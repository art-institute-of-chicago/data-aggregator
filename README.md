![Art Institute of Chicago](https://raw.githubusercontent.com/Art-Institute-of-Chicago/template/master/aic-logo.gif)

# Data Aggregator
> A central location of data collected from several different systems and offered up through an API

The Data Aggregator is part of a large internal project to consolidate data across many disparate systems
at the Art Institute of Chicago into a single, unified source. This offers our products a rich set of 
data that can be accessed in one way, in one location. 


## Features

* All data available via a JSON-based REST API
* Large lists are paginated
* Complex data types can be "included" in requests
* Seed data provided for all resources
* Unit tests for all endpoints


## Overview

The Data Aggregator interfaces with several internal APIs to collect its data.


## Requirements

The project has been built in Laravel, and includes the following requirements:

* Laravel 5.4
* PHP 7.0 (may work in earlier versions but hasn't been tested)
* MySQL 5.7 (may work in earlier versions but hasn't been tested)
* [Composer](https://getcomposer.org/)


## Installing

To get started with this project, use the following commands:

```shell
# Clone the repo to your computer
git clone https://github.com/art-institute-of-chicago/data-aggregator.git

# Enter the folder that was created by the clone
cd data-aggregator

# Install PHP dependencies
composer install
```


## Developing

First you'll need to create a `.env` file and update it to reflect your environment. We've provided an 
example file to get you started:

```shell
# Copy the example file
cp .env.example .env

# Generate a new key for your Laravel project
php artisan key:generate
```

Then, to create the database tables and seed them with fake data, run:

```shell
php artisan migrate --seed
```

This will create all the tables and relationships, and fill the tables with data from the 
[Faker](https://github.com/fzaninotto/Faker) PHP library.


### Adding new data sources

When adding new data sources to the Aggregator, the following steps should be taken.

#### 1. Create database tables

You can use a migration to create the tables. This way the application's schema is saved in version control,
and other developers can recreate the database environment easily:

```shell
php artisan make:migration create_source_tables
```

Replace `source` with the name of the source system you're working with. Your new file will be generated
in the [migrations](database/migrations) folder. In this file, add your create table commands using [Schema::create](https://laravel.com/docs/5.4/migrations#creating-tables).

#### 2. Create a factory to generate fake data

We create a single [factory](database/factories) per source system, and define a factory for each model.

#### 3. Create a model

We store each source's models in a separate directory under [app](app)

#### 4. Create a seeder

Create a seeder for your model in the [seeds](database/seeds) folder. We organize all our seeders in subdirectories
by source system. Once you create your seeder, add references to it in [DatabaseSeeder.php](database/seeds/DatabaseSeeder.php). 
In this file we group the calls to the individual seeders by source system, to help organize what can easily
be a long list of similar calls.

At this point you can recreate your database and seed it with fake data to see your new tables:

```shell
php artisan migrate --seed
```

This will run your new migration and seed the tables with fake data. After this point, if you make changes to your migration 
you'll have to rerun all your migrations:

```shell
php artisan migrate:refresh --seed
```

Be aware that if you've imported real data into into any of your tables they will be truncated and replaced with fake data.

#### 5. Create unit tests

Now that you've got your data structured and some test data to play with, you can begin wiring together the API
calls to the data. First, create a set of [unit tests](test/Unit) for your new model. At a basic level, test whether you can 
retrieve a single resource, a list of all resources, multiple resources, and test for expected errors. Create 
the tests now. It's super-satisfying to see your tests pass when you're done with these steps!

#### 6. Create a controller

It's probably easiest to copy an existing [controller](app/Http/Controller) as a starting point.

#### 7. Create a transformer

Transformers take the model data and turns it into an array ready for output. Using the [Fractal](http://fractal.thephpleague.com/)
library, we've created a [foundation](app/Http/Transformers/ApiTransformer.php) to make creating transformers in the Aggregator
fairly straightforward. Ids, titles and dates will be added automatically unless you exclude them by setting the `$excludeIdsAndTitle`
or `$excludeDates` properties to `false`. Then create a `transformFields` function to return an array of the fields 
that are unique to your model.

#### 8. Create routes for your endpoints

[Routes](https://laravel.com/docs/5.4/routing) are registered in [routes/api.php](routes/api.php).

#### 9. Make your tests pass

You can run the following to only test one set of unit tests:

```shell
phpunit --filter ResourceTest
```

Keep going until all your tests pass. You can use the following to run all tests:

```shell
phpunit
```

#### 10. Add Swagger documentation

Add your new source data to our [Swagger](resource/views/swagger.blade.php) documentation. This file is not parsed or generated at all.
It contains one big JSON object that gets output as swagger.json.

That's it!


## Contributing

We encourage your contributions. Please fork this repository and make your changes in a separate branch. 
We like to use [git-flow](https://github.com/nvie/gitflow) to make this process easier.

```bash
# Clone the repo to your computer
git clone git@github.com:your-github-account/data-aggregator.git

# Enter the folder that was created by the clone
cd data-aggregator

# Install PHP dependencies
composer install

# Start a feature branch
git flow start feature yourinitials-good-description-issuenumberifapplicable

# ... make some changes, commit your code

# Push your branch to GitHub
git push origin yourinitials-good-description-issuenumberifapplicable
```

Then on github.com, create a Pull Request to merge your changes into our 
`develop` branch. 

This project is released with a Contributor Code of Conduct. By participating in 
this project you agree to abide by its [terms](CODE_OF_CONDUCT.md).

We also welcome bug reports and questions under GitHub's [Issues](issues).


## Licensing

This project is licensed under the [GNU Affero General Public License 
Version 3](LICENSE).
