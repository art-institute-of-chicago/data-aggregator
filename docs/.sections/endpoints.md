## Endpoints

### Collections

#### Artworks

_The `description` field in this response is licensed under a Creative Commons Attribution 4.0 Generic License (CC-By) and the Terms and Conditions of artic.edu. All other data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu._

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
        "total": 132747,
        "limit": 2,
        "offset": 0,
        "total_pages": 66374,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/artworks?page=2&limit=2"
    },
    "data": [
        {
            "id": 274568,
            "api_model": "artworks",
            "api_link": "https://api.artic.edu/api/v1/artworks/274568",
            "is_boosted": false,
            "title": "Machine Boys",
            "alt_titles": null,
            ...
        },
        {
            "id": 283236,
            "api_model": "artworks",
            "api_link": "https://api.artic.edu/api/v1/artworks/283236",
            "is_boosted": false,
            "title": "Tucumcari, from the series Roads Well Traveled: Route 66",
            "alt_titles": null,
            ...
        }
    ],
    "info": {
        "license_text": "The `description` field in this response is licensed under a Creative Commons Attribution 4.0 Generic License (CC-By) and the Terms and Conditions of artic.edu. All other data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.16"
    },
    "config": {
        "iiif_url": "https://www-test.artic.edu/iiif/2",
        "website_url": "https://www-test.artic.edu"
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
        "total": 133118,
        "limit": 10,
        "offset": 0,
        "total_pages": 13312,
        "current_page": 1
    },
    "data": [
        {
            "_score": 129.94258,
            "id": 16568,
            "api_model": "artworks",
            "api_link": "https://api.artic.edu/api/v1/artworks/16568",
            "is_boosted": true,
            "title": "Water Lilies",
            "thumbnail": {
                "lqip": "data:image/gif;base64,R0lGODlhBQAFAPQAAEZcaFFfdVtqbk9ldFBlcVFocllrcFlrd11rdl9sdFZtf15wcWV0d2R2eGByfmd6eGl6e2t9elZxiGF4kWB4kmJ9kGJ8lWeCkWSAnQAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAAAAAAALAAAAAAFAAUAAAUVoJBADXI4TLRMWHU9hmRRCjAURBACADs=",
                "width": 8808,
                "height": 8460,
                "alt_text": "Painting of a pond seen up close spotted with thickly painted pink and white water lilies and a shadow across the top third of the picture."
            },
            "timestamp": "2026-09-22T22:14:18-05:00"
        },
        {
            "_score": 120.392235,
            "id": 16571,
            "api_model": "artworks",
            "api_link": "https://api.artic.edu/api/v1/artworks/16571",
            "is_boosted": true,
            "title": "Arrival of the Normandy Train, Gare Saint-Lazare",
            "thumbnail": {
                "lqip": "data:image/gif;base64,R0lGODlhBwAFAPUAADU8QkROS0ZPU0hSVk1YXVFWUlBXXlFaWVNcWFFkV1plVVtjWmBnWmFqXmRrX05ZYFFaYlljbF5qbGNsY2ZydmlzdWRxeGdze2l1fWx3fG16enJ4fH+KioWOkZeam5yjqZ2lqrG1ubS6vwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAAAAAAALAAAAAAHAAUAAAYhQIKmYslQDoONp8ORBECi0OfyKEAMmAhAgFhMHA2GIhEEADs=",
                "width": 6786,
                "height": 5092,
                "alt_text": "Loosely painted image of an open-air train station. On the right, a parked train gives off an enormous plumb of white smoke, making the scene look as though it were full of clouds. A huddled mass of barely discernible people crowd around the train on both sides of the tracks. Blue, green, and gray tones dominate."
            },
            "timestamp": "2026-09-23T03:32:17-05:00"
        },
        {
            "_score": 119.06504,
            "id": 64818,
            "api_model": "artworks",
            "api_link": "https://api.artic.edu/api/v1/artworks/64818",
            "is_boosted": true,
            "title": "Stacks of Wheat (End of Summer)",
            "thumbnail": {
                "lqip": "data:image/gif;base64,R0lGODlhCAAFAPUAAF5eVW1bVm9eVmpjW3RoXXxyV39yXmdsZmhmaXZtbG11eH57eYl5bYR7dHuAf4mDfo6HfpePdpCFeZSOfJ+VdnZ+g4ODgoCHg4iHgo+GgY2MgpmThJeTipaSjaCcmbWnh6qrpKmopqqtrKusrbGxobq4pLu5qq2zsQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAAAAAAALAAAAAAIAAUAAAYlwJNoFAKRSiZPh7OZRCgfBWJwAAQEBU2D8VgkCAYI5uKoWDKSIAA7",
                "width": 6884,
                "height": 4068,
                "alt_text": "Painting composed of short, dense brushstrokes depicts two domed stacks of wheat that cast long shadows on a field. The angled light indicates either a rising or setting sun."
            },
            "timestamp": "2026-09-22T22:30:35-05:00"
        }
    ],
    "info": {
        "license_text": "The `description` field in this response is licensed under a Creative Commons Attribution 4.0 Generic License (CC-By) and the Terms and Conditions of artic.edu. All other data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.15"
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
        "license_text": "The `description` field in this response is licensed under a Creative Commons Attribution 4.0 Generic License (CC-By) and the Terms and Conditions of artic.edu. All other data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.16"
    },
    "config": {
        "iiif_url": "https://www-test.artic.edu/iiif/2",
        "website_url": "https://www-test.artic.edu"
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
            "value": "47.2 \u00d7 34.5 cm (18 5/8 \u00d7 13 5/8 in.)"
        },
        {
            "label": "Object Number",
            "value": "1880.1"
        },
        {
            "label": "Collection",
            "value": "<a href='https://www-test.artic.edu/collection' target='_blank'>Art Institute of Chicago</a>"
        },
        "..."
    ],
    "attribution": "Digital image courtesy of the Art Institute of Chicago.",
    "logo": "https://raw.githubusercontent.com/Art-Institute-of-Chicago/template/main/aic-logo.gif",
    "within": "https://www-test.artic.edu/collection",
    "rendering": {
        "@id": "https://www-test.artic.edu/artworks/4",
        "format": "text/html",
        "label": "Full record"
    },
    "sequences": [
        {
            "@type": "sc:Sequence",
            "canvases": [
                {
                    "@type": "sc:Canvas",
                    "@id": "https://www-test.artic.edu/iiif/2/1753b638-d4fb-8e45-3db9-92dde7f053da",
                    "label": "Priest and Boy, n.d.. Lawrence Carmichael Earle, American, 1845-1921",
                    "width": 843,
                    "height": 1162,
                    "images": [
                        {
                            "@type": "oa:Annotation",
                            "motivation": "sc:painting",
                            "on": "https://www-test.artic.edu/iiif/2/1753b638-d4fb-8e45-3db9-92dde7f053da",
                            "resource": {
                                "@type": "dctypes:Image",
                                "@id": "https://www-test.artic.edu/iiif/2/1753b638-d4fb-8e45-3db9-92dde7f053da/full/843,/0/default.jpg",
                                "width": 843,
                                "height": 1162,
                                "service": {
                                    "@context": "http://iiif.io/api/image/2/context.json",
                                    "@id": "https://www-test.artic.edu/iiif/2/1753b638-d4fb-8e45-3db9-92dde7f053da",
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
        "total": 16973,
        "limit": 2,
        "offset": 0,
        "total_pages": 8487,
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
        "version": "1.16"
    },
    "config": {
        "iiif_url": "https://www-test.artic.edu/iiif/2",
        "website_url": "https://www-test.artic.edu"
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
        "total": 17007,
        "limit": 10,
        "offset": 0,
        "total_pages": 1701,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "id": 36217,
            "api_model": "agents",
            "api_link": "https://api.artic.edu/api/v1/agents/36217",
            "title": "Andrew Plimer",
            "timestamp": "2026-09-23T15:04:12-05:00"
        },
        {
            "_score": 1,
            "id": 36218,
            "api_model": "agents",
            "api_link": "https://api.artic.edu/api/v1/agents/36218",
            "title": "Nathaniel Plimer",
            "timestamp": "2026-09-23T15:04:12-05:00"
        },
        {
            "_score": 1,
            "id": 36219,
            "api_model": "agents",
            "api_link": "https://api.artic.edu/api/v1/agents/36219",
            "title": "David Plowden",
            "timestamp": "2026-09-23T15:04:12-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.15"
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
            "Decorative Arts Society",
            "Chicago Society of Decorative Art"
        ],
        ...
    },
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.16"
    },
    "config": {
        "iiif_url": "https://www-test.artic.edu/iiif/2",
        "website_url": "https://www-test.artic.edu"
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
        "total": 4185,
        "limit": 2,
        "offset": 0,
        "total_pages": 2093,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/places?page=2&limit=2"
    },
    "data": [
        {
            "id": 22107,
            "api_model": "places",
            "api_link": "https://api.artic.edu/api/v1/places/22107",
            "title": "Ancient Italy",
            "latitude": null,
            "longitude": null,
            ...
        },
        {
            "id": 31045,
            "api_model": "places",
            "api_link": "https://api.artic.edu/api/v1/places/31045",
            "title": "Passamaquoddy Indian Township Reservation",
            "latitude": 45.2413,
            "longitude": -67.5905,
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Attribution 4.0 Generic License (CC-By) and the Terms and Conditions of artic.edu. Contains information from the J. Paul Getty Trust, Getty Research Institute, the Getty Thesaurus of Geographic Names, which is made available under the ODC Attribution License.",
        "license_links": [
            "https://creativecommons.org/licenses/by/4.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.16"
    },
    "config": {
        "iiif_url": "https://www-test.artic.edu/iiif/2",
        "website_url": "https://www-test.artic.edu"
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
        "total": 4186,
        "limit": 10,
        "offset": 0,
        "total_pages": 419,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "id": -2147483613,
            "api_model": "places",
            "api_link": "https://api.artic.edu/api/v1/places/-2147483613",
            "title": "Peoria",
            "timestamp": "2026-02-24T12:08:38-06:00"
        },
        {
            "_score": 1,
            "id": -2147483581,
            "api_model": "places",
            "api_link": "https://api.artic.edu/api/v1/places/-2147483581",
            "title": "Askov",
            "timestamp": "2026-02-24T12:08:38-06:00"
        },
        {
            "_score": 1,
            "id": -2147483534,
            "api_model": "places",
            "api_link": "https://api.artic.edu/api/v1/places/-2147483534",
            "title": "Z\u00fcrich",
            "timestamp": "2026-02-24T12:08:38-06:00"
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Attribution 4.0 Generic License (CC-By) and the Terms and Conditions of artic.edu. Contains information from the J. Paul Getty Trust, Getty Research Institute, the Getty Thesaurus of Geographic Names, which is made available under the ODC Attribution License.",
        "license_links": [
            "https://creativecommons.org/licenses/by/4.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.15"
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
            "https://creativecommons.org/licenses/by/4.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.16"
    },
    "config": {
        "iiif_url": "https://www-test.artic.edu/iiif/2",
        "website_url": "https://www-test.artic.edu"
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
        "total": 179,
        "limit": 2,
        "offset": 0,
        "total_pages": 90,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/galleries?page=2&limit=2"
    },
    "data": [
        {
            "id": 2147480090,
            "api_model": "galleries",
            "api_link": "https://api.artic.edu/api/v1/galleries/2147480090",
            "title": "Gallery 107",
            "latitude": 41.879392721931,
            "longitude": -87.623461169312,
            ...
        },
        {
            "id": 2147473659,
            "api_model": "galleries",
            "api_link": "https://api.artic.edu/api/v1/galleries/2147473659",
            "title": "Michigan Avenue entrance/steps",
            "latitude": 41.879586,
            "longitude": -87.62398,
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.16"
    },
    "config": {
        "iiif_url": "https://www-test.artic.edu/iiif/2",
        "website_url": "https://www-test.artic.edu"
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
        "total": 4,
        "limit": 10,
        "offset": 0,
        "total_pages": 1,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "id": 2147480090,
            "api_model": "galleries",
            "api_link": "https://api.artic.edu/api/v1/galleries/2147480090",
            "title": "Gallery 107",
            "timestamp": "2026-09-23T03:20:28-05:00"
        },
        {
            "_score": 1,
            "id": 2147483633,
            "api_model": "galleries",
            "api_link": "https://api.artic.edu/api/v1/galleries/2147483633",
            "title": "Gallery 206",
            "timestamp": "2026-09-23T03:20:28-05:00"
        },
        {
            "_score": 1,
            "id": 2147478068,
            "api_model": "galleries",
            "api_link": "https://api.artic.edu/api/v1/galleries/2147478068",
            "title": "Gallery 272",
            "timestamp": "2026-09-22T03:15:22-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.15"
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
        "version": "1.16"
    },
    "config": {
        "iiif_url": "https://www-test.artic.edu/iiif/2",
        "website_url": "https://www-test.artic.edu"
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
        "total": 6552,
        "limit": 2,
        "offset": 0,
        "total_pages": 3276,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/exhibitions?page=2&limit=2"
    },
    "data": [
        {
            "id": 3365,
            "api_model": "exhibitions",
            "api_link": "https://api.artic.edu/api/v1/exhibitions/3365",
            "title": "John Massey: Cart\u00f3n de Venezuela",
            "is_featured": false,
            "position": -1,
            ...
        },
        {
            "id": 3251,
            "api_model": "exhibitions",
            "api_link": "https://api.artic.edu/api/v1/exhibitions/3251",
            "title": "Four Followers of Caravaggio",
            "is_featured": false,
            "position": -1,
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.16"
    },
    "config": {
        "iiif_url": "https://www-test.artic.edu/iiif/2",
        "website_url": "https://www-test.artic.edu"
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
        "total": 6553,
        "limit": 10,
        "offset": 0,
        "total_pages": 656,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "id": 7613,
            "api_model": "exhibitions",
            "api_link": "https://api.artic.edu/api/v1/exhibitions/7613",
            "title": "Photographs by Walter Peterhans",
            "timestamp": "2026-02-24T12:09:49-06:00"
        },
        {
            "_score": 1,
            "id": 7614,
            "api_model": "exhibitions",
            "api_link": "https://api.artic.edu/api/v1/exhibitions/7614",
            "title": "Art Student's League: Exhibition by New Members",
            "timestamp": "2026-02-24T12:09:49-06:00"
        },
        {
            "_score": 1,
            "id": 7615,
            "api_model": "exhibitions",
            "api_link": "https://api.artic.edu/api/v1/exhibitions/7615",
            "title": "American Glass",
            "timestamp": "2026-02-24T12:09:49-06:00"
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.15"
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
        "position": -1,
        ...
    },
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.16"
    },
    "config": {
        "iiif_url": "https://www-test.artic.edu/iiif/2",
        "website_url": "https://www-test.artic.edu"
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
        "version": "1.16"
    },
    "config": {
        "iiif_url": "https://www-test.artic.edu/iiif/2",
        "website_url": "https://www-test.artic.edu"
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
        "version": "1.16"
    },
    "config": {
        "iiif_url": "https://www-test.artic.edu/iiif/2",
        "website_url": "https://www-test.artic.edu"
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
        "total": 163,
        "limit": 2,
        "offset": 0,
        "total_pages": 82,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/agent-roles?page=2&limit=2"
    },
    "data": [
        {
            "id": 575,
            "api_model": "agent-roles",
            "api_link": "https://api.artic.edu/api/v1/agent-roles/575",
            "title": "Ceramist",
            "source_updated_at": "2023-05-04T16:32:56-05:00",
            "updated_at": "2023-05-04T16:37:23-05:00",
            ...
        },
        {
            "id": 434,
            "api_model": "agent-roles",
            "api_link": "https://api.artic.edu/api/v1/agent-roles/434",
            "title": "Craftsperson",
            "source_updated_at": "2020-06-24T16:02:14-05:00",
            "updated_at": "2020-06-24T21:00:33-05:00",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.16"
    },
    "config": {
        "iiif_url": "https://www-test.artic.edu/iiif/2",
        "website_url": "https://www-test.artic.edu"
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
        "version": "1.16"
    },
    "config": {
        "iiif_url": "https://www-test.artic.edu/iiif/2",
        "website_url": "https://www-test.artic.edu"
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
            "id": 50,
            "api_model": "artwork-place-qualifiers",
            "api_link": "https://api.artic.edu/api/v1/artwork-place-qualifiers/50",
            "title": "Place depicted:",
            "source_updated_at": "1976-09-02T11:20:00-05:00",
            "updated_at": "2025-02-19T17:23:33-06:00",
            ...
        },
        {
            "id": 1,
            "api_model": "artwork-place-qualifiers",
            "api_link": "https://api.artic.edu/api/v1/artwork-place-qualifiers/1",
            "title": "Building address:",
            "source_updated_at": "1976-09-02T11:20:00-05:00",
            "updated_at": "2025-02-19T17:23:33-06:00",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.16"
    },
    "config": {
        "iiif_url": "https://www-test.artic.edu/iiif/2",
        "website_url": "https://www-test.artic.edu"
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
        "title": "Building address:",
        "source_updated_at": "1976-09-02T11:20:00-05:00",
        "updated_at": "2025-02-19T17:23:33-06:00",
        ...
    },
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.16"
    },
    "config": {
        "iiif_url": "https://www-test.artic.edu/iiif/2",
        "website_url": "https://www-test.artic.edu"
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
        "total": 34,
        "limit": 2,
        "offset": 0,
        "total_pages": 17,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/artwork-date-qualifiers?page=2&limit=2"
    },
    "data": [
        {
            "id": 65,
            "api_model": "artwork-date-qualifiers",
            "api_link": "https://api.artic.edu/api/v1/artwork-date-qualifiers/65",
            "title": "Created",
            "source_updated_at": "2025-10-30T14:25:45-05:00",
            "updated_at": "2025-10-30T14:28:58-05:00",
            ...
        },
        {
            "id": 64,
            "api_model": "artwork-date-qualifiers",
            "api_link": "https://api.artic.edu/api/v1/artwork-date-qualifiers/64",
            "title": "Recreated",
            "source_updated_at": "2025-10-30T14:25:34-05:00",
            "updated_at": "2025-10-30T14:28:58-05:00",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.16"
    },
    "config": {
        "iiif_url": "https://www-test.artic.edu/iiif/2",
        "website_url": "https://www-test.artic.edu"
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
        "version": "1.16"
    },
    "config": {
        "iiif_url": "https://www-test.artic.edu/iiif/2",
        "website_url": "https://www-test.artic.edu"
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
        "total": 45,
        "limit": 2,
        "offset": 0,
        "total_pages": 23,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/artwork-types?page=2&limit=2"
    },
    "data": [
        {
            "id": 49,
            "api_model": "artwork-types",
            "api_link": "https://api.artic.edu/api/v1/artwork-types/49",
            "title": "TBM Equipment",
            "aat_id": null,
            "source_updated_at": "2026-03-18T16:23:57-05:00",
            ...
        },
        {
            "id": 1,
            "api_model": "artwork-types",
            "api_link": "https://api.artic.edu/api/v1/artwork-types/1",
            "title": "Painting",
            "aat_id": 300033618,
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
        "version": "1.16"
    },
    "config": {
        "iiif_url": "https://www-test.artic.edu/iiif/2",
        "website_url": "https://www-test.artic.edu"
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
        "version": "1.16"
    },
    "config": {
        "iiif_url": "https://www-test.artic.edu/iiif/2",
        "website_url": "https://www-test.artic.edu"
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
        "total": 11033,
        "limit": 2,
        "offset": 0,
        "total_pages": 5517,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/category-terms?page=2&limit=2"
    },
    "data": [
        {
            "id": "TM-16635",
            "api_model": "category-terms",
            "api_link": "https://api.artic.edu/api/v1/category-terms/TM-16635",
            "title": "buttons",
            "subtype": "subject",
            "parent_id": null,
            ...
        },
        {
            "id": "TM-16634",
            "api_model": "category-terms",
            "api_link": "https://api.artic.edu/api/v1/category-terms/TM-16634",
            "title": "buttons",
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
        "version": "1.16"
    },
    "config": {
        "iiif_url": "https://www-test.artic.edu/iiif/2",
        "website_url": "https://www-test.artic.edu"
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
        "total": 11034,
        "limit": 10,
        "offset": 0,
        "total_pages": 1104,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "id": "TM-11203",
            "api_model": "category-terms",
            "api_link": "https://api.artic.edu/api/v1/category-terms/TM-11203",
            "title": "swags",
            "timestamp": "2026-02-24T12:10:22-06:00"
        },
        {
            "_score": 1,
            "id": "TM-11204",
            "api_model": "category-terms",
            "api_link": "https://api.artic.edu/api/v1/category-terms/TM-11204",
            "title": "fruit",
            "timestamp": "2026-02-24T12:10:22-06:00"
        },
        {
            "_score": 1,
            "id": "TM-11205",
            "api_model": "category-terms",
            "api_link": "https://api.artic.edu/api/v1/category-terms/TM-11205",
            "title": "trees",
            "timestamp": "2026-02-24T12:10:22-06:00"
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.15"
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
        "version": "1.16"
    },
    "config": {
        "iiif_url": "https://www-test.artic.edu/iiif/2",
        "website_url": "https://www-test.artic.edu"
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
        "total": 187487,
        "limit": 2,
        "offset": 0,
        "total_pages": 93744,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/images?page=2&limit=2"
    },
    "data": [
        {
            "id": "87d79e05-f1d2-f288-c9dd-af0c508ba811",
            "lake_guid": "87d79e05-f1d2-f288-c9dd-af0c508ba811",
            "api_model": "images",
            "api_link": "https://api.artic.edu/api/v1/images/87d79e05-f1d2-f288-c9dd-af0c508ba811",
            "title": "J38164-int",
            "type": "image",
            ...
        },
        {
            "id": "f59fa19c-0765-ea18-87a0-e1d0aafa9a7b",
            "lake_guid": "f59fa19c-0765-ea18-87a0-e1d0aafa9a7b",
            "api_model": "images",
            "api_link": "https://api.artic.edu/api/v1/images/f59fa19c-0765-ea18-87a0-e1d0aafa9a7b",
            "title": "J37558-int",
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
        "version": "1.16"
    },
    "config": {
        "iiif_url": "https://www-test.artic.edu/iiif/2",
        "website_url": "https://www-test.artic.edu"
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
        "total": 187517,
        "limit": 10,
        "offset": 0,
        "total_pages": 18752,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "id": "347c8c03-2424-2ded-7657-07efc7f29ca3",
            "api_model": "images",
            "api_link": "https://api.artic.edu/api/v1/images/347c8c03-2424-2ded-7657-07efc7f29ca3",
            "title": "PD_070714_11",
            "timestamp": "2026-02-24T12:15:06-06:00"
        },
        {
            "_score": 1,
            "id": "c4ed70c7-dc98-2407-0127-764b518a110e",
            "api_model": "images",
            "api_link": "https://api.artic.edu/api/v1/images/c4ed70c7-dc98-2407-0127-764b518a110e",
            "title": "PD_070714_01",
            "timestamp": "2026-02-24T12:15:07-06:00"
        },
        {
            "_score": 1,
            "id": "6bb0caca-5a34-bd67-13e1-c61e0f6e4373",
            "api_model": "images",
            "api_link": "https://api.artic.edu/api/v1/images/6bb0caca-5a34-bd67-13e1-c61e0f6e4373",
            "title": "PD_09489-int",
            "timestamp": "2026-02-24T12:15:09-06:00"
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.15"
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
        "version": "1.16"
    },
    "config": {
        "iiif_url": "https://www-test.artic.edu/iiif/2",
        "website_url": "https://www-test.artic.edu"
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
        "total": 1,
        "limit": 2,
        "offset": 0,
        "total_pages": 1,
        "current_page": 1
    },
    "data": [
        {
            "id": "fae3fdc2-7a52-5fc4-c634-c2033f9b2a46",
            "lake_guid": "fae3fdc2-7a52-5fc4-c634-c2033f9b2a46",
            "api_model": "videos",
            "api_link": "https://api.artic.edu/api/v1/videos/fae3fdc2-7a52-5fc4-c634-c2033f9b2a46",
            "title": "Skeele_FruitPiece_Essentials_Main",
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
        "version": "1.16"
    },
    "config": {
        "iiif_url": "https://www-test.artic.edu/iiif/2",
        "website_url": "https://www-test.artic.edu"
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
        "total": 1,
        "limit": 10,
        "offset": 0,
        "total_pages": 1,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "id": "fae3fdc2-7a52-5fc4-c634-c2033f9b2a46",
            "api_model": "videos",
            "api_link": "https://api.artic.edu/api/v1/videos/fae3fdc2-7a52-5fc4-c634-c2033f9b2a46",
            "title": "Skeele_FruitPiece_Essentials_Main",
            "timestamp": "2026-04-28T16:58:16-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.15"
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

::: details Example request: https://api.artic.edu/api/v1/videos/fae3fdc2-7a52-5fc4-c634-c2033f9b2a46  
```js
{
    "data": {
        "id": "fae3fdc2-7a52-5fc4-c634-c2033f9b2a46",
        "lake_guid": "fae3fdc2-7a52-5fc4-c634-c2033f9b2a46",
        "api_model": "videos",
        "api_link": "https://api.artic.edu/api/v1/videos/fae3fdc2-7a52-5fc4-c634-c2033f9b2a46",
        "title": "Skeele_FruitPiece_Essentials_Main",
        "type": "video",
        ...
    },
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.16"
    },
    "config": {
        "iiif_url": "https://www-test.artic.edu/iiif/2",
        "website_url": "https://www-test.artic.edu"
    }
}
```
:::

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
        "total": 1366,
        "limit": 2,
        "offset": 0,
        "total_pages": 683,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/sounds?page=2&limit=2"
    },
    "data": [
        {
            "id": "fcfb9bd0-18b0-96d2-a34f-f8cb17843a36",
            "lake_guid": "fcfb9bd0-18b0-96d2-a34f-f8cb17843a36",
            "api_model": "sounds",
            "api_link": "https://api.artic.edu/api/v1/sounds/fcfb9bd0-18b0-96d2-a34f-f8cb17843a36",
            "title": "RETIRED Statuette Of A Striding Figure 206785",
            "type": "sound",
            ...
        },
        {
            "id": "bdd6f8fd-438f-1725-c362-22508f1a7efd",
            "lake_guid": "bdd6f8fd-438f-1725-c362-22508f1a7efd",
            "api_model": "sounds",
            "api_link": "https://api.artic.edu/api/v1/sounds/bdd6f8fd-438f-1725-c362-22508f1a7efd",
            "title": "Paradise Lost 10569",
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
        "version": "1.16"
    },
    "config": {
        "iiif_url": "https://www-test.artic.edu/iiif/2",
        "website_url": "https://www-test.artic.edu"
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
        "total": 1366,
        "limit": 10,
        "offset": 0,
        "total_pages": 137,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "id": "c0be80f0-8195-19e7-f3bb-ef7e2fcf86fa",
            "api_model": "sounds",
            "api_link": "https://api.artic.edu/api/v1/sounds/c0be80f0-8195-19e7-f3bb-ef7e2fcf86fa",
            "title": "Audio stop 558.mp3",
            "timestamp": "2026-02-24T12:20:52-06:00"
        },
        {
            "_score": 1,
            "id": "d47a64ac-bef9-06d5-bc16-ad26cd906711",
            "api_model": "sounds",
            "api_link": "https://api.artic.edu/api/v1/sounds/d47a64ac-bef9-06d5-bc16-ad26cd906711",
            "title": "ARCHIVED__VerandaPostOld_102611.mp3",
            "timestamp": "2026-02-24T12:20:54-06:00"
        },
        {
            "_score": 1,
            "id": "604f4bb5-e08d-574f-3e8e-078829e08507",
            "api_model": "sounds",
            "api_link": "https://api.artic.edu/api/v1/sounds/604f4bb5-e08d-574f-3e8e-078829e08507",
            "title": "ARCHIVED_StacksOfWheatEndOfSummer_S64818.mp3",
            "timestamp": "2026-02-24T12:20:54-06:00"
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.15"
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
        "version": "1.16"
    },
    "config": {
        "iiif_url": "https://www-test.artic.edu/iiif/2",
        "website_url": "https://www-test.artic.edu"
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
        "total": 3879,
        "limit": 2,
        "offset": 0,
        "total_pages": 1940,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/texts?page=2&limit=2"
    },
    "data": [
        {
            "id": "e99dec8d-34e6-3027-3dac-10ac43036d6d",
            "lake_guid": "e99dec8d-34e6-3027-3dac-10ac43036d6d",
            "api_model": "texts",
            "api_link": "https://api.artic.edu/api/v1/texts/e99dec8d-34e6-3027-3dac-10ac43036d6d",
            "title": "D18547_02",
            "type": "text",
            ...
        },
        {
            "id": "574615e9-7162-7e40-462b-9af2c55cb961",
            "lake_guid": "574615e9-7162-7e40-462b-9af2c55cb961",
            "api_model": "texts",
            "api_link": "https://api.artic.edu/api/v1/texts/574615e9-7162-7e40-462b-9af2c55cb961",
            "title": "D18547_13",
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
        "version": "1.16"
    },
    "config": {
        "iiif_url": "https://www-test.artic.edu/iiif/2",
        "website_url": "https://www-test.artic.edu"
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
        "total": 3895,
        "limit": 10,
        "offset": 0,
        "total_pages": 390,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "id": "68bff8f4-a6a0-6328-39d5-bc83d8c8830c",
            "api_model": "texts",
            "api_link": "https://api.artic.edu/api/v1/texts/68bff8f4-a6a0-6328-39d5-bc83d8c8830c",
            "title": "Artwork Resource Packet: <em>Head of Xilonen, Goddess of Young Maize</em>",
            "timestamp": "2026-02-24T12:20:56-06:00"
        },
        {
            "_score": 1,
            "id": "7f9dd3d7-f28b-e338-70d3-903dd16c8b84",
            "api_model": "texts",
            "api_link": "https://api.artic.edu/api/v1/texts/7f9dd3d7-f28b-e338-70d3-903dd16c8b84",
            "title": "Educator Resource Packet: <em>The Return of Odysseus (Homage to Pintoricchio and Benin)</em> by Romare Bearden",
            "timestamp": "2026-02-24T12:20:56-06:00"
        },
        {
            "_score": 1,
            "id": "2ae8156f-4012-34cb-e470-bd3f4aa334f1",
            "api_model": "texts",
            "api_link": "https://api.artic.edu/api/v1/texts/2ae8156f-4012-34cb-e470-bd3f4aa334f1",
            "title": "Educator Resource Packet: <em>Untitled (H\u00f4tel de la Duchesse-Anne)</em> by Joseph Cornell",
            "timestamp": "2026-02-24T12:20:56-06:00"
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.15"
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
        "version": "1.16"
    },
    "config": {
        "iiif_url": "https://www-test.artic.edu/iiif/2",
        "website_url": "https://www-test.artic.edu"
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
        "total": 2619,
        "limit": 2,
        "offset": 0,
        "total_pages": 1310,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/products?page=2&limit=2"
    },
    "data": [
        {
            "id": 292498,
            "api_model": "products",
            "api_link": "https://api.artic.edu/api/v1/products/292498",
            "title": "Edward Gorey Collectible Figure",
            "external_sku": 292498,
            "image_url": "https://shop-images.imgix.net292498_2.jpg",
            ...
        },
        {
            "id": 292468,
            "api_model": "products",
            "api_link": "https://api.artic.edu/api/v1/products/292468",
            "title": "Photographer Enamel Pin",
            "external_sku": 292468,
            "image_url": "https://shop-images.imgix.net292468_2.jpg",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.16"
    },
    "config": {
        "iiif_url": "https://www-test.artic.edu/iiif/2",
        "website_url": "https://www-test.artic.edu"
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
        "total": 2619,
        "limit": 10,
        "offset": 0,
        "total_pages": 262,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "id": 281547,
            "api_model": "products",
            "api_link": "https://api.artic.edu/api/v1/products/281547",
            "title": "Essential Guide",
            "timestamp": "2026-02-24T12:21:11-06:00"
        },
        {
            "_score": 1,
            "id": 281550,
            "api_model": "products",
            "api_link": "https://api.artic.edu/api/v1/products/281550",
            "title": "Essential Guide",
            "timestamp": "2026-02-24T12:21:11-06:00"
        },
        {
            "_score": 1,
            "id": 281641,
            "api_model": "products",
            "api_link": "https://api.artic.edu/api/v1/products/281641",
            "title": "Hairy Who? 1966\u20131969",
            "timestamp": "2026-02-24T12:21:11-06:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.15"
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
        "version": "1.16"
    },
    "config": {
        "iiif_url": "https://www-test.artic.edu/iiif/2",
        "website_url": "https://www-test.artic.edu"
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
            "id": 4721,
            "api_model": "tours",
            "api_link": "https://api.artic.edu/api/v1/tours/4721",
            "title": "Verbal Description Tour: Monet and Chicago",
            "image": "http://aic-mobile-tours.artic.edu/sites/default/files/tour-images/1956.1202%20-%20Irises.jpg",
            "description": "<p>Monet and Chicago is the first exhibition to consider the city\u2019s unique embrace of the Impressionist artist, and celebrates its essential role in fostering modern art in the United States. Loans from Chicagoland collections join works by Monet in the museum's collection, which number more than any other in the country.</p>\n",
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
        "version": "1.16"
    },
    "config": {
        "iiif_url": "https://www-test.artic.edu/iiif/2",
        "website_url": "https://www-test.artic.edu"
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
            "id": 6011,
            "api_model": "tours",
            "api_link": "https://api.artic.edu/api/v1/tours/6011",
            "title": "Verbal Description Tour of Bruce Goff: Material Worlds ",
            "timestamp": "2026-03-29T23:06:21-05:00"
        },
        {
            "_score": 1,
            "id": 6025,
            "api_model": "tours",
            "api_link": "https://api.artic.edu/api/v1/tours/6025",
            "title": "Matisse's Jazz: Rhythms in Color Mini Audio Tour",
            "timestamp": "2026-06-03T23:05:37-05:00"
        },
        {
            "_score": 1,
            "id": 6042,
            "api_model": "tours",
            "api_link": "https://api.artic.edu/api/v1/tours/6042",
            "title": "Korean National Treasures: 2,000 Years of Art Verbal Description Tour",
            "timestamp": "2026-07-06T23:05:41-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.15"
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
        "version": "1.16"
    },
    "config": {
        "iiif_url": "https://www-test.artic.edu/iiif/2",
        "website_url": "https://www-test.artic.edu"
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
        "total": 794,
        "limit": 2,
        "offset": 0,
        "total_pages": 397,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/mobile-sounds?page=2&limit=2"
    },
    "data": [
        {
            "id": 4742,
            "api_model": "mobile-sounds",
            "api_link": "https://api.artic.edu/api/v1/mobile-sounds/4742",
            "title": "Hartwell Memorial Window, and Hartwell Memorial Window",
            "web_url": "https://www.artic.edu/mobile/audio/TiffanyWindow_AudioStop_V6.mp3",
            "transcript": "<p>Elizabeth McGoey: One of the things that I think visitors wouldn\u2019t know about the window when you\u2019re standing in front of it is how deep those glass layers can go. It\u2019s not flat at all.</p>\n<p>[MUSIC]</p>\n<p>Narrator: Associate curator, Liz McGoey.</p>\n<p>Elizabeth McGoey: We see this dazzling landscape, these naturalistic details\u2014the back of the window, in fact, looks like a topographical model, it sort of undulates and changes in size.</p>\n<p>Narrator: Curator, Sarah Kelly Oehler</p>\n<p>Sarah Kelly Oehler: This is actually comprised of 48 panels of glass, but what you don\u2019t see is that each individual panel might be up to five layers thick of glass, sort of pancaked together.</p>\n<p>Narrator: This intricate arrangement of glass comes together in a soaring view of Mount Chocorua in New Hampshire, long the homeland of Algonquin peoples as well as many other Indigenous communities. It is also a landscape that meant a great deal to the family that commissioned this work from Tiffany Studios as a memorial.</p>\n<p>Elizabeth McGoey: This window was a commission made by Mary Hartwell in honor of her husband Fredrick Harwell who was a deacon of the Central Baptist Church in Providence, Rhode Island. Frederick Hartwell was born in New Hampshire and his family had a home there. Even now it still has deep resonance with the family.</p>\n<p>Sarah Kelly Oehler: Mary Hartwell would have chosen Tiffany Studios because, at that time, they were the preeminent maker of glass products.</p>\n<p>Elizabeth McGoey: Louis Comfort Tiffany had started a glass company in 1885, which would then become Tiffany studios. And the firm had become synonymous with technical innovation and radiant brilliance.</p>\n<p>Sarah Kelly Oehler: And the woman who designed this was named Agnes Northrop and she was, in fact, Tiffany Studio\u2019s leading landscape designer</p>\n<p>Elizabeth McGoey: She really had an eye for natural compositions, for how to create well-developed, interesting, intricate passages of foliage and water.</p>\n<p>Narrator: Northrop, Tiffany, and the many talented specialists across the firm were celebrated for their innovations in stained glass. One distinctive example is the leaves of the trees, made of what is appropriately called \u201cfoliage glass.\u201d</p>\n<p>Elizabeth McGoey: Which is where shards of glass are thrown onto another molten color and went through the rollers, where you get this dazzling confetti-like effect that conveys dappled light coming through trees.</p>\n<p>Sarah Kelly Oehler: What they ended up doing was really thinking about how to use the glass itself to achieve different aesthetic effects.</p>\n<p>Narrator: To take in the full complexity and intricacy of the landscape, from the mountain peak to the lush foliage at the waters edge, we encourage you to do some up-close observation as well as from across the room.</p>\n<p>Elizabeth McGoey: It\u2019s a work of deeply resonant beauty. I absolutely can see people coming here and reflecting on time they\u2019ve spent in nature, on remembering a loved one. I think this is a work that will allow that kind of respite, that kind of joy, but also bring a sense of wonder that is unparalleled.</p>\n",
            ...
        },
        {
            "id": 4740,
            "api_model": "mobile-sounds",
            "api_link": "https://api.artic.edu/api/v1/mobile-sounds/4740",
            "title": "Ray Johnson and the Art of Friendship",
            "web_url": "https://www.artic.edu/mobile/audio/Art%20of%20Friendship_V11_Exhb_2.mp3",
            "transcript": "<p>Andrew Meriwether:<br>Art Institute of Chicago presents . . . Hi, there. I'm Andrew Meriwether, I'm a producer here at the Art Institute of Chciago. And I'm very excited to share with you this story about the artist Ray Johnson. There was a point in the 1960s and 70s when everyone in the New York art world seemed to know Ray Johnson, or at least knew someone who knew Ray Johnson. Ray had a gift for creating connections, forming relationships with hundreds, if not thousands, of people. It's like he had this gravitational pull where if you were the right type of person, you would find yourself involved in the strange orbit of Ray without entirely understanding how you got there, but always wanting to know more.</p>\n<p>Andrew Meriwether:<br>And it was through this network of people that Ray ended up creating a massive and diverse body of work. A collection of which will be featured in the exhibition Ray Johnson c/o at the Art Institute. You're going to hear it from several people who knew Ray personally, as well as curators, Caitlin Haskell and Jordan Carter as you learn about the life and work of this artist. Before we go to the story, a note that towards the end of the episode, we do discuss suicide. If you're not interested in hearing that, you may want to skip this one. All right, we now present, What is a Moticos? Ray Johnson's Art of Friendship.</p>\n<p>Henry Martin:<br>Ray one day phoned me and said that he had conjunctivitis and when I accompany him to the eye hospital and I said, &quot;Yes, of course.&quot; So we met at the place where we usually met and got on the bus. And when we got on the bus, Ray had a strange kind of attitude. It was the way he held his body or something. And it became obvious to me that there was something that Ray was not looking at, but what he wanted me to see. And so he looked around and there was an advertisement for a bank. And there was a very distinguished gentleman in a gray suit and a tie who had a silver dollar in his eye as a monochrome. And that's what Ray wanted me to see.</p>\n<p>Henry Martin:<br>And after that, the whole day became a voyage through eye imagery. Ray found it everywhere. He pointed it out everywhere. He didn't point it out, but he directed my attention in ways that allowed me to see these things that he was seeing. He could communicate the quality of his own intention and somehow get you involved in it. It was very mysterious.</p>\n<p>Caitlin Haskell:<br>My name is Caitlin Haskell. I'm the Gary C. and Frances Comer Curator of Modern and Contemporary Art and I'm a co-curator of Ray Johnson c/o. Ray Johnson was born in Detroit in October 1927. He was an only child, raised in a very sort of working class family.</p>\n<p>Jordan Carter:<br>I'm Jordan Carter, associate curator of Modern and Contemporary Art and I'm a co-curator of Ray Johnson c/o. We don't know too much about Ray as a young boy, but we know quite a bit about his high school time.</p>\n<p>Caitlin Haskell:<br>When he was in high school, the program that he was enrolled at a school called Cass Tech. It was specifically for people who knew they wanted to go into the arts. Then, he was taking classes at the same time at Detroit Institute of the Arts and he says in high school, &quot;I'm longing one day for a work of mine to be hanging in the museum.&quot; So it's kind of a very focused path toward becoming an artist in actually a somewhat traditional way, and then he just throws that out the window.</p>\n<p>Caitlin Haskell:<br>Ray Johnson arrives at Black Mountain College in the summer of 1945, which is a place where people were really questioning the social function and value of the arts, how to teach the arts, how to really do different interdisciplinary practices. And he studies there on and off until the summer of '48. After the summer session of '48, he goes out to San Francisco. He spends a really brief amount of time in Pennsylvania. And then he's in New York, living at this place called the Boza Mansion.</p>\n<p>Jordan Carter:<br>The Boza Mansion is really sort of this house where these artists, which is Ray Johnson and also John Cage and I believe, Richard Leopold as well, live together and work together. And each of them was really beginning to champion a very interdisciplinary and experimental way of working.</p>\n<p>Caitlin Haskell:<br>So at this point in time, when he starts to make some collages that are abstract and geometric, which he calls moticos.</p>\n<p>Jordan Carter:<br>A plan where it's an onset of osmotics censored based on motion and movement, and mobility. Fundamentally and materially, they're very base cardboard constructions, and he's doing a lot of sanding and a lot of chopping, and it's really building out of very everyday materials. You can really feel the tactility in them.</p>\n<p>Caitlin Haskell:<br>Ray Johnson writes this manifesto that's called What is a Moticos? He poses it as a question, right? I mean, what the definition of what a moticos is, is something that's in the process of becoming. And he's always sort of saying, &quot;The next time you're riding in a train, look out the window. There might be a moticos.&quot; And the ideas that he's going to work small, the pieces are going to be about 12 inches high, and they're going to be mobile and you can send them to people through the mail.</p>\n<p>Robert Warner:<br>Hello, I'm Bob Warner, friend of Ray Johnson's. It's a great honor to Zoom with you in Chicago. I met Ray Johnson through a postcard that a friend had on a wall. And when I was visiting her, I said, &quot;That's a most curious postal card.&quot; So she took it down from the wall and said that, &quot;That was my friend Ray Johnson for many years ago. I think you might like to know about Ray Johnson, he's a collagist, here's his address.&quot; So I sent off a postal card to Ray Johnson.</p>\n<p>Caitlin Haskell:<br>The first place you see New York Correspondence School printed on a piece of paper is 1963.</p>\n<p>Robert Warner:<br>He sent me a form letter that said, &quot;This is my activity. This is my name. I am Ray Johnson, contact me at 516-676-3150.&quot;</p>\n<p>Jordan Carter:<br>The New York Correspondence School, loosely, is a group of friends and sort of a network of makers who are sending things in the mail and the person who is sort of the primary protagonist and sort of the impresario of this exchange in this network is Ray Johnson.</p>\n<p>Robert Warner:<br>So I called I said, &quot;This is Bob Warner.&quot; And he said, &quot;Do you want to correspond? Do you want to join my school?&quot;</p>\n<p>Jordan Carter:<br>And the New York Correspondence School basically operates around this idea that if you mail something, then something's going to come back to you.</p>\n<p>Coco Gordon:<br>With Ray, it was so simple. Okay. I'm Coco Gordon, Coco Go, and Super Skywoman, all-in-one. Didn't have to do anything, all I did was keep on engaging everything he sent me, I would send back. In spades, he would send me in spades and we kept on going back and forth.</p>\n<p>Jordan Carter:<br>Ray really established the New York Correspondence School by antagonizing, provoking people to respond to his own mailings, getting people to please send something to someone else by virtue of receiving this mail and participating, one nominally sort of becomes a part of the New York Correspondence School.</p>\n<p>Robert Warner:<br>It was like a ping pong game. If you let the ping pong ball drop, I probably wouldn't have heard from him, but because I kept up a back and forth with him, he seemed engaged and I was certainly engaged.</p>\n<p>Jordan Carter:<br>It's hard to describe what a Ray Johnson mailing looks like or feels like because it's essentially diffused. It's so diverse.</p>\n<p>Caitlin Haskell:<br>You might have something on a standard piece of stationery that you could buy at a stationary store.</p>\n<p>Jordan Carter:<br>There could be a rubbing, there could be a collage.</p>\n<p>Caitlin Haskell:<br>You might have a page that was torn out of a magazine with a note relates to the images or the article there.</p>\n<p>Jordan Carter:<br>You could have stitches, you could have fake eyelashes.</p>\n<p>Caitlin Haskell:<br>Blood, cockroach, taped down.</p>\n<p>Jordan Carter:<br>It's impossible to say, what a typical Ray Johnson mailing would be like, because there was nothing typical about it.</p>\n<p>Robert Warner:<br>I kind of like being sent, it was like being a secret agent. Like one day he said, &quot;I sent you a package for Jeff Hendricks.&quot; And I said, &quot;I don't know who Jeff Hendricks is.&quot; And he said, &quot;Well, he lives near you. He lives on Greenwich street.&quot; It was a small package, like a Tupperware with a rusty nail on it. I said, &quot;Does he know I'm coming?&quot; And he said, &quot;Yes, Jeff Hendricks knows that you're coming.&quot; And so I went there, I rang the bell. He went into the kitchen for a moment, came back out, I think with a ball of string or some wine, and gave it back to me. And that was my meeting with Jeff Hendricks.</p>\n<p>Henry Martin:<br>Art had nothing to do with it, or it didn't necessarily have anything to do with it. Okay, well, my name is Henry Martin. I live in Northern Italy, and Ray and I were friends. Well from about 1959, 1960, up until the time of his death, it was all a question of simple communication. It was a game. It was a game in which everybody was finding ways of giving meanings to things.</p>\n<p>Jordan Carter:<br>In many ways, you could see the New York Correspondence School as really kind of being synonymous with Ray Johnson. The people who participated in the New York Correspondence School, they were interested in what this weird quirky kind of bizarre, sort of agitator was doing. What is he going to do next? Why else would somebody go through all of these lanes to participate and what is basically sort of chain mail. It's because there's something really inspiring about it, or there's something that you want to be closer to.</p>\n<p>Henry Martin:<br>It was the mystery of it. There are all of these unexpected things that sort of came into your life. And that was interesting. I mean, it was just intrinsically interesting. It didn't have to be anything particular. It was just an activity that you found yourself involved in.</p>\n<p>Jordan Carter:<br>The New York Correspondence School really also had a hub and that hub was Bill Wilson's home.</p>\n<p>Caitlin Haskell:<br>The archivist of the New York Correspondence School was Bill Wilson and Bill was one of Ray's very best friends. When Bill and Ray met in the fall of 1956, Ray is trying to establish himself as an artist. And Bill is about to embark on a career as a professor.</p>\n<p>Jordan Carter:<br>Bill would host parties and some parties he would actually host in honor of Ray Johnson.</p>\n<p>Henry Martin:<br>It was during my junior year. Oh, Bill wrote me a note and asked me will I please bring down a basket of lobsters for a party that he was going to have. And so I did that. The party was underway when I got there, I went in and Bill asked Ray to come out and help me get the lobsters into the house. He could have asked anybody, but there was some strange reason for which he asked Ray. So we went out and the car was parked near the very strange neon light. And we opened the trunk of the car and there were these lobsters in this gray, green, brownish seaweed. And Ray had a way of looking at the scene with participating in the scene in a way that I could not possibly have. Well, I can't describe it, but there is something very special about it that Ray saw and somehow made me notice.</p>\n<p>Jordan Carter:<br>Ray Johnson had an incredible memory and a dedication to having a sustained and nuanced dialogue with his correspondence.</p>\n<p>Coco Gordon:<br>He had a fantastic memory of what he did with whom. And he had, everyday, he must've sent out 200 pieces of mail to different people.</p>\n<p>Jordan Carter:<br>He would go back to something as mundane as what... A meal, maybe, they have the last week or maybe a eyeglasses shop that they had visited together.</p>\n<p>Henry Martin:<br>I remember, for example, that he sent me pictures of lobsters attached to pieces of graph paper with the instruct, that I suppose, to send this image to Agnes Martin. So I had no idea who Agnes Martin was.</p>\n<p>Jordan Carter:<br>And this was sort of, come back and become a recurring motif in their mailings. And it would sort of ground things in the very granular level, but it would also always be open to so many indeterminate associations and possibilities.</p>\n<p>Henry Martin:<br>The lobster's meant something to me and the graph paper for it's been something entirely different to Agnes Martin. So Ray was always dealing with images that function that various different levels for various different people.</p>\n<p>Coco Gordon:<br>Every one thing led to another thing that became a thing for him, with that person. Most people will ask you simple questions, when you get to know them about you, where you were born, who are your siblings, your parents, he didn't do that. He did this, this was his work. This is his life.</p>\n<p>Caitlin Haskell:<br>It's tender. And it's all of the exchanges you want to have with your friends in person, too. You open the letter and you smile and there's something clever and you feel that someone's paying attention to you.</p>\n<p>Robert Warner:<br>I liked all of these details. And I liked the fact that he paid attention to my life. And I respected the fact that his life was what his life was. I didn't feel as though I needed to go there and have a party or picnic at Ray Johnson's house. I had my own life.</p>\n<p>Henry Martin:<br>You have to understand that everybody's Ray Johnson is a different Ray Johnson. Ray lived many different realities and he sort of preferred to live them one at a time.</p>\n<p>Coco Gordon:<br>He was able to transform himself into whatever it was that people thought he was and they came to see that.</p>\n<p>Henry Martin:<br>The responsibility with Ray is how you personally respond to him. You're never going to get it right. And what you contribute is what you contribute. What you contribute is the way you deal with him.</p>\n<p>Jordan Carter:<br>I mean, you think about this person who is so prolific, so networked, communicating constantly, but it's really hard to get a sense of what Ray was doing when he wasn't active, when he wasn't mailing, who is Ray?</p>\n<p>Henry Martin:<br>The first time Ray was on Housing street, it was an incredible apartment. There was nothing in it. The floor was painted gray, oh, the walls were painted white. There was a bed, a table, a chair, and a refrigerator, and a closet. It was a monk's cell and that was the way Ray lived. I mean, that's how Ray was when Ray was alone. It was a very strange situation, but he goes, on the one hand, you have this person who lived a life that you could call monastic, and on the other hand, there was his person, he knew 40,000 people in New York city, how it fits all together. I mean, who knows?</p>\n<p>Caitlin Haskell:<br>He's never not being an artist. He's sort of always on, and that could take place in a conversation, it could take place having a meal, it could take place making a collage, but he's always being Ray Johnson and he's always being an artist. Something that you hear from Ray's friends is that it could be exhausting to spend time with him because he was always on the lookout for what was going to make this moment significant. And there was also a sense that, everything is kind of a live performance and that your response, how clever, or how witty you were in your response was going to be kind of judged or measured in some way.</p>\n<p>Jordan Carter:<br>And this notion of exhausting others, I also would dare to say that in some ways, Johnson exhausted himself and his constant urge for creativity and finding new wants, and meaning, and associations in the world, and through others. And I think it exhausted him.</p>\n<p>Caitlin Haskell:<br>There's sort of the sense that more conventional artists, you have a show and maybe even one show a year, it starts to be on somebody else's terms. And for him, it's much more integrated, and organic, and sort of about him as a person and his lived experience.</p>\n<p>Jordan Carter:<br>Whereas I would maybe message someone about a date that I was on, or this thing that's happening in my personal life. This thing called a personal life is something that Ray doesn't seem to have.</p>\n<p>Henry Martin:<br>I mean, it was obvious. It was clear that he was a very secretive person and that's something that people knew him simply accepted, that you have to accept it. There was nothing else to do with it. I mean, you'd be walking down the street with Ray and then he'd suddenly disappear, he just wasn't there anymore. I mean, you turn around and you'd see him disappear into a subway. I mean, abandonment was one of the things that Ray did. I mean, he would abandon you, I mean, and there you were. I screamed harder, where if the person you were with, he just wasn't there anymore. We haven't talked about his death and I never do, but clearly there is sadness, is there. I mean, there was a point where he was overwhelmed.</p>\n<p>Caitlin Haskell:<br>Yeah. Ray Johnson took his life in January of '95. And it's clear at the end of 1994 that he was experiencing maybe some depression, things weren't going well. But death was always a theme in Ray's work.</p>\n<p>Henry Martin:<br>His collages are full of death. There's little Mary Crehan who choked to death with a peanut butter sandwich. There's a little boy named Dick Higgins who died in some other strange, weird, freak accident. There's the Book about Death.</p>\n<p>Caitlin Haskell:<br>He engages it as a taboo. He talks about the death of the New York Correspondence School as well.</p>\n<p>Henry Martin:<br>It wasn't an easy situation in which to be Ray's situation. Recognition, not recognition, not wanting to be recognized, wanting to be recognized for not wanting to be recognized. And it was all very complex. I mean, there was that side to him. It's not as though he were always a joker and always just playing games.</p>\n<p>Jordan Carter:<br>The title of the exhibition is Ray Johnson c/o and you quite literally come to his work by way of the things that he sent to other people. That's how you learn fragments of who this Ray was. That's what he left behind, was his work. And he left that work, care of people. And it's through these people, through these collaborations, through these relationships that we begin to chip away at who this man was as an artist, who he was as a collaborator and who he was as a human being.</p>\n<p>Caitlin Haskell:<br>This is about a person who brought together hundreds of other people and created a new system and network of expression and of encounters with people in a deeply personal human way.</p>\n<p>Coco Gordon:<br>Connecting. Connecting people, connecting things, connecting his thoughts, connecting everything in his life.</p>\n<p>Robert Warner:<br>There's not a week or a day that goes by that someone will say, &quot;Oh yeah, I knew about Ray Johnson. I don't think I kept any of his collages, but I might have gotten something from him.&quot;</p>\n<p>Henry Martin:<br>Seeing things for Ray was a question of realizing that they were important. It was a question of noticing things that you wouldn't ordinarily notice. That was the quality that he communicated. With everything was wrecked attention and he gave endless attention to things. And that's what you learned from Ray, to not take things for granted, to realize a kind of aura or kind of magic around things.</p>\n<p>Robert Warner:<br>And I'm sure that when we all look back on this 20 years from now, we're going to say, &quot;Boy, that was a great show and we did a really wonderful thing.&quot; And look how many more people are connected through Ray Johnson's process, not just about correspondence, but about friendships. We still have the spirit or, that seems too spiritual somehow to say spirit, the life. No, that sounds wrong, too. The moticos of Ray Johnson in our daily lives.</p>\n<p>Andrew Meriwether:<br>Want to give a huge thank you to Bob Warner, Coco Gordon, and Henry Martin for sharing their stories with us. This episode today was produced by me, Andrew Meriweather for the art Institute of Chicago, with support from Bloomberg Philanthropies. Original music by QSHOP. Thank you all so much for listening and we'll see you at the museum.</p>\n",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.16"
    },
    "config": {
        "iiif_url": "https://www-test.artic.edu/iiif/2",
        "website_url": "https://www-test.artic.edu"
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
        "total": 1086,
        "limit": 10,
        "offset": 0,
        "total_pages": 109,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "id": 1362,
            "api_model": "mobile-sounds",
            "api_link": "https://api.artic.edu/api/v1/mobile-sounds/1362",
            "title": "Veranda Post of Enthroned King and Senior Wife (Opo Ogoga)",
            "timestamp": "2026-06-03T23:05:09-05:00"
        },
        {
            "_score": 1,
            "id": 2228,
            "api_model": "mobile-sounds",
            "api_link": "https://api.artic.edu/api/v1/mobile-sounds/2228",
            "title": "Veranda Post (\u00d2p\u00f3 \u00d2g\u00f2g\u00e1)",
            "timestamp": "2026-06-03T23:05:18-05:00"
        },
        {
            "_score": 1,
            "id": 2243,
            "api_model": "mobile-sounds",
            "api_link": "https://api.artic.edu/api/v1/mobile-sounds/2243",
            "title": "Veranda Post (\u00d2p\u00f3 \u00d2g\u00f2g\u00e1)",
            "timestamp": "2026-06-03T23:05:19-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.15"
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
        "version": "1.16"
    },
    "config": {
        "iiif_url": "https://www-test.artic.edu/iiif/2",
        "website_url": "https://www-test.artic.edu"
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
            "section_ids": [
                39490616069,
                39580036238,
                39580598949,
                39582005744,
                39582287106,
                39582568469,
                39582849833,
                39583131198,
                39583412564,
                39583693931,
                39583975299,
                39584256668,
                39584538038,
                39584819409,
                39585100781,
                39585382154,
                39585663528,
                39585944903,
                39586226279,
                39586507656,
                39586789034,
                39587070413,
                39587351793,
                39587633174,
                39587914556,
                39588195939,
                39588477323,
                39588758708,
                39590447039,
                39590728431,
                39591009824,
                39591291218,
                39591572613,
                39591854009,
                39592135406,
                39592416804,
                39592698203,
                39592979603,
                39593261004,
                39593542406,
                39593823809,
                39594105213,
                39594386618,
                39594668024,
                39594949431,
                39595230839,
                39595512248,
                39595793658,
                39596075069,
                39596356481,
                39596637894,
                39596919308,
                39597200723,
                39597482139,
                39597763556,
                39600014928,
                39600296354,
                39600577781,
                39600859209,
                39601140638,
                39601422068,
                39601703499,
                39601984931,
                39602266364,
                39602547798,
                39602829233,
                39603110669,
                39603392106,
                39603673544,
                39604799306,
                39605080749,
                39605362193,
                39605643638,
                39605925084,
                39606206531,
                39606487979,
                39606769428,
                39607050878,
                39607332329,
                39607613781,
                39607895234,
                39608176688,
                39608458143,
                39608739599,
                39609302514,
                39609583973,
                39609865433,
                39610146894,
                39610428356,
                39610709819,
                39610991283,
                39611272748,
                39611554214,
                39611835681,
                39612117149,
                39612398618,
                39612680088,
                39612961559,
                39613243031,
                39613524504,
                39613805978,
                39614087453,
                39614368929,
                39614650406,
                39614931884,
                39615213363,
                39615494843,
                39615776324,
                39616057806,
                39616339289,
                39616620773,
                39616902258,
                39617183744,
                39617465231,
                39617746719,
                39618028208,
                39618309698,
                39618591189,
                39618872681,
                39619154174,
                39619435668,
                39619717163,
                39620280156,
                39620561654,
                39620843153,
                39621124653,
                39621406154,
                39621687656,
                39621969159,
                39622250663,
                39622532168,
                39622813674,
                39623095181,
                39623376689,
                39623658198,
                39623939708,
                39624221219,
                39624502731,
                39624784244,
                39625065758,
                39625347273,
                39625628789,
                39625910306,
                39626191824,
                39626473343,
                39626754863,
                39627317906,
                39627599429,
                39627880953,
                39628162478,
                39628444004,
                39628725531,
                39629007059,
                39629570118,
                39629851649,
                39630133181,
                39630977783,
                39631259319,
                39631540856,
                39631822394,
                39632103933,
                39632385473,
                39632667014,
                39632948556,
                39633230099,
                39633511643,
                39633793188,
                39634074734,
                39634356281,
                39634637829,
                39634919378,
                39635200928,
                39635482479,
                39635764031,
                39636045584,
                39636327138,
                39636608693,
                39636890249,
                39637171806,
                39637453364,
                39637734923,
                39638016483,
                39638298044,
                39638579606,
                39638861169,
                39639142733,
                39639424298,
                39639705864,
                39639987431,
                39640268999,
                39640832138,
                39641113709,
                39641395281,
                39641676854,
                39641958428,
                39642240003,
                39642521579,
                39642803156,
                39643084734,
                39643366313,
                39643647893,
                39643929474,
                39644211056,
                39644492639,
                39644774223,
                39645055808,
                39645337394,
                39645618981,
                39645900569,
                39646182158,
                39646745339,
                39647308524,
                39652658981,
                39652940594,
                39654067056,
                39676317959,
                39677726454,
                39678571563,
                39679416681,
                39684769304,
                39789358656,
                39813904923,
                39814187108,
                39814469294,
                39814751481,
                39815033669,
                39815315858,
                39815598048,
                39815880239,
                39816162431,
                39843822098,
                40430021523,
                40655833031,
                40770830693,
                40771116249,
                40771401806,
                40771687364,
                40771972923,
                40772258483
            ],
            ...
        },
        {
            "id": 140019,
            "api_model": "publications",
            "api_link": "https://api.artic.edu/api/v1/publications/140019",
            "title": "Manet Paintings and Works on Paper at the Art Institute of Chicago",
            "web_url": "https://publications.artic.edu/manet/reader/manetart",
            "section_ids": [
                39211200800,
                39213441156,
                39213721205,
                39214281306,
                39214561358,
                39214841411,
                39215401520,
                39216521750,
                39216801810,
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
                39220722755,
                39243972383
            ],
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.16"
    },
    "config": {
        "iiif_url": "https://www-test.artic.edu/iiif/2",
        "website_url": "https://www-test.artic.edu"
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
            "id": 2,
            "api_model": "publications",
            "api_link": "https://api.artic.edu/api/v1/publications/2",
            "title": "American Silver in the Art Institute of Chicago",
            "timestamp": "2026-09-01T03:05:14-05:00"
        },
        {
            "_score": 1,
            "id": 7,
            "api_model": "publications",
            "api_link": "https://api.artic.edu/api/v1/publications/7",
            "title": "Pissarro Paintings and Works on Paper at the Art Institute of Chicago",
            "timestamp": "2026-09-01T03:05:14-05:00"
        },
        {
            "_score": 1,
            "id": 12,
            "api_model": "publications",
            "api_link": "https://api.artic.edu/api/v1/publications/12",
            "title": "The Modern Series at the Art Institute of Chicago",
            "timestamp": "2026-09-01T03:05:14-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.15"
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
        "version": "1.16"
    },
    "config": {
        "iiif_url": "https://www-test.artic.edu/iiif/2",
        "website_url": "https://www-test.artic.edu"
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
        "total": 1508,
        "limit": 2,
        "offset": 0,
        "total_pages": 754,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/sections?page=2&limit=2"
    },
    "data": [
        {
            "id": 108342,
            "api_model": "sections",
            "api_link": "https://api.artic.edu/api/v1/sections/108342",
            "title": "Select Silver Objects in the Collection of the Art Institute of Chicago",
            "web_url": "https://publications.artic.edu/americansilver/reader/collection/section/462",
            "accession": "1954.131",
            ...
        },
        {
            "id": 15222,
            "api_model": "sections",
            "api_link": "https://api.artic.edu/api/v1/sections/15222",
            "title": "Cat. 100 \u00a0Circa \u201970 Coffee Service, designed 1958; introduced 1960",
            "web_url": "https://publications.artic.edu/americansilver/reader/collection/section/171",
            "accession": "2009.1036.1",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.16"
    },
    "config": {
        "iiif_url": "https://www-test.artic.edu/iiif/2",
        "website_url": "https://www-test.artic.edu"
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
        "total": 1508,
        "limit": 10,
        "offset": 0,
        "total_pages": 151,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "id": 42,
            "api_model": "sections",
            "api_link": "https://api.artic.edu/api/v1/sections/42",
            "title": "American Silver in the Art Institute of Chicago",
            "timestamp": "2026-09-01T03:05:17-05:00"
        },
        {
            "_score": 1,
            "id": 52,
            "api_model": "sections",
            "api_link": "https://api.artic.edu/api/v1/sections/52",
            "title": "Catalogue",
            "timestamp": "2026-09-01T03:05:17-05:00"
        },
        {
            "_score": 1,
            "id": 128,
            "api_model": "sections",
            "api_link": "https://api.artic.edu/api/v1/sections/128",
            "title": "Pissarro Paintings and Works on Paper at the Art Institute of Chicago",
            "timestamp": "2026-09-01T03:05:17-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.15"
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
        "version": "1.16"
    },
    "config": {
        "iiif_url": "https://www-test.artic.edu/iiif/2",
        "website_url": "https://www-test.artic.edu"
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
        "version": "1.16"
    },
    "config": {
        "iiif_url": "https://www-test.artic.edu/iiif/2",
        "website_url": "https://www-test.artic.edu"
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
            "id": 1,
            "api_model": "sites",
            "api_link": "https://api.artic.edu/api/v1/sites/1",
            "title": "Chicago Architecture: Ten Visions",
            "timestamp": "2026-09-01T03:00:19-05:00"
        },
        {
            "_score": 1,
            "id": 2,
            "api_model": "sites",
            "api_link": "https://api.artic.edu/api/v1/sites/2",
            "title": "American Perspectives: A yearlong celebration of American artistic vision",
            "timestamp": "2026-09-01T03:00:19-05:00"
        },
        {
            "_score": 1,
            "id": 3,
            "api_model": "sites",
            "api_link": "https://api.artic.edu/api/v1/sites/3",
            "title": "Curious Corner",
            "timestamp": "2026-09-01T03:00:19-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.15"
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
        "version": "1.16"
    },
    "config": {
        "iiif_url": "https://www-test.artic.edu/iiif/2",
        "website_url": "https://www-test.artic.edu"
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
        "total": 2967,
        "limit": 2,
        "offset": 0,
        "total_pages": 1484,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/events?page=2&limit=2"
    },
    "data": [
        {
            "id": 3991,
            "api_model": "events",
            "api_link": "https://api.artic.edu/api/v1/events/3991",
            "title": "Lecture: Portrait of a Woman in Silk\u2014Hidden Histories of the British Atlantic World",
            "title_display": null,
            "image_url": null,
            ...
        },
        {
            "id": 3990,
            "api_model": "events",
            "api_link": "https://api.artic.edu/api/v1/events/3990",
            "title": "Far North Community Associates: Exploring Architectural Gems in LaSalle County",
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
        "version": "1.16"
    },
    "config": {
        "iiif_url": "https://www-test.artic.edu/iiif/2",
        "website_url": "https://www-test.artic.edu"
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
        "total": 3009,
        "limit": 10,
        "offset": 0,
        "total_pages": 301,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "id": 5581,
            "api_model": "events",
            "api_link": "https://api.artic.edu/api/v1/events/5581",
            "title": "Member Preview: Gio Swaby\u2014Fresh Up",
            "timestamp": "2026-09-03T23:27:08-05:00"
        },
        {
            "_score": 1,
            "id": 5674,
            "api_model": "events",
            "api_link": "https://api.artic.edu/api/v1/events/5674",
            "title": "The Art Exchange (May 26\u201329)",
            "timestamp": "2026-09-03T23:27:08-05:00"
        },
        {
            "_score": 1,
            "id": 5672,
            "api_model": "events",
            "api_link": "https://api.artic.edu/api/v1/events/5672",
            "title": "The Art Exchange (May 12\u201315)",
            "timestamp": "2026-09-03T23:27:08-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.15"
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
        "image_url": "http://artic-web-test.imgix.net/22a002db-9695-452b-9c85-7a63644df4e0/G35154-int_press.jpg?rect=0%2C349%2C2334%2C1312&auto=format%2Ccompress&fit=crop&crop=faces%2Ccenter&w=1200&h=675",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.16"
    },
    "config": {
        "iiif_url": "https://www-test.artic.edu/iiif/2",
        "website_url": "https://www-test.artic.edu"
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
        "total": 233,
        "limit": 2,
        "offset": 0,
        "total_pages": 117,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/event-occurrences?page=2&limit=2"
    },
    "data": [
        {
            "id": "cdf69678-889f-5caa-b256-3e62ea44894b",
            "api_model": "event-occurrences",
            "api_link": "https://api.artic.edu/api/v1/event-occurrences/cdf69678-889f-5caa-b256-3e62ea44894b",
            "title": "Gallery Tour (Sunday at 3:00, Modern Wing start)",
            "title_display": "Gallery Tour",
            "event_id": 5538,
            ...
        },
        {
            "id": "7317e526-601c-5bd9-89c9-e8f4b2da3f61",
            "api_model": "event-occurrences",
            "api_link": "https://api.artic.edu/api/v1/event-occurrences/7317e526-601c-5bd9-89c9-e8f4b2da3f61",
            "title": "Gallery Tour (Sunday at 3:00, Modern Wing start)",
            "title_display": "Gallery Tour",
            "event_id": 5538,
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.16"
    },
    "config": {
        "iiif_url": "https://www-test.artic.edu/iiif/2",
        "website_url": "https://www-test.artic.edu"
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
        "total": 335,
        "limit": 10,
        "offset": 0,
        "total_pages": 34,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "id": "7bb2ca70-efa9-5981-b93e-2413245110d8",
            "api_model": "event-occurrences",
            "api_link": "https://api.artic.edu/api/v1/event-occurrences/7bb2ca70-efa9-5981-b93e-2413245110d8",
            "title": "Gallery Conversation: Beyond Form\u2014Abstraction at Midcentury",
            "timestamp": "2026-09-21T23:27:11-05:00"
        },
        {
            "_score": 1,
            "id": "7c6e2f81-1ad6-5676-82a0-616503d588f8",
            "api_model": "event-occurrences",
            "api_link": "https://api.artic.edu/api/v1/event-occurrences/7c6e2f81-1ad6-5676-82a0-616503d588f8",
            "title": "Holiday Art Making: Cocoa and Crafts",
            "timestamp": "2026-09-21T23:27:11-05:00"
        },
        {
            "_score": 1,
            "id": "4020953f-f35b-56ef-a9a0-a93fda997550",
            "api_model": "event-occurrences",
            "api_link": "https://api.artic.edu/api/v1/event-occurrences/4020953f-f35b-56ef-a9a0-a93fda997550",
            "title": "Holiday Art Making: Cocoa and Crafts",
            "timestamp": "2026-09-21T23:27:11-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.15"
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

::: details Example request: https://api.artic.edu/api/v1/event-occurrences/00824725-b564-5541-b0b8-8306cbb133ca  
```js
{
    "data": {
        "id": "00824725-b564-5541-b0b8-8306cbb133ca",
        "api_model": "event-occurrences",
        "api_link": "https://api.artic.edu/api/v1/event-occurrences/00824725-b564-5541-b0b8-8306cbb133ca",
        "title": "Gallery Tour (Friday at 1:00, Grand Staircase start)",
        "title_display": "Gallery Tour",
        "event_id": 5533,
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.16"
    },
    "config": {
        "iiif_url": "https://www-test.artic.edu/iiif/2",
        "website_url": "https://www-test.artic.edu"
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
        "total": 48,
        "limit": 2,
        "offset": 0,
        "total_pages": 24,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/event-programs?page=2&limit=2"
    },
    "data": [
        {
            "id": 33,
            "api_model": "event-programs",
            "api_link": "https://api.artic.edu/api/v1/event-programs/33",
            "title": "Holidays",
            "is_affiliate_group": false,
            "is_event_host": false,
            ...
        },
        {
            "id": 28,
            "api_model": "event-programs",
            "api_link": "https://api.artic.edu/api/v1/event-programs/28",
            "title": "Conservation and Science",
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
        "version": "1.16"
    },
    "config": {
        "iiif_url": "https://www-test.artic.edu/iiif/2",
        "website_url": "https://www-test.artic.edu"
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
        "total": 50,
        "limit": 10,
        "offset": 0,
        "total_pages": 5,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "id": 116,
            "api_model": "event-programs",
            "api_link": "https://api.artic.edu/api/v1/event-programs/116",
            "title": "Cassatt",
            "timestamp": "2026-09-21T23:30:11-05:00"
        },
        {
            "_score": 1,
            "id": 115,
            "api_model": "event-programs",
            "api_link": "https://api.artic.edu/api/v1/event-programs/115",
            "title": "Programas en espa\u00f1ol",
            "timestamp": "2026-09-21T23:30:11-05:00"
        },
        {
            "_score": 1,
            "id": 114,
            "api_model": "event-programs",
            "api_link": "https://api.artic.edu/api/v1/event-programs/114",
            "title": "Weekday Studio",
            "timestamp": "2026-09-21T23:30:11-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.15"
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
        "version": "1.16"
    },
    "config": {
        "iiif_url": "https://www-test.artic.edu/iiif/2",
        "website_url": "https://www-test.artic.edu"
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
        "total": 574,
        "limit": 2,
        "offset": 0,
        "total_pages": 287,
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
            "id": 620,
            "api_model": "articles",
            "api_link": "https://api.artic.edu/api/v1/articles/620",
            "title": "Snow White and the Seven Dwarfs",
            "copy": " There\u2019s more than initially meets the eye to this exceptionally intricate lock, which was forged in iron by metalworker Frank Koralewsky and illustrates a scene from Grimms\u2019 \u201cSnow White and the Seven Dwarves.\u201d   Look closely and you\u2019ll probably see Snow White first\u2014she\u2019s stirring a cauldron over a fire in the cottage\u2019s kitchen. Let your eyes travel down down to her left and right and you\u2019ll see two dwarves entering with ingredients for her stew. The one to the left hauls a carrot and the one to the right lugs an oversized hare. A bit further to the right, two dwarves stand on andirons and manage the fire. And as you look toward the exterior of the scene, two more dwarves stand on guard. One just above Snow White turns a tiny knob, while the other is literally asleep on the job under a toadstool.   If you\u2019ve been counting carefully, you know that we\u2019ve only accounted for six dwarves so far. The last would have been perched on top of the key that would have unlocked this lock. The key isn\u2019t here, but see below for a historical picture.   Koralewsky was a German-born metalworker who immigrated to the United States in the early 20th century. He settled in Boston and joined the Boston Society of Arts and Crafts, which specialized in locksmithing and hardware. This delicate piece took Koralewsky seven years to complete, but it won the gold medal at the 1915 Panama-Pacific International Exposition. \u2014Katie Rahn ",
            "source_updated_at": "2018-08-08T16:13:55-05:00",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.16"
    },
    "config": {
        "iiif_url": "https://www-test.artic.edu/iiif/2",
        "website_url": "https://www-test.artic.edu"
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
        "total": 581,
        "limit": 10,
        "offset": 0,
        "total_pages": 59,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "id": 1016,
            "api_model": "articles",
            "api_link": "https://api.artic.edu/api/v1/articles/1016",
            "title": "An Ode to the Ugly: In Praise of Ivan Albright",
            "timestamp": "2026-09-17T23:15:35-05:00"
        },
        {
            "_score": 1,
            "id": 1008,
            "api_model": "articles",
            "api_link": "https://api.artic.edu/api/v1/articles/1008",
            "title": "The Accidental Anonymity of Ancient Portraits",
            "timestamp": "2026-09-17T23:15:36-05:00"
        },
        {
            "_score": 1,
            "id": 1054,
            "api_model": "articles",
            "api_link": "https://api.artic.edu/api/v1/articles/1054",
            "title": "Leslie Wilson, Associate Director, Academic Engagement and Research",
            "timestamp": "2026-09-17T23:15:36-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.15"
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
        "version": "1.16"
    },
    "config": {
        "iiif_url": "https://www-test.artic.edu/iiif/2",
        "website_url": "https://www-test.artic.edu"
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
        "total": 52,
        "limit": 2,
        "offset": 0,
        "total_pages": 26,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/highlights?page=2&limit=2"
    },
    "data": [
        {
            "id": 6,
            "api_model": "highlights",
            "api_link": "https://api.artic.edu/api/v1/highlights/6",
            "title": "american-art",
            "copy": " Please note: artworks occasionally go off view for imaging, treatment, or loan to other institutions. Click on the images to ensure the work is currently on view.   Georgia O\u2019Keeffe didn't travel in an airplane until she was in her 70s, but when she did, she was fascinated. She started a series of paintings inspired by her in-flight experiences. The works began small and progressively got bigger until the final canvas in the series, Sky above Clouds IV , which is so large that it has never traveled since coming to the Art Institute.   One of America's most famous paintings, American Gothic , debuted at the Art Institute of Chicago, winning a $300 prize and instant fame for Grant Wood. It has long been parodied and is often seen as a satirical commentary on the Midwestern character, but Wood intended it to a positive statement about rural American values. Read more about this work on our blog, where a curator answers the top five FAQs about the iconic painting.   One of the best-known images of 20th-century art, Nighthawks depicts an all-night diner in which three customers, all lost in their own thoughts, have congregated. It's unclear how or why the anonymous and uncommunicative night owls are there\u2014in fact, Hopper eliminated any reference to an entrance to the diner. The four seem as separate and remote from the viewer as they are from one another. (The red-haired woman was actually modeled by the artist\u2019s wife, Jo.)   Known today for his paintings and murals depicting Mexican political and cultural life, Diego Rivera enjoyed a brief but sparkling period as a Cubist painter early in his career. In this work he portrayed his then-lover, the Russian-born painter and writer Marevna Vorob\u00ebv-Stebelska, clearly conveying her distinctive bobbed hair, blond bangs, and prominent nose\u2014despite or with the aid of the Cubist style. Like many other artists in Paris, Rivera rejected Cubism as frivolous and inappropriate following World War I and the Russian Revolution.   A native Chicagoan and graduate of the School of the Art Institute, Archibald Motley used his art to represent the vibrancy of African American culture, frequently portraying young, sophisticated city dwellers out on the town. One of Motley\u2019s most celebrated paintings, Nightlife depicts a crowded cabaret in the South Side neighborhood of Bronzeville. The dynamic composition, intense lighting, and heightened colors vividly express the liveliness of the scene.   The only American artist invited to exhibit with the French Impressionists, Mary Cassatt concentrated on the human figure, particularly on sensitive yet unsentimental portrayals of women and children. In The Child\u2019s Bath , one of Cassatt\u2019s masterworks, she used cropped forms, bold patterns and outlines, and a flattened perspective, all of which she derived from her study of Japanese woodblock prints.   Eldzier Cortor lived in Chicago and attended the School of the Art Institute, and while drawn to abstraction, he felt that it was not an effective tool for conveying serious social and political concerns. In The Room No. VI, the artist exposes the impoverished living conditions experienced by many African Americans on the South Side through a brilliant use of line and color, reinvigorating the idiom of social realism.   Though Stuart Davis studied with the so-called Ashcan School, who sought to depict a realistic look at modern urban life, he came to embrace a more abstracted and energetic style, as seen in Ready-to-Wear . The bright colors intersect and interrupt one another in a distinctly American way: jazzy, vital, and mass produced\u2014all qualities summed up in the title.   In addition to architecture, Frank Lloyd Wright designed furniture like this chair from his home in Oak Park, Illinois. Though his early experiments were heavy, solid cube chairs, he eventually added the refinements seen in this design, such as spindles, the subtly tapering crest rail, and gently curving leg ends, all of which produce an effect that is equal parts sophistication and simplicity.   In The Herring Net, Winslow Homer depicts two fishermen at their daily yet heroic work. As the small boat rides the swells, one fisherman hauls in the heavy net while the other unloads the glistening herring, illustrating that teamwork is essential for survival on this churning sea that both gives and takes. ",
            "source_updated_at": "2020-05-28T11:32:54-05:00",
            ...
        },
        {
            "id": 9,
            "api_model": "highlights",
            "api_link": "https://api.artic.edu/api/v1/highlights/9",
            "title": "international-modern-art",
            "copy": " Please note: artworks occasionally go off view for imaging, treatment, or loan to other institutions. Click on the images to ensure the work is currently on view.   One of the most iconic examples of Picasso\u2019s early Cubism, this portrait of the artist\u2019s dealer Daniel-Henry Kahnweiler (1884\u20131979) was created over more than 30 working sessions. With each sitting, Picasso further broke down and recombined the forms he saw, eventually arriving at a depiction of Kahnweiler as a network of shimmering, semitransparent surfaces that fracture into different planes and shapes.   One of Germany\u2019s leading modern painters, Gabrielle M\u00fcnter was known for her use of saturated color and loose brushwork verging on abstraction. Often using toys as the subjects of her still lifes, she infused her work with a liveliness and wit. Here, her painting includes a depiction of a wax doll made by her friend, the Russian dancer Alexander Sacharoff.   In his seminal 1912 publication, Concerning the Spiritual in Art , Vasily Kandinsky advocated an art that could move beyond imitation of the physical world, inspiring, as he put it, \"vibrations in the soul.\u201d Improvisation No. 30 (Cannons) \u2014one of the first works in which he attempted to depict those \u201cvibrations\u201d \u2014 is a standout work within the Art Institute\u2019s modern art collection, which includes five key paintings by Kandinsky.   This monumental painting is the result of an intense period of experimentation and revision for artist Henri Matisse. He originally painted the work as a pastoral scene of standing and seated bathers, but over the next decade he transformed it into the cubist-inflected composition seen today. When the painting was acquired by the Art Institute in 1953, Matisse told the museum\u2019s director that he viewed the painting as one of his five most pivotal works.   In 1913, on a transatlantic voyage to New York, Francis Picabia was amused by two fellow passengers: an exotic dancer and a Dominican priest, who could not resist the temptation of watching the dancer rehearse. In response, Picabia created this monumental canvas that evokes the sensations of dance and a ship moving through rolling seas. He titled the work Edtaonisl , an acronym made by alternating the letters of the French words \u00e9toile (star) and dans[e] (dance).   Among the most influential images in the early history of Surrealism, Giorgio de Chirico\u2019s The Philosopher\u2019s Conquest seems rife with meaning yet remains resolutely enigmatic. By juxtaposing incongruous objects, the artist sought to produce what he called art that resembles \u201cthe restlessness of myth.\u201d De Chirico\u2019s works profoundly affected artists associated with the Surrealist movement, who in the 1920s and 1930s used similarly unconventional pairings to explore the realm of the subconscious in their work.   While working in Russia in 1915, Kazimir Malevich invented Suprematism, a revolutionary mode of abstraction, which he considered a new type of realism. Breaking away from observed reality to focus instead on the relationships between colored geometric forms against a textured white background, the artist freed his compositions from traditional givens\u2014like top or bottom, left or right\u2014and presented everyday scenes, such as an athlete playing soccer, as if they existed in four dimensions.   Among the earliest proponents of abstract painting in Europe, Frantisek Kupka immigrated from Bohemia (in present-day Czech Republic) to Paris in 1896. Traveling to Paris and Chartres, France, he studied the stained-glass windows of Gothic and Romanesque cathedrals and created radiant abstractions that convey the feeling of light passing through colored glass.   Functioning simultaneously as an abstract painting and a concrete poem, Suzanne Duchamp\u2019s Broken and Restored Multiplication is filled with visual and verbal metaphors of disorder and breakage. In this collage-like array, she turns the iconic metal lattice of the Eiffel Tower upside-down, alerting us to the fragility, but also the flexibility, of systems such as language and memory that allow us to recognize our place in the world, even as it seems to be falling apart.   Constantin Br\u00e2ncu\u0219i's Golden Bird is an icon of modern sculpture and one of more than two dozen Bird sculptures the artist created in his quest for self-sufficient form. As Br\u00e2ncu\u0219i once said, \u201cAll my life, I have sought to render the essence of flight.\u201d In this work, details such as feet, a tail, and an upturned beak are barely suggested, and the elegant, streamlined silhouette of the polished bronze contrasts the rough-hewn wood base.   Piet Mondrian, a founding member of the revolutionary international movement De Stijl (the Style), argued that \u201cthe straight line tells the truth.\u201d Deceptively simple, his works are the result of constant adjustment to achieve absolute balance and harmony. In Lozenge Composition with Yellow, Black, Blue, Red, and Gray , Mondrian rotated a square canvas 90-degrees to create a dynamic relationship between the rectilinear composition and the diagonal lines of the edges of the support.   One of the most prolific artists of the 20th century, Picasso arguably influenced the direction of modern art more than any other single figure. In this work, a portrait of Marie-Th\u00e9r\u00e8se Walter, he used an approach inflected by both Cubism and Surrealism, depicting Walter\u2019s face from a frontal and profile view simultaneously.   Although Marcel Duchamp began his career as a painter, he is best known for his attempts to prove the end of \u201cretinal art,\u201d or artworks created to please the eye. His answer was the \u201creadymade,\u201d an ordinary object transformed into a work of art simply by means of its selection and designation as such by an artist. His Bottle Rack , first realized in 1914, is the earliest work of this type, and was acquired by the Art Institute in 2018. Learn more about Duchamp\u2019s Bottle Rack on the museum\u2019s blog .   Among the boldest and the most brilliantly colored of all of Max Beckmann\u2019s self-portraits, this was perhaps the last painting the artist completed in Berlin before he and his wife fled to the Netherlands\u2014just two days after Adolf Hitler delivered a speech condemning modern art. In 1937, shortly after this work was made, more than 500 of his works were confiscated from German public collections.   White Crucifixion represents a critical turning point for Marc Chagall and for the history of 20th-century art: it was the first of a series of compositions in which the artist portrayed Christ as a Jewish martyr and identified the Nazis with Christ\u2019s tormentors. Painted in response to the terror and trauma of Kristallnacht, an anti-Jewish pogrom, this work is among the most overtly political paintings of Chagall\u2019s career. ",
            "source_updated_at": "2020-05-28T11:33:12-05:00",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.16"
    },
    "config": {
        "iiif_url": "https://www-test.artic.edu/iiif/2",
        "website_url": "https://www-test.artic.edu"
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
        "version": "1.15"
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
        "copy": " If you entered at Michigan Avenue, start at the top. If you entered through the Modern Wing, go in reverse order. Please note that artworks occasionally go off view for imaging, treatment, or loan to other institutions. Click on the images to ensure the work is currently on view.   More than 100 years ago, Agnes F. Northrop designed the monumental Hartwell Memorial Window for Tiffany Studios as a commission from Mary Hartwell in honor of her husband, Frederick Hartwell, for the Central Baptist Church of Providence, Rhode Island (now Community Church of Providence). Composed of 48 panels and numerous different glass types, the window is inspired by the view from Frederick Hartwell\u2019s family home near Mt. Chocorua in New Hampshire. The majestic scene captures the transitory beauty of nature\u2014the sun setting over a mountain, flowing water, and dappled light dancing through the trees\u2014in an intricate arrangement of vibrantly colored glass. On view at the top of the Woman's Board Grand Staircase   This 12th-century statue of the Buddha comes from the south Indian coastal town of Nagapattinam, where Buddhist monasteries flourished and attracted monks from distant lands. He is seated in a lotus posture of meditation, with hands and feet resting atop one another. The mark on his forehead is called the urna, which distinguishes the Buddha as a great being. On view in Gallery 140   Kashmir-raised, London-based artist Raqib Shaw has worked on his autobiographical Paradise Lost since 2009, but he hadn\u2019t seen all 21 panels together until the more than 100-foot-wide work was installed in our galleries in the summer of 2025. This magnificent allegorical painting takes viewers on a spellbinding journey, from the nocturnal solitude of the artist\u2019s childhood in Kashmir to the frenzied daylight of the art world and the West to finally a fragile, renewed dawn. Each panel is dense with symbolism, and the composition is dotted with images of the artist, sometimes as a humanoid creature and sometimes unambiguously in full human form. On view in Galleries 141\u2013142   Gallery 109 was designed by Tadao And\u014d, a self-taught architect who sought out instruction through apprenticeships with carpenters, designers, and planners and by traveling to visit major works by European and American architects in Japan and abroad. Completed in 1992, the \"And\u014d Gallery\" evokes a traditional Japanese interior with 16 free-standing wood columns in a darkened room, framing the art objects displayed in cases around the room\u2019s perimeter in an entirely modern way. On view in Gallery 109   Created by Bernat Martorell\u2014the greatest Spanish painter of the first half of the 15th century\u2014this scene shows a popular episode from the legend of Saint George where the model Christian knight saves a town and rescues a beautiful princess. Triumphant on his rearing white steed, Saint George points a lance down at the evil dragon. The princess looks on, wearing an ermine-lined robe and a sumptuous gilt crown. George\u2019s halo and armor and the scaly body of the dragon are richly modeled with raised stucco decoration. Martorell also treated the ground, littered with bones and crawling with lizards, in a lively manner, giving it a gritty texture. On view in Gallery 237   For his largest and best-known painting, Georges Seurat depicted Parisians enjoying all sorts of leisurely activities\u2014strolling, lounging, sailing, and fishing\u2014in the park called La Grande Jatte in the River Seine. He used an innovative technique called Pointillism, inspired by optical and color theory, applying tiny dabs of different colored paint that viewers see as a single, and Seurat believed, more brilliant hue. On view in Gallery 240   Over his short five-year career, Vincent van Gogh painted 35 self-portraits\u201424 of them, including this early example, during his two-year stay in Paris with his brother Theo. Here, Van Gogh used densely dabbed brushwork, an approach influenced by Georges Seurat\u2019s revolutionary technique in A Sunday on La Grande Jatte\u20141884 (on view Gallery in 240), to create a dynamic portrayal of himself. The dazzling array of dots and dashes in brilliant greens, blues, reds, and oranges is anchored by his intense gaze. On view in Gallery 241   Painted in the summer of 1965, when Georgia O'Keeffe was 77 years old, this monumental work culminates the artist\u2019s series based on her experiences as an airplane passenger during the 1950s. Spanning the entire 24-foot width of O\u2019Keeffe\u2019s garage, the work has not left the Art Institute since it came into the building\u2014because of its size and because of its status as an essential icon. On view in Gallery 249   One of the most famous American paintings of all time, this double portrait by Grant Wood debuted at the Art Institute in 1930, winning the artist a $300 prize and instant fame. Many people think the couple are a husband and wife, but Wood meant the couple to be a father and his daughter. (His sister and his dentist served as his models.) He intended this Depression-era canvas to be a positive statement about rural American values during a time of disillusionment. On view in Gallery 263   This iconic painting of an all-night diner in which three customers sit together and yet seem totally isolated from one another has become one of the best-known images of 20th-century art. Hopper said of the enigmatic work, \u201cUnconsciously, probably, I was painting the loneliness of a large city.\u201d On view in Gallery 262   In December 1931 Pablo Picasso began a series of paintings of Marie-Th\u00e9r\u00e8se Walter, a French model with whom he was romantically involved while married to his first wife, Olga Khokhlova. Perhaps acknowledging their double life, Picasso invented a new motif\u2014a face encompassing both frontal and profile views. A constant innovator, Picasso experimented with materials as well as with form and style. The Red Armchair demonstrates the artist\u2019s inventive use of Ripolin, an industrial house paint. Mixing it with oil paint he produced various surfaces, from the rough, yellow background to the almost brushless finish of the black lines. On view in Gallery 394   Joan Mitchell once declared that her large, light-filled abstract canvases were \u201cabout landscape, not about me.\u201d Here, the dense tangle of color and gestural brushstrokes captures the energy of a bustling metropolis. Mitchell had ample time to observe city life, having been born and raised in Chicago and spending much of the 1950s traveling between the artistic hubs of Paris and New York. City Landscape can be interpreted in various ways: a skyline and its reflection on a body of water, the commotion of a downtown street, or the view from an airplane window\u2014a cluster of buildings blurring into the surrounding patchwork of fields. On view in Gallery 291\u2014learn more in this video . ",
        "source_updated_at": "2026-03-11T14:32:33-05:00",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.16"
    },
    "config": {
        "iiif_url": "https://www-test.artic.edu/iiif/2",
        "website_url": "https://www-test.artic.edu"
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
        "total": 10,
        "limit": 2,
        "offset": 0,
        "total_pages": 5,
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
        "version": "1.16"
    },
    "config": {
        "iiif_url": "https://www-test.artic.edu/iiif/2",
        "website_url": "https://www-test.artic.edu"
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
        "total": 10,
        "limit": 10,
        "offset": 0,
        "total_pages": 1,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "id": 2,
            "api_model": "static-pages",
            "api_link": "https://api.artic.edu/api/v1/static-pages/2",
            "title": "Events",
            "timestamp": "2026-09-23T16:00:17-05:00"
        },
        {
            "_score": 1,
            "id": 3,
            "api_model": "static-pages",
            "api_link": "https://api.artic.edu/api/v1/static-pages/3",
            "title": "Exhibitions",
            "timestamp": "2026-09-23T16:00:17-05:00"
        },
        {
            "_score": 1,
            "id": 4,
            "api_model": "static-pages",
            "api_link": "https://api.artic.edu/api/v1/static-pages/4",
            "title": "Upcoming Exhibitions",
            "timestamp": "2026-09-23T16:00:17-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.15"
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

::: details Example request: https://api.artic.edu/api/v1/static-pages/2  
```js
{
    "data": {
        "id": 2,
        "api_model": "static-pages",
        "api_link": "https://api.artic.edu/api/v1/static-pages/2",
        "title": "Events",
        "web_url": "/events",
        "source_updated_at": null,
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.16"
    },
    "config": {
        "iiif_url": "https://www-test.artic.edu/iiif/2",
        "website_url": "https://www-test.artic.edu"
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
        "total": 213,
        "limit": 2,
        "offset": 0,
        "total_pages": 107,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/generic-pages?page=2&limit=2"
    },
    "data": [
        {
            "id": 465,
            "api_model": "generic-pages",
            "api_link": "https://api.artic.edu/api/v1/generic-pages/465",
            "title": "Playing Favorites",
            "web_url": "http://www-dev.artic.edu/visit-us-virtually/watch-and-listen/videos/playing-favorites",
            "copy": " Finding Meaning in a Medieval Reliquary with Cybele Tom Former objects conservator Cybele Tom reflects on the work she would most like to bring home from the museum\u2014a treasured reliquary.   Designing for Pig Parts with Zo\u00eb Ryan Former chair and curator of Architecture and Design Zo\u00eb Ryan shares one of her most beloved objects in the collection\u2014a book by designer Christien Meindertsma that encourages us to think critically about how and why objects come into being.   Manipulating Reality through Victorian Photocollage with Liz Siegel Curator of Photography Liz Siegel dives into an object full of subtle surprises\u2014a photocollage by Lady Filmer that presents both a self-portrait and an imagined reality for the artist.   Art You Can't Hold in Your Hands with Jordan Carter Jordan Carter, associate curator, Modern and Contemporary Art, talks about the first artwork he installed at the museum\u2014a piece of conceptual art by Daniel Buren that exists outside of traditional exhibition spaces.   Rembrandt and the Desire for Human Connection with Sam Ramos Sam Ramos, associate director of innovation and creativity, tells viewers about an artwork he loves\u2014a painting by Rembrandt\u2014and explains why he might be afraid to have the artist create his portrait.   Art That Expresses the Inner World with Costa Petridis Costa Petridis, chair and curator of Arts of Africa, reflects on an artwork that makes the invisible visible\u2014a drawing by Belgian artist Fernand Khnopff. ",
            ...
        },
        {
            "id": 459,
            "api_model": "generic-pages",
            "api_link": "https://api.artic.edu/api/v1/generic-pages/459",
            "title": "Project Windows 2020",
            "web_url": "http://www-dev.artic.edu/visit/special-offers/project-windows-2020",
            "copy": " Voting for Project Windows 2020 is now closed. Check out the winners below!   Project Windows 2020 Winners   Art Institute Award Robert Guild Jewelry Best Use of Color Strides by Miyanna Best Use of Light/Technology Bloomingdale's Best Use of Materials Offshore Rooftop & Bar at Navy Pier Chicago Charm Teuscher Chocolates of Switzerland Chicago Style Blick Art Supply Most Amusing Ghirardelli Most Artistic Marshall Pierce & Co. Most Inspiring Macy\u2019s People's Choice Tea Gschwendner   Project Windows 2020 Participants ",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.16"
    },
    "config": {
        "iiif_url": "https://www-test.artic.edu/iiif/2",
        "website_url": "https://www-test.artic.edu"
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
        "total": 211,
        "limit": 10,
        "offset": 0,
        "total_pages": 22,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "id": 43,
            "api_model": "generic-pages",
            "api_link": "https://api.artic.edu/api/v1/generic-pages/43",
            "title": "Chicago Commercial, Residential, and Landscape Architecture, Pre-WWII",
            "timestamp": "2026-09-21T23:39:06-05:00"
        },
        {
            "_score": 1,
            "id": 581,
            "api_model": "generic-pages",
            "api_link": "https://api.artic.edu/api/v1/generic-pages/581",
            "title": "Art as Resistance: A Teen Art Showcase",
            "timestamp": "2026-09-21T23:39:06-05:00"
        },
        {
            "_score": 1,
            "id": 574,
            "api_model": "generic-pages",
            "api_link": "https://api.artic.edu/api/v1/generic-pages/574",
            "title": "Internship and Research Opportunities",
            "timestamp": "2026-09-21T23:39:06-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.15"
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
        "web_url": "http://www-dev.artic.edu/visit/free-admission-opportunities",
        "copy": " RESERVE ONLINE IN ADVANCE   You can reserve your free tickets online in advance ; your resident status will be verified using the zip code associated with the billing address provided. If you're unable to reserve tickets in advance, please stop by the admissions desks on the day of your visit for assistance. Free admission for Illinois residents is supported by   Illinois Educators Free admission is available to current Illinois educators, including pre-K\u201312 teachers, teaching artists working in schools, and homeschool parents. Educators can register online to receive a voucher for a complimentary ticket to the museum. This voucher must be presented\u2014as a printed document or on a smartphone\u2014with a valid educator ID at one of the museum\u2019s admission counters. Chicago Public Library\u2014Explore More Illinois Digital Pass Chicago Public Library cardholders 18 and older can log in at chipublib.org/digitalpasses to reserve free general admission passes to the museum through Explore More Illinois. Please note that this offer is valid only for Chicago Public Library cardholders.   NO ADVANCE TICKET REQUIRED The following groups are invited to visit our galleries at no cost every day. In order to receive your free admission benefits, simply show the corresponding identification at the admissions desk in either museum lobby. Free admission benefits are not single use\u2014you are welcome to use them any time you would like to visit. Be sure to inquire about the availability of special exhibition tickets when you check in at the admissions counter. Kids under 14 Admission is always free for children under 14. These free tickets are available online as well as on-site at the admissions counters. Chicago Teens Museum admission is free for Chicago teens under the age of 18, thanks to the extraordinary generosity of Glenn and Claire Swogger and the Redbud Foundation. See more opportunities and resources for teens . Active-Duty Military As part of the Blue Star Museums program, active-duty service members receive free admission all year long. Plus, from Armed Forces Day through Labor Day, we also welcome service members and their households. Please bring your active-duty military ID to the admissions counter to receive this benefit. LINK and WIC Cardholders As part of Museums for All, LINK and WIC cardholders and anyone in their households receive free general admission to the museum and all ticketed special exhibitions. Simply present your card along with a valid photo ID. University Partners Students of colleges and universities in the University Partner Program are entitled to free general and special exhibition admission by showing a valid student ID at the ticket counter. Check the full list of partnering colleges and universities . Corporate Partners Employees of certain companies in the Corporate Partner Program are entitled to free general and special exhibition admission by showing proof of employment at the ticket counter. Learn more about the Corporate Partner Program . Check the full list of Corporate Partner companies whose employees are entitled to free admission.   More Corporate Partner Opportunities ",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.16"
    },
    "config": {
        "iiif_url": "https://www-test.artic.edu/iiif/2",
        "website_url": "https://www-test.artic.edu"
    }
}
```
:::

#### Landing Pages

_The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for "fair use" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials._

##### `GET /landing-pages`

A list of all landing-pages sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](#landing-pages-2).

###### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

::: details Example request: https://api.artic.edu/api/v1/landing-pages?limit=2  
```js
{
    "pagination": {
        "total": 10,
        "limit": 2,
        "offset": 0,
        "total_pages": 5,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/landing-pages?page=2&limit=2"
    },
    "data": [
        {
            "id": 3,
            "api_model": "landing-pages",
            "api_link": "https://api.artic.edu/api/v1/landing-pages/3",
            "title": "Home",
            "web_url": null,
            "copy": "Mary Cassatt: After Impressionism. Through January 3 Discover the bold and innovative work of Mary Cassatt in this gathering of over 70 experimental and ambitious works made at the height of her career. Tickets to this show are $7 in addition to general admission. Members never need tickets and enjoy two days of member previews and a member-only viewing hour, 10\u201311 a.m., every day we\u2019re open!",
            ...
        },
        {
            "id": 4,
            "api_model": "landing-pages",
            "api_link": "https://api.artic.edu/api/v1/landing-pages/4",
            "title": "Ryan Learning Center",
            "web_url": null,
            "copy": "Room to Draw. What can you discover when you draw? Visit the Trott Family Gallery for this immersive studio experience designed for families, and experiment with creative and unexpected drawing tools and techniques. This installation is inspired by the exhibition Willem de Kooning Drawing, on view in Regenstein Hall June 14\u2013September 20, 2026, and is made possible by The Willem de Kooning Foundation, New York. Educator Resources. Explore accessible resources for your classroom, find support from experienced museum educators for integrating works of art in your teaching, and learn more about professional development opportunities. Family Programs. Inspired by our latest exhibitions, our programs offer creative opportunities for the whole family. The Artist\u2019s Studio. This fall, make a postcard for a loved one inspired by the exhibition Mary Cassatt: After Impressionism . The Patrick G. and Shirley W. Ryan Learning Center (RLC) is the museum\u2019s hub for learning and creativity, a place where you can find art making and interactive experiences all the time.. Whether you\u2019re visiting as a family, as part of a school group, with friends, or on your own, there\u2019s something in the RLC for you. Find out what you can do. Children ages 13 and under must be accompanied by an adult over 18 in the RLC and the museum at all times.  Museum admission is free for Chicago teens under the age of 18, thanks to the extraordinary generosity of Glenn and Claire Swogger and the Redbud Foundation. Lead support for transportation scholarships to the Ryan Learning Center is provided by Sara and Kip Kirkpatrick. K\u201312 student programming at the Art Institute is supported by an anonymous donor. Major support for education at the Art Institute is provided by the James and Madeleine McMullan Family Foundation, Nancy R. Levi, Cari and Michael J. Sacks, Elissa Efroymson and Adnaan Hamid, the Terra Foundation for American Art, the Elizabeth Morse Genius Charitable Trust, the Joseph and Robert Cornell Memorial Foundation, an anonymous donor, and The Barker Welfare Foundation. Additional support is provided by the Burt Family Foundation, Dancing Skies Foundation, Dr. Scholl Foundation, Charles and M.R. Shapiro Foundation, and The Siragusa Family Foundation. BMO is the Corporate Sponsor of Chicago Public Schools Engagement at the Art Institute of Chicago.   Volunteer or Intern with the RLC Find out how to become involved as a volunteer or teen intern in the Ryan Learning Center.  Teens. Meet new people. Look at art. Make art. Be inspired. Find out how to get involved in internships and programs designed by teens, for teens. JourneyMaker. Want to create your own very own museum tour? Visit the JourneyMaker kiosks in the RLC and design a personalized gallery adventure full of fun ideas for looking and responding to art together. Choose from eight different story lines, select your works of art, and print your guide\u2014and then head out to the galleries. You can also make your guide before you arrive . JourneyMaker est\u00e1 disponible en espa\u00f1ol. JourneyMaker \u6709\u4e2d\u6587\u7248\u672c\u3002 Generous support for JourneyMaker is provided by the Woman\u2019s Board of the Art Institute of Chicago. Look, Listen, Touch. Use all your senses to experience a diverse range of materials that artists use to create their works. Plus, try your hand at a pattern-rubbing station featuring patterns inspired by objects in the collection. Located adjacent to the RLC entrance, the Elizabeth Morse Multisensory Gallery is accessible whenever the museum is open. Dive deeper into your sensory exploration by listening to audio stops available through the Art Institute\u2019s free app. You\u2019ll find us at stops 51\u201354 and 56. Teen Art Making. Teens are invited to drop in during Teen Open Studios or take a deeper dive into art-making practices by registering for Teen Studio Workshops. These programs offer the chance to experiment and explore using a variety of media and techniques inspired by our latest exhibitions.  Feedback or Questions Let us know about your experience, or share a picture of something you made at the museum. Email ryanlearningcenter@artic.edu .  Programs for Families and Teens. Drop by the Ryan Learning Center to explore a wide variety of art-making activities. Make with Us. Families, teens, and visitors of all ages\u2014you are invited to come by the Ryan Learning Center\u2019s Art Exchange every day the museum is open to find creative activities and inspiration. (Please note that the Art Exchange cannot accommodate visiting student, youth, or daycare groups.) Families. With free admission for kids under 14 and Chicago teens under 18, the Art Institute is the perfect place for a creative outing with the whole family. Portraits in Partnership. View artworks inspired by Bisa Butler's The Safety Patrol (2018) and made by families and teens as part of the museum's longstanding civic partnerships with Chicago Public Library and Chicago Public Schools. Image: Bisa Butler. The Safety Patrol , 2018. Cavigga Family Trust Fund. \u00a9 2026 Bisa Butler. Experience with Us. The Ryan Learning Center is a sensory-rich space with areas for exploration and play, including spots for building, reading, imagination, and hands-on discovery. It\u2019s also a place where we showcase the creative work of young artists. K\u201312 Student Groups. The museum is a great place for you and your students to learn. Choose from a wide variety of museum experiences that support classroom learning and meet students where they are. Learn With Us. Whether you\u2019re ready to plan your visit or want to dive deeper into programs and resources for learning with the museum, we have tips and tools for you below.",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.16"
    },
    "config": {
        "iiif_url": "https://www-test.artic.edu/iiif/2",
        "website_url": "https://www-test.artic.edu"
    }
}
```
:::

##### `GET /landing-pages/search`

Search landing-pages data in the aggregator. 

###### Available parameters:

* `q` - Your search query
* `query` - For complex queries, you can pass Elasticsearch domain syntax queries here
* `sort` - Used in conjunction with `query`
* `from` - Starting point of results. Pagination via Elasticsearch conventions
* `size` - Number of results to return. Pagination via Elasticsearch conventions
* `facets` - A comma-separated list of 'count' aggregation facets to include in the results.

::: details Example request: https://api.artic.edu/api/v1/landing-pages/search
```js
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
            "_score": 1,
            "id": 14,
            "api_model": "landing-pages",
            "api_link": "https://api.artic.edu/api/v1/landing-pages/14",
            "title": "Videos",
            "timestamp": "2026-08-05T17:05:49-05:00"
        },
        {
            "_score": 1,
            "id": 12,
            "api_model": "landing-pages",
            "api_link": "https://api.artic.edu/api/v1/landing-pages/12",
            "title": "Conservation and Science",
            "timestamp": "2026-08-05T17:05:49-05:00"
        },
        {
            "_score": 1,
            "id": 13,
            "api_model": "landing-pages",
            "api_link": "https://api.artic.edu/api/v1/landing-pages/13",
            "title": "Research Center",
            "timestamp": "2026-08-18T17:35:13-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.15"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "http://www.artic.edu"
    }
}
```
:::

##### `GET /landing-pages/{id}`

A single landing-page by the given identifier.

::: details Example request: https://api.artic.edu/api/v1/landing-pages/1  
```js
{
    "data": {
        "id": 1,
        "api_model": "landing-pages",
        "api_link": "https://api.artic.edu/api/v1/landing-pages/1",
        "title": "Visit",
        "web_url": null,
        "copy": "Mary Cassatt: After Impressionism. Through January 3 Discover the bold and innovative work of Mary Cassatt in this gathering of over 70 experimental and ambitious works made at the height of her career. Tickets to this show are $7 in addition to general admission. Members never need tickets and enjoy two days of member previews and a member-only viewing hour, 10\u201311 a.m., every day we\u2019re open! Museum Map. Take a look at our museum floor plan to get a sense of the museum's layout and mark any must-see spaces. Free Daily Tours. Follow a knowledgeable guide through the galleries on a free tour, offered in English every day at 1:00 and 3:00 and in Spanish on Fridays and Saturdays at 12:00. Your Personal Must-See Tour. Build your very own self-guided museum tour with the works you love. What to See in an Hour. Experience some of the museum\u2019s most iconic works by accessing self-guided tours, like What to See in an Hour, on your phone. Ryan Learning Center. Enjoy creative activities in this space, Wednesdays\u2013Mondays, 11:00\u20133:00, including making a custom museum tour with JourneyMaker. Exhibitions. Be sure to catch the many special exhibitions on view during your visit. Visitor Policies. These guidelines support a welcoming environment for all our visitors to experience the art in our galleries. Dining and Shopping. Grab a bite at one of our caf\u00e9s and be sure to pick up a souvenir of your visit at one of two store locations. Accessibility. The Art Institute offers a range of resources and programs designed for adults and children with disabilities.",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.16"
    },
    "config": {
        "iiif_url": "https://www-test.artic.edu/iiif/2",
        "website_url": "https://www-test.artic.edu"
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
        "total": 392,
        "limit": 2,
        "offset": 0,
        "total_pages": 196,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/press-releases?page=2&limit=2"
    },
    "data": [
        {
            "id": 242,
            "api_model": "press-releases",
            "api_link": "https://api.artic.edu/api/v1/press-releases/242",
            "title": "Charles White: A Retrospective",
            "web_url": "http://www-dev.artic.edu/press/press-releases/242/charles-white-a-retrospective",
            "copy": " Tuesday, January 23, 2018   CHICAGO \u2014Charles White, born and educated in Chicago, was one of the preeminent artists to emerge during the city\u2019s Black Renaissance of the 1930s and 1940s. A passionate mural and easel painter and superbly gifted draftsman, White powerfully interpreted African American history, culture, and lives in striking works that nevertheless have a more universal resonance. Presented by the Art Institute of Chicago and The Museum of Modern Art (MoMA) in New York, Charles White: A Retrospective runs June 8-September 3 at the Art Institute before traveling to MoMA, where it will be on view from October 7, 2018 through January 13, 2019, followed by Los Angeles Museum of Contemporary Art in Spring 2019. Co-curated by Sarah Kelly Oehler, Field McCormick Chair and Curator of American Art, and Esther Adler, Associate Curator, Department of Drawings and Prints, MoMA, the exhibition examines how White explored social and political themes ranging from the ongoing fight for freedom and equality to the dignity and struggles of labor. Throughout his career, he pushed against the boundaries of his media and the figurative tradition in American art.   As an artist, White\u2019s mastery of mediums intersected with social activism, engaging the past and present with an eye toward the future. He defined his essential quest as the discovery of truth, beauty, and dignity of life and people while using an expressive and highly accessible realism. He often drew from history to illuminate inequities contemporary to his time, as Oehler describes in the forthcoming catalogue for the exhibition, \u201cNot content merely to be mindful of the past, White made it his most important artistic theme\u2026 He returned to the past again and again for aesthetic inspiration, explicitly harnessing his creative energies to educate his fellow citizens and promote social equality by producing and displaying inspiring images of historical figures.\u201d   Presented in the 100th anniversary year of the artist\u2019s birth, this exhibition marks the most comprehensive presentation of White\u2019s work since 1982 and unites a selection of his finest paintings, drawings, and prints. This includes fourteen works owned by the Art Institute, drawn in part from the group of forty-three prints by White recently acquired by the Art Institute, of which five were offered as gifts by the artist\u2019s son. This breathtaking collection of White\u2019s prints begins with his work in Mexico during the late\u20131940s, up through his last published lithograph and his most powerful etchings. Organized chronologically, the exhibition examines the development of White\u2019s practice, from his emergence as a force in the Chicago art world through his mature career as an artist, activist, and educator in New York and Los Angeles. The exhibition deepens understanding of White\u2019s artistic oeuvre, looking in particular at his output through the lens of Chicago\u2019s unique cultural and artistic communities and the city\u2019s broader contributions to American art history. Together, the featured works speak to White\u2019s universal appeal and continued relevance to audiences today.   A full catalogue featuring essays by organizing curators Sarah Kelly Oehler and Esther Adler accompanies the exhibition. Additional essayists include Ilene Susan Fort, Curator Emerita of American Art at Los Angeles County Museum of Art; Kellie Jones, Associate Professor in Art History and Archaeology and the Institute for Research in African American Studies (IRAAS) at Columbia University; Mark Pascale, Janet and Craig Duchossois Curator of Prints and Drawings, the Art Institute of Chicago; and Deborah Willis, University Professor and Chair of the Department of Photography and Imaging at the Tisch School of the Arts at New York University.Sponsors   Image: Charles White. Harvest Talk , 1953. \u00a9 The Charles White Archives Inc. ",
            ...
        },
        {
            "id": 45,
            "api_model": "press-releases",
            "api_link": "https://api.artic.edu/api/v1/press-releases/45",
            "title": "Press Releases from 1983",
            "web_url": "http://www-dev.artic.edu/press/press-releases/45/press-releases-from-1983",
            "copy": " To obtain the full text of any news releases in this index, please contact the Institutional Archives at reference@artic.edu or (312) 443-4777.   January 3, 1983 Mauritshuis: 17th Century Dutch Painting from the Royal Picture Gallery, organized by The National Gallery of Art, Washington, D.C.; bicentennial of Dutch-American diplomatic relations; exhibition venues, catalogue by director of The Mauritshuis Dr. Hans Hoetink; complementary exhibitions of works by Dutch Masters from AIC Permanent collection in the galleries of Prints and Drawings, European Paintings, and Textiles 88-90, 94, 115 January 21, 1983 \"Living National Treasures\" of Japan, exhibition and craft making demonstrations, Children's festival of Japanese Arts, programs and schedule 91-93 February 3, 1983 Mauritshuis: 17th Century Dutch Painting, related events, films and lectures; curator of European Painting Department Richard Brettell 88-90, 94-95, 115 February 10, 1983 Betty and Edwin Bergman Collection, gift of Joseph Cornell objects; comments by AIC Director James N. Wood, and Curator of 20th Century Art Department A. James Speyer 96-98, 149 February 22, 1983 Highlights of Arms and Armor from the George F. Harding Collection, exhibition, consulting curator Leonid Tarassuk; the Collection history and acquisition; remarks by AIC Chairman Arthur W. Schultz 99-101, 149 March 3, 1983 Photographs and Portfolios by Paul Strand, exhibition of works loaned from private and public collections; curator of Photography Department David Travis; exhibition venues 102-103 Photographs by Jerry Gordon, exhibition of works loaned by the artist; curator of Photography Department David Travis 104 March 17, 1983 Six Centuries of European Decorative Arts from the Permanent Collection, exhibition, reinstallation in Gunsaulis Hall, curator of European Decorative Arts Lynn Springer Roberts 105-106 ; symposium 111-112 March 21, 1983 Perspectives on Contemporary Realism: The Jalane and Richard Davidson Collection, traveling exhibition, AIC showing coordinated by curator of Prints and Drawings Department Harold Joachim; Collection history; catalogue by Frank H. Goodyear, Jr., of Pennsylvania Academy of Fine Arts 107-108 March 24, 1983 The Vatican Collection: The Papacy and Art, announcement 150 , attendance and ticket information 109-110, 129-130, 148, 175-176 ; lectures 153-154 ; complementary exhibitions from Permanent Collection: A Legacy of Rome: Church Architecture in Chicago 133 Junior Museum: Vatican Discovered 133 The Lure of Rome: Five Centuries in the Eternal City, organized by the Department of Prints and Drawings and the Ryerson and Burnham Libraries 140-141 Vestments and Liturgical Textiles 144-145 April 7, 1983 The Age of Grandeur: European Decorative Arts in the 17th Century , symposium in conjunction with renovation and reinstallation of Gunsaulis Hall; The Antiquarian Society of AIC, Samuel A. Marx Fund, Mrs. James Ward Thorne Fund; related events 105-106, 111-112 April 14, 1983 Ansel Adams: An American Place, 1936, photography exhibition re-creating the 1936 show held in Alfred Stieglitz Gallery in New York, catalogue by guest curator Andrea Gray; AIC showing coordinated by curator of Photography Department David Travis; exhibition venues 113-114 April 18, 1983 17th Century Textile Treasures from the Permanent Collection, show complementing The Mauritshuis Museum exhibition, curator of Textiles Department Christa Thurman 115 Campaign for Chicago's Masterpiece, fund-raising drive for Museum building restoration and construction of the South Wing; announcement by Chairman of AIC Board of Trustees Arthur W. Schultz; comments by Chairman of the Campaign Marshall Field 116-118, 191 April 26, 1983 Acquisition of two works from Claude Monet's Haystack series, partial gift of Mr. and Mrs. Daniel Searle; Museum Major Acquisition Fund, de-accessioning of several Impressionist paintings through Christies's sales 119-120 April 28, 1983 Henry Moore's Large Interior Form (1982), gift from Henry Moore Foundation of Hertfordshire, U. K.; installation of the sculpture in Museum's Northwest Garden, project by Bruce Graham of Skidmore, Owings & Merril; remarks by AIC Director James N. Wood; related exhibition and events 121-122 May 2, 1983 New Chicago Architecture: Beyond the International Style, recent work by Chicago architectural firms, exhibition curated by John Zukowsky and Robert Bruegman; catalogue included in Inland Architect magazine (May/June 1983) 123-124, 149 May 3, 1983 Ivan Mestrovich's Two American Indians , restoration of sculptures (downtown Chicago) made possible by The Benjamin F. Ferguson Fund under direction of AIC Board of Trustees; examination and restoration by Washington University Technical Associates (WUTA) of St. Louis; comments by conservator Timothy Lennon, Department of Conservation at AIC 125-126 May 5, 1983 Photography and Architecture: 1839-1939, exhibition from The Canadian Center for Architecture, Montreal; US and European venues, catalogue 127-128 May 9, 1983 The Vatican Collections: The Papacy and Art, exhibition, Ticketron and Tele-tron services; Membership Department 129-130 Neil J. Hoffman, appointed President of SAIC; announcement by AIC Chairman Arthur W. Schultz 131-132 May 20, 1983 The Vatican Collections: The Papacy and Art, related events and complementary exhibitions 133 Puppet Week programs for preschoolers featuring noted puppeteer companies, schedule 134-135 May 23, 1983 An Open Land: Photographs of the Midwest 1852-1982, traveling exhibition sponsored by Open Land Project and organized by photographer Rhondal McKinney and curator of Photography Department David Travis, catalogue 136-137 June 6, 1983 The Betty and Edwin Bergman Joseph Cornell Collection, gift, gallery installation designed by architectural firm Krueck & Olsen of Chicago 138-139, 149, 168 June 9, 1983 The Lure of Rome: Five Centuries in the Eternal City, exhibition organized by AIC Prints and Drawings Department, AIC Ryerson and Burnham Libraries, and The Newberry Library (Chicago), complementing The Vatican exhibition 140-141 June 23, 1983 Chicago: The Architectural City, photography exhibition in celebration of 150th anniversary of the city of Chicago, guest curator Kathleen Lamb; The Prince Charitable Trusts of Chicago, grant 142-143, 149 August 5, 1983 The Sustaining Fellows $2.1 million contribution, chairman David C. Hilliard and president Norman Ross; remarks by Chairman of The Board of Trustees Arthur W. Schultz; reception in McKinlock Court 146-147 August 19, 1983 The Vatican Collection: The Papacy and Art, attendance record 148 Exhibition Schedule for August 1983 - June 1984, 149-152 August 25, 1983 Lecture series featuring The Vatican Collection: The Papacy and Art exhibition 153-154 August 29, 1983 Art Today series, Hayden Herrera, Dore Ashton 155 September 7, 1983 Recent Acquisitions, 1982-83, exhibition curator Deborah Frumkin of Photography Department; The Photographic Society purchases 156 Lars Sonck, 1870-1956, Finnish architecture exhibition as a part of Scandinavia Today Program of The American Scandinavian Foundation, catalogue 158-159 September 12, 1983 The 1983 Chicago Chapter, American Institute of Architects (AIA) Award, AIA architectural competitions in the USA, exhibition of prize-winning Chicago-area firms 157-158 September 16, 1983 The National Endowment for the Arts (NEA) $1 million challenge grant to AIC; announcement by Chairman of The Board of Trustees Arthur W. Schultz 160-161 September 26, 1983 Alfred Stieglitz, retrospective; Georgia O'Keeffe, donation of Stieglitz Photography collection; exhibition catalogue 150, 162-164, 167 September 29, 1983 Nancy Outside in July: Etchings by Jim Dine, exhibition, curator of Prints and Drawings Ester Sparks; Aldo Crommelynck and Jim Dine, gift of prints to Museum; exhibition venues and catalogue published by the Universal Limited Art Editions (ULAE) 150, 165-167 October 1983 Monthly Calendar Exhibition schedule and public programs, including The Junior Museum, The Film Center, The Art Rental and Sales Gallery, and SAIC 167-171 October 6, 1983 The Campaign for Chicago's Masterpiece, $49.25 million five-year fund-raising drive, Museum expansion and renovation 116-118 ; comments by AIC Chairman Arthur W. Schultz and AIC Director James N. Wood; joint gift from Marshall Field and the McCormick Family for Field/McCormick American Wing; various contributions; press conference and dinner for art patrons of Midwest 172-174 October 26, 1983 The Vatican Collection: The Papacy and Art, attendance and budget record; comments by AIC president E. Laurence Chalmers, Jr., 175-176 October 31, 1983 Faberge: Selections from the FORBES Magazine Collection, exhibition from Malcolm S. Forbes Collection (New York) 177-178 November 3, 1983 TOPS: The Chicago Architectural Club 1983 Juried Exhibition, Chicago's skyline concept drawings, curator of Architecture Pauline Saliga; The Chicago Architectural Journal documenting exhibition 179-180 November 7, 198 Aqua Lapis: Embroidered Wall Sculpture by Nancy Hemenway, 1975-1983; curator of Textile Department Christa Thurman; exhibition venues and catalogue 151, 181-182 November 14, 1983 The Pennsylvania Germans: A Celebration of Their Arts, 1683-1850, exhibition organized by Philadelphia Museum of Art, catalogue 151, 183-184 November 21, 1983 Junior Museum, Painting: From the Ground Up, exhibition curated by director of AIC Junior Museum Lois Raasch 185 November 28, 1983 Mrs. James W. Alsdorf, Warren L. Batts, John H. Bryan, and Daniel C. Searle elected AIC Trustees; Arthur M. Wood, James W. Alsdorf, Mrs. Frederic Clay Bartlett (born Evelyn Fortune), and Ivan Albright named Life Trustees of AIC; other officers elected at the Annual Meeting of The Board of Trustees 186-187 November 29, 1983 Dr. Harold Joachim (1909-1983), Curator of the Department of Prints and Drawings, obituary 188-189 December 15, 1983 Computerized display system installed in accordance with The Campaign for Chicago's Masterpiece, donations from Museum visitors for restoration of Allerton building glass roof 190 (116-118) December 22, 1983 Grant Wood: The Regionalist Vision, exhibition organized by The Minneapolis Museum of Art; the Chicago Tribune grant; exhibition history of Grant Wood's American Gothic and selection of cartoons and parodies based on the painting; exhibition venues and catalogue; related events and lectures 151, 191-196 ",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.16"
    },
    "config": {
        "iiif_url": "https://www-test.artic.edu/iiif/2",
        "website_url": "https://www-test.artic.edu"
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
        "total": 394,
        "limit": 10,
        "offset": 0,
        "total_pages": 40,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "id": 24,
            "api_model": "press-releases",
            "api_link": "https://api.artic.edu/api/v1/press-releases/24",
            "title": "Press Releases from 1962",
            "timestamp": "2026-09-22T23:42:15-05:00"
        },
        {
            "_score": 1,
            "id": 23,
            "api_model": "press-releases",
            "api_link": "https://api.artic.edu/api/v1/press-releases/23",
            "title": "Press Releases from 1961",
            "timestamp": "2026-09-22T23:42:15-05:00"
        },
        {
            "_score": 1,
            "id": 22,
            "api_model": "press-releases",
            "api_link": "https://api.artic.edu/api/v1/press-releases/22",
            "title": "Press Releases from 1960",
            "timestamp": "2026-09-22T23:42:15-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.15"
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
        "web_url": "http://www-dev.artic.edu/press/press-releases/1/press-releases-from-1939",
        "copy": " To obtain the full text of any news releases in this index, please contact the AIC Archives at archives@artic.edu .   January 6, 1939 Scammon Lecture, The Spirit of Modern Building , given by Dr. Walter Curt Behrendt, Technical Director of Buffalo City Planing Association, N.Y., 1 January 7, 1939 Turkish and Italian Textiles in Paintings , lecture, given by Alan J. B. Wace, Keeper of Textiles in the Victoria and Albert Museum and professor of Classical Archaeology, Cambridge, England; members of Chicago Needlework and Textile Guild, listed 2 January 20, 1939 Lecture series, given by Dr. Maurice Gnesin, Director of Goodman Theatre and Head of AIC Goodman School of Drama 3 January 11, 1939 Comments on exhibitions: The French Romanticists Gros, Gericault, and Delacroix; Exhibition of Bonnard and Villard, Contemporary French Artists; Christmas Story in Art; George Grosz, His Art from 1918 to 1938; Architecture by Ludwig Mies Van Der Rohe; 34 Old Master Drawings, Lent by Sir Robert Witt of London; gallery tour for the Second Conference of Chicago Art Clubs 4-5 January 13, 1939 AIC major exhibitions of 1938, attendance record from Museum Registrar's Department 6 January 14, 1939 Scammon Lecture, Turner's Romantic Vision of Switzerland , given by Dr. Paul Ganz, Professor at University of Basle, Switzerland, biography note and publications 8 January 18, 1939 28th Annual Governing Members' Meeting, hosted by AIC President Mr. Potter Palmer; luncheon, list of participants 7 January 19, 1939 Kate S. Buckingham Memorial Lecture, Chinese Bronzes , given by AIC Assistant Director and Curator of Oriental Art Department Charles Fabens Kelley 9 January 21, 1939 The National Exhibition of Representative Buildings of the Post War Period, exhibition, organized and curated by American Institute of Architecture (AIA) 12 January 23, 1939 Annual Report for 1938, issued by Director of Fine Arts Daniel C. Rich and Director of Finance and Operation Charles H. Burkholder; major gifts and donations; Robert Allerton, gift for construction of the Decorative Arts Galleries; Mrs. Erna Sawyer Goodman, money gift, establishing William Owen Goodman Fund; attendance, membership, SAIC enrollment; major bequest of Ms. Kate Buckingham; Mrs. William O. Goodman Collection of pewter, gift to AIC; Superintendent's report on condition of skylight roof; Bartlett Lecture Series; funding for lectures and publications 10-11 Pablo Picasso: Forty Years of His Art, exhibition announcement, first collaborative project of AIC and The Museum of Modern Art, N.Y., 13, 102 January 25, 1939 43rd Annual Exhibition by Artists of Chicago and Vicinity, jury comprised of Donald Bear of Denver Art Museum, Clarence Carter of Carnegie Institute, Pittsburgh, and artists Mahonri H. Young of New York and Albin Polasek of Chicago; list of prizes 14, 19-20, 23, 25 January 26, 1939 Kate S. Buckingham Memorial Lecture, Chinese Terra Cotta Tiles , given by AIC Assistant Director and Curator of Oriental Art Department Charles Fabens Kelley 15 January 30, 1939 A Leading School of Buddhist Sculpture , lecture given by Dr. Osvald Siren of National Museum in Stockholm; biography note and comments on his collection and publications 16 SAIC 6th Annual Open House for alumni, governing members, trustees, friends of the School and officials; Glee Club concert under direction of AIC Assistant Director and Curator of Oriental Art Charles Kelley 17 January 31, 1939 Chicago High School Scholarship contest at SAIC; list of winners, Judith Pesman, Suzanne Siporin, Emil Grego, Joanne Kuper, and Joseph Strickland 18 Exhibition of Contemporary American Art at New York World's Fair 1939; proceedings and requirements; Chicago juries of New York World's Fair, represented by Aaron Bohrod, Ralph Clarkson, Mitchell Siporin, Daniel C. Rich (chairman of the Painting Jury), Sidney Loeb, Peterpaul Ott, Albin Polasek, George Thorp, Todros Geller, James Swann, Morris Topchevsky, Beatrice Levy, Charles Wilimovsky, and Lillian Combs 19-20 February 2, 1939 Kate S. Buckingham Memorial Lecture, Chinese Sculpture and Painting , given by AIC Assistant Director and Curator of Oriental Art Department Charles Fabens Kelley 21 February 4, 1939 Scammon Lecture, Six Dynasties and Early T'ang Painting , given by Laurence Sickman, curator of Oriental Art at William Rockhill Nelson Gallery of Art, Kansas City, MO; biography note 22 February 6, 1939 43rd Annual Exhibition by Artists of Chicago and Vicinity, opening, Artists' Dinner, hosted by AIC Director of Finance and Operation Charles H. Burkholder; guest speaker George Buehr, other guests included Mr. and Mrs. Potter Palmer, Mr. Paul Schulze, Mr. and Mrs. Charles Fabens Kelley, Mrs. Albion Headburg, and Ms. Eleanor Jewett 14, 19-20, 23, 25 February 13, 1939 The Making of a Cartoon , lecture and film demonstration, conducted by cartoonist of the Chicago Daily News Vaughn R. Shoemaker, complementing exhibition titled Original American Cartoons from Charles L. Howard Collection 24 February 14, 1939 AIC Exhibition Calendar for 1939 In the Department of Painting and Sculpture, curator Daniel Catton Rich, AIC Director: Chicago and Vicinity 43rd Annual Exhibition; Masterpiece of the Month: Portrait of Mrs. Wolff by Sir Thomas Lawrence; 18th International Exhibition of Watercolors; Annual Exhibition by Students of SAIC; 50th Annual Exhibition of American Painting and Sculpture: Half a Century of American Art 25 In the Children's Museum, curator Helen Mackenzie: The Making of a Masterpiece, exhibition, featuring altarpiece by Giovanni di Paolo of Sienna; Means and Methods of Water Color Painting 25 In the Blackstone Hall: Original American Cartoons from the Collection of Charles L. Howard of Chicago 26 In the Oriental Art Department, Curator Charles Fabens Kelley: two exhibitions from AIC Clarence Buckingham Collection of Japanese Prints, titled In Wind and Rain, and Blossom Viewing; Masterpiece of the Month: Imperial Jade Cup on Stand, 18th C., gift of Russell Tyson 26 In Prints Department, Acting Curator Lillian Combs: Selections from Lenora Hall Gurley Memorial Collection of Drawings; Recent Accessions in Prints, 1937-1939; Woodcuts from Books of the 15th Century; Masterpiece of the Month: The Lamentation from the Great Passion by Albrecht Durer; Prints by Old Masters from Clarence Buckingham Collection; The Bulls of Bordeaux by Francesco Goya; Sports in Prints 26 In the Decorative Arts Department, Curator Bessie Bennett: French Furniture and Sculpture, 18th C. from Henry Dangler Collection; Florence Dibell Bartlett Collection of Bonader from Sweden, 18th and 19th C.; English Architecture of 18th C.; Embroideries from The Greek Islands Lent by Elizabeth Day McCormick; Ecclesiastical Embroideries; English Embroideries; Exhibition of Embroideries by the Needlework and Textile Guild 27 General Information about Permanent collection and admission 27 February 15, 1939 Florence Dibell Bartlett Lecture, Adventures in the Arts , given by Helen Parker, Head of AIC Education Department 28 February 20, 1939 Antiquarian Society, Tea Party, honoring Elizabeth Day McCormick and exhibition of Embroideries from the Greek Islands; party specialties and participants 29, 59, 61 February 21, 1939 George Washington's Birthday, free Museum admission; Washington's portraits in AIC Permanent collection 30 February 25, 1939 Scammon Lecture, The Fountains of Florence , given by Bertha Wiles, Curator of Mark Epstein Library at University of Chicago 31 February 28, 1939 Scammon Lecture, The Artistic Relations of England and Italy , given by William George Constable of Boston Museum of Fine Arts; biography note, Mr. Constable, founder of the Courtauld Institute in London 33 March 2, 1939 New Light on Prehistoric Man , lecture and film demonstration, presented by Dr. Henry Field, and sponsored by Chicago Chapter of Archaeological Institute of America 32 Kate S. Buckingham Lecture, The Gothic Room , given by Bessie Bennett, AIC Curator of Decorative Arts 34 March 8, 1939 Goodman Theatre, performance of Alice in Wonderland for children from settlement houses and orphanages; list of participating institutions 36 March 9, 1939 Kate S. Buckingham Lecture, Prints by Old Masters, Including Rembrandt , given by Edith R. Abbot, artist and educator of The Metropolitan Museum, N.Y., biography note about Ms. Abbot 37 March 15, 1939 Frederick Arnold Sweet, appointed Assistant Curator of AIC Painting and Sculpture Department; Mr. Sweet's resume 38 March 17, 1939 Kate S. Buckingham Lectures, Master Etchers of the 19th Century , given by Head of Education Department Helen Parker; The English Lustre Ware Collection, given by AIC Director Daniel C. Rich 39 March 20, 1939 Opening reception for 18th International Water Color Show, works on view, including loans from Edward Hopper, John Whorf, and Henri Matisse 35 March 23, 1939 18th Annual International Water Color Exhibition; prizes and works on view; jury comprised of Grant Wood, Joseph W. Jicha of Cleveland, and Hubert Ropp of Chicago; concurrent exhibition in the AIC Children's Museum, explaining water color technique; biography notes about prize-winners, Everett Shinn and Dale Nichols 35, 40-42, 5I-52, 64 March 24, 1939 Kate S. Buckingham Lecture, The English Lustre Ware Collection , given by AIC Director Daniel C. Rich 43 March 28, 1939 AIC Curator of Decorative Arts Department Bessie Bennett (1870-1939), obituary; Ms. Bennet's AIC tenure, biography note, remarks by AIC President Mr. Potter Palmer 44-45 April 3, 1939 Easter Festivities at AIC, Monsalvat , performance by Dudley Crafts Watson; SAIC Glee Club concert under direction of Charles Fabens Kelley, sponsored in part by Mrs. James Ward Thorne 46 April 6, 1939 Albin Polasek, Head of Sculpture Department at SAIC, honored with award of merit by the National Institute of Immigrant Welfare, N.Y.; biography note and chronology 47-48 April 11, 1939 Glee Club, Eastern concert program 46, 49 50th Annual Exhibition of American Painting and Sculpture: Half a Century of American Art, retrospective, showing works from American Annual exhibitions held at AIC from 1888 to 1938; comments on the exhibition selection by AIC Director Daniel C. Rich 25, 50 3rd Conference of Art Chairmen; AIC Assistant Curator of Painting and Sculpture Frederick A. Sweet, speaking on 18th International Water Color Exhibition, comments and criticism 40-42, 51-52, 64 April 13, 1939 Kate S. Buckingham Lecture, The Early Development of Chinese Pottery , given by AIC Assistant Director and Curator of Oriental Art Department Charles Fabens Kelley 53 April 17, 1939 SAIC group exhibition at Paul Theobald's Gallery in Chicago, showing abstractionist paintings done in the class of Willard G. Smythe 54 April 20, 1939 Kate S. Buckingham Lecture, The Great Period of Pottery and the Beginnings of Porcelain , given by AIC Assistant Director and Curator of Oriental Art Department Charles Fabens Kelley; attendance record of the Lecture Series 55 April 25, 1939 Europe, Asia, Africa: A Common Civilization , lecture, given by Melville J. Herskovits of Northwestern University, Evanston, IL, 56 Art Quiz, booklet by Head of Education Department Helen Parker, published in support for AIC Museum programs 57 April 27, 1939 Kate S. Buckingham Lecture, The Great Porcelains of the Ming and Ch'ing Dynasties, given by AIC Assistant Director and Curator of Oriental Art Department Charles Fabens Kelley 58 May 2, 1939 Antiquarian Society, Tea Party, featuring speech by AIC Director Daniel C. Rich, titled Decorative Arts in the Museum of Tomorrow ; members of the Society, listed 59 May 5, 1939 Goodman Theatre dance series, featuring Spanish dancer Clarita Martin, Ms. Martin's remarks 60 May 6, 1939 Antiquarian Society, Spring Meeting; Tea Party marking the Exhibition of Embroideries from Greek Islands in Elizabeth Day McCormick Collection; special gallery arrangements provided by Mrs. Walter S. Brewster, Mrs. Charles S. Dewey, Mrs. James Ward Thorne, Mrs. C. Morse Ely, and Mrs. Chauncey McCormick 29, 59, 61-62 May 9, 1939 Antiquarian Society Tea Party, decorative floral display available for public viewing 62 May 12, 1939 5th Annual Exhibition by Student Janitors of SAIC, participants and Fellowship awards 63 May 12, 1939 18th International Water Color Exhibition, attendance record; list of works sold from the show 35, 40-42, 51-52, 64 May 13, 1939 Annual Exhibition of the Needlework and Textile Guild of AIC, opening; works on view and participants 65-66 May 22, 1939 Foreign Travelling Fellowships, awarded to SAIC Student Janitors by AIC Officials and members of SAIC Faculty; award recipients Murray Jones, Edward Voska, biography notes 67 May 23, 1939 SAIC Glee Club concert, program and performers 68 May 26, 1939 Free Museum admission on Memorial Day; special exhibitions: Glass Paperweights from Mrs. John H. Bergstrom Collection; Japanese Surimono Prints, lent by Ms. Helen C. Gunsaulus; Chinese Jades from Mrs. Edward Sonnenschein Collection; Ms. Elizabeth Day McCormick Collection of Embroideries 69 June 2, 1939 Room of Recent Accessions, opening; new gallery, designated for exhibitions in The Masterpiece of the Month Series, and displaying new additions to Permanent collection; works shown at the opening; comments by AIC Director Daniel C. Rich 70-71 June 6, 1939 Art Students League of SAIC, prizes given to the League members; awards made possible through the gift of Mrs. William O. Goodman 72 June 8, 1939 Free Summer Lectures, French and German Primitives by Gibson Danes of Northwestern University, Evanston, IL; Paintings of the High Renaissance in Italy by SAIC instructor Briggs Dyer; Dutch and Flemish Old Masters by AIC Assistant Curator of Painting Frederick A. Sweet 73 June 9, 1939 SAIC Annual Commencement Exercises, graduation announcement at Goodman Memorial Theatre, conducted by AIC Vice President Mr. Chauncey McCormick; Invocation and Benediction pronounced by Minister of New England Church, Rev. Theodore Hume; student prizes, AIC Glee Club performance; guest list 74 June 10, 1939 AIC Director Daniel Catton Rich, named Chairman of Jury at San Francisco Golden Gate International Exposition 75 June 13, 1939 AIC Exhibition Calendar for 1939 Summer Exhibitions In the Department of Painting and Sculpture, curator AIC Director Daniel Catton Rich: Annual Exhibition of Works by SAIC Students; Costumes and Folk Art from Central Europe from Florence Dibell Bartlett Collection; Whistleriana, the artist's memorabilia from Walter Brewster Collection; Water Color Drawings by Thomas Rowlandson; Paintings by Lester O. Schwartz; Memorial Exhibition of Paintings by Pauline Palmer; Memorial Exhibition of Paintings by Carl Rudolf Krafft; Chinese Porcelains from the Goodman, Crane, Patterson, and Salisbury Collections; Lithographs by Odilon Redon; 50th Annual Exhibition of American Painting and Sculpture: Half a Century of American Art 76-77, 83 In the Children's Museum, curator Helen Mackenzie: Exhibition of Work by Children in the Saturday Classes of SAIC 77 From exhibition series The Making of the Masterpiece, showing At the Moulin Rouge by Toulouse-Lautrec 77 The Masterpiece of the Month, exhibition series introduced 77-78 In the Oriental Art Department, curator Charles Fabens Kelley: Chinese Jades from the Collection of Mr. and Mrs. Edward Sonnenschein; Japanese Surimono, lent by Ms. Helen C. Gunsaulus; Pottery of the Ming Dynasty 78, 83 In the Department of Prints and Drawing, Acting Curator Lilian Combs: Prints by Old Masters from Clarence Buckingham Collection; Sports in Prints; Sporting Prints and Drawings from the Collection of Mr. Joel Spitz of Chicago; Half a Century of American Prints; The Lenora Hall Curley Memorial Collection of Drawings; British Landscape Prints by Seymour Haden and David Young Cameron; Portraiture in Prints from Clarence Buckingham Collection; 7th International Exhibition of Lithography and Wood Engraving 78-79, 83 In the Decorative Arts Department: Exhibition of Paperweights from the Collection of Mrs. John N. Bergstrom; French Furniture from Henry C. Dangler Collection; Bonader from Sweden, Florence Dibell Bartlett Collection; English Architecture of the 18th C.; Exhibition of Embroideries from the Greek Islands, English and Ecclesiastical Embroideries from the Collection of Elizabeth Day McCormick 79, 83 Various announcements: invitation for train passengers to visit AIC on the way to the World's Fair in New York and San Francisco Golden Gate Exposition; attendance, lectures, Museum hours and orientation 79-80 June 13, 1939 General Education Board of Rockefeller Foundation, grant for three year project on art education in Chicago High Schools, conducted under supervision of Head of AIC Education Department Helen Parker 81 July 14, 1939 Chinese Art , free lecture series given by AIC Assistant Director and Curator of Oriental Art Charles Fabens Kelley; weekend gallery talks 82 July 18, 1939 Notes on Summer Exhibitions 83 July 22, 1939 Lectures and Gallery tours, given by AIC Assistant Curator for Painting and Sculpture Frederick A. Sweet, Gibson Danes of Northwestern University, Evanston, IL, and Briggs Dyer of SAIC 84 Weekly News Letter (Walter J. Sherwood, ed.); Nine Summer Exhibitions: Costumes and Folk Art from Eastern Europe lent by Florence D. Bartlett; Paintings by Carl Rudolf Krafft, School of the Ozark Painters; Pauline Palmer's paintings, works on view; Exhibition of Lester O. Schwartz, SAIC alumnus; Exhibition of Whistleriana from the collection of Walter S. Brewster, works on view; Water Colors by Thomas Rowlandson; Chinese Porcelains and Jades from Chicago Collections; Lithographs by Odilon Redon, from Martin A. Ryerson Collection; renovation of Permanent collection display; El Greco, lecture by assistant curator of Painting and Sculpture Frederick A. Sweet; note on the death of the mural painter Alphonse Mucha and the 1908 lecture series, titled Harmony in Art , given by the artist in AIC 137-138 July 25, 1939 Invitation to free music concert in Blackstone Hall, organist Max Allen, pianist Eleanor Gullett 85 July 29, 1939 Weekly News Letter (Walter J. Sherwood, ed.); The Masterpiece of the Month, exhibition series, Rembrandt's etching, titled Christ Preaching on display; paintings by winners of AIC Annuals Peter Hurd, Millard Sheets, Esther Williams, Nicolai Ziroli, John Whorf, William Zorach, and Georges Schreiber, acquired by The Metropolitan Museum in New York; free gallery lecture series, given by Briggs Dyer of SAIC and Gibson Danes of Northwestern University, Evanston, IL; gallery tours by Addis Osborne, SAIC alumnus; AIC catalogue of Summer exhibitions 139-141 August 1, 1939 Lectures and gallery talks, given by Briggs Dyer of SAIC, and Addis Osborne, SAIC alumnus 86-88, 90 August 5, 1939 Weekly News Letter (Lester Bridaham, ed.); Kenneth Goodman Memorial Theatre, improvements and additions; Decorative Arts Department Galleries in the Allerton Wing, construction, made possible by Vice-President and Chairman of the Committee of Decorative Arts, Mr. Robert Allerton; Wendell Stevenson, SAIC alumnus, commission of portraiture; SAIC Summer classes extended; Summer School at Saugatuck, MI, classes of Charles Willimovsky, SAIC Director Frederick Fursman, and Don Loving; 50th Annual Exhibition of American Painting and Sculpture: Half a Century of American Art, exhibition announcement; excepts from Time and Newsweek magazines, commenting on AIC Summer exhibitions; Sporting Prints from the Collection of Joel Spitz, exhibition 142-144 August 8, 1939 Briggs Dyer's Sunday Lecture Series gained public acclaim 87 August 12, 1939 Weekly News Letter; lectures and classes given by artists and SAIC alumni Leon R. Pescheret and Addis Osborne, and SAIC professors Edmund Giesbert and Briggs Dyer; Odilon Redon Lithographs, exhibition of works acquired by Martin A. Ryerson from the artist's widow, remarks by AIC Trustee Arthur T. Aldis; painting by Robert B. Harshe, AIC Director from 1921 to 1938, awarded honorable mention at Fine Arts Exhibition of the Golden Gates Exposition, excerpt from The Magazine of Art , May issie 145-147 August 15, 1939 Notes on Briggs Dyer's lectures 88 August 18, 1939 Membership Lecture, One-Plate Color Etching , given by SAIC instructor Leon R. Pescheret 89 August 19, 1939 Weekly News Letter; Student Honorable Mentions for the year 1939; AIC Curator Frederick A. Sweet, inquiring about locations of paintings for inclusion into 50th Annual Exhibition of American Painting and Sculpture: Half a Century of American Art, list of desired works; Assistant in AIC Decorative Arts Department Helen Mitchell, awarded Fellowship at Yale University; The Chicago Museum Tour Committee, providing two-day tour and booklet for Chicago visitors in cooperation with AIC and other cultural institutions, list of the Committee members 148-150 August 22, 1939 Lectures and gallery talks, given by SAIC instructors Briggs Dyer and Addis Osborne, and Head of AIC Education Department Helen Parker 90 Weekly News Letter; Masterpiece of the Month, exhibition series, showing Persian brocade of the Safavid period, the reign of Shah Abbas (1587-1628), gift of Mr. John R. Thompson of Chicago, description and comments; Contemporary Fine Arts Building at the New York World's Fair, AIC ranked as the most popular museum outside New York; Oriental jades from AIC Sonnenschein Collection, shown at The Golden Gate Exposition in San Francisco; free Museum admission on Labor Day; AIC Fall lecture series, titled The Great White Way to San Francisco Bay , given by Dudley Crafts Watson, reflecting on New York World's Fair, The Golden Gate Exposition in San Francisco, and US Museums 151-153 August 29, 1939 Notes on Exhibition of East European Costumes from Florence D. Bartlett Collection and other displays 91 September 2, 1939 SAIC announcing Student registration for the year 1940; colored post cards and reproductions of works from AIC Permanent collection, supplied by New York office of Vienna publisher Max Jaffe, list of titles available at AIC Reproduction Desk; gallery tours, conducted by Head of AIC Education Department Helen Parker and Briggs Dyer of SAIC; general Museum information, record of School, Museum offices and workshops, Shipping Room, and Museum Registrar in the Archives Department; Fall program in Fullerton Hall, opened with lecture series about home decoration, given by Dudley Crafts Watson 154-156 September 11, 1939 Lectures, Paintings of the High Renaissance in Italy , given by Helen Parker, and Dutch and Flemish Old Masters , given by Briggs Dyer 92 September 13, 1939 Meyric R. Rogers, appointed AIC Curator of Decorative Arts Department, replacing late Ms. Bessie Bennett; Mr. Rogers, concurrently appointed Head of Industrial Arts Department, newly formed in AIC; biography note, publications, and remarks by AIC President Potter Palmer and AIC Director of Fine Arts Daniel C. Rich 93-94 September 19, 1939 Week of the American Legion Convention, free Museum admission for the Legion members, announcement by AIC Director of Finance and Operation C. H. Burkholder 95-96 September 22, 1939 American Legion Parade, free Museum admission for the public 95-96 September 25, 1939 AIC Department of Education, programs and lectures, featuring SAIC instructor Mary Hipple, Head of Education Department Helen Parker, Ramsey Wieland, and George Buehr; film demonstrations on art techniques, supplemented by gallery tours 97 September 28, 1939 Sunday Lectures, French and English Paintings of the 17th and 18th Century , given by SAIC instructor George Buehr, and French Decorative Arts , given by assistant in Education Department Ramsey Wieland 100 September 30, 1939 Fiestas in Guatemala , lecture by Erna Fergusson, introducing Scammon Lecture Series for the year 101 October 1, 1939 Masterpiece of the Month, exhibition series, St. John on Patmosby Nicolas Poussin ; comparative displays in Impressionist galleries 98-99 October 2, 1939 Picasso Retrospective, planned by Alfred H. Barr, Director and Vice President of The Museum of Modern Art, N. Y. (MOMA), and Daniel C. Rich, AIC Director of Fine Arts; announcement on exhibition dates; war time exhibition, the first collaborative project by MOMA and AIC 13, 102 October 4, 1939 The Adventures in the Arts , lecture series conducted by Head of Education Department Helen Parker; attendance record for AIC lectures; Costumes from Florence Dibell Bartlett Collection on display 103 October 5, 1939 7th International Exhibition of Lithography and Wood-Engraving, US tour exhibition, jury comprised of artists Peggy Bacon, Asa Cheffetz, and Todros Geller; The Logan Prize for Prints, announced 104 October 7, 1939 Scammon Lecture, The Educational Viewpoint in an Art Museum , given by Dr. Thomas Munro of Cleveland Museum of Art; biography note and publications 105 October 12, 1939 Exhibition of Chinese Pottery and Porcelain, lent by Chicago collectors Mrs. William O. Goodman, Mrs. Richard T. Crane, Mrs. Alice H. Patterson, and Mrs. W. W. Kimball (courtesy of Mrs. Warren Salisbury and Mr. Kimball Salisbury) 106 October 14, 1939 Scammon Lecture, Armor of Renaissance Princes , given by Curator of Arms and Armors in The Metropolitan Museum Stephen V. Grancsay; the 1893 exhibition of Arms and Armor, held at the Chicago Columbian Exposition and featuring Mr. Grancsay's lecture 107 October 20, 1939 Motion Pictures in the Arts , special program in association with 7th International Exhibition of Lithography and Wood-Engraving, conducted by Head of Education Department Helen Parker; film screening, featuring woodcut artists and illustrators, Lynd Ward, Timothy Cole, and Chaim Gross 108 October 21, 1939 Scammon Lecture, The Art of Our Early Cabinet Makers , given by Edwin J. Hipkiss of Boston Museum of Fine Arts; biography note and publications 109 October 26, 1939 SAIC Glee Club concert of Negro Spirituals, conducted by AIC Assistant Director and Curator of Oriental Art Department Charles Fabens Kelley, and featuring musicians Virgil Espenlaub, Juanita Krunk, and Eleanor Gullett; numbers performed 110 October 27, 1939 Scammon Lecture, French Medieval Sculpture in America , given in association with opening of The Cloisters Museum in New York, by James J. Rorimer of The Metropolitan Museum; remarks by Mr. H. E. Winlock, formerly Director of The Metropolitan Museum; publications by Mr. Rorimer 111 October 28, 1939 50th American Exhibition: Half a Century of American Art, opening reception featuring tea table decorations from different periods, sponsored and arranged by The Antiquarian Society, The Municipal Art League, Art Institute Alumni, The Renaissance Society, The Arts Club, etc.; listing of representatives and participants 25, 50, 77, 112, 120-121 November 1, 1939 Masterpieces of Italian Art, exhibition lent by the Royal Italian Government to San Francisco World's Fair, special announcement on exclusive showing at AIC 113-114, 116-119, 122, 123, 125, 129, 131,132, 134 November 6, 1939 Scammon Lecture, Colonial American Portraiture , given by Alan Burroughs of Harvard University; biography note and publications 115 November 9, 1939 Masterpieces of Italian Art, exhibition lent by the Royal Italian Government to San Francisco World's Fair, shipment of art works to Chicago for exclusive showing at AIC and official ceremonies upon arrival, the route of procession to AIC 116 November 11, 1939 Masterpieces of Italian Art, exhibition lent by the Royal Italian Government to San Francisco World's Fair; honorary committees and Chicago sponsors for exclusive AIC showing 117-119 November 14, 1939 50th Annual Exhibition of American Painting and Sculpture: Half a Century of American Art, opening reception arranged by Antiquarian Society and Fortnightly Club, description of table decoration and list of hostesses 120-121 November 17, 1939 Masterpieces of Italian Art, exhibition, opening ceremonies featuring opera singer Hilde Reggiani 122 November 21, 1939 Free Museum admission on Thanksgiving Day; Radio program and special lectures, supplementing Masterpieces of Italian Art Exhibition 123 November 27, 1939 Scammon Lecture, featuring American sculptor William Zorach 124 December 1, 1939 Masterpieces of Italian Art, exhibition, related discussion on using tempera technique 125 December 2, 1939 Scammon Lecture, Precursors of the New Architecture , given by John Barney Rodgers of Armour Institute of Technology; biography note 126 December 5, 1939 Glee Club, Christmas concert, directed by AIC Assistant Director Charles Fabens Kelley 127 December 7, 1939 Masterpieces of Italian Art, exhibition; extended hours for late evening viewing; special musical programs, gallery tours, and Christmas events 129 December 9, 1939 Scammon Lecture, dedicated to sculptor Carl Milles, given by curator of Decorative Arts Department Meyric R. Rogers 128 December 12, 1939 Armour Institute of Technology Musical Club, free concert including AIC Glee Club performance 130 December 14, 1939 Masterpieces of Italian Art, exhibition, evening concerts; Joseph Bentonelli, lyric tenor, performing from the Museum Grand Staircase 131 December 18, 1939 Masterpieces of Italian Art, exhibition, evening concerts; Choir of the Church of Saint Thomas the Apostle 132 December 19, 1939 Free Museum admission on Christmas Day; Listing of current exhibitions 133 December 26, 1939 Masterpieces of Italian Art, exhibition, Italian Day in the Museum, free admission declared by Royal Italian Government 134 December 27, 1939 Free museum admission on New Year's Day; current exhibitions and lectures 135 ",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.16"
    },
    "config": {
        "iiif_url": "https://www-test.artic.edu/iiif/2",
        "website_url": "https://www-test.artic.edu"
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
        "total": 65,
        "limit": 2,
        "offset": 0,
        "total_pages": 33,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/educator-resources?page=2&limit=2"
    },
    "data": [
        {
            "id": 99,
            "api_model": "educator-resources",
            "api_link": "https://api.artic.edu/api/v1/educator-resources/99",
            "title": "Tips for Discussing Works of Art",
            "web_url": "http://www-dev.artic.edu/educator-resources/99/tips-for-discussing-works-of-art",
            "copy": " Discussions about works of art can take many forms. Keeping the following suggestions in mind will ensure that the discussion is meaningful and inclusive. ",
            ...
        },
        {
            "id": 34,
            "api_model": "educator-resources",
            "api_link": "https://api.artic.edu/api/v1/educator-resources/34",
            "title": "Educator Resource Packet: Shukongojin",
            "web_url": "http://www-dev.artic.edu/educator-resources/34/educator-resource-packet-shukongojin",
            "copy": " The Art Institute\u2019s figure of Shukongojin, with his demon-like body, flaring eyes, and mouth stretched in a scream, might have originally terrified an oncoming visitor to the temple he guarded, but might have also instilled a sense of protection and reassurance for the visitor who hoped nothing would disturb his meditations once inside. For the viewer today, Shukongojin looks down from his rock-like pedestal, imposing both a sense of awe and curiosity about the target of his aggressive presence. This teaching packet includes an essay, discussion questions, activity ideas, a glossary, and an image of the artwork. ",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.16"
    },
    "config": {
        "iiif_url": "https://www-test.artic.edu/iiif/2",
        "website_url": "https://www-test.artic.edu"
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
        "total": 66,
        "limit": 10,
        "offset": 0,
        "total_pages": 7,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "id": 175,
            "api_model": "educator-resources",
            "api_link": "https://api.artic.edu/api/v1/educator-resources/175",
            "title": "Thinking Creatively: Exploring Artists' Choices",
            "timestamp": "2026-09-22T23:45:06-05:00"
        },
        {
            "_score": 1,
            "id": 173,
            "api_model": "educator-resources",
            "api_link": "https://api.artic.edu/api/v1/educator-resources/173",
            "title": "Alma Thomas: A Closer Look",
            "timestamp": "2026-09-22T23:45:06-05:00"
        },
        {
            "_score": 1,
            "id": 134,
            "api_model": "educator-resources",
            "api_link": "https://api.artic.edu/api/v1/educator-resources/134",
            "title": "Diego Rivera: A Closer Look",
            "timestamp": "2026-09-22T23:45:06-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.15"
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

::: details Example request: https://api.artic.edu/api/v1/educator-resources/12  
```js
{
    "data": {
        "id": 12,
        "api_model": "educator-resources",
        "api_link": "https://api.artic.edu/api/v1/educator-resources/12",
        "title": "Educator Resource Packet: A Boy in Front of the Loews 125th Street Movie Theater, from the series Harlem, U.S.A",
        "web_url": "http://www-dev.artic.edu/educator-resources/12/educator-resource-packet-a-boy-in-front-of-the-loews-125th-street-movie-theater-from-the-series-harlem-usa",
        "copy": " A Boy in Front of the Loews 125th Street Movie Theater is one of thirty photographs that constitute Harlem, U.S.A. , Dawoud Bey\u2019s first significant body of work. In this series, he explores a multitude of approaches towards representing the identities of Harlem and its black residents. This teaching packet includes an essay, discussion questions, activity ideas, a glossary, and images of three photographs from the series. ",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.16"
    },
    "config": {
        "iiif_url": "https://www-test.artic.edu/iiif/2",
        "website_url": "https://www-test.artic.edu"
    }
}
```
:::

#### Digital Publications

_The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for "fair use" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials._

##### `GET /digital-publications`

A list of all digital-publications sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](#digital-publications-2).

###### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

::: details Example request: https://api.artic.edu/api/v1/digital-publications?limit=2  
```js
{
    "pagination": {
        "total": 23,
        "limit": 2,
        "offset": 0,
        "total_pages": 12,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/digital-publications?page=2&limit=2"
    },
    "data": [
        {
            "id": 37,
            "api_model": "digital-publications",
            "api_link": "https://api.artic.edu/api/v1/digital-publications/37",
            "title": "Perspectives on Data",
            "web_url": "http://www-dev.artic.edu/digital-publications/37/perspectives-on-data",
            "copy": "<h1>Perspectives on Data</h1><p>This publication, the second in the three-volume <em>Perspectives</em> series, explores the potentials and pitfalls of using data and data-oriented approaches in art, art history, and museums through essays, interviews, and a video that address topics such as data analysis and visualization, the design of collection management systems, and the representation of provenance.</p><p>Mapping Senufo: Making Visible Debatable Information and Situated Knowledge<br/>About<br/>Iterative Pasts and Linked Futures: A Feminist Approach to Modeling Data in Archives and Collections of Artists\u2019 Publishing<br/>Make Slow, Make Long<br/>Crowdsourcing Metadata in Museums: Expanding Descriptions, Access, Transparency, and Experience<br/>Digital Methods for Inquiry into the Eurocentric Structure of Architectural History Surveys<br/>Contributions<br/>The Sound and Voice of Violent Things: Against the Silence of Data Visualization<br/>The Human Shape of Data<br/>Credits<br/>Taking Care of History: Toward a Politics of Provenance Linked Open Data in Museums<br/>Director&#8217;s Foreword<br/></p>",
            ...
        },
        {
            "id": 36,
            "api_model": "digital-publications",
            "api_link": "https://api.artic.edu/api/v1/digital-publications/36",
            "title": "Perspectives on In/stability",
            "web_url": "http://www-dev.artic.edu/digital-publications/36/perspectives-on-instability",
            "copy": "<h1>Perspectives on In/stability</h1><p>This publication, the first in the three-volume <em>Perspectives</em> series, explores how stability and instability manifest in and shape artworks, the narratives we tell about them, and how we present them.</p><p>About<br/>Contributions<br/>Stability Isn&#8217;t Everything It&#8217;s Glitched Up to Be: An Interview with Jamie Fenton<br/>Edo Spaces, European Images: Iterations of Art and Architecture of Benin<br/>Forces of In/stability<br/>Credits<br/>Seven-Figure Settlements and Paid Days Off: An Interview with Devin Kenny<br/>From Cloth to Clay: Identities and Im/permanence in Moche Ceramics<br/>Seeking Balance: Material and Meaning in a Polychrome Guanyin<br/>Director&#8217;s Foreword<br/>The Color of Fire Is Flux<br/>Empty Fields Revisited<br/></p>",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.16"
    },
    "config": {
        "iiif_url": "https://www-test.artic.edu/iiif/2",
        "website_url": "https://www-test.artic.edu"
    }
}
```
:::

##### `GET /digital-publications/search`

Search digital-publications data in the aggregator. 

###### Available parameters:

* `q` - Your search query
* `query` - For complex queries, you can pass Elasticsearch domain syntax queries here
* `sort` - Used in conjunction with `query`
* `from` - Starting point of results. Pagination via Elasticsearch conventions
* `size` - Number of results to return. Pagination via Elasticsearch conventions
* `facets` - A comma-separated list of 'count' aggregation facets to include in the results.

::: details Example request: https://api.artic.edu/api/v1/digital-publications/search
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
            "id": 51,
            "api_model": "digital-publications",
            "api_link": "https://api.artic.edu/api/v1/digital-publications/51",
            "title": "Ivan Albright Paintings at the Art Institute of Chicago",
            "timestamp": "2026-09-22T23:48:02-05:00"
        },
        {
            "_score": 1,
            "id": 42,
            "api_model": "digital-publications",
            "api_link": "https://api.artic.edu/api/v1/digital-publications/42",
            "title": "Ancient Egyptian Art at the Art Institute of Chicago",
            "timestamp": "2026-09-22T23:48:02-05:00"
        },
        {
            "_score": 1,
            "id": 48,
            "api_model": "digital-publications",
            "api_link": "https://api.artic.edu/api/v1/digital-publications/48",
            "title": "Monet Paintings and Drawings at the Art Institute of Chicago",
            "timestamp": "2026-09-22T23:48:02-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.15"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "http://www.artic.edu"
    }
}
```
:::

##### `GET /digital-publications/{id}`

A single digital-publication by the given identifier.

::: details Example request: https://api.artic.edu/api/v1/digital-publications/2  
```js
{
    "data": {
        "id": 2,
        "api_model": "digital-publications",
        "api_link": "https://api.artic.edu/api/v1/digital-publications/2",
        "title": "American Silver",
        "web_url": "http://www-dev.artic.edu/digital-publications/2/american-silver",
        "copy": " American Silver in the Art Institute of Chicago showcases the museum's superb collection of American silver. In-depth essays relate a fascinating story about eating, drinking, and entertaining that spans the history of the Republic and traces the development of the museum\u2019s holdings of American silver over nearly a century, and a catalogue incorporates detailed analysis of objects written by leading specialists. This digital augmentation of the 2017 publication provides stunning high-resolution photography and, for a select number of objects, three-dimensional captures that allow for close viewing. In addition, this edition includes an extensive illustrated checklist of additional objects.   Edited by Elizabeth McGoey with contributions by Debra Schmidt Bach, David L. Barquist, Judith A. Barter, Jennifer Goldsborough, Medill Higgins Harvey, Patricia Kane, Elizabeth McGoey, Barbara K. Schnitzer, Janine E. Skerry, Ann Wagner, Gerald W. R. Ward, Deborah Dependahl Waters, Beth Carver Wees, and Elizabeth A. Williams   American Silver in the Art Institute of Chicago is free and has received major support for this catalogue is provided by the Henry Luce Foundation. It is also made by possible by the generosity of the Community Associates of the Art Institute of Chicago, Mr. and Mrs. Henry M. Buchbinder, Carl and Marilynn Thoma, Louise Ingersoll Tausche, Jamee and Marshal Field V, Kay Bucksbaum, Celia and David Hilliard, and Jan and Bill Jentes. ",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.16"
    },
    "config": {
        "iiif_url": "https://www-test.artic.edu/iiif/2",
        "website_url": "https://www-test.artic.edu"
    }
}
```
:::

#### Digital Publication Articles

_The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for "fair use" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials._

##### `GET /digital-publication-articles`

A list of all digital-publication-articles sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](#digital-publication-articles-2).

###### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

::: details Example request: https://api.artic.edu/api/v1/digital-publication-articles?limit=2  
```js
{
    "pagination": {
        "total": 28,
        "limit": 2,
        "offset": 0,
        "total_pages": 14,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/digital-publication-articles?page=2&limit=2"
    },
    "data": [
        {
            "id": 51,
            "api_model": "digital-publication-articles",
            "api_link": "https://api.artic.edu/api/v1/digital-publication-articles/51",
            "title": "About",
            "web_url": "http://www-dev.artic.edu/digital-publications/36/perspectives-on-instability/content#about",
            "copy": null,
            ...
        },
        {
            "id": 50,
            "api_model": "digital-publication-articles",
            "api_link": "https://api.artic.edu/api/v1/digital-publication-articles/50",
            "title": "Works",
            "web_url": "http://www-dev.artic.edu/digital-publications/34/malangatana-mozambique-modern/content#works",
            "copy": null,
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.16"
    },
    "config": {
        "iiif_url": "https://www-test.artic.edu/iiif/2",
        "website_url": "https://www-test.artic.edu"
    }
}
```
:::

##### `GET /digital-publication-articles/search`

Search digital-publication-articles data in the aggregator. 

###### Available parameters:

* `q` - Your search query
* `query` - For complex queries, you can pass Elasticsearch domain syntax queries here
* `sort` - Used in conjunction with `query`
* `from` - Starting point of results. Pagination via Elasticsearch conventions
* `size` - Number of results to return. Pagination via Elasticsearch conventions
* `facets` - A comma-separated list of 'count' aggregation facets to include in the results.

::: details Example request: https://api.artic.edu/api/v1/digital-publication-articles/search
```js
{
    "preference": null,
    "pagination": {
        "total": 29,
        "limit": 10,
        "offset": 0,
        "total_pages": 3,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "id": 3,
            "api_model": "digital-publication-articles",
            "api_link": "https://api.artic.edu/api/v1/digital-publication-articles/3",
            "title": "Acknowledgments",
            "timestamp": "2026-09-22T23:51:06-05:00"
        },
        {
            "_score": 1,
            "id": 41,
            "api_model": "digital-publication-articles",
            "api_link": "https://api.artic.edu/api/v1/digital-publication-articles/41",
            "title": "Director's Foreword",
            "timestamp": "2026-09-22T23:51:07-05:00"
        },
        {
            "_score": 1,
            "id": 30,
            "api_model": "digital-publication-articles",
            "api_link": "https://api.artic.edu/api/v1/digital-publication-articles/30",
            "title": "Director's Foreword",
            "timestamp": "2026-09-22T23:51:07-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.15"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "http://www.artic.edu"
    }
}
```
:::

##### `GET /digital-publication-articles/{id}`

A single digital-publication-article by the given identifier.

::: details Example request: https://api.artic.edu/api/v1/digital-publication-articles/1  
```js
{
    "data": {
        "id": 1,
        "api_model": "digital-publication-articles",
        "api_link": "https://api.artic.edu/api/v1/digital-publication-articles/1",
        "title": "Director's Foreword",
        "web_url": "http://www-dev.artic.edu/digital-publications/34/malangatana-mozambique-modern/1/directors-foreword",
        "copy": " The Art Institute of Chicago has been at the forefront of American museums in collecting and displaying modern art since the early twentieth century, and boasts an ongoing commitment to extending this vital legacy with research, publications, and exhibitions. In that spirit, a number of our curators came together in 2013 for a series of discussions exploring ideas about modern art, in particular the ways in which it manifests across our collections. This gave rise to the Modern Series, a set of three experimental, challenging, and provocative exhibitions and publications that are co-organized by curators across departments, with divergent but complementary specialties. The two previous iterations\u2014 Shatter Rupture Break (February 15\u2013May 3, 2015) and Go (February 23\u2013June 4, 2017)\u2014sought to present the museum\u2019s holdings in departments including Arts of the Americas, Modern and Contemporary Art, Photography and Media, and Textiles in fresh and exciting ways. Malangatana: Mozambique Modern (July 30\u2013November 16, 2020), the third and final project in the series, expands our understanding of modernism and modern art in a global context by bringing the work of celebrated Mozambican artist Malangatana Ngwenya (1936\u20132011) into conversation with our own international collection. It not only showcases the evolution in style and content within his early paintings and drawings, but also contextualizes his practice within the social and political conditions that framed the emergence of modern art in Mozambique and across the African continent. The exhibition also contributed to the cultivation of a more global perspective on artistic creation and its representation in the museum, both by providing the basis for this publication and, not least, by prompting us to acquire a painting and six works on paper by Malangatana for our permanent collection. Africa and its diasporas, with their deep history and wide geographical reach, occupy a prominent place within global art history and modern art that merits many more such efforts and programs in the years to come. Our colleagues\u2014notably Sarah Guernsey, Ann Goldstein, and Greg Nosan\u2014deserve my sincere gratitude for their continuing critical support for the Modern Series. But I am especially thankful to the exhibition\u2019s curators, Hendrik Folkerts, Felicia Mings, and Constantine Petridis, for introducing our staff and visitors to the fascinating milieu and work of Malangatana Ngwenya and for helping the Art Institute expand its representation of modern art from around the world. This exhibition would not have been possible without the generosity of the individuals and institutions in the United States, Portugal, and Mozambique who lent works from their collections. I am particularly grateful to the Malangatana Valente Ngwenya Foundation in Maputo for its invaluable loan of a significant number of paintings and drawings. Major funding for Malangatana: Mozambique Modern was provided by Sylvia Neil and Dan Fischel and the Alfred L. McDougal and Nancy Lauter McDougal Fund for Contemporary Art. Additional support is contributed by the Society for Contemporary Art through the SCA Activation Fund and the Miriam U. Hoover Foundation. Members of the Luminary Trust provide annual leadership support for the museum\u2019s operations, including exhibition development, conservation and collection care, and educational programming. The Luminary Trust includes an anonymous donor; Neil Bluhm and the Bluhm Family Charitable Foundation; Jay Franke and David Herro; Karen Gray-Krehbiel and John Krehbiel, Jr.; Kenneth Griffin; Caryn and King Harris, The Harris Family Foundation; Josef and Margot Lakonishok; Robert M. and Diane v.S. Levy; Ann and Samuel M. Mencoff; Sylvia Neil and Dan Fischel; Anne and Chris Reyes; Cari and Michael J. Sacks; and the Earl and Brenda Shapiro Foundation. Most importantly, I acknowledge with deepest thanks the intellectual and financial support of Sylvia Neil and Dan Fischel, who have provided crucial funding for the realization of this catalogue as well as the previous two in the Modern Series. Their ongoing commitment has enabled and encouraged our continued explorations into the possibilities of digital publication. James Rondeau President and Eloise W. Martin Director ",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.16"
    },
    "config": {
        "iiif_url": "https://www-test.artic.edu/iiif/2",
        "website_url": "https://www-test.artic.edu"
    }
}
```
:::

#### Printed Publications

_The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for "fair use" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials._

##### `GET /printed-publications`

A list of all printed-publications sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](#printed-publications-2).

###### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

::: details Example request: https://api.artic.edu/api/v1/printed-publications?limit=2  
```js
{
    "pagination": {
        "total": 216,
        "limit": 2,
        "offset": 0,
        "total_pages": 108,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/printed-publications?page=2&limit=2"
    },
    "data": [
        {
            "id": 38,
            "api_model": "printed-publications",
            "api_link": "https://api.artic.edu/api/v1/printed-publications/38",
            "title": "The Lithographs of James McNeill Whistler",
            "web_url": "http://www-dev.artic.edu/print-publications/38/the-lithographs-of-james-mcneill-whistler",
            "copy": " This two-volume study presents the lithographic work of James McNeill Whistler (American, 1834-1903) in thorough technical and contextual detail. Volume I, a catalogue raisonn\u00e9, contains entries for each of Whistler's 179 lithographs, and is illustrated with reproductions of near-facsimile quality. The essays situate Whistler's work in lithography within a broader art-historical context. Volume II features transcriptions of more than 170 letters exchanged between Whistler and his London printers, Thomas Way and T. R. Way. Also included are a discussion of Whistler's lithographic techniques and an illustrated chronological account of the artist's marketing strategies. A compilation of watermarks reproduces at actual size those found in lithographs printed in Whistler's lifetime and posthumously. The Lithographs of James McNeill Whistler constitutes an important contribution to Whistler studies and to the study of nineteenth-century printmaking.   Edited by Martha Tedeschi   2-volume, boxed set, 992 pages, 8 7/8 x 12 3/4 in. 864 ills. Out of print ISBN: 978-0-86559-150-9 (hardcover) ",
            ...
        },
        {
            "id": 11,
            "api_model": "printed-publications",
            "api_link": "https://api.artic.edu/api/v1/printed-publications/11",
            "title": "Altered and Adorned: Using Renaissance Prints in Daily Life",
            "web_url": "http://www-dev.artic.edu/print-publications/11/altered-and-adorned-using-renaissance-prints-in-daily-life",
            "copy": " Today Renaissance-era prints are typically preserved behind glass or in solander boxes in museums, but these decorative objects were once a central part of everyday life. Altered and Adorned is a delightful, surprising look at how prints were used: affixed on walls; glued into albums, books, and boxes; annotated; hand-colored; or cut apart.   This handsome volume introduces readers to the experimental world of printmaking in the mid-fifteenth through early seventeenth centuries and the array of objects it inspired, from illustrated books, sewing patterns, and wearable ornaments to sundials, other astronomical instruments, and anatomical prints. It features many treasures from the Art Institute of Chicago\u2019s rich permanent collection that have never before been published, along with essays on the ways prints functioned\u2014in some cases as three-dimensional and interactive works\u2014and how their condition communicates their past use.   Suzanne Karr Schmidt With a contribution by Kimberly Nichols   112 pages, 9 x 12 in. 98 color ills. Out of print ISBN: 978-0-300-16911-9 (hardcover) ",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.16"
    },
    "config": {
        "iiif_url": "https://www-test.artic.edu/iiif/2",
        "website_url": "https://www-test.artic.edu"
    }
}
```
:::

##### `GET /printed-publications/search`

Search printed-publications data in the aggregator. 

###### Available parameters:

* `q` - Your search query
* `query` - For complex queries, you can pass Elasticsearch domain syntax queries here
* `sort` - Used in conjunction with `query`
* `from` - Starting point of results. Pagination via Elasticsearch conventions
* `size` - Number of results to return. Pagination via Elasticsearch conventions
* `facets` - A comma-separated list of 'count' aggregation facets to include in the results.

::: details Example request: https://api.artic.edu/api/v1/printed-publications/search
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
            "id": 235,
            "api_model": "printed-publications",
            "api_link": "https://api.artic.edu/api/v1/printed-publications/235",
            "title": "Mary Cassatt: After Impressionism",
            "timestamp": "2026-09-22T23:54:06-05:00"
        },
        {
            "_score": 1,
            "id": 181,
            "api_model": "printed-publications",
            "api_link": "https://api.artic.edu/api/v1/printed-publications/181",
            "title": "Mirroring China\u2019s Past: Emperors, Scholars, and Their Bronzes",
            "timestamp": "2026-09-22T23:54:06-05:00"
        },
        {
            "_score": 1,
            "id": 186,
            "api_model": "printed-publications",
            "api_link": "https://api.artic.edu/api/v1/printed-publications/186",
            "title": "John Singer Sargent and Chicago\u2019s Gilded Age",
            "timestamp": "2026-09-22T23:54:06-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.15"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "http://www.artic.edu"
    }
}
```
:::

##### `GET /printed-publications/{id}`

A single printed-publication by the given identifier.

::: details Example request: https://api.artic.edu/api/v1/printed-publications/4  
```js
{
    "data": {
        "id": 4,
        "api_model": "printed-publications",
        "api_link": "https://api.artic.edu/api/v1/printed-publications/4",
        "title": "The Art Institute of Chicago: The Essential Guide",
        "web_url": "http://www-dev.artic.edu/print-publications/4/the-art-institute-of-chicago-the-essential-guide",
        "copy": " The Essential Guide presents the diverse holdings of the Art Institute\u2019s collections. Featuring more than three hundred objects, it provides a journey through time\u2014from ancient Egypt until the present day\u2014and across the globe. Beautifully illustrated with short texts about each work, the publication includes beloved icons such as Georges Seurat\u2019s Sunday on La Grande Jatte\u20141884 and Edward Hopper\u2019s Nighthawks , as well as exciting recent acquisitions like a Teotihuacan shell mask, Marcel Duchamp\u2019s readymade Bottle Rack , and Thomas Hart Benton\u2019s Cotton Pickers . Read about objects currently on view in the galleries as well as exquisite textiles and works on paper that, because of the fragility of their materials, are less frequently shown. Use it as a guide to the museum or a souvenir of your visit. Four distinctive covers\u2014one great book! Choose your favorite cover image by Katsushika Hokusai, Archibald Motley Jr., Georgia O\u2019Keeffe, or Georges Seurat.   Foreword by James Rondeau   352 pages, 6 x 9 x 1 in. 335 color ills. Softcover $25 ($22.50 members) ISBN 978-0-86559-301-5 ",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.16"
    },
    "config": {
        "iiif_url": "https://www-test.artic.edu/iiif/2",
        "website_url": "https://www-test.artic.edu"
    }
}
```
:::

#### Hours

_The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for "fair use" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials._

##### `GET /hours`

A list of all hours sorted by last updated date in descending order. For a description of all the fields included with this response, see [here](#hours-2).

###### Available parameters:

* `ids` - A comma-separated list of resource ids to retrieve
* `limit` - The number of resources to return per page
* `page` - The page of resources to retrieve
* `fields` - A comma-separated list of fields to return per resource

::: details Example request: https://api.artic.edu/api/v1/hours?limit=2  
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
            "id": 39,
            "api_model": "hours",
            "api_link": "https://api.artic.edu/api/v1/hours/39",
            "title": null,
            "monday_is_closed": false,
            "monday_member_open": "PT10H00M",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.16"
    },
    "config": {
        "iiif_url": "https://www-test.artic.edu/iiif/2",
        "website_url": "https://www-test.artic.edu"
    }
}
```
:::

##### `GET /hours/search`

Search hours data in the aggregator. 

###### Available parameters:

* `q` - Your search query
* `query` - For complex queries, you can pass Elasticsearch domain syntax queries here
* `sort` - Used in conjunction with `query`
* `from` - Starting point of results. Pagination via Elasticsearch conventions
* `size` - Number of results to return. Pagination via Elasticsearch conventions
* `facets` - A comma-separated list of 'count' aggregation facets to include in the results.

::: details Example request: https://api.artic.edu/api/v1/hours/search
```js
{
    "preference": null,
    "pagination": {
        "total": 1,
        "limit": 10,
        "offset": 0,
        "total_pages": 1,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "id": 39,
            "api_model": "hours",
            "api_link": "https://api.artic.edu/api/v1/hours/39",
            "title": null,
            "timestamp": "2026-09-23T16:00:10-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.15"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "http://www.artic.edu"
    }
}
```
:::

##### `GET /hours/{id}`

A single hour by the given identifier.

::: details Example request: https://api.artic.edu/api/v1/hours/39  
```js
{
    "data": {
        "id": 39,
        "api_model": "hours",
        "api_link": "https://api.artic.edu/api/v1/hours/39",
        "title": null,
        "monday_is_closed": false,
        "monday_member_open": "PT10H00M",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.16"
    },
    "config": {
        "iiif_url": "https://www-test.artic.edu/iiif/2",
        "website_url": "https://www-test.artic.edu"
    }
}
```
:::

