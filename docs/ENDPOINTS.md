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
  * `committees`
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
        "total": 106503,
        "limit": 2,
        "offset": 0,
        "total_pages": 53252,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/artworks?page=2&limit=2"
    },
    "data": [
        {
            "id": 45571,
            "title": "Chair Back",
            "lake_guid": "a44955fc-e64e-4db6-fcb7-4ee01be42160",
            "is_boosted": false,
            "alt_titles": [],
            "main_reference_number": "1973.581",
            ...
        },
        {
            "id": 46103,
            "title": "Panel (Furnishing Fabric)",
            "lake_guid": "74da7217-a7d2-6ed1-9022-d42b57445e08",
            "is_boosted": false,
            "alt_titles": [],
            "main_reference_number": "1943.23",
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
  * `committees`
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
            "id": 66434,
            "title": "Georgia O'Keeffe\u2014Hands and Thimble",
            "lake_guid": "98f1fd24-3b57-9a0f-cebb-d63c1c6d4f7b",
            "is_boosted": true,
            "alt_titles": [],
            "main_reference_number": "1949.745",
            ...
        },
        {
            "id": 15401,
            "title": "At Mouquin's",
            "lake_guid": "4bac2d7e-1c89-805e-c4a5-19315bbc566e",
            "is_boosted": true,
            "alt_titles": [],
            "main_reference_number": "1925.295",
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
            "_score": 13.925655,
            "api_id": "14598",
            "api_model": "artworks",
            "is_boosted": true,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/artworks\/14598",
            "id": 14598,
            "title": "The Beach at Sainte-Adresse",
            "timestamp": "2018-02-16T08:36:23-06:00"
        },
        {
            "_score": 13.587482,
            "api_id": "16571",
            "api_model": "artworks",
            "is_boosted": true,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/artworks\/16571",
            "id": 16571,
            "title": "Arrival of the Normandy Train, Gare Saint-Lazare",
            "timestamp": "2018-02-16T08:35:12-06:00"
        },
        {
            "_score": 13.587482,
            "api_id": "16568",
            "api_model": "artworks",
            "is_boosted": true,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/artworks\/16568",
            "id": 16568,
            "title": "Water Lilies",
            "timestamp": "2018-02-16T08:35:17-06:00"
        }
    ],
    "suggest": {
        "phrase": [
            "<em>month<\/em>",
            "<em>don't<\/em>",
            "<em>Don't<\/em>",
            "<em>Donut<\/em>",
            "<em>Bonnet<\/em>"
        ]
    }
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
            "alt_titles": [],
            "birth_date": 1882,
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
            "id": 48,
            "title": "American Modernism",
            "lake_guid": "795eda4e-6c99-1e9f-3283-5aaaad27f857",
            "is_boosted": false,
            "parent_id": 2,
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
            "id": 191,
            "title": "Featured Objects",
            "lake_guid": "ada5fe78-e09d-0ef8-82b3-71c4a5b1f6ae",
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
        "total": 12225,
        "limit": 2,
        "offset": 0,
        "total_pages": 6113,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/agents?page=2&limit=2"
    },
    "data": [
        {
            "id": 35594,
            "title": "Brice Marden",
            "lake_guid": "1e58e94b-9384-6b32-eb3b-021263324fc8",
            "is_boosted": true,
            "alt_titles": [],
            "birth_date": 1938,
            ...
        },
        {
            "id": 114190,
            "title": "Tom Steger",
            "lake_guid": "9769bc51-4065-3603-ff38-852f48067372",
            "is_boosted": false,
            "alt_titles": [],
            "birth_date": null,
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
            "id": 35594,
            "title": "Brice Marden",
            "lake_guid": "1e58e94b-9384-6b32-eb3b-021263324fc8",
            "is_boosted": true,
            "alt_titles": [],
            "birth_date": 1938,
            ...
        },
        {
            "id": 24885,
            "title": "Florine Stettheimer",
            "lake_guid": "e17ea79f-c2dc-c32e-6fd6-9a9b78098a8f",
            "is_boosted": true,
            "alt_titles": [],
            "birth_date": 1871,
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
        "total": 12352,
        "limit": 10,
        "offset": 0,
        "total_pages": 1236,
        "current_page": 1
    },
    "data": [
        {
            "_score": 5.7674494,
            "api_id": "41673",
            "api_model": "agents",
            "is_boosted": true,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/agents\/41673",
            "id": 41673,
            "title": "William Merritt Chase",
            "timestamp": "2018-02-16T08:30:04-06:00"
        },
        {
            "_score": 5.7674494,
            "api_id": "44584",
            "api_model": "agents",
            "is_boosted": true,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/agents\/44584",
            "id": 44584,
            "title": "Carl Blechen",
            "timestamp": "2018-02-16T08:30:01-06:00"
        },
        {
            "_score": 5.7674494,
            "api_id": "40545",
            "api_model": "agents",
            "is_boosted": true,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/agents\/40545",
            "id": 40545,
            "title": "Eug\u00e8ne Delacroix",
            "timestamp": "2018-02-16T08:30:01-06:00"
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
        "total": 12225,
        "limit": 2,
        "offset": 0,
        "total_pages": 6113,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/agents?page=2&limit=2"
    },
    "data": [
        {
            "id": 35594,
            "title": "Brice Marden",
            "lake_guid": "1e58e94b-9384-6b32-eb3b-021263324fc8",
            "is_boosted": true,
            "alt_titles": [],
            "birth_date": 1938,
            ...
        },
        {
            "id": 114190,
            "title": "Tom Steger",
            "lake_guid": "9769bc51-4065-3603-ff38-852f48067372",
            "is_boosted": false,
            "alt_titles": [],
            "birth_date": null,
            ...
        }
    ]
}
```

## Object Types

### `/object-types`

A list of all object-types sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](FIELDS.md#object-types).

#### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

Example request: http://aggregator-data-test.artic.edu/api/v1/object-types?limit=2  
Example output:

```
{
    "pagination": {
        "total": 41,
        "limit": 2,
        "offset": 0,
        "total_pages": 21,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/object-types?page=2&limit=2"
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

### `/object-types/{id}`

A single object-types by the given identifier. {id} is the identifier from our collections managements system.

Example request: http://aggregator-data-test.artic.edu/api/v1/object-types/3?limit=2  
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
            "id": 772,
            "title": "Picturesque: Case 4",
            "lake_guid": "de381c5a-4c09-5839-6156-222dfb245c07",
            "is_boosted": false,
            "parent_id": 426,
            "is_in_nav": false,
            ...
        },
        {
            "id": 778,
            "title": "Wendingen: Case 3",
            "lake_guid": "8c6e80ad-d7bd-1aae-470d-fb3815e9eedb",
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
        "total": 815,
        "limit": 10,
        "offset": 0,
        "total_pages": 82,
        "current_page": 1
    },
    "data": [
        {
            "_score": 2,
            "api_id": "44",
            "api_model": "categories",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/categories\/44",
            "id": 44,
            "title": "Paintings, 1900-1955",
            "timestamp": "2018-02-16T08:33:31-06:00"
        },
        {
            "_score": 2,
            "api_id": "48",
            "api_model": "categories",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/categories\/48",
            "id": 48,
            "title": "American Modernism",
            "timestamp": "2018-02-16T08:33:31-06:00"
        },
        {
            "_score": 2,
            "api_id": "40",
            "api_model": "categories",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/categories\/40",
            "id": 40,
            "title": "American Quilts",
            "timestamp": "2018-02-16T08:33:31-06:00"
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
        "total": 12882,
        "limit": 2,
        "offset": 0,
        "total_pages": 6441,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/places?page=2&limit=2"
    },
    "data": [
        {
            "id": 2147476007,
            "title": "Gallery 173",
            "lake_guid": "40e49893-4a74-c54e-af60-a054cc71031f",
            "is_boosted": false,
            "type": "AIC Gallery",
            "latitude": 41.878826,
            ...
        },
        {
            "id": 2147476836,
            "title": "Gallery 227",
            "lake_guid": "981e94ab-c973-a801-8211-9e5df159ee98",
            "is_boosted": false,
            "type": "AIC Gallery",
            "latitude": 41.879303,
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
        "total": 12850,
        "limit": 10,
        "offset": 0,
        "total_pages": 1285,
        "current_page": 1
    },
    "data": [
        {
            "_score": 2,
            "api_id": "999035569",
            "api_model": "places",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/places\/999035569",
            "id": 999035569,
            "title": "Kris Hall",
            "timestamp": "2018-02-01T14:28:16-06:00"
        },
        {
            "_score": 2,
            "api_id": "999054263",
            "api_model": "places",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/places\/999054263",
            "id": 999054263,
            "title": "Gallery 718",
            "timestamp": "2018-02-01T14:28:16-06:00"
        },
        {
            "_score": 2,
            "api_id": "999142380",
            "api_model": "places",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/places\/999142380",
            "id": 999142380,
            "title": "Gallery 165",
            "timestamp": "2018-02-01T14:28:16-06:00"
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
        "total": 254,
        "limit": 2,
        "offset": 0,
        "total_pages": 127,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/galleries?page=2&limit=2"
    },
    "data": [
        {
            "id": 2147483483,
            "title": "Gallery 109a",
            "lake_guid": "3ef24120-ffb3-9876-88ea-82620082a088",
            "is_boosted": false,
            "type": "AIC Gallery",
            "is_closed": false,
            ...
        },
        {
            "id": 2147483484,
            "title": "Gallery 108a",
            "lake_guid": "a53db368-4aaf-01d6-dd3d-7035997255df",
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
        "total": 254,
        "limit": 10,
        "offset": 0,
        "total_pages": 26,
        "current_page": 1
    },
    "data": [
        {
            "_score": 2,
            "api_id": "2147483613",
            "api_model": "galleries",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/galleries\/2147483613",
            "id": 2147483613,
            "title": "Gallery 219",
            "timestamp": "2018-02-16T08:34:22-06:00"
        },
        {
            "_score": 2,
            "api_id": "2147476019",
            "api_model": "galleries",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/galleries\/2147476019",
            "id": 2147476019,
            "title": "Gallery 177",
            "timestamp": "2018-02-16T08:34:22-06:00"
        },
        {
            "_score": 2,
            "api_id": "2147477218",
            "api_model": "galleries",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/galleries\/2147477218",
            "id": 2147477218,
            "title": "Gallery 200",
            "timestamp": "2018-02-16T08:34:22-06:00"
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
        "total": 6185,
        "limit": 2,
        "offset": 0,
        "total_pages": 3093,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/exhibitions?page=2&limit=2"
    },
    "data": [
        {
            "id": 2345,
            "title": "Tarsila do Amaral: Inventing Modern Art in Brazil",
            "lake_guid": "aa1fd01e-c8f2-e6b0-fa93-e935ac0d77b5",
            "is_boosted": false,
            "description": null,
            "short_description": "This exhibition devoted to Brazilian artist Tarsila do Amaral focuses on her synthesis of avant-garde aesthetics and Brazilian subjects to produce a powerful new modern art for her country.\n",
            ...
        },
        {
            "id": 2954,
            "title": "Making Memories: Quilts as Souvenirs",
            "lake_guid": "bbc77df8-5969-d7c8-cb36-fd8df7411132",
            "is_boosted": false,
            "description": null,
            "short_description": "This presentation of 27 quilts explores the way these textiles function as keepsakes and considers how their material fabrication mimics the construction of memory. \n",
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
        "total": 6025,
        "limit": 10,
        "offset": 0,
        "total_pages": 603,
        "current_page": 1
    },
    "data": [
        {
            "_score": 2,
            "api_id": "999606729",
            "api_model": "exhibitions",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/exhibitions\/999606729",
            "id": 999606729,
            "title": "Sint Laboriosam Fugiat",
            "timestamp": "2018-01-25T13:26:28-06:00"
        },
        {
            "_score": 2,
            "api_id": "999706416",
            "api_model": "exhibitions",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/exhibitions\/999706416",
            "id": 999706416,
            "title": "Et Ut Nihil",
            "timestamp": "2018-01-25T13:26:28-06:00"
        },
        {
            "_score": 2,
            "api_id": "5626",
            "api_model": "exhibitions",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/exhibitions\/5626",
            "id": 5626,
            "title": "A Century of Progress: Loan Exhibition of Paintings and Sculpture",
            "timestamp": "2018-02-02T13:40:53-06:00"
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
        "total": 110232,
        "limit": 2,
        "offset": 0,
        "total_pages": 55116,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/images?page=2&limit=2"
    },
    "data": [
        {
            "id": "c9154218-8d42-b2f9-4e66-1a3f42f9b493",
            "title": "54123",
            "is_boosted": false,
            "type": "image",
            "description": null,
            "content": null,
            ...
        },
        {
            "id": "c918903e-4217-8814-efd6-fa32eb62360d",
            "title": "137174",
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
        "total": 110276,
        "limit": 10,
        "offset": 0,
        "total_pages": 11028,
        "current_page": 1
    },
    "data": [
        {
            "_score": 2,
            "api_id": "ccde07fd-5d94-5e73-0929-041b037d1fa8",
            "api_model": "images",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/images\/ccde07fd-5d94-5e73-0929-041b037d1fa8",
            "id": "ccde07fd-5d94-5e73-0929-041b037d1fa8",
            "title": "IM025680",
            "timestamp": "2018-01-25T05:46:55-06:00"
        },
        {
            "_score": 2,
            "api_id": "b93cb50a-f752-e2e2-9fcd-ea0b563b676a",
            "api_model": "images",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/images\/b93cb50a-f752-e2e2-9fcd-ea0b563b676a",
            "id": "b93cb50a-f752-e2e2-9fcd-ea0b563b676a",
            "title": "IM025805",
            "timestamp": "2018-01-25T05:47:08-06:00"
        },
        {
            "_score": 2,
            "api_id": "c0cc2fd7-260a-2292-7ab3-7dfbdc347186",
            "api_model": "images",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/images\/c0cc2fd7-260a-2292-7ab3-7dfbdc347186",
            "id": "c0cc2fd7-260a-2292-7ab3-7dfbdc347186",
            "title": "IM026053",
            "timestamp": "2018-01-25T06:20:04-06:00"
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
            "id": "322cdacc-0bfa-f004-544d-dc14d2c81bfd",
            "title": "Video: Toulouse-Lautrec's <em>At the Moulin Rouge<\/em>",
            "is_boosted": false,
            "type": "video",
            "description": "Tour the famous Parisian dance hall in this painting by Toulouse-Lautrec.",
            "content": "http:\/\/www.artic.edu\/aic\/collections\/citi\/resources\/43.flv",
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
            "timestamp": "2018-02-02T12:45:03-06:00"
        },
        {
            "_score": 2,
            "api_id": "f4b8bd70-5961-02ef-9495-56162fe094c4",
            "api_model": "videos",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/videos\/f4b8bd70-5961-02ef-9495-56162fe094c4",
            "id": "f4b8bd70-5961-02ef-9495-56162fe094c4",
            "title": "Video: Honoring the Asante King, Kumasi, Ghana",
            "timestamp": "2018-02-02T12:45:03-06:00"
        },
        {
            "_score": 2,
            "api_id": "58d41fd0-7853-6073-79f2-376ae8d366c3",
            "api_model": "videos",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/videos\/58d41fd0-7853-6073-79f2-376ae8d366c3",
            "id": "58d41fd0-7853-6073-79f2-376ae8d366c3",
            "title": "Video: Lecture with Mary Heilmann",
            "timestamp": "2018-02-02T12:45:03-06:00"
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
        "total": 146,
        "limit": 10,
        "offset": 0,
        "total_pages": 15,
        "current_page": 1
    },
    "data": [
        {
            "_score": 2,
            "api_id": "f18ca768-f043-737e-65b9-404c185f9e5f",
            "api_model": "links",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/links\/f18ca768-f043-737e-65b9-404c185f9e5f",
            "id": "f18ca768-f043-737e-65b9-404c185f9e5f",
            "title": "[RETIRED] Art Institute Gallery Panorama",
            "timestamp": "2018-02-02T12:44:59-06:00"
        },
        {
            "_score": 2,
            "api_id": "cdbe4fd0-4fce-0c09-73fc-23816df0c718",
            "api_model": "links",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/links\/cdbe4fd0-4fce-0c09-73fc-23816df0c718",
            "id": "cdbe4fd0-4fce-0c09-73fc-23816df0c718",
            "title": "Turning the Pages:  Jacobellus of Salerno (active around 1270), Gradual Manuscript, about 1270",
            "timestamp": "2018-02-02T12:44:59-06:00"
        },
        {
            "_score": 2,
            "api_id": "763ab38a-d299-ccf6-b35b-e918d09550c3",
            "api_model": "links",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/links\/763ab38a-d299-ccf6-b35b-e918d09550c3",
            "id": "763ab38a-d299-ccf6-b35b-e918d09550c3",
            "title": "The Alfred Stieglitz Collection at the Art Institute of Chicago",
            "timestamp": "2018-02-02T12:44:59-06:00"
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
            "id": "d718f1ba-4559-c502-86b3-3de1791b7050",
            "title": "439.wav",
            "is_boosted": false,
            "type": "sound",
            "description": null,
            "content": null,
            ...
        },
        {
            "id": "dec011c1-f3cb-4d17-f42d-47c4978fbfb2",
            "title": "440.wav",
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
            "api_id": "9506a882-6e9f-c261-c787-4e9824018fd4",
            "api_model": "sounds",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/sounds\/9506a882-6e9f-c261-c787-4e9824018fd4",
            "id": "9506a882-6e9f-c261-c787-4e9824018fd4",
            "title": "Audio Lecture: Artists Connect: Isak Applin Connects with Giovanni di Paolo",
            "timestamp": "2018-02-02T12:45:29-06:00"
        },
        {
            "_score": 2,
            "api_id": "50810560-b911-fe67-3407-2758bbe586c0",
            "api_model": "sounds",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/sounds\/50810560-b911-fe67-3407-2758bbe586c0",
            "id": "50810560-b911-fe67-3407-2758bbe586c0",
            "title": "Audio Lecture: Horace Pippin's <em>Cabin in the Cotton<\/em>",
            "timestamp": "2018-02-02T12:45:29-06:00"
        },
        {
            "_score": 2,
            "api_id": "ba7ff2d6-5ca9-9d8d-cdfc-2a7abf0455f7",
            "api_model": "sounds",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/sounds\/ba7ff2d6-5ca9-9d8d-cdfc-2a7abf0455f7",
            "id": "ba7ff2d6-5ca9-9d8d-cdfc-2a7abf0455f7",
            "title": "Audio Lecture: Manchay Culture: Ancient Temples of Peru",
            "timestamp": "2018-02-02T12:45:29-06:00"
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
            "id": "19151aeb-f37d-7cde-c3d1-11f55f702cd8",
            "title": "Examination: Van Gogh's <em>Self Portrait<\/em>",
            "is_boosted": false,
            "type": "text",
            "description": "An exploration of the lively brushwork and color in van Gogh's intense self-portrait.  ",
            "content": "Prior to leaving the Netherlands for Paris in February 1886, Vincent van Gogh \nhad rendered the harsh beauty of peasant life in images such as <em>The Potato Eaters <\/em>(1885; Amsterdam, Van Gogh Museum), the great work of his early Realist phase. However, sudden exposure to French avant-garde painting prompted him to rethink his artistic means. Rejecting the bleak palette and crude forms he had employed in his previous paintings, van Gogh set about assimilating the art of the Impressionists, notably their broken brushwork and vibrant use of color. Simultaneously, he came to terms with the quasi-scientific method of Georges Seurat, whose <em>Sunday on La Grande Jatte\u20141884<em> he discovered at the final Impressionist exhibition, which opened a few months after his arrival in the capital. In 1888 van Gogh went to Arles, where he devised a highly personal style characterized by decorative clarity, expressive drawing, and violent chromatic contrasts. But it was during his two-year Paris sojourn that he laid the foundation for the achievement of his final years. <br><br>\nIn this transitional period, van Gogh\u2014who had never before executed a self-portrait\u2014produced at least twenty-four images of himself, in which we can measure his adaptation of new ideas to his own expressive ends. The format of the Art Institute\u2019s example evokes traditional conventions of the genre, but the technique is thoroughly modern. The face is rendered in brusque strokes of bright color, and the coat and background are a vibrating flux of dots and dashes. Juxtaposing complementary colors, for example red and green (in the beard, as well as the background), van Gogh demonstrated his awareness of Neo-Impressionist practice. He would soon abandon Pointillist handling, but Seurat\u2019s poetic notion of a \"harmony of contrasts\" would continue to haunt his imagination. \n",
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
            "api_id": "5feab1d2-baf9-f0f9-f2b9-abe01cb98162",
            "api_model": "texts",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/texts\/5feab1d2-baf9-f0f9-f2b9-abe01cb98162",
            "id": "5feab1d2-baf9-f0f9-f2b9-abe01cb98162",
            "title": "Turning the Pages: Nathalia Goncharova (Russian, 1881-1962), <em>Anchorites; Anchoress: Two Poems<\/em> (<em>Pustynniki; Pustynnitsa: Dve poemy<\/em>), 1913",
            "timestamp": "2018-02-02T12:45:17-06:00"
        },
        {
            "_score": 2,
            "api_id": "dd301cc5-d966-9755-d6fa-a60535d0e8e8",
            "api_model": "texts",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/texts\/dd301cc5-d966-9755-d6fa-a60535d0e8e8",
            "id": "dd301cc5-d966-9755-d6fa-a60535d0e8e8",
            "title": "Turning the Pages: Henri de Toulouse Lautrec (French, 1864-1901), <em>Sketchbook<\/em>, 1880",
            "timestamp": "2018-02-02T12:45:17-06:00"
        },
        {
            "_score": 2,
            "api_id": "c552712c-7c68-6585-5952-8d4df7d3ed42",
            "api_model": "texts",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/texts\/c552712c-7c68-6585-5952-8d4df7d3ed42",
            "id": "c552712c-7c68-6585-5952-8d4df7d3ed42",
            "title": "Turning the Pages: Unbound copy of Pablo Picasso (Spanish, 1881-1973), <em>Le Chef d'oeuvre inconnu<\/em> (<em>The Unknown Masterpiece<\/em>), 1931",
            "timestamp": "2018-02-02T12:45:17-06:00"
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
        "total": 25,
        "limit": 2,
        "offset": 0,
        "total_pages": 13,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/shop-categories?page=2&limit=2"
    },
    "data": [
        {
            "id": 999175,
            "title": "Aut ipsam molestiae accusamus iure",
            "is_boosted": false,
            "link": "http:\/\/beahan.com\/",
            "parent_id": 999194,
            "type": "sub-category",
            ...
        },
        {
            "id": 999697,
            "title": "Facere quasi cupiditate ea ipsa",
            "is_boosted": false,
            "link": "http:\/\/www.vonrueden.com\/aliquid-fuga-praesentium-iste-culpa-quaerat-quam-sunt",
            "parent_id": 999083,
            "type": "sub-category",
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
        "total": 73,
        "limit": 10,
        "offset": 0,
        "total_pages": 8,
        "current_page": 1
    },
    "data": [
        {
            "_score": 2,
            "api_id": "999809",
            "api_model": "shop-categories",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/shop-categories\/999809",
            "id": 999809,
            "title": "Est nostrum dolor numquam et",
            "timestamp": "2018-02-03T22:40:29-06:00"
        },
        {
            "_score": 2,
            "api_id": "999879",
            "api_model": "shop-categories",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/shop-categories\/999879",
            "id": 999879,
            "title": "Atque hic non sit dolorem",
            "timestamp": "2018-02-03T22:40:29-06:00"
        },
        {
            "_score": 2,
            "api_id": "999328",
            "api_model": "shop-categories",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/shop-categories\/999328",
            "id": 999328,
            "title": "Fugit in aut expedita sit",
            "timestamp": "2018-01-25T13:34:02-06:00"
        }
    ]
}
```

### `/shop-categories/{id}`

A single shop-categories by the given identifier.

Example request: http://aggregator-data-test.artic.edu/api/v1/shop-categories/999175?limit=2  
Example output:

```
{
    "data": {
        "id": 999175,
        "title": "Aut ipsam molestiae accusamus iure",
        "is_boosted": false,
        "link": "http:\/\/beahan.com\/",
        "parent_id": 999194,
        "type": "sub-category",
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
        "total": 25,
        "limit": 2,
        "offset": 0,
        "total_pages": 13,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/products?page=2&limit=2"
    },
    "data": [
        {
            "id": 999966,
            "title": "Officiis Ipsum Rerum Alias Cumque Occaecati",
            "is_boosted": false,
            "title_display": "Officiis Ipsum <em>Rerum Alias<\/em> Cumque Occaecati",
            "sku": "58054222",
            "link": "http:\/\/kuhn.com\/id-dolore-perspiciatis-ullam-facilis-et",
            ...
        },
        {
            "id": 999969,
            "title": "Odio Et Et Dicta Natus Totam",
            "is_boosted": false,
            "title_display": "Odio Et <em>Et Dicta<\/em> Natus Totam",
            "sku": "63522761",
            "link": "http:\/\/sauer.com\/aut-voluptatem-sit-ut-vel-modi-quia.html",
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
        "total": 70,
        "limit": 10,
        "offset": 0,
        "total_pages": 7,
        "current_page": 1
    },
    "data": [
        {
            "_score": 2,
            "api_id": "999367",
            "api_model": "products",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/products\/999367",
            "id": 999367,
            "title": "Nesciunt Repudiandae Dolor Facere Dolorem Quod",
            "timestamp": "2018-01-25T13:34:02-06:00"
        },
        {
            "_score": 2,
            "api_id": "999627",
            "api_model": "products",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/products\/999627",
            "id": 999627,
            "title": "Laudantium Eum Non Tempora Vero Incidunt",
            "timestamp": "2018-01-25T13:34:02-06:00"
        },
        {
            "_score": 2,
            "api_id": "999133",
            "api_model": "products",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/products\/999133",
            "id": 999133,
            "title": "Et Adipisci Et Unde Velit Commodi",
            "timestamp": "2018-01-25T13:34:02-06:00"
        }
    ]
}
```

### `/products/{id}`

A single products by the given identifier.

Example request: http://aggregator-data-test.artic.edu/api/v1/products/999966?limit=2  
Example output:

```
{
    "data": {
        "id": 999966,
        "title": "Officiis Ipsum Rerum Alias Cumque Occaecati",
        "is_boosted": false,
        "title_display": "Officiis Ipsum <em>Rerum Alias<\/em> Cumque Occaecati",
        "sku": "58054222",
        "link": "http:\/\/kuhn.com\/id-dolore-perspiciatis-ullam-facilis-et",
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
        "total": 128,
        "limit": 2,
        "offset": 0,
        "total_pages": 64,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/legacy-events?page=2&limit=2"
    },
    "data": [
        {
            "id": 2277,
            "title": "Museum Closed for Christmas",
            "is_boosted": false,
            "description": "",
            "short_description": "",
            "image": "",
            ...
        },
        {
            "id": 2278,
            "title": "Museum Closed for New Year&#039;s Day",
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
        "total": 123,
        "limit": 10,
        "offset": 0,
        "total_pages": 13,
        "current_page": 1
    },
    "data": [
        {
            "_score": 2,
            "api_id": "7832",
            "api_model": "legacy-events",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/legacy-events\/7832",
            "id": 7832,
            "title": "Artists Connect: Barak ad\u00e9 Soleil",
            "timestamp": "2018-02-14T22:38:09-06:00"
        },
        {
            "_score": 2,
            "api_id": "7703",
            "api_model": "legacy-events",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/legacy-events\/7703",
            "id": 7703,
            "title": "Gallery Talk: Art of the Newspaper",
            "timestamp": "2018-02-14T22:38:06-06:00"
        },
        {
            "_score": 2,
            "api_id": "7774",
            "api_model": "legacy-events",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/legacy-events\/7774",
            "id": 7774,
            "title": "Gallery Talk: Intersections",
            "timestamp": "2018-02-14T22:38:07-06:00"
        }
    ]
}
```

### `/legacy-events/{id}`

A single legacy-events by the given identifier.

Example request: http://aggregator-data-test.artic.edu/api/v1/legacy-events/2277?limit=2  
Example output:

```
{
    "data": {
        "id": 2277,
        "title": "Museum Closed for Christmas",
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
        "total": 8,
        "limit": 2,
        "offset": 0,
        "total_pages": 4,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/tours?page=2&limit=2"
    },
    "data": [
        {
            "id": 2193,
            "title": "The Essentials Tour",
            "is_boosted": false,
            "image": "http:\/\/aicweb10.artic.edu\/sites\/default\/files\/tour-images\/english%20%281%29.jpg",
            "description": "Discover the stories behind some of the museum\u2019s most iconic artworks.",
            "intro": "Indulge in the sunlit bank of the River Seine in Georges Seurat\u2019s \"A Sunday on La Grande Jatte\" or make a late-night stop at a New York City diner in Edward Hopper\u2019s \"Nighthawks\" in this tour of the museum\u2019s iconic collection. Founded in 1879, the Art Institute of Chicago is home to a massive collection spanning nearly all of human history. As you explore centuries of art, this tour highlights some essential landmarks\u2014with lesser known, but equally engaging artworks\u2014along the way. The soundtrack features the music of Andrew Bird, another Chicago essential.",
            ...
        },
        {
            "id": 2219,
            "title": "Visita a lo esencial",
            "is_boosted": false,
            "image": "http:\/\/aicweb10.artic.edu\/sites\/default\/files\/tour-images\/espanol.jpg",
            "description": "Descubra las historias detr\u00e1s de algunas de las obras de arte m\u00e1s ic\u00f3nicas del museo.",
            "intro": "Disfrute el banco del R\u00edo Sena ba\u00f1ado de sol en \u201cUn domingo en La Grande Jatte\u201d de Georges Seurat o haga una parada nocturna en una cafeter\u00eda de Nueva York en \u201cNighthawks\u201d de Edward Hopper en esta visita a la ic\u00f3nica colecci\u00f3n del museo. El Art Institute of Chicago, fundado en 1879, alberga una enorme colecci\u00f3n que abarca casi toda la historia de la humanidad. A medida que explora siglos de arte, esta visita resalta algunos hitos esenciales, con obras de arte menos conocidas, pero igualmente interesantes, en todo el recorrido. La pista musical presenta la m\u00fasica de Andrew Bird, otra persona esencial en Chicago.",
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
        "total": 33,
        "limit": 10,
        "offset": 0,
        "total_pages": 4,
        "current_page": 1
    },
    "data": [
        {
            "_score": 2,
            "api_id": "9992046",
            "api_model": "tours",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/tours\/9992046",
            "id": 9992046,
            "title": "Et aut commodi",
            "timestamp": "2018-01-25T13:34:14-06:00"
        },
        {
            "_score": 2,
            "api_id": "9992691",
            "api_model": "tours",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/tours\/9992691",
            "id": 9992691,
            "title": "Debitis assumenda enim",
            "timestamp": "2018-01-25T13:34:14-06:00"
        },
        {
            "_score": 2,
            "api_id": "9996612",
            "api_model": "tours",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/tours\/9996612",
            "id": 9996612,
            "title": "Sint eum aspernatur",
            "timestamp": "2018-01-25T13:34:14-06:00"
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
        "total": 98,
        "limit": 2,
        "offset": 0,
        "total_pages": 49,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/tour-stops?page=2&limit=2"
    },
    "data": [
        {
            "id": 12,
            "title": "The Woman's Board Grand Staircase",
            "is_boosted": false,
            "artwork_title": "The Woman's Board Grand Staircase",
            "artwork_id": 236511,
            "tour_id": null,
            ...
        },
        {
            "id": 98,
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

Example request: http://aggregator-data-test.artic.edu/api/v1/tour-stops/17?limit=2  
Example output:

```
{
    "data": {
        "id": 17,
        "title": "Chicago Stock Exchange Trading Room: Reconstruction at the Art Institute of Chicago",
        "is_boosted": false,
        "artwork_title": "Chicago Stock Exchange Trading Room: Reconstruction at the Art Institute of Chicago",
        "artwork_id": 156538,
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
        "total": 569,
        "limit": 2,
        "offset": 0,
        "total_pages": 285,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/mobile-sounds?page=2&limit=2"
    },
    "data": [
        {
            "id": 1536,
            "title": "Arrangement in Flesh Color and Brown: Portrait of Arthur Jerome Eddy",
            "is_boosted": false,
            "link": "http:\/\/aicweb10.artic.edu\/sites\/default\/files\/audio\/742.mp3",
            "transcript": "NARRATOR: For James McNeill Whistler, the title of a painting really mattered. \r\nSarah Kelly:  You&#039;ll notice that Whistler titled this portrait, &quot;Arrangement in Flesh Color and Brown,&quot; and only then has the subtitle, &quot;Portrait of Arthur Jerome Eddy.&quot; He wanted to emphasize that it was simply a chosen arrangement of line and of color, rather than Arthur Jerome Eddy. And Eddy was very much agreeable to this. \r\n\r\nNARRATOR:  Sarah Kelly, Associate Curator at the Art Institute of Chicago. \r\n\r\nSARAH KELLY:  Arthur Jerome Eddy is a very important person to the Art Institute of Chicago. He was a Chicago lawyer, and he saw Whistler&#039;s works at the 1893 World&#039;s Columbian Exhibition here in Chicago, where Whistler actually was given center stage. And he was so impressed that he went off and asked Whistler to paint his portrait. He then went from championing Whistler to championing modern art. He became a very influential collector of modern paintings, so the core collection of German expressionist painting came from Arthur Jerome Eddy. He also published a book about modern art. So he was very influential in promoting modern art in America, and particularly in Chicago.",
            "last_updated_source": null,
            ...
        },
        {
            "id": 1537,
            "title": "Bust of a Youth (Saint John the Baptist?)",
            "is_boosted": false,
            "link": "http:\/\/aicweb10.artic.edu\/sites\/default\/files\/audio\/750.mp3",
            "transcript": "NARRATOR:  Bruce Boucher, Curator of European sculpture. \r\n\r\nBRUCE BOUCHER:  Francesco Mochi&#039;s Bust of a Youth is one of our signature pieces, and it is one of the most beautiful Baroque sculptures in the collection. It shows a youth, an adolescent, with corkscrew curls and drapery that suggests he may or may not be the young Saint John the Baptist. But it is a portrait of adolescence, he has a rather dreamy expression and his lips are parted as if he is about to speak, or has just said something. It&#039;s the kind of animated expression that Baroque sculptors like Mochi would use, to try to transcend the limitations of marble as a medium. \r\n\r\nBRUCE BOUCHER  He could carve marble like butter. And if you look at these curls, you could put your finger through them, they are really a tour de force of sculpture. What is Baroque about this, is the way in which.. the sculptor is trying to engage us in a kind of imaginary discourse with the sitter. The figure&#039;s head is turned sharply to the side, his eyes are focused, his mouth is open. There&#039;s a sense of movement about it, which distinguishes it from a Renaissance sculpture, which would probably have been much more passive and less engaged with us as spectators.",
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
            "id": 226,
            "title": "James Ensor: The Temptation of Saint Anthony",
            "is_boosted": false,
            "web_url": "https:\/\/publications.artic.edu\/ensor\/reader\/temptationstanthony",
            "site": "ensor",
            "alias": "temptationstanthony",
            ...
        },
        {
            "id": 140019,
            "title": "Manet Paintings and Works on Paper at the Art Institute of Chicago",
            "is_boosted": false,
            "web_url": "https:\/\/publications.artic.edu\/manet\/reader\/manetart",
            "site": "manet",
            "alias": "manetart",
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
        "total": 35,
        "limit": 10,
        "offset": 0,
        "total_pages": 4,
        "current_page": 1
    },
    "data": [
        {
            "_score": 2,
            "api_id": "9998893",
            "api_model": "publications",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/publications\/9998893",
            "id": 9998893,
            "title": "Rerum cupiditate id",
            "timestamp": "2018-01-25T13:34:20-06:00"
        },
        {
            "_score": 2,
            "api_id": "9995008",
            "api_model": "publications",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/publications\/9995008",
            "id": 9995008,
            "title": "Quaerat autem totam",
            "timestamp": "2018-01-25T13:34:20-06:00"
        },
        {
            "_score": 2,
            "api_id": "9991871",
            "api_model": "publications",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/publications\/9991871",
            "id": 9991871,
            "title": "Soluta eum delectus",
            "timestamp": "2018-01-25T13:34:20-06:00"
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
            "id": 37654267653,
            "title": "Works of Art--Renoir 2014",
            "is_boosted": false,
            "web_url": "https:\/\/publications.artic.edu\/renoir\/reader\/paintingsanddrawings\/section\/138977",
            "accession": null,
            "revision": 1512680354,
            ...
        },
        {
            "id": 37793804331,
            "title": "Collection Highlights",
            "is_boosted": false,
            "web_url": "https:\/\/publications.artic.edu\/renoir\/reader\/paintingsanddrawings\/section\/139485",
            "accession": null,
            "revision": 1512680354,
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
        "total": 723,
        "limit": 10,
        "offset": 0,
        "total_pages": 73,
        "current_page": 1
    },
    "data": [
        {
            "_score": 2,
            "api_id": "499019",
            "api_model": "sections",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/sections\/499019",
            "id": 499019,
            "title": "Cat. 30 Denarius Portraying Julius Caesar",
            "timestamp": "2018-02-08T23:02:34-06:00"
        },
        {
            "_score": 2,
            "api_id": "488085",
            "api_model": "sections",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/sections\/488085",
            "id": 488085,
            "title": "Cat. 19 Head of a Philosopher",
            "timestamp": "2018-02-08T23:02:34-06:00"
        },
        {
            "_score": 2,
            "api_id": "487097",
            "api_model": "sections",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/sections\/487097",
            "id": 487097,
            "title": "Cat. 20 Side Panel of a Sarcophagus",
            "timestamp": "2018-02-08T23:02:34-06:00"
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
            "id": 96,
            "title": "Van Gogh's Bedroooms",
            "is_boosted": false,
            "description": "Vincent van Gogh\u2019s bedroom in Arles is arguably the most famous chambre in the history of art. It also held special significance for the artist, who created three distinct paintings of this intimate space from 1888 to 1889. This exhibition\u2014presented only at the Art Institute of Chicago\u2014brings together all three versions of The Bedroom for the first time in North America, offering a pioneering and in-depth study of their making and meaning to Van Gogh in his relentless quest for home.",
            "web_url": "http:\/\/archive.artic.edu\/van-gogh-bedrooms\/",
            "exhibition_ids": [
                1865
            ],
            ...
        },
        {
            "id": 89,
            "title": "Magritte: Time Transfixed",
            "is_boosted": false,
            "description": "Magritte: The Mystery of the Ordinary, 1926\u20141938 focuses on Ren\u00e9 Magritte\u2019s breakthrough Surrealist years, peeling back the layers of this inventive and experimental period in the artist\u2019s career to reveal the development of the themes and motifs that make his art so unforgettable. Each of Magritte\u2019s enigmatic works encourages viewers to think and search deeply, and in the case of the Art Institute\u2019s iconic Time Transfixed, that kind of probing investigation revealed surprising twists and turns in the making of painting.",
            "web_url": "http:\/\/archive.artic.edu\/magritte\/",
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
        "total": 121,
        "limit": 10,
        "offset": 0,
        "total_pages": 13,
        "current_page": 1
    },
    "data": [
        {
            "_score": 2,
            "api_id": "9991844",
            "api_model": "sites",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/sites\/9991844",
            "id": 9991844,
            "title": "Possimus quis a",
            "timestamp": "2018-01-25T13:34:26-06:00"
        },
        {
            "_score": 2,
            "api_id": "9997382",
            "api_model": "sites",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/sites\/9997382",
            "id": 9997382,
            "title": "Architecto consequatur eum",
            "timestamp": "2018-01-25T13:34:26-06:00"
        },
        {
            "_score": 2,
            "api_id": "9990543",
            "api_model": "sites",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/sites\/9990543",
            "id": 9990543,
            "title": "Eligendi sint officiis",
            "timestamp": "2018-01-25T13:34:26-06:00"
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
            "id": 25535,
            "title": "Streetscape",
            "alternate_title": null,
            "web_url": "http:\/\/digital-libraries.saic.edu\/cdm\/ref\/collection\/mqc\/id\/25535",
            "collection": "Historic Architecture and Landscape Image Collection, c.1865-1973 (bulk 1890-1930)",
            "archive": "Architecture Lantern Slide Collection",
            ...
        },
        {
            "id": 25792,
            "title": "Rue de la Saint-Antoine",
            "alternate_title": null,
            "web_url": "http:\/\/digital-libraries.saic.edu\/cdm\/ref\/collection\/mqc\/id\/25792",
            "collection": "Historic Architecture and Landscape Image Collection, c.1865-1973 (bulk 1890-1930)",
            "archive": "Architecture Lantern Slide Collection",
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
            "id": 25535,
            "title": "Streetscape",
            "alternate_title": null,
            "web_url": "http:\/\/digital-libraries.saic.edu\/cdm\/ref\/collection\/mqc\/id\/25535",
            "collection": "Historic Architecture and Landscape Image Collection, c.1865-1973 (bulk 1890-1930)",
            "archive": "Architecture Lantern Slide Collection",
            ...
        },
        {
            "id": 25792,
            "title": "Rue de la Saint-Antoine",
            "alternate_title": null,
            "web_url": "http:\/\/digital-libraries.saic.edu\/cdm\/ref\/collection\/mqc\/id\/25792",
            "collection": "Historic Architecture and Landscape Image Collection, c.1865-1973 (bulk 1890-1930)",
            "archive": "Architecture Lantern Slide Collection",
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
            "id": "01ARTIC_ALMA2123092740003801",
            "title": "A Voyage to Cadiz and Gibraltar, up the Mediterranean to Sicily and Malta, in 1810, & 11 : including a description of Sicily and the Lipari Islands, and an excursion in Portugal",
            "date": 1815,
            "creators": [
                {
                    "id": "no89017673",
                    "uri": "http:\/\/id.loc.gov\/authorities\/names\/no89017673",
                    "title": "Cockburn, George"
                }
            ],
            "subjects": [
                {
                    "id": "sh86002688",
                    "uri": "http:\/\/id.loc.gov\/authorities\/subjects\/sh86002688",
                    "title": "Mediterranean Region -- Description and travel"
                },
                {
                    "id": "sh85122237",
                    "uri": "http:\/\/id.loc.gov\/authorities\/subjects\/sh85122237",
                    "title": "Sicily (Italy) -- Description and travel"
                },
                {
                    "id": "sh85080200",
                    "uri": "http:\/\/id.loc.gov\/authorities\/subjects\/sh85080200",
                    "title": "Malta -- Description and travel"
                },
                {
                    "id": "sh85105232",
                    "uri": "http:\/\/id.loc.gov\/authorities\/subjects\/sh85105232",
                    "title": "Portugal -- Description and travel"
                }
            ],
            ...
        },
        {
            "id": "01ARTIC_ALMA2123108950003801",
            "title": "Nihon jinmin no sh\u014dri e no zenshin : Anpo hantai t\u014ds\u014d kiroku shashinsh\u016b",
            "date": 1961,
            "creators": [
                {
                    "id": "n50061776",
                    "uri": "http:\/\/id.loc.gov\/authorities\/names\/n50061776",
                    "title": "Nihon Ky\u014dsant\u014d"
                }
            ],
            "subjects": [
                {
                    "id": "sh2010106269",
                    "uri": "http:\/\/id.loc.gov\/authorities\/subjects\/sh2010106269",
                    "title": "Peace movements -- Japan"
                },
                {
                    "id": "sh2008107793",
                    "uri": "http:\/\/id.loc.gov\/authorities\/subjects\/sh2008107793",
                    "title": "Military assistance, American -- Japan"
                },
                {
                    "id": "sh2008115634",
                    "uri": "http:\/\/id.loc.gov\/authorities\/subjects\/sh2008115634",
                    "title": "Japan -- Foreign relations -- United States"
                },
                {
                    "id": "sh85140113",
                    "uri": "http:\/\/id.loc.gov\/authorities\/subjects\/sh85140113",
                    "title": "United States -- Foreign relations -- Japan"
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
            "id": "01ARTIC_ALMA2123092740003801",
            "title": "A Voyage to Cadiz and Gibraltar, up the Mediterranean to Sicily and Malta, in 1810, & 11 : including a description of Sicily and the Lipari Islands, and an excursion in Portugal",
            "date": 1815,
            "creators": [
                {
                    "id": "no89017673",
                    "uri": "http:\/\/id.loc.gov\/authorities\/names\/no89017673",
                    "title": "Cockburn, George"
                }
            ],
            "subjects": [
                {
                    "id": "sh86002688",
                    "uri": "http:\/\/id.loc.gov\/authorities\/subjects\/sh86002688",
                    "title": "Mediterranean Region -- Description and travel"
                },
                {
                    "id": "sh85122237",
                    "uri": "http:\/\/id.loc.gov\/authorities\/subjects\/sh85122237",
                    "title": "Sicily (Italy) -- Description and travel"
                },
                {
                    "id": "sh85080200",
                    "uri": "http:\/\/id.loc.gov\/authorities\/subjects\/sh85080200",
                    "title": "Malta -- Description and travel"
                },
                {
                    "id": "sh85105232",
                    "uri": "http:\/\/id.loc.gov\/authorities\/subjects\/sh85105232",
                    "title": "Portugal -- Description and travel"
                }
            ],
            ...
        },
        {
            "id": "01ARTIC_ALMA2123108950003801",
            "title": "Nihon jinmin no sh\u014dri e no zenshin : Anpo hantai t\u014ds\u014d kiroku shashinsh\u016b",
            "date": 1961,
            "creators": [
                {
                    "id": "n50061776",
                    "uri": "http:\/\/id.loc.gov\/authorities\/names\/n50061776",
                    "title": "Nihon Ky\u014dsant\u014d"
                }
            ],
            "subjects": [
                {
                    "id": "sh2010106269",
                    "uri": "http:\/\/id.loc.gov\/authorities\/subjects\/sh2010106269",
                    "title": "Peace movements -- Japan"
                },
                {
                    "id": "sh2008107793",
                    "uri": "http:\/\/id.loc.gov\/authorities\/subjects\/sh2008107793",
                    "title": "Military assistance, American -- Japan"
                },
                {
                    "id": "sh2008115634",
                    "uri": "http:\/\/id.loc.gov\/authorities\/subjects\/sh2008115634",
                    "title": "Japan -- Foreign relations -- United States"
                },
                {
                    "id": "sh85140113",
                    "uri": "http:\/\/id.loc.gov\/authorities\/subjects\/sh85140113",
                    "title": "United States -- Foreign relations -- Japan"
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
            "id": "n98090075",
            "uri": "http:\/\/id.loc.gov\/authorities\/names\/n98090075",
            "title": "Baldung, Hans, -1545. Freiburg Altar",
            ...
        },
        {
            "id": "nr95018309",
            "uri": "http:\/\/id.loc.gov\/authorities\/names\/nr95018309",
            "title": "T\u00e9rey, G\u00e1bor",
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
            "id": "n98090075",
            "uri": "http:\/\/id.loc.gov\/authorities\/names\/n98090075",
            "title": "Baldung, Hans, -1545. Freiburg Altar",
            ...
        },
        {
            "id": "nr95018309",
            "uri": "http:\/\/id.loc.gov\/authorities\/names\/nr95018309",
            "title": "T\u00e9rey, G\u00e1bor",
            ...
        }
    ]
}
```

> Generated by `php artisan docs:endpoints` on 2018-02-16 08:36:58
