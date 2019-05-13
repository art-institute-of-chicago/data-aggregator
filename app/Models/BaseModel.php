<?php

namespace App\Models;

use Aic\Hub\Foundation\AbstractModel;
use App\BelongsToManyOrOne;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class BaseModel extends AbstractModel
{

    use Transformable, Instancable, Fakeable, Documentable;

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
            'source_modified_at' => 'datetime',
        ]);

    }

    public function isBoosted()
    {

        return false;

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

                $this->$relation->searchable();

            } elseif ($this->$relation instanceof Collection) {

                foreach ($this->$relation->chunk(50) as $chunk)
                {
                    $chunk->searchable();
                }
            }
        }
    }
}
