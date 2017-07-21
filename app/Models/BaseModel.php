<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Scopes\SortByLastUpdatedScope;

class BaseModel extends Model
{

    public $incrementing = false;

    /**
     * The attributes that aren't mass assignable. Generally,
     * we want all attributes to be mass assignable. Laravel
     * defaults to guarding all attributes.
     *
     * @var array
     */
    protected $guarded = [];

    protected static function boot()
    {

        parent::boot();
        static::addGlobalScope(new SortByLastUpdatedScope());

    }

}
