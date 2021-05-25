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
        WaitTime::destroy(1980,1981,1982,1983);
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
