<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RefactorCategoryTerms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        // Remove existing tables
        Schema::dropIfExists('categories');
        Schema::dropIfExists('terms');

        Schema::create('category_terms', function(Blueprint $table) {

            // Shared fields
            $table->string('lake_uid')->primary();
            $table->uuid('lake_guid')->unique();
            $table->string('title')->nullable();
            $table->boolean('is_category')->index();
            $table->string('subtype')->index();

            // Category fields
            $table->string('parent_id')->nullable()->index();

            // Category fields that we can ignore for now...
            // $table->text('description')->nullable();
            // $table->boolean('is_in_nav')->nullable();
            // $table->integer('sort')->nullable();

            // TODO: Move source dates to their own table?
            $table->timestamp('source_created_at')->nullable()->default(null);
            $table->timestamp('source_modified_at')->nullable()->default(null);
            $table->timestamp('source_indexed_at')->nullable()->default(null);
            $table->timestamp('citi_created_at')->nullable()->default(null);
            $table->timestamp('citi_modified_at')->nullable()->default(null);

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

        Schema::dropIfExists('category_terms');

        // php artisan migrate:generate categories
        Schema::create('categories', function(Blueprint $table)
        {
            $table->char('lake_guid', 36)->nullable()->unique();
            $table->string('title', 191)->nullable();
            $table->string('lake_uid', 191)->primary();
            $table->text('description', 65535)->nullable();
            $table->boolean('is_in_nav')->nullable();
            $table->string('parent_id', 191)->nullable()->index();
            $table->integer('sort')->nullable();
            $table->integer('type')->nullable();
            $table->timestamp('source_created_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('source_modified_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('source_indexed_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('citi_created_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('citi_modified_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamps();
        });

        // php artisan migrate:generate terms
        Schema::create('terms', function(Blueprint $table)
        {
            $table->char('lake_guid', 36)->nullable()->unique();
            $table->string('title', 191)->nullable();
            $table->string('lake_uid', 191)->primary();
            $table->string('term_type_id', 191)->nullable();
            $table->timestamp('source_created_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('source_modified_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('source_indexed_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('citi_created_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('citi_modified_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamps();
        });

        // You're gonna have to rerun the imports if you revert:
        // php artisan import:collections-full terms
        // php artisan import:collections-full categories

    }
}
