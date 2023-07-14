<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::dropIfExists('closures');
    }

    public function down()
    {
        Schema::create('closures', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->date('date_start');
            $table->date('date_end');
            $table->string('closure_copy')->nullable();
            $table->integer('type');
            $table->timestamp('source_modified_at')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable()->index();
            $table->softDeletes();
        });
    }
};
