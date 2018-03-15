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
        "total": 106531,
        "limit": 2,
        "offset": 0,
        "total_pages": 53266,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/artworks?page=2&limit=2"
    },
    "data": [
        {
            "id": 111380,
            "title": "Seated Bodhisattva",
            "lake_guid": "7f35d0ca-0059-f9fd-88d6-e578bd3e0739",
            "is_boosted": true,
            "thumbnail": {
                "url": "https:\/\/lakeimagesweb.artic.edu\/iiif\/2\/8425e900-2940-ebbe-a2b3-d0406073778f",
                "type": "iiif",
                "lqip": "data:image\/gif;base64,R0lGODlhBAAFAPQAAE9QUFBQUWdZTGlcUWtoZm5san95c398e5B\/bIJ7dYt\/c4OAfoSCgJuTjKKak6iqq7q6ub\/AwQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAAAAAAALAAAAAAEAAUAAAURIFAQweM0D4Qo0SEMzJIYTAgAOw==",
                "width": 1776,
                "height": 2250
            },
            "alt_titles": [],
            ...
        },
        {
            "id": 107300,
            "title": "Tall-Case Clock",
            "lake_guid": "7b854b17-ab7a-0539-458e-ffa0b30e6815",
            "is_boosted": true,
            "thumbnail": {
                "url": "https:\/\/lakeimagesweb.artic.edu\/iiif\/2\/76d1e99c-43ab-82a3-1d47-53d95d2a1921",
                "type": "iiif",
                "lqip": "data:image\/gif;base64,R0lGODlhBAAFAPQAADAvMC8wMTU2OTU4PTg6Pjk7QTk8QEBCR0hKTEtMTlVMR1lSTmRXRWxhVGphWGhhWnpsXnttXoB1bYB1bgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAAAAAAALAAAAAAEAAUAAAURIKAsgQBNhBFJx8A0ReI8SAgAOw==",
                "width": 1775,
                "height": 2250
            },
            "alt_titles": [],
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
            "id": 111380,
            "title": "Seated Bodhisattva",
            "lake_guid": "7f35d0ca-0059-f9fd-88d6-e578bd3e0739",
            "is_boosted": true,
            "thumbnail": {
                "url": "https:\/\/lakeimagesweb.artic.edu\/iiif\/2\/8425e900-2940-ebbe-a2b3-d0406073778f",
                "type": "iiif",
                "lqip": "data:image\/gif;base64,R0lGODlhBAAFAPQAAE9QUFBQUWdZTGlcUWtoZm5san95c398e5B\/bIJ7dYt\/c4OAfoSCgJuTjKKak6iqq7q6ub\/AwQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAAAAAAALAAAAAAEAAUAAAURIFAQweM0D4Qo0SEMzJIYTAgAOw==",
                "width": 1776,
                "height": 2250
            },
            "alt_titles": [],
            ...
        },
        {
            "id": 107300,
            "title": "Tall-Case Clock",
            "lake_guid": "7b854b17-ab7a-0539-458e-ffa0b30e6815",
            "is_boosted": true,
            "thumbnail": {
                "url": "https:\/\/lakeimagesweb.artic.edu\/iiif\/2\/76d1e99c-43ab-82a3-1d47-53d95d2a1921",
                "type": "iiif",
                "lqip": "data:image\/gif;base64,R0lGODlhBAAFAPQAADAvMC8wMTU2OTU4PTg6Pjk7QTk8QEBCR0hKTEtMTlVMR1lSTmRXRWxhVGphWGhhWnpsXnttXoB1bYB1bgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAAAAAAALAAAAAAEAAUAAAURIKAsgQBNhBFJx8A0ReI8SAgAOw==",
                "width": 1775,
                "height": 2250
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
* `facets` - A comma-separated list of "count" aggregation facets to include in the results.

Example request: http://aggregator-data-test.artic.edu/api/v1/artworks/search?q=monet  
Example output:

```
{
    "preference": null,
    "pagination": {
        "total": 334,
        "limit": 10,
        "offset": 0,
        "total_pages": 34,
        "current_page": 1
    },
    "data": [
        {
            "_score": 15.363219,
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
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/artworks\/64818",
            "id": 64818,
            "title": "Stacks of Wheat (End of Summer)",
            "timestamp": "2018-03-14T18:40:36-05:00"
        },
        {
            "_score": 15.265642,
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
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/artworks\/14598",
            "id": 14598,
            "title": "The Beach at Sainte-Adresse",
            "timestamp": "2018-03-14T18:27:44-05:00"
        },
        {
            "_score": 13.138819,
            "api_id": "44892",
            "thumbnail": {
                "width": null,
                "type": "iiif",
                "url": "https:\/\/lakeimagesweb.artic.edu\/iiif\/2\/4b15ce06-46cb-93d0-417b-ef84469c0811",
                "lqip": "data:image\/gif;base64,R0lGODlhBgAFAPQAABwUEi8kGSslHysmHzMmHjUpHzYpHj0oHDcuJUg+N1pALktAM1dOP1tPPVhPP29gT39tV3x2aIpoVo11YJGKZJuPfp+NfJ+YfKWfiLCih7Koja2mlrStlr2pkwAAAAAAACH5BAAAAAAALAAAAAAGAAUAAAUYYGAgwlAsDgMcxCN1ltJAU7VdVKZxWJSEADs=",
                "height": null
            },
            "api_model": "artworks",
            "is_boosted": true,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/artworks\/44892",
            "id": 44892,
            "title": "Fish (Still Life)",
            "timestamp": "2018-03-14T18:35:36-05:00"
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
            "thumbnail": null,
            "sort_title": "Hopper, Edward",
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

Example request: http://aggregator-data-test.artic.edu/api/v1/artworks/111628/images?limit=2  
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
        },
        {
            "id": "e2193e3c-80dd-386e-0ae3-a0d11883d367",
            "title": "01. <em>Fifty-third Annual Exhibition of American Paintings and Sculpture<\/em>, Plate VII",
            "lake_guid": "e2193e3c-80dd-386e-0ae3-a0d11883d367",
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
        "total": 12242,
        "limit": 2,
        "offset": 0,
        "total_pages": 6121,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/agents?page=2&limit=2"
    },
    "data": [
        {
            "id": 30723,
            "title": "Jean Baptiste Sim\u00e9on Chardin",
            "lake_guid": "9cd5b353-3ed0-2d78-26e3-dd0b98138a31",
            "is_boosted": true,
            "thumbnail": null,
            "sort_title": "Chardin, Jean Baptiste Sim\u00e9on",
            ...
        },
        {
            "id": 44812,
            "title": "Lee Krasner",
            "lake_guid": "45e08914-a055-069b-8076-a93b4b56c433",
            "is_boosted": true,
            "thumbnail": null,
            "sort_title": "Krasner, Lee",
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
            "id": 30723,
            "title": "Jean Baptiste Sim\u00e9on Chardin",
            "lake_guid": "9cd5b353-3ed0-2d78-26e3-dd0b98138a31",
            "is_boosted": true,
            "thumbnail": null,
            "sort_title": "Chardin, Jean Baptiste Sim\u00e9on",
            ...
        },
        {
            "id": 44812,
            "title": "Lee Krasner",
            "lake_guid": "45e08914-a055-069b-8076-a93b4b56c433",
            "is_boosted": true,
            "thumbnail": null,
            "sort_title": "Krasner, Lee",
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
        "total": 12235,
        "limit": 10,
        "offset": 0,
        "total_pages": 1224,
        "current_page": 1
    },
    "data": [
        {
            "_score": 5.755949,
            "api_id": "34316",
            "thumbnail": null,
            "api_model": "agents",
            "is_boosted": true,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/agents\/34316",
            "id": 34316,
            "title": "Marcel Duchamp",
            "timestamp": "2018-03-14T18:24:07-05:00"
        },
        {
            "_score": 5.755949,
            "api_id": "34946",
            "thumbnail": null,
            "api_model": "agents",
            "is_boosted": true,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/agents\/34946",
            "id": 34946,
            "title": "Utagawa Hiroshige",
            "timestamp": "2018-03-14T18:24:08-05:00"
        },
        {
            "_score": 5.755949,
            "api_id": "33376",
            "thumbnail": null,
            "api_model": "agents",
            "is_boosted": true,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/agents\/33376",
            "id": 33376,
            "title": "Ivan Albright",
            "timestamp": "2018-03-14T18:24:05-05:00"
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
        "total": 12242,
        "limit": 2,
        "offset": 0,
        "total_pages": 6121,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/agents?page=2&limit=2"
    },
    "data": [
        {
            "id": 30723,
            "title": "Jean Baptiste Sim\u00e9on Chardin",
            "lake_guid": "9cd5b353-3ed0-2d78-26e3-dd0b98138a31",
            "is_boosted": true,
            "thumbnail": null,
            "sort_title": "Chardin, Jean Baptiste Sim\u00e9on",
            ...
        },
        {
            "id": 44812,
            "title": "Lee Krasner",
            "lake_guid": "45e08914-a055-069b-8076-a93b4b56c433",
            "is_boosted": true,
            "thumbnail": null,
            "sort_title": "Krasner, Lee",
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
            "api_id": "PC-1",
            "thumbnail": null,
            "api_model": "categories",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/categories\/PC-1",
            "id": "PC-1",
            "title": "African",
            "timestamp": "2018-03-14T19:14:09-05:00"
        },
        {
            "_score": 2,
            "api_id": "PC-10",
            "thumbnail": null,
            "api_model": "categories",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/categories\/PC-10",
            "id": "PC-10",
            "title": "European Painting and Sculpture",
            "timestamp": "2018-03-14T19:14:09-05:00"
        },
        {
            "_score": 2,
            "api_id": "PC-103",
            "thumbnail": null,
            "api_model": "categories",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/categories\/PC-103",
            "id": "PC-103",
            "title": "Japanese",
            "timestamp": "2018-03-14T19:14:09-05:00"
        }
    ]
}
```

### `/categories/{id}`

A single categories by the given identifier. {id} is the identifier from our collections managements system.

Example request: http://aggregator-data-test.artic.edu/api/v1/categories/PC-3?limit=2  
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

Example request: http://aggregator-data-test.artic.edu/api/v1/places?limit=2  
Example output:

```
{
    "pagination": {
        "total": 12887,
        "limit": 2,
        "offset": 0,
        "total_pages": 6444,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/places?page=2&limit=2"
    },
    "data": [
        {
            "id": 29030,
            "title": "Red rolled unit, top shelf",
            "lake_guid": "659d7803-2e57-10d1-af0c-e85e190c2bca",
            "is_boosted": false,
            "thumbnail": null,
            "type": "AIC Storage",
            ...
        },
        {
            "id": 6386,
            "title": "above freezer vertical bin 001",
            "lake_guid": "89e32333-ca54-5536-ee46-61e86bc2fd61",
            "is_boosted": false,
            "thumbnail": null,
            "type": "AIC Storage",
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
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/places\/-2147480450",
            "id": -2147480450,
            "title": "El Paso",
            "timestamp": "2018-03-14T19:14:38-05:00"
        },
        {
            "_score": 2,
            "api_id": "-2147480439",
            "thumbnail": null,
            "api_model": "places",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/places\/-2147480439",
            "id": -2147480439,
            "title": "San Diego",
            "timestamp": "2018-03-14T19:14:38-05:00"
        },
        {
            "_score": 2,
            "api_id": "-2147480407",
            "thumbnail": null,
            "api_model": "places",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/places\/-2147480407",
            "id": -2147480407,
            "title": "Jouy-en-Josas",
            "timestamp": "2018-03-14T19:14:38-05:00"
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
            "id": 2147478131,
            "title": "Gallery 104",
            "lake_guid": "e4860b90-d219-94a5-a601-c1d8388554df",
            "is_boosted": false,
            "thumbnail": null,
            "type": "AIC Gallery",
            ...
        },
        {
            "id": 25288,
            "title": "Gallery 233",
            "lake_guid": "5201ff15-03fc-a77b-5899-ad7c21964e89",
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
            "api_id": "2704",
            "thumbnail": null,
            "api_model": "galleries",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/galleries\/2704",
            "id": 2704,
            "title": "Textile Seminar (TE055)",
            "timestamp": "2018-03-14T19:14:56-05:00"
        },
        {
            "_score": 2,
            "api_id": "21434",
            "thumbnail": null,
            "api_model": "galleries",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/galleries\/21434",
            "id": 21434,
            "title": "Gallery 273",
            "timestamp": "2018-03-14T19:14:56-05:00"
        },
        {
            "_score": 2,
            "api_id": "21638",
            "thumbnail": null,
            "api_model": "galleries",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/galleries\/21638",
            "id": 21638,
            "title": "Museum Caf\u00e9",
            "timestamp": "2018-03-14T19:14:56-05:00"
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
            "id": 2663,
            "title": "Charles White: A Retrospective",
            "lake_guid": "2d8d829e-1d2f-d70e-e862-7134a9c06e5b",
            "is_boosted": false,
            "thumbnail": null,
            "description": "Charles White (1918\u20131979) powerfully interpreted African American history, culture, and lives over the course of his four-decade career.&nbsp; A superbly gifted draftsman and printmaker as well as a talented mural and easel painter, he developed a distinctive and labor-intensive approach to art making and remained committed to a representational style at a time when the art world increasingly favored abstraction. His work magnified the power of the black figure through scale and form, communicating universal human themes while also focusing attention on the lives of African Americans and the struggle for equality. This exhibition\u2014the first major retrospective of White\u2019s work in more than 35 years\u2014showcases a gifted and influential artist whose work continues to resonate amid today\u2019s national dialogues about race, work, equality and history.Born in Chicago and educated at the School of the Art Institute, White was part of the city\u2019s flourishing black artistic community of the 1930s. He was determined to employ art in the struggle for social change, declaring, \u201cPaint is the only weapon I have with which to fight what I resent.\u201d Influenced by Mexican muralists such as Diego Rivera, White completed several important mural commissions in the city, including one for a branch of the Chicago Public Library.&nbsp;White married sculptor Elizabeth Catlett in 1941, and the couple soon settled in New York. Together they traveled to Mexico City, where White honed his printmaking skills as part of the printmaking collective known as the Taller de Gr\u00e1fica Popular. In New York in the 1940s and early 1950s, White showed his work at the progressive ACA Gallery and was a prominent member of African American and leftist artist communities.&nbsp;White moved to Southern California in 1956, and his career flourished as he embraced drawing and printmaking more fully, pushing at the boundaries of his media while continuing to engage with civil rights and equality. Despite his rejection of the prevailing style of Abstract Expressionism and ongoing use of an expressive figuration, he found critical acclaim in the United States and abroad.&nbsp;Charles White: A Retrospective unites a selection of White\u2019s finest paintings, drawings, and prints, presenting the full breadth of his work and demonstrating his artistic development. The themes he explored\u2014African American history and the fight for freedom, the nobility of black people, and the dignity of labor and human nature\u2014reveal his talent and passion, and encourage viewers to consider current questions of history, politics, and identity in relation to the recent past.&nbsp;",
            ...
        },
        {
            "id": 257,
            "title": "Utamaro: Aspects of Beauty",
            "lake_guid": "37d8b387-7505-c981-3378-d7b85ae624a5",
            "is_boosted": false,
            "thumbnail": null,
            "description": "Chosen from among approximately 300 works by Kitagawa Utamaro (c. 1753\u20131806) in the Art Institute\u2019s collection, this exhibition highlights some of the artist\u2019s most celebrated prints. It was Utamaro who gave us close-up portraits of beauties with pensive expressions, scenes of women engaged in everyday activities such as cooking, and images of women of every age against backgrounds that range from gray to yellow to brilliant (and luminescent) mica of various shades. Examples of each of these types of prints as well as illustrated books are on view.",
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
            "api_id": "73",
            "thumbnail": null,
            "api_model": "exhibitions",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/exhibitions\/73",
            "id": 73,
            "title": "Focus: Michael Asher",
            "timestamp": "2018-03-14T19:14:10-05:00"
        },
        {
            "_score": 2,
            "api_id": "84",
            "thumbnail": null,
            "api_model": "exhibitions",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/exhibitions\/84",
            "id": 84,
            "title": "On the Scene: Jessica Rowe, Jason Salavon, Brian Ulrich",
            "timestamp": "2018-03-14T19:14:10-05:00"
        },
        {
            "_score": 2,
            "api_id": "105",
            "thumbnail": null,
            "api_model": "exhibitions",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/exhibitions\/105",
            "id": 105,
            "title": "Yokohama-e: Nineteenth Century Prints of Americans in Japan",
            "timestamp": "2018-03-14T19:14:10-05:00"
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
        "thumbnail": null,
        "description": "Were the Impressionists fashionistas? And what role did fashion play in their goal to paint modern life with a \u201cmodern\u201d style? This is the subject of the internationally acclaimed exhibition Impressionism, Fashion, and Modernity, the first to uncover the fascinating relationship between art and fashion from the mid-1860s through the mid-1880s as Paris became the style capital of the world. Featuring 75 major figure paintings by Caillebotte, Degas, Manet, Monet, Renoir, and Seurat, including many never before seen in North America, this stylish show presents a new perspective on the Impressionists\u2014revealing how these early avant-garde artists embraced fashion trends as they sought to capture modern life on canvas.\n\nIn the second half of the 19th century, the modern fashion industry was born: designers like Charles Frederick Worth were transforming how clothing was made and marketed, department stores were on the rise, and fashion magazines were beginning to proliferate. Visual artists and writers alike were intrigued by this new industry; its dynamic, ephemeral, and constantly innovative qualities embodied the very essence of modernity that they sought to express in their work and offered a means of discovering new visual and verbal expressions.\n\nThis groundbreaking exhibition explores the vital relationship between fashion and art during these pivotal years not only through the masterworks by Impressionists but also with paintings by fashion portraitists Jean B\u00e9raud, Carolus-Duran, Alfred Stevens, and James Tissot. Period costumes such as men\u2019s suits, robes de promenade, day dresses, and ball gowns, along with fashion plates, photographs, and popular prints offer a firsthand look at the apparel these artists used to convey their modernity as well as that of their subjects. Further enriching the display are fabrics and accessories\u2014lace, silks, velvets, and satins found in hats, parasols, gloves, and shoes\u2014recreating the sensory experience that made fashion an industry favorite and a serious subject among painters, writers, poets, and the popular press.\n\nTruly bringing the exhibition to life are the vivid connections between the most up-to-the-minute fashions and the painted transformations of the same styles. Pairing life-size figure paintings by Monet, Renoir, or Tissot with the contemporary outfits that inspired them, the show invites inquiry into the difference between portrait and genre painting, between Tissot\u2019s painted fashion plates and Manet\u2019s images of life experienced, demonstrating for the first time the means by which the Impressionists \u201cfashioned\u201d their models\u2014and paintings\u2014for larger artistic goals.",
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
        "total": 110922,
        "limit": 2,
        "offset": 0,
        "total_pages": 55461,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/images?page=2&limit=2"
    },
    "data": [
        {
            "id": "036ef5c5-17bd-a788-7b61-7cf1c43005f0",
            "title": "Photograph: Interior Vew of Atrium in River City II, c. 1986.",
            "lake_guid": "036ef5c5-17bd-a788-7b61-7cf1c43005f0",
            "is_boosted": false,
            "thumbnail": null,
            "type": "image",
            ...
        },
        {
            "id": "0ac65ee8-ee18-8a91-3a24-24453d56e4f1",
            "title": "G29269",
            "lake_guid": "0ac65ee8-ee18-8a91-3a24-24453d56e4f1",
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
* `facets` - A comma-separated list of "count" aggregation facets to include in the results.

Example request: http://aggregator-data-test.artic.edu/api/v1/images/search  
Example output:

```
{
    "preference": null,
    "pagination": {
        "total": 110922,
        "limit": 10,
        "offset": 0,
        "total_pages": 11093,
        "current_page": 1
    },
    "data": [
        {
            "_score": 2,
            "api_id": "013028c8-0727-07c9-ab17-94cd54516034",
            "thumbnail": null,
            "api_model": "images",
            "is_boosted": false,
            "api_link": "http:\/\/localhost\/api\/v1\/images\/013028c8-0727-07c9-ab17-94cd54516034",
            "id": "013028c8-0727-07c9-ab17-94cd54516034",
            "title": "102608",
            "timestamp": "2018-03-14T20:42:55-05:00"
        },
        {
            "_score": 2,
            "api_id": "0136ad39-90c7-280c-19ef-0f51dee23ba5",
            "thumbnail": null,
            "api_model": "images",
            "is_boosted": false,
            "api_link": "http:\/\/localhost\/api\/v1\/images\/0136ad39-90c7-280c-19ef-0f51dee23ba5",
            "id": "0136ad39-90c7-280c-19ef-0f51dee23ba5",
            "title": "PH_01223",
            "timestamp": "2018-03-14T20:42:55-05:00"
        },
        {
            "_score": 2,
            "api_id": "0137b770-8c81-5aba-1df6-a1373d997a17",
            "thumbnail": null,
            "api_model": "images",
            "is_boosted": false,
            "api_link": "http:\/\/localhost\/api\/v1\/images\/0137b770-8c81-5aba-1df6-a1373d997a17",
            "id": "0137b770-8c81-5aba-1df6-a1373d997a17",
            "title": "E18139",
            "timestamp": "2018-03-14T20:42:55-05:00"
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
            "id": "074737dc-b35b-420f-ce0b-3669914013d8",
            "title": "Video: Lecture and Demonstration\u2014Ancient Roman Hairdressing",
            "lake_guid": "074737dc-b35b-420f-ce0b-3669914013d8",
            "is_boosted": false,
            "thumbnail": null,
            "type": "video",
            ...
        },
        {
            "id": "16b17adc-c5f0-92a4-d244-6346902fcec6",
            "title": "Video: A Thousand and One Swabs\u2014The Transformation of <em>Paris Street; Rainy Day<\/em>",
            "lake_guid": "16b17adc-c5f0-92a4-d244-6346902fcec6",
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
            "api_id": "031dcad7-f39f-2dae-595c-eb6730a54dc6",
            "thumbnail": null,
            "api_model": "videos",
            "is_boosted": false,
            "api_link": "http:\/\/localhost\/api\/v1\/videos\/031dcad7-f39f-2dae-595c-eb6730a54dc6",
            "id": "031dcad7-f39f-2dae-595c-eb6730a54dc6",
            "title": "Video: Staff Picks: Robby S.",
            "timestamp": "2018-03-14T20:42:26-05:00"
        },
        {
            "_score": 2,
            "api_id": "05ef3389-d354-0890-a840-dd836ed0c52d",
            "thumbnail": null,
            "api_model": "videos",
            "is_boosted": false,
            "api_link": "http:\/\/localhost\/api\/v1\/videos\/05ef3389-d354-0890-a840-dd836ed0c52d",
            "id": "05ef3389-d354-0890-a840-dd836ed0c52d",
            "title": "Video: Moreau's Enduring Art",
            "timestamp": "2018-03-14T20:42:26-05:00"
        },
        {
            "_score": 2,
            "api_id": "12f69a4d-06c5-e35c-c936-d1dc451231d1",
            "thumbnail": null,
            "api_model": "videos",
            "is_boosted": false,
            "api_link": "http:\/\/localhost\/api\/v1\/videos\/12f69a4d-06c5-e35c-c936-d1dc451231d1",
            "id": "12f69a4d-06c5-e35c-c936-d1dc451231d1",
            "title": "Video: Cassatt in the Paris Art World",
            "timestamp": "2018-03-14T20:42:26-05:00"
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
            "lake_guid": "1ac6c73b-e560-5fc9-05fb-8e2c30eccdc0",
            "is_boosted": false,
            "thumbnail": null,
            "type": "link",
            ...
        },
        {
            "id": "1be5e153-a275-da69-9210-89c4e9fbf716",
            "title": "Website: Art Access: Indian, Himalayan, and Southeast Asian Art",
            "lake_guid": "1be5e153-a275-da69-9210-89c4e9fbf716",
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
            "api_id": "0006576e-6a99-7ec1-9562-8a5c1085d2d9",
            "thumbnail": null,
            "api_model": "links",
            "is_boosted": false,
            "api_link": "http:\/\/localhost\/api\/v1\/links\/0006576e-6a99-7ec1-9562-8a5c1085d2d9",
            "id": "0006576e-6a99-7ec1-9562-8a5c1085d2d9",
            "title": "Timeline: When in Africa, When in the World",
            "timestamp": "2018-03-14T20:42:01-05:00"
        },
        {
            "_score": 2,
            "api_id": "0af8be20-aebb-1193-96d5-f1045e399776",
            "thumbnail": null,
            "api_model": "links",
            "is_boosted": false,
            "api_link": "http:\/\/localhost\/api\/v1\/links\/0af8be20-aebb-1193-96d5-f1045e399776",
            "id": "0af8be20-aebb-1193-96d5-f1045e399776",
            "title": "Timeline: Irving Penn",
            "timestamp": "2018-03-14T20:42:01-05:00"
        },
        {
            "_score": 2,
            "api_id": "12af57aa-9338-35a0-bd9c-658bb31e9d3f",
            "thumbnail": null,
            "api_model": "links",
            "is_boosted": false,
            "api_link": "http:\/\/localhost\/api\/v1\/links\/12af57aa-9338-35a0-bd9c-658bb31e9d3f",
            "id": "12af57aa-9338-35a0-bd9c-658bb31e9d3f",
            "title": "Turning the Pages: Jacques-Louis David, (French, 1748\u20131825) Sketchbook, 1809\/10",
            "timestamp": "2018-03-14T20:42:01-05:00"
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
            "id": "0018fcf4-cf5c-03a3-3d9c-69c4b1ac5dcc",
            "title": "510.mp3",
            "lake_guid": "0018fcf4-cf5c-03a3-3d9c-69c4b1ac5dcc",
            "is_boosted": false,
            "thumbnail": null,
            "type": "sound",
            ...
        },
        {
            "id": "03fc135f-ae30-5dc1-ff05-68a88a73473b",
            "title": "955.mp3",
            "lake_guid": "03fc135f-ae30-5dc1-ff05-68a88a73473b",
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
            "api_id": "006ee4b8-782c-6840-8309-99e456a81ff1",
            "thumbnail": null,
            "api_model": "sounds",
            "is_boosted": false,
            "api_link": "http:\/\/localhost\/api\/v1\/sounds\/006ee4b8-782c-6840-8309-99e456a81ff1",
            "id": "006ee4b8-782c-6840-8309-99e456a81ff1",
            "title": "549.mp3",
            "timestamp": "2018-03-14T20:42:13-05:00"
        },
        {
            "_score": 2,
            "api_id": "0194fb4d-9230-54a5-6ba1-23b7545b5028",
            "thumbnail": null,
            "api_model": "sounds",
            "is_boosted": false,
            "api_link": "http:\/\/localhost\/api\/v1\/sounds\/0194fb4d-9230-54a5-6ba1-23b7545b5028",
            "id": "0194fb4d-9230-54a5-6ba1-23b7545b5028",
            "title": "Musecast: May 2009",
            "timestamp": "2018-03-14T20:42:13-05:00"
        },
        {
            "_score": 2,
            "api_id": "01b0d6b8-f153-d6e5-59b6-1d5fd859dd71",
            "thumbnail": null,
            "api_model": "sounds",
            "is_boosted": false,
            "api_link": "http:\/\/localhost\/api\/v1\/sounds\/01b0d6b8-f153-d6e5-59b6-1d5fd859dd71",
            "id": "01b0d6b8-f153-d6e5-59b6-1d5fd859dd71",
            "title": "828.mp3",
            "timestamp": "2018-03-14T20:42:13-05:00"
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
            "api_id": "00b9fbb1-0548-9f4c-e269-ebf702490f4c",
            "thumbnail": null,
            "api_model": "texts",
            "is_boosted": false,
            "api_link": "http:\/\/localhost\/api\/v1\/texts\/00b9fbb1-0548-9f4c-e269-ebf702490f4c",
            "id": "00b9fbb1-0548-9f4c-e269-ebf702490f4c",
            "title": "Related Story: READ Duchamp in His Own Words",
            "timestamp": "2018-03-14T20:42:21-05:00"
        },
        {
            "_score": 2,
            "api_id": "049c9547-d585-c8d5-1070-93e83b0dfb89",
            "thumbnail": null,
            "api_model": "texts",
            "is_boosted": false,
            "api_link": "http:\/\/localhost\/api\/v1\/texts\/049c9547-d585-c8d5-1070-93e83b0dfb89",
            "id": "049c9547-d585-c8d5-1070-93e83b0dfb89",
            "title": "Monet's Water Garden",
            "timestamp": "2018-03-14T20:42:21-05:00"
        },
        {
            "_score": 2,
            "api_id": "05873879-a659-bca6-a9be-5eec6460c09f",
            "thumbnail": null,
            "api_model": "texts",
            "is_boosted": false,
            "api_link": "http:\/\/localhost\/api\/v1\/texts\/05873879-a659-bca6-a9be-5eec6460c09f",
            "id": "05873879-a659-bca6-a9be-5eec6460c09f",
            "title": "Related Story: Antioch and Early Christianity ",
            "timestamp": "2018-03-14T20:42:21-05:00"
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
            "thumbnail": null,
            "web_url": "http:\/\/www.artinstituteshop.org\/browse.aspx?catID=2",
            "parent_id": null,
            ...
        },
        {
            "id": 3,
            "title": "Apparel & Accessories",
            "is_boosted": false,
            "thumbnail": null,
            "web_url": "http:\/\/www.artinstituteshop.org\/browse.aspx?catID=3",
            "parent_id": null,
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
            "api_id": "14",
            "thumbnail": null,
            "api_model": "shop-categories",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/shop-categories\/14",
            "id": 14,
            "title": "Fountains",
            "timestamp": "2018-03-14T19:24:55-05:00"
        },
        {
            "_score": 2,
            "api_id": "19",
            "thumbnail": null,
            "api_model": "shop-categories",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/shop-categories\/19",
            "id": 19,
            "title": "Tabletop",
            "timestamp": "2018-03-14T19:24:55-05:00"
        },
        {
            "_score": 2,
            "api_id": "22",
            "thumbnail": null,
            "api_model": "shop-categories",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/shop-categories\/22",
            "id": 22,
            "title": "Holiday Ornaments",
            "timestamp": "2018-03-14T19:24:55-05:00"
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
        "thumbnail": null,
        "web_url": "http:\/\/www.artinstituteshop.org\/browse.aspx?catID=2",
        "parent_id": null,
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
            "thumbnail": null,
            "title_sort": null,
            "parent_id": null,
            ...
        },
        {
            "id": 7640,
            "title": "Scattered Leaves Scarf - Cranberry",
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
* `facets` - A comma-separated list of "count" aggregation facets to include in the results.

Example request: http://aggregator-data-test.artic.edu/api/v1/products/search  
Example output:

```
{
    "preference": null,
    "pagination": {
        "total": 5911,
        "limit": 10,
        "offset": 0,
        "total_pages": 592,
        "current_page": 1
    },
    "data": [
        {
            "_score": 2,
            "api_id": "40",
            "thumbnail": null,
            "api_model": "products",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/products\/40",
            "id": 40,
            "title": "Monet Water Lilies Scarf",
            "timestamp": "2018-03-14T19:24:55-05:00"
        },
        {
            "_score": 2,
            "api_id": "41",
            "thumbnail": null,
            "api_model": "products",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/products\/41",
            "id": 41,
            "title": "Asian Butterfly Scarf",
            "timestamp": "2018-03-14T19:24:55-05:00"
        },
        {
            "_score": 2,
            "api_id": "44",
            "thumbnail": null,
            "api_model": "products",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/products\/44",
            "id": 44,
            "title": "Velvet Kimono Scarf",
            "timestamp": "2018-03-14T19:24:55-05:00"
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

Example request: http://aggregator-data-test.artic.edu/api/v1/legacy-events?limit=2  
Example output:

```
{
    "pagination": {
        "total": 1779,
        "limit": 2,
        "offset": 0,
        "total_pages": 890,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/legacy-events?page=2&limit=2"
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
* `facets` - A comma-separated list of "count" aggregation facets to include in the results.

Example request: http://aggregator-data-test.artic.edu/api/v1/legacy-events/search  
Example output:

```
{
    "preference": null,
    "pagination": {
        "total": 1779,
        "limit": 10,
        "offset": 0,
        "total_pages": 178,
        "current_page": 1
    },
    "data": [
        {
            "_score": 2,
            "api_id": "717297",
            "thumbnail": null,
            "api_model": "legacy-events",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/legacy-events\/717297",
            "id": 717297,
            "title": "Gallery Talk: Modern Wing Highlights",
            "timestamp": "2018-03-14T19:25:02-05:00"
        },
        {
            "_score": 2,
            "api_id": "719696",
            "thumbnail": null,
            "api_model": "legacy-events",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/legacy-events\/719696",
            "id": 719696,
            "title": "Gallery Talk: Modern Wing Highlights",
            "timestamp": "2018-03-14T19:25:02-05:00"
        },
        {
            "_score": 2,
            "api_id": "726917",
            "thumbnail": null,
            "api_model": "legacy-events",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/legacy-events\/726917",
            "id": 726917,
            "title": "Gallery Talk: Modern Wing Highlights",
            "timestamp": "2018-03-14T19:25:02-05:00"
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
            "thumbnail": null,
            "api_model": "tours",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/tours\/2193",
            "id": 2193,
            "title": "The Essentials Tour",
            "timestamp": "2018-03-14T19:25:04-05:00"
        },
        {
            "_score": 2,
            "api_id": "2220",
            "thumbnail": null,
            "api_model": "tours",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/tours\/2220",
            "id": 2220,
            "title": "\u7cbe\u534e\u6e38",
            "timestamp": "2018-03-14T19:25:04-05:00"
        },
        {
            "_score": 2,
            "api_id": "1022",
            "thumbnail": null,
            "api_model": "tours",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/tours\/1022",
            "id": 1022,
            "title": "The New Contemporary",
            "timestamp": "2018-03-14T19:25:04-05:00"
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
            "id": 2780,
            "title": "Paris Street; Rainy Day",
            "is_boosted": false,
            "thumbnail": null,
            "artwork_title": "Paris Street; Rainy Day",
            "artwork_id": 20684,
            ...
        },
        {
            "id": 2781,
            "title": "A Sunday on La Grande Jatte \u2014 1884",
            "is_boosted": false,
            "thumbnail": null,
            "artwork_title": "A Sunday on La Grande Jatte \u2014 1884",
            "artwork_id": 27992,
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
        "total": 105,
        "limit": 10,
        "offset": 0,
        "total_pages": 11,
        "current_page": 1
    },
    "data": [
        {
            "_score": 2,
            "api_id": "2787",
            "thumbnail": null,
            "api_model": "tour-stops",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/tour-stops\/2787",
            "id": 2787,
            "title": "Buddha Shakyamuni Seated in Meditation (Dhyanamudra)",
            "timestamp": "2018-03-14T19:25:04-05:00"
        },
        {
            "_score": 2,
            "api_id": "2793",
            "thumbnail": null,
            "api_model": "tour-stops",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/tour-stops\/2793",
            "id": 2793,
            "title": "Bathers by a River",
            "timestamp": "2018-03-14T19:25:04-05:00"
        },
        {
            "_score": 2,
            "api_id": "2812",
            "thumbnail": null,
            "api_model": "tour-stops",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/tour-stops\/2812",
            "id": 2812,
            "title": "Teabowl with Mufurong (Hibiscus) and Dragonfly",
            "timestamp": "2018-03-14T19:25:04-05:00"
        }
    ]
}
```

### `/tour-stops/{id}`

A single tour-stops by the given identifier.

Example request: http://aggregator-data-test.artic.edu/api/v1/tour-stops/2780?limit=2  
Example output:

```
{
    "data": {
        "id": 2780,
        "title": "Paris Street; Rainy Day",
        "is_boosted": false,
        "thumbnail": null,
        "artwork_title": "Paris Street; Rainy Day",
        "artwork_id": 20684,
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
        "total": 610,
        "limit": 2,
        "offset": 0,
        "total_pages": 305,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/mobile-sounds?page=2&limit=2"
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

A single mobile-sounds by the given identifier.

Example request: http://aggregator-data-test.artic.edu/api/v1/mobile-sounds/1545?limit=2  
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
* `facets` - A comma-separated list of "count" aggregation facets to include in the results.

Example request: http://aggregator-data-test.artic.edu/api/v1/publications/search  
Example output:

```
{
    "preference": null,
    "pagination": {
        "total": 6,
        "limit": 10,
        "offset": 0,
        "total_pages": 1,
        "current_page": 1
    },
    "data": [
        {
            "_score": 2,
            "api_id": "12",
            "thumbnail": null,
            "api_model": "publications",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/publications\/12",
            "id": 12,
            "title": "The Modern Series at the Art Institute of Chicago",
            "timestamp": "2018-03-14T19:25:05-05:00"
        },
        {
            "_score": 2,
            "api_id": "226",
            "thumbnail": null,
            "api_model": "publications",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/publications\/226",
            "id": 226,
            "title": "James Ensor: The Temptation of Saint Anthony",
            "timestamp": "2018-03-14T19:25:05-05:00"
        },
        {
            "_score": 2,
            "api_id": "406",
            "thumbnail": null,
            "api_model": "publications",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/publications\/406",
            "id": 406,
            "title": "Whistler and Roussel: Linked Visions",
            "timestamp": "2018-03-14T19:25:05-05:00"
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
            "thumbnail": null,
            "web_url": "https:\/\/publications.artic.edu\/pissarro\/reader\/paintingsandpaper\/section\/1010",
            "accession": null,
            ...
        },
        {
            "id": 520,
            "title": "Cat. 12  Haymaking at \u00c9ragny, 1892",
            "is_boosted": false,
            "thumbnail": null,
            "web_url": "https:\/\/publications.artic.edu\/pissarro\/reader\/paintingsandpaper\/section\/24",
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
* `facets` - A comma-separated list of "count" aggregation facets to include in the results.

Example request: http://aggregator-data-test.artic.edu/api/v1/sections/search  
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
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/sections\/338",
            "id": 338,
            "title": "Modern Series Title",
            "timestamp": "2018-03-14T19:25:05-05:00"
        },
        {
            "_score": 2,
            "api_id": "343",
            "thumbnail": null,
            "api_model": "sections",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/sections\/343",
            "id": 343,
            "title": "Cat. 6  Tinker with His Tools, 1874\/76",
            "timestamp": "2018-03-14T19:25:05-05:00"
        },
        {
            "_score": 2,
            "api_id": "365",
            "thumbnail": null,
            "api_model": "sections",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/sections\/365",
            "id": 365,
            "title": "How to use This Catalogue",
            "timestamp": "2018-03-14T19:25:05-05:00"
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
            "id": 40,
            "title": "Belligerent Encounters: Graphic Chronicles of War and Revolution, 1500\u20131945",
            "is_boosted": false,
            "thumbnail": null,
            "description": "Wars and revolutions have been recorded in words and images for millennia, commemorated in architecture, sculpture, mosaics, frescoes, and tapestries. In Europe the advent of printing and printmaking in the 15th century meant that the chronicling of historical and contemporary conflicts was possible on a scale never before seen. Woodcuts, engravings, etchings, and lithographs depicting wars and revolutions can be seen as ancestors to the kinds of digital technologies that made this year\u2019s \u201cArab Spring\u201d a global event. Mainly drawn from the permanent collection of the Art Institute of Chicago\u2019s Department of Prints and Drawings, Belligerent Encounters includes European and American prints, posters, and drawings spanning almost 500 years of war and revolution. Some images\u2014by artists Jacques Callot, Albrecht D\u00fcrer, and Francisco de Goya\u2014 are quite famous; others by Otto Dix and \u00c9douard Manet may be familiar to some viewers; and a number by Frank Brangwyn, Albin Egger-Lienz, Heinrich Hoerle, and Jan Poortenaar will be unknown to many people. While some of the works on display were conceived to stand on their own, a number come from thematic portfolios whose contents were intended to be viewed together. These include Max Beckmann\u2019s Hell (Die H\u00f6lle), 1919; Otto Dix\u2019s War (Der Krieg), 1924; and Heinrich Hoerle\u2019s Cripples Portfolio (Die Kr\u00fcppel), 1920.",
            "web_url": "http:\/\/archive.artic.edu\/b-encounters\/",
            ...
        },
        {
            "id": 41,
            "title": "Benin\u2014Kings and Rituals: Court Arts from Nigeria",
            "is_boosted": false,
            "thumbnail": null,
            "description": "Spectacular and sophisticated, the royal sculptures and regalia from the West African Kingdom of Benin are among the continent\u2019s most acclaimed works of art. This landmark exhibition, representing six centuries of Benin's rich artistic heritage, brings together more than 220 of these masterworks from collections around the world and makes its sole North American stop at the Art Institute of Chicago. Planned with the most prominent scholars of Benin art, history, and culture, as well as the cooperation of reigning Oba Erediauwa and the National Commission for Museums and Monuments, Nigeria, Benin\u2014Kings and Rituals brings international attention and new perspectives to Benin art and history.",
            "web_url": "http:\/\/archive.artic.edu\/benin\/",
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
            "thumbnail": null,
            "api_model": "sites",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/sites\/14",
            "id": 14,
            "title": "The Medici, Michelangelo, and the Art of Late Renaissance Florence",
            "timestamp": "2018-03-14T19:25:08-05:00"
        },
        {
            "_score": 2,
            "api_id": "19",
            "thumbnail": null,
            "api_model": "sites",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/sites\/19",
            "id": 19,
            "title": "Perpetual Glory: Medieval Islamic Ceramics from the Harvey B. Plotnick Collection",
            "timestamp": "2018-03-14T19:25:08-05:00"
        },
        {
            "_score": 2,
            "api_id": "22",
            "thumbnail": null,
            "api_model": "sites",
            "is_boosted": false,
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/sites\/22",
            "id": 22,
            "title": "Seurat and the Making of \"La Grande Jatte\"",
            "timestamp": "2018-03-14T19:25:08-05:00"
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
            "id": 10059,
            "title": "Columbia University, Low Memorial Library",
            "alternate_title": null,
            "web_url": "http:\/\/digital-libraries.saic.edu\/cdm\/ref\/collection\/mqc\/id\/10059",
            "collection": "Inland Architect",
            "archive": null,
            ...
        },
        {
            "id": 10060,
            "title": "Donnelley, R.R., and Sons Co. Building",
            "alternate_title": "Columbia College Residence Center; Plymouth-Polk Building; South Plymouth Building; Lakeside Press; Triangle Publications",
            "web_url": "http:\/\/digital-libraries.saic.edu\/cdm\/ref\/collection\/mqc\/id\/10060",
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
            "id": 10059,
            "title": "Columbia University, Low Memorial Library",
            "alternate_title": null,
            "web_url": "http:\/\/digital-libraries.saic.edu\/cdm\/ref\/collection\/mqc\/id\/10059",
            "collection": "Inland Architect",
            "archive": null,
            ...
        },
        {
            "id": 10060,
            "title": "Donnelley, R.R., and Sons Co. Building",
            "alternate_title": "Columbia College Residence Center; Plymouth-Polk Building; South Plymouth Building; Lakeside Press; Triangle Publications",
            "web_url": "http:\/\/digital-libraries.saic.edu\/cdm\/ref\/collection\/mqc\/id\/10060",
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
            "id": "sh85007505",
            "uri": "http:\/\/id.loc.gov\/authorities\/subjects\/sh85007505",
            "title": "Art -- Study and teaching",
            ...
        },
        {
            "id": "nb2011016367",
            "uri": "http:\/\/id.loc.gov\/authorities\/names\/nb2011016367",
            "title": "Spiro, Alex",
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
            "id": "sh85007505",
            "uri": "http:\/\/id.loc.gov\/authorities\/subjects\/sh85007505",
            "title": "Art -- Study and teaching",
            ...
        },
        {
            "id": "nb2011016367",
            "uri": "http:\/\/id.loc.gov\/authorities\/names\/nb2011016367",
            "title": "Spiro, Alex",
            ...
        }
    ]
}
```

> Generated by `php artisan docs:endpoints` on 2018-03-14 21:43:23
