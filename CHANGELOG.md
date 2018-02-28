Data Aggregator Changelog
=============================

0.9 - Autocomplete, shop data and support for mobile app

* Fill in products and shop categories data from the museum shop
* Add unit tests to verify that the API is serving fields used by the mobile app
* Silent output on successful scheduled commands

AUTOCOMPLETE
* Refactor /autocomplete endpoint to simplify output
* Only provide boosted records as results
* Allow clients to specify which resources to include in the results
* Find matches for both sort titles and regular titles
* Allow for fuzzy matching on queries greater than 5 characters
* Account for articles, e.g., "the", "an" and "a"

ARTWORKS
* Remove committees from API output. We use the data to calculate other fields, but we don't have a use case from our clients to use this data directly.
* Rename ObjectType to ArtworkType, to match our naming conventions
* Add `fiscal_year` for use in Recent Acquisitions filter on website
* Add `sound_ids`, `video_ids`, `link_ids` and `text_ids` to artworks
* The following modifications have been made to the API schema:
  - `artwork_type_title` - Renamed from `object_type_title` to match the naming of this model
  - `artwork_type_id` - Renamed from `object_type_id` to match the naming of this model
  - `committee_titles` - Removed from the API
  - `sound_ids` - Added, unique identifiers of the audio about this work
  - `video_ids` - Added, unique identifiers of the videos about this work
  - `link_ids` - Added, unique identifiers of the links about this work
  - `text_ids` - Added, unique identifiers of the texts about this work
  - `style_titles` - Added, the names of all style terms related to this artwork
  - `classification_titles` - Added, the names of all classification terms related to this artwork
  - `subject_titles` - Added, the names of all subject terms related to this artwork

EXHIBITIONS
* Add hero images from existing marketing site
* Properly output `gallery_title`
* Properly import `gallery_id`
* Pull exhibition descriptions from existing website if we didn't already have one
* The following modifications have been made to the API schema:
  - `legacy_image_desktop_url` - Added, URL to the desktop hero image from the legacy marketing site
  - `legacy_image_mobile_url` - Added, URL to the mobile hero image from the legacy marketing site

AGENTS
* Fill in alternate names with real data
* The following modifications have been made to the API schema:
  - `sort_title` - Added, sortable name, typically with last name first
  - `agent_type_title` - Renamed from `agent_type` to match schema used by other models

TERMS
* Add search endpoint for terms at /terms/search

PRODUCTS
* The following modifications have been made to the API schema:
  - `title_sort` - Added, the sortable version of the name of this product
  - `title_display` - Removed, since we're not getting a title catered to display from the Shop API
  - `parent_id` - Added, unique identifier of this product's parent
  - `category_id` - Added, replaces the array of `category_ids` until we get cleaner data
  - `category_ids` - Removed, until we understand how to navigate this data from the shop API
  - `web_url` - Renamed from `link` to match schema used by other models
  - `external_sku` - Added, numeric product identification code of a machine-readable bar code, when the customer sku differs from our internal one
  - `image_url` - Renamed from `image` to match schema used by other models
  - `is_on_sale` - Removed, until we understand how to determine this from the shop API
  - `rating` - Removed, until the data is provided to from the shop API
  - `review_count` - Removed, until the data is provided to from the shop API
  - `item_sold` - Removed, until the data is provided to from the shop API
  - `inventory` - Added, number indicating how many items remain in our inventory
  - `sale_price` - Added, number indicating how much the product costs on sale to the customer
  - `member_price` - Added, number indicating how much the product costs members
  - `aic_collection` - Added, whether the item is an AIC product
  - `gift_box` - Added, whether the item can be wrapped in a gift box
  - `recipient` - Added, category indicating who the product is intended for. E.g., 'Anyone', 'ForHim', 'ForHer', etc.
  - `holiday` - Added, whether the product is a holiday item
  - `architecture` - Added, whether the product is an architectural item
  - `glass` - Added, whether the item is made of glass
  - `choking_hazard` - Added, whether this product is a choking hazard
  — `x_shipping_charge` - Added, number indicating the additional shipping charge for this item, in US Dollars.
  - `back_order` - Added, whether this product has been back ordered
  - `back_order_due_date` - Added, date representing when this item is expected to be back in stock
  - `artist_ids` - Added, unique identifiers of the artists represented in this item

SHOP CATEGORIES
* The following modifications have been made to the API schema:
  - `web_url` - Renamed from `link` to match schema used by other models
  - `type` - Removed, until the data is provided to from the shop API
  - `source_id` - Removed, until the data is provided to from the shop API


0.8 - Clean up for consistency, and further feature additions to support the website and mobile app

* Add `*_title` to all name-of fields for consistency
* Accept `q` and `query` in the same search request
* Boost artists, to provide better data to the "Featured result" option on the website. We're boosting all artists in the set of boosted artworks, along with the top 100 viewed artists on our website in 2017.
* Refactor departments to use departmental publish categories in CITI rather than our internal department structure.
* Add includes for `sites` to /agents, /artworks and /exhibitions
* Split /galleries and /places with a more reliable condition
* Remove deprecated `theme` model, which isn't output anywhere in the API
* Split /events up into /ticketed-events and /legacy-event endpoints, to make room for canonical events from the new website
* Remove /members endpoint
* Add `button_url`, `button_text` and `web_url` to /legacy-events
* Provide functionality to pass aggregation parameters to search endpoints
* Add multi search functionality to allow multiple queries to be sent in one request
* Make tours discoverable by the names of their tour stops
* Add `tour_ids` to `/tour-stops`
* Rename `/tours` include from `stops` to `tour-stops`

ARTWORKS ENDPOINT
* Fix output of `medium` field
* Properly fill in rights flags
* The following modifications have been made to the API schema:
  - `department_title` - Renamed from `department` to match schema used by other fields
  - `object_type_title` - Renamed from `object_type` to match schema used by other fields
  - `is_in_gallery` - Removed, in favor of `is_on_view` that accounts for gallery closures
  - `object_type_title` - Renamed from `object_type` to match schema used by other fields

VENUES ENDPOINT
* The following modifications have been made to the API schema:
  - `agent_title` - Renamed from `agent` to match schema used by other fields
  - `exhibition_title` - Renamed from `exhibition` to match schema used by other fields

AGENT PLACES ENDPOINT
* The following modifications have been made to the API schema:
  - `agent_title` - Renamed from `agent` to match schema used by other fields
  - `place_title` - Renamed from `place` to match schema used by other fields

ARTWORK CATALOGUES ENDPOINT
* The following modifications have been made to the API schema:
  - `artwork_title` - Renamed from `artwork` to match schema used by other fields
  - `catalogue_title` - Renamed from `catalogue` to match schema used by other fields

TOUR STOPS ENDPOINT
* The following modifications have been made to the API schema:
  - `artwork_title` - Renamed from `artwork` to match schema used by other fields

NEW ENDPOINTS
* Additionally, the following endpoints have been added to the API:
  - `/artworks/boosted` – Renamed from `/artworks/essentials`, which has been deprecated. This naming matches logic we released in 0.7 to create a common mechanism by which resources can provide boosted results.
  - `/agents/boosted` – We're now boosting artists in addition to artworks. This endpoint provides a view of just boosted artists.
  - `/legacy-events` and `/ticketed-events` – The `/events` endpoint has been split up into two separate endpoints, more clearly naming what data it's serving. `/legacy-events` are from the existing website for use by the mobile app. `/ticketed-events` are the small set of events in our ticketing system for use by the website CMS. These name changes also affect the resource names and endpoints for our search. After the website launches, `/legacy-events` will be deprecated and we'll work with the mobile team to make the transition. This change has been made to make room for a single, canonical list of events that will be provided by the new website.
  - The `/members` endpoint has been removed.

DEPRECATED SEARCH PARAMETERS
* As planned, the following search parameters have been removed from the API:
  - `type` – Replaced with `resources`. This parameter is no longer supported in later versions of Elasticsearch.
  - `_source` – Replaced with `fields`. This parameter duplicates functionality provided by `fields`.
  - `facets` - Replaced with `aggregations`. This parameter opens up built in Elasticsearch aggregation functionality to our API


0.7 - Add functionality to support website and mobile App development

* Add general import:all and import:daily commands to run imports from all sources
* Adjust task scheduling to make automatic imports function properly
* Enhance search, artworks and exhibitions to support website and mobile app, as follows:

SEARCH ENHANCEMENTS
* Avoid adjusting relevance if `sort` is set
* Adjust simple searches to only search specified fields
* Allow searching across multiple resources
* Add `is_boosted` field to search output, to help inform "Featured result"
* Generalize definition of is_boosted functionality across all resources
* Add ability to search resources that are subsets of others, like artists and galleries

ARTWORK ENDPOINT
* Restructure terms and catalogues raisonne to be a first-class resource rather than a list of strings
* Seed terms data with static production export
* Add catalogue raisonne data from LPM
* Add flags to indicate rights usage
* The following modifications have been made to the API schema:
  - `alt_titles` - Renamed from `alternative_titles` to match schema used by other fields
  - `is_zoomable` - Added, whether images of the work are allowed to be displayed in a zoomable interface.
  - `max_zoom_window_size` - Added, the maximum size of the window the image is allowed to be viewed in, in pixels.
  - `fiscal_year` - Added, the fiscal year in which the work was acquired.
  - `artist_ids` - Removed, in favor of two separate fields to specify a preferred artists and all others.
  - `artist_id` - Added, unique identifier of the preferred artist associated with the work
  - `alt_artist_ids` - Added, unique identifiers of the non-preferred artists/cultures associated with the work
  - `catalogue_titles` - Removed
  - `artwork_catalogue_ids` - Added, represents all the catalogues this work is included in. This isn't an exhaustive list of publications where the work has been mentioned. For that, see `publication_history`.
  - `style_id` - Added, unique identifier of the preferred style term for the work
  - `alt_style_ids` - Added, unique identifiers of all other non-preferred style terms for the work
  - `classification_id` - Added, unique identifier of the preferred classification term for the work
  - `alt_classification_ids` - Added, unique identifiers of all other non-preferred classification terms for the work
  - `subject_id` - Added, unique identifier of the preferred subject term for the work
  - `alt_subject_ids` - Added, unique identifiers of all other non-preferred subject terms for the work
  - `image_id` - Renamed from `preferred_image_id`
  - `image_iiif_url` - Renamed from `preferred_image_iiif_url`
  - `alt_image_ids` - Renamed from `image_ids` and refactored to omit the preferred image
  - `alt_image_iiif_urls` - Renamed from `image_iiif_urls` and refactored to omit the preferred image

EXHIBITIONS ENDPOINT
* Add new fields to support mobile app:
  - `short_description` - Brief explanation of what this exhibition is
  - `web_url` - URL to this exhibition on our website

NEW ENDPOINTS
* Additionally, the following endpoints have been added to the API:
  - `/terms` – Get a list of all terms. Includes all styles, classifications and subjects bundled together, differentiated by `type`.
  - `/terms/{id}` – Get a specific term with the given ID.
  - `/artwork/{id}/terms` – Get all the terms for an artwork.
  - `/catalogues` – Get a list of all catalogues raisonné that we know about.
  - `/catalogues/{id}` – Get a specific catalogue raisonné with the given ID.
  - `/artwork-catalogues` – Get all the pivot catalogues raisonné between artworks and catalogues. The pivot models include page numbers, state/edition, and whether this is the preferred catalogue for the artwork.
  - `/artwork-catalogues/{id}` – Get a specific pivot catalogue.
  - `/artworks/{id}/artwork-catalogues` – Get all the pivot catalogues for a given artwork.

NEW SEARCH PARAMETERS
* Additionally, the following parameters have been added to our search endpoints, with plans to deprecate some existing ones
  - `resources` – An array to identify the types of data to return. Options match the names of available endpoints. For example "artworks", "galleries", etc.
  - `type` – This parameter is no longer supported in later versions of Elasticsearch, so we plan to deprecate this in 0.8.
  - `fields` – An array of field names to return in your search results. Can be set to any field name that's returned in our API. Can also be set to `true` to return all fields, which is useful for debugging.
  - `_source` – This parameter duplicates functionality provided by `fields`, so we plan to deprecate this in 0.8.


0.6 - Fill in Collections data

* Upgrade to Laravel 5.5
* Clean up Fillable logic to reduce redundancy
* Add db:reset command to drop all tables
* Change all CITI IDs to signed integers in database, to account for low negative number IDs from CITI places
* Add `alternate_titles` field to API schema for artworks and agents

EXHIBITIONS ENDPOINT
* Add start dates and end dates:
  - aic_start_at - Date the exhibition opened at the Art Institute of Chicago
  - aic_end_at - Date the exhibition closed at the Art Institute of Chicago
  - start_at - Date the exhibition opened across multiple venues
  - end_at - Date the exhibition closed across multiple venues
* Remove array of images in favor of a single, preferred image:
  - image_id - Unique identifier of the image to use to represent this exhibition
  - image_iiif_url - IIIF URL of the image to use to represent this exhibition
* Add additional fields:
  - status - Whether the exhibition is open or closed
* Populate venues data, which fills in `venue_ids` and `/venues`, `/venues/{id}` and `/exhibitions/{id}/venues` endpoints
* Populate artworks data, which fills in `artwork_ids` and `/exhibitions/{id}/artworks` endpoint
* Show related artists via related Static Archive Sites
* Add `short_description` and `web_url` and import from existing website
* Fill in the gallery_id based on a string name (hotfix until more reliable data is available from LAKE)

PLACES ENDPOINT
* Create `/places` endpoints that act as parents to galleries. Add `/places` and `/places/{id}` endpoints
* Populate Agent Place data, which fills in `agents/{id}/places`, `/agent-places` and `/agent-places/{id}` endpoints
* Fill in gallery type with "AIC Gallery" for any gallery that is associated with an artwork (hotfix until more reliable data is available from LAKE)

ARTWORKS ENDPOINT
* Fill in the gallery_id based on a string name (hotfix until more reliable data is available from LAKE)
* Rename `gallery` to `gallery_title`
* Deprecate `is_in_gallery` in favor of `is_on_view`, which checks if the artwork is in a gallery, and that the gallery is open


0.5 - Library, Archives, dominant colors and improve search

* Add Etags to all API output
* Add dominant color information to all images
* Separate Elasticsearch index into separate indexes per resource, for future compatibility
* Refactor agents to store all in a single table, while still providing separate endpoints by type
* Tie Agents to their corresponding ULAN URIs
* Add ability to sort search results
* Abstract portions of code common between APIs into the `data-hub-foundation` package
* Add Library Terms and Materials data to the aggregator
* Add images from the Ryerson & Burnham Library Image Archive to the aggregator
* Add missing relationships to Artwork endpoint—DSC Sections, Mobile Tour Stops, dominant color of preferred image
* Add missing relationships to Artists endpoint—Artworks
* Add missing relationships to Exhibitions endpoint—Events


0.4 - Digital Catalogues, static sites and mobile

* Refactor artists endpoint to return all agents that are marked as a creator for an artwork
* Import real Digital Catalogue data
* Import static site archive data
* Import events from current website as production-quality sample data
* Add related exhibitions to events
* Add long and short description to events
* Clean up mobile tour API output
* Reduce duplication in transformer logic
* Reduce duplication in seeder logic
* Reduce duplication in Asset model logic
* Provide Faker as a service to all unit tests and factories


0.3 - Clean up:

* Import processes to remove duplicate relationships
* Seeding to create fake records with IDs out of the range of real data, so they can live side-by-side
* Update `db:seed` command to not truncate tables during seeding
* Create `db:cleanseed` command to delete seeded data
* Add types to field documentation
