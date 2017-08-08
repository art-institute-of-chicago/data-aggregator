<?php

namespace App\Console\Helpers;

use Elasticsearch;

trait Indexer
{

    /**
     * Check if the index already exists. If it exists, the user is prompted to delete it.
     */
    public function destroy($index = null)
    {

        if (!$index)
        {

            $index = env('ELASTICSEARCH_INDEX', 'data_aggregator_test');

        }

        $params = [
            'index' => $index,
        ];

        // No need to do anything if the index doesn't exist
        if (!Elasticsearch::indices()->exists($params))
        {
            return true;
        }

        // Return false if the user bails out
        if (!$this->confirm("The " .$index ." index already exists. Do you wish to delete it?"))
        {
            return false;
        }

        // @TODO: Catch exceptions?
        Elasticsearch::indices()->delete($params);

        return true;

    }


    public function baseUrl()
    {

        $host = env('ELASTICSEARCH_HOST', 'localhost');
        $port = env('ELASTICSEARCH_PORT', 9200);
        $scheme = env('ELASTICSEARCH_SCHEME', null);

        return $scheme .'://' .$host .':' .$port;

    }


    /**
     * Determine message to output after the index is created.
     *
     * @param array  $return
     */
    private function done($return = [])
    {

        if ($return['acknowledged'])
        {

            return 'Done!';

        }

        return "There was an error: " .print_r($return, true);

    }

}
