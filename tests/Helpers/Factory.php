<?php

namespace Tests\Helpers;

trait Factory
{
    protected $times = 1;
    protected $ids = [];

    protected function times($count)
    {
        $this->times = $count;
        return $this;
    }

    protected function make($type, $fields = [])
    {
        $models = $type::factory()
            ->count($this->times)
            ->create($fields);

        $this->ids = array_merge($this->ids, $models->modelKeys());
        $this->reset();

        return $models->count() == 1 ? $models->first() : $models;
    }

    protected function classFrom($type)
    {
        return array_pop(explode('\\', $type));
    }

    protected function reset()
    {
        $this->times = 1;
    }
}
