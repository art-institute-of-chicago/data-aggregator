<?php

namespace App\Console\Commands;

use Carbon\Carbon;

class ImportCollectionsFull extends AbstractImportCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:collections-full
                            {endpoint? : That last portion of the URL path naming the resource to import, for example "artists"}
                            {page? : The page to begin importing from}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description =
                           "Import all collections data\n\n"

                           ."If no options are passes all Collections data will be imported. Results are paged through 100 records \n"
                           ."at a time. If the Collections Data Service doesn't provide an endpoint fake data will be generated.";

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        if ($this->argument('endpoint'))
        {
            $page = $this->argument('page') ?: 1;
            $this->import($this->argument('endpoint'), $page);
        }
        else
        {

            // @TODO Replace with real endpoint when it becomes available
            if (\App\Models\Collections\AgentType::all()->isEmpty())
            {

                \Artisan::call("db:seed", ['--class' => 'AgentTypesTableSeeder']);

            }

            // @TODO Replace with agent endpoint when it becomes available
            if (\App\Models\Collections\Agent::all()->isEmpty())
            {

                $this->import('artists');
                \Artisan::call("db:seed", ['--class' => 'AgentsTableSeeder']);

            }

            $this->import('departments');

            // @TODO Replace with real endpoint when it becomes available
            if (\App\Models\Collections\ObjectType::all()->isEmpty())
            {

                \Artisan::call("db:seed", ['--class' => 'ObjectTypesTableSeeder']);

            }

            // @TODO The categories endpoint in the Collections Data Service currently breaks on the last page of results.
            $this->import('categories');

            // @TODO Galleries are available, but break due to Redmine bug #1911 - Gallery Floor isn't always a number
            //$this->import('galleries');
            // @TODO Replace with real endpoint when it becomes available
            if (\App\Models\Collections\Gallery::all()->isEmpty())
            {

                \Artisan::call("db:seed", ['--class' => 'GalleriesTableSeeder']);

            }

            $this->import('artworks');
            $this->import('links');
            $this->import('videos');
            $this->import('texts');

            // @TODO Replace with real endpoint when it becomes available
            if (\App\Models\Collections\Exhibition::all()->isEmpty())
            {

                \Artisan::call("db:seed", ['--class' => 'ExhibitionsTableSeeder']);

            }

            $this->import('sounds');

        }

    }

    private function import($endpoint, $current = 1)
    {

        $class = \App\Models\CollectionsModel::classFor($endpoint);

        // Abort if the table is already filled
        $resources = call_user_func($class .'::all');
        if (!$resources->isEmpty())
        {
            return false;
        }

        // Query for the first page + get page count
        $json = $this->queryService($endpoint, $current);
        $pages = $json->pagination->pages->total;

        while ($current <= $pages)
        {

            foreach ($json->data as $source)
            {

                $resource = call_user_func($class .'::findOrCreate', $source->id);

                $resource->fillFrom($source);
                $resource->attachFrom($source);
                $resource->save();

            }

            $current++;
            $json = $this->queryService($endpoint, $current);

        }

    }

    private function queryService($type = 'artworks', $page = 1)
    {
        return $this->query( env('COLLECTIONS_DATA_SERVICE_URL', 'http://localhost') .'/' .$type .'?page=' .$page .'&per_page=100' );
    }

}
