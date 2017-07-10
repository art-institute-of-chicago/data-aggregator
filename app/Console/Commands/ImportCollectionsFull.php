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
    protected $signature = 'import:collections-full {endpoint?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import all collections data';

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

        /*
        $this->call(ObjectTypesTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(GalleriesTableSeeder::class);
        $this->call(GalleryCategoriesTableSeeder::class);
        $this->call(ArtworksTableSeeder::class);
        $this->call(ArtistArtworksTableSeeder::class);
        $this->call(ArtworkCopyrightRepresentativesTableSeeder::class);
        $this->call(ArtworkCategoriesTableSeeder::class);
        $this->call(ArtworkCommitteesTableSeeder::class);
        $this->call(ArtworkTermsTableSeeder::class);
        $this->call(ArtworkDatesTableSeeder::class);
        $this->call(ArtworkCataloguesTableSeeder::class);
        $this->call(ArtworkArtworksTableSeeder::class);
        $this->call(ThemesTableSeeder::class);
        $this->call(LinksTableSeeder::class);
        $this->call(LinkCategoriesTableSeeder::class);
        $this->call(SoundsTableSeeder::class);
        $this->call(SoundCategoriesTableSeeder::class);
        $this->call(VideosTableSeeder::class);
        $this->call(VideoCategoriesTableSeeder::class);
        $this->call(TextsTableSeeder::class);
        $this->call(TextCategoriesTableSeeder::class);
        $this->call(ImagesTableSeeder::class);
        $this->call(ImageCategoriesTableSeeder::class);
        $this->call(ExhibitionsTableSeeder::class);
        */

        if ($this->argument('endpoint'))
        {
            $this->import($this->argument('endpoint'));
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

            $this->import('artworks');

            //$this->import('exhibitions');
        }
        
    }

    private function query($type = 'artworks', $page = 1)
    {

        return json_decode(file_get_contents(env('COLLECTIONS_DATA_SERVICE_URL', 'http://localhost') .'/' .$type .'?page=' .$page .'&per_page=1000'));

    }

    private function import($endpoint)
    {

        $json = $this->query($endpoint);
        $pages = $json->pagination->pages->total;
        $current = 1;

        while ($current <= $pages)
        {

            foreach ($json->data as $source)
            {

                $class = \App\Collections\CollectionsModel::classFor($endpoint);
                $resource = call_user_func($class .'::findOrCreate', $source->id);

                $this->{'update_' .$endpoint}($resource, $source);
                
                $resource->save();
            }

            $current++;
            $json = $this->query($endpoint, $current);
        }         

    }

    private function update_artists($resource, $source)
    {

        $resource = $this->updateIdsAndTitle($resource, $source, $citiField = true);
        $resource->birth_date = $source->date_birth;
        //$resource->birth_place = ;
        $resource->death_date = $source->date_death;
        //$resource->death_place = ;
        //$resource->licensing_restricted = 
        $resource->agent_type_citi_id = \App\Collections\AgentType::where('title', 'Artist')->first()->citi_id;
        $resource = $this->updateDates($resource, $source, $citiField = true);

        return $resource;

    }

    private function update_departments($resource, $source)
    {

        $resource = $this->updateIdsAndTitle($resource, $source, $citiField = true);
        $resource = $this->updateDates($resource, $source, $citiField = true);

        return $resource;

    }

    private function update_artworks($resource, $source)
    {

        $resource = $this->updateIdsAndTitle($resource, $source, $citiField = true);
        $resource->main_id = $source->main_id;
        $resource->date_display = $source->date_display;
        $resource->date_start = $source->date_start;
        $resource->date_end = $source->date_end;
        //$resource->description = ;
        $resource->artist_display = $source->creator_display;
        $resource->dimensions = $source->dimensions;
        $resource->medium = $source->medium;
        $resource->credit_line = $source->credit_line;
        $resource->inscriptions = $source->inscriptions;
        $resource->publication_history = $source->publications;
        $resource->exhibition_history = $source->exhibitions;
        $resource->provenance = $source->provenance;
        //$resource->publishing_verification_level = ;
        //$resource->is_public_domain = ;
        $resource->copyright_notice = $source->copyright;
        //$resource->place_of_origin = ;
        //$resource->collection_status = ;
        $resource->department_citi_id = $source->department_id;
        //$resource->object_type_citi_id = ;
        //$resource->gallery_citi_id = ;
        $resource = $this->updateDates($resource, $source, $citiField = true);

        return $resource;
    }

    private function updateIdsAndTitle($resource, $source, $citiField = true)
    {

        if ($citiField)
        {

            $resource->citi_id = $source->id;
            $resource->lake_guid = $source->lake_guid;

        }
        else
        {

            $resource->lake_guid = $source->id;

        }
            
        $resource->title = $source->title;
        $resource->lake_uri = $source->lake_uri;
        return $resource;
    }

    private function updateDates($resource, $source, $citiField = true)
    {

        $resource->source_created_at = strtotime($source->created_at);
        $resource->source_modified_at = strtotime($source->modified_at);
        $resource->source_indexed_at = strtotime($source->indexed_at);

        if ($citiField)
        {

            //$resource->citi_created_at = ;
            //$resource->citi_modified_at = ;

        }

        return $resource;
    }

}