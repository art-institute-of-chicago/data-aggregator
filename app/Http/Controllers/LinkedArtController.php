<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collections\Artwork;

use App\Http\Controllers\Controller as BaseController;

class LinkedArtController extends BaseController
{
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
        );

        return $item;
    }

    private function getArtworkType($artwork)
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
}
