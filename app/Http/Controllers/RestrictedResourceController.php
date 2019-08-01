<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Aic\Hub\Foundation\Exceptions\UnauthorizedException;

class RestrictedResourceController extends ResourceController
{

    public function show(Request $request, $id)
    {
        $this->checkIfAuthorized();
        return parent::show(...func_get_args());
    }

    public function index(Request $request)
    {
        $this->checkIfAuthorized();
        return parent::index(...func_get_args());
    }

    protected function showScope(Request $request, $id)
    {
        $this->checkIfAuthorized();
        return parent::showScope(...func_get_args());
    }

    protected function indexScope(Request $request)
    {
        $this->checkIfAuthorized();
        return parent::indexScope(...func_get_args());
    }

    private function checkIfAuthorized()
    {
        if (!Auth::check() && config('aic.auth.restricted')) {
            throw new UnauthorizedException();
        }
    }

}
