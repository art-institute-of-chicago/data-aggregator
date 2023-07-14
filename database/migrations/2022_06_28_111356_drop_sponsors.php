<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('sponsor_id');
        });

        Schema::dropIfExists('sponsors');
    }

    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->integer('sponsor_id')->nullable()->after('deleted_at');
        });

        Schema::create('sponsors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->text('content');
            $table->boolean('published');
            $table->timestamp('source_modified_at')->nullable();
            $table->timestamps();
        });
    }
};
