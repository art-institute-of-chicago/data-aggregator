<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Carbon\CarbonInterface;

class WebStatusCheck extends Command
{
    protected $signature = 'monitor:website {domains*}';
    protected $description = 'Monitor specified domains for non-200 responses';

    private const INITIAL_WAIT = 60;
    private const ALERT_INTERVALS = [300, 120, 60];
    private const MAX_ALERTS = 7;

    private $domainStates = [];

    public function handle()
    {
        $domains = $this->argument('domains');

        // Setup states for domains
        foreach ($domains as $domain) {
            $this->domainStates[$domain] = [
                'firstAlertTime' => null,
                'alertCount' => 0,
                'lastAlertTime' => null,
                'currentWaitIndex' => 0,
            ];
        }

        $this->info('Starting monitoring of domains: ' . implode(', ', $domains));

        while (true) {
            foreach ($domains as $domain) {
                try {
                    $response = Http::get("https://{$domain}");

                    if ($response->status() !== 200) {
                        $this->handleNon200Response($domain, $response->status());
                    } elseif ($this->domainStates[$domain]['alertCount'] > 0) {
                        // Site is back up after previous alerts
                        $this->sendSlackMessage("{$domain} is back up :blob_excited:");
                        $this->resetMonitoring($domain);
                    }

                    // If we haven't hit max alerts wait for next check
                    if (
                        $this->domainStates[$domain]['alertCount'] < self::MAX_ALERTS ||
                        $this->domainStates[$domain]['alertCount'] === self::MAX_ALERTS
                    ) {
                        $waitTime = $this->getWaitTime($domain);
                        sleep($waitTime);
                    }
                } catch (\Exception $e) {
                    $this->info("Error monitoring {$domain}: " . $e->getMessage());
                    Log::error("Monitoring error for {$domain}: " . $e->getMessage());
                    sleep(60);
                }
            }
        }
    }

    private function handleNon200Response(string $domain, int $responseCode)
    {
        $currentTime = Carbon::now();
        $state = &$this->domainStates[$domain];

        if ($state['alertCount'] === 0) {
            // First alert
            $state['firstAlertTime'] = $currentTime;
            $state['lastAlertTime'] = $currentTime;
            $state['alertCount']++;
            $this->sendSlackMessage(
                "{$domain} responded {$responseCode} :eyes:"
            );
            sleep(self::INITIAL_WAIT);
            return;
        }

        // Only send alerts if we haven't reached the maximum
        if ($state['alertCount'] < self::MAX_ALERTS) {
            $downtime = $currentTime->diffForHumans($state['firstAlertTime'], [
                'syntax' => CarbonInterface::DIFF_ABSOLUTE,
            ]);
            $this->sendSlackMessage(
                "{$domain} responded {$responseCode} for {$downtime} :ahhhhhhhhh:"
            );
            $state['alertCount']++;
            $state['lastAlertTime'] = $currentTime;

            // Move to next wait interval
            if ($state['currentWaitIndex'] < count(self::ALERT_INTERVALS) - 1) {
                $state['currentWaitIndex']++;
            }
        }
    }

    private function getWaitTime(string $domain): int
    {
        $state = $this->domainStates[$domain];

        if ($state['alertCount'] === 0) {
            return 60; // Default check interval when everything is normal
        }

        if ($state['alertCount'] === self::MAX_ALERTS) {
            return 60; // After max alerts just keep checking every minute
        }

        return self::ALERT_INTERVALS[$state['currentWaitIndex']];
    }

    private function sendSlackMessage(string $message)
    {
        $webhookUrl = config('aic.monitoring.slack.webhook_url');
        try {
            Http::post($webhookUrl, [
                'text' => $message
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to send Slack message: ' . $e->getMessage());
        }
    }

    private function resetMonitoring(string $domain)
    {
        $this->domainStates[$domain] = [
            'firstAlertTime' => null,
            'alertCount' => 0,
            'lastAlertTime' => null,
            'currentWaitIndex' => 0,
        ];
    }
}
