<?php

namespace Tests\Unit;

abstract class AssetTestCase extends ApiTestCase
{

    /**
     * Return an id that is valid, yet has a negligent likelihood of pointing at an actual object.
     * Must pass the relevant controller's `validateId` check. Meant to be overwritten.
     * Assets will always use UUIDs as primary keys, since LAKE is their SOR.
     *
     * @var string
     */
    protected function getRandomId()
    {
        return $this->faker->unique()->uuid;
    }

}
