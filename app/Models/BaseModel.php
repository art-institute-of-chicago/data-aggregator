<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Scopes\SortByLastUpdatedScope;

class BaseModel extends Model
{

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var boolean
     */
    public $incrementing = false;


    /**
     * The attributes that aren't mass assignable. Generally,
     * we want all attributes to be mass assignable. Laravel
     * defaults to guarding all attributes.
     *
     * @var array
     */
    protected $guarded = [];


    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {

        parent::boot();
        static::addGlobalScope(new SortByLastUpdatedScope());

    }


    /**
     * Return the cached instance or create a new instance of this model.
     * Uses an array to accomodate for multiple inherited models calling
     * this same method.
     *
     * @return static
     */
    public static function instance()
    {

        static $instances = array();

        $calledClass = get_called_class();

        if (!isset($instances[$calledClass]))
        {

            $instances[$calledClass] = new $calledClass();

        }

        return $instances[$calledClass];

    }


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
