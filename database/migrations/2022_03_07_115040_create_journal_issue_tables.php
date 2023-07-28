<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('issues', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->boolean('published');
            $table->datetime('publish_start_date')->nullable();
            $table->datetime('date')->nullable();
            $table->integer('issue_number')->nullable();
            $table->string('cite_as')->nullable();
            $table->timestamp('source_modified_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('issue_articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->boolean('published');
            $table->datetime('publish_start_date')->nullable();
            $table->datetime('date')->nullable();
            $table->integer('issue_id')->nullable();
            $table->longText('copy')->nullable();
            $table->text('abstract')->nullable();
            $table->string('cite_as')->nullable();
            $table->timestamp('source_modified_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('issues');
        Schema::dropIfExists('issue_articles');
    }
};
