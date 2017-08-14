<?php

namespace App\Http\Controllers;

use App\Models\Collections\Asset;
use App\Models\Collections\Artwork;
use App\Models\Collections\Category;
use App\Models\Collections\Image;
use App\Models\Collections\Video;
use App\Models\Collections\Sound;
use App\Models\Collections\Text;
use App\Models\Collections\Link;
use Illuminate\Http\Request;

class AssetsController extends ApiController
{

    public $type = 'Asset';

    /**
     * Display a listing of the resource.
     *
     * @param null $id
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
        if ($limit > static::LIMIT_MAX) return $this->respondForbidden('Invalid limit', 'You have requested too many ' .strtolower($this->type) .'s. Please set a smaller limit.');

        $attr = str_plural(strtolower($this->type));
        $type = 'App\Models\Collections\\' .$this->type;
        $all = $artworkId ? Artwork::findOrFail($artworkId)->$attr : $type::paginate($limit);

        $transformer = $this->transformer();
        return response()->collection($all, new $transformer);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Collections\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $assetId)
    {

        if ($request->method() != 'GET')
        {

            $this->respondMethodNotAllowed();

        }

        try
        {

            if (!$this->isUuid($assetId))
            {
                return $this->respondInvalidSyntax('Invalid identifier', "The " .strtolower($this->type) ." identifier should be a universally unique identifier. Please ensure you're passing the correct source identifier and try again.");
            }

            $item = $this->model()::find($assetId);

            if (!$item)
            {
                return $this->respondNotFound(strtolower($this->type) .' not found', "The " .strtolower($this->type) ." you requested cannot be found. Please ensure you're passing the source identifier and try again.");
            }

            $transformer = $this->transformer();
            return response()->item($item, new $transformer);
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
        $all = $this->model()::find($ids);
        $transformer = $this->transformer();
        return response()->collection($all, new $transformer);

    }

    public function model()
    {

        return 'App\Models\Collections\\' .$this->type;

    }

    public function transformer()
    {

        return '\App\Http\Transformers\\' . $this->type .'Transformer';

    }

}
