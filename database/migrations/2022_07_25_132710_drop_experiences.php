<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::dropIfExists('experiences');
    }

    public function down()
    {
        Schema::create('experiences', function (Blueprint $table) {
            $table->unsignedInteger('id')->primary();
            $table->string('title', 200)->nullable();
            $table->string('sub_title')->nullable();
            $table->text('description')->nullable();
            $table->unsignedInteger('position')->nullable();
            $table->unsignedInteger('interactive_feature_id');
            $table->boolean('archived')->default(false);
            $table->boolean('kiosk_only')->default(false);
            $table->timestamp('source_updated_at')->nullable();
            $table->timestamps();
        });
    }
};
