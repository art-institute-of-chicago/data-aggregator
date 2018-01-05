<?php

namespace App\Http\Transformers;

use Aic\Hub\Foundation\AbstractTransformer;

use App\ArchivalImage;

class ArchivalImageTransformer extends AbstractTransformer
{

    public function transform($image)
    {

        $data = [
            'id' => $image->id,
            'title' => $image->title,
            'alternate_title' => $image->alt_title,
            'web_url' => $image->web_url,
            'collection' => $image->collection_name,
            'archive' => $image->archive_name,
            'format' => $image->format,
            'file_format' => $image->file_format,
            'file_size' => $image->file_size,
            'pixel_dimensions' => $image->pixel_dimensions,
            'color' => $image->color,
            'physical_notes' => $image->physical_notes,
            'date' => $image->date_display,
            'date_object' => $image->date_of_object,
            'date_view' => $image->date_of_view,
            'creator' => $image->creator,
            'additional_creator' => $image->additional_creator,
            'photographer' => $image->photographer,
            'main_id' => $image->main_id,
            'legacy_image_id' => $image->legacy_image_id,
            'subject_terms' => $image->subject_terms,
            'view' => $image->view,
            'image_notes' => $image->image_notes,
            'file_name' => $image->file_name,
            'source_created_at' => $image->source_created_at->toIso8601String(),
            'source_modified_at' => $image->source_modified_at->toIso8601String(),
        ];

        // Enables ?fields= functionality
        return parent::transform($data);

    }

}