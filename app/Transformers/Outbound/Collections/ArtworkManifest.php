<?php

namespace App\Transformers\Outbound\Collections;

use League\Fractal\TransformerAbstract as BaseTransformer;

use App\Models\Collections\Artwork;
use App\Transformers\Outbound\Collections\Traits\IsCC0;

class ArtworkManifest extends BaseTransformer
{

    use IsCC0;

    public function transform(Artwork $model)
    {
        $canvases = [];

        if ($model->image) {
            $canvases[] = [
                '@type' => 'sc:Canvas',
                '@id' => config('app.url') . '/api/v1/images/' . $model->image->lake_guid,
                'label' => $model->title,
                //'width' => 1830,
                //'height' => 1200,
                'images' => [
                    [
                        '@type' => 'oa:Annotation',
                        'motivation' => 'sc:painting',
                        'on' => config('app.url') . '/api/v1/images/' . $model->image->lake_guid,
                        'resource' => [
                            '@type' => 'dctypes:Image',
                            '@id' => 'https://www.artic.edu/iiif/2/' . $model->image->lake_guid . '/full/full/0/default.jpg',
                            //'width' => 1830,
                            //'height' => 1200,
                            'service' => [
                                '@context' => 'http://iiif.io/api/image/2/context.json',
                                '@id' => 'https://www.artic.edu/iiif/2/' . $model->image->lake_guid,
                                'profile' => 'http://iiif.io/api/image/2/level2.json'
                            ]
                        ]
                    ]
                ]
            ];
        }
        if ($model->altImages) {
            foreach ($model->altImages as $image) {
                $canvases[] = [
                    '@type' => 'sc:Canvas',
                    '@id' => config('app.url') . '/api/v1/images/' . $image->lake_guid,
                    'label' => $model->title,
                    //'width' => 1830,
                    //'height' => 1200,
                    'images' => [
                        [
                            '@type' => 'oa:Annotation',
                            'motivation' => 'sc:painting',
                            'on' => config('app.url') . '/api/v1/images/' . $image->lake_guid,
                            'resource' => [
                                '@type' => 'dctypes:Image',
                                '@id' => 'https://www.artic.edu/iiif/2/' . $image->lake_guid . '/full/full/0/default.jpg',
                                //'width' => 1830,
                                //'height' => 1200,
                                'service' => [
                                    '@context' => 'http://iiif.io/api/image/2/context.json',
                                    '@id' => 'https://www.artic.edu/iiif/2/' . $image->lake_guid,
                                    'profile' => 'http://iiif.io/api/image/2/level2.json'
                                ]
                            ]
                        ]
                    ]
                ];
            }
        }
        return [
            '@context' => 'http://iiif.io/api/presentation/2/context.json',
            '@id' => config('app.url') . '/api/v1/artworks/' . $model->citi_id,
            '@type' => 'sc:Manifest',
            'label' => $model->title,
            'metadata' => [],
            'description' => [
              [
                'value' => $model->description,
                'language' => 'en'
              ]
            ],
            'attribution' => $this->getLicenseText(),
            'sequences' => [
                [
                    '@type' => 'sc:Sequence',
                    'canvases' => $canvases,
                ],
            ],
        ];
    }

}
