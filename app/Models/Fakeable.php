<?php

namespace App\Models;

trait Fakeable
{

    /**
     * The smallest number that fake IDs start at for this model
     *
     * @var integer
     */
    protected $fakeIdsStartAt = 999000;

    /**
     * Scope a query to only include fake records.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFake($query)
    {
        if ($this->getKeyType() === 'int')
        {

            return $query->where($this->getKeyName(), '>=', $this->fakeIdsStartAt);

        }

        return $query->where($this->getKeyName(), 'like', '99999999-9999-9999-9999-%');
    }

    /**
     * The smallest number that fake IDs start at for this model
     *
     * @return integer
     */
    public static function fakeIdsStartAt()
    {

        return $this->instance()->fakeIdsStartAt;

    }

}
