<?php

namespace App\Models\Web;

use App\Models\WebModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;

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

    protected function webUrl(): Attribute
    {
        return Attribute::make(
            get: fn (?string $webUrl) => $webUrl ? Str::replace('nocache.', '', $webUrl) : null,
        );
    }

    public function exhibition()
    {
        return $this->belongsTo('App\Models\Collections\Exhibition', 'datahub_id');
    }

    protected static function newFactory()
    {
        return \Database\Factories\Web\ExhibitionFactory::new();
    }
}
