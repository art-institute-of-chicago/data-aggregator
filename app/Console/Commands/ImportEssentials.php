<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ImportEssentials extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:essentials';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import all collections data related to Essential Works';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        // Return false if the user bails out
        if (!$this->confirm("WARNING: Running this will reset your database! Are you sure?"))
        {
            return false;
        }

        // Truncate all tables
        $this->call("migrate:refresh");

        // These hold parsed responses from the server
        $images = [];
        $artworks = [];
        $galleries = [];
        $categories = [];
        $departments = [];

        // These will be filled in from artworks
        $image_ids = [];
        $category_ids = [];
        $department_ids = [];

        // TODO: Replace this w/ $gallery_ids, when those become available in LPM Solr
        $gallery_titles = [];

        // We are interested in only the essentials
        $artwork_ids = \App\Models\Collections\Artwork::getEssentialIds();

        // Reduce the number of ids down, for testing
        $artwork_ids = array_slice( $artwork_ids, 0, 50 );

        // Due to the way findOrCreate() works, importing artworks will create stub
        // database entries for all related entities, usually only containing the id.
        // Thus, we could ::all() the related models, and pluck their ids, but this works.

        $artworks = $this->getData( $artwork_ids, 'artworks' );

        // Extract related ids from the artworks
        foreach( $artworks as $artwork ) {

            // TODO: Extract more than just the preferred representation
            if( !is_null( $artwork->image_guid ) ) {
                $image_ids[] = $artwork->image_guid;
            }

            if( !is_null( $artwork->creator_id ) ) {
                $creator_ids[] = $artwork->creator_id;
            }

            if( !is_null( $artwork->department_id ) ) {
                $department_ids[] = $artwork->department_id;
            }

            if( !is_null( $artwork->location ) ) {
                $gallery_titles[] = $artwork->location;
            }

            if( !is_null( $artwork->category_ids ) ) {
                $category_ids = array_merge( $category_ids, $artwork->category_ids );
            }

        }

        // Ensure there's no duplicates
        $image_ids = array_unique( $image_ids );
        $creator_ids = array_unique( $creator_ids );
        $category_ids = array_unique( $category_ids );
        $department_ids = array_unique( $department_ids );
        $gallery_titles = array_unique( $gallery_titles );

        // We need an Agent Type w/ title = Artist, or Artwork import will fail
        // We can't actually import the real Agent Types, since none of them is `Artist`
        // Until this discrepancy is resolved, just manually seed the table
        $agent_type = new \App\Models\Collections\AgentType;
        $agent_type->citi_id = 7;
        $agent_type->title = 'Artist';
        $agent_type->lake_guid = '053cb6d5-7a32-772b-6ab0-ed4d5586775f';

        $agent_type->save();

        // Add all Artworks to database
        $artworks = $this->import( $artworks, 'artworks' );

        // TODO: Get all Galleries, after Gallery ID becomes available

        // Clear up some memory
        unset( $artworks );

        // Do the thing
        $this->getDataAndImport( $image_ids, 'images' );
        $this->getDataAndImport( $creator_ids, 'artists' );
        $this->getDataAndImport( $category_ids, 'categories' );
        $this->getDataAndImport( $department_ids, 'departments' );

    }


    /**
     * A convenience method that gets data for multiple resources from the CDS API,
     * and saves them all to the aggregator's database.
     *
     * @param array $ids
     * @param string $type
     *
     * @return array
     */
    private function getDataAndImport( array $ids, $type = 'artworks' ) {

        return $this->import( $this->getData( $ids, $type ), $type );

    }


    /**
     * Uses an array of data (e.g. `$response->data` from the CDS API) to create or
     * update multiple resources in the aggregator.
     *
     * @param array $data
     * @param string $type
     *
     * @return array
     */
    private function import(array $data, $type = 'artworks' )
    {

        $resources = [];

        $class = \App\Models\CollectionsModel::classFor($type);

        foreach ($data as $datum)
        {

            $resource = call_user_func($class .'::findOrCreate', $datum->id);

            $resource->fillFrom($datum, false);
            $resource->attachFrom($datum, false);
            $resource->save();

            $resources[] = $resource;

        }

        return $resources;

    }


    /**
     * This method accepts an array of ids, generates appropriate CDS API URLs, and
     * retrieves their data from the CDS. It works similar to `import:collections-full`,
     * but has the ability to target specific ids. There's some risk of running out of
     * memory, but it should be fine for small datasets.
     *
     * @param array $ids
     * @param string $type
     *
     * @return array
     */
    private function getData( array $ids, $type = 'artworks' ) {

        $results = [];

        // Avoid making the URI too long
        $urls = $this->getUrls( $ids, $type );

        // There's some danger of running out of memory w/ too many results
        // ...but this should work fine for ~400 entities
        foreach( $urls as $url ) {

            $response = $this->query($url);
            $results = array_merge($results, $response->data);

        }

        return $results;

    }


    /**
     * Query the CDS for a specific resource type, and loop through all pages, gathering
     * the results into an array. This method is similar to the `import:collections-full`
     * approach. It runs the risk of running out of memory, but it works fine for smaller
     * datasets.
     *
     * @param string $type
     * @param integer $current
     *
     * @return array
     */
    private function getAllData( $type = 'artworks', $current = 1 )
    {

        $results = [];

        $class = \App\Models\CollectionsModel::classFor($endpoint);

        // Query for the first page + get page count
        $response = $this->query($endpoint, $current);
        $pages = $response->pagination->pages->total;

        while ($current <= $pages)
        {

            $results[] = $response->data;

            $response = $this->query($endpoint, $current);

            $current++;

        }

        return $results;

    }


    /**
     * This method will take an array of ids and return an array of URLs to the CDS API,
     * which utilize the `?ids=a,b,c` syntax. It'll iterate on chunking the ids until the
     * URLs it generates all satisfy a reasonable length criteria (600 chars).
     *
     * @param array $ids
     * @param string $type
     *
     * @return array
     */
    private function getUrls( array $ids, $type = 'artworks' )
    {

        $n = 0;

        do {

            $n++;

            $chunked_ids = self::partition( $ids, $n );

            $urls = array_map( function( $ids ) use ($type) {

                return env('COLLECTIONS_DATA_SERVICE_URL', 'http://localhost')
                    . '/' . $type
                    . '?per_page=' . count( $ids )
                    . '&ids=' . implode(',', $ids);

            }, $chunked_ids);

            // Don't generate a URL longer than 600 characters, including prefix
            $max_url_length = max(array_map('strlen', $urls));

        } while( $max_url_length > 600 );

        return $urls;

    }


    /**
     * Convenience curl wrapper. Accepts `GET` URL. Returns decoded JSON.
     *
     * @param string $url
     *
     * @return string
     */
    private function query($url)
    {

        $ch = curl_init();

        curl_setopt ($ch, CURLOPT_URL, $url);
        curl_setopt ($ch, CURLOPT_HEADER, 0);

        ob_start();

        curl_exec ($ch);
        curl_close ($ch);
        $string = ob_get_contents();

        ob_end_clean();

        return json_decode($string);

    }

    /**
     *
     * @param Array $list
     * @param int $p
     * @return multitype:multitype:
     * @link http://www.php.net/manual/en/function.array-chunk.php#75022
     */
    private static function partition(Array $list, $p) {
        $listlen = count($list);
        $partlen = floor($listlen / $p);
        $partrem = $listlen % $p;
        $partition = array();
        $mark = 0;
        for($px = 0; $px < $p; $px ++) {
            $incr = ($px < $partrem) ? $partlen + 1 : $partlen;
            $partition[$px] = array_slice($list, $mark, $incr);
            $mark += $incr;
        }
        return $partition;
    }

}
