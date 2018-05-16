<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePagesFromWebCms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::dropIfExists('pages');

        $createPagesTable = function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('web_url', 512)->nullable();
            $table->string('slug')->nullable();
            $table->text('listing_description')->nullable();
            $table->text('short_description')->nullable();
            $table->boolean('published')->nullable();
            $table->datetime('publish_start_date')->nullable();
            $table->datetime('publish_end_date')->nullable();
            $table->text('text')->nullable();
            $table->string('image_url')->nullable();
            $table->timestamps();
            $table->softDeletes();
        };

        Schema::create('generic_pages', $createPagesTable);
        Schema::create('press_releases', $createPagesTable);
        Schema::create('research_guides', $createPagesTable);
        Schema::create('educator_resources', $createPagesTable);
        Schema::create('digital_catalogs', $createPagesTable);
        Schema::create('printed_catalogs', $createPagesTable);

        Schema::table('locations', function (Blueprint $table) {
            $table->string('title')->nullable()->change();
        });

        Schema::table('selections', function (Blueprint $table) {
            $table->text('short_copy')->nullable()->change();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::dropIfExists('generic_pages');
        Schema::dropIfExists('press_releases');
        Schema::dropIfExists('research_guides');
        Schema::dropIfExists('educator_resources');
        Schema::dropIfExists('digital_catalogs');
        Schema::dropIfExists('printed_catalogs');

        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('type');
            $table->string('home_intro')->nullable();
            $table->string('exhibition_intro')->nullable();
            $table->string('art_intro')->nullable();
            $table->string('visit_intro')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('selections', function (Blueprint $table) {
            $table->string('short_copy')->nullable()->change();
        });

    }

}
