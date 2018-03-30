<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTypeOnTerms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('terms', function (Blueprint $table) {
            $table->dropColumn('type');
        });

        Schema::table('terms', function (Blueprint $table) {
            $table->string('term_type_id')->nullable()->after('lake_uid');
        });

        ( new CreateCategoryTermsView() )->up( false, false );

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('terms', function (Blueprint $table) {
            $table->dropColumn('term_type_id');
        });

        Schema::table('terms', function (Blueprint $table) {
            $table->string('type')->nullable()->after('lake_uid');
        });

    }
}
