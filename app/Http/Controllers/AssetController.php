<?php

namespace App\Http\Controllers;

use App\Models\Collections\Asset;
use Aic\Hub\Foundation\Exceptions\ItemNotFoundException;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;

class AssetController extends ResourceController
{
    public function netx(Request $request, $id)
    {
        if (is_numeric($id)) {
            $asset = Asset::where('lake_guid', $id)->first();
            $isNetx = true;
        } else {
            $asset = Asset::where('lake_guid', $id)->first();
            if ($asset) {
                $isNetx = false;
            } else {
                $asset = Asset::where('netx_uuid', $id)->first();
                $isNetx = true;
            }
        }

        if (!$asset) {
            throw new ItemNotFoundException();
        }

        return response()->json(array_merge([
            'is_netx_asset' => $isNetx,
        ], $isNetx ? [
            'netx_id' => $asset->lake_guid,
            'netx_uui' => $asset->netx_uuid,
        ] : [
            'lake_guid' => $asset->lake_guid,
        ]));
    }

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
