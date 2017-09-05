<?php

namespace App\Models;

trait Transformable
{

    /**
     * Turn this model object into a generic array.
     *
     * @param boolean  withTitles
     * @return array
     */
    public function transform($withTitles = false)
    {

        $ret = $this->transformFields();

        if ($withTitles)
        {

            $ret = array_merge($ret, $this->transformTitles());

        }

        return $ret;

    }


    /**
     * Turn this model object into a generic array.
     *
     * @return array
     */
    public function transformFields()
    {

        return [];

    }


    /**
     * Turn the titles for related models into a generic array
     *
     * @return array
     */
    protected function transformTitles()
    {

        return [];

    }

}
