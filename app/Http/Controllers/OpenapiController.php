<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class OpenapiController extends Controller
{
    protected $filename = 'openapi.json';

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $content = Storage::get($this->filename);
        return response(
            view('openapi', ['content' => $content]),
            200,
            ['Content-Type' => 'application/json']
        );
    }
}
