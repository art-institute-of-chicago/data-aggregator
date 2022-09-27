<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class SwaggerController extends Controller
{
    protected $filename = 'swagger.json';

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $content = Storage::get($this->filename);
        return response(
            view('swagger', ['content' => $content]),
            200,
            ['Content-Type' => 'application/json']
        );
    }
}
