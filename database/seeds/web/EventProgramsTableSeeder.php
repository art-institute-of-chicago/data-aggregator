<?php

use App\Models\Web\EventProgram;

class EventProgramsTableSeeder extends AbstractSeeder
{

    protected function seed()
    {
        factory(EventProgram::class, 25)->create();
    }

}
