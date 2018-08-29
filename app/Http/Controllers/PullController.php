<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Jobs\PullRecord;

use Aic\Hub\Foundation\Exceptions\DetailedException;

use Aic\Hub\Foundation\AbstractController as BaseController;

class PullController extends BaseController
{

    public function pull($endpoint, $id) {

        // Verify that we have a valid endpoint
        if (!app('Resources')->getModelForEndpoint($endpoint))
        {

            throw new DetailedException('Invalid endpoint', $endpoint .' is not a valid endpoint. Please request an update for data we know about.', Response::HTTP_BAD_REQUEST);

        }

        PullRecord::dispatch($endpoint, $id);

        return response()->json([
            "status" => Response::HTTP_ACCEPTED,
            "message" => 'Your request to update has been accepted.'
        ], Response::HTTP_ACCEPTED);

    }

}
