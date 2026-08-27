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
        "total": 132132,
        "limit": 2,
        "offset": 0,
        "total_pages": 66066,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/artworks?page=2&limit=2"
    },
    "data": [
        {
            "id": 19777,
            "api_model": "artworks",
            "api_link": "https://api.artic.edu/api/v1/artworks/19777",
            "is_boosted": false,
            "title": "Beauty Reading a Letter",
            "alt_titles": null,
            ...
        },
        {
            "id": 88962,
            "api_model": "artworks",
            "api_link": "https://api.artic.edu/api/v1/artworks/88962",
            "is_boosted": false,
            "title": "The Autumn Moon in the Mirror (Kyodai no shugetsu), from the series \"Eight Views of the Parlor (Zashiki hakkei)\"",
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
        "version": "1.15"
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
        "total": 132681,
        "limit": 10,
        "offset": 0,
        "total_pages": 13269,
        "current_page": 1
    },
    "data": [
        {
            "_score": 119.3978,
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
            "timestamp": "2026-08-25T23:27:23-05:00"
        },
        {
            "_score": 110.62245,
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
            "timestamp": "2026-08-27T12:06:54-05:00"
        },
        {
            "_score": 109.40296,
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
            "timestamp": "2026-08-26T15:19:32-05:00"
        }
    ],
    "info": {
        "license_text": "The `description` field in this response is licensed under a Creative Commons Attribution 4.0 Generic License (CC-By) and the Terms and Conditions of artic.edu. All other data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.14"
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
        "version": "1.15"
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
        "total": 16835,
        "limit": 2,
        "offset": 0,
        "total_pages": 8418,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/agents?page=2&limit=2"
    },
    "data": [
        {
            "id": 57698,
            "api_model": "agents",
            "api_link": "https://api.artic.edu/api/v1/agents/57698",
            "title": "Jean Baptiste Claude Sen\u00e9",
            "sort_title": "Sen\u00e9, Jean Baptiste Claude",
            "alt_titles": [
                "Jean B. C. Sen\u00e9",
                "Jean-Baptiste-Claude Sen\u00e9",
                "Claude Sen\u00e9, II"
            ],
            ...
        },
        {
            "id": 53675,
            "api_model": "agents",
            "api_link": "https://api.artic.edu/api/v1/agents/53675",
            "title": "John B. Flannagan",
            "sort_title": "Flannagan, John B.",
            "alt_titles": [
                "John Bernard Flannagan"
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
        "version": "1.15"
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
        "total": 16955,
        "limit": 10,
        "offset": 0,
        "total_pages": 1696,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "id": 4094,
            "api_model": "agents",
            "api_link": "https://api.artic.edu/api/v1/agents/4094",
            "title": "Winifred B. Carpenter",
            "timestamp": "2026-08-27T11:16:06-05:00"
        },
        {
            "_score": 1,
            "id": 4098,
            "api_model": "agents",
            "api_link": "https://api.artic.edu/api/v1/agents/4098",
            "title": "Giulio Carpioni",
            "timestamp": "2026-08-27T11:16:06-05:00"
        },
        {
            "_score": 1,
            "id": 4099,
            "api_model": "agents",
            "api_link": "https://api.artic.edu/api/v1/agents/4099",
            "title": "Will Carqueville",
            "timestamp": "2026-08-27T11:16:06-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.14"
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
        "version": "1.15"
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
        "total": 4170,
        "limit": 2,
        "offset": 0,
        "total_pages": 2085,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/places?page=2&limit=2"
    },
    "data": [
        {
            "id": 35360,
            "api_model": "places",
            "api_link": "https://api.artic.edu/api/v1/places/35360",
            "title": "Rockport",
            "latitude": 42.65,
            "longitude": -70.6167,
            ...
        },
        {
            "id": 33508,
            "api_model": "places",
            "api_link": "https://api.artic.edu/api/v1/places/33508",
            "title": "Siwa Oasis",
            "latitude": 29.1923,
            "longitude": 25.5275,
            ...
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
        "total": 4182,
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
        "version": "1.14"
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
        "version": "1.15"
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
            "id": 25210,
            "api_model": "galleries",
            "api_link": "https://api.artic.edu/api/v1/galleries/25210",
            "title": "Gallery 188",
            "latitude": 41.880030773499,
            "longitude": -87.621987295079,
            ...
        },
        {
            "id": 23967,
            "api_model": "galleries",
            "api_link": "https://api.artic.edu/api/v1/galleries/23967",
            "title": "Gallery 283",
            "latitude": 41.880226482055,
            "longitude": -87.622314524958,
            ...
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
        "total": 5,
        "limit": 10,
        "offset": 0,
        "total_pages": 1,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "id": 2147480173,
            "api_model": "galleries",
            "api_link": "https://api.artic.edu/api/v1/galleries/2147480173",
            "title": "Gallery 109",
            "timestamp": "2026-08-12T15:22:41-05:00"
        },
        {
            "_score": 1,
            "id": 23999,
            "api_model": "galleries",
            "api_link": "https://api.artic.edu/api/v1/galleries/23999",
            "title": "Gallery 184",
            "timestamp": "2026-08-13T12:12:52-05:00"
        },
        {
            "_score": 1,
            "id": 23998,
            "api_model": "galleries",
            "api_link": "https://api.artic.edu/api/v1/galleries/23998",
            "title": "Gallery 183",
            "timestamp": "2026-08-13T12:12:52-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.14"
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
        "version": "1.15"
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
        "total": 6545,
        "limit": 2,
        "offset": 0,
        "total_pages": 3273,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/exhibitions?page=2&limit=2"
    },
    "data": [
        {
            "id": 6597,
            "api_model": "exhibitions",
            "api_link": "https://api.artic.edu/api/v1/exhibitions/6597",
            "title": "18th Century French Art in the Art Institute of Chicago",
            "is_featured": false,
            "position": -1,
            ...
        },
        {
            "id": 10880,
            "api_model": "exhibitions",
            "api_link": "https://api.artic.edu/api/v1/exhibitions/10880",
            "title": "Felix-Gonzalez Torres: The Work Cannot Be Destroyed",
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
        "version": "1.15"
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
        "total": 6549,
        "limit": 10,
        "offset": 0,
        "total_pages": 655,
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
        "version": "1.14"
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
        "version": "1.15"
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
        "version": "1.15"
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
        "version": "1.15"
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
        "version": "1.15"
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
        "version": "1.15"
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
        "version": "1.15"
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
        "version": "1.15"
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
        "version": "1.15"
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
        "version": "1.15"
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
        "version": "1.15"
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
        "version": "1.15"
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
        "total": 11011,
        "limit": 2,
        "offset": 0,
        "total_pages": 5506,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/category-terms?page=2&limit=2"
    },
    "data": [
        {
            "id": "TM-16605",
            "api_model": "category-terms",
            "api_link": "https://api.artic.edu/api/v1/category-terms/TM-16605",
            "title": "movie poster",
            "subtype": "subject",
            "parent_id": null,
            ...
        },
        {
            "id": "TM-16603",
            "api_model": "category-terms",
            "api_link": "https://api.artic.edu/api/v1/category-terms/TM-16603",
            "title": "architectural photography",
            "subtype": "subject",
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
        "version": "1.15"
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
        "total": 11026,
        "limit": 10,
        "offset": 0,
        "total_pages": 1103,
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
        "version": "1.14"
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
        "version": "1.15"
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
        "total": 182944,
        "limit": 2,
        "offset": 0,
        "total_pages": 91472,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/images?page=2&limit=2"
    },
    "data": [
        {
            "id": "6342ce54-4b64-07e2-53e3-e384777e9c2d",
            "lake_guid": "6342ce54-4b64-07e2-53e3-e384777e9c2d",
            "api_model": "images",
            "api_link": "https://api.artic.edu/api/v1/images/6342ce54-4b64-07e2-53e3-e384777e9c2d",
            "title": "AIC1994GoyasVision004.jpg",
            "type": "image",
            ...
        },
        {
            "id": "5fd4486d-d432-8064-b658-20dc440b1a1a",
            "lake_guid": "5fd4486d-d432-8064-b658-20dc440b1a1a",
            "api_model": "images",
            "api_link": "https://api.artic.edu/api/v1/images/5fd4486d-d432-8064-b658-20dc440b1a1a",
            "title": "AIC1984EvaZeiselDesigner008.jpg",
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
        "version": "1.15"
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
        "total": 184195,
        "limit": 10,
        "offset": 0,
        "total_pages": 18420,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "id": "974f657a-b598-0a68-00d1-fcae2b9b4d84",
            "api_model": "images",
            "api_link": "https://api.artic.edu/api/v1/images/974f657a-b598-0a68-00d1-fcae2b9b4d84",
            "title": "PD_04099",
            "timestamp": "2026-02-24T12:14:44-06:00"
        },
        {
            "_score": 1,
            "id": "4cb17a3c-1118-c871-cda8-e78ae7eaa996",
            "api_model": "images",
            "api_link": "https://api.artic.edu/api/v1/images/4cb17a3c-1118-c871-cda8-e78ae7eaa996",
            "title": "PD_04100",
            "timestamp": "2026-02-24T12:14:45-06:00"
        },
        {
            "_score": 1,
            "id": "ed103997-14b9-9106-c6f7-0b13c65ac6be",
            "api_model": "images",
            "api_link": "https://api.artic.edu/api/v1/images/ed103997-14b9-9106-c6f7-0b13c65ac6be",
            "title": "PD_04098",
            "timestamp": "2026-02-24T12:14:45-06:00"
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.14"
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
        "version": "1.15"
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
        "version": "1.15"
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
        "version": "1.14"
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
        "version": "1.15"
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
        "total": 1372,
        "limit": 2,
        "offset": 0,
        "total_pages": 686,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/sounds?page=2&limit=2"
    },
    "data": [
        {
            "id": "9e14d96c-96f2-8595-fe8d-b356d90542a5",
            "lake_guid": "9e14d96c-96f2-8595-fe8d-b356d90542a5",
            "api_model": "sounds",
            "api_link": "https://api.artic.edu/api/v1/sounds/9e14d96c-96f2-8595-fe8d-b356d90542a5",
            "title": "T97 Fullerton Hall",
            "type": "sound",
            ...
        },
        {
            "id": "163b701d-1f53-5014-3383-f093e800b57d",
            "lake_guid": "163b701d-1f53-5014-3383-f093e800b57d",
            "api_model": "sounds",
            "api_link": "https://api.artic.edu/api/v1/sounds/163b701d-1f53-5014-3383-f093e800b57d",
            "title": "T83  Ando Gallery",
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
        "version": "1.15"
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
        "total": 1372,
        "limit": 10,
        "offset": 0,
        "total_pages": 138,
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
        "version": "1.14"
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
        "version": "1.15"
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
        "total": 3893,
        "limit": 2,
        "offset": 0,
        "total_pages": 1947,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/texts?page=2&limit=2"
    },
    "data": [
        {
            "id": "c9b527a1-c62f-24be-09af-999736fe01b2",
            "lake_guid": "c9b527a1-c62f-24be-09af-999736fe01b2",
            "api_model": "texts",
            "api_link": "https://api.artic.edu/api/v1/texts/c9b527a1-c62f-24be-09af-999736fe01b2",
            "title": "AIC1906Nwsppr2ndAn_comb.pdf",
            "type": "text",
            ...
        },
        {
            "id": "9ab171f4-9871-f1ec-2b69-80609e972115",
            "lake_guid": "9ab171f4-9871-f1ec-2b69-80609e972115",
            "api_model": "texts",
            "api_link": "https://api.artic.edu/api/v1/texts/9ab171f4-9871-f1ec-2b69-80609e972115",
            "title": "AIC1905SocWstArt10thAn_comb.pdf",
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
        "version": "1.15"
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
        "total": 3896,
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
        "version": "1.14"
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
        "version": "1.15"
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
        "total": 2467,
        "limit": 2,
        "offset": 0,
        "total_pages": 1234,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/products?page=2&limit=2"
    },
    "data": [
        {
            "id": 292096,
            "api_model": "products",
            "api_link": "https://api.artic.edu/api/v1/products/292096",
            "title": "Great Women Artists: Compact Format",
            "external_sku": 292096,
            "image_url": "https://shop-images.imgix.net292096_2.jpg",
            ...
        },
        {
            "id": 292078,
            "api_model": "products",
            "api_link": "https://api.artic.edu/api/v1/products/292078",
            "title": "Art for All: Impressionists",
            "external_sku": 292078,
            "image_url": "https://shop-images.imgix.net292078_2.jpg",
            ...
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
        "total": 2549,
        "limit": 10,
        "offset": 0,
        "total_pages": 255,
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
        "version": "1.14"
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
        "version": "1.15"
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
        "total": 21,
        "limit": 2,
        "offset": 0,
        "total_pages": 11,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/tours?page=2&limit=2"
    },
    "data": [
        {
            "id": 5872,
            "api_model": "tours",
            "api_link": "https://api.artic.edu/api/v1/tours/5872",
            "title": "Verbal Description Tour of Design in Europe, 1600\u20131900",
            "image": "http://aic-mobile-tours.artic.edu/sites/default/files/tour-images/2007.105%20-%20King%20Vulture.jpg",
            "description": "<p>This tour is designed for people who are blind or have low vision, but it can be enjoyed by all. Each stop guides you through the rich detail of an artwork with extensive visual description.</p>\n",
            ...
        },
        {
            "id": 3246,
            "api_model": "tours",
            "api_link": "https://api.artic.edu/api/v1/tours/3246",
            "title": "Verbal Description Tour: The Essentials",
            "image": "http://aic-mobile-tours.artic.edu/sites/default/files/tour-images/1926.224%20-%20A%20Sunday%20on%20La%20Grande%20Jatte%20%E2%80%94%201884.jpg",
            "description": "<p>Designed for people with impaired vision: Discover our Essentials Tour.</p>\n",
            ...
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
        "version": "1.14"
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
        "version": "1.15"
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
        "total": 1066,
        "limit": 2,
        "offset": 0,
        "total_pages": 533,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/mobile-sounds?page=2&limit=2"
    },
    "data": [
        {
            "id": 6097,
            "api_model": "mobile-sounds",
            "api_link": "https://api.artic.edu/api/v1/mobile-sounds/6097",
            "title": "Still Life Reviving (Naturaleza muerta resucitando) (The Essentials Tour)",
            "web_url": "https://www.artic.edu/mobile/audio/04-StillLifeReviving-V2.mp3",
            "transcript": "<p>Caitlin Haskell:</p>\n<p>Hi, I'm Caitlin Haskell, I'm the Gary C. and Frances Comer Senior Curator in Modern and Contemporary Art at the Art Institute of Chicago. The title of this painting is Still Life Reviving, and it's an extraordinary still life, because the elements that should be resting on the table have taken flight. Eight plates levitate above the tablecloth, and above them, fruit encircles a candlestick and a whirling galaxy.</p>\n<p>We might think that the tablecloth is setting everything into motion, or it's also possible that there is something supernatural taking place more broadly within the space. There are at least three things that make this painting, made by the artist Remedios Varo, especially remarkable. First, it's her final painting, made in 1963, the year that she died at the age of 54. It's also her largest painting on canvas. And unlike most of her paintings, it does not picture a human figure within the scene, creating an eerie situation where we, as the viewer, are witnessing an occurrence that may or may not be seen by others.</p>\n<p>Varo was a Spanish born artist who was involved with the surrealist movement in the 1930s. She ultimately fled the Spanish Civil War and the Second World War in Europe to establish herself in Mexico City, where she was an important member of a vibrant artistic community there. When she first began exhibiting her work, her paintings were met with great fascination, both for the stories they told, and for the singular way that she created them.</p>\n<p>In paintings like this one, she combined centuries old, meticulous methods of painting with futuristic imagery and surrealist automatic techniques. The paintings look both forward and backward, putting the past in conversation with the future. Look, for example, at the architecture of the setting. The Gothic arches conjure the interior of a cathedral. In the vortex above the table, colliding fruits burst open, sending seeds flying to the ground. Between the angled pavers, new plants emerge. Signs of new life. Perhaps these are the first growth of the new worlds that Varo envisioned in her last years of working. Imagined worlds free of the bigotry and sexism, pain and ecological destruction of the world that Varo knew.</p>\n",
            ...
        },
        {
            "id": 6096,
            "api_model": "mobile-sounds",
            "api_link": "https://api.artic.edu/api/v1/mobile-sounds/6096",
            "title": "Relief of a Falling Warrior (The Essentials Tour)",
            "web_url": "https://www.artic.edu/mobile/audio/02-ReliefOfAFallingWarrior-V2.mp3",
            "transcript": "<p>This ancient Roman relief depicts a bearded warrior, with a chiseled physique, and a strange pose. His left arm is outstretched, holding a shield with a cloak draped over his shoulder, while his right arm is bent behind him. We can only see part of his legs, but based on the position of his body, we might assume that he's fallen down on his right knee. Perhaps he is in the process of toppling after suffering a fatal blow from behind.</p>\n<p>The relief is in the Neo-Attic style, which means the Roman artist was imitating the appearance of Greek art from centuries before. In this case, the artist was quoting a well known motif taken from the shield of the cult statue of Athena that once stood in the Parthenon in Athens. According to ancient descriptions of the statue, Athena's shield was adorned with images of the mythological battle between Greek soldiers and the warrior women known as the Amazons. The fallen soldier was part of that imagery, and by copying it, the Roman artists demonstrated their sophisticated understanding of Greek precedents.</p>\n<p>At some point in its history, this sculpture was thrown into the ocean during a shipwreck. The fragment was discovered underwater in the 1920s off the harbor of Piraeus, the port city of ancient Athens.</p>\n<p>Here's curator Lisa \u00c7akmak.</p>\n<p>Lisa \u00c7akmak:</p>\n<p>My favorite part of this piece really is the two different surfaces. When this was excavated, the figure on the left of the relief was embedded into the seafloor. You have a really high polished, very smooth sculpture.</p>\n<p>And then, the right section with his arm and shield, was exposed to all of this marine life. You can see that there are all these holes and scratches. And if you look really, really closely up at the top right corner, you can even see the vestiges of a mollusk shell.</p>\n",
            ...
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
        "version": "1.14"
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
        "version": "1.15"
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
        "version": "1.15"
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
            "timestamp": "2026-08-01T03:05:21-05:00"
        },
        {
            "_score": 1,
            "id": 7,
            "api_model": "publications",
            "api_link": "https://api.artic.edu/api/v1/publications/7",
            "title": "Pissarro Paintings and Works on Paper at the Art Institute of Chicago",
            "timestamp": "2026-08-01T03:05:21-05:00"
        },
        {
            "_score": 1,
            "id": 12,
            "api_model": "publications",
            "api_link": "https://api.artic.edu/api/v1/publications/12",
            "title": "The Modern Series at the Art Institute of Chicago",
            "timestamp": "2026-08-01T03:05:21-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.14"
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
        "version": "1.15"
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
        "version": "1.15"
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
            "timestamp": "2026-08-01T03:05:24-05:00"
        },
        {
            "_score": 1,
            "id": 52,
            "api_model": "sections",
            "api_link": "https://api.artic.edu/api/v1/sections/52",
            "title": "Catalogue",
            "timestamp": "2026-08-01T03:05:24-05:00"
        },
        {
            "_score": 1,
            "id": 128,
            "api_model": "sections",
            "api_link": "https://api.artic.edu/api/v1/sections/128",
            "title": "Pissarro Paintings and Works on Paper at the Art Institute of Chicago",
            "timestamp": "2026-08-01T03:05:24-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.14"
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
        "version": "1.15"
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
        "version": "1.15"
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
            "timestamp": "2026-07-01T03:00:16-05:00"
        },
        {
            "_score": 1,
            "id": 2,
            "api_model": "sites",
            "api_link": "https://api.artic.edu/api/v1/sites/2",
            "title": "American Perspectives: A yearlong celebration of American artistic vision",
            "timestamp": "2026-07-01T03:00:16-05:00"
        },
        {
            "_score": 1,
            "id": 3,
            "api_model": "sites",
            "api_link": "https://api.artic.edu/api/v1/sites/3",
            "title": "Curious Corner",
            "timestamp": "2026-07-01T03:00:16-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.14"
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
        "version": "1.15"
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
        "version": "1.15"
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
        "total": 2991,
        "limit": 10,
        "offset": 0,
        "total_pages": 300,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "id": 6393,
            "api_model": "events",
            "api_link": "https://api.artic.edu/api/v1/events/6393",
            "title": "Exuberus Teen Night 2026",
            "timestamp": "2026-08-05T16:44:58-05:00"
        },
        {
            "_score": 1,
            "id": 6447,
            "api_model": "events",
            "api_link": "https://api.artic.edu/api/v1/events/6447",
            "title": "Lecture: Norman Rockwell and the Chicago Cubs\u2014The Making of Baseball's \"Loveable Losers\"",
            "timestamp": "2026-08-05T16:44:58-05:00"
        },
        {
            "_score": 1,
            "id": 6453,
            "api_model": "events",
            "api_link": "https://api.artic.edu/api/v1/events/6453",
            "title": "Lecture: Beyond Form\u2014Abstraction at Midcentury",
            "timestamp": "2026-08-05T16:44:58-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.14"
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
        "total": 495,
        "limit": 2,
        "offset": 0,
        "total_pages": 248,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/event-occurrences?page=2&limit=2"
    },
    "data": [
        {
            "id": "a94da84f-5371-5b8d-91a7-34b69cffe144",
            "api_model": "event-occurrences",
            "api_link": "https://api.artic.edu/api/v1/event-occurrences/a94da84f-5371-5b8d-91a7-34b69cffe144",
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
        "version": "1.15"
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
        "total": 446,
        "limit": 10,
        "offset": 0,
        "total_pages": 45,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "id": "c0c274ff-208a-58c1-aadd-8ba9c7b0ed6b",
            "api_model": "event-occurrences",
            "api_link": "https://api.artic.edu/api/v1/event-occurrences/c0c274ff-208a-58c1-aadd-8ba9c7b0ed6b",
            "title": "Writing in the Galleries: Rupture, Action, Gesture, Collage",
            "timestamp": "2026-08-18T23:27:47-05:00"
        },
        {
            "_score": 1,
            "id": "b14b809e-e5fc-5215-b115-7dc74f26a1ba",
            "api_model": "event-occurrences",
            "api_link": "https://api.artic.edu/api/v1/event-occurrences/b14b809e-e5fc-5215-b115-7dc74f26a1ba",
            "title": "Lecture: Ray Johnson's Books as Social Objects",
            "timestamp": "2026-08-18T23:27:47-05:00"
        },
        {
            "_score": 1,
            "id": "bb064810-7967-5eb2-95f9-0297ddeb2c4c",
            "api_model": "event-occurrences",
            "api_link": "https://api.artic.edu/api/v1/event-occurrences/bb064810-7967-5eb2-95f9-0297ddeb2c4c",
            "title": "Luminary Curator's Choice: Jill Mulleady\u2014The Passenger",
            "timestamp": "2026-08-18T23:27:47-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.14"
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
        "version": "1.15"
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
        "version": "1.15"
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
            "timestamp": "2026-08-25T23:30:06-05:00"
        },
        {
            "_score": 1,
            "id": 115,
            "api_model": "event-programs",
            "api_link": "https://api.artic.edu/api/v1/event-programs/115",
            "title": "Programas en espa\u00f1ol",
            "timestamp": "2026-08-25T23:30:06-05:00"
        },
        {
            "_score": 1,
            "id": 114,
            "api_model": "event-programs",
            "api_link": "https://api.artic.edu/api/v1/event-programs/114",
            "title": "Weekday Studio",
            "timestamp": "2026-08-25T23:30:06-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.14"
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
        "version": "1.15"
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
        "version": "1.15"
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
        "total": 578,
        "limit": 10,
        "offset": 0,
        "total_pages": 58,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "id": 955,
            "api_model": "articles",
            "api_link": "https://api.artic.edu/api/v1/articles/955",
            "title": "Ruins and Rebirth",
            "timestamp": "2026-08-26T23:15:14-05:00"
        },
        {
            "_score": 1,
            "id": 985,
            "api_model": "articles",
            "api_link": "https://api.artic.edu/api/v1/articles/985",
            "title": "What Van Gogh Saw: A Photographer's Journey",
            "timestamp": "2026-08-26T23:15:14-05:00"
        },
        {
            "_score": 1,
            "id": 1211,
            "api_model": "articles",
            "api_link": "https://api.artic.edu/api/v1/articles/1211",
            "title": "Meet Elizabeth Catlett in 11 Facts",
            "timestamp": "2026-08-26T23:15:14-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.14"
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
        "total": 51,
        "limit": 2,
        "offset": 0,
        "total_pages": 26,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/highlights?page=2&limit=2"
    },
    "data": [
        {
            "id": 4,
            "api_model": "highlights",
            "api_link": "https://api.artic.edu/api/v1/highlights/4",
            "title": "new-on-view",
            "copy": " Norman Rockwell's The Dugout   The first artwork by Rockwell to enter our collection, this 1948 painting captures the highs and lows of players and fans following the Cubs\u2019 doubleheader loss to the Boston Braves. Published as the cover of an issue of the Saturday Evening Post , the work became one of the 20th century\u2019s most recognizable sports images and helped cement the Cubs\u2019 beloved reputation across Chicago. On view in Gallery 263 Learn more in this article .   2026 Society of Contemporary Art (SCA) Exhibition   Since 1940, the Society for Contemporary Art (SCA) has supported contemporary art at the Art Institute of Chicago through donations of artworks and support of exhibition, lectures, and other programs. Each year, members of the SCA\u2019s acquisition committee carefully select a group of contemporary works to consider purchasing and giving to the Art Institute for its permanent collection. This year\u2019s selections include works by Kerstin Br\u00e4tsch, Jana Euler, Tadaaki Kuwayama, Klara Lid\u00e9n, and Walid Raad / The Atlas Group, exploring the shifting boundaries between perception, material, and spatial experience through painting, sculpture, and installation. Organized in partnership with the museum\u2019s Department of Modern and Contemporary Art, the exhibition of these works continues the SCA\u2019s longstanding tradition of supporting rigorous contemporary artistic practices while contributing directly to the museum\u2019s permanent collection. On view in Gallery 294 through August 31, 2026 Learn more about the SCA .   Ker-Xavier Roussel's Public Park   Public Park (about 1893\u201394) by French artist Ker-Xavier Roussel, a member of the Nabis group, captures women and children in Paris\u2019s Tuileries garden. The superb painting complements domestic scenes by fellow Nabis, including Roussel\u2019s brother-in-law \u00c9douard Vuillard and F\u00e9lix Vallotton , and creates new connections within the museum\u2019s wider Post-Impressionist collection, especially with Georges Seurat\u2019s A Sunday on La Grande Jatte . On view in Gallery 244 Learn more in this article .   Caked: a plein air romp with baked goods by Gladys Nilsson   Gladys Nilsson\u2014SAIC graduate, 30+-year SAIC faculty member, and one of the wonderfully inventive artists who exhibited as the Hairy Who in the 1960s\u2014just completed a commissioned mural for the museum at the beginning of May. Commemorating the artist's 85th birthday, the mural features many figures gallivanting outdoors and enjoying carrot cake\u2014the artist's favorite. As is typical for Nilsson, she didn't work from a sketch for this mural, but instead from a rough concept, and this particular drawing came together on the wall from the edges into the center. It is the largest work she has ever made.   On view in Gallery 286, just around the corner from the Modern Bar Learn more, from Nilsson herself, in this Art Institute Short , and read about the experience of assisting Nilsson with the mural in this article .   Kay WalkingStick's The Silence of Glacier   The Silence of Glacier is the first work by Cherokee artist Kay WalkingStick to enter our collection. Depicting Glacier National Park overlaid with a Northern Cheyenne beadwork pattern, the painting reclaims the Rockies as Native land and highlights Indigenous abstraction. Within our collection, WalkingStick\u2019s work invites dialogue with historic Native art and modern works like Georgia O\u2019Keeffe\u2019s landscapes. See it alongside O\u2019Keeffe\u2019s Green Mountains, Canada , in Gallery 160.   SCULPTURES BY LOUISE BOURGEOIS   A special presentation in Gallery 293 brings together six sculptures by Louise Bourgeois that span the artist\u2019s nearly 75-year career. From early works made of wood that evoke the body to architectural structures resembling cages and prison cells, her wide-ranging experiments in form examine the complexities of the human condition. The artist often referenced aspects of her own life in her work, such as her childhood in France and her role as a mother. Yet her sculptures transcend autobiography and engage themes of loss and loneliness, sex and mortality, trauma and fear. On view in Gallery 293   Remedios Varo's Still Life Reviving (Naturaleza muerta resucitando)   Still Life Reviving (Naturaleza muerta resucitando) , Remedios Varo\u2019s last and largest painting, transforms the quietude of a traditional still life into a supernatural scene. Set in a Gothic tower, a table for eight begins to levitate. Above it, apples, peaches, pomegranates, and strawberries orbit like planets in a solar system. The emergence of new life is a common theme of Varo\u2019s work of the 1960s. Here, in addition to the seedlings sprouting up, the cloth itself seems animated. Everything flows into the vortex, except four mosquitos that look on warily as the fruits collide. On view in Gallery 396 Learn more in this article .   El Anatsui's The Deluge   The Deluge , a loan from a private collection, presents a version of the Biblical flood. Near the top of the work, abstract shapes resemble clouds with blue lines of rain shooting down. Inspired in part by the graphic woven patterns of African cloths, Ghanaian artist El Anatsui uses recycled cans and other found aluminum to weave sculptural tapestries. The repurposed objects bear traces of their initial use; as the artist has explained, they comprise \u201cmedia which come with history, meaning, with something [that] means something to me. Not just oil paint from a tube. I can\u2019t relate to that well. I would rather go for something people have used. Then there is a link between me and the other people who have touched that piece.\u201d On view in Griffin Court   Simone Leigh's Sharifa   The nine-foot-tall Sharifa (2022) by Chicago-born artist Simone Leigh is what the artist has called \u201cthe first portrait I\u2019ve ever done.\u201d The subject is the writer Sharifa Rhodes-Pitts, author of Harlem Is Nowhere , a 2011 history of the storied neighborhood. She is also one of Leigh\u2019s closest friends and a frequent participant in her projects. The sculpture grew out of a video project Leigh produced for an exhibition at the Guggenheim Museum in which she asked Rhodes-Pitts and others to recall and recreate their body position during childbirth. \u201cSharifa was just leaning against the wall, thinking, and that was the start of this sculpture,\u201d Leigh has said. Though many of her sculptures use friends and colleagues as their subjects, before Sharifa , the artist had resisted calling them portraits. Rhodes-Pitts, as both a historian and a mother, embodies the labor of black women that Leigh has long centered in her work. On view in the North Garden (corner of Michigan and Monroe) Learn more in this article .   Ramon Casas\u2019s Erik Satie   On loan to us from Northwestern University Libraries, this grand, full-length portrait shows French composer Erik Satie looking well dressed but a little worse for wear, having presumedly been out all night at the cabaret. The work holds the place usually occupied by Henri de Toulouse-Lautrec\u2019s At the Moulin Rouge , itself on loan to the Minneapolis Institute of Art. Fun fact: It was Toulouse-Lautrec who inspired Casas to depict scenes of modern life this this one. On view in Gallery 242 ",
            "source_updated_at": "2026-06-22T15:35:03-05:00",
            ...
        },
        {
            "id": 6,
            "api_model": "highlights",
            "api_link": "https://api.artic.edu/api/v1/highlights/6",
            "title": "american-art",
            "copy": " Please note: artworks occasionally go off view for imaging, treatment, or loan to other institutions. Click on the images to ensure the work is currently on view.   Georgia O\u2019Keeffe didn't travel in an airplane until she was in her 70s, but when she did, she was fascinated. She started a series of paintings inspired by her in-flight experiences. The works began small and progressively got bigger until the final canvas in the series, Sky above Clouds IV , which is so large that it has never traveled since coming to the Art Institute.   One of America's most famous paintings, American Gothic , debuted at the Art Institute of Chicago, winning a $300 prize and instant fame for Grant Wood. It has long been parodied and is often seen as a satirical commentary on the Midwestern character, but Wood intended it to a positive statement about rural American values. Read more about this work on our blog, where a curator answers the top five FAQs about the iconic painting.   One of the best-known images of 20th-century art, Nighthawks depicts an all-night diner in which three customers, all lost in their own thoughts, have congregated. It's unclear how or why the anonymous and uncommunicative night owls are there\u2014in fact, Hopper eliminated any reference to an entrance to the diner. The four seem as separate and remote from the viewer as they are from one another. (The red-haired woman was actually modeled by the artist\u2019s wife, Jo.)   Known today for his paintings and murals depicting Mexican political and cultural life, Diego Rivera enjoyed a brief but sparkling period as a Cubist painter early in his career. In this work he portrayed his then-lover, the Russian-born painter and writer Marevna Vorob\u00ebv-Stebelska, clearly conveying her distinctive bobbed hair, blond bangs, and prominent nose\u2014despite or with the aid of the Cubist style. Like many other artists in Paris, Rivera rejected Cubism as frivolous and inappropriate following World War I and the Russian Revolution.   A native Chicagoan and graduate of the School of the Art Institute, Archibald Motley used his art to represent the vibrancy of African American culture, frequently portraying young, sophisticated city dwellers out on the town. One of Motley\u2019s most celebrated paintings, Nightlife depicts a crowded cabaret in the South Side neighborhood of Bronzeville. The dynamic composition, intense lighting, and heightened colors vividly express the liveliness of the scene.   The only American artist invited to exhibit with the French Impressionists, Mary Cassatt concentrated on the human figure, particularly on sensitive yet unsentimental portrayals of women and children. In The Child\u2019s Bath , one of Cassatt\u2019s masterworks, she used cropped forms, bold patterns and outlines, and a flattened perspective, all of which she derived from her study of Japanese woodblock prints.   Eldzier Cortor lived in Chicago and attended the School of the Art Institute, and while drawn to abstraction, he felt that it was not an effective tool for conveying serious social and political concerns. In The Room No. VI, the artist exposes the impoverished living conditions experienced by many African Americans on the South Side through a brilliant use of line and color, reinvigorating the idiom of social realism.   Though Stuart Davis studied with the so-called Ashcan School, who sought to depict a realistic look at modern urban life, he came to embrace a more abstracted and energetic style, as seen in Ready-to-Wear . The bright colors intersect and interrupt one another in a distinctly American way: jazzy, vital, and mass produced\u2014all qualities summed up in the title.   In addition to architecture, Frank Lloyd Wright designed furniture like this chair from his home in Oak Park, Illinois. Though his early experiments were heavy, solid cube chairs, he eventually added the refinements seen in this design, such as spindles, the subtly tapering crest rail, and gently curving leg ends, all of which produce an effect that is equal parts sophistication and simplicity.   In The Herring Net, Winslow Homer depicts two fishermen at their daily yet heroic work. As the small boat rides the swells, one fisherman hauls in the heavy net while the other unloads the glistening herring, illustrating that teamwork is essential for survival on this churning sea that both gives and takes. ",
            "source_updated_at": "2020-05-28T11:32:54-05:00",
            ...
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
        "total": 52,
        "limit": 10,
        "offset": 0,
        "total_pages": 6,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "id": 104,
            "api_model": "highlights",
            "api_link": "https://api.artic.edu/api/v1/highlights/104",
            "title": "willem-de-kooning-brdrawing-guide",
            "timestamp": "2026-08-05T17:04:28-05:00"
        },
        {
            "_score": 1,
            "id": 4,
            "api_model": "highlights",
            "api_link": "https://api.artic.edu/api/v1/highlights/4",
            "title": "new-on-view",
            "timestamp": "2026-08-05T17:04:28-05:00"
        },
        {
            "_score": 1,
            "id": 103,
            "api_model": "highlights",
            "api_link": "https://api.artic.edu/api/v1/highlights/103",
            "title": "mindful-looking",
            "timestamp": "2026-08-05T17:04:28-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.14"
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
        "version": "1.15"
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
        "version": "1.15"
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
            "timestamp": "2026-08-27T12:05:23-05:00"
        },
        {
            "_score": 1,
            "id": 3,
            "api_model": "static-pages",
            "api_link": "https://api.artic.edu/api/v1/static-pages/3",
            "title": "Exhibitions",
            "timestamp": "2026-08-27T12:05:23-05:00"
        },
        {
            "_score": 1,
            "id": 4,
            "api_model": "static-pages",
            "api_link": "https://api.artic.edu/api/v1/static-pages/4",
            "title": "Upcoming Exhibitions",
            "timestamp": "2026-08-27T12:05:23-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.14"
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
        "version": "1.15"
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
            "id": 459,
            "api_model": "generic-pages",
            "api_link": "https://api.artic.edu/api/v1/generic-pages/459",
            "title": "Project Windows 2020",
            "web_url": "https://www.artic.edu/visit/special-offers/project-windows-2020",
            "copy": " Voting for Project Windows 2020 is now closed. Check out the winners below!   Project Windows 2020 Winners   Art Institute Award Robert Guild Jewelry Best Use of Color Strides by Miyanna Best Use of Light/Technology Bloomingdale's Best Use of Materials Offshore Rooftop & Bar at Navy Pier Chicago Charm Teuscher Chocolates of Switzerland Chicago Style Blick Art Supply Most Amusing Ghirardelli Most Artistic Marshall Pierce & Co. Most Inspiring Macy\u2019s People's Choice Tea Gschwendner   Project Windows 2020 Participants ",
            ...
        },
        {
            "id": 457,
            "api_model": "generic-pages",
            "api_link": "https://api.artic.edu/api/v1/generic-pages/457",
            "title": "Watch and Listen",
            "web_url": "https://www.artic.edu/visit-us-virtually/watch-and-listen",
            "copy": null,
            ...
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
            "id": 67,
            "api_model": "generic-pages",
            "api_link": "https://api.artic.edu/api/v1/generic-pages/67",
            "title": "Board of Trustees",
            "timestamp": "2026-08-24T23:39:44-05:00"
        },
        {
            "_score": 1,
            "id": 304,
            "api_model": "generic-pages",
            "api_link": "https://api.artic.edu/api/v1/generic-pages/304",
            "title": "Collection Updates",
            "timestamp": "2026-08-24T23:39:44-05:00"
        },
        {
            "_score": 1,
            "id": 569,
            "api_model": "generic-pages",
            "api_link": "https://api.artic.edu/api/v1/generic-pages/569",
            "title": "Tips for Visiting Mary Cassatt",
            "timestamp": "2026-08-24T23:39:44-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.14"
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
        "web_url": "https://www.artic.edu/visit/free-admission-opportunities",
        "copy": " RESERVE ONLINE IN ADVANCE   You can reserve your free tickets online in advance ; your resident status will be verified using the zip code associated with the billing address provided. If you're unable to reserve tickets in advance, please stop by the admissions desks on the day of your visit for assistance. Free admission for Illinois residents is supported by   Illinois Educators Free admission is available to current Illinois educators, including pre-K\u201312 teachers, teaching artists working in schools, and homeschool parents. Educators can register online to receive a voucher for a complimentary ticket to the museum. This voucher must be presented\u2014as a printed document or on a smartphone\u2014with a valid educator ID at one of the museum\u2019s admission counters. Chicago Public Library\u2014Explore More Illinois Digital Pass Chicago Public Library cardholders 18 and older can log in at chipublib.org/digitalpasses to reserve free general admission passes to the museum through Explore More Illinois. Please note that this offer is valid only for Chicago Public Library cardholders.   NO ADVANCE TICKET REQUIRED The following groups are invited to visit our galleries at no cost every day. In order to receive your free admission benefits, simply show the corresponding identification at the admissions desk in either museum lobby. Free admission benefits are not single use\u2014you are welcome to use them any time you would like to visit. Be sure to inquire about the availability of special exhibition tickets when you check in at the admissions counter. Kids under 14 Admission is always free for children under 14. These free tickets are available online as well as on-site at the admissions counters. Chicago Teens Museum admission is free for Chicago teens under the age of 18, thanks to the extraordinary generosity of Glenn and Claire Swogger and the Redbud Foundation. See more opportunities and resources for teens . Active-Duty Military As part of the Blue Star Museums program, active-duty service members receive free admission all year long. Plus, from Armed Forces Day through Labor Day, we also welcome service members and their households. Please bring your active-duty military ID to the admissions counter to receive this benefit. LINK and WIC Cardholders As part of Museums for All, LINK and WIC cardholders and anyone in their households receive free general admission to the museum and all ticketed special exhibitions. Simply present your card along with a valid photo ID. University Partners Students of colleges and universities in the University Partner Program are entitled to free general and special exhibition admission by showing a valid student ID at the ticket counter. Check the full list of partnering colleges and universities . Corporate Partners Employees of certain companies in the Corporate Partner Program are entitled to free general and special exhibition admission by showing proof of employment at the ticket counter. Learn more about the Corporate Partner Program . Check the full list of Corporate Partner companies whose employees are entitled to free admission.   More Corporate Partner Opportunities ",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.15"
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
            "id": 11,
            "api_model": "landing-pages",
            "api_link": "https://api.artic.edu/api/v1/landing-pages/11",
            "title": "Publications",
            "web_url": null,
            "copy": "Publications at the Art Institute of Chicago. For nearly one hundred years, the Publishing department has produced high-quality, impactful, and accessible publications that contribute to knowledge and engage readers of all kinds, empowering them to make meaningful connections with art and art history. Explore our range of print and digital titles, from popular collection publications to scholarly exhibition catalogues.",
            ...
        },
        {
            "id": 8,
            "api_model": "landing-pages",
            "api_link": "https://api.artic.edu/api/v1/landing-pages/8",
            "title": "Articles & Videos",
            "web_url": null,
            "copy": "Conservation Spotlight. Go behind the scenes with conservators and conservation scientists to uncover secrets about artists' materials, practices, and even works thought to be lost. More to Explore. Check out some popular stories\u2014from the recent and not so recent past.",
            ...
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
            "id": 4,
            "api_model": "landing-pages",
            "api_link": "https://api.artic.edu/api/v1/landing-pages/4",
            "title": "Ryan Learning Center",
            "timestamp": "2026-08-05T17:05:49-05:00"
        },
        {
            "_score": 1,
            "id": 1,
            "api_model": "landing-pages",
            "api_link": "https://api.artic.edu/api/v1/landing-pages/1",
            "title": "Visit",
            "timestamp": "2026-08-05T17:05:49-05:00"
        },
        {
            "_score": 1,
            "id": 14,
            "api_model": "landing-pages",
            "api_link": "https://api.artic.edu/api/v1/landing-pages/14",
            "title": "Videos",
            "timestamp": "2026-08-05T17:05:49-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.14"
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
        "copy": "Willem de Kooning Drawing. Through September 20, 2026 Immerse yourself in the Art Institute\u2019s first exhibition in more than 50 years devoted to the celebrated Abstract Expressionist, and discover an artist whose drawing practice redefined the possibilities of modern and contemporary art. Tickets to this show are $7 in addition to general admission. Members never need tickets and enjoy a member-only viewing hour, 10\u201311 a.m., every day we're open! Museum Map. Take a look at our museum floor plan to get a sense of the museum's layout and mark any must-see spaces. Free Daily Tours. Follow a knowledgeable guide through the galleries on a free tour, offered in English every day at 1:00 and 3:00 and in Spanish on Fridays and Saturdays at 12:00. Your Personal Must-See Tour. Build your very own self-guided museum tour with the works you love. What to See in an Hour. Experience some of the museum\u2019s most iconic works by accessing self-guided tours, like What to See in an Hour, on your phone. Ryan Learning Center. Enjoy creative activities in this space, Wednesdays\u2013Mondays, 11:00\u20133:00, including making a custom museum tour with JourneyMaker. Exhibitions. Be sure to catch the many special exhibitions on view during your visit. Visitor Policies. These guidelines support a welcoming environment for all our visitors to experience the art in our galleries. Dining and Shopping. Grab a bite at one of our caf\u00e9s and be sure to pick up a souvenir of your visit at one of two store locations. Accessibility. The Art Institute offers a range of resources and programs designed for adults and children with disabilities.",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.15"
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
        "total": 388,
        "limit": 2,
        "offset": 0,
        "total_pages": 194,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/press-releases?page=2&limit=2"
    },
    "data": [
        {
            "id": 242,
            "api_model": "press-releases",
            "api_link": "https://api.artic.edu/api/v1/press-releases/242",
            "title": "Charles White: A Retrospective",
            "web_url": "https://www.artic.edu/press/press-releases/242/charles-white-a-retrospective",
            "copy": " Tuesday, January 23, 2018   CHICAGO \u2014Charles White, born and educated in Chicago, was one of the preeminent artists to emerge during the city\u2019s Black Renaissance of the 1930s and 1940s. A passionate mural and easel painter and superbly gifted draftsman, White powerfully interpreted African American history, culture, and lives in striking works that nevertheless have a more universal resonance. Presented by the Art Institute of Chicago and The Museum of Modern Art (MoMA) in New York, Charles White: A Retrospective runs June 8-September 3 at the Art Institute before traveling to MoMA, where it will be on view from October 7, 2018 through January 13, 2019, followed by Los Angeles Museum of Contemporary Art in Spring 2019. Co-curated by Sarah Kelly Oehler, Field McCormick Chair and Curator of American Art, and Esther Adler, Associate Curator, Department of Drawings and Prints, MoMA, the exhibition examines how White explored social and political themes ranging from the ongoing fight for freedom and equality to the dignity and struggles of labor. Throughout his career, he pushed against the boundaries of his media and the figurative tradition in American art.   As an artist, White\u2019s mastery of mediums intersected with social activism, engaging the past and present with an eye toward the future. He defined his essential quest as the discovery of truth, beauty, and dignity of life and people while using an expressive and highly accessible realism. He often drew from history to illuminate inequities contemporary to his time, as Oehler describes in the forthcoming catalogue for the exhibition, \u201cNot content merely to be mindful of the past, White made it his most important artistic theme\u2026 He returned to the past again and again for aesthetic inspiration, explicitly harnessing his creative energies to educate his fellow citizens and promote social equality by producing and displaying inspiring images of historical figures.\u201d   Presented in the 100th anniversary year of the artist\u2019s birth, this exhibition marks the most comprehensive presentation of White\u2019s work since 1982 and unites a selection of his finest paintings, drawings, and prints. This includes fourteen works owned by the Art Institute, drawn in part from the group of forty-three prints by White recently acquired by the Art Institute, of which five were offered as gifts by the artist\u2019s son. This breathtaking collection of White\u2019s prints begins with his work in Mexico during the late\u20131940s, up through his last published lithograph and his most powerful etchings. Organized chronologically, the exhibition examines the development of White\u2019s practice, from his emergence as a force in the Chicago art world through his mature career as an artist, activist, and educator in New York and Los Angeles. The exhibition deepens understanding of White\u2019s artistic oeuvre, looking in particular at his output through the lens of Chicago\u2019s unique cultural and artistic communities and the city\u2019s broader contributions to American art history. Together, the featured works speak to White\u2019s universal appeal and continued relevance to audiences today.   A full catalogue featuring essays by organizing curators Sarah Kelly Oehler and Esther Adler accompanies the exhibition. Additional essayists include Ilene Susan Fort, Curator Emerita of American Art at Los Angeles County Museum of Art; Kellie Jones, Associate Professor in Art History and Archaeology and the Institute for Research in African American Studies (IRAAS) at Columbia University; Mark Pascale, Janet and Craig Duchossois Curator of Prints and Drawings, the Art Institute of Chicago; and Deborah Willis, University Professor and Chair of the Department of Photography and Imaging at the Tisch School of the Arts at New York University.Sponsors   Image: Charles White. Harvest Talk , 1953. \u00a9 The Charles White Archives Inc. ",
            ...
        },
        {
            "id": 76,
            "api_model": "press-releases",
            "api_link": "https://api.artic.edu/api/v1/press-releases/76",
            "title": "Art Institute Becomes First Art Museum to Offer Tours with \u201cIndoor Gps\u201d  for Apple and Android Devices",
            "web_url": "https://www.artic.edu/press/press-releases/76/art-institute-becomes-first-art-museum-to-offer-tours-with-indoor-gps-for-apple-and-android-devices",
            "copy": " Wednesday, February 20, 2013 ",
            ...
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
        "total": 393,
        "limit": 10,
        "offset": 0,
        "total_pages": 40,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "id": 424,
            "api_model": "press-releases",
            "api_link": "https://api.artic.edu/api/v1/press-releases/424",
            "title": "Jill Mulleady: The Passenger",
            "timestamp": "2026-08-26T23:42:11-05:00"
        },
        {
            "_score": 1,
            "id": 423,
            "api_model": "press-releases",
            "api_link": "https://api.artic.edu/api/v1/press-releases/423",
            "title": "Mary Cassatt: After Impressionism",
            "timestamp": "2026-08-26T23:42:11-05:00"
        },
        {
            "_score": 1,
            "id": 422,
            "api_model": "press-releases",
            "api_link": "https://api.artic.edu/api/v1/press-releases/422",
            "title": "Lee Miller: Fearless",
            "timestamp": "2026-08-26T23:42:11-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.14"
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
        "web_url": "https://www.artic.edu/press/press-releases/1/press-releases-from-1939",
        "copy": " To obtain the full text of any news releases in this index, please contact the AIC Archives at archives@artic.edu .   January 6, 1939 Scammon Lecture, The Spirit of Modern Building , given by Dr. Walter Curt Behrendt, Technical Director of Buffalo City Planing Association, N.Y., 1 January 7, 1939 Turkish and Italian Textiles in Paintings , lecture, given by Alan J. B. Wace, Keeper of Textiles in the Victoria and Albert Museum and professor of Classical Archaeology, Cambridge, England; members of Chicago Needlework and Textile Guild, listed 2 January 20, 1939 Lecture series, given by Dr. Maurice Gnesin, Director of Goodman Theatre and Head of AIC Goodman School of Drama 3 January 11, 1939 Comments on exhibitions: The French Romanticists Gros, Gericault, and Delacroix; Exhibition of Bonnard and Villard, Contemporary French Artists; Christmas Story in Art; George Grosz, His Art from 1918 to 1938; Architecture by Ludwig Mies Van Der Rohe; 34 Old Master Drawings, Lent by Sir Robert Witt of London; gallery tour for the Second Conference of Chicago Art Clubs 4-5 January 13, 1939 AIC major exhibitions of 1938, attendance record from Museum Registrar's Department 6 January 14, 1939 Scammon Lecture, Turner's Romantic Vision of Switzerland , given by Dr. Paul Ganz, Professor at University of Basle, Switzerland, biography note and publications 8 January 18, 1939 28th Annual Governing Members' Meeting, hosted by AIC President Mr. Potter Palmer; luncheon, list of participants 7 January 19, 1939 Kate S. Buckingham Memorial Lecture, Chinese Bronzes , given by AIC Assistant Director and Curator of Oriental Art Department Charles Fabens Kelley 9 January 21, 1939 The National Exhibition of Representative Buildings of the Post War Period, exhibition, organized and curated by American Institute of Architecture (AIA) 12 January 23, 1939 Annual Report for 1938, issued by Director of Fine Arts Daniel C. Rich and Director of Finance and Operation Charles H. Burkholder; major gifts and donations; Robert Allerton, gift for construction of the Decorative Arts Galleries; Mrs. Erna Sawyer Goodman, money gift, establishing William Owen Goodman Fund; attendance, membership, SAIC enrollment; major bequest of Ms. Kate Buckingham; Mrs. William O. Goodman Collection of pewter, gift to AIC; Superintendent's report on condition of skylight roof; Bartlett Lecture Series; funding for lectures and publications 10-11 Pablo Picasso: Forty Years of His Art, exhibition announcement, first collaborative project of AIC and The Museum of Modern Art, N.Y., 13, 102 January 25, 1939 43rd Annual Exhibition by Artists of Chicago and Vicinity, jury comprised of Donald Bear of Denver Art Museum, Clarence Carter of Carnegie Institute, Pittsburgh, and artists Mahonri H. Young of New York and Albin Polasek of Chicago; list of prizes 14, 19-20, 23, 25 January 26, 1939 Kate S. Buckingham Memorial Lecture, Chinese Terra Cotta Tiles , given by AIC Assistant Director and Curator of Oriental Art Department Charles Fabens Kelley 15 January 30, 1939 A Leading School of Buddhist Sculpture , lecture given by Dr. Osvald Siren of National Museum in Stockholm; biography note and comments on his collection and publications 16 SAIC 6th Annual Open House for alumni, governing members, trustees, friends of the School and officials; Glee Club concert under direction of AIC Assistant Director and Curator of Oriental Art Charles Kelley 17 January 31, 1939 Chicago High School Scholarship contest at SAIC; list of winners, Judith Pesman, Suzanne Siporin, Emil Grego, Joanne Kuper, and Joseph Strickland 18 Exhibition of Contemporary American Art at New York World's Fair 1939; proceedings and requirements; Chicago juries of New York World's Fair, represented by Aaron Bohrod, Ralph Clarkson, Mitchell Siporin, Daniel C. Rich (chairman of the Painting Jury), Sidney Loeb, Peterpaul Ott, Albin Polasek, George Thorp, Todros Geller, James Swann, Morris Topchevsky, Beatrice Levy, Charles Wilimovsky, and Lillian Combs 19-20 February 2, 1939 Kate S. Buckingham Memorial Lecture, Chinese Sculpture and Painting , given by AIC Assistant Director and Curator of Oriental Art Department Charles Fabens Kelley 21 February 4, 1939 Scammon Lecture, Six Dynasties and Early T'ang Painting , given by Laurence Sickman, curator of Oriental Art at William Rockhill Nelson Gallery of Art, Kansas City, MO; biography note 22 February 6, 1939 43rd Annual Exhibition by Artists of Chicago and Vicinity, opening, Artists' Dinner, hosted by AIC Director of Finance and Operation Charles H. Burkholder; guest speaker George Buehr, other guests included Mr. and Mrs. Potter Palmer, Mr. Paul Schulze, Mr. and Mrs. Charles Fabens Kelley, Mrs. Albion Headburg, and Ms. Eleanor Jewett 14, 19-20, 23, 25 February 13, 1939 The Making of a Cartoon , lecture and film demonstration, conducted by cartoonist of the Chicago Daily News Vaughn R. Shoemaker, complementing exhibition titled Original American Cartoons from Charles L. Howard Collection 24 February 14, 1939 AIC Exhibition Calendar for 1939 In the Department of Painting and Sculpture, curator Daniel Catton Rich, AIC Director: Chicago and Vicinity 43rd Annual Exhibition; Masterpiece of the Month: Portrait of Mrs. Wolff by Sir Thomas Lawrence; 18th International Exhibition of Watercolors; Annual Exhibition by Students of SAIC; 50th Annual Exhibition of American Painting and Sculpture: Half a Century of American Art 25 In the Children's Museum, curator Helen Mackenzie: The Making of a Masterpiece, exhibition, featuring altarpiece by Giovanni di Paolo of Sienna; Means and Methods of Water Color Painting 25 In the Blackstone Hall: Original American Cartoons from the Collection of Charles L. Howard of Chicago 26 In the Oriental Art Department, Curator Charles Fabens Kelley: two exhibitions from AIC Clarence Buckingham Collection of Japanese Prints, titled In Wind and Rain, and Blossom Viewing; Masterpiece of the Month: Imperial Jade Cup on Stand, 18th C., gift of Russell Tyson 26 In Prints Department, Acting Curator Lillian Combs: Selections from Lenora Hall Gurley Memorial Collection of Drawings; Recent Accessions in Prints, 1937-1939; Woodcuts from Books of the 15th Century; Masterpiece of the Month: The Lamentation from the Great Passion by Albrecht Durer; Prints by Old Masters from Clarence Buckingham Collection; The Bulls of Bordeaux by Francesco Goya; Sports in Prints 26 In the Decorative Arts Department, Curator Bessie Bennett: French Furniture and Sculpture, 18th C. from Henry Dangler Collection; Florence Dibell Bartlett Collection of Bonader from Sweden, 18th and 19th C.; English Architecture of 18th C.; Embroideries from The Greek Islands Lent by Elizabeth Day McCormick; Ecclesiastical Embroideries; English Embroideries; Exhibition of Embroideries by the Needlework and Textile Guild 27 General Information about Permanent collection and admission 27 February 15, 1939 Florence Dibell Bartlett Lecture, Adventures in the Arts , given by Helen Parker, Head of AIC Education Department 28 February 20, 1939 Antiquarian Society, Tea Party, honoring Elizabeth Day McCormick and exhibition of Embroideries from the Greek Islands; party specialties and participants 29, 59, 61 February 21, 1939 George Washington's Birthday, free Museum admission; Washington's portraits in AIC Permanent collection 30 February 25, 1939 Scammon Lecture, The Fountains of Florence , given by Bertha Wiles, Curator of Mark Epstein Library at University of Chicago 31 February 28, 1939 Scammon Lecture, The Artistic Relations of England and Italy , given by William George Constable of Boston Museum of Fine Arts; biography note, Mr. Constable, founder of the Courtauld Institute in London 33 March 2, 1939 New Light on Prehistoric Man , lecture and film demonstration, presented by Dr. Henry Field, and sponsored by Chicago Chapter of Archaeological Institute of America 32 Kate S. Buckingham Lecture, The Gothic Room , given by Bessie Bennett, AIC Curator of Decorative Arts 34 March 8, 1939 Goodman Theatre, performance of Alice in Wonderland for children from settlement houses and orphanages; list of participating institutions 36 March 9, 1939 Kate S. Buckingham Lecture, Prints by Old Masters, Including Rembrandt , given by Edith R. Abbot, artist and educator of The Metropolitan Museum, N.Y., biography note about Ms. Abbot 37 March 15, 1939 Frederick Arnold Sweet, appointed Assistant Curator of AIC Painting and Sculpture Department; Mr. Sweet's resume 38 March 17, 1939 Kate S. Buckingham Lectures, Master Etchers of the 19th Century , given by Head of Education Department Helen Parker; The English Lustre Ware Collection, given by AIC Director Daniel C. Rich 39 March 20, 1939 Opening reception for 18th International Water Color Show, works on view, including loans from Edward Hopper, John Whorf, and Henri Matisse 35 March 23, 1939 18th Annual International Water Color Exhibition; prizes and works on view; jury comprised of Grant Wood, Joseph W. Jicha of Cleveland, and Hubert Ropp of Chicago; concurrent exhibition in the AIC Children's Museum, explaining water color technique; biography notes about prize-winners, Everett Shinn and Dale Nichols 35, 40-42, 5I-52, 64 March 24, 1939 Kate S. Buckingham Lecture, The English Lustre Ware Collection , given by AIC Director Daniel C. Rich 43 March 28, 1939 AIC Curator of Decorative Arts Department Bessie Bennett (1870-1939), obituary; Ms. Bennet's AIC tenure, biography note, remarks by AIC President Mr. Potter Palmer 44-45 April 3, 1939 Easter Festivities at AIC, Monsalvat , performance by Dudley Crafts Watson; SAIC Glee Club concert under direction of Charles Fabens Kelley, sponsored in part by Mrs. James Ward Thorne 46 April 6, 1939 Albin Polasek, Head of Sculpture Department at SAIC, honored with award of merit by the National Institute of Immigrant Welfare, N.Y.; biography note and chronology 47-48 April 11, 1939 Glee Club, Eastern concert program 46, 49 50th Annual Exhibition of American Painting and Sculpture: Half a Century of American Art, retrospective, showing works from American Annual exhibitions held at AIC from 1888 to 1938; comments on the exhibition selection by AIC Director Daniel C. Rich 25, 50 3rd Conference of Art Chairmen; AIC Assistant Curator of Painting and Sculpture Frederick A. Sweet, speaking on 18th International Water Color Exhibition, comments and criticism 40-42, 51-52, 64 April 13, 1939 Kate S. Buckingham Lecture, The Early Development of Chinese Pottery , given by AIC Assistant Director and Curator of Oriental Art Department Charles Fabens Kelley 53 April 17, 1939 SAIC group exhibition at Paul Theobald's Gallery in Chicago, showing abstractionist paintings done in the class of Willard G. Smythe 54 April 20, 1939 Kate S. Buckingham Lecture, The Great Period of Pottery and the Beginnings of Porcelain , given by AIC Assistant Director and Curator of Oriental Art Department Charles Fabens Kelley; attendance record of the Lecture Series 55 April 25, 1939 Europe, Asia, Africa: A Common Civilization , lecture, given by Melville J. Herskovits of Northwestern University, Evanston, IL, 56 Art Quiz, booklet by Head of Education Department Helen Parker, published in support for AIC Museum programs 57 April 27, 1939 Kate S. Buckingham Lecture, The Great Porcelains of the Ming and Ch'ing Dynasties, given by AIC Assistant Director and Curator of Oriental Art Department Charles Fabens Kelley 58 May 2, 1939 Antiquarian Society, Tea Party, featuring speech by AIC Director Daniel C. Rich, titled Decorative Arts in the Museum of Tomorrow ; members of the Society, listed 59 May 5, 1939 Goodman Theatre dance series, featuring Spanish dancer Clarita Martin, Ms. Martin's remarks 60 May 6, 1939 Antiquarian Society, Spring Meeting; Tea Party marking the Exhibition of Embroideries from Greek Islands in Elizabeth Day McCormick Collection; special gallery arrangements provided by Mrs. Walter S. Brewster, Mrs. Charles S. Dewey, Mrs. James Ward Thorne, Mrs. C. Morse Ely, and Mrs. Chauncey McCormick 29, 59, 61-62 May 9, 1939 Antiquarian Society Tea Party, decorative floral display available for public viewing 62 May 12, 1939 5th Annual Exhibition by Student Janitors of SAIC, participants and Fellowship awards 63 May 12, 1939 18th International Water Color Exhibition, attendance record; list of works sold from the show 35, 40-42, 51-52, 64 May 13, 1939 Annual Exhibition of the Needlework and Textile Guild of AIC, opening; works on view and participants 65-66 May 22, 1939 Foreign Travelling Fellowships, awarded to SAIC Student Janitors by AIC Officials and members of SAIC Faculty; award recipients Murray Jones, Edward Voska, biography notes 67 May 23, 1939 SAIC Glee Club concert, program and performers 68 May 26, 1939 Free Museum admission on Memorial Day; special exhibitions: Glass Paperweights from Mrs. John H. Bergstrom Collection; Japanese Surimono Prints, lent by Ms. Helen C. Gunsaulus; Chinese Jades from Mrs. Edward Sonnenschein Collection; Ms. Elizabeth Day McCormick Collection of Embroideries 69 June 2, 1939 Room of Recent Accessions, opening; new gallery, designated for exhibitions in The Masterpiece of the Month Series, and displaying new additions to Permanent collection; works shown at the opening; comments by AIC Director Daniel C. Rich 70-71 June 6, 1939 Art Students League of SAIC, prizes given to the League members; awards made possible through the gift of Mrs. William O. Goodman 72 June 8, 1939 Free Summer Lectures, French and German Primitives by Gibson Danes of Northwestern University, Evanston, IL; Paintings of the High Renaissance in Italy by SAIC instructor Briggs Dyer; Dutch and Flemish Old Masters by AIC Assistant Curator of Painting Frederick A. Sweet 73 June 9, 1939 SAIC Annual Commencement Exercises, graduation announcement at Goodman Memorial Theatre, conducted by AIC Vice President Mr. Chauncey McCormick; Invocation and Benediction pronounced by Minister of New England Church, Rev. Theodore Hume; student prizes, AIC Glee Club performance; guest list 74 June 10, 1939 AIC Director Daniel Catton Rich, named Chairman of Jury at San Francisco Golden Gate International Exposition 75 June 13, 1939 AIC Exhibition Calendar for 1939 Summer Exhibitions In the Department of Painting and Sculpture, curator AIC Director Daniel Catton Rich: Annual Exhibition of Works by SAIC Students; Costumes and Folk Art from Central Europe from Florence Dibell Bartlett Collection; Whistleriana, the artist's memorabilia from Walter Brewster Collection; Water Color Drawings by Thomas Rowlandson; Paintings by Lester O. Schwartz; Memorial Exhibition of Paintings by Pauline Palmer; Memorial Exhibition of Paintings by Carl Rudolf Krafft; Chinese Porcelains from the Goodman, Crane, Patterson, and Salisbury Collections; Lithographs by Odilon Redon; 50th Annual Exhibition of American Painting and Sculpture: Half a Century of American Art 76-77, 83 In the Children's Museum, curator Helen Mackenzie: Exhibition of Work by Children in the Saturday Classes of SAIC 77 From exhibition series The Making of the Masterpiece, showing At the Moulin Rouge by Toulouse-Lautrec 77 The Masterpiece of the Month, exhibition series introduced 77-78 In the Oriental Art Department, curator Charles Fabens Kelley: Chinese Jades from the Collection of Mr. and Mrs. Edward Sonnenschein; Japanese Surimono, lent by Ms. Helen C. Gunsaulus; Pottery of the Ming Dynasty 78, 83 In the Department of Prints and Drawing, Acting Curator Lilian Combs: Prints by Old Masters from Clarence Buckingham Collection; Sports in Prints; Sporting Prints and Drawings from the Collection of Mr. Joel Spitz of Chicago; Half a Century of American Prints; The Lenora Hall Curley Memorial Collection of Drawings; British Landscape Prints by Seymour Haden and David Young Cameron; Portraiture in Prints from Clarence Buckingham Collection; 7th International Exhibition of Lithography and Wood Engraving 78-79, 83 In the Decorative Arts Department: Exhibition of Paperweights from the Collection of Mrs. John N. Bergstrom; French Furniture from Henry C. Dangler Collection; Bonader from Sweden, Florence Dibell Bartlett Collection; English Architecture of the 18th C.; Exhibition of Embroideries from the Greek Islands, English and Ecclesiastical Embroideries from the Collection of Elizabeth Day McCormick 79, 83 Various announcements: invitation for train passengers to visit AIC on the way to the World's Fair in New York and San Francisco Golden Gate Exposition; attendance, lectures, Museum hours and orientation 79-80 June 13, 1939 General Education Board of Rockefeller Foundation, grant for three year project on art education in Chicago High Schools, conducted under supervision of Head of AIC Education Department Helen Parker 81 July 14, 1939 Chinese Art , free lecture series given by AIC Assistant Director and Curator of Oriental Art Charles Fabens Kelley; weekend gallery talks 82 July 18, 1939 Notes on Summer Exhibitions 83 July 22, 1939 Lectures and Gallery tours, given by AIC Assistant Curator for Painting and Sculpture Frederick A. Sweet, Gibson Danes of Northwestern University, Evanston, IL, and Briggs Dyer of SAIC 84 Weekly News Letter (Walter J. Sherwood, ed.); Nine Summer Exhibitions: Costumes and Folk Art from Eastern Europe lent by Florence D. Bartlett; Paintings by Carl Rudolf Krafft, School of the Ozark Painters; Pauline Palmer's paintings, works on view; Exhibition of Lester O. Schwartz, SAIC alumnus; Exhibition of Whistleriana from the collection of Walter S. Brewster, works on view; Water Colors by Thomas Rowlandson; Chinese Porcelains and Jades from Chicago Collections; Lithographs by Odilon Redon, from Martin A. Ryerson Collection; renovation of Permanent collection display; El Greco, lecture by assistant curator of Painting and Sculpture Frederick A. Sweet; note on the death of the mural painter Alphonse Mucha and the 1908 lecture series, titled Harmony in Art , given by the artist in AIC 137-138 July 25, 1939 Invitation to free music concert in Blackstone Hall, organist Max Allen, pianist Eleanor Gullett 85 July 29, 1939 Weekly News Letter (Walter J. Sherwood, ed.); The Masterpiece of the Month, exhibition series, Rembrandt's etching, titled Christ Preaching on display; paintings by winners of AIC Annuals Peter Hurd, Millard Sheets, Esther Williams, Nicolai Ziroli, John Whorf, William Zorach, and Georges Schreiber, acquired by The Metropolitan Museum in New York; free gallery lecture series, given by Briggs Dyer of SAIC and Gibson Danes of Northwestern University, Evanston, IL; gallery tours by Addis Osborne, SAIC alumnus; AIC catalogue of Summer exhibitions 139-141 August 1, 1939 Lectures and gallery talks, given by Briggs Dyer of SAIC, and Addis Osborne, SAIC alumnus 86-88, 90 August 5, 1939 Weekly News Letter (Lester Bridaham, ed.); Kenneth Goodman Memorial Theatre, improvements and additions; Decorative Arts Department Galleries in the Allerton Wing, construction, made possible by Vice-President and Chairman of the Committee of Decorative Arts, Mr. Robert Allerton; Wendell Stevenson, SAIC alumnus, commission of portraiture; SAIC Summer classes extended; Summer School at Saugatuck, MI, classes of Charles Willimovsky, SAIC Director Frederick Fursman, and Don Loving; 50th Annual Exhibition of American Painting and Sculpture: Half a Century of American Art, exhibition announcement; excepts from Time and Newsweek magazines, commenting on AIC Summer exhibitions; Sporting Prints from the Collection of Joel Spitz, exhibition 142-144 August 8, 1939 Briggs Dyer's Sunday Lecture Series gained public acclaim 87 August 12, 1939 Weekly News Letter; lectures and classes given by artists and SAIC alumni Leon R. Pescheret and Addis Osborne, and SAIC professors Edmund Giesbert and Briggs Dyer; Odilon Redon Lithographs, exhibition of works acquired by Martin A. Ryerson from the artist's widow, remarks by AIC Trustee Arthur T. Aldis; painting by Robert B. Harshe, AIC Director from 1921 to 1938, awarded honorable mention at Fine Arts Exhibition of the Golden Gates Exposition, excerpt from The Magazine of Art , May issie 145-147 August 15, 1939 Notes on Briggs Dyer's lectures 88 August 18, 1939 Membership Lecture, One-Plate Color Etching , given by SAIC instructor Leon R. Pescheret 89 August 19, 1939 Weekly News Letter; Student Honorable Mentions for the year 1939; AIC Curator Frederick A. Sweet, inquiring about locations of paintings for inclusion into 50th Annual Exhibition of American Painting and Sculpture: Half a Century of American Art, list of desired works; Assistant in AIC Decorative Arts Department Helen Mitchell, awarded Fellowship at Yale University; The Chicago Museum Tour Committee, providing two-day tour and booklet for Chicago visitors in cooperation with AIC and other cultural institutions, list of the Committee members 148-150 August 22, 1939 Lectures and gallery talks, given by SAIC instructors Briggs Dyer and Addis Osborne, and Head of AIC Education Department Helen Parker 90 Weekly News Letter; Masterpiece of the Month, exhibition series, showing Persian brocade of the Safavid period, the reign of Shah Abbas (1587-1628), gift of Mr. John R. Thompson of Chicago, description and comments; Contemporary Fine Arts Building at the New York World's Fair, AIC ranked as the most popular museum outside New York; Oriental jades from AIC Sonnenschein Collection, shown at The Golden Gate Exposition in San Francisco; free Museum admission on Labor Day; AIC Fall lecture series, titled The Great White Way to San Francisco Bay , given by Dudley Crafts Watson, reflecting on New York World's Fair, The Golden Gate Exposition in San Francisco, and US Museums 151-153 August 29, 1939 Notes on Exhibition of East European Costumes from Florence D. Bartlett Collection and other displays 91 September 2, 1939 SAIC announcing Student registration for the year 1940; colored post cards and reproductions of works from AIC Permanent collection, supplied by New York office of Vienna publisher Max Jaffe, list of titles available at AIC Reproduction Desk; gallery tours, conducted by Head of AIC Education Department Helen Parker and Briggs Dyer of SAIC; general Museum information, record of School, Museum offices and workshops, Shipping Room, and Museum Registrar in the Archives Department; Fall program in Fullerton Hall, opened with lecture series about home decoration, given by Dudley Crafts Watson 154-156 September 11, 1939 Lectures, Paintings of the High Renaissance in Italy , given by Helen Parker, and Dutch and Flemish Old Masters , given by Briggs Dyer 92 September 13, 1939 Meyric R. Rogers, appointed AIC Curator of Decorative Arts Department, replacing late Ms. Bessie Bennett; Mr. Rogers, concurrently appointed Head of Industrial Arts Department, newly formed in AIC; biography note, publications, and remarks by AIC President Potter Palmer and AIC Director of Fine Arts Daniel C. Rich 93-94 September 19, 1939 Week of the American Legion Convention, free Museum admission for the Legion members, announcement by AIC Director of Finance and Operation C. H. Burkholder 95-96 September 22, 1939 American Legion Parade, free Museum admission for the public 95-96 September 25, 1939 AIC Department of Education, programs and lectures, featuring SAIC instructor Mary Hipple, Head of Education Department Helen Parker, Ramsey Wieland, and George Buehr; film demonstrations on art techniques, supplemented by gallery tours 97 September 28, 1939 Sunday Lectures, French and English Paintings of the 17th and 18th Century , given by SAIC instructor George Buehr, and French Decorative Arts , given by assistant in Education Department Ramsey Wieland 100 September 30, 1939 Fiestas in Guatemala , lecture by Erna Fergusson, introducing Scammon Lecture Series for the year 101 October 1, 1939 Masterpiece of the Month, exhibition series, St. John on Patmosby Nicolas Poussin ; comparative displays in Impressionist galleries 98-99 October 2, 1939 Picasso Retrospective, planned by Alfred H. Barr, Director and Vice President of The Museum of Modern Art, N. Y. (MOMA), and Daniel C. Rich, AIC Director of Fine Arts; announcement on exhibition dates; war time exhibition, the first collaborative project by MOMA and AIC 13, 102 October 4, 1939 The Adventures in the Arts , lecture series conducted by Head of Education Department Helen Parker; attendance record for AIC lectures; Costumes from Florence Dibell Bartlett Collection on display 103 October 5, 1939 7th International Exhibition of Lithography and Wood-Engraving, US tour exhibition, jury comprised of artists Peggy Bacon, Asa Cheffetz, and Todros Geller; The Logan Prize for Prints, announced 104 October 7, 1939 Scammon Lecture, The Educational Viewpoint in an Art Museum , given by Dr. Thomas Munro of Cleveland Museum of Art; biography note and publications 105 October 12, 1939 Exhibition of Chinese Pottery and Porcelain, lent by Chicago collectors Mrs. William O. Goodman, Mrs. Richard T. Crane, Mrs. Alice H. Patterson, and Mrs. W. W. Kimball (courtesy of Mrs. Warren Salisbury and Mr. Kimball Salisbury) 106 October 14, 1939 Scammon Lecture, Armor of Renaissance Princes , given by Curator of Arms and Armors in The Metropolitan Museum Stephen V. Grancsay; the 1893 exhibition of Arms and Armor, held at the Chicago Columbian Exposition and featuring Mr. Grancsay's lecture 107 October 20, 1939 Motion Pictures in the Arts , special program in association with 7th International Exhibition of Lithography and Wood-Engraving, conducted by Head of Education Department Helen Parker; film screening, featuring woodcut artists and illustrators, Lynd Ward, Timothy Cole, and Chaim Gross 108 October 21, 1939 Scammon Lecture, The Art of Our Early Cabinet Makers , given by Edwin J. Hipkiss of Boston Museum of Fine Arts; biography note and publications 109 October 26, 1939 SAIC Glee Club concert of Negro Spirituals, conducted by AIC Assistant Director and Curator of Oriental Art Department Charles Fabens Kelley, and featuring musicians Virgil Espenlaub, Juanita Krunk, and Eleanor Gullett; numbers performed 110 October 27, 1939 Scammon Lecture, French Medieval Sculpture in America , given in association with opening of The Cloisters Museum in New York, by James J. Rorimer of The Metropolitan Museum; remarks by Mr. H. E. Winlock, formerly Director of The Metropolitan Museum; publications by Mr. Rorimer 111 October 28, 1939 50th American Exhibition: Half a Century of American Art, opening reception featuring tea table decorations from different periods, sponsored and arranged by The Antiquarian Society, The Municipal Art League, Art Institute Alumni, The Renaissance Society, The Arts Club, etc.; listing of representatives and participants 25, 50, 77, 112, 120-121 November 1, 1939 Masterpieces of Italian Art, exhibition lent by the Royal Italian Government to San Francisco World's Fair, special announcement on exclusive showing at AIC 113-114, 116-119, 122, 123, 125, 129, 131,132, 134 November 6, 1939 Scammon Lecture, Colonial American Portraiture , given by Alan Burroughs of Harvard University; biography note and publications 115 November 9, 1939 Masterpieces of Italian Art, exhibition lent by the Royal Italian Government to San Francisco World's Fair, shipment of art works to Chicago for exclusive showing at AIC and official ceremonies upon arrival, the route of procession to AIC 116 November 11, 1939 Masterpieces of Italian Art, exhibition lent by the Royal Italian Government to San Francisco World's Fair; honorary committees and Chicago sponsors for exclusive AIC showing 117-119 November 14, 1939 50th Annual Exhibition of American Painting and Sculpture: Half a Century of American Art, opening reception arranged by Antiquarian Society and Fortnightly Club, description of table decoration and list of hostesses 120-121 November 17, 1939 Masterpieces of Italian Art, exhibition, opening ceremonies featuring opera singer Hilde Reggiani 122 November 21, 1939 Free Museum admission on Thanksgiving Day; Radio program and special lectures, supplementing Masterpieces of Italian Art Exhibition 123 November 27, 1939 Scammon Lecture, featuring American sculptor William Zorach 124 December 1, 1939 Masterpieces of Italian Art, exhibition, related discussion on using tempera technique 125 December 2, 1939 Scammon Lecture, Precursors of the New Architecture , given by John Barney Rodgers of Armour Institute of Technology; biography note 126 December 5, 1939 Glee Club, Christmas concert, directed by AIC Assistant Director Charles Fabens Kelley 127 December 7, 1939 Masterpieces of Italian Art, exhibition; extended hours for late evening viewing; special musical programs, gallery tours, and Christmas events 129 December 9, 1939 Scammon Lecture, dedicated to sculptor Carl Milles, given by curator of Decorative Arts Department Meyric R. Rogers 128 December 12, 1939 Armour Institute of Technology Musical Club, free concert including AIC Glee Club performance 130 December 14, 1939 Masterpieces of Italian Art, exhibition, evening concerts; Joseph Bentonelli, lyric tenor, performing from the Museum Grand Staircase 131 December 18, 1939 Masterpieces of Italian Art, exhibition, evening concerts; Choir of the Church of Saint Thomas the Apostle 132 December 19, 1939 Free Museum admission on Christmas Day; Listing of current exhibitions 133 December 26, 1939 Masterpieces of Italian Art, exhibition, Italian Day in the Museum, free admission declared by Royal Italian Government 134 December 27, 1939 Free museum admission on New Year's Day; current exhibitions and lectures 135 ",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.15"
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
        "version": "1.15"
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
        "total": 65,
        "limit": 10,
        "offset": 0,
        "total_pages": 7,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "id": 173,
            "api_model": "educator-resources",
            "api_link": "https://api.artic.edu/api/v1/educator-resources/173",
            "title": "Alma Thomas: A Closer Look",
            "timestamp": "2026-08-26T23:45:03-05:00"
        },
        {
            "_score": 1,
            "id": 134,
            "api_model": "educator-resources",
            "api_link": "https://api.artic.edu/api/v1/educator-resources/134",
            "title": "Diego Rivera: A Closer Look",
            "timestamp": "2026-08-26T23:45:03-05:00"
        },
        {
            "_score": 1,
            "id": 170,
            "api_model": "educator-resources",
            "api_link": "https://api.artic.edu/api/v1/educator-resources/170",
            "title": "Elizabeth Catlett and the Taller de Gr\u00e1fica Popular (TGP):  A Closer Look",
            "timestamp": "2026-08-26T23:45:03-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.14"
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
            "web_url": "https://www.artic.edu/digital-publications/37/perspectives-on-data",
            "copy": "<h1>Perspectives on Data</h1><p>This publication, the second in the three-volume <em>Perspectives</em> series, explores the potentials and pitfalls of using data and data-oriented approaches in art, art history, and museums through essays, interviews, and a video that address topics such as data analysis and visualization, the design of collection management systems, and the representation of provenance.</p><p>Mapping Senufo: Making Visible Debatable Information and Situated Knowledge<br/>About<br/>Iterative Pasts and Linked Futures: A Feminist Approach to Modeling Data in Archives and Collections of Artists\u2019 Publishing<br/>Make Slow, Make Long<br/>Crowdsourcing Metadata in Museums: Expanding Descriptions, Access, Transparency, and Experience<br/>Digital Methods for Inquiry into the Eurocentric Structure of Architectural History Surveys<br/>Contributions<br/>The Sound and Voice of Violent Things: Against the Silence of Data Visualization<br/>The Human Shape of Data<br/>Credits<br/>Taking Care of History: Toward a Politics of Provenance Linked Open Data in Museums<br/>Director&#8217;s Foreword<br/></p>",
            ...
        },
        {
            "id": 36,
            "api_model": "digital-publications",
            "api_link": "https://api.artic.edu/api/v1/digital-publications/36",
            "title": "Perspectives on In/stability",
            "web_url": "https://www.artic.edu/digital-publications/36/perspectives-on-instability",
            "copy": "<h1>Perspectives on In/stability</h1><p>This publication, the first in the three-volume <em>Perspectives</em> series, explores how stability and instability manifest in and shape artworks, the narratives we tell about them, and how we present them.</p><p>About<br/>Contributions<br/>Stability Isn&#8217;t Everything It&#8217;s Glitched Up to Be: An Interview with Jamie Fenton<br/>Edo Spaces, European Images: Iterations of Art and Architecture of Benin<br/>Forces of In/stability<br/>Credits<br/>Seven-Figure Settlements and Paid Days Off: An Interview with Devin Kenny<br/>From Cloth to Clay: Identities and Im/permanence in Moche Ceramics<br/>Seeking Balance: Material and Meaning in a Polychrome Guanyin<br/>Director&#8217;s Foreword<br/>The Color of Fire Is Flux<br/>Empty Fields Revisited<br/></p>",
            ...
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
            "id": 48,
            "api_model": "digital-publications",
            "api_link": "https://api.artic.edu/api/v1/digital-publications/48",
            "title": "Monet Paintings and Drawings at the Art Institute of Chicago",
            "timestamp": "2026-08-16T23:48:56-05:00"
        },
        {
            "_score": 1,
            "id": 46,
            "api_model": "digital-publications",
            "api_link": "https://api.artic.edu/api/v1/digital-publications/46",
            "title": "Matisse Paintings, Works on Paper, Sculpture, and Textiles at the Art Institute of Chicago",
            "timestamp": "2026-08-16T23:48:56-05:00"
        },
        {
            "_score": 1,
            "id": 47,
            "api_model": "digital-publications",
            "api_link": "https://api.artic.edu/api/v1/digital-publications/47",
            "title": "Cezanne Paintings and Watercolors at the Art Institute of Chicago",
            "timestamp": "2026-08-16T23:48:56-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.14"
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
        "web_url": "https://www.artic.edu/digital-publications/2/american-silver",
        "copy": " American Silver in the Art Institute of Chicago showcases the museum's superb collection of American silver. In-depth essays relate a fascinating story about eating, drinking, and entertaining that spans the history of the Republic and traces the development of the museum\u2019s holdings of American silver over nearly a century, and a catalogue incorporates detailed analysis of objects written by leading specialists. This digital augmentation of the 2017 publication provides stunning high-resolution photography and, for a select number of objects, three-dimensional captures that allow for close viewing. In addition, this edition includes an extensive illustrated checklist of additional objects.   Edited by Elizabeth McGoey with contributions by Debra Schmidt Bach, David L. Barquist, Judith A. Barter, Jennifer Goldsborough, Medill Higgins Harvey, Patricia Kane, Elizabeth McGoey, Barbara K. Schnitzer, Janine E. Skerry, Ann Wagner, Gerald W. R. Ward, Deborah Dependahl Waters, Beth Carver Wees, and Elizabeth A. Williams   American Silver in the Art Institute of Chicago is free and has received major support for this catalogue is provided by the Henry Luce Foundation. It is also made by possible by the generosity of the Community Associates of the Art Institute of Chicago, Mr. and Mrs. Henry M. Buchbinder, Carl and Marilynn Thoma, Louise Ingersoll Tausche, Jamee and Marshal Field V, Kay Bucksbaum, Celia and David Hilliard, and Jan and Bill Jentes. ",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.15"
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
            "id": 49,
            "api_model": "digital-publication-articles",
            "api_link": "https://api.artic.edu/api/v1/digital-publication-articles/49",
            "title": "Contributions",
            "web_url": "https://www.artic.edu/digital-publications/34/malangatana-mozambique-modern/content#contributions",
            "copy": null,
            ...
        },
        {
            "id": 48,
            "api_model": "digital-publication-articles",
            "api_link": "https://api.artic.edu/api/v1/digital-publication-articles/48",
            "title": "About",
            "web_url": "https://www.artic.edu/digital-publications/34/malangatana-mozambique-modern/content#about",
            "copy": null,
            ...
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
            "timestamp": "2026-08-05T17:07:24-05:00"
        },
        {
            "_score": 1,
            "id": 41,
            "api_model": "digital-publication-articles",
            "api_link": "https://api.artic.edu/api/v1/digital-publication-articles/41",
            "title": "Director's Foreword",
            "timestamp": "2026-08-05T17:07:24-05:00"
        },
        {
            "_score": 1,
            "id": 30,
            "api_model": "digital-publication-articles",
            "api_link": "https://api.artic.edu/api/v1/digital-publication-articles/30",
            "title": "Director's Foreword",
            "timestamp": "2026-08-05T17:07:24-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.14"
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
        "web_url": "https://www.artic.edu/digital-publications/34/malangatana-mozambique-modern/1/directors-foreword",
        "copy": " The Art Institute of Chicago has been at the forefront of American museums in collecting and displaying modern art since the early twentieth century, and boasts an ongoing commitment to extending this vital legacy with research, publications, and exhibitions. In that spirit, a number of our curators came together in 2013 for a series of discussions exploring ideas about modern art, in particular the ways in which it manifests across our collections. This gave rise to the Modern Series, a set of three experimental, challenging, and provocative exhibitions and publications that are co-organized by curators across departments, with divergent but complementary specialties. The two previous iterations\u2014 Shatter Rupture Break (February 15\u2013May 3, 2015) and Go (February 23\u2013June 4, 2017)\u2014sought to present the museum\u2019s holdings in departments including Arts of the Americas, Modern and Contemporary Art, Photography and Media, and Textiles in fresh and exciting ways. Malangatana: Mozambique Modern (July 30\u2013November 16, 2020), the third and final project in the series, expands our understanding of modernism and modern art in a global context by bringing the work of celebrated Mozambican artist Malangatana Ngwenya (1936\u20132011) into conversation with our own international collection. It not only showcases the evolution in style and content within his early paintings and drawings, but also contextualizes his practice within the social and political conditions that framed the emergence of modern art in Mozambique and across the African continent. The exhibition also contributed to the cultivation of a more global perspective on artistic creation and its representation in the museum, both by providing the basis for this publication and, not least, by prompting us to acquire a painting and six works on paper by Malangatana for our permanent collection. Africa and its diasporas, with their deep history and wide geographical reach, occupy a prominent place within global art history and modern art that merits many more such efforts and programs in the years to come. Our colleagues\u2014notably Sarah Guernsey, Ann Goldstein, and Greg Nosan\u2014deserve my sincere gratitude for their continuing critical support for the Modern Series. But I am especially thankful to the exhibition\u2019s curators, Hendrik Folkerts, Felicia Mings, and Constantine Petridis, for introducing our staff and visitors to the fascinating milieu and work of Malangatana Ngwenya and for helping the Art Institute expand its representation of modern art from around the world. This exhibition would not have been possible without the generosity of the individuals and institutions in the United States, Portugal, and Mozambique who lent works from their collections. I am particularly grateful to the Malangatana Valente Ngwenya Foundation in Maputo for its invaluable loan of a significant number of paintings and drawings. Major funding for Malangatana: Mozambique Modern was provided by Sylvia Neil and Dan Fischel and the Alfred L. McDougal and Nancy Lauter McDougal Fund for Contemporary Art. Additional support is contributed by the Society for Contemporary Art through the SCA Activation Fund and the Miriam U. Hoover Foundation. Members of the Luminary Trust provide annual leadership support for the museum\u2019s operations, including exhibition development, conservation and collection care, and educational programming. The Luminary Trust includes an anonymous donor; Neil Bluhm and the Bluhm Family Charitable Foundation; Jay Franke and David Herro; Karen Gray-Krehbiel and John Krehbiel, Jr.; Kenneth Griffin; Caryn and King Harris, The Harris Family Foundation; Josef and Margot Lakonishok; Robert M. and Diane v.S. Levy; Ann and Samuel M. Mencoff; Sylvia Neil and Dan Fischel; Anne and Chris Reyes; Cari and Michael J. Sacks; and the Earl and Brenda Shapiro Foundation. Most importantly, I acknowledge with deepest thanks the intellectual and financial support of Sylvia Neil and Dan Fischel, who have provided crucial funding for the realization of this catalogue as well as the previous two in the Modern Series. Their ongoing commitment has enabled and encouraged our continued explorations into the possibilities of digital publication. James Rondeau President and Eloise W. Martin Director ",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.15"
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
        "version": "1.15"
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
        "total": 216,
        "limit": 10,
        "offset": 0,
        "total_pages": 22,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "id": 199,
            "api_model": "printed-publications",
            "api_link": "https://api.artic.edu/api/v1/printed-publications/199",
            "title": "Joseph E. Yoakum: What I Saw",
            "timestamp": "2026-08-22T23:54:08-05:00"
        },
        {
            "_score": 1,
            "id": 200,
            "api_model": "printed-publications",
            "api_link": "https://api.artic.edu/api/v1/printed-publications/200",
            "title": "Ray Johnson c/o",
            "timestamp": "2026-08-22T23:54:08-05:00"
        },
        {
            "_score": 1,
            "id": 201,
            "api_model": "printed-publications",
            "api_link": "https://api.artic.edu/api/v1/printed-publications/201",
            "title": "Andr\u00e9 Kert\u00e9sz: Postcards from Paris",
            "timestamp": "2026-08-22T23:54:08-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.14"
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
        "version": "1.15"
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
            "timestamp": "2026-08-27T12:05:05-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.14"
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


