<?php

namespace App\Http\Controllers;

use App\Collections\Video;
use App\Collections\Artwork;
use Illuminate\Http\Request;

class VideosController extends AssetsController
{

    public $type = 'Video';

}
