<?php

namespace App\Transformers\Outbound\Collections;

use App\Transformers\Outbound\CollectionsTransformer as BaseTransformer;

class Place extends BaseTransformer
{

    protected function getFields()
    {
        return [
            'latitude' => [
                'doc' => 'Latitude coordinate of the center of the room',
                'type' => 'number',
                'elasticsearch' => 'float',
                'is_restricted' => true,
            ],
            'longitude' => [
                'doc' => 'Longitude coordinate of the center of the room',
                'type' => 'number',
                'elasticsearch' => 'float',
                'is_restricted' => true,
            ],
            'type' => [
                'doc' => 'Type always takes one of the following values: AIC Gallery, AIC Storage, No location',
                'type' => 'string',
                'elasticsearch' => 'keyword',
            ],
            'tgn_id' => [
                'doc' => 'Reconciled identifier of this object in the Getty\'s Thesauraus of Geographic Names (TGN)',
                'type' => 'number',
                'elasticsearch' => 'integer',
            ],
        ];
    }

    public function getLicenseText()
    {
        return 'The data in this response is licensed under a Creative Commons Attribution 4.0 Generic License (CC-By) and the Terms and Conditions of artic.edu. Contains information from the J. Paul Getty Trust, Getty Research Institute, the Getty Thesaurus of Geographic Names, which is made available under the ODC Attribution License.';
    }

    public function getLicenseLinks()
    {
        return [
            'https://www.artic.edu/terms',
            'https://creativecommons.org/licenses/by/4.0/',
        ];
    }

    public function getLicensePriority()
    {
        return 50;
    }
}
