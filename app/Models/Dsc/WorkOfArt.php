<?php

namespace App\Models\Dsc;

use App\Models\DscModel;
use App\Models\SolrSearchable;

class WorkOfArt extends DscModel
{

    use SolrSearchable;

    public $table = 'works_of_art';

    // @TODO: Because WorkOfArt uses SolrSearchable directly, we error out on $apiCtrl
    // protected $apiCtrl = 'WorksOfArt';

    protected function searchableLink()
    {

        return action('WorksOfArtController@show', ['id' => $this->getKey()]);

    }

    public function publication()
    {

        return $this->belongsTo('App\Models\Dsc\Publication');

    }

    public function artwork()
    {

        return $this->belongsTo('App\Models\Collections\Artwork');

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
            'content' => $this->content,
            'weight' => $this->weight,
            'depth' => $this->depth,
            'publication' => $this->publication ? $this->publication->title : '',
            'publication_id' => $this->publication_dsc_id,
            'artwork' => $this->artwork ? $this->artwork->title : '',
            'artwork_id' => $this->artwork_citi_id,
        ];

    }

}
