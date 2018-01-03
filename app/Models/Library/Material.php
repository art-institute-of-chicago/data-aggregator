<?php

namespace App\Models\Library;

use Aic\Hub\Foundation\AbstractModel as BaseModel;

class Material extends BaseModel
{

    public function creators()
    {

        return $this->belongsToMany('App\Models\Library\Term', 'material_creator');

    }

    public function subjects()
    {

        return $this->belongsToMany('App\Models\Library\Term', 'material_subject');

    }

}
