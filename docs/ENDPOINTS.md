# Collections

## Artworks

### `/artworks`

A list of all artworks sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](FIELDS.md#artworks).

#### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource
* `include` - A comma-separated list of subresource to embed in the returned resources. Available options are:
  * `artists`
  * `categories`
  * `copyright_representatives`
  * `parts`
  * `sets`
  * `dates`
  * `catalogues`
  * `terms`
  * `images`
  * `publications`
  * `tours`
  * `sites`

Example request: http://aggregator-data-test.artic.edu/api/v1/artworks?limit=2  
Example output:

```
{
    "pagination": {
        "total": 106523,
        "limit": 2,
        "offset": 0,
        "total_pages": 53262,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/artworks?page=2&limit=2"
    },
    "data": [
        {
            "id": 108763,
            "title": "Two Panels (Design No. 105)",
            "lake_guid": "7433f5b4-fd9f-3759-6990-d9af17b6dfe3",
            "is_boosted": false,
            "alt_titles": [],
            "main_reference_number": "1983.179a-b",
            ...
        },
        {
            "id": 100863,
            "title": "Optimum Cubes Drawn from Available Circles\/Dinner Plate (Actual Size)",
            "lake_guid": "8643c87f-b48e-c349-3cf6-7ec4f94a8ed0",
            "is_boosted": false,
            "alt_titles": [],
            "main_reference_number": "1983.826",
            ...
        }
    ]
}
```

### `/artworks/boosted`

A list of boosted artworks sorted by last updated date in descending order. This is a subset of the `artworks/` endpoint that represents approximately 400 of our most well-known resources. This can be used to get a shorter list of artworks that will have most of its metadata filled out for testing purposes.

#### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource
* `include` - A comma-separated list of subresource to embed in the returned resources. Available options are:
  * `artists`
  * `categories`
  * `copyright_representatives`
  * `parts`
  * `sets`
  * `dates`
  * `catalogues`
  * `terms`
  * `images`
  * `publications`
  * `tours`
  * `sites`

Example request: http://aggregator-data-test.artic.edu/api/v1/artworks/boosted?limit=2  
Example output:

```
{
    "pagination": {
        "total": 413,
        "limit": 2,
        "offset": 0,
        "total_pages": 207,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/artworks\/boosted?page=2&limit=2"
    },
    "data": [
        {
            "id": 58540,
            "title": "Tiered Offering Mandala of the Goddess of Wealth (Vasudhara)",
            "lake_guid": "1eeb00da-88dc-9a97-f185-59d59f8dca91",
            "is_boosted": true,
            "alt_titles": [],
            "main_reference_number": "1979.616",
            ...
        },
        {
            "id": 110663,
            "title": "The Combat of the Giaour and Hassan",
            "lake_guid": "e75d6a6f-83c6-b220-39db-56edd386d72a",
            "is_boosted": true,
            "alt_titles": [],
            "main_reference_number": "1962.966",
            ...
        }
    ]
}
```

### `/artworks/search`

Search artworks data in the aggregator. Artworks in the groups of essentials are boosted so they'll show up higher in results.

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
        "total": 345,
        "limit": 10,
        "offset": 0,
        "total_pages": 35,
        "current_page": 1
    },
    "data": [
        {
            "_score": 15.174915,
            "api_id": "14598",
            "api_model": "artworks",
            "is_boosted": true,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/artworks\/14598",
            "id": 14598,
            "title": "The Beach at Sainte-Adresse",
            "timestamp": "2018-02-23T15:41:29-06:00"
        },
        {
            "_score": 14.437024,
            "api_id": "64818",
            "api_model": "artworks",
            "is_boosted": true,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/artworks\/64818",
            "id": 64818,
            "title": "Stacks of Wheat (End of Summer)",
            "timestamp": "2018-02-23T15:40:03-06:00"
        },
        {
            "_score": 13.983941,
            "api_id": "16571",
            "api_model": "artworks",
            "is_boosted": true,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/artworks\/16571",
            "id": 16571,
            "title": "Arrival of the Normandy Train, Gare Saint-Lazare",
            "timestamp": "2018-02-23T15:40:30-06:00"
        }
    ]
}
```

### `/artworks/{id}`

A single artworks by the given identifier. {id} is the identifier from our collections managements system.

Example request: http://aggregator-data-test.artic.edu/api/v1/artworks/111628?limit=2  
Example output:

```
{
    "data": {
        "id": 111628,
        "title": "Nighthawks",
        "lake_guid": "80a016ca-a836-a86b-04bb-cf4c4af574cf",
        "is_boosted": true,
        "alt_titles": [],
        "main_reference_number": "1942.51",
        ...
    }
}
```

### `/artworks/{id}/artists`

The artists for a given artworks. Served from the API as a type of `agent`, so their output schema is the same.

Example request: http://aggregator-data-test.artic.edu/api/v1/artworks/111628/artists?limit=2  
Example output:

```
{
    "data": [
        {
            "id": 34996,
            "title": "Edward Hopper",
            "lake_guid": "cba02485-5b76-1e48-bb85-2f9d0f3e3c57",
            "is_boosted": true,
            "sort_title": "Hopper, Edward",
            "alt_titles": null,
            ...
        }
    ]
}
```

### `/artworks/{id}/categories`

The categories for a given artworks.

Example request: http://aggregator-data-test.artic.edu/api/v1/artworks/111628/categories?limit=2  
Example output:

```
{
    "data": [
        {
            "id": 151,
            "title": "light and shadow",
            "lake_guid": "40b3ae54-9c43-a750-ac9a-31c39bf490ba",
            "is_boosted": false,
            "parent_id": null,
            "is_in_nav": false,
            ...
        },
        {
            "id": 149,
            "title": "New York City",
            "lake_guid": "e3dc716f-3912-3063-bdfc-910cdd53a116",
            "is_boosted": false,
            "parent_id": null,
            "is_in_nav": false,
            ...
        },
        {
            "id": 41,
            "title": "Featured Works",
            "lake_guid": "ae637a2b-e996-a28e-7ca8-adae24ae01fa",
            "is_boosted": false,
            "parent_id": 2,
            "is_in_nav": true,
            ...
        },
        {
            "id": 147,
            "title": "architecture",
            "lake_guid": "965e725e-1275-ff04-6e9f-8b207eeb28ec",
            "is_boosted": false,
            "parent_id": null,
            "is_in_nav": false,
            ...
        },
        {
            "id": 152,
            "title": "figural paintings",
            "lake_guid": "87917ef5-0de9-d5c9-ac25-be5b0a4dd782",
            "is_boosted": false,
            "parent_id": null,
            "is_in_nav": false,
            ...
        },
        {
            "id": 48,
            "title": "American Modernism",
            "lake_guid": "795eda4e-6c99-1e9f-3283-5aaaad27f857",
            "is_boosted": false,
            "parent_id": 2,
            "is_in_nav": true,
            ...
        },
        {
            "id": 150,
            "title": "views through windows",
            "lake_guid": "cefecb9f-0be9-6023-1188-294ad5ac7e27",
            "is_boosted": false,
            "parent_id": null,
            "is_in_nav": false,
            ...
        },
        {
            "id": 144,
            "title": "Edward Hopper",
            "lake_guid": "3b7d4a9f-cd72-a02f-4247-61ef8e814a98",
            "is_boosted": false,
            "parent_id": null,
            "is_in_nav": false,
            ...
        },
        {
            "id": 83,
            "title": "Featured Works",
            "lake_guid": "854c887d-e8e1-71fb-1393-a3280918efd2",
            "is_boosted": false,
            "parent_id": 11,
            "is_in_nav": true,
            ...
        },
        {
            "id": 365,
            "title": "Art Access: Modern and Contemporary Art",
            "lake_guid": "b3743235-8d0d-a381-8582-95dfcad26711",
            "is_boosted": false,
            "parent_id": null,
            "is_in_nav": false,
            ...
        },
        {
            "id": 44,
            "title": "Paintings, 1900-1955",
            "lake_guid": "dcafd608-cc4a-bf34-12b7-87e095bc0a5b",
            "is_boosted": false,
            "parent_id": 2,
            "is_in_nav": true,
            ...
        },
        {
            "id": 2,
            "title": "American",
            "lake_guid": "609dd2cb-9647-1b18-59be-5b8d74d29b51",
            "is_boosted": false,
            "parent_id": null,
            "is_in_nav": true,
            ...
        },
        {
            "id": 11,
            "title": "Modern",
            "lake_guid": "45cc4323-ddb5-b79e-92ae-59238de12577",
            "is_boosted": false,
            "parent_id": null,
            "is_in_nav": true,
            ...
        },
        {
            "id": 612,
            "title": "The City in Art",
            "lake_guid": "4864d53c-d1e6-a072-d036-18f96d612709",
            "is_boosted": false,
            "parent_id": null,
            "is_in_nav": false,
            ...
        },
        {
            "id": 87,
            "title": "American Modernism",
            "lake_guid": "3c15e374-7cd0-7a9a-0280-fa3855032a3f",
            "is_boosted": false,
            "parent_id": 11,
            "is_in_nav": true,
            ...
        },
        {
            "id": 191,
            "title": "Featured Objects",
            "lake_guid": "ada5fe78-e09d-0ef8-82b3-71c4a5b1f6ae",
            "is_boosted": false,
            "parent_id": null,
            "is_in_nav": true,
            ...
        },
        {
            "id": 109,
            "title": "Art Institute Icons",
            "lake_guid": "74c96fd4-5e7e-4b56-26f3-0a911d8fe63b",
            "is_boosted": false,
            "parent_id": null,
            "is_in_nav": true,
            ...
        },
        {
            "id": 801,
            "title": "Art Resource",
            "lake_guid": "4a87fc2b-ddde-03db-3d5b-8a4e65c2ca26",
            "is_boosted": false,
            "parent_id": null,
            "is_in_nav": false,
            ...
        }
    ]
}
```

### `/artworks/{id}/images`

The images for a given artworks.

Example request: http://aggregator-data-test.artic.edu/api/v1/artworks/111628/images?limit=2  
Example output:

```
{
    "data": [
        {
            "id": "39d43108-e690-2705-67e2-a16dc28b8c7f",
            "title": "G42375",
            "is_boosted": false,
            "type": "image",
            "description": null,
            "content": null,
            ...
        },
        {
            "id": "e2193e3c-80dd-386e-0ae3-a0d11883d367",
            "title": "01. <em>Fifty-third Annual Exhibition of American Paintings and Sculpture<\/em>, Plate VII",
            "is_boosted": false,
            "type": "image",
            "description": "The Art Institute of Chicago, <em>Fifty-third Annual Exhibition of American Paintings and Sculpture<\/em>.  Chicago: 1942. <br \/> <br \/> Publishing: Edward Hopper, Nighthawks, 1942. 1942.51.",
            "content": "http:\/\/www.artic.edu\/aic\/collections\/citi\/resources\/Rsrc_001455.jpg",
            ...
        }
    ]
}
```

### `/artworks/{id}/parts`

The parts for a given artworks.

Example request: http://aggregator-data-test.artic.edu/api/v1/artworks/111628/parts?limit=2  

### `/artworks/{id}/sets`

The sets for a given artworks.

Example request: http://aggregator-data-test.artic.edu/api/v1/artworks/111628/sets?limit=2  

## Agents

### `/agents`

A list of all agents sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](FIELDS.md#agents).

#### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource
* `include` - A comma-separated list of subresource to embed in the returned resources. Available options are:
  * `places`
  * `sites`

Example request: http://aggregator-data-test.artic.edu/api/v1/agents?limit=2  
Example output:

```
{
    "pagination": {
        "total": 12234,
        "limit": 2,
        "offset": 0,
        "total_pages": 6117,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/agents?page=2&limit=2"
    },
    "data": [
        {
            "id": 36608,
            "title": "Richard Serra",
            "lake_guid": "06a32bea-60c2-15e5-fd90-efa1d5a728bc",
            "is_boosted": false,
            "sort_title": "Serra, Richard",
            "alt_titles": null,
            ...
        },
        {
            "id": 75267,
            "title": "Regen Projects",
            "lake_guid": "79084c0b-4596-d9af-e10b-3778997b4cac",
            "is_boosted": false,
            "sort_title": "Regen Projects",
            "alt_titles": null,
            ...
        }
    ]
}
```

### `/agents/boosted`

A list of boosted agents sorted by last updated date in descending order. This is a subset of the `agents/` endpoint that represents approximately 400 of our most well-known resources. This can be used to get a shorter list of agents that will have most of its metadata filled out for testing purposes.

#### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource
* `include` - A comma-separated list of subresource to embed in the returned resources. Available options are:
  * `places`
  * `sites`

Example request: http://aggregator-data-test.artic.edu/api/v1/agents/boosted?limit=2  
Example output:

```
{
    "pagination": {
        "total": 330,
        "limit": 2,
        "offset": 0,
        "total_pages": 165,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/agents\/boosted?page=2&limit=2"
    },
    "data": [
        {
            "id": 36613,
            "title": "Gino Severini",
            "lake_guid": "77482fc0-c146-f6bf-5d4b-85baa0759359",
            "is_boosted": true,
            "sort_title": "Severini, Gino",
            "alt_titles": null,
            ...
        },
        {
            "id": 59979,
            "title": "Jeff Wall",
            "lake_guid": "8e1f2fd4-f252-f1d0-0bf1-b4f3ca3c751f",
            "is_boosted": true,
            "sort_title": "Wall, Jeff",
            "alt_titles": null,
            ...
        }
    ]
}
```

### `/agents/search`

Search agents data in the aggregator. 

#### Available parameters:

* `q` - Your search query
* `query` - For complex queries, you can pass Elasticsearch domain syntax queries here
* `sort` - Used in conjunction with `query`
* `from` - Starting point of results. Pagination via Elasticsearch conventions
* `size` - Number of results to return. Pagination via Elasticsearch conventions
* `facets` - A comma-separated list of "count" aggregation facets to include in the results.

Example request: http://aggregator-data-test.artic.edu/api/v1/agents/search  
Example output:

```
{
    "preference": null,
    "pagination": {
        "total": 12234,
        "limit": 10,
        "offset": 0,
        "total_pages": 1224,
        "current_page": 1
    },
    "data": [
        {
            "_score": 5.65818,
            "api_id": "18851",
            "api_model": "agents",
            "is_boosted": true,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/agents\/18851",
            "id": 18851,
            "title": "Hermann Dudley Murphy",
            "timestamp": "2018-02-20T19:41:11-06:00"
        },
        {
            "_score": 5.65818,
            "api_id": "24418",
            "api_model": "agents",
            "is_boosted": true,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/agents\/24418",
            "id": 24418,
            "title": "Frans Snyders",
            "timestamp": "2018-02-20T19:41:11-06:00"
        },
        {
            "_score": 5.65818,
            "api_id": "24535",
            "api_model": "agents",
            "is_boosted": true,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/agents\/24535",
            "id": 24535,
            "title": "Tawaraya S\u00f4tatsu",
            "timestamp": "2018-02-20T19:41:11-06:00"
        }
    ]
}
```

### `/agents/{id}`

A single agents by the given identifier. {id} is the identifier from our collections managements system.

Example request: http://aggregator-data-test.artic.edu/api/v1/agents?limit=2  
Example output:

```
{
    "pagination": {
        "total": 12234,
        "limit": 2,
        "offset": 0,
        "total_pages": 6117,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/agents?page=2&limit=2"
    },
    "data": [
        {
            "id": 36608,
            "title": "Richard Serra",
            "lake_guid": "06a32bea-60c2-15e5-fd90-efa1d5a728bc",
            "is_boosted": false,
            "sort_title": "Serra, Richard",
            "alt_titles": null,
            ...
        },
        {
            "id": 75267,
            "title": "Regen Projects",
            "lake_guid": "79084c0b-4596-d9af-e10b-3778997b4cac",
            "is_boosted": false,
            "sort_title": "Regen Projects",
            "alt_titles": null,
            ...
        }
    ]
}
```

## Artwork Types

### `/artwork-types`

A list of all artwork-types sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](FIELDS.md#artwork-types).

#### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

Example request: http://aggregator-data-test.artic.edu/api/v1/artwork-types?limit=2  
Example output:

```
{
    "pagination": {
        "total": 41,
        "limit": 2,
        "offset": 0,
        "total_pages": 21,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/artwork-types?page=2&limit=2"
    },
    "data": [
        {
            "id": 1,
            "title": "Painting",
            "lake_guid": "cfae4567-198f-973a-07b8-2e4b0defc28e",
            "is_boosted": false,
            "last_updated_source": "2018-01-12T13:58:00-06:00",
            "last_updated": "2018-02-15T15:10:45-06:00",
            ...
        },
        {
            "id": 2,
            "title": "Photograph",
            "lake_guid": "f3daccbc-a5c3-41c9-859b-aac047d78a1c",
            "is_boosted": false,
            "last_updated_source": "2018-01-12T13:58:03-06:00",
            "last_updated": "2018-02-15T15:10:45-06:00",
            ...
        }
    ]
}
```

### `/artwork-types/{id}`

A single artwork-types by the given identifier. {id} is the identifier from our collections managements system.

Example request: http://aggregator-data-test.artic.edu/api/v1/artwork-types/3?limit=2  
Example output:

```
{
    "data": {
        "id": 3,
        "title": "Sculpture",
        "lake_guid": "e2ed3e7c-d93f-7576-9a38-149daf99fba3",
        "is_boosted": false,
        "last_updated_source": "2018-01-12T13:58:01-06:00",
        "last_updated": "2018-02-15T15:10:45-06:00",
        ...
    }
}
```

## Categories

### `/categories`

A list of all categories sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](FIELDS.md#categories).

#### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

Example request: http://aggregator-data-test.artic.edu/api/v1/categories?limit=2  
Example output:

```
{
    "pagination": {
        "total": 790,
        "limit": 2,
        "offset": 0,
        "total_pages": 395,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/categories?page=2&limit=2"
    },
    "data": [
        {
            "id": 537,
            "title": "Paper Architecture: Case 4",
            "lake_guid": "59fd3f55-520c-6072-ace8-eb880b039b3a",
            "is_boosted": false,
            "parent_id": 426,
            "is_in_nav": false,
            ...
        },
        {
            "id": 562,
            "title": "Caricatures: Case 6",
            "lake_guid": "d1788815-07f2-9484-7b24-f898eb4ed2a2",
            "is_boosted": false,
            "parent_id": 426,
            "is_in_nav": false,
            ...
        }
    ]
}
```

### `/categories/search`

Search categories data in the aggregator. 

#### Available parameters:

* `q` - Your search query
* `query` - For complex queries, you can pass Elasticsearch domain syntax queries here
* `sort` - Used in conjunction with `query`
* `from` - Starting point of results. Pagination via Elasticsearch conventions
* `size` - Number of results to return. Pagination via Elasticsearch conventions
* `facets` - A comma-separated list of "count" aggregation facets to include in the results.

Example request: http://aggregator-data-test.artic.edu/api/v1/categories/search  
Example output:

```
{
    "preference": null,
    "pagination": {
        "total": 790,
        "limit": 10,
        "offset": 0,
        "total_pages": 79,
        "current_page": 1
    },
    "data": [
        {
            "_score": 2,
            "api_id": "99",
            "api_model": "categories",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/categories\/99",
            "id": 99,
            "title": "Painting 1800\u20131900",
            "timestamp": "2018-02-16T23:04:55-06:00"
        },
        {
            "_score": 2,
            "api_id": "84",
            "api_model": "categories",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/categories\/84",
            "id": 84,
            "title": "1900\u20131919",
            "timestamp": "2018-02-16T23:04:55-06:00"
        },
        {
            "_score": 2,
            "api_id": "491",
            "api_model": "categories",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/categories\/491",
            "id": 491,
            "title": "1980s",
            "timestamp": "2018-02-16T23:04:55-06:00"
        }
    ]
}
```

### `/categories/{id}`

A single categories by the given identifier. {id} is the identifier from our collections managements system.

Example request: http://aggregator-data-test.artic.edu/api/v1/categories/3?limit=2  
Example output:

```
{
    "data": {
        "id": 3,
        "title": "Art of the Americas",
        "lake_guid": "a3598772-5c42-3069-994c-68c88ce9aacd",
        "is_boosted": false,
        "parent_id": null,
        "is_in_nav": true,
        ...
    }
}
```

## Agent Types

### `/agent-types`

A list of all agent-types sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](FIELDS.md#agent-types).

#### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

Example request: http://aggregator-data-test.artic.edu/api/v1/agent-types?limit=2  
Example output:

```
{
    "pagination": {
        "total": 26,
        "limit": 2,
        "offset": 0,
        "total_pages": 13,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/agent-types?page=2&limit=2"
    },
    "data": [
        {
            "id": 1,
            "title": "Corporate Body",
            "lake_guid": "4fc9cef2-32d7-60a0-8ddd-335fd7800f29",
            "is_boosted": false,
            "last_updated_source": "2018-02-09T10:43:56-06:00",
            "last_updated": "2018-02-15T14:39:52-06:00",
            ...
        },
        {
            "id": 2,
            "title": "Culture",
            "lake_guid": "7b02ffea-6a50-4090-0898-f2ab89215d26",
            "is_boosted": false,
            "last_updated_source": "2018-02-09T10:43:57-06:00",
            "last_updated": "2018-02-15T14:39:52-06:00",
            ...
        }
    ]
}
```

### `/agent-types/{id}`

A single agent-types by the given identifier. {id} is the identifier from our collections managements system.

Example request: http://aggregator-data-test.artic.edu/api/v1/agent-types/1?limit=2  
Example output:

```
{
    "data": {
        "id": 1,
        "title": "Corporate Body",
        "lake_guid": "4fc9cef2-32d7-60a0-8ddd-335fd7800f29",
        "is_boosted": false,
        "last_updated_source": "2018-02-09T10:43:56-06:00",
        "last_updated": "2018-02-15T14:39:52-06:00",
        ...
    }
}
```

## Places

### `/places`

A list of all places sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](FIELDS.md#places).

#### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource
* `include` - A comma-separated list of subresource to embed in the returned resources. Available options are:
  * `categories`

Example request: http://aggregator-data-test.artic.edu/api/v1/places?limit=2  
Example output:

```
{
    "pagination": {
        "total": 12884,
        "limit": 2,
        "offset": 0,
        "total_pages": 6442,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/places?page=2&limit=2"
    },
    "data": [
        {
            "id": -2147482340,
            "title": "Gloucester",
            "lake_guid": "18944d03-3b7e-4b96-1c5a-a5a99558d158",
            "is_boosted": false,
            "type": "No location",
            "latitude": 42.6,
            ...
        },
        {
            "id": -2147477709,
            "title": "Munich",
            "lake_guid": "6ef2cbea-a84a-71ac-0e56-d0df1260f5a7",
            "is_boosted": false,
            "type": "No location",
            "latitude": 48.1333,
            ...
        }
    ]
}
```

### `/places/search`

Search places data in the aggregator. 

#### Available parameters:

* `q` - Your search query
* `query` - For complex queries, you can pass Elasticsearch domain syntax queries here
* `sort` - Used in conjunction with `query`
* `from` - Starting point of results. Pagination via Elasticsearch conventions
* `size` - Number of results to return. Pagination via Elasticsearch conventions
* `facets` - A comma-separated list of "count" aggregation facets to include in the results.

Example request: http://aggregator-data-test.artic.edu/api/v1/places/search  
Example output:

```
{
    "preference": null,
    "pagination": {
        "total": 12853,
        "limit": 10,
        "offset": 0,
        "total_pages": 1286,
        "current_page": 1
    },
    "data": [
        {
            "_score": 2,
            "api_id": "8400",
            "api_model": "places",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/places\/8400",
            "id": 8400,
            "title": "west vault flat file 99",
            "timestamp": "2018-02-15T15:28:20-06:00"
        },
        {
            "_score": 2,
            "api_id": "8399",
            "api_model": "places",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/places\/8399",
            "id": 8399,
            "title": "west vault flat file 98",
            "timestamp": "2018-02-15T15:28:18-06:00"
        },
        {
            "_score": 2,
            "api_id": "8365",
            "api_model": "places",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/places\/8365",
            "id": 8365,
            "title": "west vault flat file 64",
            "timestamp": "2018-02-15T15:28:19-06:00"
        }
    ]
}
```

### `/places/{id}`

A single places by the given identifier. {id} is the identifier from our collections managements system.

Example request: http://aggregator-data-test.artic.edu/api/v1/places/27406?limit=2  
Example output:

```
{
    "data": {
        "id": 27406,
        "title": "box c34325 Parada, Esther",
        "lake_guid": "25edc61c-01f7-f2e6-a80e-d82fae8ae36e",
        "is_boosted": false,
        "type": "AIC Storage",
        "latitude": 0,
        ...
    }
}
```

## Galleries

### `/galleries`

A list of all galleries sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](FIELDS.md#galleries).

#### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource
* `include` - A comma-separated list of subresource to embed in the returned resources. Available options are:
  * `categories`

Example request: http://aggregator-data-test.artic.edu/api/v1/galleries?limit=2  
Example output:

```
{
    "pagination": {
        "total": 257,
        "limit": 2,
        "offset": 0,
        "total_pages": 129,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/galleries?page=2&limit=2"
    },
    "data": [
        {
            "id": 2147480089,
            "title": "Gallery 108",
            "lake_guid": "d3c6b8f3-e4bb-54d7-aa82-6ec8b6a0bb97",
            "is_boosted": false,
            "type": "AIC Gallery",
            "is_closed": false,
            ...
        },
        {
            "id": 2147480090,
            "title": "Gallery 107",
            "lake_guid": "b5193a8d-0b10-9f9a-fded-9ae3d89b2b1e",
            "is_boosted": false,
            "type": "AIC Gallery",
            "is_closed": false,
            ...
        }
    ]
}
```

### `/galleries/search`

Search galleries data in the aggregator. 

#### Available parameters:

* `q` - Your search query
* `query` - For complex queries, you can pass Elasticsearch domain syntax queries here
* `sort` - Used in conjunction with `query`
* `from` - Starting point of results. Pagination via Elasticsearch conventions
* `size` - Number of results to return. Pagination via Elasticsearch conventions
* `facets` - A comma-separated list of "count" aggregation facets to include in the results.

Example request: http://aggregator-data-test.artic.edu/api/v1/galleries/search  
Example output:

```
{
    "preference": null,
    "pagination": {
        "total": 257,
        "limit": 10,
        "offset": 0,
        "total_pages": 26,
        "current_page": 1
    },
    "data": [
        {
            "_score": 2,
            "api_id": "2147483601",
            "api_model": "galleries",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/galleries\/2147483601",
            "id": 2147483601,
            "title": "Gallery 226",
            "timestamp": "2018-02-16T23:05:32-06:00"
        },
        {
            "_score": 2,
            "api_id": "2147483613",
            "api_model": "galleries",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/galleries\/2147483613",
            "id": 2147483613,
            "title": "Gallery 219",
            "timestamp": "2018-02-16T23:05:33-06:00"
        },
        {
            "_score": 2,
            "api_id": "2147478672",
            "api_model": "galleries",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/galleries\/2147478672",
            "id": 2147478672,
            "title": "Gallery 240",
            "timestamp": "2018-02-16T23:05:33-06:00"
        }
    ]
}
```

### `/galleries/{id}`

A single galleries by the given identifier. {id} is the identifier from our collections managements system.

Example request: http://aggregator-data-test.artic.edu/api/v1/galleries/26772?limit=2  
Example output:

```
{
    "data": {
        "id": 26772,
        "title": "Gallery 150",
        "lake_guid": "7bf43464-008d-02cc-ef4d-276705c7df3a",
        "is_boosted": false,
        "type": "AIC Gallery",
        "is_closed": false,
        ...
    }
}
```

## Exhibitions

### `/exhibitions`

A list of all exhibitions sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](FIELDS.md#exhibitions).

#### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource
* `include` - A comma-separated list of subresource to embed in the returned resources. Available options are:
  * `artworks`
  * `venues`
  * `sites`

Example request: http://aggregator-data-test.artic.edu/api/v1/exhibitions?limit=2  
Example output:

```
{
    "pagination": {
        "total": 6200,
        "limit": 2,
        "offset": 0,
        "total_pages": 3100,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/exhibitions?page=2&limit=2"
    },
    "data": [
        {
            "id": 257,
            "title": "Utamaro: Aspects of Beauty",
            "lake_guid": "37d8b387-7505-c981-3378-d7b85ae624a5",
            "is_boosted": false,
            "description": "Chosen from among approximately 300 works by Kitagawa Utamaro (c. 1753\u20131806) in the Art Institute\u2019s collection, this exhibition highlights some of the artist\u2019s most celebrated prints. It was Utamaro who gave us close-up portraits of beauties with pensive expressions, scenes of women engaged in everyday activities such as cooking, and images of women of every age against backgrounds that range from gray to yellow to brilliant (and luminescent) mica of various shades. Examples of each of these types of prints as well as illustrated books are on view.",
            "short_description": "This display includes some of the artist's most celebrated prints\u2014portraits of pensive beauties, scenes of women engaged in everyday activities, and images of women of every age.\n",
            ...
        },
        {
            "id": 1507,
            "title": "Spencer Finch: Lunar",
            "lake_guid": "22aa7acc-721d-9307-1be2-d0134852456c",
            "is_boosted": false,
            "description": "Throughout his career, American artist Spencer Finch has used color and light as primary subjects\u2014and materials\u2014in his drawings, photographs, mixed media projects, and large-scale installations. Best known for exploring ideas about memory and perception, the artist often employs a colorimeter, a device that measures the average color and temperature of light that exists naturally in a specific place and time. With this information in hand, Finch reconstructs the luminosity of the location through artificial means.\n\nFor his solo project at the Art Institute, Finch has created a solar-powered \u201clunar lander module\u201d that uses energy from sunlight to power a geodesic dome\u2013shaped object\u2014a \u201cbuckyball\u201d that resembles the carbon molecules named for visionary architect Buckminster Fuller\u2014positioned on top of the lander. Installed on the open-air Bluhm Family Terrace, Lunar will glow during the evening hours the color of moonlight\u2014the exact light measured from the full moon over Chicago in July 2011.\n\n\u201cLike just about everyone, I wanted to make a picture of the moon or, more specifically, of moonlight,\u201d Finch said about the project. \u201cI have always loved nocturnes and the impossible attempts to paint near-darkness in near-darkness. I figured there were probably enough literal pictures of the moon, so I began thinking about the form of moonlight and how it is actually reflected sunlight. This led me to explore the use of solar power to generate the light of the moon. The structure of the lunar module and the buckyball followed in short order\u2014I thought it would be fun to imagine that a lunar module returning from the moon with moonlight on board landed on top of the Art Institute.\u201d\n\nSponsor\nThis exhibition is organized by the Art Institute of Chicago with major funding from the Bluhm Family Endowment Fund. The fund supports exhibitions of modern and contemporary sculpture, which may consist of existing works drawn from the Art Institute\u2019s permanent collection or borrowed from other collections private and public, or new works commissioned specifically for this site. Generous support is provided by the Exhibitions Trust: Goldman Sachs, Kenneth and Anne Griffin, Thomas and Margot Pritzker, the Earl and Brenda Shapiro Foundation, Donna and Howard Stone, and Melinda and Paul Sullivan.",
            "short_description": "Throughout his career, American artist Spencer Finch has used color and light as primary subjects\u2014and materials\u2014in his drawings, photographs, mixed media projects, and large-scale installations. Best known for exploring ideas about memory and perception, the artist often employs a colorimeter, a device that measures the average color and temperature of light that exists naturally in a specific place and time. With this information in hand, Finch reconstructs the luminosity of the location through artificial means.",
            ...
        }
    ]
}
```

### `/exhibitions/search`

Search exhibitions data in the aggregator. 

#### Available parameters:

* `q` - Your search query
* `query` - For complex queries, you can pass Elasticsearch domain syntax queries here
* `sort` - Used in conjunction with `query`
* `from` - Starting point of results. Pagination via Elasticsearch conventions
* `size` - Number of results to return. Pagination via Elasticsearch conventions
* `facets` - A comma-separated list of "count" aggregation facets to include in the results.

Example request: http://aggregator-data-test.artic.edu/api/v1/exhibitions/search  
Example output:

```
{
    "preference": null,
    "pagination": {
        "total": 6200,
        "limit": 10,
        "offset": 0,
        "total_pages": 620,
        "current_page": 1
    },
    "data": [
        {
            "_score": 2,
            "api_id": "4878",
            "api_model": "exhibitions",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/exhibitions\/4878",
            "id": 4878,
            "title": "Atlan Ceramic Art Club 25th Annual",
            "timestamp": "2018-02-21T14:24:15-06:00"
        },
        {
            "_score": 2,
            "api_id": "4872",
            "api_model": "exhibitions",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/exhibitions\/4872",
            "id": 4872,
            "title": "Paintings from Collection of late R. Hall McCormick",
            "timestamp": "2018-02-21T14:24:15-06:00"
        },
        {
            "_score": 2,
            "api_id": "4862",
            "api_model": "exhibitions",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/exhibitions\/4862",
            "id": 4862,
            "title": "Students of the Art Institute Annual",
            "timestamp": "2018-02-21T14:24:16-06:00"
        }
    ]
}
```

### `/exhibitions/{id}`

A single exhibitions by the given identifier. {id} is the identifier from our collections managements system.

Example request: http://aggregator-data-test.artic.edu/api/v1/exhibitions/1302?limit=2  
Example output:

```
{
    "data": {
        "id": 1302,
        "title": "Impressionism, Fashion, and Modernity",
        "lake_guid": "3254ccb1-0786-3b5d-004f-19a0f324106a",
        "is_boosted": false,
        "description": "Were the Impressionists fashionistas? And what role did fashion play in their goal to paint modern life with a \u201cmodern\u201d style? This is the subject of the internationally acclaimed exhibition Impressionism, Fashion, and Modernity, the first to uncover the fascinating relationship between art and fashion from the mid-1860s through the mid-1880s as Paris became the style capital of the world. Featuring 75 major figure paintings by Caillebotte, Degas, Manet, Monet, Renoir, and Seurat, including many never before seen in North America, this stylish show presents a new perspective on the Impressionists\u2014revealing how these early avant-garde artists embraced fashion trends as they sought to capture modern life on canvas.\n\nIn the second half of the 19th century, the modern fashion industry was born: designers like Charles Frederick Worth were transforming how clothing was made and marketed, department stores were on the rise, and fashion magazines were beginning to proliferate. Visual artists and writers alike were intrigued by this new industry; its dynamic, ephemeral, and constantly innovative qualities embodied the very essence of modernity that they sought to express in their work and offered a means of discovering new visual and verbal expressions.\n\nThis groundbreaking exhibition explores the vital relationship between fashion and art during these pivotal years not only through the masterworks by Impressionists but also with paintings by fashion portraitists Jean B\u00e9raud, Carolus-Duran, Alfred Stevens, and James Tissot. Period costumes such as men\u2019s suits, robes de promenade, day dresses, and ball gowns, along with fashion plates, photographs, and popular prints offer a firsthand look at the apparel these artists used to convey their modernity as well as that of their subjects. Further enriching the display are fabrics and accessories\u2014lace, silks, velvets, and satins found in hats, parasols, gloves, and shoes\u2014recreating the sensory experience that made fashion an industry favorite and a serious subject among painters, writers, poets, and the popular press.\n\nTruly bringing the exhibition to life are the vivid connections between the most up-to-the-minute fashions and the painted transformations of the same styles. Pairing life-size figure paintings by Monet, Renoir, or Tissot with the contemporary outfits that inspired them, the show invites inquiry into the difference between portrait and genre painting, between Tissot\u2019s painted fashion plates and Manet\u2019s images of life experienced, demonstrating for the first time the means by which the Impressionists \u201cfashioned\u201d their models\u2014and paintings\u2014for larger artistic goals.",
        "short_description": null,
        ...
    }
}
```

### `/exhibitions/{id}/artworks`

The artworks for a given exhibitions.

Example request: http://aggregator-data-test.artic.edu/api/v1/exhibitions/1302/artworks?limit=2  
Example output:

```
{
    "data": []
}
```

### `/exhibitions/{id}/venues`

The venues for a given exhibitions.

Example request: http://aggregator-data-test.artic.edu/api/v1/exhibitions/1302/venues?limit=2  
Example output:

```
{
    "data": [
        {
            "id": 1445,
            "title": null,
            "lake_guid": null,
            "agent_title": "Mus\u00e9e d'Orsay",
            "agent_id": 93515,
            "exhibition_title": "Impressionism, Fashion, and Modernity",
            ...
        },
        {
            "id": 1446,
            "title": null,
            "lake_guid": null,
            "agent_title": "The Metropolitan Museum of Art",
            "agent_id": 25885,
            "exhibition_title": "Impressionism, Fashion, and Modernity",
            ...
        },
        {
            "id": 1447,
            "title": null,
            "lake_guid": null,
            "agent_title": "The Art Institute of Chicago",
            "agent_id": 25739,
            "exhibition_title": "Impressionism, Fashion, and Modernity",
            ...
        }
    ]
}
```

## Images

### `/images`

A list of all images sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](FIELDS.md#images).

#### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource
* `include` - A comma-separated list of subresource to embed in the returned resources. Available options are:
  * `categories`
  * `artworks`

Example request: http://aggregator-data-test.artic.edu/api/v1/images?limit=2  
Example output:

```
{
    "pagination": {
        "total": 110323,
        "limit": 2,
        "offset": 0,
        "total_pages": 55162,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/images?page=2&limit=2"
    },
    "data": [
        {
            "id": "0b1ebee7-c06a-c363-bc50-6b9ff1263eb2",
            "title": "PH_02534",
            "is_boosted": false,
            "type": "image",
            "description": null,
            "content": null,
            ...
        },
        {
            "id": "1745f47c-4383-7b12-bd6f-e9c60036dd63",
            "title": "214109",
            "is_boosted": false,
            "type": "image",
            "description": null,
            "content": null,
            ...
        }
    ]
}
```

### `/images/search`

Search images data in the aggregator. 

#### Available parameters:

* `q` - Your search query
* `query` - For complex queries, you can pass Elasticsearch domain syntax queries here
* `sort` - Used in conjunction with `query`
* `from` - Starting point of results. Pagination via Elasticsearch conventions
* `size` - Number of results to return. Pagination via Elasticsearch conventions
* `facets` - A comma-separated list of "count" aggregation facets to include in the results.

Example request: http://aggregator-data-test.artic.edu/api/v1/images/search  
Example output:

```
{
    "preference": null,
    "pagination": {
        "total": 110322,
        "limit": 10,
        "offset": 0,
        "total_pages": 11033,
        "current_page": 1
    },
    "data": [
        {
            "_score": 2,
            "api_id": "4c6ff249-5501-55b0-13d9-274122c3d974",
            "api_model": "images",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/images\/4c6ff249-5501-55b0-13d9-274122c3d974",
            "id": "4c6ff249-5501-55b0-13d9-274122c3d974",
            "title": "Masthead\/Headline: Soviet Bombs Berlin",
            "timestamp": "2018-02-17T00:10:46-06:00"
        },
        {
            "_score": 2,
            "api_id": "c46a0316-75dd-eaba-af35-511c49165eaf",
            "api_model": "images",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/images\/c46a0316-75dd-eaba-af35-511c49165eaf",
            "id": "c46a0316-75dd-eaba-af35-511c49165eaf",
            "title": "Poster: Kill Him",
            "timestamp": "2018-02-17T00:10:46-06:00"
        },
        {
            "_score": 2,
            "api_id": "43e6d12e-651f-a6d0-5372-95c741eb7b7d",
            "api_model": "images",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/images\/43e6d12e-651f-a6d0-5372-95c741eb7b7d",
            "id": "43e6d12e-651f-a6d0-5372-95c741eb7b7d",
            "title": "Photograph: Yanks in Germany Show Their Excitement over the News of the Russian Drive",
            "timestamp": "2018-02-17T00:10:46-06:00"
        }
    ]
}
```

### `/images/{id}`

A single images by the given identifier. {id} is the identifier from our collections managements system.

Example request: http://aggregator-data-test.artic.edu/api/v1/images/c972e5d7-0667-6904-d919-bbeefeae0a10?limit=2  
Example output:

```
{
    "data": {
        "id": "c972e5d7-0667-6904-d919-bbeefeae0a10",
        "title": "IM011631",
        "is_boosted": false,
        "type": "image",
        "description": null,
        "content": null,
        ...
    }
}
```

## Videos

### `/videos`

A list of all videos sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](FIELDS.md#videos).

#### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource
* `include` - A comma-separated list of subresource to embed in the returned resources. Available options are:
  * `categories`
  * `artworks`

Example request: http://aggregator-data-test.artic.edu/api/v1/videos?limit=2  
Example output:

```
{
    "pagination": {
        "total": 312,
        "limit": 2,
        "offset": 0,
        "total_pages": 156,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/videos?page=2&limit=2"
    },
    "data": [
        {
            "id": "076c371c-f8f6-4e1f-8a0c-87f8d0de922e",
            "title": "Family Activity: Design a Robe!",
            "is_boosted": false,
            "type": "video",
            "description": "<h3>Introduction:<\/h3>\n<p>About 250 years ago, a man wore this <em>Robe (Jifu)<\/em> in China.  It is made of silk, which was a highly valued fabric made from the fibers found inside of a silkworm\u2019s cocoon. During this time in China, silk robes were often decorated with <a href=\"#symbolic\">symbolic<\/a> images, which represented for an object or idea. For example, along the hem of the robe there are mountains that rise from ocean waves, possibly symbolizing the ability of the Chinese ruler to tower over his subjects. Dragons were often used to show the energy of the universe, and dragons with five claws symbolized the Emperor and his imperial court.  This robe displays many symbols, including images that are related to <a href=\"#buddhism\">Buddhism <\/a> and <a href=\"#taoism\">Taoism<\/a>.<\/p>\n<div class=\"image wrap\">\n<p><a href=\"http:\/\/www.artic.edu\/aic\/collections\/artwork\/68711\"><img src=\"http:\/\/www.artic.edu\/aic\/collections\/citi\/resources\/_erfimages\/E38850.jpg\" border=\"0\" class=\"inline\" \/><\/a><\/p>\n<\/div>\n<h3>Discussion Questions:<\/h3>\nLook at the painting carefully.\n<ul>\n<li>This robe displays images of the Eight Buddhist Symbols. Use the <a href=\"http:\/\/www.artic.edu\/aic\/collections\/exhibitions\/Chinese\/artwork\/68711\/zoomify\">zoom function<\/a> to find the following images:\n<ul>\t<li>Conch shell<\/li>\t<li>Dharma wheel<\/li>\t<li>Victory Banner (also known as the Banner of Spirituality)<\/li>\t<li>Treasure Vase<\/li>\t<li>Parasol (Umbrella)<\/li>\t<li>Pair of Fish<\/li>\t<li>Lotus<\/li>\t<li>Endless Knot<\/li>\n<\/ul><\/li>\n<li>Look at what you are wearing right now. What do you think people living 250 years in the future might know about you only by looking at these clothes?<\/li>\n<li>Think about the people and things that are important to you, such as family members, hobbies, pets, or favorite foods.  What symbols would you use to represent these important people and things?<\/li>\n<\/ul>\n<br \/>\n<h3>Activity:<\/h3>\n<p>Design a robe that displays who you are!<\/p>\n<br \/>\n<h3>Materials Needed:<\/h3>\n<ul>\n<li>Robe template<\/li>\n<li>Paper<\/li>\n<li>Colored pencils, markers, and\/or crayons<\/li>\n<\/ul>\n<em>Optional:<\/em>\n<ul>\n<li>Paint (watercolor or poster paint) and paintbrushes<\/li>\n<li>Construction paper<\/li>\n<li>Scissors<\/li>\n<li>Glue<\/li>\n<li>Magazines or newspapers<\/li>\n<\/ul>\n<h3>Steps:<\/h3>\n<strong><em>Brainstorm!<\/em><\/strong>\n<ol>\n<li>Make a list of the things that you want others to know about you, such as your hobbies, favorite subjects in school, or your family.<\/li>\n<li>Choose the things on your list that you find most important. These are the ideas you will use to decorate your robe.<\/li>\n<li>Create a symbol (picture) that represents each of these things.  For example, if you like basketball you may want to draw a picture of a basketball or if you like reading you may want to draw your favorite book. Or, cut out your symbols from magazines or using construction paper.<\/li>\n<\/ol><br \/>\n<strong><em>Create!<\/em><\/strong>\n<ol>\n<li>Print out the robe template. <\/li>\n<li>Select a background color for your robe. If you plan to draw your symbols, color in the background at the end.  If you plan to glue your symbols, make sure to add your background color first.<\/li>\n<li>Decorate your robe with the symbols you created.  Notice that many of the on this Jifu appear in the exact same location on the right side. This kind of arrangement is called bilateral symmetry, or mirror symmetry.  Try to arrange your symbols in the same way.<\/li>\n<\/ol><br \/>\n<p><strong><em>Share!<\/em><\/strong><p>\n<p>Show your finished robe to a friend or family member and explain what the symbols tell about you.<\/p><br \/>\n<h3>Glossary<\/h3>\n<p><strong><a name=\"buddhism\" id=\"buddhism\"><\/a>Buddhism<\/strong> (<em>n<\/em>)<br \/>\ndefinition of Buddhism<\/p>\n<p><strong><a name=\"symbolic\" id=\"symbolic\"><\/a>symbolic<\/strong> (<em>adj<\/em>)<br \/>\ndefinition of symbolic<\/p>\n<p><strong><a name=\"taoism\" id=\"taoism\"><\/a>Taoism<\/strong> (<em>n<\/em>)<br \/>\ndefinition of Taoism<\/p>\n<\/div>",
            "content": null,
            ...
        },
        {
            "id": "160643f1-0efe-3834-5acd-62f130d6cc3d",
            "title": "Video: Acceptance of Impressionism in America",
            "is_boosted": false,
            "type": "video",
            "description": "Hear why Impressionism was criticized in the 1870s and meet individuals like Mrs. Potter Palmer who supported it and brought it to Chicago.",
            "content": "http:\/\/www.artic.edu\/aic\/collections\/citi\/resources\/327.flv",
            ...
        }
    ]
}
```

### `/videos/search`

Search videos data in the aggregator. 

#### Available parameters:

* `q` - Your search query
* `query` - For complex queries, you can pass Elasticsearch domain syntax queries here
* `sort` - Used in conjunction with `query`
* `from` - Starting point of results. Pagination via Elasticsearch conventions
* `size` - Number of results to return. Pagination via Elasticsearch conventions
* `facets` - A comma-separated list of "count" aggregation facets to include in the results.

Example request: http://aggregator-data-test.artic.edu/api/v1/videos/search  
Example output:

```
{
    "preference": null,
    "pagination": {
        "total": 312,
        "limit": 10,
        "offset": 0,
        "total_pages": 32,
        "current_page": 1
    },
    "data": [
        {
            "_score": 2,
            "api_id": "a618fd16-d028-5264-6f4b-7da5158fc9cb",
            "api_model": "videos",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/videos\/a618fd16-d028-5264-6f4b-7da5158fc9cb",
            "id": "a618fd16-d028-5264-6f4b-7da5158fc9cb",
            "title": "Video: Case Studies in Modern and Contemporary Sculpture: David Smith and Anthony Caro",
            "timestamp": "2018-02-17T00:09:25-06:00"
        },
        {
            "_score": 2,
            "api_id": "f4b8bd70-5961-02ef-9495-56162fe094c4",
            "api_model": "videos",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/videos\/f4b8bd70-5961-02ef-9495-56162fe094c4",
            "id": "f4b8bd70-5961-02ef-9495-56162fe094c4",
            "title": "Video: Honoring the Asante King, Kumasi, Ghana",
            "timestamp": "2018-02-17T00:09:25-06:00"
        },
        {
            "_score": 2,
            "api_id": "58d41fd0-7853-6073-79f2-376ae8d366c3",
            "api_model": "videos",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/videos\/58d41fd0-7853-6073-79f2-376ae8d366c3",
            "id": "58d41fd0-7853-6073-79f2-376ae8d366c3",
            "title": "Video: Lecture with Mary Heilmann",
            "timestamp": "2018-02-17T00:09:25-06:00"
        }
    ]
}
```

### `/videos/{id}`

A single videos by the given identifier. {id} is the identifier from our collections managements system.

Example request: http://aggregator-data-test.artic.edu/api/v1/videos/8199a3c6-99fa-582d-449a-bc9221db54da?limit=2  
Example output:

```
{
    "data": {
        "id": "8199a3c6-99fa-582d-449a-bc9221db54da",
        "title": "Video: Cassatt and the Modern Woman",
        "is_boosted": false,
        "type": "video",
        "description": "An introduction to Cassatt's paintings of women involved in morning activities in the privacy of their bourgeois homes.",
        "content": "http:\/\/www.artic.edu\/aic\/collections\/citi\/resources\/530.flv",
        ...
    }
}
```

## Links

### `/links`

A list of all links sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](FIELDS.md#links).

#### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource
* `include` - A comma-separated list of subresource to embed in the returned resources. Available options are:
  * `categories`
  * `artworks`

Example request: http://aggregator-data-test.artic.edu/api/v1/links?limit=2  
Example output:

```
{
    "pagination": {
        "total": 142,
        "limit": 2,
        "offset": 0,
        "total_pages": 71,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/links?page=2&limit=2"
    },
    "data": [
        {
            "id": "1ac6c73b-e560-5fc9-05fb-8e2c30eccdc0",
            "title": "Text: The Bartletts and the Grande Jatte:  Collecting Modern Painting in the 1920s",
            "is_boosted": false,
            "type": "link",
            "description": "The fascinating story of the collectors' love of modern art and their acquisiton of  Seurat's famous painting in 1924.",
            "content": null,
            ...
        },
        {
            "id": "316671be-a9f3-603a-e387-7d6652cc6309",
            "title": "Audio Lecture: Where Art and Science Meet\u2014Unlocking the Secrets of the Collection with High-Tech Scientific Tools",
            "is_boosted": false,
            "type": "link",
            "description": "<p>Francesca Casadio, Andrew W. Mellon Conservation Scientist at the Art Institute of Chicago, leads a talk that is part forensic science, part detective work. Examples of research carried out on selected objects from the collection are given.<\/p>",
            "content": null,
            ...
        }
    ]
}
```

### `/links/search`

Search links data in the aggregator. 

#### Available parameters:

* `q` - Your search query
* `query` - For complex queries, you can pass Elasticsearch domain syntax queries here
* `sort` - Used in conjunction with `query`
* `from` - Starting point of results. Pagination via Elasticsearch conventions
* `size` - Number of results to return. Pagination via Elasticsearch conventions
* `facets` - A comma-separated list of "count" aggregation facets to include in the results.

Example request: http://aggregator-data-test.artic.edu/api/v1/links/search  
Example output:

```
{
    "preference": null,
    "pagination": {
        "total": 142,
        "limit": 10,
        "offset": 0,
        "total_pages": 15,
        "current_page": 1
    },
    "data": [
        {
            "_score": 2,
            "api_id": "cdbe4fd0-4fce-0c09-73fc-23816df0c718",
            "api_model": "links",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/links\/cdbe4fd0-4fce-0c09-73fc-23816df0c718",
            "id": "cdbe4fd0-4fce-0c09-73fc-23816df0c718",
            "title": "Turning the Pages:  Jacobellus of Salerno (active around 1270), Gradual Manuscript, about 1270",
            "timestamp": "2018-02-17T00:09:23-06:00"
        },
        {
            "_score": 2,
            "api_id": "763ab38a-d299-ccf6-b35b-e918d09550c3",
            "api_model": "links",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/links\/763ab38a-d299-ccf6-b35b-e918d09550c3",
            "id": "763ab38a-d299-ccf6-b35b-e918d09550c3",
            "title": "The Alfred Stieglitz Collection at the Art Institute of Chicago",
            "timestamp": "2018-02-17T00:09:23-06:00"
        },
        {
            "_score": 2,
            "api_id": "12af57aa-9338-35a0-bd9c-658bb31e9d3f",
            "api_model": "links",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/links\/12af57aa-9338-35a0-bd9c-658bb31e9d3f",
            "id": "12af57aa-9338-35a0-bd9c-658bb31e9d3f",
            "title": "Turning the Pages: Jacques-Louis David, (French, 1748\u20131825) Sketchbook, 1809\/10",
            "timestamp": "2018-02-17T00:09:23-06:00"
        }
    ]
}
```

### `/links/{id}`

A single links by the given identifier. {id} is the identifier from our collections managements system.

Example request: http://aggregator-data-test.artic.edu/api/v1/links/3990a5f5-2ae9-3c7b-2fb8-1b0438962cd3?limit=2  
Example output:

```
{
    "data": {
        "id": "3990a5f5-2ae9-3c7b-2fb8-1b0438962cd3",
        "title": "Student Tours: Visit Information",
        "is_boosted": false,
        "type": "link",
        "description": "Information on planning a student tour: application dates, reservation and museum contact information.",
        "content": "http:\/\/www.artic.edu\/aic\/students\/tours\/index.html",
        ...
    }
}
```

## Sounds

### `/sounds`

A list of all sounds sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](FIELDS.md#sounds).

#### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource
* `include` - A comma-separated list of subresource to embed in the returned resources. Available options are:
  * `categories`
  * `artworks`

Example request: http://aggregator-data-test.artic.edu/api/v1/sounds?limit=2  
Example output:

```
{
    "pagination": {
        "total": 1020,
        "limit": 2,
        "offset": 0,
        "total_pages": 510,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/sounds?page=2&limit=2"
    },
    "data": [
        {
            "id": "e7c899fa-b566-3c49-d221-632fbd8ed765",
            "title": "925.mp3",
            "is_boosted": false,
            "type": "sound",
            "description": null,
            "content": null,
            ...
        },
        {
            "id": "0a9dc20c-f384-990b-43dc-c51b24cb5a72",
            "title": "569.mp3",
            "is_boosted": false,
            "type": "sound",
            "description": null,
            "content": null,
            ...
        }
    ]
}
```

### `/sounds/search`

Search sounds data in the aggregator. 

#### Available parameters:

* `q` - Your search query
* `query` - For complex queries, you can pass Elasticsearch domain syntax queries here
* `sort` - Used in conjunction with `query`
* `from` - Starting point of results. Pagination via Elasticsearch conventions
* `size` - Number of results to return. Pagination via Elasticsearch conventions
* `facets` - A comma-separated list of "count" aggregation facets to include in the results.

Example request: http://aggregator-data-test.artic.edu/api/v1/sounds/search  
Example output:

```
{
    "preference": null,
    "pagination": {
        "total": 1020,
        "limit": 10,
        "offset": 0,
        "total_pages": 102,
        "current_page": 1
    },
    "data": [
        {
            "_score": 2,
            "api_id": "7b141e3d-b77f-b0e7-e4d0-97cd0f732064",
            "api_model": "sounds",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/sounds\/7b141e3d-b77f-b0e7-e4d0-97cd0f732064",
            "id": "7b141e3d-b77f-b0e7-e4d0-97cd0f732064",
            "title": "Audio Lecture: Closing Conversation with Ed Ruscha",
            "timestamp": "2018-02-17T00:09:41-06:00"
        },
        {
            "_score": 2,
            "api_id": "8fdc4987-3e96-3383-9f0c-d9b9ba048a88",
            "api_model": "sounds",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/sounds\/8fdc4987-3e96-3383-9f0c-d9b9ba048a88",
            "id": "8fdc4987-3e96-3383-9f0c-d9b9ba048a88",
            "title": "Audio Lecture: Exhibit the Collection",
            "timestamp": "2018-02-17T00:09:41-06:00"
        },
        {
            "_score": 2,
            "api_id": "ec435396-f58e-27e5-1277-1d002f8dda47",
            "api_model": "sounds",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/sounds\/ec435396-f58e-27e5-1277-1d002f8dda47",
            "id": "ec435396-f58e-27e5-1277-1d002f8dda47",
            "title": "Musecast: March 2007",
            "timestamp": "2018-02-17T00:09:41-06:00"
        }
    ]
}
```

### `/sounds/{id}`

A single sounds by the given identifier. {id} is the identifier from our collections managements system.

Example request: http://aggregator-data-test.artic.edu/api/v1/sounds/0dc99580-0a4c-c047-31e9-f42d29ac020e?limit=2  
Example output:

```
{
    "data": {
        "id": "0dc99580-0a4c-c047-31e9-f42d29ac020e",
        "title": "Audio Lecture: Sally Mann at the Art Institute of Chicago",
        "is_boosted": false,
        "type": "sound",
        "description": "<p>Tune in as contemporary photographer Mann answers questions from an audience of nearly 400 on opening day of the Art Institute exhibition <em>So the Story Goes<\/em>. Mann responds to questions ranging from printing techniques to subject matter, from disbelief in photographic \"truth\" to a Southern weakness for the romantic.<\/p>",
        "content": "http:\/\/www.artic.edu\/aic\/collections\/citi\/resources\/691_mann.mp3",
        ...
    }
}
```

## Texts

### `/texts`

A list of all texts sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](FIELDS.md#texts).

#### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource
* `include` - A comma-separated list of subresource to embed in the returned resources. Available options are:
  * `categories`
  * `artworks`

Example request: http://aggregator-data-test.artic.edu/api/v1/texts?limit=2  
Example output:

```
{
    "pagination": {
        "total": 601,
        "limit": 2,
        "offset": 0,
        "total_pages": 301,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/texts?page=2&limit=2"
    },
    "data": [
        {
            "id": "0de7088d-00e1-5d1f-2e42-8fd0dfe6cc1a",
            "title": "Overview: Twachtman's Seasonal Exploration and Depiction of <em>The White Bridge<\/em>",
            "is_boosted": false,
            "type": "text",
            "description": " An overview of Twachtman's paintings of his Connecticut property and a look at his joyous image of springtime and of human construction in harmony with nature.    ",
            "content": "For John Henry Twachtman, Cos Cob, Connecticut, was a source of never-ending artistic inspiration. He purchased property there in 1889, and, over the following decade, made improvements to his house and surrounding land. In 1895 he added a trellised, white footbridge, which spanned Horseneck Brook. Twachtman carefully selected the proportions and color of the structure to enhance the site\u2019s inherent aesthetic qualities. He then made at least five paintings of the bridge from different vantage points, exploring its relationship to both the man-made and natural world. These works are contemporaneous with Claude Monet\u2019s pictures of the Japanese bridge over his water-lily pond at Giverny; although Twachtman was less methodical (and less prolific) than Monet, he worked with a similarly palpable love of place. <br><br>\n The Art Institute\u2019s <em>White Bridge<\/em> is a vivid, joyous image of springtime that complements <em>Icebound<\/em>, Twachtman\u2019s rendition of the same brook in winter. Delineated with bright, white paint, the bridge crosses over the reflective surface of the water and stands out sharply through transparent trees in the foreground. The light, feathery strokes that compose the bridge echo those used to trace the limbs and branches of the surrounding hemlocks. The artist thus used brushwork to unify forms on the surface of the canvas, as he had made an effort to integrate the bridge itself into the Cos Cob setting. Twachtman\u2019s desire to show human construction in harmony with nature indicates his concern\u2014widespread at the turn of the twentieth century\u2014about the effects of urban and industrial growth. A witness to (and participant in) the suburbanization of rural Connecticut, Twachtman lamented the threat posed to the pastoral landscape he loved.\n",
            ...
        },
        {
            "id": "12ee437a-24a2-d760-bd05-2974fe2e0403",
            "title": "Introduction: Renoir's Portrait of Alfred Sisley",
            "is_boosted": false,
            "type": "text",
            "description": "An introduction to Renoir's casual and thoughtful portrait of friend and artist Alfred Sisley.  ",
            "content": "Pierre Auguste Renoir and Alfred Sisley had known each other for more than ten years, having met in the studio of Charles Gleyre in 1862, when Renoir executed this portrait. Although the two men were of different backgrounds\u2014Sisley came from a middle-class family and had initially intended to join his father\u2019s business, while Renoir, the son of a tailor and a dressmaker, had trained as an apprentice porcelain painter\u2014they shared a passion for art. Renoir later recalled their student excursions to picturesque areas outside of Paris: \"I would take my paint box and a shirt, and Sisley and I would leave Fontainebleau, and walk until we reached a village. Sometimes we did not come back until we had run out of money a week later.\" <br><br>\n In Renoir\u2019s portrait, Sisley sits casually astride a bamboo chair, resting his head on his left hand, his eyes lowered and gently averted. The shallow, dark room is pierced only by a window at the upper right. Although the composition\u2019s dominant tonality is blue, its mood is not melancholy; rather, Sisley appears thoughtful and serene, something of a dreamer. No clues, such as brushes or a palette, hint at his vocation, so perhaps Renoir intended to refer to his subject\u2019s identity as an artist more indirectly, through his romantic characterization. <br><br>\n This was one of six portraits that Renoir sent to the third Impressionist exhibition, held in 1877. The work can be seen as a document of the two men\u2019s shared aim, at this point in their careers, to achieve artistic success through avant-garde rather than official means, and of Renoir\u2019s specific aspiration to become known as a portrait painter. More importantly, however, its affectionate quality makes it a representation of friendship.\n\n\n",
            ...
        }
    ]
}
```

### `/texts/search`

Search texts data in the aggregator. 

#### Available parameters:

* `q` - Your search query
* `query` - For complex queries, you can pass Elasticsearch domain syntax queries here
* `sort` - Used in conjunction with `query`
* `from` - Starting point of results. Pagination via Elasticsearch conventions
* `size` - Number of results to return. Pagination via Elasticsearch conventions
* `facets` - A comma-separated list of "count" aggregation facets to include in the results.

Example request: http://aggregator-data-test.artic.edu/api/v1/texts/search  
Example output:

```
{
    "preference": null,
    "pagination": {
        "total": 601,
        "limit": 10,
        "offset": 0,
        "total_pages": 61,
        "current_page": 1
    },
    "data": [
        {
            "_score": 2,
            "api_id": "a861a6cb-873b-544e-0b07-216be282459f",
            "api_model": "texts",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/texts\/a861a6cb-873b-544e-0b07-216be282459f",
            "id": "a861a6cb-873b-544e-0b07-216be282459f",
            "title": "Departmental Gallery Exhibition: Chicago Stories: Prints and H. C. Westermann--See America First",
            "timestamp": "2018-02-17T00:09:34-06:00"
        },
        {
            "_score": 2,
            "api_id": "9ff783bd-7f7b-a257-48b7-fdd59a795a67",
            "api_model": "texts",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/texts\/9ff783bd-7f7b-a257-48b7-fdd59a795a67",
            "id": "9ff783bd-7f7b-a257-48b7-fdd59a795a67",
            "title": "Historic Collections: The James and Marilynn Alsdorf Collection",
            "timestamp": "2018-02-17T00:09:34-06:00"
        },
        {
            "_score": 2,
            "api_id": "495776c4-18c9-07bd-f193-3929f16636a0",
            "api_model": "texts",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/texts\/495776c4-18c9-07bd-f193-3929f16636a0",
            "id": "495776c4-18c9-07bd-f193-3929f16636a0",
            "title": "Early Biography: Margaret T. Burroughs",
            "timestamp": "2018-02-17T00:09:34-06:00"
        }
    ]
}
```

### `/texts/{id}`

A single texts by the given identifier. {id} is the identifier from our collections managements system.

Example request: http://aggregator-data-test.artic.edu/api/v1/texts/28f4641e-c040-7669-6036-f6fce1e25514?limit=2  
Example output:

```
{
    "data": {
        "id": "28f4641e-c040-7669-6036-f6fce1e25514",
        "title": "Examination: Rodin's <em>Adam<\/em>",
        "is_boosted": false,
        "type": "text",
        "description": "An exploration of Rodin's ability to convey physical and emotional torment in his towering sculpture of Adam.",
        "content": "With his right leg raised and his torso tensed and wrenched into an unnatural position, Auguste Rodin\u2019s <em>Adam<\/em> appears horribly disfigured, despite his idealized proportions and serene facial expression. His right arm and hand, perhaps drawn from Michelangelo\u2019s figure of Adam at the center of the Sistine Chapel ceiling, point emphatically downward, as if to indicate the fall of man, while his left hand desperately clutches his right knee. \"I . . . tried to express the inner feelings of the man by the mobility of the muscles,\" wrote the artist about this piece. The rigid musculature of the figure\u2019s hands and legs, the twisted trunk of the body, and the emphatic straining of the head, as neck and shoulder collapse into a nearly horizontal plane, all serve to convey a sense of physical pain, certainly related to the emotional torment of having been banished by God from Paradise. <br><br>\n Rodin originally intended his towering, contorted sculpture of <em>Adam<\/em> and its pendant, <em>Eve<\/em>, to flank the <em>Gates of Hell<\/em>, a monumental bronze doorway of bas-reliefs illustrating various cantos from Dante\u2019s <em>Divine Comedy<\/em>. The doorway\u2014capped by looming representations of the three shades, which repeat the basic form of Adam\u2014was commissioned by the French government in 1880 for a new museum of decorative arts in Paris. The museum was never built, and Rodin left the portal unfinished at his death. Nevertheless, the project became well known during the artist\u2019s lifetime, for he cast individual figures and groups, some of which appeared in a large exhibition of works by Rodin and Claude Monet held at the prestigious Parisian gallery of Georges Petit in 1889.",
        ...
    }
}
```

# Shop

## Shop Categories

### `/shop-categories`

A list of all shop-categories sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](FIELDS.md#shop-categories).

#### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource
* `include` - A comma-separated list of subresource to embed in the returned resources. Available options are:
  * `children`

Example request: http://aggregator-data-test.artic.edu/api/v1/shop-categories?limit=2  
Example output:

```
{
    "pagination": {
        "total": 86,
        "limit": 2,
        "offset": 0,
        "total_pages": 43,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/shop-categories?page=2&limit=2"
    },
    "data": [
        {
            "id": 2,
            "title": "Books",
            "is_boosted": false,
            "web_url": "http:\/\/www.artinstituteshop.org\/browse.aspx?catID=2",
            "parent_id": null,
            "child_ids": [
                9,
                10,
                11,
                132
            ],
            ...
        },
        {
            "id": 3,
            "title": "Apparel & Accessories",
            "is_boosted": false,
            "web_url": "http:\/\/www.artinstituteshop.org\/browse.aspx?catID=3",
            "parent_id": null,
            "child_ids": [
                8,
                56
            ],
            ...
        }
    ]
}
```

### `/shop-categories/search`

Search shop-categories data in the aggregator. 

#### Available parameters:

* `q` - Your search query
* `query` - For complex queries, you can pass Elasticsearch domain syntax queries here
* `sort` - Used in conjunction with `query`
* `from` - Starting point of results. Pagination via Elasticsearch conventions
* `size` - Number of results to return. Pagination via Elasticsearch conventions
* `facets` - A comma-separated list of "count" aggregation facets to include in the results.

Example request: http://aggregator-data-test.artic.edu/api/v1/shop-categories/search  
Example output:

```
{
    "preference": null,
    "pagination": {
        "total": 86,
        "limit": 10,
        "offset": 0,
        "total_pages": 9,
        "current_page": 1
    },
    "data": [
        {
            "_score": 2,
            "api_id": "120",
            "api_model": "shop-categories",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/shop-categories\/120",
            "id": 120,
            "title": "Decorative Glass",
            "timestamp": "2018-02-27T15:14:45-06:00"
        },
        {
            "_score": 2,
            "api_id": "108",
            "api_model": "shop-categories",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/shop-categories\/108",
            "id": 108,
            "title": "Clocks",
            "timestamp": "2018-02-27T15:14:45-06:00"
        },
        {
            "_score": 2,
            "api_id": "84",
            "api_model": "shop-categories",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/shop-categories\/84",
            "id": 84,
            "title": "Screens",
            "timestamp": "2018-02-27T15:14:45-06:00"
        }
    ]
}
```

### `/shop-categories/{id}`

A single shop-categories by the given identifier.

Example request: http://aggregator-data-test.artic.edu/api/v1/shop-categories/2?limit=2  
Example output:

```
{
    "data": {
        "id": 2,
        "title": "Books",
        "is_boosted": false,
        "web_url": "http:\/\/www.artinstituteshop.org\/browse.aspx?catID=2",
        "parent_id": null,
        "child_ids": [
            9,
            10,
            11,
            132
        ],
        ...
    }
}
```

## Products

### `/products`

A list of all products sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](FIELDS.md#products).

#### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource
* `include` - A comma-separated list of subresource to embed in the returned resources. Available options are:
  * `categories`

Example request: http://aggregator-data-test.artic.edu/api/v1/products?limit=2  
Example output:

```
{
    "pagination": {
        "total": 5911,
        "limit": 2,
        "offset": 0,
        "total_pages": 2956,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/products?page=2&limit=2"
    },
    "data": [
        {
            "id": 7374,
            "title": "Aqua Dotted Pearl Earrings",
            "is_boosted": false,
            "title_sort": null,
            "parent_id": null,
            "category_id": 5,
            ...
        },
        {
            "id": 7640,
            "title": "Scattered Leaves Scarf - Cranberry",
            "is_boosted": false,
            "title_sort": null,
            "parent_id": null,
            "category_id": 3,
            ...
        }
    ]
}
```

### `/products/search`

Search products data in the aggregator. 

#### Available parameters:

* `q` - Your search query
* `query` - For complex queries, you can pass Elasticsearch domain syntax queries here
* `sort` - Used in conjunction with `query`
* `from` - Starting point of results. Pagination via Elasticsearch conventions
* `size` - Number of results to return. Pagination via Elasticsearch conventions
* `facets` - A comma-separated list of "count" aggregation facets to include in the results.

Example request: http://aggregator-data-test.artic.edu/api/v1/products/search  
Example output:

```
{
    "preference": null,
    "pagination": {
        "total": 5909,
        "limit": 10,
        "offset": 0,
        "total_pages": 591,
        "current_page": 1
    },
    "data": [
        {
            "_score": 2,
            "api_id": "260",
            "api_model": "products",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/products\/260",
            "id": 260,
            "title": "Glass Menorah",
            "timestamp": "2018-02-27T15:12:09-06:00"
        },
        {
            "_score": 2,
            "api_id": "44",
            "api_model": "products",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/products\/44",
            "id": 44,
            "title": "Velvet Kimono Scarf",
            "timestamp": "2018-02-27T15:12:09-06:00"
        },
        {
            "_score": 2,
            "api_id": "1082",
            "api_model": "products",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/products\/1082",
            "id": 1082,
            "title": "Harlem Renaissance",
            "timestamp": "2018-02-27T15:12:09-06:00"
        }
    ]
}
```

### `/products/{id}`

A single products by the given identifier.

Example request: http://aggregator-data-test.artic.edu/api/v1/products/7760?limit=2  
Example output:

```
{
    "data": {
        "id": 7760,
        "title": "TEA SET FLORAL - S\/7",
        "is_boosted": false,
        "title_sort": null,
        "parent_id": null,
        "category_id": 4,
        ...
    }
}
```

# Events

## Legacy Events

### `/legacy-events`

A list of all legacy-events sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](FIELDS.md#legacy-events).

#### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

Example request: http://aggregator-data-test.artic.edu/api/v1/legacy-events?limit=2  
Example output:

```
{
    "pagination": {
        "total": 1774,
        "limit": 2,
        "offset": 0,
        "total_pages": 887,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/legacy-events?page=2&limit=2"
    },
    "data": [
        {
            "id": 2618626,
            "title": "Museum Closed for New Year&#039;s Day",
            "is_boosted": false,
            "description": "",
            "short_description": "",
            "image": "",
            ...
        },
        {
            "id": 2618627,
            "title": "Museum Closed for Christmas",
            "is_boosted": false,
            "description": "",
            "short_description": "",
            "image": "",
            ...
        }
    ]
}
```

### `/legacy-events/search`

Search legacy-events data in the aggregator. 

#### Available parameters:

* `q` - Your search query
* `query` - For complex queries, you can pass Elasticsearch domain syntax queries here
* `sort` - Used in conjunction with `query`
* `from` - Starting point of results. Pagination via Elasticsearch conventions
* `size` - Number of results to return. Pagination via Elasticsearch conventions
* `facets` - A comma-separated list of "count" aggregation facets to include in the results.

Example request: http://aggregator-data-test.artic.edu/api/v1/legacy-events/search  
Example output:

```
{
    "preference": null,
    "pagination": {
        "total": 1774,
        "limit": 10,
        "offset": 0,
        "total_pages": 178,
        "current_page": 1
    },
    "data": [
        {
            "_score": 2,
            "api_id": "28785137",
            "api_model": "legacy-events",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/legacy-events\/28785137",
            "id": 28785137,
            "title": "The Artist&#039;s Studio",
            "timestamp": "2018-02-23T23:00:47-06:00"
        },
        {
            "_score": 2,
            "api_id": "30447306",
            "api_model": "legacy-events",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/legacy-events\/30447306",
            "id": 30447306,
            "title": "Member Preview: Mirroring China\u2019s Past\u2014Emperors and Their Bronzes",
            "timestamp": "2018-02-23T23:00:47-06:00"
        },
        {
            "_score": 2,
            "api_id": "29127560",
            "api_model": "legacy-events",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/legacy-events\/29127560",
            "id": 29127560,
            "title": "Member Weekend Mornings: Rodin\u2015Sculptor and Storyteller",
            "timestamp": "2018-02-23T23:00:48-06:00"
        }
    ]
}
```

### `/legacy-events/{id}`

A single legacy-events by the given identifier.

Example request: http://aggregator-data-test.artic.edu/api/v1/legacy-events/2618626?limit=2  
Example output:

```
{
    "data": {
        "id": 2618626,
        "title": "Museum Closed for New Year&#039;s Day",
        "is_boosted": false,
        "description": "",
        "short_description": "",
        "image": "",
        ...
    }
}
```

# Mobile

## Tours

### `/tours`

A list of all tours sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](FIELDS.md#tours).

#### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource
* `include` - A comma-separated list of subresource to embed in the returned resources. Available options are:
  * `tour_stops`

Example request: http://aggregator-data-test.artic.edu/api/v1/tours?limit=2  
Example output:

```
{
    "pagination": {
        "total": 9,
        "limit": 2,
        "offset": 0,
        "total_pages": 5,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/tours?page=2&limit=2"
    },
    "data": [
        {
            "id": 3906,
            "title": "A Beautiful Science: The Evolution of Chinese Porcelain",
            "is_boosted": false,
            "image": "http:\/\/aicweb10.artic.edu\/sites\/default\/files\/tour-images\/default%20%281%29.jpg",
            "description": "Discover the&nbsp;technology and craft&nbsp;of Chinese Porcelain.",
            "intro": "Join Art Institute conservator, Rachel Sabino, and practicing ceramic artist,&nbsp;Michael&nbsp;Kaysen, as they take you on a journey into the&nbsp;scientific&nbsp;and aesthetic marvel of Chinese porcelain. You will traverse hundreds of years of history as you see porcelain develop and change before your eyes.&nbsp;\r\n\r\n&nbsp;",
            ...
        },
        {
            "id": 2193,
            "title": "The Essentials Tour",
            "is_boosted": false,
            "image": "http:\/\/aicweb10.artic.edu\/sites\/default\/files\/tour-images\/english%20%281%29.jpg",
            "description": "Discover the stories behind some of the museum\u2019s most iconic artworks.",
            "intro": "Indulge in the sunlit bank of the River Seine in Georges Seurat\u2019s \"A Sunday on La Grande Jatte\" or make a late-night stop at a New York City diner in Edward Hopper\u2019s \"Nighthawks\" in this tour of the museum\u2019s iconic collection. Founded in 1879, the Art Institute of Chicago is home to a massive collection spanning nearly all of human history. As you explore centuries of art, this tour highlights some essential landmarks\u2014with lesser known, but equally engaging artworks\u2014along the way. The soundtrack features the music of Andrew Bird, another Chicago essential.",
            ...
        }
    ]
}
```

### `/tours/search`

Search tours data in the aggregator. 

#### Available parameters:

* `q` - Your search query
* `query` - For complex queries, you can pass Elasticsearch domain syntax queries here
* `sort` - Used in conjunction with `query`
* `from` - Starting point of results. Pagination via Elasticsearch conventions
* `size` - Number of results to return. Pagination via Elasticsearch conventions
* `facets` - A comma-separated list of "count" aggregation facets to include in the results.

Example request: http://aggregator-data-test.artic.edu/api/v1/tours/search  
Example output:

```
{
    "preference": null,
    "pagination": {
        "total": 9,
        "limit": 10,
        "offset": 0,
        "total_pages": 1,
        "current_page": 1
    },
    "data": [
        {
            "_score": 2,
            "api_id": "2193",
            "api_model": "tours",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/tours\/2193",
            "id": 2193,
            "title": "The Essentials Tour",
            "timestamp": "2018-02-20T20:17:26-06:00"
        },
        {
            "_score": 2,
            "api_id": "2220",
            "api_model": "tours",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/tours\/2220",
            "id": 2220,
            "title": "\u7cbe\u534e\u6e38",
            "timestamp": "2018-02-20T20:17:26-06:00"
        },
        {
            "_score": 2,
            "api_id": "3246",
            "api_model": "tours",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/tours\/3246",
            "id": 3246,
            "title": "Verbal Description tour: The Essentials",
            "timestamp": "2018-02-20T20:17:26-06:00"
        }
    ]
}
```

### `/tours/{id}`

A single tours by the given identifier.

Example request: http://aggregator-data-test.artic.edu/api/v1/tours/2219?limit=2  
Example output:

```
{
    "data": {
        "id": 2219,
        "title": "Visita a lo esencial",
        "is_boosted": false,
        "image": "http:\/\/aicweb10.artic.edu\/sites\/default\/files\/tour-images\/espanol.jpg",
        "description": "Descubra las historias detr\u00e1s de algunas de las obras de arte m\u00e1s ic\u00f3nicas del museo.",
        "intro": "Disfrute el banco del R\u00edo Sena ba\u00f1ado de sol en \u201cUn domingo en La Grande Jatte\u201d de Georges Seurat o haga una parada nocturna en una cafeter\u00eda de Nueva York en \u201cNighthawks\u201d de Edward Hopper en esta visita a la ic\u00f3nica colecci\u00f3n del museo. El Art Institute of Chicago, fundado en 1879, alberga una enorme colecci\u00f3n que abarca casi toda la historia de la humanidad. A medida que explora siglos de arte, esta visita resalta algunos hitos esenciales, con obras de arte menos conocidas, pero igualmente interesantes, en todo el recorrido. La pista musical presenta la m\u00fasica de Andrew Bird, otra persona esencial en Chicago.",
        ...
    }
}
```

## Tour Stops

### `/tour-stops`

A list of all tour-stops sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](FIELDS.md#tour-stops).

#### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource
* `include` - A comma-separated list of subresource to embed in the returned resources. Available options are:
  * `sound`

Example request: http://aggregator-data-test.artic.edu/api/v1/tour-stops?limit=2  
Example output:

```
{
    "pagination": {
        "total": 105,
        "limit": 2,
        "offset": 0,
        "total_pages": 53,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/tour-stops?page=2&limit=2"
    },
    "data": [
        {
            "id": 1039,
            "title": "Woman with Dog (Frau mit Hund)",
            "is_boosted": false,
            "artwork_title": "Woman with Dog (Frau mit Hund)",
            "artwork_id": 229376,
            "tour_id": null,
            ...
        },
        {
            "id": 1099,
            "title": null,
            "is_boosted": false,
            "artwork_title": null,
            "artwork_id": null,
            "tour_id": null,
            ...
        }
    ]
}
```

### `/tour-stops/search`

Search tour-stops data in the aggregator. 

#### Available parameters:

* `q` - Your search query
* `query` - For complex queries, you can pass Elasticsearch domain syntax queries here
* `sort` - Used in conjunction with `query`
* `from` - Starting point of results. Pagination via Elasticsearch conventions
* `size` - Number of results to return. Pagination via Elasticsearch conventions
* `facets` - A comma-separated list of "count" aggregation facets to include in the results.

Example request: http://aggregator-data-test.artic.edu/api/v1/tour-stops/search  
Example output:

```
{
    "preference": null,
    "pagination": {
        "total": 0,
        "limit": 10,
        "offset": 0,
        "total_pages": 0,
        "current_page": 1
    },
    "data": []
}
```

### `/tour-stops/{id}`

A single tour-stops by the given identifier.

Example request: http://aggregator-data-test.artic.edu/api/v1/tour-stops/1041?limit=2  
Example output:

```
{
    "data": {
        "id": 1041,
        "title": "A Sunday on La Grande Jatte \u2014 1884",
        "is_boosted": false,
        "artwork_title": "A Sunday on La Grande Jatte \u2014 1884",
        "artwork_id": 27992,
        "tour_id": null,
        ...
    }
}
```

## Mobile Sounds

### `/mobile-sounds`

A list of all mobile-sounds sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](FIELDS.md#mobile-sounds).

#### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

Example request: http://aggregator-data-test.artic.edu/api/v1/mobile-sounds?limit=2  
Example output:

```
{
    "pagination": {
        "total": 577,
        "limit": 2,
        "offset": 0,
        "total_pages": 289,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/mobile-sounds?page=2&limit=2"
    },
    "data": [
        {
            "id": 3898,
            "title": "A Beautiful Science Introduction",
            "is_boosted": false,
            "link": "http:\/\/aicweb10.artic.edu\/sites\/default\/files\/audio\/01%20Introduction%20NEW%20INTRO%20Bloomberg%20Tag%20FINAL.mp3",
            "transcript": "Narrator: Welcome to a Beautiful Science: The Evolution of Chinese Porcelain. On this tour you will traverse hundreds of years of history as you witness the scientific and aesthetic marvel of porcelain develop. Your tour will be guided by practicing ceramic artist and staff member at the Art Institute of Chicago, Michael Kaysen.\r\n\r\nMichael: When people talk about Chinese porcelain, they\u2019re usually referring to a blue and white porcelain. We often don\u2019t realize that that\u2019s just one type, one aspect of it. There is a wide range of production. Chinese porcelain, within the museum, covers that and the entire range of that work. It\u2019s a long time period-- a few thousand years. And there were many different types of ware made. \r\n\r\nNarrator: As well as conservator at the Art Institute of Chicago, Rachel Sabino\r\n\r\nRachel: The extent to which this was a revolutionary technical innovation might not be something that people know about.\r\n\r\nMichael: They were achieving very high temperatures We\u2019re talking 2400 degrees, almost 2500 degrees. And that last few hundred degrees is very difficult to attain. \r\n\r\nRachel: But of course, I think your average person, when you say, &quot;What is china?&quot; thinks of wedding sets and tea services, maybe figurines, knick-knacks, things that sit on a shelf, dusty. Yeah, it&#039;s easy to take for granted something that&#039;s so ubiquitous in our daily lives.  We have cups, we have plates, we have vases, we have industrial ceramics in our smartphones.  But the massive scale that this represented in terms of human effort-- not just in sheer physical labor but also technical know-how, pushing the boundaries of technology-- I think it&#039;s easy for that to get missed. \r\nWhat I find interesting about it is that for such a humble material-- I mean, it really is basically earth, fire, water-- there&#039;s a lot going on.  \r\n",
            "last_updated_source": null,
            ...
        },
        {
            "id": 3899,
            "title": "Vase (hu) with Horizontal bands ",
            "is_boosted": false,
            "link": "http:\/\/aicweb10.artic.edu\/sites\/default\/files\/audio\/02%20Celadon%20Vase%20FINAL%20MASTERED.mp3",
            "transcript": "Narrator: Conservator, Rachel Sabino. \r\n\r\nRachel: So in a gallery devoted entirely to porcelain, why are we starting here in front of this object? It\u2019s not white, it\u2019s not translucent, and it\u2019s because porcelain means different things in the east versus  west. In the west, porcelain is a term exclusively used to describe a clay fired above 1400 degrees centigrade. And in the east, the wares are also high fired, but can be fired from 1100 and still qualify as porcelain.  And so that\u2019s why we\u2019re standing here, this object is high fired enough to count as porcelain but  it is what we would call in the west a stone ware. \r\n\r\nNarrator: Practicing ceramic artist, Michael Kaysen. \r\n\r\nMichael: It\u2019s all thrown in one piece. There are some press-molded dog slash-lion faces. So, basically, what the potter would do is press a piece of clay into some type of mold. \r\nIt was dipped into a glaze-- a bucket of glaze, or some kind of container of glaze; probably not a bucket. &lt;laughs&gt; The glaze is-- it\u2019s a very simple glaze: an iron... with a little bit of iron it. That\u2019s what the green color is from.\r\n\r\nRachel: the Chinese actually have a lovely way of thinking about ceramics and glazes compositionally.  They think of it as bones, flesh, and blood; and in any ceramic you need silica, you need alumina, and you need fluxes to melt all of these materials; and the bones they consider the silica.  If you think of the glass-forming components of the clay as the structure, then the alumina is all the rest that kind of fills in the gaps and hangs off the bones, and the flux, which lowers the melting temperature of this whole mix, can be thought of as sort of the blood that courses through the material.\r\n",
            "last_updated_source": null,
            ...
        }
    ]
}
```

### `/mobile-sounds/{id}`

A single mobile-sounds by the given identifier.

Example request: http://aggregator-data-test.artic.edu/api/v1/mobile-sounds/1545?limit=2  
Example output:

```
{
    "data": {
        "id": 1545,
        "title": "Trompe-l'Oeil Still Life with a Flower Garland and a Curtain",
        "is_boosted": false,
        "link": "http:\/\/aicweb10.artic.edu\/sites\/default\/files\/audio\/757.mp3",
        "transcript": "NARRATOR: Painted in the Netherlands in 1658, this masterly still life held a fascinating secret for many years. Curator Martha Wolff.\r\n\r\nMARTHA WOLFF: This painting is signed by Adriaen van der Spelt, a still life painter whose work is rather rare. But fairly recently, we realized that it&#039;s in fact a collaboration between van der Spelt and a more famous painter named Frans van Mieris who contributed the beautiful blue satin curtain that is drawn across part of the picture.\r\n\r\nNARRATOR: The young artists had both just joined the Painters Gild in the City of Leiden, so this picture was probably a demonstration in their skill in the art of illusion.\r\n\r\nMARTHA WOLFF: And also a reflection of actual usage at the time, because Dutch collectors would use curtains to protect particularly exquisite pictures from light and also to give the viewer the thrill of pulling back the curtain and seeing what was displayed behind it. And you have multiple layers of illusion here because you have first the stone arch and then you have the garland that&#039;s draped in front of it, and then you have the curtain. And one of the most wonderful things is really the brass rod which plays off of the frame of the picture. It stands in front of it.",
        "last_updated_source": null,
        ...
    }
}
```

# Digital Scholarly Catalogs

## Publications

### `/publications`

A list of all publications sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](FIELDS.md#publications).

#### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

Example request: http://aggregator-data-test.artic.edu/api/v1/publications?limit=2  
Example output:

```
{
    "pagination": {
        "total": 10,
        "limit": 2,
        "offset": 0,
        "total_pages": 5,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/publications?page=2&limit=2"
    },
    "data": [
        {
            "id": 445,
            "title": "Caillebotte Paintings and Drawings at the Art Institute of Chicago",
            "is_boosted": false,
            "web_url": "https:\/\/publications.artic.edu\/caillebotte\/reader\/paintingsanddrawings",
            "site": "caillebotte",
            "alias": "paintingsanddrawings",
            ...
        },
        {
            "id": 480,
            "title": "Roman Art at the Art Institute of Chicago",
            "is_boosted": false,
            "web_url": "https:\/\/publications.artic.edu\/roman\/reader\/romanart",
            "site": "roman",
            "alias": "romanart",
            ...
        }
    ]
}
```

### `/publications/search`

Search publications data in the aggregator. 

#### Available parameters:

* `q` - Your search query
* `query` - For complex queries, you can pass Elasticsearch domain syntax queries here
* `sort` - Used in conjunction with `query`
* `from` - Starting point of results. Pagination via Elasticsearch conventions
* `size` - Number of results to return. Pagination via Elasticsearch conventions
* `facets` - A comma-separated list of "count" aggregation facets to include in the results.

Example request: http://aggregator-data-test.artic.edu/api/v1/publications/search  
Example output:

```
{
    "preference": null,
    "pagination": {
        "total": 10,
        "limit": 10,
        "offset": 0,
        "total_pages": 1,
        "current_page": 1
    },
    "data": [
        {
            "_score": 2,
            "api_id": "140019",
            "api_model": "publications",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/publications\/140019",
            "id": 140019,
            "title": "Manet Paintings and Works on Paper at the Art Institute of Chicago",
            "timestamp": "2018-02-27T16:51:09-06:00"
        },
        {
            "_score": 2,
            "api_id": "12",
            "api_model": "publications",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/publications\/12",
            "id": 12,
            "title": "The Modern Series at the Art Institute of Chicago",
            "timestamp": "2018-02-27T16:51:08-06:00"
        },
        {
            "_score": 2,
            "api_id": "406",
            "api_model": "publications",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/publications\/406",
            "id": 406,
            "title": "Whistler and Roussel: Linked Visions",
            "timestamp": "2018-02-27T16:51:08-06:00"
        }
    ]
}
```

### `/publications/{id}`

A single publications by the given identifier.

Example request: http://aggregator-data-test.artic.edu/api/v1/publications/445?limit=2  
Example output:

```
{
    "data": {
        "id": 445,
        "title": "Caillebotte Paintings and Drawings at the Art Institute of Chicago",
        "is_boosted": false,
        "web_url": "https:\/\/publications.artic.edu\/caillebotte\/reader\/paintingsanddrawings",
        "site": "caillebotte",
        "alias": "paintingsanddrawings",
        ...
    }
}
```

## Sections

### `/sections`

A list of all sections sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](FIELDS.md#sections).

#### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

Example request: http://aggregator-data-test.artic.edu/api/v1/sections?limit=2  
Example output:

```
{
    "pagination": {
        "total": 845,
        "limit": 2,
        "offset": 0,
        "total_pages": 423,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/sections?page=2&limit=2"
    },
    "data": [
        {
            "id": 518663,
            "title": "Authors and Contributors",
            "is_boosted": false,
            "web_url": "https:\/\/publications.artic.edu\/pissarro\/reader\/paintingsandpaper\/section\/1010",
            "accession": null,
            "revision": 1502911013,
            ...
        },
        {
            "id": 517645,
            "title": "About this Catalogue",
            "is_boosted": false,
            "web_url": "https:\/\/publications.artic.edu\/pissarro\/reader\/paintingsandpaper\/section\/1009",
            "accession": null,
            "revision": 1502911013,
            ...
        }
    ]
}
```

### `/sections/search`

Search sections data in the aggregator. 

#### Available parameters:

* `q` - Your search query
* `query` - For complex queries, you can pass Elasticsearch domain syntax queries here
* `sort` - Used in conjunction with `query`
* `from` - Starting point of results. Pagination via Elasticsearch conventions
* `size` - Number of results to return. Pagination via Elasticsearch conventions
* `facets` - A comma-separated list of "count" aggregation facets to include in the results.

Example request: http://aggregator-data-test.artic.edu/api/v1/sections/search  
Example output:

```
{
    "preference": null,
    "pagination": {
        "total": 659,
        "limit": 10,
        "offset": 0,
        "total_pages": 66,
        "current_page": 1
    },
    "data": [
        {
            "_score": 2,
            "api_id": "39608458143",
            "api_model": "sections",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/sections\/39608458143",
            "id": 39608458143,
            "title": "Gauguin, Cat. 61, Pape Moe (1922.4797)",
            "timestamp": "2018-02-27T16:51:11-06:00"
        },
        {
            "_score": 2,
            "api_id": "39607332329",
            "api_model": "sections",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/sections\/39607332329",
            "id": 39607332329,
            "title": "Gauguin, Cat. 60.4, Manao tupapau (She Thinks of the Ghost or The Ghost Thinks of Her), from the Noa Noa Suite (1924.1198)",
            "timestamp": "2018-02-27T16:51:11-06:00"
        },
        {
            "_score": 2,
            "api_id": "39606487979",
            "api_model": "sections",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/sections\/39606487979",
            "id": 39606487979,
            "title": "Gauguin, Cat. 60.1, Manao tupapau (She Thinks of the Ghost or The Ghost Thinks of Her), from the Noa Noa Suite (2015.359)",
            "timestamp": "2018-02-27T16:51:11-06:00"
        }
    ]
}
```

### `/sections/{id}`

A single sections by the given identifier.

Example request: http://aggregator-data-test.artic.edu/api/v1/sections/3014259?limit=2  
Example output:

```
{
    "data": {
        "id": 3014259,
        "title": "Cat. 160 Pair of Earrings",
        "is_boosted": false,
        "web_url": "https:\/\/publications.artic.edu\/roman\/reader\/romanart\/section\/1974",
        "accession": null,
        "revision": 1502910278,
        ...
    }
}
```

# Static Archive

## Sites

### `/sites`

A list of all sites sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](FIELDS.md#sites).

#### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource
* `include` - A comma-separated list of subresource to embed in the returned resources. Available options are:
  * `artworks`

Example request: http://aggregator-data-test.artic.edu/api/v1/sites?limit=2  
Example output:

```
{
    "pagination": {
        "total": 96,
        "limit": 2,
        "offset": 0,
        "total_pages": 48,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/sites?page=2&limit=2"
    },
    "data": [
        {
            "id": 94,
            "title": "Building: Inside Studio Gang Architects",
            "is_boosted": false,
            "description": "Inventive. Collaborative. Research-driven. Led by principal and founder Jeanne Gang, Chicago-based Studio Gang Architects has established itself as one of the premier architectural firms working today. Inside Studio Gang Architects presents an engaging workshop-like environment that showcases and reveals the practice's creative process as they seek architectural solutions to pressing contemporary issues. During the course of this exhibition, two Archi-Salons will engage a host of architects, journalists, and critics in discourse surrounding the contemporary practice of architecture. Held within the gallery space, the two salons will focus on different perspectives that influence current practices. These conversations will be inspired by Studio Gang\u00e2\u20ac\u2122s work, but ultimately will address larger issues in the field of contemporary architecture.",
            "web_url": "http:\/\/archive.artic.edu\/studiogang\/",
            "exhibition_ids": [
                1650
            ],
            ...
        },
        {
            "id": 95,
            "title": "Game of Thornes: A Maze of Miniature Proportions",
            "is_boosted": false,
            "description": "This fantasy world comes in delightfully pint-sized pieces\u2014the Thorne Miniature Rooms. Your mission: navigate you escape from this mystifying realm of riddled rooms.",
            "web_url": "http:\/\/archive.artic.edu\/thorne-game\/",
            "exhibition_ids": [],
            ...
        }
    ]
}
```

### `/sites/search`

Search sites data in the aggregator. 

#### Available parameters:

* `q` - Your search query
* `query` - For complex queries, you can pass Elasticsearch domain syntax queries here
* `sort` - Used in conjunction with `query`
* `from` - Starting point of results. Pagination via Elasticsearch conventions
* `size` - Number of results to return. Pagination via Elasticsearch conventions
* `facets` - A comma-separated list of "count" aggregation facets to include in the results.

Example request: http://aggregator-data-test.artic.edu/api/v1/sites/search  
Example output:

```
{
    "preference": null,
    "pagination": {
        "total": 96,
        "limit": 10,
        "offset": 0,
        "total_pages": 10,
        "current_page": 1
    },
    "data": [
        {
            "_score": 2,
            "api_id": "14",
            "api_model": "sites",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/sites\/14",
            "id": 14,
            "title": "The Medici, Michelangelo, and the Art of Late Renaissance Florence",
            "timestamp": "2018-02-25T23:05:52-06:00"
        },
        {
            "_score": 2,
            "api_id": "19",
            "api_model": "sites",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/sites\/19",
            "id": 19,
            "title": "Perpetual Glory: Medieval Islamic Ceramics from the Harvey B. Plotnick Collection",
            "timestamp": "2018-02-25T23:05:52-06:00"
        },
        {
            "_score": 2,
            "api_id": "22",
            "api_model": "sites",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/sites\/22",
            "id": 22,
            "title": "Seurat and the Making of \"La Grande Jatte\"",
            "timestamp": "2018-02-25T23:05:52-06:00"
        }
    ]
}
```

### `/sites/{id}`

A single sites by the given identifier.

Example request: http://aggregator-data-test.artic.edu/api/v1/sites/1?limit=2  
Example output:

```
{
    "data": {
        "id": 1,
        "title": "Chicago Architecture: Ten Visions",
        "is_boosted": false,
        "description": "Chicago Architecture: Ten Visions presents diverse views of the future of Chicago\u2019s built environment from 10 internationally renowned architects. The architects were selected from an invited competition juried by architects Stanley Tigerman and Harry Cobb, in collaboration with curators from the Art Institute\u2019s Department of Architecture. The 10 architects reflect a cross section of Chicago\u2019s vibrant architectural scene\u2014from large and small firms as well as the academic community\u2014bringing to this exhibition diverse experiences and insights. Each architect was asked to define an important issue for the future of Chicago and create a \u201cspatial commentary\u201d on that particular theme. Within a lively plan designed by Stanley Tigerman, each of the participants has curated and designed his or her own mini-exhibition in a space of approximately 21 feet square. Tigerman\u2019s setting creates a linear sequence in which visitors pass through the architects\u2019 spaces to an interactive area where the architects\u2019 commentaries can be heard by picking up a telephone. Visitors are encouraged to record their comments on any and all of the \u201cten visions.\u201d",
        "web_url": "http:\/\/archive.artic.edu\/10visions\/",
        "exhibition_ids": [
            2839
        ],
        ...
    }
}
```

# Archive

## Archive Images

### `/archive-images`

A list of all archive-images sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](FIELDS.md#archive-images).

#### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

Example request: http://aggregator-data-test.artic.edu/api/v1/archive-images?limit=2  
Example output:

```
{
    "pagination": {
        "total": 55591,
        "limit": 2,
        "offset": 0,
        "total_pages": 27796,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/archive-images?page=2&limit=2"
    },
    "data": [
        {
            "id": 10011,
            "title": "Inglis, David, Residence",
            "alternate_title": null,
            "web_url": "http:\/\/digital-libraries.saic.edu\/cdm\/ref\/collection\/mqc\/id\/10011",
            "collection": "Inland Architect",
            "archive": null,
            ...
        },
        {
            "id": 10012,
            "title": "University Congregational Church",
            "alternate_title": null,
            "web_url": "http:\/\/digital-libraries.saic.edu\/cdm\/ref\/collection\/mqc\/id\/10012",
            "collection": "Inland Architect",
            "archive": null,
            ...
        }
    ]
}
```

### `/archive-images/{id}`

A single archive-images by the given identifier.

Example request: http://aggregator-data-test.artic.edu/api/v1/archive-images?limit=2  
Example output:

```
{
    "pagination": {
        "total": 55591,
        "limit": 2,
        "offset": 0,
        "total_pages": 27796,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/archive-images?page=2&limit=2"
    },
    "data": [
        {
            "id": 10011,
            "title": "Inglis, David, Residence",
            "alternate_title": null,
            "web_url": "http:\/\/digital-libraries.saic.edu\/cdm\/ref\/collection\/mqc\/id\/10011",
            "collection": "Inland Architect",
            "archive": null,
            ...
        },
        {
            "id": 10012,
            "title": "University Congregational Church",
            "alternate_title": null,
            "web_url": "http:\/\/digital-libraries.saic.edu\/cdm\/ref\/collection\/mqc\/id\/10012",
            "collection": "Inland Architect",
            "archive": null,
            ...
        }
    ]
}
```

# Library

## Library Materials

### `/library-materials`

A list of all library-materials sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](FIELDS.md#library-materials).

#### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource
* `include` - A comma-separated list of subresource to embed in the returned resources. Available options are:
  * `creators`
  * `subjects`

Example request: http://aggregator-data-test.artic.edu/api/v1/library-materials?limit=2  
Example output:

```
{
    "pagination": {
        "total": 6861,
        "limit": 2,
        "offset": 0,
        "total_pages": 3431,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/library-materials?page=2&limit=2"
    },
    "data": [
        {
            "id": "01ARTIC_ALMA2132892260003801",
            "title": "The life of J. M. W. Turner, R.A.",
            "date": 1879,
            "creators": [
                {
                    "id": "n50018890",
                    "uri": "http:\/\/id.loc.gov\/authorities\/names\/n50018890",
                    "title": "Hamerton, Philip Gilbert"
                }
            ],
            "subjects": [
                {
                    "id": "n79060712",
                    "uri": "http:\/\/id.loc.gov\/authorities\/names\/n79060712",
                    "title": "Turner, J. M. W"
                }
            ],
            ...
        },
        {
            "id": "01ARTIC_ALMA2132890200003801",
            "title": "Simplicissimus.",
            "date": 1896,
            "creators": [],
            "subjects": [
                {
                    "id": "sh85054431",
                    "uri": "http:\/\/id.loc.gov\/authorities\/subjects\/sh85054431",
                    "title": "German wit and humor, Pictorial"
                },
                {
                    "id": "sh85020312",
                    "uri": "http:\/\/id.loc.gov\/authorities\/subjects\/sh85020312",
                    "title": "Caricatures and cartoons"
                }
            ],
            ...
        }
    ]
}
```

### `/library-materials/{id}`

A single library-materials by the given identifier.

Example request: http://aggregator-data-test.artic.edu/api/v1/library-materials?limit=2  
Example output:

```
{
    "pagination": {
        "total": 6861,
        "limit": 2,
        "offset": 0,
        "total_pages": 3431,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/library-materials?page=2&limit=2"
    },
    "data": [
        {
            "id": "01ARTIC_ALMA2132892260003801",
            "title": "The life of J. M. W. Turner, R.A.",
            "date": 1879,
            "creators": [
                {
                    "id": "n50018890",
                    "uri": "http:\/\/id.loc.gov\/authorities\/names\/n50018890",
                    "title": "Hamerton, Philip Gilbert"
                }
            ],
            "subjects": [
                {
                    "id": "n79060712",
                    "uri": "http:\/\/id.loc.gov\/authorities\/names\/n79060712",
                    "title": "Turner, J. M. W"
                }
            ],
            ...
        },
        {
            "id": "01ARTIC_ALMA2132890200003801",
            "title": "Simplicissimus.",
            "date": 1896,
            "creators": [],
            "subjects": [
                {
                    "id": "sh85054431",
                    "uri": "http:\/\/id.loc.gov\/authorities\/subjects\/sh85054431",
                    "title": "German wit and humor, Pictorial"
                },
                {
                    "id": "sh85020312",
                    "uri": "http:\/\/id.loc.gov\/authorities\/subjects\/sh85020312",
                    "title": "Caricatures and cartoons"
                }
            ],
            ...
        }
    ]
}
```

## Library Terms

### `/library-terms`

A list of all library-terms sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](FIELDS.md#library-terms).

#### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource
* `include` - A comma-separated list of subresource to embed in the returned resources. Available options are:
  * `creator_of`
  * `subject_of`

Example request: http://aggregator-data-test.artic.edu/api/v1/library-terms?limit=2  
Example output:

```
{
    "pagination": {
        "total": 9508,
        "limit": 2,
        "offset": 0,
        "total_pages": 4754,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/library-terms?page=2&limit=2"
    },
    "data": [
        {
            "id": "n81033839",
            "uri": "http:\/\/id.loc.gov\/authorities\/names\/n81033839",
            "title": "V\u00e1clavek, Bed\u0159ich",
            ...
        },
        {
            "id": "nr93036655",
            "uri": "http:\/\/id.loc.gov\/authorities\/names\/nr93036655",
            "title": "Moses, Henry",
            ...
        }
    ]
}
```

### `/library-terms/{id}`

A single library-terms by the given identifier.

Example request: http://aggregator-data-test.artic.edu/api/v1/library-terms?limit=2  
Example output:

```
{
    "pagination": {
        "total": 9508,
        "limit": 2,
        "offset": 0,
        "total_pages": 4754,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/library-terms?page=2&limit=2"
    },
    "data": [
        {
            "id": "n81033839",
            "uri": "http:\/\/id.loc.gov\/authorities\/names\/n81033839",
            "title": "V\u00e1clavek, Bed\u0159ich",
            ...
        },
        {
            "id": "nr93036655",
            "uri": "http:\/\/id.loc.gov\/authorities\/names\/nr93036655",
            "title": "Moses, Henry",
            ...
        }
    ]
}
```

> Generated by `php artisan docs:endpoints` on 2018-02-27 19:42:35
