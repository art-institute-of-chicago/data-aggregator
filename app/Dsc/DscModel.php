<?php

namespace App\Dsc;

use Illuminate\Database\Eloquent\Model;

use App\Scopes\SortByLastUpdatedScope;

class DscModel extends Model
{

    public $incrementing = false;
    protected $primaryKey = 'dsc_id';
    protected $dates = ['source_created_at', 'source_modified_at'];

    /**
     * The attributes that aren't mass assignable.
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
