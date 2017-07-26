<?php

namespace App\Models\StaticArchive;

use App\Models\BaseModel;
use App\Models\SolrSearchable;

class Site extends BaseModel
{

    use SolrSearchable;

    protected $primaryKey = 'site_id';
    protected $dates = ['source_created_at', 'source_modified_at'];

    public function exhibition()
    {

        return $this->belongsTo('App\Models\Collections\Exhibition');

    }

    public function artworks()
    {

        return $this->belongsToMany('App\Models\Collections\Artwork');

    }


    /**
     * Turn this model object into a generic array.
     *
     * @param boolean  $withTitles
     * @return array
     */
    public function transformFields()
    {

        return [
            'description' => $this->description,
            'link' => $this->link,
            'exhibition' => $this->exhibition ? $this->exhibition->title : "",
            'exhibition_id' => $this->exhibition_citi_id,
            'artwork_ids' => $this->artworks->pluck('citi_id')->all(),
        ];

    }


    /**
     * Turn the titles for related models into a generic array
     *
     * @return array
     */
    protected function transformTitles()
    {

        return [

            'artwork_titles' => $this->artworks->pluck('title')->all(),

        ];

    }

}
