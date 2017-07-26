<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ScoutImportAll extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scout:import-all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import all models into the search index';

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

        \Artisan::call("scout:import", ['model' => \App\Models\Collections\Agent::class]);
        \Artisan::call("scout:import", ['model' => \App\Models\Collections\Department::class]);
        \Artisan::call("scout:import", ['model' => \App\Models\Collections\Category::class]);
        \Artisan::call("scout:import", ['model' => \App\Models\Collections\Gallery::class]);
        \Artisan::call("scout:import", ['model' => \App\Models\Collections\Artwork::class]);
        \Artisan::call("scout:import", ['model' => \App\Models\Collections\Link::class]);
        \Artisan::call("scout:import", ['model' => \App\Models\Collections\Sound::class]);
        \Artisan::call("scout:import", ['model' => \App\Models\Collections\Video::class]);
        \Artisan::call("scout:import", ['model' => \App\Models\Collections\Text::class]);
        \Artisan::call("scout:import", ['model' => \App\Models\Collections\Exhibition::class]);

        \Artisan::call("scout:import", ['model' => \App\Models\Shop\Category::class]);
        \Artisan::call("scout:import", ['model' => \App\Models\Shop\Product::class]);

        \Artisan::call("scout:import", ['model' => \App\Models\Membership\Event::class]);

        \Artisan::call("scout:import", ['model' => \App\Models\Mobile\Tour::class]);
        \Artisan::call("scout:import", ['model' => \App\Models\Mobile\TourStop::class]);

        \Artisan::call("scout:import", ['model' => \App\Models\Dsc\Publication::class]);
        \Artisan::call("scout:import", ['model' => \App\Models\Dsc\Section::class]);
        \Artisan::call("scout:import", ['model' => \App\Models\Dsc\WorkOfArt::class]);
        \Artisan::call("scout:import", ['model' => \App\Models\Dsc\Collector::class]);

        \Artisan::call("scout:import", ['model' => \App\Models\StaticArchive\Site::class]);

    }
}
