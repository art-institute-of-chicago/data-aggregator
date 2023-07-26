<?php

namespace App\Models\Collections;

use App\Models\CollectionsModel;
use App\Models\ElasticSearchable;

/**
 * A binary representation of a collections resource, like an artwork, artist, exhibition, etc.
 */
class Asset extends CollectionsModel
{
    use ElasticSearchable;

    public const IMAGE = 'image';
    public const SOUND = 'sound';
    public const TEXT = 'text';
    public const VIDEO = 'video';

    protected static $assetType;

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

    private $preloadedArtworks;

    /**
     * Create a new instance of the given model. For Assets, we use this to set a default `type`.
     */
    public function __construct()
    {
        parent::__construct(...func_get_args());

        $this->type = static::$assetType ?? null;
    }

    public static function getHashedId($id)
    {
        if (!is_numeric($id)) {
            return $id;
        }

        if ($id === null) {
            return null;
        }

        $hash = (string) hash('md5', config('aic.asset.prefix') . $id);
        return substr($hash, 0, 8) . '-'
          . substr($hash, 8, 4) . '-'
          . substr($hash, 12, 4) . '-'
          . substr($hash, 16, 4) . '-'
          . substr($hash, 20);
    }

    public function artworks()
    {
        return $this->belongsToMany('App\Models\Collections\Artwork', 'artwork_asset', 'asset_id')
            ->withPivot('is_preferred')
            ->withPivot('is_doc')
            ->artworks();
    }

    public function exhibitions()
    {
        return $this->belongsToMany('App\Models\Collections\Exhibition', 'exhibition_asset', 'asset_id')
            ->withPivot('is_preferred')
            ->withPivot('is_doc');
    }

    public function imagedArtworks()
    {
        return $this->artworks()->wherePivot('is_doc', '=', false);
    }

    public function documentedArtworks()
    {
        return $this->artworks()->wherePivot('is_doc', '=', true);
    }

    public function imagedExhibitions()
    {
        return $this->exhibitions()->wherePivot('is_doc', '=', false);
    }

    public function documentedExhibitions()
    {
        return $this->exhibitions()->wherePivot('is_doc', '=', true);
    }

    /**
     * Temporary helper to ease indexing.
     */
    public function getRelatedArtworks()
    {
        return $this->preloadedArtworks ?? $this->preloadedArtworks = $this->artworks()
            // https://stackoverflow.com/questions/34052056/disable-eager-relations
            ->setEagerLoads([])
            ->get(['artworks.id', 'artworks.title']);
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

    protected function getKeyForDoc()
    {
        return $this->getHashedId($this->getKey());
    }

    /**
     * Filters the `assets` table by `type` to match `$assetType` of the model.
     * Uses the inline method for scope definition, rather than creating new classes.
     *
     * @link https://stackoverflow.com/questions/20701216/laravel-default-orderby
     *
     * {@inheritdoc}
     */
    protected static function boot()
    {
        parent::boot();

        // Allows querying all assets via the Asset class directly
        if (!static::$assetType) {
            return;
        }

        static::addGlobalScope('assets', function ($builder) {
            $builder->where('type', '=', static::$assetType);
        });
    }
}
