<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DeleteCollectionsRecords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:collections-delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete records that have been removed from the source system';

    protected $size = 100;

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

        $this->deleteUnpublished(\App\Models\Collections\ArtworkDateQualifier::class);
        $this->deleteUnpublished(\App\Models\Collections\ArtworkType::class, 'object-types');
        $this->deleteUnpublished(\App\Models\Collections\AgentType::class);
        $this->deleteUnpublished(\App\Models\Collections\AgentPlace::class);
        $this->deleteUnpublished(\App\Models\Collections\Agent::class);
        $this->deleteUnpublished(\App\Models\Collections\Category::class);
        $this->deleteUnpublished(\App\Models\Collections\Term::class);
        $this->deleteUnpublished(\App\Models\Collections\Place::class);
        $this->deleteUnpublished(\App\Models\Collections\Gallery::class);
        $this->deleteUnpublished(\App\Models\Collections\ArtworkCatalogue::class);
        $this->deleteUnpublished(\App\Models\Collections\Catalogue::class);
        $this->deleteUnpublished(\App\Models\Collections\Artwork::class);
        $this->deleteUnpublished(\App\Models\Collections\Video::class);
        $this->deleteUnpublished(\App\Models\Collections\Text::class);
        $this->deleteUnpublished(\App\Models\Collections\Sound::class);
        $this->deleteUnpublished(\App\Models\Collections\AgentExhibition::class);
        $this->deleteUnpublished(\App\Models\Collections\Exhibition::class);
        $this->deleteUnpublished(\App\Models\Collections\Image::class);

    }

    private function deleteUnpublished($model = \App\Models\Collections\Artwork::class, $endpoint = '')
    {

        if (!$endpoint)
        {

            $endpoint = app('Resources')->getEndpointForModel($model);

        }

        $size = $this->size;
        if ($model::instance()->getKeyName() == 'lake_guid')
        {
            $size = $size / 10;
        }
        $model::chunk($size, function ($resources) use ($model, $endpoint) {
            $this->info( 'Working on ' . $endpoint . ' starting at ' .$resources->pluck($model::instance()->getKeyName())->first());

            // Get a list of CITI IDs of works in the Data Aggregator
            $daIds = $resources->pluck($model::instance()->getKeyName());

            $json = json_decode(file_get_contents(env('COLLECTIONS_DATA_SERVICE_URL')
                                                  .'/'
                                                  .$endpoint
                                                  .'?flo=id&limit=' .$this->size .'&ids='
                                                  .implode(',',$daIds->all()),
                                                  false,
                                                  stream_context_create([
                                                      'http'=> [
                                                          'timeout' => 120,  //120 Seconds is 2 Minutes
                                                      ]
                                                  ])));

            $cdsIds = collect($json->data)->pluck('id');

            // Compare those two lists, and delete anything in the Data Hub that's not in the CSD
            $diff = $daIds->diff($cdsIds)->all();
            if ($diff)
            {

                $this->warn( 'Deleting ' . implode(',', $diff) );
                $model::destroy($diff);

            }

        });

    }
}
