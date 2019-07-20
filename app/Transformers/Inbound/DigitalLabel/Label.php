<?php

namespace App\Transformers\Inbound\DigitalLabel;

use App\Transformers\Datum;
use App\Transformers\Inbound\DigitalLabelTransformer;

class Label extends DigitalLabelTransformer
{

    protected function getIds(Datum $datum)
    {

        return [
            'id' => $datum->experienceId,
        ];

    }

    protected function getExtraFields(Datum $datum)
    {

        return [

            'title' => $this->headline(json_decode($datum->contentBundle)),
            'type' => $datum->experienceType,
            'copy_text' => $this->text(json_decode($datum->contentBundle)),
            'image_url' => $this->image(json_decode($datum->contentBundle)),
            'is_published' => !$datum->archived,

        ];

    }

    protected function getSync(Datum $datum)
    {

        return [
            'artworks' => $this->artworkIds(json_decode($datum->contentBundle)),
            'artists' => $this->artistIds(json_decode($datum->contentBundle)),
        ];

    }

    protected function search($accession)
    {

        static $cache = [];

        $query = [
            'fields' => [
                'id',
                'title',
                'main_reference_number',
                'artist_id',
            ],
            'resources' => [
                'artworks',
            ],
            'query' => [
                'prefix' => [
                    'main_reference_number' => $accession
                ]
            ]
        ];

        $response = $cache[$accession] ?? $this->post(config('app.url') . '/api/v1/search', $query);
        $cache[$accession] = $response;
        $response = json_decode($response);

        $results = $response->data;
        $results = collect($results);

        $results = $results->filter(function ($result) use ($accession) {

            // Check what's left after DSC accession is trimmed from result
            $mrn = $result->main_reference_number;
            $mrn = substr($mrn, strlen($accession));

            // If there's no "leftover" string, this is an exact match
            if(strlen($mrn) === 0)
            {
                return true;
            }

            // If next char is numeric, ignore, e.g. 1928.23 vs. 1928.230
            if(is_numeric($mrn[0]))
            {
                return false;
            }

            // If next char is a period, ignore, e.g. 1928.23 vs. 1928.23.12
            if($mrn[0] === '.')
            {
                return false;
            }

            return true;

        });

        // Sort by length of accession, so shortest is first
        $results = $results->sortBy(function ($result) {
            return strlen($result->main_reference_number);
        });

        // The first result is our match
        return $results->first();

    }

    private function headline($contentBundle)
    {

        foreach ($contentBundle as $slide)
        {
            if (property_exists($slide, 'headline'))
            {
                return $slide->headline;
            }
        }

        return '';
    }

    private function text($contentBundle)
    {

        $ret = '';

        foreach ($contentBundle as $slide)
        {
            if (property_exists($slide, 'primaryCopy'))
            {
                $ret .= $slide->primaryCopy . ' ';
            }
        }

        return $ret;
    }

    private function image($contentBundle)
    {

        foreach ($contentBundle as $slide)
        {
            if (property_exists($slide, 'media') && is_array($slide->media))
            {
                foreach ($slide->media as $media)
                {
                    if ($media->src)
                    {
                        return env('DIGITAL_LABELS_IMAGE_ROOT') . '/' . $media->src;
                    }
                }
            }
        }

        return null;
    }

    private function artworkIds($contentBundle)
    {

        // First, collect all the main reference numbers from the contentBundle
        $mainRefNums = $this->mainReferenceNumbers($contentBundle);

        // Then send them all to the data hub to get artwork ids
        $ret = [];

        foreach ($mainRefNums as $mainRefNum)
        {
            if ($mainRefNum)
            {
                $r = $this->search($mainRefNum);

                if ($r)
                {
                    $ret[] = $r->id;
                }
            }
        }

        return $ret;
    }

    private function artistIds($contentBundle)
    {

        // First, collect all the main reference numbers from the contentBundle
        $mainRefNums = $this->mainReferenceNumbers($contentBundle);

        // Then send them all to the data hub to get artwork ids
        $ret = [];

        foreach ($mainRefNums as $mainRefNum)
        {
            if ($mainRefNum)
            {
                $r = $this->search($mainRefNum);

                if ($r && $r->artist_id)
                {
                    $ret[] = $r->artist_id;
                }
            }
        }

        return $ret;
    }

    private function mainReferenceNumbers($contentBundle)
    {
        $mainRefNums = [];

        foreach ($contentBundle as $slide)
        {
            if (property_exists($slide, 'media') && is_array($slide->media))
            {
                foreach ($slide->media as $media)
                {
                    if (is_object($media) && property_exists($media, 'credits'))
                    {
                        if (property_exists($media->credits, 'creditsRefNum'))
                        {
                            $mainRefNums[] = $media->credits->creditsRefNum;
                        }
                    }
                }
            }
        }
        return  array_unique($mainRefNums);
    }

    // @TODO: Use https://github.com/FriendsOfPHP/Goutte
    // https://stackoverflow.com/questions/5647461/how-do-i-send-a-post-request-with-php
    private function post($url, $data)
    {

        // use key 'http' even if you send the request to https://...
        $options = [
            'http' => [
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($data),
            ],
        ];
        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);

        return $result;

    }
}
