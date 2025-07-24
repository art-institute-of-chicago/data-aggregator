<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hours', function (Blueprint $table) {
            $table->increments('id')->unsignedInteger();
            $table->boolean('monday_is_closed')->nullable();
            $table->string('monday_member_open')->nullable();
            $table->string('monday_member_close')->nullable();
            $table->string('monday_public_open')->nullable();
            $table->string('monday_public_close')->nullable();
            $table->boolean('tuesday_is_closed')->nullable();
            $table->string('tuesday_member_open')->nullable();
            $table->string('tuesday_member_close')->nullable();
            $table->string('tuesday_public_open')->nullable();
            $table->string('tuesday_public_close')->nullable();
            $table->boolean('wednesday_is_closed')->nullable();
            $table->string('wednesday_member_open')->nullable();
            $table->string('wednesday_member_close')->nullable();
            $table->string('wednesday_public_open')->nullable();
            $table->string('wednesday_public_close')->nullable();
            $table->boolean('thursday_is_closed')->nullable();
            $table->string('thursday_member_open')->nullable();
            $table->string('thursday_member_close')->nullable();
            $table->string('thursday_public_open')->nullable();
            $table->string('thursday_public_close')->nullable();
            $table->boolean('friday_is_closed')->nullable();
            $table->string('friday_member_open')->nullable();
            $table->string('friday_member_close')->nullable();
            $table->string('friday_public_open')->nullable();
            $table->string('friday_public_close')->nullable();
            $table->boolean('saturday_is_closed')->nullable();
            $table->string('saturday_member_open')->nullable();
            $table->string('saturday_member_close')->nullable();
            $table->string('saturday_public_open')->nullable();
            $table->string('saturday_public_close')->nullable();
            $table->boolean('sunday_is_closed')->nullable();
            $table->string('sunday_member_open')->nullable();
            $table->string('sunday_member_close')->nullable();
            $table->string('sunday_public_open')->nullable();
            $table->string('sunday_public_close')->nullable();
            $table->text('summary')->nullable();
            $table->text('additional_text')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hours');
    }
};
