Data Aggregator Changelog
=============================

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
