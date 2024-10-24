<?php

namespace App\Providers\AI\Azure;

use Illuminate\Support\Facades\Http;

class AzureServiceProvider
{
    protected $connection;

    # Embeddings
    protected $embeddingApiEndpoint;
    protected $embeddingApiKey;

    # Image Analysis
    protected $imageAnalysisApiEndpoint;
    protected $imageAnalysisApiKey;

    # Completions
    protected $completionsApiEndpoint;
    protected $completionsApiKey;

    public function __construct()
    {
        $this->connection = 'vectors';

        $this->embeddingApiEndpoint = config(key: 'resources.azure.embedding.enpoint');
        $this->embeddingApiKey = config(key: 'resources.azure.embedding.key');

        $this->imageAnalysisApiEndpoint = config(key: 'resources.azure.image_analysis.endpoint');
        $this->imageAnalysisApiKey = config(key: 'resources.azure.image_analysis.key');

        $this->completionsApiEndpoint = config(key: 'resources.azure.completion.endpoint');
        $this->completionsApiKey = config(key: 'resources.azure.completion.key');
    }

    public function search($query)
    {

        if (!empty($query)) {
            $query = 
                $this->getEmbeddings(input: $this->normalizeQuery(input: htmlspecialchars(string: $query, flags: ENT_QUOTES, encoding: 'UTF-8')));

            $vectorizedQuery = '[' . implode(separator: ',', array: $query['data'][0]['embedding']) . ']';

            $statement = "SELECT * FROM Embeddings ORDER BY embedding <-> vector('{$vectorizedQuery}') LIMIT 30";
        } else {
            // Return any items
        }
    }


    public function callApi($data, $endpoint, $key): mixed
    {
        $response = Http::withHeaders(headers: [
            'Authorization' => 'Bearer ',
            'api-key' => $key,
        ])->post(url: $endpoint, data: ['input' => $data]);

        if ($response->successful()) {
            return $response->json();
        } else {
            return response()->json(data: ['error' => $response], status: 404);
        }
    }

    public function getEmbeddings($input): mixed
    {

        return $this->callApi(data: $input, endpoint: $this->embeddingApiEndpoint, key: $this->embeddingApiKey);
    }

    public function getCompletions($input): mixed
    {

        return $this->callApi(data: $input, endpoint: $this->completionsApiEndpoint, key: $this->completionsApiKey);
    }

    public function analyzeImage($input): mixed
    {

        return $this->callApi(data: $input, endpoint: $this->imageAnalysisApiEndpoint, key: $this->imageAnalysisApiKey);
    }

    public function summarizeImageDescription($originalDescription, $generatedDescription) 
    {

        if (!empty($input)) {
            $prompt = <<<EOT
            AI Completion System Prompt:

            You are an AI that generates descriptions combining an AI-analyzed image with a scholarly description. You will merge both descriptions in a way that respects the integrity of the original scholarly description. Clearly show relationships between the two descriptions without introducing any new inferences unless explicitly mentioned in the original description.

            When creating the combined description:

                •	Respect the original scholarly description and retain its structure where possible.
                •	Integrate the AI-analyzed insights only if they are obvious and do not conflict with the original description.
                •	Ensure clarity by templating the scholarly and AI-generated content.
                •	Do not infer anything beyond what is directly stated by the scholarly description unless explicitly instructed.

            Please format your response in a JSON format like so:

            {
                "summarized": "This response is a summarized description of the AI-Analyzed description and the scholarly description",
            }

            Here is the scholarly description: {{$originalDescription}}

            Here is the AI generated description: {{$generatedDescription}}
            EOT;

            return $this->getCompletions(input: $prompt);
        } else {
            return ['No valid input given', http_response_code(response_code: 500)];
        }
    }

    public function normalizeQuery($input): mixed
    {

        if (!empty($input)) {
            # A system prompt is appended to provide the most accurate query for vector embeddings

            $prompt = <<<EOT
            You are an AI designed to help with semantic search queries. Given a natural language query, your task is to normalize the input by simplifying the language, removing unnecessary details, and retaining only the core meaning. The goal is to ensure that the query can be efficiently converted into a vector for search purposes. Please return the normalized query in a clear, concise form.

            Example 1:
            Input: "Can you show me the documents related to machine learning applications in healthcare?"
            Output: "machine learning applications in healthcare"

            Example 2:
            Input: "What are the best practices for setting up a scalable cloud infrastructure?"
            Output: "best practices scalable cloud infrastructure"

            Now, normalize the following query: "{$input}";
            EOT;

            return $this->getCompletions(input: $prompt);

        } else {
            return ['No valid input given', http_response_code(response_code: 500)];
        }
    }
}
