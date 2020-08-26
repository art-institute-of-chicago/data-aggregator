![Art Institute of Chicago](https://raw.githubusercontent.com/Art-Institute-of-Chicago/template/master/aic-logo.gif)

# Public API data

Founded in 1879, the [Art Institute of Chicago](https://www.artic.edu) is one of the world’s major museums, housing an extraordinary collection of objects from across places, cultures, and time. We are also a place of active learning for all—dedicated to investigation, innovation, education, and dialogue—continually aspiring to greater public service and civic engagement.

The Art Institute of Chicago provides access to all of our public data through a single, unified [API](https://api.artic.edu) (Application Programming Interface). It’s powered by a data hub, a system our engineers built to collect public information from a number of different internal systems. In our API, you’ll find data on our collections, digital publications, in-gallery interactives, mobile apps, shop products, events, and more.

For a number of reasons it may be useful to work with all our API data within your own local enviroment. We've made it easy to do so by providing a full data dump of our
entire API here in this repo.

## Features

* All data is wiped and refreshed daily
* Each record is represented by a single file
* All data organized by API endpoint
* Images are not included

## Overview

In [json](json) you'll find a list of folders, each representing a different endpoint in our API. Within each of these folders you'll find a series of files named `{id}.json`, where `{id}` represents the unique identifier of the record, and the file's contents includes exactly what you will find in our API.

In [getting-started](getting-started) you'll find smaller samplings of our data for folks who don't want our entire dataset. [allArtworks.jsonl](getting-started/allArtworks.jsonl) is a simple JSONL file containing all our published artworks with a few key fields. For more information on the JSONL format, see [here](http://jsonlines.org/). [someArtworks.csv](getting-started/someArtworks.csv) is just a few hundred of our artworks in CSV format. Note that our API doesn't provide data in CSV format, so anything that you build off of this CSV file won't be able to scaffold up to our regular API.

Images are not included and are not part of the dataset. For more details on how to use images of artworks in the Art Institute of Chicago’s collection, please visit our [open access](https://www.artic.edu/open-access) page.

As this data is automatically refreshed daily, please be sure to regularly update your copy of the dataset to ensure you are using the best available information.

## Contributing

Because updating this data has been automated, we only accept pull requests for changes to documentation—and we encourage your contributions. Please fork this repository and make your changes in a separate branch.

```bash
# Clone the repo to your computer
git clone git@github.com:art-institute-of-chicago/api-data.git

# Enter the folder that was created by the clone
cd api-data

# Start a feature branch
git checkout -b feature/good-short-description

# ... make some changes, commit your code
yourfavoritetexteditor README.md
git add .
git commit -m 'Add a clear and conside commit message'

# Push your branch to GitHub
git push origin feature/good-short-description
```

Then on github.com, create a Pull Request to merge your changes into our `master` branch.

This project is released with a Contributor Code of Conduct. By participating in this project you agree to abide by its [terms](CODE_OF_CONDUCT.md).

We welcome bug reports and questions under GitHub's [Issues](issues). For other concerns, you can reach our engineering team at [engineering@artic.edu](mailto:engineering@artic.edu)

## Licensing

Note that all content may have different licensing terms. Please be mindful of the `info.license_text` and `info.license_links` fields within each JSON data file. These notices refer to the metadata that each file represents, they do not apply to images and media which may have different licensing terms.