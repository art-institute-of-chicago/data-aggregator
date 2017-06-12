<?php

namespace App\Http\Controllers;

class SwaggerController extends ApiController
{
    /**
     * Display Swagger documentation.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $swagger = \Swagger\scan(base_path('routes'));
        header('Content-Type: application/json');
        return response()->json($swagger);

    }

}