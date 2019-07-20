<?php

namespace App\Console\Commands\Prototype;

use Aic\Hub\Foundation\AbstractCommand as BaseCommand;

class PrototypeSearch extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'proto:search';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Output sharable file to demonstrate search boosting modifications';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $ret = $this->header("Prototype search boosting");

        $ret .= $this->results([
            "african american",
            "archibald motley",
            "cow's skull",
            "cats",
            "nocturne",
            "walker evans",
            'nighthawks',
            'the old guitarist',
            'time transfixed',
            'the assumption of the virgin',
            'saint george killing dragon',
            'a sunday afternoon on the island of la grande jatte',
            'bedroom of arles',
            'hydra',
            'the childs bath',
            'reclining woman',
            'american gothic',
            'creche',
            'the weaver',

            'thorne rooms',
            'thorne',
            'cubism',
            'still life',
            'ceramic',
            'impressionism',
            'renaissance',
            'paintings',
            'photography',
            'pop art',
            'furniture',
            'armor',
            'charcoal',

            'seurat',
            'hopper',
            'rodin',
            'pollock',
            'rothko',
            'kandinsky',
            'grant wood',
            'van gogh',
            'monet',
            'picasso',
            'renoir',
            'degas',
            'gauguin',
            'chagall',
            'dali',
            'warhol',
            'rembrandt',
            'magritte',
            'matisse',
            'okeeffe',
            'frank lloyd wright',
            'el greco',
            'cezanne',
            'mary cassatt',
            'manet',
            'caillebotte',
            'whistler',
            'goya',
            'winslow homer',
            'david smith',

            '1942.51',
            '1926.224',
            "1962.824",
            "1959.615",
            "2007.347",
        ]);

        $ret .= $this->footer();

        print $ret;
    }

    public function results($queries = [], $limit = 5)
    {
        $ret = '';

        foreach ($queries as $query)
        {
            $ret .= "<h2>{$query}</h2>\n";
            $response = file_get_contents(config('app.url') . '/api/v1/artworks/search?limit=' . $limit . '&fields=thumbnail,id,title,main_reference_number&q=' . urlencode($query));

            $ret .= "<table>\n";

            foreach (json_decode($response)->data as $item)
            {
                $ret .= "<tr class='clickable-row' data-href='http://www-2018.artic.edu/artworks/{$item->id}'>";
                $ret .= "<td style=\"padding:0 8px\"><img src=\"" . ($item->thumbnail->url ?? '') . "/full/75,/0/default.jpg\" /></td>";
                $ret .= "<td style=\"padding:0 8px\">{$item->id}</td>";
                $ret .= "<td style=\"padding:0 8px\">{$item->main_reference_number}</td>";
                $ret .= "<td style=\"padding:0 8px\">{$item->title}</td>";
                $ret .= "</tr>\n";
            }
            $ret .= "</table>\n";
            $ret .= "<br/><br/>\n";
        }

        return $ret;
    }

    public function header($title = '')
    {
        $ret = "<html>\n";
        $ret .= "<head>\n";
        $ret .= "<script src=\"https://code.jquery.com/jquery-3.3.1.slim.min.js\" integrity=\"sha256-3edrmyuQ0w65f8gfBsqowzjJe2iM6n0nKciPUp8y+7E=\" crossorigin=\"anonymous\"></script>\n";
        $ret .= "<style>tr.clickable-row { cursor: pointer; }</style>\n";
        $ret .= "</head>\n";
        $ret .= "<body>\n";

        if ($title)
        {
            $ret .= "<h1>{$title}</h1>\n";
        }
        return $ret;
    }

    public function footer()
    {
        return "<script>\n"
            . "  jQuery(document).ready(function($) {\n"
            . "    $(\".clickable-row\").click(function() {\n"
            . "      window.location = $(this).data(\"href\");\n"
            . "    });\n"
            . "  });\n"
            . "</script>\n"
            . "</body>\n</html>\n";
    }
}
