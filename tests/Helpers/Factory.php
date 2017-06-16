<?php

namespace Tests\Helpers;

trait Factory
{

    
    protected $times = 1;
    protected $ids = [];
    protected $attachTypes = [];
    protected $attachTimes = 1;
    protected $attachRelation = '';
    
    protected function times($count)
    {
        $this->times = $count;
        return $this;
    }
    
    protected function attach($types, $times = 1, $relation = '') {
        
        if (is_array($types))
        {
            $this->attachTypes = $types;
        }
        else
        {
            $this->attachTypes = [$types];
        }
        $this->attachTimes = $times;
        $this->attachRelation = $relation;
        return $this;

    }
    
    protected function make($type)
    {

        $model;
        while ($this->times-- > 0) {

            $model = factory($type)->create();

            if ($this->attachTypes)
            {

                while ($this->attachTimes-- > 0)
                {
                    
                    foreach ($this->attachTypes as $attachType)
                    {
                        $class = $this->classFrom($attachType);

                        $relation = $this->attachRelation ? $this->attachRelation : lcfirst(str_plural($class));

                        $add = 'save';
                        
                        if ($model->$relation() instanceof \Illuminate\Database\Eloquent\Relations\BelongsTo)
                        {

                            $add = 'associate';

                        }
                            
                        $model->$relation()->$add(factory($attachType)->create());
                        
                    }

                }

            }
            $this->ids[] = $model->getAttributeValue($model->getKeyName());
            
        }
        $this->reset();

        return last($this->ids);
    }

    protected function classFrom($type)
    {

        $path = explode('\\', $type);
        return array_pop($path);

    }
    
    protected function reset()
    {

        $this->times = 1;
        $this->attachTypes = [];
        $this->attachTimes = 1;
        $this->attachRelation = '';
        
    }    

}