<?php

namespace App\Models;

use Aic\Hub\Foundation\AbstractModel;
use App\BelongsToManyOrOne;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class BaseModel extends AbstractModel
{

    use Transformable, Instancable, Fakeable;

    protected $hasSourceDates = true;

    /**
     * Instantiate a new BelongsToMany relationship.
     *
     * @TODO: Move this to the foundation?
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  \Illuminate\Database\Eloquent\Model  $parent
     * @param  string  $table
     * @param  string  $foreignPivotKey
     * @param  string  $relatedPivotKey
     * @param  string  $parentKey
     * @param  string  $relatedKey
     * @param  string  $relationName
     * @return \App\BelongsToManyOrOne
     */
    protected function newBelongsToMany(Builder $query, Model $parent, $table, $foreignPivotKey, $relatedPivotKey,
                                        $parentKey, $relatedKey, $relationName = null)
    {
        return new BelongsToManyOrOne($query, $parent, $table, $foreignPivotKey, $relatedPivotKey, $parentKey, $relatedKey, $relationName);
    }


    /**
     * String that indicates the sub-namespace of the child models. Used for dynamic model retrieval.
     *
     * TODO: This isn't entirely accurate, since a model might be drawn from multiple sources.
     *
     * @var string
     */
    protected static $source;


    /**
     * The name of the field that the source API provides a last updated timestamp in.
     *
     * @var string
     */
    public static $sourceLastUpdateDateField = 'modified_at';


    /**
     * This getter is in Laravel's base `Model` class, or rather, in its `HasAttributes` trait.
     * We override it here as a convenient way to "append" dates. This allows child classes to
     * use the `$casts` property without worrying about overwriting parent definitions in their
     * entirety. This way, casts are additive. If you need to remove dates, just overwrite this
     * method in a child model.
     */
    public function getCasts()
    {

        // Traverse through the class hierarchy of all the child classes and merge together their
        // definitions of the `$casts` attribute. This allows child classes to simple use `$casts`
        // as an additive property without needing to worry about merging with the parent array.
        $casts = parent::getCasts();
        $class = get_called_class();
        while ($class = get_parent_class($class)) {
            $casts = array_merge($casts, get_class_vars($class)['casts']);
        }

        if (!$this->hasSourceDates)
        {
            return $casts;
        }

        return array_merge( $casts, [
            'source_created_at' => 'datetime',
            'source_modified_at' => 'datetime',
        ]);

    }

    /**
     * Define how the fields in the API are mapped to model properties.
     *
     * Acts as a wrapper method to common attributes across a range of resources. Each method should
     * override `transformMappingInternal()` with their specific field definitions.
     *
     * The keys in the returned array represent the property name as it appears in the API. The value of
     * each pair is an array that includes the following:
     *
     * - "doc" => The documentation for this API field
     * - "value" => An anoymous function that returns the value for this field
     *
     * @return array
     */
    protected function transformMapping()
    {

        return array_merge(
            $this->getMappingForIds(),
            $this->getMappingForTitles(),
            [
                [
                    'name' => 'is_boosted',
                    'doc' => "Whether this document should be boosted in search",
                    "type" => "boolean",
                    'value' => function() { return $this->isBoosted(); },
                ],
                [
                    "name" => 'thumbnail',
                    "doc" => "Thumbnail for showing this entity in search results. Currently, all thumbnails are IIIF images, but this may change in the future, so check `type` before proceeding.",
                    "type" => "array",
                    "elasticsearch" => [
                        "mapping" => [
                            'type' => 'object',
                            'properties' => [
                                'url' => [ 'type' => 'keyword' ],
                                'type' => [ 'type' => 'keyword' ],
                                'lqip' => [ 'enabled' => false ],
                                'width' => [ 'type' => 'integer' ],
                                'height' => [ 'type' => 'integer' ],
                                'alt_text' => [ 'type' => 'text' ],
                            ]
                        ]
                    ],
                    "value" => function() {
                        return !$this->thumbnail ? null : [
                            'url' => $this->thumbnail->iiif_url ?? null,
                            'type' => 'iiif',
                            'lqip' => $this->thumbnail->metadata->lqip ?? null,
                            'width' => $this->thumbnail->metadata->width ?? null,
                            'height' => $this->thumbnail->metadata->height ?? null,
                            'alt_text' => $this->thumbnail->alt_text ?? ($this->alt_text ?? null),
                        ];
                    },
                ],
            ],
            $this->transformMappingInternal(),
            $this->getMappingForDates()
        );

    }

    protected function getMappingForIds()
    {
        $is_id_int = $this->getKeyType() === 'int';

        return [
            [
                'name' => 'id',
                'doc' => 'Unique identifier of this resource. Taken from the source system.',
                'type' => $is_id_int ? 'number' : 'string',
                'elasticsearch' => [
                    // TODO: Account for `long` vs `integer` here?
                    'type' =>  $is_id_int ? 'integer' : 'keyword',
                ],
                'value' => function() { return $this->getKey(); },
            ]
        ];
    }

    protected function getMappingForTitles()
    {
        return [
            [
                'name' => 'title',
                'doc' => 'Name of this resource',
                'type' => 'string',
                'elasticsearch' => [
                    'default' => true,
                    'boost' => 1.5,
                ],
                'value' => function() { return $this->title; },
            ]
        ];
    }

    protected function getMappingForDates()
    {

        if (!$this->hasSourceDates)
        {
            return [];
        }

        return [
            [
                'name' => 'last_updated_source',
                'doc' => 'Date and time the resource was updated in the source system',
                'type' => 'string',
                'value' => function() { return $this->source_indexed_at ? $this->source_indexed_at->toIso8601String() : NULL; },
            ],
            [
                'name' => 'last_updated',
                'doc' => 'Date and time the resource was updated in the Data Aggregator',
                'type' => 'string',
                'value' => function() { return $this->updated_at ? $this->updated_at->toIso8601String() : NULL; },
            ],
        ];
    }

    public function isBoosted()
    {

        return false;

    }

    public static function source()
    {

        return static::$source;

    }

    /**
     * Generate a unique ID based on a combination of two numbers.
     * @param  int   $x
     * @param  int   $y
     * @return int
     */
    public function cantorPair($x, $y)
    {

        return (($x + $y) * ($x + $y + 1)) / 2 + $y;

    }

    /**
     * Get the two numbers that a cantor ID was based on
     * @param  int   $z
     * @return array
     */
    public function reverseCantorPair($z)
    {

        $t = floor((-1 + sqrt(1 + 8 * $z))/2);
        $x = $t * ($t + 3) / 2 - $z;
        $y = $z - $t * ($t + 1) / 2;
        return [$x, $y];

    }

    /**
     * Touch the owning relations of the model.
     * Reindex related models in search index.
     *
     * @return void
     */
    public function touchOwners()
    {

        parent::touchOwners();

        foreach ($this->touches as $relation) {

            if ($this->$relation instanceof self) {

                $this->$relation()->searchable();

            } elseif ($this->$relation instanceof Collection) {

                $this->$relation->each( [$this, 'searchable'] );

            }
        }
    }
}
