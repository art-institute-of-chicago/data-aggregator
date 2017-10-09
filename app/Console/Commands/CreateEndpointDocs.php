<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateEndpointDocs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'docs:endpoints
                            {appUrl? : The root URL to use for the documentation. Defaults to APP_URL}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $appUrl;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {

        $appUrl = config("app.url");

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        if ($this->argument('appUrl'))
        {

            $this->appUrl = $this->argument('appUrl');

        }

        $doc = \App\Models\Collections\Artwork::instance()->doc($this->appUrl);

        $this->info($doc);

    }
}
