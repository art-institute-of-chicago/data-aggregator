## Endpoints

### Collections

#### Artworks

_The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu._

##### `GET /artworks`

A list of all artworks sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](#artworks-2).

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
        "total": 295,
        "limit": 10,
        "offset": 0,
        "total_pages": 30,
        "current_page": 1
    },
    "data": [
        {
            "_score": 248.15005,
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
            "timestamp": "2020-08-26T03:02:44-05:00"
        },
        {
            "_score": 229.91185,
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
            "timestamp": "2020-08-26T03:02:44-05:00"
        },
        {
            "_score": 227.37732,
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
            "timestamp": "2020-08-26T03:11:40-05:00"
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

A list of all agents sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](#agents-2).

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
        "total": 14119,
        "limit": 10,
        "offset": 0,
        "total_pages": 1412,
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
            "api_link": "https://api.artic.edu/api/v1/agents/2",
            "id": 2,
            "title": "Antiquarian Society",
            "timestamp": "2020-08-26T03:41:41-05:00"
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

A list of all places sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](#places-2).

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
        "total": 3924,
        "limit": 10,
        "offset": 0,
        "total_pages": 393,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "places",
            "api_link": "https://api.artic.edu/api/v1/places/-2147483613",
            "id": -2147483613,
            "title": "Peoria",
            "timestamp": "2020-08-26T03:43:24-05:00"
        },
        {
            "_score": 1,
            "api_model": "places",
            "api_link": "https://api.artic.edu/api/v1/places/-2147483581",
            "id": -2147483581,
            "title": "Askov",
            "timestamp": "2020-08-26T03:43:24-05:00"
        },
        {
            "_score": 1,
            "api_model": "places",
            "api_link": "https://api.artic.edu/api/v1/places/-2147483534",
            "id": -2147483534,
            "title": "Z\u00fcrich",
            "timestamp": "2020-08-26T03:43:24-05:00"
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

A list of all galleries sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](#galleries-2).

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
            "timestamp": "2020-08-26T03:43:27-05:00"
        },
        {
            "_score": 1,
            "api_model": "galleries",
            "api_link": "https://api.artic.edu/api/v1/galleries/346",
            "id": 346,
            "title": "Stock Exchange Trading Room",
            "timestamp": "2020-08-26T03:43:27-05:00"
        },
        {
            "_score": 1,
            "api_model": "galleries",
            "api_link": "https://api.artic.edu/api/v1/galleries/2705",
            "id": 2705,
            "title": "Gallery 59",
            "timestamp": "2020-08-26T03:43:27-05:00"
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

A list of all exhibitions sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](#exhibitions-2).

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
        "total": 6082,
        "limit": 2,
        "offset": 0,
        "total_pages": 3041,
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
            "description": null,
            ...
        },
        {
            "id": 3070,
            "api_model": "exhibitions",
            "api_link": "https://api.artic.edu/api/v1/exhibitions/3070",
            "title": "Van Gogh",
            "is_featured": false,
            "description": "When Vincent van Gogh decided to become an artist at the age of 27, he had already lived in 16 cities and had failed at five different professions. Though finally settled in his career, his home life was anything but\u2014Van Gogh remained a wanderer until his death 10 years later, despite his dream of a permanent home. With each move, the change in environment took his artistic aesthetic in a new direction. \n\nTo complement the exhibition Van Gogh\u2019s Bedrooms, which explores the theme of home in the artist\u2019s oeuvre, the Ryerson and Burnham Libraries present Van Gogh: In Search Of, a focused exhibition featuring photographs of the many residences and locales Van Gogh frequented over the course of his artistic career. \n\nThe selection of images, drawn largely from the libraries\u2019 own archives, were made possible by a friendship established between the Art Institute and the Van Gogh family in the 1940s. While preparing for a Van Gogh exhibition at the museum in 1949, Art Institute Director Daniel Catton Rich and Public Relations Counsel Peter Pollack visited the artist\u2019s nephew, Vincent Willem van Gogh, to ask for a loan of many of his uncle's paintings for the show. A close friendship among the men developed, and the three of them set out to visit most of the sites captured by the famous artist in his fabulous paintings. These site visits were documented by Pollack, a trained photographer. This remarkable assemblage of images offers a unique glimpse into the artist's life seen through the lens of the photographer.",
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
            "api_link": "https://api.artic.edu/api/v1/exhibitions/1953",
            "id": 1953,
            "title": "Strokes of Genius: Italian Drawings from the Goldman Collection",
            "timestamp": "2020-08-26T03:43:36-05:00"
        },
        {
            "_score": 1,
            "api_model": "exhibitions",
            "api_link": "https://api.artic.edu/api/v1/exhibitions/1959",
            "id": 1959,
            "title": "Renoir\u2019s True Colors: Science Solves a Mystery",
            "timestamp": "2020-08-26T03:43:36-05:00"
        },
        {
            "_score": 1,
            "api_model": "exhibitions",
            "api_link": "https://api.artic.edu/api/v1/exhibitions/1977",
            "id": 1977,
            "title": "Devouring Books",
            "timestamp": "2020-08-26T03:43:36-05:00"
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
        "description": null,
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

A list of all agent-types sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](#agent-types-2).

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

A list of all agent-roles sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](#agent-roles-2).

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

A list of all agent-place-qualifiers sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](#agent-place-qualifiers-2).

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

A list of all artwork-types sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](#artwork-types-2).

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

A list of all artwork-place-qualifiers sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](#artwork-place-qualifiers-2).

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

A list of all artwork-date-qualifiers sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](#artwork-date-qualifiers-2).

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

A list of all catalogues sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](#catalogues-2).

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

A list of all category-terms sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](#category-terms-2).

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
        "total": 9187,
        "limit": 10,
        "offset": 0,
        "total_pages": 919,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "category-terms",
            "api_link": "https://api.artic.edu/api/v1/category-terms/TM-10316",
            "id": "TM-10316",
            "title": "liturgical - buddhist",
            "timestamp": "2020-08-26T03:44:44-05:00"
        },
        {
            "_score": 1,
            "api_model": "category-terms",
            "api_link": "https://api.artic.edu/api/v1/category-terms/TM-10317",
            "id": "TM-10317",
            "title": "liturgical",
            "timestamp": "2020-08-26T03:44:44-05:00"
        },
        {
            "_score": 1,
            "api_model": "category-terms",
            "api_link": "https://api.artic.edu/api/v1/category-terms/TM-10339",
            "id": "TM-10339",
            "title": "struck",
            "timestamp": "2020-08-26T03:44:44-05:00"
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

A list of all assets sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](#assets-2).

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

A list of all images sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](#images-2).

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
        "total": 142105,
        "limit": 10,
        "offset": 0,
        "total_pages": 14211,
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

A list of all videos sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](#videos-2).

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
            "timestamp": "2020-08-26T05:02:58-05:00"
        },
        {
            "_score": 1,
            "api_model": "videos",
            "api_link": "https://api.artic.edu/api/v1/videos/c051f71e-2b69-ac68-9aa8-99410d91f3f3",
            "id": "c051f71e-2b69-ac68-9aa8-99410d91f3f3",
            "title": "Under Cover: The Science of Van Gogh's Bedroom",
            "timestamp": "2020-08-26T05:02:58-05:00"
        },
        {
            "_score": 1,
            "api_model": "videos",
            "api_link": "https://api.artic.edu/api/v1/videos/c5700df1-473c-c1cd-ab1b-79b20a32fc27",
            "id": "c5700df1-473c-c1cd-ab1b-79b20a32fc27",
            "title": "Online Game: Winslow Homer's <em>The Water Fan</em>",
            "timestamp": "2020-08-26T05:02:58-05:00"
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

A list of all sounds sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](#sounds-2).

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
            "timestamp": "2020-08-26T05:03:01-05:00"
        },
        {
            "_score": 1,
            "api_model": "sounds",
            "api_link": "https://api.artic.edu/api/v1/sounds/31c370a9-98de-3533-c14e-c91776c8bf82",
            "id": "31c370a9-98de-3533-c14e-c91776c8bf82",
            "title": "Audio Lecture: Mel Bochner Symposium, Introduction and Keynote",
            "timestamp": "2020-08-26T05:03:01-05:00"
        },
        {
            "_score": 1,
            "api_model": "sounds",
            "api_link": "https://api.artic.edu/api/v1/sounds/31ee173d-cd35-88ef-9362-61722a5e10bf",
            "id": "31ee173d-cd35-88ef-9362-61722a5e10bf",
            "title": "Audio stop 442.wav",
            "timestamp": "2020-08-26T05:03:01-05:00"
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

A list of all texts sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](#texts-2).

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
            "api_link": "https://api.artic.edu/api/v1/texts/003a874b-1325-1ae5-5679-568e2fa377fa",
            "id": "003a874b-1325-1ae5-5679-568e2fa377fa",
            "title": "AIC1926ChiArExh39thAn_comb.pdf",
            "timestamp": "2020-08-26T05:03:13-05:00"
        },
        {
            "_score": 1,
            "api_model": "texts",
            "api_link": "https://api.artic.edu/api/v1/texts/00412027-e9c3-c75b-4304-a8f362b31d7d",
            "id": "00412027-e9c3-c75b-4304-a8f362b31d7d",
            "title": "Audio Transcript 218.txt",
            "timestamp": "2020-08-26T05:03:13-05:00"
        },
        {
            "_score": 1,
            "api_model": "texts",
            "api_link": "https://api.artic.edu/api/v1/texts/006e038b-dd9e-c2b8-8dfd-21fa34d3660d",
            "id": "006e038b-dd9e-c2b8-8dfd-21fa34d3660d",
            "title": "AIC1926FSchofield_comb.pdf",
            "timestamp": "2020-08-26T05:03:13-05:00"
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

A list of all shop-categories sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](#shop-categories-2).

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
            "timestamp": "2020-08-26T05:03:21-05:00"
        },
        {
            "_score": 1,
            "api_model": "shop-categories",
            "api_link": "https://api.artic.edu/api/v1/shop-categories/3",
            "id": 3,
            "title": "Fashion & Accessories",
            "timestamp": "2020-08-26T05:03:21-05:00"
        },
        {
            "_score": 1,
            "api_model": "shop-categories",
            "api_link": "https://api.artic.edu/api/v1/shop-categories/4",
            "id": 4,
            "title": "Decor",
            "timestamp": "2020-08-26T05:03:21-05:00"
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

A list of all products sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](#products-2).

###### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

::: details Example request: https://api.artic.edu/api/v1/products?limit=2  
```js
{
    "pagination": {
        "total": 1,
        "limit": 2,
        "offset": 0,
        "total_pages": 1,
        "current_page": 1
    },
    "data": [
        {
            "id": 64,
            "api_model": "products",
            "api_link": "https://api.artic.edu/api/v1/products/64",
            "title": "Chagall America Windows Silk Tie",
            "title_sort": null,
            "parent_id": null,
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
        "total": 6975,
        "limit": 10,
        "offset": 0,
        "total_pages": 698,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "products",
            "api_link": "https://api.artic.edu/api/v1/products/411",
            "id": 411,
            "title": "Silver Scribble Tree Pin",
            "timestamp": "2020-08-26T05:03:22-05:00"
        },
        {
            "_score": 1,
            "api_model": "products",
            "api_link": "https://api.artic.edu/api/v1/products/412",
            "id": 412,
            "title": "Snowman Pin",
            "timestamp": "2020-08-26T05:03:22-05:00"
        },
        {
            "_score": 1,
            "api_model": "products",
            "api_link": "https://api.artic.edu/api/v1/products/414",
            "id": 414,
            "title": "Pussy Willow Necklace",
            "timestamp": "2020-08-26T05:03:22-05:00"
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

::: details Example request: https://api.artic.edu/api/v1/products/64?limit=2  
```js
{
    "data": {
        "id": 64,
        "api_model": "products",
        "api_link": "https://api.artic.edu/api/v1/products/64",
        "title": "Chagall America Windows Silk Tie",
        "title_sort": null,
        "parent_id": null,
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

A list of all tours sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](#tours-2).

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

A list of all mobile-sounds sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](#mobile-sounds-2).

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
        "total": 792,
        "limit": 10,
        "offset": 0,
        "total_pages": 80,
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
            "timestamp": "2020-08-26T05:03:50-05:00"
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

A list of all publications sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](#publications-2).

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
            "timestamp": "2020-08-26T05:03:55-05:00"
        },
        {
            "_score": 1,
            "api_model": "publications",
            "api_link": "https://api.artic.edu/api/v1/publications/7",
            "id": 7,
            "title": "Pissarro Paintings and Works on Paper at the Art Institute of Chicago",
            "timestamp": "2020-08-26T05:03:55-05:00"
        },
        {
            "_score": 1,
            "api_model": "publications",
            "api_link": "https://api.artic.edu/api/v1/publications/12",
            "id": 12,
            "title": "The Modern Series at the Art Institute of Chicago",
            "timestamp": "2020-08-26T05:03:55-05:00"
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

A list of all sections sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](#sections-2).

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
            "api_link": "https://api.artic.edu/api/v1/sections/464649",
            "id": 464649,
            "title": "Acknowledgments",
            "timestamp": "2020-08-26T05:03:58-05:00"
        },
        {
            "_score": 1,
            "api_model": "sections",
            "api_link": "https://api.artic.edu/api/v1/sections/466580",
            "id": 466580,
            "title": "Introduction",
            "timestamp": "2020-08-26T05:03:58-05:00"
        },
        {
            "_score": 1,
            "api_model": "sections",
            "api_link": "https://api.artic.edu/api/v1/sections/467547",
            "id": 467547,
            "title": "Works of Art",
            "timestamp": "2020-08-26T05:03:58-05:00"
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

A list of all sites sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](#sites-2).

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
            "timestamp": "2020-08-26T05:04:10-05:00"
        },
        {
            "_score": 1,
            "api_model": "sites",
            "api_link": "https://api.artic.edu/api/v1/sites/2",
            "id": 2,
            "title": "American Perspectives: A yearlong celebration of American artistic vision",
            "timestamp": "2020-08-26T05:04:10-05:00"
        },
        {
            "_score": 1,
            "api_model": "sites",
            "api_link": "https://api.artic.edu/api/v1/sites/3",
            "id": 3,
            "title": "Curious Corner",
            "timestamp": "2020-08-26T05:04:10-05:00"
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

A list of all closures sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](#closures-2).

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
            "timestamp": "2020-08-26T05:04:11-05:00"
        },
        {
            "_score": 1,
            "api_model": "closures",
            "api_link": "https://api.artic.edu/api/v1/closures/5",
            "id": 5,
            "title": "Lorem ipsum.",
            "timestamp": "2020-08-26T05:04:11-05:00"
        },
        {
            "_score": 1,
            "api_model": "closures",
            "api_link": "https://api.artic.edu/api/v1/closures/9",
            "id": 9,
            "title": "Lorem ipsum.",
            "timestamp": "2020-08-26T05:04:11-05:00"
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

A list of all web-exhibitions sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](#web-exhibitions-2).

###### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

::: details Example request: https://api.artic.edu/api/v1/web-exhibitions?limit=2  
```js
{
    "pagination": {
        "total": 387,
        "limit": 2,
        "offset": 0,
        "total_pages": 194,
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
            "id": 66,
            "api_model": "web-exhibitions",
            "api_link": "https://api.artic.edu/api/v1/web-exhibitions/66",
            "title": "Tools of the Trade: 19th- and 20th- Century Architectural Trade Catalogs",
            "exhibition_id": 2999,
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
            "timestamp": "2020-08-26T05:04:11-05:00"
        },
        {
            "_score": 1,
            "api_model": "web-exhibitions",
            "api_link": "https://api.artic.edu/api/v1/web-exhibitions/2",
            "id": 2,
            "title": "Manet and Modern Beauty",
            "timestamp": "2020-08-26T05:04:11-05:00"
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

A list of all events sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](#events-2).

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
        "total": 105,
        "limit": 2,
        "offset": 0,
        "total_pages": 53,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/events?page=2&limit=2"
    },
    "data": [
        {
            "id": 4,
            "api_model": "events",
            "api_link": "https://api.artic.edu/api/v1/events/4",
            "title": "Member Preview: John Singer Sargent and Chicago\u2019s Gilded Age",
            "title_display": null,
            "image_url": "https://artic-web.imgix.net/22a002db-9695-452b-9c85-7a63644df4e0/G35154-int_press.jpg?rect=0%2C349%2C2334%2C1312&auto=compress&fm=jpg&q=80&fit=crop&crop=faces%2Cedges%2Centropy&w=1200&h=675",
            ...
        },
        {
            "id": 2995,
            "api_model": "events",
            "api_link": "https://api.artic.edu/api/v1/events/2995",
            "title": "Screening: H\u00e9lio Oiticica",
            "title_display": null,
            "image_url": null,
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
        "total": 1983,
        "limit": 10,
        "offset": 0,
        "total_pages": 199,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "events",
            "api_link": "https://api.artic.edu/api/v1/events/4207",
            "id": 4207,
            "title": "Gallery Talk: Dawoud Bey: Night Coming Tenderly, Black",
            "timestamp": "2020-08-26T05:04:19-05:00"
        },
        {
            "_score": 1,
            "api_model": "events",
            "api_link": "https://api.artic.edu/api/v1/events/4208",
            "id": 4208,
            "title": "One Book, One Chicago Program: Into the Void",
            "timestamp": "2020-08-26T05:04:19-05:00"
        },
        {
            "_score": 1,
            "api_model": "events",
            "api_link": "https://api.artic.edu/api/v1/events/4209",
            "id": 4209,
            "title": "Lecture: Secrets of the Collection\u2014Conserving Photographs",
            "timestamp": "2020-08-26T05:04:19-05:00"
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

::: details Example request: https://api.artic.edu/api/v1/events/4?limit=2  
```js
{
    "data": {
        "id": 4,
        "api_model": "events",
        "api_link": "https://api.artic.edu/api/v1/events/4",
        "title": "Member Preview: John Singer Sargent and Chicago\u2019s Gilded Age",
        "title_display": null,
        "image_url": "https://artic-web.imgix.net/22a002db-9695-452b-9c85-7a63644df4e0/G35154-int_press.jpg?rect=0%2C349%2C2334%2C1312&auto=compress&fm=jpg&q=80&fit=crop&crop=faces%2Cedges%2Centropy&w=1200&h=675",
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

A list of all event-occurrences sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](#event-occurrences-2).

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
        "total": 7,
        "limit": 10,
        "offset": 0,
        "total_pages": 1,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "event-occurrences",
            "api_link": "https://api.artic.edu/api/v1/event-occurrences/001379c7-0f99-5ef5-ab95-ba02114f63d8",
            "id": "001379c7-0f99-5ef5-ab95-ba02114f63d8",
            "title": "Member Preview: Monet and Chicago",
            "timestamp": "2020-08-26T05:04:23-05:00"
        },
        {
            "_score": 1,
            "api_model": "event-occurrences",
            "api_link": "https://api.artic.edu/api/v1/event-occurrences/3c2fd868-71e9-5ae8-8547-c47f16dc1c73",
            "id": "3c2fd868-71e9-5ae8-8547-c47f16dc1c73",
            "title": "Member Double Discount Day",
            "timestamp": "2020-08-26T05:04:23-05:00"
        },
        {
            "_score": 1,
            "api_model": "event-occurrences",
            "api_link": "https://api.artic.edu/api/v1/event-occurrences/477a6b63-6439-5992-8ba3-a47428d31881",
            "id": "477a6b63-6439-5992-8ba3-a47428d31881",
            "title": "Conservation Perspectives: Malangatana\u2014Mozambique Modern",
            "timestamp": "2020-08-26T05:04:23-05:00"
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

A list of all event-programs sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](#event-programs-2).

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
            "timestamp": "2020-08-26T05:04:23-05:00"
        },
        {
            "_score": 1,
            "api_model": "event-programs",
            "api_link": "https://api.artic.edu/api/v1/event-programs/2",
            "id": 2,
            "title": "Family Festivals",
            "timestamp": "2020-08-26T05:04:23-05:00"
        },
        {
            "_score": 1,
            "api_model": "event-programs",
            "api_link": "https://api.artic.edu/api/v1/event-programs/3",
            "id": 3,
            "title": "Picture This",
            "timestamp": "2020-08-26T05:04:23-05:00"
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

A list of all articles sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](#articles-2).

###### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

::: details Example request: https://api.artic.edu/api/v1/articles?limit=2  
```js
{
    "pagination": {
        "total": 253,
        "limit": 2,
        "offset": 0,
        "total_pages": 127,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/articles?page=2&limit=2"
    },
    "data": [
        {
            "id": 705,
            "api_model": "articles",
            "api_link": "https://api.artic.edu/api/v1/articles/705",
            "title": "hidden-materials-in-john-singer-sargents-watercolors",
            "date": "2018-08-01T00:00:00-05:00",
            "copy": " While John Singer Sargent is most widely known for his oil portraits of august men and women in fashionable interiors, he cultivated a love of painting outdoors from an early age. As a boy he recorded his family\u2019s European travels in sketchbooks, and as his talent and repertoire grew, he acquired numerous accoutrements such as portable easels, sketching umbrellas, rigid pads of paper, and compact palettes of watercolors that allowed him to paint multiple pictures during one outing, even in challenging conditions. In fact, Sargent was an official war artist for Britain during World War I and spent four months on the front painting and sketching.   A fellow war artist, Henry Tonks, painted this watercolor caricature of Sargent in 1918, depicting the artist clothed in army greens and shielded by a sketching umbrella that Sargent camouflaged for the purpose. The painting (held in the collection of the Museum of Fine Arts in Boston, and not a part of this exhibition) gives new meaning to challenging conditions\u2014and shows us a glimpse of Sargent\u2019s life apart from glamorous portraits.   In preparation for the current exhibition John Singer Sargent and Chicago\u2019s Gilded Age , Art Institute curators, conservators, and conservation scientists examined some of Sargent\u2019s paintings and investigated his less obvious materials, finding evidence that provides valuable insight into the artist\u2019s working process. A Newsworthy Surprise Sargent captured hundreds of landscapes in watercolor as he traveled across Europe and North America. In 1908 he painted Tarragona Terrace and Garden when he visited the eastern coast of Spain. Seated in the arcade of Tarragona\u2019s cathedral, Sargent made a quick study of its columns.   While he generally preferred to leave parts of the paper bare to delineate highlights, the foliage in the upper left corner of this picture was painted using a different technique. Here it appears that Sargent simply laid in a mass of greens and browns and then returned with an opaque, zinc white paint to create his highlights. In order to fully conceal the dark colors underneath, Sargent had to use thick dabs of white as if he were making a correction in oils. Sargent often made multiple paintings in one day and would interleave his paintings with sheets of newspaper for protection as he carried them. He did this with Tarragona Terrace and Garden , perhaps not realizing that the thickly applied areas of paint had not dried completely when he laid the newspaper on its surface. As an unintended consequence, fragments from a Spanish newspaper stuck to the painting, remnants of Sargent\u2019s panting process that survive today.   In normal light these tiny pieces of newsprint are barely noticeable, but they stand out in an infrared photograph, which makes some of the Spanish text almost legible.   Wax in a Watercolor Nearly 10 years after he painted Tarragona Terrace and Garden , Sargent made another series of stunning architectural studies while visiting his friends Charles and James Deering in Florida. Sargent was drawn to Vizcaya, the lavish estate that James had recently built, not least of all because it reminded him of the Italian landscapes and gardens that he loved to paint.   Analytical instruments in the conservation science lab at the Art Institute can help answer a lot of questions about artists\u2019 materials. In the case of this work, scientists sought more information about a soft, translucent material found in discrete areas on its surface. The material was analyzed and determined to be a wax, which Sargent used as a \u201cresist\u201d\u2014meaning that he marked the paper with a transparent material that would repel the water-based paint and leave highlights in the composition.   Analysis also revealed that the wax is a type called spermaceti, a product obtained from sperm whales and a major commercial product of the whaling industry. In Sargent\u2019s time this wax was commonly used to make candles. Finding it here helps to explain Sargent\u2019s process\u2014because spermaceti is softer than other common waxes such as beeswax, it would have been the logical choice for use as a drawing material. To learn more about Sargent\u2019s process and materials come visit John Singer Sargent and Chicago\u2019s Gilded Age in the Art Institute\u2019s Regenstein Hall through September 30, and check out the technical essay in the exhibition catalogue . \u2014Mary Broadway, associate conservator of prints and drawings ",
            ...
        },
        {
            "id": 696,
            "api_model": "articles",
            "api_link": "https://api.artic.edu/api/v1/articles/696",
            "title": "encounter-with-unusual-photo-paper",
            "date": "2018-06-13T00:00:00-05:00",
            "copy": " Recently, a photograph by Kenneth Heilbron (American, 1903\u20131997), was brought to the photography conservation lab to be prepared for exhibition. Heilbron, a Chicago-based photographer who became the School of the Art Institute\u2019s first instructor of photography in 1939, was perhaps best known for his assignment work for Time , Fortune , and Life magazines. This 1940s image of two women standing along Michigan Avenue typifies the advertising work that Heilbron did for Chicago\u2019s Marshall Field\u2019s department store.   One of the most interesting and challenging aspects of photography conservation is to properly identify photographic processes, which differ not only in terms of the visual images they produce but in the materials used to create the print. Accurate knowledge of process is essential because it impacts the conservator\u2019s approach, as different materials sometimes require different treatments. Observing the print under the stereomicroscope, I discovered a very porous surface unlike that of any photographic paper I had seen before. With the help of the department\u2019s senior conservator, Sylvie Penichon, the paper was identified as Gevaluxe Velours, a photographic paper produced in Belgium between 1930 and 1950 by Gevaert Photo-Producten NV. Its unusual surface was created by dusting fibrous material on a sheet of paper coated with adhesive before it was sensitized. Under the microscope, the surface of the paper looks extremely fragile and soft, but it is actually quite rough to the touch\u2014a little like sandpaper. Unlike sandpaper, however, it will easily scratch if a hard object comes in contact with the surface. The damage can be superficial\u2014surface fibers may be disrupted and reflect light differently. Or the fiber can be completely removed, creating a loss that exposes the white underlying paper support. Once the structure and materials of the photographic paper were determined, I began conservation treatment based on two main criteria: long-term stability and visual appearance. First, the cardboard support on which the print is mounted was cleaned, and the delaminated and brittle edges were repaired with wheat starch paste\u2014a very stable, reversible, and long-lasting adhesive commonly used in conservation. Then, under the microscope and with the help of tweezers, I removed, one by one, every fiber and visible dust spec that was caught in the fibrous material.   The scratches were then inpainted using a very fine brush and watercolors. The first tests were done under the stereomicroscope, but once I understood how the surface was reacting to the application of paint, I completed the inpainting on an easel using magnifiers. The tone was then gradually built up with successive thin applications of color. This technique ensured that the inpainting blended in and would be virtually undetectable. The key with this technique is to know when to stop!   By cleaning the surface of the print and reducing the appearance of the scratches, the subject of the photograph\u2014as well as its unique surface\u2014can be fully appreciated.   This interesting print is currently on display in Gallery 10, where a selection of highlights of the Art Institute photography collection complements the exhibition Never a Lovely So Real: Photography and Film in Chicago, 1950\u20131980 . It marks the first time this photograph has been on view since it was acquired in 2000. Come and see it in person! \u2014Marie-Lou Beauchamp, Andrew W. Mellon Fellow in Photograph Conservation, Department of Photography ",
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
        "total": 276,
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
            "timestamp": "2020-08-26T05:04:24-05:00"
        },
        {
            "_score": 1,
            "api_model": "articles",
            "api_link": "https://api.artic.edu/api/v1/articles/18",
            "id": 18,
            "title": "your-move",
            "timestamp": "2020-08-26T05:04:24-05:00"
        },
        {
            "_score": 1,
            "api_model": "articles",
            "api_link": "https://api.artic.edu/api/v1/articles/26",
            "id": 26,
            "title": "secrets-of-the-modern-wing-take-two",
            "timestamp": "2020-08-26T05:04:24-05:00"
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
        "date": "2018-08-01T00:00:00-05:00",
        "copy": " While John Singer Sargent is most widely known for his oil portraits of august men and women in fashionable interiors, he cultivated a love of painting outdoors from an early age. As a boy he recorded his family\u2019s European travels in sketchbooks, and as his talent and repertoire grew, he acquired numerous accoutrements such as portable easels, sketching umbrellas, rigid pads of paper, and compact palettes of watercolors that allowed him to paint multiple pictures during one outing, even in challenging conditions. In fact, Sargent was an official war artist for Britain during World War I and spent four months on the front painting and sketching.   A fellow war artist, Henry Tonks, painted this watercolor caricature of Sargent in 1918, depicting the artist clothed in army greens and shielded by a sketching umbrella that Sargent camouflaged for the purpose. The painting (held in the collection of the Museum of Fine Arts in Boston, and not a part of this exhibition) gives new meaning to challenging conditions\u2014and shows us a glimpse of Sargent\u2019s life apart from glamorous portraits.   In preparation for the current exhibition John Singer Sargent and Chicago\u2019s Gilded Age , Art Institute curators, conservators, and conservation scientists examined some of Sargent\u2019s paintings and investigated his less obvious materials, finding evidence that provides valuable insight into the artist\u2019s working process. A Newsworthy Surprise Sargent captured hundreds of landscapes in watercolor as he traveled across Europe and North America. In 1908 he painted Tarragona Terrace and Garden when he visited the eastern coast of Spain. Seated in the arcade of Tarragona\u2019s cathedral, Sargent made a quick study of its columns.   While he generally preferred to leave parts of the paper bare to delineate highlights, the foliage in the upper left corner of this picture was painted using a different technique. Here it appears that Sargent simply laid in a mass of greens and browns and then returned with an opaque, zinc white paint to create his highlights. In order to fully conceal the dark colors underneath, Sargent had to use thick dabs of white as if he were making a correction in oils. Sargent often made multiple paintings in one day and would interleave his paintings with sheets of newspaper for protection as he carried them. He did this with Tarragona Terrace and Garden , perhaps not realizing that the thickly applied areas of paint had not dried completely when he laid the newspaper on its surface. As an unintended consequence, fragments from a Spanish newspaper stuck to the painting, remnants of Sargent\u2019s panting process that survive today.   In normal light these tiny pieces of newsprint are barely noticeable, but they stand out in an infrared photograph, which makes some of the Spanish text almost legible.   Wax in a Watercolor Nearly 10 years after he painted Tarragona Terrace and Garden , Sargent made another series of stunning architectural studies while visiting his friends Charles and James Deering in Florida. Sargent was drawn to Vizcaya, the lavish estate that James had recently built, not least of all because it reminded him of the Italian landscapes and gardens that he loved to paint.   Analytical instruments in the conservation science lab at the Art Institute can help answer a lot of questions about artists\u2019 materials. In the case of this work, scientists sought more information about a soft, translucent material found in discrete areas on its surface. The material was analyzed and determined to be a wax, which Sargent used as a \u201cresist\u201d\u2014meaning that he marked the paper with a transparent material that would repel the water-based paint and leave highlights in the composition.   Analysis also revealed that the wax is a type called spermaceti, a product obtained from sperm whales and a major commercial product of the whaling industry. In Sargent\u2019s time this wax was commonly used to make candles. Finding it here helps to explain Sargent\u2019s process\u2014because spermaceti is softer than other common waxes such as beeswax, it would have been the logical choice for use as a drawing material. To learn more about Sargent\u2019s process and materials come visit John Singer Sargent and Chicago\u2019s Gilded Age in the Art Institute\u2019s Regenstein Hall through September 30, and check out the technical essay in the exhibition catalogue . \u2014Mary Broadway, associate conservator of prints and drawings ",
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

A list of all selections sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](#selections-2).

###### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

::: details Example request: https://api.artic.edu/api/v1/selections?limit=2  
```js
{
    "pagination": {
        "total": 13,
        "limit": 2,
        "offset": 0,
        "total_pages": 7,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/selections?page=2&limit=2"
    },
    "data": [
        {
            "id": 6,
            "api_model": "selections",
            "api_link": "https://api.artic.edu/api/v1/selections/6",
            "title": "american-art",
            "short_copy": "<p>The Art Institute boasts an outstanding collection of American Art\u2014fitting for a classic American city. Find some of the icons below.</p>",
            "copy": " Please note: artworks occasionally go off view for imaging, treatment, or loan to other institutions. Click on the images to ensure the work is currently on view.   Georgia O\u2019Keeffe didn't travel in an airplane until she was in her 70s, but when she did, she was fascinated. She started a series of paintings inspired by her in-flight experiences. The works began small and progressively got bigger until the final canvas in the series, Sky above Clouds IV , which is so large that it has never traveled since coming to the Art Institute.   One of America's most famous paintings, American Gothic , debuted at the Art Institute of Chicago, winning a $300 prize and instant fame for Grant Wood. It has long been parodied and is often seen as a satirical commentary on the Midwestern character, but Wood intended it to a positive statement about rural American values. Read more about this work on our blog, where a curator answers the top five FAQs about the iconic painting.   One of the best-known images of 20th-century art, Nighthawks depicts an all-night diner in which three customers, all lost in their own thoughts, have congregated. It's unclear how or why the anonymous and uncommunicative night owls are there\u2014in fact, Hopper eliminated any reference to an entrance to the diner. The four seem as separate and remote from the viewer as they are from one another. (The red-haired woman was actually modeled by the artist\u2019s wife, Jo.)   Known today for his paintings and murals depicting Mexican political and cultural life, Diego Rivera enjoyed a brief but sparkling period as a Cubist painter early in his career. In this work he portrayed his then-lover, the Russian-born painter and writer Marevna Vorob\u00ebv-Stebelska, clearly conveying her distinctive bobbed hair, blond bangs, and prominent nose\u2014despite or with the aid of the Cubist style. Like many other artists in Paris, Rivera rejected Cubism as frivolous and inappropriate following World War I and the Russian Revolution.   A native Chicagoan and graduate of the School of the Art Institute, Archibald Motley used his art to represent the vibrancy of African American culture, frequently portraying young, sophisticated city dwellers out on the town. One of Motley\u2019s most celebrated paintings, Nightlife depicts a crowded cabaret in the South Side neighborhood of Bronzeville. The dynamic composition, intense lighting, and heightened colors vividly express the liveliness of the scene.   The only American artist invited to exhibit with the French Impressionists, Mary Cassatt concentrated on the human figure, particularly on sensitive yet unsentimental portrayals of women and children. In The Child\u2019s Bath , one of Cassatt\u2019s masterworks, she used cropped forms, bold patterns and outlines, and a flattened perspective, all of which she derived from her study of Japanese woodblock prints.   Eldzier Cortor lived in Chicago and attended the School of the Art Institute, and while drawn to abstraction, he felt that it was not an effective tool for conveying serious social and political concerns. In The Room No. VI, the artist exposes the impoverished living conditions experienced by many African Americans on the South Side through a brilliant use of line and color, reinvigorating the idiom of social realism.   Though Stuart Davis studied with the so-called Ashcan School, who sought to depict a realistic look at modern urban life, he came to embrace a more abstracted and energetic style, as seen in Ready-to-Wear . The bright colors intersect and interrupt one another in a distinctly American way: jazzy, vital, and mass produced\u2014all qualities summed up in the title.   In addition to architecture, Frank Lloyd Wright designed furniture like this chair from his home in Oak Park, Illinois. Though his early experiments were heavy, solid cube chairs, he eventually added the refinements seen in this design, such as spindles, the subtly tapering crest rail, and gently curving leg ends, all of which produce an effect that is equal parts sophistication and simplicity.   In The Herring Net, Winslow Homer depicts two fishermen at their daily yet heroic work. As the small boat rides the swells, one fisherman hauls in the heavy net while the other unloads the glistening herring, illustrating that teamwork is essential for survival on this churning sea that both gives and takes. ",
            ...
        },
        {
            "id": 5,
            "api_model": "selections",
            "api_link": "https://api.artic.edu/api/v1/selections/5",
            "title": "impressionism",
            "short_copy": "<p>The Art Institute\u2019s holdings of late 19th-century French art are among the largest and finest in the world and feature some of the most well-known and well-loved works in the museum. The works included here are highlights from our wide-ranging collection.</p>",
            "copy": " Pierre-August Renoir's painting of two boaters and their female friend enjoying a lunch alfresco is the picture of idyllic pleasure. Renoir likely created this painting during an extended stay at the restaurant it depicts\u2014the Maison Fournaise, along the Seine. He completed many scenes of boating life during this period.   In this work, Berthe Morisot captures the essence of modern life in understated terms\u2014rendering her subject with soft, feathery brushstrokes in nuanced shades of lavender, pink, blue, white, and gray. The composition resembles a visual tone poem, orchestrated with such perfumed and rarified motifs as brushed blonde hair, satins, powder puffs, and \ufb02ower petals. Morisot exhibited in seven of the eight Impressionist group shows; this painting was included in the fifth exhibition, in 1880, where her work received great acclaim.   This monumental view of a bustling Parisian intersection is considered Caillebotte\u2019s masterpiece. In it, the artist captures a scene of sweeping modernity that conveys the momentary quality of everyday life, depicting fashionable city dwellers strolling down the street on a rainy day. The painting\u2019s rigorous perspective and grand scale pleased Parisian audiences, while its asymmetry, unusually cropped forms, and rain-washed mood stimulated a more radical sensibility.   The hat\u2014a prime symbol of the modern bourgeois woman in the works of Edgar Degas\u2014also functions as a metaphor for the artistic process in this painting of a millinery shop. Degas has scraped and repainted the canvas around the woman's hands and the hat she holds to create a sense of movement. Nearby hats also remain unfinished\u2014awaiting their finishing touches in the shop, they are partially painted in broad strokes, as if Degas himself hasn't quite finished working on them.   The two girls depicted in this painting, clutching oranges tossed to them from the crowd as gifts, likely performed as acrobats in their father's famed Cirque Fernando, in Paris. Although they are painted standing in the center of a circus ring, Renoir actually painted them in his studio, where he could take full advantage of natural sunlight. Read more about this work on our blog .   Set in the Parisian suburb of Chatou, Two Sisters (On the Terrace) features a pair of young women who were not actually sisters. Pierre-Auguste Renoir juxtaposed the girls\u2019 solid, life-size figures against a dreamy, fantastic landscape. The basket of yarn to their left evokes the artist\u2019s palette, and the girls\u2019 contrasting expressions\u2014the elder\u2019s far-off stare and the younger\u2019s eager stillness\u2014make this \u201csisterly\u201d moment feel casually genuine.   There\u2019s a trick at work in this painting by \u00c9douard Manet of a woman sitting in a Parisian caf\u00e9\u2014the scene behind her is actually one of Manet\u2019s paintings, and the table, magazine, and other objects are props set up in Manet\u2019s studio. This highly Impressionistic painting, with its free brushstrokes and light colors, is typical of Manet\u2019s later works.   This scene of the Grande Jatte, an island in the Seine just outside of Paris where city residents sought rest and recreation, is considered Georges Seurat's greatest work. Seurat labored extensively over A Sunday on La Grande Jatte\u20141884 , reworking the original and completing numerous preliminary drawings and oil sketches . Inspired by research in optical and color theory, he juxtaposed tiny dabs of colors that, through optical blending, form a single and, he believed, more brilliantly luminous hue.   In 1888, Vincent van Gogh moved into a new house in Arles, France which he dubbed the \"Studio of the South\" in the hope that friends and artists would join him there. He immediately set to work on the house and painted this bedroom scene as a part of his decorating scheme. This sun-drenched composition with its vivid palette, dramatic perspective, and dynamic brushwork seems ready to burst with an intense, nervous vitality. Van Gogh liked this image so much that he painted three distinct versions\u2014the other two are held in the collections of the Van Gogh Museum in Amsterdam and the Mus\u00e9e d'Orsay in Paris. ",
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
            "timestamp": "2020-08-26T05:04:25-05:00"
        },
        {
            "_score": 1,
            "api_model": "selections",
            "api_link": "https://api.artic.edu/api/v1/selections/4",
            "id": 4,
            "title": "new-acquisitions",
            "timestamp": "2020-08-26T05:04:25-05:00"
        },
        {
            "_score": 1,
            "api_model": "selections",
            "api_link": "https://api.artic.edu/api/v1/selections/5",
            "id": 5,
            "title": "impressionism",
            "timestamp": "2020-08-26T05:04:25-05:00"
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
        "short_copy": "<p>The Art Institute boasts an outstanding collection of American Art\u2014fitting for a classic American city. Find some of the icons below.</p>",
        "copy": " Please note: artworks occasionally go off view for imaging, treatment, or loan to other institutions. Click on the images to ensure the work is currently on view.   Georgia O\u2019Keeffe didn't travel in an airplane until she was in her 70s, but when she did, she was fascinated. She started a series of paintings inspired by her in-flight experiences. The works began small and progressively got bigger until the final canvas in the series, Sky above Clouds IV , which is so large that it has never traveled since coming to the Art Institute.   One of America's most famous paintings, American Gothic , debuted at the Art Institute of Chicago, winning a $300 prize and instant fame for Grant Wood. It has long been parodied and is often seen as a satirical commentary on the Midwestern character, but Wood intended it to a positive statement about rural American values. Read more about this work on our blog, where a curator answers the top five FAQs about the iconic painting.   One of the best-known images of 20th-century art, Nighthawks depicts an all-night diner in which three customers, all lost in their own thoughts, have congregated. It's unclear how or why the anonymous and uncommunicative night owls are there\u2014in fact, Hopper eliminated any reference to an entrance to the diner. The four seem as separate and remote from the viewer as they are from one another. (The red-haired woman was actually modeled by the artist\u2019s wife, Jo.)   Known today for his paintings and murals depicting Mexican political and cultural life, Diego Rivera enjoyed a brief but sparkling period as a Cubist painter early in his career. In this work he portrayed his then-lover, the Russian-born painter and writer Marevna Vorob\u00ebv-Stebelska, clearly conveying her distinctive bobbed hair, blond bangs, and prominent nose\u2014despite or with the aid of the Cubist style. Like many other artists in Paris, Rivera rejected Cubism as frivolous and inappropriate following World War I and the Russian Revolution.   A native Chicagoan and graduate of the School of the Art Institute, Archibald Motley used his art to represent the vibrancy of African American culture, frequently portraying young, sophisticated city dwellers out on the town. One of Motley\u2019s most celebrated paintings, Nightlife depicts a crowded cabaret in the South Side neighborhood of Bronzeville. The dynamic composition, intense lighting, and heightened colors vividly express the liveliness of the scene.   The only American artist invited to exhibit with the French Impressionists, Mary Cassatt concentrated on the human figure, particularly on sensitive yet unsentimental portrayals of women and children. In The Child\u2019s Bath , one of Cassatt\u2019s masterworks, she used cropped forms, bold patterns and outlines, and a flattened perspective, all of which she derived from her study of Japanese woodblock prints.   Eldzier Cortor lived in Chicago and attended the School of the Art Institute, and while drawn to abstraction, he felt that it was not an effective tool for conveying serious social and political concerns. In The Room No. VI, the artist exposes the impoverished living conditions experienced by many African Americans on the South Side through a brilliant use of line and color, reinvigorating the idiom of social realism.   Though Stuart Davis studied with the so-called Ashcan School, who sought to depict a realistic look at modern urban life, he came to embrace a more abstracted and energetic style, as seen in Ready-to-Wear . The bright colors intersect and interrupt one another in a distinctly American way: jazzy, vital, and mass produced\u2014all qualities summed up in the title.   In addition to architecture, Frank Lloyd Wright designed furniture like this chair from his home in Oak Park, Illinois. Though his early experiments were heavy, solid cube chairs, he eventually added the refinements seen in this design, such as spindles, the subtly tapering crest rail, and gently curving leg ends, all of which produce an effect that is equal parts sophistication and simplicity.   In The Herring Net, Winslow Homer depicts two fishermen at their daily yet heroic work. As the small boat rides the swells, one fisherman hauls in the heavy net while the other unloads the glistening herring, illustrating that teamwork is essential for survival on this churning sea that both gives and takes. ",
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

A list of all web-artists sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](#web-artists-2).

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
        "total": 107,
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
            "timestamp": "2020-08-26T05:04:25-05:00"
        },
        {
            "_score": 1,
            "api_model": "web-artists",
            "api_link": "https://api.artic.edu/api/v1/web-artists/2",
            "id": 2,
            "title": "Don A. DuBroff",
            "timestamp": "2020-08-26T05:04:25-05:00"
        },
        {
            "_score": 1,
            "api_model": "web-artists",
            "api_link": "https://api.artic.edu/api/v1/web-artists/3",
            "id": 3,
            "title": "Neue Galerie New York",
            "timestamp": "2020-08-26T05:04:25-05:00"
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

A list of all static-pages sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](#static-pages-2).

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
            "last_updated_source": null,
            ...
        },
        {
            "id": 8,
            "api_model": "static-pages",
            "api_link": "https://api.artic.edu/api/v1/static-pages/8",
            "title": "Digital Publications",
            "web_url": "/digital-publications",
            "last_updated_source": null,
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
            "timestamp": "2020-08-26T09:00:08-05:00"
        },
        {
            "_score": 1,
            "api_model": "static-pages",
            "api_link": "https://api.artic.edu/api/v1/static-pages/2",
            "id": 2,
            "title": "Events",
            "timestamp": "2020-08-26T09:00:08-05:00"
        },
        {
            "_score": 1,
            "api_model": "static-pages",
            "api_link": "https://api.artic.edu/api/v1/static-pages/3",
            "id": 3,
            "title": "Exhibitions",
            "timestamp": "2020-08-26T09:00:08-05:00"
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
        "last_updated_source": null,
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

A list of all generic-pages sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](#generic-pages-2).

###### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

::: details Example request: https://api.artic.edu/api/v1/generic-pages?limit=2  
```js
{
    "pagination": {
        "total": 206,
        "limit": 2,
        "offset": 0,
        "total_pages": 103,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/generic-pages?page=2&limit=2"
    },
    "data": [
        {
            "id": 417,
            "api_model": "generic-pages",
            "api_link": "https://api.artic.edu/api/v1/generic-pages/417",
            "title": "Instagram",
            "type": null,
            "web_url": "https://nocache.www.artic.edu/instagram",
            ...
        },
        {
            "id": 10,
            "api_model": "generic-pages",
            "api_link": "https://api.artic.edu/api/v1/generic-pages/10",
            "title": "JourneyMaker",
            "type": null,
            "web_url": "https://nocache.www.artic.edu/visit/explore-on-your-own/journeymaker",
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
        "total": 246,
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
            "timestamp": "2020-08-26T05:04:25-05:00"
        },
        {
            "_score": 1,
            "api_model": "generic-pages",
            "api_link": "https://api.artic.edu/api/v1/generic-pages/2",
            "id": 2,
            "title": "Free Admission Opportunities",
            "timestamp": "2020-08-26T05:04:25-05:00"
        },
        {
            "_score": 1,
            "api_model": "generic-pages",
            "api_link": "https://api.artic.edu/api/v1/generic-pages/4",
            "id": 4,
            "title": "Directions & Parking",
            "timestamp": "2020-08-26T05:04:25-05:00"
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
        "type": null,
        "web_url": "https://nocache.www.artic.edu/instagram",
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

A list of all press-releases sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](#press-releases-2).

###### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

::: details Example request: https://api.artic.edu/api/v1/press-releases?limit=2  
```js
{
    "pagination": {
        "total": 244,
        "limit": 2,
        "offset": 0,
        "total_pages": 122,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/press-releases?page=2&limit=2"
    },
    "data": [
        {
            "id": 16,
            "api_model": "press-releases",
            "api_link": "https://api.artic.edu/api/v1/press-releases/16",
            "title": "Press Releases from 1954",
            "type": null,
            "web_url": "https://nocache.www.artic.edu/press/press-releases/16/press-releases-from-1954",
            ...
        },
        {
            "id": 17,
            "api_model": "press-releases",
            "api_link": "https://api.artic.edu/api/v1/press-releases/17",
            "title": "Press Releases from 1955",
            "type": null,
            "web_url": "https://nocache.www.artic.edu/press/press-releases/17/press-releases-from-1955",
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
        "total": 251,
        "limit": 10,
        "offset": 0,
        "total_pages": 26,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "press-releases",
            "api_link": "https://api.artic.edu/api/v1/press-releases/1",
            "id": 1,
            "title": "Press Releases from 1939",
            "timestamp": "2020-08-26T05:04:26-05:00"
        },
        {
            "_score": 1,
            "api_model": "press-releases",
            "api_link": "https://api.artic.edu/api/v1/press-releases/2",
            "id": 2,
            "title": "Press Releases from 1940",
            "timestamp": "2020-08-26T05:04:26-05:00"
        },
        {
            "_score": 1,
            "api_model": "press-releases",
            "api_link": "https://api.artic.edu/api/v1/press-releases/3",
            "id": 3,
            "title": "Press Releases from 1941",
            "timestamp": "2020-08-26T05:04:26-05:00"
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
        "type": null,
        "web_url": "https://nocache.www.artic.edu/press/press-releases/16/press-releases-from-1954",
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

A list of all educator-resources sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](#educator-resources-2).

###### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

::: details Example request: https://api.artic.edu/api/v1/educator-resources?limit=2  
```js
{
    "pagination": {
        "total": 56,
        "limit": 2,
        "offset": 0,
        "total_pages": 28,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/educator-resources?page=2&limit=2"
    },
    "data": [
        {
            "id": 63,
            "api_model": "educator-resources",
            "api_link": "https://api.artic.edu/api/v1/educator-resources/63",
            "title": "Tips for Teachers and Parents: Body Language: How to Talk to Students About Nudity in Art",
            "type": null,
            "web_url": "https://nocache.www.artic.edu/collection/resources/educator-resources/63-tips-for-teachers-and-parents-body-language-how-to-talk-to-students-about-nudity-in-art",
            ...
        },
        {
            "id": 17,
            "api_model": "educator-resources",
            "api_link": "https://api.artic.edu/api/v1/educator-resources/17",
            "title": "Educator Resource Packet: City Landscape by Joan Mitchell",
            "type": null,
            "web_url": "https://nocache.www.artic.edu/collection/resources/educator-resources/17-educator-resource-packet-city-landscape-by-joan-mitchell",
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
            "timestamp": "2020-08-26T05:04:27-05:00"
        },
        {
            "_score": 1,
            "api_model": "educator-resources",
            "api_link": "https://api.artic.edu/api/v1/educator-resources/3",
            "id": 3,
            "title": "Activity: Arrival of the Normandy Train, Gare Saint-Lazare",
            "timestamp": "2020-08-26T05:04:27-05:00"
        },
        {
            "_score": 1,
            "api_model": "educator-resources",
            "api_link": "https://api.artic.edu/api/v1/educator-resources/4",
            "id": 4,
            "title": "Activity: The Family Concert",
            "timestamp": "2020-08-26T05:04:27-05:00"
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
        "type": null,
        "web_url": "https://nocache.www.artic.edu/collection/resources/educator-resources/63-tips-for-teachers-and-parents-body-language-how-to-talk-to-students-about-nudity-in-art",
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

A list of all digital-catalogs sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](#digital-catalogs-2).

###### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

::: details Example request: https://api.artic.edu/api/v1/digital-catalogs?limit=2  
```js
{
    "pagination": {
        "total": 13,
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
            "type": null,
            "web_url": "https://nocache.www.artic.edu/digital-publications/american-silver",
            ...
        },
        {
            "id": 5,
            "api_model": "digital-catalogs",
            "api_link": "https://api.artic.edu/api/v1/digital-catalogs/5",
            "title": "Roman Art at the Art Institute of Chicago",
            "type": null,
            "web_url": "https://nocache.www.artic.edu/digital-publications/roman-art-at-the-art-institute-of-chicago",
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
            "timestamp": "2020-08-26T05:04:27-05:00"
        },
        {
            "_score": 1,
            "api_model": "digital-catalogs",
            "api_link": "https://api.artic.edu/api/v1/digital-catalogs/3",
            "id": 3,
            "title": "Modern Series: Go",
            "timestamp": "2020-08-26T05:04:27-05:00"
        },
        {
            "_score": 1,
            "api_model": "digital-catalogs",
            "api_link": "https://api.artic.edu/api/v1/digital-catalogs/4",
            "id": 4,
            "title": "Manet Paintings and Works on Paper at the Art Institute of Chicago",
            "timestamp": "2020-08-26T05:04:27-05:00"
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
        "type": null,
        "web_url": "https://nocache.www.artic.edu/digital-publications/american-silver",
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

A list of all printed-catalogs sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](#printed-catalogs-2).

###### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

::: details Example request: https://api.artic.edu/api/v1/printed-catalogs?limit=2  
```js
{
    "pagination": {
        "total": 115,
        "limit": 2,
        "offset": 0,
        "total_pages": 58,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/printed-catalogs?page=2&limit=2"
    },
    "data": [
        {
            "id": 41,
            "api_model": "printed-catalogs",
            "api_link": "https://api.artic.edu/api/v1/printed-catalogs/41",
            "title": "2001: Building for Space Travel",
            "type": null,
            "web_url": "https://nocache.www.artic.edu/print-publications/2001-building-for-space-travel",
            ...
        },
        {
            "id": 39,
            "api_model": "printed-catalogs",
            "api_link": "https://api.artic.edu/api/v1/printed-catalogs/39",
            "title": "1945: Creativity and Crisis, Chicago Architecture and Design of the World War II Era",
            "type": null,
            "web_url": "https://nocache.www.artic.edu/print-publications/1945-creativity-and-crisis-chicago-architecture-and-design-of-the-world-war-ii-era",
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
            "timestamp": "2020-08-26T05:04:27-05:00"
        },
        {
            "_score": 1,
            "api_model": "printed-catalogs",
            "api_link": "https://api.artic.edu/api/v1/printed-catalogs/5",
            "id": 5,
            "title": "Roy Lichtenstein: A Retrospective",
            "timestamp": "2020-08-26T05:04:27-05:00"
        },
        {
            "_score": 1,
            "api_model": "printed-catalogs",
            "api_link": "https://api.artic.edu/api/v1/printed-catalogs/6",
            "id": 6,
            "title": "Dawoud Bey: Harlem, U.S.A.",
            "timestamp": "2020-08-26T05:04:27-05:00"
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
        "type": null,
        "web_url": "https://nocache.www.artic.edu/print-publications/2001-building-for-space-travel",
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

