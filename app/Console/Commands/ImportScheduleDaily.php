<?php

namespace App\Console\Commands;

use Aic\Hub\Foundation\AbstractCommand as BaseCommand;

class ImportScheduleDaily extends BaseCommand
{

    protected $signature = 'import:daily';

    protected $description = 'Run all increment commands on sources that we\'re able to, and do a full refresh on sources that require it.';


    public function handle()
    {

        $this->call('import:collections');
        $this->call('import:exhibitions-legacy');
        $this->call('import:events-ticketed');
        $this->call('import:events-legacy');
        $this->call('import:mobile');
        $this->call('import:set-ulan-uris');
        $this->call('import:products');
        $this->call('import:web');
        $this->call('import:analytics');

        // Because in the CMS Events don't get touched when a ticketed event
        // is added. Remove this once that's in place.
        $this->call('import:web-full', ['endpoint' => 'events']);

    }

}
