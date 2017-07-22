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

}
