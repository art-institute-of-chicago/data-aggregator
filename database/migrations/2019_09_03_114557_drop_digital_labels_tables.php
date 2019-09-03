<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropDigitalLabelsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('digital_label_exhibitions');
        Schema::dropIfExists('digital_labels');
        Schema::dropIfExists('artwork_digital_label');
        Schema::dropIfExists('artist_digital_label');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $oldMigration = new CreateDigitalLabelsExhibitionsTables;
        $oldMigration->up();
    }
}
