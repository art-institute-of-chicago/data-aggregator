<?php

namespace App\Console\Commands;

use League\Csv\Reader;

use App\Models\Collections\Term;
use App\Models\Collections\Artwork;
use App\Models\Collections\ArtworkTerm;

use Aic\Hub\Foundation\AbstractCommand as BaseCommand;

class ImportLegacyTerms extends BaseCommand
{

    protected $signature = 'import:terms-legacy';

    protected $description = 'Import CSV of terms data, for seeding with production-quality data.';

    protected $filename = 'Terms2018.csv';

    public function handle()
    {

        ini_set("memory_limit", "-1");

        $path = storage_path() . '/app/' . $this->filename;

        $csv = Reader::createFromPath( $path, 'r' );
        $csv->setHeaderOffset(0);

        // First, go through all the records and insert new Terms
        foreach( $csv->getRecords() as $row )
        {

            foreach (['classification' => 'classifications',
                      'style' => 'style/periods',
                      'subject' => 'subjects'] as $type => $termField)
            {

                $terms = array_map('trim', explode(',', $row[$termField]));

                foreach ($terms as $t)
                {

                    Term::firstOrCreate(['type' => $type,
                                         'title' => $t]);

                }

            }

        }

        // Then go through all the records again, and tie classifications, styles and subjects to those terms.
        foreach( $csv->getRecords() as $row )
        {

            $artwork = Artwork::where('main_id', $row['main ref'])->first();

            foreach (['classification' => 'classifications',
                      'style' => 'style/periods',
                      'subject' => 'subjects'] as $type => $termField)
            {

                $terms = array_map('trim', explode(',', $row[$termField]));

                $terms = Term::where('type', $type)
                       ->whereIn('title', $terms)
                       ->get();

                foreach ($terms as $ind => $term)
                {

                    if ($artwork && $term)
                    {

                        $artworkTerm = ArtworkTerm::firstOrCreate(['artwork_citi_id' => $artwork->citi_id,
                                                                   'term_citi_id' => $term->citi_id],
                                                                  $ind == 0 ? ['preferred' => true] : []
                        );

                    }

                }

            }

        }

    }

}
