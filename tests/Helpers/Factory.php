<?php

namespace Tests\Helpers;

use Illuminate\Support\Str;

trait Factory
{

    protected $times = 1;
    protected $ids = [];
    protected $attachTypes = [];
    protected $attachTimes = 1;
    protected $attachRelation = '';
    protected $attachFields = [];

    protected function times($count)
    {
        $this->times = $count;
        return $this;
    }

    protected function attach($types, $times = 1, $relation = '', $fields = [])
    {
        if (!is_array($types)) {
            $types = [$types];
        }

        $this->attachTypes = $types;
        $this->attachTimes = $times;
        $this->attachRelation = $relation;
        $this->attachFields = $fields;
        return $this;
    }

    protected function make($type, $fields = [])
    {

        $return = [];
        while ($this->times-- > 0)
        {
            $model = factory($type)->create($fields);

            if ($this->attachTypes)
            {
                while ($this->attachTimes-- > 0)
                {
                    foreach ($this->attachTypes as $attachType)
                    {
                        $class = $this->classFrom($attachType);

                        $relation = $this->attachRelation ? $this->attachRelation : lcfirst(Str::plural($class));

                        $attach = factory($attachType)->create($this->attachFields);

                        if ($model->{$relation}() instanceof \Illuminate\Database\Eloquent\Relations\BelongsTo) {
                            $model->{$relation}()->associate($attach);
                        } elseif ($model->{$relation}() instanceof \Illuminate\Database\Eloquent\Relations\HasMany) {
                            $model->{$relation}()->save($attach);
                        } else {
                            $model->{$relation}()->attach($attach->getKey());
                        }
                    }
                }
            }

            $this->ids[] = $model->getAttributeValue($model->getKeyName());
            $return[] = $model;
        }

        $this->reset();

        return count($return) == 1 ? $return[0] : collect($return);
    }

    protected function classFrom($type)
    {
        return array_pop(explode('\\', $type));
    }

    protected function reset()
    {
        $this->times = 1;
        $this->attachTypes = [];
        $this->attachTimes = 1;
        $this->attachRelation = '';
        $this->attachFields = [];
    }

}
