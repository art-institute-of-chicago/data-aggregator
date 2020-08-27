<?php

namespace App\Transformers\Outbound\Collections;

use League\Fractal\TransformerAbstract as BaseTransformer;

use App\Models\Collections\Artwork;
use App\Transformers\Outbound\Collections\Traits\IsCC0;

class ArtworkManifest extends BaseTransformer
{

    use IsCC0;

    protected $canvasSequence = 1;

    public function transform(Artwork $model)
    {
        $canvases = [];

        if ($model->image) {
            $canvases[] = $this->_createCanvasImage($model, $model->image);
        }
        if ($model->altImages) {
            foreach ($model->altImages as $image) {
                $canvases[] = $this->_createCanvasImage($model, $image);
            }
        }
        return [
            '@context' => 'http://iiif.io/api/presentation/2/context.json',
            '@id' => config('app.url') . '/api/v1/artworks/' . $model->citi_id . '/manifest.json',
            '@type' => 'sc:Manifest',
            'label' => $model->title,
            'description' => [
              [
                'value' => strip_tags($model->description),
                'language' => 'en'
              ]
            ],
            'metadata' => [
                [
                    'label' => 'Artist / Maker',
                    'value' => $model->artist_display,
                ],
                [
                    'label' => 'Medium',
                    'value' => $model->medium_display,
                ],
                [
                    'label' => 'Dimensions',
                    'value' => $model->dimensions,
                ],
                [
                    'label' => 'Object Number',
                    'value' => $model->main_id,
                ],
                [
                    'label' => 'Collection',
                    'value' => '<a href=\'' . config('app.url') . '/collection/\' target=\'_blank\'>Art Institute of Chicago</a>',
                ],
            ],
            'attribution' => ($model->copyright_notice ? $model->copyright_notice . ' ' : '') . 'Digital image courtesy of the Art Institute of Chicago.',
            'logo' => 'https://raw.githubusercontent.com/Art-Institute-of-Chicago/template/master/aic-logo.gif',
            'within' => config('app.url') . '/collection',
            'sequences' => [
                [
                    '@type' => 'sc:Sequence',
                    'canvases' => $canvases,
                ],
            ],
        ];
    }

    private function _createCanvasImage($model, $image) {
        $jsonData = \Cache::remember('info-json-'.$image->lake_guid, 86400, function () use ($image) {
            return @file_get_contents(config('app.url') . '/iiif/2/' . $image->lake_guid . '/info.json');
        });
        if (!$jsonData) {
            return;
        }
        $imageData = json_decode($jsonData);

        return [
            '@type' => 'sc:Canvas',
            '@id' => config('app.url') . '/api/v1/images/' . $image->lake_guid,
            'label' => "" . $this->canvasSequence++,
            'width' => $imageData->width,
            'height' => $imageData->height,
            'images' => [
                [
                    '@type' => 'oa:Annotation',
                    'motivation' => 'sc:painting',
                    'on' => config('app.url') . '/api/v1/images/' . $image->lake_guid,
                    'resource' => [
                        '@type' => 'dctypes:Image',
                        '@id' => config('app.url') . '/iiif/2/' . $image->lake_guid . '/full/full/0/default.jpg',
                        'width' => $imageData->width,
                        'height' => $imageData->height,
                        'service' => [
                            '@context' => 'http://iiif.io/api/image/2/context.json',
                            '@id' => config('app.url') . '/iiif/2/' . $image->lake_guid,
                            'profile' => 'http://iiif.io/api/image/2/level2.json'
                        ]
                    ]
                ]
            ]
        ];
    }
}
