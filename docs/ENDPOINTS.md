## Artworks

### `/artworks`

A list of all artworks sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](FIELDS.md#artworks).

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

Search artwork data in the aggregator. Artworks in the groups of essentials are boosted so they'll show up higher in results.

#### Available parameters:

* `q` - Your search query
* `query` - For complex queries, you can pass Elasticsearch domain syntax queries here
* `sort` - Used in conjunction with `query`
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


## Agents

### `/agents`

A list of all agents sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](FIELDS.md#agents).

#### Available parameters:

* `ids` - A comma-separated list of agent ids to retrieve
* `limit` - The number of records to return per page
* `page` - The page of records to retrieve
* `fields` - A comma-separated list of fields to return per record

Example request: http://aggregator-data-test.artic.edu/api/v1/agents  
Example output:

```
{
  "pagination": {
    "total": 11309,
    "limit": 12,
    "offset": 0,
    "total_pages": 943,
    "current_page": 1,
    "next_url": "http://aggregator-data-test.artic.edu/api/v1/agents?page=2&limit=12"
  },
  "data": [
    {
      "id": 68565,
      "title": "Huys, Franz",
      "lake_guid": "dc30f7f9-a86b-4c30-db5f-4d790184a851",
      "birth_date": 1522,
      "birth_place": null,
      "death_date": 1562,
      "death_place": null,
      "is_licensing_restricted": false,
      "agent_type": "Artist",
      "agent_type_id": 36,
      "last_updated_citi": "2017-10-05T21:00:01-05:00",
      "last_updated_fedora": "2017-10-05T16:55:24-05:00",
      "last_updated_source": "2017-10-05T16:55:25-05:00",
      "last_updated": "2017-10-05T17:00:02-05:00"
    },
    {
      "id": 36022,
      "title": "Nilsson, Gladys",
      "lake_guid": "6ff4fc85-5c15-e096-b4f1-ec666c205769",
      "birth_date": 1940,
      "birth_place": null,
      "death_date": null,
      "death_place": null,
      "is_licensing_restricted": false,
      "agent_type": "Artist",
      "agent_type_id": 36,
      "last_updated_citi": "2017-09-05T16:40:46-05:00",
      "last_updated_fedora": "2017-10-05T12:15:27-05:00",
      "last_updated_source": "2017-10-05T12:15:28-05:00",
      "last_updated": "2017-10-05T12:20:02-05:00"
    },
    ...
  ]
}
```

### `/agents/search`

Search agent data in the aggregator.

#### Available parameters:

* `q` - Your search query
* `query` - For complex queries, you can pass Elasticsearch domain syntax queries here
* `sort` - Used in conjunction with `query`
* `from` - Starting point of results. Pagination via Elasticsearch conventions
* `size` - Number of results to return. Pagination via Elasticsearch conventions
* `facets` - A comma-separated list of "count" aggregation facets to include in the results.

Example request: http://aggregator-data-test.artic.edu/api/v1/agents/search?q=raushenbreg  
Example output:

```
{
  "preference": null,
  "pagination": {
    "total": 1,
    "limit": 10,
    "offset": 0,
    "total_pages": 1,
    "current_page": 1
  },
  "data": [
    {
      "_score": 9.910224,
      "api_id": "36326",
      "api_model": "agents",
      "api_link": "http://aggregator-data-test.artic.edu/api/v1/agents/36326",
      "id": "collections.agents.36326",
      "title": "Rauschenberg, Robert",
      "timestamp": "2017-09-25T15:01:58-05:00"
    }
  ],
  "aggregations": {
    "count_api_model": [
      {
        "key": "agents",
        "doc_count": 1
      }
    ]
  }
}
```

### `/agents/{id}`

A single agent by the given identifier. {id} is the identifier from our collections managements system.

Example request: http://aggregator-data-test.artic.edu/api/v1/agents/36326  
Example output:

```
{
  "data": {
    "id": 36326,
    "title": "Rauschenberg, Robert",
    "lake_guid": "f2b75a42-96e8-ac9b-89d1-62c66fac4123",
    "birth_date": 1925,
    "birth_place": null,
    "death_date": 2008,
    "death_place": null,
    "is_licensing_restricted": false,
    "agent_type": "Artist",
    "agent_type_id": 36,
    "last_updated_citi": "2017-09-05T16:41:14-05:00",
    "last_updated_fedora": "2017-09-22T14:41:10-05:00",
    "last_updated_source": "2017-09-22T14:41:10-05:00",
    "last_updated": "2017-09-25T15:01:58-05:00"
  }
}
```


## Artists

Artists are a subset of agents filtered by `agent_type` with values `Artist`. The following endpoints are available with the same parameters and output as their corresponding `/agents` endpoints:

* `/artists`
* `/artists/{id}`


## Venues

Artists are a subset of agents filtered by `agent_type` with values `Corporate Body`. The following endpoints are available with the same parameters and output as their corresponding `/agents` endpoints:

* `/venues`
* `/venues/{id}`


## Departments

### `/departments`

A list of all departments sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](FIELDS.md#departments).

#### Available parameters:

* `ids` - A comma-separated list of department ids to retrieve
* `limit` - The number of records to return per page
* `page` - The page of records to retrieve
* `fields` - A comma-separated list of fields to return per record

Example request: http://aggregator-data-test.artic.edu/api/v1/departments  
Example output:

```
{
  "pagination": {
    "total": 32,
    "limit": 12,
    "offset": 0,
    "total_pages": 3,
    "current_page": 1,
    "next_url": "http://aggregator-data-test.artic.edu/api/v1/departments?page=2&limit=12"
  },
  "data": [
    {
      "id": 1,
      "title": "Unknown",
      "lake_guid": "a6295a34-c3a9-b51f-d9dc-c2d13be2aa75",
      "last_updated_citi": "2017-09-05T16:47:55-05:00",
      "last_updated_fedora": "2017-10-04T13:36:33-05:00",
      "last_updated_source": "2017-10-04T13:36:33-05:00",
      "last_updated": "2017-10-04T13:40:41-05:00"
    },
    {
      "id": 3,
      "title": "Prints and Drawings",
      "lake_guid": "922e5173-2c3d-b6c1-f223-bb591cafbb79",
      "last_updated_citi": "2017-09-05T16:47:55-05:00",
      "last_updated_fedora": "2017-05-17T14:40:40-05:00",
      "last_updated_source": "2017-10-04T13:36:32-05:00",
      "last_updated": "2017-10-04T13:40:41-05:00"
    },
	...
  ]
}
```

### `/departments/search`

Search department data in the aggregator.

#### Available parameters:

* `q` - Your search query
* `query` - For complex queries, you can pass Elasticsearch domain syntax queries here
* `sort` - Used in conjunction with `query`
* `from` - Starting point of results. Pagination via Elasticsearch conventions
* `size` - Number of results to return. Pagination via Elasticsearch conventions
* `facets` - A comma-separated list of "count" aggregation facets to include in the results.

Example request: http://aggregator-data-test.artic.edu/api/v1/departments/search?q=print  
Example output:

```
{
  "preference": null,
  "pagination": {
    "total": 2,
    "limit": 10,
    "offset": 0,
    "total_pages": 1,
    "current_page": 1
  },
  "data": [
    {
      "_score": 3.4345741,
      "api_id": "3",
      "api_model": "departments",
      "api_link": "http://aggregator-data-test.artic.edu/api/v1/departments/3",
      "id": "collections.departments.3",
      "title": "Prints and Drawings",
      "timestamp": "2017-10-04T13:40:41-05:00"
    },
    {
      "_score": 2.6400175,
      "api_id": "14",
      "api_model": "departments",
      "api_link": "http://aggregator-data-test.artic.edu/api/v1/departments/14",
      "id": "collections.departments.14",
      "title": "European Painting and Sculpture",
      "timestamp": "2017-10-04T13:40:41-05:00"
    }
  ],
  "suggest": {
    "autocomplete": [
      "Print Catalog of Figures Included in the Gallery D",
      "Print Catalog of Figures Included in the Gallery D",
      "Print Fanciers",
      "Print Gallery",
      "Print for Chicago 8, from Conspiracy, The Artist a"
    ],
    "phrase": [
      "<em>Saint</em>",
      "<em>Point</em>",
      "<em>Front</em>",
      "<em>Print</em>",
      "<em>prints</em>"
    ]
  },
  "aggregations": {
    "count_api_model": [
      {
        "key": "departments",
        "doc_count": 2
      }
    ]
  }
}
```

### `/departments/{id}`

A single department by the given identifier. {id} is the identifier from our collections managements system.

Example request: http://aggregator-data-test.artic.edu/api/v1/departments/3  
Example output:

```
{
  "data": {
    "id": 3,
    "title": "Prints and Drawings",
    "lake_guid": "922e5173-2c3d-b6c1-f223-bb591cafbb79",
    "last_updated_citi": "2017-09-05T16:47:55-05:00",
    "last_updated_fedora": "2017-05-17T14:40:40-05:00",
    "last_updated_source": "2017-10-04T13:36:32-05:00",
    "last_updated": "2017-10-04T13:40:41-05:00"
  }
}
```


## Object Types

### `/object-types`

A list of all object types sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](FIELDS.md#object-types).

#### Available parameters:

* `ids` - A comma-separated list of object type ids to retrieve
* `limit` - The number of records to return per page
* `page` - The page of records to retrieve
* `fields` - A comma-separated list of fields to return per record

Example request: http://aggregator-data-test.artic.edu/api/v1/object-types  
Example output:

```
{
  "pagination": {
    "total": 25,
    "limit": 12,
    "offset": 0,
    "total_pages": 3,
    "current_page": 1,
    "next_url": "http://aggregator-data-test.artic.edu/api/v1/object-types?page=2&limit=12"
  },
  "data": [
    {
      "id": 2,
      "title": "Sculpture",
      "lake_guid": "47d48584-6c98-3d10-9efd-25db337a470e",
      "last_updated_citi": "2016-10-11T07:59:44-05:00",
      "last_updated_fedora": "2017-03-08T18:24:39-06:00",
      "last_updated_source": "2017-05-27T15:44:27-05:00",
      "last_updated": "2017-09-05T16:47:56-05:00"
    },
    {
      "id": 3,
      "title": "Painting",
      "lake_guid": "fca7d2b6-3583-3ffb-a491-54326a5715bc",
      "last_updated_citi": "2017-02-14T01:22:25-06:00",
      "last_updated_fedora": "2017-02-23T21:32:35-06:00",
      "last_updated_source": "2017-03-28T01:38:08-05:00",
      "last_updated": "2017-09-05T16:47:56-05:00"
    },
	...
  ]
}
```

### `/object-types/{id}`

A single object type by the given identifier. {id} is the identifier from our collections managements system.

Example request: http://aggregator-data-test.artic.edu/api/v1/object-types/3  
Example output:

```
{
  "data": {
    "id": 28,
    "title": "Design",
    "lake_guid": "71ae1eda-0f26-3041-a6a3-28a072be6c20",
    "last_updated_citi": "2017-05-28T14:01:29-05:00",
    "last_updated_fedora": "2017-02-02T08:50:07-06:00",
    "last_updated_source": "2017-04-04T09:04:06-05:00",
    "last_updated": "2017-09-05T16:47:56-05:00"
  }
}
```


## Categories

### `/categories`

A list of all categories sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](FIELDS.md#categories).

#### Available parameters:

* `ids` - A comma-separated list of category ids to retrieve
* `limit` - The number of records to return per page
* `page` - The page of records to retrieve
* `fields` - A comma-separated list of fields to return per record

Example request: http://aggregator-data-test.artic.edu/api/v1/categories  
Example output:

```
{
  "pagination": {
    "total": 32,
    "limit": 12,
    "offset": 0,
    "total_pages": 3,
    "current_page": 1,
    "next_url": "http://aggregator-data-test.artic.edu/api/v1/categories?page=2&limit=12"
  },
  "data": [
    {
      "id": 1,
      "title": "Unknown",
      "lake_guid": "a6295a34-c3a9-b51f-d9dc-c2d13be2aa75",
      "last_updated_citi": "2017-09-05T16:47:55-05:00",
      "last_updated_fedora": "2017-10-04T13:36:33-05:00",
      "last_updated_source": "2017-10-04T13:36:33-05:00",
      "last_updated": "2017-10-04T13:40:41-05:00"
    },
    {
      "id": 3,
      "title": "Prints and Drawings",
      "lake_guid": "922e5173-2c3d-b6c1-f223-bb591cafbb79",
      "last_updated_citi": "2017-09-05T16:47:55-05:00",
      "last_updated_fedora": "2017-05-17T14:40:40-05:00",
      "last_updated_source": "2017-10-04T13:36:32-05:00",
      "last_updated": "2017-10-04T13:40:41-05:00"
    },
	...
  ]
}
```

### `/categories/search`

Search category data in the aggregator.

#### Available parameters:

* `q` - Your search query
* `query` - For complex queries, you can pass Elasticsearch domain syntax queries here
* `sort` - Used in conjunction with `query`
* `from` - Starting point of results. Pagination via Elasticsearch conventions
* `size` - Number of results to return. Pagination via Elasticsearch conventions
* `facets` - A comma-separated list of "count" aggregation facets to include in the results.

Example request: http://aggregator-data-test.artic.edu/api/v1/categories/search?q=print  
Example output:

```
{
  "preference": null,
  "pagination": {
    "total": 2,
    "limit": 10,
    "offset": 0,
    "total_pages": 1,
    "current_page": 1
  },
  "data": [
    {
      "_score": 3.4345741,
      "api_id": "3",
      "api_model": "categories",
      "api_link": "http://aggregator-data-test.artic.edu/api/v1/categories/3",
      "id": "collections.categories.3",
      "title": "Prints and Drawings",
      "timestamp": "2017-10-04T13:40:41-05:00"
    },
    {
      "_score": 2.6400175,
      "api_id": "14",
      "api_model": "categories",
      "api_link": "http://aggregator-data-test.artic.edu/api/v1/categories/14",
      "id": "collections.categories.14",
      "title": "European Painting and Sculpture",
      "timestamp": "2017-10-04T13:40:41-05:00"
    }
  ],
  "suggest": {
    "autocomplete": [
      "Print Catalog of Figures Included in the Gallery D",
      "Print Catalog of Figures Included in the Gallery D",
      "Print Fanciers",
      "Print Gallery",
      "Print for Chicago 8, from Conspiracy, The Artist a"
    ],
    "phrase": [
      "<em>Saint</em>",
      "<em>Point</em>",
      "<em>Front</em>",
      "<em>Print</em>",
      "<em>prints</em>"
    ]
  },
  "aggregations": {
    "count_api_model": [
      {
        "key": "categories",
        "doc_count": 2
      }
    ]
  }
}
```

### `/categories/{id}`

A single category by the given identifier. {id} is the identifier from our collections managements system.

Example request: http://aggregator-data-test.artic.edu/api/v1/categories/3  
Example output:

```
{
  "data": {
    "id": 3,
    "title": "Prints and Drawings",
    "lake_guid": "922e5173-2c3d-b6c1-f223-bb591cafbb79",
    "last_updated_citi": "2017-09-05T16:47:55-05:00",
    "last_updated_fedora": "2017-05-17T14:40:40-05:00",
    "last_updated_source": "2017-10-04T13:36:32-05:00",
    "last_updated": "2017-10-04T13:40:41-05:00"
  }
}
```


## Agent Types

### `/agent-types`

A list of all agent types sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](FIELDS.md#agent-types).

#### Available parameters:

* `ids` - A comma-separated list of agent type ids to retrieve
* `limit` - The number of records to return per page
* `page` - The page of records to retrieve
* `fields` - A comma-separated list of fields to return per record

Example request: http://aggregator-data-test.artic.edu/api/v1/agent-types  
Example output:

```
{
  "pagination": {
    "total": 25,
    "limit": 12,
    "offset": 0,
    "total_pages": 3,
    "current_page": 1,
    "next_url": "http://aggregator-data-test.artic.edu/api/v1/agent-types?page=2&limit=12"
  },
  "data": [
    {
      "id": 29,
      "title": "Copyright Representative",
      "lake_guid": "799208c3-264a-33c3-8644-80ba5b63848d",
      "last_updated_citi": "2016-09-25T23:11:41-05:00",
      "last_updated_fedora": "2016-12-19T02:27:03-06:00",
      "last_updated_source": "2017-01-29T08:51:34-06:00",
      "last_updated": "2017-09-05T16:32:48-05:00"
    },
    {
      "id": 36,
      "title": "Artist",
      "lake_guid": "3f952f4e-1164-3656-877c-9d195faba4b9",
      "last_updated_citi": "2016-11-22T00:31:50-06:00",
      "last_updated_fedora": "2017-08-07T04:44:13-05:00",
      "last_updated_source": "2017-08-31T20:18:26-05:00",
      "last_updated": "2017-09-05T16:32:48-05:00"
    },
	...
  ]
}
```

### `/agent-types/{id}`

A single agent type by the given identifier. {id} is the identifier from our collections managements system.

Example request: http://aggregator-data-test.artic.edu/api/v1/agent-types/36  
Example output:

```
{
  "data": {
    "id": 36,
    "title": "Artist",
    "lake_guid": "3f952f4e-1164-3656-877c-9d195faba4b9",
    "last_updated_citi": "2016-11-22T00:31:50-06:00",
    "last_updated_fedora": "2017-08-07T04:44:13-05:00",
    "last_updated_source": "2017-08-31T20:18:26-05:00",
    "last_updated": "2017-09-05T16:32:48-05:00"
  }
}
```


## Galleries

### `/galleries`

A list of all galleries sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](FIELDS.md#galleries).

#### Available parameters:

* `ids` - A comma-separated list of gallery ids to retrieve
* `limit` - The number of records to return per page
* `page` - The page of records to retrieve
* `fields` - A comma-separated list of fields to return per record

Example request: http://aggregator-data-test.artic.edu/api/v1/galleries  
Example output:

```
{
  "pagination": {
    "total": 116,
    "limit": 12,
    "offset": 0,
    "total_pages": 10,
    "current_page": 1,
    "next_url": "http://aggregator-data-test.artic.edu/api/v1/galleries?page=2&limit=12"
  },
  "data": [
    {
      "id": 28498,
      "title": "Gallery 239",
      "lake_guid": "86cc9e3e-b494-3930-a492-ec82baa70f4e",
      "is_closed": false,
      "number": "239",
      "floor": "2",
      "latitude": 41.88,
      "longitude": -87.62,
      "latlon": "41.88,-87.62",
      "category_ids": [],
      "last_updated_citi": "2017-10-06T16:27:07-05:00",
      "last_updated_fedora": "2017-09-27T17:27:33-05:00",
      "last_updated_source": "2017-09-27T17:27:33-05:00",
      "last_updated": "2017-10-06T16:27:07-05:00"
    },
    {
      "id": 27946,
      "title": "South Stanley McCormick Memorial Garden",
      "lake_guid": "13ef4c3f-2c46-dfc2-3d97-922e74df4eeb",
      "is_closed": false,
      "number": null,
      "floor": "1",
      "latitude": 41.88,
      "longitude": -87.62,
      "latlon": "41.88,-87.62",
      "category_ids": [],
      "last_updated_citi": "2017-10-06T16:27:10-05:00",
      "last_updated_fedora": "2017-08-11T16:38:04-05:00",
      "last_updated_source": "2017-08-11T16:38:04-05:00",
      "last_updated": "2017-10-06T16:27:10-05:00"
    },
	...
  ]
}
```

### `/galleries/search`

Search gallery data in the aggregator.

#### Available parameters:

* `q` - Your search query
* `query` - For complex queries, you can pass Elasticsearch domain syntax queries here
* `sort` - Used in conjunction with `query`
* `from` - Starting point of results. Pagination via Elasticsearch conventions
* `size` - Number of results to return. Pagination via Elasticsearch conventions
* `facets` - A comma-separated list of "count" aggregation facets to include in the results.

Example request: http://aggregator-data-test.artic.edu/api/v1/galleries/search?q=modern  
Example output:

```
{
  "preference": null,
  "pagination": {
    "total": 1,
    "limit": 10,
    "offset": 0,
    "total_pages": 1,
    "current_page": 1
  },
  "data": [
    {
      "_score": 8.302454,
      "api_id": "28275",
      "api_model": "galleries",
      "api_link": "http://aggregator-data-test.artic.edu/api/v1/galleries/28275",
      "id": "collections.galleries.28275",
      "title": "Modern Wing Entrance",
      "timestamp": "2017-10-06T16:27:10-05:00"
    }
  ],
  "suggest": {
    "autocomplete": [
      "02. Modern Homes No. 104 and 109",
      "05. \"Modern Sanitation,\" Vol. X, No.4. Standard Sa",
      "Modern",
      "Modern",
      "Modern (Modern Wing)"
    ],
    "phrase": [
      "<em>Modern</em>",
      "<em>mode</em>",
      "<em>model</em>",
      "<em>models</em>"
    ]
  },
  "aggregations": {
    "count_api_model": [
      {
        "key": "galleries",
        "doc_count": 1
	  }
    ]
  }
}
```

### `/galleries/{id}`

A single gallery by the given identifier. {id} is the identifier from our collections managements system.

Example request: http://aggregator-data-test.artic.edu/api/v1/galleries/3  
Example output:

```
{
  "data": {
    "id": 27946,
    "title": "South Stanley McCormick Memorial Garden",
    "lake_guid": "13ef4c3f-2c46-dfc2-3d97-922e74df4eeb",
    "is_closed": false,
    "number": null,
    "floor": "1",
    "latitude": 41.88,
    "longitude": -87.62,
    "latlon": "41.88,-87.62",
    "category_ids": [],
    "last_updated_citi": "2017-10-06T16:27:10-05:00",
    "last_updated_fedora": "2017-08-11T16:38:04-05:00",
    "last_updated_source": "2017-08-11T16:38:04-05:00",
    "last_updated": "2017-10-06T16:27:10-05:00"
  }
}
```


