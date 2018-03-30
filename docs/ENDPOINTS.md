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
  * `parts`
  * `sets`
  * `dates`
  * `catalogues`
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
        "total": 106551,
        "limit": 2,
        "offset": 0,
        "total_pages": 53276,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data.artic.edu\/api\/v1\/artworks?page=2&limit=2"
    },
    "data": [
        {
            "id": 118917,
            "title": "Panorama, 1983\u201386",
            "lake_guid": "4aa53f97-51dc-f897-bdbb-4c20696bf5e3",
            "is_boosted": false,
            "thumbnail": null,
            "alt_titles": [],
            ...
        },
        {
            "id": 120543,
            "title": "Untitled",
            "lake_guid": "ed2d9467-ac94-c969-c1b2-e8f6eb7fbd93",
            "is_boosted": false,
            "thumbnail": null,
            "alt_titles": [],
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
  * `artists`
  * `categories`
  * `parts`
  * `sets`
  * `dates`
  * `catalogues`
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
            "id": 47149,
            "title": "Mao",
            "lake_guid": "1c3cd317-e33b-388a-4036-6938cc1023bc",
            "is_boosted": true,
            "thumbnail": {
                "url": "https:\/\/lakeimagesweb.artic.edu\/iiif\/2\/706a6428-c775-6cd5-6d8d-41f6dd04ce26",
                "type": "iiif",
                "lqip": "data:image\/gif;base64,R0lGODlhBAAFAPQAACMeJ0M\/MXZfDlJOO3lSL2RJMWxUNGRdRGpiVWdlW5xvLoJyI5poMr11Klp9nF2DonOSqXWWrXydsImvxAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAAAAAAALAAAAAAEAAUAAAUR4KMYDtQwkUQUU4IEA3AsQggAOw==",
                "width": 1741,
                "height": 2250
            },
            "alt_titles": [],
            ...
        },
        {
            "id": 72728,
            "title": "Untitled",
            "lake_guid": "b637652f-6bfe-d94d-d285-85cfdd938f66",
            "is_boosted": true,
            "thumbnail": {
                "url": "https:\/\/lakeimagesweb.artic.edu\/iiif\/2\/947e1361-4118-e395-413c-9eb1c04fe92e",
                "type": "iiif",
                "lqip": "data:image\/gif;base64,R0lGODlhCwAFAPUAABoYGiIiJCUiJSkmKiwnLCwpLC4sLy8tMTQyNTs2Ojo4PDw4PD85PD89QkA8QEA9QUNCR1BQUldXV1tYWV1cXGdkZ2xpaXRzdHZzdXd0dnx5e3t6fHx6fIB9f4KAgYOAgoOBhoWFhYeGhoWEioqIjpKOlJKPlpSOlZiVlJaTmpycoaCaobOxsra4vb28v7++vsLBxMPFyMbFys3Kzs3L0M\/M0NHP1AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAAAAAAALAAAAAALAAUAAAYywFhLZqPVZjAX66UarVKm0okEwqAqjEnj4VgoIAiKBJAoEASDgyEQEVk+mo4nw9lcQkEAOw==",
                "width": 3000,
                "height": 1387
            },
            "alt_titles": [],
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
        "total": 267,
        "limit": 10,
        "offset": 0,
        "total_pages": 27,
        "current_page": 1
    },
    "data": [
        {
            "_score": 33.516296,
            "api_id": "7988",
            "thumbnail": {
                "width": 2024,
                "type": "iiif",
                "url": "https:\/\/lakeimagesweb.artic.edu\/iiif\/2\/3f007f48-0cb7-4d65-6bff-09fff932999e",
                "lqip": "data:image\/gif;base64,R0lGODlhBAAFAPQAACcnJyoqKjw8PEBAQEREREVFRUlJSU5OTlFRUVJSUlVVVVpaWl9fX2NjY2tra3BwcHBwcHl5eYqKipWVlQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAAAAAAAIf8LSW1hZ2VNYWdpY2sOZ2FtbWE9MC40NTQ1NDUALAAAAAAEAAUAAAURILREwtEMgDMhgSIxifEQRQgAOw==",
                "height": 2743
            },
            "api_model": "artworks",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/artworks\/7988",
            "id": 7988,
            "title": "Claude Monet",
            "timestamp": "2018-03-19T16:51:20-05:00"
        },
        {
            "_score": 30.885502,
            "api_id": "14598",
            "thumbnail": {
                "width": 3000,
                "type": "iiif",
                "url": "https:\/\/lakeimagesweb.artic.edu\/iiif\/2\/9ee6ba5d-97ee-8012-2ee5-7b540a048023",
                "lqip": "data:image\/gif;base64,R0lGODlhBwAFAPUAAFtgaXRtcHVxcn53dH9+fXR3gIZ\/gXWGkH2SnoeLl46NkpCOlJmWl5GRmJCRmZWTmpOVmpeXnpmZn5qYn5KWoZSXoZiaopmao5yboJ2epp6fp6CfpaeipqWjqKyrr7Osq7Wztru4usPAwQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAAAAAAALAAAAAAHAAUAAAYhwMVj4wGFRJcMxaKpdAiKhsSRiAwEjALggAgYPpwJBhIEADs=",
                "height": 2198
            },
            "api_model": "artworks",
            "is_boosted": true,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/artworks\/14598",
            "id": 14598,
            "title": "The Beach at Sainte-Adresse",
            "timestamp": "2018-03-19T16:52:58-05:00"
        },
        {
            "_score": 30.467085,
            "api_id": "64818",
            "thumbnail": {
                "width": 3000,
                "type": "iiif",
                "url": "https:\/\/lakeimagesweb.artic.edu\/iiif\/2\/9511bf7d-4f6c-f523-5fb1-ff069c17f16c",
                "lqip": "data:image\/gif;base64,R0lGODlhCAAFAPUAAG90ZH53aXh1dItwZoxxaI98cHSEeJOEZZiDbaSQfnKAgJKHg5aNgpeZjJOXkZ+elKKajZSlnZ6jmJWqnrGujbewiq6tk6mqn7Ghk7Oym42jpKOoo6+to7OooK2xoM2\/mrbFvLjIv83PvsfQus7TvMHJwMHNwMDLxAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAAAAAAALAAAAAAIAAUAAAYlQFDoVDKNSCLOxZOxUCofhSBgABAGhwYj8XAsCgiIZBLRbDqYIAA7",
                "height": 1778
            },
            "api_model": "artworks",
            "is_boosted": true,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/artworks\/64818",
            "id": 64818,
            "title": "Stacks of Wheat (End of Summer)",
            "timestamp": "2018-03-26T12:55:06-05:00"
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
            "lqip": "data:image\/gif;base64,R0lGODlhCQAFAPUAAAggIQsoKQksLAssLxUsKRkvLRgxMhM+PBo4OzAtJCcwKSY0KSY0LCozKDwyJT85KSk4MEk2JFE7IwxDOx5AOEZCLEJKPAk0QgI6TBJGRRVNRx9LSwtYWyhWTzhQTStaWjxrZEBxYkV0ZUhxaEh5bE+Ke8vBbX2\/poXCq4rKr9PUncfPoc3XpwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAAAAAAALAAAAAAJAAUAAAYqQIckkmgsIAZEgUHJbD6jlSoA0HAuGA\/LBCKFJgTFw1JBpU4lUecgGAQBADs=",
            "width": 3000,
            "height": 1638
        },
        "alt_titles": [],
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
            "id": "PC-151",
            "title": "light and shadow",
            "lake_guid": "40b3ae54-9c43-a750-ac9a-31c39bf490ba",
            "is_boosted": false,
            "thumbnail": null,
            "parent_id": null,
            ...
        },
        {
            "id": "PC-149",
            "title": "New York City",
            "lake_guid": "e3dc716f-3912-3063-bdfc-910cdd53a116",
            "is_boosted": false,
            "thumbnail": null,
            "parent_id": null,
            ...
        },
        {
            "id": "PC-41",
            "title": "Featured Works",
            "lake_guid": "ae637a2b-e996-a28e-7ca8-adae24ae01fa",
            "is_boosted": false,
            "thumbnail": null,
            "parent_id": "PC-2",
            ...
        },
        {
            "id": "PC-147",
            "title": "architecture",
            "lake_guid": "965e725e-1275-ff04-6e9f-8b207eeb28ec",
            "is_boosted": false,
            "thumbnail": null,
            "parent_id": null,
            ...
        },
        {
            "id": "PC-152",
            "title": "figural paintings",
            "lake_guid": "87917ef5-0de9-d5c9-ac25-be5b0a4dd782",
            "is_boosted": false,
            "thumbnail": null,
            "parent_id": null,
            ...
        },
        {
            "id": "PC-48",
            "title": "American Modernism",
            "lake_guid": "795eda4e-6c99-1e9f-3283-5aaaad27f857",
            "is_boosted": false,
            "thumbnail": null,
            "parent_id": "PC-2",
            ...
        },
        {
            "id": "PC-150",
            "title": "views through windows",
            "lake_guid": "cefecb9f-0be9-6023-1188-294ad5ac7e27",
            "is_boosted": false,
            "thumbnail": null,
            "parent_id": null,
            ...
        },
        {
            "id": "PC-144",
            "title": "Edward Hopper",
            "lake_guid": "3b7d4a9f-cd72-a02f-4247-61ef8e814a98",
            "is_boosted": false,
            "thumbnail": null,
            "parent_id": null,
            ...
        },
        {
            "id": "PC-83",
            "title": "Featured Works",
            "lake_guid": "854c887d-e8e1-71fb-1393-a3280918efd2",
            "is_boosted": false,
            "thumbnail": null,
            "parent_id": "PC-11",
            ...
        },
        {
            "id": "PC-365",
            "title": "Art Access: Modern and Contemporary Art",
            "lake_guid": "b3743235-8d0d-a381-8582-95dfcad26711",
            "is_boosted": false,
            "thumbnail": null,
            "parent_id": null,
            ...
        },
        {
            "id": "PC-44",
            "title": "Paintings, 1900-1955",
            "lake_guid": "dcafd608-cc4a-bf34-12b7-87e095bc0a5b",
            "is_boosted": false,
            "thumbnail": null,
            "parent_id": "PC-2",
            ...
        },
        {
            "id": "PC-2",
            "title": "American",
            "lake_guid": "609dd2cb-9647-1b18-59be-5b8d74d29b51",
            "is_boosted": false,
            "thumbnail": null,
            "parent_id": null,
            ...
        },
        {
            "id": "PC-11",
            "title": "Modern",
            "lake_guid": "45cc4323-ddb5-b79e-92ae-59238de12577",
            "is_boosted": false,
            "thumbnail": null,
            "parent_id": null,
            ...
        },
        {
            "id": "PC-612",
            "title": "The City in Art",
            "lake_guid": "4864d53c-d1e6-a072-d036-18f96d612709",
            "is_boosted": false,
            "thumbnail": null,
            "parent_id": null,
            ...
        },
        {
            "id": "PC-87",
            "title": "American Modernism",
            "lake_guid": "3c15e374-7cd0-7a9a-0280-fa3855032a3f",
            "is_boosted": false,
            "thumbnail": null,
            "parent_id": "PC-11",
            ...
        },
        {
            "id": "PC-191",
            "title": "Featured Objects",
            "lake_guid": "ada5fe78-e09d-0ef8-82b3-71c4a5b1f6ae",
            "is_boosted": false,
            "thumbnail": null,
            "parent_id": null,
            ...
        },
        {
            "id": "PC-109",
            "title": "Art Institute Icons",
            "lake_guid": "74c96fd4-5e7e-4b56-26f3-0a911d8fe63b",
            "is_boosted": false,
            "thumbnail": null,
            "parent_id": null,
            ...
        },
        {
            "id": "PC-801",
            "title": "Art Resource",
            "lake_guid": "4a87fc2b-ddde-03db-3d5b-8a4e65c2ca26",
            "is_boosted": false,
            "thumbnail": null,
            "parent_id": null,
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
        "total": 12243,
        "limit": 2,
        "offset": 0,
        "total_pages": 6122,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data.artic.edu\/api\/v1\/agents?page=2&limit=2"
    },
    "data": [
        {
            "id": 78367,
            "title": "Museum of Contemporary Art",
            "lake_guid": "f0c7c1bc-73e8-87ec-d305-04621964cce6",
            "is_boosted": false,
            "thumbnail": null,
            "sort_title": "Museum of Contemporary Art",
            ...
        },
        {
            "id": 98211,
            "title": "Elizabeth Wells Robertson",
            "lake_guid": "ed1d160c-96a1-fbd7-2440-d030e877b540",
            "is_boosted": false,
            "thumbnail": null,
            "sort_title": "Robertson, Elizabeth Wells",
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
            "id": 15965,
            "title": "Ren\u00e9 Magritte",
            "lake_guid": "4c25b9f9-482a-a495-8279-3352b1e25487",
            "is_boosted": true,
            "thumbnail": null,
            "sort_title": "Magritte, Ren\u00e9",
            ...
        },
        {
            "id": 3829,
            "title": "Gustave Caillebotte",
            "lake_guid": "5e58b265-759b-1d92-d74c-3420a3c09e0d",
            "is_boosted": true,
            "thumbnail": null,
            "sort_title": "Caillebotte, Gustave",
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
        "total": 12236,
        "limit": 10,
        "offset": 0,
        "total_pages": 1224,
        "current_page": 1
    },
    "data": [
        {
            "_score": 7.686507,
            "api_id": "15615",
            "thumbnail": null,
            "api_model": "agents",
            "is_boosted": true,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/agents\/15615",
            "id": 15615,
            "title": "Tiffany Studios",
            "timestamp": "2018-03-19T16:49:01-05:00"
        },
        {
            "_score": 7.686507,
            "api_id": "5383",
            "thumbnail": null,
            "api_model": "agents",
            "is_boosted": true,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/agents\/5383",
            "id": 5383,
            "title": "Juan S\u00e1nchez Cot\u00e1n",
            "timestamp": "2018-03-19T16:48:57-05:00"
        },
        {
            "_score": 7.686507,
            "api_id": "7268",
            "thumbnail": null,
            "api_model": "agents",
            "is_boosted": true,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/agents\/7268",
            "id": 7268,
            "title": "Francesco Durantino",
            "timestamp": "2018-03-19T16:48:58-05:00"
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
        "total": 12243,
        "limit": 2,
        "offset": 0,
        "total_pages": 6122,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data.artic.edu\/api\/v1\/agents?page=2&limit=2"
    },
    "data": [
        {
            "id": 78367,
            "title": "Museum of Contemporary Art",
            "lake_guid": "f0c7c1bc-73e8-87ec-d305-04621964cce6",
            "is_boosted": false,
            "thumbnail": null,
            "sort_title": "Museum of Contemporary Art",
            ...
        },
        {
            "id": 98211,
            "title": "Elizabeth Wells Robertson",
            "lake_guid": "ed1d160c-96a1-fbd7-2440-d030e877b540",
            "is_boosted": false,
            "thumbnail": null,
            "sort_title": "Robertson, Elizabeth Wells",
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
        "total": 790,
        "limit": 2,
        "offset": 0,
        "total_pages": 395,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data.artic.edu\/api\/v1\/categories?page=2&limit=2"
    },
    "data": [
        {
            "id": "PC-457",
            "title": "Inside Marina City",
            "lake_guid": "d1a55901-5197-54df-782d-d44bf82a7784",
            "is_boosted": false,
            "thumbnail": null,
            "parent_id": "PC-417",
            ...
        },
        {
            "id": "PC-537",
            "title": "Paper Architecture: Case 4",
            "lake_guid": "59fd3f55-520c-6072-ace8-eb880b039b3a",
            "is_boosted": false,
            "thumbnail": null,
            "parent_id": "PC-426",
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
        "total": 790,
        "limit": 10,
        "offset": 0,
        "total_pages": 79,
        "current_page": 1
    },
    "data": [
        {
            "_score": 2,
            "api_id": "PC-1",
            "thumbnail": null,
            "api_model": "categories",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/categories\/PC-1",
            "id": "PC-1",
            "title": "African",
            "timestamp": "2018-03-19T17:41:37-05:00"
        },
        {
            "_score": 2,
            "api_id": "PC-10",
            "thumbnail": null,
            "api_model": "categories",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/categories\/PC-10",
            "id": "PC-10",
            "title": "European Painting and Sculpture",
            "timestamp": "2018-03-19T17:41:37-05:00"
        },
        {
            "_score": 2,
            "api_id": "PC-103",
            "thumbnail": null,
            "api_model": "categories",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/categories\/PC-103",
            "id": "PC-103",
            "title": "Japanese",
            "timestamp": "2018-03-19T17:41:37-05:00"
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
        "parent_id": null,
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
        "total": 12887,
        "limit": 2,
        "offset": 0,
        "total_pages": 6444,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data.artic.edu\/api\/v1\/places?page=2&limit=2"
    },
    "data": [
        {
            "id": 2147483419,
            "title": "Gunsaulus Hall",
            "lake_guid": "1b4de455-fe95-2548-d972-39f88e2d88a5",
            "is_boosted": false,
            "thumbnail": null,
            "type": "AIC Gallery",
            ...
        },
        {
            "id": 25000,
            "title": "Display Unit 208",
            "lake_guid": "70f0115e-d027-0ce4-4f0d-dcef4e75953b",
            "is_boosted": false,
            "thumbnail": null,
            "type": "AIC Gallery",
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
        "total": 12884,
        "limit": 10,
        "offset": 0,
        "total_pages": 1289,
        "current_page": 1
    },
    "data": [
        {
            "_score": 2,
            "api_id": "-2147480450",
            "thumbnail": null,
            "api_model": "places",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/places\/-2147480450",
            "id": -2147480450,
            "title": "El Paso",
            "timestamp": "2018-03-19T17:42:07-05:00"
        },
        {
            "_score": 2,
            "api_id": "-2147480439",
            "thumbnail": null,
            "api_model": "places",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/places\/-2147480439",
            "id": -2147480439,
            "title": "San Diego",
            "timestamp": "2018-03-19T17:42:07-05:00"
        },
        {
            "_score": 2,
            "api_id": "-2147480407",
            "thumbnail": null,
            "api_model": "places",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/places\/-2147480407",
            "id": -2147480407,
            "title": "Jouy-en-Josas",
            "timestamp": "2018-03-19T17:42:07-05:00"
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
            "id": 28498,
            "title": "Gallery 239",
            "lake_guid": "86cc9e3e-b494-3930-a492-ec82baa70f4e",
            "is_boosted": false,
            "thumbnail": null,
            "type": "AIC Gallery",
            ...
        },
        {
            "id": 28502,
            "title": "Gallery 239A",
            "lake_guid": "9e0ced44-b82c-05d4-a998-6d5ad9471caa",
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
            "_score": 2,
            "api_id": "2147476055",
            "thumbnail": null,
            "api_model": "galleries",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/galleries\/2147476055",
            "id": 2147476055,
            "title": "Gallery 167",
            "timestamp": "2018-03-27T11:05:05-05:00"
        },
        {
            "_score": 2,
            "api_id": "2147478066",
            "thumbnail": null,
            "api_model": "galleries",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/galleries\/2147478066",
            "id": 2147478066,
            "title": "Gallery 265",
            "timestamp": "2018-03-27T11:05:05-05:00"
        },
        {
            "_score": 2,
            "api_id": "2147483626",
            "thumbnail": null,
            "api_model": "galleries",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/galleries\/2147483626",
            "id": 2147483626,
            "title": "Gallery 211",
            "timestamp": "2018-03-27T11:05:05-05:00"
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
        "total": 6200,
        "limit": 2,
        "offset": 0,
        "total_pages": 3100,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data.artic.edu\/api\/v1\/exhibitions?page=2&limit=2"
    },
    "data": [
        {
            "id": 2246,
            "title": "Moholy-Nagy: Future Present",
            "lake_guid": "667460e9-d2cc-1cd2-5bfb-94296bd71adc",
            "is_boosted": false,
            "thumbnail": null,
            "description": "Painting, photography, film, sculpture, advertising, product design, theater sets\u2014L\u00e1szl\u00f3 Moholy-Nagy (American, born Hungary, 1895\u20131946) did it all. Future Present, the first comprehensive retrospective of Moholy-Nagy\u2019s work in the United States in nearly 50 years, brings together more than 300 works to survey the career of a multimedia artist who was always ahead of his time. Moholy, as he was known, came to prominence as a professor at the Bauhaus art school in Germany (1923\u201328). In 1937 he founded the New Bauhaus in Chicago, a school that continues today as the Institute of Design at the Illinois Institute of Technology. He remains the most renowned international modern artist ever to have resided in Chicago.\n\nA pioneer of abstraction for the industrial age, Moholy insisted that art must be developed from the materials of one\u2019s time, in his case recorded sound, photography, film, and synthetic plastics. He demonstrated that in our era of reproducibility works of art gain fresh meaning with a change in size or even reorientation, reverse printing, or a shift in lighting. For Moholy, every citizen could be creative, and every viewer could educate his or her senses by studying effects of light, transparency, and motion in common materials of everyday modern life.\n\n\u2028Future Present presents a wide body of works ranging in date from 1920, when the artist moved to Germany, until his death in Chicago in 1946. One room shows 38 photomontages\u2014nearly all known compositions in nearly every physical variant\u2014brought together for the first time. Another presents three \u201ctelephone paintings,\u201d a single abstract composition that Moholy ordered in three sizes from an enamel sign factory in 1923; this trio of industrial paintings has been separated for decades. All six of Moholy\u2019s iconic, plunging views from the Berlin Radio Tower are united in another room, while a multimedia installation, Room of the Present, which Moholy conceived in 1930 but could not finish, is brought to life as a room of its own.\n\n\u2028\u2028Special emphasis is given to Moholy\u2019s time in the United States, where his art moved from planar painterly abstractions to three-dimensional hybrids of painting and sculpture. Never have so many of the artist\u2019s late works in Plexiglas\u2014wall-mounted, freestanding, and hanging in midair\u2014been seen together. These works came from Moholy\u2019s teaching at the \u201cChicago Bauhaus,\u201d which is also highlighted through a showing of student work as well as a \u201cteaching wall\u201d that frames Moholy\u2019s greatest pedagogical ideas. The show closes with Moholy\u2019s recorded voice and a projection of abstract color slides that the artist made in part by recording the scribble-like trace of headlights and taillights on Lake Shore Drive at night.\n\nOrganizers\nMoholy-Nagy: Future Present is organized by the Art Institute of Chicago; Solomon R. Guggenheim Museum, New York; and Los Angeles County Museum of Art, Los Angeles.\n\nOther Venues\nSolomon R. Guggenheim Museum: May 27\u2013September 7, 2016\nLos Angeles County Museum of Art: February 12\u2013June 18, 2017\n\nCatalogue\nPurchase Moholy-Nagy: Future Present and experience the exhibition through its accompanying catalogue. All purchases support the many fine programs of the museum.",
            ...
        },
        {
            "id": 3092,
            "title": "Vanishing Beauty: Asian Jewelry and Ritual Objects from the Barbara and David Kipper Collection",
            "lake_guid": "fcf2680b-2056-beb7-b0f7-efc78fc58f8d",
            "is_boosted": false,
            "thumbnail": null,
            "description": "Immerse yourself in the rich cultures of some of Asia\u2019s most remote regions with this summer\u2019s exhibition Vanishing Beauty. Drawn from Art Institute Trustee and accomplished photographer Barbara Levy Kipper\u2019s sweeping collection of Asian jewelry and ritual objects promised to the museum in 2014, the exhibition presents more than 300 exquisitely crafted works\u2014highlights from this expansive, diverse, and thoughtfully assembled collection\u2014that offer a panoramic view of the fast-disappearing nomadic and tribal cultures of Asia.\n\nAmong the pieces on view are a vast collection of Tibetan and greater Himalayan Buddhist ritual objects and adornments, Islamic silver jewelry from the nomadic tribes of Turkmenistan and the city-states of Uzbekistan, tribal and folk jewelry from across South Asia, personal ornaments from the Indonesian archipelago, and the monumental jewelry of southwestern China\u2019s ethnic minorities. Tying all these disparate objects together is the fact that the peoples who produced them have largely been pushed into the margins, surviving today only in the remotest of areas. In these cultures, jewelry is auspicious and holds great meaning; it is rarely mere adornment. Necklaces, pendants, earrings, and headdresses all serve social, ritual, or talismanic purposes.\n\nA highlight of this manifold use of jewelry is a cobra-like headdress (perak) from Tibet composed of long rows of turquoise stones that, when worn, cascade from a woman\u2019s forehead down the length of her back. A stone synonymous with Tibetan jewelry, turquoise is believed to hold mystical healing properties, and its quantity and quality act as status symbols for the wealth of a woman and her family. With more than 100 large turquoise stones as well as small amulet cases (gaus), this stunning perak signifies great spiritual and earthly fortune for its wearer and joins hundreds of similarly meaning-filled objects in this vibrant display of craftsmanship and culture.\n\nThe exhibition flows through five geographical areas\u2014from mountaintop monasteries in the Himalayas to oasis settlements of the Central Asian steppes marked by grand blue-tiled mosques, madrasahs, and mausolea; on to the pastoral regions and deserts of South Asia and the most secluded islands of Indonesia; and finally to the river valleys in China\u2019s mountainous Guizhou province. Providing an immersive experience with music and video installations throughout the galleries, Vanishing Beauty brings these dispersed cultures to life through a dazzling array of extraordinary objects, each rich with stories from some of the most inaccessible regions of the world.\n\nPurchase Vanishing Beauty Asian Jewelry and Ritual Objects from the Barbara and David Kipper Collection and experience the exhibition through its accompanying catalogue.  All purchases support the many fine programs of the museum.\nSponsors\nVanishing Beauty: Asian Jewelry and Ritual Objects from the Barbara and David Kipper Collection is generously sponsored by Barbara Levy Kipper and the Kipper Family Foundation.\n\nAnnual support for Art Institute exhibitions is provided by the Exhibitions Trust: Neil Bluhm and the Bluhm Family Charitable Foundation, Kenneth Griffin, Robert M. and Diane v.S. Levy, Thomas and Margot Pritzker, Anne and Chris Reyes, Betsy Bergman Rosenfield and Andrew M. Rosenfield, the Earl and Brenda Shapiro Foundation, and the Woman\u2019s Board.",
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
        "total": 6216,
        "limit": 10,
        "offset": 0,
        "total_pages": 622,
        "current_page": 1
    },
    "data": [
        {
            "_score": 2,
            "api_id": "73",
            "thumbnail": null,
            "api_model": "exhibitions",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/exhibitions\/73",
            "id": 73,
            "title": "Focus: Michael Asher",
            "timestamp": "2018-03-19T17:41:38-05:00"
        },
        {
            "_score": 2,
            "api_id": "84",
            "thumbnail": null,
            "api_model": "exhibitions",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/exhibitions\/84",
            "id": 84,
            "title": "On the Scene: Jessica Rowe, Jason Salavon, Brian Ulrich",
            "timestamp": "2018-03-19T17:41:38-05:00"
        },
        {
            "_score": 2,
            "api_id": "105",
            "thumbnail": null,
            "api_model": "exhibitions",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/exhibitions\/105",
            "id": 105,
            "title": "Yokohama-e: Nineteenth Century Prints of Americans in Japan",
            "timestamp": "2018-03-19T17:41:38-05:00"
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
        "total": 111007,
        "limit": 2,
        "offset": 0,
        "total_pages": 55504,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data.artic.edu\/api\/v1\/images?page=2&limit=2"
    },
    "data": [
        {
            "id": "4f2d350e-c5e0-7ead-198e-36e177451b9a",
            "title": "IM028462",
            "lake_guid": "4f2d350e-c5e0-7ead-198e-36e177451b9a",
            "is_boosted": false,
            "thumbnail": null,
            "type": "image",
            ...
        },
        {
            "id": "2e0899f5-e61c-fc16-4624-7bd6ffc9629a",
            "title": "IM028898",
            "lake_guid": "2e0899f5-e61c-fc16-4624-7bd6ffc9629a",
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
        "total": 111007,
        "limit": 10,
        "offset": 0,
        "total_pages": 11101,
        "current_page": 1
    },
    "data": [
        {
            "_score": 2,
            "api_id": "6041969b-ee24-999c-7382-66dd3f67ab29",
            "thumbnail": null,
            "api_model": "images",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/images\/6041969b-ee24-999c-7382-66dd3f67ab29",
            "id": "6041969b-ee24-999c-7382-66dd3f67ab29",
            "title": "G57736",
            "timestamp": "2018-03-19T17:45:59-05:00"
        },
        {
            "_score": 2,
            "api_id": "6045845c-3314-1c90-56a1-d90e395f2b4e",
            "thumbnail": null,
            "api_model": "images",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/images\/6045845c-3314-1c90-56a1-d90e395f2b4e",
            "id": "6045845c-3314-1c90-56a1-d90e395f2b4e",
            "title": "PD_011414_59",
            "timestamp": "2018-03-19T17:45:59-05:00"
        },
        {
            "_score": 2,
            "api_id": "6047a610-ab9c-aedb-618c-452c58678483",
            "thumbnail": null,
            "api_model": "images",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/images\/6047a610-ab9c-aedb-618c-452c58678483",
            "id": "6047a610-ab9c-aedb-618c-452c58678483",
            "title": "PH_11860",
            "timestamp": "2018-03-19T17:45:59-05:00"
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
            "id": "4286a87f-4193-0c3a-91d4-784c57ed2cd9",
            "title": "Online Game: Claude Monet's <em>Water Lilies<\/em>",
            "lake_guid": "4286a87f-4193-0c3a-91d4-784c57ed2cd9",
            "is_boosted": false,
            "thumbnail": null,
            "type": "video",
            ...
        },
        {
            "id": "45e5e9c4-f2a5-692e-095c-6a2d4e701483",
            "title": "Online Game: Mary Cassatt's <em>The Child's Bath<\/em>",
            "lake_guid": "45e5e9c4-f2a5-692e-095c-6a2d4e701483",
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
            "_score": 2,
            "api_id": "031dcad7-f39f-2dae-595c-eb6730a54dc6",
            "thumbnail": null,
            "api_model": "videos",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/videos\/031dcad7-f39f-2dae-595c-eb6730a54dc6",
            "id": "031dcad7-f39f-2dae-595c-eb6730a54dc6",
            "title": "Video: Staff Picks: Robby S.",
            "timestamp": "2018-03-19T17:52:28-05:00"
        },
        {
            "_score": 2,
            "api_id": "05ef3389-d354-0890-a840-dd836ed0c52d",
            "thumbnail": null,
            "api_model": "videos",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/videos\/05ef3389-d354-0890-a840-dd836ed0c52d",
            "id": "05ef3389-d354-0890-a840-dd836ed0c52d",
            "title": "Video: Moreau's Enduring Art",
            "timestamp": "2018-03-19T17:52:28-05:00"
        },
        {
            "_score": 2,
            "api_id": "12f69a4d-06c5-e35c-c936-d1dc451231d1",
            "thumbnail": null,
            "api_model": "videos",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/videos\/12f69a4d-06c5-e35c-c936-d1dc451231d1",
            "id": "12f69a4d-06c5-e35c-c936-d1dc451231d1",
            "title": "Video: Cassatt in the Paris Art World",
            "timestamp": "2018-03-19T17:52:28-05:00"
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

Example request: http://aggregator-data.artic.edu/api/v1/links?limit=2  
Example output:

```
{
    "pagination": {
        "total": 142,
        "limit": 2,
        "offset": 0,
        "total_pages": 71,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data.artic.edu\/api\/v1\/links?page=2&limit=2"
    },
    "data": [
        {
            "id": "6d566693-97e7-ef54-f374-b772b6b93df1",
            "title": "Website: Art Access: Renaissance and Baroque Art",
            "lake_guid": "6d566693-97e7-ef54-f374-b772b6b93df1",
            "is_boosted": false,
            "thumbnail": null,
            "type": "link",
            ...
        },
        {
            "id": "1ac6c73b-e560-5fc9-05fb-8e2c30eccdc0",
            "title": "Text: The Bartletts and the Grande Jatte:  Collecting Modern Painting in the 1920s",
            "lake_guid": "1ac6c73b-e560-5fc9-05fb-8e2c30eccdc0",
            "is_boosted": false,
            "thumbnail": null,
            "type": "link",
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
* `facets` - A comma-separated list of \"count\" aggregation facets to include in the results.

Example request: http://aggregator-data.artic.edu/api/v1/links/search  
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
            "api_id": "0006576e-6a99-7ec1-9562-8a5c1085d2d9",
            "thumbnail": null,
            "api_model": "links",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/links\/0006576e-6a99-7ec1-9562-8a5c1085d2d9",
            "id": "0006576e-6a99-7ec1-9562-8a5c1085d2d9",
            "title": "Timeline: When in Africa, When in the World",
            "timestamp": "2018-03-19T17:52:21-05:00"
        },
        {
            "_score": 2,
            "api_id": "0af8be20-aebb-1193-96d5-f1045e399776",
            "thumbnail": null,
            "api_model": "links",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/links\/0af8be20-aebb-1193-96d5-f1045e399776",
            "id": "0af8be20-aebb-1193-96d5-f1045e399776",
            "title": "Timeline: Irving Penn",
            "timestamp": "2018-03-19T17:52:21-05:00"
        },
        {
            "_score": 2,
            "api_id": "12af57aa-9338-35a0-bd9c-658bb31e9d3f",
            "thumbnail": null,
            "api_model": "links",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/links\/12af57aa-9338-35a0-bd9c-658bb31e9d3f",
            "id": "12af57aa-9338-35a0-bd9c-658bb31e9d3f",
            "title": "Turning the Pages: Jacques-Louis David, (French, 1748\u20131825) Sketchbook, 1809\/10",
            "timestamp": "2018-03-19T17:52:21-05:00"
        }
    ]
}
```

### `/links/{id}`

A single link by the given identifier. {id} is the identifier from our collections managements system.

Example request: http://aggregator-data.artic.edu/api/v1/links/3990a5f5-2ae9-3c7b-2fb8-1b0438962cd3?limit=2  
Example output:

```
{
    "data": {
        "id": "3990a5f5-2ae9-3c7b-2fb8-1b0438962cd3",
        "title": "Student Tours: Visit Information",
        "lake_guid": "3990a5f5-2ae9-3c7b-2fb8-1b0438962cd3",
        "is_boosted": false,
        "thumbnail": null,
        "type": "link",
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
            "id": "885f816a-377c-944d-ef52-4df674a07025",
            "title": "Audio Lecture: Artists Connect: Georgina Valverde Connects with a Talismanic Textile",
            "lake_guid": "885f816a-377c-944d-ef52-4df674a07025",
            "is_boosted": false,
            "thumbnail": null,
            "type": "sound",
            ...
        },
        {
            "id": "0604bd8c-aa40-cfcf-43b0-c25e2f3cdcdd",
            "title": "Audio Lecture: Ed Ruscha and Photography",
            "lake_guid": "0604bd8c-aa40-cfcf-43b0-c25e2f3cdcdd",
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
            "_score": 2,
            "api_id": "006ee4b8-782c-6840-8309-99e456a81ff1",
            "thumbnail": null,
            "api_model": "sounds",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/sounds\/006ee4b8-782c-6840-8309-99e456a81ff1",
            "id": "006ee4b8-782c-6840-8309-99e456a81ff1",
            "title": "549.mp3",
            "timestamp": "2018-03-19T17:52:21-05:00"
        },
        {
            "_score": 2,
            "api_id": "0194fb4d-9230-54a5-6ba1-23b7545b5028",
            "thumbnail": null,
            "api_model": "sounds",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/sounds\/0194fb4d-9230-54a5-6ba1-23b7545b5028",
            "id": "0194fb4d-9230-54a5-6ba1-23b7545b5028",
            "title": "Musecast: May 2009",
            "timestamp": "2018-03-19T17:52:21-05:00"
        },
        {
            "_score": 2,
            "api_id": "01b0d6b8-f153-d6e5-59b6-1d5fd859dd71",
            "thumbnail": null,
            "api_model": "sounds",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/sounds\/01b0d6b8-f153-d6e5-59b6-1d5fd859dd71",
            "id": "01b0d6b8-f153-d6e5-59b6-1d5fd859dd71",
            "title": "828.mp3",
            "timestamp": "2018-03-19T17:52:21-05:00"
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
        "total": 601,
        "limit": 2,
        "offset": 0,
        "total_pages": 301,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data.artic.edu\/api\/v1\/texts?page=2&limit=2"
    },
    "data": [
        {
            "id": "16326618-b988-b9ab-b510-573c0b0a011f",
            "title": "Artist Biography: Gustave Caillebotte",
            "lake_guid": "16326618-b988-b9ab-b510-573c0b0a011f",
            "is_boosted": false,
            "thumbnail": null,
            "type": "text",
            ...
        },
        {
            "id": "26a0c842-0b93-37e5-d95f-15bd45f8be91",
            "title": "Examination: Seurat's Artistic Process for <em>A Sunday on La Grande Jatte<\/em>",
            "lake_guid": "26a0c842-0b93-37e5-d95f-15bd45f8be91",
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
        "total": 601,
        "limit": 10,
        "offset": 0,
        "total_pages": 61,
        "current_page": 1
    },
    "data": [
        {
            "_score": 2,
            "api_id": "00b9fbb1-0548-9f4c-e269-ebf702490f4c",
            "thumbnail": null,
            "api_model": "texts",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/texts\/00b9fbb1-0548-9f4c-e269-ebf702490f4c",
            "id": "00b9fbb1-0548-9f4c-e269-ebf702490f4c",
            "title": "Related Story: READ Duchamp in His Own Words",
            "timestamp": "2018-03-19T17:52:25-05:00"
        },
        {
            "_score": 2,
            "api_id": "049c9547-d585-c8d5-1070-93e83b0dfb89",
            "thumbnail": null,
            "api_model": "texts",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/texts\/049c9547-d585-c8d5-1070-93e83b0dfb89",
            "id": "049c9547-d585-c8d5-1070-93e83b0dfb89",
            "title": "Monet's Water Garden",
            "timestamp": "2018-03-19T17:52:25-05:00"
        },
        {
            "_score": 2,
            "api_id": "05873879-a659-bca6-a9be-5eec6460c09f",
            "thumbnail": null,
            "api_model": "texts",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/texts\/05873879-a659-bca6-a9be-5eec6460c09f",
            "id": "05873879-a659-bca6-a9be-5eec6460c09f",
            "title": "Related Story: Antioch and Early Christianity ",
            "timestamp": "2018-03-19T17:52:25-05:00"
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
            "id": 2,
            "title": "Accessories",
            "is_boosted": false,
            "thumbnail": null,
            "web_url": "http:\/\/www.artinstituteshop.org\/browse.aspx?catID=2",
            "parent_id": 3,
            ...
        },
        {
            "id": 3,
            "title": "Scarves",
            "is_boosted": false,
            "thumbnail": null,
            "web_url": "http:\/\/www.artinstituteshop.org\/browse.aspx?catID=3",
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
            "_score": 2,
            "api_id": "14",
            "thumbnail": null,
            "api_model": "shop-categories",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/shop-categories\/14",
            "id": 14,
            "title": "Fountains",
            "timestamp": "2018-03-19T17:52:34-05:00"
        },
        {
            "_score": 2,
            "api_id": "19",
            "thumbnail": null,
            "api_model": "shop-categories",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/shop-categories\/19",
            "id": 19,
            "title": "Tabletop",
            "timestamp": "2018-03-19T17:52:34-05:00"
        },
        {
            "_score": 2,
            "api_id": "22",
            "thumbnail": null,
            "api_model": "shop-categories",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/shop-categories\/22",
            "id": 22,
            "title": "Holiday Ornaments",
            "timestamp": "2018-03-19T17:52:34-05:00"
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
        "total": 5916,
        "limit": 2,
        "offset": 0,
        "total_pages": 2958,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data.artic.edu\/api\/v1\/products?page=2&limit=2"
    },
    "data": [
        {
            "id": 7049,
            "title": "Watercolor Silk Scarf-Pink\/Purple",
            "is_boosted": false,
            "thumbnail": null,
            "title_sort": null,
            "parent_id": null,
            ...
        },
        {
            "id": 7306,
            "title": "Driftwood Necklace",
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
        "total": 5916,
        "limit": 10,
        "offset": 0,
        "total_pages": 592,
        "current_page": 1
    },
    "data": [
        {
            "_score": 2,
            "api_id": "1128",
            "thumbnail": null,
            "api_model": "products",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/products\/1128",
            "id": 1128,
            "title": "Italian Glass Flower",
            "timestamp": "2018-03-19T17:52:35-05:00"
        },
        {
            "_score": 2,
            "api_id": "1136",
            "thumbnail": null,
            "api_model": "products",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/products\/1136",
            "id": 1136,
            "title": " Kandinsky Glass Panel",
            "timestamp": "2018-03-19T17:52:35-05:00"
        },
        {
            "_score": 2,
            "api_id": "1145",
            "thumbnail": null,
            "api_model": "products",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/products\/1145",
            "id": 1145,
            "title": "Modern Masters Boxed Notecards",
            "timestamp": "2018-03-19T17:52:35-05:00"
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
        "total": 1797,
        "limit": 2,
        "offset": 0,
        "total_pages": 899,
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
        "total": 1797,
        "limit": 10,
        "offset": 0,
        "total_pages": 180,
        "current_page": 1
    },
    "data": [
        {
            "_score": 2,
            "api_id": "717297",
            "thumbnail": null,
            "api_model": "legacy-events",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/legacy-events\/717297",
            "id": 717297,
            "title": "Gallery Talk: Modern Wing Highlights",
            "timestamp": "2018-03-19T17:52:42-05:00"
        },
        {
            "_score": 2,
            "api_id": "719696",
            "thumbnail": null,
            "api_model": "legacy-events",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/legacy-events\/719696",
            "id": 719696,
            "title": "Gallery Talk: Modern Wing Highlights",
            "timestamp": "2018-03-19T17:52:42-05:00"
        },
        {
            "_score": 2,
            "api_id": "726917",
            "thumbnail": null,
            "api_model": "legacy-events",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/legacy-events\/726917",
            "id": 726917,
            "title": "Gallery Talk: Modern Wing Highlights",
            "timestamp": "2018-03-19T17:52:42-05:00"
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
            "id": 2352,
            "title": "Visions of America",
            "is_boosted": false,
            "thumbnail": null,
            "image": "http:\/\/aic-mobile-tours.artic.edu\/sites\/default\/files\/tour-images\/The%20Freedman.jpg",
            "description": "Inspired by the hit musical Hamilton, explore America now, through America&nbsp;then.&nbsp;",
            ...
        },
        {
            "id": 2193,
            "title": "The Essentials Tour",
            "is_boosted": false,
            "thumbnail": null,
            "image": "http:\/\/aic-mobile-tours.artic.edu\/sites\/default\/files\/tour-images\/Rainy_Day%20copy.jpg",
            "description": "Discover the stories behind some of the museum\u2019s most iconic artworks.",
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
            "_score": 2,
            "api_id": "2193",
            "thumbnail": null,
            "api_model": "tours",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/tours\/2193",
            "id": 2193,
            "title": "The Essentials Tour",
            "timestamp": "2018-03-19T17:52:45-05:00"
        },
        {
            "_score": 2,
            "api_id": "2220",
            "thumbnail": null,
            "api_model": "tours",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/tours\/2220",
            "id": 2220,
            "title": "\u7cbe\u534e\u6e38",
            "timestamp": "2018-03-19T17:52:45-05:00"
        },
        {
            "_score": 2,
            "api_id": "1022",
            "thumbnail": null,
            "api_model": "tours",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/tours\/1022",
            "id": 1022,
            "title": "The New Contemporary",
            "timestamp": "2018-03-19T17:52:45-05:00"
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
            "id": 3243,
            "title": "E-12: English Drawing Room of the Georgian Period, c. 1800",
            "is_boosted": false,
            "thumbnail": null,
            "artwork_title": "E-12: English Drawing Room of the Georgian Period, c. 1800",
            "artwork_id": 43721,
            ...
        },
        {
            "id": 3304,
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

### `/tour-stops/search`

Search tour-stops data in the aggregator. 

#### Available parameters:

* `q` - Your search query
* `query` - For complex queries, you can pass Elasticsearch domain syntax queries here
* `sort` - Used in conjunction with `query`
* `from` - Starting point of results. Pagination via Elasticsearch conventions
* `size` - Number of results to return. Pagination via Elasticsearch conventions
* `facets` - A comma-separated list of \"count\" aggregation facets to include in the results.

Example request: http://aggregator-data.artic.edu/api/v1/tour-stops/search  
Example output:

```
{
    "preference": null,
    "pagination": {
        "total": 315,
        "limit": 10,
        "offset": 0,
        "total_pages": 32,
        "current_page": 1
    },
    "data": [
        {
            "_score": 2,
            "api_id": "2678",
            "thumbnail": null,
            "api_model": "tour-stops",
            "is_boosted": false,
            "api_link": "http:\/\/localhost\/api\/v1\/tour-stops\/2678",
            "id": 2678,
            "title": "Stacks of Wheat (End of Day, Autumn)",
            "timestamp": "2018-03-16T15:47:57-05:00"
        },
        {
            "_score": 2,
            "api_id": "2680",
            "thumbnail": null,
            "api_model": "tour-stops",
            "is_boosted": false,
            "api_link": "http:\/\/localhost\/api\/v1\/tour-stops\/2680",
            "id": 2680,
            "title": "Coronation Stone of Motecuhzoma II (Stone of the Five Suns)",
            "timestamp": "2018-03-16T15:47:57-05:00"
        },
        {
            "_score": 2,
            "api_id": "2681",
            "thumbnail": null,
            "api_model": "tour-stops",
            "is_boosted": false,
            "api_link": "http:\/\/localhost\/api\/v1\/tour-stops\/2681",
            "id": 2681,
            "title": "Veranda Post of Enthroned King and Senior Wife (Opo Ogoga)",
            "timestamp": "2018-03-16T15:47:57-05:00"
        }
    ]
}
```

### `/tour-stops/{id}`

A single tour-stop by the given identifier.

Example request: http://aggregator-data.artic.edu/api/v1/tour-stops/3245?limit=2  
Example output:

```
{
    "data": {
        "id": 3245,
        "title": "Portrait of Mrs. James Ward Thorne",
        "is_boosted": false,
        "thumbnail": null,
        "artwork_title": "Portrait of Mrs. James Ward Thorne",
        "artwork_id": 32088,
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
        "total": 610,
        "limit": 2,
        "offset": 0,
        "total_pages": 305,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data.artic.edu\/api\/v1\/mobile-sounds?page=2&limit=2"
    },
    "data": [
        {
            "id": 4060,
            "title": "01 VoA After Intro",
            "is_boosted": false,
            "thumbnail": null,
            "link": "http:\/\/aic-mobile-tours.artic.edu\/sites\/default\/files\/audio\/01_VoA_After_Intro.mp3",
            "transcript": null,
            ...
        },
        {
            "id": 4061,
            "title": "02 VoA After Punchbowl",
            "is_boosted": false,
            "thumbnail": null,
            "link": "http:\/\/aic-mobile-tours.artic.edu\/sites\/default\/files\/audio\/02_VoA_After_Punchbowl.mp3",
            "transcript": null,
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
            "_score": 2,
            "api_id": "140019",
            "thumbnail": null,
            "api_model": "publications",
            "is_boosted": false,
            "api_link": "http:\/\/localhost\/api\/v1\/publications\/140019",
            "id": 140019,
            "title": "Manet Paintings and Works on Paper at the Art Institute of Chicago",
            "timestamp": "2018-03-17T23:00:55-05:00"
        },
        {
            "_score": 2,
            "api_id": "12",
            "thumbnail": null,
            "api_model": "publications",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/publications\/12",
            "id": 12,
            "title": "The Modern Series at the Art Institute of Chicago",
            "timestamp": "2018-03-19T17:52:45-05:00"
        },
        {
            "_score": 2,
            "api_id": "226",
            "thumbnail": null,
            "api_model": "publications",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/publications\/226",
            "id": 226,
            "title": "James Ensor: The Temptation of Saint Anthony",
            "timestamp": "2018-03-19T17:52:45-05:00"
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
            "_score": 2,
            "api_id": "338",
            "thumbnail": null,
            "api_model": "sections",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/sections\/338",
            "id": 338,
            "title": "Modern Series Title",
            "timestamp": "2018-03-19T17:52:45-05:00"
        },
        {
            "_score": 2,
            "api_id": "343",
            "thumbnail": null,
            "api_model": "sections",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/sections\/343",
            "id": 343,
            "title": "Cat. 6  Tinker with His Tools, 1874\/76",
            "timestamp": "2018-03-19T17:52:45-05:00"
        },
        {
            "_score": 2,
            "api_id": "365",
            "thumbnail": null,
            "api_model": "sections",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/sections\/365",
            "id": 365,
            "title": "How to use This Catalogue",
            "timestamp": "2018-03-19T17:52:45-05:00"
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
            "id": 42,
            "title": "Beyond Golden Clouds: Japanese Screens from the Art Institute of Chicago and the Saint Louis Art Museum",
            "is_boosted": false,
            "thumbnail": null,
            "description": "Japanese folding screens have captivated the imagination of the West since the 16th century, when Europeans had their first glimpse. Across their expansive decorative surfaces, the realities and imaginations of artists over hundreds of years have been charted with bright mineral pigments and precious gold and silver. More so than smaller painting formats, the screen is the canvas upon which artists have historically realized their most expansive visions, which is why they are so often career-defining masterpieces. Beyond Golden Clouds celebrates the full range of the screen format, made possible by the collaboration of the Art Institute and the Saint Louis Art Museum. Unique among past shows, this exhibition displays works dating from as early as the 16th century to contemporary screens of the past decade, and features various media, including traditional paper and silk as well as stoneware and varnish. The exhibition, which will be shown at both museums, includes a total of 32 works of art. During the week of August 10\u201314, several works in the exhibition will be rotated out and replaced by others, offering the chance to experience the exhibition anew.",
            "web_url": "http:\/\/archive.artic.edu\/beyondgoldenclouds\/",
            ...
        },
        {
            "id": 43,
            "title": "Henri Cartier-Bresson: The Modern Century",
            "is_boosted": false,
            "thumbnail": null,
            "description": "The two most important developments in photography in the first half of the 20th century were the emergence of lasting artistic traditions and the rise of mass-circulation picture magazines. Henri Cartier-Bresson (1908\u20132004) was a leading figure in both domains. In the early 1930s, he helped to define photographic modernism, using a handheld camera to snatch beguiling images from fleeting moments of everyday life. After World War II, he turned to photojournalism, and the magic and mystery of his early work gave way to an equally uncanny clarity and completeness.",
            "web_url": "http:\/\/archive.artic.edu\/cartier-bresson\/",
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
            "_score": 2,
            "api_id": "14",
            "thumbnail": null,
            "api_model": "sites",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/sites\/14",
            "id": 14,
            "title": "The Medici, Michelangelo, and the Art of Late Renaissance Florence",
            "timestamp": "2018-03-19T17:52:48-05:00"
        },
        {
            "_score": 2,
            "api_id": "19",
            "thumbnail": null,
            "api_model": "sites",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/sites\/19",
            "id": 19,
            "title": "Perpetual Glory: Medieval Islamic Ceramics from the Harvey B. Plotnick Collection",
            "timestamp": "2018-03-19T17:52:49-05:00"
        },
        {
            "_score": 2,
            "api_id": "22",
            "thumbnail": null,
            "api_model": "sites",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data.artic.edu\/api\/v1\/sites\/22",
            "id": 22,
            "title": "Seurat and the Making of \"La Grande Jatte\"",
            "timestamp": "2018-03-19T17:52:49-05:00"
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
            "id": "01ARTIC_ALMA2122459140003801",
            "title": "Handbook of embroidery",
            "date": 1880,
            "creators": [
                {
                    "id": "nb2011029156",
                    "uri": "http:\/\/id.loc.gov\/authorities\/names\/nb2011029156",
                    "title": "Alford, Marian"
                }
            ],
            "subjects": [
                {
                    "id": "sh85042701",
                    "uri": "http:\/\/id.loc.gov\/authorities\/subjects\/sh85042701",
                    "title": "Embroidery"
                }
            ],
            ...
        },
        {
            "id": "01ARTIC_ALMA2122470490003801",
            "title": "Vom Kubismus : die Mittel zu Seinem Verst\u00e4ndnis",
            "date": 1922,
            "creators": [
                {
                    "id": "n81013211",
                    "uri": "http:\/\/id.loc.gov\/authorities\/names\/n81013211",
                    "title": "Gleizes, Albert"
                }
            ],
            "subjects": [
                {
                    "id": "sh85034652",
                    "uri": "http:\/\/id.loc.gov\/authorities\/subjects\/sh85034652",
                    "title": "Cubism -- Periodicals"
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
            "id": "01ARTIC_ALMA2122459140003801",
            "title": "Handbook of embroidery",
            "date": 1880,
            "creators": [
                {
                    "id": "nb2011029156",
                    "uri": "http:\/\/id.loc.gov\/authorities\/names\/nb2011029156",
                    "title": "Alford, Marian"
                }
            ],
            "subjects": [
                {
                    "id": "sh85042701",
                    "uri": "http:\/\/id.loc.gov\/authorities\/subjects\/sh85042701",
                    "title": "Embroidery"
                }
            ],
            ...
        },
        {
            "id": "01ARTIC_ALMA2122470490003801",
            "title": "Vom Kubismus : die Mittel zu Seinem Verst\u00e4ndnis",
            "date": 1922,
            "creators": [
                {
                    "id": "n81013211",
                    "uri": "http:\/\/id.loc.gov\/authorities\/names\/n81013211",
                    "title": "Gleizes, Albert"
                }
            ],
            "subjects": [
                {
                    "id": "sh85034652",
                    "uri": "http:\/\/id.loc.gov\/authorities\/subjects\/sh85034652",
                    "title": "Cubism -- Periodicals"
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
            "id": "sh2008113839",
            "uri": "http:\/\/id.loc.gov\/authorities\/subjects\/sh2008113839",
            "title": "World War, 1914-1918 -- Pictorial works",
            ...
        },
        {
            "id": "sh85127802",
            "uri": "http:\/\/id.loc.gov\/authorities\/subjects\/sh85127802",
            "title": "Steel, Structural -- Catalogs",
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
            "id": "sh2008113839",
            "uri": "http:\/\/id.loc.gov\/authorities\/subjects\/sh2008113839",
            "title": "World War, 1914-1918 -- Pictorial works",
            ...
        },
        {
            "id": "sh85127802",
            "uri": "http:\/\/id.loc.gov\/authorities\/subjects\/sh85127802",
            "title": "Steel, Structural -- Catalogs",
            ...
        }
    ]
}
```

> Generated by `php artisan docs:endpoints` on 2018-03-30 16:29:37
