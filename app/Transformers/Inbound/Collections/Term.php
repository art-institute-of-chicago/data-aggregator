<?php

namespace App\Transformers\Inbound\Collections;

use Illuminate\Database\Eloquent\Model;

use App\Transformers\Datum;

class Term extends BaseList
{

    protected function getIds(Datum $datum)
    {
        return [
            'lake_uid' => $datum->id,
        ];
    }

    protected function getExtraFields(Datum $datum)
    {
        return [
            'subtype' => $datum->term_type_id ? 'TT-' . $datum->term_type_id : null,
        ];
    }

    public function shouldSave(Model $instance, $datum, $isNew = null)
    {
        return parent::shouldSave($instance, $datum, $isNew) &&
        ('TT-' . $datum->term_type_id == \App\Models\Collections\Term::CLASSIFICATION
         || 'TT-' . $datum->term_type_id == \App\Models\Collections\Term::MATERIAL
         || 'TT-' . $datum->term_type_id == \App\Models\Collections\Term::TECHNIQUE
         || 'TT-' . $datum->term_type_id == \App\Models\Collections\Term::STYLE
         || 'TT-' . $datum->term_type_id == \App\Models\Collections\Term::SUBJECT);
    }
}
