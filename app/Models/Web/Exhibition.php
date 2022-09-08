<?php

namespace App\Models\Web;

use App\Models\WebModel;

/**
 * An enhanced exhibition on the website
 */
class Exhibition extends WebModel
{

    public $table = 'web_exhibitions';

    protected $casts = [
        'is_featured' => 'boolean',
        'public_start_at' => 'datetime',
        'public_end_at' => 'datetime',
    ];

    protected $touches = [
        'exhibition',
    ];

    public function exhibition()
    {
        return $this->belongsTo('App\Models\Collections\Exhibition', 'datahub_id');
    }

    protected static function newFactory()
    {
        return \Database\Factories\Web\ExhibitionFactory::new();
    }
}
