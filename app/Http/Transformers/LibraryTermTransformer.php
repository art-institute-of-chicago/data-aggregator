<?php

namespace App\Http\Transformers;

use App\Models\Library\Term;
use App\Transformers\LibraryMaterialTransformer as MaterialTransformer;

use Aic\Hub\Foundation\AbstractTransformer;

class LibraryTermTransformer extends AbstractTransformer
{

    protected $availableIncludes = ['creator_of', 'subject_of'];

    public function transform($term)
    {

        $data = [
            'id' => $term->id,
            'uri' => $term->uri,
            'title' => $term->title,
        ];

        // Enables ?fields= functionality
        return parent::transform($data);

    }

    public function includeSubjectOf(Term $term)
    {
        return $this->collection( $term->subjectOf()->getResults(), new MaterialTransformer, false );
    }


    public function includeCreatorOf(Term $term)
    {
        return $this->collection( $term->creatorOf()->getResults(), new MaterialTransformer, false );
    }

}
