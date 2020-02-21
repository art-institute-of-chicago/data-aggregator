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
     * The following tests determin which fields are used on the website by:
     * * On the website, set `API_LOGGER=true` in `.env`
     * * Access a page and watch the log
     * * After the page is done loading, the log will dump all the fields requests for each API model
     */
    public function it_fetches_fields_used_on_website_home_page() {
        $this->it_fetches_fields([
            'id',
            'title',
            'image_id',
            'main_reference_number',
            'thumbnail',
        ],
        [
            'artist_pivots',
        ]);
    }

    /** @test */
    public function it_fetches_fields_used_on_website_collection_landing_page() {
        $this->it_fetches_fields([
            'main_reference_number',
            'image_id',
            'title',
            'thumbnail',
            'id',
            'artist_title',
        ]);
    }

    /** @test */
    public function it_fetches_fields_used_on_website_artwork_detail_page() {
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

    /** @test */
    public function it_fetches_fields_used_on_website_artist_detail_page() {
        $this->it_fetches_fields([
            'id',
            'image_id',
            'main_reference_number',
            'title',
            'thumbnail',
            'artist_title',
        ],
        [
            'artist_pivots',
        ]);
    }

    /** @test */
    public function it_fetches_fields_used_on_website_article_page_with_artwork_block_and_gallery() {
        $this->it_fetches_fields([
            'image_id',
            'main_reference_number',
            'title',
            'thumbnail',
            'is_on_view',
            'artist_title',
            'id',
            'is_zoomable',
            'is_public_domain',
            'max_zoom_window_size',
        ]);
    }
}
