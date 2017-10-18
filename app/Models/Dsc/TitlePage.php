<?php

namespace App\Models\Dsc;

use App\Models\DscModel;
use App\Models\Documentable;

class TitlePage extends DscModel
{

    use Documentable;

    public function publication()
    {

        return $this->belongsTo('App\Models\Dsc\Publication');

    }


    /**
     * Turn this item object into a generic array.
     *
     * @param  \App\Models\Dsc\Publication  $item
     * @return array
     */
    public function transformFields()
    {

        return [
            'content' => $this->content,
            'publication' => $this->publication ? $this->publication->title : '',
            'publication_id' => $this->publication_dsc_id,
        ];

    }

    /**
     * Get an example ID for documentation generation
     *
     * @return string
     */
    public function exampleId()
    {

        return "7991";

    }

}
