![Art Institute of Chicago](https://raw.githubusercontent.com/Art-Institute-of-Chicago/template/master/aic-logo.gif)

# Data Aggregator - Add a new data source

When adding new data sources to the Aggregator, the following steps should be taken.

### 1. Create database tables

Use a migration to create the tables. This way the application's schema is saved in version control,
and other developers can recreate the database environment easily:

```shell
php artisan make:migration create_source_tables
```

Replace `source` with the name of the source system you're working with. Your new file will be generated
in the [migrations](database/migrations) folder. In this file, add your create table commands using [Schema::create](https://laravel.com/docs/5.5/migrations#creating-tables).

### 2. Create a model

We store each source's models in a separate directory under [app/Models](app/Models)

### 3. Create a factory to generate fake data

We create a single [factory](database/factories) per source system, and define a factory for each model.

### 4. Create a seeder

Create a seeder for your model in the [seeds](database/seeds) folder. We organize all our seeders in subdirectories
by source system. Each source has a DatabaseSeeder that seeds all the tables for that source, and individual
TableSeeders for each resource. Once you create your seeders, add a reference to the source's DatabaseSeeder in
[DatabaseSeeder.php](database/seeds/DatabaseSeeder.php). In this file we group the calls to the source DatabaseSeeders,
to help organize what can easily be a long list of similar calls.

At this point you can recreate your database and seed it with fake data to see your new tables:

```shell
php artisan migrate --seed
```

This will run your new migration and seed the tables with fake data. After this point, if you make changes to your
migration you'll have to rerun it:

```shell
php artisan migrate:rollback
php artisan migrate --seed
```

Seeded data data doesn't interfere with real data. All seed data should generate IDs outside of the range of real data.
See [DscFactory.php](database/factories/DscFactory.php#L19) for an example. Other parts of the code rely on
[`$fakeIdsStartAt`](app/Models/BaseModel.php#L37) to differentiate fake data from real data.

### 5. Create unit tests

Now that you've got your data structured and some test data to play with, you can begin wiring together the API
calls to the data. First, create a set of [unit tests](test/Unit) for your new model. We generally test on things that
we want from our API. So we base out tests on HTTP requests, and make sure if we hit a particular URL, that our API
performs in particular ways. In [ApiTestCase.php](test/Unit/ApiTestCase.php), we've made it easy to test a lot of the
basic things, like whether you can retrieve a single resource, a list of all resources, multiple resources, and tests
for expected errors. Create the unit test file that extends this one, and add test for any unique behavior that your new
endpoints will provide.

### 6. Create a controller

It's probably easiest to copy an existing [controller](app/Http/Controller) as a starting point. Define the `$model`
that the new controller is responsible for serving, and `$transformer` it should use.

### 7. Create a transformer

Transformers take the model data and turns it into an array ready for output. Using the
[Fractal](http://fractal.thephpleague.com/) library, we've created a
[foundation](app/Http/Transformers/ApiTransformer.php) for all the transformations at the API level, and a
[Transformable trait](app/Models/Transformable.php) as a place for model-specific transformations. IDs, titles and dates
will be added automatically unless you exclude them by setting the `$excludeIdsAndTitle` or `$excludeDates` properties
to `false` in the transformer class. Create a Transformer class, then create a `transformMappingInternal()` function in
your model to return an array of the fields that are unique to your model.

### 8. Create routes for your endpoints

[Routes](https://laravel.com/docs/5.5/routing) are registered in [routes/api.php](routes/api.php).

### 9. Add new models to providers

Be sure to add your models to the [ResourceServiceProvider](app/Providers/ResourceServiceProvider) and, if the model
is searchable in Elasticsearch, the [SearchServiceProvider](app/Providers/SearchServiceProvider).

### 10. Make your tests pass

You can run the following to only test one set of unit tests:

```shell
phpunit --filter ResourceTest
```

Keep going until all your tests pass. You can use the following to run all tests:

```shell
phpunit
```

### 11. Add documentation

The model `transformMappingInternal()` function includes array elements for documenting the fields outputted in the API.
If you didn't add the documentation during that step, do it now. You can generate new documentation with the following
commands:

```shell
php artisan docs:endpoints
php artisan docs:fields
```

Markdown files will be generated in `storage/apps`. When these look good to release, copy them to the `docs` folder.

Also, add your new source data to our [Swagger](resource/views/swagger.blade.php)
documentation. This file is not parsed or generated at all. It contains one big JSON object that gets output as
swagger.json.

That's it!
