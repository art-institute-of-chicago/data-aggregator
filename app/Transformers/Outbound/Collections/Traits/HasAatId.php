<?php

namespace App\Transformers\Outbound\Collections\Traits;

trait HasAatId
{
    protected function getFieldsForHasAatId()
    {
        return [
            'aat_id' => [
                'doc' => 'Identifier of reconciled (most similar) term in the Getty\'s Art and Architecture Thesaurus (AAT)',
                'type' => 'integer',
                'elasticsearch' => 'integer',
            ],
        ];
    }
}
