<?php

namespace App\Behaviors;

trait CanQuery
{

    /**
     * Convenience curl wrapper. Accepts `GET` URL. Returns decoded JSON.
     *
     * @param string $url
     *
     * @return string
     */
    protected function query($url)
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


    /**
     * Determine a URL to a source system and execute a query,
     *
     * @param string $endpoint
     * @param string $id
     *
     * @return array JSON object as an array
     */
    private function queryResource($endpoint, $id)
    {

        $model = app('Resources')->getModelForEndpoint($endpoint);
        $source = $model::source();
        $url = $this->sourceUrl($source) .'/' .$endpoint .'/' .$id;

        $result = $this->query( $url );

        if( is_null( $result ) ) {
            throw new \Exception("Cannot contact data service: " . $url);
        }

        return $result;
    }


    /**
     * Save a new model instance given an object retrieved from an external source.
     *
     * @param object  $datum
     * @param string  $model
     * @param boolean $fake  Whether or not to fill missing fields w/ fake data.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function saveDatum( $datum, $model )
    {

        // Don't use findOrCreate here, since it can cause errors due to Searchable
        $resource = $model::findOrNew( $datum->id );

        $resource->fillFrom($datum);
        $resource->attachFrom($datum);
        $resource->save();

        return $resource;

    }


    /**
     * Determine a source URL.
     *
     * @param string $source
     *
     * @return string
     */
    private function sourceUrl($source)
    {

        switch ($source)
        {

        case 'Archive':

            return env('ARCHIVES_DATA_SERVICE_URL', 'http://localhost');

        case 'Collections':

            return env('COLLECTIONS_DATA_SERVICE_URL', 'http://localhost');

        case 'Dsc':

            return env('DSC_DATA_SERVICE_URL', 'http://localhost');

        case 'Library':

            return env('LIBRARY_DATA_SERVICE_URL', 'http://localhost');

        case 'Membership':

            return env('EVENTS_DATA_SERVICE_URL', 'http://localhost');

        case 'Mobile':

            return env('MOBILE_DATA_SERVICE_URL', 'http://localhost');

        case 'Shop':

            return env('SHOP_DATA_SERVICE_URL', 'http://localhost');

        case 'Web':

            return env('WEB_CMS_DATA_SERVICE_URL', 'http://localhost');

        default:

            return env('COLLECTIONS_DATA_SERVICE_URL', 'http://localhost');

        }

    }

}
