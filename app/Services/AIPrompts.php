<?php

namespace App\Services;

class AIPrompts
{
    public static function getAltTextPrompt(string $type = 'standard'): string
    {
        return match ($type) {
            'editorial' => 'Analyze this image following accessibility best practices. Please provide it in a short 2-4 sentence paragraph following these practices:

                              Consider:
                                - Focusing purely on subject matter and not the composition or techniques of the image.
                                - Structure the description by spatial order (top-to-bottom, left-to-right, or foreground-to-background as appropriate). Use common language without art-historical jargon.
                                - Subject matter in each region
                                - Colors using familiar names (red, blue, yellow, etc.)
                                - Spatial relationships and orientation
                                - Size and scale of elements
                                - Stating if there are multiple images in the composition and comparing them

                              Avoid:
                                - Describing objects or features that are not clearly discernable
                                - Assuming the material of the image and techniques
                                - Using interpretive statements like "suggests" or "indicating"
                                - Starting with statements like "the image", "the painting", "the artwork", "the drawing"
                                - Including statements on subjects if none are present

                              If people are present, describe:
                                - Physical features that are immediately noticeable
                                - Age using simple terms (child, youth, adult, older person)
                                - Skin tone if clearly visible (light, medium-light, medium, medium-dark, dark)
                                - Avoid gender assumptions unless clearly performed/verifiable
                                - Named individuals if recognizable

                                Focus on observable information, not interpretation. Describe what can be seen, not what it might mean. If an aspect is not present do not mention it in your analysis',

            default => 'Analyze this image following accessibility best practices. Please provide it in a single sentence of not more than 300 characters following these:

                              Consider:
                                - Identify the medium when possible (a black-and-white photograph, a painting, a drawing, etc.)
                                - Start with a holistic description of the image and its overall subject matter. If there is a particularly dominant element, name and place that before moving spatially from left to right.
                                - When placing items spatially, use "at left," "at top right," "at center," etc.
                                - Use common language without art-historical jargon
                                - Identify colors using familiar names (red, blue, yellow, etc.)
                                - Describe spatial relationships
                                - Use full sentences with all necessary words; do not ellide or use shorthand.

                              Avoid:
                                - Describing objects or features that are not clearly discernable
                                - Using interpretive statements like "suggests" or "indicating"
                                - Including statements on subjects if none are present

                              If people are present, describe:
                                - Physical features that are immediately noticeable
                                - Age using simple terms (child, youth, adult, older person)
                                - Skin tone if clearly visible (light, medium-light, medium, medium-dark, dark
                                - Named individuals if recognizable

                                Focus on observable information, not interpretation. Describe what can be seen, not what it might mean. If an aspect is not present, do not mention it in your analysis.'
        };
    }
}
