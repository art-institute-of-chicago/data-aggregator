<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddContentLastModFieldsToAssets extends Migration
{
    public function up()
    {
        Schema::table('assets', function (Blueprint $table) {
            $table->string('content_e_tag', 40)->nullable()->after('metadata');
            $table->timestamp('content_modified_at')->nullable()->after('content_e_tag');
        });

    }

    public function down()
    {
        Schema::table('assets', function (Blueprint $table) {
            $table->dropColumn([
                'content_e_tag',
                'content_modified_at',
            ]);
        });
    }
}
