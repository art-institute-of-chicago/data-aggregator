<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Carbon\Carbon;

class ImportCollections extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:collections';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Import collections data that has been updated since the last import";

    protected $command;

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $startTime = Carbon::now();
        $this->command = \App\Command::firstOrCreate(['command' => 'import-collections']);
        $this->command->last_ran_at = new Carbon($this->command->last_ran_at) ?: Carbon::now(); //->subDays(3);

        $this->import('artists');
        $this->import('departments');
        $this->import('categories');
        //$this->import('galleries');
        $this->import('artworks');
        $this->import('links');
        $this->import('videos');
        $this->import('texts');
        $this->import('sounds');

        $this->command->last_ran_at = $startTime;
        $this->command->save();

    }

    private function import($endpoint, $current = 1)
    {

        $class = \App\Models\CollectionsModel::classFor($endpoint);

        $json = $this->query($endpoint, $current);
        $pages = $json->pagination->pages->total;

        while ($current <= $pages)
        {

            foreach ($json->data as $source)
            {
                $sourceIndexedTime = new Carbon($source->indexed_at);
                $sourceIndexedTime->timezone = config('app.timezone');

                if ($this->command->last_ran_at->lte($sourceIndexedTime))
                {

                    $resource = call_user_func($class .'::findOrCreate', $source->id);

                    $resource->fillFrom($source);
                    $resource->attachFrom($source);
                    $resource->save();

                }
                else
                {

                    break 2;

                }

            }

            $current++;
            $json = $this->query($endpoint, $current);

        }

    }

    private function query($type = 'artworks', $page = 1)
    {

        $ch = curl_init();

        curl_setopt ($ch, CURLOPT_URL, env('COLLECTIONS_DATA_SERVICE_URL', 'http://localhost') .'/' .$type .'?page=' .$page .'&per_page=100');
        curl_setopt ($ch, CURLOPT_HEADER, 0);

        ob_start();

        curl_exec ($ch);
        curl_close ($ch);
        $string = ob_get_contents();

        ob_end_clean();

        return json_decode($string);

    }

}
