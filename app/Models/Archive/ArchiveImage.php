<?php

namespace App\Models\Archive;

use App\Models\BaseModel;

/**
 * An image from the archives.
 */
class ArchiveImage extends BaseModel
{

    protected static $source = 'Archive';

    protected $table = 'archival_images';

    protected $primaryKey = 'id';

    protected $fakeIdsStartAt = 999000;

    protected $casts = [
        'subject_terms' => 'array'
    ];

}
