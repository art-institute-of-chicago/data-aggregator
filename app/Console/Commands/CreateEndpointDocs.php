<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

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

        $doc = '';

        $doc .= "# Collections\n\n";
        $doc .= \App\Models\Collections\Artwork::instance()->doc($this->appUrl);
        $doc .= \App\Models\Collections\Agent::instance()->doc($this->appUrl);
        $doc .= \App\Models\Collections\Artist::instance()->doc($this->appUrl);
        $doc .= \App\Models\Collections\CorporateBody::instance()->doc($this->appUrl);
        $doc .= \App\Models\Collections\Department::instance()->doc($this->appUrl);
        $doc .= \App\Models\Collections\ObjectType::instance()->doc($this->appUrl);
        $doc .= \App\Models\Collections\Category::instance()->doc($this->appUrl);
        $doc .= \App\Models\Collections\AgentType::instance()->doc($this->appUrl);
        $doc .= \App\Models\Collections\Gallery::instance()->doc($this->appUrl);
        $doc .= \App\Models\Collections\Exhibition::instance()->doc($this->appUrl);
        $doc .= \App\Models\Collections\Image::instance()->doc($this->appUrl);
        $doc .= \App\Models\Collections\Video::instance()->doc($this->appUrl);
        $doc .= \App\Models\Collections\Link::instance()->doc($this->appUrl);
        $doc .= \App\Models\Collections\Sound::instance()->doc($this->appUrl);
        $doc .= \App\Models\Collections\Text::instance()->doc($this->appUrl);

        $doc .= "# Shop\n\n";
        $doc .= \App\Models\Shop\Category::instance()->doc($this->appUrl);
        $doc .= \App\Models\Shop\Product::instance()->doc($this->appUrl);

        $this->info($doc);
        Storage::disk('local')->put('ENDPOINTS.md', $doc);

    }

}
