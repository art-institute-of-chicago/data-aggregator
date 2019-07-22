<?php

namespace App\Models;

trait HasRelationshipArray
{

    protected $relationships;

    public function __construct(array $attributes = [])
    {
        $this->relationships = $this->getRelationships();

        parent::__construct($attributes);
    }

    /**
     * Handle dynamic method calls into the model. Defined in Eloquent's Model,
     * but we extend it to handle our custom `$relationship` mappings.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        // For simple cases, e.g. $relationships['department']['method']
        if (isset($this->relationships[$method])) {
            return $this->relationships[$method]['method'](...$parameters);
        }

        // For simple cases, e.g. $relationships['department']['method']
        if (starts_with($method, 'alt')) {
            $method = str_after($method, 'alt');
            $method = str_plural($method, 1);

            if (isset($this->relationships[$method . 'Pivots'])) {
                return $this->alts($method);
            }
        }

        return parent::__call(...func_get_args());
    }

    /**
     * Get a relationship.
     *
     * @param  string  $key
     * @return mixed
     */
    public function getRelationValue($key)
    {
        if ($value = parent::getRelationValue($key)) {
            return $value;
        }

        // Identical to `method_exists` approach in parent, but uses array
        // Note that `is_callable` doesn't respect `__call`
        if (isset($this->relationships[$key])) {
            return $this->getRelationshipFromMethod($key);
        }
    }

}
