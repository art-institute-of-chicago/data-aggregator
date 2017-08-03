<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Elasticsearch;

class InstallSearch extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'search:install';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set up the Search Service index with data types and fields';


    /**
     * The name of the index to create.
     *
     * @var string
     */
    protected $index;


    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->index = env('ELASTICSEARCH_INDEX', 'data_aggregator:v1');
    }


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $this->check();

        $params = [
            'index' => $this->index,
            'body' => [
                'mappings' =>
                array_merge(
                    \App\Models\Collections\Agent::instance()->elasticsearchMapping(),
                    \App\Models\Collections\Department::instance()->elasticsearchMapping(),
                    \App\Models\Collections\Category::instance()->elasticsearchMapping(),
                    \App\Models\Collections\Gallery::instance()->elasticsearchMapping(),
                    \App\Models\Collections\Artwork::instance()->elasticsearchMapping(),
                    \App\Models\Collections\Link::instance()->elasticsearchMapping(),
                    \App\Models\Collections\Sound::instance()->elasticsearchMapping(),
                    \App\Models\Collections\Video::instance()->elasticsearchMapping(),
                    \App\Models\Collections\Text::instance()->elasticsearchMapping(),
                    \App\Models\Collections\Exhibition::instance()->elasticsearchMapping(),

                    \App\Models\Shop\Category::instance()->elasticsearchMapping(),
                    \App\Models\Shop\Product::instance()->elasticsearchMapping(),

                    \App\Models\Membership\Event::instance()->elasticsearchMapping(),

                    \App\Models\Mobile\Tour::instance()->elasticsearchMapping(),
                    \App\Models\Mobile\TourStop::instance()->elasticsearchMapping(),

                    \App\Models\Dsc\Publication::instance()->elasticsearchMapping(),
                    \App\Models\Dsc\Section::instance()->elasticsearchMapping(),
                    \App\Models\Dsc\WorkOfArt::instance()->elasticsearchMapping(),
                    \App\Models\Dsc\Collector::instance()->elasticsearchMapping(),

                    \App\Models\StaticArchive\Site::instance()->elasticsearchMapping()

                )
            ]
        ];

        $return = Elasticsearch::indices()->create($params);
        
        $this->info($this->done($return));
    }


    /**
     * Check if the index already exists. If it exists, the user is prompted to delete it.
     */
    protected function check()
    {

        $params = [
            'index' => $this->index,
        ];        

        if (Elasticsearch::indices()->exists($params))
        {

            if ($this->confirm("The " .$this->index ." index already exists. Do you wish to delete it?")) {

                $return = Elasticsearch::indices()->delete($params);

            }

        }

    }


    /**
     * Determine message to output after the index is created.
     *
     * @param array  $return
     */
    protected function done($return = [])
    {

        if ($return['acknowledged'])
        {

            return 'Done!';

        }

        return "There was an error: " .print_r($return, true);

    }

}
