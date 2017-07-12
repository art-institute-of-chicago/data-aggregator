<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ImportCollectionsFull extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:collections-full {endpoint?} {page?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import all collections data';

    protected $faker;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->faker = \Faker\Factory::create();
        parent::__construct();
    }

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

            // agent-types
            if (\App\Collections\AgentType::all()->isEmpty())
            {

                factory(\App\Collections\AgentType::class, 10)->create();
                
            }
            // agents
            $this->import('artists');
            $this->import('departments');
            // object-types
            $this->import('categories');
            //$this->import('galleries');
            
            $this->import('artworks');
            // artists_artworks
            // artwork-copyright-representative
            // artwork-categories
            // artwork-committees            
            // artwork-terms
            // artwork-dates
            // artwork-catalogues
            // artwork-artworks

            // themes

            $this->import('links');
            $this->import('sounds');
            $this->import('videos');
            $this->import('texts');
            // images

            //$this->import('exhibitions');

            // update artworks with gallery id and object type id 
        }
        
    }

    private function import($endpoint, $current = 1)
    {

        $json = $this->query($endpoint, $current);
        $pages = $json->pagination->pages->total;

        while ($current <= $pages)
        {

            foreach ($json->data as $source)
            {

                $class = \App\Collections\CollectionsModel::classFor($endpoint);
                print_r($source); print "\n";
                $resource = call_user_func($class .'::findOrCreate', $source->id);

                $resource->fillFrom($source);
                $resource->attachFrom($source);
                $resource->save();

            }

            $current++;
            $json = $this->query($endpoint, $current);
        }

        $json = null;

    }

    private function query($type = 'artworks', $page = 1)
    {

        $ch = curl_init();

        curl_setopt ($ch, CURLOPT_URL, env('COLLECTIONS_DATA_SERVICE_URL', 'http://localhost') .'/' .$type .'?page=' .$page .'&per_page=100');
        curl_setopt ($ch, CURLOPT_HEADER, 0);

        ob_start();

        curl_exec ($ch);
        curl_close ($ch);
        $string = ob_get_contents();

        ob_end_clean();
        $ch = null;

        return json_decode($string);

    }

}