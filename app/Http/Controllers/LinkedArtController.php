<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collections\Artwork;

use App\Http\Controllers\Controller as BaseController;

class LinkedArtController extends BaseController
{
    private $fnumbers = [
        28560 => 'F484',
        80607 => 'F345',
        14586 => 'F470',
        28862 => 'F139',
        79349 => 'F667',
        109314 => 'F354',
        27949 => 'F506',
        27954 => 'F272',
        64957 => 'F382',
        52733 => 'F1468',
        59774 => 'F1069',
        31640 => 'F1240a',
        65479 => 'F1642',
        87327 => 'F1524',
        150802 => 'F1690',
        133605 => 'F1518',
        88393 => null,
        202382 => 'F1241',
    ];

    public function artwork(Request $request, $id)
    {
        $artwork = Artwork::find($id);

        $item = [
            '@context' => 'https://linked.art/ns/v1/linked-art.json',
            'id' => route('ld.artwork', ['id' => $artwork]),
            'type' => 'HumanMadeObject',
        ];

        $item = array_merge(
            $item,
            $this->getArtworkType($artwork),
            $this->getLinkToVgwUri($artwork),
        );

        return $item;
    }

    private function getArtworkType($artwork): array
    {
        if (!$artworkType = $artwork->artworkType) {
            return [];
        }

        if (!$artworkType->aat_id) {
            return [];
        }

        return [
            'classified_as' => [
                'id' => 'http://vocab.getty.edu/aat/' . $artworkType->aat_id,
                'type' => 'Type',
                '_label' => $artworkType->title,
            ],
        ];
    }

    private function getLinkToVgwUri($artwork): array
    {
        $fnumber = $this->fnumbers[$artwork->getKey()] ?? null;

        if (!$fnumber) {
            return [];
        }

        return [
            'see_also' => [
                'id' => 'https://vangoghworldwide.org/data/artwork/' . $fnumber,
            ],
        ];
    }
}
