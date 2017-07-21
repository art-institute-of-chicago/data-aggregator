<?php

namespace App\Http\Controllers;

use App\Models\Collections\Text;
use App\Models\Collections\Artwork;
use Illuminate\Http\Request;

class TextsController extends AssetsController
{

    public $type = 'Text';

}
