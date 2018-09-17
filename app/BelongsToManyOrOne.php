<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Collection;

class BelongsToManyOrOne extends BelongsToMany
{
    /**
     * Whether this relation should return a collection.
     *
     * @var boolean
     */
    protected $isMany = true;

    /**
     * Get the results of the relationship.
     *
     * @return mixed
     */
    public function getResults()
    {
        $results = $this->get();

        return $this->isMany ? $results : $results->first();
    }

    /**
     * Declare that a single result should be returned.
     *
     * @return $this
     */
    public function expectOne()
    {
        $this->isMany = false;

        return $this;
    }

    /**
     * Declare that a collection of results should be returned.
     *
     * @return $this
     */
    public function expectMany()
    {
        $this->isMany = true;

        return $this;
    }

    /**
     * Convenience method for only getting the preferred item.
     *
     * @return $this
     */
    public function isPreferred()
    {

        return $this->wherePivot('preferred', '=', true)->expectOne();

    }

    /**
     * Convenience method for only getting the alternative items.
     *
     * @return $this
     */
    public function isAlternative()
    {

        return $this->wherePivot('preferred', '=', false)->expectMany();

    }
    
    public function match(array $models, Collection $results, $relation)
    {
        $dictionary = $this->buildDictionary($results);

	    foreach ($models as $model) {
		    $model->setRelation($relation, $this->getRelationValue($dictionary, $model->{$this->parentKey}));
	    }

        return $models;
    }
    
    
    /**
     * Get the value of a relationship by one or many type.
     *
     * @param  array   $dictionary
     * @param  string  $key
     * @return mixed
     */
    protected function getRelationValue(array $dictionary, $key)
    {
        $value = $dictionary[$key] ?? [];

        return $this->isMany ? $this->related->newCollection($value) : (count($value) ? reset($value) : null);
    }

}
