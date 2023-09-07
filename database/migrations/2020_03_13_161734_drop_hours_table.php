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
        Schema::dropIfExists('hours');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::create('hours', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->datetime('opening_time')->nullable();
            $table->datetime('closing_time')->nullable();
            $table->integer('type');
            $table->integer('day_of_week');
            $table->boolean('closed');
            $table->timestamp('source_modified_at')->nullable();
            $table->timestamp('created_at', 0)->nullable();
            $table->timestamp('updated_at', 0)->nullable()->index();
            $table->softDeletes();
        });
    }
};
