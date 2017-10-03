<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ScoutImportAll extends Command
{

    protected $signature = 'scout:import-all';

    protected $description = 'Import all models into the search index';


    public function handle()
    {

        $this->call("scout:import", ['model' => \App\Models\Collections\Agent::class]);
        $this->call("scout:import", ['model' => \App\Models\Collections\Department::class]);
        $this->call("scout:import", ['model' => \App\Models\Collections\Category::class]);
        $this->call("scout:import", ['model' => \App\Models\Collections\Gallery::class]);
        $this->call("scout:import", ['model' => \App\Models\Collections\Artwork::class]);
        $this->call("scout:import", ['model' => \App\Models\Collections\Link::class]);
        $this->call("scout:import", ['model' => \App\Models\Collections\Video::class]);
        $this->call("scout:import", ['model' => \App\Models\Collections\Text::class]);
        $this->call("scout:import", ['model' => \App\Models\Collections\Sound::class]);
        $this->call("scout:import", ['model' => \App\Models\Collections\Image::class]);
        $this->call("scout:import", ['model' => \App\Models\Collections\Exhibition::class]);

        $this->call("scout:import", ['model' => \App\Models\Shop\Category::class]);
        $this->call("scout:import", ['model' => \App\Models\Shop\Product::class]);

        $this->call("scout:import", ['model' => \Modules\Membership\Models\Event::class]);

        $this->call("scout:import", ['model' => \App\Models\Mobile\Tour::class]);
        $this->call("scout:import", ['model' => \App\Models\Mobile\TourStop::class]);

        $this->call("scout:import", ['model' => \App\Models\Dsc\Publication::class]);
        $this->call("scout:import", ['model' => \App\Models\Dsc\Section::class]);

        $this->call("scout:import", ['model' => \App\Models\StaticArchive\Site::class]);

    }
}
