<?php

namespace Tests\Contract;

use Tests\TestCase;

use App\Models\Collections\Artwork;

class ArtworkTest extends ContractTestCase
{

    protected $model = Artwork::class;

    /** @test
     * List of fields taken from https://docs.google.com/spreadsheets/d/1F8YkAb-xaAAfsuWtXmll84nthfsfbBnxm4yU3lX0uLY
     */
    public function it_fetches_fields_used_by_mobile() {
        $this->it_fetches_fields([
            'title',
            'gallery_title',
            'id',
            'main_reference_number',
            'artist_display',
            'credit_line',
            'date_display',
            'is_on_view',
            'date_start',
            'date_end',
            'copyright_notice',
            'gallery_id',
            'image_id',
        ]);
    }

    /** @test
     */
    public function it_fetches_fields_used_on_website_artwork_detail_page() {
        // includes ['artist_pivots', 'place_pivots', 'dates', 'catalogue_pivots']
        // $artist->title
        // thumbnail.url
        $this->it_fetches_fields([
            'id',
            'title',
            'alt_titles',
            'artist_id',
            'artist_title',
            'artist_display',
            'classification_id',
            'alt_classification_ids',
            'classification_titles',
            'color',
            'copyright_notice',
            'credit_line',
            'date_start',
            'date_end',
            'date_qualifier_title',
            'department_id',
            'department_title',
            'description',
            'dimensions',
            'gallery_id',
            'gallery_title',
            'fiscal_year_deaccession',
            'inscriptions',
            'is_on_view',
            'is_public_domain',
            'is_zoomable',
            'main_reference_number',
            'material_titles',
            'medium_display',
            'image_id',
            'alt_image_ids',
            'max_zoom_window_size',
            'place_of_origin',
            'style_id',
            'alt_style_ids',
            'style_titles',
            'subject_titles',
            'thumbnail',
        ],
        [
            'dates',
            'artist_pivots',
            'catalogue_pivots',
            'place_pivots',
        ]);
    }
}
