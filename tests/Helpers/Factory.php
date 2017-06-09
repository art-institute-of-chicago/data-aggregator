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
    

    protected function _make($type, $fields = [])
    {

        while ($this->times--) {
            $stub = array_merge($this->_getStub(), $fields);

            if (array_key_exists('citi_id', $stub)) {
                $this->ids[] = $stub['citi_id'];
            }
            
            $type::create($stub);
        }
    }

    protected function _getStub()
    {

        throw new BadMethodCallException('Create your own _getStub method to declare your fields.');
    }
    

}