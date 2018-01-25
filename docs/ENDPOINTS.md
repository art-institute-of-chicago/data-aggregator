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
        "total": 106508,
        "limit": 2,
        "offset": 0,
        "total_pages": 53254,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/artworks?page=2&limit=2"
    },
    "data": [
        {
            "id": 999885144,
            "title": "Illum Incidunt Voluptatum Placeat",
            "lake_guid": "99999999-9999-9999-9999-999999555136",
            "alternate_titles": [],
            "main_reference_number": "1944.398",
            "date_start": 2002,
            ...
        },
        {
            "id": 999646348,
            "title": "Magnam Voluptatibus Modi Aut",
            "lake_guid": "99999999-9999-9999-9999-999999668145",
            "alternate_titles": [],
            "main_reference_number": "2012.594",
            "date_start": 1988,
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
            "id": 156474,
            "title": "Relaxing in the Shade",
            "lake_guid": "da31a3fc-9d34-fe35-ee60-c4f08e1b1531",
            "alternate_titles": [],
            "main_reference_number": "2000.475",
            "date_start": 1927,
            ...
        },
        {
            "id": 4575,
            "title": "Judith",
            "lake_guid": "abd92a83-28ee-6255-d1f3-8354a9f39e08",
            "alternate_titles": [],
            "main_reference_number": "1956.1109",
            "date_start": 1495,
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
        "total": 10574,
        "limit": 10,
        "offset": 0,
        "total_pages": 1058,
        "current_page": 1
    },
    "data": [
        {
            "_score": 14.844946,
            "api_id": "16499",
            "api_model": "artworks",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/artworks\/16499",
            "id": 16499,
            "title": "Jesus Mocked by the Soldiers",
            "timestamp": "2018-01-25T04:18:15-06:00"
        },
        {
            "_score": 14.553251,
            "api_id": "16571",
            "api_model": "artworks",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/artworks\/16571",
            "id": 16571,
            "title": "Arrival of the Normandy Train, Gare Saint-Lazare",
            "timestamp": "2018-01-25T04:18:12-06:00"
        },
        {
            "_score": 14.367294,
            "api_id": "44892",
            "api_model": "artworks",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/artworks\/44892",
            "id": 44892,
            "title": "Fish (Still Life)",
            "timestamp": "2018-01-25T04:14:20-06:00"
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
                "doc_count": 10574
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
        "alternate_titles": [],
        "main_reference_number": "1942.51",
        "date_start": 1941,
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
            "title": "Hopper, Edward",
            "lake_guid": "cba02485-5b76-1e48-bb85-2f9d0f3e3c57",
            "alternate_titles": [],
            "birth_date": null,
            "birth_place": null,
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
            "id": 147,
            "title": "architecture",
            "lake_guid": "965e725e-1275-ff04-6e9f-8b207eeb28ec",
            "parent_id": null,
            "is_in_nav": false,
            "description": null,
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
            "id": 150,
            "title": "views through windows",
            "lake_guid": "cefecb9f-0be9-6023-1188-294ad5ac7e27",
            "parent_id": null,
            "is_in_nav": false,
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
            "id": 41,
            "title": "Featured Works",
            "lake_guid": "ae637a2b-e996-a28e-7ca8-adae24ae01fa",
            "parent_id": 2,
            "is_in_nav": true,
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
            "id": 48,
            "title": "American Modernism",
            "lake_guid": "795eda4e-6c99-1e9f-3283-5aaaad27f857",
            "parent_id": 2,
            "is_in_nav": true,
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
            "id": 365,
            "title": "Art Access: Modern and Contemporary Art",
            "lake_guid": "b3743235-8d0d-a381-8582-95dfcad26711",
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
            "id": 109,
            "title": "Art Institute Icons",
            "lake_guid": "74c96fd4-5e7e-4b56-26f3-0a911d8fe63b",
            "parent_id": null,
            "is_in_nav": true,
            "description": "As an encyclopedic museum of art, the Art Institute has works from around the globe representing over 5,000 years of human artistic creation. In the Art Institute Icons theme, find iconic works of art that demonstrate the diversity and distinction of the museum\u2019s holdings.",
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
            "id": 801,
            "title": "Art Resource",
            "lake_guid": "4a87fc2b-ddde-03db-3d5b-8a4e65c2ca26",
            "parent_id": null,
            "is_in_nav": false,
            "description": "Art Resource is a website where you can license high resolution images from The Art Institute of Chicago.",
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
            "type": "image",
            "description": null,
            "content": null,
            "category_ids": [],
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
        "total": 11636,
        "limit": 2,
        "offset": 0,
        "total_pages": 5818,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/agents?page=2&limit=2"
    },
    "data": [
        {
            "id": 999043073,
            "title": "McClure, Harmony",
            "lake_guid": "99999999-9999-9999-9999-999999141766",
            "alternate_titles": [],
            "birth_date": 1995,
            "birth_place": "Cuba",
            ...
        },
        {
            "id": 999230726,
            "title": "Witting, Tracey",
            "lake_guid": "99999999-9999-9999-9999-999999827568",
            "alternate_titles": [],
            "birth_date": 1984,
            "birth_place": "Somalia",
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
        "total": 11636,
        "limit": 10,
        "offset": 0,
        "total_pages": 1164,
        "current_page": 1
    },
    "data": [
        {
            "_score": 8.377342,
            "api_id": "90583",
            "api_model": "agents",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/agents\/90583",
            "id": 90583,
            "title": "Rich, Felicity",
            "timestamp": "2018-01-24T23:37:00-06:00"
        },
        {
            "_score": 8.377342,
            "api_id": "43060",
            "api_model": "agents",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/agents\/43060",
            "id": 43060,
            "title": "Ward, Sheila",
            "timestamp": "2018-01-24T23:39:21-06:00"
        },
        {
            "_score": 8.377342,
            "api_id": "43714",
            "api_model": "agents",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/agents\/43714",
            "id": 43714,
            "title": "Wynkoop, Cornelius",
            "timestamp": "2018-01-24T23:44:55-06:00"
        }
    ],
    "aggregations": {
        "count_api_model": [
            {
                "key": "agents",
                "doc_count": 11636
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
        "total": 11636,
        "limit": 2,
        "offset": 0,
        "total_pages": 5818,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/agents?page=2&limit=2"
    },
    "data": [
        {
            "id": 999043073,
            "title": "McClure, Harmony",
            "lake_guid": "99999999-9999-9999-9999-999999141766",
            "alternate_titles": [],
            "birth_date": 1995,
            "birth_place": "Cuba",
            ...
        },
        {
            "id": 999230726,
            "title": "Witting, Tracey",
            "lake_guid": "99999999-9999-9999-9999-999999827568",
            "alternate_titles": [],
            "birth_date": 1984,
            "birth_place": "Somalia",
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
        "total": 57,
        "limit": 2,
        "offset": 0,
        "total_pages": 29,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/departments?page=2&limit=2"
    },
    "data": [
        {
            "id": 999719446,
            "title": "Dolore Art",
            "lake_guid": "99999999-9999-9999-9999-999999380551",
            "last_updated_fedora": "2017-04-15T03:56:12-05:00",
            "last_updated_source": "2017-06-11T16:42:47-05:00",
            "last_updated": "2018-01-25T13:26:19-06:00",
            ...
        },
        {
            "id": 999690027,
            "title": "Aliquam Art",
            "lake_guid": "99999999-9999-9999-9999-999999936017",
            "last_updated_fedora": "2018-01-07T09:28:36-06:00",
            "last_updated_source": "2017-02-10T10:11:02-06:00",
            "last_updated": "2018-01-25T13:26:19-06:00",
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
            "api_id": "423",
            "api_model": "departments",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/departments\/423",
            "id": 423,
            "title": "Design and Construction",
            "timestamp": "2018-01-24T23:51:34-06:00"
        },
        {
            "_score": 1,
            "api_id": "84",
            "api_model": "departments",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/departments\/84",
            "id": 84,
            "title": "Museum Registrar",
            "timestamp": "2018-01-24T23:51:34-06:00"
        },
        {
            "_score": 1,
            "api_id": "89",
            "api_model": "departments",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/departments\/89",
            "id": 89,
            "title": "Conservation",
            "timestamp": "2018-01-24T23:51:34-06:00"
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
        "last_updated_source": "2017-11-06T15:36:36-06:00",
        "last_updated": "2018-01-24T23:51:34-06:00",
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
        "total": 66,
        "limit": 2,
        "offset": 0,
        "total_pages": 33,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/object-types?page=2&limit=2"
    },
    "data": [
        {
            "id": 99909,
            "title": "Drawing and Aut",
            "lake_guid": "99999999-9999-9999-9999-999999358095",
            "last_updated_fedora": "2017-07-24T02:32:22-05:00",
            "last_updated_source": "2017-09-29T06:52:57-05:00",
            "last_updated": "2018-01-25T13:26:20-06:00",
            ...
        },
        {
            "id": 99910,
            "title": "Sculpture",
            "lake_guid": "99999999-9999-9999-9999-999999810609",
            "last_updated_fedora": "2017-10-24T05:21:58-05:00",
            "last_updated_source": "2017-12-19T03:46:14-06:00",
            "last_updated": "2018-01-25T13:26:20-06:00",
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
        "last_updated_fedora": "2018-01-12T13:57:42-06:00",
        "last_updated_source": "2018-01-12T13:58:01-06:00",
        "last_updated": "2018-01-24T23:51:37-06:00",
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
            "id": 999145688,
            "title": "Nobis",
            "lake_guid": "99999999-9999-9999-9999-999999218960",
            "parent_id": 999200522,
            "is_in_nav": false,
            "description": "In totam id fugit magni ipsam et. Quod non ullam ut quos numquam quis voluptas. Consequuntur ea ipsum et sit id officiis. Quis quo sint magnam id qui asperiores error.",
            ...
        },
        {
            "id": 999309035,
            "title": "Magni",
            "lake_guid": "99999999-9999-9999-9999-999999395393",
            "parent_id": 999724543,
            "is_in_nav": false,
            "description": "Soluta qui unde consequatur sequi. Repudiandae similique et distinctio eius.",
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
            "timestamp": "2018-01-24T23:51:42-06:00"
        },
        {
            "_score": 1,
            "api_id": "302",
            "api_model": "categories",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/categories\/302",
            "id": 302,
            "title": "Silk Road Chicago",
            "timestamp": "2018-01-24T23:51:42-06:00"
        },
        {
            "_score": 1,
            "api_id": "227",
            "api_model": "categories",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/categories\/227",
            "id": 227,
            "title": "photograph",
            "timestamp": "2018-01-24T23:51:43-06:00"
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
        "total": 38,
        "limit": 2,
        "offset": 0,
        "total_pages": 19,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/agent-types?page=2&limit=2"
    },
    "data": [
        {
            "id": 99965,
            "title": "Individual",
            "lake_guid": "99999999-9999-9999-9999-999999854753",
            "last_updated_fedora": "2017-09-16T16:10:41-05:00",
            "last_updated_source": "2017-07-29T18:31:29-05:00",
            "last_updated": "2018-01-25T13:27:56-06:00",
            ...
        },
        {
            "id": 99971,
            "title": "magnam quam",
            "lake_guid": "99999999-9999-9999-9999-999999286886",
            "last_updated_fedora": "2017-07-18T21:47:21-05:00",
            "last_updated_source": "2017-05-28T01:02:45-05:00",
            "last_updated": "2018-01-25T13:27:56-06:00",
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
        "last_updated_fedora": "2018-01-12T13:31:20-06:00",
        "last_updated_source": "2018-01-12T13:31:23-06:00",
        "last_updated": "2018-01-24T23:28:00-06:00",
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
        "total": 319,
        "limit": 2,
        "offset": 0,
        "total_pages": 160,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/places?page=2&limit=2"
    },
    "data": [
        {
            "id": 999148293,
            "title": "Pfannerstill Hall",
            "lake_guid": "99999999-9999-9999-9999-999999756931",
            "latitude": 64.67,
            "longitude": 45.06,
            "latlon": "64.67,45.06",
            ...
        },
        {
            "id": 999763732,
            "title": "Gallery 357",
            "lake_guid": "99999999-9999-9999-9999-999999814883",
            "latitude": -25.3,
            "longitude": -92.84,
            "latlon": "-25.3,-92.84",
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
        "total": 319,
        "limit": 10,
        "offset": 0,
        "total_pages": 32,
        "current_page": 1
    },
    "data": [
        {
            "_score": 5.0133753,
            "api_id": "23972",
            "api_model": "places",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/places\/23972",
            "id": 23972,
            "title": "Gallery 297B",
            "timestamp": "2018-01-24T23:53:15-06:00"
        },
        {
            "_score": 1,
            "api_id": "2147483626",
            "api_model": "places",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/places\/2147483626",
            "id": 2147483626,
            "title": "Gallery 211",
            "timestamp": "2018-01-24T23:53:15-06:00"
        },
        {
            "_score": 1,
            "api_id": "2147483601",
            "api_model": "places",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/places\/2147483601",
            "id": 2147483601,
            "title": "Gallery 226",
            "timestamp": "2018-01-24T23:53:15-06:00"
        }
    ],
    "aggregations": {
        "count_api_model": [
            {
                "key": "places",
                "doc_count": 319
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
        "latitude": 41.88,
        "longitude": -87.62,
        "latlon": "41.88,-87.62",
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
        "total": 5992,
        "limit": 2,
        "offset": 0,
        "total_pages": 2996,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/exhibitions?page=2&limit=2"
    },
    "data": [
        {
            "id": 999453187,
            "title": "Quo Qui Non",
            "lake_guid": "99999999-9999-9999-9999-999999643493",
            "description": "Corporis corrupti corrupti qui nemo. Velit sequi aut eos quis. Consequatur consequatur quisquam sint quis voluptatibus.",
            "type": "AIC Only",
            "status": "Closed",
            ...
        },
        {
            "id": 999882513,
            "title": "Est Ad Maiores",
            "lake_guid": "99999999-9999-9999-9999-999999442241",
            "description": "Rerum iste nam autem fugit odio. Nam natus eius sit nihil. Minus vitae voluptatum corporis. Sequi maiores sed sapiente dignissimos vel aut cum a.",
            "type": "AIC & Other Venues",
            "status": "Open",
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
        "total": 5992,
        "limit": 10,
        "offset": 0,
        "total_pages": 600,
        "current_page": 1
    },
    "data": [
        {
            "_score": 7.731018,
            "api_id": "6596",
            "api_model": "exhibitions",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/exhibitions\/6596",
            "id": 6596,
            "title": "The Age of Louis XV: French Paintings from 1710-1774",
            "timestamp": "2018-01-25T10:10:03-06:00"
        },
        {
            "_score": 7.731018,
            "api_id": "4796",
            "api_model": "exhibitions",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/exhibitions\/4796",
            "id": 4796,
            "title": "Art Students' League of Chicago 23rd Annual",
            "timestamp": "2018-01-25T10:10:12-06:00"
        },
        {
            "_score": 7.731018,
            "api_id": "4758",
            "api_model": "exhibitions",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/exhibitions\/4758",
            "id": 4758,
            "title": "Junior Museum: Manet's Mirror",
            "timestamp": "2018-01-25T10:11:08-06:00"
        }
    ],
    "aggregations": {
        "count_api_model": [
            {
                "key": "exhibitions",
                "doc_count": 5992
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
        "description": "Were the Impressionists fashionistas? And what role did fashion play in their goal to paint modern life with a \u201cmodern\u201d style? This is the subject of the internationally acclaimed exhibition Impressionism, Fashion, and Modernity, the first to uncover the fascinating relationship between art and fashion from the mid-1860s through the mid-1880s as Paris became the style capital of the world. Featuring 75 major figure paintings by Caillebotte, Degas, Manet, Monet, Renoir, and Seurat, including many never before seen in North America, this stylish show presents a new perspective on the Impressionists\u2014revealing how these early avant-garde artists embraced fashion trends as they sought to capture modern life on canvas.\n\nIn the second half of the 19th century, the modern fashion industry was born: designers like Charles Frederick Worth were transforming how clothing was made and marketed, department stores were on the rise, and fashion magazines were beginning to proliferate. Visual artists and writers alike were intrigued by this new industry; its dynamic, ephemeral, and constantly innovative qualities embodied the very essence of modernity that they sought to express in their work and offered a means of discovering new visual and verbal expressions.\n\nThis groundbreaking exhibition explores the vital relationship between fashion and art during these pivotal years not only through the masterworks by Impressionists but also with paintings by fashion portraitists Jean B\u00e9raud, Carolus-Duran, Alfred Stevens, and James Tissot. Period costumes such as men\u2019s suits, robes de promenade, day dresses, and ball gowns, along with fashion plates, photographs, and popular prints offer a firsthand look at the apparel these artists used to convey their modernity as well as that of their subjects. Further enriching the display are fabrics and accessories\u2014lace, silks, velvets, and satins found in hats, parasols, gloves, and shoes\u2014recreating the sensory experience that made fashion an industry favorite and a serious subject among painters, writers, poets, and the popular press.\n\nTruly bringing the exhibition to life are the vivid connections between the most up-to-the-minute fashions and the painted transformations of the same styles. Pairing life-size figure paintings by Monet, Renoir, or Tissot with the contemporary outfits that inspired them, the show invites inquiry into the difference between portrait and genre painting, between Tissot\u2019s painted fashion plates and Manet\u2019s images of life experienced, demonstrating for the first time the means by which the Impressionists \u201cfashioned\u201d their models\u2014and paintings\u2014for larger artistic goals.",
        "type": "AIC & Other Venues",
        "status": "Closed",
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
            "agent": "Art Institute of Chicago",
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
        "total": 110247,
        "limit": 2,
        "offset": 0,
        "total_pages": 55124,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/images?page=2&limit=2"
    },
    "data": [
        {
            "id": "99999999-9999-9999-9999-999999141446",
            "title": "Rerum Sapiente Harum",
            "type": "image",
            "description": "Porro qui delectus porro doloribus sint vitae consequatur. Repellat sed harum a voluptas. Impedit sit adipisci et in dolores.",
            "content": "http:\/\/www.bruen.com\/asperiores-at-non-cum-qui-omnis",
            "category_ids": [
                999985182,
                999460659
            ],
            ...
        },
        {
            "id": "99999999-9999-9999-9999-999999215212",
            "title": "Impedit Impedit Et",
            "type": "image",
            "description": "Rerum voluptates unde voluptas placeat in perferendis at. Vel veritatis et excepturi consequuntur qui quia consequatur. Repellendus fuga quia quae. Eos quam rerum quam recusandae.",
            "content": "https:\/\/bogisich.biz\/enim-animi-iusto-mollitia-et-quia-expedita-nam.html",
            "category_ids": [
                999596527,
                999917045,
                999460659,
                999390606
            ],
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
        "total": 110196,
        "limit": 10,
        "offset": 0,
        "total_pages": 11020,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_id": "efc9a39f-2ecd-3fed-c2b4-d44553b52742",
            "api_model": "images",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/images\/efc9a39f-2ecd-3fed-c2b4-d44553b52742",
            "id": "efc9a39f-2ecd-3fed-c2b4-d44553b52742",
            "title": "PH_03535",
            "timestamp": "2018-01-25T05:44:46-06:00"
        },
        {
            "_score": 1,
            "api_id": "b099a33e-f64c-d560-22a2-06686e82a4b4",
            "api_model": "images",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/images\/b099a33e-f64c-d560-22a2-06686e82a4b4",
            "id": "b099a33e-f64c-d560-22a2-06686e82a4b4",
            "title": "PD_06757",
            "timestamp": "2018-01-25T05:44:46-06:00"
        },
        {
            "_score": 1,
            "api_id": "d94d90a4-ad30-7de0-12a9-4e583fd045c7",
            "api_model": "images",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/images\/d94d90a4-ad30-7de0-12a9-4e583fd045c7",
            "id": "d94d90a4-ad30-7de0-12a9-4e583fd045c7",
            "title": "PD_06765",
            "timestamp": "2018-01-25T05:44:46-06:00"
        }
    ],
    "aggregations": {
        "count_api_model": [
            {
                "key": "images",
                "doc_count": 110196
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
        "type": "image",
        "description": null,
        "content": null,
        "category_ids": [],
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
        "total": 337,
        "limit": 2,
        "offset": 0,
        "total_pages": 169,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/videos?page=2&limit=2"
    },
    "data": [
        {
            "id": "99999999-9999-9999-9999-999999129278",
            "title": "Consequatur Incidunt Dolores",
            "type": "video",
            "description": "Suscipit dolor aut autem incidunt voluptates autem. Voluptatem minima quis natus beatae. Aut dolor corporis nemo occaecati quia ut commodi.",
            "content": "http:\/\/www.purdy.com\/",
            "category_ids": [
                999596527,
                999682299
            ],
            ...
        },
        {
            "id": "99999999-9999-9999-9999-999999215800",
            "title": "Ut Sunt Explicabo",
            "type": "video",
            "description": "Et voluptatem ut quae similique qui. Quos nobis voluptas repellendus facere. Iure est qui vel similique adipisci error corporis. Enim aut sed nostrum vero distinctio nisi.",
            "content": "https:\/\/boehm.com\/qui-perspiciatis-et-deserunt-veniam-cupiditate-ducimus-alias.html",
            "category_ids": [
                999596527,
                999200522,
                999360338,
                999777672
            ],
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
            "_score": 1,
            "api_id": "a618fd16-d028-5264-6f4b-7da5158fc9cb",
            "api_model": "videos",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/videos\/a618fd16-d028-5264-6f4b-7da5158fc9cb",
            "id": "a618fd16-d028-5264-6f4b-7da5158fc9cb",
            "title": "Video: Case Studies in Modern and Contemporary Sculpture: David Smith and Anthony Caro",
            "timestamp": "2018-01-25T05:40:20-06:00"
        },
        {
            "_score": 1,
            "api_id": "e3150fa7-baa4-3295-6ce0-5106c416ede6",
            "api_model": "videos",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/videos\/e3150fa7-baa4-3295-6ce0-5106c416ede6",
            "id": "e3150fa7-baa4-3295-6ce0-5106c416ede6",
            "title": "Video: Lecture by Ragnar Kjartansson",
            "timestamp": "2018-01-25T05:40:20-06:00"
        },
        {
            "_score": 1,
            "api_id": "b7326b1f-5f46-3681-3a00-becd4c71e662",
            "api_model": "videos",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/videos\/b7326b1f-5f46-3681-3a00-becd4c71e662",
            "id": "b7326b1f-5f46-3681-3a00-becd4c71e662",
            "title": "Panorama: Gallery 206",
            "timestamp": "2018-01-25T05:40:16-06:00"
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
        "type": "video",
        "description": "An introduction to Cassatt's paintings of women involved in morning activities in the privacy of their bourgeois homes.",
        "content": null,
        "category_ids": [],
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
        "total": 171,
        "limit": 2,
        "offset": 0,
        "total_pages": 86,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/links?page=2&limit=2"
    },
    "data": [
        {
            "id": "99999999-9999-9999-9999-999999100487",
            "title": "Dolor Dolores Est",
            "type": "link",
            "description": "Voluptate illo excepturi provident. Quo perferendis et nulla aut. Illum molestiae ducimus illum dolores dolorem ipsa voluptatibus et.",
            "content": "http:\/\/pagac.net\/et-dolor-aspernatur-itaque-est-quo-inventore",
            "category_ids": [
                999985182,
                999460659
            ],
            ...
        },
        {
            "id": "99999999-9999-9999-9999-999999113367",
            "title": "Nisi Dolorum Perspiciatis",
            "type": "link",
            "description": "Eum fugiat sint iure consequuntur veritatis enim. Et qui praesentium maxime enim vitae rerum eius quia. Nemo voluptatem vel quam iusto architecto est adipisci quae. Ab optio ab et nihil deserunt quisquam.",
            "content": "http:\/\/www.schulist.com\/",
            "category_ids": [
                999766397,
                999028140,
                999240906
            ],
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
            "_score": 1,
            "api_id": "763ab38a-d299-ccf6-b35b-e918d09550c3",
            "api_model": "links",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/links\/763ab38a-d299-ccf6-b35b-e918d09550c3",
            "id": "763ab38a-d299-ccf6-b35b-e918d09550c3",
            "title": "The Alfred Stieglitz Collection at the Art Institute of Chicago",
            "timestamp": "2018-01-25T05:39:57-06:00"
        },
        {
            "_score": 1,
            "api_id": "12af57aa-9338-35a0-bd9c-658bb31e9d3f",
            "api_model": "links",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/links\/12af57aa-9338-35a0-bd9c-658bb31e9d3f",
            "id": "12af57aa-9338-35a0-bd9c-658bb31e9d3f",
            "title": "Turning the Pages: Jacques-Louis David, (French, 1748\u20131825) Sketchbook, 1809\/10",
            "timestamp": "2018-01-25T05:39:57-06:00"
        },
        {
            "_score": 1,
            "api_id": "4bb1b351-0f9f-2c28-b2a3-610406705922",
            "api_model": "links",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/links\/4bb1b351-0f9f-2c28-b2a3-610406705922",
            "id": "4bb1b351-0f9f-2c28-b2a3-610406705922",
            "title": "Online Catalogue: Whistler and Roussel: Linked Visions ",
            "timestamp": "2018-01-25T05:39:58-06:00"
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
        "type": "link",
        "description": "Information on planning a student tour: application dates, reservation and museum contact information. ",
        "content": "http:\/\/www.artic.edu\/aic\/students\/tours\/index.html",
        "category_ids": [],
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
        "total": 1045,
        "limit": 2,
        "offset": 0,
        "total_pages": 523,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/sounds?page=2&limit=2"
    },
    "data": [
        {
            "id": "99999999-9999-9999-9999-999999109002",
            "title": "Cumque Exercitationem Ipsa",
            "type": "sound",
            "description": "Qui molestiae rerum fugit laudantium magni necessitatibus. Non ex temporibus libero pariatur ut. Perferendis dolore enim vero consequatur qui est velit. Aut voluptatem sint et beatae saepe adipisci id.",
            "content": "http:\/\/www.cassin.info\/ut-quibusdam-consequatur-non-dolorem-ducimus-et",
            "category_ids": [
                999360338,
                999766397
            ],
            ...
        },
        {
            "id": "99999999-9999-9999-9999-999999174406",
            "title": "Labore Dignissimos Nihil",
            "type": "sound",
            "description": "Provident quia dolore ullam aut optio voluptas sed. Qui qui ullam totam officia. Nihil eveniet enim cupiditate est atque consequatur exercitationem.",
            "content": "http:\/\/homenick.net\/assumenda-ad-eligendi-optio-perspiciatis-in-commodi-sunt",
            "category_ids": [
                999596527,
                999570814,
                999769770,
                999028140
            ],
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
            "_score": 1,
            "api_id": "bb9570c9-ca4b-a564-1a51-89d5cef11408",
            "api_model": "sounds",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/sounds\/bb9570c9-ca4b-a564-1a51-89d5cef11408",
            "id": "bb9570c9-ca4b-a564-1a51-89d5cef11408",
            "title": "Audio Lecture: Sustaining Fellows Exhibition Opening: <em>Windows on the War\u2014Soviet TASS Posters at Home and Abroad, 1941\u20131945<\/em>",
            "timestamp": "2018-01-25T05:43:11-06:00"
        },
        {
            "_score": 1,
            "api_id": "3670aba4-56e1-1f0d-768b-b4dba580f1a9",
            "api_model": "sounds",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/sounds\/3670aba4-56e1-1f0d-768b-b4dba580f1a9",
            "id": "3670aba4-56e1-1f0d-768b-b4dba580f1a9",
            "title": "Audio: Sustaining Fellows Annual Meeting",
            "timestamp": "2018-01-25T05:43:12-06:00"
        },
        {
            "_score": 1,
            "api_id": "77c2386d-67d8-682c-6b7f-63642a6406d9",
            "api_model": "sounds",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/sounds\/77c2386d-67d8-682c-6b7f-63642a6406d9",
            "id": "77c2386d-67d8-682c-6b7f-63642a6406d9",
            "title": "Audio Lecture: Symposium\u2014Material Witness: Documentary since the 1940s (Jason Hill)",
            "timestamp": "2018-01-25T05:43:12-06:00"
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
        "type": "sound",
        "description": "<p>Tune in as contemporary photographer Mann answers questions from an audience of nearly 400 on opening day of the Art Institute exhibition <em>So the Story Goes<\/em>. Mann responds to questions ranging from printing techniques to subject matter, from disbelief in photographic \"truth\" to a Southern weakness for the romantic.<\/p>",
        "content": null,
        "category_ids": [],
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
        "total": 626,
        "limit": 2,
        "offset": 0,
        "total_pages": 313,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/texts?page=2&limit=2"
    },
    "data": [
        {
            "id": "99999999-9999-9999-9999-999999253812",
            "title": "Commodi Rerum Quia",
            "type": "text",
            "description": "Ut est in nemo alias cumque porro velit est. Cupiditate id iste voluptatem atque quia velit vel. Voluptatem nesciunt praesentium maxime iusto in laborum. Ea qui aliquam sint nam.",
            "content": "https:\/\/okon.biz\/omnis-repudiandae-amet-quo-non-in.html",
            "category_ids": [
                999309035,
                999570814,
                999769770
            ],
            ...
        },
        {
            "id": "99999999-9999-9999-9999-999999304467",
            "title": "Maxime Soluta Temporibus",
            "type": "text",
            "description": "Assumenda quasi dicta voluptas velit et non. Minus provident a voluptates quidem. Et laudantium illo pariatur ut. Nihil nostrum aliquam ut molestiae.",
            "content": "http:\/\/www.aufderhar.com\/et-corporis-quidem-et-necessitatibus-sit-blanditiis.html",
            "category_ids": [
                999853349,
                999240906
            ],
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
            "_score": 1,
            "api_id": "745f3ea9-c921-ec1b-c497-243f4a820085",
            "api_model": "texts",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/texts\/745f3ea9-c921-ec1b-c497-243f4a820085",
            "id": "745f3ea9-c921-ec1b-c497-243f4a820085",
            "title": "Related Story: VIEW Mary Reynolds and Marcel Duchamp",
            "timestamp": "2018-01-25T05:41:01-06:00"
        },
        {
            "_score": 1,
            "api_id": "a6f0fab5-a61f-6098-b921-82232067b495",
            "api_model": "texts",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/texts\/a6f0fab5-a61f-6098-b921-82232067b495",
            "id": "a6f0fab5-a61f-6098-b921-82232067b495",
            "title": "Related Story: VIEW References to Judaism",
            "timestamp": "2018-01-25T05:41:02-06:00"
        },
        {
            "_score": 1,
            "api_id": "4609dd6f-c726-1a6b-e626-01741405670b",
            "api_model": "texts",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/texts\/4609dd6f-c726-1a6b-e626-01741405670b",
            "id": "4609dd6f-c726-1a6b-e626-01741405670b",
            "title": "Related Story: VIEW Latin American Modern Artists at the Museum",
            "timestamp": "2018-01-25T05:41:05-06:00"
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
        "type": "text",
        "description": "An exploration of Rodin's ability to convey physical and emotional torment in his towering sculpture of Adam.",
        "content": "With his right leg raised and his torso tensed and wrenched into an unnatural position, Auguste Rodin\u2019s <em>Adam<\/em> appears horribly disfigured, despite his idealized proportions and serene facial expression. His right arm and hand, perhaps drawn from Michelangelo\u2019s figure of Adam at the center of the Sistine Chapel ceiling, point emphatically downward, as if to indicate the fall of man, while his left hand desperately clutches his right knee. \"I . . . tried to express the inner feelings of the man by the mobility of the muscles,\" wrote the artist about this piece. The rigid musculature of the figure\u2019s hands and legs, the twisted trunk of the body, and the emphatic straining of the head, as neck and shoulder collapse into a nearly horizontal plane, all serve to convey a sense of physical pain, certainly related to the emotional torment of having been banished by God from Paradise. <br><br>\n Rodin originally intended his towering, contorted sculpture of <em>Adam<\/em> and its pendant, <em>Eve<\/em>, to flank the <em>Gates of Hell<\/em>, a monumental bronze doorway of bas-reliefs illustrating various cantos from Dante\u2019s <em>Divine Comedy<\/em>. The doorway\u2014capped by looming representations of the three shades, which repeat the basic form of Adam\u2014was commissioned by the French government in 1880 for a new museum of decorative arts in Paris. The museum was never built, and Rodin left the portal unfinished at his death. Nevertheless, the project became well known during the artist\u2019s lifetime, for he cast individual figures and groups, some of which appeared in a large exhibition of works by Rodin and Claude Monet held at the prestigious Parisian gallery of Georges Petit in 1889.",
        "category_ids": [],
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
            "title": "Explicabo corporis qui numquam aliquid",
            "link": "https:\/\/runolfsdottir.biz\/fuga-ipsa-aut-ut-harum.html",
            "parent_id": 999662,
            "type": "color",
            "source_id": 55,
            ...
        },
        {
            "id": 999180,
            "title": "Omnis odit voluptatem blanditiis voluptatem",
            "link": "http:\/\/www.cassin.net\/dolores-consequuntur-aut-laboriosam-quod-provident.html",
            "parent_id": 999872,
            "type": "style",
            "source_id": 14,
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
        "total": 25,
        "limit": 10,
        "offset": 0,
        "total_pages": 3,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_id": "999579",
            "api_model": "shop-categories",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/shop-categories\/999579",
            "id": 999579,
            "title": "Similique aut quia laboriosam blanditiis",
            "timestamp": "2018-01-25T13:34:01-06:00"
        },
        {
            "_score": 1,
            "api_id": "999872",
            "api_model": "shop-categories",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/shop-categories\/999872",
            "id": 999872,
            "title": "Rerum et aut provident rerum",
            "timestamp": "2018-01-25T13:34:01-06:00"
        },
        {
            "_score": 1,
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
                "doc_count": 25
            }
        ]
    }
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
        "title": "Explicabo corporis qui numquam aliquid",
        "link": "https:\/\/runolfsdottir.biz\/fuga-ipsa-aut-ut-harum.html",
        "parent_id": 999662,
        "type": "color",
        "source_id": 55,
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
            "id": 999686,
            "title": "Provident Illo In Quidem Ipsam Nam",
            "title_display": "Provident Illo <em>In Quidem<\/em> Ipsam Nam",
            "sku": "86043366",
            "link": "http:\/\/schaefer.com\/quae-cum-velit-rerum-mollitia-voluptatem-et-quod.html",
            "image": "https:\/\/lorempixel.com\/640\/480\/?13826",
            ...
        },
        {
            "id": 999731,
            "title": "Animi Omnis Ullam Nostrum Facere Quo",
            "title_display": "Animi Omnis <em>Ullam Nostrum<\/em> Facere Quo",
            "sku": "70689853",
            "link": "http:\/\/www.kiehn.com\/non-quo-eveniet-hic-similique-sint-consequatur-est-numquam",
            "image": "https:\/\/lorempixel.com\/640\/480\/?94998",
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
            "api_id": "999367",
            "api_model": "products",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/products\/999367",
            "id": 999367,
            "title": "Nesciunt Repudiandae Dolor Facere Dolorem Quod",
            "timestamp": "2018-01-25T13:34:02-06:00"
        },
        {
            "_score": 1,
            "api_id": "999627",
            "api_model": "products",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/products\/999627",
            "id": 999627,
            "title": "Laudantium Eum Non Tempora Vero Incidunt",
            "timestamp": "2018-01-25T13:34:02-06:00"
        },
        {
            "_score": 1,
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
                "doc_count": 25
            }
        ]
    }
}
```

### `/products/{id}`

A single products by the given identifier.

Example request: http://aggregator-data-test.artic.edu/api/v1/products/999686?limit=2  
Example output:

```
{
    "data": {
        "id": 999686,
        "title": "Provident Illo In Quidem Ipsam Nam",
        "title_display": "Provident Illo <em>In Quidem<\/em> Ipsam Nam",
        "sku": "86043366",
        "link": "http:\/\/schaefer.com\/quae-cum-velit-rerum-mollitia-voluptatem-et-quod.html",
        "image": "https:\/\/lorempixel.com\/640\/480\/?13826",
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
        "total": 1904,
        "limit": 2,
        "offset": 0,
        "total_pages": 952,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/events?page=2&limit=2"
    },
    "data": [
        {
            "id": 99945219,
            "title": "Eaque vel et",
            "description": "Animi eos tempore reiciendis. Eos distinctio voluptas voluptas quisquam non necessitatibus. Expedita porro expedita sint beatae et non corporis dignissimos.",
            "short_description": "Aut optio natus voluptatem quidem vero labore nulla optio.",
            "image": "https:\/\/lorempixel.com\/640\/480\/?57344",
            "type": "Et asperiores saepe",
            ...
        },
        {
            "id": 99949087,
            "title": "Quidem nam nisi",
            "description": "Beatae consequatur voluptatem sit quae quod. Excepturi quo culpa harum libero sed modi. Voluptatum aut nulla enim voluptatem sunt.",
            "short_description": "Perspiciatis temporibus dolorem vitae ut impedit iste assumenda.",
            "image": "https:\/\/lorempixel.com\/640\/480\/?39548",
            "type": "Quos est vero",
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
        "total": 1904,
        "limit": 10,
        "offset": 0,
        "total_pages": 191,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_id": "29142829",
            "api_model": "events",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/events\/29142829",
            "id": 29142829,
            "title": "Member Weekend Mornings: Rodin\u2015Sculptor and Storyteller",
            "timestamp": "2018-01-25T12:32:44-06:00"
        },
        {
            "_score": 1,
            "api_id": "24517570",
            "api_model": "events",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/events\/24517570",
            "id": 24517570,
            "title": "Gallery Talk: Highlights of the Art Institute",
            "timestamp": "2018-01-25T12:32:44-06:00"
        },
        {
            "_score": 1,
            "api_id": "28845877",
            "api_model": "events",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/events\/28845877",
            "id": 28845877,
            "title": "The Artist&#039;s Studio",
            "timestamp": "2018-01-25T12:32:44-06:00"
        }
    ],
    "aggregations": {
        "count_api_model": [
            {
                "key": "events",
                "doc_count": 1904
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
        "total": 32,
        "limit": 2,
        "offset": 0,
        "total_pages": 16,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/tours?page=2&limit=2"
    },
    "data": [
        {
            "id": 9992452,
            "title": "Tempora soluta qui",
            "image": "https:\/\/lorempixel.com\/640\/480\/?87790",
            "description": "Sed aliquid ullam nihil quisquam minima. Facere incidunt in inventore laudantium aliquid. Facere sunt est error vel adipisci cupiditate dolores. Doloribus neque tempore ullam velit nihil ipsa error. Dolores porro velit expedita omnis est.",
            "intro": "Natus eum optio perferendis. Provident sint atque fugit. Quia ut dolores hic et. Facere quo eum suscipit architecto maiores provident sequi qui.",
            "weight": 7,
            ...
        },
        {
            "id": 9997339,
            "title": "Impedit accusantium nulla",
            "image": "https:\/\/lorempixel.com\/640\/480\/?32373",
            "description": "Eius voluptates commodi doloribus occaecati. Quaerat perspiciatis consequatur asperiores nobis. Repellendus impedit atque quis et quas veniam molestiae et. Soluta cupiditate quo impedit id delectus. Quis et nihil reprehenderit aut. Minus itaque placeat ex molestiae.",
            "intro": "Natus sit magni tempore. Harum quo sit porro perferendis necessitatibus neque et. Sunt temporibus ut itaque explicabo consequatur reiciendis. Quasi velit et inventore sunt non.",
            "weight": 3,
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
        "total": 32,
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
            "timestamp": "2018-01-25T12:37:02-06:00"
        },
        {
            "_score": 1,
            "api_id": "9992046",
            "api_model": "tours",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/tours\/9992046",
            "id": 9992046,
            "title": "Et aut commodi",
            "timestamp": "2018-01-25T13:34:14-06:00"
        },
        {
            "_score": 1,
            "api_id": "9992691",
            "api_model": "tours",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/tours\/9992691",
            "id": 9992691,
            "title": "Debitis assumenda enim",
            "timestamp": "2018-01-25T13:34:14-06:00"
        }
    ],
    "aggregations": {
        "count_api_model": [
            {
                "key": "tours",
                "doc_count": 32
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
        "image": "http:\/\/aicweb10.artic.edu\/sites\/default\/files\/tour-images\/espanol.jpg",
        "description": "Descubra las historias detr\u00e1s de algunas de las obras de arte m\u00e1s ic\u00f3nicas del museo.",
        "intro": "Disfrute el banco del R\u00edo Sena ba\u00f1ado de sol en \u201cUn domingo en La Grande Jatte\u201d de Georges Seurat o haga una parada nocturna en una cafeter\u00eda de Nueva York en \u201cNighthawks\u201d de Edward Hopper en esta visita a la ic\u00f3nica colecci\u00f3n del museo. El Art Institute of Chicago, fundado en 1879, alberga una enorme colecci\u00f3n que abarca casi toda la historia de la humanidad. A medida que explora siglos de arte, esta visita resalta algunos hitos esenciales, con obras de arte menos conocidas, pero igualmente interesantes, en todo el recorrido. La pista musical presenta la m\u00fasica de Andrew Bird, otra persona esencial en Chicago.",
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
        "total": 162,
        "limit": 2,
        "offset": 0,
        "total_pages": 81,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/tour-stops?page=2&limit=2"
    },
    "data": [
        {
            "id": 244,
            "title": "Delectus facilis voluptatibus",
            "artwork": "Delectus facilis voluptatibus",
            "artwork_id": null,
            "mobile_sound": "http:\/\/www.bradtke.biz\/aut-dolore-nisi-libero-pariatur.html",
            "mobile_sound_id": null,
            ...
        },
        {
            "id": 165,
            "title": "Quam consequatur in",
            "artwork": "Quam consequatur in",
            "artwork_id": null,
            "mobile_sound": "http:\/\/www.zboncak.com\/praesentium-consectetur-laboriosam-recusandae-eveniet-inventore-atque.html",
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

Example request: http://aggregator-data-test.artic.edu/api/v1/tour-stops/160?limit=2  
Example output:

```
{
    "data": {
        "id": 160,
        "title": "Bathers by a River",
        "artwork": "Bathers by a River",
        "artwork_id": null,
        "mobile_sound": "http:\/\/aicweb10.artic.edu\/sites\/default\/files\/audio\/801c.mp3",
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
        "total": 577,
        "limit": 2,
        "offset": 0,
        "total_pages": 289,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/mobile-sounds?page=2&limit=2"
    },
    "data": [
        {
            "id": 9999618,
            "title": "Aut enim debitis",
            "link": "http:\/\/von.com\/vel-sunt-esse-dignissimos-laboriosam-incidunt-dolores",
            "transcript": "Nostrum qui commodi mollitia saepe nostrum minima. Qui dignissimos molestiae reiciendis voluptatem. Quas culpa voluptatibus natus rem libero itaque sint. Esse et aliquam fugit id praesentium.",
            "last_updated_source": null,
            "last_updated": "2018-01-25T13:34:14-06:00",
            ...
        },
        {
            "id": 9992970,
            "title": "Ullam fugiat sunt",
            "link": "http:\/\/wisoky.com\/rerum-libero-dolore-incidunt-magnam-earum-ducimus",
            "transcript": "Minima pariatur nemo deserunt quisquam voluptates vel aliquam. Voluptate ut minus magnam. Ut aut iusto eum aliquam esse minus non qui. Voluptates ut numquam tempora explicabo saepe explicabo.",
            "last_updated_source": null,
            "last_updated": "2018-01-25T13:34:14-06:00",
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
        "transcript": "NARRATOR: Painted in the Netherlands in 1658, this masterly still life held a fascinating secret for many years. Curator Martha Wolff.\r\n\r\nMARTHA WOLFF: This painting is signed by Adriaen van der Spelt, a still life painter whose work is rather rare. But fairly recently, we realized that it&#039;s in fact a collaboration between van der Spelt and a more famous painter named Frans van Mieris who contributed the beautiful blue satin curtain that is drawn across part of the picture.\r\n\r\nNARRATOR: The young artists had both just joined the Painters Gild in the City of Leiden, so this picture was probably a demonstration in their skill in the art of illusion.\r\n\r\nMARTHA WOLFF: And also a reflection of actual usage at the time, because Dutch collectors would use curtains to protect particularly exquisite pictures from light and also to give the viewer the thrill of pulling back the curtain and seeing what was displayed behind it. And you have multiple layers of illusion here because you have first the stone arch and then you have the garland that&#039;s draped in front of it, and then you have the curtain. And one of the most wonderful things is really the brass rod which plays off of the frame of the picture. It stands in front of it.",
        "last_updated_source": null,
        "last_updated": "2018-01-25T12:37:01-06:00",
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
            "id": 9995008,
            "title": "Quaerat autem totam",
            "web_url": "http:\/\/maggio.org\/",
            "site": "inet",
            "alias": "solutasaepe",
            "section_ids": [
                9992501,
                9990205,
                9992272,
                9991846,
                9990097,
                9998821
            ],
            ...
        },
        {
            "id": 9990153,
            "title": "Qui ipsum natus",
            "web_url": "http:\/\/crist.biz\/porro-omnis-voluptas-ad-quo-est",
            "site": "cumqueex",
            "alias": "praesentiumomnis",
            "section_ids": [
                9992758
            ],
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
            "_score": 1,
            "api_id": "140019",
            "api_model": "publications",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/publications\/140019",
            "id": 140019,
            "title": "Manet Paintings and Works on Paper at the Art Institute of Chicago",
            "timestamp": "2018-01-25T12:48:55-06:00"
        },
        {
            "_score": 1,
            "api_id": "9998893",
            "api_model": "publications",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/publications\/9998893",
            "id": 9998893,
            "title": "Rerum cupiditate id",
            "timestamp": "2018-01-25T13:34:20-06:00"
        },
        {
            "_score": 1,
            "api_id": "9995008",
            "api_model": "publications",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/publications\/9995008",
            "id": 9995008,
            "title": "Quaerat autem totam",
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
        "web_url": "https:\/\/publications.artic.edu\/caillebotte\/reader\/paintingsanddrawings",
        "site": "caillebotte",
        "alias": "paintingsanddrawings",
        "section_ids": [
            504064,
            503060,
            416795,
            418624,
            527432,
            520264,
            530519,
            420457,
            514159,
            439945,
            422294,
            538795,
            417709,
            448432,
            508090,
            506075,
            439007,
            505069,
            414970,
            421375
        ],
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
            "id": 9995536,
            "title": "Quia asperiores non",
            "web_url": "http:\/\/www.braun.info\/minima-omnis-reprehenderit-similique-quia-ea-rerum-eius",
            "accession": "2004.461",
            "revision": 1368266150,
            "source_id": 20551,
            ...
        },
        {
            "id": 9995025,
            "title": "Aspernatur aliquid qui",
            "web_url": "http:\/\/www.schoen.info\/ab-autem-voluptatem-aut-facilis.html",
            "accession": "1932.365",
            "revision": 1282377355,
            "source_id": 50017,
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
            "_score": 5.2195077,
            "api_id": "111401",
            "api_model": "sections",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/sections\/111401",
            "id": 111401,
            "title": "Sheet 3F",
            "timestamp": "2018-01-25T12:49:15-06:00"
        },
        {
            "_score": 1,
            "api_id": "481190",
            "api_model": "sections",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/sections\/481190",
            "id": 481190,
            "title": "Cat. 13 Statue of the Aphrodite of Knidos",
            "timestamp": "2018-01-25T12:49:08-06:00"
        },
        {
            "_score": 1,
            "api_id": "488085",
            "api_model": "sections",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/sections\/488085",
            "id": 488085,
            "title": "Cat. 19 Head of a Philosopher",
            "timestamp": "2018-01-25T12:49:08-06:00"
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
        "web_url": "https:\/\/publications.artic.edu\/roman\/reader\/romanart\/section\/1974",
        "accession": "1892.24",
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
        "total": 121,
        "limit": 2,
        "offset": 0,
        "total_pages": 61,
        "current_page": 1,
        "next_url": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/sites?page=2&limit=2"
    },
    "data": [
        {
            "id": 9993734,
            "title": "Incidunt a distinctio",
            "description": "Eos sit magni accusamus sit dolorem in. Est placeat sed rerum consequatur. Non commodi eum voluptatibus. Non deserunt explicabo similique itaque ad assumenda magni. Molestiae error architecto molestiae.",
            "web_url": "https:\/\/miller.info\/est-ut-libero-dolor-qui.html",
            "exhibition_ids": [
                999731489,
                999701287
            ],
            "artist_ids": [
                999230726,
                999721928,
                999319443,
                999750434
            ],
            ...
        },
        {
            "id": 9994758,
            "title": "Explicabo nulla vero",
            "description": "Magni eum et ut modi illo. Fuga quidem blanditiis eius saepe. Cum repellendus ut nostrum id incidunt rerum molestiae. Sequi adipisci dicta tenetur sapiente voluptate qui consequuntur. Sit eum repellendus accusamus amet incidunt.",
            "web_url": "http:\/\/pacocha.com\/accusantium-reiciendis-ad-non-sed-voluptates.html",
            "exhibition_ids": [
                999731489,
                999701287,
                999405374
            ],
            "artist_ids": [
                999944186,
                999206563,
                999980362
            ],
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
            "_score": 1,
            "api_id": "14",
            "api_model": "sites",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/sites\/14",
            "id": 14,
            "title": "The Medici, Michelangelo, and the Art of Late Renaissance Florence",
            "timestamp": "2018-01-25T12:56:08-06:00"
        },
        {
            "_score": 1,
            "api_id": "19",
            "api_model": "sites",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/sites\/19",
            "id": 19,
            "title": "Perpetual Glory: Medieval Islamic Ceramics from the Harvey B. Plotnick Collection",
            "timestamp": "2018-01-25T12:56:08-06:00"
        },
        {
            "_score": 1,
            "api_id": "22",
            "api_model": "sites",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/sites\/22",
            "id": 22,
            "title": "Seurat and the Making of \"La Grande Jatte\"",
            "timestamp": "2018-01-25T12:56:08-06:00"
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
        "description": "Chicago Architecture: Ten Visions presents diverse views of the future of Chicago\u2019s built environment from 10 internationally renowned architects. The architects were selected from an invited competition juried by architects Stanley Tigerman and Harry Cobb, in collaboration with curators from the Art Institute\u2019s Department of Architecture. The 10 architects reflect a cross section of Chicago\u2019s vibrant architectural scene\u2014from large and small firms as well as the academic community\u2014bringing to this exhibition diverse experiences and insights. Each architect was asked to define an important issue for the future of Chicago and create a \u201cspatial commentary\u201d on that particular theme. Within a lively plan designed by Stanley Tigerman, each of the participants has curated and designed his or her own mini-exhibition in a space of approximately 21 feet square. Tigerman\u2019s setting creates a linear sequence in which visitors pass through the architects\u2019 spaces to an interactive area where the architects\u2019 commentaries can be heard by picking up a telephone. Visitors are encouraged to record their comments on any and all of the \u201cten visions.\u201d",
        "web_url": "http:\/\/archive.artic.edu\/10visions\/",
        "exhibition_ids": [
            2839
        ],
        "artist_ids": [
            103040,
            31760,
            72565,
            31646
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
            "id": 25700,
            "title": "Michaels, Ralph, Residence",
            "alternate_title": null,
            "web_url": "http:\/\/digital-libraries.saic.edu\/cdm\/ref\/collection\/mqc\/id\/25700",
            "collection": "Historic Architecture and Landscape Image Collection, c.1865-1973 (bulk 1890-1930)",
            "archive": "Architecture Lantern Slide Collection",
            ...
        },
        {
            "id": 25956,
            "title": "Saks Fifth Avenue",
            "alternate_title": "Michigan-Chestnut Building; Chemertron Building; Building for Palmer Estate",
            "web_url": "http:\/\/digital-libraries.saic.edu\/cdm\/ref\/collection\/mqc\/id\/25956",
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
            "id": 25700,
            "title": "Michaels, Ralph, Residence",
            "alternate_title": null,
            "web_url": "http:\/\/digital-libraries.saic.edu\/cdm\/ref\/collection\/mqc\/id\/25700",
            "collection": "Historic Architecture and Landscape Image Collection, c.1865-1973 (bulk 1890-1930)",
            "archive": "Architecture Lantern Slide Collection",
            ...
        },
        {
            "id": 25956,
            "title": "Saks Fifth Avenue",
            "alternate_title": "Michigan-Chestnut Building; Chemertron Building; Building for Palmer Estate",
            "web_url": "http:\/\/digital-libraries.saic.edu\/cdm\/ref\/collection\/mqc\/id\/25956",
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
            "id": "01ARTIC_ALMA2122404630003801",
            "title": "Exposition Francis Picabia",
            "date": 1927,
            "creators": [
                {
                    "id": "n50019704",
                    "uri": "http:\/\/id.loc.gov\/authorities\/names\/n50019704",
                    "title": "Picabia, Francis, 1879-1953 -- Exhibitions"
                }
            ],
            "subjects": [
                {
                    "id": "n50019704",
                    "uri": "http:\/\/id.loc.gov\/authorities\/names\/n50019704",
                    "title": "Picabia, Francis, 1879-1953 -- Exhibitions"
                }
            ],
            ...
        },
        {
            "id": "01ARTIC_ALMA2122407250003801",
            "title": "Le mythe de la Roche Per\u00e7ee : poeme",
            "date": 1947,
            "creators": [
                {
                    "id": "n82116392",
                    "uri": "http:\/\/id.loc.gov\/authorities\/names\/n82116392",
                    "title": "Goll, Yvan"
                },
                {
                    "id": "n50009559",
                    "uri": "http:\/\/id.loc.gov\/authorities\/names\/n50009559",
                    "title": "Tanguy, Yves"
                }
            ],
            "subjects": [],
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
            "id": "01ARTIC_ALMA2122404630003801",
            "title": "Exposition Francis Picabia",
            "date": 1927,
            "creators": [
                {
                    "id": "n50019704",
                    "uri": "http:\/\/id.loc.gov\/authorities\/names\/n50019704",
                    "title": "Picabia, Francis, 1879-1953 -- Exhibitions"
                }
            ],
            "subjects": [
                {
                    "id": "n50019704",
                    "uri": "http:\/\/id.loc.gov\/authorities\/names\/n50019704",
                    "title": "Picabia, Francis, 1879-1953 -- Exhibitions"
                }
            ],
            ...
        },
        {
            "id": "01ARTIC_ALMA2122407250003801",
            "title": "Le mythe de la Roche Per\u00e7ee : poeme",
            "date": 1947,
            "creators": [
                {
                    "id": "n82116392",
                    "uri": "http:\/\/id.loc.gov\/authorities\/names\/n82116392",
                    "title": "Goll, Yvan"
                },
                {
                    "id": "n50009559",
                    "uri": "http:\/\/id.loc.gov\/authorities\/names\/n50009559",
                    "title": "Tanguy, Yves"
                }
            ],
            "subjects": [],
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
            "id": "no89021296",
            "uri": "http:\/\/id.loc.gov\/authorities\/names\/no89021296",
            "title": "Lefebvre-Durufl\u00e9, N.-J",
            ...
        },
        {
            "id": "n79151476",
            "uri": "http:\/\/id.loc.gov\/authorities\/names\/n79151476",
            "title": "Ostervald, J. F",
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
            "id": "no89021296",
            "uri": "http:\/\/id.loc.gov\/authorities\/names\/no89021296",
            "title": "Lefebvre-Durufl\u00e9, N.-J",
            ...
        },
        {
            "id": "n79151476",
            "uri": "http:\/\/id.loc.gov\/authorities\/names\/n79151476",
            "title": "Ostervald, J. F",
            ...
        }
    ]
}
```

> Generated by `php artisan docs:endpoints` on 2018-01-25 14:31:27
