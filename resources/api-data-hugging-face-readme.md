---
pretty_name: Art Institute of Chicago Public API Data
license: other
language:
- en
configs:
{{configs}}
---

![Art Institute of Chicago](https://raw.githubusercontent.com/Art-Institute-of-Chicago/template/main/aic-logo.gif)

# Public API data

Founded in 1879, the [Art Institute of Chicago](https://www.artic.edu) is one of the world’s major museums, housing an extraordinary collection of objects from across places, cultures, and time. We are also a place of active learning for all—dedicated to investigation, innovation, education, and dialogue—continually aspiring to greater public service and civic engagement.

We provide access to all of our public data through a single, unified [API](https://api.artic.edu/docs). This API is powered by a [data hub](https://github.com/art-institute-of-chicago/data-aggregator), a system our engineers built to collect public information from a number of different internal systems. This dataset is a full copy of that API, for users who would rather work with our data locally than query the API.


## What's in the dataset?

Each endpoint in our API is published as its own config, backed by a single Parquet file named `{endpoint}.parquet`. Each row is one record, and its columns match the `data` block that our API returns for that record. Artwork records also include an `iiif_url` column, which is the base URL of our IIIF image server.

Please consult our [API documentation](https://api.artic.edu/docs) for more information about fields and endpoints.

Images are not included and are not part of the dataset. For more details on how to use images of artworks in the Art Institute of Chicago’s collection, please visit our [open access](https://www.artic.edu/open-access) page.

This data is refreshed automatically, and the history of this repository is replaced on each refresh. Please be sure to regularly update your copy of the dataset to ensure you are using the best available information.


## Usage

```python
from datasets import load_dataset

artworks = load_dataset("art-institute-of-chicago/api-data", "artworks", split="train")
```

The Parquet files can also be read directly with tools like pandas, Polars, or DuckDB.


## Licensing

Note that all content may have different licensing terms. Please be mindful of the `license_text` and `license_links` fields within each JSON data file. These notices refer to the metadata that each file represents, they do not apply to images and media which may have different licensing terms.


## Contact

For questions about this dataset, you can reach our engineering team at [engineering@artic.edu](mailto:engineering@artic.edu).
