<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::rename('digital_catalogs', 'digital_publications');
        Schema::rename('printed_catalogs', 'printed_publications');
    }

    public function down(): void
    {
        Schema::rename('digital_publications', 'digital_catalogs');
        Schema::rename('printed_publications', 'printed_catalogs');
    }
};
