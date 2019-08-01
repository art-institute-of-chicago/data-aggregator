<?php

namespace App\Http\Controllers;

use Illuminate\Mail\Markdown;
use Illuminate\Support\Facades\Storage;

class DocsController extends Controller
{

    protected $filename;

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
        $markup = Markdown::parse($content);
        $markup = preg_replace_callback('/<h2>(\w+)<\/h2>/i', function ($title) {
            return '<h2 id="' . strtolower($title[1]) . '">' . $title[1] . '</h2>';
        }, $markup);
        return view('docs', ['content' => $markup]);
    }
}
