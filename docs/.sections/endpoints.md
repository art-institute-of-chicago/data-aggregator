## Endpoints

### Collections

#### Artworks

_The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu._

##### `GET /artworks`

A list of all artworks sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#artworks).

###### Available parameters:

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
        "total": 112786,
        "limit": 2,
        "offset": 0,
        "total_pages": 56393,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/artworks?page=2&limit=2"
    },
    "data": [
        {
            "id": 236548,
            "api_model": "artworks",
            "api_link": "https://api.artic.edu/api/v1/artworks/236548",
            "is_boosted": false,
            "title": "Mogabido",
            "alt_titles": null,
            ...
        },
        {
            "id": 240218,
            "api_model": "artworks",
            "api_link": "https://api.artic.edu/api/v1/artworks/240218",
            "is_boosted": false,
            "title": "Fragment II",
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

##### `GET /artworks/search`

Search artworks data in the aggregator. Artworks in the groups of essentials are boosted so they'll show up higher in results.

###### Available parameters:

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
            "_score": 247.43706,
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
            "api_link": "https://api.artic.edu/api/v1/artworks/16568",
            "id": 16568,
            "title": "Water Lilies",
            "timestamp": "2020-08-12T03:02:52-05:00"
        },
        {
            "_score": 229.25125,
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
            "api_link": "https://api.artic.edu/api/v1/artworks/16571",
            "id": 16571,
            "title": "Arrival of the Normandy Train, Gare Saint-Lazare",
            "timestamp": "2020-08-12T03:02:52-05:00"
        },
        {
            "_score": 226.72401,
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
            "api_link": "https://api.artic.edu/api/v1/artworks/64818",
            "id": 64818,
            "title": "Stacks of Wheat (End of Summer)",
            "timestamp": "2020-08-12T03:12:22-05:00"
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

##### `GET /artworks/{id}`

A single artwork by the given identifier. {id} is the identifier from our collections management system.

::: details Example request: https://api.artic.edu/api/v1/artworks/236548?limit=2  
```js
{
    "data": {
        "id": 236548,
        "api_model": "artworks",
        "api_link": "https://api.artic.edu/api/v1/artworks/236548",
        "is_boosted": false,
        "title": "Mogabido",
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

#### Agents

_The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu._

##### `GET /agents`

A list of all agents sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#agents).

###### Available parameters:

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
        "total": 13891,
        "limit": 2,
        "offset": 0,
        "total_pages": 6946,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/agents?page=2&limit=2"
    },
    "data": [
        {
            "id": 48957,
            "api_model": "agents",
            "api_link": "https://api.artic.edu/api/v1/agents/48957",
            "title": "Lutz Bacher",
            "sort_title": "Bacher, Lutz",
            "alt_titles": null,
            ...
        },
        {
            "id": 34988,
            "api_model": "agents",
            "api_link": "https://api.artic.edu/api/v1/agents/34988",
            "title": "Winslow Homer",
            "sort_title": "Homer, Winslow",
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

##### `GET /agents/search`

Search agents data in the aggregator. 

###### Available parameters:

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
        "total": 13892,
        "limit": 10,
        "offset": 0,
        "total_pages": 1390,
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
            "api_link": "https://api.artic.edu/api/v1/agents/4454",
            "id": 4454,
            "title": "Hugo Charlemont",
            "timestamp": "2020-08-12T03:43:52-05:00"
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

##### `GET /agents/{id}`

A single agent by the given identifier. {id} is the identifier from our collections management system.

::: details Example request: https://api.artic.edu/api/v1/agents/48957?limit=2  
```js
{
    "data": {
        "id": 48957,
        "api_model": "agents",
        "api_link": "https://api.artic.edu/api/v1/agents/48957",
        "title": "Lutz Bacher",
        "sort_title": "Bacher, Lutz",
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

#### Places

_The data in this response is licensed under a Creative Commons Attribution 4.0 Generic License (CC-By) and the Terms and Conditions of artic.edu. Contains information from the J. Paul Getty Trust, Getty Research Institute, the Getty Thesaurus of Geographic Names, which is made available under the ODC Attribution License._

##### `GET /places`

A list of all places sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#places).

###### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

::: details Example request: https://api.artic.edu/api/v1/places?limit=2  
```js
{
    "pagination": {
        "total": 3918,
        "limit": 2,
        "offset": 0,
        "total_pages": 1959,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/places?page=2&limit=2"
    },
    "data": [
        {
            "id": -37,
            "api_model": "places",
            "api_link": "https://api.artic.edu/api/v1/places/-37",
            "title": "Cape Town",
            "type": "No location",
            "last_updated_source": "2020-08-11T06:46:44-05:00",
            ...
        },
        {
            "id": -2147473261,
            "api_model": "places",
            "api_link": "https://api.artic.edu/api/v1/places/-2147473261",
            "title": "Joliet",
            "type": "No location",
            "last_updated_source": "2020-06-23T10:54:15-05:00",
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

##### `GET /places/search`

Search places data in the aggregator. 

###### Available parameters:

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
            "api_link": "https://api.artic.edu/api/v1/places/-2147483613",
            "id": -2147483613,
            "title": "Peoria",
            "timestamp": "2020-08-12T03:45:47-05:00"
        },
        {
            "_score": 1,
            "api_model": "places",
            "api_link": "https://api.artic.edu/api/v1/places/-2147483581",
            "id": -2147483581,
            "title": "Askov",
            "timestamp": "2020-08-12T03:45:47-05:00"
        },
        {
            "_score": 1,
            "api_model": "places",
            "api_link": "https://api.artic.edu/api/v1/places/-2147483534",
            "id": -2147483534,
            "title": "Z\u00fcrich",
            "timestamp": "2020-08-12T03:45:47-05:00"
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

##### `GET /places/{id}`

A single place by the given identifier. {id} is the identifier from our collections management system.

::: details Example request: https://api.artic.edu/api/v1/places/-37?limit=2  
```js
{
    "data": {
        "id": -37,
        "api_model": "places",
        "api_link": "https://api.artic.edu/api/v1/places/-37",
        "title": "Cape Town",
        "type": "No location",
        "last_updated_source": "2020-08-11T06:46:44-05:00",
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

#### Galleries

_The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu._

##### `GET /galleries`

A list of all galleries sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#galleries).

###### Available parameters:

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

##### `GET /galleries/search`

Search galleries data in the aggregator. 

###### Available parameters:

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
            "api_link": "https://api.artic.edu/api/v1/galleries/2",
            "id": 2,
            "title": "East Garden at Columbus Drive",
            "timestamp": "2020-08-12T03:45:50-05:00"
        },
        {
            "_score": 1,
            "api_model": "galleries",
            "api_link": "https://api.artic.edu/api/v1/galleries/346",
            "id": 346,
            "title": "Stock Exchange Trading Room",
            "timestamp": "2020-08-12T03:45:50-05:00"
        },
        {
            "_score": 1,
            "api_model": "galleries",
            "api_link": "https://api.artic.edu/api/v1/galleries/2705",
            "id": 2705,
            "title": "Gallery 59",
            "timestamp": "2020-08-12T03:45:50-05:00"
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

##### `GET /galleries/{id}`

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

#### Exhibitions

_The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu._

##### `GET /exhibitions`

A list of all exhibitions sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#exhibitions).

###### Available parameters:

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
        "total": 6353,
        "limit": 2,
        "offset": 0,
        "total_pages": 3177,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/exhibitions?page=2&limit=2"
    },
    "data": [
        {
            "id": 9531,
            "api_model": "exhibitions",
            "api_link": "https://api.artic.edu/api/v1/exhibitions/9531",
            "title": "Richard Hunt: Scholar's Rock, or Stone of Hope, or Love of Bronze",
            "is_featured": false,
            "is_published": true,
            ...
        },
        {
            "id": 2930,
            "api_model": "exhibitions",
            "api_link": "https://api.artic.edu/api/v1/exhibitions/2930",
            "title": "Barbara Kruger. \nThinking of You.\nI Mean Me.\nI Mean You.",
            "is_featured": false,
            "is_published": false,
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

##### `GET /exhibitions/search`

Search exhibitions data in the aggregator. 

###### Available parameters:

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
        "total": 6353,
        "limit": 10,
        "offset": 0,
        "total_pages": 636,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "exhibitions",
            "api_link": "https://api.artic.edu/api/v1/exhibitions/1321",
            "id": 1321,
            "title": "Souvenirs of the Barbizon: Photographs, Paintings, and Works on Paper",
            "timestamp": "2020-08-12T03:45:56-05:00"
        },
        {
            "_score": 1,
            "api_model": "exhibitions",
            "api_link": "https://api.artic.edu/api/v1/exhibitions/1332",
            "id": 1332,
            "title": "Capturing the Sublime: Italian Drawings of the Renaissance and Baroque",
            "timestamp": "2020-08-12T03:45:56-05:00"
        },
        {
            "_score": 1,
            "api_model": "exhibitions",
            "api_link": "https://api.artic.edu/api/v1/exhibitions/1333",
            "id": 1333,
            "title": "Bertrand Goldberg:  Architecture of Invention",
            "timestamp": "2020-08-12T03:45:56-05:00"
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

##### `GET /exhibitions/{id}`

A single exhibition by the given identifier. {id} is the identifier from our collections management system.

::: details Example request: https://api.artic.edu/api/v1/exhibitions/9531?limit=2  
```js
{
    "data": {
        "id": 9531,
        "api_model": "exhibitions",
        "api_link": "https://api.artic.edu/api/v1/exhibitions/9531",
        "title": "Richard Hunt: Scholar's Rock, or Stone of Hope, or Love of Bronze",
        "is_featured": false,
        "is_published": true,
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

#### Agent Types

_The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu._

##### `GET /agent-types`

A list of all agent-types sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#agent-types).

###### Available parameters:

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

##### `GET /agent-types/{id}`

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

#### Agent Roles

_The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu._

##### `GET /agent-roles`

A list of all agent-roles sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#agent-roles).

###### Available parameters:

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
            "id": 434,
            "api_model": "agent-roles",
            "api_link": "https://api.artic.edu/api/v1/agent-roles/434",
            "title": "Craftsperson",
            "last_updated_source": "2020-06-24T11:02:14-05:00",
            "last_updated": "2020-06-24T16:00:33-05:00",
            ...
        },
        {
            "id": 574,
            "api_model": "agent-roles",
            "api_link": "https://api.artic.edu/api/v1/agent-roles/574",
            "title": "File Transfer",
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

##### `GET /agent-roles/{id}`

A single agent-role by the given identifier. {id} is the identifier from our collections management system.

::: details Example request: https://api.artic.edu/api/v1/agent-roles/434?limit=2  
```js
{
    "data": {
        "id": 434,
        "api_model": "agent-roles",
        "api_link": "https://api.artic.edu/api/v1/agent-roles/434",
        "title": "Craftsperson",
        "last_updated_source": "2020-06-24T11:02:14-05:00",
        "last_updated": "2020-06-24T16:00:33-05:00",
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

#### Agent Place Qualifiers

_The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu._

##### `GET /agent-place-qualifiers`

A list of all agent-place-qualifiers sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#agent-place-qualifiers).

###### Available parameters:

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

##### `GET /agent-place-qualifiers/{id}`

A single agent-place-qualifier by the given identifier. {id} is the identifier from our collections management system.


#### Artwork Types

_The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu._

##### `GET /artwork-types`

A list of all artwork-types sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#artwork-types).

###### Available parameters:

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

##### `GET /artwork-types/{id}`

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

#### Artwork Place Qualifiers

_The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu._

##### `GET /artwork-place-qualifiers`

A list of all artwork-place-qualifiers sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#artwork-place-qualifiers).

###### Available parameters:

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

##### `GET /artwork-place-qualifiers/{id}`

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

#### Artwork Date Qualifiers

_The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu._

##### `GET /artwork-date-qualifiers`

A list of all artwork-date-qualifiers sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#artwork-date-qualifiers).

###### Available parameters:

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

##### `GET /artwork-date-qualifiers/{id}`

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

#### Catalogues

_The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu._

##### `GET /catalogues`

A list of all catalogues sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#catalogues).

###### Available parameters:

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

##### `GET /catalogues/{id}`

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

#### Category Terms

_The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu._

##### `GET /category-terms`

A list of all category-terms sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#category-terms).

###### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

::: details Example request: https://api.artic.edu/api/v1/category-terms?limit=2  
```js
{
    "pagination": {
        "total": 9185,
        "limit": 2,
        "offset": 0,
        "total_pages": 4593,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/category-terms?page=2&limit=2"
    },
    "data": [
        {
            "id": "TM-14479",
            "api_model": "category-terms",
            "api_link": "https://api.artic.edu/api/v1/category-terms/TM-14479",
            "title": "hand woven",
            "subtype": "technique",
            "parent_id": null,
            ...
        },
        {
            "id": "TM-14478",
            "api_model": "category-terms",
            "api_link": "https://api.artic.edu/api/v1/category-terms/TM-14478",
            "title": "computer-assisted Jacquard loom",
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

##### `GET /category-terms/search`

Search category-terms data in the aggregator. 

###### Available parameters:

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
        "total": 9185,
        "limit": 10,
        "offset": 0,
        "total_pages": 919,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "category-terms",
            "api_link": "https://api.artic.edu/api/v1/category-terms/PC-1",
            "id": "PC-1",
            "title": "Arts of Africa",
            "timestamp": "2020-08-12T03:47:14-05:00"
        },
        {
            "_score": 1,
            "api_model": "category-terms",
            "api_link": "https://api.artic.edu/api/v1/category-terms/PC-10",
            "id": "PC-10",
            "title": "European Painting and Sculpture",
            "timestamp": "2020-08-12T03:47:14-05:00"
        },
        {
            "_score": 1,
            "api_model": "category-terms",
            "api_link": "https://api.artic.edu/api/v1/category-terms/PC-100",
            "id": "PC-100",
            "title": "Impressionism and Post-Impressionism",
            "timestamp": "2020-08-12T03:47:14-05:00"
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

##### `GET /category-terms/{id}`

A single category-term by the given identifier. {id} is the identifier from our collections management system.

::: details Example request: https://api.artic.edu/api/v1/category-terms/TM-14479?limit=2  
```js
{
    "data": {
        "id": "TM-14479",
        "api_model": "category-terms",
        "api_link": "https://api.artic.edu/api/v1/category-terms/TM-14479",
        "title": "hand woven",
        "subtype": "technique",
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

#### Assets

_The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu._

##### `GET /assets`

A list of all assets sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#assets).

###### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

::: details Example request: https://api.artic.edu/api/v1/assets?limit=2  
```js
{
    "pagination": {
        "total": 145124,
        "limit": 2,
        "offset": 0,
        "total_pages": 72562,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/assets?page=2&limit=2"
    },
    "data": [
        {
            "id": "798c9e3b-203e-5ec8-753e-fdd3c0fa5f02",
            "lake_guid": "798c9e3b-203e-5ec8-753e-fdd3c0fa5f02",
            "api_model": "assets",
            "api_link": "https://api.artic.edu/api/v1/assets/798c9e3b-203e-5ec8-753e-fdd3c0fa5f02",
            "title": "278842",
            "type": "image",
            ...
        },
        {
            "id": "e4d1214c-9756-3519-93e9-0f8e6e31840f",
            "lake_guid": "e4d1214c-9756-3519-93e9-0f8e6e31840f",
            "api_model": "assets",
            "api_link": "https://api.artic.edu/api/v1/assets/e4d1214c-9756-3519-93e9-0f8e6e31840f",
            "title": "IM022580",
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

##### `GET /assets/{id}`

A single asset by the given identifier. {id} is the identifier from our collections management system.


#### Images

_The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu._

##### `GET /images`

A list of all images sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#images).

###### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

::: details Example request: https://api.artic.edu/api/v1/images?limit=2  
```js
{
    "pagination": {
        "total": 141947,
        "limit": 2,
        "offset": 0,
        "total_pages": 70974,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/images?page=2&limit=2"
    },
    "data": [
        {
            "id": "798c9e3b-203e-5ec8-753e-fdd3c0fa5f02",
            "lake_guid": "798c9e3b-203e-5ec8-753e-fdd3c0fa5f02",
            "api_model": "images",
            "api_link": "https://api.artic.edu/api/v1/images/798c9e3b-203e-5ec8-753e-fdd3c0fa5f02",
            "title": "278842",
            "type": "image",
            ...
        },
        {
            "id": "e4d1214c-9756-3519-93e9-0f8e6e31840f",
            "lake_guid": "e4d1214c-9756-3519-93e9-0f8e6e31840f",
            "api_model": "images",
            "api_link": "https://api.artic.edu/api/v1/images/e4d1214c-9756-3519-93e9-0f8e6e31840f",
            "title": "IM022580",
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

##### `GET /images/search`

Search images data in the aggregator. 

###### Available parameters:

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
        "total": 141960,
        "limit": 10,
        "offset": 0,
        "total_pages": 14196,
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

##### `GET /images/{id}`

A single image by the given identifier. {id} is the identifier from our collections management system.


#### Videos

_The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu._

##### `GET /videos`

A list of all videos sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#videos).

###### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

::: details Example request: https://api.artic.edu/api/v1/videos?limit=2  
```js
{
    "pagination": {
        "total": 4,
        "limit": 2,
        "offset": 0,
        "total_pages": 2,
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

##### `GET /videos/search`

Search videos data in the aggregator. 

###### Available parameters:

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
            "api_link": "https://api.artic.edu/api/v1/videos/1ee4a231-0dad-2638-24fd-dfa2138eb142",
            "id": "1ee4a231-0dad-2638-24fd-dfa2138eb142",
            "title": "Digital Simulation: Original appearance of <em>For to Be a Farmer's Boy</em>",
            "timestamp": "2020-08-12T05:13:31-05:00"
        },
        {
            "_score": 1,
            "api_model": "videos",
            "api_link": "https://api.artic.edu/api/v1/videos/c051f71e-2b69-ac68-9aa8-99410d91f3f3",
            "id": "c051f71e-2b69-ac68-9aa8-99410d91f3f3",
            "title": "Under Cover: The Science of Van Gogh's Bedroom",
            "timestamp": "2020-08-12T05:13:31-05:00"
        },
        {
            "_score": 1,
            "api_model": "videos",
            "api_link": "https://api.artic.edu/api/v1/videos/c5700df1-473c-c1cd-ab1b-79b20a32fc27",
            "id": "c5700df1-473c-c1cd-ab1b-79b20a32fc27",
            "title": "Online Game: Winslow Homer's <em>The Water Fan</em>",
            "timestamp": "2020-08-12T05:13:31-05:00"
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

##### `GET /videos/{id}`

A single video by the given identifier. {id} is the identifier from our collections management system.


#### Sounds

_The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu._

##### `GET /sounds`

A list of all sounds sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#sounds).

###### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

::: details Example request: https://api.artic.edu/api/v1/sounds?limit=2  
```js
{
    "pagination": {
        "total": 1102,
        "limit": 2,
        "offset": 0,
        "total_pages": 551,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/sounds?page=2&limit=2"
    },
    "data": [
        {
            "id": "1ac585eb-257e-2b3b-1a07-8cf2a06d7e16",
            "lake_guid": "1ac585eb-257e-2b3b-1a07-8cf2a06d7e16",
            "api_model": "sounds",
            "api_link": "https://api.artic.edu/api/v1/sounds/1ac585eb-257e-2b3b-1a07-8cf2a06d7e16",
            "title": "Audio stop 963.mp3",
            "type": "sound",
            ...
        },
        {
            "id": "18526870-d924-4bc6-237b-da10fd586aaa",
            "lake_guid": "18526870-d924-4bc6-237b-da10fd586aaa",
            "api_model": "sounds",
            "api_link": "https://api.artic.edu/api/v1/sounds/18526870-d924-4bc6-237b-da10fd586aaa",
            "title": "Audio stop 818.mp3",
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

##### `GET /sounds/search`

Search sounds data in the aggregator. 

###### Available parameters:

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
            "api_link": "https://api.artic.edu/api/v1/sounds/31bdc88e-581d-b744-022b-7e9571b95ff2",
            "id": "31bdc88e-581d-b744-022b-7e9571b95ff2",
            "title": "Audio Lecture: Winslow Homer, Artist and Angler",
            "timestamp": "2020-08-12T05:13:34-05:00"
        },
        {
            "_score": 1,
            "api_model": "sounds",
            "api_link": "https://api.artic.edu/api/v1/sounds/31c370a9-98de-3533-c14e-c91776c8bf82",
            "id": "31c370a9-98de-3533-c14e-c91776c8bf82",
            "title": "Audio Lecture: Mel Bochner Symposium, Introduction and Keynote",
            "timestamp": "2020-08-12T05:13:34-05:00"
        },
        {
            "_score": 1,
            "api_model": "sounds",
            "api_link": "https://api.artic.edu/api/v1/sounds/31ee173d-cd35-88ef-9362-61722a5e10bf",
            "id": "31ee173d-cd35-88ef-9362-61722a5e10bf",
            "title": "Audio stop 442.wav",
            "timestamp": "2020-08-12T05:13:34-05:00"
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

##### `GET /sounds/{id}`

A single sound by the given identifier. {id} is the identifier from our collections management system.


#### Texts

_The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu._

##### `GET /texts`

A list of all texts sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#texts).

###### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

::: details Example request: https://api.artic.edu/api/v1/texts?limit=2  
```js
{
    "pagination": {
        "total": 2071,
        "limit": 2,
        "offset": 0,
        "total_pages": 1036,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/texts?page=2&limit=2"
    },
    "data": [
        {
            "id": "6f45a6b5-784e-4a59-46d7-99e066cd29f6",
            "lake_guid": "6f45a6b5-784e-4a59-46d7-99e066cd29f6",
            "api_model": "texts",
            "api_link": "https://api.artic.edu/api/v1/texts/6f45a6b5-784e-4a59-46d7-99e066cd29f6",
            "title": "Audio Transcript 963.txt",
            "type": "text",
            ...
        },
        {
            "id": "3c6168fb-d604-0ea8-6cc5-2b55b716b8e3",
            "lake_guid": "3c6168fb-d604-0ea8-6cc5-2b55b716b8e3",
            "api_model": "texts",
            "api_link": "https://api.artic.edu/api/v1/texts/3c6168fb-d604-0ea8-6cc5-2b55b716b8e3",
            "title": "Audio Transcript 963-1.txt",
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

##### `GET /texts/search`

Search texts data in the aggregator. 

###### Available parameters:

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
            "api_link": "https://api.artic.edu/api/v1/texts/0ce7c09b-72fa-2879-0e4a-f460a04276aa",
            "id": "0ce7c09b-72fa-2879-0e4a-f460a04276aa",
            "title": "Audio Transcript 957.txt",
            "timestamp": "2020-08-12T05:13:49-05:00"
        },
        {
            "_score": 1,
            "api_model": "texts",
            "api_link": "https://api.artic.edu/api/v1/texts/0ce9f003-fa67-e2c9-bcd5-33d3196510fa",
            "id": "0ce9f003-fa67-e2c9-bcd5-33d3196510fa",
            "title": "AIC1921APoole_comb.pdf",
            "timestamp": "2020-08-12T05:13:49-05:00"
        },
        {
            "_score": 1,
            "api_model": "texts",
            "api_link": "https://api.artic.edu/api/v1/texts/0d0b2dd0-c275-ae3b-e6f7-6766fc503e22",
            "id": "0d0b2dd0-c275-ae3b-e6f7-6766fc503e22",
            "title": "Educator Resource Packet: <em>A Boy in Front of the Loews 125th Street Movie Theater</em>, from the series<em> Harlem, U.S.A </em>",
            "timestamp": "2020-08-12T05:13:49-05:00"
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

##### `GET /texts/{id}`

A single text by the given identifier. {id} is the identifier from our collections management system.


### Shop

#### Shop Categories

_The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for "fair use" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials._

##### `GET /shop-categories`

A list of all shop-categories sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#shop-categories).

###### Available parameters:

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
        "total": 87,
        "limit": 2,
        "offset": 0,
        "total_pages": 44,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/shop-categories?page=2&limit=2"
    },
    "data": [
        {
            "id": 56,
            "api_model": "shop-categories",
            "api_link": "https://api.artic.edu/api/v1/shop-categories/56",
            "title": "Totes",
            "web_url": "http://shop.artic.edu/browse.aspx?catID=56",
            "parent_id": 3,
            ...
        },
        {
            "id": 53,
            "api_model": "shop-categories",
            "api_link": "https://api.artic.edu/api/v1/shop-categories/53",
            "title": "Religious",
            "web_url": "http://shop.artic.edu/browse.aspx?catID=53",
            "parent_id": 6,
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

##### `GET /shop-categories/search`

Search shop-categories data in the aggregator. 

###### Available parameters:

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
            "api_link": "https://api.artic.edu/api/v1/shop-categories/2",
            "id": 2,
            "title": "Books & Prints",
            "timestamp": "2020-08-12T05:13:57-05:00"
        },
        {
            "_score": 1,
            "api_model": "shop-categories",
            "api_link": "https://api.artic.edu/api/v1/shop-categories/3",
            "id": 3,
            "title": "Fashion & Accessories",
            "timestamp": "2020-08-12T05:13:57-05:00"
        },
        {
            "_score": 1,
            "api_model": "shop-categories",
            "api_link": "https://api.artic.edu/api/v1/shop-categories/4",
            "id": 4,
            "title": "Decor",
            "timestamp": "2020-08-12T05:13:57-05:00"
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

##### `GET /shop-categories/{id}`

A single shop-category by the given identifier.

::: details Example request: https://api.artic.edu/api/v1/shop-categories/56?limit=2  
```js
{
    "data": {
        "id": 56,
        "api_model": "shop-categories",
        "api_link": "https://api.artic.edu/api/v1/shop-categories/56",
        "title": "Totes",
        "web_url": "http://shop.artic.edu/browse.aspx?catID=56",
        "parent_id": 3,
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

#### Products

_The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for "fair use" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials._

##### `GET /products`

A list of all products sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#products).

###### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

::: details Example request: https://api.artic.edu/api/v1/products?limit=2  
```js
{
    "pagination": {
        "total": 6929,
        "limit": 2,
        "offset": 0,
        "total_pages": 3465,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/products?page=2&limit=2"
    },
    "data": [
        {
            "id": 6970,
            "api_model": "products",
            "api_link": "https://api.artic.edu/api/v1/products/6970",
            "title": "FPT RAFFAEL WHITE LILY",
            "title_sort": null,
            "is_active": false,
            ...
        },
        {
            "id": 6969,
            "api_model": "products",
            "api_link": "https://api.artic.edu/api/v1/products/6969",
            "title": "FPT KOOP SUMMER SALES FRAME",
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

##### `GET /products/search`

Search products data in the aggregator. 

###### Available parameters:

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
        "total": 6929,
        "limit": 10,
        "offset": 0,
        "total_pages": 693,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "products",
            "api_link": "https://api.artic.edu/api/v1/products/594",
            "id": 594,
            "title": "Petite Paperweight Plate Set",
            "timestamp": "2020-08-12T05:13:59-05:00"
        },
        {
            "_score": 1,
            "api_model": "products",
            "api_link": "https://api.artic.edu/api/v1/products/599",
            "id": 599,
            "title": "Silk Rose Pins",
            "timestamp": "2020-08-12T05:13:59-05:00"
        },
        {
            "_score": 1,
            "api_model": "products",
            "api_link": "https://api.artic.edu/api/v1/products/604",
            "id": 604,
            "title": "Italian Glass Trees",
            "timestamp": "2020-08-12T05:13:59-05:00"
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

##### `GET /products/{id}`

A single product by the given identifier.

::: details Example request: https://api.artic.edu/api/v1/products/4272?limit=2  
```js
{
    "data": {
        "id": 4272,
        "api_model": "products",
        "api_link": "https://api.artic.edu/api/v1/products/4272",
        "title": "The Age of French Impressionism: Masterpieces from the Art Institute of Chicago",
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

### Mobile

#### Tours

_The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for "fair use" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials._

##### `GET /tours`

A list of all tours sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#tours).

###### Available parameters:

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
            "id": 1023,
            "api_model": "tours",
            "api_link": "https://api.artic.edu/api/v1/tours/1023",
            "title": "The Architecture Tour",
            "image": "http://aic-mobile-tours.artic.edu/sites/default/files/tour-images/IM016907_008_reduced.jpg",
            "description": "<p>Uncover the secrets of the museum\u2019s storied architecture.</p>\n",
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

##### `GET /tours/search`

Search tours data in the aggregator. 

###### Available parameters:

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

##### `GET /tours/{id}`

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

#### Mobile Sounds

_The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for "fair use" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials._

##### `GET /mobile-sounds`

A list of all mobile-sounds sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#mobile-sounds).

###### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

::: details Example request: https://api.artic.edu/api/v1/mobile-sounds?limit=2  
```js
{
    "pagination": {
        "total": 786,
        "limit": 2,
        "offset": 0,
        "total_pages": 393,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/mobile-sounds?page=2&limit=2"
    },
    "data": [
        {
            "id": 4716,
            "api_model": "mobile-sounds",
            "api_link": "https://api.artic.edu/api/v1/mobile-sounds/4716",
            "title": "Audio Dispatch: Redesigning \"Monet and Chicago\"",
            "web_url": "https://www.artic.edu/mobile/audio/AD_MonetRedesign_V5%20%281%29.mp3",
            "transcript": null,
            ...
        },
        {
            "id": 4703,
            "api_model": "mobile-sounds",
            "api_link": "https://api.artic.edu/api/v1/mobile-sounds/4703",
            "title": "4887_T036_Irises_V5.mp3",
            "web_url": "https://www.artic.edu/mobile/audio/11_4887_Irises_V5.mp3",
            "transcript": "<p>Narrator: Curator, Gloria Groom.</p>\n<p>Gloria Groom: This, I think, is one of the most unusual waterlily series that Monet ever did. These are all six feet tall, square canvases where he is so much interested, yes, in the reflective quality but even more so in the kind of building up of this encrusted surface scraping back, adding, scraping back, adding. And you get this almost fresco like encrusted [ph?] surface that looks like it belongs to the wall.</p>\n<p>Narrator: Researcher Associate, Kathryn Kremnitzer.</p>\n<p>Kathryn Kremnitzer: The composition is almost dizzying. You know, we think of Monet painting these at the edge of the pond looking into the reflection seeing things on the surface and below. It feels upside down because you don\u2019t know what\u2019s up and what is down.</p>\n<p>Gloria Groom: Where are we? What is reflected? What\u2019s growing up from the water? And what\u2019s being reflected into the water? This back-and-forth thing, those qualities that were so attractive in the 1950s for the abstract expressionists. And why when his son Michel started selling off some of these large scale canvases that had been left in his studio, someone like Kathryn Kuh, who was the Art Institute\u2019s first curator of modern and contemporary art just fell in love with this and had to have it.</p>\n<p>Kathryn Kremnitzer: This truly pioneering curator of modern art purchased irises from Katia Granoff\u2019s gallery in Paris.</p>\n<p>Gloria Groom: Interestingly enough beat out Alfred Barr\u2026</p>\n<p>Kathryn Kremnitzer: \u2026who\u2019s the director of the Museum of Modern Art in New York. Thinking about what is modern art in 1956 you might not think Monet and the Art Institute already had so many inimitable examples by the artist, why strengthen your collection that way?</p>\n<p>Gloria Groom: Kathryn Kuh absolutely saw in this what was going on in America at the same time with abstract expressionist, with color field painting.</p>\n<p>Kathryn Kremnitzer: It\u2019s totally immersive. And it sets up moments of abstraction or pure color that in the twentieth century will take center stage.</p>\n",
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

##### `GET /mobile-sounds/search`

Search mobile-sounds data in the aggregator. 

###### Available parameters:

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
        "total": 788,
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
            "api_link": "https://api.artic.edu/api/v1/mobile-sounds/226",
            "id": 226,
            "title": "Justus Sustermans",
            "timestamp": "2020-08-12T05:14:29-05:00"
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

##### `GET /mobile-sounds/{id}`

A single mobile-sound by the given identifier.

::: details Example request: https://api.artic.edu/api/v1/mobile-sounds/4716?limit=2  
```js
{
    "data": {
        "id": 4716,
        "api_model": "mobile-sounds",
        "api_link": "https://api.artic.edu/api/v1/mobile-sounds/4716",
        "title": "Audio Dispatch: Redesigning \"Monet and Chicago\"",
        "web_url": "https://www.artic.edu/mobile/audio/AD_MonetRedesign_V5%20%281%29.mp3",
        "transcript": null,
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

### Digital Scholarly Catalogs

#### Publications

_The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for "fair use" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials._

##### `GET /publications`

A list of all publications sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#publications).

###### Available parameters:

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

##### `GET /publications/search`

Search publications data in the aggregator. 

###### Available parameters:

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
            "api_link": "https://api.artic.edu/api/v1/publications/2",
            "id": 2,
            "title": "American Silver in the Art Institute of Chicago",
            "timestamp": "2020-08-12T05:14:34-05:00"
        },
        {
            "_score": 1,
            "api_model": "publications",
            "api_link": "https://api.artic.edu/api/v1/publications/7",
            "id": 7,
            "title": "Pissarro Paintings and Works on Paper at the Art Institute of Chicago",
            "timestamp": "2020-08-12T05:14:34-05:00"
        },
        {
            "_score": 1,
            "api_model": "publications",
            "api_link": "https://api.artic.edu/api/v1/publications/12",
            "id": 12,
            "title": "The Modern Series at the Art Institute of Chicago",
            "timestamp": "2020-08-12T05:14:34-05:00"
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

##### `GET /publications/{id}`

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

#### Sections

_The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for "fair use" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials._

##### `GET /sections`

A list of all sections sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#sections).

###### Available parameters:

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

##### `GET /sections/search`

Search sections data in the aggregator. 

###### Available parameters:

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
            "api_link": "https://api.artic.edu/api/v1/sections/39585382154",
            "id": 39585382154,
            "title": "Cat. 38 \u00a0Tahitian Eve\u00a0(recto), Fragment of Inscription\u00a0(verso), 1891/93",
            "timestamp": "2020-08-12T05:14:45-05:00"
        },
        {
            "_score": 1,
            "api_model": "sections",
            "api_link": "https://api.artic.edu/api/v1/sections/39585663528",
            "id": 39585663528,
            "title": "Cat. 44 \u00a0Tahitian Hut, 1891/93",
            "timestamp": "2020-08-12T05:14:45-05:00"
        },
        {
            "_score": 1,
            "api_model": "sections",
            "api_link": "https://api.artic.edu/api/v1/sections/39585944903",
            "id": 39585944903,
            "title": "Cat. 47 \u00a0Man with an Ax, 1891/93",
            "timestamp": "2020-08-12T05:14:45-05:00"
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

##### `GET /sections/{id}`

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

### Static Archive

#### Sites

_The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for "fair use" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials._

##### `GET /sites`

A list of all sites sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#sites).

###### Available parameters:

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

##### `GET /sites/search`

Search sites data in the aggregator. 

###### Available parameters:

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
            "api_link": "https://api.artic.edu/api/v1/sites/1",
            "id": 1,
            "title": "Chicago Architecture: Ten Visions",
            "timestamp": "2020-08-12T05:14:48-05:00"
        },
        {
            "_score": 1,
            "api_model": "sites",
            "api_link": "https://api.artic.edu/api/v1/sites/2",
            "id": 2,
            "title": "American Perspectives: A yearlong celebration of American artistic vision",
            "timestamp": "2020-08-12T05:14:48-05:00"
        },
        {
            "_score": 1,
            "api_model": "sites",
            "api_link": "https://api.artic.edu/api/v1/sites/3",
            "id": 3,
            "title": "Curious Corner",
            "timestamp": "2020-08-12T05:14:48-05:00"
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

##### `GET /sites/{id}`

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

### Website

#### Closures

_The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for "fair use" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials._

##### `GET /closures`

A list of all closures sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#closures).

###### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

::: details Example request: https://api.artic.edu/api/v1/closures?limit=2  
```js
{
    "pagination": {
        "total": 20,
        "limit": 2,
        "offset": 0,
        "total_pages": 10,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/closures?page=2&limit=2"
    },
    "data": [
        {
            "id": 26,
            "api_model": "closures",
            "api_link": "https://api.artic.edu/api/v1/closures/26",
            "title": "Lorem ipsum.",
            "date_start": "2020-08-11T00:00:00-05:00",
            "date_end": "2020-08-12T00:00:00-05:00",
            ...
        },
        {
            "id": 24,
            "api_model": "closures",
            "api_link": "https://api.artic.edu/api/v1/closures/24",
            "title": "Lorem ipsum.",
            "date_start": "2020-08-06T00:00:00-05:00",
            "date_end": "2020-08-07T00:00:00-05:00",
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

##### `GET /closures/search`

Search closures data in the aggregator. 

###### Available parameters:

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
        "total": 20,
        "limit": 10,
        "offset": 0,
        "total_pages": 2,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "closures",
            "api_link": "https://api.artic.edu/api/v1/closures/4",
            "id": 4,
            "title": "Lorem ipsum.",
            "timestamp": "2020-08-12T05:14:50-05:00"
        },
        {
            "_score": 1,
            "api_model": "closures",
            "api_link": "https://api.artic.edu/api/v1/closures/5",
            "id": 5,
            "title": "Lorem ipsum.",
            "timestamp": "2020-08-12T05:14:50-05:00"
        },
        {
            "_score": 1,
            "api_model": "closures",
            "api_link": "https://api.artic.edu/api/v1/closures/9",
            "id": 9,
            "title": "Lorem ipsum.",
            "timestamp": "2020-08-12T05:14:50-05:00"
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

##### `GET /closures/{id}`

A single closure by the given identifier.

::: details Example request: https://api.artic.edu/api/v1/closures/26?limit=2  
```js
{
    "data": {
        "id": 26,
        "api_model": "closures",
        "api_link": "https://api.artic.edu/api/v1/closures/26",
        "title": "Lorem ipsum.",
        "date_start": "2020-08-11T00:00:00-05:00",
        "date_end": "2020-08-12T00:00:00-05:00",
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

#### Web Exhibitions

_The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for "fair use" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials._

##### `GET /web-exhibitions`

A list of all web-exhibitions sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#web-exhibitions).

###### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

::: details Example request: https://api.artic.edu/api/v1/web-exhibitions?limit=2  
```js
{
    "pagination": {
        "total": 679,
        "limit": 2,
        "offset": 0,
        "total_pages": 340,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/web-exhibitions?page=2&limit=2"
    },
    "data": [
        {
            "id": 692,
            "api_model": "web-exhibitions",
            "api_link": "https://api.artic.edu/api/v1/web-exhibitions/692",
            "title": "Richard Hunt: Scholar's Rock, or Stone of Hope, or Love of Bronze",
            "exhibition_id": 9531,
            "is_featured": false,
            ...
        },
        {
            "id": 58,
            "api_model": "web-exhibitions",
            "api_link": "https://api.artic.edu/api/v1/web-exhibitions/58",
            "title": "Japan\u2019s Great Female Poets",
            "exhibition_id": null,
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

##### `GET /web-exhibitions/search`

Search web-exhibitions data in the aggregator. 

###### Available parameters:

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
        "total": 680,
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
            "api_link": "https://api.artic.edu/api/v1/web-exhibitions/1",
            "id": 1,
            "title": "Charles White: A Retrospective",
            "timestamp": "2020-08-12T05:14:50-05:00"
        },
        {
            "_score": 1,
            "api_model": "web-exhibitions",
            "api_link": "https://api.artic.edu/api/v1/web-exhibitions/2",
            "id": 2,
            "title": "Manet and Modern Beauty",
            "timestamp": "2020-08-12T05:14:50-05:00"
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

##### `GET /web-exhibitions/{id}`

A single web-exhibition by the given identifier.

::: details Example request: https://api.artic.edu/api/v1/web-exhibitions/692?limit=2  
```js
{
    "data": {
        "id": 692,
        "api_model": "web-exhibitions",
        "api_link": "https://api.artic.edu/api/v1/web-exhibitions/692",
        "title": "Richard Hunt: Scholar's Rock, or Stone of Hope, or Love of Bronze",
        "exhibition_id": 9531,
        "is_featured": false,
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

#### Events

_The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for "fair use" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials._

##### `GET /events`

A list of all events sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#events).

###### Available parameters:

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
        "total": 1978,
        "limit": 2,
        "offset": 0,
        "total_pages": 989,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/events?page=2&limit=2"
    },
    "data": [
        {
            "id": 4095,
            "api_model": "events",
            "api_link": "https://api.artic.edu/api/v1/events/4095",
            "title": "Member Lecture: Painting the Floating World\u2014Ukiyo-e Masterpieces from the Weston Collection",
            "title_display": "Member Lecture: <i>Painting the Floating World\u2014Ukiyo-e Masterpieces from the Weston Collection</i>",
            "published": true,
            ...
        },
        {
            "id": 4082,
            "api_model": "events",
            "api_link": "https://api.artic.edu/api/v1/events/4082",
            "title": "Screening and Discussion: Pope.L\u2014The Escape",
            "title_display": null,
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

##### `GET /events/search`

Search events data in the aggregator. 

###### Available parameters:

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
            "api_link": "https://api.artic.edu/api/v1/events/3298",
            "id": 3298,
            "title": "Night Heist 2017",
            "timestamp": "2020-08-12T05:14:54-05:00"
        },
        {
            "_score": 1,
            "api_model": "events",
            "api_link": "https://api.artic.edu/api/v1/events/3299",
            "id": 3299,
            "title": "Express Talk: Joan Mitchell's City Landscape",
            "timestamp": "2020-08-12T05:14:54-05:00"
        },
        {
            "_score": 1,
            "api_model": "events",
            "api_link": "https://api.artic.edu/api/v1/events/3300",
            "id": 3300,
            "title": "Gallery Talk: Poetics of Wine in China",
            "timestamp": "2020-08-12T05:14:54-05:00"
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

##### `GET /events/{id}`

A single event by the given identifier.

::: details Example request: https://api.artic.edu/api/v1/events/4095?limit=2  
```js
{
    "data": {
        "id": 4095,
        "api_model": "events",
        "api_link": "https://api.artic.edu/api/v1/events/4095",
        "title": "Member Lecture: Painting the Floating World\u2014Ukiyo-e Masterpieces from the Weston Collection",
        "title_display": "Member Lecture: <i>Painting the Floating World\u2014Ukiyo-e Masterpieces from the Weston Collection</i>",
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

#### Event Occurrences

_The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for "fair use" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials._

##### `GET /event-occurrences`

A list of all event-occurrences sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#event-occurrences).

###### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

::: details Example request: https://api.artic.edu/api/v1/event-occurrences?limit=2  
```js
{
    "pagination": {
        "total": 2,
        "limit": 2,
        "offset": 0,
        "total_pages": 1,
        "current_page": 1
    },
    "data": [
        {
            "id": "80f6ec5d-556c-50fa-8f98-448d224a405e",
            "api_model": "event-occurrences",
            "api_link": "https://api.artic.edu/api/v1/event-occurrences/80f6ec5d-556c-50fa-8f98-448d224a405e",
            "title": "Virtual Lecture: Fred Wilson",
            "event_id": 5046,
            "short_description": "Presented by the Society for Contemporary Art with the School of the Art Institute of Chicago's Visiting Artists Program",
            ...
        },
        {
            "id": "e47cc49e-b658-58f4-97c4-04039e5a4a4b",
            "api_model": "event-occurrences",
            "api_link": "https://api.artic.edu/api/v1/event-occurrences/e47cc49e-b658-58f4-97c4-04039e5a4a4b",
            "title": "Virtual Lecture: El Greco\u2014Ambition and Defiance",
            "event_id": 5041,
            "short_description": null,
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

##### `GET /event-occurrences/search`

Search event-occurrences data in the aggregator. 

###### Available parameters:

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
        "total": 2,
        "limit": 10,
        "offset": 0,
        "total_pages": 1,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "event-occurrences",
            "api_link": "https://api.artic.edu/api/v1/event-occurrences/80f6ec5d-556c-50fa-8f98-448d224a405e",
            "id": "80f6ec5d-556c-50fa-8f98-448d224a405e",
            "title": "Virtual Lecture: Fred Wilson",
            "timestamp": "2020-08-12T05:15:03-05:00"
        },
        {
            "_score": 1,
            "api_model": "event-occurrences",
            "api_link": "https://api.artic.edu/api/v1/event-occurrences/e47cc49e-b658-58f4-97c4-04039e5a4a4b",
            "id": "e47cc49e-b658-58f4-97c4-04039e5a4a4b",
            "title": "Virtual Lecture: El Greco\u2014Ambition and Defiance",
            "timestamp": "2020-08-12T05:15:03-05:00"
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

##### `GET /event-occurrences/{id}`

A single event-occurrence by the given identifier.

::: details Example request: https://api.artic.edu/api/v1/event-occurrences/80f6ec5d-556c-50fa-8f98-448d224a405e?limit=2  
```js
{
    "data": {
        "id": "80f6ec5d-556c-50fa-8f98-448d224a405e",
        "api_model": "event-occurrences",
        "api_link": "https://api.artic.edu/api/v1/event-occurrences/80f6ec5d-556c-50fa-8f98-448d224a405e",
        "title": "Virtual Lecture: Fred Wilson",
        "event_id": 5046,
        "short_description": "Presented by the Society for Contemporary Art with the School of the Art Institute of Chicago's Visiting Artists Program",
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

#### Event Programs

_The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for "fair use" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials._

##### `GET /event-programs`

A list of all event-programs sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#event-programs).

###### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

::: details Example request: https://api.artic.edu/api/v1/event-programs?limit=2  
```js
{
    "pagination": {
        "total": 67,
        "limit": 2,
        "offset": 0,
        "total_pages": 34,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/event-programs?page=2&limit=2"
    },
    "data": [
        {
            "id": 6,
            "api_model": "event-programs",
            "api_link": "https://api.artic.edu/api/v1/event-programs/6",
            "title": "Artists Connect",
            "is_affiliate_group": false,
            "is_event_host": false,
            ...
        },
        {
            "id": 5,
            "api_model": "event-programs",
            "api_link": "https://api.artic.edu/api/v1/event-programs/5",
            "title": "American Sign Language Tours",
            "is_affiliate_group": false,
            "is_event_host": false,
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

##### `GET /event-programs/search`

Search event-programs data in the aggregator. 

###### Available parameters:

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
            "api_link": "https://api.artic.edu/api/v1/event-programs/1",
            "id": 1,
            "title": "Artist\u2019s Studio",
            "timestamp": "2020-08-12T05:15:03-05:00"
        },
        {
            "_score": 1,
            "api_model": "event-programs",
            "api_link": "https://api.artic.edu/api/v1/event-programs/2",
            "id": 2,
            "title": "Family Festivals",
            "timestamp": "2020-08-12T05:15:03-05:00"
        },
        {
            "_score": 1,
            "api_model": "event-programs",
            "api_link": "https://api.artic.edu/api/v1/event-programs/3",
            "id": 3,
            "title": "Picture This",
            "timestamp": "2020-08-12T05:15:03-05:00"
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

##### `GET /event-programs/{id}`

A single event-program by the given identifier.

::: details Example request: https://api.artic.edu/api/v1/event-programs/5?limit=2  
```js
{
    "data": {
        "id": 5,
        "api_model": "event-programs",
        "api_link": "https://api.artic.edu/api/v1/event-programs/5",
        "title": "American Sign Language Tours",
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

#### Articles

_The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for "fair use" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials._

##### `GET /articles`

A list of all articles sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#articles).

###### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

::: details Example request: https://api.artic.edu/api/v1/articles?limit=2  
```js
{
    "pagination": {
        "total": 275,
        "limit": 2,
        "offset": 0,
        "total_pages": 138,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/articles?page=2&limit=2"
    },
    "data": [
        {
            "id": 835,
            "api_model": "articles",
            "api_link": "https://api.artic.edu/api/v1/articles/835",
            "title": "abelardo-morell-adding-heart-to-eyes",
            "is_published": false,
            "date": "2020-08-21T00:00:00-05:00",
            ...
        },
        {
            "id": 705,
            "api_model": "articles",
            "api_link": "https://api.artic.edu/api/v1/articles/705",
            "title": "hidden-materials-in-john-singer-sargents-watercolors",
            "is_published": true,
            "date": "2018-08-01T00:00:00-05:00",
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

##### `GET /articles/search`

Search articles data in the aggregator. 

###### Available parameters:

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
        "total": 275,
        "limit": 10,
        "offset": 0,
        "total_pages": 28,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "articles",
            "api_link": "https://api.artic.edu/api/v1/articles/14",
            "id": 14,
            "title": "secrets-of-the-modern-wing",
            "timestamp": "2020-08-12T05:15:04-05:00"
        },
        {
            "_score": 1,
            "api_model": "articles",
            "api_link": "https://api.artic.edu/api/v1/articles/18",
            "id": 18,
            "title": "your-move",
            "timestamp": "2020-08-12T05:15:04-05:00"
        },
        {
            "_score": 1,
            "api_model": "articles",
            "api_link": "https://api.artic.edu/api/v1/articles/26",
            "id": 26,
            "title": "secrets-of-the-modern-wing-take-two",
            "timestamp": "2020-08-12T05:15:04-05:00"
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

##### `GET /articles/{id}`

A single article by the given identifier.

::: details Example request: https://api.artic.edu/api/v1/articles/705?limit=2  
```js
{
    "data": {
        "id": 705,
        "api_model": "articles",
        "api_link": "https://api.artic.edu/api/v1/articles/705",
        "title": "hidden-materials-in-john-singer-sargents-watercolors",
        "is_published": true,
        "date": "2018-08-01T00:00:00-05:00",
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

#### Selections

_The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for "fair use" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials._

##### `GET /selections`

A list of all selections sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#selections).

###### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

::: details Example request: https://api.artic.edu/api/v1/selections?limit=2  
```js
{
    "pagination": {
        "total": 17,
        "limit": 2,
        "offset": 0,
        "total_pages": 9,
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
            "id": 15,
            "api_model": "selections",
            "api_link": "https://api.artic.edu/api/v1/selections/15",
            "title": "explore-the-collection",
            "published": false,
            "short_copy": null,
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

##### `GET /selections/search`

Search selections data in the aggregator. 

###### Available parameters:

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
            "api_link": "https://api.artic.edu/api/v1/selections/3",
            "id": 3,
            "title": "what-to-see-in-an-hour",
            "timestamp": "2020-08-12T05:15:05-05:00"
        },
        {
            "_score": 1,
            "api_model": "selections",
            "api_link": "https://api.artic.edu/api/v1/selections/4",
            "id": 4,
            "title": "new-acquisitions",
            "timestamp": "2020-08-12T05:15:05-05:00"
        },
        {
            "_score": 1,
            "api_model": "selections",
            "api_link": "https://api.artic.edu/api/v1/selections/5",
            "id": 5,
            "title": "impressionism",
            "timestamp": "2020-08-12T05:15:05-05:00"
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

##### `GET /selections/{id}`

A single selection by the given identifier.

::: details Example request: https://api.artic.edu/api/v1/selections/6?limit=2  
```js
{
    "data": {
        "id": 6,
        "api_model": "selections",
        "api_link": "https://api.artic.edu/api/v1/selections/6",
        "title": "american-art",
        "published": true,
        "short_copy": "<p>The Art Institute boasts an outstanding collection of American Art\u2014fitting for a classic American city. Find some of the icons below.</p>",
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

#### Web Artists

_The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for "fair use" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials._

##### `GET /web-artists`

A list of all web-artists sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#web-artists).

###### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

::: details Example request: https://api.artic.edu/api/v1/web-artists?limit=2  
```js
{
    "pagination": {
        "total": 105,
        "limit": 2,
        "offset": 0,
        "total_pages": 53,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/web-artists?page=2&limit=2"
    },
    "data": [
        {
            "id": 2,
            "api_model": "web-artists",
            "api_link": "https://api.artic.edu/api/v1/web-artists/2",
            "title": "Don A. DuBroff",
            "has_also_known_as": null,
            "intro_copy": null,
            ...
        },
        {
            "id": 1,
            "api_model": "web-artists",
            "api_link": "https://api.artic.edu/api/v1/web-artists/1",
            "title": "Winslow Homer",
            "has_also_known_as": null,
            "intro_copy": null,
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

##### `GET /web-artists/search`

Search web-artists data in the aggregator. 

###### Available parameters:

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
        "total": 105,
        "limit": 10,
        "offset": 0,
        "total_pages": 11,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "web-artists",
            "api_link": "https://api.artic.edu/api/v1/web-artists/1",
            "id": 1,
            "title": "Winslow Homer",
            "timestamp": "2020-08-12T05:15:05-05:00"
        },
        {
            "_score": 1,
            "api_model": "web-artists",
            "api_link": "https://api.artic.edu/api/v1/web-artists/2",
            "id": 2,
            "title": "Don A. DuBroff",
            "timestamp": "2020-08-12T05:15:05-05:00"
        },
        {
            "_score": 1,
            "api_model": "web-artists",
            "api_link": "https://api.artic.edu/api/v1/web-artists/3",
            "id": 3,
            "title": "Neue Galerie New York",
            "timestamp": "2020-08-12T05:15:05-05:00"
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

##### `GET /web-artists/{id}`

A single web-artist by the given identifier.

::: details Example request: https://api.artic.edu/api/v1/web-artists/2?limit=2  
```js
{
    "data": {
        "id": 2,
        "api_model": "web-artists",
        "api_link": "https://api.artic.edu/api/v1/web-artists/2",
        "title": "Don A. DuBroff",
        "has_also_known_as": null,
        "intro_copy": null,
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

#### Static Pages

_The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for "fair use" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials._

##### `GET /static-pages`

A list of all static-pages sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#static-pages).

###### Available parameters:

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
            "id": 11,
            "api_model": "static-pages",
            "api_link": "https://api.artic.edu/api/v1/static-pages/11",
            "title": "Articles",
            "web_url": "/articles",
            "is_published": true,
            ...
        },
        {
            "id": 8,
            "api_model": "static-pages",
            "api_link": "https://api.artic.edu/api/v1/static-pages/8",
            "title": "Digital Publications",
            "web_url": "/digital-publications",
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

##### `GET /static-pages/search`

Search static-pages data in the aggregator. 

###### Available parameters:

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
            "timestamp": "2020-08-12T17:25:11-05:00"
        },
        {
            "_score": 1,
            "api_model": "static-pages",
            "api_link": "https://api.artic.edu/api/v1/static-pages/2",
            "id": 2,
            "title": "Events",
            "timestamp": "2020-08-12T17:25:11-05:00"
        },
        {
            "_score": 1,
            "api_model": "static-pages",
            "api_link": "https://api.artic.edu/api/v1/static-pages/3",
            "id": 3,
            "title": "Exhibitions",
            "timestamp": "2020-08-12T17:25:11-05:00"
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

##### `GET /static-pages/{id}`

A single static-page by the given identifier.

::: details Example request: https://api.artic.edu/api/v1/static-pages/11?limit=2  
```js
{
    "data": {
        "id": 11,
        "api_model": "static-pages",
        "api_link": "https://api.artic.edu/api/v1/static-pages/11",
        "title": "Articles",
        "web_url": "/articles",
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

#### Generic Pages

_The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for "fair use" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials._

##### `GET /generic-pages`

A list of all generic-pages sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#generic-pages).

###### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

::: details Example request: https://api.artic.edu/api/v1/generic-pages?limit=2  
```js
{
    "pagination": {
        "total": 245,
        "limit": 2,
        "offset": 0,
        "total_pages": 123,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/generic-pages?page=2&limit=2"
    },
    "data": [
        {
            "id": 452,
            "api_model": "generic-pages",
            "api_link": "https://api.artic.edu/api/v1/generic-pages/452",
            "title": "Research and Resources",
            "is_published": false,
            "type": null,
            ...
        },
        {
            "id": 451,
            "api_model": "generic-pages",
            "api_link": "https://api.artic.edu/api/v1/generic-pages/451",
            "title": "College and University Faculty and Students",
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

##### `GET /generic-pages/search`

Search generic-pages data in the aggregator. 

###### Available parameters:

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
        "total": 245,
        "limit": 10,
        "offset": 0,
        "total_pages": 25,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "generic-pages",
            "api_link": "https://api.artic.edu/api/v1/generic-pages/1",
            "id": 1,
            "title": "Visit",
            "timestamp": "2020-08-12T05:15:05-05:00"
        },
        {
            "_score": 1,
            "api_model": "generic-pages",
            "api_link": "https://api.artic.edu/api/v1/generic-pages/2",
            "id": 2,
            "title": "Free Admission Opportunities",
            "timestamp": "2020-08-12T05:15:05-05:00"
        },
        {
            "_score": 1,
            "api_model": "generic-pages",
            "api_link": "https://api.artic.edu/api/v1/generic-pages/4",
            "id": 4,
            "title": "Directions & Parking",
            "timestamp": "2020-08-12T05:15:05-05:00"
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

##### `GET /generic-pages/{id}`

A single generic-page by the given identifier.

::: details Example request: https://api.artic.edu/api/v1/generic-pages/417?limit=2  
```js
{
    "data": {
        "id": 417,
        "api_model": "generic-pages",
        "api_link": "https://api.artic.edu/api/v1/generic-pages/417",
        "title": "Instagram",
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

#### Press Releases

_The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for "fair use" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials._

##### `GET /press-releases`

A list of all press-releases sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#press-releases).

###### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

::: details Example request: https://api.artic.edu/api/v1/press-releases?limit=2  
```js
{
    "pagination": {
        "total": 248,
        "limit": 2,
        "offset": 0,
        "total_pages": 124,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/press-releases?page=2&limit=2"
    },
    "data": [
        {
            "id": 16,
            "api_model": "press-releases",
            "api_link": "https://api.artic.edu/api/v1/press-releases/16",
            "title": "Press Releases from 1954",
            "is_published": true,
            "type": null,
            ...
        },
        {
            "id": 17,
            "api_model": "press-releases",
            "api_link": "https://api.artic.edu/api/v1/press-releases/17",
            "title": "Press Releases from 1955",
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

##### `GET /press-releases/search`

Search press-releases data in the aggregator. 

###### Available parameters:

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
            "api_link": "https://api.artic.edu/api/v1/press-releases/1",
            "id": 1,
            "title": "Press Releases from 1939",
            "timestamp": "2020-08-12T05:15:06-05:00"
        },
        {
            "_score": 1,
            "api_model": "press-releases",
            "api_link": "https://api.artic.edu/api/v1/press-releases/2",
            "id": 2,
            "title": "Press Releases from 1940",
            "timestamp": "2020-08-12T05:15:06-05:00"
        },
        {
            "_score": 1,
            "api_model": "press-releases",
            "api_link": "https://api.artic.edu/api/v1/press-releases/3",
            "id": 3,
            "title": "Press Releases from 1941",
            "timestamp": "2020-08-12T05:15:06-05:00"
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

##### `GET /press-releases/{id}`

A single press-release by the given identifier.

::: details Example request: https://api.artic.edu/api/v1/press-releases/16?limit=2  
```js
{
    "data": {
        "id": 16,
        "api_model": "press-releases",
        "api_link": "https://api.artic.edu/api/v1/press-releases/16",
        "title": "Press Releases from 1954",
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

#### Educator Resources

_The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for "fair use" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials._

##### `GET /educator-resources`

A list of all educator-resources sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#educator-resources).

###### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

::: details Example request: https://api.artic.edu/api/v1/educator-resources?limit=2  
```js
{
    "pagination": {
        "total": 108,
        "limit": 2,
        "offset": 0,
        "total_pages": 54,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/educator-resources?page=2&limit=2"
    },
    "data": [
        {
            "id": 2,
            "api_model": "educator-resources",
            "api_link": "https://api.artic.edu/api/v1/educator-resources/2",
            "title": "Test Resource",
            "is_published": false,
            "type": null,
            ...
        },
        {
            "id": 3,
            "api_model": "educator-resources",
            "api_link": "https://api.artic.edu/api/v1/educator-resources/3",
            "title": "Activity: Arrival of the Normandy Train, Gare Saint-Lazare",
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

##### `GET /educator-resources/search`

Search educator-resources data in the aggregator. 

###### Available parameters:

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
            "api_link": "https://api.artic.edu/api/v1/educator-resources/2",
            "id": 2,
            "title": "Test Resource",
            "timestamp": "2020-08-12T05:15:07-05:00"
        },
        {
            "_score": 1,
            "api_model": "educator-resources",
            "api_link": "https://api.artic.edu/api/v1/educator-resources/3",
            "id": 3,
            "title": "Activity: Arrival of the Normandy Train, Gare Saint-Lazare",
            "timestamp": "2020-08-12T05:15:07-05:00"
        },
        {
            "_score": 1,
            "api_model": "educator-resources",
            "api_link": "https://api.artic.edu/api/v1/educator-resources/4",
            "id": 4,
            "title": "Activity: The Family Concert",
            "timestamp": "2020-08-12T05:15:07-05:00"
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

##### `GET /educator-resources/{id}`

A single educator-resource by the given identifier.

::: details Example request: https://api.artic.edu/api/v1/educator-resources/63?limit=2  
```js
{
    "data": {
        "id": 63,
        "api_model": "educator-resources",
        "api_link": "https://api.artic.edu/api/v1/educator-resources/63",
        "title": "Tips for Teachers and Parents: Body Language: How to Talk to Students About Nudity in Art",
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

#### Digital Catalogs

_The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for "fair use" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials._

##### `GET /digital-catalogs`

A list of all digital-catalogs sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#digital-catalogs).

###### Available parameters:

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
            "id": 2,
            "api_model": "digital-catalogs",
            "api_link": "https://api.artic.edu/api/v1/digital-catalogs/2",
            "title": "American Silver",
            "is_published": true,
            "type": null,
            ...
        },
        {
            "id": 5,
            "api_model": "digital-catalogs",
            "api_link": "https://api.artic.edu/api/v1/digital-catalogs/5",
            "title": "Roman Art at the Art Institute of Chicago",
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

##### `GET /digital-catalogs/search`

Search digital-catalogs data in the aggregator. 

###### Available parameters:

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
            "api_link": "https://api.artic.edu/api/v1/digital-catalogs/2",
            "id": 2,
            "title": "American Silver",
            "timestamp": "2020-08-12T05:15:07-05:00"
        },
        {
            "_score": 1,
            "api_model": "digital-catalogs",
            "api_link": "https://api.artic.edu/api/v1/digital-catalogs/3",
            "id": 3,
            "title": "Modern Series: Go",
            "timestamp": "2020-08-12T05:15:07-05:00"
        },
        {
            "_score": 1,
            "api_model": "digital-catalogs",
            "api_link": "https://api.artic.edu/api/v1/digital-catalogs/4",
            "id": 4,
            "title": "Manet Paintings and Works on Paper at the Art Institute of Chicago",
            "timestamp": "2020-08-12T05:15:07-05:00"
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

##### `GET /digital-catalogs/{id}`

A single digital-catalog by the given identifier.

::: details Example request: https://api.artic.edu/api/v1/digital-catalogs/2?limit=2  
```js
{
    "data": {
        "id": 2,
        "api_model": "digital-catalogs",
        "api_link": "https://api.artic.edu/api/v1/digital-catalogs/2",
        "title": "American Silver",
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

#### Printed Catalogs

_The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for "fair use" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials._

##### `GET /printed-catalogs`

A list of all printed-catalogs sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](fields#printed-catalogs).

###### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

::: details Example request: https://api.artic.edu/api/v1/printed-catalogs?limit=2  
```js
{
    "pagination": {
        "total": 181,
        "limit": 2,
        "offset": 0,
        "total_pages": 91,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/printed-catalogs?page=2&limit=2"
    },
    "data": [
        {
            "id": 41,
            "api_model": "printed-catalogs",
            "api_link": "https://api.artic.edu/api/v1/printed-catalogs/41",
            "title": "2001: Building for Space Travel",
            "is_published": true,
            "type": null,
            ...
        },
        {
            "id": 39,
            "api_model": "printed-catalogs",
            "api_link": "https://api.artic.edu/api/v1/printed-catalogs/39",
            "title": "1945: Creativity and Crisis, Chicago Architecture and Design of the World War II Era",
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

##### `GET /printed-catalogs/search`

Search printed-catalogs data in the aggregator. 

###### Available parameters:

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
            "api_link": "https://api.artic.edu/api/v1/printed-catalogs/4",
            "id": 4,
            "title": "The Art Institute of Chicago: The Essential Guide",
            "timestamp": "2020-08-12T05:15:07-05:00"
        },
        {
            "_score": 1,
            "api_model": "printed-catalogs",
            "api_link": "https://api.artic.edu/api/v1/printed-catalogs/5",
            "id": 5,
            "title": "Roy Lichtenstein: A Retrospective",
            "timestamp": "2020-08-12T05:15:07-05:00"
        },
        {
            "_score": 1,
            "api_model": "printed-catalogs",
            "api_link": "https://api.artic.edu/api/v1/printed-catalogs/6",
            "id": 6,
            "title": "Dawoud Bey: Harlem, U.S.A.",
            "timestamp": "2020-08-12T05:15:07-05:00"
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

##### `GET /printed-catalogs/{id}`

A single printed-catalog by the given identifier.

::: details Example request: https://api.artic.edu/api/v1/printed-catalogs/41?limit=2  
```js
{
    "data": {
        "id": 41,
        "api_model": "printed-catalogs",
        "api_link": "https://api.artic.edu/api/v1/printed-catalogs/41",
        "title": "2001: Building for Space Travel",
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

