<?php

namespace App\Transformers\Outbound\Library;

use App\Transformers\Outbound\Library\Material as MaterialTransformer;

use App\Transformers\Outbound\AbstractTransformer as BaseTransformer;

class Term extends BaseTransformer
{

    protected $availableIncludes = ['creator_of', 'subject_of'];

    public function includeSubjectOf($term)
    {
        return $this->collection($term->subjectOf, new MaterialTransformer(), false);
    }

    public function includeCreatorOf($term)
    {
        return $this->collection($term->creatorOf, new MaterialTransformer(), false);
    }

    protected function getFields()
    {
        return [
            'uri' => [
                'doc' => 'Full Library of Congress URI for identification',
                'type' => 'string',
                'elasticsearch' => 'keyword',
            ],
        ];
    }

}
