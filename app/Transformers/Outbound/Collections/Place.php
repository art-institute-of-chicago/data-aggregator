<?php

namespace App\Transformers\Outbound\Collections;

use App\Transformers\Outbound\CollectionsTransformer as BaseTransformer;
use App\Transformers\Outbound\Collections\Traits\IsCCBy;

class Place extends BaseTransformer
{
    use IsCCBy {
        IsCCBy::getLicenseText as ccByLicenseText;
    }

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
            'tgn_id' => [
                'doc' => 'Reconciled identifier of this object in the Getty\'s Thesauraus of Geographic Names (TGN)',
                'type' => 'number',
                'elasticsearch' => 'integer',
            ],
        ];
    }

    public function getLicenseText()
    {
        return $this->ccByLicenseText() . ' Contains information from the J. Paul Getty Trust, Getty Research Institute, the Getty Thesaurus of Geographic Names, which is made available under the ODC Attribution License.';
    }
}
