<?php

namespace App\Http\Controllers;

use App\Collections\Department;
use App\Collections\Artwork;
use Illuminate\Http\Request;

class DepartmentsController extends ApiController
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
            return response()->item(Artwork::findOrFail($artworkId)->department, new \App\Http\Transformers\DepartmentTransformer);
        }
        else
        {
            $all = Department::all();
            return response()->collection($all, new \App\Http\Transformers\DepartmentTransformer);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Collections\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show($departmentId)
    {
        try
        {
            if (intval($departmentId) <= 0)
            {
                return $this->respondInvalidSyntax('Invalid identifier', "The department identifier should be a number. Please ensure you're passing the correct source identifier and try again.");
            }

            $item = Department::find($departmentId);

            if (!$item)
            {
                return $this->respondNotFound('Department not found', "The department you requested cannot be found. Please ensure you're passing the source identifier and try again.");
            }

            return response()->item($item, new \App\Http\Transformers\DepartmentTransformer);
        }
        catch(\Exception $e)
        {
            return $this->respondFailure();
        }
        
    }

}
