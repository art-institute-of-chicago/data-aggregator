<?php

namespace App\Services;

class DescriptionService
{
    private EmbeddingService $embeddingService;

    public function __construct(EmbeddingService $embeddingService)
    {
        $this->embeddingService = $embeddingService;
    }

    public function summarizeImageDescription(?string $aicDescription, array $generatedDescription): string
    {
        $prompt = $this->buildArtworkSummarizationPrompt($aicDescription, $generatedDescription);
        return $this->embeddingService->getCompletions($prompt);
    }

    private function buildArtworkSummarizationPrompt(?string $aicDescription, array $generatedDescription): string
    {
        $basePrompt = <<<EOT
            You are an art historian writing clear, cohesive visual descriptions of artworks for alt text. Create a description that captures the work's essential visual elements and technical aspects using the JSON provided data on visual analysis.

            Create a unified description that:
            - Begins with the primary subject matter and composition
            - Details the specific materials and techniques used
            - Notes distinctive color choices and applications
            - Describes spatial relationships and scale
            - Includes relevant textural and surface qualities

            Avoid:
            - Using section headers or separate analyses
            - Making interpretive or emotional statements
            - Speculating beyond what is visible
            - Including technical metadata or analysis details
            - Using phrases like "this artwork" or "we can see"
            - Inferring textures or materials if not confidently or explicitly stated
            - Assuming the gender to the artist or subjects unless they are explictly mentioned
            - Assuming the ethnicity or race of the artist or subjects unless explicitly mentioned

            Please format your response in a string format with a single, cohesive description:
            EOT;

        if ($aicDescription) {
            $basePrompt .= "\n\nOriginal scholarly description: {$aicDescription}";
        }

        $basePrompt .= "\nVisual analysis: " . json_encode($generatedDescription);

        return $basePrompt;
    }
}
