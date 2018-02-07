<?php

namespace App\Presenters\Collections;

use App\Presenters\BasePresenter;

class Artwork extends BasePresenter
{

    /**
     * Name of the resource
     *
     * @type string
     */
    public function title()
    {

        return $this->entity->title;

    }

    /**
     * Alternate names for this work
     *
     * @type array
     */
    public function alt_titles()
    {

        return [];

    }

    /**
     * Unique identifier assigned to the artwork upon acquisition
     *
     * @type string
     */
    public function main_reference_number()
    {

        return $this->entity->main_id;

    }

    /**
     * The year of the period of time associated with the creation of this work
     *
     * @type number
     */
    public function date_start()
    {

        return $this->entity->date_start;

    }

    /**
     * The year of the period of time associated with the creation of this work
     *
     * @type number
     */
    public function date_end()
    {

        return $this->entity->date_end;

    }

    /**
     * Readable, free-text description of the period of time associated with the creation of this work. This might
     * include date terms like Dynasty, Era etc. Written by curators and editors in house style, and is the preferred
     * field for display on websites and apps.
     *
     * @type string
     */
    public function date_display()
    {

        return $this->entity->date_display;

    }

    /**
     * Longer explanation describing the work
     *
     * @type string
     */
    public function description()
    {

        return $this->entity->description;

    }

    /**
     * Readable description of the creator of this work. Includes artist names, nationality and lifespan dates
     *
     * @type string
     */
    public function artist_display()
    {

        return $this->entity->artist_display;

    }

    /**
     * Name of the curatorial department that this work belongs to
     *
     * @type string
     */
    public function department()
    {

        return $this->entity->department ? $this->entity->department->title : NULL;

    }

    /**
     * Unique identifier of the curatorial department that this work belongs to
     *
     * @type number
     */
    public function department_id()
    {

        return $this->entity->department ? $this->entity->department->citi_id : NULL;

    }

    /**
     * The size, shape, scale, and dimensions of the work. May include multiple dimension like overall, frame, or
     * dimension for each section of a work. Free-form text formatted in a house style.
     *
     * @type string
     */
    public function dimensions()
    {

        return $this->entity->dimensions;

    }

    /**
     * The substances or materials used in the creation of a work
     *
     * @type string
     */
    public function medium()
    {

        return $this->entity->medium_display;

    }

    /**
     * A description of distinguishing or identifying physical markings that are on the work
     *
     * @type string
     */
    public function inscriptions()
    {

        return $this->entity->inscriptions;

    }

    /**
     * The kind of object or work, e.g., Painting, Sculpture, Book, etc.
     *
     * @type string
     */
    public function object_type()
    {

        return $this->entity->objectType ? $this->entity->objectType->title : NULL;

    }

    /**
     * Unique identifier of the kind of object or work
     *
     * @type number
     */
    public function object_type_id()
    {

        return $this->entity->objectType ? $this->entity->objectType->citi_id : NULL;

    }

    /**
     * Brief statement indicating how the work came into the collection
     *
     * @type string
     */
    public function credit_line()
    {

        return $this->entity->credit_line;

    }

    /**
     * Bibliographic list of all the places this work has been published
     *
     * @type string
     */
    public function publication_history()
    {

        return $this->entity->publication_history;

    }

    /**
     * List of all the places this work has been exhibited
     *
     * @type string
     */
    public function exhibition_history()
    {

        return $this->entity->exhibition_history;

    }

    /**
     * Ownership/collecting history of the work. May include names of owners, dates, and possibly methods of transfer of
     * ownership. Free-form text formatted in a house style.
     *
     * @type string
     */
    public function provenance_text()
    {

        return $this->entity->provenance;

    }

    /**
     * Indicator of how much metadata on the work in published. Web Basic is the least amount, Web Everything is the
     * greatest.
     *
     * @type string
     */
    public function publishing_verification_level()
    {

        return $this->entity->publishing_verification_level;

    }

    /**
     * Whether the work is in the public domain, meaning it was created before copyrights existed or has left the copyright term
     *
     * @type boolean
     */
    public function is_public_domain()
    {

        return (bool) $this->entity->is_public_domain;

    }

    /**
     * Whether images of the work are allowed to be displayed in a zoomable interface.
     *
     * @type boolean
     */
    public function is_zoomable()
    {

        return (bool) $this->entity->is_zoomable;

    }

    /**
     * The maximum size of the window the image is allowed to be viewed in, in pixels.
     *
     * @type number
     */
    public function max_zoom_window_size()
    {

        return $this->entity->max_zoom_window_size;

    }

    /**
     * Statement notifying how the work is protected by copyright. Applies to the work itself, not image or other
     * related assets.
     *
     * @type number
     */
    public function copyright_notice()
    {

        return $this->entity->copyright_notice;

    }

    /**
     * The fiscal year in which the work was acquired.
     *
     * @type number
     */
    public function fiscal_year()
    {

        return null;

    }

    /**
     * The location where the creation, design, or production of the work took place, or the original location of the work
     *
     * @type string
     */
    public function place_of_origin()
    {

        return $this->entity->place_of_origin;

    }

    /**
     * The works status of belonging to our collection. Values include 'Permanent Collection', 'Ryerson Collection', and
     * 'Long-term Loan'.
     *
     * @type string
     */
    public function collection_status()
    {

        return $this->entity->collection_status;

    }

    /**
     * The location of this work in our museum
     *
     * @type string
     */
    public function gallery_title()
    {

        return $this->entity->gallery ? $this->entity->gallery->title : null;

    }

    /**
     * Unique identifier of the location of this work in our museum
     *
     * @type number
     */
    public function gallery_id()
    {

        return $this->entity->gallery ? $this->entity->gallery->citi_id : null;

    }

    /**
     * [DEPRECATED] Whether the work is on display
     *
     * @type boolean
     */
    public function is_in_gallery()
    {

        return $this->entity->gallery && !$this->entity->gallery->closed ? true : false;

    }

    /**
     * Whether the work is on display
     *
     * @type boolean
     */
    public function is_on_view()
    {

        return $this->entity->gallery && !$this->entity->gallery->closed ? true : false;

    }

    /**
     * Latitude coordinate of the location of this work in our galleries
     *
     * @type number
     */
    public function latitude()
    {

        return $this->entity->mobileArtwork ? $this->entity->mobileArtwork->latitude : NULL;

    }

    /**
     * Longitude coordinate of the location of this work in our galleries
     *
     * @type number
     */
    public function longitude()
    {

        return $this->entity->mobileArtwork ? $this->entity->mobileArtwork->longitude : NULL;

    }

    /**
     * Latitude and longitude coordinates of the location of this work in our galleries
     *
     * @type string
     */
    public function latlon()
    {

        return $this->entity->mobileArtwork ? ($this->entity->mobileArtwork->latitude .',' .$this->entity->mobileArtwork->longitude) : NULL;

    }

    /**
     * Whether the work is highlighted in the mobile app
     *
     * @type boolean
     */
    public function is_highlighted_in_mobile()
    {

        return (bool) $this->entity->mobileArtwork ? $this->entity->mobileArtwork->highlighted : false;

    }

    /**
     * The code that can be entered in our audioguides to learn more about this work
     *
     * @type number
     */
    public function selector_number()
    {

        return $this->entity->mobileArtwork ? $this->entity->mobileArtwork->selector_number : NULL;

    }

    /**
     * Unique identifier of the preferred artist/culture associated with this work
     *
     * @type number
     */
    public function artist_id()
    {

        return $this->entity->artists->pluck('citi_id')->first();

    }

    /**
     * Unique identifiers of the non-preferred artists/cultures associated with this work
     *
     * @type array
     */
    public function alt_artist_ids()
    {

        return $this->entity->artists->pluck('citi_id')->all();

    }

    /**
     * Unique identifiers of the categories this work is a part of
     *
     * @type array
     */
    public function category_ids()
    {

        return $this->entity->categories->pluck('citi_id')->all();

    }

    /**
     * Unique identifiers of the copyright representatives associated with this work
     *
     * @type array
     */
    public function copyright_representative_ids()
    {

        return $this->entity->copyrightRepresentatives->pluck('citi_id')->all();

    }

    /**
     * Unique identifiers of the individual works that make up this work
     *
     * @type array
     */
    public function part_ids()
    {

        return $this->entity->parts->pluck('citi_id')->all();

    }

    /**
     * Unique identifiers of the sets this work is a part of. These are not artwork ids.
     *
     * @type array
     */
    public function set_ids()
    {

        return $this->entity->sets->pluck('citi_id')->all();

    }

    /**
     * List of all the dates associated with this work. Includes creation dates, and may also include publication dates
     * for works on paper, exhibition dates for provenance, found dates for archaeological finds, etc.
     *
     * @type array
     */
    public function date_dates()
    {

        return $this->entity->dates()->pluck('date')->transform(function ($item, $key) {
            return $item->toIso8601String();
        })->all();

    }

    /**
     * This list represents all the catalogues this work is included in. This isn't an exhaustive list of publications
     * where the work has been mentioned. For that, see `publication_history`.
     *
     * @type array
     */
    public function artwork_catalogue_ids()
    {

        return $this->entity->artworkCatalogues->pluck('citi_id')->all();

    }

    /**
     * List of committees which were involved in the acquisition or deaccession of this work
     *
     * @type array
     */
    public function committee_titles()
    {

        return $this->entity->committees->pluck('committee')->all();

    }

    /**
     * The names of the taxonomy tags for this work
     *
     * @type array
     */
    public function term_titles()
    {

        return $this->entity->terms->pluck('title')->all();

    }

    /**
     * Unique identifier of the preferred style term for this work
     *
     * @type number
     */
    public function style_id()
    {

        return $this->entity->styles->where('pivot.preferred', true)->pluck('citi_id')->first();

    }

    /**
     * Unique identifiers of all other non-preferred style terms for this work
     *
     * @type array
     */
    public function alt_style_ids()
    {

        return $this->entity->styles->where('pivot.preferred', false)->pluck('citi_id')->all();

    }

    /**
     * Unique identifier of the preferred classification term for this work
     *
     * @type number
     */
    public function classification_id()
    {

        return $this->entity->classifications->where('pivot.preferred', true)->pluck('citi_id')->first();

    }

    /**
     * Unique identifiers of all other non-preferred classification terms for this work
     *
     * @type array
     */
    public function alt_classification_ids()
    {

        return $this->entity->classifications->where('pivot.preferred', false)->pluck('citi_id')->all();

    }

    /**
     * Unique identifier of the preferred subject term for this work
     *
     * @type number
     */
    public function subject_id()
    {

        return $this->entity->subjects->where('pivot.preferred', true)->pluck('citi_id')->first();

    }

    /**
     * Unique identifiers of all other non-preferred subject terms for this work
     *
     * @type array
     */
    public function alt_subject_ids()
    {

        return $this->entity->subjects->where('pivot.preferred', false)->pluck('citi_id')->all();

    }

    /**
     * Dominant color of this image in HSL
     *
     * @type object
     */
    public function color()
    {

        $preferred_image = $this->entity->images()->wherePivot('preferred','=',true)->get()->first();
        return ($preferred_image && $preferred_image->metadata && $preferred_image->metadata->color ? $preferred_image->metadata->color : null);


    }

    /**
     * Unique identifier of the preferred image to use to represent this work
     *
     * @type uuid
     */
    public function image_id()
    {

        $preferred_image = $this->entity->images()->wherePivot('preferred','=',true)->get()->first();
        return $preferred_image ? $preferred_image->lake_guid : null;

    }

    /**
     * IIIF URL of the preferred image to use to represent this work
     *
     * @type string
     */
    public function image_iiif_url()
    {

        $preferred_image = $this->entity->images()->wherePivot('preferred','=',true)->get()->first();
        return $preferred_image ? $preferred_image->iiif_url : null;

    }

    /**
     * Unique identifiers of all non-preferred images of this work. The order of this list will not correspond to the
     * order of `image_iiif_urls`.
     *
     * @type array
     */
    public function alt_image_ids()
    {

        $alt_images = $this->entity->images()->wherePivot('preferred','=',false)->get()->all();
        return $alt_images ? $alt_images->pluck('lake_guid')->all() : null;

    }

    /**
     * IIIF URLs of all the images of this work. The order of this list will not correspond to the order of `image_ids`.
     *
     * @type array
     */
    public function alt_image_iiif_urls()
    {

        $alt_images = $this->entity->images()->wherePivot('preferred','=',false)->get()->all();
        return $alt_images ? $alt_images->pluck('iiif_url')->all() : null;

    }

    /**
     * Unique identifiers of the tour stops this work is included in
     *
     * @type array
     */
    public function tour_stop_ids()
    {

        return $this->entity->mobileArtwork ? ( $this->entity->mobileArtwork->stops->pluck('id')->all() ) : [];

    }

    /**
     * Unique identifiers of the digital publication chaptes this work in included in
     *
     * @type array
     */
    public function section_ids()
    {

        return $this->entity->sections->pluck('dsc_id')->all();

    }

    /**
     * Unique identifiers of the microsites this work is a part of
     *
     * @type array
     */
    public function site_ids()
    {

        return $this->entity->sites->pluck('site_id')->all();

    }

}
