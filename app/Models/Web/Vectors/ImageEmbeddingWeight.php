<?php

namespace App\Models\Web\Vectors;

use App\Models\WebModel;
use Pgvector\Laravel\Vector;

class ImageEmbeddingWeight extends WebModel
{
    /**
     * The connection name for the model.
     */
    protected $connection = 'vectors';

    /**
     * The table associated with the model.
     */
    protected $table = 'image_embedding_weights';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'image_embedding_id',
        'weight',
        'query_embedding'
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'query_embedding' => Vector::class,
        'weight' => 'decimal:2'
    ];

    /**
     * Get the image embedding that owns the weight.
     */
    public function imageEmbedding()
    {
        return $this->belongsTo(ImageEmbedding::class);
    }
}
