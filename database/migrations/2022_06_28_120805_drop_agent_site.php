<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::dropIfExists('agent_site');
    }

    public function down(): void
    {
        Schema::create('agent_site', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('agent_citi_id')->index();
            $table->unsignedInteger('site_site_id')->index();
        });
    }
};
