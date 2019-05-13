<?php

namespace App\Console\Commands\Import;

use App\Models\Collections\Agent;

class ImportUlan extends AbstractImportCommand
{

    protected $signature = 'import:ulan';

    protected $description = "Set the `ulan_uri` for Agents.";

    public function handle()
    {

        // TODO: Set up monthly-ish download of new data set + refresh all agents then

        // Grab all agents that (1) don't have a URI
        $agents = Agent::whereNull('ulan_uri');

        // ...and (2) were updated since successful last run
        $agents = $agents->where('source_modified_at', '>=', $this->command->last_success_at);

        // Then, loop through them in a memory-friendly way
        foreach( $agents->cursor() as $agent ) {

            $this->info('Trying agent #' .$agent->citi_id .', ' .$agent->title);

            // Query ulan service with birth date
            $result = $this->fetchUlan($agent, $agent->birth_date, null);

            $gotit = $this->updateUlan($agent, $result, 'with birth year');

            // If the birth date didn't work, try with the death date
            if (!$gotit && $agent->death_date)
            {

                $result = $this->fetchUlan($agent, null, $agent->death_date);

                $gotit = $this->updateUlan($agent, $result, 'with death year');

                // Now let's try both, just for the record
                if (!$gotit)
                {

                    $result = $this->fetchUlan($agent, $agent->birth_date, $agent->death_date);

                    $gotit = $this->updateUlan($agent, $result, 'with birth and death year');

                }

            }

            // If there are no results, try with just the last name or first word
            if (count($result->results) == 0)
            {
                continue;
            }

        }

    }

    private function fetchUlan($agent, $birth_date = 0, $death_date = 0)
    {

        return $this->fetch( env('ULAN_DATA_SERVICE_URL')
                             .'?q=' .urlencode($agent->title)
                             .($birth_date ? '&by=' .$birth_date : '')
                             .($death_date ? '&dy=' .$death_date : ''),
        true);

    }

    private function updateUlan($agent, $result, $message = '')
    {

        // If there's only one result, set the ULAN URI
        if (count($result->results) == 1)
        {

            $this->info('... exact name matched ' .$message .' ' .$result->results[0]->uri);
            $agent->ulan_uri = $result->results[0]->uri;
            $agent->save();
            return true;

        }

        // If there's more than one result, try to find an exact match
        if (count($result->results) > 1)
        {

            // Make a distinct list of IDs, because the service sometimes returns dups
            $uris = [];
            foreach ($result->results as $res)
            {

                $uris[] = $res->uri;

            }

            $uris = array_unique($uris);
            if (count($uris) == 1)
            {

                $this->info('... exact name matched distinct results' .$message);
                $agent->ulan_uri = $uris[0];
                $agent->save();
                return true;

            }

        }

        return false;

    }
}
