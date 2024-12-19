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
        $prompt = $this->buildSummarizationPrompt($aicDescription, $generatedDescription);
        return $this->embeddingService->getCompletions($prompt);
    }

    private function buildSummarizationPrompt(?string $aicDescription, array $generatedDescription): string
    {
        $basePrompt = <<<EOT
            You are an art historian writing clear, cohesive visual descriptions of artworks for alt text. Create a description that captures the work's essential visual elements and technical aspects.
            
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

    private function buiildAltTextPrompt(?string $aicDescription, array $generatedDescription): string
    {
        $basePrompt = <<<EOT
        You are an art historian writing clear, cohesive visual descriptions of artworks for alt text. Create a description that captures the work's essential visual elements and technical aspects.

        Create a unified description that:

            Begins with the primary subject matter and composition.
            Details the specific materials, methods, and visual styles, such as medium, texture, and notable physical qualities.
            Identifies the color of key elements using familiar terms.
            Describes spatial relationships, orientation, and scale.
            Transcribes embedded text verbatim and in quotation marks.

        Avoid:

            Using specialized art-historical jargon unless essential.
            Making interpretive or emotional statements.
            Including redundant metadata or captions already accessible.
            Assuming gender, ethnicity, or race unless explicitly stated or visually verifiable.
            Starting with phrases like "image of" or "picture of."
            Referencing other images or figures.

        Please format your response in a string format with a single, cohesive description. For example:
            
        "Two winged baby angels hold a wreath over a person intently reading. The forms are created from loose gestural black lines and washes of gray on yellowed paper."
        EOT;

        if ($aicDescription) {
            $basePrompt .= "\n\nOriginal scholarly description: {$aicDescription}";
        }

        $basePrompt .= "\nVisual analysis: " . json_encode($generatedDescription);

        return $basePrompt;
    }
}
