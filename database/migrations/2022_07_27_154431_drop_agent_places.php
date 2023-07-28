<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::dropIfExists('agent_place_qualifiers');

        Schema::dropIfExists('agent_place');
    }

    public function down()
    {
        Schema::create('agent_place_qualifiers', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->text('title')->nullable();
            $table->timestamp('source_updated_at')->nullable();
            $table->timestamps();
        });

        Schema::create('agent_place', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('agent_id')->index();
            $table->integer('place_id')->index();
            $table->integer('agent_place_qualifier_id')->nullable()->index();
            $table->boolean('is_preferred')->index();
        });
    }
};
