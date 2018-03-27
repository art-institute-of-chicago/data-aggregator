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
     * (Optional) HTTP Basic Auth string.
     *
     * @var string
     */
    protected $auth;


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
        curl_setopt ($ch, CURLOPT_USERPWD, $auth);

        ob_start();

        curl_exec ($ch);
        curl_close ($ch);

        $contents = ob_get_contents();

        ob_end_clean();

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

        // Determine if authentication is needed
        $method = $this->auth ? 'fetchWithAuth' : 'fetch';

        return $this->$method( $url, true );

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

        $this->warn( 'Found ' . $pages . ' page(s) for model ' . $model );

        while( $current <= $pages )
        {

            $this->warn( 'Importing ' . $current . ' of ' . $pages . ' for model ' . $model );

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
