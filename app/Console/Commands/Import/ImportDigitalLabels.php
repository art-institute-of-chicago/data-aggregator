<?php

namespace App\Console\Commands\Import;

use Illuminate\Support\Facades\Storage;

use App\Models\DigitalLabel\Label;
use App\Models\DigitalLabel\Exhibition;

use App\Transformers\Inbound\DigitalLabel\Exhibition as ExhibitionTransformer;
use App\Transformers\Inbound\DigitalLabel\Label as LabelTransformer;

class ImportDigitalLabels extends AbstractImportCommand
{

    protected $signature = "import:digital-labels
                            {--from-backup : Whether to use a previously retrieved version of Digital Label's JSON data}";

    protected $description = "Import all digital labels from their CMS";

    protected $folderName = 'digital-labels';

    public function handle()
    {

        if( !$this->reset() )
        {
            return false;
        }

        $this->downloadLabels();
        $this->importLabels();

    }

    private function sourceExhibitionJson()
    {
        return env('DIGITAL_LABELS_JSON_ROOT') . '/public/exhibitions';
    }

    private function sourceLabelJson($id)
    {
        return env('DIGITAL_LABELS_JSON_ROOT') . "/public/experience/{$id}/content/published";
    }

    private function exhibitionJson()
    {
        return $this->folderName . '/exhibitions.json';
    }

    private function labelJson($id)
    {
        return $this->folderName . "/label-{$id}.json";
    }

    private function downloadLabels()
    {
        if( !$this->option('from-backup') )
        {

            $this->info('Retrieving digital labels JSON');

            $contents = $this->fetch( $this->sourceExhibitionJson() );
            Storage::disk('local')->put($this->exhibitionJson() , $contents );

            $results = json_decode( $contents );

            foreach ($results as $exhibition)
            {
                foreach ($exhibition->experiences as $label)
                {
                    if ($label->publishedId)
                    {
                        $contents = $this->fetch( $this->sourceLabelJson($label->objectId) );
                        Storage::disk('local')->put($this->labelJson($label->objectId), $contents );
                    }
                }
            }
        }
    }

    private function importLabels()
    {
        $this->info("Importing digital labels");

        $contents = Storage::get( $this->exhibitionJson() );
        $results = json_decode( $contents );

        foreach ($results as $datum)
        {
            $datum->id = $datum->objectId;
            $this->save( $datum, Exhibition::class, ExhibitionTransformer::class );

            foreach ($datum->experiences as $d)
            {
                if (Storage::exists( $this->labelJson($d->objectId) ) )
                {
                    $c = Storage::get( $this->labelJson($d->objectId) );
                    $r = json_decode( $c );

                    $r->id = $d->objectId;
                    $r->title = $d->title;
                    $r->whenCreated = $d->whenCreated;
                    $r->whenChanged = $d->whenChanged;
                    $r->digital_label_exhibition_id = $datum->objectId;
                    $this->save( $r, Label::class, LabelTransformer::class );
                }
            }
        }

    }

    protected function reset()
    {

        return $this->resetData(
            [
                Label::class,
            ],
            [
                'digital_label_exhibitions',
                'digital_labels'
            ]
        );
    }
}
