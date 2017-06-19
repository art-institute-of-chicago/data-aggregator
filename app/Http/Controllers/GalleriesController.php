<?php

namespace App\Http\Controllers;

use App\Collections\Gallery;
use App\Collections\Artwork;
use Illuminate\Http\Request;

class GalleriesController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @param null $id
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $artworkId = null)
    {

        $ids = $request->input('ids');
        if ($ids)
        {

            return $this->showMutliple($ids);

        }

        $limit = $request->input('limit') ?: 12;
        if ($limit > static::LIMIT_MAX) return $this->respondForbidden('Invalid limit', 'You have requested too many galleries. Please set a smaller limit.');

        if ($artworkId)
        {

            $all = Artwork::findOrFail($artworkId)->galleries;

        }
        else
        {

            $all = Gallery::paginate($limit);

        }

        return response()->collection($all, new \App\Http\Transformers\GalleryTransformer);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Collections\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show($galleryId)
    {
        try
        {
            if (intval($galleryId) <= 0)
            {
                return $this->respondInvalidSyntax('Invalid identifier', "The gallery identifier should be a number. Please ensure you're passing the correct source identifier and try again.");
            }

            $item = Gallery::find($galleryId);

            if (!$item)
            {
                return $this->respondNotFound('Gallery not found', "The gallery you requested cannot be found. Please ensure you're passing the source identifier and try again.");
            }

            return response()->item($item, new \App\Http\Transformers\GalleryTransformer);
        }
        catch(\Exception $e)
        {
            return $this->respondFailure($e->getMessage());
        }
        
    }

    public function showMutliple($ids = '')
    {

        $ids = explode(',',$ids);
        if (count($ids) > static::LIMIT_MAX)
        {
            
            return $this->respondForbidden('Invalid number of ids', 'You have requested too many ids. Please send a smaller amount.');
            
        }
        $all = Gallery::find($ids);
        return response()->collection($all, new \App\Http\Transformers\GalleryTransformer);
        
    }

}
