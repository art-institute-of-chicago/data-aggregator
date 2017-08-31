<?php

namespace App\Http\Controllers;

use App\Models\Collections\Department;
use App\Models\Collections\Artwork;
use Illuminate\Http\Request;

class DepartmentsController extends ApiNewController
{

    protected $model = \App\Models\Collections\Department::class;

    protected $transformer = \App\Http\Transformers\DepartmentTransformer::class;

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
        if ($limit > static::LIMIT_MAX) return $this->respondForbidden('Invalid limit', 'You have requested too many artworks. Please set a smaller limit.');

        if ($artworkId)
        {
            return response()->item(Artwork::findOrFail($artworkId)->department, new $this->transformer);
        }
        else
        {
            $all = Department::paginate($limit);
            return response()->collection($all, new $this->transformer);
        }
    }

}
