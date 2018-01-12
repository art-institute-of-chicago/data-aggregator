<?php

namespace App\Models;

trait Fillable
{

    protected $hasSourceDates = true;

    /**
     * Fill in this model's fields from the given resource, or fill it in with fake data.
     * This method is used primarily when the given resource is provided by the source
     * system.
     *
     * @param  object  $source
     * @param  bool  $fake
     * @return $this
     */
    public function fillFrom($source)
    {
        $this
            ->fillIdsFrom($source)
            ->fillTitleFrom($source);

        if( $this->hasSourceDates )
        {
            $this->fillDatesFrom($source);
        }

        $this->fillArraysAndObjectsFrom($source);

        $this->fillFieldsFrom($source);

        $this->fill( $this->getExtraFillFieldsFrom($source) );

        return $this;
    }


    /**
     * Method to allow child classes to define how `fill` methods should treat related models
     * for each model.
     *
     * @param  object  $source
     * @return $this
     */
    public function attachFrom($source)
    {

        return $this;

    }


    /**
     * Method to allow child classes to define `fill` fields that are named differently from the API, 
     * or should be treated differently. 
     *
     * @param  object  $source
     * @return $this
     */
    protected function getExtraFillFieldsFrom($source)
    {

        return [];

    }

    /**
     * Fill in this model's attributes from source data. Only fill attributes whose names are the same
     * as the field name presented in the API that do not contain array or object values. Does not process
     * `title`, `id`, `created_at` and `modified_at` which are handled in separate methods.
     *
     * @param  object  $source
     * @return $this
     */
    protected function fillFieldsFrom($source)
    {

        // Ignore `id`, `title`, `created_at` and `modified_at`
        foreach( ['id', 'title', 'created_at', 'modified_at'] as $field )
        {
            if( isset( $source->$field ) )
            {
                unset( $source->$field );
            }
        }

        // Cast the object to an array
        $data = (array) $source;

        // Remove any fields that are objects or arrays
        $data = array_filter( $data, function( $datum ) {
            return !is_array( $datum ) && !is_object( $datum );
        });

        // Remove any fields that aren't columns in the database
        $availableAttributes = array_keys($this->attributes);
        $data = array_filter( $data, function( $key ) use ($availableAttributes) {
            return in_array( $key, $availableAttributes );
        }, ARRAY_FILTER_USE_KEY);

        $this->fill($data);
        return $this;

    }


    /**
     * Fill in this model's identifiers from source data.
     * Meant to be overridden, especially by CollectionsModel, etc.
     *
     * @param  object  $source
     * @return $this
     */
    protected function fillIdsFrom($source)
    {

        $this->id = $source->id;

        return $this;

    }


    /**
     * Fill in this model's title from source data.
     * Meant to be overridden for more complex cases.
     *
     * @param  object  $source
     * @return $this
     */
    protected function fillTitleFrom($source)
    {

        $this->title = $source->title;

        return $this;

    }


    /**
     * Fill in this model's dates from the given resource, or fill it in with fake data.
     * This method is used primarily when the given resource is provided by the source
     * system.
     *
     * @param  object  $source
     * @return $this
     */
    protected function fillDatesFrom($source)
    {

        $fill = [];

        $fill['source_created_at'] = strtotime($source->created_at);
        $fill['source_modified_at'] = strtotime($source->modified_at);

        $this->fill($fill);

        return $this;

    }

    /**
     * Provide child classes a space to implement fill functionality for arrays and objects
     * returned from source APIs
     *
     * @param  object  $source
     * @return $this
     */
    protected function fillArraysAndObjectsFrom($source)
    {

        return $this;

    }

}
