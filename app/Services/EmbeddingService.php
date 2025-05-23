<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Exception;
use Illuminate\Support\Facades\Cache;

class EmbeddingService
{
    public function getEmbeddings(string $input): ?array
    {
        return Cache::remember(
            "embedding:search:" . md5($input),
            now()->addDays(7),
            function () use ($input) {
                \Log::info('making call to Azure');
                $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                    'api-key' => config('azure.embedding.key'),
                ])->post(config('azure.embedding.endpoint'), [
                    'input' => [$input],
                    'model' => 'text-embedding-ada-002'
                ]);

                if ($response->successful()) {
                    return $response->json()['data'][0]['embedding'] ?? null;
                }

                throw new Exception('Failed to get embeddings: ' . $response->json()['error'] ?? 'Unknown error');
            }
        );
    }

    public function getImageEmbeddings(string $imageUrl): ?array
    {
        $response = Http::withHeaders([
            'Ocp-Apim-Subscription-Key' => config('azure.image_embedding.key')
        ])->post(config('azure.image_embedding.endpoint'), [
            'url' => $imageUrl
        ]);

        if ($response->successful()) {
            return $response->json()['vector'] ?? null;
        }

        throw new Exception('Failed to get image embeddings: ' . $response->json()['error'] ?? 'Unknown error');
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
            'api-key' => config('azure.completion.key')
        ])->post(config('azure.completion.endpoint'), [
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
}
