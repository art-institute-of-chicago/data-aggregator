<?php

namespace App\Console\Commands\Import;

use App\Models\Collections\Agent;

class ImportUlan extends AbstractImportCommand
{

    protected $signature = 'import:ulan
                            {--full : Run for all agents}';

    protected $description = 'Set the `ulan_uri` for Agents.';

    public function handle()
    {
        $agents = Agent::query();

        if (!$this->option('full')) {
            $agents->whereNull('ulan_uri');
            $agents->where('source_modified_at', '>=', $this->command->last_success_at);
        }

        // Then, loop through them in a memory-friendly way
        foreach ($agents->cursor() as $agent) {
            $this->info('Trying agent #' . $agent->citi_id . ', "' . $agent->title . '"');

            $gotit = false;

            if (isset($agent->birth_date) && isset($agent->death_date)) {
                $result = $this->fetchUlan($agent, $agent->birth_date, $agent->death_date);
                $gotit = $this->updateUlan($agent, $result, 'with birth and death year', 0);
            }

            if (!$gotit && isset($agent->birth_date)) {
                $result = $this->fetchUlan($agent, $agent->birth_date, null);
                $gotit = $this->updateUlan($agent, $result, 'with birth year', 1);
            }

            if (!$gotit && $agent->death_date) {
                $result = $this->fetchUlan($agent, null, $agent->death_date);
                $gotit = $this->updateUlan($agent, $result, 'with death year', 1);
            }

            if (!$gotit) {
                $result = $this->fetchUlan($agent, null, null);
                $gotit = $this->updateUlan($agent, $result, 'with no years', 2);
            }

            if (!$gotit) {
                $result = $this->fetchUlan($agent, null, null);
                $gotit = $this->updateUlan($agent, $result, 'with no years', 3, true);
            }
        }
    }

    private function fetchUlan($agent, $birth_date = 0, $death_date = 0)
    {
        $url = env('ULAN_DATA_SERVICE_URL') .
            '?q=' . urlencode($agent->sort_title ?? $agent->title) .
            ($birth_date ? '&by=' . $birth_date : '') .
            ($death_date ? '&dy=' . $death_date : '');

        return $this->fetch($url, true);
    }

    private function updateUlan($agent, $result, $message = '', $certainty = null, $permissive = false)
    {
        // If there's only one result, set the ULAN URI
        if (count($result->results) === 1) {
            $this->info('... exact name matched ' . $message . ' ' . $result->results[0]->uri);
            $agent->ulan_uri = $result->results[0]->uri;
            $agent->ulan_certainty = $certainty;
            $agent->save();
            return true;
        }

        // If there's more than one result, try to find an exact match
        if (count($result->results) > 1) {
            // Make a distinct list of IDs, because the service sometimes returns dups
            $uris = array_unique(array_map(function ($item) {
                return $item->uri;
            }, $result->results));

            if (count($uris) === 1) {
                $this->info('... exact name matched distinct results ' . $message . ' ' . $uris[0]);
                $agent->ulan_uri = $uris[0];
                $agent->ulan_certainty = $certainty;
                $agent->save();
                return true;
            }

            if (count($uris) > 1 && $permissive) {
                $this->info('... exact name matched non-distinct results ' . $message . ' ' . $uris[0]);
                $agent->ulan_uri = $uris[0];
                $agent->ulan_certainty = $certainty;
                $agent->save();
                return true;
            }
        }

        return false;
    }
}
