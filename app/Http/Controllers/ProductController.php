<?php

namespace App\Http\Controllers;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * time curl -F csv=@storage/app/DatahubChainDriveProductData.csv http://username:password@data-aggregator.test/push/v1/products
     */
    public function upload(Request $request)
    {
        $file = $request->file('csv');

        if (!$file) {
            abort(400);
        }

        if ($file->getMimeType() !== 'text/csv') {
            abort(400);
        }

        // Stream the file to S3; be sure to set `AWS_BUCKET` in `.env` and otherwise configure credentials
        Storage::disk('s3')->putFileAs(
            '/',
            new File($file->getRealPath()),
            'DatahubChainDriveProductData.csv'
        );

        return response()->json([
            'status' => 200,
            'message' => 'Success, file uploaded, ready for next scheduled import.',
        ]);
    }
}
