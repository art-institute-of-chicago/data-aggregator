<?php

namespace App\Http\Controllers;

use App\Models\Membership\Member;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MembersController extends ApiController
{

    protected $model = \App\Models\Membership\Member::class;

    protected $transformer = \App\Http\Transformers\MemberTransformer::class;


    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @param  int $zip
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {

        $zip = $request->input('zip');
        $email = $request->input('email');
        $phone = $request->input('phone');

        if( !( $zip || $email || $phone ) )
        {
            return $this->respondInvalidSyntax('Missing parameters', "Please provide at least one of the following: zip, email, or phone.");
        }

        $url = env('EVENTS_DATA_SERVICE_URL', 'http://localhost');
        $url .= "/members/{$id}?zip={$zip}&email={$email}&phone={$phone}";

        return response()->json( $this->query( $url ) );

    }


    /**
     * Retrieving a list of members is forbidden.
     *
     * @TODO We haven't actually defined this route, but I thought it best to
     * override the inherited method. We should handle the `NotFoundHttpException`
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $this->respondForbidden();
    }


    private function query($url)
    {

        $ch = curl_init();

        curl_setopt ($ch, CURLOPT_URL, $url);
        curl_setopt ($ch, CURLOPT_HEADER, 0);

        ob_start();

        curl_exec ($ch);
        curl_close ($ch);
        $string = ob_get_contents();

        ob_end_clean();

        return json_decode($string);

    }


}
