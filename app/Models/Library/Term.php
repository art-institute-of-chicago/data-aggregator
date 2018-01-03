<?php

namespace App\Models\Library;

use Aic\Hub\Foundation\AbstractModel as BaseModel;

class Term extends BaseModel
{

    protected $table = 'library_terms';

    public function creatorOf()
    {

        return $this->belongsToMany('App\Models\Library\Material', 'library_material_creator', 'term_id', 'material_id');

    }

    public function subjectOf()
    {

        return $this->belongsToMany('App\Models\Library\Material', 'library_material_creator', 'term_id', 'material_id');

    }

}
