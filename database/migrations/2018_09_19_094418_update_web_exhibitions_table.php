<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateWebExhibitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        // For now, sponsors_sub_copy is not provided upstream
        // cms_exhibition_type is useless outside the website:
        // it just determines how big the header should be.
        foreach (['sponsors_sub_copy', 'cms_exhibition_type'] as $column) {
            Schema::table('web_exhibitions', function (Blueprint $table) use ($column) {
                $table->dropColumn($column);
            });
        }

        Schema::table('web_exhibitions', function (Blueprint $table) use ($column) {
            $table->text('title')->change();
            $table->text('header_copy')->change();
            $table->text('exhibition_message')->change();
            $table->integer('datahub_id')->change();
            $table->renameColumn('published', 'is_published');

            // TODO: Think about how to handle content properly...
            // $table->json('content')->nullable();

            $table->text('list_description')->nullable()->after('header_copy');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('web_exhibitions', function (Blueprint $table) {
            $table->string('title')->change();
            $table->string('header_copy')->change();
            $table->string('exhibition_message')->change();
            $table->string('datahub_id')->change();
            $table->string('sponsors_sub_copy')->nullable()->after('exhibition_message');
            // cms_exhibition_type wasn't nullable before, but imports might break otherwise.
            $table->integer('cms_exhibition_type')->nullable()->after('sponsors_sub_copy');
            $table->renameColumn('is_published', 'published');
            $table->dropColumn('list_description');
        });

    }
}
