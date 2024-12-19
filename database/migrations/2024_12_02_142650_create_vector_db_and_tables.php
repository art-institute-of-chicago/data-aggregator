<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class () extends Migration {
    public function __construct()
    {
        $this->connection = 'vectors';
    }

    public function up(): void
    {
        // Text embeddings table
        Schema::create('text_embeddings', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('version'); // Version's are used to iterate on AI processor updates on regressions or improvements
            $table->string('model_name');
            $table->integer('model_id');
            $table->json('data'); // A general array used to store contextual/additional data that isn't an embedding
            // Add unique constraint
            $table->unique(['model_name', 'model_id']);
        });

        // Add vector column for text embeddings
        DB::statement('ALTER TABLE text_embeddings ADD COLUMN embedding vector(1536)');

        // Create hnsw index for text embeddings
        DB::statement('CREATE INDEX text_embeddings_idx ON text_embeddings USING hnsw (embedding vector_cosine_ops) WITH (m = 16, ef_construction = 64)');

        // Image embeddings table
        Schema::create('image_embeddings', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('version'); // Version's are used to iterate on AI processor updates on regressions or improvements
            $table->string('model_name');
            $table->integer('model_id');
            $table->json('data'); // A general array used to store contextual/additional data that isn't an embedding
            // Add unique constraint
            $table->unique(['model_name', 'model_id']);
        });

        // Add vector column for image embeddings
        DB::statement('ALTER TABLE image_embeddings ADD COLUMN embedding vector(1024)');

        // Create hnsw index for image embeddings
        DB::statement('CREATE INDEX image_embeddings_idx ON image_embeddings USING hnsw (embedding vector_cosine_ops) WITH (m = 16, ef_construction = 64)');

        Schema::create('text_embedding_weights', function (Blueprint $table) {
            $table->id();
            $table->foreignId('text_embedding_id')
                ->constrained('text_embeddings')
                ->onDelete('cascade');
            $table->timestamps();
            $table->vector('query_embedding', 1536);
            $table->decimal('weight', 5, 2)->default(1.0);

            $table->index('weight');
        });

        Schema::create('image_embedding_weights', function (Blueprint $table) {
            $table->id();
            $table->foreignId('image_embedding_id')
                ->constrained('image_embeddings')
                ->onDelete('cascade');
            $table->timestamps();
            $table->vector('query_embedding', 1024);
            $table->decimal('weight', 5, 2)->default(1.0);

            $table->index('weight');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('text_embeddings');
        Schema::dropIfExists('image_embeddings');
        Schema::dropIfExists('text_embedding_weights');
        Schema::dropIfExists('image_embedding_weights');
    }
};
