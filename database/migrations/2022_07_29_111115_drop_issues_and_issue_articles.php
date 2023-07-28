<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::dropIfExists('issues');

        Schema::dropIfExists('issue_articles');
    }

    public function down()
    {
        Schema::create('issues', function (Blueprint $table) {
            $table->unsignedInteger('id')->primary();
            $table->text('title');
            $table->integer('issue_number')->nullable();
            $table->text('cite_as')->nullable();
            $table->timestamp('source_updated_at')->nullable();
            $table->timestamps();
        });

        Schema::create('issue_articles', function (Blueprint $table) {
            $table->unsignedInteger('id')->primary();
            $table->text('title');
            $table->integer('issue_id')->nullable();
            $table->longText('copy')->nullable();
            $table->text('abstract')->nullable();
            $table->text('cite_as')->nullable();
            $table->timestamp('source_updated_at')->nullable();
            $table->timestamps();
        });
    }
};
