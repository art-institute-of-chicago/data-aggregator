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

}
