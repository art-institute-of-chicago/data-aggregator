<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use App\Models\Web\Vectors\TextEmbedding;
use App\Models\Web\Vectors\ImageEmbedding;
use Exception;

class EmbeddingService
{
    protected string $connection = 'vectors';
    protected array $config;

    public function __construct()
    {
        $this->config = [
            'embedding' => [
                'endpoint' => config('azure.embedding.endpoint'),
                'key' => config('azure.embedding.key'),
                'version' => config('azure.embedding.version'),
            ],
            'image_embedding' => [
                'endpoint' => config('azure.image_embedding.endpoint'),
                'key' => config('azure.image_embedding.key'),
                'version' => config('azure.image_embedding.version'),
            ],
            'image_analysis' => [
                'endpoint' => config('azure.image_analysis.endpoint'),
                'key' => config('azure.image_analysis.key'),
                'version' => config('azure.image_analysis.version'),
            ],
            'completion' => [
                'endpoint' => config('azure.completion.endpoint'),
                'key' => config('azure.completion.key'),
                'version' => config('azure.completion.version'),
            ],
        ];
    }

    public function getEmbeddings(string $input): ?array
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'api-key' => $this->config['embedding']['key'],
        ])->post($this->config['embedding']['endpoint'], [
            'input' => [$input],
            'model' => 'text-embedding-ada-002'
        ]);

        if ($response->successful()) {
            return $response->json()['data'][0]['embedding'] ?? null;
        }

        throw new Exception('Failed to get embeddings: ' . $response->json()['error'] ?? 'Unknown error');
    }

    public function getImageEmbeddings(string $imageUrl): ?array
    {
        $response = Http::withHeaders([
            'Ocp-Apim-Subscription-Key' => $this->config['image_embedding']['key']
        ])->post($this->config['image_embedding']['endpoint'], [
            'url' => $imageUrl
        ]);

        if ($response->successful()) {
            return $response->json()['vector'] ?? null;
        }

        throw new Exception('Failed to get image embeddings: ' . $response->json()['error'] ?? 'Unknown error');
    }

    public function saveEmbeddings(
        string $modelName,
        int $modelId,
        array|string $embedding,
        string $type,
        ?array $additionalData = null
    ): array {
        $version = $this->config[$type === 'text' ? 'embedding' : 'image_embedding']['version'];
        $embeddingModel = $type === 'text' ? TextEmbedding::class : ImageEmbedding::class;

        // Format embedding as vector string if needed
        $embeddingVector = is_array($embedding)
            ? sprintf('[%s]', implode(',', $embedding))
            : $embedding;

        $embedding = $embeddingModel::on($this->connection)
            ->updateOrCreate(
                [
                    'model_name' => $modelName,
                    'model_id' => $modelId,
                ],
                [
                    'version' => $version,
                    'data' => $additionalData,
                    'embedding' => DB::raw("?::vector"),
                ],
                [$embeddingVector]
            );

        return [
            'success' => true,
            'message' => 'Embedding saved successfully',
            'embedding_id' => $embedding->id
        ];
    }

    public function saveArtworkDescription(
        int $artworkId,
        array $description,
        array $generationData
    ): array {
        $modelName = 'artworks';
        $version = $this->config['image_analysis']['version'];

        // Save image analysis data
        $newData = [
            'generation_data' => $generationData,
            'description' => $description,
            'description_generated_at' => now()->toDateTimeString(),
        ];

        $imageEmbedding = ImageEmbedding::on($this->connection)
            ->updateOrCreate(
                [
                    'model_name' => $modelName,
                    'model_id' => $artworkId,
                ],
                [
                    'version' => $version,
                    'data' => $newData,
                ]
            );

        // Generate and save text embeddings from description
        $descriptionText = $this->formatDescriptionText($description);
        $textEmbeddingsSaved = false;

        if ($descriptionText) {
            $textEmbedding = $this->getEmbeddings($descriptionText);
            if ($textEmbedding) {
                $this->saveEmbeddings(
                    modelName: $modelName,
                    modelId: $artworkId,
                    embedding: $textEmbedding,
                    type: 'text',
                    additionalData: [
                        'description_source' => 'image_analysis',
                        'description' => $descriptionText,
                        'generated_at' => now()->toDateTimeString()
                    ]
                );
                $textEmbeddingsSaved = true;
            }
        }

        return [
            'success' => true,
            'message' => 'Artwork description saved successfully',
            'embedding_id' => $imageEmbedding->id,
            'text_embedding_saved' => $textEmbeddingsSaved
        ];
    }

    public function getImageDescription(string $imageUrl): array
    {
        $response = Http::withHeaders([
            'Ocp-Apim-Subscription-Key' => $this->config['image_analysis']['key']
        ])->post($this->config['image_analysis']['endpoint'], [
            'url' => $imageUrl
        ]);

        if ($response->successful()) {
            $data = $response->json();
            return [
                'caption' => $data['captionResult']['text'] ?? null,
                'denseCaption' => $data['denseCaptionsResult']['values'] ?? null,
                'tags' => $data['tagsResult']['values'] ?? null,
                'objects' => $data['objectsResult']['values'] ?? null,
                'peopleLocation' => $data['peopleResult']['values'] ?? null,
            ];
        }

        throw new Exception('Failed to get image description: ' . $response->json()['message'] ?? 'Unknown error');
    }

    public function normalizeQuery(string $input): string
    {
        if (empty($input)) {
            throw new Exception('No valid input given');
        }

        $prompt = <<<EOT
        You are an AI designed to help with semantic search queries. Given a natural language query, your task is to normalize the input by simplifying the language, removing unnecessary details, and retaining only the core meaning. The goal is to ensure that the query can be efficiently converted into a vector for search purposes. Please return the normalized query in a clear, concise form.

        Example 1:
        Input: "Can you show me the documents related to machine learning applications in healthcare?"
        Output: "machine learning applications in healthcare"

        Example 2:
        Input: "What are the best practices for setting up a scalable cloud infrastructure?"
        Output: "best practices scalable cloud infrastructure"

        Now, normalize the following query: "{$input}"
        EOT;

        return $this->getCompletions($prompt);
    }

    public function getCompletions(string $input): string
    {
        $response = Http::withHeaders([
            'api-key' => $this->config['completion']['key']
        ])->post($this->config['completion']['endpoint'], [
            'messages' => [
                [
                    'role' => 'user',
                    'content' => $input
                ]
            ]
        ]);

        if ($response->successful()) {
            return $response->json()['choices'][0]['message']['content'] ?? '';
        }

        throw new Exception('Failed to get completions: ' . $response->json()['error'] ?? 'Unknown error');
    }

    protected function formatDescriptionText(array $description): string
    {
        $text = '';

        if (!empty($description['caption'])) {
            $text .= $description['caption'] . ' ';
        }

        if (!empty($description['denseCaption'])) {
            foreach ($description['denseCaption'] as $caption) {
                if (!empty($caption['text']) && ($caption['confidence'] ?? 0) > 0.7) {
                    $text .= $caption['text'] . ' ';
                }
            }
        }

        if (!empty($description['tags'])) {
            foreach ($description['tags'] as $tag) {
                if (!empty($tag['name']) && ($tag['confidence'] ?? 0) > 0.9) {
                    $text .= $tag['name'] . ' ';
                }
            }
        }

        return trim($text);
    }
}
