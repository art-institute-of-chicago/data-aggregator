<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommandTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('commands', function (Blueprint $table) {
            $table->increments('id');
            $table->string('command')->nullable();
            $table->timestamp('last_attempt_at')->nullable()->useCurrent();
            $table->timestamp('last_success_at')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::dropIfExists('commands');

    }
}
