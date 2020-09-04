<?php

namespace App\Transformers\Outbound\Archive;

use App\Transformers\Outbound\AbstractTransformer as BaseTransformer;

class ArchiveImage extends BaseTransformer
{

    protected function getFields()
    {
        return [
            'alternate_title' => [
                'doc' => 'Alternate name of this image',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'web_url' => [
                'doc' => 'URL to this image on the archives website',
                'type' => 'url',
                'elasticsearch' => 'keyword',
            ],
            'collection' => [
                'doc' => 'Name of the collection this image is a part of',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'archive' => [
                'doc' => 'Name of the archive within this collection this image is a part of',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'format' => [
                'doc' => 'Physical format of the photograph',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'file_format' => [
                'doc' => 'Format of the digital file',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'file_size' => [
                'doc' => 'Number representing the size of the file in bytes',
                'type' => 'number',
                'elasticsearch' => 'integer',
            ],
            'pixel_dimensions' => [
                'doc' => 'Dimensions of the digital image',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'color' => [
                'doc' => 'Color type. Values include Color, B&W and Toned',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'physical_notes' => [
                'doc' => 'Notes about the photograph',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'date' => [
                'doc' => 'Date of photograph',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'date_object' => [
                'doc' => 'Date the subject of the photograph was designed or built',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'date_view' => [
                'doc' => '',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'creator' => [
                'doc' => 'Name of the architect, designer or creator',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'additional_creator' => [
                'doc' => 'Name of an additional architect, designer or creator',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'photographer' => [
                'doc' => 'Name of person who took the photograph',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'main_id' => [
                'doc' => 'Unique identifier used by the Archives for this image',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'legacy_image_id' => [
                'doc' => 'Unique identifier used by Imaging for this image. Most of the these numbers of using their legacy ID schema.',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'subject_terms' => [
                'doc' => 'Array of subject terms this image is tagged with',
                'type' => 'array',
                'elasticsearch' => 'text',
            ],
            'view' => [
                'doc' => 'View of the object in the image',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'image_notes' => [
                'doc' => 'Image description',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'file_name' => [
                'doc' => 'Name of the digital image file',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
        ];
    }
}
