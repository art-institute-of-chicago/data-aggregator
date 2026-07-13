<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('archives', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('title')->nullable();
            $table->string('mms_id')->nullable()->index();
            $table->string('contentdm_collection')->nullable();
            $table->string('contentdm_id')->nullable();
            $table->text('contentdm_url')->nullable();
            $table->text('web_url')->nullable();
            $table->string('match_type')->nullable();
            $table->string('match_confidence')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamp('source_created_at')->nullable();
            $table->timestamp('source_modified_at')->nullable();
            $table->timestamps();
        });

        Schema::create('agent_archive', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('agent_citi_id')->unsigned()->index();
            $table->bigInteger('archive_id')->unsigned()->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('agent_archive');
        Schema::dropIfExists('archives');
    }
};
