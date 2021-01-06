<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOnLoanDisplayToArtworks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('artworks', function (Blueprint $table) {
            $table->text('on_loan_display')->nullable()->after('is_on_view');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('artworks', function (Blueprint $table) {
            $table->dropColumn('on_loan_display');
        });
    }
}
