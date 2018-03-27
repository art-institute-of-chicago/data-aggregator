<?php

namespace App\Behaviors;

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
     * Queries a paginated JSON endpoint from `$this->api` and returns its decoded contents.
     * Assumes that the endpoint follows our dataservice conventions for pagination.
     *
     * @param string $endpoint
     * @param integer $page
     * @param limit $limit
     *
     * @return object
     */
    protected function query( $endpoint, $page = 1, $limit = 1000 )
    {

        $url = $this->api . '/' . $endpoint . '?page=' . $page . '&limit=' . $limit;

        // Allows us to specify which fields to retrieve, for performance
        if( $this->fields )
        {
            $url .= $this->fields;
        }

        $this->info( 'Querying: ' . $url );

        return $this->fetch( $url, true );

    }

    /**
     * Queries a paginated JSON endpoint from `$this->api` and returns its decoded contents.
     * Assumes that the endpoint follows our dataservice conventions for pagination.
     *
     * @param string $model
     * @param string $endpoint
     * @param integer $current  Current page for offset start
     *
     * @return object
     */
    protected function import( $model, $endpoint, $current = 1 )
    {

        // Abort if the table is already filled
        if( $model::count() > 0 )
        {
            return false;
        }

        // Query for the first page + get page count
        $json = $this->query( $endpoint, $current );

        // Assumes the dataservice has standardized pagination
        $pages = $json->pagination->total_pages;

        while( $current <= $pages )
        {

            // Assumes the dataservice wraps its results in a `data` field
            foreach( $json->data as $datum )
            {
                // Be sure to overwrite `save` to make this work!
                $this->save( $datum, $model );
            }

            $current++;

            $json = $this->query( $endpoint, $current );

        }

    }

    /**
     * This method is meant to be overwritten in a class that uses this trait.
     *
     * @TODO Abstract this into an inbound transformer
     *
     * @param array $datum
     * @param string $model
     */
    protected function save( $datum, $model )
    {

        throw \Exception('You must overwrite the `save` method.');

    }

}
