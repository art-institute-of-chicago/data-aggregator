<?php

namespace App\Http\Controllers;

use App\Models\Collections\Artwork;
use App\Models\Collections\Exhibition;
use Illuminate\Http\Request;

class ArtworksController extends ApiNewController
{

    protected $model = \App\Models\Collections\Artwork::class;

    protected $transformer = \App\Http\Transformers\ArtworkTransformer::class;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $artworkId = null)
    {

        if ($request->method() != 'GET')
        {

            $this->respondMethodNotAllowed();

        }

        $ids = $request->input('ids');
        if ($ids)
        {

            return $this->showMutliple($ids);

        }

        $limit = $request->input('limit') ?: 12;
        if ($limit > static::LIMIT_MAX) return $this->respondForbidden('Invalid limit', 'You have requested too many artworks. Please set a smaller limit.');

        // exhibitions/{id}/artworks
        if ($artworkId && $request->segment(3) == 'exhibitions')
        {

            $all = Exhibition::findOrFail($artworkId)->artworks;

        }
        // artworks/essentials
        elseif ($request->segment(4) == 'essentials')
        {

            $all = Artwork::essentials()->paginate($limit);

        }
        // artworks/{id}/sets
        elseif ($artworkId && $request->segment(5) == 'sets')
        {

            $all = Artwork::findOrFail($artworkId)->sets;

        }
        // artworks/{id}/parts
        elseif ($artworkId && $request->segment(5) == 'parts')
        {

            $all = Artwork::findOrFail($artworkId)->parts;

        }
        else
        {

            $all = Artwork::paginate($limit);

        }

        return response()->collection($all, new $this->transformer);

    }

}
