<?php

namespace App\Transformers\Outbound\Collections;

use App\Transformers\Outbound\Collections\Asset as BaseTransformer;

class Image extends BaseTransformer
{

    protected function getAssetFields()
    {
        $imageFields = [
            'content' => [
                'doc' => 'Text of or URL to the contents of this asset',
                'type' => 'string',
                'elasticsearch' => [
                    'default' => true,
                ],
                'value' => function ($item) {
                    return $item->content ?? null;
                },
            ],
            'iiif_url' => [
                'doc' => 'IIIF URL of this image',
                'type' => 'url',
                'elasticsearch' => 'keyword',
            ],
            'width' => [
                'doc' => 'Native width of the image',
                'type' => 'number',
                'elasticsearch' => 'integer',
                'value' => function ($item) {
                    return $item->width ?? null;
                },
            ],
            'height' => [
                'doc' => 'Native height of the image',
                'type' => 'number',
                'elasticsearch' => 'integer',
                'value' => function ($item) {
                    return $item->height ?? null;
                },
            ],
            'lqip' => [
                'doc' => 'Low-quality image placeholder (LQIP). Currently a 5x5-constrained, base64-encoded GIF.',
                'type' => 'text',
                'elasticsearch' => [
                    'mapping' => [
                        'enabled' => false, // Exclude from indexing, retrievable via _source
                    ],
                ],
                'value' => function ($item) {
                    return $item->metadata->lqip ?? null;
                },
            ],
            'colorfulness' => [
                'doc' => 'Unbounded positive float representing an abstract measure of colorfulness.',
                'type' => 'float',
                'elasticsearch' => [
                    'mapping' => [
                        'type' => 'scaled_float',
                        'scaling_factor' => 10000,
                    ],
                ],
                'value' => function ($item) {
                    return $item->metadata->colorfulness ?? null;
                },
            ],
            'color' => [
                'doc' => 'Dominant color of this image in HSL',
                'type' => 'object',
                'elasticsearch' => [
                    'mapping' => [
                        'type' => 'object',
                        'properties' => [
                            'population' => ['type' => 'integer'],
                            'percentage' => ['type' => 'float'],
                            'h' => ['type' => 'integer'],
                            's' => ['type' => 'integer'],
                            'l' => ['type' => 'integer'],
                        ],
                    ],
                ],
                'value' => function ($item) {
                    return $item->metadata->color ?? null;
                },
            ],
            'fingerprint' => [
                'doc' => 'Image hashes: aHash, dHash, pHash, wHash',
                'type' => 'object',
                'elasticsearch' => [
                    'mapping' => [
                        'type' => 'object',
                        'properties' => [
                            'ahash' => ['type' => 'keyword'],
                            'dhash' => ['type' => 'keyword'],
                            'phash' => ['type' => 'keyword'],
                            'whash' => ['type' => 'keyword'],
                        ],
                    ],
                ],
                'value' => function ($item) {
                    return array_filter([
                        'ahash' => $item->metadata->ahash ?? null,
                        'dhash' => $item->metadata->dhash ?? null,
                        'phash' => $item->metadata->phash ?? null,
                        'whash' => $item->metadata->whash ?? null,
                    ]) ?: null;
                },
            ],
        ];

        return array_merge(
            $imageFields,
            $this->getHashField('ahash'),
            $this->getHashField('phash'),
            $this->getHashField('whash'),
            $this->getHashField('dhash'),
        );
    }

    private function getHashField(string $hashName): array
    {
        $properties = collect()
            ->range(0, 63)
            ->map(fn ($i) => [
                'hash_' . $i => ['type' => 'boolean'],
            ])
            ->collapse()
            ->all();

        return [
            $hashName => [
                'doc' => 'Image hash generated using ' . $hashName . ' algorithm with 64 boolean subfields',
                'type' => 'object',
                'elasticsearch' => [
                    'mapping' => [
                        'type' => 'object',
                        'properties' => $properties,
                    ],
                ],
                'value' => function ($item) use ($hashName) {
                    if (empty($item->metadata->{$hashName})) {
                        return;
                    }

                    $hashes = hexToBoolArray($item->metadata->{$hashName});

                    try {
                        $values = collect()
                            ->range(0, 63)
                            ->map(fn ($i) => [
                                'hash_' . $i => $hashes[$i]
                            ])
                            ->collapse()
                            ->all();
                    } catch (\Throwable $e) {
                        // IMG-59: Undefined array key 30
                        return;
                    }

                    return (object) $values;
                },
            ]
        ];
    }
}
