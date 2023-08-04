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
        Schema::create('ticketed_events', function (Blueprint $table) {
            $table = $this->_addIdsAndTitle($table);
            $table->integer('event_type_id')->nullable();
            $table->timestamp('start_at')->nullable();
            $table->timestamp('end_at')->nullable();
            $table->timestamp('on_sale_at')->nullable();
            $table->timestamp('off_sale_at')->nullable();
            $table->integer('resource_id')->nullable();
            $table->string('resource_title')->nullable();
            $table->boolean('is_after_hours')->nullable();
            $table->boolean('is_private_event')->nullable();
            $table->boolean('is_admission_required')->nullable();
            $table->text('image_url')->nullable();
            $table->integer('available')->nullable();
            $table->integer('total_capacity')->nullable();
            $table = $this->_addDates($table);
        });

        Schema::create('ticketed_event_types', function (Blueprint $table) {
            $table->integer('membership_id')->unsigned()->primary();
            $table->string('title')->nullable();
            $table->string('category')->nullable();
            $table->text('description')->nullable();
            $table->timestamp('source_created_at')->nullable();
            $table->timestamp('source_modified_at')->nullable();
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
        Schema::dropIfExists('ticketed_events');
        Schema::dropIfExists('ticketed_event_types');
    }

    private function _addIdsAndTitle($table)
    {
        $table->integer('membership_id')->unsigned()->primary();
        $table->string('title')->nullable();
        return $table;
    }

    private function _addDates($table, $citiField = true)
    {
        $table->timestamp('source_created_at')->nullable();
        $table->timestamp('source_modified_at')->nullable();
        $table->timestamps();
        return $table;
    }
};
