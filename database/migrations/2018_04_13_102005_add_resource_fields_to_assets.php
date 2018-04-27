<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddResourceFieldsToAssets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('assets', function (Blueprint $table) {

            $table->boolean('is_multimedia_resource')->default(false)->index()->after('published');
            $table->boolean('is_educational_resource')->default(false)->index()->after('is_multimedia_resource');
            $table->boolean('is_teacher_resource')->default(false)->index()->after('is_educational_resource');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('assets', function (Blueprint $table) {

            $table->dropColumn('is_multimedia_resource');
            $table->dropColumn('is_educational_resource');
            $table->dropColumn('is_teacher_resource');

        });

    }
}
