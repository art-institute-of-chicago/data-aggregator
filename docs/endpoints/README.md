# Endpoints

## Collections

### Artworks

_The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu._

#### `GET /artworks`

A list of all artworks sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#artworks).

##### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource
* `include` - A comma-separated list of subresource to embed in the returned resources. Available options are:
  * `artist_pivots`
  * `catalogue_pivots`
  * `dates`
  * `place_pivots`
  * `sites`

::: details Example request: https://api.artic.edu/api/v1/artworks?limit=2  
```js
{
    "pagination": {
        "total": 111957,
        "limit": 2,
        "offset": 0,
        "total_pages": 55979,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/artworks?page=2&limit=2"
    },
    "data": [
        {
            "id": 6565,
            "api_model": "artworks",
            "api_link": "https://api.artic.edu/api/v1/artworks/6565",
            "is_boosted": true,
            "title": "American Gothic",
            "alt_titles": null,
            ...
        },
        {
            "id": 51981,
            "api_model": "artworks",
            "api_link": "https://api.artic.edu/api/v1/artworks/51981",
            "is_boosted": false,
            "title": "As\u00ed es el nuevo orden nazi (This Is The New Nazi Regime)",
            "alt_titles": null,
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15",
        "documentation": "http://art-institute-of-chicago.github.io/data-aggregator"
    },
    "config": {
        "iiif_url": "https://lakeimagesweb.artic.edu/iiif/2",
        "shop_image_url": "https://shop-images.imgix.net",
        "shop_product_url": "http://shop.artic.edu/item.aspx?productId=",
        "shop_category_url": "http://shop.artic.edu/item.aspx?productId="
    }
}
```
:::

#### `GET /artworks/search`

Search artworks data in the aggregator. Artworks in the groups of essentials are boosted so they'll show up higher in results.

##### Available parameters:

* `q` - Your search query
* `query` - For complex queries, you can pass Elasticsearch domain syntax queries here
* `sort` - Used in conjunction with `query`
* `from` - Starting point of results. Pagination via Elasticsearch conventions
* `size` - Number of results to return. Pagination via Elasticsearch conventions
* `facets` - A comma-separated list of 'count' aggregation facets to include in the results.

::: details Example request: https://api.artic.edu/api/v1/artworks/search?q=monet
```js
{
    "preference": null,
    "pagination": {
        "total": 293,
        "limit": 10,
        "offset": 0,
        "total_pages": 30,
        "current_page": 1
    },
    "data": [
        {
            "_score": 250.46643,
            "thumbnail": {
                "alt_text": "Painting of a pond seen up close spotted with thickly painted pink and white water lilies and a shadow across the top third of the picture.",
                "width": null,
                "type": "iiif",
                "url": "https://www.artic.edu/iiif/2/5d2717cc-c619-fd84-49c4-62409bb1c04c",
                "lqip": null,
                "height": null
            },
            "api_model": "artworks",
            "is_boosted": true,
            "api_link": "https://aggregator-data.artic.edu/api/v1/artworks/16568",
            "id": 16568,
            "title": "Water Lilies",
            "timestamp": "2020-07-30T03:02:49-05:00"
        },
        {
            "_score": 232.05797,
            "thumbnail": {
                "alt_text": "Loosely painted image of an open-air train station. On the right, a parked train gives off an enormous plumb of white smoke, making the scene look as though it were full of clouds. A huddled mass of barely discernible people crowd around the train on both sides of the tracks. Blue, green, and gray tones dominate.",
                "width": null,
                "type": "iiif",
                "url": "https://www.artic.edu/iiif/2/ddae7b18-6c67-bfe7-f270-c999655b08c7",
                "lqip": null,
                "height": null
            },
            "api_model": "artworks",
            "is_boosted": true,
            "api_link": "https://aggregator-data.artic.edu/api/v1/artworks/16571",
            "id": 16571,
            "title": "Arrival of the Normandy Train, Gare Saint-Lazare",
            "timestamp": "2020-07-30T03:02:49-05:00"
        },
        {
            "_score": 229.49979,
            "thumbnail": {
                "alt_text": "Painting composed of short, dense brushstrokes depicts two domed stacks of wheat that cast long shadows on a field. The angled light indicates either a rising or setting sun.",
                "width": null,
                "type": "iiif",
                "url": "https://www.artic.edu/iiif/2/691c69c1-221a-1faf-14ea-7bc0c0a05fe2",
                "lqip": null,
                "height": null
            },
            "api_model": "artworks",
            "is_boosted": true,
            "api_link": "https://aggregator-data.artic.edu/api/v1/artworks/64818",
            "id": 64818,
            "title": "Stacks of Wheat (End of Summer)",
            "timestamp": "2020-07-30T14:52:15-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15"
    }
}
```
:::

#### `GET /artworks/{id}`

A single artwork by the given identifier. {id} is the identifier from our collections management system.

::: details Example request: https://api.artic.edu/api/v1/artworks/6565?limit=2  
```js
{
    "data": {
        "id": 6565,
        "api_model": "artworks",
        "api_link": "https://api.artic.edu/api/v1/artworks/6565",
        "is_boosted": true,
        "title": "American Gothic",
        "alt_titles": null,
        ...
    },
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15",
        "documentation": "http://art-institute-of-chicago.github.io/data-aggregator"
    },
    "config": {
        "iiif_url": "https://lakeimagesweb.artic.edu/iiif/2",
        "shop_image_url": "https://shop-images.imgix.net",
        "shop_product_url": "http://shop.artic.edu/item.aspx?productId=",
        "shop_category_url": "http://shop.artic.edu/item.aspx?productId="
    }
}
```
:::

### Agents

_The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu._

#### `GET /agents`

A list of all agents sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#agents).

##### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource
* `include` - A comma-separated list of subresource to embed in the returned resources. Available options are:
  * `sites`
  * `place_pivots`

::: details Example request: https://api.artic.edu/api/v1/agents?limit=2  
```js
{
    "pagination": {
        "total": 13668,
        "limit": 2,
        "offset": 0,
        "total_pages": 6834,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/agents?page=2&limit=2"
    },
    "data": [
        {
            "id": 106504,
            "api_model": "agents",
            "api_link": "https://api.artic.edu/api/v1/agents/106504",
            "title": "Crab Tree Farm Foundation Inc.",
            "sort_title": "Crab Tree Farm Foundation Inc.",
            "alt_titles": [
                "Crab Tree Farm Foundation, Inc."
            ],
            ...
        },
        {
            "id": 63707,
            "api_model": "agents",
            "api_link": "https://api.artic.edu/api/v1/agents/63707",
            "title": "Ruth Orkin",
            "sort_title": "Orkin, Ruth",
            "alt_titles": null,
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15",
        "documentation": "http://art-institute-of-chicago.github.io/data-aggregator"
    },
    "config": {
        "iiif_url": "https://lakeimagesweb.artic.edu/iiif/2",
        "shop_image_url": "https://shop-images.imgix.net",
        "shop_product_url": "http://shop.artic.edu/item.aspx?productId=",
        "shop_category_url": "http://shop.artic.edu/item.aspx?productId="
    }
}
```
:::

#### `GET /agents/search`

Search agents data in the aggregator. 

##### Available parameters:

* `q` - Your search query
* `query` - For complex queries, you can pass Elasticsearch domain syntax queries here
* `sort` - Used in conjunction with `query`
* `from` - Starting point of results. Pagination via Elasticsearch conventions
* `size` - Number of results to return. Pagination via Elasticsearch conventions
* `facets` - A comma-separated list of 'count' aggregation facets to include in the results.

::: details Example request: https://api.artic.edu/api/v1/agents/search
```js
{
    "preference": null,
    "pagination": {
        "total": 13880,
        "limit": 10,
        "offset": 0,
        "total_pages": 1388,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "agents",
            "api_link": "https://aggregator-data.artic.edu/api/v1/agents/60368",
            "id": 60368,
            "title": "Faith Wilding",
            "timestamp": "2020-05-18T04:01:24-05:00"
        },
        {
            "_score": 1,
            "api_model": "agents",
            "api_link": "https://aggregator-data.artic.edu/api/v1/agents/115891",
            "id": 115891,
            "title": "Adam Pendleton",
            "timestamp": "2020-05-18T04:05:02-05:00"
        },
        {
            "_score": 1,
            "api_model": "agents",
            "api_link": "https://aggregator-data.artic.edu/api/v1/agents/1245",
            "id": 1245,
            "title": "Jules Robert Auguste",
            "timestamp": "2020-07-30T03:41:59-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15"
    }
}
```
:::

#### `GET /agents/{id}`

A single agent by the given identifier. {id} is the identifier from our collections management system.

::: details Example request: https://api.artic.edu/api/v1/agents/106504?limit=2  
```js
{
    "data": {
        "id": 106504,
        "api_model": "agents",
        "api_link": "https://api.artic.edu/api/v1/agents/106504",
        "title": "Crab Tree Farm Foundation Inc.",
        "sort_title": "Crab Tree Farm Foundation Inc.",
        "alt_titles": [
            "Crab Tree Farm Foundation, Inc."
        ],
        ...
    },
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15",
        "documentation": "http://art-institute-of-chicago.github.io/data-aggregator"
    },
    "config": {
        "iiif_url": "https://lakeimagesweb.artic.edu/iiif/2",
        "shop_image_url": "https://shop-images.imgix.net",
        "shop_product_url": "http://shop.artic.edu/item.aspx?productId=",
        "shop_category_url": "http://shop.artic.edu/item.aspx?productId="
    }
}
```
:::

### Places

_The data in this response is licensed under a Creative Commons Attribution 4.0 Generic License (CC-By) and the Terms and Conditions of artic.edu. Contains information from the J. Paul Getty Trust, Getty Research Institute, the Getty Thesaurus of Geographic Names, which is made available under the ODC Attribution License._

#### `GET /places`

A list of all places sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#places).

##### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

::: details Example request: https://api.artic.edu/api/v1/places?limit=2  
```js
{
    "pagination": {
        "total": 3920,
        "limit": 2,
        "offset": 0,
        "total_pages": 1960,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/places?page=2&limit=2"
    },
    "data": [
        {
            "id": -2147476160,
            "api_model": "places",
            "api_link": "https://api.artic.edu/api/v1/places/-2147476160",
            "title": "Leiden",
            "type": "No location",
            "last_updated_source": "2020-05-08T05:26:02-05:00",
            ...
        },
        {
            "id": -2147479905,
            "api_model": "places",
            "api_link": "https://api.artic.edu/api/v1/places/-2147479905",
            "title": "Lima",
            "type": "No location",
            "last_updated_source": "2020-04-17T10:33:21-05:00",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Attribution 4.0 Generic License (CC-By) and the Terms and Conditions of artic.edu. Contains information from the J. Paul Getty Trust, Getty Research Institute, the Getty Thesaurus of Geographic Names, which is made available under the ODC Attribution License.",
        "license_links": [
            "https://www.artic.edu/terms",
            "https://creativecommons.org/licenses/by/4.0/"
        ],
        "version": "1.0-rc15",
        "documentation": "http://art-institute-of-chicago.github.io/data-aggregator"
    },
    "config": {
        "iiif_url": "https://lakeimagesweb.artic.edu/iiif/2",
        "shop_image_url": "https://shop-images.imgix.net",
        "shop_product_url": "http://shop.artic.edu/item.aspx?productId=",
        "shop_category_url": "http://shop.artic.edu/item.aspx?productId="
    }
}
```
:::

#### `GET /places/search`

Search places data in the aggregator. 

##### Available parameters:

* `q` - Your search query
* `query` - For complex queries, you can pass Elasticsearch domain syntax queries here
* `sort` - Used in conjunction with `query`
* `from` - Starting point of results. Pagination via Elasticsearch conventions
* `size` - Number of results to return. Pagination via Elasticsearch conventions
* `facets` - A comma-separated list of 'count' aggregation facets to include in the results.

::: details Example request: https://api.artic.edu/api/v1/places/search
```js
{
    "preference": null,
    "pagination": {
        "total": 3918,
        "limit": 10,
        "offset": 0,
        "total_pages": 392,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "places",
            "api_link": "https://aggregator-data.artic.edu/api/v1/places/-2147483613",
            "id": -2147483613,
            "title": "Peoria",
            "timestamp": "2020-07-30T03:43:45-05:00"
        },
        {
            "_score": 1,
            "api_model": "places",
            "api_link": "https://aggregator-data.artic.edu/api/v1/places/-2147483581",
            "id": -2147483581,
            "title": "Askov",
            "timestamp": "2020-07-30T03:43:45-05:00"
        },
        {
            "_score": 1,
            "api_model": "places",
            "api_link": "https://aggregator-data.artic.edu/api/v1/places/-2147483534",
            "id": -2147483534,
            "title": "Z\u00fcrich",
            "timestamp": "2020-07-30T03:43:45-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Attribution 4.0 Generic License (CC-By) and the Terms and Conditions of artic.edu. Contains information from the J. Paul Getty Trust, Getty Research Institute, the Getty Thesaurus of Geographic Names, which is made available under the ODC Attribution License.",
        "license_links": [
            "https://www.artic.edu/terms",
            "https://creativecommons.org/licenses/by/4.0/"
        ],
        "version": "1.0-rc15"
    }
}
```
:::

#### `GET /places/{id}`

A single place by the given identifier. {id} is the identifier from our collections management system.

::: details Example request: https://api.artic.edu/api/v1/places/-2147476160?limit=2  
```js
{
    "data": {
        "id": -2147476160,
        "api_model": "places",
        "api_link": "https://api.artic.edu/api/v1/places/-2147476160",
        "title": "Leiden",
        "type": "No location",
        "last_updated_source": "2020-05-08T05:26:02-05:00",
        ...
    },
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Attribution 4.0 Generic License (CC-By) and the Terms and Conditions of artic.edu. Contains information from the J. Paul Getty Trust, Getty Research Institute, the Getty Thesaurus of Geographic Names, which is made available under the ODC Attribution License.",
        "license_links": [
            "https://www.artic.edu/terms",
            "https://creativecommons.org/licenses/by/4.0/"
        ],
        "version": "1.0-rc15",
        "documentation": "http://art-institute-of-chicago.github.io/data-aggregator"
    },
    "config": {
        "iiif_url": "https://lakeimagesweb.artic.edu/iiif/2",
        "shop_image_url": "https://shop-images.imgix.net",
        "shop_product_url": "http://shop.artic.edu/item.aspx?productId=",
        "shop_category_url": "http://shop.artic.edu/item.aspx?productId="
    }
}
```
:::

### Galleries

_The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu._

#### `GET /galleries`

A list of all galleries sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#galleries).

##### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

::: details Example request: https://api.artic.edu/api/v1/galleries?limit=2  
```js
{
    "pagination": {
        "total": 180,
        "limit": 2,
        "offset": 0,
        "total_pages": 90,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/galleries?page=2&limit=2"
    },
    "data": [
        {
            "id": 24317,
            "api_model": "galleries",
            "api_link": "https://api.artic.edu/api/v1/galleries/24317",
            "title": "Gallery 189 (Corridor)",
            "type": "AIC Gallery",
            "is_closed": false,
            ...
        },
        {
            "id": 2705,
            "api_model": "galleries",
            "api_link": "https://api.artic.edu/api/v1/galleries/2705",
            "title": "Gallery 59",
            "type": "AIC Gallery",
            "is_closed": false,
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15",
        "documentation": "http://art-institute-of-chicago.github.io/data-aggregator"
    },
    "config": {
        "iiif_url": "https://lakeimagesweb.artic.edu/iiif/2",
        "shop_image_url": "https://shop-images.imgix.net",
        "shop_product_url": "http://shop.artic.edu/item.aspx?productId=",
        "shop_category_url": "http://shop.artic.edu/item.aspx?productId="
    }
}
```
:::

#### `GET /galleries/search`

Search galleries data in the aggregator. 

##### Available parameters:

* `q` - Your search query
* `query` - For complex queries, you can pass Elasticsearch domain syntax queries here
* `sort` - Used in conjunction with `query`
* `from` - Starting point of results. Pagination via Elasticsearch conventions
* `size` - Number of results to return. Pagination via Elasticsearch conventions
* `facets` - A comma-separated list of 'count' aggregation facets to include in the results.

::: details Example request: https://api.artic.edu/api/v1/galleries/search
```js
{
    "preference": null,
    "pagination": {
        "total": 180,
        "limit": 10,
        "offset": 0,
        "total_pages": 18,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "galleries",
            "api_link": "https://aggregator-data.artic.edu/api/v1/galleries/2",
            "id": 2,
            "title": "East Garden at Columbus Drive",
            "timestamp": "2020-07-30T03:43:48-05:00"
        },
        {
            "_score": 1,
            "api_model": "galleries",
            "api_link": "https://aggregator-data.artic.edu/api/v1/galleries/346",
            "id": 346,
            "title": "Stock Exchange Trading Room",
            "timestamp": "2020-07-30T03:43:48-05:00"
        },
        {
            "_score": 1,
            "api_model": "galleries",
            "api_link": "https://aggregator-data.artic.edu/api/v1/galleries/2705",
            "id": 2705,
            "title": "Gallery 59",
            "timestamp": "2020-07-30T03:43:48-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15"
    }
}
```
:::

#### `GET /galleries/{id}`

A single gallery by the given identifier. {id} is the identifier from our collections management system.

::: details Example request: https://api.artic.edu/api/v1/galleries/24317?limit=2  
```js
{
    "data": {
        "id": 24317,
        "api_model": "galleries",
        "api_link": "https://api.artic.edu/api/v1/galleries/24317",
        "title": "Gallery 189 (Corridor)",
        "type": "AIC Gallery",
        "is_closed": false,
        ...
    },
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15",
        "documentation": "http://art-institute-of-chicago.github.io/data-aggregator"
    },
    "config": {
        "iiif_url": "https://lakeimagesweb.artic.edu/iiif/2",
        "shop_image_url": "https://shop-images.imgix.net",
        "shop_product_url": "http://shop.artic.edu/item.aspx?productId=",
        "shop_category_url": "http://shop.artic.edu/item.aspx?productId="
    }
}
```
:::

### Exhibitions

_The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu._

#### `GET /exhibitions`

A list of all exhibitions sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#exhibitions).

##### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource
* `include` - A comma-separated list of subresource to embed in the returned resources. Available options are:
  * `artworks`
  * `sites`

::: details Example request: https://api.artic.edu/api/v1/exhibitions?limit=2  
```js
{
    "pagination": {
        "total": 6351,
        "limit": 2,
        "offset": 0,
        "total_pages": 3176,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/exhibitions?page=2&limit=2"
    },
    "data": [
        {
            "id": 1929,
            "api_model": "exhibitions",
            "api_link": "https://api.artic.edu/api/v1/exhibitions/1929",
            "title": "Whistler and Roussel: Linked Visions",
            "is_featured": false,
            "is_published": false,
            ...
        },
        {
            "id": 9040,
            "api_model": "exhibitions",
            "api_link": "https://api.artic.edu/api/v1/exhibitions/9040",
            "title": "PHOTOGRAPHY + PHOTOGRAPHY Iconic: Photographs from the Robin and Sandy Stuart Collection",
            "is_featured": true,
            "is_published": true,
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15",
        "documentation": "http://art-institute-of-chicago.github.io/data-aggregator"
    },
    "config": {
        "iiif_url": "https://lakeimagesweb.artic.edu/iiif/2",
        "shop_image_url": "https://shop-images.imgix.net",
        "shop_product_url": "http://shop.artic.edu/item.aspx?productId=",
        "shop_category_url": "http://shop.artic.edu/item.aspx?productId="
    }
}
```
:::

#### `GET /exhibitions/search`

Search exhibitions data in the aggregator. 

##### Available parameters:

* `q` - Your search query
* `query` - For complex queries, you can pass Elasticsearch domain syntax queries here
* `sort` - Used in conjunction with `query`
* `from` - Starting point of results. Pagination via Elasticsearch conventions
* `size` - Number of results to return. Pagination via Elasticsearch conventions
* `facets` - A comma-separated list of 'count' aggregation facets to include in the results.

::: details Example request: https://api.artic.edu/api/v1/exhibitions/search
```js
{
    "preference": null,
    "pagination": {
        "total": 6352,
        "limit": 10,
        "offset": 0,
        "total_pages": 636,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "exhibitions",
            "api_link": "https://aggregator-data.artic.edu/api/v1/exhibitions/1953",
            "id": 1953,
            "title": "Strokes of Genius: Italian Drawings from the Goldman Collection",
            "timestamp": "2020-07-30T03:43:57-05:00"
        },
        {
            "_score": 1,
            "api_model": "exhibitions",
            "api_link": "https://aggregator-data.artic.edu/api/v1/exhibitions/1959",
            "id": 1959,
            "title": "Renoir\u2019s True Colors: Science Solves a Mystery",
            "timestamp": "2020-07-30T03:43:57-05:00"
        },
        {
            "_score": 1,
            "api_model": "exhibitions",
            "api_link": "https://aggregator-data.artic.edu/api/v1/exhibitions/1977",
            "id": 1977,
            "title": "Devouring Books",
            "timestamp": "2020-07-30T03:43:57-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15"
    }
}
```
:::

#### `GET /exhibitions/{id}`

A single exhibition by the given identifier. {id} is the identifier from our collections management system.

::: details Example request: https://api.artic.edu/api/v1/exhibitions/1929?limit=2  
```js
{
    "data": {
        "id": 1929,
        "api_model": "exhibitions",
        "api_link": "https://api.artic.edu/api/v1/exhibitions/1929",
        "title": "Whistler and Roussel: Linked Visions",
        "is_featured": false,
        "is_published": false,
        ...
    },
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15",
        "documentation": "http://art-institute-of-chicago.github.io/data-aggregator"
    },
    "config": {
        "iiif_url": "https://lakeimagesweb.artic.edu/iiif/2",
        "shop_image_url": "https://shop-images.imgix.net",
        "shop_product_url": "http://shop.artic.edu/item.aspx?productId=",
        "shop_category_url": "http://shop.artic.edu/item.aspx?productId="
    }
}
```
:::

### Agent Types

_The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu._

#### `GET /agent-types`

A list of all agent-types sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#agent-types).

##### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

::: details Example request: https://api.artic.edu/api/v1/agent-types?limit=2  
```js
{
    "pagination": {
        "total": 26,
        "limit": 2,
        "offset": 0,
        "total_pages": 13,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/agent-types?page=2&limit=2"
    },
    "data": [
        {
            "id": 29,
            "api_model": "agent-types",
            "api_link": "https://api.artic.edu/api/v1/agent-types/29",
            "title": "Artist Collaborative",
            "last_updated_source": "2019-05-08T13:31:54-05:00",
            "last_updated": "2019-05-09T12:01:08-05:00",
            ...
        },
        {
            "id": 28,
            "api_model": "agent-types",
            "api_link": "https://api.artic.edu/api/v1/agent-types/28",
            "title": "Nonprofit",
            "last_updated_source": "2019-05-08T13:31:54-05:00",
            "last_updated": "2019-05-09T12:01:08-05:00",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15",
        "documentation": "http://art-institute-of-chicago.github.io/data-aggregator"
    },
    "config": {
        "iiif_url": "https://lakeimagesweb.artic.edu/iiif/2",
        "shop_image_url": "https://shop-images.imgix.net",
        "shop_product_url": "http://shop.artic.edu/item.aspx?productId=",
        "shop_category_url": "http://shop.artic.edu/item.aspx?productId="
    }
}
```
:::

#### `GET /agent-types/{id}`

A single agent-type by the given identifier. {id} is the identifier from our collections management system.

::: details Example request: https://api.artic.edu/api/v1/agent-types/29?limit=2  
```js
{
    "data": {
        "id": 29,
        "api_model": "agent-types",
        "api_link": "https://api.artic.edu/api/v1/agent-types/29",
        "title": "Artist Collaborative",
        "last_updated_source": "2019-05-08T13:31:54-05:00",
        "last_updated": "2019-05-09T12:01:08-05:00",
        ...
    },
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15",
        "documentation": "http://art-institute-of-chicago.github.io/data-aggregator"
    },
    "config": {
        "iiif_url": "https://lakeimagesweb.artic.edu/iiif/2",
        "shop_image_url": "https://shop-images.imgix.net",
        "shop_product_url": "http://shop.artic.edu/item.aspx?productId=",
        "shop_category_url": "http://shop.artic.edu/item.aspx?productId="
    }
}
```
:::

### Agent Roles

_The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu._

#### `GET /agent-roles`

A list of all agent-roles sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#agent-roles).

##### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

::: details Example request: https://api.artic.edu/api/v1/agent-roles?limit=2  
```js
{
    "pagination": {
        "total": 164,
        "limit": 2,
        "offset": 0,
        "total_pages": 82,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/agent-roles?page=2&limit=2"
    },
    "data": [
        {
            "id": 574,
            "api_model": "agent-roles",
            "api_link": "https://api.artic.edu/api/v1/agent-roles/574",
            "title": "File Transfer",
            "last_updated_source": "2019-05-08T14:05:12-05:00",
            "last_updated": "2019-05-09T12:01:07-05:00",
            ...
        },
        {
            "id": 573,
            "api_model": "agent-roles",
            "api_link": "https://api.artic.edu/api/v1/agent-roles/573",
            "title": "Imitator of",
            "last_updated_source": "2019-05-08T14:05:12-05:00",
            "last_updated": "2019-05-09T12:01:07-05:00",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15",
        "documentation": "http://art-institute-of-chicago.github.io/data-aggregator"
    },
    "config": {
        "iiif_url": "https://lakeimagesweb.artic.edu/iiif/2",
        "shop_image_url": "https://shop-images.imgix.net",
        "shop_product_url": "http://shop.artic.edu/item.aspx?productId=",
        "shop_category_url": "http://shop.artic.edu/item.aspx?productId="
    }
}
```
:::

#### `GET /agent-roles/{id}`

A single agent-role by the given identifier. {id} is the identifier from our collections management system.

::: details Example request: https://api.artic.edu/api/v1/agent-roles/574?limit=2  
```js
{
    "data": {
        "id": 574,
        "api_model": "agent-roles",
        "api_link": "https://api.artic.edu/api/v1/agent-roles/574",
        "title": "File Transfer",
        "last_updated_source": "2019-05-08T14:05:12-05:00",
        "last_updated": "2019-05-09T12:01:07-05:00",
        ...
    },
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15",
        "documentation": "http://art-institute-of-chicago.github.io/data-aggregator"
    },
    "config": {
        "iiif_url": "https://lakeimagesweb.artic.edu/iiif/2",
        "shop_image_url": "https://shop-images.imgix.net",
        "shop_product_url": "http://shop.artic.edu/item.aspx?productId=",
        "shop_category_url": "http://shop.artic.edu/item.aspx?productId="
    }
}
```
:::

### Agent Place Qualifiers

_The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu._

#### `GET /agent-place-qualifiers`

A list of all agent-place-qualifiers sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#agent-place-qualifiers).

##### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

::: details Example request: https://api.artic.edu/api/v1/agent-place-qualifiers?limit=2  
```js
{
    "pagination": {
        "total": 0,
        "limit": 2,
        "offset": 0,
        "total_pages": 1,
        "current_page": 1
    },
    "data": [],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15",
        "documentation": "http://art-institute-of-chicago.github.io/data-aggregator"
    },
    "config": {
        "iiif_url": "https://lakeimagesweb.artic.edu/iiif/2",
        "shop_image_url": "https://shop-images.imgix.net",
        "shop_product_url": "http://shop.artic.edu/item.aspx?productId=",
        "shop_category_url": "http://shop.artic.edu/item.aspx?productId="
    }
}
```
:::

#### `GET /agent-place-qualifiers/{id}`

A single agent-place-qualifier by the given identifier. {id} is the identifier from our collections management system.


### Artwork Types

_The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu._

#### `GET /artwork-types`

A list of all artwork-types sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#artwork-types).

##### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

::: details Example request: https://api.artic.edu/api/v1/artwork-types?limit=2  
```js
{
    "pagination": {
        "total": 44,
        "limit": 2,
        "offset": 0,
        "total_pages": 22,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/artwork-types?page=2&limit=2"
    },
    "data": [
        {
            "id": 48,
            "api_model": "artwork-types",
            "api_link": "https://api.artic.edu/api/v1/artwork-types/48",
            "title": "Time Based Media",
            "last_updated_source": "2020-05-04T07:25:27-05:00",
            "last_updated": "2020-05-04T07:25:51-05:00",
            ...
        },
        {
            "id": 47,
            "api_model": "artwork-types",
            "api_link": "https://api.artic.edu/api/v1/artwork-types/47",
            "title": "Materials",
            "last_updated_source": "2019-10-07T06:53:19-05:00",
            "last_updated": "2019-10-07T06:56:21-05:00",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15",
        "documentation": "http://art-institute-of-chicago.github.io/data-aggregator"
    },
    "config": {
        "iiif_url": "https://lakeimagesweb.artic.edu/iiif/2",
        "shop_image_url": "https://shop-images.imgix.net",
        "shop_product_url": "http://shop.artic.edu/item.aspx?productId=",
        "shop_category_url": "http://shop.artic.edu/item.aspx?productId="
    }
}
```
:::

#### `GET /artwork-types/{id}`

A single artwork-type by the given identifier. {id} is the identifier from our collections management system.

::: details Example request: https://api.artic.edu/api/v1/artwork-types/48?limit=2  
```js
{
    "data": {
        "id": 48,
        "api_model": "artwork-types",
        "api_link": "https://api.artic.edu/api/v1/artwork-types/48",
        "title": "Time Based Media",
        "last_updated_source": "2020-05-04T07:25:27-05:00",
        "last_updated": "2020-05-04T07:25:51-05:00",
        ...
    },
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15",
        "documentation": "http://art-institute-of-chicago.github.io/data-aggregator"
    },
    "config": {
        "iiif_url": "https://lakeimagesweb.artic.edu/iiif/2",
        "shop_image_url": "https://shop-images.imgix.net",
        "shop_product_url": "http://shop.artic.edu/item.aspx?productId=",
        "shop_category_url": "http://shop.artic.edu/item.aspx?productId="
    }
}
```
:::

### Artwork Place Qualifiers

_The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu._

#### `GET /artwork-place-qualifiers`

A list of all artwork-place-qualifiers sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#artwork-place-qualifiers).

##### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

::: details Example request: https://api.artic.edu/api/v1/artwork-place-qualifiers?limit=2  
```js
{
    "pagination": {
        "total": 15,
        "limit": 2,
        "offset": 0,
        "total_pages": 8,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/artwork-place-qualifiers?page=2&limit=2"
    },
    "data": [
        {
            "id": 54,
            "api_model": "artwork-place-qualifiers",
            "api_link": "https://api.artic.edu/api/v1/artwork-place-qualifiers/54",
            "title": "Artist's culture:",
            "last_updated_source": "2020-04-14T04:36:05-05:00",
            "last_updated": "2020-04-14T08:46:00-05:00",
            ...
        },
        {
            "id": 55,
            "api_model": "artwork-place-qualifiers",
            "api_link": "https://api.artic.edu/api/v1/artwork-place-qualifiers/55",
            "title": "Inhabited place:",
            "last_updated_source": "2020-04-13T08:01:45-05:00",
            "last_updated": "2020-04-13T08:05:56-05:00",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15",
        "documentation": "http://art-institute-of-chicago.github.io/data-aggregator"
    },
    "config": {
        "iiif_url": "https://lakeimagesweb.artic.edu/iiif/2",
        "shop_image_url": "https://shop-images.imgix.net",
        "shop_product_url": "http://shop.artic.edu/item.aspx?productId=",
        "shop_category_url": "http://shop.artic.edu/item.aspx?productId="
    }
}
```
:::

#### `GET /artwork-place-qualifiers/{id}`

A single artwork-place-qualifier by the given identifier. {id} is the identifier from our collections management system.

::: details Example request: https://api.artic.edu/api/v1/artwork-place-qualifiers/54?limit=2  
```js
{
    "data": {
        "id": 54,
        "api_model": "artwork-place-qualifiers",
        "api_link": "https://api.artic.edu/api/v1/artwork-place-qualifiers/54",
        "title": "Artist's culture:",
        "last_updated_source": "2020-04-14T04:36:05-05:00",
        "last_updated": "2020-04-14T08:46:00-05:00",
        ...
    },
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15",
        "documentation": "http://art-institute-of-chicago.github.io/data-aggregator"
    },
    "config": {
        "iiif_url": "https://lakeimagesweb.artic.edu/iiif/2",
        "shop_image_url": "https://shop-images.imgix.net",
        "shop_product_url": "http://shop.artic.edu/item.aspx?productId=",
        "shop_category_url": "http://shop.artic.edu/item.aspx?productId="
    }
}
```
:::

### Artwork Date Qualifiers

_The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu._

#### `GET /artwork-date-qualifiers`

A list of all artwork-date-qualifiers sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#artwork-date-qualifiers).

##### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

::: details Example request: https://api.artic.edu/api/v1/artwork-date-qualifiers?limit=2  
```js
{
    "pagination": {
        "total": 31,
        "limit": 2,
        "offset": 0,
        "total_pages": 16,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/artwork-date-qualifiers?page=2&limit=2"
    },
    "data": [
        {
            "id": 62,
            "api_model": "artwork-date-qualifiers",
            "api_link": "https://api.artic.edu/api/v1/artwork-date-qualifiers/62",
            "title": "Manufactured",
            "last_updated_source": "2019-05-08T16:59:24-05:00",
            "last_updated": "2019-05-09T12:01:07-05:00",
            ...
        },
        {
            "id": 61,
            "api_model": "artwork-date-qualifiers",
            "api_link": "https://api.artic.edu/api/v1/artwork-date-qualifiers/61",
            "title": "Delineated",
            "last_updated_source": "2019-05-08T16:59:24-05:00",
            "last_updated": "2019-05-09T12:01:07-05:00",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15",
        "documentation": "http://art-institute-of-chicago.github.io/data-aggregator"
    },
    "config": {
        "iiif_url": "https://lakeimagesweb.artic.edu/iiif/2",
        "shop_image_url": "https://shop-images.imgix.net",
        "shop_product_url": "http://shop.artic.edu/item.aspx?productId=",
        "shop_category_url": "http://shop.artic.edu/item.aspx?productId="
    }
}
```
:::

#### `GET /artwork-date-qualifiers/{id}`

A single artwork-date-qualifier by the given identifier. {id} is the identifier from our collections management system.

::: details Example request: https://api.artic.edu/api/v1/artwork-date-qualifiers/62?limit=2  
```js
{
    "data": {
        "id": 62,
        "api_model": "artwork-date-qualifiers",
        "api_link": "https://api.artic.edu/api/v1/artwork-date-qualifiers/62",
        "title": "Manufactured",
        "last_updated_source": "2019-05-08T16:59:24-05:00",
        "last_updated": "2019-05-09T12:01:07-05:00",
        ...
    },
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15",
        "documentation": "http://art-institute-of-chicago.github.io/data-aggregator"
    },
    "config": {
        "iiif_url": "https://lakeimagesweb.artic.edu/iiif/2",
        "shop_image_url": "https://shop-images.imgix.net",
        "shop_product_url": "http://shop.artic.edu/item.aspx?productId=",
        "shop_category_url": "http://shop.artic.edu/item.aspx?productId="
    }
}
```
:::

### Catalogues

_The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu._

#### `GET /catalogues`

A list of all catalogues sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#catalogues).

##### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

::: details Example request: https://api.artic.edu/api/v1/catalogues?limit=2  
```js
{
    "pagination": {
        "total": 1101,
        "limit": 2,
        "offset": 0,
        "total_pages": 551,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/catalogues?page=2&limit=2"
    },
    "data": [
        {
            "id": 536,
            "api_model": "catalogues",
            "api_link": "https://api.artic.edu/api/v1/catalogues/536",
            "title": "Chamberlain",
            "last_updated_source": "2019-10-15T04:35:50-05:00",
            "last_updated": "2019-10-15T04:36:17-05:00",
            ...
        },
        {
            "id": 535,
            "api_model": "catalogues",
            "api_link": "https://api.artic.edu/api/v1/catalogues/535",
            "title": "Thuillier",
            "last_updated_source": "2019-07-23T05:05:59-05:00",
            "last_updated": "2019-07-23T05:10:47-05:00",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15",
        "documentation": "http://art-institute-of-chicago.github.io/data-aggregator"
    },
    "config": {
        "iiif_url": "https://lakeimagesweb.artic.edu/iiif/2",
        "shop_image_url": "https://shop-images.imgix.net",
        "shop_product_url": "http://shop.artic.edu/item.aspx?productId=",
        "shop_category_url": "http://shop.artic.edu/item.aspx?productId="
    }
}
```
:::

#### `GET /catalogues/{id}`

A single catalogue by the given identifier. {id} is the identifier from our collections management system.

::: details Example request: https://api.artic.edu/api/v1/catalogues/536?limit=2  
```js
{
    "data": {
        "id": 536,
        "api_model": "catalogues",
        "api_link": "https://api.artic.edu/api/v1/catalogues/536",
        "title": "Chamberlain",
        "last_updated_source": "2019-10-15T04:35:50-05:00",
        "last_updated": "2019-10-15T04:36:17-05:00",
        ...
    },
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15",
        "documentation": "http://art-institute-of-chicago.github.io/data-aggregator"
    },
    "config": {
        "iiif_url": "https://lakeimagesweb.artic.edu/iiif/2",
        "shop_image_url": "https://shop-images.imgix.net",
        "shop_product_url": "http://shop.artic.edu/item.aspx?productId=",
        "shop_category_url": "http://shop.artic.edu/item.aspx?productId="
    }
}
```
:::

### Category Terms

_The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu._

#### `GET /category-terms`

A list of all category-terms sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#category-terms).

##### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

::: details Example request: https://api.artic.edu/api/v1/category-terms?limit=2  
```js
{
    "pagination": {
        "total": 8907,
        "limit": 2,
        "offset": 0,
        "total_pages": 4454,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/category-terms?page=2&limit=2"
    },
    "data": [
        {
            "id": "TM-14202",
            "api_model": "category-terms",
            "api_link": "https://api.artic.edu/api/v1/category-terms/TM-14202",
            "title": "abstraction",
            "subtype": "classification",
            "parent_id": null,
            ...
        },
        {
            "id": "TM-14201",
            "api_model": "category-terms",
            "api_link": "https://api.artic.edu/api/v1/category-terms/TM-14201",
            "title": "foam",
            "subtype": "technique",
            "parent_id": null,
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15",
        "documentation": "http://art-institute-of-chicago.github.io/data-aggregator"
    },
    "config": {
        "iiif_url": "https://lakeimagesweb.artic.edu/iiif/2",
        "shop_image_url": "https://shop-images.imgix.net",
        "shop_product_url": "http://shop.artic.edu/item.aspx?productId=",
        "shop_category_url": "http://shop.artic.edu/item.aspx?productId="
    }
}
```
:::

#### `GET /category-terms/search`

Search category-terms data in the aggregator. 

##### Available parameters:

* `q` - Your search query
* `query` - For complex queries, you can pass Elasticsearch domain syntax queries here
* `sort` - Used in conjunction with `query`
* `from` - Starting point of results. Pagination via Elasticsearch conventions
* `size` - Number of results to return. Pagination via Elasticsearch conventions
* `facets` - A comma-separated list of 'count' aggregation facets to include in the results.

::: details Example request: https://api.artic.edu/api/v1/category-terms/search
```js
{
    "preference": null,
    "pagination": {
        "total": 9166,
        "limit": 10,
        "offset": 0,
        "total_pages": 917,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "category-terms",
            "api_link": "https://aggregator-data.artic.edu/api/v1/category-terms/PC-73",
            "id": "PC-73",
            "title": "Bertrand Goldberg Archive",
            "timestamp": "2020-07-30T03:45:09-05:00"
        },
        {
            "_score": 1,
            "api_model": "category-terms",
            "api_link": "https://aggregator-data.artic.edu/api/v1/category-terms/PC-74",
            "id": "PC-74",
            "title": "System of Architectural Ornament",
            "timestamp": "2020-07-30T03:45:09-05:00"
        },
        {
            "_score": 1,
            "api_model": "category-terms",
            "api_link": "https://aggregator-data.artic.edu/api/v1/category-terms/PC-75",
            "id": "PC-75",
            "title": "Prairie School",
            "timestamp": "2020-07-30T03:45:09-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15"
    }
}
```
:::

#### `GET /category-terms/{id}`

A single category-term by the given identifier. {id} is the identifier from our collections management system.

::: details Example request: https://api.artic.edu/api/v1/category-terms/TM-14202?limit=2  
```js
{
    "data": {
        "id": "TM-14202",
        "api_model": "category-terms",
        "api_link": "https://api.artic.edu/api/v1/category-terms/TM-14202",
        "title": "abstraction",
        "subtype": "classification",
        "parent_id": null,
        ...
    },
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15",
        "documentation": "http://art-institute-of-chicago.github.io/data-aggregator"
    },
    "config": {
        "iiif_url": "https://lakeimagesweb.artic.edu/iiif/2",
        "shop_image_url": "https://shop-images.imgix.net",
        "shop_product_url": "http://shop.artic.edu/item.aspx?productId=",
        "shop_category_url": "http://shop.artic.edu/item.aspx?productId="
    }
}
```
:::

### Category Terms

_The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu._

#### `GET /category-terms`

A list of all category-terms sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#category-terms).

##### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

::: details Example request: https://api.artic.edu/api/v1/category-terms?limit=2  
```js
{
    "pagination": {
        "total": 8907,
        "limit": 2,
        "offset": 0,
        "total_pages": 4454,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/category-terms?page=2&limit=2"
    },
    "data": [
        {
            "id": "TM-14202",
            "api_model": "category-terms",
            "api_link": "https://api.artic.edu/api/v1/category-terms/TM-14202",
            "title": "abstraction",
            "subtype": "classification",
            "parent_id": null,
            ...
        },
        {
            "id": "TM-14201",
            "api_model": "category-terms",
            "api_link": "https://api.artic.edu/api/v1/category-terms/TM-14201",
            "title": "foam",
            "subtype": "technique",
            "parent_id": null,
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15",
        "documentation": "http://art-institute-of-chicago.github.io/data-aggregator"
    },
    "config": {
        "iiif_url": "https://lakeimagesweb.artic.edu/iiif/2",
        "shop_image_url": "https://shop-images.imgix.net",
        "shop_product_url": "http://shop.artic.edu/item.aspx?productId=",
        "shop_category_url": "http://shop.artic.edu/item.aspx?productId="
    }
}
```
:::

#### `GET /category-terms/{id}`

A single category-term by the given identifier. {id} is the identifier from our collections management system.

::: details Example request: https://api.artic.edu/api/v1/category-terms/TM-14202?limit=2  
```js
{
    "data": {
        "id": "TM-14202",
        "api_model": "category-terms",
        "api_link": "https://api.artic.edu/api/v1/category-terms/TM-14202",
        "title": "abstraction",
        "subtype": "classification",
        "parent_id": null,
        ...
    },
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15",
        "documentation": "http://art-institute-of-chicago.github.io/data-aggregator"
    },
    "config": {
        "iiif_url": "https://lakeimagesweb.artic.edu/iiif/2",
        "shop_image_url": "https://shop-images.imgix.net",
        "shop_product_url": "http://shop.artic.edu/item.aspx?productId=",
        "shop_category_url": "http://shop.artic.edu/item.aspx?productId="
    }
}
```
:::

### Category Terms

_The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu._

#### `GET /category-terms`

A list of all category-terms sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#category-terms).

##### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

::: details Example request: https://api.artic.edu/api/v1/category-terms?limit=2  
```js
{
    "pagination": {
        "total": 8907,
        "limit": 2,
        "offset": 0,
        "total_pages": 4454,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/category-terms?page=2&limit=2"
    },
    "data": [
        {
            "id": "TM-14202",
            "api_model": "category-terms",
            "api_link": "https://api.artic.edu/api/v1/category-terms/TM-14202",
            "title": "abstraction",
            "subtype": "classification",
            "parent_id": null,
            ...
        },
        {
            "id": "TM-14201",
            "api_model": "category-terms",
            "api_link": "https://api.artic.edu/api/v1/category-terms/TM-14201",
            "title": "foam",
            "subtype": "technique",
            "parent_id": null,
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15",
        "documentation": "http://art-institute-of-chicago.github.io/data-aggregator"
    },
    "config": {
        "iiif_url": "https://lakeimagesweb.artic.edu/iiif/2",
        "shop_image_url": "https://shop-images.imgix.net",
        "shop_product_url": "http://shop.artic.edu/item.aspx?productId=",
        "shop_category_url": "http://shop.artic.edu/item.aspx?productId="
    }
}
```
:::

#### `GET /category-terms/{id}`

A single category-term by the given identifier. {id} is the identifier from our collections management system.

::: details Example request: https://api.artic.edu/api/v1/category-terms/PC-834?limit=2  
```js
{
    "data": {
        "id": "PC-834",
        "api_model": "category-terms",
        "api_link": "https://api.artic.edu/api/v1/category-terms/PC-834",
        "title": "Halloween",
        "subtype": "theme",
        "parent_id": null,
        ...
    },
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15",
        "documentation": "http://art-institute-of-chicago.github.io/data-aggregator"
    },
    "config": {
        "iiif_url": "https://lakeimagesweb.artic.edu/iiif/2",
        "shop_image_url": "https://shop-images.imgix.net",
        "shop_product_url": "http://shop.artic.edu/item.aspx?productId=",
        "shop_category_url": "http://shop.artic.edu/item.aspx?productId="
    }
}
```
:::

### Assets

_The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu._

#### `GET /assets`

A list of all assets sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#assets).

##### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

::: details Example request: https://api.artic.edu/api/v1/assets?limit=2  
```js
{
    "pagination": {
        "total": 143472,
        "limit": 2,
        "offset": 0,
        "total_pages": 71736,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/assets?page=2&limit=2"
    },
    "data": [
        {
            "id": "3e8cfa8f-e917-4b10-74c9-6068d05f0615",
            "lake_guid": "3e8cfa8f-e917-4b10-74c9-6068d05f0615",
            "api_model": "assets",
            "api_link": "https://api.artic.edu/api/v1/assets/3e8cfa8f-e917-4b10-74c9-6068d05f0615",
            "title": "Audio stop 413.mp3",
            "type": "sound",
            ...
        },
        {
            "id": "362fb2d1-96ca-ffd0-733d-94a0c930a808",
            "lake_guid": "362fb2d1-96ca-ffd0-733d-94a0c930a808",
            "api_model": "assets",
            "api_link": "https://api.artic.edu/api/v1/assets/362fb2d1-96ca-ffd0-733d-94a0c930a808",
            "title": "Audio stop 924.mp3",
            "type": "sound",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15",
        "documentation": "http://art-institute-of-chicago.github.io/data-aggregator"
    },
    "config": {
        "iiif_url": "https://lakeimagesweb.artic.edu/iiif/2",
        "shop_image_url": "https://shop-images.imgix.net",
        "shop_product_url": "http://shop.artic.edu/item.aspx?productId=",
        "shop_category_url": "http://shop.artic.edu/item.aspx?productId="
    }
}
```
:::

#### `GET /assets/{id}`

A single asset by the given identifier. {id} is the identifier from our collections management system.


### Images

_The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu._

#### `GET /images`

A list of all images sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#images).

##### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

::: details Example request: https://api.artic.edu/api/v1/images?limit=2  
```js
{
    "pagination": {
        "total": 140290,
        "limit": 2,
        "offset": 0,
        "total_pages": 70145,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/images?page=2&limit=2"
    },
    "data": [
        {
            "id": "91f3d50f-db37-d9f0-0370-f076f3cff73c",
            "lake_guid": "91f3d50f-db37-d9f0-0370-f076f3cff73c",
            "api_model": "images",
            "api_link": "https://api.artic.edu/api/v1/images/91f3d50f-db37-d9f0-0370-f076f3cff73c",
            "title": "Still1_TheWhitetobeAngry.jpg",
            "type": "image",
            ...
        },
        {
            "id": "8e7d641a-2ee6-e0a2-a047-7655991ab26c",
            "lake_guid": "8e7d641a-2ee6-e0a2-a047-7655991ab26c",
            "api_model": "images",
            "api_link": "https://api.artic.edu/api/v1/images/8e7d641a-2ee6-e0a2-a047-7655991ab26c",
            "title": "Still2_TheWhitetobeAngry.jpg",
            "type": "image",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15",
        "documentation": "http://art-institute-of-chicago.github.io/data-aggregator"
    },
    "config": {
        "iiif_url": "https://lakeimagesweb.artic.edu/iiif/2",
        "shop_image_url": "https://shop-images.imgix.net",
        "shop_product_url": "http://shop.artic.edu/item.aspx?productId=",
        "shop_category_url": "http://shop.artic.edu/item.aspx?productId="
    }
}
```
:::

#### `GET /images/search`

Search images data in the aggregator. 

##### Available parameters:

* `q` - Your search query
* `query` - For complex queries, you can pass Elasticsearch domain syntax queries here
* `sort` - Used in conjunction with `query`
* `from` - Starting point of results. Pagination via Elasticsearch conventions
* `size` - Number of results to return. Pagination via Elasticsearch conventions
* `facets` - A comma-separated list of 'count' aggregation facets to include in the results.

::: details Example request: https://api.artic.edu/api/v1/images/search
```js
{
    "preference": null,
    "pagination": {
        "total": 141684,
        "limit": 10,
        "offset": 0,
        "total_pages": 14169,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "images",
            "api_link": "https://aggregator-data.artic.edu/api/v1/images/2231cdf1-d6ed-05cd-7ef8-66ab93dc8932",
            "id": "2231cdf1-d6ed-05cd-7ef8-66ab93dc8932",
            "title": "G00149",
            "timestamp": "2020-05-18T04:24:04-05:00"
        },
        {
            "_score": 1,
            "api_model": "images",
            "api_link": "https://aggregator-data.artic.edu/api/v1/images/2fd42dbf-1bca-06a5-4c8e-b82fc431a0e6",
            "id": "2fd42dbf-1bca-06a5-4c8e-b82fc431a0e6",
            "title": "E30137",
            "timestamp": "2020-05-18T04:30:30-05:00"
        },
        {
            "_score": 1,
            "api_model": "images",
            "api_link": "https://aggregator-data.artic.edu/api/v1/images/3f2f9f3d-5a59-8c6b-37fb-198cec93ba4d",
            "id": "3f2f9f3d-5a59-8c6b-37fb-198cec93ba4d",
            "title": "G00134",
            "timestamp": "2020-05-18T04:37:40-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15"
    }
}
```
:::

#### `GET /images/{id}`

A single image by the given identifier. {id} is the identifier from our collections management system.


### Videos

_The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu._

#### `GET /videos`

A list of all videos sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#videos).

##### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

::: details Example request: https://api.artic.edu/api/v1/videos?limit=2  
```js
{
    "pagination": {
        "total": 5,
        "limit": 2,
        "offset": 0,
        "total_pages": 3,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/videos?page=2&limit=2"
    },
    "data": [
        {
            "id": "c051f71e-2b69-ac68-9aa8-99410d91f3f3",
            "lake_guid": "c051f71e-2b69-ac68-9aa8-99410d91f3f3",
            "api_model": "videos",
            "api_link": "https://api.artic.edu/api/v1/videos/c051f71e-2b69-ac68-9aa8-99410d91f3f3",
            "title": "Under Cover: The Science of Van Gogh's Bedroom",
            "type": "video",
            ...
        },
        {
            "id": "eb06edce-6f2e-727c-0cee-a32cef589911",
            "lake_guid": "eb06edce-6f2e-727c-0cee-a32cef589911",
            "api_model": "videos",
            "api_link": "https://api.artic.edu/api/v1/videos/eb06edce-6f2e-727c-0cee-a32cef589911",
            "title": "A Thousand and One Swabs: The Transformation of \"Paris Street; Rainy Day\"",
            "type": "video",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15",
        "documentation": "http://art-institute-of-chicago.github.io/data-aggregator"
    },
    "config": {
        "iiif_url": "https://lakeimagesweb.artic.edu/iiif/2",
        "shop_image_url": "https://shop-images.imgix.net",
        "shop_product_url": "http://shop.artic.edu/item.aspx?productId=",
        "shop_category_url": "http://shop.artic.edu/item.aspx?productId="
    }
}
```
:::

#### `GET /videos/search`

Search videos data in the aggregator. 

##### Available parameters:

* `q` - Your search query
* `query` - For complex queries, you can pass Elasticsearch domain syntax queries here
* `sort` - Used in conjunction with `query`
* `from` - Starting point of results. Pagination via Elasticsearch conventions
* `size` - Number of results to return. Pagination via Elasticsearch conventions
* `facets` - A comma-separated list of 'count' aggregation facets to include in the results.

::: details Example request: https://api.artic.edu/api/v1/videos/search
```js
{
    "preference": null,
    "pagination": {
        "total": 4,
        "limit": 10,
        "offset": 0,
        "total_pages": 1,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "videos",
            "api_link": "https://aggregator-data.artic.edu/api/v1/videos/1ee4a231-0dad-2638-24fd-dfa2138eb142",
            "id": "1ee4a231-0dad-2638-24fd-dfa2138eb142",
            "title": "Digital Simulation: Original appearance of <em>For to Be a Farmer's Boy</em>",
            "timestamp": "2020-07-30T05:06:15-05:00"
        },
        {
            "_score": 1,
            "api_model": "videos",
            "api_link": "https://aggregator-data.artic.edu/api/v1/videos/c051f71e-2b69-ac68-9aa8-99410d91f3f3",
            "id": "c051f71e-2b69-ac68-9aa8-99410d91f3f3",
            "title": "Under Cover: The Science of Van Gogh's Bedroom",
            "timestamp": "2020-07-30T05:06:15-05:00"
        },
        {
            "_score": 1,
            "api_model": "videos",
            "api_link": "https://aggregator-data.artic.edu/api/v1/videos/c5700df1-473c-c1cd-ab1b-79b20a32fc27",
            "id": "c5700df1-473c-c1cd-ab1b-79b20a32fc27",
            "title": "Online Game: Winslow Homer's <em>The Water Fan</em>",
            "timestamp": "2020-07-30T05:06:15-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15"
    }
}
```
:::

#### `GET /videos/{id}`

A single video by the given identifier. {id} is the identifier from our collections management system.


### Sounds

_The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu._

#### `GET /sounds`

A list of all sounds sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#sounds).

##### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

::: details Example request: https://api.artic.edu/api/v1/sounds?limit=2  
```js
{
    "pagination": {
        "total": 1104,
        "limit": 2,
        "offset": 0,
        "total_pages": 552,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/sounds?page=2&limit=2"
    },
    "data": [
        {
            "id": "3e8cfa8f-e917-4b10-74c9-6068d05f0615",
            "lake_guid": "3e8cfa8f-e917-4b10-74c9-6068d05f0615",
            "api_model": "sounds",
            "api_link": "https://api.artic.edu/api/v1/sounds/3e8cfa8f-e917-4b10-74c9-6068d05f0615",
            "title": "Audio stop 413.mp3",
            "type": "sound",
            ...
        },
        {
            "id": "362fb2d1-96ca-ffd0-733d-94a0c930a808",
            "lake_guid": "362fb2d1-96ca-ffd0-733d-94a0c930a808",
            "api_model": "sounds",
            "api_link": "https://api.artic.edu/api/v1/sounds/362fb2d1-96ca-ffd0-733d-94a0c930a808",
            "title": "Audio stop 924.mp3",
            "type": "sound",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15",
        "documentation": "http://art-institute-of-chicago.github.io/data-aggregator"
    },
    "config": {
        "iiif_url": "https://lakeimagesweb.artic.edu/iiif/2",
        "shop_image_url": "https://shop-images.imgix.net",
        "shop_product_url": "http://shop.artic.edu/item.aspx?productId=",
        "shop_category_url": "http://shop.artic.edu/item.aspx?productId="
    }
}
```
:::

#### `GET /sounds/search`

Search sounds data in the aggregator. 

##### Available parameters:

* `q` - Your search query
* `query` - For complex queries, you can pass Elasticsearch domain syntax queries here
* `sort` - Used in conjunction with `query`
* `from` - Starting point of results. Pagination via Elasticsearch conventions
* `size` - Number of results to return. Pagination via Elasticsearch conventions
* `facets` - A comma-separated list of 'count' aggregation facets to include in the results.

::: details Example request: https://api.artic.edu/api/v1/sounds/search
```js
{
    "preference": null,
    "pagination": {
        "total": 1102,
        "limit": 10,
        "offset": 0,
        "total_pages": 111,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "sounds",
            "api_link": "https://aggregator-data.artic.edu/api/v1/sounds/31bdc88e-581d-b744-022b-7e9571b95ff2",
            "id": "31bdc88e-581d-b744-022b-7e9571b95ff2",
            "title": "Audio Lecture: Winslow Homer, Artist and Angler",
            "timestamp": "2020-07-30T05:06:18-05:00"
        },
        {
            "_score": 1,
            "api_model": "sounds",
            "api_link": "https://aggregator-data.artic.edu/api/v1/sounds/31c370a9-98de-3533-c14e-c91776c8bf82",
            "id": "31c370a9-98de-3533-c14e-c91776c8bf82",
            "title": "Audio Lecture: Mel Bochner Symposium, Introduction and Keynote",
            "timestamp": "2020-07-30T05:06:18-05:00"
        },
        {
            "_score": 1,
            "api_model": "sounds",
            "api_link": "https://aggregator-data.artic.edu/api/v1/sounds/31ee173d-cd35-88ef-9362-61722a5e10bf",
            "id": "31ee173d-cd35-88ef-9362-61722a5e10bf",
            "title": "Audio stop 442.wav",
            "timestamp": "2020-07-30T05:06:18-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15"
    }
}
```
:::

#### `GET /sounds/{id}`

A single sound by the given identifier. {id} is the identifier from our collections management system.


### Texts

_The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu._

#### `GET /texts`

A list of all texts sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#texts).

##### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

::: details Example request: https://api.artic.edu/api/v1/texts?limit=2  
```js
{
    "pagination": {
        "total": 2073,
        "limit": 2,
        "offset": 0,
        "total_pages": 1037,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/texts?page=2&limit=2"
    },
    "data": [
        {
            "id": "94fec0ef-f7e8-de18-1abd-437ba326d47c",
            "lake_guid": "94fec0ef-f7e8-de18-1abd-437ba326d47c",
            "api_model": "texts",
            "api_link": "https://api.artic.edu/api/v1/texts/94fec0ef-f7e8-de18-1abd-437ba326d47c",
            "title": "Chart: Chronology of the Obas of Benin",
            "type": "text",
            ...
        },
        {
            "id": "8440fd93-e2f6-140c-d1ba-27ee861f9575",
            "lake_guid": "8440fd93-e2f6-140c-d1ba-27ee861f9575",
            "api_model": "texts",
            "api_link": "https://api.artic.edu/api/v1/texts/8440fd93-e2f6-140c-d1ba-27ee861f9575",
            "title": "Audio transcript 409.txt",
            "type": "text",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15",
        "documentation": "http://art-institute-of-chicago.github.io/data-aggregator"
    },
    "config": {
        "iiif_url": "https://lakeimagesweb.artic.edu/iiif/2",
        "shop_image_url": "https://shop-images.imgix.net",
        "shop_product_url": "http://shop.artic.edu/item.aspx?productId=",
        "shop_category_url": "http://shop.artic.edu/item.aspx?productId="
    }
}
```
:::

#### `GET /texts/search`

Search texts data in the aggregator. 

##### Available parameters:

* `q` - Your search query
* `query` - For complex queries, you can pass Elasticsearch domain syntax queries here
* `sort` - Used in conjunction with `query`
* `from` - Starting point of results. Pagination via Elasticsearch conventions
* `size` - Number of results to return. Pagination via Elasticsearch conventions
* `facets` - A comma-separated list of 'count' aggregation facets to include in the results.

::: details Example request: https://api.artic.edu/api/v1/texts/search
```js
{
    "preference": null,
    "pagination": {
        "total": 2071,
        "limit": 10,
        "offset": 0,
        "total_pages": 208,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "texts",
            "api_link": "https://aggregator-data.artic.edu/api/v1/texts/6d0baa6e-fa2b-5250-e29d-ea076f4bc432",
            "id": "6d0baa6e-fa2b-5250-e29d-ea076f4bc432",
            "title": "AIC1927SAICAnnual_comb.pdf",
            "timestamp": "2020-07-30T05:06:34-05:00"
        },
        {
            "_score": 1,
            "api_model": "texts",
            "api_link": "https://aggregator-data.artic.edu/api/v1/texts/6d22910e-a036-5c1e-5668-3ba2a2ef5532",
            "id": "6d22910e-a036-5c1e-5668-3ba2a2ef5532",
            "title": "focus: William Pope.L\u2014Drawing, Dreaming, Drowning",
            "timestamp": "2020-07-30T05:06:34-05:00"
        },
        {
            "_score": 1,
            "api_model": "texts",
            "api_link": "https://aggregator-data.artic.edu/api/v1/texts/6d3587e9-1a22-f778-9075-07663ceb4f04",
            "id": "6d3587e9-1a22-f778-9075-07663ceb4f04",
            "title": "Glossary: Edgar Degas",
            "timestamp": "2020-07-30T05:06:34-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15"
    }
}
```
:::

#### `GET /texts/{id}`

A single text by the given identifier. {id} is the identifier from our collections management system.


## Shop

### Shop Categories

_The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for "fair use" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials._

#### `GET /shop-categories`

A list of all shop-categories sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#shop-categories).

##### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource
* `include` - A comma-separated list of subresource to embed in the returned resources. Available options are:
  * `children`

::: details Example request: https://api.artic.edu/api/v1/shop-categories?limit=2  
```js
{
    "pagination": {
        "total": 0,
        "limit": 2,
        "offset": 0,
        "total_pages": 1,
        "current_page": 1
    },
    "data": [],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15",
        "documentation": "http://art-institute-of-chicago.github.io/data-aggregator"
    },
    "config": {
        "iiif_url": "https://lakeimagesweb.artic.edu/iiif/2",
        "shop_image_url": "https://shop-images.imgix.net",
        "shop_product_url": "http://shop.artic.edu/item.aspx?productId=",
        "shop_category_url": "http://shop.artic.edu/item.aspx?productId="
    }
}
```
:::

#### `GET /shop-categories/search`

Search shop-categories data in the aggregator. 

##### Available parameters:

* `q` - Your search query
* `query` - For complex queries, you can pass Elasticsearch domain syntax queries here
* `sort` - Used in conjunction with `query`
* `from` - Starting point of results. Pagination via Elasticsearch conventions
* `size` - Number of results to return. Pagination via Elasticsearch conventions
* `facets` - A comma-separated list of 'count' aggregation facets to include in the results.

::: details Example request: https://api.artic.edu/api/v1/shop-categories/search
```js
{
    "preference": null,
    "pagination": {
        "total": 87,
        "limit": 10,
        "offset": 0,
        "total_pages": 9,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "shop-categories",
            "api_link": "https://aggregator-data.artic.edu/api/v1/shop-categories/2",
            "id": 2,
            "title": "Books & Prints",
            "timestamp": "2020-07-30T05:06:39-05:00"
        },
        {
            "_score": 1,
            "api_model": "shop-categories",
            "api_link": "https://aggregator-data.artic.edu/api/v1/shop-categories/3",
            "id": 3,
            "title": "Fashion & Accessories",
            "timestamp": "2020-07-30T05:06:39-05:00"
        },
        {
            "_score": 1,
            "api_model": "shop-categories",
            "api_link": "https://aggregator-data.artic.edu/api/v1/shop-categories/4",
            "id": 4,
            "title": "Decor",
            "timestamp": "2020-07-30T05:06:39-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15"
    }
}
```
:::

#### `GET /shop-categories/{id}`

A single shop-category by the given identifier.


### Products

_The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for "fair use" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials._

#### `GET /products`

A list of all products sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#products).

##### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

::: details Example request: https://api.artic.edu/api/v1/products?limit=2  
```js
{
    "pagination": {
        "total": 6500,
        "limit": 2,
        "offset": 0,
        "total_pages": 3250,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/products?page=2&limit=2"
    },
    "data": [
        {
            "id": 8652,
            "api_model": "products",
            "api_link": "https://api.artic.edu/api/v1/products/8652",
            "title": "TRAY INTERVALS OF SEVENTHS 6X12IN",
            "title_sort": null,
            "is_active": false,
            ...
        },
        {
            "id": 8651,
            "api_model": "products",
            "api_link": "https://api.artic.edu/api/v1/products/8651",
            "title": "SCRF MIXED TONES SILK",
            "title_sort": null,
            "is_active": false,
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15",
        "documentation": "http://art-institute-of-chicago.github.io/data-aggregator"
    },
    "config": {
        "iiif_url": "https://lakeimagesweb.artic.edu/iiif/2",
        "shop_image_url": "https://shop-images.imgix.net",
        "shop_product_url": "http://shop.artic.edu/item.aspx?productId=",
        "shop_category_url": "http://shop.artic.edu/item.aspx?productId="
    }
}
```
:::

#### `GET /products/search`

Search products data in the aggregator. 

##### Available parameters:

* `q` - Your search query
* `query` - For complex queries, you can pass Elasticsearch domain syntax queries here
* `sort` - Used in conjunction with `query`
* `from` - Starting point of results. Pagination via Elasticsearch conventions
* `size` - Number of results to return. Pagination via Elasticsearch conventions
* `facets` - A comma-separated list of 'count' aggregation facets to include in the results.

::: details Example request: https://api.artic.edu/api/v1/products/search
```js
{
    "preference": null,
    "pagination": {
        "total": 6928,
        "limit": 10,
        "offset": 0,
        "total_pages": 693,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "products",
            "api_link": "https://aggregator-data.artic.edu/api/v1/products/903",
            "id": 903,
            "title": "Van Gogh The Bedroom Large Matted Print",
            "timestamp": "2020-07-30T05:06:40-05:00"
        },
        {
            "_score": 1,
            "api_model": "products",
            "api_link": "https://aggregator-data.artic.edu/api/v1/products/904",
            "id": 904,
            "title": "Monet House at Argenteuil Large Framed Reproduction",
            "timestamp": "2020-07-30T05:06:40-05:00"
        },
        {
            "_score": 1,
            "api_model": "products",
            "api_link": "https://aggregator-data.artic.edu/api/v1/products/905",
            "id": 905,
            "title": "Monet House at Argenteuil Large Matted Print",
            "timestamp": "2020-07-30T05:06:40-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15"
    }
}
```
:::

#### `GET /products/{id}`

A single product by the given identifier.

::: details Example request: https://api.artic.edu/api/v1/products/8509?limit=2  
```js
{
    "data": {
        "id": 8509,
        "api_model": "products",
        "api_link": "https://api.artic.edu/api/v1/products/8509",
        "title": "Lexon Mino Speaker - Polished",
        "title_sort": null,
        "is_active": true,
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15",
        "documentation": "http://art-institute-of-chicago.github.io/data-aggregator"
    },
    "config": {
        "iiif_url": "https://lakeimagesweb.artic.edu/iiif/2",
        "shop_image_url": "https://shop-images.imgix.net",
        "shop_product_url": "http://shop.artic.edu/item.aspx?productId=",
        "shop_category_url": "http://shop.artic.edu/item.aspx?productId="
    }
}
```
:::

## Mobile

### Tours

_The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for "fair use" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials._

#### `GET /tours`

A list of all tours sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#tours).

##### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource
* `include` - A comma-separated list of subresource to embed in the returned resources. Available options are:
  * `tour_stops`

::: details Example request: https://api.artic.edu/api/v1/tours?limit=2  
```js
{
    "pagination": {
        "total": 15,
        "limit": 2,
        "offset": 0,
        "total_pages": 8,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/tours?page=2&limit=2"
    },
    "data": [
        {
            "id": 3246,
            "api_model": "tours",
            "api_link": "https://api.artic.edu/api/v1/tours/3246",
            "title": "Verbal Description tour: The Essentials",
            "image": "http://aic-mobile-tours.artic.edu/sites/default/files/tour-images/IM016907_020.jpg",
            "description": "<p>Designed for people with impaired vision: Discover our Essentials Tour.</p>\n",
            ...
        },
        {
            "id": 1000,
            "api_model": "tours",
            "api_link": "https://api.artic.edu/api/v1/tours/1000",
            "title": "Magic of the Miniature",
            "image": "http://aic-mobile-tours.artic.edu/sites/default/files/tour-images/E17048_reduced.jpg",
            "description": "<p>Travel back in time through the magic of the Thorne Rooms.</p>\n",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15",
        "documentation": "http://art-institute-of-chicago.github.io/data-aggregator"
    },
    "config": {
        "iiif_url": "https://lakeimagesweb.artic.edu/iiif/2",
        "shop_image_url": "https://shop-images.imgix.net",
        "shop_product_url": "http://shop.artic.edu/item.aspx?productId=",
        "shop_category_url": "http://shop.artic.edu/item.aspx?productId="
    }
}
```
:::

#### `GET /tours/search`

Search tours data in the aggregator. 

##### Available parameters:

* `q` - Your search query
* `query` - For complex queries, you can pass Elasticsearch domain syntax queries here
* `sort` - Used in conjunction with `query`
* `from` - Starting point of results. Pagination via Elasticsearch conventions
* `size` - Number of results to return. Pagination via Elasticsearch conventions
* `facets` - A comma-separated list of 'count' aggregation facets to include in the results.

::: details Example request: https://api.artic.edu/api/v1/tours/search
```js
{
    "preference": null,
    "pagination": {
        "total": 19,
        "limit": 10,
        "offset": 0,
        "total_pages": 2,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "tours",
            "api_link": "https://aggregator-data.artic.edu/api/v1/tours/4581",
            "id": 4581,
            "title": "In a Cloud, in a Wall, in a Chair: Six Modernists in Mexico at Midcentury",
            "timestamp": "2020-03-06T06:10:23-06:00"
        },
        {
            "_score": 1,
            "api_model": "tours",
            "api_link": "https://aggregator-data.artic.edu/api/v1/tours/4626",
            "id": 4626,
            "title": "Andy Warhol\u2014From A to B and Back Again",
            "timestamp": "2020-03-06T06:10:23-06:00"
        },
        {
            "_score": 1,
            "api_model": "tours",
            "api_link": "https://aggregator-data-dev.artic.edu/api/v1/tours/4636",
            "id": 4636,
            "title": "MD Test Tour",
            "timestamp": "2019-12-05T11:00:47-06:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15"
    }
}
```
:::

#### `GET /tours/{id}`

A single tour by the given identifier.

::: details Example request: https://api.artic.edu/api/v1/tours/3246?limit=2  
```js
{
    "data": {
        "id": 3246,
        "api_model": "tours",
        "api_link": "https://api.artic.edu/api/v1/tours/3246",
        "title": "Verbal Description tour: The Essentials",
        "image": "http://aic-mobile-tours.artic.edu/sites/default/files/tour-images/IM016907_020.jpg",
        "description": "<p>Designed for people with impaired vision: Discover our Essentials Tour.</p>\n",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15",
        "documentation": "http://art-institute-of-chicago.github.io/data-aggregator"
    },
    "config": {
        "iiif_url": "https://lakeimagesweb.artic.edu/iiif/2",
        "shop_image_url": "https://shop-images.imgix.net",
        "shop_product_url": "http://shop.artic.edu/item.aspx?productId=",
        "shop_category_url": "http://shop.artic.edu/item.aspx?productId="
    }
}
```
:::

### Mobile Sounds

_The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for "fair use" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials._

#### `GET /mobile-sounds`

A list of all mobile-sounds sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#mobile-sounds).

##### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

::: details Example request: https://api.artic.edu/api/v1/mobile-sounds?limit=2  
```js
{
    "pagination": {
        "total": 772,
        "limit": 2,
        "offset": 0,
        "total_pages": 386,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/mobile-sounds?page=2&limit=2"
    },
    "data": [
        {
            "id": 4665,
            "api_model": "mobile-sounds",
            "api_link": "https://api.artic.edu/api/v1/mobile-sounds/4665",
            "title": "Bottle Rack (Porte-Bouteilles) (How to Make a Surrealist Artwork)",
            "web_url": "https://www.artic.edu/mobile/audio/238749_T022_BottleRack_V6.mp3",
            "transcript": "<p>This is an interview with Dada artist Marcel Duchamp on the BBC in 1968.</p>\n<p>Narrator: Where should we begin with this confounding artwork? Maybe the easiest place is explaining what is literally is. Curator, Caitlin Haskell.</p>\n<p>Catlin: This is actually a functional object. In France people would drink wine and those bottles could be reused. And so after you finished your wine you\u2019d rinse it out and the bottle would need to dry so you would put on one of these spikes.</p>\n<p>Narrator: Duchamp called these sculptures \u201cReadymades.\u201d In the example we\u2019re looking at, the bottle rack is presented as it was originally manufactured.</p>\n<p>Caitlin: His hand is not involved in the making of this in the least, but he selected it and he had the idea to put it in the context of an art gallery. And it starts to provoke lots and lots of questions about, well, what is an artwork? Or you sort of find yourself asking \u2018why couldn\u2019t this be an artwork?\u2019</p>\n<p>Narrator: What complicates this question even more is that this bottle rack at the Art Institute isn\u2019t the first bottle rack. See, Duchamp was in New York when he fully conceived of the idea of the Readymade, but the bottle rack he has purchased in 1914 was still in his studio in France, which he left in the care of his sister Suzanne, whose work is also discussed on this tour. Research Associate, Jennifer Cohen.</p>\n<p>Jennifer: And he wrote to his sister about this \u201cso called bottle rack\u201d as he put it and he said that now he was going to call it a Readymade and he said \u201ctake the bottle rack for yourself, I will make it a Readymade remotely you are to inscribe it at the bottom and on the inside bottom ring in small letters painted with a brush in oil, silver/white color with an inscription.</p>\n<p>He\u2019s trying to distance the act of artistic intentionality to such a degree that he\u2019s having his sister sign the work for him.</p>\n<p>Narrator: Unfortunately for Marcel, his sister received the letter too late and had already thrown out the bottle rack, assuming it was junk cluttering up the studio. Not one to be discouraged, Duchamp would go on purchase and exhibit multiple bottle racks. This particular bottle rack was ultimately purchased by artist Robert Rauchunberg and signed by Duchamp, which you can see on the inside of the bottom ring.</p>\n<p>Duchamp\u2019s questioning of originality, artist intention, and what makes something artwork would become central for the Surrealist movement and shaped what it would mean to create a Surrealist artwork.</p>\n",
            ...
        },
        {
            "id": 4664,
            "api_model": "mobile-sounds",
            "api_link": "https://api.artic.edu/api/v1/mobile-sounds/4664",
            "title": "Forest and Sun (How to Make a Surrealist Artwork)",
            "web_url": "https://www.artic.edu/mobile/audio/185760_T022_ForestandSun_V5.mp3",
            "transcript": "<p>Narrator: An important part of being a Surrealist was discovering new methods for creating artworks. One way the Surrealists did that was by experimenting with placing the creation of the artwork outside the control of the artist. Curator, Caitlin Haskell.</p>\n<p>Caitlin: And Ernst in particular had some really wonderful ways of making textures, making marks that are totally new and don\u2019t allow him to be completely in control of what\u2019s going to arrive on the surface.</p>\n<p>Narrator: We can see two such techniques here. One known as frottage, which involved placing paper or canvas on a textured surface, like wood, and drawing over the top of that surface to create shapes and lines. And grattage, technique where you scrape away applied oil paint, creating unexpected patterns.</p>\n<p>These methods of creation would come to be known as automatism and would be foundational in the creation of many Surrealist artworks. Research Associate, Jennifer Cohen.</p>\n<p>Jennifer: It originated in poetry, where you would write without stopping. And what they were looking for was something more authentic about themselves. It was a very Freudian exercise where I\u2019m looking for a secret that my conscious mind doesn\u2019t know about itself.</p>\n<p>Narrator: By accessing the unconscious during the creative process a painting could become a mirror to one\u2019s inner life. Notice for instance the forest.</p>\n<p>Jennifer: It gets to the heart of who he is. You can see that the petrified forest comes to look like an \u2018M\u2019 and from a distance you can really get a sense that it\u2019s really supposed to be the artist\u2019s signature.</p>\n<p>Narrator: As in his first name, Max. Ernst, like many Surrealists, wanted to move away from rational thought because they believed this way of thinking had lead society astray.</p>\n<p>Caitlin: Ernst was someone who had fought in World War I. And you\u2019re at one of these moments you get in the 20th century where there\u2019s a sense that all of the rational might that Europe had, all the forces of civilization had led to something quite tragic and horrific.</p>\n<p>Narrator: In using automatism, Surrealists believed we could uncover and present something profound about ourselves that rationalism had failed to produce.</p>\n",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15",
        "documentation": "http://art-institute-of-chicago.github.io/data-aggregator"
    },
    "config": {
        "iiif_url": "https://lakeimagesweb.artic.edu/iiif/2",
        "shop_image_url": "https://shop-images.imgix.net",
        "shop_product_url": "http://shop.artic.edu/item.aspx?productId=",
        "shop_category_url": "http://shop.artic.edu/item.aspx?productId="
    }
}
```
:::

#### `GET /mobile-sounds/search`

Search mobile-sounds data in the aggregator. 

##### Available parameters:

* `q` - Your search query
* `query` - For complex queries, you can pass Elasticsearch domain syntax queries here
* `sort` - Used in conjunction with `query`
* `from` - Starting point of results. Pagination via Elasticsearch conventions
* `size` - Number of results to return. Pagination via Elasticsearch conventions
* `facets` - A comma-separated list of 'count' aggregation facets to include in the results.

::: details Example request: https://api.artic.edu/api/v1/mobile-sounds/search
```js
{
    "preference": null,
    "pagination": {
        "total": 787,
        "limit": 10,
        "offset": 0,
        "total_pages": 79,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "mobile-sounds",
            "api_link": "https://aggregator-data-dev.artic.edu/api/v1/mobile-sounds/4528",
            "id": 4528,
            "title": "Statue of a Young Satyr Wearing a Theater Mask of Silenos",
            "timestamp": "2019-12-05T11:00:45-06:00"
        },
        {
            "_score": 1,
            "api_model": "mobile-sounds",
            "api_link": "https://aggregator-data-dev.artic.edu/api/v1/mobile-sounds/4637",
            "id": 4637,
            "title": "Intro",
            "timestamp": "2019-12-05T11:00:46-06:00"
        },
        {
            "_score": 1,
            "api_model": "mobile-sounds",
            "api_link": "https://aggregator-data.artic.edu/api/v1/mobile-sounds/226",
            "id": 226,
            "title": "Intro",
            "timestamp": "2020-07-30T05:07:09-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15"
    }
}
```
:::

#### `GET /mobile-sounds/{id}`

A single mobile-sound by the given identifier.

::: details Example request: https://api.artic.edu/api/v1/mobile-sounds/4665?limit=2  
```js
{
    "data": {
        "id": 4665,
        "api_model": "mobile-sounds",
        "api_link": "https://api.artic.edu/api/v1/mobile-sounds/4665",
        "title": "Bottle Rack (Porte-Bouteilles) (How to Make a Surrealist Artwork)",
        "web_url": "https://www.artic.edu/mobile/audio/238749_T022_BottleRack_V6.mp3",
        "transcript": "<p>This is an interview with Dada artist Marcel Duchamp on the BBC in 1968.</p>\n<p>Narrator: Where should we begin with this confounding artwork? Maybe the easiest place is explaining what is literally is. Curator, Caitlin Haskell.</p>\n<p>Catlin: This is actually a functional object. In France people would drink wine and those bottles could be reused. And so after you finished your wine you\u2019d rinse it out and the bottle would need to dry so you would put on one of these spikes.</p>\n<p>Narrator: Duchamp called these sculptures \u201cReadymades.\u201d In the example we\u2019re looking at, the bottle rack is presented as it was originally manufactured.</p>\n<p>Caitlin: His hand is not involved in the making of this in the least, but he selected it and he had the idea to put it in the context of an art gallery. And it starts to provoke lots and lots of questions about, well, what is an artwork? Or you sort of find yourself asking \u2018why couldn\u2019t this be an artwork?\u2019</p>\n<p>Narrator: What complicates this question even more is that this bottle rack at the Art Institute isn\u2019t the first bottle rack. See, Duchamp was in New York when he fully conceived of the idea of the Readymade, but the bottle rack he has purchased in 1914 was still in his studio in France, which he left in the care of his sister Suzanne, whose work is also discussed on this tour. Research Associate, Jennifer Cohen.</p>\n<p>Jennifer: And he wrote to his sister about this \u201cso called bottle rack\u201d as he put it and he said that now he was going to call it a Readymade and he said \u201ctake the bottle rack for yourself, I will make it a Readymade remotely you are to inscribe it at the bottom and on the inside bottom ring in small letters painted with a brush in oil, silver/white color with an inscription.</p>\n<p>He\u2019s trying to distance the act of artistic intentionality to such a degree that he\u2019s having his sister sign the work for him.</p>\n<p>Narrator: Unfortunately for Marcel, his sister received the letter too late and had already thrown out the bottle rack, assuming it was junk cluttering up the studio. Not one to be discouraged, Duchamp would go on purchase and exhibit multiple bottle racks. This particular bottle rack was ultimately purchased by artist Robert Rauchunberg and signed by Duchamp, which you can see on the inside of the bottom ring.</p>\n<p>Duchamp\u2019s questioning of originality, artist intention, and what makes something artwork would become central for the Surrealist movement and shaped what it would mean to create a Surrealist artwork.</p>\n",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15",
        "documentation": "http://art-institute-of-chicago.github.io/data-aggregator"
    },
    "config": {
        "iiif_url": "https://lakeimagesweb.artic.edu/iiif/2",
        "shop_image_url": "https://shop-images.imgix.net",
        "shop_product_url": "http://shop.artic.edu/item.aspx?productId=",
        "shop_category_url": "http://shop.artic.edu/item.aspx?productId="
    }
}
```
:::

## Digital Scholarly Catalogs

### Publications

_The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for "fair use" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials._

#### `GET /publications`

A list of all publications sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#publications).

##### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

::: details Example request: https://api.artic.edu/api/v1/publications?limit=2  
```js
{
    "pagination": {
        "total": 12,
        "limit": 2,
        "offset": 0,
        "total_pages": 6,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/publications?page=2&limit=2"
    },
    "data": [
        {
            "id": 141096,
            "api_model": "publications",
            "api_link": "https://api.artic.edu/api/v1/publications/141096",
            "title": "Gauguin Paintings, Sculpture, and Graphic Works at the Art Institute of Chicago",
            "web_url": "https://publications.artic.edu/gauguin/reader/gauguinart",
            "site": "gauguin",
            ...
        },
        {
            "id": 140019,
            "api_model": "publications",
            "api_link": "https://api.artic.edu/api/v1/publications/140019",
            "title": "Manet Paintings and Works on Paper at the Art Institute of Chicago",
            "web_url": "https://publications.artic.edu/manet/reader/manetart",
            "site": "manet",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15",
        "documentation": "http://art-institute-of-chicago.github.io/data-aggregator"
    },
    "config": {
        "iiif_url": "https://lakeimagesweb.artic.edu/iiif/2",
        "shop_image_url": "https://shop-images.imgix.net",
        "shop_product_url": "http://shop.artic.edu/item.aspx?productId=",
        "shop_category_url": "http://shop.artic.edu/item.aspx?productId="
    }
}
```
:::

#### `GET /publications/search`

Search publications data in the aggregator. 

##### Available parameters:

* `q` - Your search query
* `query` - For complex queries, you can pass Elasticsearch domain syntax queries here
* `sort` - Used in conjunction with `query`
* `from` - Starting point of results. Pagination via Elasticsearch conventions
* `size` - Number of results to return. Pagination via Elasticsearch conventions
* `facets` - A comma-separated list of 'count' aggregation facets to include in the results.

::: details Example request: https://api.artic.edu/api/v1/publications/search
```js
{
    "preference": null,
    "pagination": {
        "total": 12,
        "limit": 10,
        "offset": 0,
        "total_pages": 2,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "publications",
            "api_link": "https://aggregator-data.artic.edu/api/v1/publications/2",
            "id": 2,
            "title": "American Silver in the Art Institute of Chicago",
            "timestamp": "2020-07-30T05:07:14-05:00"
        },
        {
            "_score": 1,
            "api_model": "publications",
            "api_link": "https://aggregator-data.artic.edu/api/v1/publications/7",
            "id": 7,
            "title": "Pissarro Paintings and Works on Paper at the Art Institute of Chicago",
            "timestamp": "2020-07-30T05:07:14-05:00"
        },
        {
            "_score": 1,
            "api_model": "publications",
            "api_link": "https://aggregator-data.artic.edu/api/v1/publications/12",
            "id": 12,
            "title": "The Modern Series at the Art Institute of Chicago",
            "timestamp": "2020-07-30T05:07:14-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15"
    }
}
```
:::

#### `GET /publications/{id}`

A single publication by the given identifier.

::: details Example request: https://api.artic.edu/api/v1/publications/141096?limit=2  
```js
{
    "data": {
        "id": 141096,
        "api_model": "publications",
        "api_link": "https://api.artic.edu/api/v1/publications/141096",
        "title": "Gauguin Paintings, Sculpture, and Graphic Works at the Art Institute of Chicago",
        "web_url": "https://publications.artic.edu/gauguin/reader/gauguinart",
        "site": "gauguin",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15",
        "documentation": "http://art-institute-of-chicago.github.io/data-aggregator"
    },
    "config": {
        "iiif_url": "https://lakeimagesweb.artic.edu/iiif/2",
        "shop_image_url": "https://shop-images.imgix.net",
        "shop_product_url": "http://shop.artic.edu/item.aspx?productId=",
        "shop_category_url": "http://shop.artic.edu/item.aspx?productId="
    }
}
```
:::

### Sections

_The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for "fair use" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials._

#### `GET /sections`

A list of all sections sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#sections).

##### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

::: details Example request: https://api.artic.edu/api/v1/sections?limit=2  
```js
{
    "pagination": {
        "total": 1124,
        "limit": 2,
        "offset": 0,
        "total_pages": 562,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/sections?page=2&limit=2"
    },
    "data": [
        {
            "id": 128775,
            "api_model": "sections",
            "api_link": "https://api.artic.edu/api/v1/sections/128775",
            "title": "Bibliography",
            "web_url": "https://publications.artic.edu/americansilver/reader/collection/section/504",
            "accession": null,
            ...
        },
        {
            "id": 108342,
            "api_model": "sections",
            "api_link": "https://api.artic.edu/api/v1/sections/108342",
            "title": "Select Silver Objects in the Collection of the Art Institute of Chicago",
            "web_url": "https://publications.artic.edu/americansilver/reader/collection/section/462",
            "accession": null,
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15",
        "documentation": "http://art-institute-of-chicago.github.io/data-aggregator"
    },
    "config": {
        "iiif_url": "https://lakeimagesweb.artic.edu/iiif/2",
        "shop_image_url": "https://shop-images.imgix.net",
        "shop_product_url": "http://shop.artic.edu/item.aspx?productId=",
        "shop_category_url": "http://shop.artic.edu/item.aspx?productId="
    }
}
```
:::

#### `GET /sections/search`

Search sections data in the aggregator. 

##### Available parameters:

* `q` - Your search query
* `query` - For complex queries, you can pass Elasticsearch domain syntax queries here
* `sort` - Used in conjunction with `query`
* `from` - Starting point of results. Pagination via Elasticsearch conventions
* `size` - Number of results to return. Pagination via Elasticsearch conventions
* `facets` - A comma-separated list of 'count' aggregation facets to include in the results.

::: details Example request: https://api.artic.edu/api/v1/sections/search
```js
{
    "preference": null,
    "pagination": {
        "total": 1124,
        "limit": 10,
        "offset": 0,
        "total_pages": 113,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "sections",
            "api_link": "https://aggregator-data.artic.edu/api/v1/sections/18",
            "id": 18,
            "title": "Foreword",
            "timestamp": "2020-07-30T05:07:14-05:00"
        },
        {
            "_score": 1,
            "api_model": "sections",
            "api_link": "https://aggregator-data.artic.edu/api/v1/sections/25",
            "id": 25,
            "title": "Preface: American Silver",
            "timestamp": "2020-07-30T05:07:14-05:00"
        },
        {
            "_score": 1,
            "api_model": "sections",
            "api_link": "https://aggregator-data.artic.edu/api/v1/sections/33",
            "id": 33,
            "title": "Forging a Collection: American Silver at the Art Institute of Chicago",
            "timestamp": "2020-07-30T05:07:14-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15"
    }
}
```
:::

#### `GET /sections/{id}`

A single section by the given identifier.

::: details Example request: https://api.artic.edu/api/v1/sections/128775?limit=2  
```js
{
    "data": {
        "id": 128775,
        "api_model": "sections",
        "api_link": "https://api.artic.edu/api/v1/sections/128775",
        "title": "Bibliography",
        "web_url": "https://publications.artic.edu/americansilver/reader/collection/section/504",
        "accession": null,
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15",
        "documentation": "http://art-institute-of-chicago.github.io/data-aggregator"
    },
    "config": {
        "iiif_url": "https://lakeimagesweb.artic.edu/iiif/2",
        "shop_image_url": "https://shop-images.imgix.net",
        "shop_product_url": "http://shop.artic.edu/item.aspx?productId=",
        "shop_category_url": "http://shop.artic.edu/item.aspx?productId="
    }
}
```
:::

## Static Archive

### Sites

_The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for "fair use" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials._

#### `GET /sites`

A list of all sites sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#sites).

##### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource
* `include` - A comma-separated list of subresource to embed in the returned resources. Available options are:
  * `artworks`

::: details Example request: https://api.artic.edu/api/v1/sites?limit=2  
```js
{
    "pagination": {
        "total": 93,
        "limit": 2,
        "offset": 0,
        "total_pages": 47,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/sites?page=2&limit=2"
    },
    "data": [
        {
            "id": 104,
            "api_model": "sites",
            "api_link": "https://api.artic.edu/api/v1/sites/104",
            "title": "Hugh Edwards",
            "description": null,
            "web_url": "http://archive.artic.edu/edwards/",
            ...
        },
        {
            "id": 103,
            "api_model": "sites",
            "api_link": "https://api.artic.edu/api/v1/sites/103",
            "title": "Edward Steichen's Work War I Years",
            "description": "This website, which includes works drawn from the Art Institute\u2019s collection, reveals the profound influence Steichen had on various photographic fields. Featured is a unique album of World War I aerial photographs assembled and annotated by Steichen in 1919 following his military discharge.",
            "web_url": "http://archive.artic.edu/steichen/",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15",
        "documentation": "http://art-institute-of-chicago.github.io/data-aggregator"
    },
    "config": {
        "iiif_url": "https://lakeimagesweb.artic.edu/iiif/2",
        "shop_image_url": "https://shop-images.imgix.net",
        "shop_product_url": "http://shop.artic.edu/item.aspx?productId=",
        "shop_category_url": "http://shop.artic.edu/item.aspx?productId="
    }
}
```
:::

#### `GET /sites/search`

Search sites data in the aggregator. 

##### Available parameters:

* `q` - Your search query
* `query` - For complex queries, you can pass Elasticsearch domain syntax queries here
* `sort` - Used in conjunction with `query`
* `from` - Starting point of results. Pagination via Elasticsearch conventions
* `size` - Number of results to return. Pagination via Elasticsearch conventions
* `facets` - A comma-separated list of 'count' aggregation facets to include in the results.

::: details Example request: https://api.artic.edu/api/v1/sites/search
```js
{
    "preference": null,
    "pagination": {
        "total": 93,
        "limit": 10,
        "offset": 0,
        "total_pages": 10,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "sites",
            "api_link": "https://aggregator-data.artic.edu/api/v1/sites/1",
            "id": 1,
            "title": "Chicago Architecture: Ten Visions",
            "timestamp": "2020-07-30T05:07:28-05:00"
        },
        {
            "_score": 1,
            "api_model": "sites",
            "api_link": "https://aggregator-data.artic.edu/api/v1/sites/2",
            "id": 2,
            "title": "American Perspectives: A yearlong celebration of American artistic vision",
            "timestamp": "2020-07-30T05:07:28-05:00"
        },
        {
            "_score": 1,
            "api_model": "sites",
            "api_link": "https://aggregator-data.artic.edu/api/v1/sites/3",
            "id": 3,
            "title": "Curious Corner",
            "timestamp": "2020-07-30T05:07:28-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15"
    }
}
```
:::

#### `GET /sites/{id}`

A single site by the given identifier.

::: details Example request: https://api.artic.edu/api/v1/sites/104?limit=2  
```js
{
    "data": {
        "id": 104,
        "api_model": "sites",
        "api_link": "https://api.artic.edu/api/v1/sites/104",
        "title": "Hugh Edwards",
        "description": null,
        "web_url": "http://archive.artic.edu/edwards/",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15",
        "documentation": "http://art-institute-of-chicago.github.io/data-aggregator"
    },
    "config": {
        "iiif_url": "https://lakeimagesweb.artic.edu/iiif/2",
        "shop_image_url": "https://shop-images.imgix.net",
        "shop_product_url": "http://shop.artic.edu/item.aspx?productId=",
        "shop_category_url": "http://shop.artic.edu/item.aspx?productId="
    }
}
```
:::

## Website

### Closures

_The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for "fair use" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials._

#### `GET /closures`

A list of all closures sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#closures).

##### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

::: details Example request: https://api.artic.edu/api/v1/closures?limit=2  
```js
{
    "pagination": {
        "total": 16,
        "limit": 2,
        "offset": 0,
        "total_pages": 8,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/closures?page=2&limit=2"
    },
    "data": [
        {
            "id": 17,
            "api_model": "closures",
            "api_link": "https://api.artic.edu/api/v1/closures/17",
            "title": "Lorem ipsum.",
            "date_start": "2020-03-13T00:00:00-05:00",
            "date_end": "2020-05-31T00:00:00-05:00",
            ...
        },
        {
            "id": 11,
            "api_model": "closures",
            "api_link": "https://api.artic.edu/api/v1/closures/11",
            "title": "Lorem ipsum.",
            "date_start": "2020-03-11T00:00:00-05:00",
            "date_end": "2020-03-13T00:00:00-05:00",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15",
        "documentation": "http://art-institute-of-chicago.github.io/data-aggregator"
    },
    "config": {
        "iiif_url": "https://lakeimagesweb.artic.edu/iiif/2",
        "shop_image_url": "https://shop-images.imgix.net",
        "shop_product_url": "http://shop.artic.edu/item.aspx?productId=",
        "shop_category_url": "http://shop.artic.edu/item.aspx?productId="
    }
}
```
:::

#### `GET /closures/search`

Search closures data in the aggregator. 

##### Available parameters:

* `q` - Your search query
* `query` - For complex queries, you can pass Elasticsearch domain syntax queries here
* `sort` - Used in conjunction with `query`
* `from` - Starting point of results. Pagination via Elasticsearch conventions
* `size` - Number of results to return. Pagination via Elasticsearch conventions
* `facets` - A comma-separated list of 'count' aggregation facets to include in the results.

::: details Example request: https://api.artic.edu/api/v1/closures/search
```js
{
    "preference": null,
    "pagination": {
        "total": 19,
        "limit": 10,
        "offset": 0,
        "total_pages": 2,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "closures",
            "api_link": "https://aggregator-data.artic.edu/api/v1/closures/4",
            "id": 4,
            "title": "Lorem ipsum.",
            "timestamp": "2020-07-30T05:07:30-05:00"
        },
        {
            "_score": 1,
            "api_model": "closures",
            "api_link": "https://aggregator-data.artic.edu/api/v1/closures/5",
            "id": 5,
            "title": "Lorem ipsum.",
            "timestamp": "2020-07-30T05:07:30-05:00"
        },
        {
            "_score": 1,
            "api_model": "closures",
            "api_link": "https://aggregator-data.artic.edu/api/v1/closures/9",
            "id": 9,
            "title": "Lorem ipsum.",
            "timestamp": "2020-07-30T05:07:30-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15"
    }
}
```
:::

#### `GET /closures/{id}`

A single closure by the given identifier.

::: details Example request: https://api.artic.edu/api/v1/closures/17?limit=2  
```js
{
    "data": {
        "id": 17,
        "api_model": "closures",
        "api_link": "https://api.artic.edu/api/v1/closures/17",
        "title": "Lorem ipsum.",
        "date_start": "2020-03-13T00:00:00-05:00",
        "date_end": "2020-05-31T00:00:00-05:00",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15",
        "documentation": "http://art-institute-of-chicago.github.io/data-aggregator"
    },
    "config": {
        "iiif_url": "https://lakeimagesweb.artic.edu/iiif/2",
        "shop_image_url": "https://shop-images.imgix.net",
        "shop_product_url": "http://shop.artic.edu/item.aspx?productId=",
        "shop_category_url": "http://shop.artic.edu/item.aspx?productId="
    }
}
```
:::

### Web Exhibitions

_The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for "fair use" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials._

#### `GET /web-exhibitions`

A list of all web-exhibitions sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#web-exhibitions).

##### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

::: details Example request: https://api.artic.edu/api/v1/web-exhibitions?limit=2  
```js
{
    "pagination": {
        "total": 677,
        "limit": 2,
        "offset": 0,
        "total_pages": 339,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/web-exhibitions?page=2&limit=2"
    },
    "data": [
        {
            "id": 386,
            "api_model": "web-exhibitions",
            "api_link": "https://api.artic.edu/api/v1/web-exhibitions/386",
            "title": "Whistler and Roussel: Linked Visions",
            "exhibition_id": 1929,
            "is_featured": false,
            ...
        },
        {
            "id": 688,
            "api_model": "web-exhibitions",
            "api_link": "https://api.artic.edu/api/v1/web-exhibitions/688",
            "title": "Woven Forms by Lenore Tawney",
            "exhibition_id": 4206,
            "is_featured": false,
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15",
        "documentation": "http://art-institute-of-chicago.github.io/data-aggregator"
    },
    "config": {
        "iiif_url": "https://lakeimagesweb.artic.edu/iiif/2",
        "shop_image_url": "https://shop-images.imgix.net",
        "shop_product_url": "http://shop.artic.edu/item.aspx?productId=",
        "shop_category_url": "http://shop.artic.edu/item.aspx?productId="
    }
}
```
:::

#### `GET /web-exhibitions/search`

Search web-exhibitions data in the aggregator. 

##### Available parameters:

* `q` - Your search query
* `query` - For complex queries, you can pass Elasticsearch domain syntax queries here
* `sort` - Used in conjunction with `query`
* `from` - Starting point of results. Pagination via Elasticsearch conventions
* `size` - Number of results to return. Pagination via Elasticsearch conventions
* `facets` - A comma-separated list of 'count' aggregation facets to include in the results.

::: details Example request: https://api.artic.edu/api/v1/web-exhibitions/search
```js
{
    "preference": null,
    "pagination": {
        "total": 678,
        "limit": 10,
        "offset": 0,
        "total_pages": 68,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "web-exhibitions",
            "api_link": "https://aggregator-data.artic.edu/api/v1/web-exhibitions/673",
            "id": 673,
            "title": "**DELETED** A&D TBD",
            "timestamp": "2019-11-22T15:02:14-06:00"
        },
        {
            "_score": 1,
            "api_model": "web-exhibitions",
            "api_link": "https://aggregator-data.artic.edu/api/v1/web-exhibitions/1",
            "id": 1,
            "title": "Charles White: A Retrospective",
            "timestamp": "2020-07-30T05:07:30-05:00"
        },
        {
            "_score": 1,
            "api_model": "web-exhibitions",
            "api_link": "https://aggregator-data.artic.edu/api/v1/web-exhibitions/2",
            "id": 2,
            "title": "Manet and Modern Beauty",
            "timestamp": "2020-07-30T05:07:30-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15"
    }
}
```
:::

#### `GET /web-exhibitions/{id}`

A single web-exhibition by the given identifier.

::: details Example request: https://api.artic.edu/api/v1/web-exhibitions/682?limit=2  
```js
{
    "data": {
        "id": 682,
        "api_model": "web-exhibitions",
        "api_link": "https://api.artic.edu/api/v1/web-exhibitions/682",
        "title": "Nancy Rubins: Our Friend Fluid Metal",
        "exhibition_id": 9524,
        "is_featured": true,
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15",
        "documentation": "http://art-institute-of-chicago.github.io/data-aggregator"
    },
    "config": {
        "iiif_url": "https://lakeimagesweb.artic.edu/iiif/2",
        "shop_image_url": "https://shop-images.imgix.net",
        "shop_product_url": "http://shop.artic.edu/item.aspx?productId=",
        "shop_category_url": "http://shop.artic.edu/item.aspx?productId="
    }
}
```
:::

### Events

_The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for "fair use" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials._

#### `GET /events`

A list of all events sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#events).

##### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource
* `include` - A comma-separated list of subresource to embed in the returned resources. Available options are:
  * `email_series_pivots`
  * `sponsor`

::: details Example request: https://api.artic.edu/api/v1/events?limit=2  
```js
{
    "pagination": {
        "total": 1989,
        "limit": 2,
        "offset": 0,
        "total_pages": 995,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/events?page=2&limit=2"
    },
    "data": [
        {
            "id": 4969,
            "api_model": "events",
            "api_link": "https://api.artic.edu/api/v1/events/4969",
            "title": "Collecting through Six Generations: Weng Family Collection of Chinese Painting and Calligraphy",
            "title_display": null,
            "published": true,
            ...
        },
        {
            "id": 4956,
            "api_model": "events",
            "api_link": "https://api.artic.edu/api/v1/events/4956",
            "title": "CANCELED | Old Masters Society El Greco Lecture and Luncheon",
            "title_display": "CANCELED | Old Masters Society Lecture and Luncheon Featuring <i>El Greco: Ambition and Defiance</i>",
            "published": true,
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15",
        "documentation": "http://art-institute-of-chicago.github.io/data-aggregator"
    },
    "config": {
        "iiif_url": "https://lakeimagesweb.artic.edu/iiif/2",
        "shop_image_url": "https://shop-images.imgix.net",
        "shop_product_url": "http://shop.artic.edu/item.aspx?productId=",
        "shop_category_url": "http://shop.artic.edu/item.aspx?productId="
    }
}
```
:::

#### `GET /events/search`

Search events data in the aggregator. 

##### Available parameters:

* `q` - Your search query
* `query` - For complex queries, you can pass Elasticsearch domain syntax queries here
* `sort` - Used in conjunction with `query`
* `from` - Starting point of results. Pagination via Elasticsearch conventions
* `size` - Number of results to return. Pagination via Elasticsearch conventions
* `facets` - A comma-separated list of 'count' aggregation facets to include in the results.

::: details Example request: https://api.artic.edu/api/v1/events/search
```js
{
    "preference": null,
    "pagination": {
        "total": 1980,
        "limit": 10,
        "offset": 0,
        "total_pages": 198,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "events",
            "api_link": "https://aggregator-data.artic.edu/api/v1/events/3401",
            "id": 3401,
            "title": "Gallery Talk: Conceptual and Minimal Art",
            "timestamp": "2020-07-30T05:07:34-05:00"
        },
        {
            "_score": 1,
            "api_model": "events",
            "api_link": "https://aggregator-data.artic.edu/api/v1/events/3402",
            "id": 3402,
            "title": "Gallery Talk: Trompe l\u2019oeil\u2014Tricks and Treats of the Eye",
            "timestamp": "2020-07-30T05:07:34-05:00"
        },
        {
            "_score": 1,
            "api_model": "events",
            "api_link": "https://aggregator-data.artic.edu/api/v1/events/3403",
            "id": 3403,
            "title": "Gallery Talk: Modern Portraits",
            "timestamp": "2020-07-30T05:07:34-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15"
    }
}
```
:::

#### `GET /events/{id}`

A single event by the given identifier.

::: details Example request: https://api.artic.edu/api/v1/events/4969?limit=2  
```js
{
    "data": {
        "id": 4969,
        "api_model": "events",
        "api_link": "https://api.artic.edu/api/v1/events/4969",
        "title": "Collecting through Six Generations: Weng Family Collection of Chinese Painting and Calligraphy",
        "title_display": null,
        "published": true,
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15",
        "documentation": "http://art-institute-of-chicago.github.io/data-aggregator"
    },
    "config": {
        "iiif_url": "https://lakeimagesweb.artic.edu/iiif/2",
        "shop_image_url": "https://shop-images.imgix.net",
        "shop_product_url": "http://shop.artic.edu/item.aspx?productId=",
        "shop_category_url": "http://shop.artic.edu/item.aspx?productId="
    }
}
```
:::

### Event Occurrences

_The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for "fair use" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials._

#### `GET /event-occurrences`

A list of all event-occurrences sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#event-occurrences).

##### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

::: details Example request: https://api.artic.edu/api/v1/event-occurrences?limit=2  
```js
{
    "pagination": {
        "total": 20,
        "limit": 2,
        "offset": 0,
        "total_pages": 10,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/event-occurrences?page=2&limit=2"
    },
    "data": [
        {
            "id": "0be59124-50ba-5d03-8b8e-629e36463954",
            "api_model": "event-occurrences",
            "api_link": "https://api.artic.edu/api/v1/event-occurrences/0be59124-50ba-5d03-8b8e-629e36463954",
            "title": "Gallery Talk: Highlights of the Art Institute",
            "event_id": 4086,
            "short_description": "Guided tour",
            ...
        },
        {
            "id": "6414774e-889a-5808-b003-982f5d2354b9",
            "api_model": "event-occurrences",
            "api_link": "https://api.artic.edu/api/v1/event-occurrences/6414774e-889a-5808-b003-982f5d2354b9",
            "title": "Gallery Talk: Highlights of the Art Institute",
            "event_id": 4086,
            "short_description": "Guided tour",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15",
        "documentation": "http://art-institute-of-chicago.github.io/data-aggregator"
    },
    "config": {
        "iiif_url": "https://lakeimagesweb.artic.edu/iiif/2",
        "shop_image_url": "https://shop-images.imgix.net",
        "shop_product_url": "http://shop.artic.edu/item.aspx?productId=",
        "shop_category_url": "http://shop.artic.edu/item.aspx?productId="
    }
}
```
:::

#### `GET /event-occurrences/search`

Search event-occurrences data in the aggregator. 

##### Available parameters:

* `q` - Your search query
* `query` - For complex queries, you can pass Elasticsearch domain syntax queries here
* `sort` - Used in conjunction with `query`
* `from` - Starting point of results. Pagination via Elasticsearch conventions
* `size` - Number of results to return. Pagination via Elasticsearch conventions
* `facets` - A comma-separated list of 'count' aggregation facets to include in the results.

::: details Example request: https://api.artic.edu/api/v1/event-occurrences/search
```js
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
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15"
    }
}
```
:::

#### `GET /event-occurrences/{id}`

A single event-occurrence by the given identifier.

::: details Example request: https://api.artic.edu/api/v1/event-occurrences/0be59124-50ba-5d03-8b8e-629e36463954?limit=2  
```js
{
    "data": {
        "id": "0be59124-50ba-5d03-8b8e-629e36463954",
        "api_model": "event-occurrences",
        "api_link": "https://api.artic.edu/api/v1/event-occurrences/0be59124-50ba-5d03-8b8e-629e36463954",
        "title": "Gallery Talk: Highlights of the Art Institute",
        "event_id": 4086,
        "short_description": "Guided tour",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15",
        "documentation": "http://art-institute-of-chicago.github.io/data-aggregator"
    },
    "config": {
        "iiif_url": "https://lakeimagesweb.artic.edu/iiif/2",
        "shop_image_url": "https://shop-images.imgix.net",
        "shop_product_url": "http://shop.artic.edu/item.aspx?productId=",
        "shop_category_url": "http://shop.artic.edu/item.aspx?productId="
    }
}
```
:::

### Event Programs

_The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for "fair use" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials._

#### `GET /event-programs`

A list of all event-programs sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#event-programs).

##### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

::: details Example request: https://api.artic.edu/api/v1/event-programs?limit=2  
```js
{
    "pagination": {
        "total": 66,
        "limit": 2,
        "offset": 0,
        "total_pages": 33,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/event-programs?page=2&limit=2"
    },
    "data": [
        {
            "id": 69,
            "api_model": "event-programs",
            "api_link": "https://api.artic.edu/api/v1/event-programs/69",
            "title": "Art Insights",
            "is_affiliate_group": false,
            "is_event_host": false,
            ...
        },
        {
            "id": 23,
            "api_model": "event-programs",
            "api_link": "https://api.artic.edu/api/v1/event-programs/23",
            "title": "Print and Drawing Club",
            "is_affiliate_group": false,
            "is_event_host": true,
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15",
        "documentation": "http://art-institute-of-chicago.github.io/data-aggregator"
    },
    "config": {
        "iiif_url": "https://lakeimagesweb.artic.edu/iiif/2",
        "shop_image_url": "https://shop-images.imgix.net",
        "shop_product_url": "http://shop.artic.edu/item.aspx?productId=",
        "shop_category_url": "http://shop.artic.edu/item.aspx?productId="
    }
}
```
:::

#### `GET /event-programs/search`

Search event-programs data in the aggregator. 

##### Available parameters:

* `q` - Your search query
* `query` - For complex queries, you can pass Elasticsearch domain syntax queries here
* `sort` - Used in conjunction with `query`
* `from` - Starting point of results. Pagination via Elasticsearch conventions
* `size` - Number of results to return. Pagination via Elasticsearch conventions
* `facets` - A comma-separated list of 'count' aggregation facets to include in the results.

::: details Example request: https://api.artic.edu/api/v1/event-programs/search
```js
{
    "preference": null,
    "pagination": {
        "total": 67,
        "limit": 10,
        "offset": 0,
        "total_pages": 7,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "event-programs",
            "api_link": "https://aggregator-data.artic.edu/api/v1/event-programs/1",
            "id": 1,
            "title": "Artist\u2019s Studio",
            "timestamp": "2020-07-30T05:07:42-05:00"
        },
        {
            "_score": 1,
            "api_model": "event-programs",
            "api_link": "https://aggregator-data.artic.edu/api/v1/event-programs/2",
            "id": 2,
            "title": "Family Festivals",
            "timestamp": "2020-07-30T05:07:42-05:00"
        },
        {
            "_score": 1,
            "api_model": "event-programs",
            "api_link": "https://aggregator-data.artic.edu/api/v1/event-programs/3",
            "id": 3,
            "title": "Picture This",
            "timestamp": "2020-07-30T05:07:42-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15"
    }
}
```
:::

#### `GET /event-programs/{id}`

A single event-program by the given identifier.

::: details Example request: https://api.artic.edu/api/v1/event-programs/69?limit=2  
```js
{
    "data": {
        "id": 69,
        "api_model": "event-programs",
        "api_link": "https://api.artic.edu/api/v1/event-programs/69",
        "title": "Art Insights",
        "is_affiliate_group": false,
        "is_event_host": false,
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15",
        "documentation": "http://art-institute-of-chicago.github.io/data-aggregator"
    },
    "config": {
        "iiif_url": "https://lakeimagesweb.artic.edu/iiif/2",
        "shop_image_url": "https://shop-images.imgix.net",
        "shop_product_url": "http://shop.artic.edu/item.aspx?productId=",
        "shop_category_url": "http://shop.artic.edu/item.aspx?productId="
    }
}
```
:::

### Articles

_The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for "fair use" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials._

#### `GET /articles`

A list of all articles sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#articles).

##### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

::: details Example request: https://api.artic.edu/api/v1/articles?limit=2  
```js
{
    "pagination": {
        "total": 257,
        "limit": 2,
        "offset": 0,
        "total_pages": 129,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/articles?page=2&limit=2"
    },
    "data": [
        {
            "id": 826,
            "api_model": "articles",
            "api_link": "https://api.artic.edu/api/v1/articles/826",
            "title": "caillebotte-and-seurat-setting-the-stage-for-masterworks",
            "is_published": false,
            "date": "2020-05-19T00:00:00-05:00",
            ...
        },
        {
            "id": 825,
            "api_model": "articles",
            "api_link": "https://api.artic.edu/api/v1/articles/825",
            "title": "the-traveling-conservator-visiting-malangatanas-studio-in-mozambique",
            "is_published": false,
            "date": "2020-05-12T00:00:00-05:00",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15",
        "documentation": "http://art-institute-of-chicago.github.io/data-aggregator"
    },
    "config": {
        "iiif_url": "https://lakeimagesweb.artic.edu/iiif/2",
        "shop_image_url": "https://shop-images.imgix.net",
        "shop_product_url": "http://shop.artic.edu/item.aspx?productId=",
        "shop_category_url": "http://shop.artic.edu/item.aspx?productId="
    }
}
```
:::

#### `GET /articles/search`

Search articles data in the aggregator. 

##### Available parameters:

* `q` - Your search query
* `query` - For complex queries, you can pass Elasticsearch domain syntax queries here
* `sort` - Used in conjunction with `query`
* `from` - Starting point of results. Pagination via Elasticsearch conventions
* `size` - Number of results to return. Pagination via Elasticsearch conventions
* `facets` - A comma-separated list of 'count' aggregation facets to include in the results.

::: details Example request: https://api.artic.edu/api/v1/articles/search
```js
{
    "preference": null,
    "pagination": {
        "total": 274,
        "limit": 10,
        "offset": 0,
        "total_pages": 28,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "articles",
            "api_link": "https://aggregator-data.artic.edu/api/v1/articles/14",
            "id": 14,
            "title": "secrets-of-the-modern-wing",
            "timestamp": "2020-07-30T05:07:42-05:00"
        },
        {
            "_score": 1,
            "api_model": "articles",
            "api_link": "https://aggregator-data.artic.edu/api/v1/articles/18",
            "id": 18,
            "title": "your-move",
            "timestamp": "2020-07-30T05:07:42-05:00"
        },
        {
            "_score": 1,
            "api_model": "articles",
            "api_link": "https://aggregator-data.artic.edu/api/v1/articles/26",
            "id": 26,
            "title": "secrets-of-the-modern-wing-take-two",
            "timestamp": "2020-07-30T05:07:42-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15"
    }
}
```
:::

#### `GET /articles/{id}`

A single article by the given identifier.

::: details Example request: https://api.artic.edu/api/v1/articles/823?limit=2  
```js
{
    "data": {
        "id": 823,
        "api_model": "articles",
        "api_link": "https://api.artic.edu/api/v1/articles/823",
        "title": "watch-this-art-and-artists-on-the-silver-screen",
        "is_published": true,
        "date": "2020-05-05T00:00:00-05:00",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15",
        "documentation": "http://art-institute-of-chicago.github.io/data-aggregator"
    },
    "config": {
        "iiif_url": "https://lakeimagesweb.artic.edu/iiif/2",
        "shop_image_url": "https://shop-images.imgix.net",
        "shop_product_url": "http://shop.artic.edu/item.aspx?productId=",
        "shop_category_url": "http://shop.artic.edu/item.aspx?productId="
    }
}
```
:::

### Selections

_The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for "fair use" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials._

#### `GET /selections`

A list of all selections sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#selections).

##### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

::: details Example request: https://api.artic.edu/api/v1/selections?limit=2  
```js
{
    "pagination": {
        "total": 15,
        "limit": 2,
        "offset": 0,
        "total_pages": 8,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/selections?page=2&limit=2"
    },
    "data": [
        {
            "id": 18,
            "api_model": "selections",
            "api_link": "https://api.artic.edu/api/v1/selections/18",
            "title": "malangatana-timeline",
            "published": false,
            "short_copy": null,
            ...
        },
        {
            "id": 9,
            "api_model": "selections",
            "api_link": "https://api.artic.edu/api/v1/selections/9",
            "title": "international-modern-art",
            "published": true,
            "short_copy": "<p>The Art Institute was the first museum in the United States to assemble a significant collection of modern art and to put it on permanent display. Today these holdings are among the finest in the world\u2014enjoy highlights from this pioneering collection.</p>",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15",
        "documentation": "http://art-institute-of-chicago.github.io/data-aggregator"
    },
    "config": {
        "iiif_url": "https://lakeimagesweb.artic.edu/iiif/2",
        "shop_image_url": "https://shop-images.imgix.net",
        "shop_product_url": "http://shop.artic.edu/item.aspx?productId=",
        "shop_category_url": "http://shop.artic.edu/item.aspx?productId="
    }
}
```
:::

#### `GET /selections/search`

Search selections data in the aggregator. 

##### Available parameters:

* `q` - Your search query
* `query` - For complex queries, you can pass Elasticsearch domain syntax queries here
* `sort` - Used in conjunction with `query`
* `from` - Starting point of results. Pagination via Elasticsearch conventions
* `size` - Number of results to return. Pagination via Elasticsearch conventions
* `facets` - A comma-separated list of 'count' aggregation facets to include in the results.

::: details Example request: https://api.artic.edu/api/v1/selections/search
```js
{
    "preference": null,
    "pagination": {
        "total": 17,
        "limit": 10,
        "offset": 0,
        "total_pages": 2,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "selections",
            "api_link": "https://aggregator-data.artic.edu/api/v1/selections/3",
            "id": 3,
            "title": "what-to-see-in-an-hour",
            "timestamp": "2020-07-30T05:07:43-05:00"
        },
        {
            "_score": 1,
            "api_model": "selections",
            "api_link": "https://aggregator-data.artic.edu/api/v1/selections/4",
            "id": 4,
            "title": "new-acquisitions",
            "timestamp": "2020-07-30T05:07:43-05:00"
        },
        {
            "_score": 1,
            "api_model": "selections",
            "api_link": "https://aggregator-data.artic.edu/api/v1/selections/5",
            "id": 5,
            "title": "impressionism",
            "timestamp": "2020-07-30T05:07:43-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15"
    }
}
```
:::

#### `GET /selections/{id}`

A single selection by the given identifier.

::: details Example request: https://api.artic.edu/api/v1/selections/9?limit=2  
```js
{
    "data": {
        "id": 9,
        "api_model": "selections",
        "api_link": "https://api.artic.edu/api/v1/selections/9",
        "title": "international-modern-art",
        "published": true,
        "short_copy": "<p>The Art Institute was the first museum in the United States to assemble a significant collection of modern art and to put it on permanent display. Today these holdings are among the finest in the world\u2014enjoy highlights from this pioneering collection.</p>",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15",
        "documentation": "http://art-institute-of-chicago.github.io/data-aggregator"
    },
    "config": {
        "iiif_url": "https://lakeimagesweb.artic.edu/iiif/2",
        "shop_image_url": "https://shop-images.imgix.net",
        "shop_product_url": "http://shop.artic.edu/item.aspx?productId=",
        "shop_category_url": "http://shop.artic.edu/item.aspx?productId="
    }
}
```
:::

### Web Artists

_The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for "fair use" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials._

#### `GET /web-artists`

A list of all web-artists sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#web-artists).

##### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

::: details Example request: https://api.artic.edu/api/v1/web-artists?limit=2  
```js
{
    "pagination": {
        "total": 78,
        "limit": 2,
        "offset": 0,
        "total_pages": 39,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/web-artists?page=2&limit=2"
    },
    "data": [
        {
            "id": 82,
            "api_model": "web-artists",
            "api_link": "https://api.artic.edu/api/v1/web-artists/82",
            "title": "Lenore Tawney",
            "has_also_known_as": null,
            "intro_copy": "<p>\u201cTo see new and original expression in a very old medium, and not just one new form but a complete new form in each piece of work, is wholly unlooked for, and is a wonderful and gratifying experience.\u201d&nbsp;</p><p>\u2013 Artist Agnes Martin on Lenore Tawney, 1961</p><p>A major figure in the fiber movement of the 1950s and 1960s, Lenore Tawney redefined the possibilities of weaving and led the way toward the explosive growth of fiber art in subsequent decades.&nbsp; She created a new vocabulary for textile works by subverting the typical woven grid and inventing new ways of weaving beyond the traditional boundaries of the loom. In order to emphasize the sculptural qualities of her works, Tawney maintained that they hang in space rather than against the wall.</p><p>Born in Lorain, Ohio, in 1907, Tawney moved to Chicago at the age of twenty and supported herself by working as a proofreader for a legal publishing company. After 15 of years living and working in the city, she began taking classes at the Art Institute as well as Chicago\u2019s Institute of Design (formerly the New Bauhaus). At the ID, Tawney studied sculpture with Alexander Archipenko and weaving with Marli Ehrman, an alumna of the innovative weaving workshop at the Bauhaus school of art in Germany. Tawney bought her first loom when she was 41 and devoted herself wholly to weaving at the age of 47.</p><p>In 1957 Tawney set out for New York City, where she established a studio among a community of artists that included <a href=\"https://www.artic.edu/artists/35235/ellsworth-kelly\" target=\"_blank\">Ellsworth Kelly</a>, <a href=\"https://www.artic.edu/artists/29405/jack-youngerman\" target=\"_blank\">Jack Youngerman</a>, <a href=\"https://www.artic.edu/artists/35058/robert-indiana\" target=\"_blank\">Robert Indiana</a>, and <a href=\"https://www.artic.edu/artists/16367/agnes-martin\" target=\"_blank\">Agnes Martin</a>. As her career progressed, Tawney worked on an increasingly large scale, making fiber works up to 20 feet in height. These monumental works include <a href=\"https://www.artic.edu/artworks/149413/the-bride-has-entered\" target=\"_blank\"><em>The Bride has Entered</em></a> and the striking tapestry <a href=\"https://www.artic.edu/artworks/109686/waters-above-the-firmament\" target=\"_blank\"><em>Waters Above the Firmament</em></a>. Throughout her career, she also created intimately scaled <a href=\"https://www.artic.edu/collection?artist_ids=Lenore%20Tawney&amp;material_ids=paper%20%28fiber%20product%29\" target=\"_blank\">drawings and collages</a>, often in the form of <a href=\"https://www.artic.edu/artworks/250895/envelope-and-collage\" target=\"_blank\">postcards</a> she would <a href=\"https://www.artic.edu/artworks/250860/portrait-collage-postcard\" target=\"_blank\">mail to friends</a>. Tawney's dedication to spirituality and meditation greatly influenced her work and her choice of subject matter. When her vision gradually failed in the 1990s, she continued making art with the aid of an assistant.</p><p>The Art Institute of Chicago has highlighted Tawney\u2019s groundbreaking fiber art in two solo exhibitions: <a href=\"https://www.artic.edu/exhibitions/7782/lenore-tawney-a-retrospective\" target=\"_blank\"><em>Lenore Tawney: A Retrospective</em></a> (1990) and <em>Woven Forms by Lenore Tawney</em> (1962). Her work has also been included in larger exhibitions such as the 2019 show <a href=\"https://www.artic.edu/exhibitions/9251/weaving-beyond-the-bauhaus\" target=\"_blank\"><em>Weaving beyond the Bauhaus</em></a>. </p>",
            ...
        },
        {
            "id": 75,
            "api_model": "web-artists",
            "api_link": "https://api.artic.edu/api/v1/web-artists/75",
            "title": "Bruce Alonzo Goff",
            "has_also_known_as": null,
            "intro_copy": "<p>Visionary American architect Bruce Goff embraced daring sculptural forms, eclectic and unconventional materials, and innovative spatial relationships to imagine new ideals for modern living. Over the course of a six-decade career that began at the age of 12 with an architectural apprenticeship in Tulsa, Oklahoma, Goff designed over 500 projects and many built works in the Great Plains, Midwest, and western United States. Goff was influenced by principles of organic design championed by Louis Sullivan and <a href=\"https://www.artic.edu/artworks/140496/house-study-aerial-perspective\" target=\"_blank\">Frank Lloyd Wright</a>, along with the Expressionist forms of the European avant-garde, like German architect <a href=\"https://www.artic.edu/artworks/241766/hypothetical-studies-1931-design-drawings\" target=\"_blank\">Erich Mendelsohn</a>. Working largely for individual clients, Goff conjured adventurous and livable designs for single-family homes that challenged the conventional, builder-spec developments that dominated the suburban built environment in postwar America.</p><p>Goff moved to Chicago in 1934 where he founded a small private practice in the Rogers Park neighborhood and worked with sculptor Alfonso Iannelli and the Libbey-Owens-Ford Glass Company while developing his creative interests in <a href=\"https://digital-libraries.artic.edu/digital/collection/mqc/id/341/rec/1\" target=\"_blank\">music</a> and <a href=\"https://www.artic.edu/artworks/130775/composition\" target=\"_blank\">painting</a> during the Great Depression. A number of important projects emerged from his Chicago studio, including the pioneering <a href=\"https://www.artic.edu/artworks/205312/ford-ruth-and-sam-house-number-1-elevation-showing-wall\" target=\"_blank\">Ruth Ford House</a>, in Aurora, Illinois, in 1947.&nbsp;</p><p>After serving in the US Navy during WWII, stationed in Alaska and the Bay Area, Goff returned to Oklahoma to teach and practice, developing a vision for architecture that blended his unique approach to materials and decoration with an approach to design that is at once modern, futurist, and deeply rooted in the context of the south central United States. Goff served as the chairman of the School of Architecture at the University of Oklahoma in Norman from 1947 to 1955, founding what is now known as the \u201cAmerican School of Architecture,\u201d and had strong influences on a generation of architects in Oklahoma and beyond.</p><p>In 1995, the Art Institute of Chicago mounted a <a href=\"https://www.artic.edu/exhibitions/8128/the-architecture-of-bruce-goff-design-for-the-continuous-present\" target=\"_blank\">major retrospective exhibition</a> of his work, with an <a href=\"https://artic-primo.hosted.exlibrisgroup.com/primo-explore/fulldisplay?docid=01ARTIC_ALMA2127083460003801&amp;context=L&amp;vid=01ARTIC&amp;search_scope=everything&amp;tab=default_tab&amp;lang=en_US\" target=\"_blank\">accompanying catalogue</a>, <em>The Architecture of Bruce Goff, 1904\u20131982: Design for the Continuous Present.</em> The museum holds the comprehensive repository for Goff\u2019s architectural drawings, paintings, and <a href=\"https://www.artic.edu/archival-collections/digital-publications/bruce-goff-archives\" target=\"_blank\">professional and personal papers</a>, gifted through the Shin\u2019enKan Foundation in 1990.</p><p>Watch the <a href=\"https://m.youtube.com/watch?v=W2xJJv8KOEw&amp;t=42s\" target=\"_blank\">video, \u201cBruce Goff: Ford House.\u201d</a>&nbsp;</p>",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15",
        "documentation": "http://art-institute-of-chicago.github.io/data-aggregator"
    },
    "config": {
        "iiif_url": "https://lakeimagesweb.artic.edu/iiif/2",
        "shop_image_url": "https://shop-images.imgix.net",
        "shop_product_url": "http://shop.artic.edu/item.aspx?productId=",
        "shop_category_url": "http://shop.artic.edu/item.aspx?productId="
    }
}
```
:::

#### `GET /web-artists/search`

Search web-artists data in the aggregator. 

##### Available parameters:

* `q` - Your search query
* `query` - For complex queries, you can pass Elasticsearch domain syntax queries here
* `sort` - Used in conjunction with `query`
* `from` - Starting point of results. Pagination via Elasticsearch conventions
* `size` - Number of results to return. Pagination via Elasticsearch conventions
* `facets` - A comma-separated list of 'count' aggregation facets to include in the results.

::: details Example request: https://api.artic.edu/api/v1/web-artists/search
```js
{
    "preference": null,
    "pagination": {
        "total": 97,
        "limit": 10,
        "offset": 0,
        "total_pages": 10,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "web-artists",
            "api_link": "https://aggregator-data.artic.edu/api/v1/web-artists/1",
            "id": 1,
            "title": "Winslow Homer",
            "timestamp": "2020-07-30T05:07:43-05:00"
        },
        {
            "_score": 1,
            "api_model": "web-artists",
            "api_link": "https://aggregator-data.artic.edu/api/v1/web-artists/2",
            "id": 2,
            "title": "Don A. DuBroff",
            "timestamp": "2020-07-30T05:07:43-05:00"
        },
        {
            "_score": 1,
            "api_model": "web-artists",
            "api_link": "https://aggregator-data.artic.edu/api/v1/web-artists/3",
            "id": 3,
            "title": "Neue Galerie New York",
            "timestamp": "2020-07-30T05:07:43-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15"
    }
}
```
:::

#### `GET /web-artists/{id}`

A single web-artist by the given identifier.

::: details Example request: https://api.artic.edu/api/v1/web-artists/82?limit=2  
```js
{
    "data": {
        "id": 82,
        "api_model": "web-artists",
        "api_link": "https://api.artic.edu/api/v1/web-artists/82",
        "title": "Lenore Tawney",
        "has_also_known_as": null,
        "intro_copy": "<p>\u201cTo see new and original expression in a very old medium, and not just one new form but a complete new form in each piece of work, is wholly unlooked for, and is a wonderful and gratifying experience.\u201d&nbsp;</p><p>\u2013 Artist Agnes Martin on Lenore Tawney, 1961</p><p>A major figure in the fiber movement of the 1950s and 1960s, Lenore Tawney redefined the possibilities of weaving and led the way toward the explosive growth of fiber art in subsequent decades.&nbsp; She created a new vocabulary for textile works by subverting the typical woven grid and inventing new ways of weaving beyond the traditional boundaries of the loom. In order to emphasize the sculptural qualities of her works, Tawney maintained that they hang in space rather than against the wall.</p><p>Born in Lorain, Ohio, in 1907, Tawney moved to Chicago at the age of twenty and supported herself by working as a proofreader for a legal publishing company. After 15 of years living and working in the city, she began taking classes at the Art Institute as well as Chicago\u2019s Institute of Design (formerly the New Bauhaus). At the ID, Tawney studied sculpture with Alexander Archipenko and weaving with Marli Ehrman, an alumna of the innovative weaving workshop at the Bauhaus school of art in Germany. Tawney bought her first loom when she was 41 and devoted herself wholly to weaving at the age of 47.</p><p>In 1957 Tawney set out for New York City, where she established a studio among a community of artists that included <a href=\"https://www.artic.edu/artists/35235/ellsworth-kelly\" target=\"_blank\">Ellsworth Kelly</a>, <a href=\"https://www.artic.edu/artists/29405/jack-youngerman\" target=\"_blank\">Jack Youngerman</a>, <a href=\"https://www.artic.edu/artists/35058/robert-indiana\" target=\"_blank\">Robert Indiana</a>, and <a href=\"https://www.artic.edu/artists/16367/agnes-martin\" target=\"_blank\">Agnes Martin</a>. As her career progressed, Tawney worked on an increasingly large scale, making fiber works up to 20 feet in height. These monumental works include <a href=\"https://www.artic.edu/artworks/149413/the-bride-has-entered\" target=\"_blank\"><em>The Bride has Entered</em></a> and the striking tapestry <a href=\"https://www.artic.edu/artworks/109686/waters-above-the-firmament\" target=\"_blank\"><em>Waters Above the Firmament</em></a>. Throughout her career, she also created intimately scaled <a href=\"https://www.artic.edu/collection?artist_ids=Lenore%20Tawney&amp;material_ids=paper%20%28fiber%20product%29\" target=\"_blank\">drawings and collages</a>, often in the form of <a href=\"https://www.artic.edu/artworks/250895/envelope-and-collage\" target=\"_blank\">postcards</a> she would <a href=\"https://www.artic.edu/artworks/250860/portrait-collage-postcard\" target=\"_blank\">mail to friends</a>. Tawney's dedication to spirituality and meditation greatly influenced her work and her choice of subject matter. When her vision gradually failed in the 1990s, she continued making art with the aid of an assistant.</p><p>The Art Institute of Chicago has highlighted Tawney\u2019s groundbreaking fiber art in two solo exhibitions: <a href=\"https://www.artic.edu/exhibitions/7782/lenore-tawney-a-retrospective\" target=\"_blank\"><em>Lenore Tawney: A Retrospective</em></a> (1990) and <em>Woven Forms by Lenore Tawney</em> (1962). Her work has also been included in larger exhibitions such as the 2019 show <a href=\"https://www.artic.edu/exhibitions/9251/weaving-beyond-the-bauhaus\" target=\"_blank\"><em>Weaving beyond the Bauhaus</em></a>. </p>",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15",
        "documentation": "http://art-institute-of-chicago.github.io/data-aggregator"
    },
    "config": {
        "iiif_url": "https://lakeimagesweb.artic.edu/iiif/2",
        "shop_image_url": "https://shop-images.imgix.net",
        "shop_product_url": "http://shop.artic.edu/item.aspx?productId=",
        "shop_category_url": "http://shop.artic.edu/item.aspx?productId="
    }
}
```
:::

### Static Pages

_The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for "fair use" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials._

#### `GET /static-pages`

A list of all static-pages sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#static-pages).

##### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

::: details Example request: https://api.artic.edu/api/v1/static-pages?limit=2  
```js
{
    "pagination": {
        "total": 11,
        "limit": 2,
        "offset": 0,
        "total_pages": 6,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/static-pages?page=2&limit=2"
    },
    "data": [
        {
            "id": 1,
            "api_model": "static-pages",
            "api_link": "https://api.artic.edu/api/v1/static-pages/1",
            "title": "Visit",
            "web_url": "/visit",
            "is_published": true,
            ...
        },
        {
            "id": 2,
            "api_model": "static-pages",
            "api_link": "https://api.artic.edu/api/v1/static-pages/2",
            "title": "Events",
            "web_url": "/events",
            "is_published": true,
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15",
        "documentation": "http://art-institute-of-chicago.github.io/data-aggregator"
    },
    "config": {
        "iiif_url": "https://lakeimagesweb.artic.edu/iiif/2",
        "shop_image_url": "https://shop-images.imgix.net",
        "shop_product_url": "http://shop.artic.edu/item.aspx?productId=",
        "shop_category_url": "http://shop.artic.edu/item.aspx?productId="
    }
}
```
:::

#### `GET /static-pages/search`

Search static-pages data in the aggregator. 

##### Available parameters:

* `q` - Your search query
* `query` - For complex queries, you can pass Elasticsearch domain syntax queries here
* `sort` - Used in conjunction with `query`
* `from` - Starting point of results. Pagination via Elasticsearch conventions
* `size` - Number of results to return. Pagination via Elasticsearch conventions
* `facets` - A comma-separated list of 'count' aggregation facets to include in the results.

::: details Example request: https://api.artic.edu/api/v1/static-pages/search
```js
{
    "preference": null,
    "pagination": {
        "total": 11,
        "limit": 10,
        "offset": 0,
        "total_pages": 2,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "static-pages",
            "api_link": "https://api.artic.edu/api/v1/static-pages/1",
            "id": 1,
            "title": "Visit",
            "timestamp": "2020-07-30T20:05:13-05:00"
        },
        {
            "_score": 1,
            "api_model": "static-pages",
            "api_link": "https://api.artic.edu/api/v1/static-pages/2",
            "id": 2,
            "title": "Events",
            "timestamp": "2020-07-30T20:05:13-05:00"
        },
        {
            "_score": 1,
            "api_model": "static-pages",
            "api_link": "https://api.artic.edu/api/v1/static-pages/3",
            "id": 3,
            "title": "Exhibitions",
            "timestamp": "2020-07-30T20:05:13-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15"
    }
}
```
:::

#### `GET /static-pages/{id}`

A single static-page by the given identifier.

::: details Example request: https://api.artic.edu/api/v1/static-pages/1?limit=2  
```js
{
    "data": {
        "id": 1,
        "api_model": "static-pages",
        "api_link": "https://api.artic.edu/api/v1/static-pages/1",
        "title": "Visit",
        "web_url": "/visit",
        "is_published": true,
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15",
        "documentation": "http://art-institute-of-chicago.github.io/data-aggregator"
    },
    "config": {
        "iiif_url": "https://lakeimagesweb.artic.edu/iiif/2",
        "shop_image_url": "https://shop-images.imgix.net",
        "shop_product_url": "http://shop.artic.edu/item.aspx?productId=",
        "shop_category_url": "http://shop.artic.edu/item.aspx?productId="
    }
}
```
:::

### Generic Pages

_The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for "fair use" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials._

#### `GET /generic-pages`

A list of all generic-pages sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#generic-pages).

##### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

::: details Example request: https://api.artic.edu/api/v1/generic-pages?limit=2  
```js
{
    "pagination": {
        "total": 257,
        "limit": 2,
        "offset": 0,
        "total_pages": 129,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/generic-pages?page=2&limit=2"
    },
    "data": [
        {
            "id": 442,
            "api_model": "generic-pages",
            "api_link": "https://api.artic.edu/api/v1/generic-pages/442",
            "title": "Crossword Puzzle",
            "is_published": true,
            "type": null,
            ...
        },
        {
            "id": 417,
            "api_model": "generic-pages",
            "api_link": "https://api.artic.edu/api/v1/generic-pages/417",
            "title": "Instagram",
            "is_published": true,
            "type": null,
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15",
        "documentation": "http://art-institute-of-chicago.github.io/data-aggregator"
    },
    "config": {
        "iiif_url": "https://lakeimagesweb.artic.edu/iiif/2",
        "shop_image_url": "https://shop-images.imgix.net",
        "shop_product_url": "http://shop.artic.edu/item.aspx?productId=",
        "shop_category_url": "http://shop.artic.edu/item.aspx?productId="
    }
}
```
:::

#### `GET /generic-pages/search`

Search generic-pages data in the aggregator. 

##### Available parameters:

* `q` - Your search query
* `query` - For complex queries, you can pass Elasticsearch domain syntax queries here
* `sort` - Used in conjunction with `query`
* `from` - Starting point of results. Pagination via Elasticsearch conventions
* `size` - Number of results to return. Pagination via Elasticsearch conventions
* `facets` - A comma-separated list of 'count' aggregation facets to include in the results.

::: details Example request: https://api.artic.edu/api/v1/generic-pages/search
```js
{
    "preference": null,
    "pagination": {
        "total": 236,
        "limit": 10,
        "offset": 0,
        "total_pages": 24,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "generic-pages",
            "api_link": "https://aggregator-data.artic.edu/api/v1/generic-pages/1",
            "id": 1,
            "title": "Visit",
            "timestamp": "2020-07-30T05:07:44-05:00"
        },
        {
            "_score": 1,
            "api_model": "generic-pages",
            "api_link": "https://aggregator-data.artic.edu/api/v1/generic-pages/2",
            "id": 2,
            "title": "Free Admission Opportunities",
            "timestamp": "2020-07-30T05:07:44-05:00"
        },
        {
            "_score": 1,
            "api_model": "generic-pages",
            "api_link": "https://aggregator-data.artic.edu/api/v1/generic-pages/4",
            "id": 4,
            "title": "Directions & Parking",
            "timestamp": "2020-07-30T05:07:44-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15"
    }
}
```
:::

#### `GET /generic-pages/{id}`

A single generic-page by the given identifier.

::: details Example request: https://api.artic.edu/api/v1/generic-pages/442?limit=2  
```js
{
    "data": {
        "id": 442,
        "api_model": "generic-pages",
        "api_link": "https://api.artic.edu/api/v1/generic-pages/442",
        "title": "Crossword Puzzle",
        "is_published": true,
        "type": null,
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15",
        "documentation": "http://art-institute-of-chicago.github.io/data-aggregator"
    },
    "config": {
        "iiif_url": "https://lakeimagesweb.artic.edu/iiif/2",
        "shop_image_url": "https://shop-images.imgix.net",
        "shop_product_url": "http://shop.artic.edu/item.aspx?productId=",
        "shop_category_url": "http://shop.artic.edu/item.aspx?productId="
    }
}
```
:::

### Press Releases

_The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for "fair use" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials._

#### `GET /press-releases`

A list of all press-releases sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#press-releases).

##### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

::: details Example request: https://api.artic.edu/api/v1/press-releases?limit=2  
```js
{
    "pagination": {
        "total": 273,
        "limit": 2,
        "offset": 0,
        "total_pages": 137,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/press-releases?page=2&limit=2"
    },
    "data": [
        {
            "id": 288,
            "api_model": "press-releases",
            "api_link": "https://api.artic.edu/api/v1/press-releases/288",
            "title": "Fabricating Fashion: Textiles for Dress, 1700-1850",
            "is_published": true,
            "type": null,
            ...
        },
        {
            "id": 287,
            "api_model": "press-releases",
            "api_link": "https://api.artic.edu/api/v1/press-releases/287",
            "title": "Malangatana: Mozambique Modern",
            "is_published": true,
            "type": null,
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15",
        "documentation": "http://art-institute-of-chicago.github.io/data-aggregator"
    },
    "config": {
        "iiif_url": "https://lakeimagesweb.artic.edu/iiif/2",
        "shop_image_url": "https://shop-images.imgix.net",
        "shop_product_url": "http://shop.artic.edu/item.aspx?productId=",
        "shop_category_url": "http://shop.artic.edu/item.aspx?productId="
    }
}
```
:::

#### `GET /press-releases/search`

Search press-releases data in the aggregator. 

##### Available parameters:

* `q` - Your search query
* `query` - For complex queries, you can pass Elasticsearch domain syntax queries here
* `sort` - Used in conjunction with `query`
* `from` - Starting point of results. Pagination via Elasticsearch conventions
* `size` - Number of results to return. Pagination via Elasticsearch conventions
* `facets` - A comma-separated list of 'count' aggregation facets to include in the results.

::: details Example request: https://api.artic.edu/api/v1/press-releases/search
```js
{
    "preference": null,
    "pagination": {
        "total": 248,
        "limit": 10,
        "offset": 0,
        "total_pages": 25,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "press-releases",
            "api_link": "https://aggregator-data.artic.edu/api/v1/press-releases/1",
            "id": 1,
            "title": "Press Releases from 1939",
            "timestamp": "2020-07-30T05:07:44-05:00"
        },
        {
            "_score": 1,
            "api_model": "press-releases",
            "api_link": "https://aggregator-data.artic.edu/api/v1/press-releases/2",
            "id": 2,
            "title": "Press Releases from 1940",
            "timestamp": "2020-07-30T05:07:44-05:00"
        },
        {
            "_score": 1,
            "api_model": "press-releases",
            "api_link": "https://aggregator-data.artic.edu/api/v1/press-releases/3",
            "id": 3,
            "title": "Press Releases from 1941",
            "timestamp": "2020-07-30T05:07:44-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15"
    }
}
```
:::

#### `GET /press-releases/{id}`

A single press-release by the given identifier.

::: details Example request: https://api.artic.edu/api/v1/press-releases/288?limit=2  
```js
{
    "data": {
        "id": 288,
        "api_model": "press-releases",
        "api_link": "https://api.artic.edu/api/v1/press-releases/288",
        "title": "Fabricating Fashion: Textiles for Dress, 1700-1850",
        "is_published": true,
        "type": null,
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15",
        "documentation": "http://art-institute-of-chicago.github.io/data-aggregator"
    },
    "config": {
        "iiif_url": "https://lakeimagesweb.artic.edu/iiif/2",
        "shop_image_url": "https://shop-images.imgix.net",
        "shop_product_url": "http://shop.artic.edu/item.aspx?productId=",
        "shop_category_url": "http://shop.artic.edu/item.aspx?productId="
    }
}
```
:::

### Educator Resources

_The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for "fair use" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials._

#### `GET /educator-resources`

A list of all educator-resources sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#educator-resources).

##### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

::: details Example request: https://api.artic.edu/api/v1/educator-resources?limit=2  
```js
{
    "pagination": {
        "total": 102,
        "limit": 2,
        "offset": 0,
        "total_pages": 51,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/educator-resources?page=2&limit=2"
    },
    "data": [
        {
            "id": 7,
            "api_model": "educator-resources",
            "api_link": "https://api.artic.edu/api/v1/educator-resources/7",
            "title": "Thematic Curricula: Art + Science",
            "is_published": true,
            "type": null,
            ...
        },
        {
            "id": 19,
            "api_model": "educator-resources",
            "api_link": "https://api.artic.edu/api/v1/educator-resources/19",
            "title": "Educator Resource Packet: Dancing Ganesha",
            "is_published": false,
            "type": null,
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15",
        "documentation": "http://art-institute-of-chicago.github.io/data-aggregator"
    },
    "config": {
        "iiif_url": "https://lakeimagesweb.artic.edu/iiif/2",
        "shop_image_url": "https://shop-images.imgix.net",
        "shop_product_url": "http://shop.artic.edu/item.aspx?productId=",
        "shop_category_url": "http://shop.artic.edu/item.aspx?productId="
    }
}
```
:::

#### `GET /educator-resources/search`

Search educator-resources data in the aggregator. 

##### Available parameters:

* `q` - Your search query
* `query` - For complex queries, you can pass Elasticsearch domain syntax queries here
* `sort` - Used in conjunction with `query`
* `from` - Starting point of results. Pagination via Elasticsearch conventions
* `size` - Number of results to return. Pagination via Elasticsearch conventions
* `facets` - A comma-separated list of 'count' aggregation facets to include in the results.

::: details Example request: https://api.artic.edu/api/v1/educator-resources/search
```js
{
    "preference": null,
    "pagination": {
        "total": 108,
        "limit": 10,
        "offset": 0,
        "total_pages": 11,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "educator-resources",
            "api_link": "https://aggregator-data.artic.edu/api/v1/educator-resources/2",
            "id": 2,
            "title": "Test Resource",
            "timestamp": "2020-07-30T05:07:45-05:00"
        },
        {
            "_score": 1,
            "api_model": "educator-resources",
            "api_link": "https://aggregator-data.artic.edu/api/v1/educator-resources/3",
            "id": 3,
            "title": "Activity: Arrival of the Normandy Train, Gare Saint-Lazare",
            "timestamp": "2020-07-30T05:07:45-05:00"
        },
        {
            "_score": 1,
            "api_model": "educator-resources",
            "api_link": "https://aggregator-data.artic.edu/api/v1/educator-resources/4",
            "id": 4,
            "title": "Activity: The Family Concert",
            "timestamp": "2020-07-30T05:07:45-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15"
    }
}
```
:::

#### `GET /educator-resources/{id}`

A single educator-resource by the given identifier.

::: details Example request: https://api.artic.edu/api/v1/educator-resources/7?limit=2  
```js
{
    "data": {
        "id": 7,
        "api_model": "educator-resources",
        "api_link": "https://api.artic.edu/api/v1/educator-resources/7",
        "title": "Thematic Curricula: Art + Science",
        "is_published": true,
        "type": null,
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15",
        "documentation": "http://art-institute-of-chicago.github.io/data-aggregator"
    },
    "config": {
        "iiif_url": "https://lakeimagesweb.artic.edu/iiif/2",
        "shop_image_url": "https://shop-images.imgix.net",
        "shop_product_url": "http://shop.artic.edu/item.aspx?productId=",
        "shop_category_url": "http://shop.artic.edu/item.aspx?productId="
    }
}
```
:::

### Digital Catalogs

_The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for "fair use" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials._

#### `GET /digital-catalogs`

A list of all digital-catalogs sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#digital-catalogs).

##### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

::: details Example request: https://api.artic.edu/api/v1/digital-catalogs?limit=2  
```js
{
    "pagination": {
        "total": 14,
        "limit": 2,
        "offset": 0,
        "total_pages": 7,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/digital-catalogs?page=2&limit=2"
    },
    "data": [
        {
            "id": 31,
            "api_model": "digital-catalogs",
            "api_link": "https://api.artic.edu/api/v1/digital-catalogs/31",
            "title": "Matisse Paintings, Works on Paper, Sculpture, and Textiles at the Art Institute of Chicago",
            "is_published": true,
            "type": null,
            ...
        },
        {
            "id": 30,
            "api_model": "digital-catalogs",
            "api_link": "https://api.artic.edu/api/v1/digital-catalogs/30",
            "title": "Ivan Albright Paintings at the Art Institute of Chicago",
            "is_published": true,
            "type": null,
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15",
        "documentation": "http://art-institute-of-chicago.github.io/data-aggregator"
    },
    "config": {
        "iiif_url": "https://lakeimagesweb.artic.edu/iiif/2",
        "shop_image_url": "https://shop-images.imgix.net",
        "shop_product_url": "http://shop.artic.edu/item.aspx?productId=",
        "shop_category_url": "http://shop.artic.edu/item.aspx?productId="
    }
}
```
:::

#### `GET /digital-catalogs/search`

Search digital-catalogs data in the aggregator. 

##### Available parameters:

* `q` - Your search query
* `query` - For complex queries, you can pass Elasticsearch domain syntax queries here
* `sort` - Used in conjunction with `query`
* `from` - Starting point of results. Pagination via Elasticsearch conventions
* `size` - Number of results to return. Pagination via Elasticsearch conventions
* `facets` - A comma-separated list of 'count' aggregation facets to include in the results.

::: details Example request: https://api.artic.edu/api/v1/digital-catalogs/search
```js
{
    "preference": null,
    "pagination": {
        "total": 14,
        "limit": 10,
        "offset": 0,
        "total_pages": 2,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "digital-catalogs",
            "api_link": "https://aggregator-data.artic.edu/api/v1/digital-catalogs/2",
            "id": 2,
            "title": "American Silver",
            "timestamp": "2020-07-30T05:07:46-05:00"
        },
        {
            "_score": 1,
            "api_model": "digital-catalogs",
            "api_link": "https://aggregator-data.artic.edu/api/v1/digital-catalogs/3",
            "id": 3,
            "title": "Modern Series: Go",
            "timestamp": "2020-07-30T05:07:46-05:00"
        },
        {
            "_score": 1,
            "api_model": "digital-catalogs",
            "api_link": "https://aggregator-data.artic.edu/api/v1/digital-catalogs/4",
            "id": 4,
            "title": "Manet Paintings and Works on Paper at the Art Institute of Chicago",
            "timestamp": "2020-07-30T05:07:46-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15"
    }
}
```
:::

#### `GET /digital-catalogs/{id}`

A single digital-catalog by the given identifier.

::: details Example request: https://api.artic.edu/api/v1/digital-catalogs/31?limit=2  
```js
{
    "data": {
        "id": 31,
        "api_model": "digital-catalogs",
        "api_link": "https://api.artic.edu/api/v1/digital-catalogs/31",
        "title": "Matisse Paintings, Works on Paper, Sculpture, and Textiles at the Art Institute of Chicago",
        "is_published": true,
        "type": null,
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15",
        "documentation": "http://art-institute-of-chicago.github.io/data-aggregator"
    },
    "config": {
        "iiif_url": "https://lakeimagesweb.artic.edu/iiif/2",
        "shop_image_url": "https://shop-images.imgix.net",
        "shop_product_url": "http://shop.artic.edu/item.aspx?productId=",
        "shop_category_url": "http://shop.artic.edu/item.aspx?productId="
    }
}
```
:::

### Printed Catalogs

_The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for "fair use" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials._

#### `GET /printed-catalogs`

A list of all printed-catalogs sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#printed-catalogs).

##### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

::: details Example request: https://api.artic.edu/api/v1/printed-catalogs?limit=2  
```js
{
    "pagination": {
        "total": 180,
        "limit": 2,
        "offset": 0,
        "total_pages": 90,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/printed-catalogs?page=2&limit=2"
    },
    "data": [
        {
            "id": 195,
            "api_model": "printed-catalogs",
            "api_link": "https://api.artic.edu/api/v1/printed-catalogs/195",
            "title": "Monet and Chicago",
            "is_published": false,
            "type": null,
            ...
        },
        {
            "id": 193,
            "api_model": "printed-catalogs",
            "api_link": "https://api.artic.edu/api/v1/printed-catalogs/193",
            "title": "Material Meanings: Selections from the Constance R. Caplan Collection",
            "is_published": true,
            "type": null,
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15",
        "documentation": "http://art-institute-of-chicago.github.io/data-aggregator"
    },
    "config": {
        "iiif_url": "https://lakeimagesweb.artic.edu/iiif/2",
        "shop_image_url": "https://shop-images.imgix.net",
        "shop_product_url": "http://shop.artic.edu/item.aspx?productId=",
        "shop_category_url": "http://shop.artic.edu/item.aspx?productId="
    }
}
```
:::

#### `GET /printed-catalogs/search`

Search printed-catalogs data in the aggregator. 

##### Available parameters:

* `q` - Your search query
* `query` - For complex queries, you can pass Elasticsearch domain syntax queries here
* `sort` - Used in conjunction with `query`
* `from` - Starting point of results. Pagination via Elasticsearch conventions
* `size` - Number of results to return. Pagination via Elasticsearch conventions
* `facets` - A comma-separated list of 'count' aggregation facets to include in the results.

::: details Example request: https://api.artic.edu/api/v1/printed-catalogs/search
```js
{
    "preference": null,
    "pagination": {
        "total": 181,
        "limit": 10,
        "offset": 0,
        "total_pages": 19,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "printed-catalogs",
            "api_link": "https://aggregator-data.artic.edu/api/v1/printed-catalogs/4",
            "id": 4,
            "title": "The Art Institute of Chicago: The Essential Guide",
            "timestamp": "2020-07-30T05:07:46-05:00"
        },
        {
            "_score": 1,
            "api_model": "printed-catalogs",
            "api_link": "https://aggregator-data.artic.edu/api/v1/printed-catalogs/5",
            "id": 5,
            "title": "Roy Lichtenstein: A Retrospective",
            "timestamp": "2020-07-30T05:07:46-05:00"
        },
        {
            "_score": 1,
            "api_model": "printed-catalogs",
            "api_link": "https://aggregator-data.artic.edu/api/v1/printed-catalogs/6",
            "id": 6,
            "title": "Dawoud Bey: Harlem, U.S.A.",
            "timestamp": "2020-07-30T05:07:46-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15"
    }
}
```
:::

#### `GET /printed-catalogs/{id}`

A single printed-catalog by the given identifier.

::: details Example request: https://api.artic.edu/api/v1/printed-catalogs/193?limit=2  
```js
{
    "data": {
        "id": 193,
        "api_model": "printed-catalogs",
        "api_link": "https://api.artic.edu/api/v1/printed-catalogs/193",
        "title": "Material Meanings: Selections from the Constance R. Caplan Collection",
        "is_published": true,
        "type": null,
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.0-rc15",
        "documentation": "http://art-institute-of-chicago.github.io/data-aggregator"
    },
    "config": {
        "iiif_url": "https://lakeimagesweb.artic.edu/iiif/2",
        "shop_image_url": "https://shop-images.imgix.net",
        "shop_product_url": "http://shop.artic.edu/item.aspx?productId=",
        "shop_category_url": "http://shop.artic.edu/item.aspx?productId="
    }
}
```
:::

