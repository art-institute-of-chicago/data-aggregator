<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Exception;

class EmbeddingService
{
    public const COMPLETIONS_MAX_RETRIES = 5;
    public const COMPLETIONS_MAX_DELAY = 32000; // 32 seconds
    public const COMPLETIONS_BASE_DELAY = 1000; // 1 second
    public const COMPLETIONS_BACKOFF_MULTIPLIER = 2;

    public function getEmbeddings(string $input): ?array
    {
        return Cache::remember(
            "embedding:search:" . md5($input),
            now()->addDays(7),
            function () use ($input) {
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

                throw new Exception('Failed to get embeddings: ' . $this->getResponseError($response->json()));
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

        throw new Exception('Failed to get image embeddings: ' . $this->getResponseError($response->json()));
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
        $attempt = 0;
        $response = null;
        while ($attempt <= self::COMPLETIONS_MAX_RETRIES) {
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

            if ($response->status() === 429) {
                $attempt++;

                if ($attempt > self::COMPLETIONS_MAX_RETRIES) {
                    break;
                }

                $delay = $this->calculateDelay($attempt, $response);

                \Log::warning("Rate limit hit, retrying in {$delay}ms", [
                    'attempt' => $attempt,
                    'max_retries' => self::COMPLETIONS_MAX_RETRIES,
                    'response_body' => $response->json()
                ]);

                usleep($delay * 1000); // Convert ms to microseconds
                continue;
            }

            throw new Exception('Failed to get completions: ' . $this->getResponseError($response->json()));
        }

        throw new Exception('Maximum retries to get completions exceeded: ' . $this->getResponseError($response->json()));
    }

    public function getResponseError($res): string
    {
        if (isset($res['error']['message'])) return $res['error']['message'];
        if (isset($res['error'])) return $res['error'];
        if (isset($res['message'])) return $res['message'];
        return 'Unknown error';
    }

    private function calculateDelay(int $attempt, $response = null): int
    {
        if ($response && $response->header('Retry-After')) {
            $retryAfter = (int) $response->header('Retry-After');
            return min($retryAfter * 1000, self::COMPLETIONS_MAX_DELAY);
        }

        if ($response) {
            $body = $response->json();
            if (isset($body['error']['message'])) {
                preg_match('/retry after (\d+) seconds?/', $body['error']['message'], $matches);
                if (!empty($matches[1])) {
                    $suggestedDelay = (int) $matches[1] * 1000;
                    return min($suggestedDelay, self::COMPLETIONS_MAX_DELAY);
                }
            }
        }

        // Exponential backoff with jitter
        $exponentialDelay = self::COMPLETIONS_BASE_DELAY * pow(self::COMPLETIONS_BACKOFF_MULTIPLIER, $attempt - 1);

        // Add jitter (+/- 25% randomization)
        $jitter = $exponentialDelay * 0.25 * (mt_rand() / mt_getrandmax() * 2 - 1);
        $finalDelay = $exponentialDelay + $jitter;

        return min((int) $finalDelay, self::COMPLETIONS_MAX_DELAY);
    }
}
