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
php artisan migrate:refresh --seed
```

This will create all the tables and relationships, and fill the tables with data from the 
[Faker](https://github.com/fzaninotto/Faker) PHP library.


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
