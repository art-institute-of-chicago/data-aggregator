<?php

namespace App\Console\Helpers;

use Elasticsearch;

trait Indexer
{
    /**
     * Check if the index already exists. If it exists, the user is prompted to delete it.
     */
    public function destroy($index = null, $yes = false)
    {
        if (!$index) {
            $index = config('elasticsearch.indexParams.index');
        }

        $params = [
            'index' => $index,
        ];

        // No need to do anything if the index doesn't exist
        if (!Elasticsearch::indices()->exists($params)) {
            return true;
        }

        // Return false if the user bails out
        if (!$yes && !$this->confirm('The ' . $index . ' index already exists. Do you wish to delete it?')) {
            return false;
        }

        $this->info('Deleting ' . $index . ' index...');

        // @TODO: Catch exceptions?
        Elasticsearch::indices()->delete($params);

        return true;
    }

    public function baseUrl()
    {
        $host = config('scout.elasticsearch.hosts.0.host', 'localhost');
        $port = config('scout.elasticsearch.hosts.0.port', 9200);
        $scheme = config('scout.elasticsearch.hosts.0.sceme', null);

        return $scheme . '://' . $host . ':' . $port;
    }

    /**
     * Determine message to output after the index is created.
     *
     * @param array  $return
     */
    private function done($return = [])
    {
        if (array_key_exists('acknowledged', $return)) {
            return 'Done!';
        }

        return 'There was an error: ' . print_r($return, true);
    }
}
