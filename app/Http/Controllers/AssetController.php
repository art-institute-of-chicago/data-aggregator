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
            $asset = Asset::where('id', $id)->first();
            $isNetx = true;
        } else {
            $asset = Asset::where('id', $id)->first();

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

        return response()->json([
            'is_netx_asset' => $isNetx,
            'netx_id' => $isNetx ? $asset->id : null,
            'netx_uui' => $isNetx ? $asset->netx_uuid : null,
            'lake_guid' => $isNetx ? null : $asset->id,
        ]);
    }

    protected function find($ids)
    {
        if (is_array($ids) || $ids instanceof Arrayable) {
            $ids = $ids instanceof Arrayable ? $ids->toArray() : $ids;

            return $this->getBaseQuery()
                ->whereIn('id', $ids)
                ->orWhereIn('netx_uuid', $ids)
                ->get();
        }

        return $this->getBaseQuery()
            ->where('id', $ids)
            ->orWhere('netx_uuid', $ids)
            ->first();
    }
}
