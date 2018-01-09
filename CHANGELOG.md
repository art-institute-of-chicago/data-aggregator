Data Aggregator Changelog
=============================
0.5 - Library, Archives, dominiant colors and improve search

	* Add Etags to all API output
	* Add dominant color information to all images
	* Separate Elasticsearch index into separate indexes per resource, for future compatability
	* Refactor agents to store all in a single table, while still providing separate endpoints by type
	* Tie Agents to their coresponding ULAN URIs
	* Add ability to sort search results
	* Abstract portions of code common between APIs into the `data-hub-foundation` package
	* Add Library Terms and Materials data to the aggregator
	* Add images from the Ryerson & Burnham Library Image Archive to the aggregator
	* Add missing relationships to Artwork endpoint—DSC Sections, Mobile Tour Stops, domoniant color of prefered image
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
