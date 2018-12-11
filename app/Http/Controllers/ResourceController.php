<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\AbstractController;

class ResourceController extends AbstractController
{

    public function show(Request $request, $id)
    {
        $endpoint = $this->getEndpoint($request, -2);
        $this->setModelTransformer($endpoint);
        return parent::show(...func_get_args());
    }

    public function index(Request $request)
    {
        $endpoint = $this->getEndpoint($request, -1);
        $this->setModelTransformer($endpoint);
        return parent::index(...func_get_args());
    }

    protected function showScope(Request $request, $id)
    {
        $endpoint = $this->getEndpoint($request, -2);
        $this->setModelTransformer($endpoint);
        return parent::showScope(...func_get_args());
    }

    protected function indexScope(Request $request)
    {
        $endpoint = $this->getEndpoint($request, -1);
        $this->setModelTransformer($endpoint);
        return parent::indexScope(...func_get_args());
    }

    private function getEndpoint(Request $request, int $offset)
    {
        return array_slice($request->segments(), $offset, 1)[0];
    }

    private function setModelTransformer(string $endpoint)
    {
        $this->model = app('Resources')->getModelForEndpoint($endpoint);
        $this->transformer = app('Resources')->getTransformerForEndpoint($endpoint);
    }

}
