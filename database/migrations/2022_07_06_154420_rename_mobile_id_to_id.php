<?php

use App\Library\Migrations\RenameColumnMigration;

return new class () extends RenameColumnMigration {
    protected $columns = [
        'mobile_artwork_mobile_sound' => [
            'mobile_artwork_mobile_id' => 'mobile_artwork_id',
            'mobile_sound_mobile_id' => 'mobile_sound_id',
        ],
        'mobile_artworks' => [
            'mobile_id' => 'id',
        ],
        'mobile_sounds' => [
            'mobile_id' => 'id',
        ],
        'tour_stops' => [
            'tour_mobile_id' => 'tour_id',
            'mobile_artwork_mobile_id' => 'mobile_artwork_id',
            'mobile_sound_mobile_id' => 'mobile_sound_id',
        ],
        'tours' => [
            'mobile_id' => 'id',
            'intro_mobile_id' => 'intro_id',
        ],
    ];

    protected $indexes = [
        'mobile_artwork_mobile_sound' => [
            'mobile_artwork_mobile_sound_mobile_artwork_mobile_id_index' => 'mobile_artwork_mobile_sound_mobile_artwork_id_index',
            'mobile_artwork_mobile_sound_mobile_sound_mobile_id_index' => 'mobile_artwork_mobile_sound_mobile_sound_id_index',
        ],
        'tour_stops' => [
            'tour_stops_mobile_artwork_mobile_id_index' => 'tour_stops_mobile_artwork_id_index',
            'tour_stops_mobile_sound_mobile_id_index' => 'tour_stops_mobile_sound_id_index',
            'tour_stops_tour_mobile_id_index' => 'tour_stops_tour_id_index',
        ],
        'tours' => [
            'tours_intro_mobile_id_index' => 'tours_intro_id_index',
        ],
    ];
};
