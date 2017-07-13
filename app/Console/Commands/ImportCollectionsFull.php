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

            // Until Agent Types are available as an endpoint in the Collections Data Service
            // generate fake data.
            if (\App\Collections\AgentType::all()->isEmpty())
            {

                factory(\App\Collections\AgentType::class, 10)->create();
                
            }

            // Until all Agents are available as an endpoint in the Collections Data Service
            // import artists and generate fake data for other agent types
            $this->import('artists');
            if (\App\Collections\CopyrightRepresentative::all()->isEmpty())
            {

                factory(\App\Collections\Agent::class, 25)->create(['agent_type_citi_id' => \App\Collections\AgentType::where('title', 'Copyright Representative')->first()->citi_id]);
                
            }
            if (\App\Collections\CorporateBody::all()->isEmpty())
            {

                factory(\App\Collections\Agent::class, 25)->create(['agent_type_citi_id' => \App\Collections\AgentType::where('title', 'Corporate Body')->first()->citi_id]);
                
            }

            $this->import('departments');

            // Until Object Types are available as an endpoint in the Collections Data Service
            // generate fake data.
            if (\App\Collections\ObjectType::all()->isEmpty())
            {

                factory(\App\Collections\ObjectType::class, 25)->create();

            }

            // The categories endpoint in the Collections Data Service currently breaks on the last page of results.
            // So let's only try to import this once for now.
            if (\App\Collections\Category::all()->isEmpty())
            {

                $this->import('categories');

            }

            // Galleries are available, but break due to Redmine bug #1911 - Gallery Floor isn't always a number
            //$this->import('galleries');
            
            $this->import('artworks');

            $this->import('links');
            $this->import('videos');
            $this->import('texts');
            $this->import('sounds');

            // Until Images are available as an endpoint in the Collections Data Service
            // generate fake data.
            $artworks = \App\Collections\Artwork::all()->all();

            foreach ($artworks as $artwork) {

                $hasPreferred = false;
            
                for ($i = 0; $i < rand(2,8); $i++) {
                
                    $preferred = $hasPreferred ? false : $this->faker->boolean;
                
                    $image = factory(\App\Collections\Image::class)->make([
                        'preferred' => $preferred,
                    ]);

                    $artwork->images()->save($image);

                    if ($preferred || $hasPreferred) $hasPreferred = true;

                }

            }

            // Until Exhibitions are available as an endpoint in the Collections Data Service
            // generate fake data.
            if (\App\Collections\Exhibition::all()->isEmpty())
            {
                factory(\App\Collections\Exhibition::class, 100)->create();

                $exhibitions = \App\Collections\Exhibition::all()->all();
                $artworkIds = \App\Collections\Artwork::all()->pluck('citi_id')->all();
                $agentIds = \App\Collections\CorporateBody::all()->pluck('citi_id')->all();

                foreach ($exhibitions as $exhibition) {
            
                    for ($i = 0; $i < rand(2,8); $i++) {

                        $artworkId = $artworkIds[array_rand($artworkIds)];

                        $exhibition->artworks()->attach($artworkId);

                    }

                    for ($i = 0; $i < rand(1,3); $i++) {

                        $agentId = $agentIds[array_rand($agentIds)];

                        $exhibition->venues()->attach($agentId);

                    }

                }

            }

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