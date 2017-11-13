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

Example request: http://aggregator-data-test.artic.edu/api/v1/artworks?limit=2  
Example output:

```
{
    "pagination": {
        "total": 105813,
        "limit": 2,
        "offset": 0,
        "total_pages": 52907,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/artworks?page=2&limit=2"
    },
    "data": [
        {
            "id": 999710512,
            "title": "Sequi Aut Recusandae Incidunt",
            "lake_guid": "99999999-9999-9999-9999-999999202953",
            "main_reference_number": "1949.385",
            "date_start": 1990,
            "date_end": 1978,
            ...
        },
        {
            "id": 999882835,
            "title": "Autem Deserunt Corrupti Vero",
            "lake_guid": "99999999-9999-9999-9999-999999880003",
            "main_reference_number": "1990.045",
            "date_start": 1989,
            "date_end": 1988,
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
            "id": 23506,
            "title": "Young Bull",
            "lake_guid": "075a5cd3-682f-5dbe-8da2-155e31336807",
            "main_reference_number": "1965.408",
            "date_start": 1508,
            "date_end": 1509,
            ...
        },
        {
            "id": 16231,
            "title": "Processional Cross",
            "lake_guid": "683eaa7c-76de-1229-7198-b513f05d7e1b",
            "main_reference_number": "1933.1032",
            "date_start": 1392,
            "date_end": 1396,
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
        "total": 7733,
        "limit": 10,
        "offset": 0,
        "total_pages": 774,
        "current_page": 1
    },
    "data": [
        {
            "_score": 19.153254,
            "api_id": "16499",
            "api_model": "artworks",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/artworks\/16499",
            "id": 16499,
            "title": "Jesus Mocked by the Soldiers",
            "timestamp": "2017-10-30T15:36:27-05:00"
        },
        {
            "_score": 17.152597,
            "api_id": "14598",
            "api_model": "artworks",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/artworks\/14598",
            "id": 14598,
            "title": "The Beach at Sainte-Adresse",
            "timestamp": "2017-10-30T15:36:06-05:00"
        },
        {
            "_score": 15.305559,
            "api_id": "16571",
            "api_model": "artworks",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/artworks\/16571",
            "id": 16571,
            "title": "Arrival of the Normandy Train, Gare Saint-Lazare",
            "timestamp": "2017-10-30T15:36:27-05:00"
        }
    ],
    "suggest": {
        "autocomplete": [
            "Monet Paintings and Drawings at the Art Institute ",
            "Monet Paintings and Drawings at the Art Institute ",
            "Monet Signature Page",
            "Monet, Claude"
        ],
        "phrase": [
            "<em>month<\/em>",
            "<em>don't<\/em>",
            "<em>Don't<\/em>",
            "<em>Manet<\/em>",
            "<em>Bonnet<\/em>"
        ]
    },
    "aggregations": {
        "count_api_model": [
            {
                "key": "artworks",
                "doc_count": 7733
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
        "main_reference_number": "1942.51",
        "date_start": 1941,
        "date_end": 1942,
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
    "data": []
}
```

### `/artworks/{id}/copyrightRepresentatives`

The copyrightrepresentatives for a given artworks. Served from the API as a type of `agent`, so their output schema is the same.

Example request: http://aggregator-data-test.artic.edu/api/v1/artworks/111628/copyrightRepresentatives?limit=2  
Example output:

```
{
    "data": []
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
            "parent_id": null,
            "is_in_nav": false,
            "description": null,
            ...
        },
        {
            "id": 801,
            "title": "Art Resource",
            "lake_guid": "4a87fc2b-ddde-03db-3d5b-8a4e65c2ca26",
            "parent_id": null,
            "is_in_nav": false,
            "description": "Art Resource is a website where you can license high resolution images from The Art Institute of Chicago.",
            ...
        },
        {
            "id": 109,
            "title": "Art Institute Icons",
            "lake_guid": "74c96fd4-5e7e-4b56-26f3-0a911d8fe63b",
            "parent_id": null,
            "is_in_nav": true,
            "description": "As an encyclopedic museum of art, the Art Institute has works from around the globe representing over 5,000 years of human artistic creation. In the Art Institute Icons theme, find iconic works of art that demonstrate the diversity and distinction of the museum\u2019s holdings.",
            ...
        },
        {
            "id": 152,
            "title": "figural paintings",
            "lake_guid": "87917ef5-0de9-d5c9-ac25-be5b0a4dd782",
            "parent_id": null,
            "is_in_nav": false,
            "description": null,
            ...
        },
        {
            "id": 191,
            "title": "Featured Objects",
            "lake_guid": "ada5fe78-e09d-0ef8-82b3-71c4a5b1f6ae",
            "parent_id": null,
            "is_in_nav": true,
            "description": null,
            ...
        },
        {
            "id": 48,
            "title": "American Modernism",
            "lake_guid": "795eda4e-6c99-1e9f-3283-5aaaad27f857",
            "parent_id": 2,
            "is_in_nav": true,
            "description": null,
            ...
        },
        {
            "id": 144,
            "title": "Edward Hopper",
            "lake_guid": "3b7d4a9f-cd72-a02f-4247-61ef8e814a98",
            "parent_id": null,
            "is_in_nav": false,
            "description": null,
            ...
        },
        {
            "id": 2,
            "title": "American",
            "lake_guid": "609dd2cb-9647-1b18-59be-5b8d74d29b51",
            "parent_id": null,
            "is_in_nav": true,
            "description": "<p>The Department of American Art includes more than 1,000 paintings and sculptures from the 18th century to 1950 and nearly 2,500 decorative art objects from the 17th century to the present. Strengths in the collection include the Alfred Stieglitz Collection and significant groups of work by John Singer Sargent, James McNeill Whistler, Mary Cassatt and Winslow Homer.  Modernist holdings include iconic images by Grant Wood, Georgia O'Keeffe, Edward Hopper and the Mexican muralist Diego Rivera.<\/p>",
            ...
        },
        {
            "id": 147,
            "title": "architecture",
            "lake_guid": "965e725e-1275-ff04-6e9f-8b207eeb28ec",
            "parent_id": null,
            "is_in_nav": false,
            "description": null,
            ...
        },
        {
            "id": 83,
            "title": "Featured Works",
            "lake_guid": "854c887d-e8e1-71fb-1393-a3280918efd2",
            "parent_id": 11,
            "is_in_nav": true,
            "description": null,
            ...
        },
        {
            "id": 87,
            "title": "American Modernism",
            "lake_guid": "3c15e374-7cd0-7a9a-0280-fa3855032a3f",
            "parent_id": 11,
            "is_in_nav": true,
            "description": null,
            ...
        },
        {
            "id": 365,
            "title": "Art Access: Modern and Contemporary Art",
            "lake_guid": "b3743235-8d0d-a381-8582-95dfcad26711",
            "parent_id": null,
            "is_in_nav": false,
            "description": null,
            ...
        },
        {
            "id": 149,
            "title": "New York City",
            "lake_guid": "e3dc716f-3912-3063-bdfc-910cdd53a116",
            "parent_id": null,
            "is_in_nav": false,
            "description": null,
            ...
        },
        {
            "id": 41,
            "title": "Featured Works",
            "lake_guid": "ae637a2b-e996-a28e-7ca8-adae24ae01fa",
            "parent_id": 2,
            "is_in_nav": true,
            "description": null,
            ...
        },
        {
            "id": 11,
            "title": "Modern",
            "lake_guid": "45cc4323-ddb5-b79e-92ae-59238de12577",
            "parent_id": null,
            "is_in_nav": true,
            "description": "Considered one of the finest and most comprehensive in the world, the Art Institute's extraordinary collection of modern art includes nearly 1,000 works by artists from Europe and the Americas. The modern collection boasts some of the greatest icons of the period, including Picasso's <em>Old Guitarist<\/em>; Matisse's <em>Bathers by a River<\/em>; Br\u00e2ncusi's <em>Golden Bird<\/em>; Magritte's <em>Time Transfixed<\/em>; O'Keeffe's <em>Black Cross, New Mexico<\/em>; Orozco's <em>Zapata<\/em>; Wood's <em>American Gothic<\/em>; Ivan Albright's <em>Picture of Dorian Gray<\/em>; and Lachaise's <em>Woman (Elevation)<\/em>.",
            ...
        },
        {
            "id": 612,
            "title": "The City in Art",
            "lake_guid": "4864d53c-d1e6-a072-d036-18f96d612709",
            "parent_id": null,
            "is_in_nav": false,
            "description": null,
            ...
        },
        {
            "id": 150,
            "title": "views through windows",
            "lake_guid": "cefecb9f-0be9-6023-1188-294ad5ac7e27",
            "parent_id": null,
            "is_in_nav": false,
            "description": null,
            ...
        },
        {
            "id": 44,
            "title": "Paintings, 1900-1955",
            "lake_guid": "dcafd608-cc4a-bf34-12b7-87e095bc0a5b",
            "parent_id": 2,
            "is_in_nav": true,
            "description": null,
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
            "description": null,
            "content": null,
            "category_ids": [],
            "iiif_url": "https:\/\/lakeimagesweb.artic.edu\/iiif\/39d43108-e690-2705-67e2-a16dc28b8c7f",
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

Example request: http://aggregator-data-test.artic.edu/api/v1/agents?limit=2  
Example output:

```
{
    "pagination": {
        "total": 100,
        "limit": 2,
        "offset": 0,
        "total_pages": 50,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/agents?page=2&limit=2"
    },
    "data": [
        {
            "id": 999454213,
            "title": "Schmidt, Michael",
            "lake_guid": "99999999-9999-9999-9999-999999255038",
            "birth_date": 2007,
            "birth_place": "Costa Rica",
            "death_date": 1976,
            ...
        },
        {
            "id": 999262497,
            "title": "Murray, Morgan",
            "lake_guid": "99999999-9999-9999-9999-99999927220",
            "birth_date": 2009,
            "birth_place": "Timor-Leste",
            "death_date": 1988,
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
        "total": 11228,
        "limit": 10,
        "offset": 0,
        "total_pages": 1123,
        "current_page": 1
    },
    "data": [
        {
            "_score": 10.724321,
            "api_id": "92975",
            "api_model": "agents",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/agents\/92975",
            "id": 92975,
            "title": "Quimbaya",
            "timestamp": "2017-10-30T15:33:53-05:00"
        },
        {
            "_score": 10.355133,
            "api_id": "24548",
            "api_model": "agents",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/agents\/24548",
            "id": 24548,
            "title": "Soule, John P.",
            "timestamp": "2017-10-30T15:33:40-05:00"
        },
        {
            "_score": 10.355133,
            "api_id": "70443",
            "api_model": "agents",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/agents\/70443",
            "id": 70443,
            "title": "Ngwane",
            "timestamp": "2017-10-30T15:33:53-05:00"
        }
    ],
    "aggregations": {
        "count_api_model": [
            {
                "key": "agents",
                "doc_count": 11228
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
        "total": 100,
        "limit": 2,
        "offset": 0,
        "total_pages": 50,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/agents?page=2&limit=2"
    },
    "data": [
        {
            "id": 999454213,
            "title": "Schmidt, Michael",
            "lake_guid": "99999999-9999-9999-9999-999999255038",
            "birth_date": 2007,
            "birth_place": "Costa Rica",
            "death_date": 1976,
            ...
        },
        {
            "id": 999262497,
            "title": "Murray, Morgan",
            "lake_guid": "99999999-9999-9999-9999-99999927220",
            "birth_date": 2009,
            "birth_place": "Timor-Leste",
            "death_date": 1988,
            ...
        }
    ]
}
```

Artists are a subset of agents filtered by `agent_type` with values `Individual`. The following endpoints are available with the same parameters and output as their corresponding `/agents` endpoints:

* `/artists`
* `/artists/{id}`
Venues are a subset of agents filtered by `agent_type` with values `Corporate Body`. The following endpoints are available with the same parameters and output as their corresponding `/agents` endpoints:

* `/venues`
* `/venues/{id}`
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
        "total": 57,
        "limit": 2,
        "offset": 0,
        "total_pages": 29,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/departments?page=2&limit=2"
    },
    "data": [
        {
            "id": 999554600,
            "title": "Reiciendis Art",
            "lake_guid": "99999999-9999-9999-9999-999999785256",
            "last_updated_fedora": "2017-08-06T19:01:50-05:00",
            "last_updated_source": "2017-04-24T00:13:04-05:00",
            "last_updated": "2017-10-30T09:26:34-05:00",
            ...
        },
        {
            "id": 999830341,
            "title": "Est Art",
            "lake_guid": "99999999-9999-9999-9999-999999687348",
            "last_updated_fedora": "2017-06-20T16:21:23-05:00",
            "last_updated_source": "2017-06-20T14:35:44-05:00",
            "last_updated": "2017-10-30T09:26:34-05:00",
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
            "_score": 1,
            "api_id": "14",
            "api_model": "departments",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/departments\/14",
            "id": 14,
            "title": "European Painting and Sculpture",
            "timestamp": "2017-10-30T15:33:57-05:00"
        },
        {
            "_score": 1,
            "api_id": "25",
            "api_model": "departments",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/departments\/25",
            "id": 25,
            "title": "Architecture and Design",
            "timestamp": "2017-10-30T15:33:57-05:00"
        },
        {
            "_score": 1,
            "api_id": "84",
            "api_model": "departments",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/departments\/84",
            "id": 84,
            "title": "Museum Registrar",
            "timestamp": "2017-10-30T15:33:57-05:00"
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
        "last_updated_fedora": "2017-10-04T13:36:37-05:00",
        "last_updated_source": "2017-10-04T13:36:37-05:00",
        "last_updated": "2017-10-26T17:31:20-05:00",
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
        "total": 65,
        "limit": 2,
        "offset": 0,
        "total_pages": 33,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/object-types?page=2&limit=2"
    },
    "data": [
        {
            "id": 99905,
            "title": "Et Arts",
            "lake_guid": "99999999-9999-9999-9999-999999741382",
            "last_updated_fedora": "2017-07-27T06:18:37-05:00",
            "last_updated_source": "2017-08-20T00:04:54-05:00",
            "last_updated": "2017-10-30T09:26:34-05:00",
            ...
        },
        {
            "id": 99908,
            "title": "Drawing and Commodi",
            "lake_guid": "99999999-9999-9999-9999-99999922034",
            "last_updated_fedora": "2017-03-15T21:43:07-05:00",
            "last_updated_source": "2017-08-25T05:45:37-05:00",
            "last_updated": "2017-10-30T09:26:34-05:00",
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
        "last_updated_fedora": "2017-10-04T13:45:19-05:00",
        "last_updated_source": "2017-10-04T13:45:19-05:00",
        "last_updated": "2017-10-26T17:31:21-05:00",
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
        "total": 815,
        "limit": 2,
        "offset": 0,
        "total_pages": 408,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/categories?page=2&limit=2"
    },
    "data": [
        {
            "id": 999671554,
            "title": "Quo",
            "lake_guid": "99999999-9999-9999-9999-999999525941",
            "parent_id": null,
            "is_in_nav": true,
            "description": "Recusandae eum enim nihil nostrum. Omnis et temporibus nulla. Mollitia suscipit necessitatibus optio aut quidem.",
            ...
        },
        {
            "id": 999500806,
            "title": "Autem",
            "lake_guid": "99999999-9999-9999-9999-999999195203",
            "parent_id": null,
            "is_in_nav": false,
            "description": "Aliquid minus est eum nobis non. Unde reprehenderit repudiandae dolorum ducimus temporibus porro repellat aut. Ea vitae ipsam laborum quidem voluptatem cum. Aut esse voluptatem rerum laudantium nisi earum.",
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
            "_score": 1,
            "api_id": "14",
            "api_model": "categories",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/categories\/14",
            "id": 14,
            "title": "Textiles",
            "timestamp": "2017-10-30T15:33:58-05:00"
        },
        {
            "_score": 1,
            "api_id": "19",
            "api_model": "categories",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/categories\/19",
            "id": 19,
            "title": "American Rooms",
            "timestamp": "2017-10-30T15:33:58-05:00"
        },
        {
            "_score": 1,
            "api_id": "22",
            "api_model": "categories",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/categories\/22",
            "id": 22,
            "title": "Featured Works",
            "timestamp": "2017-10-30T15:33:58-05:00"
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
        "parent_id": null,
        "is_in_nav": true,
        "description": "<p>The Amerindian collection primarily focuses upon Mesoamerican and Andean ceramics, sculpture, textiles, and metalwork. Native North American Indian works, particularly from the Plains Indians, the Southwest, and California, are also on view.<\/p>",
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
        "total": 35,
        "limit": 2,
        "offset": 0,
        "total_pages": 18,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/agent-types?page=2&limit=2"
    },
    "data": [
        {
            "id": 99903,
            "title": "fuga reprehenderit",
            "lake_guid": "99999999-9999-9999-9999-999999107124",
            "last_updated_fedora": "2017-10-19T02:29:05-05:00",
            "last_updated_source": "2017-10-18T12:59:10-05:00",
            "last_updated": "2017-10-30T09:26:27-05:00",
            ...
        },
        {
            "id": 99906,
            "title": "molestiae nesciunt",
            "lake_guid": "99999999-9999-9999-9999-999999279344",
            "last_updated_fedora": "2017-02-22T17:16:51-06:00",
            "last_updated_source": "2017-01-27T04:38:18-06:00",
            "last_updated": "2017-10-30T09:26:27-05:00",
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
        "last_updated_fedora": "2017-10-04T13:45:35-05:00",
        "last_updated_source": "2017-10-04T13:45:35-05:00",
        "last_updated": "2017-10-26T17:23:51-05:00",
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
        "total": 64,
        "limit": 2,
        "offset": 0,
        "total_pages": 32,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/galleries?page=2&limit=2"
    },
    "data": [
        {
            "id": 999334153,
            "title": "Bogisich Building",
            "lake_guid": "99999999-9999-9999-9999-999999330401",
            "is_closed": true,
            "number": "940A",
            "floor": "2",
            ...
        },
        {
            "id": 999562024,
            "title": "Gallery 137",
            "lake_guid": "99999999-9999-9999-9999-99999949495",
            "is_closed": true,
            "number": "696",
            "floor": "LL",
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
        "total": 64,
        "limit": 10,
        "offset": 0,
        "total_pages": 7,
        "current_page": 1
    },
    "data": [
        {
            "_score": 10.295673,
            "api_id": "23972",
            "api_model": "galleries",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/galleries\/23972",
            "id": 23972,
            "title": "Gallery 297B",
            "timestamp": "2017-10-30T15:33:59-05:00"
        },
        {
            "_score": 1,
            "api_id": "23990",
            "api_model": "galleries",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/galleries\/23990",
            "id": 23990,
            "title": "Gallery 392A",
            "timestamp": "2017-10-30T15:33:59-05:00"
        },
        {
            "_score": 1,
            "api_id": "23993",
            "api_model": "galleries",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/galleries\/23993",
            "id": 23993,
            "title": "Gallery 395A",
            "timestamp": "2017-10-30T15:33:59-05:00"
        }
    ],
    "aggregations": {
        "count_api_model": [
            {
                "key": "galleries",
                "doc_count": 64
            }
        ]
    }
}
```

### `/galleries/{id}`

A single galleries by the given identifier. {id} is the identifier from our collections managements system.

Example request: http://aggregator-data-test.artic.edu/api/v1/galleries/24650?limit=2  
Example output:

```
{
    "data": {
        "id": 24650,
        "title": "Gallery 141",
        "lake_guid": "d4cdd96c-85b1-2775-abc7-3af69f99057e",
        "is_closed": false,
        "number": "141",
        "floor": "1",
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
        "total": 4555,
        "limit": 2,
        "offset": 0,
        "total_pages": 2278,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/exhibitions?page=2&limit=2"
    },
    "data": [
        {
            "id": 999038730,
            "title": "Harum At Nostrum",
            "lake_guid": "99999999-9999-9999-9999-999999814381",
            "description": "Molestiae recusandae inventore voluptate voluptatum et. Sint et sequi vel. Totam ex provident dolorem quasi.",
            "type": "Mini Exhibition",
            "department": "Molestiae Art",
            ...
        },
        {
            "id": 999117087,
            "title": "Sit Veritatis Quod",
            "lake_guid": "99999999-9999-9999-9999-999999790436",
            "description": "Dolores doloremque nostrum inventore est exercitationem. Sed in eligendi illo sapiente. Beatae minus sit est eos sit. Et sint sed explicabo excepturi consequuntur exercitationem.",
            "type": "AIC & Other Venues",
            "department": "Laboriosam Art",
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
        "total": 4581,
        "limit": 10,
        "offset": 0,
        "total_pages": 459,
        "current_page": 1
    },
    "data": [
        {
            "_score": 10.355133,
            "api_id": "4788",
            "api_model": "exhibitions",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/exhibitions\/4788",
            "id": 4788,
            "title": "Guild of Boston Artists",
            "timestamp": "2017-10-30T16:24:30-05:00"
        },
        {
            "_score": 10.355133,
            "api_id": "6596",
            "api_model": "exhibitions",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/exhibitions\/6596",
            "id": 6596,
            "title": "The Age of Louis XV: French Paintings from 1710-1774",
            "timestamp": "2017-10-30T16:24:43-05:00"
        },
        {
            "_score": 10.295673,
            "api_id": "4575",
            "api_model": "exhibitions",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/exhibitions\/4575",
            "id": 4575,
            "title": "Paintings by Contemporary Spanish Artists",
            "timestamp": "2017-10-30T16:24:29-05:00"
        }
    ],
    "aggregations": {
        "count_api_model": [
            {
                "key": "exhibitions",
                "doc_count": 4581
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
        "description": null,
        "type": null,
        "department": "",
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
    "data": []
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
        "total": 104032,
        "limit": 2,
        "offset": 0,
        "total_pages": 52016,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/images?page=2&limit=2"
    },
    "data": [
        {
            "id": "99999999-9999-9999-9999-999999284859",
            "title": "Labore Esse Itaque",
            "description": "Rerum eligendi veniam maiores at cupiditate labore temporibus. Minus facilis quaerat non. Omnis voluptas necessitatibus molestias quisquam similique.",
            "content": null,
            "category_ids": [
                999671554,
                999519730
            ],
            "iiif_url": "https:\/\/lakeimagesweb.artic.edu\/iiif\/99999999-9999-9999-9999-999999284859",
            ...
        },
        {
            "id": "99999999-9999-9999-9999-999999359912",
            "title": "Doloribus Vel Quia",
            "description": "Incidunt et culpa pariatur sit sunt molestiae. Aut distinctio assumenda et ut magni. Aut voluptatem consectetur consequuntur itaque nihil eveniet perferendis.",
            "content": null,
            "category_ids": [
                999769889,
                999736683,
                999452985
            ],
            "iiif_url": "https:\/\/lakeimagesweb.artic.edu\/iiif\/99999999-9999-9999-9999-999999359912",
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

### `/images/{id}`

A single images by the given identifier. {id} is the identifier from our collections managements system.

Example request: http://aggregator-data-test.artic.edu/api/v1/images/c972e5d7-0667-6904-d919-bbeefeae0a10?limit=2  
Example output:

```
{
    "data": {
        "id": "c972e5d7-0667-6904-d919-bbeefeae0a10",
        "title": "IM011631",
        "description": null,
        "content": null,
        "category_ids": [],
        "iiif_url": "https:\/\/lakeimagesweb.artic.edu\/iiif\/c972e5d7-0667-6904-d919-bbeefeae0a10",
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

Example request: http://aggregator-data-test.artic.edu/api/v1/videos?limit=2  
Example output:

```
{
    "pagination": {
        "total": 337,
        "limit": 2,
        "offset": 0,
        "total_pages": 169,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/videos?page=2&limit=2"
    },
    "data": [
        {
            "id": "99999999-9999-9999-9999-99999910111",
            "title": "Accusamus Voluptatem Deserunt",
            "description": "Aut qui et doloribus totam nihil. Itaque et exercitationem id ut cupiditate illum ea. Et id sit aliquid neque eius nisi alias.",
            "content": "https:\/\/www.bergnaum.org\/laborum-laborum-dolorum-quos-laborum-tenetur-quisquam",
            "category_ids": [
                999641849,
                999280991,
                999230377
            ],
            "last_updated_fedora": "2017-03-22T20:59:30-05:00",
            ...
        },
        {
            "id": "99999999-9999-9999-9999-99999914416",
            "title": "Quaerat Impedit Et",
            "description": "Corporis quis impedit ea minus asperiores ullam iure quis. Autem libero suscipit natus sit reprehenderit corrupti explicabo. Provident sunt deleniti sed quaerat. Rerum eius dolore porro quibusdam nostrum et est.",
            "content": "https:\/\/www.wehner.biz\/rerum-dolor-velit-alias-veniam-ea",
            "category_ids": [
                999519730,
                999500806,
                999212014
            ],
            "last_updated_fedora": "2017-02-21T09:52:14-06:00",
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

### `/videos/{id}`

A single videos by the given identifier. {id} is the identifier from our collections managements system.

Example request: http://aggregator-data-test.artic.edu/api/v1/videos/8199a3c6-99fa-582d-449a-bc9221db54da?limit=2  
Example output:

```
{
    "data": {
        "id": "8199a3c6-99fa-582d-449a-bc9221db54da",
        "title": "Video: Cassatt and the Modern Woman",
        "description": "An introduction to Cassatt's paintings of women involved in morning activities in the privacy of their bourgeois homes.  ",
        "content": "http:\/\/www.artic.edu\/aic\/collections\/citi\/resources\/530.flv",
        "category_ids": [],
        "last_updated_fedora": "2017-06-12T16:33:15-05:00",
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

Example request: http://aggregator-data-test.artic.edu/api/v1/links?limit=2  
Example output:

```
{
    "pagination": {
        "total": 171,
        "limit": 2,
        "offset": 0,
        "total_pages": 86,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/links?page=2&limit=2"
    },
    "data": [
        {
            "id": "99999999-9999-9999-9999-999999114341",
            "title": "Beatae Similique Ea",
            "description": "Et ut neque ad iure dicta error. Sit alias dicta illo sint nihil dolore ullam. Ea totam quis vel.",
            "content": "http:\/\/powlowski.org\/aspernatur-ipsa-aut-dolorem-assumenda-doloremque-fuga-molestiae-ratione",
            "category_ids": [
                999298593,
                999452985
            ],
            "last_updated_fedora": "2016-11-21T21:39:42-06:00",
            ...
        },
        {
            "id": "99999999-9999-9999-9999-999999148100",
            "title": "Quidem Fugiat In",
            "description": "Maiores et rem necessitatibus soluta et molestiae. Non adipisci et atque cumque voluptate et. Rerum alias ullam deleniti voluptatum rerum perspiciatis labore. Minima nobis et qui.",
            "content": "http:\/\/www.jacobs.com\/molestiae-quo-nam-vel-et",
            "category_ids": [
                999060336,
                999500806,
                999250264
            ],
            "last_updated_fedora": "2017-01-10T20:04:12-06:00",
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

### `/links/{id}`

A single links by the given identifier. {id} is the identifier from our collections managements system.

Example request: http://aggregator-data-test.artic.edu/api/v1/links/3990a5f5-2ae9-3c7b-2fb8-1b0438962cd3?limit=2  
Example output:

```
{
    "data": {
        "id": "3990a5f5-2ae9-3c7b-2fb8-1b0438962cd3",
        "title": "Student Tours: Visit Information",
        "description": "Information on planning a student tour: application dates, reservation and museum contact information. ",
        "content": "http:\/\/www.artic.edu\/aic\/students\/tours\/index.html",
        "category_ids": [],
        "last_updated_fedora": "2017-06-12T17:03:20-05:00",
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

Example request: http://aggregator-data-test.artic.edu/api/v1/sounds?limit=2  
Example output:

```
{
    "pagination": {
        "total": 1045,
        "limit": 2,
        "offset": 0,
        "total_pages": 523,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/sounds?page=2&limit=2"
    },
    "data": [
        {
            "id": "99999999-9999-9999-9999-999999143459",
            "title": "Maxime Et Nulla",
            "description": "Quia veritatis et aut autem quia. Vitae quia modi quaerat veniam. Sequi et eum repellendus ipsa omnis sunt.",
            "content": "https:\/\/gutmann.info\/consectetur-velit-dolor-at-est-odit-nam-et-ut.html",
            "category_ids": [
                999671554,
                999197004,
                999139485
            ],
            "last_updated_fedora": "2017-03-30T11:52:25-05:00",
            ...
        },
        {
            "id": "99999999-9999-9999-9999-999999216952",
            "title": "Voluptate Ut Et",
            "description": "Alias et est nihil facere. Distinctio sunt sed cum nihil doloremque unde. Ullam eos dolores quod fugit. Ea illo mollitia natus eveniet.",
            "content": "https:\/\/abbott.org\/et-est-occaecati-laboriosam-eligendi-voluptate-perspiciatis.html",
            "category_ids": [
                999876764,
                999197004,
                999250264
            ],
            "last_updated_fedora": "2016-11-20T11:20:43-06:00",
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

### `/sounds/{id}`

A single sounds by the given identifier. {id} is the identifier from our collections managements system.

Example request: http://aggregator-data-test.artic.edu/api/v1/sounds/0dc99580-0a4c-c047-31e9-f42d29ac020e?limit=2  
Example output:

```
{
    "data": {
        "id": "0dc99580-0a4c-c047-31e9-f42d29ac020e",
        "title": "Audio Lecture: Sally Mann at the Art Institute of Chicago",
        "description": "<p>Tune in as contemporary photographer Mann answers questions from an audience of nearly 400 on opening day of the Art Institute exhibition <em>So the Story Goes<\/em>. Mann responds to questions ranging from printing techniques to subject matter, from disbelief in photographic \"truth\" to a Southern weakness for the romantic.<\/p>",
        "content": "http:\/\/www.artic.edu\/aic\/collections\/citi\/resources\/691_mann.mp3",
        "category_ids": [],
        "last_updated_fedora": "2017-06-12T16:33:47-05:00",
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

Example request: http://aggregator-data-test.artic.edu/api/v1/texts?limit=2  
Example output:

```
{
    "pagination": {
        "total": 626,
        "limit": 2,
        "offset": 0,
        "total_pages": 313,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/texts?page=2&limit=2"
    },
    "data": [
        {
            "id": "99999999-9999-9999-9999-999999159061",
            "title": "Rerum Impedit Quisquam",
            "description": "Blanditiis expedita et harum ipsa ut. Natus blanditiis nam ullam dicta magnam maiores voluptatum. Vel vel ut autem minima laboriosam quia.",
            "content": "http:\/\/www.wilkinson.biz\/est-voluptatem-quod-nemo-et-qui-quaerat-voluptates-quo",
            "category_ids": [
                999500806,
                999913894
            ],
            "last_updated_fedora": "2017-01-03T06:20:36-06:00",
            ...
        },
        {
            "id": "99999999-9999-9999-9999-999999266159",
            "title": "Reprehenderit Neque Ut",
            "description": "Porro aut ut non nostrum aut. Et dignissimos est sit sed totam cupiditate quam.",
            "content": "http:\/\/lindgren.info\/laboriosam-veritatis-eum-rerum-sint-fugiat.html",
            "category_ids": [
                999810496,
                999810496,
                999139485
            ],
            "last_updated_fedora": "2016-12-22T13:23:51-06:00",
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

### `/texts/{id}`

A single texts by the given identifier. {id} is the identifier from our collections managements system.

Example request: http://aggregator-data-test.artic.edu/api/v1/texts/28f4641e-c040-7669-6036-f6fce1e25514?limit=2  
Example output:

```
{
    "data": {
        "id": "28f4641e-c040-7669-6036-f6fce1e25514",
        "title": "Examination: Rodin's <em>Adam<\/em>",
        "description": "An exploration of Rodin's ability to convey physical and emotional torment in his towering sculpture of Adam.  ",
        "content": "With his right leg raised and his torso tensed and wrenched into an unnatural position, Auguste Rodin\u2019s <em>Adam<\/em> appears horribly disfigured, despite his idealized proportions and serene facial expression. His right arm and hand, perhaps drawn from Michelangelo\u2019s figure of Adam at the center of the Sistine Chapel ceiling, point emphatically downward, as if to indicate the fall of man, while his left hand desperately clutches his right knee. \"I . . . tried to express the inner feelings of the man by the mobility of the muscles,\" wrote the artist about this piece. The rigid musculature of the figure\u2019s hands and legs, the twisted trunk of the body, and the emphatic straining of the head, as neck and shoulder collapse into a nearly horizontal plane, all serve to convey a sense of physical pain, certainly related to the emotional torment of having been banished by God from Paradise. <br><br>\n Rodin originally intended his towering, contorted sculpture of <em>Adam<\/em> and its pendant, <em>Eve<\/em>, to flank the <em>Gates of Hell<\/em>, a monumental bronze doorway of bas-reliefs illustrating various cantos from Dante\u2019s <em>Divine Comedy<\/em>. The doorway\u2014capped by looming representations of the three shades, which repeat the basic form of Adam\u2014was commissioned by the French government in 1880 for a new museum of decorative arts in Paris. The museum was never built, and Rodin left the portal unfinished at his death. Nevertheless, the project became well known during the artist\u2019s lifetime, for he cast individual figures and groups, some of which appeared in a large exhibition of works by Rodin and Claude Monet held at the prestigious Parisian gallery of Georges Petit in 1889.\n\n",
        "category_ids": [],
        "last_updated_fedora": "2017-06-12T17:03:05-05:00",
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
            "id": 999429,
            "title": "Facilis aut beatae exercitationem iure",
            "link": "http:\/\/www.altenwerth.com\/",
            "parent_id": 999828,
            "type": "sale",
            "source_id": 43,
            ...
        },
        {
            "id": 999439,
            "title": "Iure non sed distinctio dolores",
            "link": "https:\/\/www.west.com\/non-officia-temporibus-nihil-culpa-fugit-et-repellat",
            "parent_id": 999041,
            "type": "top-category",
            "source_id": 47,
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

### `/shop-categories/{id}`

A single shop-categories by the given identifier.

Example request: http://aggregator-data-test.artic.edu/api/v1/shop-categories/999397?limit=2  
Example output:

```
{
    "data": {
        "id": 999397,
        "title": "Assumenda qui aliquid dolorem minus",
        "link": "http:\/\/keeling.biz\/illo-eos-sint-ex-aut-ea",
        "parent_id": null,
        "type": "sub-category",
        "source_id": 36,
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
            "id": 999448,
            "title": "Et Recusandae Possimus Excepturi Quam Debitis",
            "title_display": "Et Recusandae <em>Possimus Excepturi<\/em> Quam Debitis",
            "sku": "36005101",
            "link": "http:\/\/www.leffler.com\/qui-nihil-eligendi-eaque-minus-quas-consequatur-nemo-veritatis",
            "image": "http:\/\/lorempixel.com\/640\/480\/?38002",
            ...
        },
        {
            "id": 999717,
            "title": "Autem Numquam Debitis Inventore Voluptates Ut",
            "title_display": "Autem Numquam <em>Debitis Inventore<\/em> Voluptates Ut",
            "sku": "03992605",
            "link": "http:\/\/kilback.com\/eos-tenetur-et-eum-sit",
            "image": "http:\/\/lorempixel.com\/640\/480\/?38264",
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
        "total": 25,
        "limit": 10,
        "offset": 0,
        "total_pages": 3,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_id": "999386",
            "api_model": "products",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/products\/999386",
            "id": 999386,
            "title": "Cupiditate Quasi Voluptatem Qui Quis Et",
            "timestamp": "2017-10-30T16:24:52-05:00"
        },
        {
            "_score": 1,
            "api_id": "999398",
            "api_model": "products",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/products\/999398",
            "id": 999398,
            "title": "Repudiandae Necessitatibus Beatae Minima Et Animi",
            "timestamp": "2017-10-30T16:24:52-05:00"
        },
        {
            "_score": 1,
            "api_id": "999547",
            "api_model": "products",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/products\/999547",
            "id": 999547,
            "title": "Ipsa Sunt Sint Sapiente Molestiae Magnam",
            "timestamp": "2017-10-30T16:24:52-05:00"
        }
    ],
    "aggregations": {
        "count_api_model": [
            {
                "key": "products",
                "doc_count": 25
            }
        ]
    }
}
```

### `/products/{id}`

A single products by the given identifier.

Example request: http://aggregator-data-test.artic.edu/api/v1/products/999448?limit=2  
Example output:

```
{
    "data": {
        "id": 999448,
        "title": "Et Recusandae Possimus Excepturi Quam Debitis",
        "title_display": "Et Recusandae <em>Possimus Excepturi<\/em> Quam Debitis",
        "sku": "36005101",
        "link": "http:\/\/www.leffler.com\/qui-nihil-eligendi-eaque-minus-quas-consequatur-nemo-veritatis",
        "image": "http:\/\/lorempixel.com\/640\/480\/?38002",
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
        "total": 2101,
        "limit": 2,
        "offset": 0,
        "total_pages": 1051,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/events?page=2&limit=2"
    },
    "data": [
        {
            "id": 99959067,
            "title": "Nostrum quam ipsam",
            "description": "Ut aut et est. Consequuntur iste aut rerum nihil. Placeat quis nobis a rerum enim quia vel.",
            "short_description": "Ipsum repellat dolor temporibus sint eum explicabo error quia.",
            "image": "http:\/\/lorempixel.com\/640\/480\/?98061",
            "type": "Aut tenetur distinctio",
            ...
        },
        {
            "id": 99938367,
            "title": "Provident fugit quia",
            "description": "Explicabo minus quis temporibus nulla ex harum enim. Adipisci rem quisquam ea quos.",
            "short_description": "Omnis id enim veritatis magni dolorum quos quos.",
            "image": "http:\/\/lorempixel.com\/640\/480\/?30074",
            "type": "Tempora rerum autem",
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
        "total": 2232,
        "limit": 10,
        "offset": 0,
        "total_pages": 224,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_id": "13182",
            "api_model": "events",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/events\/13182",
            "id": 13182,
            "title": "Gauguin: Artist as Alchemist",
            "timestamp": "2017-10-30T16:24:52-05:00"
        },
        {
            "_score": 1,
            "api_id": "14110",
            "api_model": "events",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/events\/14110",
            "id": 14110,
            "title": "Sketch Class: Still Life \u2014 Approaches and Meanings",
            "timestamp": "2017-10-30T16:24:52-05:00"
        },
        {
            "_score": 1,
            "api_id": "14119",
            "api_model": "events",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/events\/14119",
            "id": 14119,
            "title": "Griffith Mann",
            "timestamp": "2017-10-30T16:24:52-05:00"
        }
    ],
    "aggregations": {
        "count_api_model": [
            {
                "key": "events",
                "doc_count": 2232
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
        "description": "Join us on an interactive tour of works in the collection led by a museum educator in American Sign Language. This public program is offered primarily for the Deaf community. All visitors are welcome.<br \/>\nTo request an accessibility accommodation for an Art Institute program, please call (312) 443-3680 or send an e-mail to access@artic.edu as far in advance as possible.\u00a0<br \/>\nPlease see the museum\u2019s Accessibility page for more information.<br \/>\n\u00a0",
        "short_description": "Guided Tour",
        "image": "http:\/\/www.artic.edu\/sites\/default\/files\/cal-ASL%20tour.-06222017.jpg",
        "type": "Talks",
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
        "total": 33,
        "limit": 2,
        "offset": 0,
        "total_pages": 17,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/tours?page=2&limit=2"
    },
    "data": [
        {
            "id": 9993771,
            "title": "Voluptas odio nostrum",
            "image": "http:\/\/lorempixel.com\/640\/480\/?61637",
            "description": "Quia molestiae sapiente qui libero placeat est. Necessitatibus ratione nam recusandae optio quas. Nostrum ut aut est molestias. Doloremque et rerum reprehenderit amet at molestiae et.",
            "intro": "Omnis ut consequatur aut natus molestiae eligendi. Voluptate porro quidem dignissimos consectetur. Rerum veritatis doloribus velit reprehenderit et.",
            "weight": 4,
            ...
        },
        {
            "id": 9991596,
            "title": "Et ut sunt",
            "image": "http:\/\/lorempixel.com\/640\/480\/?81185",
            "description": "Quia quisquam vero voluptatibus cum ad. Sequi incidunt quisquam eius molestias at optio quae. Voluptates sit nesciunt omnis quia sapiente modi. Odio fuga ut voluptatem ut tempore.",
            "intro": "Aut ducimus facilis sapiente autem nobis veniam sed a. Debitis et maxime voluptate. Suscipit natus sed earum impedit suscipit est.",
            "weight": 2,
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
            "_score": 1,
            "api_id": "2193",
            "api_model": "tours",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/tours\/2193",
            "id": 2193,
            "title": "The Essentials Tour",
            "timestamp": "2017-10-30T16:24:52-05:00"
        },
        {
            "_score": 1,
            "api_id": "2333",
            "api_model": "tours",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/tours\/2333",
            "id": 2333,
            "title": "Gauguin: Artist as Alchemist",
            "timestamp": "2017-10-30T16:24:52-05:00"
        },
        {
            "_score": 1,
            "api_id": "9991596",
            "api_model": "tours",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/tours\/9991596",
            "id": 9991596,
            "title": "Et ut sunt",
            "timestamp": "2017-10-30T16:24:52-05:00"
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

Example request: http://aggregator-data-test.artic.edu/api/v1/tours/2280?limit=2  
Example output:

```
{
    "data": {
        "id": 2280,
        "title": "Zhang Peili: Record. Repeat.",
        "image": "http:\/\/aicweb10.artic.edu\/sites\/default\/files\/tour-images\/Untitled.jpg",
        "description": "View the career of an artist who pioneered the use of video in China.",
        "intro": "Considered the first Chinese artist to work in video, Zhang Peili is a pioneering figure in the history of contemporary art. Zhang's distinctive videos focus on the repetition of actions\u2014breaking a mirror, reading, washing, looking out the window, and dancing\u2014that are familiar yet rendered disorienting through Zhang's use of perspective, close-ups, and framing.&nbsp;This exhibition traces the development of his practice from early experiments with video in the late 1980s to new digital formats in the 2000s.",
        "weight": null,
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
        "total": 158,
        "limit": 2,
        "offset": 0,
        "total_pages": 79,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/tour-stops?page=2&limit=2"
    },
    "data": [
        {
            "id": 162,
            "title": "Ullam nihil sed",
            "artwork": "Ullam nihil sed",
            "artwork_id": null,
            "mobile_sound": "http:\/\/www.hamill.com\/",
            "mobile_sound_id": null,
            ...
        },
        {
            "id": 229,
            "title": "Velit eum illo",
            "artwork": "Velit eum illo",
            "artwork_id": null,
            "mobile_sound": "http:\/\/green.biz\/",
            "mobile_sound_id": null,
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

Example request: http://aggregator-data-test.artic.edu/api/v1/tour-stops/62?limit=2  
Example output:

```
{
    "data": {
        "id": 62,
        "title": "Paris Street; Rainy Day",
        "artwork": "Paris Street; Rainy Day",
        "artwork_id": null,
        "mobile_sound": "http:\/\/aicweb10.artic.edu\/sites\/default\/files\/audio\/792s.mp3",
        "mobile_sound_id": null,
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
        "total": 549,
        "limit": 2,
        "offset": 0,
        "total_pages": 275,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/mobile-sounds?page=2&limit=2"
    },
    "data": [
        {
            "id": 9996548,
            "title": "Optio voluptatem blanditiis",
            "link": "http:\/\/labadie.com\/commodi-natus-quidem-maxime-unde-eveniet.html",
            "transcript": "Ab ipsa minus quasi non. Sapiente dolor sed illum quaerat sunt voluptas architecto. Minus dolor deserunt nihil doloremque. Sint quaerat dicta nam a in.",
            "last_updated_source": null,
            "last_updated": "2017-10-30T09:26:54-05:00",
            ...
        },
        {
            "id": 9999116,
            "title": "Qui amet ipsa",
            "link": "https:\/\/www.goyette.info\/laboriosam-accusantium-tempora-omnis-quas-et-sunt-dignissimos-dolorem",
            "transcript": "Non recusandae aspernatur ut totam nemo voluptatum sed. Corrupti accusamus quod iure culpa molestias. Voluptas ut quas est aut quam nobis.",
            "last_updated_source": null,
            "last_updated": "2017-10-30T09:26:54-05:00",
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
        "link": "http:\/\/aicweb10.artic.edu\/sites\/default\/files\/audio\/757.mp3",
        "transcript": "&quot;Narrator:  Painted in the Netherlands in 1658, this masterly still life held a fascinating secret for many years. Curator Martha Wolff.\nMartha Wolff:  This painting is signed by Adriaen van der Spelt, a still life painter whose work is rather rare. But fairly recently, we realized that it&#039;s in fact a collaboration between van der Spelt and a more famous painter named Frans van Mieris who contributed the beautiful blue satin curtain that is drawn across part of the picture.\nNarrator:  The young artists had both just joined the Painters Gild in the City of Leiden, so this picture was probably a demonstration in their skill in the art of illusion.\nMartha Wolff:  And also a reflection of actual usage at the time, because Dutch collectors would use curtains to protect particularly exquisite pictures from light and also to give the viewer the thrill of pulling back the curtain and seeing what was displayed behind it. And you have multiple layers of illusion here because you have first the stone arch and then you have the garland that&#039;s draped in front of it, and then you have the curtain. And one of the most wonderful things is really the brass rod which plays off of the frame of the picture. It stands in front of it.&quot;",
        "last_updated_source": null,
        "last_updated": "2017-10-27T14:12:15-05:00",
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
        "total": 35,
        "limit": 2,
        "offset": 0,
        "total_pages": 18,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/publications?page=2&limit=2"
    },
    "data": [
        {
            "id": 9991702,
            "title": "Corrupti consequatur molestias",
            "web_url": "http:\/\/www.bruen.com\/suscipit-similique-nihil-ut-quod-aut-nesciunt-quod",
            "site": "autquasi",
            "alias": "suscipitest",
            "last_updated_source": null,
            ...
        },
        {
            "id": 9990945,
            "title": "Quae nobis magnam",
            "web_url": "https:\/\/hickle.com\/dolores-explicabo-dolorem-nisi-necessitatibus-nobis.html",
            "site": "undenulla",
            "alias": "aipsam",
            "last_updated_source": null,
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
        "total": 60,
        "limit": 10,
        "offset": 0,
        "total_pages": 6,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_id": "9998328",
            "api_model": "publications",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/publications\/9998328",
            "id": 9998328,
            "title": "Qui enim vel",
            "timestamp": "2017-10-30T16:32:52-05:00"
        },
        {
            "_score": 1,
            "api_id": "140019",
            "api_model": "publications",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/publications\/140019",
            "id": 140019,
            "title": "Manet Paintings and Works on Paper at the Art Institute of Chicago",
            "timestamp": "2017-11-13T15:37:34-06:00"
        },
        {
            "_score": 1,
            "api_id": "9990049",
            "api_model": "publications",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/publications\/9990049",
            "id": 9990049,
            "title": "Cumque animi et",
            "timestamp": "2017-11-13T15:44:09-06:00"
        }
    ],
    "aggregations": {
        "count_api_model": [
            {
                "key": "publications",
                "doc_count": 60
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
        "web_url": "https:\/\/publications.artic.edu\/caillebotte\/reader\/paintingsanddrawings",
        "site": "caillebotte",
        "alias": "paintingsanddrawings",
        "last_updated_source": null,
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
        "total": 895,
        "limit": 2,
        "offset": 0,
        "total_pages": 448,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/sections?page=2&limit=2"
    },
    "data": [
        {
            "id": 9995033,
            "title": "Distinctio deleniti sit",
            "web_url": "http:\/\/www.schuppe.net\/totam-aliquid-est-dolores-ipsam-perferendis-repudiandae-maiores",
            "accession": "1914.084",
            "revision": 1480797384,
            "source_id": 22056,
            ...
        },
        {
            "id": 9991251,
            "title": "Cumque odio reiciendis",
            "web_url": "https:\/\/mcdermott.com\/commodi-velit-culpa-voluptatem-reiciendis-facilis-est-provident.html",
            "accession": "1930.902",
            "revision": 1364204535,
            "source_id": 38127,
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
        "total": 569,
        "limit": 10,
        "offset": 0,
        "total_pages": 57,
        "current_page": 1
    },
    "data": [
        {
            "_score": 10.018661,
            "api_id": "111401",
            "api_model": "sections",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/sections\/111401",
            "id": 111401,
            "title": "Sheet 3F",
            "timestamp": "2017-11-13T15:38:02-06:00"
        },
        {
            "_score": 1,
            "api_id": "9990311",
            "api_model": "sections",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/sections\/9990311",
            "id": 9990311,
            "title": "Modi non autem",
            "timestamp": "2017-10-30T16:32:52-05:00"
        },
        {
            "_score": 1,
            "api_id": "9994543",
            "api_model": "sections",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/sections\/9994543",
            "id": 9994543,
            "title": "Quod adipisci sunt",
            "timestamp": "2017-10-30T16:32:52-05:00"
        }
    ],
    "aggregations": {
        "count_api_model": [
            {
                "key": "sections",
                "doc_count": 569
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
        "web_url": "https:\/\/publications.artic.edu\/roman\/reader\/romanart\/section\/1974",
        "accession": null,
        "revision": 1502910278,
        "source_id": 1974,
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
        "total": 25,
        "limit": 2,
        "offset": 0,
        "total_pages": 13,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/sites?page=2&limit=2"
    },
    "data": [
        {
            "id": 9996300,
            "title": "Deleniti veniam necessitatibus",
            "description": "Cupiditate quisquam ex est ut et. Quis aperiam consequuntur ex itaque dolor. Atque ratione soluta qui sed magnam soluta. Ducimus sed enim dolorem minima. Reprehenderit qui esse expedita cupiditate.",
            "link": "http:\/\/bernhard.com\/consequatur-esse-dolore-quia-et-ex-quasi",
            "exhibition": "Fugiat Qui Necessitatibus",
            "exhibition_id": 999464502,
            ...
        },
        {
            "id": 9994789,
            "title": "Et blanditiis neque",
            "description": "Quasi ut ducimus mollitia voluptas. Odit neque saepe explicabo odit nihil. Mollitia quaerat exercitationem qui in. Dolores possimus cumque odit ex voluptatem. Ut qui autem est quia eveniet fuga commodi quos. Repudiandae dolore voluptatem non non tempora. Aut cupiditate deleniti corrupti repellendus.",
            "link": "http:\/\/koss.com\/non-iusto-velit-minus.html",
            "exhibition": "Eos Inventore Earum",
            "exhibition_id": 999010659,
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
        "total": 25,
        "limit": 10,
        "offset": 0,
        "total_pages": 3,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_id": "9991306",
            "api_model": "sites",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/sites\/9991306",
            "id": 9991306,
            "title": "Sit est est",
            "timestamp": "2017-10-30T16:32:53-05:00"
        },
        {
            "_score": 1,
            "api_id": "9992202",
            "api_model": "sites",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/sites\/9992202",
            "id": 9992202,
            "title": "Dolore incidunt dicta",
            "timestamp": "2017-10-30T16:32:53-05:00"
        },
        {
            "_score": 1,
            "api_id": "9992555",
            "api_model": "sites",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/sites\/9992555",
            "id": 9992555,
            "title": "Qui et id",
            "timestamp": "2017-10-30T16:32:53-05:00"
        }
    ],
    "aggregations": {
        "count_api_model": [
            {
                "key": "sites",
                "doc_count": 25
            }
        ]
    }
}
```

### `/sites/{id}`

A single sites by the given identifier.

Example request: http://aggregator-data-test.artic.edu/api/v1/sites/9996300?limit=2  
Example output:

```
{
    "data": {
        "id": 9996300,
        "title": "Deleniti veniam necessitatibus",
        "description": "Cupiditate quisquam ex est ut et. Quis aperiam consequuntur ex itaque dolor. Atque ratione soluta qui sed magnam soluta. Ducimus sed enim dolorem minima. Reprehenderit qui esse expedita cupiditate.",
        "link": "http:\/\/bernhard.com\/consequatur-esse-dolore-quia-et-ex-quasi",
        "exhibition": "Fugiat Qui Necessitatibus",
        "exhibition_id": 999464502,
        ...
    }
}
```

> Generated by `php artisan docs:endpoints` on 2017-11-13 17:38:07
