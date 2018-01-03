<?php

namespace App\Models\Library;

use Aic\Hub\Foundation\AbstractModel as BaseModel;

class Material extends BaseModel
{

    protected $table = 'library_materials';

    public function creators()
    {

        return $this->belongsToMany('App\Models\Library\Term', 'library_material_creator', 'material_id', 'term_id');

    }

    public function subjects()
    {

        return $this->belongsToMany('App\Models\Library\Term', 'library_material_subject', 'material_id', 'term_id');

    }

}
