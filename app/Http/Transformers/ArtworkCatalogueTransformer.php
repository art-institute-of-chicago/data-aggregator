<?php

namespace App\Http\Transformers;

use App\Models\Collections\ArtworkCatalogue;

class ArtworkCatalogueTransformer extends CollectionsTransformer
{

    public $excludeDates = true;
    public $excludeIdsAndTitle = true;

}
