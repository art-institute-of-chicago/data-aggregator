<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class SwaggerController extends Controller
{

    protected $filename = 'swagger.json';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
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
