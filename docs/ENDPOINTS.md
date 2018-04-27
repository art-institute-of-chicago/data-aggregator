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
  * `artist_pivots`
  * `place_pivots`
  * `artists`
  * `catalogues`
  * `categories`
  * `dates`
  * `parts`
  * `sets`
  * `terms`
  * `images`
  * `documents`
  * `publications`
  * `tours`
  * `sites`

Example request: http://aggregator-data.artic.edu/api/v1/artworks?limit=2  
Example output:

```
{
    "pagination": {
        "total": 105341,
        "limit": 2,
        "offset": 0,
        "total_pages": 52671,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data.artic.edu\/api\/v1\/artworks?page=2&limit=2"
    },
    "data": [
        {
            "id": 150165,
            "title": "Panel",
            "lake_guid": "3e4bd101-fc64-e0e9-9786-bcbe897c0b2c",
            "is_boosted": false,
            "thumbnail": {
                "url": "https:\/\/lakeimagesweb.artic.edu\/iiif\/2\/0db7b8e8-7549-5132-ea31-79c3837b0199",
                "type": "iiif",
                "lqip": null,
                "width": null,
                "height": null
            },
            "alt_titles": null,
            ...
        },
        {
            "id": 154288,
            "title": "At Warm Springs",
            "lake_guid": "0aa9aa02-cce3-1c02-0ccd-0311e15ff9ac",
            "is_boosted": false,
            "thumbnail": {
                "url": "https:\/\/lakeimagesweb.artic.edu\/iiif\/2\/b578109d-937d-1a78-1ef2-14c58a8852d2",
                "type": "iiif",
                "lqip": null,
                "width": null,
                "height": null
            },
            "alt_titles": null,
            ...
        }
    ]
}
```

### `/artworks/boosted`

A list of boosted artworks sorted by last updated date in descending order. This is a subset of the `artworks/` endpoint that represents approximately 400 of our most well-known artworks as featured in three important catalogs: Paintings at the Art Institute of Chicago: Highlights of the Collection, The Essential Guide, and Master Paintings in the Art Institute of Chicago. This can be used to get a shorter list of artworks that will have most of its metadata filled out for testing purposes.

#### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource
* `include` - A comma-separated list of subresource to embed in the returned resources. Available options are:
  * `artist_pivots`
  * `place_pivots`
  * `artists`
  * `catalogues`
  * `categories`
  * `dates`
  * `parts`
  * `sets`
  * `terms`
  * `images`
  * `documents`
  * `publications`
  * `tours`
  * `sites`

Example request: http://aggregator-data.artic.edu/api/v1/artworks/boosted?limit=2  
Example output:

```
{
    "pagination": {
        "total": 416,
        "limit": 2,
        "offset": 0,
        "total_pages": 208,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data.artic.edu\/api\/v1\/artworks\/boosted?page=2&limit=2"
    },
    "data": [
        {
            "id": 111442,
            "title": "The Child's Bath",
            "lake_guid": "6b3d9dbf-fb69-4371-8ddc-10d914922b53",
            "is_boosted": true,
            "thumbnail": {
                "url": "https:\/\/lakeimagesweb.artic.edu\/iiif\/2\/c418c213-c246-1883-cd09-ca8496c69c9a",
                "type": "iiif",
                "lqip": null,
                "width": null,
                "height": null
            },
            "alt_titles": null,
            ...
        },
        {
            "id": 187528,
            "title": "Reliquary Head",
            "lake_guid": "2ea344d5-e5ad-67b4-ffeb-d26b4d7be0c9",
            "is_boosted": true,
            "thumbnail": {
                "url": "https:\/\/lakeimagesweb.artic.edu\/iiif\/2\/63389c9d-509f-da8a-f751-e7fe56bdc5c1",
                "type": "iiif",
                "lqip": null,
                "width": null,
                "height": null
            },
            "alt_titles": null,
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
* `facets` - A comma-separated list of \"count\" aggregation facets to include in the results.

Example request: http://aggregator-data.artic.edu/api/v1/artworks/search?q=monet  
Example output:

```
{
    "preference": null,
    "pagination": {
        "total": 275,
        "limit": 10,
        "offset": 0,
        "total_pages": 28,
        "current_page": 1
    },
    "data": [
        {
            "_score": 48.293816,
            "api_id": "14598",
            "thumbnail": {
                "width": null,
                "type": "iiif",
                "url": "https:\/\/lakeimagesweb.artic.edu\/iiif\/2\/9ee6ba5d-97ee-8012-2ee5-7b540a048023",
                "lqip": null,
                "height": null
            },
            "api_model": "artworks",
            "is_boosted": true,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/artworks\/14598",
            "id": 14598,
            "title": "The Beach at Sainte-Adresse",
            "timestamp": "2018-04-23T13:05:17-05:00"
        },
        {
            "_score": 47.30404,
            "api_id": "64818",
            "thumbnail": {
                "width": null,
                "type": "iiif",
                "url": "https:\/\/lakeimagesweb.artic.edu\/iiif\/2\/9511bf7d-4f6c-f523-5fb1-ff069c17f16c",
                "lqip": null,
                "height": null
            },
            "api_model": "artworks",
            "is_boosted": true,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/artworks\/64818",
            "id": 64818,
            "title": "Stacks of Wheat (End of Summer)",
            "timestamp": "2018-04-23T15:10:19-05:00"
        },
        {
            "_score": 43.98106,
            "api_id": "16571",
            "thumbnail": {
                "width": null,
                "type": "iiif",
                "url": "https:\/\/lakeimagesweb.artic.edu\/iiif\/2\/f9ae4fc0-5c4e-f15d-f9ca-71453a8de917",
                "lqip": null,
                "height": null
            },
            "api_model": "artworks",
            "is_boosted": true,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/artworks\/16571",
            "id": 16571,
            "title": "Arrival of the Normandy Train, Gare Saint-Lazare",
            "timestamp": "2018-04-23T13:15:17-05:00"
        }
    ]
}
```

### `/artworks/{id}`

A single artwork by the given identifier. {id} is the identifier from our collections managements system.

Example request: http://aggregator-data.artic.edu/api/v1/artworks/111628?limit=2  
Example output:

```
{
    "data": {
        "id": 111628,
        "title": "Nighthawks",
        "lake_guid": "80a016ca-a836-a86b-04bb-cf4c4af574cf",
        "is_boosted": true,
        "thumbnail": {
            "url": "https:\/\/lakeimagesweb.artic.edu\/iiif\/2\/39d43108-e690-2705-67e2-a16dc28b8c7f",
            "type": "iiif",
            "lqip": null,
            "width": null,
            "height": null
        },
        "alt_titles": null,
        ...
    }
}
```

### `/artworks/{id}/artists`

The artists for a given artworks. Served from the API as a type of `agent`, so their output schema is the same.

Example request: http://aggregator-data.artic.edu/api/v1/artworks/111628/artists?limit=2  
Example output:

```
{
    "data": [
        {
            "id": 34996,
            "title": "Edward Hopper",
            "lake_guid": "cba02485-5b76-1e48-bb85-2f9d0f3e3c57",
            "is_boosted": true,
            "thumbnail": null,
            "sort_title": "Hopper, Edward",
            ...
        }
    ]
}
```

### `/artworks/{id}/categories`

The categories for a given artworks.

Example request: http://aggregator-data.artic.edu/api/v1/artworks/111628/categories?limit=2  
Example output:

```
{
    "data": [
        {
            "id": "PC-41",
            "title": "Featured Works",
            "lake_guid": "ae637a2b-e996-a28e-7ca8-adae24ae01fa",
            "is_boosted": false,
            "thumbnail": null,
            "subtype": "department",
            ...
        },
        {
            "id": "PC-87",
            "title": "American Modernism",
            "lake_guid": "3c15e374-7cd0-7a9a-0280-fa3855032a3f",
            "is_boosted": false,
            "thumbnail": null,
            "subtype": "department",
            ...
        },
        {
            "id": "PC-44",
            "title": "Paintings, 1900-1955",
            "lake_guid": "dcafd608-cc4a-bf34-12b7-87e095bc0a5b",
            "is_boosted": false,
            "thumbnail": null,
            "subtype": "department",
            ...
        },
        {
            "id": "PC-83",
            "title": "Featured Works",
            "lake_guid": "854c887d-e8e1-71fb-1393-a3280918efd2",
            "is_boosted": false,
            "thumbnail": null,
            "subtype": "department",
            ...
        },
        {
            "id": "PC-48",
            "title": "American Modernism",
            "lake_guid": "795eda4e-6c99-1e9f-3283-5aaaad27f857",
            "is_boosted": false,
            "thumbnail": null,
            "subtype": "department",
            ...
        },
        {
            "id": "PC-2",
            "title": "American",
            "lake_guid": "609dd2cb-9647-1b18-59be-5b8d74d29b51",
            "is_boosted": false,
            "thumbnail": null,
            "subtype": "department",
            ...
        },
        {
            "id": "PC-109",
            "title": "Art Institute Icons",
            "lake_guid": "74c96fd4-5e7e-4b56-26f3-0a911d8fe63b",
            "is_boosted": false,
            "thumbnail": null,
            "subtype": "theme",
            ...
        },
        {
            "id": "PC-11",
            "title": "Modern",
            "lake_guid": "45cc4323-ddb5-b79e-92ae-59238de12577",
            "is_boosted": false,
            "thumbnail": null,
            "subtype": "department",
            ...
        }
    ]
}
```

### `/artworks/{id}/images`

The images for a given artworks.

Example request: http://aggregator-data.artic.edu/api/v1/artworks/111628/images?limit=2  
Example output:

```
{
    "data": [
        {
            "id": "39d43108-e690-2705-67e2-a16dc28b8c7f",
            "title": "G42375",
            "lake_guid": "39d43108-e690-2705-67e2-a16dc28b8c7f",
            "is_boosted": false,
            "thumbnail": null,
            "type": "image",
            ...
        }
    ]
}
```

### `/artworks/{id}/parts`

The parts for a given artworks.

Example request: http://aggregator-data.artic.edu/api/v1/artworks/111628/parts?limit=2  

### `/artworks/{id}/sets`

The sets for a given artworks.

Example request: http://aggregator-data.artic.edu/api/v1/artworks/111628/sets?limit=2  

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

Example request: http://aggregator-data.artic.edu/api/v1/agents?limit=2  
Example output:

```
{
    "pagination": {
        "total": 12352,
        "limit": 2,
        "offset": 0,
        "total_pages": 6176,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data.artic.edu\/api\/v1\/agents?page=2&limit=2"
    },
    "data": [
        {
            "id": 86099,
            "title": "Dawoud Bey",
            "lake_guid": "d3b4ed7a-6e89-a629-486a-e9b5e413fa82",
            "is_boosted": true,
            "thumbnail": null,
            "sort_title": "Bey, Dawoud",
            ...
        },
        {
            "id": 37541,
            "title": "Ancient Egyptian",
            "lake_guid": "372a9294-e938-d879-844f-8b2758350346",
            "is_boosted": true,
            "thumbnail": null,
            "sort_title": "Ancient Egyptian",
            ...
        }
    ]
}
```

### `/agents/boosted`

A list of boosted agents sorted by last updated date in descending order. This is a subset of the `agents/` endpoint that represents all the artists included in boosted Artwork, in addition to the top 100 viewed artists on our website in 2017.

#### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource
* `include` - A comma-separated list of subresource to embed in the returned resources. Available options are:
  * `places`
  * `sites`

Example request: http://aggregator-data.artic.edu/api/v1/agents/boosted?limit=2  
Example output:

```
{
    "pagination": {
        "total": 330,
        "limit": 2,
        "offset": 0,
        "total_pages": 165,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data.artic.edu\/api\/v1\/agents\/boosted?page=2&limit=2"
    },
    "data": [
        {
            "id": 86099,
            "title": "Dawoud Bey",
            "lake_guid": "d3b4ed7a-6e89-a629-486a-e9b5e413fa82",
            "is_boosted": true,
            "thumbnail": null,
            "sort_title": "Bey, Dawoud",
            ...
        },
        {
            "id": 37541,
            "title": "Ancient Egyptian",
            "lake_guid": "372a9294-e938-d879-844f-8b2758350346",
            "is_boosted": true,
            "thumbnail": null,
            "sort_title": "Ancient Egyptian",
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
* `facets` - A comma-separated list of \"count\" aggregation facets to include in the results.

Example request: http://aggregator-data.artic.edu/api/v1/agents/search  
Example output:

```
{
    "preference": null,
    "pagination": {
        "total": 12350,
        "limit": 10,
        "offset": 0,
        "total_pages": 1235,
        "current_page": 1
    },
    "data": [
        {
            "_score": 6.623475,
            "api_id": "57829",
            "thumbnail": null,
            "api_model": "agents",
            "is_boosted": true,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/agents\/57829",
            "id": 57829,
            "title": "Nilima Sheikh",
            "timestamp": "2018-04-17T20:32:36-05:00"
        },
        {
            "_score": 6.623475,
            "api_id": "57216",
            "thumbnail": null,
            "api_model": "agents",
            "is_boosted": true,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/agents\/57216",
            "id": 57216,
            "title": "Sait\u014d Yoshishige",
            "timestamp": "2018-04-17T20:33:03-05:00"
        },
        {
            "_score": 6.623475,
            "api_id": "91529",
            "thumbnail": null,
            "api_model": "agents",
            "is_boosted": true,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/agents\/91529",
            "id": 91529,
            "title": "Yamakawa Sh\u00fbh\u00f4",
            "timestamp": "2018-04-17T18:16:57-05:00"
        }
    ]
}
```

### `/agents/{id}`

A single agent by the given identifier. {id} is the identifier from our collections managements system.

Example request: http://aggregator-data.artic.edu/api/v1/agents?limit=2  
Example output:

```
{
    "pagination": {
        "total": 12352,
        "limit": 2,
        "offset": 0,
        "total_pages": 6176,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data.artic.edu\/api\/v1\/agents?page=2&limit=2"
    },
    "data": [
        {
            "id": 86099,
            "title": "Dawoud Bey",
            "lake_guid": "d3b4ed7a-6e89-a629-486a-e9b5e413fa82",
            "is_boosted": true,
            "thumbnail": null,
            "sort_title": "Bey, Dawoud",
            ...
        },
        {
            "id": 37541,
            "title": "Ancient Egyptian",
            "lake_guid": "372a9294-e938-d879-844f-8b2758350346",
            "is_boosted": true,
            "thumbnail": null,
            "sort_title": "Ancient Egyptian",
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

Example request: http://aggregator-data.artic.edu/api/v1/artwork-types?limit=2  
Example output:

```
{
    "pagination": {
        "total": 41,
        "limit": 2,
        "offset": 0,
        "total_pages": 21,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data.artic.edu\/api\/v1\/artwork-types?page=2&limit=2"
    },
    "data": [
        {
            "id": 1,
            "title": "Painting",
            "lake_guid": "cfae4567-198f-973a-07b8-2e4b0defc28e",
            "is_boosted": false,
            "thumbnail": null,
            "last_updated_source": "2018-01-12T13:58:00-06:00",
            ...
        },
        {
            "id": 2,
            "title": "Photograph",
            "lake_guid": "f3daccbc-a5c3-41c9-859b-aac047d78a1c",
            "is_boosted": false,
            "thumbnail": null,
            "last_updated_source": "2018-01-12T13:58:03-06:00",
            ...
        }
    ]
}
```

### `/artwork-types/{id}`

A single artwork-type by the given identifier. {id} is the identifier from our collections managements system.

Example request: http://aggregator-data.artic.edu/api/v1/artwork-types/3?limit=2  
Example output:

```
{
    "data": {
        "id": 3,
        "title": "Sculpture",
        "lake_guid": "e2ed3e7c-d93f-7576-9a38-149daf99fba3",
        "is_boosted": false,
        "thumbnail": null,
        "last_updated_source": "2018-01-12T13:58:01-06:00",
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

Example request: http://aggregator-data.artic.edu/api/v1/categories?limit=2  
Example output:

```
{
    "pagination": {
        "total": 130,
        "limit": 2,
        "offset": 0,
        "total_pages": 65,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data.artic.edu\/api\/v1\/categories?page=2&limit=2"
    },
    "data": [
        {
            "id": "PC-8",
            "title": "Contemporary",
            "lake_guid": "54d6c04b-3762-6241-0d92-30a27f4a2fac",
            "is_boosted": false,
            "thumbnail": null,
            "subtype": "department",
            ...
        },
        {
            "id": "PC-15",
            "title": "Thorne Miniature Rooms",
            "lake_guid": "0aa6a1c8-8369-7956-d0bc-22e1fc914f17",
            "is_boosted": false,
            "thumbnail": null,
            "subtype": "department",
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
* `facets` - A comma-separated list of \"count\" aggregation facets to include in the results.

Example request: http://aggregator-data.artic.edu/api/v1/categories/search  
Example output:

```
{
    "preference": null,
    "pagination": {
        "total": 130,
        "limit": 10,
        "offset": 0,
        "total_pages": 13,
        "current_page": 1
    },
    "data": [
        {
            "_score": 2.0003564,
            "api_id": "PC-23",
            "thumbnail": null,
            "api_model": "category-terms",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/categories\/PC-23",
            "id": "PC-23",
            "title": "Featured Works",
            "timestamp": "2018-04-27T16:57:00-05:00"
        },
        {
            "_score": 2.0003564,
            "api_id": "PC-68",
            "thumbnail": null,
            "api_model": "category-terms",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/categories\/PC-68",
            "id": "PC-68",
            "title": "Installations",
            "timestamp": "2018-04-27T16:57:00-05:00"
        },
        {
            "_score": 2.0003564,
            "api_id": "PC-3",
            "thumbnail": null,
            "api_model": "category-terms",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/categories\/PC-3",
            "id": "PC-3",
            "title": "Art of the Americas",
            "timestamp": "2018-04-27T16:57:00-05:00"
        }
    ]
}
```

### `/categories/{id}`

A single category by the given identifier. {id} is the identifier from our collections managements system.

Example request: http://aggregator-data.artic.edu/api/v1/categories/PC-3?limit=2  
Example output:

```
{
    "data": {
        "id": "PC-3",
        "title": "Art of the Americas",
        "lake_guid": "a3598772-5c42-3069-994c-68c88ce9aacd",
        "is_boosted": false,
        "thumbnail": null,
        "subtype": "department",
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

Example request: http://aggregator-data.artic.edu/api/v1/agent-types?limit=2  
Example output:

```
{
    "pagination": {
        "total": 26,
        "limit": 2,
        "offset": 0,
        "total_pages": 13,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data.artic.edu\/api\/v1\/agent-types?page=2&limit=2"
    },
    "data": [
        {
            "id": 1,
            "title": "Corporate Body",
            "lake_guid": "4fc9cef2-32d7-60a0-8ddd-335fd7800f29",
            "is_boosted": false,
            "thumbnail": null,
            "last_updated_source": "2018-02-09T10:43:56-06:00",
            ...
        },
        {
            "id": 2,
            "title": "Culture",
            "lake_guid": "7b02ffea-6a50-4090-0898-f2ab89215d26",
            "is_boosted": false,
            "thumbnail": null,
            "last_updated_source": "2018-02-09T10:43:57-06:00",
            ...
        }
    ]
}
```

### `/agent-types/{id}`

A single agent-type by the given identifier. {id} is the identifier from our collections managements system.

Example request: http://aggregator-data.artic.edu/api/v1/agent-types/1?limit=2  
Example output:

```
{
    "data": {
        "id": 1,
        "title": "Corporate Body",
        "lake_guid": "4fc9cef2-32d7-60a0-8ddd-335fd7800f29",
        "is_boosted": false,
        "thumbnail": null,
        "last_updated_source": "2018-02-09T10:43:56-06:00",
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

Example request: http://aggregator-data.artic.edu/api/v1/places?limit=2  
Example output:

```
{
    "pagination": {
        "total": 12857,
        "limit": 2,
        "offset": 0,
        "total_pages": 6429,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data.artic.edu\/api\/v1\/places?page=2&limit=2"
    },
    "data": [
        {
            "id": -2147476116,
            "title": "Norwich",
            "lake_guid": "06a453f3-6d5a-b0b0-4c91-26d6404c2039",
            "is_boosted": false,
            "thumbnail": null,
            "type": "No location",
            ...
        },
        {
            "id": -2147482767,
            "title": "Basel",
            "lake_guid": "a886bcc8-8bbe-3f91-b4f4-908aef865bbd",
            "is_boosted": false,
            "thumbnail": null,
            "type": "No location",
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
* `facets` - A comma-separated list of \"count\" aggregation facets to include in the results.

Example request: http://aggregator-data.artic.edu/api/v1/places/search  
Example output:

```
{
    "preference": null,
    "pagination": {
        "total": 12854,
        "limit": 10,
        "offset": 0,
        "total_pages": 1286,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_id": "-2147475393",
            "thumbnail": null,
            "api_model": "places",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/places\/-2147475393",
            "id": -2147475393,
            "title": "Newport News",
            "timestamp": "2018-04-17T18:17:53-05:00"
        },
        {
            "_score": 1,
            "api_id": "-2147476241",
            "thumbnail": null,
            "api_model": "places",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/places\/-2147476241",
            "id": -2147476241,
            "title": "New Hampshire",
            "timestamp": "2018-04-17T18:17:53-05:00"
        },
        {
            "_score": 1,
            "api_id": "-2147479947",
            "thumbnail": null,
            "api_model": "places",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/places\/-2147479947",
            "id": -2147479947,
            "title": "Santa Barbara",
            "timestamp": "2018-04-17T18:17:53-05:00"
        }
    ]
}
```

### `/places/{id}`

A single place by the given identifier. {id} is the identifier from our collections managements system.

Example request: http://aggregator-data.artic.edu/api/v1/places/27406?limit=2  
Example output:

```
{
    "data": {
        "id": 27406,
        "title": "box c34325 Parada, Esther",
        "lake_guid": "25edc61c-01f7-f2e6-a80e-d82fae8ae36e",
        "is_boosted": false,
        "thumbnail": null,
        "type": "AIC Storage",
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

Example request: http://aggregator-data.artic.edu/api/v1/galleries?limit=2  
Example output:

```
{
    "pagination": {
        "total": 257,
        "limit": 2,
        "offset": 0,
        "total_pages": 129,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data.artic.edu\/api\/v1\/galleries?page=2&limit=2"
    },
    "data": [
        {
            "id": 23996,
            "title": "Gallery 398A",
            "lake_guid": "96964608-c2bc-46ee-09c4-0eb4115131e9",
            "is_boosted": false,
            "thumbnail": null,
            "type": "AIC Gallery",
            ...
        },
        {
            "id": 2147478064,
            "title": "Gallery 262",
            "lake_guid": "e6a887ee-be6a-aa97-c084-ffda92428278",
            "is_boosted": false,
            "thumbnail": null,
            "type": "AIC Gallery",
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
* `facets` - A comma-separated list of \"count\" aggregation facets to include in the results.

Example request: http://aggregator-data.artic.edu/api/v1/galleries/search  
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
            "_score": 1,
            "api_id": "25467",
            "thumbnail": null,
            "api_model": "galleries",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/galleries\/25467",
            "id": 25467,
            "title": "Gallery 289",
            "timestamp": "2018-04-17T18:20:02-05:00"
        },
        {
            "_score": 1,
            "api_id": "23972",
            "thumbnail": null,
            "api_model": "galleries",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/galleries\/23972",
            "id": 23972,
            "title": "Gallery 297B",
            "timestamp": "2018-04-17T18:20:02-05:00"
        },
        {
            "_score": 1,
            "api_id": "23998",
            "thumbnail": null,
            "api_model": "galleries",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/galleries\/23998",
            "id": 23998,
            "title": "Gallery 183",
            "timestamp": "2018-04-17T18:20:02-05:00"
        }
    ]
}
```

### `/galleries/{id}`

A single gallery by the given identifier. {id} is the identifier from our collections managements system.

Example request: http://aggregator-data.artic.edu/api/v1/galleries/26772?limit=2  
Example output:

```
{
    "data": {
        "id": 26772,
        "title": "Gallery 150",
        "lake_guid": "7bf43464-008d-02cc-ef4d-276705c7df3a",
        "is_boosted": false,
        "thumbnail": null,
        "type": "AIC Gallery",
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

Example request: http://aggregator-data.artic.edu/api/v1/exhibitions?limit=2  
Example output:

```
{
    "pagination": {
        "total": 6207,
        "limit": 2,
        "offset": 0,
        "total_pages": 3104,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data.artic.edu\/api\/v1\/exhibitions?page=2&limit=2"
    },
    "data": [
        {
            "id": 2722,
            "title": "Hairy Who? 1966\u20131969",
            "lake_guid": "82631682-2e77-8213-7339-ec1124c9ff4f",
            "is_boosted": false,
            "thumbnail": null,
            "description": null,
            ...
        },
        {
            "id": 2822,
            "title": "Manet and Modern Beauty",
            "lake_guid": "18eb6fca-c351-d5e0-7a45-551c265b8516",
            "is_boosted": false,
            "thumbnail": null,
            "description": null,
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
* `facets` - A comma-separated list of \"count\" aggregation facets to include in the results.

Example request: http://aggregator-data.artic.edu/api/v1/exhibitions/search  
Example output:

```
{
    "preference": null,
    "pagination": {
        "total": 6234,
        "limit": 10,
        "offset": 0,
        "total_pages": 624,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_id": "8832",
            "thumbnail": null,
            "api_model": "exhibitions",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/exhibitions\/8832",
            "id": 8832,
            "title": "American Exhibition of Water Colors and Drawings 59th Annual",
            "timestamp": "2018-04-17T20:24:13-05:00"
        },
        {
            "_score": 1,
            "api_id": "7534",
            "thumbnail": null,
            "api_model": "exhibitions",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/exhibitions\/7534",
            "id": 7534,
            "title": "SAIC: Fellowship Part I",
            "timestamp": "2018-04-17T20:24:16-05:00"
        },
        {
            "_score": 1,
            "api_id": "7493",
            "thumbnail": null,
            "api_model": "exhibitions",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/exhibitions\/7493",
            "id": 7493,
            "title": "A Selection from a Bequest of American Hooked Rugs (1987)",
            "timestamp": "2018-04-17T20:24:16-05:00"
        }
    ]
}
```

### `/exhibitions/{id}`

A single exhibition by the given identifier. {id} is the identifier from our collections managements system.

Example request: http://aggregator-data.artic.edu/api/v1/exhibitions/1302?limit=2  
Example output:

```
{
    "data": {
        "id": 1302,
        "title": "Impressionism, Fashion, and Modernity",
        "lake_guid": "3254ccb1-0786-3b5d-004f-19a0f324106a",
        "is_boosted": false,
        "thumbnail": null,
        "description": "Were the Impressionists fashionistas? And what role did fashion play in their goal to paint modern life with a \u201cmodern\u201d style? This is the subject of the internationally acclaimed exhibition Impressionism, Fashion, and Modernity, the first to uncover the fascinating relationship between art and fashion from the mid-1860s through the mid-1880s as Paris became the style capital of the world. Featuring 75 major figure paintings by Caillebotte, Degas, Manet, Monet, Renoir, and Seurat, including many never before seen in North America, this stylish show presents a new perspective on the Impressionists\u2014revealing how these early avant-garde artists embraced fashion trends as they sought to capture modern life on canvas.\n\nIn the second half of the 19th century, the modern fashion industry was born: designers like Charles Frederick Worth were transforming how clothing was made and marketed, department stores were on the rise, and fashion magazines were beginning to proliferate. Visual artists and writers alike were intrigued by this new industry; its dynamic, ephemeral, and constantly innovative qualities embodied the very essence of modernity that they sought to express in their work and offered a means of discovering new visual and verbal expressions.\n\nThis groundbreaking exhibition explores the vital relationship between fashion and art during these pivotal years not only through the masterworks by Impressionists but also with paintings by fashion portraitists Jean B\u00e9raud, Carolus-Duran, Alfred Stevens, and James Tissot. Period costumes such as men\u2019s suits, robes de promenade, day dresses, and ball gowns, along with fashion plates, photographs, and popular prints offer a firsthand look at the apparel these artists used to convey their modernity as well as that of their subjects. Further enriching the display are fabrics and accessories\u2014lace, silks, velvets, and satins found in hats, parasols, gloves, and shoes\u2014recreating the sensory experience that made fashion an industry favorite and a serious subject among painters, writers, poets, and the popular press.\n\nTruly bringing the exhibition to life are the vivid connections between the most up-to-the-minute fashions and the painted transformations of the same styles. Pairing life-size figure paintings by Monet, Renoir, or Tissot with the contemporary outfits that inspired them, the show invites inquiry into the difference between portrait and genre painting, between Tissot\u2019s painted fashion plates and Manet\u2019s images of life experienced, demonstrating for the first time the means by which the Impressionists \u201cfashioned\u201d their models\u2014and paintings\u2014for larger artistic goals.",
        ...
    }
}
```

### `/exhibitions/{id}/artworks`

The artworks for a given exhibitions.

Example request: http://aggregator-data.artic.edu/api/v1/exhibitions/1302/artworks?limit=2  
Example output:

```
{
    "data": []
}
```

### `/exhibitions/{id}/venues`

The venues for a given exhibitions.

Example request: http://aggregator-data.artic.edu/api/v1/exhibitions/1302/venues?limit=2  
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

Example request: http://aggregator-data.artic.edu/api/v1/images?limit=2  
Example output:

```
{
    "pagination": {
        "total": 111044,
        "limit": 2,
        "offset": 0,
        "total_pages": 55522,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data.artic.edu\/api\/v1\/images?page=2&limit=2"
    },
    "data": [
        {
            "id": "e2193e3c-80dd-386e-0ae3-a0d11883d367",
            "title": "01. <em>Fifty-third Annual Exhibition of American Paintings and Sculpture<\/em>, Plate VII",
            "lake_guid": "e2193e3c-80dd-386e-0ae3-a0d11883d367",
            "is_boosted": false,
            "thumbnail": null,
            "type": "image",
            ...
        },
        {
            "id": "0db7b8e8-7549-5132-ea31-79c3837b0199",
            "title": "123321",
            "lake_guid": "0db7b8e8-7549-5132-ea31-79c3837b0199",
            "is_boosted": false,
            "thumbnail": null,
            "type": "image",
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
* `facets` - A comma-separated list of \"count\" aggregation facets to include in the results.

Example request: http://aggregator-data.artic.edu/api/v1/images/search  
Example output:

```
{
    "preference": null,
    "pagination": {
        "total": 111044,
        "limit": 10,
        "offset": 0,
        "total_pages": 11105,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_id": "1033674e-0c77-5a25-4735-cf6b58c72e1c",
            "thumbnail": null,
            "api_model": "images",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/images\/1033674e-0c77-5a25-4735-cf6b58c72e1c",
            "id": "1033674e-0c77-5a25-4735-cf6b58c72e1c",
            "title": "IM030759",
            "timestamp": "2018-04-17T19:59:18-05:00"
        },
        {
            "_score": 1,
            "api_id": "2a397ecd-b22e-91d5-1476-7afd2f3adb54",
            "thumbnail": null,
            "api_model": "images",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/images\/2a397ecd-b22e-91d5-1476-7afd2f3adb54",
            "id": "2a397ecd-b22e-91d5-1476-7afd2f3adb54",
            "title": "IM030804",
            "timestamp": "2018-04-17T19:59:18-05:00"
        },
        {
            "_score": 1,
            "api_id": "078761df-2d3b-184b-e396-e005e9ef58bd",
            "thumbnail": null,
            "api_model": "images",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/images\/078761df-2d3b-184b-e396-e005e9ef58bd",
            "id": "078761df-2d3b-184b-e396-e005e9ef58bd",
            "title": "PD_042017_07",
            "timestamp": "2018-04-17T19:59:18-05:00"
        }
    ]
}
```

### `/images/{id}`

A single image by the given identifier. {id} is the identifier from our collections managements system.

Example request: http://aggregator-data.artic.edu/api/v1/images/c972e5d7-0667-6904-d919-bbeefeae0a10?limit=2  
Example output:

```
{
    "data": {
        "id": "c972e5d7-0667-6904-d919-bbeefeae0a10",
        "title": "IM011631",
        "lake_guid": "c972e5d7-0667-6904-d919-bbeefeae0a10",
        "is_boosted": false,
        "thumbnail": null,
        "type": "image",
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

Example request: http://aggregator-data.artic.edu/api/v1/videos?limit=2  
Example output:

```
{
    "pagination": {
        "total": 312,
        "limit": 2,
        "offset": 0,
        "total_pages": 156,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data.artic.edu\/api\/v1\/videos?page=2&limit=2"
    },
    "data": [
        {
            "id": "563074e8-c724-862b-26df-2d69bc2f3af0",
            "title": "Audio Lecture: \"What is Modern Photography\"",
            "lake_guid": "563074e8-c724-862b-26df-2d69bc2f3af0",
            "is_boosted": false,
            "thumbnail": null,
            "type": "video",
            ...
        },
        {
            "id": "0c6eb0fe-a071-68e7-fcbf-2c4fb4bd846f",
            "title": "Diagram: <em>Oba's Altar Tusk<\/em>",
            "lake_guid": "0c6eb0fe-a071-68e7-fcbf-2c4fb4bd846f",
            "is_boosted": false,
            "thumbnail": null,
            "type": "video",
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
* `facets` - A comma-separated list of \"count\" aggregation facets to include in the results.

Example request: http://aggregator-data.artic.edu/api/v1/videos/search  
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
            "_score": 1,
            "api_id": "f05900b7-c7e6-2484-314a-e7165a13eb93",
            "thumbnail": null,
            "api_model": "videos",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/videos\/f05900b7-c7e6-2484-314a-e7165a13eb93",
            "id": "f05900b7-c7e6-2484-314a-e7165a13eb93",
            "title": "Video: Caillebotte and the Streets of Paris",
            "timestamp": "2018-04-17T19:58:11-05:00"
        },
        {
            "_score": 1,
            "api_id": "f9a367ce-38ec-e366-2c80-f33f2ed41da1",
            "thumbnail": null,
            "api_model": "videos",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/videos\/f9a367ce-38ec-e366-2c80-f33f2ed41da1",
            "id": "f9a367ce-38ec-e366-2c80-f33f2ed41da1",
            "title": "Video Postcard: <em>Paris Street; Rainy Day<\/em> (1877)",
            "timestamp": "2018-04-17T19:58:11-05:00"
        },
        {
            "_score": 1,
            "api_id": "a618fd16-d028-5264-6f4b-7da5158fc9cb",
            "thumbnail": null,
            "api_model": "videos",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/videos\/a618fd16-d028-5264-6f4b-7da5158fc9cb",
            "id": "a618fd16-d028-5264-6f4b-7da5158fc9cb",
            "title": "Video: Case Studies in Modern and Contemporary Sculpture: David Smith and Anthony Caro",
            "timestamp": "2018-04-17T19:58:11-05:00"
        }
    ]
}
```

### `/videos/{id}`

A single video by the given identifier. {id} is the identifier from our collections managements system.

Example request: http://aggregator-data.artic.edu/api/v1/videos/8199a3c6-99fa-582d-449a-bc9221db54da?limit=2  
Example output:

```
{
    "data": {
        "id": "8199a3c6-99fa-582d-449a-bc9221db54da",
        "title": "Video: Cassatt and the Modern Woman",
        "lake_guid": "8199a3c6-99fa-582d-449a-bc9221db54da",
        "is_boosted": false,
        "thumbnail": null,
        "type": "video",
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

Example request: http://aggregator-data.artic.edu/api/v1/sounds?limit=2  
Example output:

```
{
    "pagination": {
        "total": 1020,
        "limit": 2,
        "offset": 0,
        "total_pages": 510,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data.artic.edu\/api\/v1\/sounds?page=2&limit=2"
    },
    "data": [
        {
            "id": "45f59e53-9d9f-9d67-c168-758cc8db6633",
            "title": "Podcast: Edward Hopper",
            "lake_guid": "45f59e53-9d9f-9d67-c168-758cc8db6633",
            "is_boosted": false,
            "thumbnail": null,
            "type": "sound",
            ...
        },
        {
            "id": "80822072-0357-2803-7e3a-7a8a4c1a3f62",
            "title": "351.mp3",
            "lake_guid": "80822072-0357-2803-7e3a-7a8a4c1a3f62",
            "is_boosted": false,
            "thumbnail": null,
            "type": "sound",
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
* `facets` - A comma-separated list of \"count\" aggregation facets to include in the results.

Example request: http://aggregator-data.artic.edu/api/v1/sounds/search  
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
            "_score": 1,
            "api_id": "b2199537-5b90-815f-9b61-2485b40421ae",
            "thumbnail": null,
            "api_model": "sounds",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/sounds\/b2199537-5b90-815f-9b61-2485b40421ae",
            "id": "b2199537-5b90-815f-9b61-2485b40421ae",
            "title": "616.mp3",
            "timestamp": "2018-04-17T19:58:55-05:00"
        },
        {
            "_score": 1,
            "api_id": "fbc8977b-6c3d-920a-04ea-f495bd8edccc",
            "thumbnail": null,
            "api_model": "sounds",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/sounds\/fbc8977b-6c3d-920a-04ea-f495bd8edccc",
            "id": "fbc8977b-6c3d-920a-04ea-f495bd8edccc",
            "title": "790.mp3",
            "timestamp": "2018-04-17T19:58:56-05:00"
        },
        {
            "_score": 1,
            "api_id": "84af5827-7c8d-ed8a-ac5d-d6b031c134e9",
            "thumbnail": null,
            "api_model": "sounds",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/sounds\/84af5827-7c8d-ed8a-ac5d-d6b031c134e9",
            "id": "84af5827-7c8d-ed8a-ac5d-d6b031c134e9",
            "title": "979.mp3",
            "timestamp": "2018-04-17T19:58:56-05:00"
        }
    ]
}
```

### `/sounds/{id}`

A single sound by the given identifier. {id} is the identifier from our collections managements system.

Example request: http://aggregator-data.artic.edu/api/v1/sounds/0dc99580-0a4c-c047-31e9-f42d29ac020e?limit=2  
Example output:

```
{
    "data": {
        "id": "0dc99580-0a4c-c047-31e9-f42d29ac020e",
        "title": "Audio Lecture: Sally Mann at the Art Institute of Chicago",
        "lake_guid": "0dc99580-0a4c-c047-31e9-f42d29ac020e",
        "is_boosted": false,
        "thumbnail": null,
        "type": "sound",
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

Example request: http://aggregator-data.artic.edu/api/v1/texts?limit=2  
Example output:

```
{
    "pagination": {
        "total": 2698,
        "limit": 2,
        "offset": 0,
        "total_pages": 1349,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data.artic.edu\/api\/v1\/texts?page=2&limit=2"
    },
    "data": [
        {
            "id": "068e6baf-6d88-0bde-b46e-794f4c7a481b",
            "title": "Teacher Manual: American Art and Culture",
            "lake_guid": "068e6baf-6d88-0bde-b46e-794f4c7a481b",
            "is_boosted": false,
            "thumbnail": null,
            "type": "text",
            ...
        },
        {
            "id": "0d3b845e-baf6-46b1-ad63-db48763ae850",
            "title": "Classroom or Home Activity: Sights and Sounds of the City",
            "lake_guid": "0d3b845e-baf6-46b1-ad63-db48763ae850",
            "is_boosted": false,
            "thumbnail": null,
            "type": "text",
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
* `facets` - A comma-separated list of \"count\" aggregation facets to include in the results.

Example request: http://aggregator-data.artic.edu/api/v1/texts/search  
Example output:

```
{
    "preference": null,
    "pagination": {
        "total": 2698,
        "limit": 10,
        "offset": 0,
        "total_pages": 270,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_id": "5feab1d2-baf9-f0f9-f2b9-abe01cb98162",
            "thumbnail": null,
            "api_model": "texts",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/texts\/5feab1d2-baf9-f0f9-f2b9-abe01cb98162",
            "id": "5feab1d2-baf9-f0f9-f2b9-abe01cb98162",
            "title": "Turning the Pages: Nathalia Goncharova (Russian, 1881-1962), <em>Anchorites; Anchoress: Two Poems<\/em> (<em>Pustynniki; Pustynnitsa: Dve poemy<\/em>), 1913",
            "timestamp": "2018-04-17T19:58:45-05:00"
        },
        {
            "_score": 1,
            "api_id": "dd301cc5-d966-9755-d6fa-a60535d0e8e8",
            "thumbnail": null,
            "api_model": "texts",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/texts\/dd301cc5-d966-9755-d6fa-a60535d0e8e8",
            "id": "dd301cc5-d966-9755-d6fa-a60535d0e8e8",
            "title": "Turning the Pages: Henri de Toulouse Lautrec (French, 1864-1901), <em>Sketchbook<\/em>, 1880",
            "timestamp": "2018-04-17T19:58:45-05:00"
        },
        {
            "_score": 1,
            "api_id": "c552712c-7c68-6585-5952-8d4df7d3ed42",
            "thumbnail": null,
            "api_model": "texts",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/texts\/c552712c-7c68-6585-5952-8d4df7d3ed42",
            "id": "c552712c-7c68-6585-5952-8d4df7d3ed42",
            "title": "Turning the Pages: Unbound copy of Pablo Picasso (Spanish, 1881-1973), <em>Le Chef d'oeuvre inconnu<\/em> (<em>The Unknown Masterpiece<\/em>), 1931",
            "timestamp": "2018-04-17T19:58:45-05:00"
        }
    ]
}
```

### `/texts/{id}`

A single text by the given identifier. {id} is the identifier from our collections managements system.

Example request: http://aggregator-data.artic.edu/api/v1/texts/28f4641e-c040-7669-6036-f6fce1e25514?limit=2  
Example output:

```
{
    "data": {
        "id": "28f4641e-c040-7669-6036-f6fce1e25514",
        "title": "Examination: Rodin's <em>Adam<\/em>",
        "lake_guid": "28f4641e-c040-7669-6036-f6fce1e25514",
        "is_boosted": false,
        "thumbnail": null,
        "type": "text",
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

Example request: http://aggregator-data.artic.edu/api/v1/shop-categories?limit=2  
Example output:

```
{
    "pagination": {
        "total": 86,
        "limit": 2,
        "offset": 0,
        "total_pages": 43,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data.artic.edu\/api\/v1\/shop-categories?page=2&limit=2"
    },
    "data": [
        {
            "id": 3,
            "title": "Scarves",
            "is_boosted": false,
            "thumbnail": null,
            "web_url": "http:\/\/www.artinstituteshop.org\/browse.aspx?catID=3",
            "parent_id": 3,
            ...
        },
        {
            "id": 4,
            "title": "Sweatshirts\/T-Shirts",
            "is_boosted": false,
            "thumbnail": null,
            "web_url": "http:\/\/www.artinstituteshop.org\/browse.aspx?catID=4",
            "parent_id": 3,
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
* `facets` - A comma-separated list of \"count\" aggregation facets to include in the results.

Example request: http://aggregator-data.artic.edu/api/v1/shop-categories/search  
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
            "_score": 1,
            "api_id": "14",
            "thumbnail": null,
            "api_model": "shop-categories",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/shop-categories\/14",
            "id": 14,
            "title": "Fountains",
            "timestamp": "2018-04-17T20:39:31-05:00"
        },
        {
            "_score": 1,
            "api_id": "19",
            "thumbnail": null,
            "api_model": "shop-categories",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/shop-categories\/19",
            "id": 19,
            "title": "Tabletop",
            "timestamp": "2018-04-17T20:39:31-05:00"
        },
        {
            "_score": 1,
            "api_id": "22",
            "thumbnail": null,
            "api_model": "shop-categories",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/shop-categories\/22",
            "id": 22,
            "title": "Holiday Ornaments",
            "timestamp": "2018-04-17T20:39:32-05:00"
        }
    ]
}
```

### `/shop-categories/{id}`

A single shop-category by the given identifier.

Example request: http://aggregator-data.artic.edu/api/v1/shop-categories/2?limit=2  
Example output:

```
{
    "data": {
        "id": 2,
        "title": "Accessories",
        "is_boosted": false,
        "thumbnail": null,
        "web_url": "http:\/\/www.artinstituteshop.org\/browse.aspx?catID=2",
        "parent_id": 3,
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

Example request: http://aggregator-data.artic.edu/api/v1/products?limit=2  
Example output:

```
{
    "pagination": {
        "total": 5917,
        "limit": 2,
        "offset": 0,
        "total_pages": 2959,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data.artic.edu\/api\/v1\/products?page=2&limit=2"
    },
    "data": [
        {
            "id": 7170,
            "title": "Embroidered Accessory Set",
            "is_boosted": false,
            "thumbnail": null,
            "title_sort": null,
            "parent_id": null,
            ...
        },
        {
            "id": 7448,
            "title": "Sunflower Platter - Blue\/Clear",
            "is_boosted": false,
            "thumbnail": null,
            "title_sort": null,
            "parent_id": null,
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
* `facets` - A comma-separated list of \"count\" aggregation facets to include in the results.

Example request: http://aggregator-data.artic.edu/api/v1/products/search  
Example output:

```
{
    "preference": null,
    "pagination": {
        "total": 5917,
        "limit": 10,
        "offset": 0,
        "total_pages": 592,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_id": "3594",
            "thumbnail": null,
            "api_model": "products",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/products\/3594",
            "id": 3594,
            "title": "Metal Mesh & Suede Bracelet",
            "timestamp": "2018-04-17T20:37:47-05:00"
        },
        {
            "_score": 1,
            "api_id": "2882",
            "thumbnail": null,
            "api_model": "products",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/products\/2882",
            "id": 2882,
            "title": "Copper Floral Scarf",
            "timestamp": "2018-04-17T20:37:47-05:00"
        },
        {
            "_score": 1,
            "api_id": "3652",
            "thumbnail": null,
            "api_model": "products",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/products\/3652",
            "id": 3652,
            "title": "Chinese Bridges: Living Architecture from China's Past",
            "timestamp": "2018-04-17T20:37:47-05:00"
        }
    ]
}
```

### `/products/{id}`

A single product by the given identifier.

Example request: http://aggregator-data.artic.edu/api/v1/products/7760?limit=2  
Example output:

```
{
    "data": {
        "id": 7760,
        "title": "Seven Piece Floral Tea Set",
        "is_boosted": false,
        "thumbnail": null,
        "title_sort": null,
        "parent_id": null,
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

Example request: http://aggregator-data.artic.edu/api/v1/legacy-events?limit=2  
Example output:

```
{
    "pagination": {
        "total": 1729,
        "limit": 2,
        "offset": 0,
        "total_pages": 865,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data.artic.edu\/api\/v1\/legacy-events?page=2&limit=2"
    },
    "data": [
        {
            "id": 2618626,
            "title": "Museum Closed for New Year's Day",
            "is_boosted": false,
            "thumbnail": null,
            "description": null,
            "short_description": null,
            ...
        },
        {
            "id": 2618627,
            "title": "Museum Closed for Christmas",
            "is_boosted": false,
            "thumbnail": null,
            "description": null,
            "short_description": null,
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
* `facets` - A comma-separated list of \"count\" aggregation facets to include in the results.

Example request: http://aggregator-data.artic.edu/api/v1/legacy-events/search  
Example output:

```
{
    "preference": null,
    "pagination": {
        "total": 1729,
        "limit": 10,
        "offset": 0,
        "total_pages": 173,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_id": "9075974",
            "thumbnail": null,
            "api_model": "legacy-events",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/legacy-events\/9075974",
            "id": 9075974,
            "title": "Museum Orientation Tour",
            "timestamp": "2018-04-17T20:27:44-05:00"
        },
        {
            "_score": 1,
            "api_id": "24580642",
            "thumbnail": null,
            "api_model": "legacy-events",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/legacy-events\/24580642",
            "id": 24580642,
            "title": "Gallery Talk: Highlights of the Art Institute",
            "timestamp": "2018-04-17T20:27:44-05:00"
        },
        {
            "_score": 1,
            "api_id": "29357087",
            "thumbnail": null,
            "api_model": "legacy-events",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/legacy-events\/29357087",
            "id": 29357087,
            "title": "The Artist's Studio",
            "timestamp": "2018-04-17T20:27:45-05:00"
        }
    ]
}
```

### `/legacy-events/{id}`

A single legacy-event by the given identifier.

Example request: http://aggregator-data.artic.edu/api/v1/legacy-events/2618626?limit=2  
Example output:

```
{
    "data": {
        "id": 2618626,
        "title": "Museum Closed for New Year's Day",
        "is_boosted": false,
        "thumbnail": null,
        "description": null,
        "short_description": null,
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

Example request: http://aggregator-data.artic.edu/api/v1/tours?limit=2  
Example output:

```
{
    "pagination": {
        "total": 9,
        "limit": 2,
        "offset": 0,
        "total_pages": 5,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data.artic.edu\/api\/v1\/tours?page=2&limit=2"
    },
    "data": [
        {
            "id": 2219,
            "title": "Visita a lo esencial",
            "is_boosted": false,
            "thumbnail": null,
            "image": "http:\/\/aic-mobile-tours.artic.edu\/sites\/default\/files\/tour-images\/espanol.jpg",
            "description": "Descubra las historias detr\u00e1s de algunas de las obras de arte m\u00e1s ic\u00f3nicas del museo.",
            ...
        },
        {
            "id": 2220,
            "title": "\u7cbe\u534e\u6e38",
            "is_boosted": false,
            "thumbnail": null,
            "image": "http:\/\/aic-mobile-tours.artic.edu\/sites\/default\/files\/tour-images\/mandarin_fixed.jpg",
            "description": "\u63a2\u7d22\u535a\u7269\u9986\u4e2d\u6700\u5177\u4ee3\u8868\u6027\u7684\u827a\u672f\u4f5c\u54c1\u4ee5\u53ca\u4ed6\u4eec\u80cc\u540e\u7684\u6545\u4e8b\u3002",
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
* `facets` - A comma-separated list of \"count\" aggregation facets to include in the results.

Example request: http://aggregator-data.artic.edu/api/v1/tours/search  
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
            "_score": 1,
            "api_id": "2193",
            "thumbnail": null,
            "api_model": "tours",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/tours\/2193",
            "id": 2193,
            "title": "The Essentials Tour",
            "timestamp": "2018-04-17T20:28:18-05:00"
        },
        {
            "_score": 1,
            "api_id": "2220",
            "thumbnail": null,
            "api_model": "tours",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/tours\/2220",
            "id": 2220,
            "title": "\u7cbe\u534e\u6e38",
            "timestamp": "2018-04-17T20:28:19-05:00"
        },
        {
            "_score": 1,
            "api_id": "2352",
            "thumbnail": null,
            "api_model": "tours",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/tours\/2352",
            "id": 2352,
            "title": "Visions of America",
            "timestamp": "2018-04-17T20:28:18-05:00"
        }
    ]
}
```

### `/tours/{id}`

A single tour by the given identifier.

Example request: http://aggregator-data.artic.edu/api/v1/tours/2219?limit=2  
Example output:

```
{
    "data": {
        "id": 2219,
        "title": "Visita a lo esencial",
        "is_boosted": false,
        "thumbnail": null,
        "image": "http:\/\/aic-mobile-tours.artic.edu\/sites\/default\/files\/tour-images\/espanol.jpg",
        "description": "Descubra las historias detr\u00e1s de algunas de las obras de arte m\u00e1s ic\u00f3nicas del museo.",
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

Example request: http://aggregator-data.artic.edu/api/v1/tour-stops?limit=2  
Example output:

```
{
    "pagination": {
        "total": 105,
        "limit": 2,
        "offset": 0,
        "total_pages": 53,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data.artic.edu\/api\/v1\/tour-stops?page=2&limit=2"
    },
    "data": [
        {
            "id": 75,
            "title": "The Old Guitarist",
            "is_boosted": false,
            "thumbnail": null,
            "artwork_title": "The Old Guitarist",
            "artwork_id": 28067,
            ...
        },
        {
            "id": 105,
            "title": null,
            "is_boosted": false,
            "thumbnail": null,
            "artwork_title": null,
            "artwork_id": null,
            ...
        }
    ]
}
```

### `/tour-stops/{id}`

A single tour-stop by the given identifier.

Example request: http://aggregator-data.artic.edu/api/v1/tour-stops/77?limit=2  
Example output:

```
{
    "data": {
        "id": 77,
        "title": "Bathers by a River",
        "is_boosted": false,
        "thumbnail": null,
        "artwork_title": "Bathers by a River",
        "artwork_id": 79307,
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

Example request: http://aggregator-data.artic.edu/api/v1/mobile-sounds?limit=2  
Example output:

```
{
    "pagination": {
        "total": 605,
        "limit": 2,
        "offset": 0,
        "total_pages": 303,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data.artic.edu\/api\/v1\/mobile-sounds?page=2&limit=2"
    },
    "data": [
        {
            "id": 1536,
            "title": "Arrangement in Flesh Color and Brown: Portrait of Arthur Jerome Eddy",
            "is_boosted": false,
            "thumbnail": null,
            "link": "http:\/\/aic-mobile-tours.artic.edu\/sites\/default\/files\/audio\/742.mp3",
            "transcript": "NARRATOR: For James McNeill Whistler, the title of a painting really mattered. \nSarah Kelly:  You&#039;ll notice that Whistler titled this portrait, &quot;Arrangement in Flesh Color and Brown,&quot; and only then has the subtitle, &quot;Portrait of Arthur Jerome Eddy.&quot; He wanted to emphasize that it was simply a chosen arrangement of line and of color, rather than Arthur Jerome Eddy. And Eddy was very much agreeable to this. \n\nNARRATOR:  Sarah Kelly, Associate Curator at the Art Institute of Chicago. \n\nSARAH KELLY:  Arthur Jerome Eddy is a very important person to the Art Institute of Chicago. He was a Chicago lawyer, and he saw Whistler&#039;s works at the 1893 World&#039;s Columbian Exhibition here in Chicago, where Whistler actually was given center stage. And he was so impressed that he went off and asked Whistler to paint his portrait. He then went from championing Whistler to championing modern art. He became a very influential collector of modern paintings, so the core collection of German expressionist painting came from Arthur Jerome Eddy. He also published a book about modern art. So he was very influential in promoting modern art in America, and particularly in Chicago.",
            ...
        },
        {
            "id": 1537,
            "title": "Bust of a Youth (Saint John the Baptist?)",
            "is_boosted": false,
            "thumbnail": null,
            "link": "http:\/\/aic-mobile-tours.artic.edu\/sites\/default\/files\/audio\/750.mp3",
            "transcript": "NARRATOR:  Bruce Boucher, Curator of European sculpture. \r\n\r\nBRUCE BOUCHER:  Francesco Mochi&#039;s Bust of a Youth is one of our signature pieces, and it is one of the most beautiful Baroque sculptures in the collection. It shows a youth, an adolescent, with corkscrew curls and drapery that suggests he may or may not be the young Saint John the Baptist. But it is a portrait of adolescence, he has a rather dreamy expression and his lips are parted as if he is about to speak, or has just said something. It&#039;s the kind of animated expression that Baroque sculptors like Mochi would use, to try to transcend the limitations of marble as a medium. \r\n\r\nBRUCE BOUCHER  He could carve marble like butter. And if you look at these curls, you could put your finger through them, they are really a tour de force of sculpture. What is Baroque about this, is the way in which.. the sculptor is trying to engage us in a kind of imaginary discourse with the sitter. The figure&#039;s head is turned sharply to the side, his eyes are focused, his mouth is open. There&#039;s a sense of movement about it, which distinguishes it from a Renaissance sculpture, which would probably have been much more passive and less engaged with us as spectators.",
            ...
        }
    ]
}
```

### `/mobile-sounds/{id}`

A single mobile-sound by the given identifier.

Example request: http://aggregator-data.artic.edu/api/v1/mobile-sounds/1545?limit=2  
Example output:

```
{
    "data": {
        "id": 1545,
        "title": "Trompe-l'Oeil Still Life with a Flower Garland and a Curtain",
        "is_boosted": false,
        "thumbnail": null,
        "link": "http:\/\/aic-mobile-tours.artic.edu\/sites\/default\/files\/audio\/757.mp3",
        "transcript": "NARRATOR: Painted in the Netherlands in 1658, this masterly still life held a fascinating secret for many years. Curator Martha Wolff.\r\n\r\nMARTHA WOLFF: This painting is signed by Adriaen van der Spelt, a still life painter whose work is rather rare. But fairly recently, we realized that it&#039;s in fact a collaboration between van der Spelt and a more famous painter named Frans van Mieris who contributed the beautiful blue satin curtain that is drawn across part of the picture.\r\n\r\nNARRATOR: The young artists had both just joined the Painters Gild in the City of Leiden, so this picture was probably a demonstration in their skill in the art of illusion.\r\n\r\nMARTHA WOLFF: And also a reflection of actual usage at the time, because Dutch collectors would use curtains to protect particularly exquisite pictures from light and also to give the viewer the thrill of pulling back the curtain and seeing what was displayed behind it. And you have multiple layers of illusion here because you have first the stone arch and then you have the garland that&#039;s draped in front of it, and then you have the curtain. And one of the most wonderful things is really the brass rod which plays off of the frame of the picture. It stands in front of it.",
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

Example request: http://aggregator-data.artic.edu/api/v1/publications?limit=2  
Example output:

```
{
    "pagination": {
        "total": 10,
        "limit": 2,
        "offset": 0,
        "total_pages": 5,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data.artic.edu\/api\/v1\/publications?page=2&limit=2"
    },
    "data": [
        {
            "id": 7,
            "title": "Pissarro Paintings and Works on Paper at the Art Institute of Chicago",
            "is_boosted": false,
            "thumbnail": null,
            "web_url": "https:\/\/publications.artic.edu\/pissarro\/reader\/paintingsandpaper",
            "site": "pissarro",
            ...
        },
        {
            "id": 12,
            "title": "The Modern Series at the Art Institute of Chicago",
            "is_boosted": false,
            "thumbnail": null,
            "web_url": "https:\/\/publications.artic.edu\/modernseries\/reader\/shatterrupturebreak",
            "site": "modernseries",
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
* `facets` - A comma-separated list of \"count\" aggregation facets to include in the results.

Example request: http://aggregator-data.artic.edu/api/v1/publications/search  
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
            "_score": 1,
            "api_id": "140019",
            "thumbnail": null,
            "api_model": "publications",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/publications\/140019",
            "id": 140019,
            "title": "Manet Paintings and Works on Paper at the Art Institute of Chicago",
            "timestamp": "2018-04-17T20:28:02-05:00"
        },
        {
            "_score": 1,
            "api_id": "12",
            "thumbnail": null,
            "api_model": "publications",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/publications\/12",
            "id": 12,
            "title": "The Modern Series at the Art Institute of Chicago",
            "timestamp": "2018-04-17T20:28:02-05:00"
        },
        {
            "_score": 1,
            "api_id": "406",
            "thumbnail": null,
            "api_model": "publications",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/publications\/406",
            "id": 406,
            "title": "Whistler and Roussel: Linked Visions",
            "timestamp": "2018-04-17T20:28:02-05:00"
        }
    ]
}
```

### `/publications/{id}`

A single publication by the given identifier.

Example request: http://aggregator-data.artic.edu/api/v1/publications/445?limit=2  
Example output:

```
{
    "data": {
        "id": 445,
        "title": "Caillebotte Paintings and Drawings at the Art Institute of Chicago",
        "is_boosted": false,
        "thumbnail": null,
        "web_url": "https:\/\/publications.artic.edu\/caillebotte\/reader\/paintingsanddrawings",
        "site": "caillebotte",
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

Example request: http://aggregator-data.artic.edu/api/v1/sections?limit=2  
Example output:

```
{
    "pagination": {
        "total": 845,
        "limit": 2,
        "offset": 0,
        "total_pages": 423,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data.artic.edu\/api\/v1\/sections?page=2&limit=2"
    },
    "data": [
        {
            "id": 36743809794,
            "title": "Cat. 11 Two Sisters (On the Terrace), 1881",
            "is_boosted": false,
            "thumbnail": null,
            "web_url": "https:\/\/publications.artic.edu\/renoir\/reader\/paintingsanddrawings\/section\/135639",
            "accession": null,
            ...
        },
        {
            "id": 37654267653,
            "title": "Works of Art--Renoir 2014",
            "is_boosted": false,
            "thumbnail": null,
            "web_url": "https:\/\/publications.artic.edu\/renoir\/reader\/paintingsanddrawings\/section\/138977",
            "accession": null,
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
* `facets` - A comma-separated list of \"count\" aggregation facets to include in the results.

Example request: http://aggregator-data.artic.edu/api/v1/sections/search  
Example output:

```
{
    "preference": null,
    "pagination": {
        "total": 444,
        "limit": 10,
        "offset": 0,
        "total_pages": 45,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_id": "2979980",
            "thumbnail": null,
            "api_model": "sections",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/sections\/2979980",
            "id": 2979980,
            "title": "Mosaics Works in Depth",
            "timestamp": "2018-04-17T20:28:06-05:00"
        },
        {
            "_score": 1,
            "api_id": "2984865",
            "thumbnail": null,
            "api_model": "sections",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/sections\/2984865",
            "id": 2984865,
            "title": "Mosaics Works in Brief",
            "timestamp": "2018-04-17T20:28:06-05:00"
        },
        {
            "_score": 1,
            "api_id": "2987309",
            "thumbnail": null,
            "api_model": "sections",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/sections\/2987309",
            "id": 2987309,
            "title": "Cat. 154 Mosaic Floor Panel Depicting Marine Life",
            "timestamp": "2018-04-17T20:28:06-05:00"
        }
    ]
}
```

### `/sections/{id}`

A single section by the given identifier.

Example request: http://aggregator-data.artic.edu/api/v1/sections/3014259?limit=2  
Example output:

```
{
    "data": {
        "id": 3014259,
        "title": "Cat. 160 Pair of Earrings",
        "is_boosted": false,
        "thumbnail": null,
        "web_url": "https:\/\/publications.artic.edu\/roman\/reader\/romanart\/section\/1974",
        "accession": null,
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

Example request: http://aggregator-data.artic.edu/api/v1/sites?limit=2  
Example output:

```
{
    "pagination": {
        "total": 96,
        "limit": 2,
        "offset": 0,
        "total_pages": 48,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data.artic.edu\/api\/v1\/sites?page=2&limit=2"
    },
    "data": [
        {
            "id": 54,
            "title": "Art Access: Impressionist and Post-Impressionist Art",
            "is_boosted": false,
            "thumbnail": null,
            "description": "In the late 19th century, the Impressionists defied academic tradition in French art with their emphasis on modern subjects, sketchlike technique, and practice of painting in the open air with pure, high-keyed color. In the wake of the Impressionist revolution, a new generation of artists pushed the basic pictorial components of color, line, and composition into new psychological and formal territories, influencing many abstract artists of the early 20th century. Thanks to such pioneering donors as Mrs. Potter Palmer and Frederic Clay Bartlett, the Art Institute of Chicago houses one of the largest and most significant collections of Impressionist and Post-Impressionist art in the world.",
            "web_url": "http:\/\/archive.artic.edu\/impressionism\/",
            ...
        },
        {
            "id": 55,
            "title": "Art Access: Indian, Himalayan, and Southeast Asian",
            "is_boosted": false,
            "thumbnail": null,
            "description": "The Art Institute's collection of art from India, the Himalayas, and Southeast Asia includes more than 1,900 objects that span nearly five millennia. Indian and Southeast Asian sculpture and Indian and Persian miniature paintings are among the museum's archaeologically and artistically significant works. As objects of worship or accounts of history, these works present a fascinating picture of the region's religions, including Hinduism, Buddhism, and Islam, and its governments and politics.",
            "web_url": "http:\/\/archive.artic.edu\/indian\/",
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
* `facets` - A comma-separated list of \"count\" aggregation facets to include in the results.

Example request: http://aggregator-data.artic.edu/api/v1/sites/search  
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
            "_score": 1,
            "api_id": "14",
            "thumbnail": null,
            "api_model": "sites",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/sites\/14",
            "id": 14,
            "title": "The Medici, Michelangelo, and the Art of Late Renaissance Florence",
            "timestamp": "2018-04-17T20:30:02-05:00"
        },
        {
            "_score": 1,
            "api_id": "19",
            "thumbnail": null,
            "api_model": "sites",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/sites\/19",
            "id": 19,
            "title": "Perpetual Glory: Medieval Islamic Ceramics from the Harvey B. Plotnick Collection",
            "timestamp": "2018-04-17T20:30:02-05:00"
        },
        {
            "_score": 1,
            "api_id": "22",
            "thumbnail": null,
            "api_model": "sites",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/sites\/22",
            "id": 22,
            "title": "Seurat and the Making of \"La Grande Jatte\"",
            "timestamp": "2018-04-17T20:30:02-05:00"
        }
    ]
}
```

### `/sites/{id}`

A single site by the given identifier.

Example request: http://aggregator-data.artic.edu/api/v1/sites/1?limit=2  
Example output:

```
{
    "data": {
        "id": 1,
        "title": "Chicago Architecture: Ten Visions",
        "is_boosted": false,
        "thumbnail": null,
        "description": "Chicago Architecture: Ten Visions presents diverse views of the future of Chicago\u2019s built environment from 10 internationally renowned architects. The architects were selected from an invited competition juried by architects Stanley Tigerman and Harry Cobb, in collaboration with curators from the Art Institute\u2019s Department of Architecture. The 10 architects reflect a cross section of Chicago\u2019s vibrant architectural scene\u2014from large and small firms as well as the academic community\u2014bringing to this exhibition diverse experiences and insights. Each architect was asked to define an important issue for the future of Chicago and create a \u201cspatial commentary\u201d on that particular theme. Within a lively plan designed by Stanley Tigerman, each of the participants has curated and designed his or her own mini-exhibition in a space of approximately 21 feet square. Tigerman\u2019s setting creates a linear sequence in which visitors pass through the architects\u2019 spaces to an interactive area where the architects\u2019 commentaries can be heard by picking up a telephone. Visitors are encouraged to record their comments on any and all of the \u201cten visions.\u201d",
        "web_url": "http:\/\/archive.artic.edu\/10visions\/",
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

Example request: http://aggregator-data.artic.edu/api/v1/archive-images?limit=2  
Example output:

```
{
    "pagination": {
        "total": 4,
        "limit": 2,
        "offset": 0,
        "total_pages": 2,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data.artic.edu\/api\/v1\/archive-images?page=2&limit=2"
    },
    "data": [
        {
            "id": 10000,
            "title": "Union Theological Seminary",
            "alternate_title": "Union Presbyterian Seminary",
            "web_url": "http:\/\/digital-libraries.saic.edu\/cdm\/ref\/collection\/mqc\/id\/10000",
            "collection": "Inland Architect",
            "archive": null,
            ...
        },
        {
            "id": 10001,
            "title": "University of Pennsylvania, Quadrangle Dormitories",
            "alternate_title": "The Quadrangle, Quad, Men's Dorms",
            "web_url": "http:\/\/digital-libraries.saic.edu\/cdm\/ref\/collection\/mqc\/id\/10001",
            "collection": "Inland Architect",
            "archive": null,
            ...
        }
    ]
}
```

### `/archive-images/{id}`

A single archive-image by the given identifier.

Example request: http://aggregator-data.artic.edu/api/v1/archive-images?limit=2  
Example output:

```
{
    "pagination": {
        "total": 4,
        "limit": 2,
        "offset": 0,
        "total_pages": 2,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data.artic.edu\/api\/v1\/archive-images?page=2&limit=2"
    },
    "data": [
        {
            "id": 10000,
            "title": "Union Theological Seminary",
            "alternate_title": "Union Presbyterian Seminary",
            "web_url": "http:\/\/digital-libraries.saic.edu\/cdm\/ref\/collection\/mqc\/id\/10000",
            "collection": "Inland Architect",
            "archive": null,
            ...
        },
        {
            "id": 10001,
            "title": "University of Pennsylvania, Quadrangle Dormitories",
            "alternate_title": "The Quadrangle, Quad, Men's Dorms",
            "web_url": "http:\/\/digital-libraries.saic.edu\/cdm\/ref\/collection\/mqc\/id\/10001",
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

Example request: http://aggregator-data.artic.edu/api/v1/library-materials?limit=2  
Example output:

```
{
    "pagination": {
        "total": 6861,
        "limit": 2,
        "offset": 0,
        "total_pages": 3431,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data.artic.edu\/api\/v1\/library-materials?page=2&limit=2"
    },
    "data": [
        {
            "id": "01ARTIC_ALMA2132512010003801",
            "title": "La chasse au snark : crise en huit \u00e9pisodes",
            "date": 1950,
            "creators": [
                {
                    "id": "n79056546",
                    "uri": "http:\/\/id.loc.gov\/authorities\/names\/n79056546",
                    "title": "Carroll, Lewis"
                },
                {
                    "id": "n85829187",
                    "uri": "http:\/\/id.loc.gov\/authorities\/names\/n85829187",
                    "title": "Parisot, Henri"
                },
                {
                    "id": "n79144795",
                    "uri": "http:\/\/id.loc.gov\/authorities\/names\/n79144795",
                    "title": "Ernst, Max"
                }
            ],
            "subjects": [],
            ...
        },
        {
            "id": "01ARTIC_ALMA2132541890003801",
            "title": "Recueil de griffonnis, de vu\u00ebs, paysages, fragments antiques et sujets historiques",
            "date": 1790,
            "creators": [
                {
                    "id": "n50025368",
                    "uri": "http:\/\/id.loc.gov\/authorities\/names\/n50025368",
                    "title": "Fragonard, Jean-Honor\u00e9"
                },
                {
                    "id": "n81128260",
                    "uri": "http:\/\/id.loc.gov\/authorities\/names\/n81128260",
                    "title": "Robert, Hubert"
                },
                {
                    "id": "n86031795",
                    "uri": "http:\/\/id.loc.gov\/authorities\/names\/n86031795",
                    "title": "Le Prince, Jean-Baptiste"
                },
                {
                    "id": "n50027103",
                    "uri": "http:\/\/id.loc.gov\/authorities\/names\/n50027103",
                    "title": "Saint Non, Jean Claude Richard de"
                }
            ],
            "subjects": [
                {
                    "id": "sh85007865",
                    "uri": "http:\/\/id.loc.gov\/authorities\/subjects\/sh85007865",
                    "title": "Art, Renaissance -- Italy"
                },
                {
                    "id": "sh85068876",
                    "uri": "http:\/\/id.loc.gov\/authorities\/subjects\/sh85068876",
                    "title": "Italy -- Antiquities"
                },
                {
                    "id": "sh85068907",
                    "uri": "http:\/\/id.loc.gov\/authorities\/subjects\/sh85068907",
                    "title": "Italy -- Description and travel"
                },
                {
                    "id": "n50027103",
                    "uri": "http:\/\/id.loc.gov\/authorities\/names\/n50027103",
                    "title": "Saint Non, Jean Claude Richard de"
                }
            ],
            ...
        }
    ]
}
```

### `/library-materials/{id}`

A single library-material by the given identifier.

Example request: http://aggregator-data.artic.edu/api/v1/library-materials?limit=2  
Example output:

```
{
    "pagination": {
        "total": 6861,
        "limit": 2,
        "offset": 0,
        "total_pages": 3431,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data.artic.edu\/api\/v1\/library-materials?page=2&limit=2"
    },
    "data": [
        {
            "id": "01ARTIC_ALMA2132512010003801",
            "title": "La chasse au snark : crise en huit \u00e9pisodes",
            "date": 1950,
            "creators": [
                {
                    "id": "n79056546",
                    "uri": "http:\/\/id.loc.gov\/authorities\/names\/n79056546",
                    "title": "Carroll, Lewis"
                },
                {
                    "id": "n85829187",
                    "uri": "http:\/\/id.loc.gov\/authorities\/names\/n85829187",
                    "title": "Parisot, Henri"
                },
                {
                    "id": "n79144795",
                    "uri": "http:\/\/id.loc.gov\/authorities\/names\/n79144795",
                    "title": "Ernst, Max"
                }
            ],
            "subjects": [],
            ...
        },
        {
            "id": "01ARTIC_ALMA2132541890003801",
            "title": "Recueil de griffonnis, de vu\u00ebs, paysages, fragments antiques et sujets historiques",
            "date": 1790,
            "creators": [
                {
                    "id": "n50025368",
                    "uri": "http:\/\/id.loc.gov\/authorities\/names\/n50025368",
                    "title": "Fragonard, Jean-Honor\u00e9"
                },
                {
                    "id": "n81128260",
                    "uri": "http:\/\/id.loc.gov\/authorities\/names\/n81128260",
                    "title": "Robert, Hubert"
                },
                {
                    "id": "n86031795",
                    "uri": "http:\/\/id.loc.gov\/authorities\/names\/n86031795",
                    "title": "Le Prince, Jean-Baptiste"
                },
                {
                    "id": "n50027103",
                    "uri": "http:\/\/id.loc.gov\/authorities\/names\/n50027103",
                    "title": "Saint Non, Jean Claude Richard de"
                }
            ],
            "subjects": [
                {
                    "id": "sh85007865",
                    "uri": "http:\/\/id.loc.gov\/authorities\/subjects\/sh85007865",
                    "title": "Art, Renaissance -- Italy"
                },
                {
                    "id": "sh85068876",
                    "uri": "http:\/\/id.loc.gov\/authorities\/subjects\/sh85068876",
                    "title": "Italy -- Antiquities"
                },
                {
                    "id": "sh85068907",
                    "uri": "http:\/\/id.loc.gov\/authorities\/subjects\/sh85068907",
                    "title": "Italy -- Description and travel"
                },
                {
                    "id": "n50027103",
                    "uri": "http:\/\/id.loc.gov\/authorities\/names\/n50027103",
                    "title": "Saint Non, Jean Claude Richard de"
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

Example request: http://aggregator-data.artic.edu/api/v1/library-terms?limit=2  
Example output:

```
{
    "pagination": {
        "total": 9508,
        "limit": 2,
        "offset": 0,
        "total_pages": 4754,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data.artic.edu\/api\/v1\/library-terms?page=2&limit=2"
    },
    "data": [
        {
            "id": "n50032177",
            "uri": "http:\/\/id.loc.gov\/authorities\/names\/n50032177",
            "title": "Callahan, Harry M",
            ...
        },
        {
            "id": "n80144448",
            "uri": "http:\/\/id.loc.gov\/authorities\/names\/n80144448",
            "title": "Takiguchi, Sh\u016bz\u014d",
            ...
        }
    ]
}
```

### `/library-terms/{id}`

A single library-term by the given identifier.

Example request: http://aggregator-data.artic.edu/api/v1/library-terms?limit=2  
Example output:

```
{
    "pagination": {
        "total": 9508,
        "limit": 2,
        "offset": 0,
        "total_pages": 4754,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data.artic.edu\/api\/v1\/library-terms?page=2&limit=2"
    },
    "data": [
        {
            "id": "n50032177",
            "uri": "http:\/\/id.loc.gov\/authorities\/names\/n50032177",
            "title": "Callahan, Harry M",
            ...
        },
        {
            "id": "n80144448",
            "uri": "http:\/\/id.loc.gov\/authorities\/names\/n80144448",
            "title": "Takiguchi, Sh\u016bz\u014d",
            ...
        }
    ]
}
```

> Generated by `php artisan docs:endpoints` on 2018-04-27 17:02:30
