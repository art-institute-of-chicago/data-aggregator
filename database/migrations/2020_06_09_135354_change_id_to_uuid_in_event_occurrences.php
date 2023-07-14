<?php

use App\Models\Web\EventOccurrence;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach (EventOccurrence::cursor() as $eventOccurrence) {
            $eventOccurrence->delete();
        }

        Schema::table('event_occurrences', function (Blueprint $table) {
            $table->string('id', 36)->change(); // should be a char, not varchar, but eh
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        foreach (EventOccurrence::cursor() as $eventOccurrence) {
            $eventOccurrence->delete();
        }

        Schema::table('event_occurrences', function (Blueprint $table) {
            $table->increments('id')->change();
        });
    }
};
