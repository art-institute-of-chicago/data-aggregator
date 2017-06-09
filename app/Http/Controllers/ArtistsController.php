<?php

namespace App\Http\Controllers;

use App\Collections\Artist;
use App\Collections\Artwork;
use Illuminate\Http\Request;

class ArtistsController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @param null $id
     * @return \Illuminate\Http\Response
     */
    public function index($artworkId = null)
    {
        if ($artworkId)
        {
            return response()->item(Artwork::findOrFail($artworkId)->artist, new \App\Http\Transformers\ArtistTransformer);
        }
        else
        {
            $all = Artist::all();
            return response()->collection($all, new \App\Http\Transformers\ArtistTransformer);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Collections\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function show($artistId)
    {
        try
        {
            if (intval($artistId) <= 0)
            {
                return $this->respondInvalidSyntax('Invalid identifier', "The artist identifier should be a number. Please ensure you're passing the correct source identifier and try again.");
            }

            $item = Artist::find($artistId);

            if (!$item)
            {
                return $this->respondNotFound('Artist not found', "The artist you requested cannot be found. Please ensure you're passing the source identifier and try again.");
            }

            return response()->item($item, new \App\Http\Transformers\ArtistTransformer);
        }
        catch(\Exception $e)
        {
            return $this->respondFailure();
        }
        
    }

}
