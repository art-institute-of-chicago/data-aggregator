<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class AssetsController extends Controller
{
    public function show($filename)
    {
        $content = Storage::get($filename);
        return view('assets', ['content' => $content]);
    }
}
