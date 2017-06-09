<?php

namespace App\Http\Controllers;

use App\Collections\Artwork;
use Illuminate\Http\Request;

class ArtworksController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $limit = $request->input('limit') ?: 12;
        if ($limit > 1000) $limit = 1000;
        
        $all = Artwork::paginate($limit);
        return response()->collection($all, new \App\Http\Transformers\ArtworkTransformer);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Collections\Artwork  $artwork
     * @return \Illuminate\Http\Response
     */
    public function show($artworkId)
    {
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

}
