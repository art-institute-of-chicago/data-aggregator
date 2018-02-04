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

Example request: http://aggregator-data-test.artic.edu/api/v1/artworks?limit=2  
Example output:

```
{
    "pagination": {
        "total": 106479,
        "limit": 2,
        "offset": 0,
        "total_pages": 53240,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/artworks?page=2&limit=2"
    },
    "data": [
        {
            "id": 153671,
            "title": "Panel (Furnishing Fabric)",
            "lake_guid": "452bba13-905e-dce5-2c1c-d7038e8d3a5b",
            "is_boosted": false,
            "alt_titles": [],
            "main_reference_number": "1999.567",
            ...
        },
        {
            "id": 184960,
            "title": "Section of Border from Thanka (Religious Picture)",
            "lake_guid": "71d6fca7-d552-739f-d029-87806ea9bf0d",
            "is_boosted": false,
            "alt_titles": [],
            "main_reference_number": "1931.9b",
            ...
        }
    ]
}
```

### `/artworks/essentials`

A list of essential artworks sorted by last updated date in descending order. This is a subset of the `artworks/` endpoint that represents approximately 400 of our most well-known works. This can be used to get a shorter list of artworks that will have most of its metadata filled out for testing purposes.

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

Example request: http://aggregator-data-test.artic.edu/api/v1/artworks/essentials?limit=2  
Example output:

```
{
    "pagination": {
        "total": 413,
        "limit": 2,
        "offset": 0,
        "total_pages": 207,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/artworks\/essentials?page=2&limit=2"
    },
    "data": [
        {
            "id": 869,
            "title": "The Watermill with the Great Red Roof",
            "lake_guid": "43ec8cd2-8ac7-c9ec-5c7b-aa7a225b53c8",
            "is_boosted": true,
            "alt_titles": [],
            "main_reference_number": "1894.1031",
            ...
        },
        {
            "id": 4575,
            "title": "Judith",
            "lake_guid": "abd92a83-28ee-6255-d1f3-8354a9f39e08",
            "is_boosted": true,
            "alt_titles": [],
            "main_reference_number": "1956.1109",
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
            "_score": 14.395895,
            "api_id": "14598",
            "api_model": "artworks",
            "is_boosted": true,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/artworks\/14598",
            "id": 14598,
            "title": "The Beach at Sainte-Adresse",
            "timestamp": "2018-02-02T21:06:35-06:00"
        },
        {
            "_score": 13.653746,
            "api_id": "16571",
            "api_model": "artworks",
            "is_boosted": true,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/artworks\/16571",
            "id": 16571,
            "title": "Arrival of the Normandy Train, Gare Saint-Lazare",
            "timestamp": "2018-02-02T21:04:39-06:00"
        },
        {
            "_score": 13.653746,
            "api_id": "16568",
            "api_model": "artworks",
            "is_boosted": true,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/artworks\/16568",
            "id": 16568,
            "title": "Water Lilies",
            "timestamp": "2018-02-02T21:06:29-06:00"
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
    },
    "aggregations": {
        "count_api_model": [
            {
                "key": "artworks",
                "doc_count": 345
            }
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
            "is_boosted": false,
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
            "id": 41,
            "title": "Featured Works",
            "lake_guid": "ae637a2b-e996-a28e-7ca8-adae24ae01fa",
            "is_boosted": false,
            "parent_id": 2,
            "is_in_nav": true,
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
            "id": 44,
            "title": "Paintings, 1900-1955",
            "lake_guid": "dcafd608-cc4a-bf34-12b7-87e095bc0a5b",
            "is_boosted": false,
            "parent_id": 2,
            "is_in_nav": true,
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
            "id": 365,
            "title": "Art Access: Modern and Contemporary Art",
            "lake_guid": "b3743235-8d0d-a381-8582-95dfcad26711",
            "is_boosted": false,
            "parent_id": null,
            "is_in_nav": false,
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

Example request: http://aggregator-data-test.artic.edu/api/v1/agents?limit=2  
Example output:

```
{
    "pagination": {
        "total": 11522,
        "limit": 2,
        "offset": 0,
        "total_pages": 5761,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/agents?page=2&limit=2"
    },
    "data": [
        {
            "id": 87635,
            "title": "Manchu",
            "lake_guid": "d08c8763-3950-fda1-70af-84cbc4d594f6",
            "is_boosted": false,
            "alt_titles": [],
            "birth_date": null,
            ...
        },
        {
            "id": 34398,
            "title": "Peter Henry Emerson",
            "lake_guid": "82be17ba-593e-4653-e6d0-0ca37552c757",
            "is_boosted": false,
            "alt_titles": [],
            "birth_date": null,
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
        "total": 11646,
        "limit": 10,
        "offset": 0,
        "total_pages": 1165,
        "current_page": 1
    },
    "data": [
        {
            "_score": 2,
            "api_id": "4247",
            "api_model": "agents",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/agents\/4247",
            "id": 4247,
            "title": "Castiglione, Giovanni Battista",
            "timestamp": "2018-02-01T15:14:43-06:00"
        },
        {
            "_score": 2,
            "api_id": "16649",
            "api_model": "agents",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/agents\/16649",
            "id": 16649,
            "title": "Matsubara Naoko",
            "timestamp": "2018-02-01T15:14:52-06:00"
        },
        {
            "_score": 2,
            "api_id": "37129",
            "api_model": "agents",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/agents\/37129",
            "id": 37129,
            "title": "Vasarely, Victor de",
            "timestamp": "2018-02-01T15:15:18-06:00"
        }
    ],
    "aggregations": {
        "count_api_model": [
            {
                "key": "agents",
                "doc_count": 11646
            }
        ]
    }
}
```

### `/agents/{id}`

A single agents by the given identifier. {id} is the identifier from our collections managements system.

Example request: http://aggregator-data-test.artic.edu/api/v1/agents?limit=2  
Example output:

```
{
    "pagination": {
        "total": 11522,
        "limit": 2,
        "offset": 0,
        "total_pages": 5761,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/agents?page=2&limit=2"
    },
    "data": [
        {
            "id": 87635,
            "title": "Manchu",
            "lake_guid": "d08c8763-3950-fda1-70af-84cbc4d594f6",
            "is_boosted": false,
            "alt_titles": [],
            "birth_date": null,
            ...
        },
        {
            "id": 34398,
            "title": "Peter Henry Emerson",
            "lake_guid": "82be17ba-593e-4653-e6d0-0ca37552c757",
            "is_boosted": false,
            "alt_titles": [],
            "birth_date": null,
            ...
        }
    ]
}
```

## Departments

### `/departments`

A list of all departments sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](FIELDS.md#departments).

#### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

Example request: http://aggregator-data-test.artic.edu/api/v1/departments?limit=2  
Example output:

```
{
    "pagination": {
        "total": 32,
        "limit": 2,
        "offset": 0,
        "total_pages": 16,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/departments?page=2&limit=2"
    },
    "data": [
        {
            "id": 1,
            "title": "Unknown",
            "lake_guid": "a6295a34-c3a9-b51f-d9dc-c2d13be2aa75",
            "is_boosted": false,
            "last_updated_source": "2017-11-06T15:36:33-06:00",
            "last_updated": "2018-02-02T10:28:55-06:00",
            ...
        },
        {
            "id": 3,
            "title": "Prints and Drawings",
            "lake_guid": "922e5173-2c3d-b6c1-f223-bb591cafbb79",
            "is_boosted": false,
            "last_updated_source": "2017-11-06T15:36:31-06:00",
            "last_updated": "2018-02-02T10:28:55-06:00",
            ...
        }
    ]
}
```

### `/departments/search`

Search departments data in the aggregator. 

#### Available parameters:

* `q` - Your search query
* `query` - For complex queries, you can pass Elasticsearch domain syntax queries here
* `sort` - Used in conjunction with `query`
* `from` - Starting point of results. Pagination via Elasticsearch conventions
* `size` - Number of results to return. Pagination via Elasticsearch conventions
* `facets` - A comma-separated list of "count" aggregation facets to include in the results.

Example request: http://aggregator-data-test.artic.edu/api/v1/departments/search  
Example output:

```
{
    "preference": null,
    "pagination": {
        "total": 57,
        "limit": 10,
        "offset": 0,
        "total_pages": 6,
        "current_page": 1
    },
    "data": [
        {
            "_score": 2,
            "api_id": "999409545",
            "api_model": "departments",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/departments\/999409545",
            "id": 999409545,
            "title": "Odit Art",
            "timestamp": "2018-01-25T13:26:19-06:00"
        },
        {
            "_score": 2,
            "api_id": "999664329",
            "api_model": "departments",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/departments\/999664329",
            "id": 999664329,
            "title": "Eos Art",
            "timestamp": "2018-01-25T13:26:19-06:00"
        },
        {
            "_score": 2,
            "api_id": "999161977",
            "api_model": "departments",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/departments\/999161977",
            "id": 999161977,
            "title": "Nemo Art",
            "timestamp": "2018-01-25T13:26:19-06:00"
        }
    ],
    "aggregations": {
        "count_api_model": [
            {
                "key": "departments",
                "doc_count": 57
            }
        ]
    }
}
```

### `/departments/{id}`

A single departments by the given identifier. {id} is the identifier from our collections managements system.

Example request: http://aggregator-data-test.artic.edu/api/v1/departments/4?limit=2  
Example output:

```
{
    "data": {
        "id": 4,
        "title": "Textiles",
        "lake_guid": "cbb32062-dd50-8711-0513-f7d19801938c",
        "is_boosted": false,
        "last_updated_source": "2017-11-06T15:36:36-06:00",
        "last_updated": "2018-02-02T10:28:55-06:00",
        ...
    }
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
            "last_updated": "2018-02-02T10:28:56-06:00",
            ...
        },
        {
            "id": 2,
            "title": "Photograph",
            "lake_guid": "f3daccbc-a5c3-41c9-859b-aac047d78a1c",
            "is_boosted": false,
            "last_updated_source": "2018-01-12T13:58:03-06:00",
            "last_updated": "2018-02-02T10:28:56-06:00",
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
        "last_updated": "2018-02-02T10:28:56-06:00",
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
        "total": 815,
        "limit": 10,
        "offset": 0,
        "total_pages": 82,
        "current_page": 1
    },
    "data": [
        {
            "_score": 2,
            "api_id": "369",
            "api_model": "categories",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/categories\/369",
            "id": 369,
            "title": "Art Access: Art of the Americas",
            "timestamp": "2018-02-02T10:28:56-06:00"
        },
        {
            "_score": 2,
            "api_id": "79",
            "api_model": "categories",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/categories\/79",
            "id": 79,
            "title": "French",
            "timestamp": "2018-02-02T10:28:56-06:00"
        },
        {
            "_score": 2,
            "api_id": "98",
            "api_model": "categories",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/categories\/98",
            "id": 98,
            "title": "Painting 1600\u20131800",
            "timestamp": "2018-02-02T10:28:56-06:00"
        }
    ],
    "aggregations": {
        "count_api_model": [
            {
                "key": "categories",
                "doc_count": 815
            }
        ]
    }
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
        "total": 25,
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
            "last_updated_source": "2018-01-12T13:31:23-06:00",
            "last_updated": "2018-02-02T10:21:38-06:00",
            ...
        },
        {
            "id": 2,
            "title": "Culture",
            "lake_guid": "7b02ffea-6a50-4090-0898-f2ab89215d26",
            "is_boosted": false,
            "last_updated_source": "2018-01-12T13:31:25-06:00",
            "last_updated": "2018-02-02T10:21:38-06:00",
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
        "last_updated_source": "2018-01-12T13:31:23-06:00",
        "last_updated": "2018-02-02T10:21:38-06:00",
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
        "total": 1746,
        "limit": 2,
        "offset": 0,
        "total_pages": 873,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/places?page=2&limit=2"
    },
    "data": [
        {
            "id": 346,
            "title": "Stock Exchange Trading Room",
            "lake_guid": "78da15d9-176a-366e-32e0-5cfd4007cdac",
            "is_boosted": false,
            "type": "AIC Gallery",
            "is_closed": false,
            ...
        },
        {
            "id": 2147483599,
            "title": "Fullerton Hall Lobby",
            "lake_guid": "6a0f0d00-458d-ef16-33f9-ab82c95b985c",
            "is_boosted": false,
            "type": "AIC Gallery",
            "is_closed": false,
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
        "total": 1771,
        "limit": 10,
        "offset": 0,
        "total_pages": 178,
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
    ],
    "aggregations": {
        "count_api_model": [
            {
                "key": "places",
                "doc_count": 1771
            }
        ]
    }
}
```

### `/places/{id}`

A single places by the given identifier. {id} is the identifier from our collections managements system.

Example request: http://aggregator-data-test.artic.edu/api/v1/places/26772?limit=2  
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

Example request: http://aggregator-data-test.artic.edu/api/v1/exhibitions?limit=2  
Example output:

```
{
    "pagination": {
        "total": 5973,
        "limit": 2,
        "offset": 0,
        "total_pages": 2987,
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
        "total": 5998,
        "limit": 10,
        "offset": 0,
        "total_pages": 600,
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
            "api_id": "1082",
            "api_model": "exhibitions",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/exhibitions\/1082",
            "id": 1082,
            "title": "Windows on the War: Soviet Tass Posters  at Home and Abroad 1941-1945",
            "timestamp": "2018-02-02T13:40:52-06:00"
        }
    ],
    "aggregations": {
        "count_api_model": [
            {
                "key": "exhibitions",
                "doc_count": 5998
            }
        ]
    }
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
            "agent": "Mus\u00e9e d'Orsay",
            "agent_id": 93515,
            "exhibition": "Impressionism, Fashion, and Modernity",
            ...
        },
        {
            "id": 1446,
            "title": null,
            "lake_guid": null,
            "agent": "The Metropolitan Museum of Art",
            "agent_id": 25885,
            "exhibition": "Impressionism, Fashion, and Modernity",
            ...
        },
        {
            "id": 1447,
            "title": null,
            "lake_guid": null,
            "agent": "The Art Institute of Chicago",
            "agent_id": 25739,
            "exhibition": "Impressionism, Fashion, and Modernity",
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
        "total": 110207,
        "limit": 2,
        "offset": 0,
        "total_pages": 55104,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/images?page=2&limit=2"
    },
    "data": [
        {
            "id": "240afeef-965e-27d6-68b9-9b687e533c6d",
            "title": "IM019311",
            "is_boosted": false,
            "type": "image",
            "description": null,
            "content": null,
            ...
        },
        {
            "id": "2a97cbe8-2159-fef1-9e1e-89ec34ce275f",
            "title": "IM018887",
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
        "total": 110254,
        "limit": 10,
        "offset": 0,
        "total_pages": 11026,
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
    ],
    "aggregations": {
        "count_api_model": [
            {
                "key": "images",
                "doc_count": 110254
            }
        ]
    }
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
            "id": "1a521261-2f72-1ec7-5b65-35f7cead3849",
            "title": "Online Game: Henri de Toulouse-Lautrec's <em>At the Moulin Rouge<\/em>",
            "is_boosted": false,
            "type": "video",
            "description": "<p><em>Note: This game is not Macintosh compatible.<\/em><\/p><br \/> <p>What's missing in this picture of Parisians at the famous Moulin Rouge dance hall?<\/p>",
            "content": "http:\/\/www.artic.edu\/aic\/collections\/citi\/resources\/261.dcr",
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
    ],
    "aggregations": {
        "count_api_model": [
            {
                "key": "videos",
                "doc_count": 312
            }
        ]
    }
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
        "total": 146,
        "limit": 2,
        "offset": 0,
        "total_pages": 73,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/links?page=2&limit=2"
    },
    "data": [
        {
            "id": "07b09575-74d2-9fba-2ba5-a0b00c8ebc52",
            "title": "REUSE",
            "is_boosted": false,
            "type": "link",
            "description": null,
            "content": null,
            ...
        },
        {
            "id": "1ac6c73b-e560-5fc9-05fb-8e2c30eccdc0",
            "title": "Text: The Bartletts and the Grande Jatte:  Collecting Modern Painting in the 1920s",
            "is_boosted": false,
            "type": "link",
            "description": "The fascinating story of the collectors' love of modern art and their acquisiton of  Seurat's famous painting in 1924.",
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
    ],
    "aggregations": {
        "count_api_model": [
            {
                "key": "links",
                "doc_count": 146
            }
        ]
    }
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
            "id": "0a9dc20c-f384-990b-43dc-c51b24cb5a72",
            "title": "569.mp3",
            "is_boosted": false,
            "type": "sound",
            "description": null,
            "content": null,
            ...
        },
        {
            "id": "0eb6300c-f812-8d92-46c8-a2fa0e0f89f1",
            "title": "247.mp3",
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
    ],
    "aggregations": {
        "count_api_model": [
            {
                "key": "sounds",
                "doc_count": 1020
            }
        ]
    }
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
            "id": "000c25a1-f2bb-affb-6575-5afbacc9587c",
            "title": "Artist Biography: Gustave Courbet",
            "is_boosted": false,
            "type": "text",
            "description": "A concise biography of Courbet's life and work.  ",
            "content": "Gustave Courbet<br>\nFrench, 1819-1877<br>\nGustave Courbet was the main exponent of realism in nineteenth-century French painting. His style contrasts with the classicism of Jean-Auguste-Dominique Ingres and the romanticism of Eug\u00e8ne Delacroix. Rejecting the fine, smooth finish of\nacademic paintings, he was the first to popularize the palette-knife technique that enabled him to emulate a variety of textures.<br><br>\nBorn in Ornans, Courbet came to Paris, where he exhibited at the Salon for the first time in 1841. After his work was rejected from the Exposition Universelle in 1855, he built the Pavilion of Realism, where he held a one-man exhibition that firmly established his position as the leading realist painter. This defiant act and his bold red signature were clear assertions of his disdain for the Acad\u00e9mie Royale.<br><br>\nFrom the 1850s Courbet traveled extensively but consciously maintained his connection to the countryside by frequently returning to Ornans. His contemporary depictions of French peasant life explore and elevate themes considered unworthy of representation in academic culture. He was imprisoned for his prominent role as head of the Federation of Arts in the Paris Commune in 1871. Ostracized for his radical politics, Courbet spent his last years in exile in Switzerland.\n",
            ...
        },
        {
            "id": "065f90c5-32de-a279-c981-0e12e9203c34",
            "title": "Introduction: Degas's <em>Spanish Dance<\/em>",
            "is_boosted": false,
            "type": "text",
            "description": "An introduction to one of two known sculptural studies by the artist treating a Spaninsh theme.  ",
            "content": "This is one of two known sculptural studies by Edgar Degas treating a Spanish theme. Degas may have chosen this pose\u2014called a <em>cambr\u00e9<\/em>, or bend from the waist\u2014after seeing Edouard Manet\u2019s painting <em>Spanish Dance<\/em> (1862; Washington, D.C., Phillips Collection), which includes two dancers posed in a similar manner, at a retrospective of the artist\u2019s work in 1883. Degas was probably also influenced by an 1837 bronze by Jean Auguste Barre of the ballerina Fanny Elssler, who achieved her greatest success performing the <em>cachucha<\/em>, a Spanish dance featured in a ballet choreographed by Jean Coralli. <br><br>\n Of the more than one hundred fifty wax sculptures that Degas produced, he exhibited just one and sold none. Only after his death were seventy-three of the waxes cast in bronze. Why did the artist make sculptures if he did not intend to display them in a permanent form? The answer lies in his compositional methods. Degas characteristically explored poses from various angles and experimented with reversals and tracings. Sculpture came to play an important role in this process, supplementing his life studies and allowing him to examine a figure from all points of view. Furthermore, because Degas made his sculptures on a small scale and with malleable materials, he could adjust their contours and lines to create new positions.  <br><br>\nIn <em>Spanish Dance<\/em>, Degas displayed his typical interest in the fine points of posture. With a flourish, the figure reaches her right arm over her head, curves her left arm in front of her torso, and bends back, thrusting her left hip to the side. Somewhat surprisingly, given Degas\u2019 interest in various ethnic dance styles, he did not explore Spanish dance themes in a sustained manner; this dramatic pose does not appear in any of the artist\u2019s known two-dimensional work.\n\n",
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
    ],
    "aggregations": {
        "count_api_model": [
            {
                "key": "texts",
                "doc_count": 601
            }
        ]
    }
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
            "id": 999689,
            "title": "Aut et recusandae eveniet iure",
            "is_boosted": false,
            "link": "http:\/\/ratke.com\/maiores-ut-fuga-illum-qui-consectetur-adipisci-hic-corporis",
            "parent_id": 999405,
            "type": "artist",
            ...
        },
        {
            "id": 999693,
            "title": "Magni ullam voluptatibus reprehenderit optio",
            "is_boosted": false,
            "link": "http:\/\/www.bogan.com\/repudiandae-incidunt-laborum-quae-incidunt-sunt-voluptatem.html",
            "parent_id": 999879,
            "type": "color",
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
        "total": 50,
        "limit": 10,
        "offset": 0,
        "total_pages": 5,
        "current_page": 1
    },
    "data": [
        {
            "_score": 2,
            "api_id": "999579",
            "api_model": "shop-categories",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/shop-categories\/999579",
            "id": 999579,
            "title": "Similique aut quia laboriosam blanditiis",
            "timestamp": "2018-01-25T13:34:01-06:00"
        },
        {
            "_score": 2,
            "api_id": "999872",
            "api_model": "shop-categories",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/shop-categories\/999872",
            "id": 999872,
            "title": "Rerum et aut provident rerum",
            "timestamp": "2018-01-25T13:34:01-06:00"
        },
        {
            "_score": 2,
            "api_id": "999287",
            "api_model": "shop-categories",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/shop-categories\/999287",
            "id": 999287,
            "title": "Asperiores ut illum enim debitis",
            "timestamp": "2018-01-25T13:34:01-06:00"
        }
    ],
    "aggregations": {
        "count_api_model": [
            {
                "key": "shop-categories",
                "doc_count": 50
            }
        ]
    }
}
```

### `/shop-categories/{id}`

A single shop-categories by the given identifier.

Example request: http://aggregator-data-test.artic.edu/api/v1/shop-categories/999689?limit=2  
Example output:

```
{
    "data": {
        "id": 999689,
        "title": "Aut et recusandae eveniet iure",
        "is_boosted": false,
        "link": "http:\/\/ratke.com\/maiores-ut-fuga-illum-qui-consectetur-adipisci-hic-corporis",
        "parent_id": 999405,
        "type": "artist",
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
            "id": 999681,
            "title": "Quia Esse Quibusdam Doloremque Perferendis Expedita",
            "is_boosted": false,
            "title_display": "Quia Esse <em>Quibusdam Doloremque<\/em> Perferendis Expedita",
            "sku": "68504410",
            "link": "http:\/\/www.reynolds.com\/",
            ...
        },
        {
            "id": 999444,
            "title": "Non Dolores Optio Sint Voluptas Esse",
            "is_boosted": false,
            "title_display": "Non Dolores <em>Optio Sint<\/em> Voluptas Esse",
            "sku": "94387667",
            "link": "http:\/\/www.sipes.biz\/",
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
        "total": 48,
        "limit": 10,
        "offset": 0,
        "total_pages": 5,
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
    ],
    "aggregations": {
        "count_api_model": [
            {
                "key": "products",
                "doc_count": 48
            }
        ]
    }
}
```

### `/products/{id}`

A single products by the given identifier.

Example request: http://aggregator-data-test.artic.edu/api/v1/products/999681?limit=2  
Example output:

```
{
    "data": {
        "id": 999681,
        "title": "Quia Esse Quibusdam Doloremque Perferendis Expedita",
        "is_boosted": false,
        "title_display": "Quia Esse <em>Quibusdam Doloremque<\/em> Perferendis Expedita",
        "sku": "68504410",
        "link": "http:\/\/www.reynolds.com\/",
        ...
    }
}
```

# Events and Membership

## Events

### `/events`

A list of all events sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](FIELDS.md#events).

#### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

Example request: http://aggregator-data-test.artic.edu/api/v1/events?limit=2  
Example output:

```
{
    "pagination": {
        "total": 1858,
        "limit": 2,
        "offset": 0,
        "total_pages": 929,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/events?page=2&limit=2"
    },
    "data": [
        {
            "id": 2639272,
            "title": "Museum Closed for New Year&#039;s Day",
            "is_boosted": false,
            "description": "",
            "short_description": "",
            "image": "",
            ...
        },
        {
            "id": 2636974,
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

### `/events/search`

Search events data in the aggregator. 

#### Available parameters:

* `q` - Your search query
* `query` - For complex queries, you can pass Elasticsearch domain syntax queries here
* `sort` - Used in conjunction with `query`
* `from` - Starting point of results. Pagination via Elasticsearch conventions
* `size` - Number of results to return. Pagination via Elasticsearch conventions
* `facets` - A comma-separated list of "count" aggregation facets to include in the results.

Example request: http://aggregator-data-test.artic.edu/api/v1/events/search  
Example output:

```
{
    "preference": null,
    "pagination": {
        "total": 1918,
        "limit": 10,
        "offset": 0,
        "total_pages": 192,
        "current_page": 1
    },
    "data": [
        {
            "_score": 2,
            "api_id": "30384910",
            "api_model": "events",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/events\/30384910",
            "id": 30384910,
            "title": "Sketch Class: The Sketchbook as Tool",
            "timestamp": "2018-01-25T12:32:45-06:00"
        },
        {
            "_score": 2,
            "api_id": "14888",
            "api_model": "events",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/events\/14888",
            "id": 14888,
            "title": "Lecture: Drinking with Dionysos and Sekhmet&#039;s Wrath: Beer and Wine in Egypt and Greece",
            "timestamp": "2018-01-25T12:32:42-06:00"
        },
        {
            "_score": 2,
            "api_id": "11169942",
            "api_model": "events",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/events\/11169942",
            "id": 11169942,
            "title": "Museum Orientation Tour",
            "timestamp": "2018-01-25T12:32:42-06:00"
        }
    ],
    "aggregations": {
        "count_api_model": [
            {
                "key": "events",
                "doc_count": 1918
            }
        ]
    }
}
```

### `/events/{id}`

A single events by the given identifier.

Example request: http://aggregator-data-test.artic.edu/api/v1/events/28990343?limit=2  
Example output:

```
{
    "data": {
        "id": 28990343,
        "title": "Gallery Talk in American Sign Language",
        "is_boosted": false,
        "description": "Join us on an interactive tour of works in the collection led by a museum educator in American Sign Language. This public program is offered primarily for the Deaf community. All visitors are welcome.<br \/>\nTo request an accessibility accommodation for an Art Institute program, please call (312) 443-3680 or send an e-mail to access@artic.edu as far in advance as possible.\u00a0<br \/>\nPlease see the museum\u2019s Accessibility page for more information.<br \/>\n\u00a0",
        "short_description": "Guided Tour",
        "image": "http:\/\/www.artic.edu\/sites\/default\/files\/cal-ASL%20tour.-06222017.jpg",
        ...
    }
}
```

## Members

### `/members/{id}?zip=XXX`

A single member by the given identifier. Will only provide results if a valid verification parameter is passed.

#### Available parameters:

* `zip` - The zip code matching the requested member record
* `email` - The email address matching the requested member record
* `phone` - The phone number matching the requested member record


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
  * `stops`

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
            "id": 2352,
            "title": "Visions of America",
            "is_boosted": false,
            "image": "http:\/\/aicweb10.artic.edu\/sites\/default\/files\/tour-images\/10141_4227478.jpg",
            "description": "Inspired by the hit musical Hamilton, explore America now, through America&nbsp;then.&nbsp;",
            "intro": "Narrated by two principal cast members from the Chicago production of Hamilton\u2014this new audio tour offers a contemporary lens on art from the early years of the United States. Get to know the people, places, and stories behind a variety of works of early American art and gain a new understanding of America now.",
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
    ],
    "aggregations": {
        "count_api_model": [
            {
                "key": "tours",
                "doc_count": 33
            }
        ]
    }
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
            "id": 99,
            "title": "Punch Bowl",
            "is_boosted": false,
            "artwork": "Punch Bowl",
            "artwork_id": null,
            "mobile_sound": "http:\/\/aicweb10.artic.edu\/sites\/default\/files\/audio\/121%20Punch%20Bowl%20DD%20092617.mp3",
            ...
        },
        {
            "id": 100,
            "title": "Mrs. Andrew Bedford Bankson and Son, Gunning Bedford Bankson",
            "is_boosted": false,
            "artwork": "Mrs. Andrew Bedford Bankson and Son, Gunning Bedford Bankson",
            "artwork_id": null,
            "mobile_sound": "http:\/\/aicweb10.artic.edu\/sites\/default\/files\/audio\/122%20Joshua%20Johnson%20DD%20092617.mp3",
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
    "data": [],
    "aggregations": {
        "count_api_model": []
    }
}
```

### `/tour-stops/{id}`

A single tour-stops by the given identifier.

Example request: http://aggregator-data-test.artic.edu/api/v1/tour-stops/160?limit=2  
Example output:

```
{
    "data": {
        "id": 160,
        "title": "Nighthawks",
        "is_boosted": false,
        "artwork": "Nighthawks",
        "artwork_id": null,
        "mobile_sound": "http:\/\/aicweb10.artic.edu\/sites\/default\/files\/audio\/973s.mp3",
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
            "id": 256,
            "title": "Jan Cornelis Sylvius",
            "is_boosted": false,
            "link": "http:\/\/aicweb10.artic.edu\/sites\/default\/files\/audio\/888.mp3",
            "transcript": "NARRATOR: This is Jan Cornelis Sylvius, a minister in the Dutch Reform Church. A cousin of Rembrandt\u2019s first wife Saskia, Sylvius baptized Rembrandt\u2019s first two children. But he was best known for his considerable skills as an orator. \r\n\r\nVICTORIA SANCHO LOBIS: In fact, Rembrandt created this portrait print of Sylvius depicting him in the act of speaking. So, Rembrandt was in some ways confronting the idea of how do you convey speech? Rembrandt has chosen to show him extending his right hand.  This is a classic rhetorical gesture that dates back to ancient sculpture. You can see that his hand casts a shadow on what appears to be the portrait\u2019s frame, and his face also casts a shadow just beyond the darkened oval.  \r\n\r\nNARRATOR: These devices refer to a tradition of funerary sculpture in the Netherlands, which often included sculpted busts of the deceased emerging from the face of a tomb.  And this is, indeed, a posthumous portrait, produced six years after Sylvius\u2019s death.\r\n\r\nThe text around the minister names him, says where he worked, and gives the date of his death. Rembrandt also includes a poem that reads, in part:\r\n\r\nVICTORIA SANCHO LOBIS: \u201cHis eloquence taught men to honor Christ and showed them the true way to heaven.\u201d \r\n",
            "last_updated_source": null,
            ...
        },
        {
            "id": 1024,
            "title": "Introduction to \"City Within a City\"",
            "is_boosted": false,
            "link": "http:\/\/aicweb10.artic.edu\/sites\/default\/files\/audio\/AIC%20Architecture%20Tour_INTRO_With%20IDs.mp3",
            "transcript": "ERIN HOGAN: I just think about, like, Chicago trying to prove itself and trying to be cultural. And, like, so much energy, and this building is kind of, like, so ambitious. \r\n\r\nThe Architecture of the Art Institute of Chicago. Hello, everybody, I am Erin Hogan, and I am the former Director of Public Affairs and Communication at the Art Institute of Chicago, and I have just long been an admirer of the physical building of the Art Institute. I love this building so much because I see it as a living, breathing organism. Well, when you walk through the door on Michigan Avenue, which for the bulk of the Art Institute&#039;s history was our only entrance, you can see immediately that you are supposed to be awed. This is a grand, civic building. You have to ascend to it; you have to come up a flight of stairs to get into the building. \r\n\r\nTIM SAMUELSON: I mean, I really feel that buildings and places have a collective vibe. And you can feel it in a building like the Art Institute, in the different spaces. And you can feel the presence of different eras of the people who created them. And the best part of it is just working quietly behind the scenes. But it&#039;s very much there. \r\n \r\nJOHN VINCI: Well the Art Institute is a conglomerate of expansions. So this is what gave the Art Institute is a special quality to me, is these parts that made it more like a city rather than a museum designed in one foul swoop. \r\n\r\nERIN HOGAN: You know, we&#039;re all about art here, it is an art museum, but this is a tour in which you will not see any art at all. And you will walk past a lot of monumental works of art at a criminal pace while we talk about corners and walls and buildings. But hopefully it will give you an appreciation for the structure that is the Art Institute of Chicago. \r\n\r\nNARRATOR: This audio guide is supported by Bloomberg Philanthropies. \r\n",
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
            "id": 135446,
            "title": "Renoir Paintings and Drawings at the Art Institute of Chicago",
            "is_boosted": false,
            "web_url": "https:\/\/publications.artic.edu\/renoir\/reader\/paintingsanddrawings",
            "site": "renoir",
            "alias": "paintingsanddrawings",
            ...
        },
        {
            "id": 141096,
            "title": "Gauguin Paintings, Sculpture, and Graphic Works at the Art Institute of Chicago",
            "is_boosted": false,
            "web_url": "https:\/\/publications.artic.edu\/gauguin\/reader\/gauguinart",
            "site": "gauguin",
            "alias": "gauguinart",
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
    ],
    "aggregations": {
        "count_api_model": [
            {
                "key": "publications",
                "doc_count": 35
            }
        ]
    }
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
            "id": 580495,
            "title": "Director's Statement",
            "is_boosted": false,
            "web_url": "https:\/\/publications.artic.edu\/pissarro\/reader\/paintingsandpaper\/section\/1069",
            "accession": null,
            "revision": 1502911013,
            ...
        },
        {
            "id": 522745,
            "title": "Copyright",
            "is_boosted": false,
            "web_url": "https:\/\/publications.artic.edu\/pissarro\/reader\/paintingsandpaper\/section\/1014",
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
        "total": 519,
        "limit": 10,
        "offset": 0,
        "total_pages": 52,
        "current_page": 1
    },
    "data": [
        {
            "_score": 2,
            "api_id": "474344",
            "api_model": "sections",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/sections\/474344",
            "id": 474344,
            "title": "Cat. 6 Portrait Head of Emperor Hadrian",
            "timestamp": "2018-02-02T21:18:16-06:00"
        },
        {
            "_score": 2,
            "api_id": "470454",
            "api_model": "sections",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/sections\/470454",
            "id": 470454,
            "title": "Cat. 2 Cinerary Urn",
            "timestamp": "2018-02-02T21:18:04-06:00"
        },
        {
            "_score": 2,
            "api_id": "481190",
            "api_model": "sections",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/sections\/481190",
            "id": 481190,
            "title": "Cat. 13 Statue of the Aphrodite of Knidos",
            "timestamp": "2018-02-02T21:18:35-06:00"
        }
    ],
    "aggregations": {
        "count_api_model": [
            {
                "key": "sections",
                "doc_count": 519
            }
        ]
    }
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
        "accession": "1892.24",
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
            "id": 90,
            "title": "Steve McQueen",
            "is_boosted": false,
            "description": "Steve McQueen is an internationally acclaimed artist whose work is primarily engaged with moving images. Born in London in 1969, he has, over the last twenty years, made a series of film and video installations designed for gallery-based presentation, along with two feature films made for cinematic release. His efforts in these two distinct, but interrelated, arenas have earned him a reputation as one of the most important and influential artists of his generation working with these media, and beyond. McQueen's earliest works are silent, and mostly black-and-white, often with a focus on the body, very often the artist\u2019s own. Subsequent pieces incorporate, as a general rule, sound and color, and often emerge from more elaborate investigations.",
            "web_url": "http:\/\/archive.artic.edu\/mcqueen\/",
            "exhibition_ids": [
                1613
            ],
            ...
        },
        {
            "id": 91,
            "title": "The New Mobile Experience",
            "is_boosted": false,
            "description": "Find the art that speaks to you with our location-aware map. Take an audio tour and immerse yourself in stories of culture and creativity. The Art Institute offers nearly a million square feet to explore\u2014the New Mobile Experience will be your guide.",
            "web_url": "http:\/\/archive.artic.edu\/new-mobile\/",
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
            "api_id": "19",
            "api_model": "sites",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/sites\/19",
            "id": 19,
            "title": "Perpetual Glory: Medieval Islamic Ceramics from the Harvey B. Plotnick Collection",
            "timestamp": "2018-02-02T21:25:16-06:00"
        },
        {
            "_score": 2,
            "api_id": "22",
            "api_model": "sites",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/sites\/22",
            "id": 22,
            "title": "Seurat and the Making of \"La Grande Jatte\"",
            "timestamp": "2018-02-02T21:25:16-06:00"
        },
        {
            "_score": 2,
            "api_id": "24",
            "api_model": "sites",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/sites\/24",
            "id": 24,
            "title": "The Silk Road and Beyond: Travel, Trade, and Transformation",
            "timestamp": "2018-02-02T21:25:16-06:00"
        }
    ],
    "aggregations": {
        "count_api_model": [
            {
                "key": "sites",
                "doc_count": 121
            }
        ]
    }
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
            "id": 25807,
            "title": "Sullivan, Albert Walter, Residence",
            "alternate_title": null,
            "web_url": "http:\/\/digital-libraries.saic.edu\/cdm\/ref\/collection\/mqc\/id\/25807",
            "collection": "Historic Architecture and Landscape Image Collection, c.1865-1973 (bulk 1890-1930)",
            "archive": "Architecture Lantern Slide Collection",
            ...
        },
        {
            "id": 25552,
            "title": "Streetscape",
            "alternate_title": null,
            "web_url": "http:\/\/digital-libraries.saic.edu\/cdm\/ref\/collection\/mqc\/id\/25552",
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
            "id": 25807,
            "title": "Sullivan, Albert Walter, Residence",
            "alternate_title": null,
            "web_url": "http:\/\/digital-libraries.saic.edu\/cdm\/ref\/collection\/mqc\/id\/25807",
            "collection": "Historic Architecture and Landscape Image Collection, c.1865-1973 (bulk 1890-1930)",
            "archive": "Architecture Lantern Slide Collection",
            ...
        },
        {
            "id": 25552,
            "title": "Streetscape",
            "alternate_title": null,
            "web_url": "http:\/\/digital-libraries.saic.edu\/cdm\/ref\/collection\/mqc\/id\/25552",
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
            "id": "01ARTIC_ALMA2133675920003801",
            "title": "Illustrated catalogue",
            "date": 1890,
            "creators": [],
            "subjects": [
                {
                    "id": "sh85022351",
                    "uri": "http:\/\/id.loc.gov\/authorities\/subjects\/sh85022351",
                    "title": "Chairs -- Catalogs"
                },
                {
                    "id": "sh85020909",
                    "uri": "http:\/\/id.loc.gov\/authorities\/subjects\/sh85020909",
                    "title": "Commercial catalogs"
                }
            ],
            ...
        },
        {
            "id": "01ARTIC_ALMA2133625370003801",
            "title": "The painter : an illustrated monthly magazine devoted to painting and decoration.",
            "date": 1882,
            "creators": [],
            "subjects": [
                {
                    "id": "sh2010104712",
                    "uri": "http:\/\/id.loc.gov\/authorities\/subjects\/sh2010104712",
                    "title": "Paint -- Periodicals"
                },
                {
                    "id": "sh2008102124",
                    "uri": "http:\/\/id.loc.gov\/authorities\/subjects\/sh2008102124",
                    "title": "Decoration and ornament -- Periodicals"
                },
                {
                    "id": "sh85096661",
                    "uri": "http:\/\/id.loc.gov\/authorities\/subjects\/sh85096661",
                    "title": "Painting -- Private collections -- United States"
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
            "id": "01ARTIC_ALMA2133675920003801",
            "title": "Illustrated catalogue",
            "date": 1890,
            "creators": [],
            "subjects": [
                {
                    "id": "sh85022351",
                    "uri": "http:\/\/id.loc.gov\/authorities\/subjects\/sh85022351",
                    "title": "Chairs -- Catalogs"
                },
                {
                    "id": "sh85020909",
                    "uri": "http:\/\/id.loc.gov\/authorities\/subjects\/sh85020909",
                    "title": "Commercial catalogs"
                }
            ],
            ...
        },
        {
            "id": "01ARTIC_ALMA2133625370003801",
            "title": "The painter : an illustrated monthly magazine devoted to painting and decoration.",
            "date": 1882,
            "creators": [],
            "subjects": [
                {
                    "id": "sh2010104712",
                    "uri": "http:\/\/id.loc.gov\/authorities\/subjects\/sh2010104712",
                    "title": "Paint -- Periodicals"
                },
                {
                    "id": "sh2008102124",
                    "uri": "http:\/\/id.loc.gov\/authorities\/subjects\/sh2008102124",
                    "title": "Decoration and ornament -- Periodicals"
                },
                {
                    "id": "sh85096661",
                    "uri": "http:\/\/id.loc.gov\/authorities\/subjects\/sh85096661",
                    "title": "Painting -- Private collections -- United States"
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
            "id": "no2013140656",
            "uri": "http:\/\/id.loc.gov\/authorities\/names\/no2013140656",
            "title": "Le Noci, Guido",
            ...
        },
        {
            "id": "n50004573",
            "uri": "http:\/\/id.loc.gov\/authorities\/names\/n50004573",
            "title": "Mulas, Ugo",
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
            "id": "no2013140656",
            "uri": "http:\/\/id.loc.gov\/authorities\/names\/no2013140656",
            "title": "Le Noci, Guido",
            ...
        },
        {
            "id": "n50004573",
            "uri": "http:\/\/id.loc.gov\/authorities\/names\/n50004573",
            "title": "Mulas, Ugo",
            ...
        }
    ]
}
```

> Generated by `php artisan docs:endpoints` on 2018-02-03 22:45:58
