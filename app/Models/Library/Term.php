<?php

namespace App\Models\Library;

use Aic\Hub\Foundation\AbstractModel as BaseModel;

class Term extends BaseModel
{

    public function creatorOf()
    {

        return $this->belongsToMany('App\Models\Library\Material', 'material_creator');

    }

    public function subjectOf()
    {

        return $this->belongsToMany('App\Models\Library\Material', 'material_subject');

    }

}
