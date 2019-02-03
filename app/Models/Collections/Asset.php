<?php

namespace App\Models\Collections;

use App\Models\CollectionsModel;
use App\Models\ElasticSearchable;
use App\Models\TransformableRefactor;

/**
 * A binary representation of a collections resource, like an artwork, artist, exhibition, etc.
 */
class Asset extends CollectionsModel
{

    use ElasticSearchable, TransformableRefactor;

    public const IMAGE = 'image';
    public const SOUND = 'sound';
    public const TEXT = 'text';
    public const VIDEO = 'video';

    protected $primaryKey = 'lake_guid';

    protected $keyType = 'string';

    protected $isInCiti = false;

    protected $casts = [
        'metadata' => 'object',
        'is_multimedia_resource' => 'boolean',
        'is_educational_resource' => 'boolean',
        'is_teacher_resource' => 'boolean',
    ];

    protected $touches = [
        'artworks',
    ];

    protected static $assetType = null;

    public function categories()
    {

        return $this->belongsToMany('App\Models\Collections\Category', 'asset_category', 'asset_lake_guid');

    }

    // Note: Not all Images are meant to be associated w/ Artworks
    public function artworks()
    {

        return $this->belongsToMany('App\Models\Collections\Artwork', 'artwork_asset', 'asset_lake_guid');

    }

    /**
     * Filters the `assets` table by `type` to match `$assetType` of the model.
     * Uses the inline method for scope definition, rather than creating new classes.
     *
     * @link https://stackoverflow.com/questions/20701216/laravel-default-orderby
     *
     * {@inheritdoc}
     */
    protected static function boot() {

        parent::boot();

        // Allows querying all assets via the Asset class directly
        if( !static::$assetType )
        {
            return;
        }

        static::addGlobalScope('assets', function ($builder) {
            $builder->where('type', '=', static::$assetType );
        });

    }

    /**
     * Create a new instance of the given model. For Assets, we use this to set a default `type`.
     *
     * @param  array  $attributes
     * @param  bool  $exists
     * @return static
     */
    public function newInstance($attributes = [], $exists = false)
    {

        $model = parent::newInstance($attributes, $exists);
        $model->type = static::$assetType;
        return $model;

    }

    /**
     * Ensure that the id is a valid UUID.
     *
     * @param mixed $id
     * @return boolean
     */
    public static function validateId($id)
    {

        // We must not be using UUIDv3, since the typical regex wasn't matching
        $uuid = '/^[0-9A-F]{8}-[0-9A-F]{4}-[0-9A-F]{4}-[0-9A-F]{4}-[0-9A-F]{12}$/i';

        return preg_match($uuid, $id);

    }

}
