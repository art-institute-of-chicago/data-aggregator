<?php

namespace App\Models;

use App\Models\BaseModel;

class CollectionsModel extends BaseModel
{

    /**
     * A Faker instance for the model.
     *
     * @var \Faker\Generator
     */
    public $faker;


    /**
     * Create a new model instance. Also instantiates a $faker class. 
     *
     * @param  array  $attributes
     * @return void
     */
    function __construct($attributes = array())
    {
        parent::__construct($attributes);

        $this->faker = \Faker\Factory::create();

    }


    /**
     * Find the record matching the given id or create it.
     *
     * @param  int    $id
     * @return \App\Models\CollectionsModel
     */
    public static function findOrCreate($id)
    {

        $model = static::find($id);
        return $model ?: static::create([static::instance()->getKeyName() => $id]);

    }


    /**
     * Get the class name for a given API endpoint
     *
     * @param  string  $endpoint
     * @return string
     */
    public static function classFor($endpoint)
    {

        switch ($endpoint) {
        case 'artists':
            return \App\Models\Collections\Agent::class;
            break;
        case 'venues':
            return \App\Models\Collections\Agent::class;
            break;
        default:
            return '\App\Models\Collections\\' .studly_case(str_singular($endpoint));
            break;
        }

    }


    /**
     * Fill in this model's IDs and title from the given resource, or fill it in with fake data.
     * This method is used primarily when the given resource is provided by the source
     * system.
     *
     * @param  \App\Models\CollecitonsModel  $source
     * @return $this
     */
    private function fillIdsAndTitleFrom($source)
    {

        $fill = [];

        if ($this->getKeyName() == 'citi_id')
        {

            $fill['citi_id'] = $source->id;
            $fill['lake_guid'] = $source->lake_guid;

        }
        else
        {

            $fill['lake_guid'] = $source->id;

        }

        $fill['title'] = $source->title;
        $fill['lake_uri'] = $source->lake_uri;

        $this->fill($fill);

        return $this;

    }


    /**
     * Fill in this model's dates from the given resource, or fill it in with fake data.
     * This method is used primarily when the given resource is provided by the source
     * system.
     *
     * @param  \App\Models\CollectionsModel  $source
     * @return $this
     */
    private function fillDatesFrom($source)
    {

        $fill = [];

        $fill['source_created_at'] = strtotime($source->created_at);
        $fill['source_modified_at'] = strtotime($source->modified_at);
        $fill['source_indexed_at'] = strtotime($source->indexed_at);

        if ($this->getKeyName() == 'citi_id')
        {

            //$fill['citi_created_at'] = ;
            //$fill['citi_modified_at'] = ;

        }

        $this->fill($fill);

        return $this;

    }


    /**
     * Fill in this model's fields from the given resource, or fill it in with fake data.
     * This method is used primarily when the given resource is provided by the source
     * system.
     *
     * @param  \App\Models\CollectionsModel  $source
     * @return $this
     */
    public function fillFrom($source)
    {
        $this->fillIdsAndTitleFrom($source)
            ->fill($this->getFillFieldsFrom($source))
            ->fillDatesFrom($source);

        return $this;
    }


    /**
     * Method to allow child classes to define how `fill` methods should treat fields that are
     * specific to each model.
     *
     * @param  \App\Models\CollectionsModel  $source
     * @return $this
     */
    public function getFillFieldsFrom($source)
    {

        return [];

    }


    /**
     * Method to allow child classes to define how `fill` methods should treat related models
     * for each model.
     *
     * @param  \App\Models\CollectionsModel  $source
     * @return $this
     */
    public function attachFrom($source)
    {

        return $this;

    }

}
