<?php

namespace App\Http\Controllers;

use App\Models\Collections\Video;
use App\Models\Collections\Artwork;
use Illuminate\Http\Request;

class VideosController extends AssetsController
{

    public $type = 'Video';

}
