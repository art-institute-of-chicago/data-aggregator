<?php

namespace App\Transformers\Inbound\Membership;

use Carbon\Carbon;

use App\Transformers\Datum;
use App\Transformers\Inbound\MembershipTransformer;

class LegacyEvent extends MembershipTransformer
{

    protected function getTitle( Datum $datum )
    {

        // Fix `The Artist&#039;s Studio` to `The Artist's Studio`
        $title = trim( html_entity_decode( $datum->title, ENT_QUOTES | ENT_XML1, 'UTF-8' ) );

        return [
            'title' => $title,
        ];

    }

    protected function getExtraFields( Datum $datum )
    {

        return array_merge( $this->getButtonFields( $datum ), [

            'short_description' => $datum->summary,
            'resource_title' => $datum->location,
            'image_url' => $datum->image,
            'web_url' => $datum->url,

            'start_at' => new Carbon($datum->dates . " " . $datum->start_time),
            'end_at' => new Carbon($datum->dates . " " . $datum->end_time),

            'is_admission_required' => $this->getAdmission( $datum ),
            'description' => $this->getDescription( $datum ),

        ]);

    }

    protected function getSync( Datum $datum )
    {

        return [
            'exhibitions' => $this->getSyncExhibitions( $datum ),
        ];

    }

    private function getAdmission( Datum $datum )
    {

        $freeFees = [
            "Free with museum admission",
            "Free with museum admission*",
            "Free with museum admission, no registration required",
            "Free with museum admission; registration required",
            "Free with museum admission, registration required",
            "Free with museum admission; registration required*",
            "Free to Illinois residents or with museum admission; registration required*",
        ];

        return in_array( $datum->fee, $freeFees );

    }

    private function getDescription( Datum $datum )
    {

        if( !$datum->body )
        {
            return null;
        }

        // TODO: This HTML-simplifier is good enough to abstract elsewhere
        // https://stackoverflow.com/a/3026235/1943591
        $html = trim($datum->body);
        $html = preg_replace("/<([a-z][a-z0-9]*)[^>]*?(\/?)>/i",'<$1$2>', $html);
        $html = str_replace(" ", " ", $html); // nbsp with sp
        $html = preg_replace("/\s+<\/p>/i",'</p>', $html);
        $html = str_replace("<p></p>",'', $html);
        $html = trim($html);

        return $html;

    }

    private function getButtonFields( Datum $datum )
    {

        if( !$datum->button_link )
        {
            return [];
        }

        $ret = [];

        $dom = new \DOMDocument();

        @$dom->loadHTML($datum->button_link);

        foreach ($dom->getElementsByTagName('a') as $a)
        {
            $ret['button_text'] = $a->textContent;
            $ret['button_url'] = $a->getAttribute('href');
        }

        return $ret;

    }

    private function getSyncExhibitions( $datum )
    {

        if( !$datum->exhibition_id )
        {
            return [];
        }

        $ids = explode(', ', $datum->exhibition_id);

        return collect( $ids )->map( [$this, 'exhibitionIdFromDrupal'] )->filter();

    }

    public function exhibitionIdFromDrupal( $idOrTitle )
    {

        switch( $idOrTitle )
        {
            case 'Rodin: Sculptor and Storyteller':
            case 7590:
                return 2756;
                break;
            case 'Making Memories: Quilts as Souvenirs':
            case 7435:
                return 2954;
                break;
            case 'Dress Codes: Portrait Photographs from the Collection':
            case 7593:
                return 2959;
                break;
            case 'Andrew Lord: Unslumbrous Night':
            case 7437:
                return 2956;
                break;
            case 'Shockingly Mad: Henry Fuseli and the Art of Drawing':
            case 7592:
                return 2945;
                break;
            case 'Revoliutsiia! Demonstratsiia! Soviet Art Put to the Test':
            case 7436:
                return 2514;
                break;
            case 'Tarsila do Amaral: Inventing Modern Art in Brazil':
            case 7434:
                return 2345;
                break;
            case 'Doctrine and Devotion: Art of the Religious Orders in the Spanish Andes':
            case 6174:
                return 2493;
                break;
            case 'India Modern: The Paintings of M. F. Husain':
            case 7320:
                return 2772;
                break;
            case 'Past Forward: Architecture and Design at the Art Institute':
            case 7438:
                return 5393;
                break;
            case 'Leigh Ledare: The Plot—Ruttenberg Contemporary Photography Series':
            case 7420:
                return 2951;
                break;
            case 'City and Country: Views of Urban and Rural Japan by Modern Japanese Artists':
            case 1425:
                return 8878;
                break;
            case 'Neapolitan Crèche':
            case 6670:
                return 3110;
                break;
            case 'Elizabeth Price':
            case 7623:
                return 2955;
                break;
        }

        return null;
    }

}
