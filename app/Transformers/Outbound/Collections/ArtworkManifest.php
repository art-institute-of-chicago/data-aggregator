<?php

namespace App\Transformers\Outbound\Collections;

use League\Fractal\TransformerAbstract as BaseTransformer;

use App\Models\Collections\Artwork;
use App\Models\Collections\Asset;
use App\Transformers\Outbound\Collections\Traits\IsCC0;

class ArtworkManifest extends BaseTransformer
{

    use IsCC0;

    public function transform(Artwork $model)
    {
        $canvases = [];

        foreach ($model->images as $image) {
            $canvases[] = $this->_createCanvasImage($model, $image);
        }

        return [
            '@context' => 'http://iiif.io/api/presentation/2/context.json',
            '@id' => config('app.url') . '/api/v1/artworks/' . $model->id . '/manifest.json',
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
                    'value' => '<a href=\'' . config('aic.config_documentation.website_url') . '/collection\' target=\'_blank\'>Art Institute of Chicago</a>',
                ],
            ],
            'attribution' => ($model->copyright_notice ? $model->copyright_notice . ' ' : '') . 'Digital image courtesy of the Art Institute of Chicago.',
            'logo' => 'https://raw.githubusercontent.com/Art-Institute-of-Chicago/template/master/aic-logo.gif',
            'within' => config('aic.config_documentation.website_url') . '/collection',
            'rendering' => [
                '@id' => config('aic.config_documentation.website_url') . '/artworks/' . $model->id,
                'format' => 'text/html',
                'label' => 'Full record'
            ],
            'sequences' => [
                [
                    '@type' => 'sc:Sequence',
                    'canvases' => $canvases,
                ],
            ],
        ];
    }

    private function _createCanvasImage($model, $image)
    {
        $imageUuid = Asset::getHashedId($image->id);

        // TODO: Should this be 1686 for public domain?
        if (isset($image->width) && isset($image->height)) {
            $width = 843;
            $height = round(843 / $image->width * $image->height);
        } else {
            $width = null;
            $height = null;
        }

        $full = '843,';

        return [
            '@type' => 'sc:Canvas',
            '@id' => config('aic.config_documentation.iiif_url') . '/' . $imageUuid,
            'label' => strip_tags($model->title . ', ' . $model->date_display . '. ' . str_replace("\n", ', ', $model->artist_display)),
            'width' => $width,
            'height' => $height,
            'images' => [
                [
                    '@type' => 'oa:Annotation',
                    'motivation' => 'sc:painting',
                    'on' => config('aic.config_documentation.iiif_url') . '/' . $imageUuid,
                    'resource' => [
                        '@type' => 'dctypes:Image',
                        '@id' => config('aic.config_documentation.iiif_url') . '/' . $imageUuid . '/full/' . $full . '/0/default.jpg',
                        'width' => $width,
                        'height' => $height,
                        'service' => [
                            '@context' => 'http://iiif.io/api/image/2/context.json',
                            '@id' => config('aic.config_documentation.iiif_url') . '/' . $imageUuid,
                            'profile' => 'http://iiif.io/api/image/2/level2.json'
                        ]
                    ]
                ]
            ]
        ];
    }
}
