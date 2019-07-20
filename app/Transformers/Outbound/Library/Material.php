<?php

namespace App\Transformers\Outbound\Library;

use App\Transformers\Outbound\Library\Term as TermTransformer;

use App\Transformers\Outbound\AbstractTransformer as BaseTransformer;

class Material extends BaseTransformer
{

    protected $availableIncludes = ['creators', 'subjects'];

    protected $defaultIncludes = ['creators', 'subjects'];

    public function includeSubjects($material)
    {
        return count($material->subjects) > 0 ? $this->collection($material->subjects, new TermTransformer(), false) : null;
    }

    public function includeCreators($material)
    {
        return count($material->creators) > 0 ? $this->collection($material->creators, new TermTransformer(), false) : null;
    }

    protected function getFields()
    {
        return [
            'date' => [
                'doc' => 'Publication year of this library material',
                'type' => 'number',
                'elasticsearch' => 'integer',
            ],
        ];
    }

}
