<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Contracts\Support\Arrayable;

class AssetController extends ResourceController
{
    protected function find($ids)
    {
        if (is_array($ids) || $ids instanceof Arrayable) {
            $ids = $ids instanceof Arrayable ? $ids->toArray() : $ids;

            return ($this->model)::query()
                ->whereIn('lake_guid', $ids)
                ->orWhereIn('netx_uuid', $ids)
                ->get();
        }

        return ($this->model)::query()
            ->where('lake_guid', $ids)
            ->orWhere('netx_uuid', $ids)
            ->first();
    }
}
