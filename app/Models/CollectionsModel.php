<?php

namespace App\Models;

use App\Models\BaseModel;

use App\Scopes\SortByLastUpdatedScope;

class CollectionsModel extends BaseModel
{

    public static $staticInstance;

    public $faker;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public static function instance()
    {

        if ( is_null( self::$staticInstance ) )
        {

            self::$staticInstance = new static;

        }
        return self::$staticInstance;

    }

    function __construct($attributes = array())
    {
        parent::__construct($attributes);

        $this->faker = \Faker\Factory::create();

    }

    protected static function boot()
    {

        parent::boot();
        static::addGlobalScope(new SortByLastUpdatedScope());

    }

    public static function findOrCreate($id)
    {

        $model = static::find($id);
        return $model ?: static::create([static::instance()->getKeyName() => $id]);

    }

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

    public function fillFrom($source)
    {
        $this->fillIdsAndTitleFrom($source)
            ->fill($this->getFillFieldsFrom($source))
            ->fillDatesFrom($source);

        return $this;
    }

    public function getFillFieldsFrom($source)
    {

        return [];

    }

    public function attachFrom($source)
    {

        return $this;

    }

}
