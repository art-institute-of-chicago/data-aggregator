<?php

namespace App\Console\Commands\Update;

use App\Models\Web\Event;
use App\Transformers\Inbound\Collections\Artwork as ArtworkTransformer;

use Aic\Hub\Foundation\AbstractCommand as BaseCommand;

class UpdateEvents extends BaseCommand
{

    protected $signature = 'update:events';

    protected $description = "Add Web CMS fields to a few sample events";


    public function handle()
    {

        $event = Event::find(61);
        $event->ticketed_event_id = 16859;
        $event->ticketed_event_type_id = 73;
        $event->image_url = 'https://cms-toolkit-dev.imgix.net/migrated-7f1e401bb00884f94cd16e52e4fc9aad/cal_ArtPlay_12022017.jpg';
        $event->save();

        $event = Event::find(24);
        $event->ticketed_event_id = 16865;
        $event->ticketed_event_type_id = 73;
        $event->image_url = 'https://cms-toolkit-dev.imgix.net/migrated-bed0f3a8ac6867c3ba5371fa90325158/2922_355206_480x360.png';
        $event->save();

        $event = Event::find(2);
        $event->ticketed_event_id = 16862;
        $event->ticketed_event_type_id = 73;
        $event->image_url = '';
        $event->save();

        $this->info( "Updated 3 events" );

    }

}
