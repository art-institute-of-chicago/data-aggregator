<?php

namespace App\Http\Controllers;

use App\Models\Collections\Artwork;
use App\Models\Collections\Exhibition;
use Illuminate\Http\Request;

class ArtworksController extends ApiController
{

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

        if ($artworkId && $request->segment(3) == 'exhibitions')
        {

            $all = Exhibition::findOrFail($artworkId)->artworks;

        }
        elseif ($request->segment(4) == 'essentials')
        {

            $all = Artwork::essentials()->paginate($limit);

        }
        elseif ($artworkId && $request->segment(5) == 'sets')
        {

            $all = Artwork::findOrFail($artworkId)->sets;

        }
        elseif ($artworkId && $request->segment(5) == 'parts')
        {

            $all = Artwork::findOrFail($artworkId)->parts;

        }
        else
        {

            $all = Artwork::paginate($limit);

        }

        return response()->collection($all, new \App\Http\Transformers\ArtworkTransformer);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Collections\Artwork  $artwork
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $artworkId)
    {

        if ($request->method() != 'GET')
        {

            $this->respondMethodNotAllowed();

        }

        try
        {
            if (intval($artworkId) <= 0)
            {
                return $this->respondInvalidSyntax('Invalid identifier', "The artwork identifier should be a number. Please ensure you're passing the correct source identifier and try again.");
            }

            $item = Artwork::find($artworkId);

            if (!$item)
            {
                return $this->respondNotFound('Artwork not found', "The artwork you requested cannot be found. Please ensure you're passing the source identifier and try again.");
            }

            return response()->item($item, new \App\Http\Transformers\ArtworkTransformer);
        }
        catch(\Exception $e)
        {
            return $this->respondFailure();
        }

    }

    public function showMutliple($ids = '')
    {

        $ids = explode(',',$ids);
        if (count($ids) > static::LIMIT_MAX)
        {

            return $this->respondForbidden('Invalid number of ids', 'You have requested too many ids. Please send a smaller amount.');

        }
        $all = Artwork::find($ids);
        return response()->collection($all, new \App\Http\Transformers\ArtworkTransformer);

    }

}
