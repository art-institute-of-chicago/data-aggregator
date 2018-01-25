Data Aggregator Changelog
=============================

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
