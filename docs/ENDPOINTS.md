## Artworks

### `/artworks`

A list of all artworks sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](FIELDS.md#artworks)

#### Available parameters:

* `ids` - A comma-separated list of artwork ids to retrieve
* `limit` - The number of records to return per page
* `page` - The page of records to retrieve
* `fields` - A comma-separated list of fields to return per record
* `include` - A comma-separated list of subresource to embed in the returned records. Available options are:
  * `artists`
  * `categories`
  * `copyrightRepresentatives`
  * `parts`
  * `sets`
  * `dates`
  * `catalogues`
  * `committees`
  * `terms`
  * `images`
  * `publications`
  * `tours`

Example request: http://aggregator-data-test.artic.edu/api/v1/artworks
Example output:

```
{
  "pagination": {
    "total": 105802,
    "limit": 12,
    "offset": 0,
    "total_pages": 8817,
    "current_page": 1,
    "next_url": "http://aggregator-data-test.artic.edu/api/v1/artworks?page=2&limit=12"
  },
  "data": [
    {
      "id": 199168,
      "title": "Building Socialism Under the Banner of Lenin (Pod znamenem Lenina, za sotsialisticheskoe stroitel’st)",
      "lake_guid": "b3cb0996-d616-441f-6e2b-75d4306d1b41",
      "main_reference_number": "2011.873",
      "date_start": 1929,
      "date_end": 1930,
      "date_display": "1930",
      ...
    }
  ]
}
```

### `/artworks/essentials`

A list of essential artworks sorted by last updated date in descending order. This is a subset of the `artworks/` endpoint that represents approximately 400 of our most well-known works. This can be used to get a shorter list of artworks that will have most of its metadata filled out for testing purposes.

#### Available parameters:

* `ids` - A comma-separated list of artwork ids to retrieve
* `limit` - The number of records to return per page
* `page` - The page of records to retrieve
* `fields` - A comma-separated list of fields to return per record
* `include` - A comma-separated list of subresource to embed in the returned records. Available options are:
  * `artists`
  * `categories`
  * `copyrightRepresentatives`
  * `parts`
  * `sets`
  * `dates`
  * `catalogues`
  * `committees`
  * `terms`
  * `images`
  * `publications`
  * `tours`

Example request: http://aggregator-data-test.artic.edu/api/v1/artworks/essentials
Example output:

```
{
  "pagination": {
    "total": 413,
    "limit": 12,
    "offset": 0,
    "total_pages": 35,
    "current_page": 1,
    "next_url": "http://aggregator-data-test.artic.edu/api/v1/artworks/essentials?page=2&limit=12"
  },
  "data": [
    {
      "id": 9503,
      "title": "Champs de Mars: The Red Tower",
      "lake_guid": "5c2720b8-6e4b-24f5-9019-8be667955d54",
      "main_reference_number": "1959.1",
      "date_start": 1910,
      "date_end": 1923,
      "date_display": "1911/23",
      ...
    }
  ]
}
```

### `/artworks/search`

Search artwork data in the aggregator. Artworks in the groups of essentials are boosted so they'll show up higher in resuts.

#### Available parameters:

* `q` - Your search query
* `query` - For complex queries, you can pass Elasticsearch domain syntax queries here
* `sort` - Used in conjunection with `query`
* `from` - Starting point of results. Pagination via Elasticsearch conventions
* `size` - Number of results to return. Pagination via Elasticsearch conventions
* `facets` - A comma-separated list of "count" aggregation facets to include in the results.

Example request: http://aggregator-data-test.artic.edu/api/v1/artworks/search?q=monet
Example output:

```
{
  "preference": null,
  "pagination": {
    "total": 7869,
    "limit": 10,
    "offset": 0,
    "total_pages": 787,
    "current_page": 1
  },
  "data": [
    {
      "_score": 22.571709,
      "api_id": "14598",
      "api_model": "artworks",
      "api_link": "http://data-aggregator.dev/api/v1/artworks/14598",
      "id": "collections.artworks.14598",
      "title": "The Beach at Sainte-Adresse",
      "timestamp": "2017-09-20T19:38:40-05:00"
    },
    {
      "_score": 20.388424,
      "api_id": "16499",
      "api_model": "artworks",
      "api_link": "http://data-aggregator.dev/api/v1/artworks/16499",
      "id": "collections.artworks.16499",
      "title": "Jesus Mocked by the Soldiers",
      "timestamp": "2017-09-20T19:36:53-05:00"
    },
    {
      "_score": 20.197554,
      "api_id": "16571",
      "api_model": "artworks",
      "api_link": "http://data-aggregator.dev/api/v1/artworks/16571",
      "id": "collections.artworks.16571",
      "title": "Arrival of the Normandy Train, Gare Saint-Lazare",
      "timestamp": "2017-09-20T19:36:52-05:00"
    },
	...
  ],
  "suggest": {
    "autocomplete": [
      "Monet and Stacks of Wheat\nMonet and Stacks of Whea",
      "Monet and the Railroad",
      "Monet's Water Garden",
      "Monet, Claude"
    ],
    "phrase": [
      "<em>month</em>",
      "<em>don't</em>",
      "<em>Don't</em>",
      "<em>Manet</em>",
      "<em>Donut</em>"
    ]
  },
  "aggregations": {
    "count_api_model": [
      {
        "key": "artworks",
        "doc_count": 7869
      }
    ]
  }
}
```

### `/artworks/{id}`

A single artwork by the given identifier. {id} is the identifier from our collections managements system.

Example request: http://aggregator-data-test.artic.edu/api/v1/artworks/111628
Example output:

```
{
  "data": {
    "id": 111628,
    "title": "Nighthawks",
    "lake_guid": "80a016ca-a836-a86b-04bb-cf4c4af574cf",
    "main_reference_number": "1942.51",
    "date_start": 1941,
    "date_end": 1942,
    "date_display": "1942",
	...
  }
}
```

### `/artworks/{id}/artists` and `/artworks/{id}/copyrightRepresentatives`

The artists and copyright representatives for a given artwork. Both artists and copyright representatives are service from the API as a type of `agent`, so their output schema is the same.

Example request: http://aggregator-data-test.artic.edu/api/v1/artworks/111628/artists
Example request: http://aggregator-data-test.artic.edu/api/v1/artworks/111628/copyrightRepresentatives
Example output:

```
{
  "data": [
    {
      "id": 34996,
      "title": "Hopper, Edward",
      "lake_guid": "cba02485-5b76-1e48-bb85-2f9d0f3e3c57",
      "birth_date": 1882,
      "birth_place": null,
      "death_date": 1967,
      "death_place": null,
      "is_licensing_restricted": false,
      "agent_type": "Artist",
      "agent_type_id": 36,
      "last_updated_citi": "2017-09-05T16:34:37-05:00",
      "last_updated_fedora": "2017-09-22T16:32:38-05:00",
      "last_updated_source": "2017-09-22T16:32:38-05:00",
      "last_updated": "2017-09-25T15:00:59-05:00"
    }
  ]
}
```

### `/artworks/{id}/categories`

A list of all publish categories for a given artwork.

Example request: http://aggregator-data-test.artic.edu/api/v1/artworks/111628/categories
Example output:

```
{
  "data": [
    {
      "id": 801,
      "title": "Art Resource",
      "parent_id": null,
      "is_in_nav": false,
      "description": "Art Resource is a website where you can license high resolution images from The Art Institute of Chicago.",
      "sort": 0,
      "type": 2,
      "last_updated_fedora": "2017-10-04T13:37:18-05:00",
      "last_updated_source": "2017-10-04T13:37:18-05:00",
      "last_updated": "2017-10-06T13:35:48-05:00"
    },
    {
      "id": 99,
      "title": "Painting 1800–1900",
      "parent_id": "10",
      "is_in_nav": true,
      "description": null,
      "sort": 60,
      "type": 1,
      "last_updated_fedora": "2017-10-04T13:38:27-05:00",
      "last_updated_source": "2017-10-04T13:38:28-05:00",
      "last_updated": "2017-10-06T13:35:47-05:00"
    },
    {
      "id": 10,
      "title": "European Painting and Sculpture",
      "parent_id": null,
      "is_in_nav": true,
      "description": "Considered one of the finest in the world, the collection of European painting contains more than 3,500 works dating from the 12th through the 20th century. Holdings include a rare group of 15th-century Spanish, Italian and Northern European paintings, highlights of European sculpture, and an important selection of 17th- and 18th-century paintings. Major Impressionist and Post-Impressionist works are among its most significant holdings.",
      "sort": 100,
      "type": 1,
      "last_updated_fedora": "2017-06-02T16:32:58-05:00",
      "last_updated_source": "2017-10-04T13:43:30-05:00",
      "last_updated": "2017-10-06T13:35:40-05:00"
    }
  ]
}
```

### `/artworks/{id}/parts`

A list of all the artwork records that make up this artwork.

Example request: http://aggregator-data-test.artic.edu/api/v1/artworks/111628/parts

### `/artworks/{id}/sets`

A list of all the artwork records that make up this artwork.

Example request: http://aggregator-data-test.artic.edu/api/v1/artworks/111628/parts

### `/artworks/{id}/images`

A list of all images for a given artwork.

Example request: http://aggregator-data-test.artic.edu/api/v1/artworks/111628/images
Example output:

```
{
  "data": [
    {
      "id": "39d43108-e690-2705-67e2-a16dc28b8c7f",
      "title": "G42375",
      "description": null,
      "content": null,
      "artist": "",
      "artist_id": null,
      "category_ids": [],
      "iiif_url": "https://lakeimagesweb.artic.edu/iiif/39d43108-e690-2705-67e2-a16dc28b8c7f",
      "is_preferred": false,
      "artwork_ids": [
        111628
      ],
      "artwork_titles": [
        "Nighthawks"
      ],
      "last_updated_fedora": "2017-05-19T20:27:26-05:00",
      "last_updated_source": "2017-06-10T08:15:04-05:00",
      "last_updated": "2017-09-18T13:13:09-05:00"
    }
  ]
}
```
