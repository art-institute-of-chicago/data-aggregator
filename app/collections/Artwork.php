<?php

namespace App\Collections;

class Artwork extends CollectionsModel
{

    public $incrementing = false;
    protected $primaryKey = 'citi_id';
    protected $dates = ['source_created_at', 'source_modified_at', 'source_indexed_at', 'citi_created_at', 'citi_modified_at'];

    public function artists()
    {

        return $this->belongsToMany('App\Collections\Artist', 'agent_artwork', 'artwork_citi_id', 'agent_citi_id');

    }

    public function copyrightRepresentatives()
    {

        return $this->belongsToMany('App\Collections\CopyrightRepresentative', 'agent_artwork', 'artwork_citi_id', 'agent_citi_id');

    }

    public function department()
    {

        return $this->belongsTo('App\Collections\Department');

    }

    public function objectType()
    {

        return $this->belongsTo('App\Collections\ObjectType');

    }

    public function categories()
    {

        return $this->belongsToMany('App\Collections\Category');

    }

    public function dates()
    {

        return $this->hasMany('App\Collections\ArtworkDate');

    }

    public function committees()
    {

        return $this->hasMany('App\Collections\ArtworkCommittee');

    }

    public function terms()
    {

        return $this->hasMany('App\Collections\ArtworkTerm');

    }

    public function catalogues()
    {

        return $this->hasMany('App\Collections\ArtworkCatalogue');

    }

    public function gallery()
    {

        return $this->belongsTo('App\Collections\Gallery');

    }

    public function parts()
    {

        return $this->belongsToMany('App\Collections\Artwork', 'artwork_artwork', 'set_citi_id', 'part_citi_id');

    }

    public function sets()
    {

        return $this->belongsToMany('App\Collections\Artwork', 'artwork_artwork', 'part_citi_id', 'set_citi_id');

    }

    public function images()
    {

        return $this->belongsToMany('App\Collections\Image');

    }

    public function mobileArtwork()
    {

        return $this->hasOne('App\Mobile\Artwork');

    }

    public function mobileSounds()
    {

        return $this->belongsToMany('App\Mobile\Sound', 'artwork_mobile_app_sound', 'artwork_citi_id', 'mobile_app_sound_mobile_id');

    }

    public function tourStops()
    {

        return $this->hasMany('App\Mobile\TourStop');

    }

    public function tours()
    {

        return $this->belongsToMany('App\Mobile\Tour', 'tour_stops');

    }

    public function publications()
    {

        return $this->belongsToMany('App\Dsc\Publication', 'works_of_art');

    }

    public function getFillFieldsFrom($source)
    {

        return [
            'citi_id' => $source->id,
            'lake_guid' => $source->lake_guid,
            'main_id' => $source->main_id,
            'date_display' => $source->date_display,
            'date_start' => $source->date_start,
            'date_end' => $source->date_end,
            'artist_display' => $source->creator_display,
            'dimensions' => $source->dimensions,
            'medium' => $source->medium,
            'credit_line' => $source->credit_line,
            'inscriptions' => $source->inscriptions,
            'publication_history' => $source->publications,
            'exhibition_history' => $source->exhibitions,
            'provenance' => $source->provenance,
            'description' => 'fake ' .$this->faker->paragraphs(5, true),
            'publishing_verification_level' => 'fake ' .$this->faker->randomElement(['Web Basic', 'Web Cataloged', 'Web Everything']),
            'is_public_domain' => $this->faker->boolean,
            'copyright_notice' => $source->copyright,
            'place_of_origin' => 'fake ' .$this->faker->country,
            'collection_status' => 'fake ' .$this->faker->randomElement(['Permanent Collection', 'Long-term Loan']),
            'department_citi_id' => $source->department_id,
            //'object_type_citi_id' => ,
            //'gallery_citi_id' => ,
            'source_created_at' => strtotime($source->created_at),
            'source_modified_at' => strtotime($source->modified_at),
            'source_indexed_at' => strtotime($source->indexed_at),
        ];

    }

    public function attachFrom($source)
    {

        if ($source->creator_id)
        {

            Artist::findOrCreate($source->creator_id);
            $this->artists()->attach($source->creator_id);

        }

        // $source->image_guid

        if ($source->department_id)
        {

            $department = Department::findOrCreate($source->department_id);
            $this->department()->associate($department);

        }

        if ($source->category_guids)
        {
            foreach ($source->category_guids as $guid)
            {

                $cat = Category::where('lake_guid', $guid)->first();
                if ($cat)
                {

                    $this->categories()->attach($cat->citi_id);

                }

            }

        }
        // $source->document_guids

        // @TODO Replace with real endpoints when they become available
        $this->seedCopyrightRepresentatives();
        $this->seedCommittees();
        $this->seedTerms();
        $this->seedDates();
        $this->seedCatalogues();
        //$this->seedParts();
        
        // update artworks with gallery id and object type id 

        return $this;

    }

    public function seedCopyrightRepresentatives()
    {

        $agentIds = CopyrightRepresentative::all()->pluck('citi_id')->all();

        $ids = [];
            
        for ($i = 0; $i < rand(2,8); $i++) {

            $id = $agentIds[array_rand($agentIds)];

            if (!in_array($id, $ids)) {
                $this->copyrightRepresentatives()->attach($id);
                $ids[] = $id;
            }

        }

        return $this;

    }

    public function seedCommittees()
    {

        for ($i = 0; $i < rand(2,8); $i++) {
                
            $committee = factory(ArtworkCommittee::class)->make([
                'artwork_citi_id' => $this->citi_id,
            ]);

            $this->committees()->save($committee);

        }

        return $this;

    }

    public function seedTerms()
    {

        for ($i = 0; $i < rand(2,8); $i++) {
                
            $term = factory(ArtworkTerm::class)->make([
                'artwork_citi_id' => $this->citi_id,
            ]);

            $this->terms()->save($term);

        }

        return $this;

    }

    public function seedDates()
    {

        $hasPreferred = false;
            
        for ($i = 0; $i < rand(2,8); $i++) {
                
            $preferred = $hasPreferred ? false : $this->faker->boolean;
                
            $this->dates()->create([
                'date' => $this->faker->dateTimeAD,
                'qualifier' => ucfirst($this->faker->word) .' date',
                'preferred' => $preferred,
            ]);

            if ($preferred || $hasPreferred) $hasPreferred = true;

        }

        return $this;

    }

    public function seedCatalogues()
    {

        $hasPreferred = false;
            
        for ($i = 0; $i < rand(2,8); $i++) {
                
            $preferred = $this->faker->boolean;
                
            $this->catalogues()->create([
                'preferred' => $hasPreferred ? false : $this->faker->boolean,
                'catalogue' => ucwords($this->faker->words(2, true)),
                'number' => $this->faker->randomNumber(3),
                'state_edition' => $this->faker->words(2, true),
            ]);

            if ($preferred || $hasPreferred) $hasPreferred = true;

        }

        return $this;

    }

    public function seedImages()
    {

        $hasPreferred = false;
            
        for ($i = 0; $i < rand(2,8); $i++) {
                
            $preferred = $hasPreferred ? false : $this->faker->boolean;
                
            $image = factory(\App\Collections\Image::class)->make([
                'preferred' => $preferred,
            ]);

            $artwork->images()->save($image);

            if ($preferred || $hasPreferred) $hasPreferred = true;

        }

        return $this;

    }

}
