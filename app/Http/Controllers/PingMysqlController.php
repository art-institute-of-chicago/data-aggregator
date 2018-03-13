<?php

namespace App\Http\Controllers;

use Aic\Hub\Foundation\Exceptions\DetailedException;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

//use Illuminate\Routing\Controller as BaseController;
use Aic\Hub\Foundation\AbstractController as BaseController;


class PingMysqlController extends BaseController
{

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  mixed $id
     * @return \Illuminate\Http\Response
     */
    public function ping()
    {

        $config = config('database.connections.mysql');

        try{
            $link = new \mysqli($config['host'],
                                $config['username'],
                                $config['password'],
                                $config['database'],
                                $config['port']);

            if ($link->connect_errno) {

                throw new DetailedException('Unable to connect', $e->getMessage(), Response::HTTP_BAD_REQUEST);

            }
        }
        catch (\Exception $e)
        {

            throw new DetailedException('Unable to connect', $e->getMessage(), Response::HTTP_BAD_REQUEST);

        }

        return response()->json([
            "status" => Response::HTTP_OK,
            "message" => 'Connection successful'
        ]);

    }

}
