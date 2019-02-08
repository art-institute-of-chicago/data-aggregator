<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropLegacyFieldsFromExhibitions extends Migration
{
    public function up()
    {

        Schema::table('exhibitions', function (Blueprint $table) {
            $table->dropColumn([
                'short_description',
                'web_url',
                'legacy_image_desktop',
                'legacy_image_mobile',
            ]);
        });

    }

    public function down()
    {

        Schema::table('exhibitions', function (Blueprint $table) {
            $table->text('short_description')->nullable()->after('description');
            $table->string('web_url')->nullable()->after('short_description');
            $table->string('legacy_image_desktop')->nullable()->after('status');
            $table->string('legacy_image_mobile')->nullable()->after('legacy_image_desktop');
        });

    }
}
