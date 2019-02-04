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
        return $this->collection($material->subjects, new TermTransformer, false);
    }


    public function includeCreators($material)
    {
        return $this->collection($material->creators, new TermTransformer, false);
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
