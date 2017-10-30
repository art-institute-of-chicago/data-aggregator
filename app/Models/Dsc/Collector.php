<?php

namespace App\Models\Dsc;

use App\Models\DscModel;
use App\Models\ElasticSearchable;
use App\Models\Documentable;

class Collector extends DscModel
{

    use ElasticSearchable;
    use Documentable;

    public function publication()
    {

        return $this->belongsTo('App\Models\Dsc\Publication');

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
            'publication_id' => $this->publication ? $this->publication->dsc_id : null,
        ];

    }


    /**
     * Generate model-specific fields for an array representing the schema for this object.
     *
     * @return array
     */
    public function elasticsearchMappingFields()
    {

        return
            [
                'content' => [
                    'type' => 'text',
                ],
                'weight' => [
                    'type' => 'integer',
                ],
                'depth' => [
                    'type' => 'integer',
                ],
                'publication' => [
                    'type' => 'text',
                ],
                'publication_id' => [
                    'type' => 'integer',
                ],
            ];

    }

    /**
     * Get an example ID for documentation generation
     *
     * @return string
     */
    public function exampleId()
    {

        return "4972";

    }

}
