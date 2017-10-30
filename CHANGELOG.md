Data Aggregator Changelog
=============================
0.3 - Clean up:

* Import processes to remove duplicate relatioships
* Seeding to create fake records with IDs out of the range of real data, so they can live side-by-side
* Update `db:seed` command to not trunate tables during seeding
* Create `db:cleanseed` command to delete seeded data
* Add types to field documentation
