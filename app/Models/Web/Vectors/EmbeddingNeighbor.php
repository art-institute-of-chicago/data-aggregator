<?php

namespace App\Models\Web\Vectors;

use App\Models\BaseModel;

class EmbeddingNeighbor extends BaseModel
{
    /**
     * The connection name for the model.
     */
    protected $connection = 'vectors';

    /**
     * The table associated with the model.
     */
    protected $table = 'embedding_neighbors';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'embedding_type',
        'model_name',
        'model_id',
        'rank',
        'neighbor_id',
        'neighbor_model_name',
        'neighbor_model_id',
        'distance',
        'computed_at',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'model_id' => 'integer',
        'rank' => 'integer',
        'neighbor_id' => 'integer',
        'neighbor_model_id' => 'integer',
        'distance' => 'float',
        'computed_at' => 'datetime',
    ];

    public function shouldBeSearchable()
    {
        return false;
    }
}
