<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::rename('digital_publication_sections', 'digital_publication_articles');
    }

    public function down(): void
    {
        Schema::rename('digital_publication_articles', 'digital_publication_sections');
    }
};
