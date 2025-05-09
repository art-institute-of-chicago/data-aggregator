![Art Institute of Chicago](https://raw.githubusercontent.com/Art-Institute-of-Chicago/template/main/aic-logo.gif)

# Data Aggregator
> A central location of data collected from several different systems and offered up through an API

The aggregator is the core of our data hub — a large internal project to consolidate data across many disparate systems at the Art Institute of Chicago into a single, unified source. This offers our products a rich set of data that can be accessed in one way, in one location. For more information about our data hub, please peruse the following paper:

[Moskvin, Illya and trivedi, nikhil. "Building a Data Hub: Microservices, APIs, and System Integration at the Art Institute of Chicago." Museums and the Web 2019. Published January 15, 2019.](https://mw19.mwconf.org/paper/building-a-data-hub-microservices-apis-and-system-integration-at-the-art-institute-of-chicago/)


## Looking for our data?

You are in the right place! The aggregator contains all of our public APIs, which power our public-facing applications, such as our website and mobile app. As part of our [Open Access](https://www.artic.edu/open-access) efforts, we are making them available to the general public.

For example, here's an endpoint that lists all of our published artworks:

https://api.artic.edu/api/v1/artworks

...and here's a query that shows identifiers, titles, and last modified dates for all artworks that have been updated in our collections system in the past seven days from this moment, sorted in reverse chronological order:

https://api.artic.edu/api/v1/artworks/search?fields=id,title,source_updated_at&query[range][source_updated_at][gte]=now-7d&sort[source_updated_at][order]=desc

Our API is a wrapper around [Elasticsearch's Query DSL](https://www.elastic.co/guide/en/elasticsearch/reference/6.0/query-dsl.html). Depending on your needs, these queries can get quite complex.

Here are some resources to get you started:

* [Art Institute of Chicago — API Documentation](https://api.artic.edu/docs) (fields and endpoints)
* [Elasticsearch 6.0 — Query DSL](https://www.elastic.co/guide/en/elasticsearch/reference/6.0/query-dsl.html) (query syntax)
* [Art Institute of Chicago — Open Access — Public API](https://www.artic.edu/open-access/public-api) (example projects)

We are currently working on improving our documentation. In the meantime, feel free to open an issue here or reach out to engineering@artic.edu with any questions. We would love to hear about any projects you pursue with our API.


## Features

* All data is available via a JSON-based RESTful API
* Most data is searchable via an Elasticsearch wrapper
* Complex data types can be "included" in requests
* Large lists are paginated
* Unit tests for all endpoints


## Overview

The aggregator interfaces with several internal APIs to collect its data. All data is imported and served up locally so that at runtime the API doesn't have dependencies on other systems. `artisan` commands have been set up to import data from various sources, either en masse or incrementally. One of the greatest benefits of an aggregator like this one is the ability to provide relationship between resources across systems. Our `/artworks` endpoint is a great example, as you can see relationships they have to a number of different things, like mobile tours, digital publications, and historic static sites.


## Requirements

The project has been built in Laravel, and includes the following requirements:

* Laravel 5.8
* PHP 7.1
* MySQL 5.7
* [Composer](https://getcomposer.org/)
* Elasticsearch 6.0

For development, we recommend that you use [Laravel Homestead](https://laravel.com/docs/5.8/homestead). It includes everything you need to run this project. Note that you will need to [enable the optional Elasticsearch feature](https://laravel.com/docs/5.8/homestead#installing-optional-features) in your Homestead.yaml.


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

First you'll need to create a `.env` file and update it to reflect  your environment. We've provided an example file to get you started:

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

This will create all the tables and relationships, and fill the tables with data from the [Faker](https://github.com/fzaninotto/Faker) PHP library.


### Importing real data

We've created a series of `artisan` tasks to import data from source systems. You can see all the available imports like so:

```shell
php artisan list import
```

To import all data from all systems, run:

```shell
php artisan import:all
```

### Compiling documentation

```bash
npm install
npm run docs-dev
npm run docs-build
```

## Contributing

We encourage your contributions. Please fork this repository and make your changes in a separate branch. To better understand how we organize our code, please review our [version control guidelines](https://docs.google.com/document/d/1B-27HBUc6LDYHwvxp3ILUcPTo67VFIGwo5Hiq4J9Jjw).

```bash
# Clone the repo to your computer
git clone git@github.com:your-github-account/data-aggregator.git

# Enter the folder that was created by the clone
cd data-aggregator

# Install PHP dependencies
composer install

# Start a feature branch
git checkout -b feature/good-short-description

# ... make some changes, commit your code

# Push your branch to GitHub
git push origin feature/good-short-description
```

Then on GitHub, create a [Pull Request](https://help.github.com/en/github/collaborating-with-issues-and-pull-requests/about-pull-requests) to merge your changes into our `develop` branch.

Our internal team uses [`php-cs-fixer`](https://github.com/FriendsOfPHP/PHP-CS-Fixer) to ensure our code meets various [PHP Standards Recommendations](https://www.php-fig.org/psr/). You're welcome to integrate `php-cs-fixer` into your workflow as you work on this project, but it is not required to make a contribution.

This project is released with a Contributor Code of Conduct. By participating in this project you agree to abide by its [terms](CODE_OF_CONDUCT.md).

We welcome bug reports and questions under GitHub's [Issues](issues). For other concerns, you can reach our engineering team at [engineering@artic.edu](mailto:engineering@artic.edu)


## Licensing

This project is licensed under the [GNU Affero General Public License Version 3](LICENSE).
