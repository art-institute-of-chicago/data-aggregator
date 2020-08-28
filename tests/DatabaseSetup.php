<?php

namespace Tests;

use Illuminate\Contracts\Console\Kernel;

use App\Models\Collections\AgentType;
use App\Models\Collections\Agent;

trait DatabaseSetup
{
    protected static $migrated = false;

    protected function setupDatabase()
    {
        if (! static::$migrated) {
            $this->artisan('migrate:fresh');

            static::$migrated = true;
        }
    }
}
