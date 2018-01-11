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

        return $this->transformFields($withTitles);

    }


    /**
     * Turn this model object into a generic array.
     *
     * @return array
     */
    public function transformFields($withTitles = false)
    {

        $fields = $this->transformMapping();

        if ($withTitles)
        {
            $fields = array_merge( $fields, $this->transformTitles() );
        }

        $out = [];

        foreach ($fields as $field)
        {

            $out[ $field["name"] ] = call_user_func( $field["value"] );

        }

        return $out;

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


    /**
     * Define how the fields in the API are mapped to model properties.
     *
     * Acts as a wrapper method to common attributes across a range of resources. Each method should
     * override `transformMappingInternal()` with their specific field definitions.
     *
     * The keys in the returned array represent the property name as it appears in the API. The value of
     * each pair is an array that includes the following:
     *
     * - "doc" => The documentation for this API field
     * - "value" => An anoymous function that returns the value for this field
     *
     * @return array
     */
    protected function transformMapping()
    {

        return $this->transformMappingInternal();

    }

    /**
     * Specific field definitions for a given class. See `transformMapping()` for more info.
     */
    protected function transformMappingInternal()
    {

        return [];

    }

}
