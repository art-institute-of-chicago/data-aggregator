<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSponsorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sponsors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->text('content');
            $table->boolean('published');
            $table->timestamps();
        });

        Schema::table('events', function (Blueprint $table) {
            $table->integer('sponsor_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sponsors');

        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('sponsor_id');
        });
    }
}
