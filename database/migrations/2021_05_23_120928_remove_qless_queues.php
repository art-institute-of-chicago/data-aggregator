<?php

use Illuminate\Database\Migrations\Migration;

use App\Models\Queues\WaitTime;

class RemoveQlessQueues extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        WaitTime::find(1980)->delete();
        WaitTime::find(1981)->delete();
        WaitTime::find(1982)->delete();
        WaitTime::find(1983)->delete();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
