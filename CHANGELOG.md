Data Aggregator Changelog
=============================
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
