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
  * `dates`
  * `place_pivots`
  * `sites`

::: details Example request: https://api.artic.edu/api/v1/artworks?limit=2  
```js
{
    "pagination": {
        "total": 116915,
        "limit": 2,
        "offset": 0,
        "total_pages": 58458,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/artworks?page=2&limit=2"
    },
    "data": [
        {
            "id": 214319,
            "api_model": "artworks",
            "api_link": "https://api.artic.edu/api/v1/artworks/214319",
            "is_boosted": false,
            "title": "Splash Point, A Stormy Day, Sunshine After a Shower",
            "alt_titles": null,
            ...
        },
        {
            "id": 214321,
            "api_model": "artworks",
            "api_link": "https://api.artic.edu/api/v1/artworks/214321",
            "is_boosted": false,
            "title": "Splash Point, A Stormy Day, Sunshine After a Shower",
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
        "version": "1.5"
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
        "total": 295,
        "limit": 10,
        "offset": 0,
        "total_pages": 30,
        "current_page": 1
    },
    "data": [
        {
            "_score": 244.0074,
            "thumbnail": {
                "alt_text": "Painting of a pond seen up close spotted with thickly painted pink and white water lilies and a shadow across the top third of the picture.",
                "width": 8808,
                "lqip": "data:image/gif;base64,R0lGODlhBQAFAPQAAEZcaFFfdVtqbk9ldFBlcVFocllrcFlrd11rdl9sdFZtf15wcWV0d2R2eGByfmd6eGl6e2t9elZxiGF4kWB4kmJ9kGJ8lWeCkWSAnQAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAAAAAAALAAAAAAFAAUAAAUVoJBADXI4TLRMWHU9hmRRCjAURBACADs=",
                "height": 8460
            },
            "api_model": "artworks",
            "is_boosted": true,
            "api_link": "https://api.artic.edu/api/v1/artworks/16568",
            "id": 16568,
            "title": "Water Lilies",
            "timestamp": "2022-09-21T23:09:27-05:00"
        },
        {
            "_score": 226.07365,
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
            "timestamp": "2022-09-21T23:09:27-05:00"
        },
        {
            "_score": 223.58144,
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
            "timestamp": "2022-09-21T23:09:26-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.5"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "version": "1.5"
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
                    "@id": "https://www.artic.edu/iiif/2/1753b638-d4fb-8e45-3db9-92dde7f053da",
                    "label": "Priest and Boy, n.d.. Lawrence Carmichael Earle, American, 1845-1921",
                    "width": 843,
                    "height": 1162,
                    "images": [
                        {
                            "@type": "oa:Annotation",
                            "motivation": "sc:painting",
                            "on": "https://www.artic.edu/iiif/2/1753b638-d4fb-8e45-3db9-92dde7f053da",
                            "resource": {
                                "@type": "dctypes:Image",
                                "@id": "https://www.artic.edu/iiif/2/1753b638-d4fb-8e45-3db9-92dde7f053da/full/843,/0/default.jpg",
                                "width": 843,
                                "height": 1162,
                                "service": {
                                    "@context": "http://iiif.io/api/image/2/context.json",
                                    "@id": "https://www.artic.edu/iiif/2/1753b638-d4fb-8e45-3db9-92dde7f053da",
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

::: details Example request: https://api.artic.edu/api/v1/agents?limit=2  
```js
{
    "pagination": {
        "total": 14764,
        "limit": 2,
        "offset": 0,
        "total_pages": 7382,
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
        "version": "1.5"
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
        "total": 14764,
        "limit": 10,
        "offset": 0,
        "total_pages": 1477,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "agents",
            "api_link": "https://api.artic.edu/api/v1/agents/23393",
            "id": 23393,
            "title": "Sarah Scott",
            "timestamp": "2022-09-22T15:01:13-05:00"
        },
        {
            "_score": 1,
            "api_model": "agents",
            "api_link": "https://api.artic.edu/api/v1/agents/23395",
            "id": 23395,
            "title": "Thomas Scott",
            "timestamp": "2022-09-22T15:01:13-05:00"
        },
        {
            "_score": 1,
            "api_model": "agents",
            "api_link": "https://api.artic.edu/api/v1/agents/23408",
            "id": 23408,
            "title": "Sean Scully",
            "timestamp": "2022-09-22T15:01:13-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.5"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "version": "1.5"
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
        "total": 3968,
        "limit": 2,
        "offset": 0,
        "total_pages": 1984,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/places?page=2&limit=2"
    },
    "data": [
        {
            "id": -5133,
            "api_model": "places",
            "api_link": "https://api.artic.edu/api/v1/places/-5133",
            "title": "Cirebon",
            "latitude": -6.7667,
            "longitude": 108.55,
            ...
        },
        {
            "id": -2147480193,
            "api_model": "places",
            "api_link": "https://api.artic.edu/api/v1/places/-2147480193",
            "title": "Saltillo",
            "latitude": 25.5,
            "longitude": -101,
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Attribution 4.0 Generic License (CC-By) and the Terms and Conditions of artic.edu. Contains information from the J. Paul Getty Trust, Getty Research Institute, the Getty Thesaurus of Geographic Names, which is made available under the ODC Attribution License.",
        "license_links": [
            "https://www.artic.edu/terms",
            "https://creativecommons.org/licenses/by/4.0/"
        ],
        "version": "1.5"
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
        "total": 3968,
        "limit": 10,
        "offset": 0,
        "total_pages": 397,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "places",
            "api_link": "https://api.artic.edu/api/v1/places/-2147474044",
            "id": -2147474044,
            "title": "Brimfield",
            "timestamp": "2022-05-08T23:17:35-05:00"
        },
        {
            "_score": 1,
            "api_model": "places",
            "api_link": "https://api.artic.edu/api/v1/places/-2147474041",
            "id": -2147474041,
            "title": "Bryn Mawr",
            "timestamp": "2022-05-08T23:17:35-05:00"
        },
        {
            "_score": 1,
            "api_model": "places",
            "api_link": "https://api.artic.edu/api/v1/places/-2147474034",
            "id": -2147474034,
            "title": "Canterbury",
            "timestamp": "2022-05-08T23:17:35-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Attribution 4.0 Generic License (CC-By) and the Terms and Conditions of artic.edu. Contains information from the J. Paul Getty Trust, Getty Research Institute, the Getty Thesaurus of Geographic Names, which is made available under the ODC Attribution License.",
        "license_links": [
            "https://www.artic.edu/terms",
            "https://creativecommons.org/licenses/by/4.0/"
        ],
        "version": "1.5"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "version": "1.5"
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
            "id": 2147480089,
            "api_model": "galleries",
            "api_link": "https://api.artic.edu/api/v1/galleries/2147480089",
            "title": "Gallery 108",
            "latitude": 41.879217980406,
            "longitude": -87.623406184027,
            ...
        },
        {
            "id": 25238,
            "api_model": "galleries",
            "api_link": "https://api.artic.edu/api/v1/galleries/25238",
            "title": "Bluhm Family Terrace",
            "latitude": 41.88047341848,
            "longitude": -87.622294127941,
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.5"
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
        "total": 108,
        "limit": 10,
        "offset": 0,
        "total_pages": 11,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "galleries",
            "api_link": "https://api.artic.edu/api/v1/galleries/28658",
            "id": 28658,
            "title": "Gallery 268",
            "timestamp": "2022-05-08T23:17:36-05:00"
        },
        {
            "_score": 1,
            "api_model": "galleries",
            "api_link": "https://api.artic.edu/api/v1/galleries/2147476836",
            "id": 2147476836,
            "title": "Gallery 227",
            "timestamp": "2022-05-08T23:17:36-05:00"
        },
        {
            "_score": 1,
            "api_model": "galleries",
            "api_link": "https://api.artic.edu/api/v1/galleries/2147477076",
            "id": 2147477076,
            "title": "North Stanley McCormick Memorial Garden",
            "timestamp": "2022-05-08T23:17:36-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.5"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "version": "1.5"
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
        "total": 6436,
        "limit": 2,
        "offset": 0,
        "total_pages": 3218,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/exhibitions?page=2&limit=2"
    },
    "data": [
        {
            "id": 3070,
            "api_model": "exhibitions",
            "api_link": "https://api.artic.edu/api/v1/exhibitions/3070",
            "title": "Van Gogh",
            "is_featured": false,
            "is_published": true,
            ...
        },
        {
            "id": 3365,
            "api_model": "exhibitions",
            "api_link": "https://api.artic.edu/api/v1/exhibitions/3365",
            "title": "John Massey: Cart\u00f3n de Venezuela",
            "is_featured": false,
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
        "version": "1.5"
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
        "total": 6167,
        "limit": 10,
        "offset": 0,
        "total_pages": 617,
        "current_page": 1
    },
    "data": [
        {
            "_score": 6.6640873,
            "api_model": "exhibitions",
            "api_link": "https://api.artic.edu/api/v1/exhibitions/4568",
            "id": 4568,
            "title": "International Exhibition of Modern Art. The Armory Show.",
            "timestamp": "2022-09-08T13:16:22-05:00"
        },
        {
            "_score": 6.6640873,
            "api_model": "exhibitions",
            "api_link": "https://api.artic.edu/api/v1/exhibitions/821",
            "id": 821,
            "title": "A Case for Wine: From King Tut to Today",
            "timestamp": "2022-09-08T13:16:23-05:00"
        },
        {
            "_score": 6.6640873,
            "api_model": "exhibitions",
            "api_link": "https://api.artic.edu/api/v1/exhibitions/8130",
            "id": 8130,
            "title": "Claude Monet: 1840-1926",
            "timestamp": "2022-09-08T13:16:19-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.5"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "is_published": true,
        ...
    },
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.5"
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
            "updated_at": "2019-05-09T17:01:08-05:00",
            ...
        },
        {
            "id": 28,
            "api_model": "agent-types",
            "api_link": "https://api.artic.edu/api/v1/agent-types/28",
            "title": "Nonprofit",
            "source_updated_at": "2019-05-08T18:31:54-05:00",
            "updated_at": "2019-05-09T17:01:08-05:00",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.5"
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
        "updated_at": "2019-05-09T17:01:08-05:00",
        ...
    },
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.5"
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
            "updated_at": "2020-06-24T21:00:33-05:00",
            ...
        },
        {
            "id": 574,
            "api_model": "agent-roles",
            "api_link": "https://api.artic.edu/api/v1/agent-roles/574",
            "title": "File Transfer",
            "source_updated_at": "2019-05-08T19:05:12-05:00",
            "updated_at": "2019-05-09T17:01:07-05:00",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.5"
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
        "updated_at": "2019-05-09T17:01:07-05:00",
        ...
    },
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.5"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
            "source_updated_at": "2020-04-14T09:36:05-05:00",
            "updated_at": "2020-04-14T13:46:00-05:00",
            ...
        },
        {
            "id": 55,
            "api_model": "artwork-place-qualifiers",
            "api_link": "https://api.artic.edu/api/v1/artwork-place-qualifiers/55",
            "title": "Inhabited place:",
            "source_updated_at": "2020-04-13T13:01:45-05:00",
            "updated_at": "2020-04-13T13:05:56-05:00",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.5"
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
        "updated_at": "2019-05-09T17:01:07-05:00",
        ...
    },
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.5"
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
            "updated_at": "2021-07-12T16:20:41-05:00",
            ...
        },
        {
            "id": 62,
            "api_model": "artwork-date-qualifiers",
            "api_link": "https://api.artic.edu/api/v1/artwork-date-qualifiers/62",
            "title": "Manufactured",
            "source_updated_at": "2019-05-08T21:59:24-05:00",
            "updated_at": "2019-05-09T17:01:07-05:00",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.5"
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
        "updated_at": "2019-05-09T17:01:07-05:00",
        ...
    },
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.5"
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
            "id": 1,
            "api_model": "artwork-types",
            "api_link": "https://api.artic.edu/api/v1/artwork-types/1",
            "title": "Painting",
            "aat_id": 300033618,
            "source_updated_at": "2019-05-08T19:03:58-05:00",
            ...
        },
        {
            "id": 23,
            "api_model": "artwork-types",
            "api_link": "https://api.artic.edu/api/v1/artwork-types/23",
            "title": "Vessel",
            "aat_id": 300193015,
            "source_updated_at": "2019-05-08T19:03:58-05:00",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.5"
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
        "aat_id": 300033618,
        "source_updated_at": "2019-05-08T19:03:58-05:00",
        ...
    },
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.5"
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
        "total": 9720,
        "limit": 2,
        "offset": 0,
        "total_pages": 4860,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/category-terms?page=2&limit=2"
    },
    "data": [
        {
            "id": "TM-15331",
            "api_model": "category-terms",
            "api_link": "https://api.artic.edu/api/v1/category-terms/TM-15331",
            "title": "oil",
            "subtype": "classification",
            "parent_id": null,
            ...
        },
        {
            "id": "TM-15329",
            "api_model": "category-terms",
            "api_link": "https://api.artic.edu/api/v1/category-terms/TM-15329",
            "title": "obi (sash)",
            "subtype": "classification",
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
        "version": "1.5"
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
        "total": 9720,
        "limit": 10,
        "offset": 0,
        "total_pages": 972,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "category-terms",
            "api_link": "https://api.artic.edu/api/v1/category-terms/TM-13494",
            "id": "TM-13494",
            "title": "babessi",
            "timestamp": "2022-05-08T23:19:07-05:00"
        },
        {
            "_score": 1,
            "api_model": "category-terms",
            "api_link": "https://api.artic.edu/api/v1/category-terms/TM-13495",
            "id": "TM-13495",
            "title": "bankoni",
            "timestamp": "2022-05-08T23:19:07-05:00"
        },
        {
            "_score": 1,
            "api_model": "category-terms",
            "api_link": "https://api.artic.edu/api/v1/category-terms/TM-13496",
            "id": "TM-13496",
            "title": "lagoons peoples",
            "timestamp": "2022-05-08T23:19:07-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.5"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "version": "1.5"
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
        "total": 152047,
        "limit": 2,
        "offset": 0,
        "total_pages": 76024,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/images?page=2&limit=2"
    },
    "data": [
        {
            "id": "b6c7f619-7978-17b6-57b8-cc29e55d01eb",
            "lake_guid": "b6c7f619-7978-17b6-57b8-cc29e55d01eb",
            "api_model": "images",
            "api_link": "https://api.artic.edu/api/v1/images/b6c7f619-7978-17b6-57b8-cc29e55d01eb",
            "title": "262843",
            "type": "image",
            ...
        },
        {
            "id": "d1e7ad2f-fda3-8682-ff7f-c95921b57789",
            "lake_guid": "d1e7ad2f-fda3-8682-ff7f-c95921b57789",
            "api_model": "images",
            "api_link": "https://api.artic.edu/api/v1/images/d1e7ad2f-fda3-8682-ff7f-c95921b57789",
            "title": "J2382-int",
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
        "version": "1.5"
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
        "total": 152047,
        "limit": 10,
        "offset": 0,
        "total_pages": 15205,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "images",
            "api_link": "https://api.artic.edu/api/v1/images/c848898b-8335-0f4e-6b2d-f1a7c372580c",
            "id": "c848898b-8335-0f4e-6b2d-f1a7c372580c",
            "title": "SI-CI24282",
            "timestamp": "2022-05-08T23:21:45-05:00"
        },
        {
            "_score": 1,
            "api_model": "images",
            "api_link": "https://api.artic.edu/api/v1/images/41b3178d-2fe9-f747-96e4-05fe72c19d98",
            "id": "41b3178d-2fe9-f747-96e4-05fe72c19d98",
            "title": "SI-CI34467",
            "timestamp": "2022-05-08T23:21:45-05:00"
        },
        {
            "_score": 1,
            "api_model": "images",
            "api_link": "https://api.artic.edu/api/v1/images/6278a77c-d6a8-afab-703c-78fb8fa180f5",
            "id": "6278a77c-d6a8-afab-703c-78fb8fa180f5",
            "title": "SI-CI16232",
            "timestamp": "2022-05-08T23:21:45-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.5"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
    }
}
```
:::

##### `GET /images/{id}`

A single image by the given identifier. {id} is the identifier from our collections management system.

::: details Example request: https://api.artic.edu/api/v1/images/0691a394-853c-20f5-4237-d07270e130a5  
```js
{
    "data": {
        "id": "0691a394-853c-20f5-4237-d07270e130a5",
        "lake_guid": "0691a394-853c-20f5-4237-d07270e130a5",
        "api_model": "images",
        "api_link": "https://api.artic.edu/api/v1/images/0691a394-853c-20f5-4237-d07270e130a5",
        "title": "AIC1999RevivalReform026.jpg",
        "type": "image",
        ...
    },
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.5"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
    }
}
```
:::

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
        "version": "1.5"
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
        "total": 0,
        "limit": 10,
        "offset": 0,
        "total_pages": 0,
        "current_page": 1
    },
    "data": [],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.5"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
            "id": "88cd5cf0-d906-0722-3540-e829adc2e3e9",
            "lake_guid": "88cd5cf0-d906-0722-3540-e829adc2e3e9",
            "api_model": "sounds",
            "api_link": "https://api.artic.edu/api/v1/sounds/88cd5cf0-d906-0722-3540-e829adc2e3e9",
            "title": "Audio stop 200",
            "type": "sound",
            ...
        },
        {
            "id": "148c8049-3a8d-dd47-0456-4e93b07f3d52",
            "lake_guid": "148c8049-3a8d-dd47-0456-4e93b07f3d52",
            "api_model": "sounds",
            "api_link": "https://api.artic.edu/api/v1/sounds/148c8049-3a8d-dd47-0456-4e93b07f3d52",
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
        "version": "1.5"
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
        "total": 808,
        "limit": 10,
        "offset": 0,
        "total_pages": 81,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "sounds",
            "api_link": "https://api.artic.edu/api/v1/sounds/f38522ed-05e8-8761-953e-77d965c87ccf",
            "id": "f38522ed-05e8-8761-953e-77d965c87ccf",
            "title": "Audio Lecture: The History and Transformation of a Benin Exhibition",
            "timestamp": "2022-05-08T23:34:10-05:00"
        },
        {
            "_score": 1,
            "api_model": "sounds",
            "api_link": "https://api.artic.edu/api/v1/sounds/586f399e-1566-b42a-c4a9-5b4aa77a0d2f",
            "id": "586f399e-1566-b42a-c4a9-5b4aa77a0d2f",
            "title": "Audio Lecture: Mel Bochner Symposium, Introduction and Keynote",
            "timestamp": "2022-05-08T23:34:10-05:00"
        },
        {
            "_score": 1,
            "api_model": "sounds",
            "api_link": "https://api.artic.edu/api/v1/sounds/df8dcfba-6535-64e2-a4d1-7701e2d121e8",
            "id": "df8dcfba-6535-64e2-a4d1-7701e2d121e8",
            "title": "Audio Lecture: Mel Bochner Symposium, Panel I: Language (Eric de Bruyn)",
            "timestamp": "2022-05-08T23:34:10-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.5"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
    }
}
```
:::

##### `GET /sounds/{id}`

A single sound by the given identifier. {id} is the identifier from our collections management system.

::: details Example request: https://api.artic.edu/api/v1/sounds/f38522ed-05e8-8761-953e-77d965c87ccf  
```js
{
    "data": {
        "id": "f38522ed-05e8-8761-953e-77d965c87ccf",
        "lake_guid": "f38522ed-05e8-8761-953e-77d965c87ccf",
        "api_model": "sounds",
        "api_link": "https://api.artic.edu/api/v1/sounds/f38522ed-05e8-8761-953e-77d965c87ccf",
        "title": "Audio Lecture: The History and Transformation of a Benin Exhibition",
        "type": "sound",
        ...
    },
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.5"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
    }
}
```
:::

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
            "id": "f5d65805-7dae-d72a-128f-cea0c7df3a7e",
            "lake_guid": "f5d65805-7dae-d72a-128f-cea0c7df3a7e",
            "api_model": "texts",
            "api_link": "https://api.artic.edu/api/v1/texts/f5d65805-7dae-d72a-128f-cea0c7df3a7e",
            "title": "AIC1968IllinoisArt_comb.pdf",
            "type": "text",
            ...
        },
        {
            "id": "a9830faa-05e7-f498-18fa-b5d9d1c62c20",
            "lake_guid": "a9830faa-05e7-f498-18fa-b5d9d1c62c20",
            "api_model": "texts",
            "api_link": "https://api.artic.edu/api/v1/texts/a9830faa-05e7-f498-18fa-b5d9d1c62c20",
            "title": "AIC1955Portrait_comb.pdf",
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
        "version": "1.5"
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
        "total": 3866,
        "limit": 10,
        "offset": 0,
        "total_pages": 387,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "texts",
            "api_link": "https://api.artic.edu/api/v1/texts/0d65a0b4-d5da-fe69-1d2f-2e9bffd63766",
            "id": "0d65a0b4-d5da-fe69-1d2f-2e9bffd63766",
            "title": "1970_Photographs_by_Edmund_Teske_Installation_Photos_3.pdf",
            "timestamp": "2022-05-08T23:34:12-05:00"
        },
        {
            "_score": 1,
            "api_model": "texts",
            "api_link": "https://api.artic.edu/api/v1/texts/027ff618-fffa-9149-7a84-f3fb3a008122",
            "id": "027ff618-fffa-9149-7a84-f3fb3a008122",
            "title": "1969_Fragments_of_the_Past_Part_2_Installation_Photos_8.pdf",
            "timestamp": "2022-05-08T23:34:12-05:00"
        },
        {
            "_score": 1,
            "api_model": "texts",
            "api_link": "https://api.artic.edu/api/v1/texts/cff82065-63b6-cb53-794b-b892e23b462e",
            "id": "cff82065-63b6-cb53-794b-b892e23b462e",
            "title": "1970_Photographs_by_Edmund_Teske_Installation_Photos_12.pdf",
            "timestamp": "2022-05-08T23:34:12-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.5"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
    }
}
```
:::

##### `GET /texts/{id}`

A single text by the given identifier. {id} is the identifier from our collections management system.

::: details Example request: https://api.artic.edu/api/v1/texts/46298023-ac4e-605c-3020-871b59e67de6  
```js
{
    "data": {
        "id": "46298023-ac4e-605c-3020-871b59e67de6",
        "lake_guid": "46298023-ac4e-605c-3020-871b59e67de6",
        "api_model": "texts",
        "api_link": "https://api.artic.edu/api/v1/texts/46298023-ac4e-605c-3020-871b59e67de6",
        "title": "1970_Photographs_by_Edmund_Teske_Installation_Photos_10.pdf",
        "type": "text",
        ...
    },
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.5"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
    }
}
```
:::

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
        "total": 1057,
        "limit": 2,
        "offset": 0,
        "total_pages": 529,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/products?page=2&limit=2"
    },
    "data": [
        {
            "id": 248052,
            "api_model": "products",
            "api_link": "https://api.artic.edu/api/v1/products/248052",
            "title": "Art Institute of Chicago Sticky Note Set",
            "external_sku": 116811,
            "image_url": "https://shop-images.imgix.net/116811_2.jpg",
            ...
        },
        {
            "id": 247757,
            "api_model": "products",
            "api_link": "https://api.artic.edu/api/v1/products/247757",
            "title": "Art Institute of Chicago Magnet",
            "external_sku": 115900,
            "image_url": "https://shop-images.imgix.net/115900_2.jpg",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.5"
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
        "version": "1.5"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "image_url": "https://shop-images.imgix.net/101127_2.jpg",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.5"
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
        "total": 16,
        "limit": 2,
        "offset": 0,
        "total_pages": 8,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/tours?page=2&limit=2"
    },
    "data": [
        {
            "id": 4219,
            "api_model": "tours",
            "api_link": "https://api.artic.edu/api/v1/tours/4219",
            "title": "Politics, Status, Fashion: The Arms and Armor Collection",
            "image": "http://aic-mobile-tours.artic.edu/sites/default/files/tour-images/aa-pistol-prepped.jpg",
            "description": "<p>Immerse yourself in the lives of royalty, warfare and sport, and Renaissance fashion in this audio tour for the Arms and Armor collection at the Art Institute of Chicago.</p>\n",
            ...
        },
        {
            "id": 4197,
            "api_model": "tours",
            "api_link": "https://api.artic.edu/api/v1/tours/4197",
            "title": "The Teen Tour",
            "image": "http://aic-mobile-tours.artic.edu/sites/default/files/tour-images/IM031265_695-int.jpg",
            "description": "<p>Experience the museum through sounds and stories produced by Chicago teens.</p>\n",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.5"
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
        "total": 18,
        "limit": 10,
        "offset": 0,
        "total_pages": 2,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "tours",
            "api_link": "https://api.artic.edu/api/v1/tours/4989",
            "id": 4989,
            "title": "Cezanne",
            "timestamp": "2022-09-06T23:00:59-05:00"
        },
        {
            "_score": 1,
            "api_model": "tours",
            "api_link": "https://api.artic.edu/api/v1/tours/4999",
            "id": 4999,
            "title": "Cezanne Verbal Description Tour",
            "timestamp": "2022-09-06T23:00:59-05:00"
        },
        {
            "_score": 1,
            "api_model": "tours",
            "api_link": "https://api.artic.edu/api/v1/tours/5155",
            "id": 5155,
            "title": "Sophie Calle Verbal Description Tour",
            "timestamp": "2022-09-21T23:00:48-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.5"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "version": "1.5"
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
        "total": 864,
        "limit": 2,
        "offset": 0,
        "total_pages": 432,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/mobile-sounds?page=2&limit=2"
    },
    "data": [
        {
            "id": 5138,
            "api_model": "mobile-sounds",
            "api_link": "https://api.artic.edu/api/v1/mobile-sounds/5138",
            "title": "Stop 5 (Sophie Calle Verbal Description Tour)",
            "web_url": "https://www.artic.edu/mobile/audio/2020.384.16a_SophieCalle_VerbalDescr_6.mp3",
            "transcript": "<p>The man I live with is the most beautiful thing I know. Even though he could be a few inches taller. I\u2019ve never come across absolute perfection. I prefer well-built men. It\u2019s a question of size and shape. Facial features don\u2019t mean much to me. What pleases me aesthetically is a man\u2019s body, slim and muscular.<br>\u2014<br>Image Description:<br>The portrait shows a light-skinned woman with short, curly hair. She wears a pair of dark, wide sunglasses, a light-colored sweater, and a delicate necklace.</p>\n<p>In the image of beauty, a light-skinned man lies on his right side facing away from the camera in an unmade bed. His head and torso dominate the foreground on the right as he leans back on his elbows, and his body extends to the left on a diagonal, moving away from the camera. He wears only red, white, and blue floral patterned shorts or underwear. Light enters the space from the right and only pieces of his body catch the light: his back, his hip, his heel. His back muscles are clearly visible. His head and legs are completely in shadow. His short, dark, curly hair blends into the darkness in the top right corner. Off-white sheets bunch around his back and lie wrinkled along the left side. Just beyond his legs, a blue and white striped garment, perhaps a dress, lies on the bed.</p>\n",
            ...
        },
        {
            "id": 5137,
            "api_model": "mobile-sounds",
            "api_link": "https://api.artic.edu/api/v1/mobile-sounds/5137",
            "title": "Stop 3 (Sophie Calle Verbal Description Tour)",
            "web_url": "https://www.artic.edu/mobile/audio/2020.384.11c_SophieCalle_VerbalDescr_5.mp3",
            "transcript": "<p>This view from my balcony, in Haute-Savoie, is first class. It really moves me aesthetically. It is where I sit to clear my mind and contemplate. To watch time pass.<br>Beauty is harmony. My mother stopped me from touching things. She would say: \u2018Don\u2019t touch, it makes you look like a blind person.\u2019 The first thing I was really able to touch was a man. He was rough-hewn. He was bold, vigorous, had a mustache. His name was Gilbert. There was a secret harmony of proportion in him. I thought he was very handsome\u2026I have not kept any photos of him.</p>\n<p>Image Description:<br>The portrait shows a light-skinned woman wearing large, dark sunglasses that cover her face from her brow to the middle of her cheeks. You can just barely see her eyes through the lenses. The woman has long, dark hair pulled back into a ponytail. Her expression is neutral, neither smiling nor frowning. She wears a dark-colored blouse with a wide neckline that exposes much of her right shoulder.</p>\n<p>Just over half of the image of beauty is filled with the periwinkle sky, with only a few dark clouds in sight on the left. The bottom of the image is dominated by trees in shadow. Most of the trees have bare branches, save a handful of pine trees which also feature some snow. The two planes are separated by a range of craggy, snow-covered mountains. Their shapes are unclear, obscured by intermittent clouds. It is easier to make out the mountains on the right than on the left, but they all catch the light. A massive pine tree on the right stands out by interrupting the view of the mountains behind it, with its top branches touching the sky above it. Behind this tree is a dark mountain that may be covered in vegetation instead of snow.</p>\n",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.5"
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
        "total": 864,
        "limit": 10,
        "offset": 0,
        "total_pages": 87,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "mobile-sounds",
            "api_link": "https://api.artic.edu/api/v1/mobile-sounds/5133",
            "id": 5133,
            "title": "Sophie Calle Intro  (Sophie Calle Verbal Description Tour)",
            "timestamp": "2022-09-21T23:00:11-05:00"
        },
        {
            "_score": 1,
            "api_model": "mobile-sounds",
            "api_link": "https://api.artic.edu/api/v1/mobile-sounds/226",
            "id": 226,
            "title": "Justus Sustermans",
            "timestamp": "2022-09-21T23:00:11-05:00"
        },
        {
            "_score": 1,
            "api_model": "mobile-sounds",
            "api_link": "https://api.artic.edu/api/v1/mobile-sounds/227",
            "id": 227,
            "title": "Self-Portrait, Etching at a Window",
            "timestamp": "2022-09-21T23:00:11-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.5"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "version": "1.5"
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
            "id": 140019,
            "api_model": "publications",
            "api_link": "https://api.artic.edu/api/v1/publications/140019",
            "title": "Manet Paintings and Works on Paper at the Art Institute of Chicago",
            "web_url": "https://publications.artic.edu/manet/reader/manetart",
            "section_ids": [
                39211200800,
                39211480841,
                39211760883,
                39212040926,
                39212601015,
                39213161108,
                39213441156,
                39213721205,
                39214001255,
                39214281306,
                39214561358,
                39214841411,
                39215401520,
                39216241691,
                39216521750,
                39216801810,
                39217081871,
                39217361933,
                39217641996,
                39217922060,
                39218202125,
                39218482191,
                39218762258,
                39219042326,
                39219322395,
                39219602465,
                39219882536,
                39220162608,
                39220442681,
                39220722755,
                39221282906,
                39221562983,
                39221843061,
                39222123140,
                39243972383
            ],
            ...
        },
        {
            "id": 135446,
            "api_model": "publications",
            "api_link": "https://api.artic.edu/api/v1/publications/135446",
            "title": "Renoir Paintings and Drawings at the Art Institute of Chicago",
            "web_url": "https://publications.artic.edu/renoir/reader/paintingsanddrawings",
            "section_ids": [
                36692321409,
                36692863204,
                36693134103,
                36693405003,
                36740827903,
                36741098979,
                36741370056,
                36742996539,
                36743267623,
                36743538708,
                36743809794,
                36744080881,
                36744351969,
                36744623058,
                36744894148,
                36745165239,
                36745436331,
                36745707424,
                36745978518,
                36746520709,
                36746791806,
                36747334003,
                36747605103,
                36747876204,
                36748147306,
                36907728448,
                36941697573,
                36942241206,
                36942513024,
                37653169963,
                37654267653,
                37718785023,
                37751751363,
                37793804331,
                37794629133
            ],
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.5"
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
            "timestamp": "2022-09-01T06:33:41-05:00"
        },
        {
            "_score": 1,
            "api_model": "publications",
            "api_link": "https://api.artic.edu/api/v1/publications/64",
            "id": 64,
            "title": "Whistler Paintings and Drawings at the Art Institute of Chicago",
            "timestamp": "2022-09-01T06:33:41-05:00"
        },
        {
            "_score": 1,
            "api_model": "publications",
            "api_link": "https://api.artic.edu/api/v1/publications/80",
            "id": 80,
            "title": "Ivan Albright Paintings at the Art Institute of Chicago",
            "timestamp": "2022-09-01T06:33:41-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.5"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "section_ids": [
            18,
            25,
            33,
            42,
            52,
            63,
            75,
            88,
            558,
            592,
            627,
            663,
            700,
            738,
            777,
            817,
            858,
            900,
            943,
            987,
            1032,
            1078,
            1125,
            1173,
            1222,
            1272,
            1323,
            1375,
            1428,
            1482,
            1537,
            1593,
            1650,
            1708,
            1767,
            1827,
            1888,
            1950,
            2013,
            2077,
            2142,
            2208,
            2275,
            2343,
            2412,
            2482,
            2553,
            2625,
            2698,
            2772,
            2847,
            2923,
            5992,
            6102,
            6213,
            6325,
            6438,
            6552,
            6667,
            6783,
            6900,
            7018,
            7137,
            7257,
            7378,
            7500,
            7623,
            7747,
            7872,
            7998,
            8125,
            8253,
            8382,
            8512,
            8643,
            8775,
            8908,
            9042,
            9177,
            9313,
            9450,
            9588,
            9727,
            9867,
            10008,
            10150,
            10293,
            10437,
            10582,
            10728,
            10875,
            11023,
            11172,
            11322,
            11473,
            11625,
            11778,
            11932,
            12087,
            12243,
            12400,
            12558,
            12717,
            12877,
            13038,
            13200,
            13363,
            13527,
            13692,
            13858,
            14025,
            14193,
            14362,
            14532,
            14703,
            14875,
            15048,
            15222,
            15397,
            15573,
            15750,
            16107,
            16287,
            16468,
            108342,
            128775,
            139125
        ],
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.5"
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
            "id": 128775,
            "api_model": "sections",
            "api_link": "https://api.artic.edu/api/v1/sections/128775",
            "title": "Bibliography",
            "web_url": "https://publications.artic.edu/americansilver/reader/collection/section/504",
            "accession": null,
            ...
        },
        {
            "id": 16468,
            "api_model": "sections",
            "api_link": "https://api.artic.edu/api/v1/sections/16468",
            "title": "Copyright Page",
            "web_url": "https://publications.artic.edu/americansilver/reader/collection/section/178",
            "accession": null,
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.5"
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
            "api_link": "https://api.artic.edu/api/v1/sections/108342",
            "id": 108342,
            "title": "Select Silver Objects in the Collection of the Art Institute of Chicago",
            "timestamp": "2022-09-01T06:33:45-05:00"
        },
        {
            "_score": 1,
            "api_model": "sections",
            "api_link": "https://api.artic.edu/api/v1/sections/11932",
            "id": 11932,
            "title": "Cat. 82 \u00a0Candelabra, 1920/21",
            "timestamp": "2022-09-01T06:33:50-05:00"
        },
        {
            "_score": 1,
            "api_model": "sections",
            "api_link": "https://api.artic.edu/api/v1/sections/12087",
            "id": 12087,
            "title": "Cat. 83 \u00a0Loving Cup, 1919",
            "timestamp": "2022-09-01T06:33:50-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.5"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "version": "1.5"
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
        "version": "1.5"
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
            "api_link": "https://api.artic.edu/api/v1/sites/40",
            "id": 40,
            "title": "Belligerent Encounters: Graphic Chronicles of War and Revolution, 1500\u20131945",
            "timestamp": "2022-09-01T06:33:21-05:00"
        },
        {
            "_score": 1,
            "api_model": "sites",
            "api_link": "https://api.artic.edu/api/v1/sites/41",
            "id": 41,
            "title": "Benin\u2014Kings and Rituals: Court Arts from Nigeria",
            "timestamp": "2022-09-01T06:33:21-05:00"
        },
        {
            "_score": 1,
            "api_model": "sites",
            "api_link": "https://api.artic.edu/api/v1/sites/42",
            "id": 42,
            "title": "Beyond Golden Clouds: Japanese Screens from the Art Institute of Chicago and the Saint Louis Art Museum",
            "timestamp": "2022-09-01T06:33:21-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.5"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "version": "1.5"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
    }
}
```
:::

### Website

#### Events

_The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for "fair use" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials._

##### `GET /events`

A list of all events sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](#events-2).

###### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

::: details Example request: https://api.artic.edu/api/v1/events?limit=2  
```js
{
    "pagination": {
        "total": 2266,
        "limit": 2,
        "offset": 0,
        "total_pages": 1133,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/events?page=2&limit=2"
    },
    "data": [
        {
            "id": 5519,
            "api_model": "events",
            "api_link": "https://api.artic.edu/api/v1/events/5519",
            "title": "Lecture: Sophie Calle: Because\u2014The Blind",
            "title_display": "Lecture: <i>Sophie Calle: Because\u2014The Blind</i>",
            "image_url": "https://artic-web.imgix.net/47026032-f502-479e-a7b0-fdf125575892/J8868_006-int-Web72ppi%2C2000px%2CsRGB%2CJPEG.jpg?rect=0%2C167%2C2000%2C1125&auto=format%2Ccompress&q=80&fit=crop&crop=faces%2Cedges%2Centropy&w=1200&h=675",
            ...
        },
        {
            "id": 5469,
            "api_model": "events",
            "api_link": "https://api.artic.edu/api/v1/events/5469",
            "title": "Artist Talk: Nancy Rubins",
            "title_display": null,
            "image_url": "https://artic-web.imgix.net/null12b5d906-8c5d-4261-b5e6-286742441381/Rubins.jpg?rect=0%2C2555%2C6132%2C3449&auto=format%2Ccompress&q=80&fit=crop&crop=faces%2Cedges%2Centropy&w=1200&h=675",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.5"
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
        "total": 2114,
        "limit": 10,
        "offset": 0,
        "total_pages": 212,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1.0695735,
            "api_model": "events",
            "api_link": "https://api.artic.edu/api/v1/events/5565",
            "id": 5565,
            "title": "Saturday Studio: Hockney and the Joy of Landscapes (Sept 17)",
            "timestamp": "2022-09-21T23:10:53-05:00"
        },
        {
            "_score": 1.0695735,
            "api_model": "events",
            "api_link": "https://api.artic.edu/api/v1/events/5559",
            "id": 5559,
            "title": "Virtual Rebroadcast: The Language of Beauty in African Art",
            "timestamp": "2022-09-21T23:10:53-05:00"
        },
        {
            "_score": 1.0695735,
            "api_model": "events",
            "api_link": "https://api.artic.edu/api/v1/events/5534",
            "id": 5534,
            "title": "Public Gallery Tour: The Art Institute (Thursday at 3:00)",
            "timestamp": "2022-09-21T23:11:06-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.5"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "image_url": "https://artic-web.imgix.net/22a002db-9695-452b-9c85-7a63644df4e0/G35154-int_press.jpg?rect=0%2C349%2C2334%2C1312&auto=format%2Ccompress&q=80&fit=crop&crop=faces%2Cedges%2Centropy&w=1200&h=675",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.5"
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
        "total": 380,
        "limit": 2,
        "offset": 0,
        "total_pages": 190,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/event-occurrences?page=2&limit=2"
    },
    "data": [
        {
            "id": "e84752a3-69ba-57d6-b0fc-8c0bd395f025",
            "api_model": "event-occurrences",
            "api_link": "https://api.artic.edu/api/v1/event-occurrences/e84752a3-69ba-57d6-b0fc-8c0bd395f025",
            "title": "Public Gallery Tour: The Art Institute (Friday)",
            "event_id": 5533,
            "short_description": "Looking for a good place to start your museum visit? Join a knowledgeable guide for a 45-minute tour of museum icons and lesser-known treasures.",
            ...
        },
        {
            "id": "e65115fe-a3c0-56ae-8e93-58ceae1e2964",
            "api_model": "event-occurrences",
            "api_link": "https://api.artic.edu/api/v1/event-occurrences/e65115fe-a3c0-56ae-8e93-58ceae1e2964",
            "title": "Public Gallery Tour: The Art Institute (Friday)",
            "event_id": 5533,
            "short_description": "Looking for a good place to start your museum visit? Join a knowledgeable guide for a 45-minute tour of museum icons and lesser-known treasures.",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.5"
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
        "total": 380,
        "limit": 10,
        "offset": 0,
        "total_pages": 38,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1.0026195,
            "api_model": "event-occurrences",
            "api_link": "https://api.artic.edu/api/v1/event-occurrences/575a97f4-c938-50e2-972f-56f49308c44a",
            "id": "575a97f4-c938-50e2-972f-56f49308c44a",
            "title": "Slow Looking: Language of Beauty (December 2)",
            "timestamp": "2022-09-21T23:19:51-05:00"
        },
        {
            "_score": 1.0026195,
            "api_model": "event-occurrences",
            "api_link": "https://api.artic.edu/api/v1/event-occurrences/ca89de08-7c44-55ad-b5eb-51ba0b5b7788",
            "id": "ca89de08-7c44-55ad-b5eb-51ba0b5b7788",
            "title": "Drop-In Sketching (November 3)",
            "timestamp": "2022-09-21T23:19:51-05:00"
        },
        {
            "_score": 1.0026195,
            "api_model": "event-occurrences",
            "api_link": "https://api.artic.edu/api/v1/event-occurrences/7fc708eb-eedc-53e5-a644-fc1f605026d0",
            "id": "7fc708eb-eedc-53e5-a644-fc1f605026d0",
            "title": "Lecture: Sophie Calle: Because\u2014The Blind",
            "timestamp": "2022-09-21T23:19:51-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.5"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
    }
}
```
:::

##### `GET /event-occurrences/{id}`

A single event-occurrence by the given identifier.

::: details Example request: https://api.artic.edu/api/v1/event-occurrences/00fb84d2-af24-572a-9f8b-0518a5f769f3  
```js
{
    "data": {
        "id": "00fb84d2-af24-572a-9f8b-0518a5f769f3",
        "api_model": "event-occurrences",
        "api_link": "https://api.artic.edu/api/v1/event-occurrences/00fb84d2-af24-572a-9f8b-0518a5f769f3",
        "title": "Saturday Studio: Bridget Riley (November 19)",
        "event_id": 5562,
        "short_description": "Saturday Studio is an art-making experience in the galleries that welcomes participants of all experience levels. Led by Chicago-based artists, the program is free with admission, and all needed materials are provided.",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.5"
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
        "total": 33,
        "limit": 2,
        "offset": 0,
        "total_pages": 17,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/event-programs?page=2&limit=2"
    },
    "data": [
        {
            "id": 12,
            "api_model": "event-programs",
            "api_link": "https://api.artic.edu/api/v1/event-programs/12",
            "title": "Verbal Description Tours",
            "is_affiliate_group": false,
            "is_event_host": false,
            ...
        },
        {
            "id": 11,
            "api_model": "event-programs",
            "api_link": "https://api.artic.edu/api/v1/event-programs/11",
            "title": "Lectures",
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
        "version": "1.5"
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
        "total": 33,
        "limit": 10,
        "offset": 0,
        "total_pages": 4,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "event-programs",
            "api_link": "https://api.artic.edu/api/v1/event-programs/84",
            "id": 84,
            "title": "Art + Science",
            "timestamp": "2022-09-21T23:20:59-05:00"
        },
        {
            "_score": 1,
            "api_model": "event-programs",
            "api_link": "https://api.artic.edu/api/v1/event-programs/83",
            "id": 83,
            "title": "Drop-In Sketching",
            "timestamp": "2022-09-21T23:20:59-05:00"
        },
        {
            "_score": 1,
            "api_model": "event-programs",
            "api_link": "https://api.artic.edu/api/v1/event-programs/82",
            "id": 82,
            "title": "The Art Exchange",
            "timestamp": "2022-09-21T23:20:59-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.5"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
    }
}
```
:::

##### `GET /event-programs/{id}`

A single event-program by the given identifier.

::: details Example request: https://api.artic.edu/api/v1/event-programs/3  
```js
{
    "data": {
        "id": 3,
        "api_model": "event-programs",
        "api_link": "https://api.artic.edu/api/v1/event-programs/3",
        "title": "Picture This",
        "is_affiliate_group": false,
        "is_event_host": false,
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.5"
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
        "total": 377,
        "limit": 2,
        "offset": 0,
        "total_pages": 189,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/articles?page=2&limit=2"
    },
    "data": [
        {
            "id": 705,
            "api_model": "articles",
            "api_link": "https://api.artic.edu/api/v1/articles/705",
            "title": "Hidden Materials in John Singer Sargent\u2019s Watercolors",
            "copy": " While John Singer Sargent is most widely known for his oil portraits of august men and women in fashionable interiors, he cultivated a love of painting outdoors from an early age. As a boy he recorded his family\u2019s European travels in sketchbooks, and as his talent and repertoire grew, he acquired numerous accoutrements such as portable easels, sketching umbrellas, rigid pads of paper, and compact palettes of watercolors that allowed him to paint multiple pictures during one outing, even in challenging conditions. In fact, Sargent was an official war artist for Britain during World War I and spent four months on the front painting and sketching.   A fellow war artist, Henry Tonks, painted this watercolor caricature of Sargent in 1918, depicting the artist clothed in army greens and shielded by a sketching umbrella that Sargent camouflaged for the purpose. The painting (held in the collection of the Museum of Fine Arts in Boston, and not a part of this exhibition) gives new meaning to challenging conditions\u2014and shows us a glimpse of Sargent\u2019s life apart from glamorous portraits.   In preparation for the current exhibition John Singer Sargent and Chicago\u2019s Gilded Age , Art Institute curators, conservators, and conservation scientists examined some of Sargent\u2019s paintings and investigated his less obvious materials, finding evidence that provides valuable insight into the artist\u2019s working process. A Newsworthy Surprise Sargent captured hundreds of landscapes in watercolor as he traveled across Europe and North America. In 1908 he painted Tarragona Terrace and Garden when he visited the eastern coast of Spain. Seated in the arcade of Tarragona\u2019s cathedral, Sargent made a quick study of its columns.   While he generally preferred to leave parts of the paper bare to delineate highlights, the foliage in the upper left corner of this picture was painted using a different technique. Here it appears that Sargent simply laid in a mass of greens and browns and then returned with an opaque, zinc white paint to create his highlights. In order to fully conceal the dark colors underneath, Sargent had to use thick dabs of white as if he were making a correction in oils. Sargent often made multiple paintings in one day and would interleave his paintings with sheets of newspaper for protection as he carried them. He did this with Tarragona Terrace and Garden , perhaps not realizing that the thickly applied areas of paint had not dried completely when he laid the newspaper on its surface. As an unintended consequence, fragments from a Spanish newspaper stuck to the painting, remnants of Sargent\u2019s panting process that survive today.   In normal light these tiny pieces of newsprint are barely noticeable, but they stand out in an infrared photograph, which makes some of the Spanish text almost legible.   Wax in a Watercolor Nearly 10 years after he painted Tarragona Terrace and Garden , Sargent made another series of stunning architectural studies while visiting his friends Charles and James Deering in Florida. Sargent was drawn to Vizcaya, the lavish estate that James had recently built, not least of all because it reminded him of the Italian landscapes and gardens that he loved to paint.   Analytical instruments in the conservation science lab at the Art Institute can help answer a lot of questions about artists\u2019 materials. In the case of this work, scientists sought more information about a soft, translucent material found in discrete areas on its surface. The material was analyzed and determined to be a wax, which Sargent used as a \u201cresist\u201d\u2014meaning that he marked the paper with a transparent material that would repel the water-based paint and leave highlights in the composition.   Analysis also revealed that the wax is a type called spermaceti, a product obtained from sperm whales and a major commercial product of the whaling industry. In Sargent\u2019s time this wax was commonly used to make candles. Finding it here helps to explain Sargent\u2019s process\u2014because spermaceti is softer than other common waxes such as beeswax, it would have been the logical choice for use as a drawing material. To learn more about Sargent\u2019s process and materials come visit John Singer Sargent and Chicago\u2019s Gilded Age in the Art Institute\u2019s Regenstein Hall through September 30, and check out the technical essay in the exhibition catalogue . \u2014Mary Broadway, associate conservator of prints and drawings ",
            "source_updated_at": "2018-08-08T16:04:54-05:00",
            ...
        },
        {
            "id": 696,
            "api_model": "articles",
            "api_link": "https://api.artic.edu/api/v1/articles/696",
            "title": "Encounter with Unusual Photo Paper",
            "copy": " Recently, a photograph by Kenneth Heilbron (American, 1903\u20131997), was brought to the photography conservation lab to be prepared for exhibition. Heilbron, a Chicago-based photographer who became the School of the Art Institute\u2019s first instructor of photography in 1939, was perhaps best known for his assignment work for Time , Fortune , and Life magazines. This 1940s image of two women standing along Michigan Avenue typifies the advertising work that Heilbron did for Chicago\u2019s Marshall Field\u2019s department store.   One of the most interesting and challenging aspects of photography conservation is to properly identify photographic processes, which differ not only in terms of the visual images they produce but in the materials used to create the print. Accurate knowledge of process is essential because it impacts the conservator\u2019s approach, as different materials sometimes require different treatments. Observing the print under the stereomicroscope, I discovered a very porous surface unlike that of any photographic paper I had seen before. With the help of the department\u2019s senior conservator, Sylvie Penichon, the paper was identified as Gevaluxe Velours, a photographic paper produced in Belgium between 1930 and 1950 by Gevaert Photo-Producten NV. Its unusual surface was created by dusting fibrous material on a sheet of paper coated with adhesive before it was sensitized. Under the microscope, the surface of the paper looks extremely fragile and soft, but it is actually quite rough to the touch\u2014a little like sandpaper. Unlike sandpaper, however, it will easily scratch if a hard object comes in contact with the surface. The damage can be superficial\u2014surface fibers may be disrupted and reflect light differently. Or the fiber can be completely removed, creating a loss that exposes the white underlying paper support. Once the structure and materials of the photographic paper were determined, I began conservation treatment based on two main criteria: long-term stability and visual appearance. First, the cardboard support on which the print is mounted was cleaned, and the delaminated and brittle edges were repaired with wheat starch paste\u2014a very stable, reversible, and long-lasting adhesive commonly used in conservation. Then, under the microscope and with the help of tweezers, I removed, one by one, every fiber and visible dust spec that was caught in the fibrous material.   The scratches were then inpainted using a very fine brush and watercolors. The first tests were done under the stereomicroscope, but once I understood how the surface was reacting to the application of paint, I completed the inpainting on an easel using magnifiers. The tone was then gradually built up with successive thin applications of color. This technique ensured that the inpainting blended in and would be virtually undetectable. The key with this technique is to know when to stop!   By cleaning the surface of the print and reducing the appearance of the scratches, the subject of the photograph\u2014as well as its unique surface\u2014can be fully appreciated.   This interesting print is currently on display in Gallery 10, where a selection of highlights of the Art Institute photography collection complements the exhibition Never a Lovely So Real: Photography and Film in Chicago, 1950\u20131980 . It marks the first time this photograph has been on view since it was acquired in 2000. Come and see it in person! \u2014Marie-Lou Beauchamp, Andrew W. Mellon Fellow in Photograph Conservation, Department of Photography ",
            "source_updated_at": "2018-08-13T14:03:37-05:00",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.5"
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
        "total": 377,
        "limit": 10,
        "offset": 0,
        "total_pages": 38,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "articles",
            "api_link": "https://api.artic.edu/api/v1/articles/953",
            "id": 953,
            "title": "May Morris: Designer and Advocate",
            "timestamp": "2022-09-21T23:02:25-05:00"
        },
        {
            "_score": 1,
            "api_model": "articles",
            "api_link": "https://api.artic.edu/api/v1/articles/962",
            "id": 962,
            "title": "Our Digital Best of 2021",
            "timestamp": "2022-09-21T23:02:25-05:00"
        },
        {
            "_score": 1,
            "api_model": "articles",
            "api_link": "https://api.artic.edu/api/v1/articles/955",
            "id": 955,
            "title": "Ruins and Rebirth",
            "timestamp": "2022-09-21T23:02:25-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.5"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "title": "Secrets of the Modern Wing",
        "copy": " I give a lot of tours of the Modern Wing, and there are details about the building that most visitors like but that aren\u2019t necessarily apparent to anyone going through the building on their own. So, here are some \u201csecrets\u201d of the Modern Wing. The building that now sits on Monroe Street is actually the third version of the expansion that the museum planned. We started thinking about expanding in 1999, before Millennium Park was built. So the original idea was to put the expansion on the south side of the building, over the railroad tracks. But once Millennium Park started to become more than parking lots, broken bottles, and train tracks, the architect Renzo Piano and museum leaders decided to completely reorient the building to face north. This move was made in 2001. To \u201ctalk\u201d to the park, and to test some proportional ideas for the fa\u00e7ade, Piano designed the two Exelon Pavilions across the street from the Modern Wing. You may know these pavilions as the entrances to the parking garages under the park. Same materials, same ideas as those for the Modern Wing. Modest structures, big architect.   A guiding principle for the Modern Wing is Piano\u2019s idea of \u201czero gravity\u201d\u2014that buildings should appear to levitate and lift. I had always heard about this idea, and I sense it when I\u2019m in the building, but it was never quite sure of how the details\u2014beyond lots of verticals\u2014worked. But the key to it in the Modern Wing is that everything is designed to not quite meet the floor. Every wall has a one-inch \u201creveal\u201d at the bottom of it. Piano designed all the benches, and they all sit slightly up off the floor on little pegs.   Every sculpture pedestal and platform also sit up off the floor. The main staircase also \u201cfloats,\u201d with an inch between what appears to be its base and the floor. Tiny detail, huge impact.   More to come! \u2014Erin Hogan ",
        "source_updated_at": "2018-08-24T16:52:37-05:00",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.5"
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
        "total": 26,
        "limit": 2,
        "offset": 0,
        "total_pages": 13,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/highlights?page=2&limit=2"
    },
    "data": [
        {
            "id": 37,
            "api_model": "highlights",
            "api_link": "https://api.artic.edu/api/v1/highlights/37",
            "title": "making-a-difference-a-tour-for-families",
            "copy": " In this tour of the collection, you\u2019ll find five works by artists or featuring subjects who are envisioning peace, imagining new futures, and creating safe and just spaces. Explore them together with your family and friends and enjoy the suggested activities together. Then think about what you can do to help others and make your mark in the world.   This highlights tour accompanies The Obama Portraits exhibition. All featured works are on view at the museum during the exhibition.   Shepard Fairey\u2019s Barack Obama \u201cHope\u201d Poster (2008) On view in Gallery 285   This iconic image of Barack Obama was designed as a poster for his 2008 presidential election campaign. How do Obama\u2019s pose and facial expression suggest the idea of hope? The artist who made this, Shepard Fairey, is a graphic designer. He transformed the original photo of Obama taken by photographer Mannie Garcia into a stenciled image using flat areas of red, white, and blue, the colors of the American flag. If you could make a poster of yourself or a friend in a style inspired by Shepard Fairey's \"Hope\" poster, what word would you use? How would you pose? Create your own free digital poster using your phone camera or computer at obamapostermaker.com .   Amanda Williams's Color(ed) Theory: Flamin' Red Hots (2014\u201315) On view in Gallery 285   This photograph by Amanda Williams comes from a project titled Color(ed) Theory that she created in the Englewood neighborhood of Chicago. The artist worked with community members to paint abandoned houses that were set to be demolished using colors associated with products marketed to the black community. The house in this photograph was painted bright red-orange, the color of a processed snack food. As the artist has noted, processed snacks are often the sort of food you can find most in food deserts, areas of the city where there are no grocery stores in which healthy food choices are available. After the buildings were demolished, Williams returned to the sites to discuss how the buildings\u2019 absence felt and what could take their place. Picture this site without the building. Describe what you imagine could be created here to make a positive change for this neighborhood. Share your thoughts with your family and friends.   Yoko Ono\u2019s Mended Petal (2016) On view in Pritzker Garden   Yoko Ono is an artist, musician, and peace activist, and many of her artworks are meant to bring awareness to the need for peace and healing in the world. This sculpture is the shape of a lotus petal, a flower that symbolizes hope and rebirth. Ono has said, \u201cI see the lotus as a universal symbol of peace and embodiment of all of our greatest hopes and aspirations.\u201d Look for the raised lines on this sculpture, the visible signs of mending called out in the title of this artwork. What do you think needs to be mended in the world today? How would you help to repair it? Use your body to copy the shape of this sculpture. Stand tall, raise your arms, and put your hands together. Feel the healing energy flow upward through your legs and body and then up your arms to the sky. You can find Skylanding , the companion piece to Mended Petal , in Jackson Park on the South Side of Chicago.   Elizabeth Catlett\u2019s Sharecropper (1952) On view in Gallery 263   Elizabeth Catlett\u2019s portrait is a powerful image of an everyday hero. Notice how we are looking up at her face, while she has her eyes set on the distant horizon. Her wide-brimmed hat shields her from the sun, and her simple jacket is fastened with a safety pin. Catlett said that she wanted to \u201cpresent black people in their beauty and dignity.\u201d What else do you think she wanted us to know about this woman? Catlett used printmaking, an inexpensive way to make and share large numbers of her activism-inspired images. This work is a linocut, a type of print made using linoleum, which Catlett chose because it was cheaper than other materials and because it produced distinct forms and lines. Look at all the shapes and textures that make up the woman and the background. See if you and your family members can describe all the different kinds of lines the artist used.   Bisa Butler\u2019s The Safety Patrol (2018) On view in Gallery 215   Bisa Butler creates works of art by layering and sewing together carefully chosen pieces of brightly colored and patterned fabric, her stitching both holding the pieces together and adding decorative designs. In this quilt, she depicted a group of children clustered closely together. Butler included many small details that tell us something about their identities and relationships to one another. Pose like the boy in the center of the artwork\u2014stand tall, look straight ahead, and raise your arms to your sides. How does that stance make you feel? What role does the boy play for this group of children? Look for clues in what he is wearing that emphasize his role in keeping others safe. Each person in your family can imagine they are one of the children in this artwork. What would that child be saying? Make up a story together that tells what is happening here. ",
            "source_updated_at": "2021-06-17T16:24:08-05:00",
            ...
        },
        {
            "id": 29,
            "api_model": "highlights",
            "api_link": "https://api.artic.edu/api/v1/highlights/29",
            "title": "contemporary-chicago-artists",
            "copy": " Explore all the works by Chicago artists in the museum's collection.   Dawoud Bey   Photographer Dawoud Bey has called Chicago home since 1998. While known for his color photography and striking portraits, for this project, Bey returned to black-and-white printing of his early years and turned his attention on an unpeopled landscape: homes and patches of land that are understood to have formed part of the Underground Railroad. For the title of the series, Night Coming Tenderly, Black , Bey was inspired by the closing couplet of a short poem \u201cDream Variations\u201d by Langston Hughes: \u201cNight coming tenderly / Black like me.\u201d   Gladys Nilsson   Among the most celebrated watercolorists working today, longtime Chicagoan Gladys Nilsson studied at the School of the Art Institute of Chicago (SAIC) and has taught at the school for over 25 years. As a member of the artist group known as the Hairy Who , Nilsson helped inject new and unique energy into the city's art landscape. Her mischievous scenes of figures interacting and engaging in various pursuits, including disguise and voyeurism, express her sense of humor and boundless curiosity. This watercolor, originally commissioned by SAIC to be used as an advertising poster, depicts playfully arranged crowds of students painting, listening to music, chatting, and hanging out in many different spaces.   Jeanne Gang   Internationally renowned for her Aqua Tower , Jeanne Gang has designed buildings across the world, and many in and around Chicago, including the Writers' Theatre, several residential buildings, two boat houses along the river, the Nature Boardwalk at Lincoln Park Zoo, and a community center in the Auburn-Gresham neighborhood. Gang designed this space to provide a welcoming, familiar space for Chinese immigrants arriving in Chicago. Finding subtle ways to incorporate traditional Chinese colors and signs within a modern, airy space, Gang organized the small structure to maximize the intergenerational connections common within the Chicago Chinese community.   Kerry James Marshall   For the last three decades, artist Kerry James Marshall has applied themes from art history to examine and recontextualize the representation of black culture. In his painting series Vignette Suite, Marshall used characteristics of the fanciful 18th-century French Rococo style and projected positive images of black life, centered around the notion of love. He focused his series on the air-borne embrace of a man and woman and surrounded them with various emblems of black affirmation, including a Black Power clenched fist, hands breaking through chains, the Black Liberation flag, African artifacts, and a panther. The result is both a multifaceted and evolving depiction of love and black identity as well as a powerful reinterpretation of a traditional art form.   Richard Hunt   One of the most important sculptors of our time, Richard Hunt was raised in Chicago and graduated from the School of the Art Institute of Chicago. Still in the city today, Hunt works out of a repurposed Chicago Railway Systems electrical substation built in 1909, creating both towering sculptures and more intimate constructions. His 2020 installation on the Art Institute\u2019s Bluhm Family Terrace features the title work, Scholar\u2019s Rock or Stone of Hope or Love of Bronze , a monumental bronze sculpture that Hunt created over six years through a durational process of adding, removing, and reshaping the work. Read more about this installation in a conversation between Hunt and curator Jordan Carter.   Anne Wilson   Anne Wilson , the Chicago-based artist and professor emeritus of Fiber and Material Studies at the School of the Art Institute of Chicago, defies easy categorization. Working with everyday materials such as table linens, bed sheets, human hair, lace, thread, glass, and wire, Wilson considers the inequities of factory labor, the impact of globalization, domestic and social rituals, and themes of time and loss. For her Dispersions series, Wilson created 26 works from fragments of heirloom damask tablecloths and napkins. Wilson opened up a damaged area in each piece of cloth into a perfect circle and embellished the edges with colored thread and hair. These are ambiguous material images, suggesting the trace from a gunshot or a celestial explosion and evoking the mortal and physical alongside the transcendent and unknowable. Wilson draws our attention to the contrasts between the machine-made cloth and the intricate hand stitching; creating tension between the artist's intervention and its foundation, and between the formal tone-on-tone design of the white cloth and the small bursts of color and texture dispersed around damaged cloth.   Amanda Williams   Currently based in the South Side neighborhood of Bridgeport, Amanda Williams was born and raised in the Chicagoland area. Her work blends her architectural training with traditional art approaches to confront issues of race, value, and urban space. For her most famous project, Color(ed) Theory , which debuted at the Chicago Architecture Biennial in 2015, Williams painted eight soon-to-be-demolished houses in Chicago's Englewood using a palette of colors found in products and services marketed primarily toward Black people, such as Flamin\u2019 Red Hots. Drawing attention to the underinvestment in African American communities around the city, the series asks: What color is poverty? What color is gentrification?   Pope.L   Known for his groundbreaking performances as well as for text-based drawings and paintings that disrupt the conventions of cultural identity and explode traditional artistic categories, artist Pope.L has lived in Chicago for over a decade and has been a professor at University of Chicago since 2010. The title of this work, Finnish Painting evokes a strangely specific yet enigmatic sense of national identity while also offering a play on words, the imperative to \u201cfinish painting.\u201d This work presents the barely legible text of a poem, the last word of which is \u201cdecode\u201d\u2014as if acknowledging that to see, read, and understand others is always a struggle, and that meaning is often fluid. Another text-based feature is the attribution at the lower right, \u201cR. Ryman,\u201d referring to Minimalist artist Robert Ryman , whose monochromatic white paintings were often layered color underpainting and who treated his signature as an important visual element within a painting\u2019s composition, never simply as authorization of a finished canvas. Perhaps this Pope.L work reveals what might lie beneath Ryman\u2019s white surfaces.   Stanley Tigerman   Architect, designer, and provocateur Stanley Tigerman \u2014a lifelong Chicagoan\u2014made it his mission to push the city's architecture beyond the then reigning style of the modernist glass box. His design for the Holocaust Museum and Education Center in Skokie integrates symbolic gestures of Judaism in various ways\u2014the site plan, materials, and formal language. This model for an early scheme shows how the museum is composed of two wings\u2014the darkened wing points six degrees toward the Western Wall in Jerusalem, and the lighter education center toward the rising sun. He suggested that the use of such symbolism serves an act of defiance to those who would eliminate a particular culture and its history.   Bethany Collins   Originally from Alabama, Bethany Collins currently lives in Chicago making work that explores the deep-rooted connections between race and language. In The Birmingham News, 1963 , Collins presents 18 embossed and distressed front pages from issues of the Birmingham News published during 1963, a seismic year for the civil rights movement. While most national media outlets were covering the area\u2019s sit-ins, demonstrations, and police brutality, the Birmingham News did not, supposedly to subdue racial tension. By embossing, darkening, and distressing these pages, Collins transforms them into a kind of memorial to events ignored by the Birmingham press and demonstrates how authored and institutional texts are always politicized.   Terry Evans   A Kansas City native, Terry Evans moved to Chicago in 1994 and has lived here since. After focusing on the Midwestern prairie for many years, Evans took to the skies and photographed the city from above for her Revealing Chicago project. From backyard pools to the city jail, the lakefront to industrial areas, Evans sought to show \"the diversity and complexity of Chicago.\" She lamented that she \"hadn't even come close. This is an incomplete portrait, a fraction of a second in the life of Chicago, and every picture contains more stories than the image reveals.\"   Judy Ledgerwood   A longtime Midwesterner and decades-long Chicagoan, Judy Ledgerwood paints monumental abstractions that explore both the perceptual effects and the politics of color, luminosity, pattern, and scale. After earning her MFA from the School of the Art Institute of Chicago in 1984, she turned to traditionally \u201cfeminine\u201d pastels and decorative forms in order to challenge the stereotypes of gendered approaches to painting. Ledgerwood borrowed this work\u2019s title, So What , from a 1959 \u201ccool period\u201d jazz composition by Miles Davis. Made during winter, the painting features pale colors evocative of the season and at first appears quiet and serene. Yet sustained looking reveals subtle modulations in the blue-green, yellow, and white circles, which seem to alternately recede and advance across the work\u2019s surface. ",
            "source_updated_at": "2021-03-24T16:22:26-05:00",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.5"
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
        "total": 26,
        "limit": 10,
        "offset": 0,
        "total_pages": 3,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "highlights",
            "api_link": "https://api.artic.edu/api/v1/highlights/4",
            "id": 4,
            "title": "new-on-view",
            "timestamp": "2022-09-21T23:25:12-05:00"
        },
        {
            "_score": 1,
            "api_model": "highlights",
            "api_link": "https://api.artic.edu/api/v1/highlights/49",
            "id": 49,
            "title": "a-aapi-artists",
            "timestamp": "2022-09-21T23:25:12-05:00"
        },
        {
            "_score": 1,
            "api_model": "highlights",
            "api_link": "https://api.artic.edu/api/v1/highlights/3",
            "id": 3,
            "title": "what-to-see-in-an-hour",
            "timestamp": "2022-09-21T23:25:12-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.5"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "copy": " Please note: artworks occasionally go off view for imaging, treatment, or loan to other institutions. Click on the images to ensure the work is currently on view.   One of the most famous American paintings of all time, this double portrait by Grant Wood debuted at the Art Institute in 1930, winning the artist a $300 prize and instant fame. Many people think the couple are a husband and wife, but Wood meant the couple to be a father and his daughter. (His sister and his dentist served as his models.) He intended this Depression-era canvas to be a positive statement about rural American values during a time of disillusionment. See American Gothic on view in Gallery 263.   For his largest and best-known painting, Georges Seurat depicted Parisians enjoying all sorts of leisurely activities\u2014strolling, lounging, sailing, and fishing\u2014in the park called La Grande Jatte in the River Seine. He used an innovative technique called Pointillism, inspired by optical and color theory, applying tiny dabs of different colored paint that viewers see as a single, and Seurat believed, more brilliant hue. See this work on view in Gallery 240.   Hero Construction , created in 1958, just a year after Chicago sculptor Richard Hunt graduated from the School of the Art Institute, is composed of found objects\u2014old pipes, bits of metal, and automobile parts\u2014that the artist discovered in junkyards and on the street. Inspired by mythology and heroic sculptures past and present, the welded figure suggests a hero for our times, humble yet resilient in the face of past, present, and future injustices and uncertainties. See Hero Construction on view on the Woman's Board Grand Staircase.   This iconic painting of an all-night diner in which three customers sit together and yet seem totally isolated from one another has become one of the best-known images of 20th-century art. Hopper said of the enigmatic work, \u201cUnconsciously, probably, I was painting the loneliness of a large city.\u201d See Nighthawks on view in Gallery 262.   Chicago-based artist Kerry James Marshall applies themes from art history to examine and recontextualize the representation of black culture. This work references nkisi nkondi , or power figures, of the Democratic Republic of Congo\u2014sculptures into which metals, mirrors, and nails were driven to channel their forces. Marshall affixed his sculpture with \u201cmedallions\u201d or \u201cicons,\u201d laminated images and texts that refer to figures within the black freedom movement in America as well as to Egyptian iconographies championed by African Americans in the 1970s as a way to challenge dominant Western worldviews. Marshall adds new elements each time the sculpture goes on view, treating it like a living and continually evolving work. See Africa Restored (Cheryl as Cleopatra) on view in Gallery 295.   Pablo Picasso\u2019s The Old Guitarist is a work from his Blue Period (1901\u201304). During this time the artist restricted himself to a cold, monochromatic blue palette and flattened forms, taking on the themes of misery and alienation inspired by such artists as Edvard Munch and Paul Gauguin. The elongated, angular figure also relates to Picasso\u2019s interest in Spanish art and, in particular, the great 16th-century artist El Greco . The image re\ufb02ects the 22-year-old Picasso\u2019s personal sympathy for the plight of the downtrodden; he knew what it was like to be poor, having been nearly penniless during all of 1902. See The Old Guitarist on view in Gallery 391.   Over his short five-year career, Vincent van Gogh painted 35 self-portraits\u201424 of them, including this early example, during his two-year stay in Paris with his brother Theo. Here, Van Gogh used densely dabbed brushwork, an approach influenced by Georges Seurat\u2019s revolutionary technique in A Sunday on La Grande Jatte\u20141884 (on view Gallery in 240), to create a dynamic portrayal of himself. The dazzling array of dots and dashes in brilliant greens, blues, reds, and oranges is anchored by his intense gaze. See Van Gogh's Self-Portrait on view in Gallery 241.   Caught in the heat of battle with sword raised and horse rearing, this mounted figure may match many notions of a knight in shining armor but actually represents a common hired soldier. The armors for both man and horse were produced in Nuremberg, Germany, in the 16th century, but the clothing was meticulously recreated in 2017 from period designs. Look for the special leggings: small plates of steel are sewn between two pieces of linen to protect the soldier's legs. You'll also spot some splashes of mud and grime from the battlefield. See Field Armor for Man and Horse on view in Gallery 239.   The densely painted and geometrically patterned Kuba mask is a ngady mwaash , an idealized representation of a woman that honors the role of women in Kuba life. Ngady mwaah most often appear as part of a trio of royal masks in reenactments of the Kuba Kingdom\u2019s origins, which are staged at public ceremonies, initiations, and funerals. In these masquerades, the ngady mwaash dances together with the mooshamb-wooy mask, which represents the king (who is both her brother and her husband), and the bwoom mask. Male mask characters like bwoom display aggression and heaviness while female characters like ngady mwaash dance in a sensuous and graceful manner even though the mask is always worn by a man. See this ngady mwaash on view in Gallery 137.   This 12th-century statue of the Buddha comes from the south Indian coastal town of Nagapattinam, where Buddhist monasteries flourished and attracted monks from distant lands. He is seated in a lotus posture of meditation, with hands and feet resting atop one another. The mark on his forehead is called the urna, which distinguishes the Buddha as a great being. See this work on view in Gallery 140.   Jacob Lawrence is best known for his Migration series: 60 panels that trace the journey of African Americans from the South to the North during the early 20th century. He also painted singular compositions like The Wedding . Here, a bride and groom along with their attendants stand before a minister. Positioning the figures with their backs to us, Lawrence invites viewers to participate in the couple\u2019s major life event.   Painted in the summer of 1965, when Georgia O'Keeffe was 77 years old, this monumental work culminates the artist\u2019s series based on her experiences as an airplane passenger during the 1950s. Spanning the entire 24-foot width of O\u2019Keeffe\u2019s garage, the work has not left the Art Institute since it came into the building\u2014because of its size and because of its status as an essential icon. See Sky above Clouds IV on view in Gallery 249.   More than 100 years ago, Agnes F. Northrop designed the monumental Hartwell Memorial Window for Tiffany Studios as a commission from Mary Hartwell in honor of her husband, Frederick Hartwell, for the Central Baptist Church of Providence, Rhode Island (now Community Church of Providence). Composed of 48 panels and numerous different glass types, the window is inspired by the view from Frederick Hartwell\u2019s family home near Mt. Chocorua in New Hampshire. The majestic scene captures the transitory beauty of nature\u2014the sun setting over a mountain, flowing water, and dappled light dancing through the trees\u2014in an intricate arrangement of vibrantly colored glass. See the Hartwell Memorial Window on view at the top of the Woman's Board Grand Staircase. ",
        "source_updated_at": "2022-07-15T16:38:48-05:00",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.5"
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
            "source_updated_at": null,
            ...
        },
        {
            "id": 10,
            "api_model": "static-pages",
            "api_link": "https://api.artic.edu/api/v1/static-pages/10",
            "title": "Press Release Archive",
            "web_url": "/press/archive",
            "source_updated_at": null,
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.5"
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
            "timestamp": "2022-09-22T15:25:09-05:00"
        },
        {
            "_score": 1,
            "api_model": "static-pages",
            "api_link": "https://api.artic.edu/api/v1/static-pages/2",
            "id": 2,
            "title": "Events",
            "timestamp": "2022-09-22T15:25:09-05:00"
        },
        {
            "_score": 1,
            "api_model": "static-pages",
            "api_link": "https://api.artic.edu/api/v1/static-pages/3",
            "id": 3,
            "title": "Exhibitions",
            "timestamp": "2022-09-22T15:25:09-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.5"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "source_updated_at": null,
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.5"
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
        "total": 217,
        "limit": 2,
        "offset": 0,
        "total_pages": 109,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/generic-pages?page=2&limit=2"
    },
    "data": [
        {
            "id": 219,
            "api_model": "generic-pages",
            "api_link": "https://api.artic.edu/api/v1/generic-pages/219",
            "title": "Researching Artworks and Artists",
            "web_url": "https://nocache.www.artic.edu/library/discover-our-collections/research-guides/researching-artworks-and-artists",
            "copy": " The Ryerson & Burnham Libraries collection contains a wide variety of resources that can be used to locate information on artists and their works. Our open shelf collection in the reading room contains reference sources, such as dictionaries, directories, encyclopedias, and indexes. We have strong collections of artist files, auction catalogs, books, exhibition catalogs, journals, and newspapers in the library collection, and the Ryerson and Burnham Archives collections also contain papers for individual artists and arts organizations, as well as a collection of artists' oral histories. This research guide provides recommendations for research sources and strategies to locate information on both prominent and obscure artists and their works. Prior to beginning your research, we recommend that you compile as much information about the artist or artwork of interest to you as possible. Do you know the artist's name, the artwork's title, the approximate dates the artist worked or the piece was created, or the geographic area where the artist lived or the object was created? If you are working on an artwork in your collection, have you examined it to see whether it contains any signatures or marks, labels, or annotations (you may wish to remove the frame to fully examine the object)? Recording this information and bringing an outline of keywords or research objectives as well as clear, closeup images of any signatures or markings to the library with you will provide you with a strong starting point for your research. ",
            ...
        },
        {
            "id": 15,
            "api_model": "generic-pages",
            "api_link": "https://api.artic.edu/api/v1/generic-pages/15",
            "title": "Research Guides",
            "web_url": "https://nocache.www.artic.edu/library/discover-our-collections/research-guides",
            "copy": " Learn how to research a work of art, uncover the history of a Chicago building, locate art market prices or a professional appraiser, or find information on works exhibited at the Paris salons, among other topics.   An overview of the library collections is available here , and information on visiting the Reading Room can be found here . ",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.5"
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
        "total": 217,
        "limit": 10,
        "offset": 0,
        "total_pages": 22,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "generic-pages",
            "api_link": "https://api.artic.edu/api/v1/generic-pages/43",
            "id": 43,
            "title": "Chicago Commercial, Residential, and Landscape Architecture, Pre-WWII",
            "timestamp": "2022-09-21T23:25:24-05:00"
        },
        {
            "_score": 1,
            "api_model": "generic-pages",
            "api_link": "https://api.artic.edu/api/v1/generic-pages/46",
            "id": 46,
            "title": "Individual Artist, Organization, or Subject Collections",
            "timestamp": "2022-09-21T23:25:24-05:00"
        },
        {
            "_score": 1,
            "api_model": "generic-pages",
            "api_link": "https://api.artic.edu/api/v1/generic-pages/42",
            "id": 42,
            "title": "Mies, IIT, and the Second Chicago School",
            "timestamp": "2022-09-21T23:25:24-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.5"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "web_url": "https://nocache.www.artic.edu/visit/free-admission-opportunities",
        "copy": " NO ADVANCE TICKET REQUIRED The following groups are invited to visit our galleries at no cost every day\u2014even when museum admission tickets are sold out. In order to receive your free admission benefits, simply show the corresponding identification at the admissions desk in either museum lobby. Free admission benefits are not single use\u2014you are welcome to use them any time you would like to visit. Kids under 14 Admission is always free for children under 14. These free tickets are available online as well as on-site at the admissions counters. Chicago Teens Museum admission is free for Chicago teens under the age of 18, thanks to the extraordinary generosity of Glenn and Claire Swogger and the Redbud Foundation. See more opportunities and resources for teens . Active-Duty Military As part of the Blue Star Museums program, active-duty service members receive free admission all year long. Plus, from Armed Forces Day through Labor Day, we also welcome service members and their households. Please bring your active-duty military ID to the admissions counter to receive this benefit. LINK and WIC Cardholders As part of Museums for All, LINK and WIC cardholders and anyone in their households receive free general admission to the museum and all ticketed special exhibitions. Simply present your card along with a valid photo ID. Illinois Educators Free admission is available to current Illinois educators, including pre-K\u201312 teachers, teaching artists working in schools, and homeschool parents. Educators can register online to receive a voucher for a complimentary ticket to the museum. This voucher must be presented\u2014as a printed document or on a smartphone\u2014with a valid educator ID at one of the museum\u2019s admission counters. Learn more about requesting complimentary educator admission. Kids Museum Passport Sponsored by the 15 Museums Work for Chicago institutions, this program allows individuals with a Chicago Public Library card to check out a pass for free general admission to the Art Institute. Please note the following parameters for use of the Kids Museum Passport: Each pass admits a maximum of four people for general admission\u2014at least one child under the age of 18 and a maximum of two adults. Ticketed exhibitions and activities are not included and must be purchased separately. University Partners Students of colleges and universities in the University Partner Program are entitled to free general and special exhibition admission by showing a valid student ID at the ticket counter. Check the full list of partnering colleges and universities . Corporate Partners Employees of certain companies in the Corporate Partner Program are entitled to free general and special exhibition admission by showing proof of employment at the ticket counter. Learn more about the Corporate Partner Program . Check the full list of Corporate Partner companies whose employees are entitled to free admission.   More Corporate Partner Opportunities   RESERVE ONLINE IN ADVANCE Illinois Residents Admission was free for Illinois residents on weekdays (Mondays, Thursdays, and Fridays) November 29\u2013December 17, 2021, and January 3\u2013March 17, 2022. Check back for the announcement of future dates. To receive free admission tickets, Illinois residents must reserve them online in advance . Resident status will be verified using the zip code associated with the billing address provided. If you're unable to reserve tickets in advance, please stop by the admissions desks for assistance. ",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.5"
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
        "total": 283,
        "limit": 2,
        "offset": 0,
        "total_pages": 142,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/press-releases?page=2&limit=2"
    },
    "data": [
        {
            "id": 5,
            "api_model": "press-releases",
            "api_link": "https://api.artic.edu/api/v1/press-releases/5",
            "title": "Press Releases from 1943",
            "web_url": "https://nocache.www.artic.edu/press/press-releases/5/press-releases-from-1943",
            "copy": " To obtain the full text of any news releases in this index, please contact the Archives at reference@artic.edu or (312) 443-4777.   January 4, 1943 Retrospective Exhibition of Paintings by Georgia O'Keeffe; comments by AIC Director Daniel C. Rich 93 (1942) January 6, 1943 Art in War Gallery: Camouflage for Civilian Defense, exhibition of panels and models produced by Carlos Dyer and prepared by The Museum of Modern Art, New York, in collaboration with Pratt Institute, Brooklyn, and US Army Engineers Board at Fort Belvoir, VA, 1 Free Midday Victory Concert, presented by Illinois Work Projects Administration, programs and schedule 92 January 7, 1943 This Week News Letter Current exhibitions, lectures, events, radio programs, and Goodman Theatre schedules 71 January 11, 1943 Winter Exhibitions: Paintings by Georgia O'Keefe, retrospective, installation conceived by the artist; Religious Folk Art of the Spanish Southwest, works lent by Taylor Museum in Colorado Springs, venue at The Museum of Modern Art in New York 2 January 23, 1943 Governing Members Annual Meeting, presided by AIC President Potter Palmer; report on war-time activities in the Museum by AIC Director of Fine Arts Daniel Catton Rich; financial report by AIC Director of Operations Charles H. Burkholder 3 January 30, 1943 Recent Accessions, exhibition, included Edouard Manet's Still Life with Carp , acquired for L. L. Coburn Collection, Winslow Homer's Croquet Scene and William Harnett's Just Dessert , both gifts of Friends of American Art, Luca Cambiaso's Venus and Cupid , purchased for Munger Collection through McKay Fund, Salvator Rosa's Crucifixion of Polycrates and Polycrates Receives the Fish , purchased from Wentworth Greene Field Museum Fund; recent accessions in Prints and Drawings Department, including works by Toulouse-Lautrec, Georges Rouault, Paul Gauguin, G. B. Tiepolo, Gericault, and Maillol, comments by Carl O. Schniewind 4 February 1, 1943 Gallery of Art Interpretation: Art by Refugee Children, exhibition, artwork for sale to aid war-time hostels for children 5 February 2, 1943 This Week News Letter Current exhibitions, lectures, events, radio programs, and Goodman Theatre calendar 72 February 8, 1943 [ The Education of Cupid by Titian], AIC acquisition, gift of Mrs. Charles H. Worcester, formerly in the Collections of the Earl of Wemyss, Scotland, and Baron von Thyssen in Lugano, Swirzerland; comments by AIC Director Daniel Catton Rich 6 February 13, 1943 47th Annual Exhibition by Artists of Chicago and Vicinity, jury comprised of Burton Cumming of Milwaukee Art Institute, Sidney Laufman of South Carolina, and Freeman Schoolcraft of Chicago; Black Cross by Georgia O'Keefe, AIC acquisition, purchased trough Special Picture Fund 7 February 15, 1943 3rd Annual Exhibition of the Society for Contemporary American Art, works on view and participants, including painting by Jean Helion 8 February 16, 1943 Free Museum admission on Washington's Birthday, related lecture, given by Dudley Crafts Watson 9 February 17, 1943 This Week News Letter Current exhibitions, lectures, events, radio programs, and Goodman Theatre calendar 73 February 18, 1943 Exhibitions in Prints and Drawings Gallery: Prints by Eugene Delacroix, comments by exhibition curator, Reference Assistant in the Department of Prints and Drawings Hugh Edwards; Photographs by Clarence John Laughlin of New Orleans; Introduction to the Department of Prints and Drawings, Permanent collection exhibition 10 February 25, 1943 Hubert Ropp, appointed Acting Dean of SAIC, replacing Norman L. Rice, both SAIC alumni, biography notes; Mr. Rice, commissioned Lieutenant in Naval Reserve 11 March 5, 1943 This Week News Letter Current exhibitions, lectures, events, radio programs, and Goodman Theatre calendar 74 March 11, 1943 47th Annual Exhibition by Artists of Chicago and Vicinity, list of prize-winners with biography notes, Sidney Loeb, Herrmann Dyer, Michael M. Ursulescu, Zsissly (Marvin Albright), Frances Foy, Kenneth Nack, John Goray, Max Kahn, Dorothy J. Bergamo, Charles Umlauf; the press release supplemented with A Letter From a Soldier Who Won a Prize by artist, Sgt. Sidney Loeb 12-14 March 15, 1943 Chester Dale Collection of Modern French Paintings, indefinite loan at AIC; notes on the collection; AIC European Galleries, rearranged under supervision of Mrs. Chester Dale; comments by AIC President Potter Palmer 15-17 March 16, 1943 Notes on special displays: Silk Screen Goes to War, exhibition of silk screen charts, produced under sponsorship of US Army and Navy, overview of installation in Prints and Drawings Gallery; Art in War: Paintings by James Sessions, exhibition of works by the artist in military service 18 March 22, 1943 Road to Victory: A Procession of Photographs of the Nation at War, exhibition, lent by The Museum of Modern Art in New York and directed by photographer assigned by US Navy, Lt. Comdr. Edward Steichen; caption by Carl Sandburg; overview of installation designed by Herbert Bayer; special opening reception, honoring representatives of patriotic and military organizations 19-20 March 26, 1943 The Discovery of Landscape, exhibition of 15th and 16th Century Prints, works on view with comparative photographs 21 March 5, 1943 This Week News Letter Current exhibitions, lectures, events, radio programs, and Goodman Theatre schedules 75 March 30, 1943 Gallery of Art Interpretation: Emotional Design in Modern Painting, exhibition of diagrams and color reproductions, lent by The Museum of Modern Art, New York, prepared in collaboration with Associate Director of Philips Memorial Gallery in Washington, D. C., Mr. C. Law Watkins 22 April 4, 1943 The Kenneth Goodman Memorial Theatre, fellowships and scholarships, offered for AIC School of Drama; notes on production 23 April 6, 1943 22nd International Exhibition of Water Colors, jury comprised of artists Ivan Albright, Edward Hopper, and curator of Whitney Museum of American Art Hermon More, biography notes 24 April 8, 1943 19th Century Chinese Paintings and Rubbings of the Ching Dynasty, both exhibitions made possible by Professor Harley Farnsworth MacNair, marking the gift of the collection to AIC Oriental Art Department, in memory of his wife Florence Ayccough MacNair; works on view 25 April 12, 1943 Julian Levi's Wellfleet Harbor , selected by AIC Committee on Painting and Sculpture as annual gift from Society for Contemporary American Art, comments and biography note; officers elected at the Society meeting 26 April 14, 1943 Prints and Drawing Gallery: Photographs by Walter Peterhans, exhibition of Illinois Institute of Technology (IIT) Faculty member and formerly director of Bauhaus Photography Department; Prints by Stanley Hayter, exhibition, comments by curator of Prints and Drawings Carl O. Schniewind 27 April 14, 1943 This Week News Letter Current exhibitions, lectures, and Goodman Theatre calendar 76 April 15, 1943 Art Through the Ages , publication by Head of SAIC Art History Department Helen Gardner; comments on preparing the third edition of the book and biography note 28 April 19, 1943 20th C. French Paintings, Chester Dale Collection, exhibition, opening reception; galleries redecorated under supervision of Mrs. Chester Dale and AIC Curator of Decorative Arts Department Meyric Rogers; catalogue and notes on the collection 29 April 21, 1943 Thorne Miniature American Rooms, photographs, issued by Three Dimension Corporation in kodachrome stereoscopic slides and presented by Drexel Furniture Company to AIC Lantern Slide Department, custodian Eleanore Collins; comments by Curator of Decorative Arts Department Meyric R. Rogers 30 May 5, 1943 Room of Chicago Art: Paintings by Malcolm Hackett and Michael Ursulescu, exhibition; biography notes 33 Gallery of Art Interpretation: The Art of Fresco Painting, exhibition, panels for demonstration of fresco technique prepared by Edgar Britton 34 May 10, 1943 This Week News Letter Current exhibitions, lectures, and Goodman Theatre schedules 77 May 12, 1943 22nd Annual Exhibition of Water Colors, prize-winners and honorable mentions, Adolf Dehn, Thomas Craig, Saul Levine, Dong Kingman, and James Lechay; annual, featuring one-man shows of William Gropper, John Marin, and Boardman Robinson; biography notes and comments 31-32 May 13, 1943 Chicago Children Paint for War, exhibition, organized by Chicago Public School Art Department, under direction of Elizabeth Wells Robertson 35 May 24, 1943 Free Museum admission on Memorial Day; current exhibitions 36 May 27, 1943 This Week News Letter Current exhibitions 78 June 2, 1943 AIC Scholarship Competition for high school students, list of award winners, announced by SAIC Acting Dean Hubert Ropp 37 June 3, 1943 SAIC Commencement Exercises, presided by AIC Vice-President Chauncey McCormick 38 June 7, 1943 Photographs Without Camera, exhibition of photograms and drawings by George Kepes, organized by Curator of Prints and Drawings Department Carl O. Schniewind 39 June 11, 1943 This Week News Letter Current exhibitions 79 June 14, 1943 Room of Chicago Art: Negro Artists of Chicago, exhibition, list of participants and works on view 40 June 29, 1943 Free Museum admission on Independence Day; current exhibitions 43 July 1, 1943 Art in War: The Army Paints Itself, exhibition by the Army Illustrators of Fort Custer; list of soldiers and officers invited to special press preview 41-42 July 1, 1943 This Week News Letter Current exhibitions 80 July 1, 1943 Goodman Theatre, winners of scholarships and fellowships, announced by Head of the Theatre, Dr. Maurice Gnesin; list with biography notes, Carl H. Fowler, Harold E. Wagenheim, Lloyd M. West, Lloyd Bennett, John A. Padovano, Nicolas J. Reichardt, and Michael H. Krause 44 Quilts and Quilting by Mrs. Bertha Stenge, exhibition, works on view and biography note 45 August 2, 1943 Room of Chicago Art: Paintings by David Bekker and Copeland C. Burg, exhibition; biography notes 46 August 9, 1943 This Week News Letter Current exhibitions 81 August 23, 1943 Annual Exhibition of SAIC Students, featuring paintings from alumni in armed forces; comments by SAIC Acting Dean Hubert Ropp, art in war therapy and rehabilitation 47 August 30, 1943 Free Museum admission on Labor Day; current exhibitions; Catalogue of Walter H. Schulze Gallery of American Art, AIC publication, made possible by Paul Schulze 48 September 1, 1943 This Week News Letter Current exhibitions 82 September 7, 1943 Goodman Theatre School of Drama, opening of third war-time season, activities and reports from alumni in armed forces 49 September 16, 1943 Paintings by Professor Chang Shu-Chi of Chungking, China, US tour exhibition, sponsored by the Chinese Government; Shu-Chi's scroll, titled The Hundred Doves , commissioned by Chinese Generalissimo Chiang Kai-Shek and presented to the US President Roosevelt; water color technique demonstration, given by the artist during AIC showing 50 September 20, 1943 Room of Chicago Art: Paintings by T. A. Hoyer and Julia Thecla; biography notes 51 September 22, 1943 This Week News Letter Current exhibitions 83 September 27, 1943 Prints by Edvard Munch and James Ensor, exhibition organized by curator of Prints and Drawings Department Carl O. Schniewind; lenders and works on view 52-53 October 6, 1943 Gallery of Recent Accessions: Inventions of the Monsters by Salvador Dali, purchased for AIC Joseph Winterbotham Collection, formerly belonging to James T. Soby; press release, included text of Dali's telegram to AIC, commenting on the painting 54 October 8, 1943 Art in War Gallery: Water Colors by Thornton Oakley; biography note 56 October 10, 1943 This Week News Letter Current exhibitions, lectures, film and Goodman Theatre calendar 84 October 11, 1943 54th Annual Exhibition of American Paintings and Sculpture, jury comprised of Bartlett H. Hayes, Jr., Henry Kreis, and Charles Sheeler; biography notes 56-58 October 26, 1943 This Week News Letter Current exhibitions, lectures, film and Goodman Theatre calendar 85 October 27, 1943 54th Annual Exhibition of American Paintings and Sculpture, prize-winners and honorable mentions, with biography notes, O. Louis Guglielmi, George Constant, Julian Levi, Ivan Albright, Boris Gilbertson, Francis Chapin, Edgar Ewing, Don Mundt, Mario C. Ubaldi, Everett Spruce, Marsden Hartley, Joseph Hirsch, and Edouard Chassaing; annual included one-man show of Edward Hopper 56-58 October 30, 1943 Chauncey McCormick, appointed Acting President of AIC, succeeding late Mr. Potter Palmer; Chicago architect John A. Holabird, elected AIC Trustee; biography note about Mr. McCormick and Mr. Holabird 59 November 2, 1943 Room of Chicago Art: Paintings by Max Kahn and Eleanor Coen, exhibition of works done in Mexico; biography notes 60 18th Century Staffordshire Figurines, exhibition from collections of Robert Dunham of Chicago, Frank Stoner and Charles Dunlap, both of New York, and from AIC Collection of Lucy Maud Buckingham 61 November 3, 1943 Antique Shawls From Persia and India, exhibition of 18th and 19th C. textiles, included examples of 19th C. European shawls, woven with machine looms in Paisley of Scotland, Lyon and Paris, adopting Oriental designs 62 November 4, 1943 This Week News Letter Current exhibitions, lectures, film and Goodman Theatre calendar 87 November 8, 1943 Chester Dale, elected Trustee of AIC Board, comments by AIC Vice-President Chauncey McCormick; note about Mr. and Mrs. Chester Dale, AIC Honorary Governing Life Members 63 December 1, 1943 Folk Woodcuts from Poland, exhibition of prints and paper cut-outs, lent by Polish Information Center, New York, Museum of the Polish Roman Catholic Union of America, Chicago, and Marya Werten of Los Angeles; opening reception, featuring Consul-General of Poland, Mr. Karol Ripa 64 December 3, 1943 Work by Convalescent Army and Navy Men from the Gardiner General Hospital, Chicago Beach and the US Naval Hospital at Great Lakes, exhibition; works on view; event arranged in association with Red Cross Project, chairman of AIC exhibition Committee, Mrs. Walter S. Brewster 65 December 4, 1943 Room of Chicago: Group Show of Fritzi Brod, Joshua Kaganove, Alice Mason, and Dan Palumbo; biography notes 66 December 7 and 13, 1943 This Week News Letter Current exhibitions, lectures, and Goodman Theatre calendar 88-89 December 13, 1943 Gallery of Art Interpretation: Island of Bali, Background to War, exhibition, lent by The Museum of Modern Art, New York, and featuring anthropologist study of Gregory Bateson, topics; installation designed by Xanti Schawinsky 67 December 18, 1943 Free Museum admission on Christmas and New Year's Day; list of current exhibitions 68 December 30, 1943 Speak Their Language, US tour exhibition of British and American cartoons, under auspices of American Federation of Arts, organized by The Metropolitan Museum in New York and English Speaking Union; works on view and participants 69 January 7,18, and 24, 1944 This Week News Letter Current exhibitions, lectures, film and Goodman Theatre calendar 91-94 January [10], 1944 Art in War: Paintings of America at War Commissioned for LIFE magazine, US tour exhibition of works by Henry Billings, Aaron Bohrod, Floyd Davis, Peter Hurd, Edward Laning, Tom Lea, Fletcher Martin, Barse Miller, and Paul Sample, works on view 70 ",
            ...
        },
        {
            "id": 4,
            "api_model": "press-releases",
            "api_link": "https://api.artic.edu/api/v1/press-releases/4",
            "title": "Press Releases from 1942",
            "web_url": "https://nocache.www.artic.edu/press/press-releases/4/press-releases-from-1942",
            "copy": " To obtain the full text of any news releases in this index, please contact the Archives at reference@artic.edu or (312) 443-4777.   January 5, 1942 2nd Annual Exhibition of Society for Contemporary American Art, opening, honoring artists of Chicago region, Julio de Diego, Francis Chapin, Laszlo Moholy-Nagy, Malcolm Hackett, Raymond Breinin; related lecture series, given by Dr. Oskar Hagen of University of Wisconsin 2 January 11, 1942 This Week News Letter Lectures and events, programs and schedules 94 January 12, 1942 Attendance record for the year 1941; awards of merit, given to AIC by editor of the New York Art News Alfred M. Frankfurter for Art of Goya Exhibition and for selecting Max Weber's Winter Twilight as prize-winning painting at 52nd Annual Exhibition of American Paintings and Sculpture 1 January 17, 1942 Works by Henri Rousseau, loan exhibition, catalogue by AIC Director and curator of Paintings Daniel Catton Rich 3-5, 10 January 19, 1942 Notes on Winter Exhibitions: Works by Henri Rousseau, show organized in collaboration with The Museum of Modern Art in New York, list of works, lent by Chicago collectors; Paintings by Karl Knaths, one-man show of SAIC alumnus in the classes of Wade, Norton, and Walcott, biography note and catalogue by Dudley Crafts Watson, Duncan Phillips, and E. M. Benson; Exhibition of Architecture by the American Institute of Architects (AIA), list of architects exhibited, including models by Mies Van der Rohe and the School of Design; Contemporary Ceramics of Western Hemisphere, selected from 10th National Ceramics Exhibition, held in Syracuse Museum of Art, NY, and sponsored by International Business Machines Corporation (IBM) 5-6 January 23, 1942 Governing Members Annual Meeting; re-election of Mr. Potter Palmer and Mr. Robert Allerton as AIC Trustees for seven-year term; reports on departments, collection development, Museum membership, important gifts and endowments, and budget for roof replacement in Allerton Building; Museum goals and urgent needs, addressed by AIC Director Daniel Catton Rich 7-8 January 25, 1942 This Week News Letter Lectures and events, programs and schedules 95 January 28, 1942 37 American Rooms in Miniature by Mrs. James Ward Thorn, exhibition closing prior to four-year US tour with first venue in Boston; miniature rooms in tree series, gift to AIC 9, 97 January 30, 1942 Work by Henri Rousseau, exhibition seminar, featuring author and collector Sidney Janis of New York, artist and Rousseau's friend Max Weber, and lecturer of New York University James Johnson Sweeney; screening of film, titled Hobbies across the Sea and performances, based on Rousseau's theatre plays 3-5,10 Gallery of Art Interpretation, Pre-Columbian Designs by the Chorotegan Indians of Nicaragua (630-1400 AD), copied from pottery by artist and archaeologist Dr. David Sequeira 11 February 2, 1942 Recent Accessions Room, showing works by Claude Gellee, Emanuel de Witte, Juan Pantoja de la Cruz, Corrado Giaquinto, Tang Yin, artist of the Riza-i-Abbasi School, Marc Chagall, Frans Masereel, David Jones, George Luks, Tom Dietrich, and Charles Burchfield; comments; donors 12 February 8, 1942 This Week News Letter Lectures and events, programs and schedules 96 February 10, 1942 46th Annual Exhibition by Artists of Chicago and Vicinity, jury comprised of Alfeo Faggi, Ernest Fiene, and Peppino Mangravite, with biography notes 14, 21-23, 33 February 12, 1942 Red Cross Benefit, Defense Show and Auction, sponsored by Art Students League, works donated by SAIC students, Chicago artists and SAIC instructors, including Francis Chapin, Boris Anisfeld, Louis Ritman, Glen Krause, Edgar Ewing, Ralph Johnstone, Kenneth Shoppen, Rufus Bastian, Laura van Pappelendam, Allen Philbrick, Kveta Miskovsky, Briggs Dyer, and Hermann Dyer; auction conducted by Dudley Crafts Watson; comments by SAIC Dean Norman Lewis Rice 15 February 16, 1942 Free Museum admission on Washington's Birthday; comments on Winter Exhibitions 16 February 18, 1942 The Pier on Sunday by James Lechay, painting selected as yearly gift to AIC by Society for Contemporary American Art, committee comprised of Charles Worcester, Chauncey McCormick, Percy Eckhart, John A. Holabird, Frederick Bartlett, and Max Epstein; painting exhibited at the 2nd Annual exhibition of the Society and previously awarded at 52nd Annual Exhibition of American Paintings and Sculpture; biography note about Mr. Lechay 13 February 20, 1942 Works of Grant Wood, retrospective, announced by AIC Director Daniel Catton Rich in view of the artist's death; exhibition to be arranged as special feature of The 53rd Annual Exhibition of American Painting and Sculpture 18 February 21, 1942 Midday Victory Concert Series, given by Symphonic Ensemble of Illinois Art Project, WPA, under direction of Izler Solomon, to aid civilian morale during war emergency 17, 19-20; schedules of programs 117-145 February 22 & 26, 1942 Rediscovering America, documentary film series, sponsored by AIC and arranged by Philadelphia Museum of Art and American Film Center, schedule 17, 19-20 February 22, 1942 This Week News Letter Lectures and events, programs and schedules 97 March 3, 1942 46th Annual Exhibition by Artists of Chicago and Vicinity, prize-winners, with biography notes, Abbot Pattison, Salcia Bahnc, Oscar van Young, Copeland C. Burg, Eugene A. Montgomery, Laura van Pappelendam, Raymond Breinin, Felix Ruvolo, Hedvig Kuhne, and Maurice Ritman; comments by exhibition jurors Ernest Fiene, Alfeo Faggi, and Peppino Mangravite 14, 21-23, 33 March 8, 1942 This Week News Letter Lectures and events, programs and schedules 98 March 12, 1942 Francis Chapin, Adolph Dehn, and Boardman Robinson, exhibition of lithographs, water colors, and drawings, curated by Carl O. Schniewind of Prints and Drawings Department, works on view and biography notes 24 March 19, 1942 Chicago Symphony Orchestra, announcing competition among SAIC students for best drawing of the Orchestra; comments by SAIC Dean Norman Lewis Rice 25 March 21, 1942 WGN radio Series Great Artists. Paul Gauguin - The Man Who Makes Human Beings , third year broadcasting, sponsored by AIC and performed by actors of Goodman Theatre of Drama 26 March 22, 1942 This Week News Letter Lectures and events, programs and schedules 99 March 26, 1942 Portraits of Whistler, Walter S. Brewster Collection of Whistleriana, exhibition of prints, drawings and photographs, made by the artist's associates and rare editions of books and catalogues; prepared by volunteer in Print Department Mrs. Bergen Evans 27 April 4, 1942 Art in War: American Artists' Record of War and Defense, exhibition from National Gallery of Art in Washington, D.C., showing works, commissioned by the Government, and purchased by Office for Emergency Management from competition, conducted by Section of Fine Arts, Public Building Administration, F.W.A.; works on view, participants, Theodore Katz, Herman Maril, Alexander Masley, Anton Refregier, Arthur Kerrick, Ernest Halberstadt, Leonard Pytlak, J. T. Robinson, Paul E. Fontaine, Carl Morris, Ray Bethers, A. S. MacCleod, and Robert O. Bach 28 April 5, 1942 This Week News Letter Lectures and events, programs and schedules 100 April 7, 1942 Latin-American Art in Celebration of Pan-American Week, exhibition in Recent Accessions Gallery, works on view by Jose Clemente Orozco, Diego Rivera, Rufino Tamayo, Leopoldo Mendez, Jean Charlot, David Alfaro Siqueiros, Mexican prints from Weyhe Gallery in New York, and various textiles and decorative objects, lent by Mrs. Marguerite Pearce 29 April 9, 1942 21st International Exhibition of Water Colors, jury of selection William Gropper of New York, Malcolm Hackett of Chicago, and Frederic Taubes of Urbana, IL, with biography notes; list of prizes; exhibition included one-man shows of Georges Rouault, Francis Chapin, and Cameron Booth 30, 35-38 April 13, 1942 Map Making for Military and Civilian Use, cartography course under instruction of architect and industrial designer, George Mendenhall, SAIC alumnus; course, introduced in SAIC by Dean Norman Lewis Rice 31 April 18, 1942 SAIC: 7th Annual Exhibition of Student Janitors, participants; notes on artists previously exhibited at SAIC Janitor's shows 32 April 19, 1942 This Week News Letter Lectures and events, programs and schedules 101 April 25, 1942 Auction for Navy Relief Society, list of contributing artists from Illinois Art Project, WPA, including Chicago artists, Nocola Ziroli, Julio de Diego, Felix Ruvolo, Raymond Breinin, Ethel Spears, Edgar Britton, Joseph Vavak, Misch Kohn, Adrian Troy, David Bekker, Morris Topchevsky, William S. Schwartz, Harry Mintz, Bernece Berkman, Anne Michalov, Hester Miller Murray, John Walley, and others; comments by AIC Director Daniel Catton Rich 34 April 26, 1942 46th Annual Exhibition by Artists of Chicago and Vicinity, works sold and prizes awarded; comments on exhibition in the New York Art News by artist and SAIC teacher Peppino Mangravitte 14, 21-23, 33 May 3, 1942 This Week News Letter Lectures and events, programs and schedules 10 May 11, 1942 21st Annual International Exhibition of Water Colors, reception; comments by jury of selection 30, 35-38 May 12, 1942 Society for Contemporary American Art, exhibition of Nicola Ziroli, Copeland C. Burg, and Julio de Diego; preview for members 39 May 13, 1942 21st Annual International Exhibition of Water Colors, list of prize-winners and honorable mentions, with biography notes, Raymond Breinin, Hardie Gramatky, Briggs Dyer, Laura Glenn Douglas, Alexander Masley, and David Bekker; comments by members of jury of selection, William Gropper, Frederic Taubes, and Malcolm Hackett; one-man shows of Georges Rouault, Francis Chapin, and Cameron Booth, and display of Mexican prints and drawings, including works by Jose Clemente Orozco, Guillermo Meza, Federico Cantu, Jesus Galvan, Maria Izquierdo, Izidoro Ocampo, Carlos Orozco Romero, Juan Soriano, Rufino Tamayo, Raul Uribe, and Alfredo Zalce 30, 35-38 May 16, 1942 Sale of hand-blocked textiles and pottery for Red Cross, produced by SAIC students under supervision of SAIC Sellers Professor of Decorative Arts Margaret Artingstall; list of artists and SAIC Faculty members contributing to the cause 40 May 17, 1942 This Week News Letter Lectures and events, programs and schedules 103 May 19, 1942 Free AIC events offered to service men, schedule 41 May 22 1942 SAIC Travelling Fellowships awards, announced by AIC President Potter Palmer; list with biography notes, Frederick Heidel, Richard Bowman, Rufino Silva, Winfield Stampfer, and Rudolph Pen 43 May 23, 1942 Public School Art Society affiliated with AIC Department of Education, announcement by President of the Society Mrs. Walter S. Brewster, listing of officers and organizations 42 May 25, 1942 Photographs of the Civil War and the American Frontier, exhibition from The Museum of Modern Art in New York, AIC showing, coordinated by curator of Prints and Drawings Department Carl O. Schniewind; works on view 44 May 27, 1942 Free Museum admission on Memorial Day; current exhibitions and events 45 May 31, 1942 This Week News Letter Lectures and events, programs and schedules 104 June 4, 1942 Gallery of Art Interpretation: 3733 High School Students Look at Paintings, exhibition and survey, final event of three-year program under grant from General Education Board, directed by AIC; display, arranged by AIC curator Helen Mackenzie and Head of Education Department Helen Parker, assisted by Laurance Longley and Florence Arquin 46 June 9, 1942 SAIC Commencement Exercises, addressed by Dean Norman Lewis Rice, Head of Goodman School of Drama Maurice Gnesin, AIC President Potter Palmer, and AIC Vice-President Chauncey McCormick; Traveling Fellowship winners, Frederick Heidel, Richard Bowman, Rufino Silva, Winfield Stampfer, and Rudolph Pen; Glee Club performance under direction of Charles Fabens Kelley, followed by Invocation by Dr. James Madison Stifler, D. D., 47 June 13, 1942 The Room of Chicago Art, opening of special AIC gallery, representing local artists; inaugurating reception and memorial exhibition of works by Leon Garland, biography note 48 June 14, 1942 This Week News Letter Lectures and events, programs and schedules 105 June 28, 1942 This Week News Letter Lectures and events, programs and schedules 106 July 12, 1942 This Week News Letter Lectures and events, programs and schedules 107 July 14, 1942 21st International Exhibition of Water Colors, list of artists, with distribution of art works sold at the show 49 July 15, 1942 Room of Chicago Art: Paintings by Herrmann and Briggs Dyer, exhibition; biography notes 50 July 24, 1942 A Tour through London and Paris, exhibition of prints from 17th C. to 20th C., curated by Carl O. Schniewind of Prints and Drawings Department; works on view 51 July 23, 1942 The Office of Civilian Defense (OCD) Poster Contest, announced by Chairman of the Committee for Artists in Civilian Defense of the Chicago Metropolitan Area and AIC Director Daniel Catton Rich; list of works awarded by Purchasing Committee, and presented by Chicago Mayor Kelly 52 August 3, 1942 Verre de Nevers from 18th-19th C., Mrs. Potter Palmer Collection of glass figurines, exhibition and gift presented to AIC through Antiquarian Society; comments by Curator of Decorative Arts Department Meyric R. Rogers 53 August 11, 1942 Room of Chicago Art: Charles W. Dahlgreen and Joseph Gualtieri, two one-man shows of SAIC alumni, works on view and biography notes 56 August 15, 1942 AIC fact-sheet, and information for Museum visitors in case of air raids, provided by AIC and Office of Civil Defense (OCD) 54 August 16, 1942 This Week News Letter Lectures and events, programs and schedules 108 August 17, 1942 21st International Exhibition of Water Colors; list of works sold; current Fall exhibitions 55 August 17, 1942 21st International Exhibition of Water Colors; list of works sold; current Fall exhibitions 55 August 30, 1942 This Week News Letter Lectures and events, programs and schedules 109 September 2, 1942 SAIC Annual Exhibition, reflecting war effort; and showing works of 1941 SAIC Fellowship winners Eleanor Coen, Charles Buckley, and James Deegan 57 September 7, 1942 Free Museum admission on Labor Day; notes on Fall exhibitions 58 September 9, 1942 53rd Annual Exhibition of American Paintings and Sculpture: Memorial Exhibition of Grant Wood, first retrospective; works on view and lenders 59 September 11, 1942 Room of Chicago Art: Paintings by Raymond Breinin and Joseph Vavak, exhibition; works on view and biography notes 60 September 12, 1942 Gallery of Art Interpretation: Children in England Paint, exhibition of water colors made by school children and documentary photographs of children in war-time England 61 September 13, 1942 This Week News Letter Lectures and events, programs and schedules 110 September 14, 1942 Art in War, exhibition series and gallery opening, announced by AIC Trustees; inaugurating exhibition of works by Barse Miller, lent by LIFE magazine, biography note 63 Pledge of Allegiance to the Flag of the United States by 48 States, Constitution Day Ceremonies held in front of the Washington Statue at AIC main entrance, star sewing ceremony representing State of Illinois, performed by Mrs. Alonzo Newton Benn of National Society of the Daughters of American Revolution (DAR); nation-wide US flag event; Chicago celebrating Constitution Day, proclaimed by Governor Green 66-67 September 16, 1942 Chicago's Constitution Day Program, AIC President Potter Palmer, representing Museum at the U. S. flag ceremony, other organizations and officials 66-67 September 18, 1942 Rediscovering America , free film series, narrated by Katharine Hepburn, Orson Welles, Eleanor Roosevelt, Carl Sandburg, and Frederick March 64 September 21, 1942 Drawings and Illustrations by Susanne Suba, introducing exhibition series of graphic arts in book and magazine illustration, curated by Carl O. Schniewind of Prints and Drawings Department; biography note on the artist 65 September 25, 1942 Between Heaven and Earth, exhibition from Permanent collection, featuring Dutch prints from Clarence Buckingham Collection and prepared by Dr. Hedi Nyhoff, overview of the display in Buckingham Gallery; comments by curator of Prints and Drawings Department Carl O. Schniewind 62 September 27, 1942 This Week News Letter Lectures and events, programs and schedules 111 September 29, 1942 53rd Annual Exhibition of American Paintings and Sculpture, prizes awarded by jury, comprised of Jerry Farnsworth of Urbana, IL, Franklin Watkins of Philadelphia, Acting Director of Carnegie Institute John O'Connor, Jose de Creeft and Oronzio Maldarelli, both of New York, with biography notes 68 October 3, 1942 Room of Chicago Art: Paintings by Felix Ruvolo and Nicola Ziroli, exhibition; works on view and biography notes 69 October 7, 1942 Free Midday Victory Concerts, attendance; schedule of programs 70, 117-145 October 9, 1942 Schedules for Midday Victory Concerts, Gallery Tours, Adventures in the Arts, Gallery Hour for Children, and Rediscovering America Film Program 71 October 11, 1942 This Week News Letter Lectures and events, programs and schedules 112 October 15, 1942 Woodcuts by Max Weber, exhibition of monotypes, executed on honeycomb frames; biography note 72 October 20, 1942 53rd Annual Exhibition of American Painting and Sculpture: Memorial Exhibition of Works by Grant Wood, opening; guest list, including Wood's friends, David Turner and John Steuart Curry 73-77 October 21, 1942 53rd Annual Exhibition of American Painting and Sculpture: Memorial Exhibition of Works by Grant Wood, opening 74-77 53rd Annual Exhibition of American Paintings and Sculpture, prize-winners Edward Hopper, Alfeo Faggi, Peppino Mangravite, Raymond Breinin, Julian Levi, Thelma Slobe, David Bekker, Sidney Laufman, and honorable mentions Charles M. West, Jr., Virginia Cuthbert, Lillian Landis, and Joseph Hirsch, with biography notes; works on view 75-77 October 25, 1942 This Week News Letter Lectures and events, programs and schedules 113 October 29, 1942 Miniature Rooms by Mrs. James Ward Thorne, free lecture and showing of three-dimensional color slides, program sponsored by Artcraft Educational Foundation and conducted by AIC Curator of Decorative Arts Department Meyric R. Rogers 78 November 3, 1942 Room of Chicago Art: Salcia Bahnc and Julio de Diego, exhibition; biography notes 81 November 5, 1942 Great Dutch Masters, exhibition from Dutch national collections, transferred to the U.S.A. for safe-keeping, held under the patronage of Mrs. Franklin D. Roosevelt and Princess Juliana of The Netherlands; proceeds from sales of exhibition catalogue, designated for Queen Wilhelmina Fund and American Women's Voluntary Services providing anti-nazis resistance; comments on Nazi regime by Netherlands Ambassador, Dr. Alexander Loudon 79-80, 82-85 November 7, 1942 This Week News Letter Lectures and events, programs and schedules 114 November 11, 1942 Great Dutch Masters, exhibition included Jan Steen's A Domestic Scene , loaned to AIC by King George VI of England from the Royal Collection, Windsor Castle; remarks by AIC Director Daniel Catton Rich 82 Great Dutch Masters, exhibition, opening address by the Netherlands Ambassador to the U.S., Dr. Alexander Loudon, Dutch and Chicago officials; broadcast by WBBM radio station; general information and catalogue 83 November 12, 1942 Great Dutch Masters, exhibition, general information, related lectures, gallery tours, and complemnting displays The Background of Dutch Painting in the Gallery of Art Interpretation and Dutch Prints: Rembrandt and His Predecessors in Print and Drawing Gallery 84 November 27, 1942 Dutch Prints: Rembrandt and His Predecessors, exhibition from Permanent collection in association with Great Dutch Masters Show, works on view 85 November 28, 1942 Room of Recent Accessions, gifts of Colonel Robert R. McCormick, and from Amy McCormick Memorial Collection: Cezanne's Bathers ; Picasso's Woman with Cats ; Degas' pastel, titled Dancers ; Modigliani's two water colors, titled Caryatid ; Dufy's Vence and Nice ; Derain's Head of a Woman ; Utrillo's Street Scene ; remarks by AIC Director Daniel Catton Rich 87-88 December 1, 1942 Abstractions by Charles Smith, exhibition in Department of Prints and Drawings; note on the artist's technique 86 December 2, 1942 This Week News Letter Lectures and events, programs and schedules 115 December 7, 1942 Room of Chicago Art: Studies for the St. Louis Post Office Murals Executed by Edward Millman and Mitchell Siporin, exhibition, biography notes, SAIC alumni 90 December 9, 1942 Art in War Gallery: Water Colors of the Navy by Vernon Howe Bailey, special exhibition, marking anniversary of Pearl Harbor 89 December 16, 1942 Annual Christmas Festival of Hull House at Goodman Theatre, announcement by President of the Public School Art Society Mrs. Walter S. Brewster; in support of programs in AIC Education Department; list of officials 91 December 17, 1942 This Week News Letter Lectures and events, programs and schedules 116 December 28, 1942 Mural Paintings from the Cave Temples of India in Replica by Sarkis Katchadourian, exhibition; works on view, and biography note 92 January 4, 1943 Retrospective Exhibition of Paintings by Georgia O'Keeffe; comments by AIC Director Daniel C. Rich 93 ",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.5"
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
        "total": 283,
        "limit": 10,
        "offset": 0,
        "total_pages": 29,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "press-releases",
            "api_link": "https://api.artic.edu/api/v1/press-releases/280",
            "id": 280,
            "title": "Pure Drawing: Seven Centuries of Art from the Gray Collection",
            "timestamp": "2022-09-21T23:26:05-05:00"
        },
        {
            "_score": 1,
            "api_model": "press-releases",
            "api_link": "https://api.artic.edu/api/v1/press-releases/279",
            "id": 279,
            "title": "Rubens, Rembrandt, and Drawing in the Golden Age",
            "timestamp": "2022-09-21T23:26:05-05:00"
        },
        {
            "_score": 1,
            "api_model": "press-releases",
            "api_link": "https://api.artic.edu/api/v1/press-releases/278",
            "id": 278,
            "title": "Photography + Folk Art: Looking for America in the 1930s",
            "timestamp": "2022-09-21T23:26:05-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.5"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "web_url": "https://nocache.www.artic.edu/press/press-releases/1/press-releases-from-1939",
        "copy": " To obtain the full text of any news releases in this index, please contact the Archives at reference@artic.edu or (312) 443-4777.   January 6, 1939 Scammon Lecture, The Spirit of Modern Building , given by Dr. Walter Curt Behrendt, Technical Director of Buffalo City Planing Association, N.Y., 1 January 7, 1939 Turkish and Italian Textiles in Paintings , lecture, given by Alan J. B. Wace, Keeper of Textiles in the Victoria and Albert Museum and professor of Classical Archaeology, Cambridge, England; members of Chicago Needlework and Textile Guild, listed 2 January 20, 1939 Lecture series, given by Dr. Maurice Gnesin, Director of Goodman Theatre and Head of AIC Goodman School of Drama 3 January 11, 1939 Comments on exhibitions: The French Romanticists Gros, Gericault, and Delacroix; Exhibition of Bonnard and Villard, Contemporary French Artists; Christmas Story in Art; George Grosz, His Art from 1918 to 1938; Architecture by Ludwig Mies Van Der Rohe; 34 Old Master Drawings, Lent by Sir Robert Witt of London; gallery tour for the Second Conference of Chicago Art Clubs 4-5 January 13, 1939 AIC major exhibitions of 1938, attendance record from Museum Registrar's Department 6 January 14, 1939 Scammon Lecture, Turner's Romantic Vision of Switzerland , given by Dr. Paul Ganz, Professor at University of Basle, Switzerland, biography note and publications 8 January 18, 1939 28th Annual Governing Members' Meeting, hosted by AIC President Mr. Potter Palmer; luncheon, list of participants 7 January 19, 1939 Kate S. Buckingham Memorial Lecture, Chinese Bronzes , given by AIC Assistant Director and Curator of Oriental Art Department Charles Fabens Kelley 9 January 21, 1939 The National Exhibition of Representative Buildings of the Post War Period, exhibition, organized and curated by American Institute of Architecture (AIA) 12 January 23, 1939 Annual Report for 1938, issued by Director of Fine Arts Daniel C. Rich and Director of Finance and Operation Charles H. Burkholder; major gifts and donations; Robert Allerton, gift for construction of the Decorative Arts Galleries; Mrs. Erna Sawyer Goodman, money gift, establishing William Owen Goodman Fund; attendance, membership, SAIC enrollment; major bequest of Ms. Kate Buckingham; Mrs. William O. Goodman Collection of pewter, gift to AIC; Superintendent's report on condition of skylight roof; Bartlett Lecture Series; funding for lectures and publications 10-11 Pablo Picasso: Forty Years of His Art, exhibition announcement, first collaborative project of AIC and The Museum of Modern Art, N.Y., 13, 102 January 25, 1939 43rd Annual Exhibition by Artists of Chicago and Vicinity, jury comprised of Donald Bear of Denver Art Museum, Clarence Carter of Carnegie Institute, Pittsburgh, and artists Mahonri H. Young of New York and Albin Polasek of Chicago; list of prizes 14, 19-20, 23, 25 January 26, 1939 Kate S. Buckingham Memorial Lecture, Chinese Terra Cotta Tiles , given by AIC Assistant Director and Curator of Oriental Art Department Charles Fabens Kelley 15 January 30, 1939 A Leading School of Buddhist Sculpture , lecture given by Dr. Osvald Siren of National Museum in Stockholm; biography note and comments on his collection and publications 16 SAIC 6th Annual Open House for alumni, governing members, trustees, friends of the School and officials; Glee Club concert under direction of AIC Assistant Director and Curator of Oriental Art Charles Kelley 17 January 31, 1939 Chicago High School Scholarship contest at SAIC; list of winners, Judith Pesman, Suzanne Siporin, Emil Grego, Joanne Kuper, and Joseph Strickland 18 Exhibition of Contemporary American Art at New York World's Fair 1939; proceedings and requirements; Chicago juries of New York World's Fair, represented by Aaron Bohrod, Ralph Clarkson, Mitchell Siporin, Daniel C. Rich (chairman of the Painting Jury), Sidney Loeb, Peterpaul Ott, Albin Polasek, George Thorp, Todros Geller, James Swann, Morris Topchevsky, Beatrice Levy, Charles Wilimovsky, and Lillian Combs 19-20 February 2, 1939 Kate S. Buckingham Memorial Lecture, Chinese Sculpture and Painting , given by AIC Assistant Director and Curator of Oriental Art Department Charles Fabens Kelley 21 February 4, 1939 Scammon Lecture, Six Dynasties and Early T'ang Painting , given by Laurence Sickman, curator of Oriental Art at William Rockhill Nelson Gallery of Art, Kansas City, MO; biography note 22 February 6, 1939 43rd Annual Exhibition by Artists of Chicago and Vicinity, opening, Artists' Dinner, hosted by AIC Director of Finance and Operation Charles H. Burkholder; guest speaker George Buehr, other guests included Mr. and Mrs. Potter Palmer, Mr. Paul Schulze, Mr. and Mrs. Charles Fabens Kelley, Mrs. Albion Headburg, and Ms. Eleanor Jewett 14, 19-20, 23, 25 February 13, 1939 The Making of a Cartoon , lecture and film demonstration, conducted by cartoonist of the Chicago Daily News Vaughn R. Shoemaker, complementing exhibition titled Original American Cartoons from Charles L. Howard Collection 24 February 14, 1939 AIC Exhibition Calendar for 1939 In the Department of Painting and Sculpture, curator Daniel Catton Rich, AIC Director: Chicago and Vicinity 43rd Annual Exhibition; Masterpiece of the Month: Portrait of Mrs. Wolff by Sir Thomas Lawrence; 18th International Exhibition of Watercolors; Annual Exhibition by Students of SAIC; 50th Annual Exhibition of American Painting and Sculpture: Half a Century of American Art 25 In the Children's Museum, curator Helen Mackenzie: The Making of a Masterpiece, exhibition, featuring altarpiece by Giovanni di Paolo of Sienna; Means and Methods of Water Color Painting 25 In the Blackstone Hall: Original American Cartoons from the Collection of Charles L. Howard of Chicago 26 In the Oriental Art Department, Curator Charles Fabens Kelley: two exhibitions from AIC Clarence Buckingham Collection of Japanese Prints, titled In Wind and Rain, and Blossom Viewing; Masterpiece of the Month: Imperial Jade Cup on Stand, 18th C., gift of Russell Tyson 26 In Prints Department, Acting Curator Lillian Combs: Selections from Lenora Hall Gurley Memorial Collection of Drawings; Recent Accessions in Prints, 1937-1939; Woodcuts from Books of the 15th Century; Masterpiece of the Month: The Lamentation from the Great Passion by Albrecht Durer; Prints by Old Masters from Clarence Buckingham Collection; The Bulls of Bordeaux by Francesco Goya; Sports in Prints 26 In the Decorative Arts Department, Curator Bessie Bennett: French Furniture and Sculpture, 18th C. from Henry Dangler Collection; Florence Dibell Bartlett Collection of Bonader from Sweden, 18th and 19th C.; English Architecture of 18th C.; Embroideries from The Greek Islands Lent by Elizabeth Day McCormick; Ecclesiastical Embroideries; English Embroideries; Exhibition of Embroideries by the Needlework and Textile Guild 27 General Information about Permanent collection and admission 27 February 15, 1939 Florence Dibell Bartlett Lecture, Adventures in the Arts , given by Helen Parker, Head of AIC Education Department 28 February 20, 1939 Antiquarian Society, Tea Party, honoring Elizabeth Day McCormick and exhibition of Embroideries from the Greek Islands; party specialties and participants 29, 59, 61 February 21, 1939 George Washington's Birthday, free Museum admission; Washington's portraits in AIC Permanent collection 30 February 25, 1939 Scammon Lecture, The Fountains of Florence , given by Bertha Wiles, Curator of Mark Epstein Library at University of Chicago 31 February 28, 1939 Scammon Lecture, The Artistic Relations of England and Italy , given by William George Constable of Boston Museum of Fine Arts; biography note, Mr. Constable, founder of the Courtauld Institute in London 33 March 2, 1939 New Light on Prehistoric Man , lecture and film demonstration, presented by Dr. Henry Field, and sponsored by Chicago Chapter of Archaeological Institute of America 32 Kate S. Buckingham Lecture, The Gothic Room , given by Bessie Bennett, AIC Curator of Decorative Arts 34 March 8, 1939 Goodman Theatre, performance of Alice in Wonderland for children from settlement houses and orphanages; list of participating institutions 36 March 9, 1939 Kate S. Buckingham Lecture, Prints by Old Masters, Including Rembrandt , given by Edith R. Abbot, artist and educator of The Metropolitan Museum, N.Y., biography note about Ms. Abbot 37 March 15, 1939 Frederick Arnold Sweet, appointed Assistant Curator of AIC Painting and Sculpture Department; Mr. Sweet's resume 38 March 17, 1939 Kate S. Buckingham Lectures, Master Etchers of the 19th Century , given by Head of Education Department Helen Parker; The English Lustre Ware Collection, given by AIC Director Daniel C. Rich 39 March 20, 1939 Opening reception for 18th International Water Color Show, works on view, including loans from Edward Hopper, John Whorf, and Henri Matisse 35 March 23, 1939 18th Annual International Water Color Exhibition; prizes and works on view; jury comprised of Grant Wood, Joseph W. Jicha of Cleveland, and Hubert Ropp of Chicago; concurrent exhibition in the AIC Children's Museum, explaining water color technique; biography notes about prize-winners, Everett Shinn and Dale Nichols 35, 40-42, 5I-52, 64 March 24, 1939 Kate S. Buckingham Lecture, The English Lustre Ware Collection , given by AIC Director Daniel C. Rich 43 March 28, 1939 AIC Curator of Decorative Arts Department Bessie Bennett (1870-1939), obituary; Ms. Bennet's AIC tenure, biography note, remarks by AIC President Mr. Potter Palmer 44-45 April 3, 1939 Easter Festivities at AIC, Monsalvat , performance by Dudley Crafts Watson; SAIC Glee Club concert under direction of Charles Fabens Kelley, sponsored in part by Mrs. James Ward Thorne 46 April 6, 1939 Albin Polasek, Head of Sculpture Department at SAIC, honored with award of merit by the National Institute of Immigrant Welfare, N.Y.; biography note and chronology 47-48 April 11, 1939 Glee Club, Eastern concert program 46, 49 50th Annual Exhibition of American Painting and Sculpture: Half a Century of American Art, retrospective, showing works from American Annual exhibitions held at AIC from 1888 to 1938; comments on the exhibition selection by AIC Director Daniel C. Rich 25, 50 3rd Conference of Art Chairmen; AIC Assistant Curator of Painting and Sculpture Frederick A. Sweet, speaking on 18th International Water Color Exhibition, comments and criticism 40-42, 51-52, 64 April 13, 1939 Kate S. Buckingham Lecture, The Early Development of Chinese Pottery , given by AIC Assistant Director and Curator of Oriental Art Department Charles Fabens Kelley 53 April 17, 1939 SAIC group exhibition at Paul Theobald's Gallery in Chicago, showing abstractionist paintings done in the class of Willard G. Smythe 54 April 20, 1939 Kate S. Buckingham Lecture, The Great Period of Pottery and the Beginnings of Porcelain , given by AIC Assistant Director and Curator of Oriental Art Department Charles Fabens Kelley; attendance record of the Lecture Series 55 April 25, 1939 Europe, Asia, Africa: A Common Civilization , lecture, given by Melville J. Herskovits of Northwestern University, Evanston, IL, 56 Art Quiz, booklet by Head of Education Department Helen Parker, published in support for AIC Museum programs 57 April 27, 1939 Kate S. Buckingham Lecture, The Great Porcelains of the Ming and Ch'ing Dynasties, given by AIC Assistant Director and Curator of Oriental Art Department Charles Fabens Kelley 58 May 2, 1939 Antiquarian Society, Tea Party, featuring speech by AIC Director Daniel C. Rich, titled Decorative Arts in the Museum of Tomorrow ; members of the Society, listed 59 May 5, 1939 Goodman Theatre dance series, featuring Spanish dancer Clarita Martin, Ms. Martin's remarks 60 May 6, 1939 Antiquarian Society, Spring Meeting; Tea Party marking the Exhibition of Embroideries from Greek Islands in Elizabeth Day McCormick Collection; special gallery arrangements provided by Mrs. Walter S. Brewster, Mrs. Charles S. Dewey, Mrs. James Ward Thorne, Mrs. C. Morse Ely, and Mrs. Chauncey McCormick 29, 59, 61-62 May 9, 1939 Antiquarian Society Tea Party, decorative floral display available for public viewing 62 May 12, 1939 5th Annual Exhibition by Student Janitors of SAIC, participants and Fellowship awards 63 May 12, 1939 18th International Water Color Exhibition, attendance record; list of works sold from the show 35, 40-42, 51-52, 64 May 13, 1939 Annual Exhibition of the Needlework and Textile Guild of AIC, opening; works on view and participants 65-66 May 22, 1939 Foreign Travelling Fellowships, awarded to SAIC Student Janitors by AIC Officials and members of SAIC Faculty; award recipients Murray Jones, Edward Voska, biography notes 67 May 23, 1939 SAIC Glee Club concert, program and performers 68 May 26, 1939 Free Museum admission on Memorial Day; special exhibitions: Glass Paperweights from Mrs. John H. Bergstrom Collection; Japanese Surimono Prints, lent by Ms. Helen C. Gunsaulus; Chinese Jades from Mrs. Edward Sonnenschein Collection; Ms. Elizabeth Day McCormick Collection of Embroideries 69 June 2, 1939 Room of Recent Accessions, opening; new gallery, designated for exhibitions in The Masterpiece of the Month Series, and displaying new additions to Permanent collection; works shown at the opening; comments by AIC Director Daniel C. Rich 70-71 June 6, 1939 Art Students League of SAIC, prizes given to the League members; awards made possible through the gift of Mrs. William O. Goodman 72 June 8, 1939 Free Summer Lectures, French and German Primitives by Gibson Danes of Northwestern University, Evanston, IL; Paintings of the High Renaissance in Italy by SAIC instructor Briggs Dyer; Dutch and Flemish Old Masters by AIC Assistant Curator of Painting Frederick A. Sweet 73 June 9, 1939 SAIC Annual Commencement Exercises, graduation announcement at Goodman Memorial Theatre, conducted by AIC Vice President Mr. Chauncey McCormick; Invocation and Benediction pronounced by Minister of New England Church, Rev. Theodore Hume; student prizes, AIC Glee Club performance; guest list 74 June 10, 1939 AIC Director Daniel Catton Rich, named Chairman of Jury at San Francisco Golden Gate International Exposition 75 June 13, 1939 AIC Exhibition Calendar for 1939 Summer Exhibitions In the Department of Painting and Sculpture, curator AIC Director Daniel Catton Rich: Annual Exhibition of Works by SAIC Students; Costumes and Folk Art from Central Europe from Florence Dibell Bartlett Collection; Whistleriana, the artist's memorabilia from Walter Brewster Collection; Water Color Drawings by Thomas Rowlandson; Paintings by Lester O. Schwartz; Memorial Exhibition of Paintings by Pauline Palmer; Memorial Exhibition of Paintings by Carl Rudolf Krafft; Chinese Porcelains from the Goodman, Crane, Patterson, and Salisbury Collections; Lithographs by Odilon Redon; 50th Annual Exhibition of American Painting and Sculpture: Half a Century of American Art 76-77, 83 In the Children's Museum, curator Helen Mackenzie: Exhibition of Work by Children in the Saturday Classes of SAIC 77 From exhibition series The Making of the Masterpiece, showing At the Moulin Rouge by Toulouse-Lautrec 77 The Masterpiece of the Month, exhibition series introduced 77-78 In the Oriental Art Department, curator Charles Fabens Kelley: Chinese Jades from the Collection of Mr. and Mrs. Edward Sonnenschein; Japanese Surimono, lent by Ms. Helen C. Gunsaulus; Pottery of the Ming Dynasty 78, 83 In the Department of Prints and Drawing, Acting Curator Lilian Combs: Prints by Old Masters from Clarence Buckingham Collection; Sports in Prints; Sporting Prints and Drawings from the Collection of Mr. Joel Spitz of Chicago; Half a Century of American Prints; The Lenora Hall Curley Memorial Collection of Drawings; British Landscape Prints by Seymour Haden and David Young Cameron; Portraiture in Prints from Clarence Buckingham Collection; 7th International Exhibition of Lithography and Wood Engraving 78-79, 83 In the Decorative Arts Department: Exhibition of Paperweights from the Collection of Mrs. John N. Bergstrom; French Furniture from Henry C. Dangler Collection; Bonader from Sweden, Florence Dibell Bartlett Collection; English Architecture of the 18th C.; Exhibition of Embroideries from the Greek Islands, English and Ecclesiastical Embroideries from the Collection of Elizabeth Day McCormick 79, 83 Various announcements: invitation for train passengers to visit AIC on the way to the World's Fair in New York and San Francisco Golden Gate Exposition; attendance, lectures, Museum hours and orientation 79-80 June 13, 1939 General Education Board of Rockefeller Foundation, grant for three year project on art education in Chicago High Schools, conducted under supervision of Head of AIC Education Department Helen Parker 81 July 14, 1939 Chinese Art , free lecture series given by AIC Assistant Director and Curator of Oriental Art Charles Fabens Kelley; weekend gallery talks 82 July 18, 1939 Notes on Summer Exhibitions 83 July 22, 1939 Lectures and Gallery tours, given by AIC Assistant Curator for Painting and Sculpture Frederick A. Sweet, Gibson Danes of Northwestern University, Evanston, IL, and Briggs Dyer of SAIC 84 Weekly News Letter (Walter J. Sherwood, ed.); Nine Summer Exhibitions: Costumes and Folk Art from Eastern Europe lent by Florence D. Bartlett; Paintings by Carl Rudolf Krafft, School of the Ozark Painters; Pauline Palmer's paintings, works on view; Exhibition of Lester O. Schwartz, SAIC alumnus; Exhibition of Whistleriana from the collection of Walter S. Brewster, works on view; Water Colors by Thomas Rowlandson; Chinese Porcelains and Jades from Chicago Collections; Lithographs by Odilon Redon, from Martin A. Ryerson Collection; renovation of Permanent collection display; El Greco, lecture by assistant curator of Painting and Sculpture Frederick A. Sweet; note on the death of the mural painter Alphonse Mucha and the 1908 lecture series, titled Harmony in Art , given by the artist in AIC 137-138 July 25, 1939 Invitation to free music concert in Blackstone Hall, organist Max Allen, pianist Eleanor Gullett 85 July 29, 1939 Weekly News Letter (Walter J. Sherwood, ed.); The Masterpiece of the Month, exhibition series, Rembrandt's etching, titled Christ Preaching on display; paintings by winners of AIC Annuals Peter Hurd, Millard Sheets, Esther Williams, Nicolai Ziroli, John Whorf, William Zorach, and Georges Schreiber, acquired by The Metropolitan Museum in New York; free gallery lecture series, given by Briggs Dyer of SAIC and Gibson Danes of Northwestern University, Evanston, IL; gallery tours by Addis Osborne, SAIC alumnus; AIC catalogue of Summer exhibitions 139-141 August 1, 1939 Lectures and gallery talks, given by Briggs Dyer of SAIC, and Addis Osborne, SAIC alumnus 86-88, 90 August 5, 1939 Weekly News Letter (Lester Bridaham, ed.); Kenneth Goodman Memorial Theatre, improvements and additions; Decorative Arts Department Galleries in the Allerton Wing, construction, made possible by Vice-President and Chairman of the Committee of Decorative Arts, Mr. Robert Allerton; Wendell Stevenson, SAIC alumnus, commission of portraiture; SAIC Summer classes extended; Summer School at Saugatuck, MI, classes of Charles Willimovsky, SAIC Director Frederick Fursman, and Don Loving; 50th Annual Exhibition of American Painting and Sculpture: Half a Century of American Art, exhibition announcement; excepts from Time and Newsweek magazines, commenting on AIC Summer exhibitions; Sporting Prints from the Collection of Joel Spitz, exhibition 142-144 August 8, 1939 Briggs Dyer's Sunday Lecture Series gained public acclaim 87 August 12, 1939 Weekly News Letter; lectures and classes given by artists and SAIC alumni Leon R. Pescheret and Addis Osborne, and SAIC professors Edmund Giesbert and Briggs Dyer; Odilon Redon Lithographs, exhibition of works acquired by Martin A. Ryerson from the artist's widow, remarks by AIC Trustee Arthur T. Aldis; painting by Robert B. Harshe, AIC Director from 1921 to 1938, awarded honorable mention at Fine Arts Exhibition of the Golden Gates Exposition, excerpt from The Magazine of Art , May issie 145-147 August 15, 1939 Notes on Briggs Dyer's lectures 88 August 18, 1939 Membership Lecture, One-Plate Color Etching , given by SAIC instructor Leon R. Pescheret 89 August 19, 1939 Weekly News Letter; Student Honorable Mentions for the year 1939; AIC Curator Frederick A. Sweet, inquiring about locations of paintings for inclusion into 50th Annual Exhibition of American Painting and Sculpture: Half a Century of American Art, list of desired works; Assistant in AIC Decorative Arts Department Helen Mitchell, awarded Fellowship at Yale University; The Chicago Museum Tour Committee, providing two-day tour and booklet for Chicago visitors in cooperation with AIC and other cultural institutions, list of the Committee members 148-150 August 22, 1939 Lectures and gallery talks, given by SAIC instructors Briggs Dyer and Addis Osborne, and Head of AIC Education Department Helen Parker 90 Weekly News Letter; Masterpiece of the Month, exhibition series, showing Persian brocade of the Safavid period, the reign of Shah Abbas (1587-1628), gift of Mr. John R. Thompson of Chicago, description and comments; Contemporary Fine Arts Building at the New York World's Fair, AIC ranked as the most popular museum outside New York; Oriental jades from AIC Sonnenschein Collection, shown at The Golden Gate Exposition in San Francisco; free Museum admission on Labor Day; AIC Fall lecture series, titled The Great White Way to San Francisco Bay , given by Dudley Crafts Watson, reflecting on New York World's Fair, The Golden Gate Exposition in San Francisco, and US Museums 151-153 August 29, 1939 Notes on Exhibition of East European Costumes from Florence D. Bartlett Collection and other displays 91 September 2, 1939 SAIC announcing Student registration for the year 1940; colored post cards and reproductions of works from AIC Permanent collection, supplied by New York office of Vienna publisher Max Jaffe, list of titles available at AIC Reproduction Desk; gallery tours, conducted by Head of AIC Education Department Helen Parker and Briggs Dyer of SAIC; general Museum information, record of School, Museum offices and workshops, Shipping Room, and Museum Registrar in the Archives Department; Fall program in Fullerton Hall, opened with lecture series about home decoration, given by Dudley Crafts Watson 154-156 September 11, 1939 Lectures, Paintings of the High Renaissance in Italy , given by Helen Parker, and Dutch and Flemish Old Masters , given by Briggs Dyer 92 September 13, 1939 Meyric R. Rogers, appointed AIC Curator of Decorative Arts Department, replacing late Ms. Bessie Bennett; Mr. Rogers, concurrently appointed Head of Industrial Arts Department, newly formed in AIC; biography note, publications, and remarks by AIC President Potter Palmer and AIC Director of Fine Arts Daniel C. Rich 93-94 September 19, 1939 Week of the American Legion Convention, free Museum admission for the Legion members, announcement by AIC Director of Finance and Operation C. H. Burkholder 95-96 September 22, 1939 American Legion Parade, free Museum admission for the public 95-96 September 25, 1939 AIC Department of Education, programs and lectures, featuring SAIC instructor Mary Hipple, Head of Education Department Helen Parker, Ramsey Wieland, and George Buehr; film demonstrations on art techniques, supplemented by gallery tours 97 September 28, 1939 Sunday Lectures, French and English Paintings of the 17th and 18th Century , given by SAIC instructor George Buehr, and French Decorative Arts , given by assistant in Education Department Ramsey Wieland 100 September 30, 1939 Fiestas in Guatemala , lecture by Erna Fergusson, introducing Scammon Lecture Series for the year 101 October 1, 1939 Masterpiece of the Month, exhibition series, St. John on Patmosby Nicolas Poussin ; comparative displays in Impressionist galleries 98-99 October 2, 1939 Picasso Retrospective, planned by Alfred H. Barr, Director and Vice President of The Museum of Modern Art, N. Y. (MOMA), and Daniel C. Rich, AIC Director of Fine Arts; announcement on exhibition dates; war time exhibition, the first collaborative project by MOMA and AIC 13, 102 October 4, 1939 The Adventures in the Arts , lecture series conducted by Head of Education Department Helen Parker; attendance record for AIC lectures; Costumes from Florence Dibell Bartlett Collection on display 103 October 5, 1939 7th International Exhibition of Lithography and Wood-Engraving, US tour exhibition, jury comprised of artists Peggy Bacon, Asa Cheffetz, and Todros Geller; The Logan Prize for Prints, announced 104 October 7, 1939 Scammon Lecture, The Educational Viewpoint in an Art Museum , given by Dr. Thomas Munro of Cleveland Museum of Art; biography note and publications 105 October 12, 1939 Exhibition of Chinese Pottery and Porcelain, lent by Chicago collectors Mrs. William O. Goodman, Mrs. Richard T. Crane, Mrs. Alice H. Patterson, and Mrs. W. W. Kimball (courtesy of Mrs. Warren Salisbury and Mr. Kimball Salisbury) 106 October 14, 1939 Scammon Lecture, Armor of Renaissance Princes , given by Curator of Arms and Armors in The Metropolitan Museum Stephen V. Grancsay; the 1893 exhibition of Arms and Armor, held at the Chicago Columbian Exposition and featuring Mr. Grancsay's lecture 107 October 20, 1939 Motion Pictures in the Arts , special program in association with 7th International Exhibition of Lithography and Wood-Engraving, conducted by Head of Education Department Helen Parker; film screening, featuring woodcut artists and illustrators, Lynd Ward, Timothy Cole, and Chaim Gross 108 October 21, 1939 Scammon Lecture, The Art of Our Early Cabinet Makers , given by Edwin J. Hipkiss of Boston Museum of Fine Arts; biography note and publications 109 October 26, 1939 SAIC Glee Club concert of Negro Spirituals, conducted by AIC Assistant Director and Curator of Oriental Art Department Charles Fabens Kelley, and featuring musicians Virgil Espenlaub, Juanita Krunk, and Eleanor Gullett; numbers performed 110 October 27, 1939 Scammon Lecture, French Medieval Sculpture in America , given in association with opening of The Cloisters Museum in New York, by James J. Rorimer of The Metropolitan Museum; remarks by Mr. H. E. Winlock, formerly Director of The Metropolitan Museum; publications by Mr. Rorimer 111 October 28, 1939 50th American Exhibition: Half a Century of American Art, opening reception featuring tea table decorations from different periods, sponsored and arranged by The Antiquarian Society, The Municipal Art League, Art Institute Alumni, The Renaissance Society, The Arts Club, etc.; listing of representatives and participants 25, 50, 77, 112, 120-121 November 1, 1939 Masterpieces of Italian Art, exhibition lent by the Royal Italian Government to San Francisco World's Fair, special announcement on exclusive showing at AIC 113-114, 116-119, 122, 123, 125, 129, 131,132, 134 November 6, 1939 Scammon Lecture, Colonial American Portraiture , given by Alan Burroughs of Harvard University; biography note and publications 115 November 9, 1939 Masterpieces of Italian Art, exhibition lent by the Royal Italian Government to San Francisco World's Fair, shipment of art works to Chicago for exclusive showing at AIC and official ceremonies upon arrival, the route of procession to AIC 116 November 11, 1939 Masterpieces of Italian Art, exhibition lent by the Royal Italian Government to San Francisco World's Fair; honorary committees and Chicago sponsors for exclusive AIC showing 117-119 November 14, 1939 50th Annual Exhibition of American Painting and Sculpture: Half a Century of American Art, opening reception arranged by Antiquarian Society and Fortnightly Club, description of table decoration and list of hostesses 120-121 November 17, 1939 Masterpieces of Italian Art, exhibition, opening ceremonies featuring opera singer Hilde Reggiani 122 November 21, 1939 Free Museum admission on Thanksgiving Day; Radio program and special lectures, supplementing Masterpieces of Italian Art Exhibition 123 November 27, 1939 Scammon Lecture, featuring American sculptor William Zorach 124 December 1, 1939 Masterpieces of Italian Art, exhibition, related discussion on using tempera technique 125 December 2, 1939 Scammon Lecture, Precursors of the New Architecture , given by John Barney Rodgers of Armour Institute of Technology; biography note 126 December 5, 1939 Glee Club, Christmas concert, directed by AIC Assistant Director Charles Fabens Kelley 127 December 7, 1939 Masterpieces of Italian Art, exhibition; extended hours for late evening viewing; special musical programs, gallery tours, and Christmas events 129 December 9, 1939 Scammon Lecture, dedicated to sculptor Carl Milles, given by curator of Decorative Arts Department Meyric R. Rogers 128 December 12, 1939 Armour Institute of Technology Musical Club, free concert including AIC Glee Club performance 130 December 14, 1939 Masterpieces of Italian Art, exhibition, evening concerts; Joseph Bentonelli, lyric tenor, performing from the Museum Grand Staircase 131 December 18, 1939 Masterpieces of Italian Art, exhibition, evening concerts; Choir of the Church of Saint Thomas the Apostle 132 December 19, 1939 Free Museum admission on Christmas Day; Listing of current exhibitions 133 December 26, 1939 Masterpieces of Italian Art, exhibition, Italian Day in the Museum, free admission declared by Royal Italian Government 134 December 27, 1939 Free museum admission on New Year's Day; current exhibitions and lectures 135 ",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.5"
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
        "total": 67,
        "limit": 2,
        "offset": 0,
        "total_pages": 34,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/educator-resources?page=2&limit=2"
    },
    "data": [
        {
            "id": 101,
            "api_model": "educator-resources",
            "api_link": "https://api.artic.edu/api/v1/educator-resources/101",
            "title": "Educator Resource Packet: Zapata by Jos\u00e9 Clemente Orozco",
            "web_url": "https://nocache.www.artic.edu/collection/resources/educator-resources/101-educator-resource-packet-zapata-by-jose-clemente-orozco",
            "copy": " This dramatic canvas was painted by Jos\u00e9 Clemente Orozco during his self-imposed exile in the United States. A leader of the Mexican Mural movement of the 1920s and 1930s, Orozco painted Emiliano Zapata who had become a symbol of the Mexican Revolution (1910-20) after his assassination in 1919. This resource packet focuses on a single work of art from the museum's collection and provides information about the artwork, the artist, and the historical context of the piece. ",
            ...
        },
        {
            "id": 99,
            "api_model": "educator-resources",
            "api_link": "https://api.artic.edu/api/v1/educator-resources/99",
            "title": "Tips for Discussing Works of Art",
            "web_url": "https://nocache.www.artic.edu/collection/resources/educator-resources/99-tips-for-discussing-works-of-art",
            "copy": " Discussions about works of art can take many forms. Keeping the following suggestions in mind will ensure that the discussion is meaningful and inclusive. ",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.5"
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
        "total": 67,
        "limit": 10,
        "offset": 0,
        "total_pages": 7,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "educator-resources",
            "api_link": "https://api.artic.edu/api/v1/educator-resources/113",
            "id": 113,
            "title": "SmartHistory Videos: Six Works from the Collection",
            "timestamp": "2022-09-21T23:26:52-05:00"
        },
        {
            "_score": 1,
            "api_model": "educator-resources",
            "api_link": "https://api.artic.edu/api/v1/educator-resources/121",
            "id": 121,
            "title": "Artful Encounters: Short and Informative Videos for Educators and Students",
            "timestamp": "2022-09-21T23:26:52-05:00"
        },
        {
            "_score": 1,
            "api_model": "educator-resources",
            "api_link": "https://api.artic.edu/api/v1/educator-resources/122",
            "id": 122,
            "title": "Lesson Plan: Silk around the World",
            "timestamp": "2022-09-21T23:26:52-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.5"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "web_url": "https://nocache.www.artic.edu/collection/resources/educator-resources/7-thematic-curriculum-art-science",
        "copy": " Art + Science was developed by the Art Institute of Chicago to support dialogue and collaboration between art and science teachers at the middle school level, with the ultimate goal of inspiring art and science integration in the curriculum. The program consists of two interconnected parts: this curriculum resource and a field trip to the museum, which features a gallery tour and studio art-making activity. The curriculum resource is intended to help teachers to prepare for and extend the field trip experience. Both the field trip and curriculum resource showcase and encourage interdisciplinary connections between art and science first on a broad level and then through the particular lens of stability and change. ",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.5"
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
        "total": 17,
        "limit": 2,
        "offset": 0,
        "total_pages": 9,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/digital-catalogs?page=2&limit=2"
    },
    "data": [
        {
            "id": 30,
            "api_model": "digital-catalogs",
            "api_link": "https://api.artic.edu/api/v1/digital-catalogs/30",
            "title": "Ivan Albright Paintings at the Art Institute of Chicago",
            "web_url": "https://nocache.www.artic.edu/digital-publications/30/ivan-albright-paintings-at-the-art-institute-of-chicago",
            "copy": " Renowned as the \u201cmaster of the macabre,\u201d Chicago native Ivan Albright (1897\u20131983) is famous for richly detailed paintings of ghoulish subjects including Into the World There Came a Soul Called Ida and Picture of Dorian Gray . This catalogue brings together fresh perspectives on the artist: professor emerita of art history Sarah Burns reveals Albright\u2019s fascination with popular culture, and curator John P. Murphy explores his philosophy of ugliness. Painting conservator Kelly Keegan examines the artist\u2019s process and details how he achieved his unique painterly effects. A plate section of the 44 oil paintings in the collection of the Art Institute of Chicago, reproduced in high resolution to enable close looking, documents Albright\u2019s portrayal of the body\u2019s vulnerability to age, disease, and death. This includes a haunting series of self-portraits, one of which the artist made in his hospital bed three days before he died.   Edited by Sarah Kelly Oehler, with an introduction by Sarah Kelly Oehler and essays by Sarah Burns, Kelly Keegan, and John P. Murphy   This publication follows the exhibition Flesh: Ivan Albright at the Art Institute of Chicago (May 4\u2013Aug. 4, 2018).   The publication is free and has received generous funding from the Northwestern University Department of Art History Warnock Publication Fund. ",
            ...
        },
        {
            "id": 13,
            "api_model": "digital-catalogs",
            "api_link": "https://api.artic.edu/api/v1/digital-catalogs/13",
            "title": "Whistler and Roussel: Linked Visions",
            "web_url": "https://nocache.www.artic.edu/digital-publications/13/whistler-and-roussel-linked-visions",
            "copy": " Whistler and Roussel: Linked Visions, an exhibition catalogue that accompanies that Art Institute show by the same title, explores the relationship and artistic collaboration between James McNeill Whistler and Theodore Roussel. The exhibition and catalogue offer a new perspective on the artists, their artistic circle, and the resulting innovation. The catalogue features an in-depth essay as well as an illustrated checklist are illustrated by 214 images that feature the works of art that are in the show   Meg Hausberg and Victoria Sancho Lobis ",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.5"
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
        "total": 17,
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
            "timestamp": "2022-09-21T23:27:03-05:00"
        },
        {
            "_score": 1,
            "api_model": "digital-catalogs",
            "api_link": "https://api.artic.edu/api/v1/digital-catalogs/34",
            "id": 34,
            "title": "Malangatana: Mozambique Modern",
            "timestamp": "2022-09-21T23:27:03-05:00"
        },
        {
            "_score": 1,
            "api_model": "digital-catalogs",
            "api_link": "https://api.artic.edu/api/v1/digital-catalogs/33",
            "id": 33,
            "title": "The Lithographs of James McNeill Whistler: The Digital Edition",
            "timestamp": "2022-09-21T23:27:03-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.5"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "web_url": "https://nocache.www.artic.edu/digital-publications/2/american-silver",
        "copy": " American Silver in the Art Institute of Chicago showcases the museum's superb collection of American silver. In-depth essays relate a fascinating story about eating, drinking, and entertaining that spans the history of the Republic and traces the development of the museum\u2019s holdings of American silver over nearly a century, and a catalogue incorporates detailed analysis of objects written by leading specialists. This digital augmentation of the 2017 publication provides stunning high-resolution photography and, for a select number of objects, three-dimensional captures that allow for close viewing. In addition, this edition includes an extensive illustrated checklist of additional objects.   Edited by Elizabeth McGoey with contributions by Debra Schmidt Bach, David L. Barquist, Judith A. Barter, Jennifer Goldsborough, Medill Higgins Harvey, Patricia Kane, Elizabeth McGoey, Barbara K. Schnitzer, Janine E. Skerry, Ann Wagner, Gerald W. R. Ward, Deborah Dependahl Waters, Beth Carver Wees, and Elizabeth A. Williams   American Silver in the Art Institute of Chicago is free and has received major support for this catalogue is provided by the Henry Luce Foundation. It is also made by possible by the generosity of the Community Associates of the Art Institute of Chicago, Mr. and Mrs. Henry M. Buchbinder, Carl and Marilynn Thoma, Louise Ingersoll Tausche, Jamee and Marshal Field V, Kay Bucksbaum, Celia and David Hilliard, and Jan and Bill Jentes. ",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.5"
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
        "total": 11,
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
            "copy": " Video   Photographs ",
            ...
        },
        {
            "id": 10,
            "api_model": "digital-publication-sections",
            "api_link": "https://api.artic.edu/api/v1/digital-publication-sections/10",
            "title": "Works in the Exhibition",
            "web_url": "https://nocache.www.artic.edu/digital-publications/34/malangatana-mozambique-modern/10/works-in-the-exhibition",
            "copy": " Artist, poet, and revered national hero Malangatana Ngwenya (1936\u20132011) was a pioneer of modern art in Africa. Born in Mozambique, in southeast Africa, Malangatana depicted vivid allegorical scenes that draw from local religious practices, his cultural background, and life under colonial rule. This exhibition presented a selection of the artist\u2019s early paintings and drawings, made between 1959 and 1975. During this period Malangatana embarked on bold formal experiments that coalesced into a signature style characterized by dense compositions of human, animal, and monstrous figures. Malangatana\u2019s early career coincided with Mozambique\u2019s liberation struggle, in particular the armed resistance against the Portuguese in 1964, which was spearheaded by the Front for the Liberation of Mozambique (FRELIMO). A Portuguese colony until 1975, Mozambique was among the last countries on the African continent to gain independence. Malangatana explored the rapidly changing world around him and addressed the country\u2019s social and political context in his paintings and drawings. These works exemplify the confluence of artistic innovation and political liberation that has shaped the history of modern art in Africa during the second half of the twentieth century.   A Hybrid Education Growing up in the village of Matalana, Malangatana encountered local art and craft traditions such as pottery, basketry, and painting before moving to Mozambique\u2019s capital, Louren\u00e7o Marques (now Maputo), to find work. Racial and social barriers of the colonial system limited black Mozambicans\u2019 access to formal art education. However, colonial policies promoting integration through assimilation\u2014pressuring the local black population to adopt the language, religion, and values of the Portuguese\u2014made art classes available to Malangatana at the Industrial School as well as the Art Center of the Colony of Mozambique in the late 1950s. At the Art Center, Malangatana encountered European styles of painting and met Portuguese architect Am\u00e2ncio d\u2019Alpoim Miranda \u201cPancho\u201d Guedes, who became a significant mentor and patron. Guedes encouraged him to leave the Art Center in order to avoid, in Malangatana\u2019s words, \u201cpollution\u201d by a formal education anchored in European painting traditions. Guedes gave Malangatana studio space and a salary, and commissioned a large number of paintings in the years prior to the artist\u2019s first solo exhibition in 1961.   Mythology and Religion Many of Malangatana\u2019s works from the late 1950s to the early 1970s refer to the artist\u2019s Mozambican roots, specifically his Ronga cultural background. The paintings in this section feature Ronga folklore, mythology, and healing rituals. Frequently the artist included Catholic symbols, signs of the pervasive Portuguese influence in Mozambique. Malangatana\u2019s exaggerated depictions of Ronga culture verge on the satirical, and his references to Christianity are similarly unflattering, suggesting a critique of Portuguese colonial rule. Malangatana\u2019s work demonstrates how he carefully balanced all aspects of life in Mozambique, from colonial influences and indigenous customs and practices to the struggle for independence. These experiences\u2014as well as his art education and the structures of patronage he was embedded in\u2014were layered and complex, subverting the clich\u00e9d notion of the self-taught African artist who, unspoiled by foreign influences, finds inspiration in \u201cprimitive\u201d practices and beliefs, an idea that persists in the art history and reception of modern African art.   Beyond Painting and Drawing Malangatana was also active as an educator, muralist, sculptor, and writer. He frequently published in journals and corresponded extensively with peers and friends all over the world. In addition, he wrote poetry, at times to accompany his paintings. Malangatana drew from personal aspects of his life in his poems, some of which were presented in an issue of the African literary journal Black Orpheus.   In 1995 Malangatana started building a cultural center in his birth village of Matalana to host art education and community events. The center\u2019s architecture combines the geometric logic and industrial materials of Bauhaus design\u2014inspired by the work of Malangatana\u2019s friend and patron Pancho Guedes, a renowned modern architect\u2014with elements such as circular windows, teeth, grids, and figurative wall reliefs (fig. 1). The grid design of this exhibition borrowed from the center\u2019s architecture (fig. 2).   Prison Drawings In 1965\u201366 the International and State Defense Police (PIDE) imprisoned Malangatana for 18 months because of his suspected involvement with the Front for the Liberation of Mozambique (FRELIMO). While incarcerated, the artist began a series of drawings that he continued to work on after his release. The works capture the harsh conditions of life in Machava Central Prison through striking realism interrupted by fantasy scenes and dreams, their tension amplified by distorted bodies and monstrous figures. In 1961 mentor and patron Pancho Guedes introduced Malangatana to Eduardo Chivambo Mondlane, the founding president of the movement FRELIMO. Malangatana hoped to go abroad for international opportunities and exposure, but Mondlane encouraged him to stay in Mozambique and use art to contribute to the anti-colonial struggle. The artist\u2019s growing political awareness during the 1960s is apparent in the increasingly political tone of his work. He also expressed dissent by withdrawing from the 1964 exhibition Artists in Mozambique to protest Nelson Mandela\u2019s imprisonment and by refusing to represent Portugal at the 1965 S\u00e3o Paulo Art Biennial.   Artist of the Revolution After receiving a yearlong scholarship in 1971 from the Gulbenkian Foundation in Lisbon, Malangatana explored new media and pursued exhibition opportunities across Europe\u2014before returning permanently to Mozambique in 1974. There he continued experimenting in his art by elongating limbs, introducing opaque colors, and moving further into abstraction with thick outlines and flattened compositions. The titles of his works during this period, such as The Cry for Freedom and Remember Those Who Entered Bleeding? , reflect the focus on the war for independence and the sense of urgency Mozambicans felt at the time: in 1974 a ceasefire ended the war, followed by ten months of negotiations and the country\u2019s independence on June 25, 1975. After independence Malangatana was embraced as an artist of the revolution, and his work, including state-funded murals, was recognized as an exemplar of Mozambican culture. In addition to holding multiple roles within the newly formed government, he was appointed ambassador of peace during Mozambique\u2019s civil war (1977\u201392) and UNESCO Artist for Peace in 1997. He was also instrumental in establishing Mozambique\u2019s National Museum of Art in Maputo. Malangatana continued working as a civic leader, educator, poet, and, foremost, as an artist until his death in 2011. ",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.5"
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
        "total": 11,
        "limit": 10,
        "offset": 0,
        "total_pages": 2,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "digital-publication-sections",
            "api_link": "https://api.artic.edu/api/v1/digital-publication-sections/9",
            "id": 9,
            "title": "\u201c'The Complete Painter': Malangatana\u2019s Approach to Painting, 1959\u201375\" by Allison Langley, Katrina Rush, and Julie Simek",
            "timestamp": "2022-09-21T23:27:08-05:00"
        },
        {
            "_score": 1,
            "api_model": "digital-publication-sections",
            "api_link": "https://api.artic.edu/api/v1/digital-publication-sections/6",
            "id": 6,
            "title": "\u201cMalangatana as Ethnographer? Modern Paintings of Village Life\u201d by Constantine Petridis",
            "timestamp": "2022-09-21T23:27:08-05:00"
        },
        {
            "_score": 1,
            "api_model": "digital-publication-sections",
            "api_link": "https://api.artic.edu/api/v1/digital-publication-sections/8",
            "id": 8,
            "title": "\u201cDeep Ambivalences: Malangatana\u2019s Anti/Colonial Aesthetic\u201d by M\u00e1rio Pissarra",
            "timestamp": "2022-09-21T23:27:08-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.5"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "copy": " The Art Institute of Chicago has been at the forefront of American museums in collecting and displaying modern art since the early twentieth century, and boasts an ongoing commitment to extending this vital legacy with research, publications, and exhibitions. In that spirit, a number of our curators came together in 2013 for a series of discussions exploring ideas about modern art, in particular the ways in which it manifests across our collections. This gave rise to the Modern Series, a set of three experimental, challenging, and provocative exhibitions and publications that are co-organized by curators across departments, with divergent but complementary specialties. The two previous iterations\u2014 Shatter Rupture Break (February 15\u2013May 3, 2015) and Go (February 23\u2013June 4, 2017)\u2014sought to present the museum\u2019s holdings in departments including Arts of the Americas, Modern and Contemporary Art, Photography and Media, and Textiles in fresh and exciting ways. Malangatana: Mozambique Modern (July 30\u2013November 16, 2020), the third and final project in the series, expands our understanding of modernism and modern art in a global context by bringing the work of celebrated Mozambican artist Malangatana Ngwenya (1936\u20132011) into conversation with our own international collection. It not only showcases the evolution in style and content within his early paintings and drawings, but also contextualizes his practice within the social and political conditions that framed the emergence of modern art in Mozambique and across the African continent. The exhibition also contributed to the cultivation of a more global perspective on artistic creation and its representation in the museum, both by providing the basis for this publication and, not least, by prompting us to acquire a painting and six works on paper by Malangatana for our permanent collection. Africa and its diasporas, with their deep history and wide geographical reach, occupy a prominent place within global art history and modern art that merits many more such efforts and programs in the years to come. Our colleagues\u2014notably Sarah Guernsey, Ann Goldstein, and Greg Nosan\u2014deserve my sincere gratitude for their continuing critical support for the Modern Series. But I am especially thankful to the exhibition\u2019s curators, Hendrik Folkerts, Felicia Mings, and Constantine Petridis, for introducing our staff and visitors to the fascinating milieu and work of Malangatana Ngwenya and for helping the Art Institute expand its representation of modern art from around the world. This exhibition would not have been possible without the generosity of the individuals and institutions in the United States, Portugal, and Mozambique who lent works from their collections. I am particularly grateful to the Malangatana Valente Ngwenya Foundation in Maputo for its invaluable loan of a significant number of paintings and drawings. Major funding for Malangatana: Mozambique Modern was provided by Sylvia Neil and Dan Fischel and the Alfred L. McDougal and Nancy Lauter McDougal Fund for Contemporary Art. Additional support is contributed by the Society for Contemporary Art through the SCA Activation Fund and the Miriam U. Hoover Foundation. Members of the Luminary Trust provide annual leadership support for the museum\u2019s operations, including exhibition development, conservation and collection care, and educational programming. The Luminary Trust includes an anonymous donor; Neil Bluhm and the Bluhm Family Charitable Foundation; Jay Franke and David Herro; Karen Gray-Krehbiel and John Krehbiel, Jr.; Kenneth Griffin; Caryn and King Harris, The Harris Family Foundation; Josef and Margot Lakonishok; Robert M. and Diane v.S. Levy; Ann and Samuel M. Mencoff; Sylvia Neil and Dan Fischel; Anne and Chris Reyes; Cari and Michael J. Sacks; and the Earl and Brenda Shapiro Foundation. Most importantly, I acknowledge with deepest thanks the intellectual and financial support of Sylvia Neil and Dan Fischel, who have provided crucial funding for the realization of this catalogue as well as the previous two in the Modern Series. Their ongoing commitment has enabled and encouraged our continued explorations into the possibilities of digital publication. James Rondeau President and Eloise W. Martin Director ",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.5"
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
        "total": 126,
        "limit": 2,
        "offset": 0,
        "total_pages": 63,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/printed-catalogs?page=2&limit=2"
    },
    "data": [
        {
            "id": 41,
            "api_model": "printed-catalogs",
            "api_link": "https://api.artic.edu/api/v1/printed-catalogs/41",
            "title": "2001: Building for Space Travel",
            "web_url": "https://nocache.www.artic.edu/print-publications/41/2001-building-for-space-travel",
            "copy": " This book accompanied a pathbreaking exhibition devoted to exploring the relationship between the products actually designed for space flight and the imaginary visions of such materials in science fiction, films, and television. Recognizing the contributions of architects and design professionals to space exploration and technology, a field generally associated with scientists and aerospace engineers, this publication includes color reproductions of approximately 150 objects. Photographs, models, computer-assisted drawings and renderings as well as selected artifacts of the space age document the dreams and realities of design for space travel. An introduction by Art Institute architecture curator John Zukowsky illuminates the historical contexts in which space technology and fantasy developed. This is followed by 13 brief essays addressing topics as diverse as the future of space tourism, the interior design of Skylab, the training of Soviet cosmonauts, and Norman Rockwell's painting The Longest Step . This book offers readers a broader understanding of how designs for space travel are informed by military, political, and scientific imperatives, and how space travel itself provides raw material for art, literature, and film.   Edited by John Zukowsky   192 pages, 9 3/8 x 11 13/16 in. 230 ills. Out of print ISBN: 978-0-810-94490-9 (hardcover) ",
            ...
        },
        {
            "id": 39,
            "api_model": "printed-catalogs",
            "api_link": "https://api.artic.edu/api/v1/printed-catalogs/39",
            "title": "1945: Creativity and Crisis, Chicago Architecture and Design of the World War II Era",
            "web_url": "https://nocache.www.artic.edu/print-publications/39/1945-creativity-and-crisis-chicago-architecture-and-design-of-the-world-war-ii-era",
            "copy": " One of the most important years in modern history, 1945 marked the end of a conflict that united many Western democracies and some communist adversaries in a struggle for survival against the Axis powers led by Germany, Italy, and Japan. Although the sociopolitical impact of World War II is the subject of numerous books, films, lectures, and television shows, the contribution to the war effort by visual arts professionals\u2014artists, architects, and industrial designers\u2014has been barely touched upon. This publication outlines the work of several practitioners, many of whom worked in and around the Chicago area, during and immediately after the war. Architects Bruce Goff, Bertrand Goldberg, Ludwig Mies van der Rohe, and L. Morgan Yost, and designers Henry P. Glass and Richard Ten Eyck are featured, showcasing a vast range of ideas on prefabricated structures, cost- and material-efficient housing, and functional design objects. Presented to coincide with the 60th anniversary of the end of World War II, this catalogue elucidates that architects and designers put their creativity to work in the war effort, and, at the war\u2019s end, helped rebuild respective environments into a new society.   John Zukowsky, Martha Thorne, Carissa Kowalski, Marta Wojcik, Lori Hanna Boyer, and Kay Manning   40 pages; 9 1/2 x 8 1/2 in. 35 ills. Out of print ISBN 0-86559-218-7 (softcover) ",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.5"
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
        "total": 126,
        "limit": 10,
        "offset": 0,
        "total_pages": 13,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "printed-catalogs",
            "api_link": "https://api.artic.edu/api/v1/printed-catalogs/205",
            "id": 205,
            "title": "Cezanne",
            "timestamp": "2022-09-21T23:27:12-05:00"
        },
        {
            "_score": 1,
            "api_model": "printed-catalogs",
            "api_link": "https://api.artic.edu/api/v1/printed-catalogs/58",
            "id": 58,
            "title": "The Age of French Impressionism: Masterpieces from the Art Institute of Chicago",
            "timestamp": "2022-09-21T23:27:12-05:00"
        },
        {
            "_score": 1,
            "api_model": "printed-catalogs",
            "api_link": "https://api.artic.edu/api/v1/printed-catalogs/20",
            "id": 20,
            "title": "Miniature Rooms: The Thorne Rooms at the Art Institute of Chicago",
            "timestamp": "2022-09-21T23:27:12-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.5"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "web_url": "https://nocache.www.artic.edu/print-publications/4/the-art-institute-of-chicago-the-essential-guide",
        "copy": " The Essential Guide presents the diverse holdings of the Art Institute\u2019s collections. Featuring more than three hundred objects, it provides a journey through time\u2014from ancient Egypt until the present day\u2014and across the globe. Beautifully illustrated with short texts about each work, the publication includes beloved icons such as Georges Seurat\u2019s Sunday on La Grande Jatte\u20141884 and Edward Hopper\u2019s Nighthawks , as well as exciting recent acquisitions like a Teotihuacan shell mask, Marcel Duchamp\u2019s readymade Bottle Rack , and Thomas Hart Benton\u2019s Cotton Pickers . Read about objects currently on view in the galleries as well as exquisite textiles and works on paper that, because of the fragility of their materials, are less frequently shown. Use it as a guide to the museum or a souvenir of your visit. Four distinctive covers\u2014one great book! Choose your favorite cover image by Katsushika Hokusai, Archibald Motley Jr., Georgia O\u2019Keeffe, or Georges Seurat.   Foreword by James Rondeau   352 pages, 6 x 9 x 1 in. 335 color ills. Softcover $25 ($22.50 members) ISBN 978-0-86559-301-5 ",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.5"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
    }
}
```
:::

