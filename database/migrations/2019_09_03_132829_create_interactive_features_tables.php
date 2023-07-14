<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interactive_features', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('sub_title')->nullable();
            $table->string('grouping_background_color')->nullable();
            $table->string('color')->nullable();
            $table->boolean('archived')->default(false);
            $table->boolean('published')->default(false);
            $table->timestamp('source_modified_at')->nullable();
            $table->timestamps();
        });

        Schema::create('experiences', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 200)->nullable();
            $table->string('sub_title')->nullable();
            $table->text('description')->nullable();
            $table->integer('position')->unsigned()->nullable();
            $table->integer('interactive_feature_id')->unsigned();
            $table->boolean('archived')->default(false);
            $table->boolean('kiosk_only')->default(false);
            $table->boolean('published')->default(false);
            $table->timestamp('source_modified_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('interactive_features');
        Schema::dropIfExists('experiences');
    }
};
