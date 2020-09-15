<?php

namespace App\Models;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

trait HasRelationships
{

    /**
     * Helper method to get the preferred term of a specified type from the eager-loaded array
     * instead of executing a new SQL query.
     */
    public function preferred($resource = 'term', $type = '', $typeField = 'type')
    {
        $resources = $this->relatedResources($resource, $type, $typeField);

        if (!$resources) {
            return [];
        }

        $resources_ids = $this->relatedIds($resources);

        $this->loadMissing($resource . 'Pivots');

        // Loop through all the term pivot models, only look at the ones
        // of the specified type, and return the preferred one
        foreach ($this->{$resource . 'Pivots'} as $pivot) {
            $key = $pivot->{$resource}()->getForeignKeyName();

            if (in_array($pivot->{$key}, $resources_ids)) {
                if ($pivot->preferred) {
                    return head(Arr::where($resources, function ($value) use ($pivot, $key) {
                        return $value->getKey() === $pivot->{$key};
                    }));
                }
            }
        }

        return null;
    }

    /**
     * Helper method to get the alternate term of a specified type from the eager-loaded array
     * instead of executing a new SQL query.
     */
    public function alts($resource, $type = '', $typeField = 'type')
    {
        $resources = $this->relatedResources($resource, $type, $typeField);

        if (!$resources) {
            return [];
        }

        $resources_ids = $this->relatedIds($resources);

        $this->loadMissing($resource . 'Pivots');

        // Loop through all the term pivot models, only look at the ones
        // of the specified type, and return an array of the non-preferred ones
        $ret = [];

        foreach ($this->{$resource . 'Pivots'} as $pivot) {
            $key = $pivot->{$resource}()->getForeignKeyName();

            if (in_array($pivot->{$key}, $resources_ids)) {
                if (!$pivot->preferred) {
                    $ret[] = head(Arr::where($resources, function ($value) use ($pivot, $key) {
                        return $value->getKey() === $pivot->{$key};
                    }));
                }
            }
        }

        return $ret;
    }

    /**
     * Get all the resources to look through. If there is a subset of resource we're
     * concerned with, as defined by $type, only get those. This is a helper method to
     * get resources of a specified type from an eager-loaded array instead of executing
     * a new SQL query.
     */
    private function relatedResources($resource, $type, $typeField = 'type')
    {
        // If no type is passed return an empty array
        if (!$resource) {
            return [];
        }

        $this->loadMissing(Str::plural($resource));

        if (!$type) {
            return $this->{Str::plural($resource)}->all();
        }

        // Loop through all the resources, and return just the ones of the specified type
        $ret = [];

        foreach ($this->{Str::plural($resource)} as $res) {
            if ($res->{$typeField} === $type) {
                $ret[] = $res;
            }
        }

        return $ret;
    }

    private function relatedIds($resources)
    {
        if ($resources) {
            $key = head($resources)->getKeyName();
            return Arr::pluck($resources, $key);
        }

        return [];
    }
}
