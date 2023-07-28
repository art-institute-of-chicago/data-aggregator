<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::dropIfExists('interactive_features');
    }

    public function down()
    {
        Schema::create('interactive_features', function (Blueprint $table) {
            $table->unsignedInteger('id')->primary();
            $table->text('title');
            $table->text('sub_title')->nullable();
            $table->string('grouping_background_color')->nullable();
            $table->string('color')->nullable();
            $table->boolean('archived')->default(false);
            $table->timestamp('source_updated_at')->nullable();
            $table->timestamps();
        });
    }
};
