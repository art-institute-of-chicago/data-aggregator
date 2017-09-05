<?php

namespace App\Models;

trait Fillable
{

    /**
     * Fill in this model's fields from the given resource, or fill it in with fake data.
     * This method is used primarily when the given resource is provided by the source
     * system.
     *
     * @param  object  $source
     * @param  bool  $fake
     * @return $this
     */
    public function fillFrom($source, $fake = true)
    {
        $this
            ->fillIdsAndTitleFrom($source)
            ->fill( $this->getFillFieldsFrom($source, $fake) )
            ->fillDatesFrom($source);

        return $this;
    }


    /**
     * Method to allow child classes to define how `fill` methods should treat related models
     * for each model.
     *
     * @param  object  $source
     * @return $this
     */
    public function attachFrom($source, $fake = true)
    {

        return $this;

    }


    /**
     * Method to allow child classes to define how `fill` methods should treat fields that are
     * specific to each model.
     *
     * @param  object  $source
     * @return $this
     */
    protected function getFillFieldsFrom($source)
    {

        return [];

    }


    /**
     * Fill in this model's IDs and title from the given resource, or fill it in with fake data.
     * This method is used primarily when the given resource is provided by the source
     * system.
     *
     * @param  object  $source
     * @return $this
     */
    protected function fillIdsAndTitleFrom($source)
    {

        $fill = [];

        $fill['title'] = $source->title;

        $this->fill($fill);

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


}
