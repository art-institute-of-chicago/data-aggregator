<?php

namespace App\Http\Transformers;

use App\Models\Library\Material;
use App\Transformers\LibraryTermTransformer as TermTransformer;

use Aic\Hub\Foundation\AbstractTransformer;

class LibraryMaterialTransformer extends AbstractTransformer
{

    protected $availableIncludes = ['creators', 'subjects'];

    protected $defaultIncludes = ['creators', 'subjects'];

    public function transform($material)
    {

        $data = [
            'id' => $material->id,
            'title' => $material->title,
            'date' => $material->date,
        ];

        // Enables ?fields= functionality
        return parent::transform($data);

    }

    public function includeSubjects(Material $material)
    {
        return $this->collection( $material->subjects()->getResults(), new TermTransformer, false );
    }


    public function includeCreators(Material $material)
    {
        return $this->collection( $material->creators()->getResults(), new TermTransformer, false );
    }

}
