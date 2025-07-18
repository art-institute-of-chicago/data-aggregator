<?php

namespace App\Behaviors;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Sentry\State\Scope;

trait ImportsData
{
    /**
     * Base URL of the API to hit.
     *
     * @TODO Move this data to config file?
     *
     * @var string
     */
    protected $api;

    /**
     * (Optional) Comma-separated list of fields to retrieve.
     *
     * @var string
     */
    protected $fields;

    /**
     * (Optional) HTTP Basic Auth string.
     *
     * @var string
     */
    protected $auth;

    /**
     * Is this a full import, or a partial? If partial, import stops when it
     * encounters the first items older than the last successful run.
     *
     * @var bool
     */
    protected $isPartial = false;

    /**
     * How far back to scan for items? Only relevant if `$isPartial` is true.
     *
     * @var \Carbon\CarbonInterface
     */
    protected $since;

    /**
     * Seconds to sleep between requests.
     *
     * @var int
     */
    protected $sleepFor = 1;

    /**
     * Set to `true` to only import a single page.
     *
     * @var boolean
     */
    protected $isTest = false;

    /**
     * Downloads a file and (optionally) runs a json decode on its contents.
     * Convenience curl wrapper. Accepts `GET` URL. Returns decoded JSON.
     *
     * @TODO Figure out how to catch "fetch failed" exceptions w/ curl
     *
     * @TODO If we use curl, we should keep the connection open, and reuse the same handle
     * @link https://stackoverflow.com/questions/18046637/should-i-close-curl-or-not
     *
     * @param string $url
     *
     * @return string
     */
    protected function fetch($url, $decode = false)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);

        if ($this->auth) {
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
            curl_setopt($ch, CURLOPT_USERPWD, $this->auth);
        }

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        // WEB-874: If connection or response take longer than 30 seconds, give up
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);

        ob_start();

        $retries = 3;

        do {
            curl_exec($ch);
            $retries--;
        } while (curl_errno($ch) === 28 && $retries > 0);

        if (curl_errno($ch)) {
            throw new \Exception(curl_error($ch));
        }

        curl_close($ch);

        $contents = ob_get_contents();

        ob_end_clean();

        if (is_null($contents)) {
            throw new \Exception('Cannot fetch URL: ' . $url);
        }

        return $decode ? json_decode($contents) : $contents;
    }

    /**
     * Helper for retrieving URL to query. Feel free to overwrite.
     *
     * @param string $endpoint
     * @param integer $page
     * @param integer $limit
     *
     * @return string
     */
    protected function getUrl($endpoint, $page = 1, $limit = 1000)
    {
        return $this->api . '/' . $endpoint . '?page=' . $page . '&limit=' . $limit;
    }

    /**
     * Queries a paginated JSON endpoint from `$this->api` and returns its decoded contents.
     * Assumes that the endpoint follows our dataservice conventions for pagination.
     *
     * @param string $endpoint
     * @param integer $page
     * @param integer $limit
     *
     * @return object
     */
    protected function query($endpoint, $page = 1, $limit = 500)
    {
        $url = $this->getUrl($endpoint, $page, $limit);

        // Allows us to specify which fields to retrieve, for performance
        if ($this->fields) {
            $url .= $this->fields;
        }

        $this->info('Querying: ' . $url);

        return $this->fetch($url, true);
    }

    /**
     * Queries a paginated JSON endpoint from `$this->api` and returns its decoded contents.
     * Assumes that the endpoint follows our dataservice conventions for pagination.
     *
     * @param string $source
     * @param string $model
     * @param string $endpoint
     * @param integer $current  Current page for offset start
     *
     * @return object
     */
    protected function import($source, $model, $endpoint, $current = 1)
    {
        $this->since = $this->command->last_success_at;

        if ($this->hasOption('since') && !empty($this->option('since'))) {
            try {
                $this->since = Carbon::parse($this->option('since'));
            } catch (\Exception $e) {
                echo 'Cannot parse date in --since option';
            }
        }

        if ($this->isPartial) {
            $this->info('Looking for resources since ' . $this->since->toIso8601String());
        }

        // Figure out which transformer to use for this import operation
        $transformer = app('Resources')->getInboundTransformerForModel($model, $source);

        // Query for the first page + get page count
        $json = $this->query($endpoint, $current);

        if ($this->isTest) {
            $pages = 1;

            $this->warn('Testing import of a single page for model ' . $model);
        } else {
            // Assumes the dataservice has standardized pagination
            $pages = $json->pagination->total_pages;

            // TODO: [ErrorException] Undefined property: stdClass::$pagination
            // This happens when you're trying to hit an endpoint that doesn't exist
            // Ensure dataservice can be reached before doing this!

            $this->warn('Found ' . $pages . ' page(s) for model ' . $model);
        }

        while ($current <= $pages) {
            $this->warn('Importing ' . $current . ' of ' . $pages . ' for model ' . $model);

            // Assumes the dataservice wraps its results in a `data` field
            foreach ($json->data as $datum) {
                // TODO: Careful, this conflicts w/ partial imports – running on one endpoint counts for all!
                // Break if this is a partial import + this datum is older than last run
                if ($this->isPartial && isset($datum->{$transformer::$sourceLastUpdateDateField})) {
                    $sourceTime = new Carbon($datum->{$transformer::$sourceLastUpdateDateField});
                    $sourceTime->timezone = config('app.timezone');

                    if ($this->since->gt($sourceTime)) {
                        break 2;
                    }
                }

                $this->updateSentryTags($datum, $endpoint, $source);

                // Be sure to overwrite `save` to make this work!
                $this->save($datum, $model, $transformer);
            }

            $current++;

            usleep($this->sleepFor * 1000000);

            // TODO: This structure causes an extra query to be run, when it might not need to be
            $json = $this->query($endpoint, $current);
        }

        unset($json);
    }

    /**
     * Helper for resetting relevant database tables and search indexes.
     *
     * @param array|string $modelsToFlush
     * @param array|string $tablesToClear
     *
     * @return boolean
     */
    protected function resetData($modelsToFlush, $tablesToClear)
    {
        // Return false if the user bails out
        if (!$this->confirmReset()) {
            return false;
        }

        // Ensure the arguments are arrays
        $modelsToFlush = is_array($modelsToFlush) ? $modelsToFlush : [$modelsToFlush];
        $tablesToClear = is_array($tablesToClear) ? $tablesToClear : [$tablesToClear];

        // TODO: If we dump the indexes + recreate them, we don't need to flush
        // Flush might not remove models that are present in the index, but not the database
        foreach ($modelsToFlush as $model) {
            $this->call('scout:flush', ['model' => $model]);
            $this->info("Flushed from search index: `{$model}`");
        }

        // TODO: We'd like to affect related models – consider doing an Eloquent delete instead
        // It's much slower, but it'll ensure better data integrity
        foreach ($tablesToClear as $table) {
            DB::table($table)->truncate();
            $this->info("Truncated `{$table}` table.");
        }

        // Reinstall search: flush might not work, since some models might be present in the index, which aren't here
        $this->info('Please manually ensure that your search index mappings are up-to-date.');
        // $this->call("search:uninstall");
        // $this->call("search:install");

        return true;
    }

    /**
     * Helper method for asking the user to confirm a full import.
     *
     * @return boolean
     */
    protected function confirmReset()
    {
        return (
            !$this->hasOption('yes') || $this->option('yes')
        ) || (
            // TODO: Make this less generic?
            $this->confirm('Running this will fully overwrite some tables in your database! Are you sure?')
        );
    }

    /**
     * Save a new model instance given an object retrieved from an external source.
     *
     * @param object  $datum
     * @param string  $model
     * @param string  $transformer
     *
     * @return ?\Illuminate\Database\Eloquent\Model
     */
    protected function save($datum, $model, $transformer)
    {
        $transformer = new $transformer();

        // Use the id and title after they are transformed, not before!
        $id = $transformer->getId($datum);

        // TODO: Use transformed title
        if (app()->runningInConsole()) {
            $title = is_array($datum)
                ? ($datum['title'] ?? '')
                : (
                    property_exists($datum, 'title')
                    ? $datum->title
                    : ''
                );
            $this->info("Importing #{$id}: " . $title);
        }

        // Don't use findOrCreate here, since it can cause errors due to Searchable
        $resource = $model::find($id);
        $isNew = is_null($resource);

        if ($isNew) {
            $resource = $model::make();
        }

        // This will be true almost always, except for lists
        if ($transformer->shouldSave($resource, $datum, $isNew)) {
            // Fill should always be called before sync
            // Syncing some relations requires `$instance->getKey()` to work (i.e. id is set)
            $fills = $transformer->fill($resource, $datum);
            $syncs = $transformer->sync($resource, $datum);

            $resource->save();
            $this->afterSave($resource);
        }

        // For debugging ids and titles:
        // $this->warn("Imported #{$resource->getKey()}: {$resource->title}");

        return $resource;
    }

    /**
     * If an import process needs to do anything after a resource has been sucessfully imported
     * do it here.
     *
     * @param \Illuminate\Database\Eloquent\Model
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function afterSave($resource)
    {
        return $resource;
    }

    protected function updateSentryTags($datum = null, $endpoint = null, $source = null)
    {
        if (app()->bound('sentry')) {
            $sentry = app('sentry');
            $sentry->configureScope(function (Scope $scope) use ($datum, $endpoint, $source) {
                isset($datum->id) && $scope->setTag('id', $datum->id);
                isset($endpoint) && $scope->setTag('endpoint', $endpoint);
                isset($source) && $scope->setTag('source', $source);
            });
        }
    }
}
