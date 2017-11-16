<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Collections\Agent;

class ImportSetArtists extends AbstractImportCommand
{

    protected $signature = 'import:set-artists';

    protected $description = "Set the `is_artist` flag for Agents who are the creators of an artwork.";


    public function handle()
    {

        // Reset `is_artist` flag for all agents to FALSE
        Agent::query()->update(['is_artist' => FALSE]);

        // Get a list of all Agents who are the creators of an artwork
        $json = $this->queryService();

        // Set their `is_artist` flag to TRUE
        $agents = Agent::whereKey($json->data)
                ->update(['is_artist' => TRUE]);

    }

    private function queryService()
    {
        return $this->query( env('COLLECTIONS_DATA_SERVICE_URL', 'http://localhost') . '/artists');
    }

}
