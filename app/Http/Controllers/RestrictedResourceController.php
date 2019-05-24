<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Aic\Hub\Foundation\Exceptions\UnauthorizedException;

class RestrictedResourceController extends ResourceController
{

    public function show(Request $request, $id)
    {
        if (!Auth::check() && config('aic.restricted')) {
            throw new UnauthorizedException();
        }
        return parent::show(...func_get_args());
    }

    public function index(Request $request)
    {
        if (!Auth::check() && config('aic.restricted')) {
            throw new UnauthorizedException();
        }
        return parent::index(...func_get_args());
    }

    protected function showScope(Request $request, $id)
    {
        if (!Auth::check() && config('aic.restricted')) {
            throw new UnauthorizedException();
        }
        return parent::showScope(...func_get_args());
    }

    protected function indexScope(Request $request)
    {
        if (!Auth::check() && config('aic.restricted')) {
            throw new UnauthorizedException();
        }
        return parent::indexScope(...func_get_args());
    }

}
