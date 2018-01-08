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

Example request: http://data-aggregator.test/api/v1/artworks?limit=2  
Example output:

```
{
    "pagination": {
        "total": 106313,
        "limit": 2,
        "offset": 0,
        "total_pages": 53157,
        "current_page": 1,
        "next_url": "http:\/\/data-aggregator.test\/api\/v1\/artworks?page=2&limit=2"
    },
    "data": [
        {
            "id": 187029,
            "title": "Iben Abdul Aziz Faisal",
            "lake_guid": "3170729c-7078-d149-8349-ae12c0bec5da",
            "main_reference_number": "2014.711",
            "date_start": 1944,
            "date_end": 1945,
            ...
        },
        {
            "id": 186996,
            "title": "Myself When Young (Solange Karsh)",
            "lake_guid": "1c48fed3-b545-c2fc-9eac-ab5d05015f71",
            "main_reference_number": "2014.689",
            "date_start": 1938,
            "date_end": 1939,
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

Example request: http://data-aggregator.test/api/v1/artworks/essentials?limit=2  
Example output:

```
{
    "pagination": {
        "total": 413,
        "limit": 2,
        "offset": 0,
        "total_pages": 207,
        "current_page": 1,
        "next_url": "http:\/\/data-aggregator.test\/api\/v1\/artworks\/essentials?page=2&limit=2"
    },
    "data": [
        {
            "id": 189290,
            "title": "Gingold Living Room End Table (2 of 2)",
            "lake_guid": "5e500edb-3f85-ff6d-7c2f-b0c3d1381852",
            "main_reference_number": "2006.752.2",
            "date_start": 1937,
            "date_end": 1948,
            ...
        },
        {
            "id": 187165,
            "title": "Monogram",
            "lake_guid": "1554f676-247e-7afe-c544-198afaffb0a9",
            "main_reference_number": "2006.170",
            "date_start": 1983,
            "date_end": 1984,
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

Example request: http://data-aggregator.test/api/v1/artworks/search?q=monet  
Example output:

```
{
    "preference": null,
    "pagination": {
        "total": 10562,
        "limit": 10,
        "offset": 0,
        "total_pages": 1057,
        "current_page": 1
    },
    "data": [
        {
            "_score": 15.440957,
            "api_id": "16499",
            "api_model": "artworks",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/artworks\/16499",
            "id": 16499,
            "title": "Jesus Mocked by the Soldiers",
            "timestamp": "2017-12-08T16:13:34-06:00"
        },
        {
            "_score": 15.157714,
            "api_id": "16571",
            "api_model": "artworks",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/artworks\/16571",
            "id": 16571,
            "title": "Arrival of the Normandy Train, Gare Saint-Lazare",
            "timestamp": "2017-12-08T16:13:33-06:00"
        },
        {
            "_score": 14.989431,
            "api_id": "44892",
            "api_model": "artworks",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/artworks\/44892",
            "id": 44892,
            "title": "Fish (Still Life)",
            "timestamp": "2017-12-08T16:11:30-06:00"
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
                "doc_count": 10562
            }
        ]
    }
}
```

### `/artworks/{id}`

A single artworks by the given identifier. {id} is the identifier from our collections managements system.

Example request: http://data-aggregator.test/api/v1/artworks/111628?limit=2  
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

Example request: http://data-aggregator.test/api/v1/artworks/111628/artists?limit=2  
Example output:

```
{
    "data": [
        {
            "id": 34996,
            "title": "Hopper, Edward",
            "lake_guid": "cba02485-5b76-1e48-bb85-2f9d0f3e3c57",
            "birth_date": null,
            "birth_place": null,
            "death_date": null,
            ...
        }
    ]
}
```

### `/artworks/{id}/categories`

The categories for a given artworks.

Example request: http://data-aggregator.test/api/v1/artworks/111628/categories?limit=2  
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
        },
        {
            "id": 2,
            "title": "American",
            "lake_guid": "609dd2cb-9647-1b18-59be-5b8d74d29b51",
            "parent_id": null,
            "is_in_nav": false,
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
            "id": 87,
            "title": "American Modernism",
            "lake_guid": "3c15e374-7cd0-7a9a-0280-fa3855032a3f",
            "parent_id": 11,
            "is_in_nav": true,
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
        }
    ]
}
```

### `/artworks/{id}/images`

The images for a given artworks.

Example request: http://data-aggregator.test/api/v1/artworks/111628/images?limit=2  
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

Example request: http://data-aggregator.test/api/v1/artworks/111628/parts?limit=2  

### `/artworks/{id}/sets`

The sets for a given artworks.

Example request: http://data-aggregator.test/api/v1/artworks/111628/sets?limit=2  

## Agents

### `/agents`

A list of all agents sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](FIELDS.md#agents).

#### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

Example request: http://data-aggregator.test/api/v1/agents?limit=2  
Example output:

```
{
    "pagination": {
        "total": 11538,
        "limit": 2,
        "offset": 0,
        "total_pages": 5769,
        "current_page": 1,
        "next_url": "http:\/\/data-aggregator.test\/api\/v1\/agents?page=2&limit=2"
    },
    "data": [
        {
            "id": 108804,
            "title": "VanderLans, Rudy",
            "lake_guid": "977d2268-51fd-509c-cf9f-4e0dc138d1cf",
            "birth_date": null,
            "birth_place": null,
            "death_date": null,
            ...
        },
        {
            "id": 115209,
            "title": "Olsson, Yngve Harald",
            "lake_guid": "0db7ad6b-1ff8-90e5-8f68-f4617c0a8f18",
            "birth_date": null,
            "birth_place": null,
            "death_date": null,
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

Example request: http://data-aggregator.test/api/v1/agents/search  
Example output:

```
{
    "preference": null,
    "pagination": {
        "total": 11411,
        "limit": 10,
        "offset": 0,
        "total_pages": 1142,
        "current_page": 1
    },
    "data": [
        {
            "_score": 8.4257555,
            "api_id": "36132",
            "api_model": "agents",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/agents\/36132",
            "id": 36132,
            "title": "Parker, Bart",
            "timestamp": "2017-12-04T00:37:08-06:00"
        },
        {
            "_score": 8.4257555,
            "api_id": "90583",
            "api_model": "agents",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/agents\/90583",
            "id": 90583,
            "title": "Rich, Felicity",
            "timestamp": "2017-12-04T00:37:24-06:00"
        },
        {
            "_score": 8.4257555,
            "api_id": "92975",
            "api_model": "agents",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/agents\/92975",
            "id": 92975,
            "title": "Quimbaya",
            "timestamp": "2017-12-04T00:37:24-06:00"
        }
    ],
    "aggregations": {
        "count_api_model": [
            {
                "key": "agents",
                "doc_count": 11411
            }
        ]
    }
}
```

### `/agents/{id}`

A single agents by the given identifier. {id} is the identifier from our collections managements system.

Example request: http://data-aggregator.test/api/v1/agents?limit=2  
Example output:

```
{
    "pagination": {
        "total": 11538,
        "limit": 2,
        "offset": 0,
        "total_pages": 5769,
        "current_page": 1,
        "next_url": "http:\/\/data-aggregator.test\/api\/v1\/agents?page=2&limit=2"
    },
    "data": [
        {
            "id": 108804,
            "title": "VanderLans, Rudy",
            "lake_guid": "977d2268-51fd-509c-cf9f-4e0dc138d1cf",
            "birth_date": null,
            "birth_place": null,
            "death_date": null,
            ...
        },
        {
            "id": 115209,
            "title": "Olsson, Yngve Harald",
            "lake_guid": "0db7ad6b-1ff8-90e5-8f68-f4617c0a8f18",
            "birth_date": null,
            "birth_place": null,
            "death_date": null,
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

Example request: http://data-aggregator.test/api/v1/departments?limit=2  
Example output:

```
{
    "pagination": {
        "total": 57,
        "limit": 2,
        "offset": 0,
        "total_pages": 29,
        "current_page": 1,
        "next_url": "http:\/\/data-aggregator.test\/api\/v1\/departments?page=2&limit=2"
    },
    "data": [
        {
            "id": 999049762,
            "title": "Nobis Art",
            "lake_guid": "99999999-9999-9999-9999-999999497508",
            "last_updated_fedora": "2017-10-14T17:40:19-05:00",
            "last_updated_source": "2017-04-14T21:24:37-05:00",
            "last_updated": "2017-11-20T11:05:35-06:00",
            ...
        },
        {
            "id": 999512660,
            "title": "Consequuntur Art",
            "lake_guid": "99999999-9999-9999-9999-999999706756",
            "last_updated_fedora": "2017-05-06T02:26:14-05:00",
            "last_updated_source": "2017-09-12T22:10:51-05:00",
            "last_updated": "2017-11-20T11:05:35-06:00",
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

Example request: http://data-aggregator.test/api/v1/departments/search  
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
            "timestamp": "2017-12-04T11:12:23-06:00"
        },
        {
            "_score": 1,
            "api_id": "25",
            "api_model": "departments",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/departments\/25",
            "id": 25,
            "title": "Architecture and Design",
            "timestamp": "2017-12-04T11:12:23-06:00"
        },
        {
            "_score": 1,
            "api_id": "84",
            "api_model": "departments",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/departments\/84",
            "id": 84,
            "title": "Museum Registrar",
            "timestamp": "2017-12-04T11:12:23-06:00"
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

Example request: http://data-aggregator.test/api/v1/departments/4?limit=2  
Example output:

```
{
    "data": {
        "id": 4,
        "title": "Textiles",
        "lake_guid": "cbb32062-dd50-8711-0513-f7d19801938c",
        "last_updated_fedora": "2017-10-04T08:36:37-05:00",
        "last_updated_source": "2017-11-06T09:36:36-06:00",
        "last_updated": "2017-11-20T08:46:23-06:00",
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

Example request: http://data-aggregator.test/api/v1/object-types?limit=2  
Example output:

```
{
    "pagination": {
        "total": 65,
        "limit": 2,
        "offset": 0,
        "total_pages": 33,
        "current_page": 1,
        "next_url": "http:\/\/data-aggregator.test\/api\/v1\/object-types?page=2&limit=2"
    },
    "data": [
        {
            "id": 99913,
            "title": "Design",
            "lake_guid": "99999999-9999-9999-9999-999999478649",
            "last_updated_fedora": "2017-08-20T10:11:56-05:00",
            "last_updated_source": "2017-08-18T14:21:35-05:00",
            "last_updated": "2017-11-20T11:05:35-06:00",
            ...
        },
        {
            "id": 99914,
            "title": "Painting",
            "lake_guid": "99999999-9999-9999-9999-999999609879",
            "last_updated_fedora": "2017-07-02T07:31:13-05:00",
            "last_updated_source": "2017-08-08T03:33:12-05:00",
            "last_updated": "2017-11-20T11:05:35-06:00",
            ...
        }
    ]
}
```

### `/object-types/{id}`

A single object-types by the given identifier. {id} is the identifier from our collections managements system.

Example request: http://data-aggregator.test/api/v1/object-types/3?limit=2  
Example output:

```
{
    "data": {
        "id": 3,
        "title": "Sculpture",
        "lake_guid": "e2ed3e7c-d93f-7576-9a38-149daf99fba3",
        "last_updated_fedora": "2017-11-06T09:37:02-06:00",
        "last_updated_source": "2017-11-06T09:37:03-06:00",
        "last_updated": "2017-11-20T08:46:24-06:00",
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

Example request: http://data-aggregator.test/api/v1/categories?limit=2  
Example output:

```
{
    "pagination": {
        "total": 815,
        "limit": 2,
        "offset": 0,
        "total_pages": 408,
        "current_page": 1,
        "next_url": "http:\/\/data-aggregator.test\/api\/v1\/categories?page=2&limit=2"
    },
    "data": [
        {
            "id": 769,
            "title": "Picturesque: Case 8",
            "lake_guid": "565de422-5b29-abe3-7b68-1f8d07ce44c0",
            "parent_id": 426,
            "is_in_nav": false,
            "description": null,
            ...
        },
        {
            "id": 771,
            "title": "Picturesque: Case 1",
            "lake_guid": "bed2b5e5-dabb-9ef1-0667-2b28f022891c",
            "parent_id": 426,
            "is_in_nav": false,
            "description": null,
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

Example request: http://data-aggregator.test/api/v1/categories/search  
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
            "api_id": "999323139",
            "api_model": "categories",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/categories\/999323139",
            "id": 999323139,
            "title": "Dolorem",
            "timestamp": "2017-12-05T11:43:13-06:00"
        },
        {
            "_score": 1,
            "api_id": "999410301",
            "api_model": "categories",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/categories\/999410301",
            "id": 999410301,
            "title": "Ab",
            "timestamp": "2017-12-05T11:43:13-06:00"
        },
        {
            "_score": 1,
            "api_id": "999565713",
            "api_model": "categories",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/categories\/999565713",
            "id": 999565713,
            "title": "Nemo",
            "timestamp": "2017-12-05T11:43:13-06:00"
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

Example request: http://data-aggregator.test/api/v1/categories/3?limit=2  
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

Example request: http://data-aggregator.test/api/v1/agent-types?limit=2  
Example output:

```
{
    "pagination": {
        "total": 35,
        "limit": 2,
        "offset": 0,
        "total_pages": 18,
        "current_page": 1,
        "next_url": "http:\/\/data-aggregator.test\/api\/v1\/agent-types?page=2&limit=2"
    },
    "data": [
        {
            "id": 99906,
            "title": "adipisci a",
            "lake_guid": "99999999-9999-9999-9999-999999787004",
            "last_updated_fedora": "2017-05-07T18:02:03-05:00",
            "last_updated_source": "2017-06-30T17:18:48-05:00",
            "last_updated": "2017-11-20T11:05:32-06:00",
            ...
        },
        {
            "id": 99918,
            "title": "at et",
            "lake_guid": "99999999-9999-9999-9999-999999278284",
            "last_updated_fedora": "2017-08-24T08:57:06-05:00",
            "last_updated_source": "2017-05-06T09:13:26-05:00",
            "last_updated": "2017-11-20T11:05:32-06:00",
            ...
        }
    ]
}
```

### `/agent-types/{id}`

A single agent-types by the given identifier. {id} is the identifier from our collections managements system.

Example request: http://data-aggregator.test/api/v1/agent-types/1?limit=2  
Example output:

```
{
    "data": {
        "id": 1,
        "title": "Corporate Body",
        "lake_guid": "4fc9cef2-32d7-60a0-8ddd-335fd7800f29",
        "last_updated_fedora": "2017-11-06T09:36:10-06:00",
        "last_updated_source": "2017-11-06T09:36:10-06:00",
        "last_updated": "2017-11-20T08:42:02-06:00",
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

Example request: http://data-aggregator.test/api/v1/galleries?limit=2  
Example output:

```
{
    "pagination": {
        "total": 242,
        "limit": 2,
        "offset": 0,
        "total_pages": 121,
        "current_page": 1,
        "next_url": "http:\/\/data-aggregator.test\/api\/v1\/galleries?page=2&limit=2"
    },
    "data": [
        {
            "id": 2147476004,
            "title": "Gallery 164",
            "lake_guid": "ae1fc76a-276c-2adb-4595-e3de661c00bf",
            "is_closed": false,
            "number": "163",
            "floor": "1",
            ...
        },
        {
            "id": 2147475001,
            "title": "Gallery 163",
            "lake_guid": "17547b95-17f4-0c20-f5af-d07842b76646",
            "is_closed": false,
            "number": "164",
            "floor": "1",
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

Example request: http://data-aggregator.test/api/v1/galleries/search  
Example output:

```
{
    "preference": null,
    "pagination": {
        "total": 241,
        "limit": 10,
        "offset": 0,
        "total_pages": 25,
        "current_page": 1
    },
    "data": [
        {
            "_score": 4.161247,
            "api_id": "23972",
            "api_model": "galleries",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/galleries\/23972",
            "id": 23972,
            "title": "Gallery 297B",
            "timestamp": "2017-12-11T14:25:35-06:00"
        },
        {
            "_score": 1,
            "api_id": "25084",
            "api_model": "galleries",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/galleries\/25084",
            "id": 25084,
            "title": "Gallery 125",
            "timestamp": "2017-12-05T11:43:19-06:00"
        },
        {
            "_score": 1,
            "api_id": "25087",
            "api_model": "galleries",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/galleries\/25087",
            "id": 25087,
            "title": "Gallery 127B",
            "timestamp": "2017-12-05T11:43:19-06:00"
        }
    ],
    "aggregations": {
        "count_api_model": [
            {
                "key": "galleries",
                "doc_count": 241
            }
        ]
    }
}
```

### `/galleries/{id}`

A single galleries by the given identifier. {id} is the identifier from our collections managements system.

Example request: http://data-aggregator.test/api/v1/galleries/24650?limit=2  
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

Example request: http://data-aggregator.test/api/v1/exhibitions?limit=2  
Example output:

```
{
    "pagination": {
        "total": 6020,
        "limit": 2,
        "offset": 0,
        "total_pages": 3010,
        "current_page": 1,
        "next_url": "http:\/\/data-aggregator.test\/api\/v1\/exhibitions?page=2&limit=2"
    },
    "data": [
        {
            "id": 999507251,
            "title": "Dicta Provident Et",
            "lake_guid": "99999999-9999-9999-9999-999999293790",
            "description": "Rerum in placeat dignissimos. Natus qui est nihil quia est iure. Atque dolores laboriosam voluptates consequatur quae hic voluptatem dolores.",
            "type": "Permanent Collection Special Project",
            "department": "Odit Art",
            ...
        },
        {
            "id": 999761724,
            "title": "Consequatur Explicabo Qui",
            "lake_guid": "99999999-9999-9999-9999-999999658680",
            "description": "Eaque animi laboriosam impedit est qui velit dolorem. Et id ea pariatur quaerat. Accusamus sunt porro recusandae. Dignissimos et qui ullam id amet adipisci sapiente.",
            "type": "AIC Only",
            "department": "Odit Art",
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

Example request: http://data-aggregator.test/api/v1/exhibitions/search  
Example output:

```
{
    "preference": null,
    "pagination": {
        "total": 6020,
        "limit": 10,
        "offset": 0,
        "total_pages": 602,
        "current_page": 1
    },
    "data": [
        {
            "_score": 7.723031,
            "api_id": "4758",
            "api_model": "exhibitions",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/exhibitions\/4758",
            "id": 4758,
            "title": "Junior Museum: Manet's Mirror",
            "timestamp": "2017-12-05T11:44:06-06:00"
        },
        {
            "_score": 7.723031,
            "api_id": "4788",
            "api_model": "exhibitions",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/exhibitions\/4788",
            "id": 4788,
            "title": "Guild of Boston Artists",
            "timestamp": "2017-12-05T11:44:06-06:00"
        },
        {
            "_score": 7.723031,
            "api_id": "4796",
            "api_model": "exhibitions",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/exhibitions\/4796",
            "id": 4796,
            "title": "Art Students' League of Chicago 23rd Annual",
            "timestamp": "2017-12-05T11:44:06-06:00"
        }
    ],
    "aggregations": {
        "count_api_model": [
            {
                "key": "exhibitions",
                "doc_count": 6020
            }
        ]
    }
}
```

### `/exhibitions/{id}`

A single exhibitions by the given identifier. {id} is the identifier from our collections managements system.

Example request: http://data-aggregator.test/api/v1/exhibitions/1302?limit=2  
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

Example request: http://data-aggregator.test/api/v1/exhibitions/1302/artworks?limit=2  
Example output:

```
{
    "data": []
}
```

### `/exhibitions/{id}/venues`

The venues for a given exhibitions.

Example request: http://data-aggregator.test/api/v1/exhibitions/1302/venues?limit=2  
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

Example request: http://data-aggregator.test/api/v1/images?limit=2  
Example output:

```
{
    "pagination": {
        "total": 109972,
        "limit": 2,
        "offset": 0,
        "total_pages": 54986,
        "current_page": 1,
        "next_url": "http:\/\/data-aggregator.test\/api\/v1\/images?page=2&limit=2"
    },
    "data": [
        {
            "id": "19fa3c42-3899-f809-8a29-61940877aedc",
            "title": "PH_13071",
            "type": "image",
            "description": null,
            "content": null,
            "category_ids": [],
            ...
        },
        {
            "id": "19f3f039-344b-529e-bff3-39c208211acb",
            "title": "192230",
            "type": "image",
            "description": null,
            "content": null,
            "category_ids": [],
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

Example request: http://data-aggregator.test/api/v1/images/search  
Example output:

```
{
    "preference": null,
    "pagination": {
        "total": 109971,
        "limit": 10,
        "offset": 0,
        "total_pages": 10998,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_id": "013f66ca-a73e-2140-bc78-ec3df471c673",
            "api_model": "images",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/images\/013f66ca-a73e-2140-bc78-ec3df471c673",
            "id": "013f66ca-a73e-2140-bc78-ec3df471c673",
            "title": "G57651",
            "timestamp": "2017-12-05T11:45:03-06:00"
        },
        {
            "_score": 1,
            "api_id": "01420f17-dc9a-2418-9399-95adb3fa96e3",
            "api_model": "images",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/images\/01420f17-dc9a-2418-9399-95adb3fa96e3",
            "id": "01420f17-dc9a-2418-9399-95adb3fa96e3",
            "title": "PD_09050",
            "timestamp": "2017-12-05T11:45:03-06:00"
        },
        {
            "_score": 1,
            "api_id": "014eb69d-d912-7852-75a0-f036b8626769",
            "api_model": "images",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/images\/014eb69d-d912-7852-75a0-f036b8626769",
            "id": "014eb69d-d912-7852-75a0-f036b8626769",
            "title": "PD_122215_47",
            "timestamp": "2017-12-05T11:45:03-06:00"
        }
    ],
    "aggregations": {
        "count_api_model": [
            {
                "key": "images",
                "doc_count": 109971
            }
        ]
    }
}
```

### `/images/{id}`

A single images by the given identifier. {id} is the identifier from our collections managements system.

Example request: http://data-aggregator.test/api/v1/images/c972e5d7-0667-6904-d919-bbeefeae0a10?limit=2  
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

Example request: http://data-aggregator.test/api/v1/videos?limit=2  
Example output:

```
{
    "pagination": {
        "total": 337,
        "limit": 2,
        "offset": 0,
        "total_pages": 169,
        "current_page": 1,
        "next_url": "http:\/\/data-aggregator.test\/api\/v1\/videos?page=2&limit=2"
    },
    "data": [
        {
            "id": "041d4172-97de-d924-72e4-6919223778f9",
            "title": "Video: Monet and the Cloud Machines",
            "type": "video",
            "description": "An exploration of Monet's fascination with depicting the smoke and steam from the cloud machines, or steam engines, pulling into Paris's Gare Saint-Lazare.  ",
            "content": "http:\/\/www.artic.edu\/aic\/collections\/citi\/resources\/531.flv",
            "category_ids": [],
            ...
        },
        {
            "id": "05ef3389-d354-0890-a840-dd836ed0c52d",
            "title": "Video: Moreau's Enduring Art",
            "type": "video",
            "description": "Learn how Moreau's art influenced modern painting of the twentieth century.  ",
            "content": "http:\/\/www.artic.edu\/aic\/collections\/citi\/resources\/545.flv",
            "category_ids": [],
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

Example request: http://data-aggregator.test/api/v1/videos/search  
Example output:

```
{
    "preference": null,
    "pagination": {
        "total": 337,
        "limit": 10,
        "offset": 0,
        "total_pages": 34,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_id": "99999999-9999-9999-9999-999999162495",
            "api_model": "videos",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/videos\/99999999-9999-9999-9999-999999162495",
            "id": "99999999-9999-9999-9999-999999162495",
            "title": "Sed Magni Ipsa",
            "timestamp": "2017-12-05T11:42:46-06:00"
        },
        {
            "_score": 1,
            "api_id": "99999999-9999-9999-9999-999999294593",
            "api_model": "videos",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/videos\/99999999-9999-9999-9999-999999294593",
            "id": "99999999-9999-9999-9999-999999294593",
            "title": "Aut Modi Sint",
            "timestamp": "2017-12-05T11:42:46-06:00"
        },
        {
            "_score": 1,
            "api_id": "99999999-9999-9999-9999-999999539319",
            "api_model": "videos",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/videos\/99999999-9999-9999-9999-999999539319",
            "id": "99999999-9999-9999-9999-999999539319",
            "title": "Aut Corporis Minus",
            "timestamp": "2017-12-05T11:42:46-06:00"
        }
    ],
    "aggregations": {
        "count_api_model": [
            {
                "key": "videos",
                "doc_count": 337
            }
        ]
    }
}
```

### `/videos/{id}`

A single videos by the given identifier. {id} is the identifier from our collections managements system.

Example request: http://data-aggregator.test/api/v1/videos/8199a3c6-99fa-582d-449a-bc9221db54da?limit=2  
Example output:

```
{
    "data": {
        "id": "8199a3c6-99fa-582d-449a-bc9221db54da",
        "title": "Video: Cassatt and the Modern Woman",
        "type": "video",
        "description": "An introduction to Cassatt's paintings of women involved in morning activities in the privacy of their bourgeois homes.  ",
        "content": "http:\/\/www.artic.edu\/aic\/collections\/citi\/resources\/530.flv",
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

Example request: http://data-aggregator.test/api/v1/links?limit=2  
Example output:

```
{
    "pagination": {
        "total": 171,
        "limit": 2,
        "offset": 0,
        "total_pages": 86,
        "current_page": 1,
        "next_url": "http:\/\/data-aggregator.test\/api\/v1\/links?page=2&limit=2"
    },
    "data": [
        {
            "id": "3990a5f5-2ae9-3c7b-2fb8-1b0438962cd3",
            "title": "Student Tours: Visit Information",
            "type": "link",
            "description": "Information on planning a student tour: application dates, reservation and museum contact information. ",
            "content": "http:\/\/www.artic.edu\/aic\/students\/tours\/index.html",
            "category_ids": [],
            ...
        },
        {
            "id": "569000e1-b10b-afdb-71f7-eb2858f61b04",
            "title": "Impressionism and Post-Impressionism:  Books and Media",
            "type": "link",
            "description": "A link to an Art Institute listing of media resources and  books for adults and children on Impressionism and Post-Impressionism.  ",
            "content": "http:\/\/www.artic.edu\/artaccess\/AA_Impressionist\/pages\/IMP_books.shtml",
            "category_ids": [],
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

Example request: http://data-aggregator.test/api/v1/links/search  
Example output:

```
{
    "preference": null,
    "pagination": {
        "total": 171,
        "limit": 10,
        "offset": 0,
        "total_pages": 18,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_id": "99999999-9999-9999-9999-999999120492",
            "api_model": "links",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/links\/99999999-9999-9999-9999-999999120492",
            "id": "99999999-9999-9999-9999-999999120492",
            "title": "Voluptatem Qui Omnis",
            "timestamp": "2017-12-05T11:36:31-06:00"
        },
        {
            "_score": 1,
            "api_id": "99999999-9999-9999-9999-999999398469",
            "api_model": "links",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/links\/99999999-9999-9999-9999-999999398469",
            "id": "99999999-9999-9999-9999-999999398469",
            "title": "Quo Illum Voluptatem",
            "timestamp": "2017-12-05T11:36:31-06:00"
        },
        {
            "_score": 1,
            "api_id": "99999999-9999-9999-9999-999999645356",
            "api_model": "links",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/links\/99999999-9999-9999-9999-999999645356",
            "id": "99999999-9999-9999-9999-999999645356",
            "title": "Est Cumque At",
            "timestamp": "2017-12-05T11:36:31-06:00"
        }
    ],
    "aggregations": {
        "count_api_model": [
            {
                "key": "links",
                "doc_count": 171
            }
        ]
    }
}
```

### `/links/{id}`

A single links by the given identifier. {id} is the identifier from our collections managements system.

Example request: http://data-aggregator.test/api/v1/links/3990a5f5-2ae9-3c7b-2fb8-1b0438962cd3?limit=2  
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

Example request: http://data-aggregator.test/api/v1/sounds?limit=2  
Example output:

```
{
    "pagination": {
        "total": 1045,
        "limit": 2,
        "offset": 0,
        "total_pages": 523,
        "current_page": 1,
        "next_url": "http:\/\/data-aggregator.test\/api\/v1\/sounds?page=2&limit=2"
    },
    "data": [
        {
            "id": "ed908ded-b1be-12d3-10ee-ca43cf0f42d8",
            "title": "Audio Lecture: Jan Tumlir Lectures on Jeff Wall",
            "type": "sound",
            "description": "<p>Jan Tumlir teaches art and film theory at the Art Center and University of Southern California, and is a regular contributor to <em>ArtForum<\/em>, <em>Frieze<\/em>, and <em>Flash Art<\/em>. Here, he and Thomas Crow discuss Jeff Wall  and more specifically, Tumlir's essay \"Profane Illuminations: The Social History of Jeff Wall.\"<\/p>",
            "content": "http:\/\/www.artic.edu\/aic\/collections\/citi\/resources\/687_tumlir.mp3",
            "category_ids": [],
            ...
        },
        {
            "id": "dec011c1-f3cb-4d17-f42d-47c4978fbfb2",
            "title": "440.wav",
            "type": "sound",
            "description": null,
            "content": null,
            "category_ids": [],
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

Example request: http://data-aggregator.test/api/v1/sounds/search  
Example output:

```
{
    "preference": null,
    "pagination": {
        "total": 1045,
        "limit": 10,
        "offset": 0,
        "total_pages": 105,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_id": "99999999-9999-9999-9999-999999446829",
            "api_model": "sounds",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/sounds\/99999999-9999-9999-9999-999999446829",
            "id": "99999999-9999-9999-9999-999999446829",
            "title": "Aut Ratione Et",
            "timestamp": "2017-12-05T11:42:57-06:00"
        },
        {
            "_score": 1,
            "api_id": "99999999-9999-9999-9999-999999728253",
            "api_model": "sounds",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/sounds\/99999999-9999-9999-9999-999999728253",
            "id": "99999999-9999-9999-9999-999999728253",
            "title": "Est Aperiam Doloremque",
            "timestamp": "2017-12-05T11:42:57-06:00"
        },
        {
            "_score": 1,
            "api_id": "99999999-9999-9999-9999-999999735589",
            "api_model": "sounds",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/sounds\/99999999-9999-9999-9999-999999735589",
            "id": "99999999-9999-9999-9999-999999735589",
            "title": "Quia Reprehenderit At",
            "timestamp": "2017-12-05T11:42:57-06:00"
        }
    ],
    "aggregations": {
        "count_api_model": [
            {
                "key": "sounds",
                "doc_count": 1045
            }
        ]
    }
}
```

### `/sounds/{id}`

A single sounds by the given identifier. {id} is the identifier from our collections managements system.

Example request: http://data-aggregator.test/api/v1/sounds/0dc99580-0a4c-c047-31e9-f42d29ac020e?limit=2  
Example output:

```
{
    "data": {
        "id": "0dc99580-0a4c-c047-31e9-f42d29ac020e",
        "title": "Audio Lecture: Sally Mann at the Art Institute of Chicago",
        "type": "sound",
        "description": "<p>Tune in as contemporary photographer Mann answers questions from an audience of nearly 400 on opening day of the Art Institute exhibition <em>So the Story Goes<\/em>. Mann responds to questions ranging from printing techniques to subject matter, from disbelief in photographic \"truth\" to a Southern weakness for the romantic.<\/p>",
        "content": "http:\/\/www.artic.edu\/aic\/collections\/citi\/resources\/691_mann.mp3",
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

Example request: http://data-aggregator.test/api/v1/texts?limit=2  
Example output:

```
{
    "pagination": {
        "total": 626,
        "limit": 2,
        "offset": 0,
        "total_pages": 313,
        "current_page": 1,
        "next_url": "http:\/\/data-aggregator.test\/api\/v1\/texts?page=2&limit=2"
    },
    "data": [
        {
            "id": "faeafe89-a188-f706-6806-cbec200a9000",
            "title": "Artist Biography: Thomas Wilmer Dewing",
            "type": "text",
            "description": "A concise biography of Dewing's life and work.  ",
            "content": "Thomas Wilmer Dewing<br>\nAmerican, 1851-1938<br>\nThomas Wilmer Dewing was best known for his portrayals of elegant, refined women posed within sparse interiors or outdoors in lush green fields. He drew inspiration from the work of Johannes Vermeer and James McNeill Whistler.<br><br>\nFrom an early age Dewing was interested in music, the theme of many of his later paintings. He was apprenticed to a lithographer and later studied painting at the Museum of Fine Arts, Boston, and the Acad\u00e9mie Julian in France.<br><br>\nIn 1897 Dewing joined a group called The Ten, although his subdued, naturalistic technique had little in common with the more impressionistic work of other members. He continued to paint into the first quarter of the twentieth century, enjoying the patronage of notable collectors.\n",
            "category_ids": [],
            ...
        },
        {
            "id": "f8f6e634-f01a-d665-c7a9-5b0ad10aafdb",
            "title": "Introduction: Monet's Mediterranean Landscapes",
            "type": "text",
            "description": "An overview of Monet's brilliant landscape, painted with a  \"palette of diamonds and precious stones,\"  of a resort town just over the Italian border.  ",
            "content": "Having spent much of 1882 and 1883 scouring the cliffs of the Normandy coast for motifs, Claude Monet passed the winter and early spring of 1884 in the south of France, on the Mediterranean. In December of the previous year, he had discovered the area while traveling with Pierre Auguste Renoir; but he returned alone, determined \"to do some astounding things.\" <br><br>\nMonet remained dedicated to Impressionism at the very moment that his colleagues, Renoir among them, were turning away from its aim of capturing transitory natural effects. Thus, in Bordighera, a resort town just over the Italian border, he responded immediately to the warm and constant southern light, so different from that of northern regions. Searching for painterly equivalents to this new environment, Monet covered canvases such as this one with a riot of intense greens and blues that at first glance seem to struggle with each other, but ultimately coalesce into a vibrant composition. Through a foreground choked with olive trees, we glimpse a sun-bleached town, beyond which the sea forms an expansive horizon. <br><br>\nAbsorbed in the unique features of Bordighera, Monet worried that people would think his renderings false or exaggerated. He disregarded the picturesque conventions of guidebook illustrations to reveal the almost overpowering brilliance of the Mediterranean. Monet did not seek to contain or control the twisted tree trunks, bent by centuries of strong coastal winds; nor did he modify the gemlike azure of the water. Using what he described as a \"palette of diamonds and precious stones,\" he moved beyond naturalism and emphasized the decorative aspects of his work, thus taking an early step along the road to his own version of Post-Impressionism.\n",
            "category_ids": [],
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

Example request: http://data-aggregator.test/api/v1/texts/search  
Example output:

```
{
    "preference": null,
    "pagination": {
        "total": 626,
        "limit": 10,
        "offset": 0,
        "total_pages": 63,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_id": "99999999-9999-9999-9999-999999128137",
            "api_model": "texts",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/texts\/99999999-9999-9999-9999-999999128137",
            "id": "99999999-9999-9999-9999-999999128137",
            "title": "Ea Sed Officiis",
            "timestamp": "2017-12-05T11:43:04-06:00"
        },
        {
            "_score": 1,
            "api_id": "99999999-9999-9999-9999-999999316657",
            "api_model": "texts",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/texts\/99999999-9999-9999-9999-999999316657",
            "id": "99999999-9999-9999-9999-999999316657",
            "title": "Quasi Cumque Omnis",
            "timestamp": "2017-12-05T11:43:04-06:00"
        },
        {
            "_score": 1,
            "api_id": "99999999-9999-9999-9999-999999341336",
            "api_model": "texts",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/texts\/99999999-9999-9999-9999-999999341336",
            "id": "99999999-9999-9999-9999-999999341336",
            "title": "Delectus Maxime Adipisci",
            "timestamp": "2017-12-05T11:43:04-06:00"
        }
    ],
    "aggregations": {
        "count_api_model": [
            {
                "key": "texts",
                "doc_count": 626
            }
        ]
    }
}
```

### `/texts/{id}`

A single texts by the given identifier. {id} is the identifier from our collections managements system.

Example request: http://data-aggregator.test/api/v1/texts/28f4641e-c040-7669-6036-f6fce1e25514?limit=2  
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

Example request: http://data-aggregator.test/api/v1/shop-categories?limit=2  
Example output:

```
{
    "pagination": {
        "total": 25,
        "limit": 2,
        "offset": 0,
        "total_pages": 13,
        "current_page": 1,
        "next_url": "http:\/\/data-aggregator.test\/api\/v1\/shop-categories?page=2&limit=2"
    },
    "data": [
        {
            "id": 999700,
            "title": "Ut repellat rem dolorem repudiandae",
            "link": "http:\/\/www.gottlieb.com\/ut-id-doloremque-consectetur-possimus-iure",
            "parent_id": 999388,
            "type": "sub-category",
            "source_id": 67,
            ...
        },
        {
            "id": 999977,
            "title": "Sit adipisci libero nihil quia",
            "link": "http:\/\/www.ortiz.com\/et-praesentium-assumenda-mollitia-provident-eaque-unde-laudantium",
            "parent_id": 999673,
            "type": "artist",
            "source_id": 43,
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

Example request: http://data-aggregator.test/api/v1/shop-categories/search  
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
            "api_id": "999232",
            "api_model": "shop-categories",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/shop-categories\/999232",
            "id": 999232,
            "title": "Deserunt omnis itaque repellat iure",
            "timestamp": "2017-12-05T11:43:33-06:00"
        },
        {
            "_score": 1,
            "api_id": "999273",
            "api_model": "shop-categories",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/shop-categories\/999273",
            "id": 999273,
            "title": "Cupiditate rerum ipsum dignissimos fuga",
            "timestamp": "2017-12-05T11:43:33-06:00"
        },
        {
            "_score": 1,
            "api_id": "999275",
            "api_model": "shop-categories",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/shop-categories\/999275",
            "id": 999275,
            "title": "Et rerum ut maxime ut",
            "timestamp": "2017-12-05T11:43:33-06:00"
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

Example request: http://data-aggregator.test/api/v1/shop-categories/999700?limit=2  
Example output:

```
{
    "data": {
        "id": 999700,
        "title": "Ut repellat rem dolorem repudiandae",
        "link": "http:\/\/www.gottlieb.com\/ut-id-doloremque-consectetur-possimus-iure",
        "parent_id": 999388,
        "type": "sub-category",
        "source_id": 67,
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

Example request: http://data-aggregator.test/api/v1/products?limit=2  
Example output:

```
{
    "pagination": {
        "total": 25,
        "limit": 2,
        "offset": 0,
        "total_pages": 13,
        "current_page": 1,
        "next_url": "http:\/\/data-aggregator.test\/api\/v1\/products?page=2&limit=2"
    },
    "data": [
        {
            "id": 999426,
            "title": "Dolorem Labore Aut Molestiae Reprehenderit Libero",
            "title_display": "Dolorem Labore <em>Aut Molestiae<\/em> Reprehenderit Libero",
            "sku": "87898035",
            "link": "http:\/\/wuckert.net\/",
            "image": "http:\/\/lorempixel.com\/640\/480\/?74608",
            ...
        },
        {
            "id": 999444,
            "title": "Voluptas Consequatur Dolorem Assumenda Vero Quaerat",
            "title_display": "Voluptas Consequatur <em>Dolorem Assumenda<\/em> Vero Quaerat",
            "sku": "14723728",
            "link": "https:\/\/wiegand.biz\/ipsa-deleniti-vero-laudantium-minima-ut-perferendis.html",
            "image": "http:\/\/lorempixel.com\/640\/480\/?35008",
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

Example request: http://data-aggregator.test/api/v1/products/search  
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
            "api_id": "999189",
            "api_model": "products",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/products\/999189",
            "id": 999189,
            "title": "Voluptas Ut At Distinctio Ut In",
            "timestamp": "2017-12-05T11:43:27-06:00"
        },
        {
            "_score": 1,
            "api_id": "999515",
            "api_model": "products",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/products\/999515",
            "id": 999515,
            "title": "Velit Pariatur Ab Ex Aliquid Consequatur",
            "timestamp": "2017-12-05T11:43:27-06:00"
        },
        {
            "_score": 1,
            "api_id": "999562",
            "api_model": "products",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/products\/999562",
            "id": 999562,
            "title": "Reiciendis Facilis Magnam Possimus Velit Minus",
            "timestamp": "2017-12-05T11:43:27-06:00"
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

Example request: http://data-aggregator.test/api/v1/products/999426?limit=2  
Example output:

```
{
    "data": {
        "id": 999426,
        "title": "Dolorem Labore Aut Molestiae Reprehenderit Libero",
        "title_display": "Dolorem Labore <em>Aut Molestiae<\/em> Reprehenderit Libero",
        "sku": "87898035",
        "link": "http:\/\/wuckert.net\/",
        "image": "http:\/\/lorempixel.com\/640\/480\/?74608",
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

Example request: http://data-aggregator.test/api/v1/events?limit=2  
Example output:

```
{
    "pagination": {
        "total": 2057,
        "limit": 2,
        "offset": 0,
        "total_pages": 1029,
        "current_page": 1,
        "next_url": "http:\/\/data-aggregator.test\/api\/v1\/events?page=2&limit=2"
    },
    "data": [
        {
            "id": 2639272,
            "title": "Museum Closed for New Year&#039;s Day",
            "description": "",
            "short_description": "",
            "image": "",
            "type": "",
            ...
        },
        {
            "id": 2636974,
            "title": "Museum Closed for New Year&#039;s Day",
            "description": "",
            "short_description": "",
            "image": "",
            "type": "",
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

Example request: http://data-aggregator.test/api/v1/events/search  
Example output:

```
{
    "preference": null,
    "pagination": {
        "total": 2057,
        "limit": 10,
        "offset": 0,
        "total_pages": 206,
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
            "timestamp": "2017-12-04T01:43:43-06:00"
        },
        {
            "_score": 1,
            "api_id": "14110",
            "api_model": "events",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/events\/14110",
            "id": 14110,
            "title": "Sketch Class: Still Life \u2014 Approaches and Meanings",
            "timestamp": "2017-12-04T01:43:43-06:00"
        },
        {
            "_score": 1,
            "api_id": "14119",
            "api_model": "events",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/events\/14119",
            "id": 14119,
            "title": "Griffith Mann",
            "timestamp": "2017-12-04T01:43:43-06:00"
        }
    ],
    "aggregations": {
        "count_api_model": [
            {
                "key": "events",
                "doc_count": 2057
            }
        ]
    }
}
```

### `/events/{id}`

A single events by the given identifier.

Example request: http://data-aggregator.test/api/v1/events/28990343?limit=2  
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

Example request: http://data-aggregator.test/api/v1/tours?limit=2  
Example output:

```
{
    "pagination": {
        "total": 33,
        "limit": 2,
        "offset": 0,
        "total_pages": 17,
        "current_page": 1,
        "next_url": "http:\/\/data-aggregator.test\/api\/v1\/tours?page=2&limit=2"
    },
    "data": [
        {
            "id": 2333,
            "title": "Gauguin: Artist as Alchemist",
            "image": "http:\/\/aicweb10.artic.edu\/sites\/default\/files\/tour-images\/gauguin.jpg",
            "description": "Get to know the many sides of the complex artist&nbsp;Paul Gauguin.",
            "intro": "Gauguin believed that any material could be transformed into art in his hands. In that sense, he can be considered an alchemist.&nbsp;Relentlessly adventurous in his work, he created distinctive, innovative art across a wide variety of media. This audio tour explores the most in-depth examination to date of his radical experiments as a painter, sculptor, ceramist, printmaker, and decorator.&nbsp;",
            "weight": null,
            ...
        },
        {
            "id": 2193,
            "title": "The Essentials Tour",
            "image": "http:\/\/aicweb10.artic.edu\/sites\/default\/files\/tour-images\/english%20%281%29.jpg",
            "description": "Discover the stories behind some of the museum\u2019s most iconic artworks.",
            "intro": "Indulge in the sunlit bank of the River Seine in Georges Seurat\u2019s \"A Sunday on La Grande Jatte\" or make a late-night stop at a New York City diner in Edward Hopper\u2019s \"Nighthawks\" in this tour of the museum\u2019s iconic collection. Founded in 1879, the Art Institute of Chicago is home to a massive collection spanning nearly all of human history. As you explore centuries of art, this tour highlights some essential landmarks\u2014with lesser known, but equally engaging artworks\u2014along the way. The soundtrack features the music of Andrew Bird, another Chicago essential.",
            "weight": null,
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

Example request: http://data-aggregator.test/api/v1/tours/search  
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
            "timestamp": "2017-12-04T01:43:50-06:00"
        },
        {
            "_score": 1,
            "api_id": "2333",
            "api_model": "tours",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/tours\/2333",
            "id": 2333,
            "title": "Gauguin: Artist as Alchemist",
            "timestamp": "2017-12-04T01:43:50-06:00"
        },
        {
            "_score": 1,
            "api_id": "9992272",
            "api_model": "tours",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/tours\/9992272",
            "id": 9992272,
            "title": "Eum soluta repellendus",
            "timestamp": "2017-12-04T01:43:50-06:00"
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

Example request: http://data-aggregator.test/api/v1/tours/2280?limit=2  
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

Example request: http://data-aggregator.test/api/v1/tour-stops?limit=2  
Example output:

```
{
    "pagination": {
        "total": 160,
        "limit": 2,
        "offset": 0,
        "total_pages": 80,
        "current_page": 1,
        "next_url": "http:\/\/data-aggregator.test\/api\/v1\/tour-stops?page=2&limit=2"
    },
    "data": [
        {
            "id": 160,
            "title": "American Gothic",
            "artwork": "American Gothic",
            "artwork_id": null,
            "mobile_sound": "http:\/\/aicweb10.artic.edu\/sites\/default\/files\/audio\/263c.mp3",
            "mobile_sound_id": null,
            ...
        },
        {
            "id": 72,
            "title": "Clovis Sleeping",
            "artwork": "Clovis Sleeping",
            "artwork_id": null,
            "mobile_sound": "http:\/\/aicweb10.artic.edu\/sites\/default\/files\/audio\/244.mp3",
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

Example request: http://data-aggregator.test/api/v1/tour-stops/search  
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

Example request: http://data-aggregator.test/api/v1/tour-stops/62?limit=2  
Example output:

```
{
    "data": {
        "id": 62,
        "title": "Reprehenderit aliquam alias",
        "artwork": "Reprehenderit aliquam alias",
        "artwork_id": null,
        "mobile_sound": "http:\/\/dickinson.org\/est-ut-velit-quasi-consequuntur-quam-architecto-ducimus.html",
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

Example request: http://data-aggregator.test/api/v1/mobile-sounds?limit=2  
Example output:

```
{
    "pagination": {
        "total": 549,
        "limit": 2,
        "offset": 0,
        "total_pages": 275,
        "current_page": 1,
        "next_url": "http:\/\/data-aggregator.test\/api\/v1\/mobile-sounds?page=2&limit=2"
    },
    "data": [
        {
            "id": 2318,
            "title": "Gauguin: Artist as Alchemist introduction",
            "link": "http:\/\/aicweb10.artic.edu\/sites\/default\/files\/audio\/243.mp3",
            "transcript": "GLORIA GROOM: Gauguin believed in the artist\u2019s ability to take raw materials and transform them into something entirely new. He didn\u2019t limit himself to conventional media or techniques\u2014he believed that any material, any object could be transformed into art in his hands. and In that sense, he can be considered an alchemist. This is Gloria Groom, curator of the exhibition Gauguin: Artist as Alchemist. Joining us today will be Allison Perelman, Research Associate, and Harriet Stratis, Senior Research Conservator. \r\n\r\nALLISON PERELMAN: I think that visitors to this exhibition will see that from the very beginning of his career Gauguin was being very experimental with materials. It was speaking about ceramics specifically that Gauguin really gets to the crux of what it means to be an alchemist. And that he said, \u201cThat with a little bit of clay he can transform it into a jewel. Into anything.\u201d I am Allison Perelman, research associate for Gauguin: Artist as Alchemist\r\n\r\nHARRIET STRATIS: I think experimentation is the one word that quintessentially describes Gauguin. His manner of working, his use of recurrent motifs that we\u2019ll see over and over again over the course of three decades. He was innovative until the end. And this ability to innovate and ability to use motifs unprecedented in french art. I\u2019m Harriet Stratis, senior research conservator for the Gauguin: Artist as Alchemist exhibition. \r\n\r\nGLORIA GROOM: While many exhibitions have considered Gauguin\u2019s life in art, Gauguin: Art as Alchemist delves into Gauguin\u2019s creative process. He doesn\u2019t have the formal training of an art school, but he did have a global training, and the sites, cultures, and objects he discovered while traveling the world shaped his artistic outlook. Walking through the galleries, you will learn about his approach to materials, his development of a deliberately primitive, crude aesthetic, his willingness to embrace chance and randomness, and how his breakthroughs in one material led to experiments in others. \r\n",
            "last_updated_source": null,
            "last_updated": "2017-11-20T11:14:44-06:00",
            ...
        },
        {
            "id": 2319,
            "title": "Clovis Sleeping",
            "link": "http:\/\/aicweb10.artic.edu\/sites\/default\/files\/audio\/244.mp3",
            "transcript": "GLORIA GROOM: So this is a painting that shows his son Clovis beside a large wood tankard. And here he\u2019s using it to set the mood along with this wallpaper, which has this sort of lyrical musical quality to it. It\u2019s part of the dreamscape that he\u2019s created for his young son. And he first shows it in a still life. He\u2019s setting it up and he\u2019s fascinated by the shape, by the way light\u2019s catching it. And he\u2019s setting up kind of a dialogue of sorts with this heavy wooden tankard and this smaller pewter pitcher. For he didn\u2019t consider ordinary objects ordinary at all. For him they have a very special meaning. And he will continue to sort of fixate on objects, and figures, and motifs that inspire him and these  will appear in his works throughout his career.\r\n\r\nALLISON PERELMEN: Walking further into the gallery you will see a large wooden cabinet. Here Gauguin is engaging with something he will do for the rest of his career: taking a found object and making it his own by carving into the surface, by adding decorative elements, painting them. Here, he is takes an elegant piece of furniture and deliberately makes it more crude with his rough carvings and mix of design elements. And although he\u2019d likely did not construct this cabinet himself, he signed it \u201cGauguin Fecit\u201d, which is Latin for \u201cGauguin made this,\u201d to make clear that this wasn\u2019t just a piece of furniture but an artwork in its own right. \r\n\u2003\r\n",
            "last_updated_source": null,
            "last_updated": "2017-11-20T11:14:44-06:00",
            ...
        }
    ]
}
```

### `/mobile-sounds/{id}`

A single mobile-sounds by the given identifier.

Example request: http://data-aggregator.test/api/v1/mobile-sounds/1545?limit=2  
Example output:

```
{
    "data": {
        "id": 1545,
        "title": "Trompe-l'Oeil Still Life with a Flower Garland and a Curtain",
        "link": "http:\/\/aicweb10.artic.edu\/sites\/default\/files\/audio\/757.mp3",
        "transcript": "&quot;Narrator:  Painted in the Netherlands in 1658, this masterly still life held a fascinating secret for many years. Curator Martha Wolff.\nMartha Wolff:  This painting is signed by Adriaen van der Spelt, a still life painter whose work is rather rare. But fairly recently, we realized that it&#039;s in fact a collaboration between van der Spelt and a more famous painter named Frans van Mieris who contributed the beautiful blue satin curtain that is drawn across part of the picture.\nNarrator:  The young artists had both just joined the Painters Gild in the City of Leiden, so this picture was probably a demonstration in their skill in the art of illusion.\nMartha Wolff:  And also a reflection of actual usage at the time, because Dutch collectors would use curtains to protect particularly exquisite pictures from light and also to give the viewer the thrill of pulling back the curtain and seeing what was displayed behind it. And you have multiple layers of illusion here because you have first the stone arch and then you have the garland that&#039;s draped in front of it, and then you have the curtain. And one of the most wonderful things is really the brass rod which plays off of the frame of the picture. It stands in front of it.&quot;",
        "last_updated_source": null,
        "last_updated": "2017-11-20T11:14:43-06:00",
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

Example request: http://data-aggregator.test/api/v1/publications?limit=2  
Example output:

```
{
    "pagination": {
        "total": 10,
        "limit": 2,
        "offset": 0,
        "total_pages": 5,
        "current_page": 1,
        "next_url": "http:\/\/data-aggregator.test\/api\/v1\/publications?page=2&limit=2"
    },
    "data": [
        {
            "id": 7,
            "title": "Pissarro Paintings and Works on Paper at the Art Institute of Chicago",
            "web_url": "https:\/\/publications.artic.edu\/pissarro\/reader\/paintingsandpaper",
            "site": "pissarro",
            "alias": "paintingsandpaper",
            "section_ids": [
                518663,
                517645,
                464158,
                1588,
                463195,
                622,
                580495,
                658,
                462233,
                695,
                982,
                461272,
                522745,
                521723,
                520702,
                520,
                268,
                292,
                553,
                587,
                343,
                19298,
                370,
                128,
                398,
                163,
                427,
                182,
                202,
                223,
                488,
                245
            ],
            ...
        },
        {
            "id": 12,
            "title": "The Modern Series at the Art Institute of Chicago",
            "web_url": "https:\/\/publications.artic.edu\/modernseries\/reader\/shatterrupturebreak",
            "site": "modernseries",
            "alias": "shatterrupturebreak",
            "section_ids": [
                119303,
                8243,
                7988,
                7490,
                7247,
                66417,
                8372,
                7862,
                7613,
                120773,
                120282,
                106478,
                119792,
                6657,
                5138,
                100115,
                2333,
                1313,
                4643,
                807,
                1068,
                3642,
                3390,
                3903,
                582,
                5447,
                4937,
                3147,
                4173,
                848,
                38490,
                2913,
                2402,
                38768,
                6773,
                5240,
                4740,
                6542,
                3992,
                3227,
                933,
                5037,
                2990,
                36302,
                7127,
                728,
                5343,
                3815,
                6890,
                3308,
                1262,
                5873,
                4082,
                3068,
                767,
                515,
                4358,
                2067,
                2837,
                5658,
                6428,
                548,
                2615,
                6203,
                38213,
                1365,
                5982,
                4452,
                617,
                890,
                5765,
                1163,
                653,
                3728,
                3473,
                35232,
                1698,
                2472,
                4265,
                35498,
                6315,
                5552,
                690,
                35765,
                1212,
                36033,
                4547,
                452,
                2762,
                6092,
                977,
                2265,
                483,
                2543,
                1527,
                1022,
                15387,
                106017,
                8502,
                338,
                1115,
                7008,
                365,
                2688,
                393,
                1418,
                34703,
                34967,
                422,
                3557
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

Example request: http://data-aggregator.test/api/v1/publications/search  
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
            "_score": 1,
            "api_id": "12",
            "api_model": "publications",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/publications\/12",
            "id": 12,
            "title": "The Modern Series at the Art Institute of Chicago",
            "timestamp": "2017-12-04T01:43:50-06:00"
        },
        {
            "_score": 1,
            "api_id": "226",
            "api_model": "publications",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/publications\/226",
            "id": 226,
            "title": "James Ensor: The Temptation of Saint Anthony",
            "timestamp": "2017-12-04T01:43:50-06:00"
        },
        {
            "_score": 1,
            "api_id": "406",
            "api_model": "publications",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/publications\/406",
            "id": 406,
            "title": "Whistler and Roussel: Linked Visions",
            "timestamp": "2017-12-04T01:43:50-06:00"
        }
    ],
    "aggregations": {
        "count_api_model": [
            {
                "key": "publications",
                "doc_count": 6
            }
        ]
    }
}
```

### `/publications/{id}`

A single publications by the given identifier.

Example request: http://data-aggregator.test/api/v1/publications/445?limit=2  
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
            530519,
            420457,
            514159,
            439945,
            538795,
            417709,
            448432,
            508090,
            506075,
            505069,
            421375,
            520264,
            422294,
            439007,
            414970
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

Example request: http://data-aggregator.test/api/v1/sections?limit=2  
Example output:

```
{
    "pagination": {
        "total": 845,
        "limit": 2,
        "offset": 0,
        "total_pages": 423,
        "current_page": 1,
        "next_url": "http:\/\/data-aggregator.test\/api\/v1\/sections?page=2&limit=2"
    },
    "data": [
        {
            "id": 518663,
            "title": "Authors and Contributors",
            "web_url": "https:\/\/publications.artic.edu\/pissarro\/reader\/paintingsandpaper\/section\/1010",
            "accession": null,
            "revision": 1502911013,
            "source_id": 1010,
            ...
        },
        {
            "id": 517645,
            "title": "About this Catalogue",
            "web_url": "https:\/\/publications.artic.edu\/pissarro\/reader\/paintingsandpaper\/section\/1009",
            "accession": null,
            "revision": 1502911013,
            "source_id": 1009,
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

Example request: http://data-aggregator.test/api/v1/sections/search  
Example output:

```
{
    "preference": null,
    "pagination": {
        "total": 469,
        "limit": 10,
        "offset": 0,
        "total_pages": 47,
        "current_page": 1
    },
    "data": [
        {
            "_score": 5.1484118,
            "api_id": "111401",
            "api_model": "sections",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/sections\/111401",
            "id": 111401,
            "title": "Sheet 3F",
            "timestamp": "2017-12-04T01:43:51-06:00"
        },
        {
            "_score": 1,
            "api_id": "338",
            "api_model": "sections",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/sections\/338",
            "id": 338,
            "title": "Modern Series Title",
            "timestamp": "2017-12-04T01:43:51-06:00"
        },
        {
            "_score": 1,
            "api_id": "343",
            "api_model": "sections",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/sections\/343",
            "id": 343,
            "title": "Cat. 6  Tinker with His Tools, 1874\/76",
            "timestamp": "2017-12-04T01:43:51-06:00"
        }
    ],
    "aggregations": {
        "count_api_model": [
            {
                "key": "sections",
                "doc_count": 469
            }
        ]
    }
}
```

### `/sections/{id}`

A single sections by the given identifier.

Example request: http://data-aggregator.test/api/v1/sections/3014259?limit=2  
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

Example request: http://data-aggregator.test/api/v1/sites?limit=2  
Example output:

```
{
    "pagination": {
        "total": 96,
        "limit": 2,
        "offset": 0,
        "total_pages": 48,
        "current_page": 1,
        "next_url": "http:\/\/data-aggregator.test\/api\/v1\/sites?page=2&limit=2"
    },
    "data": [
        {
            "id": 82,
            "title": "Making Place: The Architecture of David Adjaye",
            "description": "With over 50 built projects across the world, David Adjaye is rapidly emerging as a major international figure in architecture and design. Rather than advancing a signature architectural style, Adjaye\u2019s structures address local concerns and conditions through both a historical understanding of context and a global understanding of modernism. The first comprehensive museum survey devoted to Adjaye, this exhibition offers an in-depth overview of the architect\u2019s distinct approach and visual language with a dynamic installation design conceived by Adjaye Associates.",
            "web_url": "http:\/\/archive.artic.edu\/adjaye\/",
            "exhibition_ids": [
                3053
            ],
            "artist_ids": [],
            ...
        },
        {
            "id": 83,
            "title": "Historical Exhibitions: The Armory Show",
            "description": "2013 marks the 100th anniversary of the International Exhibition of Modern Art, better known today as the Armory Show. A landmark event in the history of art, this monumental exhibition showcased the works of the most radical European artists of the day alongside those of their progressive American contemporaries. Presented differently at each of its three venues\u2014New York (69th Regiment Armory, February 17\u2013March 15), Chicago (Art Institute of Chicago, March 24\u2013April 16), and Boston (Copley Society, April 23\u2013May 14)\u2014the exhibition introduced a broad spectrum of the American public to the visual language of European modernism, forever changing the aesthetic landscape for American artists, collectors, critics, and arts institutions.",
            "web_url": "http:\/\/archive.artic.edu\/armoryshow\/",
            "exhibition_ids": [
                4586
            ],
            "artist_ids": [],
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

Example request: http://data-aggregator.test/api/v1/sites/search  
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
            "api_model": "sites",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/sites\/14",
            "id": 14,
            "title": "The Medici, Michelangelo, and the Art of Late Renaissance Florence",
            "timestamp": "2018-01-08T10:22:43-06:00"
        },
        {
            "_score": 1,
            "api_id": "19",
            "api_model": "sites",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/sites\/19",
            "id": 19,
            "title": "Perpetual Glory: Medieval Islamic Ceramics from the Harvey B. Plotnick Collection",
            "timestamp": "2018-01-08T10:22:44-06:00"
        },
        {
            "_score": 1,
            "api_id": "22",
            "api_model": "sites",
            "api_link": "http:\/\/aggregator-data-test.artic.edu\/api\/v1\/sites\/22",
            "id": 22,
            "title": "Seurat and the Making of \"La Grande Jatte\"",
            "timestamp": "2018-01-08T10:22:44-06:00"
        }
    ],
    "aggregations": {
        "count_api_model": [
            {
                "key": "sites",
                "doc_count": 96
            }
        ]
    }
}
```

### `/sites/{id}`

A single sites by the given identifier.

Example request: http://data-aggregator.test/api/v1/sites/1?limit=2  
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
            72565,
            31760,
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

Example request: http://data-aggregator.test/api/v1/archive-images?limit=2  
Example output:

```
{
    "pagination": {
        "total": 55591,
        "limit": 2,
        "offset": 0,
        "total_pages": 27796,
        "current_page": 1,
        "next_url": "http:\/\/data-aggregator.test\/api\/v1\/archive-images?page=2&limit=2"
    },
    "data": [
        {
            "id": 25600,
            "title": "Freeman, Samuel, Residence",
            "alternate_title": null,
            "web_url": "http:\/\/digital-libraries.saic.edu\/cdm\/ref\/collection\/mqc\/id\/25600",
            "collection": "Historic Architecture and Landscape Image Collection, c.1865-1973 (bulk 1890-1930)",
            "archive": "Architecture Lantern Slide Collection",
            ...
        },
        {
            "id": 25856,
            "title": "Residence",
            "alternate_title": null,
            "web_url": "http:\/\/digital-libraries.saic.edu\/cdm\/ref\/collection\/mqc\/id\/25856",
            "collection": "Historic Architecture and Landscape Image Collection, c.1865-1973 (bulk 1890-1930)",
            "archive": "Architecture Lantern Slide Collection",
            ...
        }
    ]
}
```

### `/archive-images/{id}`

A single archive-images by the given identifier.

Example request: http://data-aggregator.test/api/v1/archive-images?limit=2  
Example output:

```
{
    "pagination": {
        "total": 55591,
        "limit": 2,
        "offset": 0,
        "total_pages": 27796,
        "current_page": 1,
        "next_url": "http:\/\/data-aggregator.test\/api\/v1\/archive-images?page=2&limit=2"
    },
    "data": [
        {
            "id": 25600,
            "title": "Freeman, Samuel, Residence",
            "alternate_title": null,
            "web_url": "http:\/\/digital-libraries.saic.edu\/cdm\/ref\/collection\/mqc\/id\/25600",
            "collection": "Historic Architecture and Landscape Image Collection, c.1865-1973 (bulk 1890-1930)",
            "archive": "Architecture Lantern Slide Collection",
            ...
        },
        {
            "id": 25856,
            "title": "Residence",
            "alternate_title": null,
            "web_url": "http:\/\/digital-libraries.saic.edu\/cdm\/ref\/collection\/mqc\/id\/25856",
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

Example request: http://data-aggregator.test/api/v1/library-materials?limit=2  
Example output:

```
{
    "pagination": {
        "total": 6861,
        "limit": 2,
        "offset": 0,
        "total_pages": 3431,
        "current_page": 1,
        "next_url": "http:\/\/data-aggregator.test\/api\/v1\/library-materials?page=2&limit=2"
    },
    "data": [
        {
            "id": "01ARTIC_ALMA2122250010003801",
            "title": "Tokyo",
            "date": 1964,
            "creators": [
                {
                    "id": "n81070576",
                    "uri": "http:\/\/id.loc.gov\/authorities\/names\/n81070576",
                    "title": "Klein, William"
                },
                {
                    "id": "n85126552",
                    "uri": "http:\/\/id.loc.gov\/authorities\/names\/n85126552",
                    "title": "Pinguet, Maurice"
                }
            ],
            "subjects": [
                {
                    "id": "n81070576",
                    "uri": "http:\/\/id.loc.gov\/authorities\/names\/n81070576",
                    "title": "Klein, William"
                },
                {
                    "id": "sh98007384",
                    "uri": "http:\/\/id.loc.gov\/authorities\/subjects\/sh98007384",
                    "title": "Street photography -- Japan -- Tokyo"
                },
                {
                    "id": "sh85101277",
                    "uri": "http:\/\/id.loc.gov\/authorities\/subjects\/sh85101277",
                    "title": "Documentary photography -- Japan"
                }
            ],
            ...
        },
        {
            "id": "01ARTIC_ALMA2122391910003801",
            "title": "Solf\u00e8ge de la couleur",
            "date": 1954,
            "creators": [
                {
                    "id": "n80032099",
                    "uri": "http:\/\/id.loc.gov\/authorities\/names\/n80032099",
                    "title": "Le Grand, Yves"
                }
            ],
            "subjects": [
                {
                    "id": "sh85096675",
                    "uri": "http:\/\/id.loc.gov\/authorities\/subjects\/sh85096675",
                    "title": "Painting -- Technique"
                },
                {
                    "id": "sh85028577",
                    "uri": "http:\/\/id.loc.gov\/authorities\/subjects\/sh85028577",
                    "title": "Color"
                }
            ],
            ...
        }
    ]
}
```

### `/library-materials/{id}`

A single library-materials by the given identifier.

Example request: http://data-aggregator.test/api/v1/library-materials?limit=2  
Example output:

```
{
    "pagination": {
        "total": 6861,
        "limit": 2,
        "offset": 0,
        "total_pages": 3431,
        "current_page": 1,
        "next_url": "http:\/\/data-aggregator.test\/api\/v1\/library-materials?page=2&limit=2"
    },
    "data": [
        {
            "id": "01ARTIC_ALMA2122250010003801",
            "title": "Tokyo",
            "date": 1964,
            "creators": [
                {
                    "id": "n81070576",
                    "uri": "http:\/\/id.loc.gov\/authorities\/names\/n81070576",
                    "title": "Klein, William"
                },
                {
                    "id": "n85126552",
                    "uri": "http:\/\/id.loc.gov\/authorities\/names\/n85126552",
                    "title": "Pinguet, Maurice"
                }
            ],
            "subjects": [
                {
                    "id": "n81070576",
                    "uri": "http:\/\/id.loc.gov\/authorities\/names\/n81070576",
                    "title": "Klein, William"
                },
                {
                    "id": "sh98007384",
                    "uri": "http:\/\/id.loc.gov\/authorities\/subjects\/sh98007384",
                    "title": "Street photography -- Japan -- Tokyo"
                },
                {
                    "id": "sh85101277",
                    "uri": "http:\/\/id.loc.gov\/authorities\/subjects\/sh85101277",
                    "title": "Documentary photography -- Japan"
                }
            ],
            ...
        },
        {
            "id": "01ARTIC_ALMA2122391910003801",
            "title": "Solf\u00e8ge de la couleur",
            "date": 1954,
            "creators": [
                {
                    "id": "n80032099",
                    "uri": "http:\/\/id.loc.gov\/authorities\/names\/n80032099",
                    "title": "Le Grand, Yves"
                }
            ],
            "subjects": [
                {
                    "id": "sh85096675",
                    "uri": "http:\/\/id.loc.gov\/authorities\/subjects\/sh85096675",
                    "title": "Painting -- Technique"
                },
                {
                    "id": "sh85028577",
                    "uri": "http:\/\/id.loc.gov\/authorities\/subjects\/sh85028577",
                    "title": "Color"
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

Example request: http://data-aggregator.test/api/v1/library-terms?limit=2  
Example output:

```
{
    "pagination": {
        "total": 9508,
        "limit": 2,
        "offset": 0,
        "total_pages": 4754,
        "current_page": 1,
        "next_url": "http:\/\/data-aggregator.test\/api\/v1\/library-terms?page=2&limit=2"
    },
    "data": [
        {
            "id": "sh2008101233",
            "uri": "http:\/\/id.loc.gov\/authorities\/subjects\/sh2008101233",
            "title": "Comic books, strips, etc -- Periodicals",
            ...
        },
        {
            "id": "nr00002283",
            "uri": "http:\/\/id.loc.gov\/authorities\/names\/nr00002283",
            "title": "Herz, Nat, 1920-1964 -- Exhibitions",
            ...
        }
    ]
}
```

### `/library-terms/{id}`

A single library-terms by the given identifier.

Example request: http://data-aggregator.test/api/v1/library-terms?limit=2  
Example output:

```
{
    "pagination": {
        "total": 9508,
        "limit": 2,
        "offset": 0,
        "total_pages": 4754,
        "current_page": 1,
        "next_url": "http:\/\/data-aggregator.test\/api\/v1\/library-terms?page=2&limit=2"
    },
    "data": [
        {
            "id": "sh2008101233",
            "uri": "http:\/\/id.loc.gov\/authorities\/subjects\/sh2008101233",
            "title": "Comic books, strips, etc -- Periodicals",
            ...
        },
        {
            "id": "nr00002283",
            "uri": "http:\/\/id.loc.gov\/authorities\/names\/nr00002283",
            "title": "Herz, Nat, 1920-1964 -- Exhibitions",
            ...
        }
    ]
}
```

> Generated by `php artisan docs:endpoints` on 2018-01-08 13:05:43
