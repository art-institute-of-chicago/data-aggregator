<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::table('artworks', function (Blueprint $table) {
            $table->dropColumn([
                'support_aat_id',
            ]);
        });
    }

    public function down()
    {
        Schema::table('artworks', function (Blueprint $table) {
            $table->integer('support_aat_id')->signed()->nullable()->after('medium_display');
        });
    }
};
