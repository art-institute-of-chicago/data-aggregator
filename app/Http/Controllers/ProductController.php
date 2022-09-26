<?php

namespace App\Http\Controllers;

use App\Behaviors\ImportsData;

use League\Csv\Reader;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use ImportsData;

    /**
     * time curl -F csv=@storage/app/DatahubChainDriveProductData.csv http://data-aggregator.test/push/v1/products
     */
    public function upload(Request $request)
    {
        // API-344, API-266: Run this import logic using jobs! Takes about 50 seconds.
        set_time_limit(120);

        $file = $request->file('csv');

        if (!$file) {
            abort(400);
        }

        if ($file->getMimeType() !== 'text/csv') {
            abort(400);
        }

        // Flysystem seems a bit overkill for such a simple operation
        $path = $file->getRealPath();

        $csv = Reader::createFromPath($path, 'r');
        $csv->setHeaderOffset(0);

        $csv->getHeader();
        $records = $csv->getRecords();
        $count = 0;

        foreach ($records as $datum) {
            $this->save(
                $datum,
                \App\Models\Shop\Product::class,
                \App\Transformers\Inbound\Shop\Product::class
            );

            $count++;
        }

        return response()->json([
            'status' => 200,
            'message' => 'Success, ' . $count . ' products imported.',
        ]);
    }
}
