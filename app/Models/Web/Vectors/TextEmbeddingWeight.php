<?php

namespace App\Models\Web\Vectors;

use App\Models\WebModel;
use Pgvector\Laravel\Vector;

class TextEmbeddingWeight extends WebModel
{
    /**
     * The connection name for the model.
     */
    protected $connection = 'vectors';

    /**
     * The table associated with the model.
     */
    protected $table = 'text_embedding_weights';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'text_embedding_id',
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
     * Get the text embedding that owns the weight.
     */
    public function textEmbedding()
    {
        return $this->belongsTo(TextEmbedding::class);
    }
}
