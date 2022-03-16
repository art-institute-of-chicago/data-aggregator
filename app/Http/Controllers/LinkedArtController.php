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

        return $item;
    }
}
