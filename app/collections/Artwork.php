<?php

namespace App\Collections;

use Illuminate\Database\Eloquent\Model;

class Artwork extends Model
{

    protected $primaryKey = 'citi_id';
    protected $dates = ['api_created_at', 'api_modified_at', 'api_indexed_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['citi_id', 'title', 'lake_guid', 'lake_uri', 'main_id'];
    
    public function artist()
    {
        return $this->belongsTo('App\Collections\Artist');
    }

    public function department()
    {
        return $this->belongsTo('App\Collections\Department');
    }

    public function getCreatorIdAttribute($value) {
        if (empty($this->creator_lake_uid)) {
            return null;
        }
        return (int) substr($this->creator_lake_uid, 3);
    }

    public function getDepartmentIdAttribute($value) {
        if (empty($this->department_lake_uid)) {
            return null;
        }
        return (int) substr($this->department_lake_uid, 3);
    }

}
