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
        "total": 115507,
        "limit": 2,
        "offset": 0,
        "total_pages": 57754,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/artworks?page=2&limit=2"
    },
    "data": [
        {
            "id": 202822,
            "api_model": "artworks",
            "api_link": "https://api.artic.edu/api/v1/artworks/202822",
            "is_boosted": false,
            "title": "Untitled (Interior View, Table and Chairs)",
            "alt_titles": null,
            ...
        },
        {
            "id": 20747,
            "api_model": "artworks",
            "api_link": "https://api.artic.edu/api/v1/artworks/20747",
            "is_boosted": false,
            "title": "Warrior Seen From the Back",
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
        "version": "1.4"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "total": 296,
        "limit": 10,
        "offset": 0,
        "total_pages": 30,
        "current_page": 1
    },
    "data": [
        {
            "_score": 226.3941,
            "thumbnail": {
                "alt_text": "Painting of a pond seen up close spotted with thickly painted pink and white water lilies and a shadow across the top third of the picture.",
                "width": 8808,
                "lqip": "data:image/gif;base64,R0lGODlhBQAFAPQAAEZcaFFfdVtqbk9ldFBlcVFocllrcFlrd11rdl9sdFZtf15wcWV0d2R2eGByfmd6eGl6e2t9elZxiGF4kWB4kmJ9kGJ8lWeCkWSAnQAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAAAAAAALAAAAAAFAAUAAAUVoJBADXI4TLRMWHU9hmRRCjAURBACADs=",
                "height": 8461
            },
            "api_model": "artworks",
            "is_boosted": true,
            "api_link": "https://api.artic.edu/api/v1/artworks/16568",
            "id": 16568,
            "title": "Water Lilies",
            "timestamp": "2022-04-20T23:07:19-05:00"
        },
        {
            "_score": 209.75488,
            "thumbnail": {
                "alt_text": "Loosely painted image of an open-air train station. On the right, a parked train gives off an enormous plumb of white smoke, making the scene look as though it were full of clouds. A huddled mass of barely discernible people crowd around the train on both sides of the tracks. Blue, green, and gray tones dominate.",
                "width": 6786,
                "lqip": "data:image/gif;base64,R0lGODlhBwAFAPUAADU8QkROS0ZPU0hSVk1YXVFWUlBXXlFaWVNcWFFkV1plVVtjWmBnWmFqXmRrX05ZYFFaYlljbF5qbGNsY2ZydmlzdWRxeGdze2l1fWx3fG16enJ4fH+KioWOkZeam5yjqZ2lqrG1ubS6vwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAAAAAAALAAAAAAHAAUAAAYhQIKmYslQDoONp8ORBECi0OfyKEAMmAhAgFhMHA2GIhEEADs=",
                "height": 5092
            },
            "api_model": "artworks",
            "is_boosted": true,
            "api_link": "https://api.artic.edu/api/v1/artworks/16571",
            "id": 16571,
            "title": "Arrival of the Normandy Train, Gare Saint-Lazare",
            "timestamp": "2022-04-21T00:32:38-05:00"
        },
        {
            "_score": 207.44257,
            "thumbnail": {
                "alt_text": "Painting composed of short, dense brushstrokes depicts two domed stacks of wheat that cast long shadows on a field. The angled light indicates either a rising or setting sun.",
                "width": 6884,
                "lqip": "data:image/gif;base64,R0lGODlhCAAFAPUAAF5eVW1bVm9eVmpjW3RoXXxyV39yXmdsZmhmaXZtbG11eH57eYl5bYR7dHuAf4mDfo6HfpePdpCFeZSOfJ+VdnZ+g4ODgoCHg4iHgo+GgY2MgpmThJeTipaSjaCcmbWnh6qrpKmopqqtrKusrbGxobq4pLu5qq2zsQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAAAAAAALAAAAAAIAAUAAAYlwJNoFAKRSiZPh7OZRCgfBWJwAAQEBU2D8VgkCAYI5uKoWDKSIAA7",
                "height": 4068
            },
            "api_model": "artworks",
            "is_boosted": true,
            "api_link": "https://api.artic.edu/api/v1/artworks/64818",
            "id": 64818,
            "title": "Stacks of Wheat (End of Summer)",
            "timestamp": "2022-04-20T23:07:19-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.3"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "http://www.artic.edu"
    }
}
```
:::

##### `GET /artworks/{id}`

A single artwork by the given identifier. {id} is the identifier from our collections management system.

::: details Example request: https://api.artic.edu/api/v1/artworks/4  
```js
{
    "data": {
        "id": 4,
        "api_model": "artworks",
        "api_link": "https://api.artic.edu/api/v1/artworks/4",
        "is_boosted": false,
        "title": "Priest and Boy",
        "alt_titles": null,
        ...
    },
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.4"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
    }
}
```
:::

##### `GET /artworks/{id}/manifest[.json]`

A representation of this artwork in the IIIF Presentation API format.

::: details Example request: https://api.artic.edu/api/v1/artworks/4/manifest.json  
```js
{
    "@context": "http://iiif.io/api/presentation/2/context.json",
    "@id": "https://api.artic.edu/api/v1/artworks/4/manifest.json",
    "@type": "sc:Manifest",
    "label": "Priest and Boy",
    "description": [
        {
            "value": "",
            "language": "en"
        }
    ],
    "metadata": [
        {
            "label": "Artist / Maker",
            "value": "Lawrence Carmichael Earle\nAmerican, 1845-1921"
        },
        {
            "label": "Medium",
            "value": "Watercolor over graphite on cream wove paper"
        },
        {
            "label": "Dimensions",
            "value": "472 \u00d7 345 mm"
        },
        {
            "label": "Object Number",
            "value": "1880.1"
        },
        {
            "label": "Collection",
            "value": "<a href='https://www.artic.edu/collection' target='_blank'>Art Institute of Chicago</a>"
        },
        "..."
    ],
    "attribution": "Digital image courtesy of the Art Institute of Chicago.",
    "logo": "https://raw.githubusercontent.com/Art-Institute-of-Chicago/template/master/aic-logo.gif",
    "within": "https://www.artic.edu/collection",
    "rendering": {
        "@id": "https://www.artic.edu/artworks/4",
        "format": "text/html",
        "label": "Full record"
    },
    "sequences": [
        {
            "@type": "sc:Sequence",
            "canvases": [
                {
                    "@type": "sc:Canvas",
                    "@id": "https://www.artic.edu/iiif/2/1a396e09-08f3-518e-8460-30c9ca19241f",
                    "label": "Priest and Boy, n.d.. Lawrence Carmichael Earle, American, 1845-1921",
                    "width": 843,
                    "height": 1162,
                    "images": [
                        {
                            "@type": "oa:Annotation",
                            "motivation": "sc:painting",
                            "on": "https://www.artic.edu/iiif/2/1a396e09-08f3-518e-8460-30c9ca19241f",
                            "resource": {
                                "@type": "dctypes:Image",
                                "@id": "https://www.artic.edu/iiif/2/1a396e09-08f3-518e-8460-30c9ca19241f/full/843,/0/default.jpg",
                                "width": 843,
                                "height": 1162,
                                "service": {
                                    "@context": "http://iiif.io/api/image/2/context.json",
                                    "@id": "https://www.artic.edu/iiif/2/1a396e09-08f3-518e-8460-30c9ca19241f",
                                    "profile": "http://iiif.io/api/image/2/level2.json"
                                }
                            }
                        }
                    ]
                }
            ]
        },
        "..."
    ]
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
        "total": 14598,
        "limit": 2,
        "offset": 0,
        "total_pages": 7299,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/agents?page=2&limit=2"
    },
    "data": [
        {
            "id": 96937,
            "api_model": "agents",
            "api_link": "https://api.artic.edu/api/v1/agents/96937",
            "title": "Neue Galerie New York",
            "sort_title": "Neue Galerie New York",
            "alt_titles": [
                "Neue Galerie (New York, N.Y.)",
                "New York (N.Y.) Neue Galerie"
            ],
            ...
        },
        {
            "id": 30979,
            "api_model": "agents",
            "api_link": "https://api.artic.edu/api/v1/agents/30979",
            "title": "Don A. DuBroff",
            "sort_title": "DuBroff, Don A.",
            "alt_titles": [
                "Don DuBroff"
            ],
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.4"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "total": 14692,
        "limit": 10,
        "offset": 0,
        "total_pages": 1470,
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
            "api_link": "https://api.artic.edu/api/v1/agents/3596",
            "id": 3596,
            "title": "Gary Alan Bukovnik",
            "timestamp": "2022-04-21T12:01:57-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.3"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "http://www.artic.edu"
    }
}
```
:::

##### `GET /agents/{id}`

A single agent by the given identifier. {id} is the identifier from our collections management system.

::: details Example request: https://api.artic.edu/api/v1/agents/2  
```js
{
    "data": {
        "id": 2,
        "api_model": "agents",
        "api_link": "https://api.artic.edu/api/v1/agents/2",
        "title": "Antiquarian Society",
        "sort_title": "Antiquarian Society",
        "alt_titles": [
            "Art Institute of Chicago Antiquarian Society",
            "A.I.C. Antiquarian Society",
            "Decorative Arts Society"
        ],
        ...
    },
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.4"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "total": 3958,
        "limit": 2,
        "offset": 0,
        "total_pages": 1979,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/places?page=2&limit=2"
    },
    "data": [
        {
            "id": 20316,
            "api_model": "places",
            "api_link": "https://api.artic.edu/api/v1/places/20316",
            "title": "Merton",
            "latitude": 51.417,
            "longitude": -0.16700000000000004,
            ...
        },
        {
            "id": -2147480614,
            "api_model": "places",
            "api_link": "https://api.artic.edu/api/v1/places/-2147480614",
            "title": "Merton Abbey Works",
            "latitude": null,
            "longitude": null,
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Attribution 4.0 Generic License (CC-By) and the Terms and Conditions of artic.edu. Contains information from the J. Paul Getty Trust, Getty Research Institute, the Getty Thesaurus of Geographic Names, which is made available under the ODC Attribution License.",
        "license_links": [
            "https://www.artic.edu/terms",
            "https://creativecommons.org/licenses/by/4.0/"
        ],
        "version": "1.4"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "total": 3966,
        "limit": 10,
        "offset": 0,
        "total_pages": 397,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "places",
            "api_link": "https://api.artic.edu/api/v1/places/-5017",
            "id": -5017,
            "title": "Waddesdon",
            "timestamp": "2022-03-04T17:48:03-06:00"
        },
        {
            "_score": 1,
            "api_model": "places",
            "api_link": "https://api.artic.edu/api/v1/places/-2630",
            "id": -2630,
            "title": "Castlemaine",
            "timestamp": "2022-03-04T17:48:04-06:00"
        },
        {
            "_score": 1,
            "api_model": "places",
            "api_link": "https://api.artic.edu/api/v1/places/-2623",
            "id": -2623,
            "title": "Oceanside",
            "timestamp": "2022-03-04T17:48:04-06:00"
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Attribution 4.0 Generic License (CC-By) and the Terms and Conditions of artic.edu. Contains information from the J. Paul Getty Trust, Getty Research Institute, the Getty Thesaurus of Geographic Names, which is made available under the ODC Attribution License.",
        "license_links": [
            "https://www.artic.edu/terms",
            "https://creativecommons.org/licenses/by/4.0/"
        ],
        "version": "1.3"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "http://www.artic.edu"
    }
}
```
:::

##### `GET /places/{id}`

A single place by the given identifier. {id} is the identifier from our collections management system.

::: details Example request: https://api.artic.edu/api/v1/places/-2147483613  
```js
{
    "data": {
        "id": -2147483613,
        "api_model": "places",
        "api_link": "https://api.artic.edu/api/v1/places/-2147483613",
        "title": "Peoria",
        "latitude": 40.683,
        "longitude": -89.583,
        ...
    },
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Attribution 4.0 Generic License (CC-By) and the Terms and Conditions of artic.edu. Contains information from the J. Paul Getty Trust, Getty Research Institute, the Getty Thesaurus of Geographic Names, which is made available under the ODC Attribution License.",
        "license_links": [
            "https://www.artic.edu/terms",
            "https://creativecommons.org/licenses/by/4.0/"
        ],
        "version": "1.4"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
            "id": 25083,
            "api_model": "galleries",
            "api_link": "https://api.artic.edu/api/v1/galleries/25083",
            "title": "Gallery 124B",
            "latitude": 41.879729222835,
            "longitude": -87.623469215939,
            ...
        },
        {
            "id": 25082,
            "api_model": "galleries",
            "api_link": "https://api.artic.edu/api/v1/galleries/25082",
            "title": "Gallery 124A",
            "latitude": 41.879823083305,
            "longitude": -87.623470557043,
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.4"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "total": 95,
        "limit": 10,
        "offset": 0,
        "total_pages": 10,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "galleries",
            "api_link": "https://api.artic.edu/api/v1/galleries/2147476037",
            "id": 2147476037,
            "title": "Gallery 179",
            "timestamp": "2022-03-04T17:48:04-06:00"
        },
        {
            "_score": 1,
            "api_model": "galleries",
            "api_link": "https://api.artic.edu/api/v1/galleries/2147476039",
            "id": 2147476039,
            "title": "Gallery 166",
            "timestamp": "2022-03-04T17:48:04-06:00"
        },
        {
            "_score": 1,
            "api_model": "galleries",
            "api_link": "https://api.artic.edu/api/v1/galleries/2147476040",
            "id": 2147476040,
            "title": "Gallery 165",
            "timestamp": "2022-03-04T17:48:04-06:00"
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.3"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "http://www.artic.edu"
    }
}
```
:::

##### `GET /galleries/{id}`

A single gallery by the given identifier. {id} is the identifier from our collections management system.

::: details Example request: https://api.artic.edu/api/v1/galleries/2  
```js
{
    "data": {
        "id": 2,
        "api_model": "galleries",
        "api_link": "https://api.artic.edu/api/v1/galleries/2",
        "title": "East Garden at Columbus Drive",
        "latitude": 41.880643,
        "longitude": -87.621179,
        ...
    },
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.4"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "total": 6412,
        "limit": 2,
        "offset": 0,
        "total_pages": 3206,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/exhibitions?page=2&limit=2"
    },
    "data": [
        {
            "id": 2931,
            "api_model": "exhibitions",
            "api_link": "https://api.artic.edu/api/v1/exhibitions/2931",
            "title": "Andr\u00e9 Kert\u00e9sz: Postcards from Paris",
            "is_featured": true,
            ...
        },
        {
            "id": 9536,
            "api_model": "exhibitions",
            "api_link": "https://api.artic.edu/api/v1/exhibitions/9536",
            "title": "Landscape in Light: The Tiffany Window at the Art Institute of Chicago",
            "is_featured": true,
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.4"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "total": 6421,
        "limit": 10,
        "offset": 0,
        "total_pages": 643,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "exhibitions",
            "api_link": "https://api.artic.edu/api/v1/exhibitions/37",
            "id": 37,
            "title": "Paintings from the collections of Cyrus H. McCormick, Mr. and Mrs. Francis Neilson, Mr. and Mrs. Max Epstein",
            "timestamp": "2022-03-04T17:48:04-06:00"
        },
        {
            "_score": 1,
            "api_model": "exhibitions",
            "api_link": "https://api.artic.edu/api/v1/exhibitions/71",
            "id": 71,
            "title": "Water Colors by Winslow Homer, Martin A. Ryerson Collection",
            "timestamp": "2022-03-04T17:48:04-06:00"
        },
        {
            "_score": 1,
            "api_model": "exhibitions",
            "api_link": "https://api.artic.edu/api/v1/exhibitions/73",
            "id": 73,
            "title": "Focus: Michael Asher",
            "timestamp": "2022-03-04T17:48:04-06:00"
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.3"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "http://www.artic.edu"
    }
}
```
:::

##### `GET /exhibitions/{id}`

A single exhibition by the given identifier. {id} is the identifier from our collections management system.

::: details Example request: https://api.artic.edu/api/v1/exhibitions/5  
```js
{
    "data": {
        "id": 5,
        "api_model": "exhibitions",
        "api_link": "https://api.artic.edu/api/v1/exhibitions/5",
        "title": "Manet and the Sea",
        "is_featured": false,
        ...
    },
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.4"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
            "source_updated_at": "2019-05-08T18:31:54-05:00",
            "last_updated": "2019-05-09T17:01:08-05:00",
            ...
        },
        {
            "id": 28,
            "api_model": "agent-types",
            "api_link": "https://api.artic.edu/api/v1/agent-types/28",
            "title": "Nonprofit",
            "source_updated_at": "2019-05-08T18:31:54-05:00",
            "last_updated": "2019-05-09T17:01:08-05:00",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.4"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
    }
}
```
:::

##### `GET /agent-types/{id}`

A single agent-type by the given identifier. {id} is the identifier from our collections management system.

::: details Example request: https://api.artic.edu/api/v1/agent-types/1  
```js
{
    "data": {
        "id": 1,
        "api_model": "agent-types",
        "api_link": "https://api.artic.edu/api/v1/agent-types/1",
        "title": "Corporate Body",
        "source_updated_at": "2019-05-08T18:31:53-05:00",
        "last_updated": "2019-05-09T17:01:08-05:00",
        ...
    },
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.4"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
            "source_updated_at": "2020-06-24T16:02:14-05:00",
            "last_updated": "2020-06-24T21:00:33-05:00",
            ...
        },
        {
            "id": 574,
            "api_model": "agent-roles",
            "api_link": "https://api.artic.edu/api/v1/agent-roles/574",
            "title": "File Transfer",
            "source_updated_at": "2019-05-08T19:05:12-05:00",
            "last_updated": "2019-05-09T17:01:07-05:00",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.4"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
    }
}
```
:::

##### `GET /agent-roles/{id}`

A single agent-role by the given identifier. {id} is the identifier from our collections management system.

::: details Example request: https://api.artic.edu/api/v1/agent-roles/1  
```js
{
    "data": {
        "id": 1,
        "api_model": "agent-roles",
        "api_link": "https://api.artic.edu/api/v1/agent-roles/1",
        "title": "Collection",
        "source_updated_at": "2019-05-08T19:05:07-05:00",
        "last_updated": "2019-05-09T17:01:07-05:00",
        ...
    },
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.4"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "version": "1.4"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
    }
}
```
:::

##### `GET /agent-place-qualifiers/{id}`

A single agent-place-qualifier by the given identifier. {id} is the identifier from our collections management system.


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
            "source_updated_at": "2020-04-14T09:36:05-05:00",
            "last_updated": "2020-04-14T13:46:00-05:00",
            ...
        },
        {
            "id": 55,
            "api_model": "artwork-place-qualifiers",
            "api_link": "https://api.artic.edu/api/v1/artwork-place-qualifiers/55",
            "title": "Inhabited place:",
            "source_updated_at": "2020-04-13T13:01:45-05:00",
            "last_updated": "2020-04-13T13:05:56-05:00",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.4"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
    }
}
```
:::

##### `GET /artwork-place-qualifiers/{id}`

A single artwork-place-qualifier by the given identifier. {id} is the identifier from our collections management system.

::: details Example request: https://api.artic.edu/api/v1/artwork-place-qualifiers/1  
```js
{
    "data": {
        "id": 1,
        "api_model": "artwork-place-qualifiers",
        "api_link": "https://api.artic.edu/api/v1/artwork-place-qualifiers/1",
        "title": "Building address",
        "source_updated_at": "2019-05-08T18:00:18-05:00",
        "last_updated": "2019-05-09T17:01:07-05:00",
        ...
    },
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.4"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "total": 32,
        "limit": 2,
        "offset": 0,
        "total_pages": 16,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/artwork-date-qualifiers?page=2&limit=2"
    },
    "data": [
        {
            "id": 63,
            "api_model": "artwork-date-qualifiers",
            "api_link": "https://api.artic.edu/api/v1/artwork-date-qualifiers/63",
            "title": "Between",
            "source_updated_at": "2021-07-12T16:18:20-05:00",
            "last_updated": "2021-07-12T16:20:41-05:00",
            ...
        },
        {
            "id": 62,
            "api_model": "artwork-date-qualifiers",
            "api_link": "https://api.artic.edu/api/v1/artwork-date-qualifiers/62",
            "title": "Manufactured",
            "source_updated_at": "2019-05-08T21:59:24-05:00",
            "last_updated": "2019-05-09T17:01:07-05:00",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.4"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
    }
}
```
:::

##### `GET /artwork-date-qualifiers/{id}`

A single artwork-date-qualifier by the given identifier. {id} is the identifier from our collections management system.

::: details Example request: https://api.artic.edu/api/v1/artwork-date-qualifiers/1  
```js
{
    "data": {
        "id": 1,
        "api_model": "artwork-date-qualifiers",
        "api_link": "https://api.artic.edu/api/v1/artwork-date-qualifiers/1",
        "title": "Cast",
        "source_updated_at": "2019-05-08T21:59:23-05:00",
        "last_updated": "2019-05-09T17:01:07-05:00",
        ...
    },
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.4"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "total": 1103,
        "limit": 2,
        "offset": 0,
        "total_pages": 552,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/catalogues?page=2&limit=2"
    },
    "data": [
        {
            "id": 538,
            "api_model": "catalogues",
            "api_link": "https://api.artic.edu/api/v1/catalogues/538",
            "title": "Edition",
            "source_updated_at": "2021-09-20T14:24:35-05:00",
            "last_updated": "2021-09-20T14:25:20-05:00",
            ...
        },
        {
            "id": 537,
            "api_model": "catalogues",
            "api_link": "https://api.artic.edu/api/v1/catalogues/537",
            "title": "Walch",
            "source_updated_at": "2020-11-17T13:20:47-06:00",
            "last_updated": "2020-11-17T13:25:42-06:00",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.4"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
    }
}
```
:::

##### `GET /catalogues/{id}`

A single catalogue by the given identifier. {id} is the identifier from our collections management system.

::: details Example request: https://api.artic.edu/api/v1/catalogues/-2147483646  
```js
{
    "data": {
        "id": -2147483646,
        "api_model": "catalogues",
        "api_link": "https://api.artic.edu/api/v1/catalogues/-2147483646",
        "title": "Bliss",
        "source_updated_at": "2019-05-08T18:18:14-05:00",
        "last_updated": "2019-05-09T17:01:08-05:00",
        ...
    },
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.4"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
    }
}
```
:::

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
            "aat_id": null,
            "source_updated_at": "2020-05-04T12:25:27-05:00",
            ...
        },
        {
            "id": 47,
            "api_model": "artwork-types",
            "api_link": "https://api.artic.edu/api/v1/artwork-types/47",
            "title": "Materials",
            "aat_id": null,
            "source_updated_at": "2019-10-07T11:53:19-05:00",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.4"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
    }
}
```
:::

##### `GET /artwork-types/{id}`

A single artwork-type by the given identifier. {id} is the identifier from our collections management system.

::: details Example request: https://api.artic.edu/api/v1/artwork-types/1  
```js
{
    "data": {
        "id": 1,
        "api_model": "artwork-types",
        "api_link": "https://api.artic.edu/api/v1/artwork-types/1",
        "title": "Painting",
        "aat_id": null,
        "source_updated_at": "2019-05-08T19:03:58-05:00",
        ...
    },
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.4"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "total": 9376,
        "limit": 2,
        "offset": 0,
        "total_pages": 4688,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/category-terms?page=2&limit=2"
    },
    "data": [
        {
            "id": "TM-14944",
            "api_model": "category-terms",
            "api_link": "https://api.artic.edu/api/v1/category-terms/TM-14944",
            "title": "Mason",
            "subtype": "material",
            "parent_id": null,
            ...
        },
        {
            "id": "TM-14943",
            "api_model": "category-terms",
            "api_link": "https://api.artic.edu/api/v1/category-terms/TM-14943",
            "title": "rubber",
            "subtype": "material",
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
        "version": "1.4"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "total": 9678,
        "limit": 10,
        "offset": 0,
        "total_pages": 968,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "category-terms",
            "api_link": "https://api.artic.edu/api/v1/category-terms/TM-12160",
            "id": "TM-12160",
            "title": "winter",
            "timestamp": "2022-03-04T17:49:11-06:00"
        },
        {
            "_score": 1,
            "api_model": "category-terms",
            "api_link": "https://api.artic.edu/api/v1/category-terms/TM-12513",
            "id": "TM-12513",
            "title": "museum visitors",
            "timestamp": "2022-03-04T17:49:12-06:00"
        },
        {
            "_score": 1,
            "api_model": "category-terms",
            "api_link": "https://api.artic.edu/api/v1/category-terms/TM-12514",
            "id": "TM-12514",
            "title": "helmets",
            "timestamp": "2022-03-04T17:49:12-06:00"
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.3"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "http://www.artic.edu"
    }
}
```
:::

##### `GET /category-terms/{id}`

A single category-term by the given identifier. {id} is the identifier from our collections management system.

::: details Example request: https://api.artic.edu/api/v1/category-terms/PC-1  
```js
{
    "data": {
        "id": "PC-1",
        "api_model": "category-terms",
        "api_link": "https://api.artic.edu/api/v1/category-terms/PC-1",
        "title": "Arts of Africa",
        "subtype": "department",
        "parent_id": null,
        ...
    },
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.4"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
    }
}
```
:::

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
        "total": 148298,
        "limit": 2,
        "offset": 0,
        "total_pages": 74149,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/images?page=2&limit=2"
    },
    "data": [
        {
            "id": "2dc207d2-7e98-0356-dbde-17f501f5a150",
            "lake_guid": "2dc207d2-7e98-0356-dbde-17f501f5a150",
            "api_model": "images",
            "api_link": "https://api.artic.edu/api/v1/images/2dc207d2-7e98-0356-dbde-17f501f5a150",
            "title": "IM048287_006-int.jpg",
            "type": "image",
            ...
        },
        {
            "id": "741dc878-928e-4f74-d340-c33e7e5d7fc8",
            "lake_guid": "741dc878-928e-4f74-d340-c33e7e5d7fc8",
            "api_model": "images",
            "api_link": "https://api.artic.edu/api/v1/images/741dc878-928e-4f74-d340-c33e7e5d7fc8",
            "title": "E23123-int",
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
        "version": "1.4"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "total": 292952,
        "limit": 10,
        "offset": 0,
        "total_pages": 29296,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "images",
            "api_link": "https://api.artic.edu/api/v1/images/43bb4f19-9af9-45c9-d00d-7efc866dd9b0",
            "id": "43bb4f19-9af9-45c9-d00d-7efc866dd9b0",
            "title": "122798",
            "timestamp": "2022-03-04T17:50:41-06:00"
        },
        {
            "_score": 1,
            "api_model": "images",
            "api_link": "https://api.artic.edu/api/v1/images/f14b1774-3cf8-97da-44c7-9bc41a1f736b",
            "id": "f14b1774-3cf8-97da-44c7-9bc41a1f736b",
            "title": "103624",
            "timestamp": "2022-03-04T17:50:41-06:00"
        },
        {
            "_score": 1,
            "api_model": "images",
            "api_link": "https://api.artic.edu/api/v1/images/02c74e07-b93b-5723-f8d7-81c2e216e889",
            "id": "02c74e07-b93b-5723-f8d7-81c2e216e889",
            "title": "103183",
            "timestamp": "2022-03-04T17:50:41-06:00"
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.3"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "http://www.artic.edu"
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
        "version": "1.4"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
            "timestamp": "2021-01-13T04:24:59-06:00"
        },
        {
            "_score": 1,
            "api_model": "videos",
            "api_link": "https://api.artic.edu/api/v1/videos/c051f71e-2b69-ac68-9aa8-99410d91f3f3",
            "id": "c051f71e-2b69-ac68-9aa8-99410d91f3f3",
            "title": "Under Cover: The Science of Van Gogh's Bedroom",
            "timestamp": "2021-01-13T04:24:59-06:00"
        },
        {
            "_score": 1,
            "api_model": "videos",
            "api_link": "https://api.artic.edu/api/v1/videos/c5700df1-473c-c1cd-ab1b-79b20a32fc27",
            "id": "c5700df1-473c-c1cd-ab1b-79b20a32fc27",
            "title": "Online Game: Winslow Homer's <em>The Water Fan</em>",
            "timestamp": "2021-01-13T04:24:59-06:00"
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.3"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "http://www.artic.edu"
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
        "total": 808,
        "limit": 2,
        "offset": 0,
        "total_pages": 404,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/sounds?page=2&limit=2"
    },
    "data": [
        {
            "id": "ebb72f65-2b6e-db0d-f7f7-7a68b0155d03",
            "lake_guid": "ebb72f65-2b6e-db0d-f7f7-7a68b0155d03",
            "api_model": "sounds",
            "api_link": "https://api.artic.edu/api/v1/sounds/ebb72f65-2b6e-db0d-f7f7-7a68b0155d03",
            "title": "Audio stop 200",
            "type": "sound",
            ...
        },
        {
            "id": "79538b5b-a483-44b0-80bb-6dc46622657f",
            "lake_guid": "79538b5b-a483-44b0-80bb-6dc46622657f",
            "api_model": "sounds",
            "api_link": "https://api.artic.edu/api/v1/sounds/79538b5b-a483-44b0-80bb-6dc46622657f",
            "title": "Audio stop 994.mp3",
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
        "version": "1.4"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "total": 1910,
        "limit": 10,
        "offset": 0,
        "total_pages": 191,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "sounds",
            "api_link": "https://api.artic.edu/api/v1/sounds/742e186a-1fc0-068a-0dfe-7f50b50c3d58",
            "id": "742e186a-1fc0-068a-0dfe-7f50b50c3d58",
            "title": "Audio stop 840.mp3",
            "timestamp": "2021-01-13T04:25:04-06:00"
        },
        {
            "_score": 1,
            "api_model": "sounds",
            "api_link": "https://api.artic.edu/api/v1/sounds/7470a64c-4cd3-ac25-0051-b779653974fc",
            "id": "7470a64c-4cd3-ac25-0051-b779653974fc",
            "title": "Audio stop 5272.mp3",
            "timestamp": "2021-01-13T04:25:04-06:00"
        },
        {
            "_score": 1,
            "api_model": "sounds",
            "api_link": "https://api.artic.edu/api/v1/sounds/74892630-a143-8188-f7d3-efd76a0ad2f7",
            "id": "74892630-a143-8188-f7d3-efd76a0ad2f7",
            "title": "Audio stop 618.mp3",
            "timestamp": "2021-01-13T04:25:04-06:00"
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.3"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "http://www.artic.edu"
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
        "total": 3866,
        "limit": 2,
        "offset": 0,
        "total_pages": 1933,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/texts?page=2&limit=2"
    },
    "data": [
        {
            "id": "ec516cf8-ad6e-0a19-77c7-9ae6e7a74284",
            "lake_guid": "ec516cf8-ad6e-0a19-77c7-9ae6e7a74284",
            "api_model": "texts",
            "api_link": "https://api.artic.edu/api/v1/texts/ec516cf8-ad6e-0a19-77c7-9ae6e7a74284",
            "title": "AIC1955Portrait_comb.pdf",
            "type": "text",
            ...
        },
        {
            "id": "bc03a9f2-2915-db9f-cb0a-f7899afefca3",
            "lake_guid": "bc03a9f2-2915-db9f-cb0a-f7899afefca3",
            "api_model": "texts",
            "api_link": "https://api.artic.edu/api/v1/texts/bc03a9f2-2915-db9f-cb0a-f7899afefca3",
            "title": "20211022_G201 Wall chat_1933.1152",
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
        "version": "1.4"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "total": 5937,
        "limit": 10,
        "offset": 0,
        "total_pages": 594,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "texts",
            "api_link": "https://api.artic.edu/api/v1/texts/8fc62b00-9bcc-50d8-25ff-b6752228c23a",
            "id": "8fc62b00-9bcc-50d8-25ff-b6752228c23a",
            "title": "Map: Monet's France",
            "timestamp": "2021-01-13T04:25:23-06:00"
        },
        {
            "_score": 1,
            "api_model": "texts",
            "api_link": "https://api.artic.edu/api/v1/texts/903a350b-86da-a6f4-c99a-68799d13d54e",
            "id": "903a350b-86da-a6f4-c99a-68799d13d54e",
            "title": "AIC1884ChristmasCard.pdf",
            "timestamp": "2021-01-13T04:25:23-06:00"
        },
        {
            "_score": 1,
            "api_model": "texts",
            "api_link": "https://api.artic.edu/api/v1/texts/90449cbb-cf30-8d5e-eafd-990b4f0d43db",
            "id": "90449cbb-cf30-8d5e-eafd-990b4f0d43db",
            "title": "AIC1955FrenchPainting_comb.pdf",
            "timestamp": "2021-01-13T04:25:23-06:00"
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.3"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "http://www.artic.edu"
    }
}
```
:::

##### `GET /texts/{id}`

A single text by the given identifier. {id} is the identifier from our collections management system.


### Shop

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
        "total": 1152,
        "limit": 2,
        "offset": 0,
        "total_pages": 576,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/products?page=2&limit=2"
    },
    "data": [
        {
            "id": 246003,
            "api_model": "products",
            "api_link": "https://api.artic.edu/api/v1/products/246003",
            "title": "Edgar Degas Little Fourteen-Year-Old Dancer Sculpture",
            "external_sku": 109017,
            "image_url": "https://shop-images.imgix.net109017_2.jpg",
            ...
        },
        {
            "id": 252397,
            "api_model": "products",
            "api_link": "https://api.artic.edu/api/v1/products/252397",
            "title": "Vincent Van Gogh The Bedroom Mug",
            "external_sku": 127208,
            "image_url": "https://shop-images.imgix.net127208_2.jpg",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.4"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "total": 917,
        "limit": 10,
        "offset": 0,
        "total_pages": 92,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "products",
            "api_link": "https://api.artic.edu/api/v1/products/286109",
            "id": 286109,
            "title": "Claude Monet Artists\u2019 Colouring Book",
            "timestamp": "2022-04-20T23:00:47-05:00"
        },
        {
            "_score": 1,
            "api_model": "products",
            "api_link": "https://api.artic.edu/api/v1/products/286110",
            "id": 286110,
            "title": "Jamie Hewlett. 40th Anniversary Edition",
            "timestamp": "2022-04-20T23:00:47-05:00"
        },
        {
            "_score": 1,
            "api_model": "products",
            "api_link": "https://api.artic.edu/api/v1/products/286114",
            "id": 286114,
            "title": "Barbara Kruger: Thinking of You. I Mean Me. I Mean You",
            "timestamp": "2022-04-20T23:00:47-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.3"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "http://www.artic.edu"
    }
}
```
:::

##### `GET /products/{id}`

A single product by the given identifier.

::: details Example request: https://api.artic.edu/api/v1/products/245285  
```js
{
    "data": {
        "id": 245285,
        "api_model": "products",
        "api_link": "https://api.artic.edu/api/v1/products/245285",
        "title": "Georges Seurat A Sunday on La Grande Jatte\u20141884 Tote",
        "external_sku": 101127,
        "image_url": "https://shop-images.imgix.net101127_2.jpg",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.4"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
            "id": 4475,
            "api_model": "tours",
            "api_link": "https://api.artic.edu/api/v1/tours/4475",
            "title": "Perfectly United and Infinitely Graceful",
            "image": "http://aic-mobile-tours.artic.edu/sites/default/files/tour-images/buddha-intro.jpg",
            "description": "<p>Explore the metaphysical and spiritual in this journey through the Alsdorf South and Southeast Asian collection at the Art Institute of Chicago.</p>\n",
            ...
        },
        {
            "id": 4721,
            "api_model": "tours",
            "api_link": "https://api.artic.edu/api/v1/tours/4721",
            "title": "Verbal Description Tour: Monet and Chicago",
            "image": "http://aic-mobile-tours.artic.edu/sites/default/files/tour-images/1956.1202%20-%20Irises.jpg",
            "description": "<p>Monet and Chicago is the first exhibition to consider the city\u2019s unique embrace of the Impressionist artist, and celebrates its essential role in fostering modern art in the United States. Loans from Chicagoland collections join works by Monet in the museum's collection, which number more than any other in the country.</p>\n",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.4"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "total": 23,
        "limit": 10,
        "offset": 0,
        "total_pages": 3,
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
        "version": "1.3"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "http://www.artic.edu"
    }
}
```
:::

##### `GET /tours/{id}`

A single tour by the given identifier.

::: details Example request: https://api.artic.edu/api/v1/tours/1000  
```js
{
    "data": {
        "id": 1000,
        "api_model": "tours",
        "api_link": "https://api.artic.edu/api/v1/tours/1000",
        "title": "Magic of the Miniature",
        "image": "http://aic-mobile-tours.artic.edu/sites/default/files/tour-images/E17048_reduced.jpg",
        "description": "<p>Travel back in time through the magic of the Thorne Rooms.</p>\n",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.4"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "total": 833,
        "limit": 2,
        "offset": 0,
        "total_pages": 417,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/mobile-sounds?page=2&limit=2"
    },
    "data": [
        {
            "id": 4862,
            "api_model": "mobile-sounds",
            "api_link": "https://api.artic.edu/api/v1/mobile-sounds/4862",
            "title": "Multisensory Gallery: Wood",
            "web_url": "https://www.artic.edu/mobile/audio/Wood_JoshDhileSession_V10.mp3",
            "transcript": "<p>Narrator: Go ahead and run your hands over this sculpture if you haven\u2019t already. This is of wood, Walnut to be specific, which is artist Josh Dhile\u2019s favorite wood to work with because of its rich brown color and because it\u2019s a little easier to carve. When we asked Josh to make a piece for this gallery, he was pretty excited about it.</p>\n<p>Josh Dhile: Yeah, the touch aspect is kind of unorthodox but I thinks it\u2019s pretty interesting. This is weird, but some of my favorite wood in the world is when you\u2019re at an amusement park and you\u2019re in line for the roller coaster, if it\u2019s an old rollercoaster, all the hand rails as you\u2019re walking up and waiting in line are made of wood you can tell it\u2019s been invested with touch from thousands of hands worth of contact. So I\u2019m excited for that, at least a little bit of that, coming to this piece also.</p>\n<p>Narrator: The sculpture is split into three sections, showing the evolution of this slab of walnut as it becomes a sculpture. Let\u2019s begin with the bottom section, that rich band of untouched wood. The first step for Josh is picking out his wood, which he does at a lumber yard</p>\n<p>Josh Dhile: It\u2019s just a warehouse full of boards and it just smells amazing as soon as you walk in, there\u2019s that saw dust in the air. All different kinds of wood often from all over the world. Your senses are immediately involved in the experience.</p>\n<p>Narrator: Josh isn\u2019t just looking for any old piece of wood, he wants to find something with an interesting grain or color, something that is going to inspire him</p>\n<p>Josh Dhile: Maybe something looks like a flame or like an eye or like a waveform going through the wood. So I\u2019m actually responding as a painter to the material as I\u2019m selecting it.</p>\n<p>Narrator: Once he has his board selected and back in his studio, he does a few sketches to outline the sculpture. Then decides how he wants to approach the carving</p>\n<p>Josh Dhile: The initial carving stages are done in a couple of different ways. There\u2019s the contemporary route where I\u2019m using something like a router, literally a spinning cutting tool, and I can plunge in and remove larger sections of wood where I need to. And that\u2019ll do that fairly quickly, but it\u2019s just loud and creates a lot of dust and it\u2019s not as pleasant as the more traditional route.</p>\n<p>Josh Dhile: Which means I\u2019ll take a large set of chisels or gouges, like if you imagine a chisel but it\u2019s got a \u201cc\u201d shape on it and it\u2019s designed to scoop wood up and out from the surface that you\u2019re carving. And then I have a wooden mallet (taps three times) that I can use to tap and send energy through the back of the chisel into the wood so that it lifts and makes a clean slice to remove the larger chunks first.</p>\n<p>Narrator: You can really feel the work of those big chisels from the indentations on the next section up. It\u2019s bumpy and ridged and you can also see how various forms are beginning to take shape.</p>\n<p>Josh Dhile: So I\u2019ll go down to the next smaller size of the chisels and gouges and that\u2019s what starts to really bring the form forward. If the first step was putting in the skeleton of the piece, now we\u2019re really starting to add the musculature</p>\n<p>Narrator: After the serious wood removal is completed, the process becomes small and meticulous</p>\n<p>Josh Dhile: it\u2019s very delicate work. It\u2019s just like little tiny veiners and gouges, no more chisels, just the little tiny tools. It\u2019s almost like a watch maker or something, you\u2019re just bent over getting these eye lashes exactly right as your notching them in.</p>\n<p>Narrator: You can really feel the changes between stage 2 and 3 with the hair. It has so much more volume and detailed lines.</p>\n<p>With the details set just right, it\u2019s time to focus on texture and that means sanding. This part of the process takes a lot of time.</p>\n<p>Josh Dhile: Hours, towards the end of a piece I expect to spend at least a full day just sanding</p>\n<p>And then, once the piece is sanded, I rub it with tung oil. It comes from a tree, it\u2019s a natural type of oil. And it kind of enriches the grain quality and it turns it nice a dark and brings all this natural luster out of the wood. You do that a couple of times and that pretty much brings the piece to a close.</p>\n<p>Narrator: If you'd like to see the work of art that inspired Josh's carving, head to gallery 237. Along the way, take note of all the many works of art made from wood or plant materials. They're everywhere! Remember to use your eyes and imagination to explore, rather than your hands. Keeping artworks safe and clean is a top priority.</p>\n",
            ...
        },
        {
            "id": 4856,
            "api_model": "mobile-sounds",
            "api_link": "https://api.artic.edu/api/v1/mobile-sounds/4856",
            "title": "Multisensory Gallery: Wool",
            "web_url": "https://www.artic.edu/mobile/audio/Wool_BryanaBibs_V10.mp3",
            "transcript": "<p>Narrator: This is a wool textile, which is probably the material and medium that you\u2019re the most familiar with. We all wear textiles everyday, whether it\u2019s a dress, socks, or overalls, all of our clothes are textiles. So what makes the clothing you\u2019re wearing now different than this textile? We\u2019ll get there I promise, but first let me introduce you to the artist.</p>\n<p>Now, we should probably start with the fact that unlike the rest of the materials in the gallery, wool comes from an animal.</p>\n<p>Bryana Bibbs: it\u2019s sheered off of sheep (laughs)</p>\n<p>Narrator: And, as Bryana explains, wool goes through a lot of processing before it can be used in this piece you\u2019re touching now.</p>\n<p>Bryana Bibbs: It\u2019s rough and sometimes it has a greasy quality to it. So they have to clean it and then they have to card it so that it\u2019s easier to spin. And carting it is essentially taking a bunch of fine, fine pins and putting it through a roller and those pins separate the fiber individually. And then once those fibers are distributed evenly and smoothed out then they kind of roll up into one big fluffy ball of fiber.</p>\n<p>Narrator: This is when Bryana gets her hands on it. Now it\u2019s still not ready to be woven at this point, it\u2019s still just raw, grayish wool. First it has to be spun on a spinning wheel and then dyed to whatever colors you want for the weaving. Of course, you could just buy pre-spun wool at a store, but for Bryana, spinning your own wool is an important part of the process</p>\n<p>Bryana: Just because I feel like you see the hand more, and I guess what I mean by the hand is that sometimes you see mistakes when you spin things.</p>\n<p>Narrator: Bryana embraces mistakes because to her it\u2019s what makes textile art special.</p>\n<p>Bryana: There\u2019s something really magical about that because it shows that it was really hand made and it wasn\u2019t made by a manufacturer. And I think it\u2019s important for people to see those mistakes because we so often in textiles don\u2019t see those mistakes.</p>\n<p>Narrator: The first thing you need to understand before we go into how Bryana actually wove this are the words weft and warp. The warp is essentially strands of wool that run top to bottom on the loom, whereas the weft runs horizontally from side to side.</p>\n<p>In this piece, Bryana shows off a bunch of different forms that a weft can take. Some pretty simple and others quite complex. Take, for example, these shaggy haired knots at the bottom</p>\n<p>Bryana: The bottom of the piece is actually made of plain weave and that is simply going over under over under over under each thread.</p>\n<p>Narrator: Then when you get to end of a row or pick, you reverse</p>\n<p>Bryana: You would go under over under over under over and then you would just repeat</p>\n<p>Narrator: Those thick knots at the bottom are called rhia knots</p>\n<p>Bryana: And Rhia knots were used in rug making and blanket making. And the more you do each pick the fuller that rhia knot becomes.</p>\n<p>Narrator: What\u2019s amazing is that just by changing the patterns, even subtly, Bryana can get totally different textures and looks like those twisted braids at the top left or like this red middle section that uses an additional tool.</p>\n<p>Bryana: how that\u2019s done is by taking a tapestry needle with your weft, and then on a diagonal wrapping that around two warp ends. And what that does is it creates this kind of arrow effect and then the more that you do it it kind of builds up and starts to look like a knit pattern.</p>\n<p>Narrator: There are a lot of different patterns and techniques you can use, and those little changes and mistakes that happen along the way lead infinite possibilities.</p>\n<p>Bryana Bibbs: When I\u2019m teaching weaving to people I suggest to try something new. That could mean changing the alternating pattern, that could mean using different materials,  that could mean going in like I did on the top left and wrapping these rhia and braiding them. Doing what you think is right for the piece.</p>\n<p>Narrator: Textiles made of wool fibers are fragile and can be harmed by exposure to light and to touch. Many textiles are displayed behind glass for protection. You'll find textiles made from wool and other fibers across the museum-- in the galleries of Arms and Armor, in decorative arts areas, and in the Textiles galleries when they are open.</p>\n",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.4"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "total": 846,
        "limit": 10,
        "offset": 0,
        "total_pages": 85,
        "current_page": 1
    },
    "data": [
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
            "api_link": "https://api.artic.edu/api/v1/mobile-sounds/4855",
            "id": 4855,
            "title": "Multisensory Gallery: Wood",
            "timestamp": "2021-11-16T23:00:26-06:00"
        },
        {
            "_score": 1,
            "api_model": "mobile-sounds",
            "api_link": "https://api.artic.edu/api/v1/mobile-sounds/1362",
            "id": 1362,
            "title": "Veranda Post of Enthroned King and Senior Wife (Opo Ogoga)",
            "timestamp": "2022-04-20T23:00:11-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.3"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "http://www.artic.edu"
    }
}
```
:::

##### `GET /mobile-sounds/{id}`

A single mobile-sound by the given identifier.

::: details Example request: https://api.artic.edu/api/v1/mobile-sounds/226  
```js
{
    "data": {
        "id": 226,
        "api_model": "mobile-sounds",
        "api_link": "https://api.artic.edu/api/v1/mobile-sounds/226",
        "title": "Justus Sustermans",
        "web_url": "https://www.artic.edu/mobile/audio/882.mp3",
        "transcript": "<p>VICTORIA SANCHO LOBIS:  Portrait prints had been made since the beginning of the history of the print.  But they typically were used to represent political figures or scholars.</p>\n<p>NARRATOR: Until Van Dyck\u2019 created the Iconography. In this series of prints he not only included political leaders and other renowned citizens, but artists as well, signaling their growing importance in 17th century European society. The Art Institute is fortunate to own all of Van Dyck\u2019s etchings for this project, and they are exhibited here for the first time in almost a century.</p>\n<p>The artist began the series by casually creating 15 portraits, expecting that expert printmakers would finish his plates. He could hardly have anticipated the interest these \u2018unfinished\u2019 prints would generate.</p>\n<p>In this portrait of artist Justus Sustermans, Van Dyck paid great attention to detail in his sitter\u2019s face.</p>\n<p>VICTORIA SANCHO LOBIS: And then from there, the description of the sitter becomes increasingly abstract. And we eventually get to the painter\u2019s right hand, which is drawn in with just the most preliminary and rudimentary lines, sort of square-shaped fingertips, and no shading whatsoever.</p>\n<p>NARRATOR: This contrast between detailed depiction and imaginative abstraction is precisely what caught a collector\u2019s eye and what still seems so modern about Van Dyck\u2019s etchings today. Van Dyck\u2019s self-portrait is probably the first unfinished print ever to have been produced in an edition.</p>\n<p>VICTORIA SANCHO LOBIS: Like most of the etchings that Van Dyck made, this print shows the effects of an imperfectly polished copper plate. So we see scratches, particularly in the upper register. There\u2019s various other passages where a more conscientious printmaker would have taken pains to remove blemishes or imperfections. But these seemed not to bother Van Dyck very much, nor did it bother some of the early collectors.</p>\n<p>NARRATOR: Those collectors immediately embraced van Dyck\u2019s revolutionary portraiture, eagerly purchasing new prints for their collections. Nearby, you\u2019ll see other unfinished portraits van Dyck created for the series.</p>\n",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.4"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "total": 16,
        "limit": 2,
        "offset": 0,
        "total_pages": 8,
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
        "version": "1.4"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "total": 16,
        "limit": 10,
        "offset": 0,
        "total_pages": 2,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "publications",
            "api_link": "https://api.artic.edu/api/v1/publications/23",
            "id": 23,
            "title": "Matisse Paintings, Works on Paper, Sculpture, and Textiles at the Art Institute of Chicago",
            "timestamp": "2022-04-01T05:29:35-05:00"
        },
        {
            "_score": 1,
            "api_model": "publications",
            "api_link": "https://api.artic.edu/api/v1/publications/64",
            "id": 64,
            "title": "Whistler Paintings and Drawings at the Art Institute of Chicago",
            "timestamp": "2022-04-01T05:29:35-05:00"
        },
        {
            "_score": 1,
            "api_model": "publications",
            "api_link": "https://api.artic.edu/api/v1/publications/80",
            "id": 80,
            "title": "Ivan Albright Paintings at the Art Institute of Chicago",
            "timestamp": "2022-04-01T05:29:35-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.3"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "http://www.artic.edu"
    }
}
```
:::

##### `GET /publications/{id}`

A single publication by the given identifier.

::: details Example request: https://api.artic.edu/api/v1/publications/2  
```js
{
    "data": {
        "id": 2,
        "api_model": "publications",
        "api_link": "https://api.artic.edu/api/v1/publications/2",
        "title": "American Silver in the Art Institute of Chicago",
        "web_url": "https://publications.artic.edu/americansilver/reader/collection",
        "site": "americansilver",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.4"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "total": 1552,
        "limit": 2,
        "offset": 0,
        "total_pages": 776,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/sections?page=2&limit=2"
    },
    "data": [
        {
            "id": 16468,
            "api_model": "sections",
            "api_link": "https://api.artic.edu/api/v1/sections/16468",
            "title": "Copyright Page",
            "web_url": "https://publications.artic.edu/americansilver/reader/collection/section/178",
            "accession": null,
            ...
        },
        {
            "id": 16287,
            "api_model": "sections",
            "api_link": "https://api.artic.edu/api/v1/sections/16287",
            "title": "Note to the Reader",
            "web_url": "https://publications.artic.edu/americansilver/reader/collection/section/177",
            "accession": null,
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.4"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "total": 1552,
        "limit": 10,
        "offset": 0,
        "total_pages": 156,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "sections",
            "api_link": "https://api.artic.edu/api/v1/sections/15222",
            "id": 15222,
            "title": "Cat. 100 \u00a0Circa \u201970 Coffee Service, designed 1958; introduced 1960",
            "timestamp": "2022-04-01T05:29:39-05:00"
        },
        {
            "_score": 1,
            "api_model": "sections",
            "api_link": "https://api.artic.edu/api/v1/sections/108342",
            "id": 108342,
            "title": "Select Silver Objects in the Collection of the Art Institute of Chicago",
            "timestamp": "2022-04-01T05:29:39-05:00"
        },
        {
            "_score": 1,
            "api_model": "sections",
            "api_link": "https://api.artic.edu/api/v1/sections/7998",
            "id": 7998,
            "title": "Cat. 55 \u00a0Punch Bowl, 1873",
            "timestamp": "2022-04-01T05:29:47-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.3"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "http://www.artic.edu"
    }
}
```
:::

##### `GET /sections/{id}`

A single section by the given identifier.

::: details Example request: https://api.artic.edu/api/v1/sections/18  
```js
{
    "data": {
        "id": 18,
        "api_model": "sections",
        "api_link": "https://api.artic.edu/api/v1/sections/18",
        "title": "Foreword",
        "web_url": "https://publications.artic.edu/americansilver/reader/collection/section/3",
        "accession": null,
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.4"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "version": "1.4"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
            "api_link": "https://api.artic.edu/api/v1/sites/16",
            "id": 16,
            "title": "Aerospace Design: The Art of Engineering from NASA\u2019s Aeronautical Research",
            "timestamp": "2022-04-01T05:29:23-05:00"
        },
        {
            "_score": 1,
            "api_model": "sites",
            "api_link": "https://api.artic.edu/api/v1/sites/17",
            "id": 17,
            "title": "C\u00e9zanne to Picasso: Ambroise Vollard, Patron of the Avant-Garde",
            "timestamp": "2022-04-01T05:29:23-05:00"
        },
        {
            "_score": 1,
            "api_model": "sites",
            "api_link": "https://api.artic.edu/api/v1/sites/18",
            "id": 18,
            "title": "Without Bounds or Limits: An Online Exhibition of the Plan of Chicago",
            "timestamp": "2022-04-01T05:29:23-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.3"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "http://www.artic.edu"
    }
}
```
:::

##### `GET /sites/{id}`

A single site by the given identifier.

::: details Example request: https://api.artic.edu/api/v1/sites/1  
```js
{
    "data": {
        "id": 1,
        "api_model": "sites",
        "api_link": "https://api.artic.edu/api/v1/sites/1",
        "title": "Chicago Architecture: Ten Visions",
        "description": "Chicago Architecture: Ten Visions presents diverse views of the future of Chicago\u2019s built environment from 10 internationally renowned architects. The architects were selected from an invited competition juried by architects Stanley Tigerman and Harry Cobb, in collaboration with curators from the Art Institute\u2019s Department of Architecture. The 10 architects reflect a cross section of Chicago\u2019s vibrant architectural scene\u2014from large and small firms as well as the academic community\u2014bringing to this exhibition diverse experiences and insights. Each architect was asked to define an important issue for the future of Chicago and create a \u201cspatial commentary\u201d on that particular theme. Within a lively plan designed by Stanley Tigerman, each of the participants has curated and designed his or her own mini-exhibition in a space of approximately 21 feet square. Tigerman\u2019s setting creates a linear sequence in which visitors pass through the architects\u2019 spaces to an interactive area where the architects\u2019 commentaries can be heard by picking up a telephone. Visitors are encouraged to record their comments on any and all of the \u201cten visions.\u201d",
        "web_url": "http://archive.artic.edu/10visions/",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.4"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "total": 39,
        "limit": 2,
        "offset": 0,
        "total_pages": 20,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/closures?page=2&limit=2"
    },
    "data": [
        {
            "id": 75,
            "api_model": "closures",
            "api_link": "https://api.artic.edu/api/v1/closures/75",
            "title": "Lorem ipsum.",
            "date_start": "2021-11-30T00:00:00-06:00",
            "date_end": "2021-12-01T00:00:00-06:00",
            ...
        },
        {
            "id": 98,
            "api_model": "closures",
            "api_link": "https://api.artic.edu/api/v1/closures/98",
            "title": "Lorem ipsum.",
            "date_start": "2021-11-04T00:00:00-05:00",
            "date_end": "2021-11-08T00:00:00-06:00",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.4"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "total": 39,
        "limit": 10,
        "offset": 0,
        "total_pages": 4,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "closures",
            "api_link": "https://api.artic.edu/api/v1/closures/58",
            "id": 58,
            "title": "Lorem ipsum.",
            "timestamp": "2022-04-20T23:08:18-05:00"
        },
        {
            "_score": 1,
            "api_model": "closures",
            "api_link": "https://api.artic.edu/api/v1/closures/75",
            "id": 75,
            "title": "Lorem ipsum.",
            "timestamp": "2022-04-20T23:08:18-05:00"
        },
        {
            "_score": 1,
            "api_model": "closures",
            "api_link": "https://api.artic.edu/api/v1/closures/103",
            "id": 103,
            "title": "Lorem ipsum.",
            "timestamp": "2022-04-20T23:08:18-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.3"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "http://www.artic.edu"
    }
}
```
:::

##### `GET /closures/{id}`

A single closure by the given identifier.

::: details Example request: https://api.artic.edu/api/v1/closures/4  
```js
{
    "data": {
        "id": 4,
        "api_model": "closures",
        "api_link": "https://api.artic.edu/api/v1/closures/4",
        "title": "Lorem ipsum.",
        "date_start": "2021-12-25T00:00:00-06:00",
        "date_end": "2021-12-25T00:00:00-06:00",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.4"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "total": 715,
        "limit": 2,
        "offset": 0,
        "total_pages": 358,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/web-exhibitions?page=2&limit=2"
    },
    "data": [
        {
            "id": 702,
            "api_model": "web-exhibitions",
            "api_link": "https://api.artic.edu/api/v1/web-exhibitions/702",
            "title": "Landscape in Light: The Tiffany Window at the Art Institute of Chicago",
            "exhibition_id": 9536,
            "is_featured": true,
            ...
        },
        {
            "id": 689,
            "api_model": "web-exhibitions",
            "api_link": "https://api.artic.edu/api/v1/web-exhibitions/689",
            "title": "Ray Johnson c/o",
            "exhibition_id": 9300,
            "is_featured": true,
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.4"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "total": 723,
        "limit": 10,
        "offset": 0,
        "total_pages": 73,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "web-exhibitions",
            "api_link": "https://api.artic.edu/api/v1/web-exhibitions/726",
            "id": 726,
            "title": "Life and Afterlife in Ancient Egypt",
            "timestamp": "2022-04-20T23:17:33-05:00"
        },
        {
            "_score": 1,
            "api_model": "web-exhibitions",
            "api_link": "https://api.artic.edu/api/v1/web-exhibitions/730",
            "id": 730,
            "title": "Basma al-Sharif: Capital\u2014Ruttenberg Contemporary Photography Series",
            "timestamp": "2022-04-20T23:17:33-05:00"
        },
        {
            "_score": 1,
            "api_model": "web-exhibitions",
            "api_link": "https://api.artic.edu/api/v1/web-exhibitions/724",
            "id": 724,
            "title": "Subscribe: Artists and Alternative Magazines, 1970-1995",
            "timestamp": "2022-04-20T23:17:33-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.3"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "http://www.artic.edu"
    }
}
```
:::

##### `GET /web-exhibitions/{id}`

A single web-exhibition by the given identifier.

::: details Example request: https://api.artic.edu/api/v1/web-exhibitions/1  
```js
{
    "data": {
        "id": 1,
        "api_model": "web-exhibitions",
        "api_link": "https://api.artic.edu/api/v1/web-exhibitions/1",
        "title": "Charles White: A Retrospective",
        "exhibition_id": 2663,
        "is_featured": false,
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.4"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "total": 2241,
        "limit": 2,
        "offset": 0,
        "total_pages": 1121,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/events?page=2&limit=2"
    },
    "data": [
        {
            "id": 5377,
            "api_model": "events",
            "api_link": "https://api.artic.edu/api/v1/events/5377",
            "title": "Virtual Conversation: Arts, Crafts, and the Morris & Co. Aesthetic",
            "title_display": null,
            "published": false,
            ...
        },
        {
            "id": 5395,
            "api_model": "events",
            "api_link": "https://api.artic.edu/api/v1/events/5395",
            "title": "Jobs at Art Museums (JAM 2022): Equity and Social Justice",
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
        "version": "1.4"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "total": 2294,
        "limit": 10,
        "offset": 0,
        "total_pages": 230,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "events",
            "api_link": "https://aggregator-data.artic.edu/api/v1/events/4937",
            "id": 4937,
            "title": "Monet and Chicago",
            "timestamp": "2020-01-07T06:08:28-06:00"
        },
        {
            "_score": 1,
            "api_model": "events",
            "api_link": "https://aggregator-data.artic.edu/api/v1/events/4938",
            "id": 4938,
            "title": "Monet and Chicago",
            "timestamp": "2020-01-07T06:08:28-06:00"
        },
        {
            "_score": 1,
            "api_model": "events",
            "api_link": "https://api.artic.edu/api/v1/events/5418",
            "id": 5418,
            "title": "Member Preview: Cezanne",
            "timestamp": "2022-04-20T23:08:34-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.3"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "http://www.artic.edu"
    }
}
```
:::

##### `GET /events/{id}`

A single event by the given identifier.

::: details Example request: https://api.artic.edu/api/v1/events/4  
```js
{
    "data": {
        "id": 4,
        "api_model": "events",
        "api_link": "https://api.artic.edu/api/v1/events/4",
        "title": "Member Preview: John Singer Sargent and Chicago\u2019s Gilded Age",
        "title_display": null,
        "published": true,
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.4"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "total": 33,
        "limit": 2,
        "offset": 0,
        "total_pages": 17,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/event-occurrences?page=2&limit=2"
    },
    "data": [
        {
            "id": "ec3d83e8-1421-5e78-9cb4-8175658aebd2",
            "api_model": "event-occurrences",
            "api_link": "https://api.artic.edu/api/v1/event-occurrences/ec3d83e8-1421-5e78-9cb4-8175658aebd2",
            "title": "Jobs at Art Museums (JAM 2022): Learning and Public Engagement",
            "event_id": 5397,
            "short_description": "Meet staff whose work connects visitors to art and inspires them to question, confront, and imagine.",
            ...
        },
        {
            "id": "d8fc801b-0e7e-525e-9124-fd77afe91707",
            "api_model": "event-occurrences",
            "api_link": "https://api.artic.edu/api/v1/event-occurrences/d8fc801b-0e7e-525e-9124-fd77afe91707",
            "title": "Jobs at Art Museums (JAM 2022): Curatorial Affairs",
            "event_id": 5399,
            "short_description": "Meet staff whose decisions and knowledge shape the stories told both inside and outside of the museum\u2019s galleries.",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.4"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "total": 183,
        "limit": 10,
        "offset": 0,
        "total_pages": 19,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "event-occurrences",
            "api_link": "https://api.artic.edu/api/v1/event-occurrences/606772f5-4e63-54a1-99ad-d9552c25347e",
            "id": "606772f5-4e63-54a1-99ad-d9552c25347e",
            "title": "Member Preview: Cezanne",
            "timestamp": "2022-04-20T23:17:15-05:00"
        },
        {
            "_score": 1,
            "api_model": "event-occurrences",
            "api_link": "https://api.artic.edu/api/v1/event-occurrences/2eaec45d-4710-5de8-9db9-65ecffa22221",
            "id": "2eaec45d-4710-5de8-9db9-65ecffa22221",
            "title": "Member Preview: Cezanne",
            "timestamp": "2022-04-20T23:17:16-05:00"
        },
        {
            "_score": 1,
            "api_model": "event-occurrences",
            "api_link": "https://api.artic.edu/api/v1/event-occurrences/81be41a8-f096-5e61-b6c9-53565e9ed3b1",
            "id": "81be41a8-f096-5e61-b6c9-53565e9ed3b1",
            "title": "Member Preview: Cezanne",
            "timestamp": "2022-04-20T23:17:16-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.3"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "http://www.artic.edu"
    }
}
```
:::

##### `GET /event-occurrences/{id}`

A single event-occurrence by the given identifier.

::: details Example request: https://api.artic.edu/api/v1/event-occurrences/1a666375-2b62-5d89-bbb6-c02ea524e6db  
```js
{
    "data": {
        "id": "1a666375-2b62-5d89-bbb6-c02ea524e6db",
        "api_model": "event-occurrences",
        "api_link": "https://api.artic.edu/api/v1/event-occurrences/1a666375-2b62-5d89-bbb6-c02ea524e6db",
        "title": "Member Double Discount Day",
        "event_id": 5367,
        "short_description": "Members save 20% in the museum's shops\u2014and online at shop.artic.edu.",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.4"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "total": 71,
        "limit": 2,
        "offset": 0,
        "total_pages": 36,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/event-programs?page=2&limit=2"
    },
    "data": [
        {
            "id": 28,
            "api_model": "event-programs",
            "api_link": "https://api.artic.edu/api/v1/event-programs/28",
            "title": "Conservation and Science",
            "is_affiliate_group": false,
            "is_event_host": false,
            ...
        },
        {
            "id": 27,
            "api_model": "event-programs",
            "api_link": "https://api.artic.edu/api/v1/event-programs/27",
            "title": "Accessibility",
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
        "version": "1.4"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "total": 73,
        "limit": 10,
        "offset": 0,
        "total_pages": 8,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "event-programs",
            "api_link": "https://api.artic.edu/api/v1/event-programs/21",
            "id": 21,
            "title": "Old Masters Society",
            "timestamp": "2022-04-20T23:17:22-05:00"
        },
        {
            "_score": 1,
            "api_model": "event-programs",
            "api_link": "https://api.artic.edu/api/v1/event-programs/20",
            "id": 20,
            "title": "Evening Associates",
            "timestamp": "2022-04-20T23:17:22-05:00"
        },
        {
            "_score": 1,
            "api_model": "event-programs",
            "api_link": "https://api.artic.edu/api/v1/event-programs/19",
            "id": 19,
            "title": "Classical Art Society",
            "timestamp": "2022-04-20T23:17:22-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.3"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "http://www.artic.edu"
    }
}
```
:::

##### `GET /event-programs/{id}`

A single event-program by the given identifier.

::: details Example request: https://api.artic.edu/api/v1/event-programs/1  
```js
{
    "data": {
        "id": 1,
        "api_model": "event-programs",
        "api_link": "https://api.artic.edu/api/v1/event-programs/1",
        "title": "Artist\u2019s Studio",
        "is_affiliate_group": false,
        "is_event_host": false,
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.4"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "total": 354,
        "limit": 2,
        "offset": 0,
        "total_pages": 177,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/articles?page=2&limit=2"
    },
    "data": [
        {
            "id": 956,
            "api_model": "articles",
            "api_link": "https://api.artic.edu/api/v1/articles/956",
            "title": "small-wonders",
            ...
        },
        {
            "id": 941,
            "api_model": "articles",
            "api_link": "https://api.artic.edu/api/v1/articles/941",
            "title": "conserving-grinling-gibbons-the-michelangelo-of-wood-carving",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.4"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "total": 385,
        "limit": 10,
        "offset": 0,
        "total_pages": 39,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "articles",
            "api_link": "https://api.artic.edu/api/v1/articles/14",
            "id": 14,
            "title": "secrets-of-the-modern-wing",
            "timestamp": "2022-04-21T12:25:30-05:00"
        },
        {
            "_score": 1,
            "api_model": "articles",
            "api_link": "https://api.artic.edu/api/v1/articles/18",
            "id": 18,
            "title": "your-move",
            "timestamp": "2022-04-21T12:25:30-05:00"
        },
        {
            "_score": 1,
            "api_model": "articles",
            "api_link": "https://api.artic.edu/api/v1/articles/26",
            "id": 26,
            "title": "secrets-of-the-modern-wing-take-two",
            "timestamp": "2022-04-21T12:25:30-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.3"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "http://www.artic.edu"
    }
}
```
:::

##### `GET /articles/{id}`

A single article by the given identifier.

::: details Example request: https://api.artic.edu/api/v1/articles/14  
```js
{
    "data": {
        "id": 14,
        "api_model": "articles",
        "api_link": "https://api.artic.edu/api/v1/articles/14",
        "title": "secrets-of-the-modern-wing",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.4"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
    }
}
```
:::

#### Highlights

_The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for "fair use" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials._

##### `GET /highlights`

A list of all highlights sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](#highlights-2).

###### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

::: details Example request: https://api.artic.edu/api/v1/highlights?limit=2  
```js
{
    "pagination": {
        "total": 27,
        "limit": 2,
        "offset": 0,
        "total_pages": 14,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/highlights?page=2&limit=2"
    },
    "data": [
        {
            "id": 44,
            "api_model": "highlights",
            "api_link": "https://api.artic.edu/api/v1/highlights/44",
            "title": "i-thinking-of-s-you-s-i-mean-s-me-s-i-mean-you-i-360-tours",
            "published": true,
            ...
        },
        {
            "id": 4,
            "api_model": "highlights",
            "api_link": "https://api.artic.edu/api/v1/highlights/4",
            "title": "new-on-view",
            "published": true,
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.4"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
    }
}
```
:::

##### `GET /highlights/search`

Search highlights data in the aggregator. 

###### Available parameters:

* `q` - Your search query
* `query` - For complex queries, you can pass Elasticsearch domain syntax queries here
* `sort` - Used in conjunction with `query`
* `from` - Starting point of results. Pagination via Elasticsearch conventions
* `size` - Number of results to return. Pagination via Elasticsearch conventions
* `facets` - A comma-separated list of 'count' aggregation facets to include in the results.

::: details Example request: https://api.artic.edu/api/v1/highlights/search
```js
{
    "preference": null,
    "pagination": {
        "total": 31,
        "limit": 10,
        "offset": 0,
        "total_pages": 4,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "highlights",
            "api_link": "https://api.artic.edu/api/v1/highlights/3",
            "id": 3,
            "title": "what-to-see-in-an-hour",
            "timestamp": "2022-04-21T12:25:10-05:00"
        },
        {
            "_score": 1,
            "api_model": "highlights",
            "api_link": "https://api.artic.edu/api/v1/highlights/4",
            "id": 4,
            "title": "new-on-view",
            "timestamp": "2022-04-21T12:25:10-05:00"
        },
        {
            "_score": 1,
            "api_model": "highlights",
            "api_link": "https://api.artic.edu/api/v1/highlights/5",
            "id": 5,
            "title": "impressionism",
            "timestamp": "2022-04-21T12:25:10-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.3"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "http://www.artic.edu"
    }
}
```
:::

##### `GET /highlights/{id}`

A single highlight by the given identifier.

::: details Example request: https://api.artic.edu/api/v1/highlights/3  
```js
{
    "data": {
        "id": 3,
        "api_model": "highlights",
        "api_link": "https://api.artic.edu/api/v1/highlights/3",
        "title": "what-to-see-in-an-hour",
        "published": true,
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.4"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "total": 183,
        "limit": 2,
        "offset": 0,
        "total_pages": 92,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/web-artists?page=2&limit=2"
    },
    "data": [
        {
            "id": 3,
            "api_model": "web-artists",
            "api_link": "https://api.artic.edu/api/v1/web-artists/3",
            "title": "Neue Galerie New York",
            "has_also_known_as": null,
            "intro_copy": null,
            ...
        },
        {
            "id": 2,
            "api_model": "web-artists",
            "api_link": "https://api.artic.edu/api/v1/web-artists/2",
            "title": "Don A. DuBroff",
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
        "version": "1.4"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "total": 189,
        "limit": 10,
        "offset": 0,
        "total_pages": 19,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "web-artists",
            "api_link": "https://api.artic.edu/api/v1/web-artists/188",
            "id": 188,
            "title": "Yeesookyung",
            "timestamp": "2022-04-20T23:02:52-05:00"
        },
        {
            "_score": 1,
            "api_model": "web-artists",
            "api_link": "https://api.artic.edu/api/v1/web-artists/59",
            "id": 59,
            "title": "Rembrandt van Rijn",
            "timestamp": "2022-04-20T23:02:52-05:00"
        },
        {
            "_score": 1,
            "api_model": "web-artists",
            "api_link": "https://api.artic.edu/api/v1/web-artists/186",
            "id": 186,
            "title": "William Holman Hunt",
            "timestamp": "2022-04-20T23:02:57-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.3"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "http://www.artic.edu"
    }
}
```
:::

##### `GET /web-artists/{id}`

A single web-artist by the given identifier.

::: details Example request: https://api.artic.edu/api/v1/web-artists/1  
```js
{
    "data": {
        "id": 1,
        "api_model": "web-artists",
        "api_link": "https://api.artic.edu/api/v1/web-artists/1",
        "title": "Winslow Homer",
        "has_also_known_as": null,
        "intro_copy": "<p>Winslow Homer, one of the most influential American painters of the nineteenth century, is known for his dynamic depictions of the power and beauty of nature and reflections on humanity\u2019s struggle with the sea. A keen observer of the world around him, Homer likewise experimented with color, form, and composition, pushing his landscapes and genre pictures in modern directions. Raised in Massachusetts, he apprenticed in a lithography shop in Boston in the mid-1850s and soon secured work as a freelance illustrator. Relocating to New York, he undertook assignments for <em>Harper\u2019s Weekly</em><span>, among other journals, and enrolled in drawing classes at the National Academy of Design.&nbsp;</span></p><p>During the Civil War, <em>Harper\u2019s Weekly</em><span> sent</span><em><span> </span></em><span>Homer to the front, where he made drawings of </span><a href=\"https://www.artic.edu/artworks/158367/the-war-for-the-union-1862-a-cavalry-charge\" target=\"_blank\"><span>Union battlefields</span></a><span>, camps, and military hospitals that appeared as wood engravings in the widely circulated publication. Homer also took up painting during his time as an artist-correspondent. After the war, he focused on oil painting, working in New York and also traveling to France in 1866\u201367. Over the following decade, Homer painted </span><a href=\"https://www.artic.edu/artworks/44018/croquet-scene\" target=\"_blank\"><span>scenes of leisure</span></a><span> set in nature, such as </span><a href=\"https://www.artic.edu/artworks/75957/mount-washington\" target=\"_blank\"><span>the White Mountains</span></a><span> in New Hampshire and the Adirondacks in upstate New York. He also spent his summers visiting </span><a href=\"https://www.artic.edu/artworks/16800/boy-in-boat-gloucester\" target=\"_blank\"><span>New England fishing villages</span></a><span>, discovering new subjects that had a profound effect on his career.&nbsp;</span></p><p>In 1881, he spent more than a year in the small fishing village of Cullercoats, England. This extended stay in the seaside community catalyzed a new, enduring interest in humankind\u2019s age-old contest with nature, rendered in larger-scale compositions with more monumental figures and forms. In the summer of 1883 Homer moved to the coastal village of Prouts Neck, Maine, which remained his home for the rest of his life. There, he observed the shoreline in various weather conditions and seasons, creating his great seascapes, such as the iconic work <a href=\"https://www.artic.edu/artworks/25865/the-herring-net\" target=\"_blank\"><em>The Herring Net</em></a><span>. Amid the remote and dramatic landscape, he depicted views void of human life, focusing instead on an emotional response to nature, as in </span><a href=\"https://www.artic.edu/artworks/8971/coast-of-maine\" target=\"_blank\"><em><span>Coast of Maine</span></em></a><span>.&nbsp;</span></p><p>Late in his career, during visits to the Bahamas, Bermuda, Cuba, and Florida, Homer applied his sophisticated understanding of color and light to a new set of atmospheric conditions, most spectacularly in his watercolors, such as <a href=\"https://www.artic.edu/artworks/16776/after-the-hurricane-bahamas\" target=\"_blank\"><em>After the Hurricane, Bahamas</em></a><span>.</span></p><p>The Art Institute\u2019s collection of works by Winslow Homer spans his career. The artist\u2019s works on paper were featured in the 2008 exhibition <a href=\"https://archive.artic.edu/homer_exhb/overview/\" target=\"_blank\"><em>Watercolors by Winslow Homer: The Color of Light</em></a><em>.</em></p>",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.4"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
            ...
        },
        {
            "id": 10,
            "api_model": "static-pages",
            "api_link": "https://api.artic.edu/api/v1/static-pages/10",
            "title": "Press Release Archive",
            "web_url": "/press/archive",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.4"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
            "timestamp": "2022-04-21T12:25:58-05:00"
        },
        {
            "_score": 1,
            "api_model": "static-pages",
            "api_link": "https://api.artic.edu/api/v1/static-pages/2",
            "id": 2,
            "title": "Events",
            "timestamp": "2022-04-21T12:25:58-05:00"
        },
        {
            "_score": 1,
            "api_model": "static-pages",
            "api_link": "https://api.artic.edu/api/v1/static-pages/3",
            "id": 3,
            "title": "Exhibitions",
            "timestamp": "2022-04-21T12:25:58-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.3"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "http://www.artic.edu"
    }
}
```
:::

##### `GET /static-pages/{id}`

A single static-page by the given identifier.

::: details Example request: https://api.artic.edu/api/v1/static-pages/1  
```js
{
    "data": {
        "id": 1,
        "api_model": "static-pages",
        "api_link": "https://api.artic.edu/api/v1/static-pages/1",
        "title": "Visit",
        "web_url": "/visit",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.4"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "total": 280,
        "limit": 2,
        "offset": 0,
        "total_pages": 140,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/generic-pages?page=2&limit=2"
    },
    "data": [
        {
            "id": 476,
            "api_model": "generic-pages",
            "api_link": "https://api.artic.edu/api/v1/generic-pages/476",
            "title": "Jobs at Art Museums (JAM 2022)",
            "type": null,
            ...
        },
        {
            "id": 348,
            "api_model": "generic-pages",
            "api_link": "https://api.artic.edu/api/v1/generic-pages/348",
            "title": "Databases for Newspaper Research",
            "type": null,
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.4"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "total": 262,
        "limit": 10,
        "offset": 0,
        "total_pages": 27,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "generic-pages",
            "api_link": "https://api.artic.edu/api/v1/generic-pages/176",
            "id": 176,
            "title": "Press",
            "timestamp": "2022-04-20T23:23:08-05:00"
        },
        {
            "_score": 1,
            "api_model": "generic-pages",
            "api_link": "https://api.artic.edu/api/v1/generic-pages/254",
            "id": 254,
            "title": "Plan Your Event",
            "timestamp": "2022-04-20T23:23:08-05:00"
        },
        {
            "_score": 1,
            "api_model": "generic-pages",
            "api_link": "https://api.artic.edu/api/v1/generic-pages/75",
            "id": 75,
            "title": "Internships and Fellowships",
            "timestamp": "2022-04-20T23:23:08-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.3"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "http://www.artic.edu"
    }
}
```
:::

##### `GET /generic-pages/{id}`

A single generic-page by the given identifier.

::: details Example request: https://api.artic.edu/api/v1/generic-pages/2  
```js
{
    "data": {
        "id": 2,
        "api_model": "generic-pages",
        "api_link": "https://api.artic.edu/api/v1/generic-pages/2",
        "title": "Free Admission Opportunities",
        "type": null,
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.4"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "total": 290,
        "limit": 2,
        "offset": 0,
        "total_pages": 145,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/press-releases?page=2&limit=2"
    },
    "data": [
        {
            "id": 60,
            "api_model": "press-releases",
            "api_link": "https://api.artic.edu/api/v1/press-releases/60",
            "title": "Press Releases from 1998",
            ...
        },
        {
            "id": 59,
            "api_model": "press-releases",
            "api_link": "https://api.artic.edu/api/v1/press-releases/59",
            "title": "Press Releases from 1997",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.4"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "total": 276,
        "limit": 10,
        "offset": 0,
        "total_pages": 28,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "press-releases",
            "api_link": "https://api.artic.edu/api/v1/press-releases/1",
            "id": 1,
            "title": "Press Releases from 1939",
            "timestamp": "2022-04-21T12:24:59-05:00"
        },
        {
            "_score": 1,
            "api_model": "press-releases",
            "api_link": "https://api.artic.edu/api/v1/press-releases/2",
            "id": 2,
            "title": "Press Releases from 1940",
            "timestamp": "2022-04-21T12:24:59-05:00"
        },
        {
            "_score": 1,
            "api_model": "press-releases",
            "api_link": "https://api.artic.edu/api/v1/press-releases/3",
            "id": 3,
            "title": "Press Releases from 1941",
            "timestamp": "2022-04-21T12:24:59-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.3"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "http://www.artic.edu"
    }
}
```
:::

##### `GET /press-releases/{id}`

A single press-release by the given identifier.

::: details Example request: https://api.artic.edu/api/v1/press-releases/1  
```js
{
    "data": {
        "id": 1,
        "api_model": "press-releases",
        "api_link": "https://api.artic.edu/api/v1/press-releases/1",
        "title": "Press Releases from 1939",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.4"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "total": 120,
        "limit": 2,
        "offset": 0,
        "total_pages": 60,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/educator-resources?page=2&limit=2"
    },
    "data": [
        {
            "id": 77,
            "api_model": "educator-resources",
            "api_link": "https://api.artic.edu/api/v1/educator-resources/77",
            "title": "Teacher Manual: Gold of Africa",
            "type": null,
            ...
        },
        {
            "id": 75,
            "api_model": "educator-resources",
            "api_link": "https://api.artic.edu/api/v1/educator-resources/75",
            "title": "Teacher Manual: Hero, Hawk, and Open Hand: American Indian Art of the Ancient Midwest and South",
            "type": null,
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.4"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "total": 121,
        "limit": 10,
        "offset": 0,
        "total_pages": 13,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "educator-resources",
            "api_link": "https://api.artic.edu/api/v1/educator-resources/114",
            "id": 114,
            "title": "Art + Language: Story Map",
            "timestamp": "2022-04-20T23:24:37-05:00"
        },
        {
            "_score": 1,
            "api_model": "educator-resources",
            "api_link": "https://api.artic.edu/api/v1/educator-resources/82",
            "id": 82,
            "title": "Thematic Curriculum: Art + History",
            "timestamp": "2022-04-20T23:24:37-05:00"
        },
        {
            "_score": 1,
            "api_model": "educator-resources",
            "api_link": "https://api.artic.edu/api/v1/educator-resources/111",
            "id": 111,
            "title": "Art Explainer Videos: Three Themes",
            "timestamp": "2022-04-20T23:24:37-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.3"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "http://www.artic.edu"
    }
}
```
:::

##### `GET /educator-resources/{id}`

A single educator-resource by the given identifier.

::: details Example request: https://api.artic.edu/api/v1/educator-resources/7  
```js
{
    "data": {
        "id": 7,
        "api_model": "educator-resources",
        "api_link": "https://api.artic.edu/api/v1/educator-resources/7",
        "title": "Thematic Curriculum: Art + Science",
        "type": null,
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.4"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "total": 18,
        "limit": 2,
        "offset": 0,
        "total_pages": 9,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/digital-catalogs?page=2&limit=2"
    },
    "data": [
        {
            "id": 31,
            "api_model": "digital-catalogs",
            "api_link": "https://api.artic.edu/api/v1/digital-catalogs/31",
            "title": "Matisse Paintings, Works on Paper, Sculpture, and Textiles at the Art Institute of Chicago",
            "type": null,
            ...
        },
        {
            "id": 30,
            "api_model": "digital-catalogs",
            "api_link": "https://api.artic.edu/api/v1/digital-catalogs/30",
            "title": "Ivan Albright Paintings at the Art Institute of Chicago",
            "type": null,
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.4"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "total": 18,
        "limit": 10,
        "offset": 0,
        "total_pages": 2,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "digital-catalogs",
            "api_link": "https://api.artic.edu/api/v1/digital-catalogs/32",
            "id": 32,
            "title": "Whistler Paintings and Drawings at the Art Institute of Chicago",
            "timestamp": "2022-04-20T23:24:55-05:00"
        },
        {
            "_score": 1,
            "api_model": "digital-catalogs",
            "api_link": "https://api.artic.edu/api/v1/digital-catalogs/35",
            "id": 35,
            "title": "Test",
            "timestamp": "2022-04-20T23:24:55-05:00"
        },
        {
            "_score": 1,
            "api_model": "digital-catalogs",
            "api_link": "https://api.artic.edu/api/v1/digital-catalogs/34",
            "id": 34,
            "title": "Malangatana: Mozambique Modern",
            "timestamp": "2022-04-20T23:24:55-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.3"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "http://www.artic.edu"
    }
}
```
:::

##### `GET /digital-catalogs/{id}`

A single digital-catalog by the given identifier.

::: details Example request: https://api.artic.edu/api/v1/digital-catalogs/2  
```js
{
    "data": {
        "id": 2,
        "api_model": "digital-catalogs",
        "api_link": "https://api.artic.edu/api/v1/digital-catalogs/2",
        "title": "American Silver",
        "type": null,
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.4"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
    }
}
```
:::

#### Digital Publication Sections

_The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for "fair use" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials._

##### `GET /digital-publication-sections`

A list of all digital-publication-sections sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](#digital-publication-sections-2).

###### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

::: details Example request: https://api.artic.edu/api/v1/digital-publication-sections?limit=2  
```js
{
    "pagination": {
        "total": 12,
        "limit": 2,
        "offset": 0,
        "total_pages": 6,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/digital-publication-sections?page=2&limit=2"
    },
    "data": [
        {
            "id": 11,
            "api_model": "digital-publication-sections",
            "api_link": "https://api.artic.edu/api/v1/digital-publication-sections/11",
            "title": "Installation Views",
            "web_url": "https://nocache.www.artic.edu/digital-publications/34/malangatana-mozambique-modern/11/installation-views",
            ...
        },
        {
            "id": 10,
            "api_model": "digital-publication-sections",
            "api_link": "https://api.artic.edu/api/v1/digital-publication-sections/10",
            "title": "Works in the Exhibition",
            "web_url": "https://nocache.www.artic.edu/digital-publications/34/malangatana-mozambique-modern/10/works-in-the-exhibition",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.4"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
    }
}
```
:::

##### `GET /digital-publication-sections/search`

Search digital-publication-sections data in the aggregator. 

###### Available parameters:

* `q` - Your search query
* `query` - For complex queries, you can pass Elasticsearch domain syntax queries here
* `sort` - Used in conjunction with `query`
* `from` - Starting point of results. Pagination via Elasticsearch conventions
* `size` - Number of results to return. Pagination via Elasticsearch conventions
* `facets` - A comma-separated list of 'count' aggregation facets to include in the results.

::: details Example request: https://api.artic.edu/api/v1/digital-publication-sections/search
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
            "api_model": "digital-publication-sections",
            "api_link": "https://api.artic.edu/api/v1/digital-publication-sections/12",
            "id": 12,
            "title": "Test section",
            "timestamp": "2022-04-20T23:24:59-05:00"
        },
        {
            "_score": 1,
            "api_model": "digital-publication-sections",
            "api_link": "https://api.artic.edu/api/v1/digital-publication-sections/8",
            "id": 8,
            "title": "\u201cDeep Ambivalences: Malangatana\u2019s Anti/Colonial Aesthetic\u201d by M\u00e1rio Pissarra",
            "timestamp": "2022-04-20T23:24:59-05:00"
        },
        {
            "_score": 1,
            "api_model": "digital-publication-sections",
            "api_link": "https://api.artic.edu/api/v1/digital-publication-sections/7",
            "id": 7,
            "title": "\u201cAffinities: Malangatana, Surrealism, and Black Liberatory Politics\u201d by Felicia Mings",
            "timestamp": "2022-04-20T23:24:59-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.3"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "http://www.artic.edu"
    }
}
```
:::

##### `GET /digital-publication-sections/{id}`

A single digital-publication-section by the given identifier.

::: details Example request: https://api.artic.edu/api/v1/digital-publication-sections/1  
```js
{
    "data": {
        "id": 1,
        "api_model": "digital-publication-sections",
        "api_link": "https://api.artic.edu/api/v1/digital-publication-sections/1",
        "title": "Director's Foreword",
        "web_url": "https://nocache.www.artic.edu/digital-publications/34/malangatana-mozambique-modern/1/directors-foreword",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.4"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "total": 186,
        "limit": 2,
        "offset": 0,
        "total_pages": 93,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/printed-catalogs?page=2&limit=2"
    },
    "data": [
        {
            "id": 121,
            "api_model": "printed-catalogs",
            "api_link": "https://api.artic.edu/api/v1/printed-catalogs/121",
            "title": "Museum Studies (1990)",
            "type": null,
            ...
        },
        {
            "id": 117,
            "api_model": "printed-catalogs",
            "api_link": "https://api.artic.edu/api/v1/printed-catalogs/117",
            "title": "Museum Studies (1991)",
            "type": null,
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.4"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "total": 190,
        "limit": 10,
        "offset": 0,
        "total_pages": 19,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "printed-catalogs",
            "api_link": "https://api.artic.edu/api/v1/printed-catalogs/73",
            "id": 73,
            "title": "Film, Video, and New Media at the Art Institute of Chicago with the Howard and Donna Stone Gift (Museum Studies)",
            "timestamp": "2022-04-20T23:25:12-05:00"
        },
        {
            "_score": 1,
            "api_model": "printed-catalogs",
            "api_link": "https://api.artic.edu/api/v1/printed-catalogs/85",
            "id": 85,
            "title": "Notable Acquisitions at The Art Institute of Chicago (2006, Museum Studies)",
            "timestamp": "2022-04-20T23:25:12-05:00"
        },
        {
            "_score": 1,
            "api_model": "printed-catalogs",
            "api_link": "https://api.artic.edu/api/v1/printed-catalogs/84",
            "id": 84,
            "title": "Notable Acquisitions at the Art Institute of Chicago (2008, Museum Studies)",
            "timestamp": "2022-04-20T23:25:13-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.3"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "http://www.artic.edu"
    }
}
```
:::

##### `GET /printed-catalogs/{id}`

A single printed-catalog by the given identifier.

::: details Example request: https://api.artic.edu/api/v1/printed-catalogs/4  
```js
{
    "data": {
        "id": 4,
        "api_model": "printed-catalogs",
        "api_link": "https://api.artic.edu/api/v1/printed-catalogs/4",
        "title": "The Art Institute of Chicago: The Essential Guide",
        "type": null,
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.4"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
    }
}
```
:::

#### Issues

_The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for "fair use" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials._

##### `GET /issues`

A list of all issues sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](#issues-2).

###### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

::: details Example request: https://api.artic.edu/api/v1/issues?limit=2  
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
            "id": 2,
            "api_model": "issues",
            "api_link": "https://api.artic.edu/api/v1/issues/2",
            "title": "TEST ISSUE",
            "date": "2021-10-27T00:00:00-05:00",
            ...
        },
        {
            "id": 1,
            "api_model": "issues",
            "api_link": "https://api.artic.edu/api/v1/issues/1",
            "title": "Instability",
            "date": "2021-09-27T00:00:00-05:00",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.4"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
    }
}
```
:::

##### `GET /issues/search`

Search issues data in the aggregator. 

###### Available parameters:

* `q` - Your search query
* `query` - For complex queries, you can pass Elasticsearch domain syntax queries here
* `sort` - Used in conjunction with `query`
* `from` - Starting point of results. Pagination via Elasticsearch conventions
* `size` - Number of results to return. Pagination via Elasticsearch conventions
* `facets` - A comma-separated list of 'count' aggregation facets to include in the results.

::: details Example request: https://api.artic.edu/api/v1/issues/search
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
        "version": "1.3"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "http://www.artic.edu"
    }
}
```
:::

##### `GET /issues/{id}`

A single issue by the given identifier.

::: details Example request: https://api.artic.edu/api/v1/issues/1  
```js
{
    "data": {
        "id": 1,
        "api_model": "issues",
        "api_link": "https://api.artic.edu/api/v1/issues/1",
        "title": "Instability",
        "date": "2021-09-27T00:00:00-05:00",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.4"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
    }
}
```
:::

#### Issue Articles

_The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for "fair use" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials._

##### `GET /issue-articles`

A list of all issue-articles sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](#issue-articles-2).

###### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

::: details Example request: https://api.artic.edu/api/v1/issue-articles?limit=2  
```js
{
    "pagination": {
        "total": 9,
        "limit": 2,
        "offset": 0,
        "total_pages": 5,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/issue-articles?page=2&limit=2"
    },
    "data": [
        {
            "id": 6,
            "api_model": "issue-articles",
            "api_link": "https://api.artic.edu/api/v1/issue-articles/6",
            "title": "From Cloth to Clay: Identities and (Im)permanence in Moche Ceramics",
            "date": "2021-09-27T00:00:00-05:00",
            ...
        },
        {
            "id": 5,
            "api_model": "issue-articles",
            "api_link": "https://api.artic.edu/api/v1/issue-articles/5",
            "title": "Seven-Figure Settlements and Paid Days Off: An Interview with Devin Kenny",
            "date": "2021-09-27T00:00:00-05:00",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.4"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
    }
}
```
:::

##### `GET /issue-articles/search`

Search issue-articles data in the aggregator. 

###### Available parameters:

* `q` - Your search query
* `query` - For complex queries, you can pass Elasticsearch domain syntax queries here
* `sort` - Used in conjunction with `query`
* `from` - Starting point of results. Pagination via Elasticsearch conventions
* `size` - Number of results to return. Pagination via Elasticsearch conventions
* `facets` - A comma-separated list of 'count' aggregation facets to include in the results.

::: details Example request: https://api.artic.edu/api/v1/issue-articles/search
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
        "version": "1.3"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "http://www.artic.edu"
    }
}
```
:::

##### `GET /issue-articles/{id}`

A single issue-article by the given identifier.

::: details Example request: https://api.artic.edu/api/v1/issue-articles/1  
```js
{
    "data": {
        "id": 1,
        "api_model": "issue-articles",
        "api_link": "https://api.artic.edu/api/v1/issue-articles/1",
        "title": "Forces of Instability",
        "date": "2021-09-27T00:00:00-05:00",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.4"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
    }
}
```
:::

