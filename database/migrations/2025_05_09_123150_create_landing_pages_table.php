<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('landing_pages', function (Blueprint $table) {
            $table->increments('id')->unsignedInteger();
            $table->text('title');
            $table->text('web_url')->nullable();
            $table->longText('copy')->nullable();
            $table->text('search_tags')->nullable();
            $table->timestamp('source_updated_at')->nullable()->default(null);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('landing_pages');
    }
};
