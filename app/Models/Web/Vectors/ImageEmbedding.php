<?php

namespace App\Models\Web\Vectors;

use App\Models\WebModel;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Pgvector\Laravel\Vector;
use Pgvector\Laravel\Distance as distance;

class ImageEmbedding extends WebModel
{
    /**
     * The connection name for the model.
     */
    protected $connection = 'vectors';

    /**
     * The table associated with the model.
     */
    protected $table = 'image_embeddings';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'version',
        'model_name',
        'model_id',
        'data',
        'embedding'
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'data' => 'array',
        'model_id' => 'integer',
        'embedding' => Vector::class,
    ];

    /**
     * Get the weights for the image embedding.
     */
    public function weights(): HasMany
    {
        return $this->hasMany(ImageEmbeddingWeight::class);
    }
}
