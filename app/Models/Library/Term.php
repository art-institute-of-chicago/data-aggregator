<?php

namespace App\Models\Library;

use App\Models\LibraryModel as BaseModel;

class Term extends BaseModel
{

    protected $hasSourceDates = false;

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
