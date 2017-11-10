<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Scopes\SortByLastUpdatedScope;

class BaseModel extends Model
{

    use Transformable, Fillable;

    /**
     * String that indicates the sub-namespace of the child models. Used for dynamic model retrieval.
     *
     * @var string
     */
    protected static $source;


    /**
     * The smallest number that fake IDs start at for this model
     *
     * @var integer
     */
    protected $fakeIdsStartAt = 999000;


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
     * Scope a query to only include fake records.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFake($query)
    {
        if ($this->getKeyType() == 'int')
        {

            return $query->where($this->getKeyName(), '>=', $this->fakeIdsStartAt);

        }
        else
        {

            return $query->where($this->getKeyName(), 'like', '99999999-9999-9999-9999-%');

        }

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
     * Get the class name for a given API endpoint
     *
     * @param  string  $endpoint
     * @return string
     */
    public static function classFor($endpoint)
    {

        return '\App\Models\\' . static::$source . '\\' . studly_case(str_singular($endpoint));

    }

    /**
     * Find the record matching the given id or create it.
     *
     * @TODO Remove this in favor of Laravel's built-in findOrCreate.
     *
     * @param  int    $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public static function findOrCreate($id)
    {

        $model = static::find($id);
        return $model ?: static::create([static::instance()->getKeyName() => $id]);

    }


    /**
     * The smallest number that fake IDs start at for this model
     *
     * @return integer
     */
    public static function fakeIdsStartAt()
    {

        return $this->instance()->fakeIdsStartAt;

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

        $ret = [
            'id' => [
                'doc' => "Unique identifier of this resource. Taken from the source system.",
                'value' => function() { return $this->getAttributeValue($this->getKeyName()); },
            ],
            'title' => [
                'doc' => "Name of this resource",
                "type" => "string",
                'value' => function() { return $this->title; },
            ]
        ];

        $ret = array_merge($ret, $this->transformMappingInternal());

        if (!$this->excludeDates)
        {

            $ret = array_merge($ret,
                               [
                                   'last_updated_source' => [
                                           'doc' => "Date and time the resource was updated in the source system",
                                           "type" => "string",
                                           'value' => function() { return $this->source_indexed_at ? $this->source_indexed_at->toIso8601String() : NULL; },
                                   ],
                                   'last_updated' => [
                                           'doc' => "Date and time the resource was updated in the Data Aggregator",
                                           "type" => "string",
                                           'value' => function() { return $this->updated_at ? $this->updated_at->toIso8601String() : NULL; },
                                   ],
                               ]
            );

        }

        return $ret;

    }

    /**
     * Generate a unique ID based on a combination of two numbers.
     * @param  int   $x
     * @param  int   $y
     * @return int
     */
    public function cantorPair($x, $y)
    {

        return (($x + $y) * ($x + $y + 1)) / 2 + $y;

    }

    /**
     * Get the two numbers that a cantor ID was based on
     * @param  int   $z
     * @return array
     */
    public function reverseCantorPair($z)
    {

        $t = floor((-1 + sqrt(1 + 8 * $z))/2);
        $x = $t * ($t + 3) / 2 - $z;
        $y = $z - $t * ($t + 1) / 2;
        return [$x, $y];

    }

}
