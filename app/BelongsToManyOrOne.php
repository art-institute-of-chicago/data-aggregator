<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

        return $this->isMany? $results : $results->first();
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
}
