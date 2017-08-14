<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ScoutFlushAll extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scout:flush-all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove all models from search index';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $this->call("scout:flush", ['model' => \App\Models\Collections\Agent::class]);
        $this->call("scout:flush", ['model' => \App\Models\Collections\Department::class]);
        $this->call("scout:flush", ['model' => \App\Models\Collections\Category::class]);
        $this->call("scout:flush", ['model' => \App\Models\Collections\Gallery::class]);
        $this->call("scout:flush", ['model' => \App\Models\Collections\Artwork::class]);
        $this->call("scout:flush", ['model' => \App\Models\Collections\Link::class]);
        $this->call("scout:flush", ['model' => \App\Models\Collections\Sound::class]);
        $this->call("scout:flush", ['model' => \App\Models\Collections\Video::class]);
        $this->call("scout:flush", ['model' => \App\Models\Collections\Text::class]);
        $this->call("scout:flush", ['model' => \App\Models\Collections\Exhibition::class]);

        $this->call("scout:flush", ['model' => \App\Models\Shop\Category::class]);
        $this->call("scout:flush", ['model' => \App\Models\Shop\Product::class]);

        $this->call("scout:flush", ['model' => \App\Models\Membership\Event::class]);

        $this->call("scout:flush", ['model' => \App\Models\Mobile\Tour::class]);
        $this->call("scout:flush", ['model' => \App\Models\Mobile\TourStop::class]);

        $this->call("scout:flush", ['model' => \App\Models\Dsc\Publication::class]);
        $this->call("scout:flush", ['model' => \App\Models\Dsc\Section::class]);
        $this->call("scout:flush", ['model' => \App\Models\Dsc\WorkOfArt::class]);
        $this->call("scout:flush", ['model' => \App\Models\Dsc\Collector::class]);

        $this->call("scout:flush", ['model' => \App\Models\StaticArchive\Site::class]);

    }
}
