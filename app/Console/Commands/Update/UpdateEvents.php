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

        // Teacher Tour: Water Lillies
        $event = Event::find(2);
        $event->ticketed_event_id = 16914;
        $event->ticketed_event_type_id = 73;
        $event->image_url = 'https://cms-toolkit-dev.imgix.net/migrated-11bd6212cf18f309f465195b159e54c2/exh_vangogh_bedroom_featured_480croped.jpg';
        $event->save();

        // Teach Tour: Van Gogh's Bedrooms
        $event = Event::find(24);
        $event->ticketed_event_id = 16915;
        $event->ticketed_event_type_id = 73;
        $event->image_url = 'https://cms-toolkit-dev.imgix.net/migrated-bed0f3a8ac6867c3ba5371fa90325158/2922_355206_480x360.png';
        $event->save();

        // Teacher Tour: Chagall Windows
        $event = Event::find(61);
        $event->ticketed_event_id = 16916;
        $event->ticketed_event_type_id = 73;
        $event->image_url = '';
        $event->save();

        // Teacher Tour: American Gothic
        $event = Event::find(1);
        $event->ticketed_event_id = 16913;
        $event->ticketed_event_type_id = 73;
        $event->image_url = 'https://cms-toolkit-dev.imgix.net/ecd4e3b1-e8fd-4ddb-aec6-0cfb87a0ad4d/p02wf9z7.jpg';
        $event->save();

        $this->info( "Updated 4 events" );

    }

}
