<?php

namespace App\Behaviors;

use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

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
     * @var string
     */
    protected $isPartial = false;


    /**
     * Set to `true` to only import a single page.
     *
     * @var boolean
     */
    protected $isTest = false;

    /**
     * Downloads a file and (optionally) runs a json decode on its contents.
     *
     * @TODO Use `curl` w/ shared handler & basic auth
     *
     * @return string|object
     */
    protected function fetch( $file, $decode = false ) {

        if( !$contents = @file_get_contents( $file ) )
        {
            throw new \Exception('Fetch failed: ' . $file );
        }

        return $decode ? json_decode( $contents ) : $contents;

    }


    /**
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
    protected function fetchWithAuth( $url, $decode = false )
    {

        $ch = curl_init();

        curl_setopt ($ch, CURLOPT_URL, $url);
        curl_setopt ($ch, CURLOPT_HEADER, 0);

        curl_setopt ($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt ($ch, CURLOPT_USERPWD, $this->auth);

        curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);

        ob_start();

        curl_exec ($ch);
        curl_close ($ch);

        $contents = ob_get_contents();

        ob_end_clean();

        if( is_null( $contents ) ) {
            throw new \Exception("Cannot fetch URL: " . $url);
        }

        return $decode ? json_decode( $contents ) : $contents;

    }

    /**
     * Helper for retrieving URL to query. Feel free to overwrite.
     *
     * @param string $endpoint
     * @param integer $page
     * @param limit $limit
     *
     * @return string
     */
    protected function getUrl( $endpoint, $page = 1, $limit = 1000 )
    {

        return $this->api . '/' . $endpoint . '?page=' . $page . '&limit=' . $limit;

    }

    /**
     * Queries a paginated JSON endpoint from `$this->api` and returns its decoded contents.
     * Assumes that the endpoint follows our dataservice conventions for pagination.
     *
     * @param string $endpoint
     * @param integer $page
     * @param limit $limit
     *
     * @return object
     */
    protected function query( $endpoint, $page = 1, $limit = 500 )
    {

        $url = $this->getUrl( $endpoint, $page, $limit );

        // Allows us to specify which fields to retrieve, for performance
        if( $this->fields )
        {
            $url .= $this->fields;
        }

        $this->info( 'Querying: ' . $url );

        // Determine if authentication is needed
        $method = $this->auth ? 'fetchWithAuth' : 'fetch';

        return $this->$method( $url, true );

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
    protected function import( $source, $model, $endpoint, $current = 1 )
    {

        if( $this->isPartial )
        {

            $this->info("Looking for resources since " . $this->command->last_success_at);

        }

        // Figure out which transformer to use for this import operation
        $transformer = app('Resources')->getInboundTransformerForModel( $model, $source );

        // Query for the first page + get page count
        $json = $this->query( $endpoint, $current );

        if ($this->isTest) {

            $pages = 1;

            $this->warn( 'Testing import of a single page for model ' . $model );

        } else {

            // Assumes the dataservice has standardized pagination
            $pages = $json->pagination->total_pages;

            // TODO: [ErrorException] Undefined property: stdClass::$pagination
            // This happens when you're trying to hit an endpoint that doesn't exist
            // Ensure dataservice can be reached before doing this!

            $this->warn( 'Found ' . $pages . ' page(s) for model ' . $model );

        }

        while( $current <= $pages )
        {

            $this->warn( 'Importing ' . $current . ' of ' . $pages . ' for model ' . $model );

            // Assumes the dataservice wraps its results in a `data` field
            foreach( $json->data as $datum )
            {

                // TODO: Careful, this conflicts w/ partial imports – running on one endpoint counts for all!
                // Break if this is a partial import + this datum is older than last run
                if( $this->isPartial && isset( $datum->{$model::$sourceLastUpdateDateField} ) )
                {

                    $sourceTime = new Carbon( $datum->{$model::$sourceLastUpdateDateField} );
                    $sourceTime->timezone = config('app.timezone');

                    if( $this->command->last_success_at->gt( $sourceTime ) )
                    {
                        break 2;
                    }

                }

                $this->updateSentryTags( $datum, $endpoint, $source );

                // Be sure to overwrite `save` to make this work!
                $this->save( $datum, $model, $transformer );

            }

            $current++;

            // TODO: This structure causes an extra query to be run, when it might not need to be
            $json = $this->query( $endpoint, $current );

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
    protected function resetData( $modelsToFlush, $tablesToClear )
    {

        // Return false if the user bails out
        if ( !$this->confirmReset() )
        {
            return false;
        }

        // Ensure the arguments are arrays
        $modelsToFlush = is_array( $modelsToFlush ) ? $modelsToFlush : [ $modelsToFlush ];
        $tablesToClear = is_array( $tablesToClear ) ? $tablesToClear : [ $tablesToClear ];

        // TODO: If we dump the indexes + recreate them, we don't need to flush
        // Flush might not remove models that are present in the index, but not the database
        foreach( $modelsToFlush as $model )
        {
            $this->call("scout:flush", ['model' => $model]);
            $this->info("Flushed from search index: `{$model}`");
        }

        // TODO: We'd like to affect related models – consider doing an Eloquent delete instead
        // It's much slower, but it'll ensure better data integrity
        foreach( $tablesToClear as $table )
        {
            DB::table($table)->truncate();
            $this->info("Truncated `{$table}` table.");
        }

        // Reinstall search: flush might not work, since some models might be present in the index, which aren't here
        $this->info("Please manually ensure that your search index mappings are up-to-date.");
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
            $this->confirm("Running this will fully overwrite some tables in your database! Are you sure?")
        );

    }

    /**
     * This method is meant to be overwritten in a class that uses this trait.
     *
     * @param array $datum
     * @param string $model
     * @param string $transformer
     */
    protected function save( $datum, $model, $transformer )
    {

        throw \Exception('You must overwrite the `save` method.');

    }

    protected function updateSentryTags($datum = null, $endpoint = null, $source = null)
    {
        if (app()->bound('sentry'))
        {
            $sentry = app('sentry');

            $sentry->tags_context(
                array_merge([],
                    isset($datum->id) ? ['id' => $datum->id] : [],
                    isset($endpoint) ? ['endpoint' => $endpoint] : [],
                    isset($source) ? ['source' => $source] : []
                )
            );
        }
    }

}
