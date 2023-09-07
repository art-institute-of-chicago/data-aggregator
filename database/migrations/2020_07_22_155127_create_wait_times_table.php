<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('wait_times', function (Blueprint $table) {
            $table->integer('queue_id')->unsigned()->primary();
            $table->text('title')->nullable();
            $table->integer('duration')->nullable();
            $table->string('units')->nullable();
            $table->string('display')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('wait_times');
    }
};
