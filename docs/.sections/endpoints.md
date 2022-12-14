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
        "total": 118760,
        "limit": 2,
        "offset": 0,
        "total_pages": 59380,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/artworks?page=2&limit=2"
    },
    "data": [
        {
            "id": 76771,
            "api_model": "artworks",
            "api_link": "https://api.artic.edu/api/v1/artworks/76771",
            "is_boosted": false,
            "title": "Pan",
            "alt_titles": null,
            ...
        },
        {
            "id": 76795,
            "api_model": "artworks",
            "api_link": "https://api.artic.edu/api/v1/artworks/76795",
            "is_boosted": false,
            "title": "Pan",
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
        "version": "1.6"
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
            "_score": 229.52556,
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
            "timestamp": "2022-12-13T23:16:39-06:00"
        },
        {
            "_score": 212.65619,
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
            "timestamp": "2022-12-13T23:14:53-06:00"
        },
        {
            "_score": 210.31189,
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
            "timestamp": "2022-12-13T23:16:37-06:00"
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
        "version": "1.6"
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
            "value": "47.2 \u00d7 34.5 cm (18 5/8 \u00d7 13 5/8 in.)"
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
        "total": 14982,
        "limit": 2,
        "offset": 0,
        "total_pages": 7491,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/agents?page=2&limit=2"
    },
    "data": [
        {
            "id": 36548,
            "api_model": "agents",
            "api_link": "https://api.artic.edu/api/v1/agents/36548",
            "title": "Naomi Savage",
            "sort_title": "Savage, Naomi",
            "alt_titles": [
                "Naomi Siegler"
            ],
            ...
        },
        {
            "id": 117796,
            "api_model": "agents",
            "api_link": "https://api.artic.edu/api/v1/agents/117796",
            "title": "groana melendez",
            "sort_title": "melendez, groana",
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
        "version": "1.6"
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
        "total": 14982,
        "limit": 10,
        "offset": 0,
        "total_pages": 1499,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "agents",
            "api_link": "https://api.artic.edu/api/v1/agents/33625",
            "id": 33625,
            "title": "Francesco Bertos",
            "timestamp": "2022-12-14T15:01:09-06:00"
        },
        {
            "_score": 1,
            "api_model": "agents",
            "api_link": "https://api.artic.edu/api/v1/agents/33626",
            "id": 33626,
            "title": "Charles Cl\u00e9ment Bervic",
            "timestamp": "2022-12-14T15:01:09-06:00"
        },
        {
            "_score": 1,
            "api_model": "agents",
            "api_link": "https://api.artic.edu/api/v1/agents/33627",
            "id": 33627,
            "title": "Albert Besnard",
            "timestamp": "2022-12-14T15:01:09-06:00"
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
        "version": "1.6"
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
        "total": 3971,
        "limit": 2,
        "offset": 0,
        "total_pages": 1986,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/places?page=2&limit=2"
    },
    "data": [
        {
            "id": -2147476188,
            "api_model": "places",
            "api_link": "https://api.artic.edu/api/v1/places/-2147476188",
            "title": "United States",
            "latitude": 38,
            "longitude": -98,
            ...
        },
        {
            "id": -2147476354,
            "api_model": "places",
            "api_link": "https://api.artic.edu/api/v1/places/-2147476354",
            "title": "Maine",
            "latitude": 45,
            "longitude": -69,
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Attribution 4.0 Generic License (CC-By) and the Terms and Conditions of artic.edu. Contains information from the J. Paul Getty Trust, Getty Research Institute, the Getty Thesaurus of Geographic Names, which is made available under the ODC Attribution License.",
        "license_links": [
            "https://www.artic.edu/terms",
            "https://creativecommons.org/licenses/by/4.0/"
        ],
        "version": "1.6"
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
        "total": 3971,
        "limit": 10,
        "offset": 0,
        "total_pages": 398,
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
        "version": "1.6"
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
            "id": 26129,
            "api_model": "galleries",
            "api_link": "https://api.artic.edu/api/v1/galleries/26129",
            "title": "Gallery 50",
            "latitude": 41.879562775663,
            "longitude": -87.6221331954,
            ...
        },
        {
            "id": 23975,
            "api_model": "galleries",
            "api_link": "https://api.artic.edu/api/v1/galleries/23975",
            "title": "Gallery 294",
            "latitude": 41.880509059365,
            "longitude": -87.621473652432,
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.6"
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
        "total": 94,
        "limit": 10,
        "offset": 0,
        "total_pages": 10,
        "current_page": 1
    },
    "data": [
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
        },
        {
            "_score": 1,
            "api_model": "galleries",
            "api_link": "https://api.artic.edu/api/v1/galleries/2147477218",
            "id": 2147477218,
            "title": "Gallery 200",
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
        "version": "1.6"
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
        "total": 6441,
        "limit": 2,
        "offset": 0,
        "total_pages": 3221,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/exhibitions?page=2&limit=2"
    },
    "data": [
        {
            "id": 9287,
            "api_model": "exhibitions",
            "api_link": "https://api.artic.edu/api/v1/exhibitions/9287",
            "title": "Canova: Sketching in Clay",
            "is_featured": false,
            "is_published": false,
            ...
        },
        {
            "id": 9639,
            "api_model": "exhibitions",
            "api_link": "https://api.artic.edu/api/v1/exhibitions/9639",
            "title": "Van Gogh and the Avant-Garde: The Modern Landscape",
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
        "version": "1.6"
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
        "total": 6441,
        "limit": 10,
        "offset": 0,
        "total_pages": 645,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "exhibitions",
            "api_link": "https://api.artic.edu/api/v1/exhibitions/1352",
            "id": 1352,
            "title": "Artful Alphabets: Five Picture Book Artists",
            "timestamp": "2022-05-08T23:17:42-05:00"
        },
        {
            "_score": 1,
            "api_model": "exhibitions",
            "api_link": "https://api.artic.edu/api/v1/exhibitions/1357",
            "id": 1357,
            "title": "June Wayne's Narrative Tapestries: Tidal Waves, DNA, and the Cosmos",
            "timestamp": "2022-05-08T23:17:42-05:00"
        },
        {
            "_score": 1,
            "api_model": "exhibitions",
            "api_link": "https://api.artic.edu/api/v1/exhibitions/1374",
            "id": 1374,
            "title": "Jindrich Heisler: Surrealism under Pressure",
            "timestamp": "2022-05-08T23:17:42-05:00"
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
        "is_published": true,
        ...
    },
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.6"
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
        "version": "1.6"
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
        "version": "1.6"
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
        "version": "1.6"
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
        "version": "1.6"
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
        "version": "1.6"
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
        "version": "1.6"
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
        "version": "1.6"
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
        "version": "1.6"
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
        "version": "1.6"
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
        "version": "1.6"
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
        "total": 9764,
        "limit": 2,
        "offset": 0,
        "total_pages": 4882,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/category-terms?page=2&limit=2"
    },
    "data": [
        {
            "id": "TM-15393",
            "api_model": "category-terms",
            "api_link": "https://api.artic.edu/api/v1/category-terms/TM-15393",
            "title": "seashells",
            "subtype": "material",
            "parent_id": null,
            ...
        },
        {
            "id": "TM-15392",
            "api_model": "category-terms",
            "api_link": "https://api.artic.edu/api/v1/category-terms/TM-15392",
            "title": "chain",
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
        "version": "1.6"
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
        "total": 9764,
        "limit": 10,
        "offset": 0,
        "total_pages": 977,
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
        "version": "1.6"
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
        "total": 154078,
        "limit": 2,
        "offset": 0,
        "total_pages": 77039,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/images?page=2&limit=2"
    },
    "data": [
        {
            "id": "39a11346-5c86-70e0-93c5-201f1e0d46f1",
            "lake_guid": "39a11346-5c86-70e0-93c5-201f1e0d46f1",
            "api_model": "images",
            "api_link": "https://api.artic.edu/api/v1/images/39a11346-5c86-70e0-93c5-201f1e0d46f1",
            "title": "J9289-int",
            "type": "image",
            ...
        },
        {
            "id": "1a5929a0-5d07-6b60-85f1-2c759769da8f",
            "lake_guid": "1a5929a0-5d07-6b60-85f1-2c759769da8f",
            "api_model": "images",
            "api_link": "https://api.artic.edu/api/v1/images/1a5929a0-5d07-6b60-85f1-2c759769da8f",
            "title": "J9397-int",
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
        "version": "1.6"
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
        "total": 154078,
        "limit": 10,
        "offset": 0,
        "total_pages": 15408,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "images",
            "api_link": "https://api.artic.edu/api/v1/images/3b96d8d0-68c9-cb16-e5ea-6d7889a9928c",
            "id": "3b96d8d0-68c9-cb16-e5ea-6d7889a9928c",
            "title": "G59063",
            "timestamp": "2022-09-09T16:57:00-05:00"
        },
        {
            "_score": 1,
            "api_model": "images",
            "api_link": "https://api.artic.edu/api/v1/images/559c01e7-76dc-2a0b-309e-1a67603ce00e",
            "id": "559c01e7-76dc-2a0b-309e-1a67603ce00e",
            "title": "AIC_1999ElsworthKelly020.jpg",
            "timestamp": "2022-05-08T23:33:57-05:00"
        },
        {
            "_score": 1,
            "api_model": "images",
            "api_link": "https://api.artic.edu/api/v1/images/3cc53520-929e-052e-10ea-9c706ffa4bba",
            "id": "3cc53520-929e-052e-10ea-9c706ffa4bba",
            "title": "AIC_1999ElsworthKelly016.jpg",
            "timestamp": "2022-05-08T23:33:57-05:00"
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
        "version": "1.6"
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
        "version": "1.6"
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
        "version": "1.6"
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
        "version": "1.6"
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
        "total": 3867,
        "limit": 2,
        "offset": 0,
        "total_pages": 1934,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/texts?page=2&limit=2"
    },
    "data": [
        {
            "id": "a6bdc2e4-24f8-e2c9-1189-075ade26f0c7",
            "lake_guid": "a6bdc2e4-24f8-e2c9-1189-075ade26f0c7",
            "api_model": "texts",
            "api_link": "https://api.artic.edu/api/v1/texts/a6bdc2e4-24f8-e2c9-1189-075ade26f0c7",
            "title": "AIC_Wei Dynasty Stele_1926.591 (1)",
            "type": "text",
            ...
        },
        {
            "id": "70425e6a-23f1-b326-a7a7-d5c727a10da1",
            "lake_guid": "70425e6a-23f1-b326-a7a7-d5c727a10da1",
            "api_model": "texts",
            "api_link": "https://api.artic.edu/api/v1/texts/70425e6a-23f1-b326-a7a7-d5c727a10da1",
            "title": "D47970_018",
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
        "version": "1.6"
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
        "total": 3867,
        "limit": 10,
        "offset": 0,
        "total_pages": 387,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "texts",
            "api_link": "https://api.artic.edu/api/v1/texts/46298023-ac4e-605c-3020-871b59e67de6",
            "id": "46298023-ac4e-605c-3020-871b59e67de6",
            "title": "1970_Photographs_by_Edmund_Teske_Installation_Photos_10.pdf",
            "timestamp": "2022-05-08T23:34:12-05:00"
        },
        {
            "_score": 1,
            "api_model": "texts",
            "api_link": "https://api.artic.edu/api/v1/texts/7daac14a-c6ac-bc68-3198-aee9440f1bb5",
            "id": "7daac14a-c6ac-bc68-3198-aee9440f1bb5",
            "title": "1970_Photographs_by_Euge_ne_Atget_Installation_Photos_16.pdf",
            "timestamp": "2022-05-08T23:34:12-05:00"
        },
        {
            "_score": 1,
            "api_model": "texts",
            "api_link": "https://api.artic.edu/api/v1/texts/aa99f424-7100-e96d-1bf1-c18e310601f3",
            "id": "aa99f424-7100-e96d-1bf1-c18e310601f3",
            "title": "1969_Prison_and_the_Free_WorldDanny_Lyon_Installation_Photos_10.pdf",
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
        "version": "1.6"
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
        "total": 1189,
        "limit": 2,
        "offset": 0,
        "total_pages": 595,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/products?page=2&limit=2"
    },
    "data": [
        {
            "id": 288335,
            "api_model": "products",
            "api_link": "https://api.artic.edu/api/v1/products/288335",
            "title": "C\u00f4te d\u2019Ivoire Face Mask T-Shirt",
            "external_sku": 288335,
            "image_url": "https://shop-images.imgix.net288335_2.jpg",
            ...
        },
        {
            "id": 288229,
            "api_model": "products",
            "api_link": "https://api.artic.edu/api/v1/products/288229",
            "title": "I Can Change the World Portfolio",
            "external_sku": 288229,
            "image_url": "https://shop-images.imgix.net288229_2.jpg",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.6"
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
        "total": 1189,
        "limit": 10,
        "offset": 0,
        "total_pages": 119,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "products",
            "api_link": "https://api.artic.edu/api/v1/products/263767",
            "id": "263767",
            "title": "Lion Tote",
            "timestamp": "2022-12-07T23:00:53-06:00"
        },
        {
            "_score": 1,
            "api_model": "products",
            "api_link": "https://api.artic.edu/api/v1/products/263994",
            "id": "263994",
            "title": "Japanese Prints: The Art Institute of Chicago",
            "timestamp": "2022-12-07T23:00:54-06:00"
        },
        {
            "_score": 1,
            "api_model": "products",
            "api_link": "https://api.artic.edu/api/v1/products/248377",
            "id": "248377",
            "title": "Edward Gorey Frawgge Mfrg Co. Puzzle",
            "timestamp": "2022-12-07T23:00:50-06:00"
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
        "version": "1.6"
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
        "total": 17,
        "limit": 2,
        "offset": 0,
        "total_pages": 9,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/tours?page=2&limit=2"
    },
    "data": [
        {
            "id": 4197,
            "api_model": "tours",
            "api_link": "https://api.artic.edu/api/v1/tours/4197",
            "title": "The Teen Tour",
            "image": "http://aic-mobile-tours.artic.edu/sites/default/files/tour-images/IM031265_695-int.jpg",
            "description": "<p>Experience the museum through sounds and stories produced by Chicago teens.</p>\n",
            ...
        },
        {
            "id": 4475,
            "api_model": "tours",
            "api_link": "https://api.artic.edu/api/v1/tours/4475",
            "title": "Perfectly United and Infinitely Graceful",
            "image": "http://aic-mobile-tours.artic.edu/sites/default/files/tour-images/buddha-intro.jpg",
            "description": "<p>Explore the metaphysical and spiritual in this journey through the Alsdorf South and Southeast Asian collection at the Art Institute of Chicago.</p>\n",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.6"
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
            "api_link": "https://api.artic.edu/api/v1/tours/5164",
            "id": 5164,
            "title": "The Language of Beauty in African Art",
            "timestamp": "2022-12-13T23:00:42-06:00"
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
        "version": "1.6"
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
        "total": 878,
        "limit": 2,
        "offset": 0,
        "total_pages": 439,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/mobile-sounds?page=2&limit=2"
    },
    "data": [
        {
            "id": 5285,
            "api_model": "mobile-sounds",
            "api_link": "https://api.artic.edu/api/v1/mobile-sounds/5285",
            "title": "T51_07_255294_UrhoboMotherChildFigure_V4.mp3",
            "web_url": "https://www.artic.edu/mobile/audio/T51_07_255294_UrhoboMotherChildFigure_V4.mp3",
            "transcript": "<p>Curatorial fellow Janet Purdy.</p>\n<p>Janet Purdy</p>\n<p>The most important thing about this figure is that it depicts a mother. And in Urhobo culture, it's a representation of maternity and women and the role they play in society.</p>\n<p>Perkins Foss</p>\n<p>She is a figure known as Edjo and she would be one of a group of individuals carved. And of course, that would be in a shrine that is commemorating, some would say, founding heroes, the founding family that settled an Urhobo community. Hi, I'm Perkins Foss and I am a retired associate professor of the history of art at Penn State University. Her stature as a senior titled individual is the ring, I guess we could say of... it's beads. It goes from shoulder, it continues down to her breast and up the other side. She's got a coiffure, only fragments of which are still left. That is a number of vertical tufts that would be tied off in such a way that it's almost, in a European sense, crown-like.</p>\n<p>Janet Purdy</p>\n<p>One of the important things to look at this is that the representation of the jewelry is showing different fashions of different times, and so these kind of figures would differ across different regions in the Niger delta. They would, over time, their adornment would change, and while we can't really see this woman's hairstyle, it would've been a very fashionable, really elaborate hairstyle represented at the time that this was carved.</p>\n<p>One of my favorite quotes is from a prolific Urhobo artist. His name is Bruce Onobrakpeya, and he's one of the biggest print makers in all of Africa, not just West Africa. And one of the things that he says about Urhobo art in general is, his quote is that &quot;art itself is the reflection of the life of people&quot;, and he's trying to carry that forward in whatever art form. He makes prints, but his father was a carver, so he's trying to make sure that whatever art forms that Urhobo people continue to create, that they reflect their life and culture and spirituality.</p>\n",
            ...
        },
        {
            "id": 5176,
            "api_model": "mobile-sounds",
            "api_link": "https://api.artic.edu/api/v1/mobile-sounds/5176",
            "title": "Male Figure (Nkishi: Yankima) (The Language of Beauty in African Art)",
            "web_url": "https://www.artic.edu/mobile/audio/T51_12_255103_SongyeMaleFigure_V3.mp3",
            "transcript": "<p>Narrator:</p>\n<p>Curator Costa Petridis</p>\n<p>Costa Petridis:</p>\n<p>So one way to approach this object is through its local name, which is nkishi. Nkishi is the local word for what we would typically refer to today as a power figure or a power object. And so what these objects are, literally are figures that serve as the receptacles of very powerful ingredients or substances that are literally contained within the object. And here among the Songye, as in many other parts in Southern Congo and elsewhere in Africa, those substances or ingredients are typically a concoction of materials from the animal world, from the plant world, from the mineral world, from the human world: nail clippings, bits of hair, stones that are found in nature, pieces of wood and bark, but also saliva, blood of animals that are offered, that are brewed together literally into a concoction, that is then inserted in specific body cavities. The belly is typically hollowed out and then contains these ingredients and then also the top of the skull.</p>\n<p>They're owned by leaders, by chiefs for the benefit of their community. They're invoked in order to deal with problems, conflicts such as epidemics, the threat of war in particular, but also the potential threat of metaphysical problems, like witches or other evildoers that harm the wellbeing of the community. These objects, in some ways, transcend the divide between the beautiful and the ugly, where the beauty of the carving, the powerful carving that represents an ancestor, it imitates all these attributes. And insignia of power and leadership is combined with a very powerful entity, with something that is embedded in the sculpture, and that because of its power, has both positive and negative connotations, both defensive and offensive qualities. And so the idea is that in these large-scale communities, Songye power figures, you have a combination of the beautiful and the ugly in one, in a new aesthetic category that I've come to label awesome art because it creates awe in the minds and in the eyes of the people who are confronted with these objects.</p>\n",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.6"
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
        "total": 878,
        "limit": 10,
        "offset": 0,
        "total_pages": 88,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "mobile-sounds",
            "api_link": "https://api.artic.edu/api/v1/mobile-sounds/1320",
            "id": 1320,
            "title": "Ogre-Headed Guardian Beast (Zhenmushou)",
            "timestamp": "2022-12-13T23:00:13-06:00"
        },
        {
            "_score": 1,
            "api_model": "mobile-sounds",
            "api_link": "https://api.artic.edu/api/v1/mobile-sounds/1336",
            "id": 1336,
            "title": "American Gothic",
            "timestamp": "2022-12-13T23:00:14-06:00"
        },
        {
            "_score": 1,
            "api_model": "mobile-sounds",
            "api_link": "https://api.artic.edu/api/v1/mobile-sounds/1339",
            "id": 1339,
            "title": "Chicago Stock Exchange: Bank of Five Elevator Grilles with Four Plates",
            "timestamp": "2022-12-13T23:00:14-06:00"
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
        "version": "1.6"
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
        "version": "1.6"
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
            "api_link": "https://api.artic.edu/api/v1/publications/2",
            "id": 2,
            "title": "American Silver in the Art Institute of Chicago",
            "timestamp": "2022-10-03T16:40:03-05:00"
        },
        {
            "_score": 1,
            "api_model": "publications",
            "api_link": "https://api.artic.edu/api/v1/publications/7",
            "id": 7,
            "title": "Pissarro Paintings and Works on Paper at the Art Institute of Chicago",
            "timestamp": "2022-10-03T16:40:03-05:00"
        },
        {
            "_score": 1,
            "api_model": "publications",
            "api_link": "https://api.artic.edu/api/v1/publications/12",
            "id": 12,
            "title": "The Modern Series at the Art Institute of Chicago",
            "timestamp": "2022-10-03T16:40:03-05:00"
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
        "version": "1.6"
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
        "version": "1.6"
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
        "total": 1508,
        "limit": 10,
        "offset": 0,
        "total_pages": 151,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "sections",
            "api_link": "https://api.artic.edu/api/v1/sections/39605080749",
            "id": 39605080749,
            "title": "Cat. 59.2 \u00a0Auti te pape (Women at the River), 1893/94",
            "timestamp": "2022-10-03T16:40:41-05:00"
        },
        {
            "_score": 1,
            "api_model": "sections",
            "api_link": "https://api.artic.edu/api/v1/sections/39605362193",
            "id": 39605362193,
            "title": "Cat. 59.3 \u00a0Auti te pape (Women at the River), 1894",
            "timestamp": "2022-10-03T16:40:41-05:00"
        },
        {
            "_score": 1,
            "api_model": "sections",
            "api_link": "https://api.artic.edu/api/v1/sections/39605643638",
            "id": 39605643638,
            "title": "Cat. 59.4 \u00a0Auti te pape (Women at the River), 1894",
            "timestamp": "2022-10-03T16:40:41-05:00"
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
        "version": "1.6"
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
        "version": "1.6"
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
        "version": "1.6"
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
        "total": 2322,
        "limit": 2,
        "offset": 0,
        "total_pages": 1161,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/events?page=2&limit=2"
    },
    "data": [
        {
            "id": 5575,
            "api_model": "events",
            "api_link": "https://api.artic.edu/api/v1/events/5575",
            "title": "Member Lecture: Salvador Dal\u00ed\u2014The Image Disappears",
            "title_display": "Member Lecture: <i>Salvador Dal\u00ed\u2014The Image Disappears</i>",
            "image_url": "https://artic-web.imgix.net/c6c97c77-359e-4007-8be3-be302010c32c/dali.png?rect=0%2C25%2C1280%2C719&auto=format%2Ccompress&q=80&fit=crop&crop=faces%2Cedges%2Centropy&w=1200&h=674",
            ...
        },
        {
            "id": 5580,
            "api_model": "events",
            "api_link": "https://api.artic.edu/api/v1/events/5580",
            "title": "Lecture: The Power of Display: Gold in Akan Art and Aesthetics",
            "title_display": "Lecture: The Power of Display\u2014Gold in Akan Art and Aesthetics",
            "image_url": "https://artic-web.imgix.net/9941566d-db3f-4031-8e12-93fb4899a580/default.jpg?rect=0%2C421%2C843%2C473&auto=format%2Ccompress&q=80&fit=crop&crop=faces%2Cedges%2Centropy&w=1200&h=673",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.6"
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
        "total": 2322,
        "limit": 10,
        "offset": 0,
        "total_pages": 233,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "events",
            "api_link": "https://api.artic.edu/api/v1/events/5590",
            "id": 5590,
            "title": "The Art Exchange (Dec 23\u201324)",
            "timestamp": "2022-12-13T23:17:49-06:00"
        },
        {
            "_score": 1,
            "api_model": "events",
            "api_link": "https://api.artic.edu/api/v1/events/5589",
            "id": 5589,
            "title": "The Art Exchange (Dec 16\u201318)",
            "timestamp": "2022-12-13T23:17:49-06:00"
        },
        {
            "_score": 1,
            "api_model": "events",
            "api_link": "https://api.artic.edu/api/v1/events/5588",
            "id": 5588,
            "title": "The Art Exchange (Dec 9\u201311",
            "timestamp": "2022-12-13T23:17:49-06:00"
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
        "image_url": "https://artic-web.imgix.net/22a002db-9695-452b-9c85-7a63644df4e0/G35154-int_press.jpg?rect=0%2C349%2C2334%2C1312&auto=format%2Ccompress&q=80&fit=crop&crop=faces%2Cedges%2Centropy&w=1200&h=675",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.6"
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
        "total": 424,
        "limit": 2,
        "offset": 0,
        "total_pages": 212,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/event-occurrences?page=2&limit=2"
    },
    "data": [
        {
            "id": "75eb4fd8-d7b5-5ae3-9cfe-f850277e5b53",
            "api_model": "event-occurrences",
            "api_link": "https://api.artic.edu/api/v1/event-occurrences/75eb4fd8-d7b5-5ae3-9cfe-f850277e5b53",
            "title": "Lecture: The Power of Display: Gold in Akan Art and Aesthetics",
            "event_id": 5580,
            "short_description": "Join Nii Otokunor Quarcoopome, curator of African art and department head of Africa, Oceania, and Indigenous Americas at the Detroit Institute of Arts, to learn more about the historic and contemporary functions and meanings of gold in Akan arts.",
            ...
        },
        {
            "id": "afdc8c55-1846-5dbc-84ea-12b5490599fc",
            "api_model": "event-occurrences",
            "api_link": "https://api.artic.edu/api/v1/event-occurrences/afdc8c55-1846-5dbc-84ea-12b5490599fc",
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
        "version": "1.6"
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
        "total": 424,
        "limit": 10,
        "offset": 0,
        "total_pages": 43,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "event-occurrences",
            "api_link": "https://api.artic.edu/api/v1/event-occurrences/1c465b7c-9c84-55a3-9777-9ac5cf18b2db",
            "id": "1c465b7c-9c84-55a3-9777-9ac5cf18b2db",
            "title": "Conversation: Discovering Dal\u00ed\u2019s Dream of Venus",
            "timestamp": "2022-12-13T23:26:06-06:00"
        },
        {
            "_score": 1,
            "api_model": "event-occurrences",
            "api_link": "https://api.artic.edu/api/v1/event-occurrences/d659b687-0d0f-5d34-b0e9-e4c673ccb8e6",
            "id": "d659b687-0d0f-5d34-b0e9-e4c673ccb8e6",
            "title": "Member Lecture: The Journey of the Noble Dos Aguas Armory",
            "timestamp": "2022-12-13T23:26:06-06:00"
        },
        {
            "_score": 1,
            "api_model": "event-occurrences",
            "api_link": "https://api.artic.edu/api/v1/event-occurrences/61fdff14-c4b8-5c6b-9c4b-1c761a66055f",
            "id": "61fdff14-c4b8-5c6b-9c4b-1c761a66055f",
            "title": "The Art Exchange (Apr 28\u201330)",
            "timestamp": "2022-12-13T23:26:06-06:00"
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
        "website_url": "http://www.artic.edu"
    }
}
```
:::

##### `GET /event-occurrences/{id}`

A single event-occurrence by the given identifier.

::: details Example request: https://api.artic.edu/api/v1/event-occurrences/000ee5de-6c64-5c74-86dd-5a55153f6995  
```js
{
    "data": {
        "id": "000ee5de-6c64-5c74-86dd-5a55153f6995",
        "api_model": "event-occurrences",
        "api_link": "https://api.artic.edu/api/v1/event-occurrences/000ee5de-6c64-5c74-86dd-5a55153f6995",
        "title": "The Art Exchange (Apr 7\u201310)",
        "event_id": 5524,
        "short_description": "Visitors of all ages are invited to stop by the Ryan Learning Center and explore a variety of activities.",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.6"
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
        "total": 36,
        "limit": 2,
        "offset": 0,
        "total_pages": 18,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/event-programs?page=2&limit=2"
    },
    "data": [
        {
            "id": 27,
            "api_model": "event-programs",
            "api_link": "https://api.artic.edu/api/v1/event-programs/27",
            "title": "Accessibility",
            "is_affiliate_group": false,
            "is_event_host": false,
            ...
        },
        {
            "id": 16,
            "api_model": "event-programs",
            "api_link": "https://api.artic.edu/api/v1/event-programs/16",
            "title": "Antiquarian Society",
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
        "version": "1.6"
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
        "total": 36,
        "limit": 10,
        "offset": 0,
        "total_pages": 4,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "event-programs",
            "api_link": "https://api.artic.edu/api/v1/event-programs/79",
            "id": 79,
            "title": "Start Here Tours",
            "timestamp": "2022-12-13T23:27:19-06:00"
        },
        {
            "_score": 1,
            "api_model": "event-programs",
            "api_link": "https://api.artic.edu/api/v1/event-programs/87",
            "id": 87,
            "title": "Joseph Cornell",
            "timestamp": "2022-12-13T23:27:19-06:00"
        },
        {
            "_score": 1,
            "api_model": "event-programs",
            "api_link": "https://api.artic.edu/api/v1/event-programs/86",
            "id": 86,
            "title": "Kelly Church",
            "timestamp": "2022-12-13T23:27:19-06:00"
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
        "version": "1.6"
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
        "total": 389,
        "limit": 2,
        "offset": 0,
        "total_pages": 195,
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
            "id": 702,
            "api_model": "articles",
            "api_link": "https://api.artic.edu/api/v1/articles/702",
            "title": "American Egyptomania",
            "copy": " Ancient Egypt has fascinated the American public for centuries. The grandeur and \u201cexoticism\u201d of its pyramids, temples, Great Sphinx, and culture have made this great civilization a recurring subject in architecture, film, art, and popular culture. In fact, Egyptian imagery, often taken out of context and presented as a stereotype, has been so present in American culture that it feels strangely familiar. During the 20th century Egyptomania reached a fever pitch in the United States: Howard Carter\u2019s 1922 discovery of King Tutankhamen\u2019s Tomb caused a nationwide craze, and Elizabeth Taylor\u2019s portrayal of Cleopatra in the 1963 classic film inspired a new interest in ancient Egyptian fashion.   Chicago was not immune to the Egyptian Revival craze, and many fine examples of Egyptian-inspired architecture can be found in the city. Graceland Cemetery in Uptown and Rosehill Cemetery in Ravenswood are two sites that house Victorian-era memorial tombs and mausoleums in the Egyptian style. A more modern and commercial example is a warehouse built by the Chicago-based storage and moving company Reebie, founded in 1880 by William C. Reebie. In 1922, the same year King Tut\u2019s tomb was discovered, the Reebie Storage and Moving Company opened a historical warehouse on the 2300 block of North Clark Street.   The building\u2019s singular fa\u00e7ade, decorated in a colorful Egyptian Revival style, features an entrance guarded by twin statues of Pharaoh Ramses II. Not surprisingly, the Reebie warehouse was designated a Chicago historical landmark in 1999.   Another Egyptian Revival\u2013style building, captured by photographer and scholar Harold Allen, is the Cairo Supper Club, a one-story building whose exterior is adorned with glazed polychromatic terra-cotta, lotus-capped columns, and a winged-scarab medallion in the cornice. Designed in 1920 by architect Paul Gerhardt Sr., the building was first used as an automobile showroom and then housed the Cairo Supper Club from the 1940s to the 1960s. The Egyptian-themed fa\u00e7ade combined with the Art Deco\u2013inflected neon lights and large plate-glass windows seem to provide a vivid marriage of two different but equally influential cultures. The Egyptian-themed fa\u00e7ade combined with the Art Deco-inflected neon lights and large plate-glass windows seems to provide a vivid marriage of two different but equally influential cultures.   Similar to the Reebie warehouse, the Cairo Supper Club building was named a Chicago historical landmark in 2013 under the guidelines of exemplary architecture with a unique exterior. The Cairo Supper Club wasn\u2019t the only Egyptian-inspired building that attracted Allen\u2019s attention and his camera. In fact, he made it his goal to photograph all the Egyptian Revival\u2013style architecture ever built and simultaneously began collecting his other items that grew out the country\u2019s Egyptomania craze\u2014magazines, print and mass-manufactured material, Wedgwood, ceramics, and memorabilia. You can experience his photographs and selections from his collection now in the exhibition Forever \u201cEgypt!\u201d: Works from the Collection of Harold Allen .   The exhibition runs through August 31 in the museum\u2019s Ryerson and Burnham Libraries. Please note: The libraries are closed Saturday and Sunday. \u2014Alejandra Vargas and Margarita Lizcano Hernandez, 2016\u201318 Andrew W. Mellon Undergraduate Curatorial Fellows and exhibition co-curators ",
            "source_updated_at": "2018-08-14T09:38:13-05:00",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.6"
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
        "total": 389,
        "limit": 10,
        "offset": 0,
        "total_pages": 39,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "articles",
            "api_link": "https://api.artic.edu/api/v1/articles/823",
            "id": 823,
            "title": "Watch This: Art and Artists on the Silver Screen",
            "timestamp": "2022-12-13T23:01:48-06:00"
        },
        {
            "_score": 1,
            "api_model": "articles",
            "api_link": "https://api.artic.edu/api/v1/articles/972",
            "id": 972,
            "title": "More Kinds of Blue",
            "timestamp": "2022-12-13T23:01:48-06:00"
        },
        {
            "_score": 1,
            "api_model": "articles",
            "api_link": "https://api.artic.edu/api/v1/articles/963",
            "id": 963,
            "title": "Kinds of Blue",
            "timestamp": "2022-12-13T23:01:48-06:00"
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
        "version": "1.6"
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
        "total": 29,
        "limit": 2,
        "offset": 0,
        "total_pages": 15,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/highlights?page=2&limit=2"
    },
    "data": [
        {
            "id": 29,
            "api_model": "highlights",
            "api_link": "https://api.artic.edu/api/v1/highlights/29",
            "title": "contemporary-chicago-artists",
            "copy": " Explore all the works by Chicago artists in the museum's collection.   Dawoud Bey   Photographer Dawoud Bey has called Chicago home since 1998. While known for his color photography and striking portraits, for this project, Bey returned to black-and-white printing of his early years and turned his attention on an unpeopled landscape: homes and patches of land that are understood to have formed part of the Underground Railroad. For the title of the series, Night Coming Tenderly, Black , Bey was inspired by the closing couplet of a short poem \u201cDream Variations\u201d by Langston Hughes: \u201cNight coming tenderly / Black like me.\u201d   Gladys Nilsson   Among the most celebrated watercolorists working today, longtime Chicagoan Gladys Nilsson studied at the School of the Art Institute of Chicago (SAIC) and has taught at the school for over 25 years. As a member of the artist group known as the Hairy Who , Nilsson helped inject new and unique energy into the city's art landscape. Her mischievous scenes of figures interacting and engaging in various pursuits, including disguise and voyeurism, express her sense of humor and boundless curiosity. This watercolor, originally commissioned by SAIC to be used as an advertising poster, depicts playfully arranged crowds of students painting, listening to music, chatting, and hanging out in many different spaces.   Jeanne Gang   Internationally renowned for her Aqua Tower , Jeanne Gang has designed buildings across the world, and many in and around Chicago, including the Writers' Theatre, several residential buildings, two boat houses along the river, the Nature Boardwalk at Lincoln Park Zoo, and a community center in the Auburn-Gresham neighborhood. Gang designed this space to provide a welcoming, familiar space for Chinese immigrants arriving in Chicago. Finding subtle ways to incorporate traditional Chinese colors and signs within a modern, airy space, Gang organized the small structure to maximize the intergenerational connections common within the Chicago Chinese community.   Kerry James Marshall   For the last three decades, artist Kerry James Marshall has applied themes from art history to examine and recontextualize the representation of black culture. In his painting series Vignette Suite, Marshall used characteristics of the fanciful 18th-century French Rococo style and projected positive images of black life, centered around the notion of love. He focused his series on the air-borne embrace of a man and woman and surrounded them with various emblems of black affirmation, including a Black Power clenched fist, hands breaking through chains, the Black Liberation flag, African artifacts, and a panther. The result is both a multifaceted and evolving depiction of love and black identity as well as a powerful reinterpretation of a traditional art form.   Richard Hunt   One of the most important sculptors of our time, Richard Hunt was raised in Chicago and graduated from the School of the Art Institute of Chicago. Still in the city today, Hunt works out of a repurposed Chicago Railway Systems electrical substation built in 1909, creating both towering sculptures and more intimate constructions. His 2020 installation on the Art Institute\u2019s Bluhm Family Terrace features the title work, Scholar\u2019s Rock or Stone of Hope or Love of Bronze , a monumental bronze sculpture that Hunt created over six years through a durational process of adding, removing, and reshaping the work. Read more about this installation in a conversation between Hunt and curator Jordan Carter.   Anne Wilson   Anne Wilson , the Chicago-based artist and professor emeritus of Fiber and Material Studies at the School of the Art Institute of Chicago, defies easy categorization. Working with everyday materials such as table linens, bed sheets, human hair, lace, thread, glass, and wire, Wilson considers the inequities of factory labor, the impact of globalization, domestic and social rituals, and themes of time and loss. For her Dispersions series, Wilson created 26 works from fragments of heirloom damask tablecloths and napkins. Wilson opened up a damaged area in each piece of cloth into a perfect circle and embellished the edges with colored thread and hair. These are ambiguous material images, suggesting the trace from a gunshot or a celestial explosion and evoking the mortal and physical alongside the transcendent and unknowable. Wilson draws our attention to the contrasts between the machine-made cloth and the intricate hand stitching; creating tension between the artist's intervention and its foundation, and between the formal tone-on-tone design of the white cloth and the small bursts of color and texture dispersed around damaged cloth.   Amanda Williams   Currently based in the South Side neighborhood of Bridgeport, Amanda Williams was born and raised in the Chicagoland area. Her work blends her architectural training with traditional art approaches to confront issues of race, value, and urban space. For her most famous project, Color(ed) Theory , which debuted at the Chicago Architecture Biennial in 2015, Williams painted eight soon-to-be-demolished houses in Chicago's Englewood using a palette of colors found in products and services marketed primarily toward Black people, such as Flamin\u2019 Red Hots. Drawing attention to the underinvestment in African American communities around the city, the series asks: What color is poverty? What color is gentrification?   Pope.L   Known for his groundbreaking performances as well as for text-based drawings and paintings that disrupt the conventions of cultural identity and explode traditional artistic categories, artist Pope.L has lived in Chicago for over a decade and has been a professor at University of Chicago since 2010. The title of this work, Finnish Painting evokes a strangely specific yet enigmatic sense of national identity while also offering a play on words, the imperative to \u201cfinish painting.\u201d This work presents the barely legible text of a poem, the last word of which is \u201cdecode\u201d\u2014as if acknowledging that to see, read, and understand others is always a struggle, and that meaning is often fluid. Another text-based feature is the attribution at the lower right, \u201cR. Ryman,\u201d referring to Minimalist artist Robert Ryman , whose monochromatic white paintings were often layered color underpainting and who treated his signature as an important visual element within a painting\u2019s composition, never simply as authorization of a finished canvas. Perhaps this Pope.L work reveals what might lie beneath Ryman\u2019s white surfaces.   Stanley Tigerman   Architect, designer, and provocateur Stanley Tigerman \u2014a lifelong Chicagoan\u2014made it his mission to push the city's architecture beyond the then reigning style of the modernist glass box. His design for the Holocaust Museum and Education Center in Skokie integrates symbolic gestures of Judaism in various ways\u2014the site plan, materials, and formal language. This model for an early scheme shows how the museum is composed of two wings\u2014the darkened wing points six degrees toward the Western Wall in Jerusalem, and the lighter education center toward the rising sun. He suggested that the use of such symbolism serves an act of defiance to those who would eliminate a particular culture and its history.   Bethany Collins   Originally from Alabama, Bethany Collins currently lives in Chicago making work that explores the deep-rooted connections between race and language. In The Birmingham News, 1963 , Collins presents 18 embossed and distressed front pages from issues of the Birmingham News published during 1963, a seismic year for the civil rights movement. While most national media outlets were covering the area\u2019s sit-ins, demonstrations, and police brutality, the Birmingham News did not, supposedly to subdue racial tension. By embossing, darkening, and distressing these pages, Collins transforms them into a kind of memorial to events ignored by the Birmingham press and demonstrates how authored and institutional texts are always politicized.   Terry Evans   A Kansas City native, Terry Evans moved to Chicago in 1994 and has lived here since. After focusing on the Midwestern prairie for many years, Evans took to the skies and photographed the city from above for her Revealing Chicago project. From backyard pools to the city jail, the lakefront to industrial areas, Evans sought to show \"the diversity and complexity of Chicago.\" She lamented that she \"hadn't even come close. This is an incomplete portrait, a fraction of a second in the life of Chicago, and every picture contains more stories than the image reveals.\"   Judy Ledgerwood   A longtime Midwesterner and decades-long Chicagoan, Judy Ledgerwood paints monumental abstractions that explore both the perceptual effects and the politics of color, luminosity, pattern, and scale. After earning her MFA from the School of the Art Institute of Chicago in 1984, she turned to traditionally \u201cfeminine\u201d pastels and decorative forms in order to challenge the stereotypes of gendered approaches to painting. Ledgerwood borrowed this work\u2019s title, So What , from a 1959 \u201ccool period\u201d jazz composition by Miles Davis. Made during winter, the painting features pale colors evocative of the season and at first appears quiet and serene. Yet sustained looking reveals subtle modulations in the blue-green, yellow, and white circles, which seem to alternately recede and advance across the work\u2019s surface. ",
            "source_updated_at": "2021-03-24T16:22:26-05:00",
            ...
        },
        {
            "id": 28,
            "api_model": "highlights",
            "api_link": "https://api.artic.edu/api/v1/highlights/28",
            "title": "art-activism",
            "copy": " This tour looks at works across time and cultures to examine how art can activate ideas for both the maker and the audience, and asks you to think critically about different approaches to activism and how you can use your own voice.   In 2003 photographer Gauri Gill was invited to the Balika Mela, or \u201cfair celebrating girls,\u201d which is held annually in the Indian state of Rajasthan and aims to raise awareness of difficulties for women in surrounding communities. At the fair Gill set up a photo booth and invited young women to \u201cportray themselves, as they are, or as they see themselves, or to invent new selves for the camera.\u201d Revanti, the subject of this photo, is a young girl from Rajasthan, an area in which girls and women are often marginalized and not permitted to pursue their own interests and identities. How would you pose to represent the way you want to be seen?   Benny Andrews painted this image of a black man wrapped in the American flag in 1966 during the Civil Rights Era. This powerful image poses numerous questions, both relevant to the time it was made and resonant in American society today: Is the man protected by the flag, or imprisoned by it? Whose freedom is safeguarded by the American flag? Can the flag be used to reinforce oppression? What other political or national symbols can be examined in this way?   The Kamakura period (1185\u20131333) was a time of significant political and cultural change in Japan, bringing about disagreements over the national religion, Buddhism, and its purest form. One sect, Pure Land, promised that all people could attain spiritual enlightenment. It was widely promoted by traveling priests and became popular among the general population. The figure of Jizo, a gentle, peaceful monk who shakes the rings on his staff to alert creatures in his path of his presence so they are not trampled, models Pure Land\u2019s compassion for all living beings while quietly campaigning for this form of Buddhism. What other kinds of quiet and seemingly small gestures can be effective as activism?   During the second World War, Japan had been largely isolated, ruled by a totalitarian regime where individual freedoms were significantly limited. In the aftermath of the war, in 1954, a group of artists formed the collective known as the Gutai Art Association and invited everyone to make art that would transform both art and society. Embracing the vitality of raw materials and the directness of gesture, Gutai advocated for abstraction as a path to individual self-expression. For her collages, Shiraga used what she called \u201cdangerous things,\u201d like the broken glass in this work, reflecting an aggressive stance toward the tradition of fine art, and perhaps tradition in general. How can the process of making art using everyday materials and free-flowing abstraction inspire us to act on our beliefs? How can it inspire others?   Brazilian artist Wanda Pimentel created Involvement Series in the late 1960s. An important work of International Pop Art, the vivid, graphic-style painting comments on social and political systems that reinforced economic inequities and gender stereotypes. Cropping, flat areas of color, and heavy outlines define everyday objects and glimpses of a fragmented and anonymous female form, a pair of feet. These familiar markers of domestic labor are presented in a compressed, alienating space that suggests the constraints imposed on women by a male-dominated society. How can everyday words and symbols be reclaimed or reframed to actively resist stereotypes and oppression?   In 1967, the artists of the Organization for Black American Culture (OBAC) created the Wall of Respect, a public mural in Chicago at the intersection of East 43rd Street and South Langley Avenue. The mural was to include representations of over 50 notable African Americans, including political figures, artists, musicians, authors, and athletes. Norman Parish\u2019s contributions to the mural\u2014portraits of H. Rap Brown, Stokely Carmichael, Marcus Garvey, Adam Clayton Powell, and Malcolm X\u2014were painted over by his peers who felt that Parish\u2019s fine-art training at the School of the Art Institute made his work too \u201cwesternized.\u201d Black Pride Whitewashed is Parish\u2019s record of his excluded portraits. It was originally two panels; the second (later destroyed by the artist) showed the same view after his work had been covered over. How can public art amplify, and at times obscure, voices? What questions does this raise about possible tensions between the individual voice and the community in acts of activism?   Honor\u00e9 Victorin Daumier\u2019s caricatures of French King Louis-Philippe (reigned 1830\u20131848) used satire as a form of political critique. This print, published in the satirical journal La Caricature in 1834, depicts the king with an exaggerated pear-shaped head and three faces, reflecting the sharp shift in public opinion of the king\u2014from inspiring hope at his coronation to inciting despair once his reign took hold. Daumier\u2019s caricatures did get him into trouble: his earlier print, Gargantua , an even more biting critique of the monarchy\u2019s gluttonous economic policies, resulted in the artist and his publisher Charles Philipon being sentenced to six months in jail in 1832. How can we use humor to communicate, critique, and persuade? Is satire effective even if it only serves to strengthen already existing points of view? ",
            "source_updated_at": "2021-10-22T13:19:26-05:00",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.6"
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
        "total": 29,
        "limit": 10,
        "offset": 0,
        "total_pages": 3,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "highlights",
            "api_link": "https://api.artic.edu/api/v1/highlights/52",
            "id": 52,
            "title": "chicagos-home-for-the-holidays",
            "timestamp": "2022-12-13T23:30:54-06:00"
        },
        {
            "_score": 1,
            "api_model": "highlights",
            "api_link": "https://api.artic.edu/api/v1/highlights/3",
            "id": 3,
            "title": "what-to-see-in-an-hour",
            "timestamp": "2022-12-13T23:30:54-06:00"
        },
        {
            "_score": 1,
            "api_model": "highlights",
            "api_link": "https://api.artic.edu/api/v1/highlights/53",
            "id": 53,
            "title": "beauty-around-the-world",
            "timestamp": "2022-12-13T23:30:54-06:00"
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
        "copy": " Please note: artworks occasionally go off view for imaging, treatment, or loan to other institutions. Click on the images to ensure the work is currently on view.   One of the most famous American paintings of all time, this double portrait by Grant Wood debuted at the Art Institute in 1930, winning the artist a $300 prize and instant fame. Many people think the couple are a husband and wife, but Wood meant the couple to be a father and his daughter. (His sister and his dentist served as his models.) He intended this Depression-era canvas to be a positive statement about rural American values during a time of disillusionment. See American Gothic on view in Gallery 263.   For his largest and best-known painting, Georges Seurat depicted Parisians enjoying all sorts of leisurely activities\u2014strolling, lounging, sailing, and fishing\u2014in the park called La Grande Jatte in the River Seine. He used an innovative technique called Pointillism, inspired by optical and color theory, applying tiny dabs of different colored paint that viewers see as a single, and Seurat believed, more brilliant hue. See this work on view in Gallery 240.   Hero Construction , created in 1958, just a year after Chicago sculptor Richard Hunt graduated from the School of the Art Institute, is composed of found objects\u2014old pipes, bits of metal, and automobile parts\u2014that the artist discovered in junkyards and on the street. Inspired by mythology and heroic sculptures past and present, the welded figure suggests a hero for our times, humble yet resilient in the face of past, present, and future injustices and uncertainties. See Hero Construction on view on the Woman's Board Grand Staircase.   This iconic painting of an all-night diner in which three customers sit together and yet seem totally isolated from one another has become one of the best-known images of 20th-century art. Hopper said of the enigmatic work, \u201cUnconsciously, probably, I was painting the loneliness of a large city.\u201d See Nighthawks on view in Gallery 262.   In the 1970s, Alma Thomas was enthralled by astronauts and outer space. Starry Night and the Astronauts not only captures her fascination with space flight but also shows the signature style of her abstract works, which use short, rhythmic strokes of paint. \u201cColor is life,\u201d she once proclaimed, \u201cand light is the mother of color.\u201d Thomas made this work in 1972, when she was 81\u2014the same year she became the first African American woman to have a solo exhibition at the Whitney Museum of American Art in New York. See Starry Night and the Astronauts in Gallery 291.   Pablo Picasso\u2019s The Old Guitarist is a work from his Blue Period (1901\u201304). During this time the artist restricted himself to a cold, monochromatic blue palette and flattened forms, taking on the themes of misery and alienation inspired by such artists as Edvard Munch and Paul Gauguin. The elongated, angular figure also relates to Picasso\u2019s interest in Spanish art and, in particular, the great 16th-century artist El Greco . The image re\ufb02ects the 22-year-old Picasso\u2019s personal sympathy for the plight of the downtrodden; he knew what it was like to be poor, having been nearly penniless during all of 1902. See The Old Guitarist on view in Gallery 391.   Over his short five-year career, Vincent van Gogh painted 35 self-portraits\u201424 of them, including this early example, during his two-year stay in Paris with his brother Theo. Here, Van Gogh used densely dabbed brushwork, an approach influenced by Georges Seurat\u2019s revolutionary technique in A Sunday on La Grande Jatte\u20141884 (on view Gallery in 240), to create a dynamic portrayal of himself. The dazzling array of dots and dashes in brilliant greens, blues, reds, and oranges is anchored by his intense gaze. See Van Gogh's Self-Portrait on view in Gallery 241.   Caught in the heat of battle with sword raised and horse rearing, this mounted figure may match many notions of a knight in shining armor but actually represents a common hired soldier. The armors for both man and horse were produced in Nuremberg, Germany, in the 16th century, but the clothing was meticulously recreated in 2017 from period designs. Look for the special leggings: small plates of steel are sewn between two pieces of linen to protect the soldier's legs. You'll also spot some splashes of mud and grime from the battlefield. See Field Armor for Man and Horse on view in Gallery 239.   The densely painted and geometrically patterned Kuba mask is a ngady mwaash , an idealized representation of a woman that honors the role of women in Kuba life. Ngady mwaah most often appear as part of a trio of royal masks in reenactments of the Kuba Kingdom\u2019s origins, which are staged at public ceremonies, initiations, and funerals. In these masquerades, the ngady mwaash dances together with the mooshamb-wooy mask, which represents the king (who is both her brother and her husband), and the bwoom mask. Male mask characters like bwoom display aggression and heaviness while female characters like ngady mwaash dance in a sensuous and graceful manner even though the mask is always worn by a man. See this ngady mwaash on view in Gallery 137.   This 12th-century statue of the Buddha comes from the south Indian coastal town of Nagapattinam, where Buddhist monasteries flourished and attracted monks from distant lands. He is seated in a lotus posture of meditation, with hands and feet resting atop one another. The mark on his forehead is called the urna, which distinguishes the Buddha as a great being. See this work on view in Gallery 140.   A native Chicagoan and graduate of the School of the Art Institute, Archibald Motley used his art to represent the vibrancy of African American culture, frequently portraying young, sophisticated city dwellers out on the town. One of Motley\u2019s most celebrated paintings, Nightlife depicts a crowded cabaret in the South Side neighborhood of Bronzeville. The dynamic composition, intense lighting, and heightened colors vividly express the liveliness of the scene. See Nightlife in Gallery 263.   Painted in the summer of 1965, when Georgia O'Keeffe was 77 years old, this monumental work culminates the artist\u2019s series based on her experiences as an airplane passenger during the 1950s. Spanning the entire 24-foot width of O\u2019Keeffe\u2019s garage, the work has not left the Art Institute since it came into the building\u2014because of its size and because of its status as an essential icon. See Sky above Clouds IV on view in Gallery 249.   More than 100 years ago, Agnes F. Northrop designed the monumental Hartwell Memorial Window for Tiffany Studios as a commission from Mary Hartwell in honor of her husband, Frederick Hartwell, for the Central Baptist Church of Providence, Rhode Island (now Community Church of Providence). Composed of 48 panels and numerous different glass types, the window is inspired by the view from Frederick Hartwell\u2019s family home near Mt. Chocorua in New Hampshire. The majestic scene captures the transitory beauty of nature\u2014the sun setting over a mountain, flowing water, and dappled light dancing through the trees\u2014in an intricate arrangement of vibrantly colored glass. See the Hartwell Memorial Window on view at the top of the Woman's Board Grand Staircase. ",
        "source_updated_at": "2022-11-22T12:50:32-06:00",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.6"
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
        "version": "1.6"
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
            "timestamp": "2022-12-14T15:55:06-06:00"
        },
        {
            "_score": 1,
            "api_model": "static-pages",
            "api_link": "https://api.artic.edu/api/v1/static-pages/2",
            "id": 2,
            "title": "Events",
            "timestamp": "2022-12-14T15:55:06-06:00"
        },
        {
            "_score": 1,
            "api_model": "static-pages",
            "api_link": "https://api.artic.edu/api/v1/static-pages/3",
            "id": 3,
            "title": "Exhibitions",
            "timestamp": "2022-12-14T15:55:06-06:00"
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
        "source_updated_at": null,
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.6"
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
        "total": 222,
        "limit": 2,
        "offset": 0,
        "total_pages": 111,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/generic-pages?page=2&limit=2"
    },
    "data": [
        {
            "id": 185,
            "api_model": "generic-pages",
            "api_link": "https://api.artic.edu/api/v1/generic-pages/185",
            "title": "Contact",
            "web_url": "https://nocache.www.artic.edu/contact",
            "copy": " Answers to our most frequently asked questions are available right here on our website: Looking for museum hours, admission information, and tips for planning your visit? Check out our Visit page . Want to know what\u2019s on view? Wondering about taking pictures in the galleries? Curious about our lions? Find answers to these questions and more in our FAQs . Wondering if you\u2019re eligible for one of our free admission programs? Head to our Free Admission Opportunities page for more information.   For specific inquiries, please reach out via the phone numbers and email addresses below. Ticketing and Sales Questions about your tickets? We\u2019re happy to help answer questions about pricing, help with error messages, and more. ticketing@artic.edu Membership As a reminder, members never need tickets or reservations to visit the museum or special exhibitions\u2014your membership acts as your reservation. membership@artic.edu Research Center Do you have a question about a piece in our collection, one of our exhibitions, a research project, or the history of the museum itself? Our library and archive staff are happy to help. archives@artic.edu reference@artic.edu Careers at the Art Institute of Chicago career-opportunities@artic.edu (312) 629-9420 Image Licensing image-requests@artic.edu (312) 443-7245 Visiting with a Group Currently we are offering options for both K\u201312 students and adults to visit as a group, but our offerings for university students, outside of our University Partners program , are on pause. K\u201312 Student Tours studenttours@artic.edu Adult Group Visits groupsales@artic.edu Venue Rental The Art Institute offers a variety of unique settings to choose from as you plan your perfect event. Please fill out our inquiry form to learn more about rental opportunities. ",
            ...
        },
        {
            "id": 64,
            "api_model": "generic-pages",
            "api_link": "https://api.artic.edu/api/v1/generic-pages/64",
            "title": "Personal Papers",
            "web_url": "https://nocache.www.artic.edu/institutional-archives/personal-papers",
            "copy": " These records from outside sources consist of the personal papers of individuals related in some way to the history of the Art Institute, people closely associated with the institution, or the collections. Similar materials that have no association with the Art Institute have been transferred to the Ryerson and Burnham Archives of the Ryerson and Burnham Libraries. Bartlett, Frederic Clay (1873\u20131953) Artist, teacher, donor, and trustee Blake, Margaret Day Donor, trustee, and founder of the Woman's Board Chassaing, Edouard and Olga Artists and teachers Gardner, Helen (1878\u20131946) Teacher Halstead, Whitney (1926\u20131978) Teacher and biographer of Joseph Yoakum (1886\u20131972) Harding, George (1868\u20131939) Collector and founder of the Harding Museum Schniewind, Carl (1900\u20131957) Curator Taft, Lorado (1860\u20131936) Artist and teacher Tyler, Alice Kellogg (1866\u20131900) Teacher Ufer, Walter (1876\u20131936) Artist Wade, Caroline (1857\u20131943) Artist and teacher ",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.6"
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
        "total": 222,
        "limit": 10,
        "offset": 0,
        "total_pages": 23,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "generic-pages",
            "api_link": "https://api.artic.edu/api/v1/generic-pages/281",
            "id": 281,
            "title": "Explore the Collection",
            "timestamp": "2022-12-13T23:31:11-06:00"
        },
        {
            "_score": 1,
            "api_model": "generic-pages",
            "api_link": "https://api.artic.edu/api/v1/generic-pages/44",
            "id": 44,
            "title": "Chicago Commercial, Residential, and Landscape Architecture, Post-WWII",
            "timestamp": "2022-12-13T23:31:11-06:00"
        },
        {
            "_score": 1,
            "api_model": "generic-pages",
            "api_link": "https://api.artic.edu/api/v1/generic-pages/405",
            "id": 405,
            "title": "Open Access",
            "timestamp": "2022-12-13T23:31:11-06:00"
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
        "web_url": "https://nocache.www.artic.edu/visit/free-admission-opportunities",
        "copy": " NO ADVANCE TICKET REQUIRED The following groups are invited to visit our galleries at no cost every day\u2014even when museum admission tickets are sold out. In order to receive your free admission benefits, simply show the corresponding identification at the admissions desk in either museum lobby. Free admission benefits are not single use\u2014you are welcome to use them any time you would like to visit. Kids under 14 Admission is always free for children under 14. These free tickets are available online as well as on-site at the admissions counters. Chicago Teens Museum admission is free for Chicago teens under the age of 18, thanks to the extraordinary generosity of Glenn and Claire Swogger and the Redbud Foundation. See more opportunities and resources for teens . Active-Duty Military As part of the Blue Star Museums program, active-duty service members receive free admission all year long. Plus, from Armed Forces Day through Labor Day, we also welcome service members and their households. Please bring your active-duty military ID to the admissions counter to receive this benefit. LINK and WIC Cardholders As part of Museums for All, LINK and WIC cardholders and anyone in their households receive free general admission to the museum and all ticketed special exhibitions. Simply present your card along with a valid photo ID. Illinois Educators Free admission is available to current Illinois educators, including pre-K\u201312 teachers, teaching artists working in schools, and homeschool parents. Educators can register online to receive a voucher for a complimentary ticket to the museum. This voucher must be presented\u2014as a printed document or on a smartphone\u2014with a valid educator ID at one of the museum\u2019s admission counters. Learn more about requesting complimentary educator admission. Kids Museum Passport Sponsored by the 15 Museums Work for Chicago institutions, this program allows individuals with a Chicago Public Library card to check out a pass for free general admission to the Art Institute. Please note the following parameters for use of the Kids Museum Passport: Each pass admits a maximum of four people for general admission\u2014at least one child under the age of 18 and a maximum of two adults. Ticketed exhibitions and activities are not included and must be purchased separately. University Partners Students of colleges and universities in the University Partner Program are entitled to free general and special exhibition admission by showing a valid student ID at the ticket counter. Check the full list of partnering colleges and universities . Corporate Partners Employees of certain companies in the Corporate Partner Program are entitled to free general and special exhibition admission by showing proof of employment at the ticket counter. Learn more about the Corporate Partner Program . Check the full list of Corporate Partner companies whose employees are entitled to free admission.   More Corporate Partner Opportunities   RESERVE ONLINE IN ADVANCE Illinois Residents Admission will be free for Illinois residents on weekdays (Mondays, Thursdays, and Fridays) January 9\u2013March 24, 2023. If you reserve your free tickets online in advance , your resident status will be verified using the zip code associated with the billing address provided. If you're unable to reserve tickets in advance, please stop by the admissions desks on the day of your visit for assistance. ",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.6"
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
        "total": 284,
        "limit": 2,
        "offset": 0,
        "total_pages": 142,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/press-releases?page=2&limit=2"
    },
    "data": [
        {
            "id": 56,
            "api_model": "press-releases",
            "api_link": "https://api.artic.edu/api/v1/press-releases/56",
            "title": "Press Releases from 1994",
            "web_url": "https://nocache.www.artic.edu/press/press-releases/56/press-releases-from-1994",
            "copy": " To obtain the full text of any news releases in this index, please contact the Institutional Archives at reference@artic.edu or (312) 443-4777.   January 1994 Monthly Calendar Graphic Tours: Travel and 19th Century: French Works on Paper, exhibition 235, 245-247 Edvard Munch and Alban Berg Exhibition 235, 248-250 Recent Acquisitions: 20th Century Works on Paper in the Department of Prints and Drawings, exhibition 235 New and continuing exhibitions, public programs, and lectures 235-240 Martin Luther King, Jr., program 240 January 4, 1994 Correction for African American History Month programs 241 January 6, 1994 Museum Studies (v. 19, no. 2), AIC periodical surveying museum acquisitions since 1980 selected by AIC Director and President James N. Wood with essays by editor of Publication Department Margherita Andreotti and Museum curators Ghenette Zelleke, David Travis, and James Ulak 242-244 January 24, 1994 Graphic Tours: Travel and 19th Century French Works on Paper, exhibition coordinated by curator of Prints and Drawings Martha Tedechi and research assistant Jay Clarke in collaboration with Northwestern University students granted by the Andrew W. Mellon Program in art objects and museum internship 245-247 ; Ed Paschke, department chairman at Northwestern University, Chicago 247 January 25, 1994 Violent Passions: Edvard Munch and Alban Berg, Lyric Opera of Chicago production in association with exhibition at AIC 235, 248-250 Museum shop, Valentine's Day gift ideas 251-254 ; the Hodge Collection of valentines in Prints and Drawings Department, facsimiles 251 ; first American valentine card, adaptation from the 1849 original 251 February 1994 Monthly Calendar With Open Eyes: Images from the Art Institute , AIC laser disc publication and interactive exhibition 255, 268-270 Exhibition of Daniel Libeskind and The Jewish Museum in Berlin 255 The Drawings of Joseph Beuys, exhibition 255, 261-267 Continuing exhibitions, public programs, and lectures 256-260 Chicago Symphony Chamber Music Series at AIC 257 February 4, 1994 Thinking is Form: the Drawings of Joseph Beuys 255, 261-267 ; exhibition venues 264 ; the artist's visit to Chicago and SAIC in 1974, 266-267 With Open Eyes: A Multimedia Exploration of Art , AIC electronic publication, demonstration and contents 255, 268-270 February 15, 1994 The Lila Wallace-Reader's Digest Fund, grant for African Arts collection; remarks by AIC Director and President James N. Wood 271-273 March 1994 Monthly Calendar Textile Acquisitions from 1988-1992, 274, 290-292, 380 Continuing exhibitions, public programs, and lectures 274-279 March 4, 1994 Retrospective exhibitions of Odilon Redon and Goya 280-283 March 14, 1994 Lessons from Life: Photographic Works from the Boardroom Collection of Martin Edelston, exhibition and gift of the collection; remarks by AIC Director and President James N. Wood 274, 284-286 March 16, 1994 Museum shop, Easter and Passover gift ideas 287-289 March 23, 1994 Selected Textile Acquisitions, 1988-1992, exhibition 274, 290-292 March 24, 1994 Dr. Charles Stuckey, Head of the Department of 20th Century Painting and Sculpture; Frances and Thomas Dittmer endowment for a curatorial chair as a part of AIC Board of Trustees capital campaign entitled The Second Century Fund: Securing Chicago's Masterpiece; remarks by AIC Director and President James N. Wood 293-294 April 1994 Monthly Calendar Reinstallation of Ancient Art Galleries in McKinlock Court; Robinson Glass Collection 295, 378 ; events 309 Continuing exhibitions, public programs, and lectures 296-301 April 4, 1994 Dr. Yutaka Mino, Head of Asian Art Department, resignation; comments by AIC Director and President James N. Wood 302-303 April 11, 1994 The Art of Horace Pippin, exhibition; Dr. Albert C. Barnes, collector 295, 304-308 ; exhibition venues 308 ; events 354-355 April 15, 1994 Kraft Education Center: Eric Beddows exhibition 301, 309-310 April 21, 1994 Spring book signing events at Museum shop featuring Judith Stein, Lynn H. Nicholas, Naomi Shihab Nye, Nancy Mathews, Eric Beddows, Annette Blaugrund, Meredith Etheringston-Smith, Eleni Fourtouni, Theodore E. Stebbins, Humphrey Wine 311-315 April 24, 1994 John James Audubon: The Watercolors for The Birds of America , exhibition from The New York Historical Society collection, venues and catalogue 316-320, 329 April 27, 1994 Museum shop, gift ideas for Mother's Day 321-324 April 28, 1994 The Actor's Image: Printmakers of the Katsukawa School , AIC publication by keeper of the Buckingham Print Collection Osamu Ueda 325-328 May 1994 Monthly Calendar Italian Sculpture, 1860-1925, from the Gilgore Collection, exhibition 329, 337-339 The Golden Age of Florentine Drawing: from Leonardo to Volterrano, exhibition 329-330, 341-343, 379 Continuing exhibitions, public programs, and lectures 330-336 May 9, 1994 Italian Sculpture, 1860-1925, from the Gilgore Collection 329, 337-340, 380 ; Sheldon and Irma Gilgore 337, 339 ; Chiseled with a Brush: Italian Sculpture, 1860-1925, from the Gilgore Collections , AIC publication by curator of European Decorative Arts Department Ian Wardropper 344-346 The Golden Age of Florentine Drawing: from Leonardo to Volterrano, exhibition 329-330, 340-343, 379 May 24, 1994 World Cup Soccer Games, Chicago Day, free museum admission 347-348 June 1994 Monthly Calendar Continuing exhibitions, public programs, and lectures 350-353 June 2, 1994 AIC and SAIC Summer Programs with Chicago Park District, Horace Pippin outdoor workshop 354-355 June 6, 1994 Museum shop, Father's Day gift ideas 356-360 Garden Restaurant, 14th season of Ray Bailey jazz quintet 361-362 June 8, 1994 Odilon Redon exhibition, installation and catalogue 372-375, 400 ; programs 368-372, 381 June 10, 1994 1994-1995 EXHIBITION SCHEDULE ( 376-389 ) Galleries of Ancient Art in McKinlok Court, reinstallation by Ian Wardropper and John Vinci 295, 309, 378 Knotted Splendor: European and Near Eastern Carpets from the Permanent Collection, exhibition 383, 413, 422-426, 446 Dieter Appelt, photography exhibition 385, 475-476, 479-480, 486 Gustave Caillebotte: The Urban Impressionist, exhibition 386 Louis Sullivan and the Prairie School, exhibition 386 Bruce Goff, exhibition of the artist's architectural archive and drawings from Architecture Department and AIC Ryerson and Burnham Libraries 387 June 20, 1994 Renzo Piano Building Workshop: Selected Projects, interactive exhibition, computer installation 382, 390-391 June 24, 1994 Goya: Truth and Fantasy, exhibition organized by Del Prado, Madrid and by Royal Academy of Arts, London, catalogue 382, 392-395 ; programs 396-399, 401, 408 July 1994 Monthly Calendar New and continuing exhibitions, public programs, and lectures 402-407 July 22, 1994 Celebrating America: A Collection of Poems and Images of American Spirit , children's book compiled by L. Whipple, AIC publication 409-410 July 26, 1994 Transforming Vision: Writers on Art , AIC publication 411-412, 435, 460 August 1994 Monthly Calendar New and continuing exhibitions, public programs, and lectures 413-417 August 2, 1994 Illustrations by Leovigildo Martinez and Leyla Torres, exhibition 418-420, 492 ; Martinez and Matthew Gollub, book signing event 419 Up and Down, All Around , AIC video release for children 421 August 4, 1994 Knotted Splendor: European and Near Eastern Carpets, exhibition 413, 422-426 ; curator of Textile Department Christa Thurman 426 ; carpet adaptations in Museum shop 427-428, 446 ; Textile Department, funding 428 September 1994 Monthly Calendar British Delft From Colonial Williamsburg, exhibition from collection of The Colonial Williamsburg Foundation, VA, 429 Continuing exhibitions, public, programs, and lectures 439-433 September 12, 1994 Museum shop, 1994-1995 Holiday Gift Catalogue 434-437 Museum Studies , AIC periodical (vol. 20, no. 2), special issue featuring Winterbotham Collection of European Paintings 438-439 September 14, 1994 Karl Friedrich Schinkel, 1781-1841: The Drama of Architecture 384, 440-443, 463,486, 489, 501-502 ; installation 442-443 ; Stanley Tigerman 463 ; curators Kurt Foster, John Zukowsky 442-443 ; Exhibition of Karl Schinkel's textile design, gift of Ruth Blumka in memory of John Maxon, comments by Christa Thurman 444-445 , 486 September 20, 1994 Museum shop, Fall trunk shows: Minasian rugs, Halcyon Days Enamels, Limoges, Antique jewelry, Noguchi lamps, Caithness paperweights, Maximal Jewelry, Recife pens; Twilight Shopping 446-449 September 22, 1994 Julia Perkins, appointed Assistant Director for Community Programs in the Museum Education Department; Lila Wallace-Reader's Digest Fund, Refocus/Resources Initiative for African-American community, funding 450-451 September 23, 1994 Architecture gallery, dedication in the name of Dr. Kisho Kurokawa (Japan); The Japan Foundation gallery endowment; lecture by the architect 452-454 September 28, 1994 Fall book signing events at the Museum shop featuring James Yood, Thomas Locker, Lois Ehlert and Sara Weeks, Victoria Lautman, Carlos Fuentes, Eleanor Dwight, Meryle Secrest 455-459 ; special event marking AIC publication of Transforming Vision: Writers on Art edited by Edward Hirsh; readings and book signing by Mark Strand, Reginald Gibbons, Jorie Graham, Li-Young Lee, Susan Mitchell, Gerald Stern, Gary Wills 460 (411-412, 435), 490 ; Festival of Children's Books 461 ; Bystander: A History of Street Photography , book by Joel Meyerowitz and AIC curator of Photography Colin Westerbeck 461, 503 September 29, 1994 Corporate Gift Program at the Museum shop 462a October 1994 Monthly Calendar Friedrich Schinkel, 1781-1841: The Drama of Architecture, installation by Stanley Tigerman 463 Continuing exhibitions, public programs, and lectures 463-471 October 7, 1994 Ryerson and Burnham Libraries, expansion and Reading Room restoration, comments by Director of AIC Libraries Jack Perry Brown; architectural firm of Shepley, Coolidge and Root; description of the 1901 original decor, Elmer E. Garnsey's design and Louis J. Millet's skylight; conversion of card catalogue into on-line computerized information system made possible by Rosenbaum Foundation, Rice Foundation, and Mellon Foundation; renovation of office and stack spaces, electronically operated storage system 472-474 October 18, 1994 Transforming Visions: Writers on Art , AIC publication edited by Edward Hirsch; evening of readings by Mark Strand, Reginald Gibbons, Jorie Graham, Li-Young Lee, Susan Mitchell, Gerald Stern, Gary Wills 460 (411-412, 435), 484-485, 490 October 19, 1994 Dieter Appelt Exhibition, events, seminar, SAIC Visiting Artists program, lecture by the artist 475-476 ; Dieter Appelt , AIC publication by curator of Photography Sylvia Wolf, first English-language monograph on the artist 479-480, 486 November 1994 Monthly Calendar Continuing exhibitions, public programs, and lectures 486-494 5th Annual Chicago Humanities Festival 488 November 4, 1994 \"Wreathing the Lions\" event at Museum's main entrance 477, 481-483 ; second annual Christmas exhibition Glad Tidings of Great Joy coordinated by AIC deputy director Teri J. Edelstein, programs and lectures; Glad Tidings of Great Joy , AIC publication of Gospels 481, 486, 495-496 November 8, 1994 American Arts Department, Henry Luce Foundation grant for major publication, fellowship, and research of the department holdings coordinated by Department curator Judith A. Barter 497-500 November 21, 1994 Lyric Opera of Chicago concerts in association with Karl Friederich Schinkel exhibition 501-502 December 1994 Monthly Calendar New and continuing exhibitions, public programs, and lectures 503-510 Bystander: A History of Street Photography, exhibition and publication by Joel Meyerowitz and Colin Westerbeck 503 December 8, 1994 Three photography exhibitions: Bystander: A History of Street Photography; Joel Meyerowitz; Andre Kertez 511-512 December 27, 1994 African American History Month, 1995 events and program schedule 513-517 ; Joseph A. Yoakum exhibition 513-514 ",
            ...
        },
        {
            "id": 54,
            "api_model": "press-releases",
            "api_link": "https://api.artic.edu/api/v1/press-releases/54",
            "title": "Press Releases from 1992",
            "web_url": "https://nocache.www.artic.edu/press/press-releases/54/press-releases-from-1992",
            "copy": " To obtain the full text of any news releases in this index, please contact the Institutional Archives at reference@artic.edu or (312) 443-4777.   January 8, 1992 The David C. and Sarajean Ruttenberg Collection, major gift to Photography Department; The Intuitive Eye, exhibition 161-162 January 10, 1992 African American History Month, programs 163-165 January 22, 1992 Museum shop, Valentine's Day gift ideas 166-168 January 23, 1992 Nils-Ole Lund: Collage Architecture, exhibition featuring images of Chicago and AIC, related publication 77, 169-170, 250 January 30, 1992 Mark Strand, poetry reading, hosted by Reginald Gibbons and sponsored by Lannan Foundation 171-172 January 1992 Monthly Calendar New and continuing exhibitions, public programs, and lectures. Kraft Education Center 173-178 Men in America: Photographs by Tom Arndt, exhibition 173 At the Edge of Shelter: Homelessness in Chicago, photography exhibition sponsored by Focus/Infinity Fund of Chicago; complementing exhibition titled Keepers of the Flame: Lewis Hine and Walter Rosenblum 173 Imaging the Body: From Fragment to Total Display, Permanent collection exhibition concurrent with show titled Metaphors of Biological Structure/Architectural Construction organized by AIC Ryerson and Burnham Libraries in conjunction with The University of Chicago Centennial Symposium 173-174 February 12, 1992 Master European Paintings from The National Gallery of Ireland: Mantegna to Goya, exhibition venues and catalogue; remarks by AIC Director and President James N. Wood 179-181, 251, 272-273 February 14, 1992 Museum Studies , AIC semiannual (v. 18, no. 1) cataloguing exhibition titled Five Centuries of Japanese Kimono; Noh drama costumes; James T. Ulak and Betty Siffert of Asian Art Department, et. al., 182-184 Five Centuries of Japanese Kimono: On This Sleeve of Fondest Dreams, exhibition; opening of renovated galleries of Chinese, Japanese, and Korean Art 77, 182-189, 212, 272 February 18, 1992 Galleries of Chinese, Japanese and Korean Art, renovation, announcement of the opening date; Chairman of The Board of Trustees Marshall Field; AIC Director and President James N. Wood; Curator of the Department of Asian Art Yutaka Mino; gallery arrangement, Japanese screens gallery designed by Tadao Ando; The Asian Study Center; Asian Art , AIC publication; the Government of Japan, Mitsubishi Bank, Mr. T. T. Tsui of Hong Kong, Rice Foundation, McCormick Foundation, and Susanne and Richard Barancik, funding; the Asahi Shimbun endowment for The Asian Study Center; Mr. Masao Kato, acquisition fund 190-194, 272, 276 February 1992 Monthly Calendar Continuing exhibitions, public programs, and lectures. Kraft Education Center 197-200 March 24, 1992 Patrick Tosani: Photographer, exhibition organized by curator of Photography Sylvia Wolf in collaboration with Association Francaise d'Action Artistique, Ministere des Affaires Entrageres, venues and catalogue 201-202, 251, 274 March 25, 1992 Museum shop, Easter and Passover holiday gifts, Chagall's American Windows , adaptation from stained glass panel; gifts inspired by Beatrix Potter's Tales of Peter Rabbit ; Alice in Wonderland , set of playing cards from AIC Prints and Drawings collection, adaptation 203-206 March 26, 1992 Kraft Education Center, grant from Chicago Community Trust's Special Projects Initiative in support of interactive exhibition titled Art Inside Out; AIC Director and President James N. Wood; Executive Director of Chicago Community Trust Bruce L. Newman; Dr. Scholl Foundation 207-208, 257, 266-267 Li-Young Lee and Jonathan Spence, evening of reading and conversation sponsored by The Lannan Foundation 209-210 March 30, 1992 Homer's The Odyssey , performance by Odds Bodkin, storyteller 211 March 1992 Monthly Calendar Continuing exhibitions, public programs, and lectures. Kraft Education Center 212-218 April 20, 1992 Museum shop, Mother's Day gift ideas, jigsaw puzzles featuring paintings from Museum's collection; AIC publications European Decorative Arts and Glass Paperweights (the Arthur Rubloff Collection); calligrapher service 219-223 April 27, 1992 Jacob Lawrence: The Frederick Douglass and Harriet Tubman Series of Narrative Paintings, Hampton University Museum, VA, exhibition venues and catalogue 224-225, 251, 275 April 1992 Monthly Calendar Continuing exhibitions, public programs, and lectures. Kraft Education Center 229-233 May 13, 1992 Luis Gonzalez Palma, Lucas Samaras, Witnesses of Time: Photographs by Flor Garduno, contemporary photography exhibitions organized by The Center for Creative Photography, Tucson, AZ, and sponsored by AIC Auxiliary Board as a part of Columbus' quincentennial celebration; complementary show for major exhibition The Ancient Americas: Art from Sacred Landscapes 77, 234-235, 250, 253, 255 May 20, 1992 Museum shop, wedding gift ideas, Asian Art collection, adaptations; Blenko Glass; Eickholdt Glass Studio 236-240 May 1992 Monthly Calendar New and continuing exhibitions, public programs, and lectures. Kraft Education Center 75-81 Patrick Tosani: Photographer, French Culture Month, exhibition organized in collaboration with Association Francaise d'Action Artistique and Ministere des Affaires Artistique, exhibition venues and catalogue 75, 201-202, 251, 274 From America's Studios: Twelve Contemporary Masters, exhibition of distinguished SAIC alumni organized by curator of 20th Century Art at AIC Neal Benezra (appointed chief curator at The Hirshhorn Museum, Washington, D.C.) 75, 227; 273 ; correction for the exhibition dates 226 Architecture in Miniature: Furniture Designed by Josef Hoffman, exhibition, the Vienna Secession; included textiles by Hoffman and Carl Czeschka 76, 253 English Silver: Masterpieces by Omar Ramsden from the Vivian and David M. Campbell Collection (Toronto, Canada), exhibition organized by David A. Hanks & Associates, N.Y., and Smithsonian Institution (SITES); AIC showing coordinated by curator of European Decorative Arts Department Lynn Springer Roberts 76, 252-253 Various Subjects Drawn from Life and on Stone: A Series of Lithographs by Theodore Gericault, exhibition; Chicago Gericault Album 76 Metaphors of Biological Structure/Architectural Construction, Ryerson and Burnham Libraries exhibition as a part of the University of Chicago symposium 76, 173-174 Art and Craft: British Prints from the Permanent Collection, exhibition 77 Five Centuries of Japanese Kimono: On this Sleeve of Fondest Dreams, exhibition of Noh drama costumes and design books from Ryerson and Burnham Libraries 77, 182-189, 212 Nils-Ole Lund: Collage Architecture, exhibition featiring images of Chicago and the Art Institute; The Architecture Society, Mr. and Mrs. Hilliard, Seymour H. Persky Fund for Architecture, project funding 77, 169-170, 250 Luis Gonzalez Palma, exhibition 77, 234-235, 250 Lucas Samaras, photography exhibition, donation of the artist's works by Robert and Gayle Greenhill (CT) 77, 234-235, 253 June 1, 1992 Museum's Garden Restaurant named one of the top of ten outdoor restaurants by Travel & Leisure magazine; After Hours Jazz program, Ray Bailey Quintet 241-242 Evenings Around Sculpture Court, special program in Roger McCormick Memorial Sculpture Court 243 June 4, 1992 Museum shop, Father's Day gift ideas 244-247 June 20, 1992 1992-1994 EXHIBITION SCHEDULE ( 248-265 ) Greek Islands Embroidered Textiles, exhibition, the Burton Yost Berry Collection 254 A Year for Giving, exhibition series on American printmaking: American Prints 1900-1945, Part I, the Ashcan School, the Harlem Renaissance; American Wood Prints; American Modernist Prints Before 1960, 254 Reflections of Weimar Germany: Portfolios by Beckmann and Corinth, exhibition, acquisition of two sets of lithographs in Prints and Drawings Department 255 Joel Sternfield, exhibition from American Prospects series, promised gift 255 European Architecture and Interiors 1890-1940: Portfolios from Ryerson and Burnham Libraries, exhibition 256, 311 Sitting Pretty: Photographs by Debora Hunter and Sue Packer, exhibition 256 Henri Rousseau's The Dream (1910), The Museum of Modern Art, N.Y.; Henri Matisse's Bathers by the River (1916), AIC; paintings on loan, museum exchange 256, 318 Transitions in Form: Modernism and Songye Stool (working title), exhibition, acquisition in the Department of Africa, Oceania, and the Americas 257 Pre-Columbian Codices in Facsimile from the Ryerson and Burnham Libraries' Collections, complementary show for major exhibition The Ancient Americas: Art from Sacred Landscapes 257, 339 The Ancient Americas: Art from Sacred Landscapes, AIC traveling exhibition, organized by curator of the Department of Africa, Oceania, and the Americas Richard Townsend; exhibition venues and catalogue 258, 339-340 Photographs by Rose Mandel, exhibition; the Mandel Collection; Lucia Woods Lindley and Daniel A. Lindley, Jr., acquisition funding 259, 340 Building in New Spain: Contemporary Spanish Architecture, traveling exhibition organized by AIC and The Ministry of Public Works and Transportation Gallery in Madrid, Spain 259, 340 News from a Radiant Future: Soviet Propaganda Porcelain from the Craig and Kay Tuber Collection (Chicago), exhibition 260, 340 What's New: Prague, exhibition, second of What's New series 260 Mexican, Central, and South American Textiles: A Living Legacy, show in conjunction with exhibition The Ancient Americas: Art from Sacred Landscapes 260, 341 Max Klinger's A Glove (working title), exhibition, the German Symbolist Movement 261 Marc Chagall: The Moscow Jewish Theater Murals from The State Tretiakov Gallery, Moscow, exhibition 261, 360-362 Magritte, traveling exhibition organized by Hayward Gallery, London, catalogue 261-262 The Moscow Avant-Garde Architecture: 1955-1991, exhibition, guest curator Eugene Asse 262 Constructing the Fair: Platinum Photographs of the World's Columbian Exposition by C. D. Arnold, exhibition from AIC Ryerson and Burnham Libraries holdings, catalogue 262 Thonet Furniture from the Collection of Mr. and Mrs. Manfred Steinfeld, exhibition including textiles from Permanent collection, catalogue 263 Chicago Architecture and Design, 1923-1933: Reconfiguration of an American Metropolis, exhibition, sequel to the 1987-1988 AIC exhibition titled Birth of a Metropolis; installation by Stanley Tigerman, et. al.; curator John Zukowsky, monograph publication 263 Gates of Mystery: The Art of Holy Russia from The State Russian Museum, St. Petersburg, exhibition of religious icons, medieval textiles, manuscripts, and other objects produced in The Armory of Moscow Kremlin; catalogue 264 Max Ernst: Dada and the Dawn of Surrealism, exhibition catalogue and venues 264-265 Thinking is Form: The Drawings of Joseph Beuys, exhibition organized by Philadelphia Museum of Art and The Museum of Modern Art, N. Y., 265 June 20, 1992 The Samuel R. and Marie Louise Rosenthal Gallery, Collection of Honore Daumier bronzes, promised gift 266 Kraft General Foods Education Center, renovation project, opening dates 266-267 June 23, 1992 Arts and Crafts in Vienna: Furniture Designed by Josef Hoffman, exhibition, the Vienna Secession; included textiles by Hoffman and Carl Czeschka 76, 253, 268 English Silver: Masterpieces by Omar Ramsden from the Vivian and David M. Campbell Collection (Toronto, Canada), exhibition organized by David A. Hanks & Associates, N.Y., and Smithsonian Institution (SITES), curator of European Decorative Arts Department Lynn Springer Roberts 76, 252-253, 268-269 June 29, 1992 American Prints 1900-1960: Recent Gifts to the Permanent Collection, exhibition series featuring the Ashcan School, the American Scene, the Harlem Renaissance, the Work Progress Administration (WPA), et. al.: American Prints Before World War II, American Wood Prints, American Modernist Prints; catalogue published by AIC Department of Prints and Drawings 254, 270-271, 291, 314, 321 June 1992 Monthly Calendar New and continuing exhibitions, public programs, and lectures. Kraft Education Center 272-279 Galleries of Chinese, Japanese, and Korean Art, renovation and reinstallation, announcement of opening; Department of Museum Education, programs celebrating Asian culture; benefactors 190-194, 272 Master European Paintings from The National Gallery of Ireland: Mantegna to Goya, exhibition organized in cooperation with AIC, exhibition venues and catalogue; remarks by AIC Director and President James N. Wood 179-181, 251, 272-273 From America's Studios: Twelve Contemporary Masters, exhibition of distinguished SAIC alumni, curator of 20th Century Art at AIC Neal Benezra, (at the time appointed as Chief Curator in The Hirshhorn Museum, Washington, D.C.) 75, 227, 273 ; correction for exhibition dates 226 ; From America's Studio: Drawing New Conclusion, SAIC complementary show 273 July 17, 1992 Joel Sternfeld, exhibition from American Prospects series; AIC color photography archiving and conservation project 255, 280, 342 July 29, 1992 Museum shop, variety of Chicago travel books, maps and videos; The Sky's The Limit , edited by curator of Architecture Pauline A. Saliga with essays by curator of Architecture Department John Zukowsky and associate director of Museum Education Department Jane H. Clarke; Chicago Architecture 1872-1922 , edited by John Zukowsky; AIC periodical Museum Studies (v. 14, no. 1) featuring the history of Museum's architectural structure 281-285 July 1992 Monthly calendar New and continuing exhibitions, public programs, and lectures. Kraft Education Center 291-298 August 10, 1992 Special AIC publications: Textiles by curator of Textiles Department Christa C. M. Thurman; Asian Art by curator of Chinese Art Elinor Pearlstein, curator of Japanese Art James T. Ulak, and Deborah Del Gais Miller, with introduction by curator of Asian Art Department Dr. Yutaka Mino; Feasting: A Celebration of Food in Art by SAIC professor James Yood; The Ancient Americas: Art of Sacred Landscapes , exhibition catalogue edited by curator of the Department of Africa, Oceania, and the Americas Richard F. Townsend; Building in a New Spain: Contemporary Spanish Architecture , exhibition catalogue edited by curator of Architecture Pauline Saliga; News from a Radiant Future: Soviet Propaganda Porcelain from Craig H. and Kay A. Tuber Collection , exhibition catalogue by curator of European Decorative Arts Ian Wardropper, et. al., 299-303 August 19, 1992 Ilya Sandra Perlingieri, professor at San Diego State University, CA, lecture on Renaissance woman artist Sofonisba Anguissola 304-305 August 21, 1992 Museum shop, offerings in conjunction with exhibition The Ancient Americas; exhibition catalogue and monograph titled The Aztecs by Richard Townsend, textiles, jewelry by Don Lucas and Luis Cue, Huichol Indians' masks, Michoacan boxes 306-310 August 1992 Monthly Calendar New and continuing exhibitions, public programs, and lectures. Kraft Education Center 311-317 Kraft General Foods Education Center, renovation project, announcement of opening; benefactors; inaugural exhibition titled Art Inside Out; Illustrations by Tomie dePaola, exhibition 266-267, 318, 324 September 1992 Monthly Calendar New and continuing exhibitions, public programs, and lectures. Kraft Education Center 318-326 October 1, 1992 Museum shop, bronze bookends newly designed by SAIC faculty member Roy Tijerina depicting Edward Kemeys' Lions (1893), sculptures located at Museum's main entrance; Centennial of AIC architectural structure 327 October 15, 1992 News from a Radiant Future: Soviet Propaganda Porcelain from the Craig and Kay Tuber Collection (Chicago), exhibition, curator of European Decorative Arts Ian Wardropper 260; 332-335, 341; catalogue 302-303 \"Skrebneski on Skrebneski\", program sponsored by The Community Associates of AIC; discussion and film screening featuring photographer Victor Screbneski; SAIC alumnus 336 October 22, 1992 Gary Snyder poetry reading, hosted by Edward Hirsch 337-338 October 1992 Monthly Calendar New and continuing exhibitions, public programs, and lectures. Kraft Education Center 339-348 November 9, 1992 Christa Mayer Thurman, Head of the Department of Textiles, 25 years of work in the Department; $1 million anonymous endowment for curatorial chair named after Mrs. Thurman; comments by AIC Director and President James N. Wood and Chairman of The Board of Trustees Marshall Field; dinner hosted by Chief Executive Officer of Sara Lee Corporation and Chairman of The Committee on Textiles in AIC John H. Bryan; contribution to Textiles acquisition fund from 155 donors 349-351 November 1992 Monthly Calendar New and continuing exhibitions, public programs, and lectures. Kraft Education Center 352-359 December 7, 1992 Marc Chagall: The Jewish Theatre Murals from The State Tretiakov Gallery, Moscow, exhibition organized by Solomon R. Guggenheim Foundation in cooperation with Chagall Biblical Message Museum, et. al; group tours and hotel packages 261, 360-362 December 14, 1992 Inigo Manglano-Ovalle, appointed Hispanic Studies Coordinator in the Teacher Services Division of the Department of Museum Education, SAIC faculty member 363-366 December 1992 Monthly Calendar Continuing exhibitions, public programs, and lectures. Kraft Education Center 367-374 ",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.6"
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
        "total": 284,
        "limit": 10,
        "offset": 0,
        "total_pages": 29,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "press-releases",
            "api_link": "https://api.artic.edu/api/v1/press-releases/287",
            "id": 287,
            "title": "Malangatana: Mozambique Modern",
            "timestamp": "2022-12-13T23:31:43-06:00"
        },
        {
            "_score": 1,
            "api_model": "press-releases",
            "api_link": "https://api.artic.edu/api/v1/press-releases/288",
            "id": 288,
            "title": "Fabricating Fashion: Textiles for Dress, 1700-1850",
            "timestamp": "2022-12-13T23:31:43-06:00"
        },
        {
            "_score": 1,
            "api_model": "press-releases",
            "api_link": "https://api.artic.edu/api/v1/press-releases/289",
            "id": 289,
            "title": "Art Institute of Chicago Welcomes Lisa Ayla \u00c7akmak as the Chair of Arts of the Ancient Mediterranean and Byzantium Department",
            "timestamp": "2022-12-13T23:31:43-06:00"
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
        "web_url": "https://nocache.www.artic.edu/press/press-releases/1/press-releases-from-1939",
        "copy": " To obtain the full text of any news releases in this index, please contact the Archives at reference@artic.edu or (312) 443-4777.   January 6, 1939 Scammon Lecture, The Spirit of Modern Building , given by Dr. Walter Curt Behrendt, Technical Director of Buffalo City Planing Association, N.Y., 1 January 7, 1939 Turkish and Italian Textiles in Paintings , lecture, given by Alan J. B. Wace, Keeper of Textiles in the Victoria and Albert Museum and professor of Classical Archaeology, Cambridge, England; members of Chicago Needlework and Textile Guild, listed 2 January 20, 1939 Lecture series, given by Dr. Maurice Gnesin, Director of Goodman Theatre and Head of AIC Goodman School of Drama 3 January 11, 1939 Comments on exhibitions: The French Romanticists Gros, Gericault, and Delacroix; Exhibition of Bonnard and Villard, Contemporary French Artists; Christmas Story in Art; George Grosz, His Art from 1918 to 1938; Architecture by Ludwig Mies Van Der Rohe; 34 Old Master Drawings, Lent by Sir Robert Witt of London; gallery tour for the Second Conference of Chicago Art Clubs 4-5 January 13, 1939 AIC major exhibitions of 1938, attendance record from Museum Registrar's Department 6 January 14, 1939 Scammon Lecture, Turner's Romantic Vision of Switzerland , given by Dr. Paul Ganz, Professor at University of Basle, Switzerland, biography note and publications 8 January 18, 1939 28th Annual Governing Members' Meeting, hosted by AIC President Mr. Potter Palmer; luncheon, list of participants 7 January 19, 1939 Kate S. Buckingham Memorial Lecture, Chinese Bronzes , given by AIC Assistant Director and Curator of Oriental Art Department Charles Fabens Kelley 9 January 21, 1939 The National Exhibition of Representative Buildings of the Post War Period, exhibition, organized and curated by American Institute of Architecture (AIA) 12 January 23, 1939 Annual Report for 1938, issued by Director of Fine Arts Daniel C. Rich and Director of Finance and Operation Charles H. Burkholder; major gifts and donations; Robert Allerton, gift for construction of the Decorative Arts Galleries; Mrs. Erna Sawyer Goodman, money gift, establishing William Owen Goodman Fund; attendance, membership, SAIC enrollment; major bequest of Ms. Kate Buckingham; Mrs. William O. Goodman Collection of pewter, gift to AIC; Superintendent's report on condition of skylight roof; Bartlett Lecture Series; funding for lectures and publications 10-11 Pablo Picasso: Forty Years of His Art, exhibition announcement, first collaborative project of AIC and The Museum of Modern Art, N.Y., 13, 102 January 25, 1939 43rd Annual Exhibition by Artists of Chicago and Vicinity, jury comprised of Donald Bear of Denver Art Museum, Clarence Carter of Carnegie Institute, Pittsburgh, and artists Mahonri H. Young of New York and Albin Polasek of Chicago; list of prizes 14, 19-20, 23, 25 January 26, 1939 Kate S. Buckingham Memorial Lecture, Chinese Terra Cotta Tiles , given by AIC Assistant Director and Curator of Oriental Art Department Charles Fabens Kelley 15 January 30, 1939 A Leading School of Buddhist Sculpture , lecture given by Dr. Osvald Siren of National Museum in Stockholm; biography note and comments on his collection and publications 16 SAIC 6th Annual Open House for alumni, governing members, trustees, friends of the School and officials; Glee Club concert under direction of AIC Assistant Director and Curator of Oriental Art Charles Kelley 17 January 31, 1939 Chicago High School Scholarship contest at SAIC; list of winners, Judith Pesman, Suzanne Siporin, Emil Grego, Joanne Kuper, and Joseph Strickland 18 Exhibition of Contemporary American Art at New York World's Fair 1939; proceedings and requirements; Chicago juries of New York World's Fair, represented by Aaron Bohrod, Ralph Clarkson, Mitchell Siporin, Daniel C. Rich (chairman of the Painting Jury), Sidney Loeb, Peterpaul Ott, Albin Polasek, George Thorp, Todros Geller, James Swann, Morris Topchevsky, Beatrice Levy, Charles Wilimovsky, and Lillian Combs 19-20 February 2, 1939 Kate S. Buckingham Memorial Lecture, Chinese Sculpture and Painting , given by AIC Assistant Director and Curator of Oriental Art Department Charles Fabens Kelley 21 February 4, 1939 Scammon Lecture, Six Dynasties and Early T'ang Painting , given by Laurence Sickman, curator of Oriental Art at William Rockhill Nelson Gallery of Art, Kansas City, MO; biography note 22 February 6, 1939 43rd Annual Exhibition by Artists of Chicago and Vicinity, opening, Artists' Dinner, hosted by AIC Director of Finance and Operation Charles H. Burkholder; guest speaker George Buehr, other guests included Mr. and Mrs. Potter Palmer, Mr. Paul Schulze, Mr. and Mrs. Charles Fabens Kelley, Mrs. Albion Headburg, and Ms. Eleanor Jewett 14, 19-20, 23, 25 February 13, 1939 The Making of a Cartoon , lecture and film demonstration, conducted by cartoonist of the Chicago Daily News Vaughn R. Shoemaker, complementing exhibition titled Original American Cartoons from Charles L. Howard Collection 24 February 14, 1939 AIC Exhibition Calendar for 1939 In the Department of Painting and Sculpture, curator Daniel Catton Rich, AIC Director: Chicago and Vicinity 43rd Annual Exhibition; Masterpiece of the Month: Portrait of Mrs. Wolff by Sir Thomas Lawrence; 18th International Exhibition of Watercolors; Annual Exhibition by Students of SAIC; 50th Annual Exhibition of American Painting and Sculpture: Half a Century of American Art 25 In the Children's Museum, curator Helen Mackenzie: The Making of a Masterpiece, exhibition, featuring altarpiece by Giovanni di Paolo of Sienna; Means and Methods of Water Color Painting 25 In the Blackstone Hall: Original American Cartoons from the Collection of Charles L. Howard of Chicago 26 In the Oriental Art Department, Curator Charles Fabens Kelley: two exhibitions from AIC Clarence Buckingham Collection of Japanese Prints, titled In Wind and Rain, and Blossom Viewing; Masterpiece of the Month: Imperial Jade Cup on Stand, 18th C., gift of Russell Tyson 26 In Prints Department, Acting Curator Lillian Combs: Selections from Lenora Hall Gurley Memorial Collection of Drawings; Recent Accessions in Prints, 1937-1939; Woodcuts from Books of the 15th Century; Masterpiece of the Month: The Lamentation from the Great Passion by Albrecht Durer; Prints by Old Masters from Clarence Buckingham Collection; The Bulls of Bordeaux by Francesco Goya; Sports in Prints 26 In the Decorative Arts Department, Curator Bessie Bennett: French Furniture and Sculpture, 18th C. from Henry Dangler Collection; Florence Dibell Bartlett Collection of Bonader from Sweden, 18th and 19th C.; English Architecture of 18th C.; Embroideries from The Greek Islands Lent by Elizabeth Day McCormick; Ecclesiastical Embroideries; English Embroideries; Exhibition of Embroideries by the Needlework and Textile Guild 27 General Information about Permanent collection and admission 27 February 15, 1939 Florence Dibell Bartlett Lecture, Adventures in the Arts , given by Helen Parker, Head of AIC Education Department 28 February 20, 1939 Antiquarian Society, Tea Party, honoring Elizabeth Day McCormick and exhibition of Embroideries from the Greek Islands; party specialties and participants 29, 59, 61 February 21, 1939 George Washington's Birthday, free Museum admission; Washington's portraits in AIC Permanent collection 30 February 25, 1939 Scammon Lecture, The Fountains of Florence , given by Bertha Wiles, Curator of Mark Epstein Library at University of Chicago 31 February 28, 1939 Scammon Lecture, The Artistic Relations of England and Italy , given by William George Constable of Boston Museum of Fine Arts; biography note, Mr. Constable, founder of the Courtauld Institute in London 33 March 2, 1939 New Light on Prehistoric Man , lecture and film demonstration, presented by Dr. Henry Field, and sponsored by Chicago Chapter of Archaeological Institute of America 32 Kate S. Buckingham Lecture, The Gothic Room , given by Bessie Bennett, AIC Curator of Decorative Arts 34 March 8, 1939 Goodman Theatre, performance of Alice in Wonderland for children from settlement houses and orphanages; list of participating institutions 36 March 9, 1939 Kate S. Buckingham Lecture, Prints by Old Masters, Including Rembrandt , given by Edith R. Abbot, artist and educator of The Metropolitan Museum, N.Y., biography note about Ms. Abbot 37 March 15, 1939 Frederick Arnold Sweet, appointed Assistant Curator of AIC Painting and Sculpture Department; Mr. Sweet's resume 38 March 17, 1939 Kate S. Buckingham Lectures, Master Etchers of the 19th Century , given by Head of Education Department Helen Parker; The English Lustre Ware Collection, given by AIC Director Daniel C. Rich 39 March 20, 1939 Opening reception for 18th International Water Color Show, works on view, including loans from Edward Hopper, John Whorf, and Henri Matisse 35 March 23, 1939 18th Annual International Water Color Exhibition; prizes and works on view; jury comprised of Grant Wood, Joseph W. Jicha of Cleveland, and Hubert Ropp of Chicago; concurrent exhibition in the AIC Children's Museum, explaining water color technique; biography notes about prize-winners, Everett Shinn and Dale Nichols 35, 40-42, 5I-52, 64 March 24, 1939 Kate S. Buckingham Lecture, The English Lustre Ware Collection , given by AIC Director Daniel C. Rich 43 March 28, 1939 AIC Curator of Decorative Arts Department Bessie Bennett (1870-1939), obituary; Ms. Bennet's AIC tenure, biography note, remarks by AIC President Mr. Potter Palmer 44-45 April 3, 1939 Easter Festivities at AIC, Monsalvat , performance by Dudley Crafts Watson; SAIC Glee Club concert under direction of Charles Fabens Kelley, sponsored in part by Mrs. James Ward Thorne 46 April 6, 1939 Albin Polasek, Head of Sculpture Department at SAIC, honored with award of merit by the National Institute of Immigrant Welfare, N.Y.; biography note and chronology 47-48 April 11, 1939 Glee Club, Eastern concert program 46, 49 50th Annual Exhibition of American Painting and Sculpture: Half a Century of American Art, retrospective, showing works from American Annual exhibitions held at AIC from 1888 to 1938; comments on the exhibition selection by AIC Director Daniel C. Rich 25, 50 3rd Conference of Art Chairmen; AIC Assistant Curator of Painting and Sculpture Frederick A. Sweet, speaking on 18th International Water Color Exhibition, comments and criticism 40-42, 51-52, 64 April 13, 1939 Kate S. Buckingham Lecture, The Early Development of Chinese Pottery , given by AIC Assistant Director and Curator of Oriental Art Department Charles Fabens Kelley 53 April 17, 1939 SAIC group exhibition at Paul Theobald's Gallery in Chicago, showing abstractionist paintings done in the class of Willard G. Smythe 54 April 20, 1939 Kate S. Buckingham Lecture, The Great Period of Pottery and the Beginnings of Porcelain , given by AIC Assistant Director and Curator of Oriental Art Department Charles Fabens Kelley; attendance record of the Lecture Series 55 April 25, 1939 Europe, Asia, Africa: A Common Civilization , lecture, given by Melville J. Herskovits of Northwestern University, Evanston, IL, 56 Art Quiz, booklet by Head of Education Department Helen Parker, published in support for AIC Museum programs 57 April 27, 1939 Kate S. Buckingham Lecture, The Great Porcelains of the Ming and Ch'ing Dynasties, given by AIC Assistant Director and Curator of Oriental Art Department Charles Fabens Kelley 58 May 2, 1939 Antiquarian Society, Tea Party, featuring speech by AIC Director Daniel C. Rich, titled Decorative Arts in the Museum of Tomorrow ; members of the Society, listed 59 May 5, 1939 Goodman Theatre dance series, featuring Spanish dancer Clarita Martin, Ms. Martin's remarks 60 May 6, 1939 Antiquarian Society, Spring Meeting; Tea Party marking the Exhibition of Embroideries from Greek Islands in Elizabeth Day McCormick Collection; special gallery arrangements provided by Mrs. Walter S. Brewster, Mrs. Charles S. Dewey, Mrs. James Ward Thorne, Mrs. C. Morse Ely, and Mrs. Chauncey McCormick 29, 59, 61-62 May 9, 1939 Antiquarian Society Tea Party, decorative floral display available for public viewing 62 May 12, 1939 5th Annual Exhibition by Student Janitors of SAIC, participants and Fellowship awards 63 May 12, 1939 18th International Water Color Exhibition, attendance record; list of works sold from the show 35, 40-42, 51-52, 64 May 13, 1939 Annual Exhibition of the Needlework and Textile Guild of AIC, opening; works on view and participants 65-66 May 22, 1939 Foreign Travelling Fellowships, awarded to SAIC Student Janitors by AIC Officials and members of SAIC Faculty; award recipients Murray Jones, Edward Voska, biography notes 67 May 23, 1939 SAIC Glee Club concert, program and performers 68 May 26, 1939 Free Museum admission on Memorial Day; special exhibitions: Glass Paperweights from Mrs. John H. Bergstrom Collection; Japanese Surimono Prints, lent by Ms. Helen C. Gunsaulus; Chinese Jades from Mrs. Edward Sonnenschein Collection; Ms. Elizabeth Day McCormick Collection of Embroideries 69 June 2, 1939 Room of Recent Accessions, opening; new gallery, designated for exhibitions in The Masterpiece of the Month Series, and displaying new additions to Permanent collection; works shown at the opening; comments by AIC Director Daniel C. Rich 70-71 June 6, 1939 Art Students League of SAIC, prizes given to the League members; awards made possible through the gift of Mrs. William O. Goodman 72 June 8, 1939 Free Summer Lectures, French and German Primitives by Gibson Danes of Northwestern University, Evanston, IL; Paintings of the High Renaissance in Italy by SAIC instructor Briggs Dyer; Dutch and Flemish Old Masters by AIC Assistant Curator of Painting Frederick A. Sweet 73 June 9, 1939 SAIC Annual Commencement Exercises, graduation announcement at Goodman Memorial Theatre, conducted by AIC Vice President Mr. Chauncey McCormick; Invocation and Benediction pronounced by Minister of New England Church, Rev. Theodore Hume; student prizes, AIC Glee Club performance; guest list 74 June 10, 1939 AIC Director Daniel Catton Rich, named Chairman of Jury at San Francisco Golden Gate International Exposition 75 June 13, 1939 AIC Exhibition Calendar for 1939 Summer Exhibitions In the Department of Painting and Sculpture, curator AIC Director Daniel Catton Rich: Annual Exhibition of Works by SAIC Students; Costumes and Folk Art from Central Europe from Florence Dibell Bartlett Collection; Whistleriana, the artist's memorabilia from Walter Brewster Collection; Water Color Drawings by Thomas Rowlandson; Paintings by Lester O. Schwartz; Memorial Exhibition of Paintings by Pauline Palmer; Memorial Exhibition of Paintings by Carl Rudolf Krafft; Chinese Porcelains from the Goodman, Crane, Patterson, and Salisbury Collections; Lithographs by Odilon Redon; 50th Annual Exhibition of American Painting and Sculpture: Half a Century of American Art 76-77, 83 In the Children's Museum, curator Helen Mackenzie: Exhibition of Work by Children in the Saturday Classes of SAIC 77 From exhibition series The Making of the Masterpiece, showing At the Moulin Rouge by Toulouse-Lautrec 77 The Masterpiece of the Month, exhibition series introduced 77-78 In the Oriental Art Department, curator Charles Fabens Kelley: Chinese Jades from the Collection of Mr. and Mrs. Edward Sonnenschein; Japanese Surimono, lent by Ms. Helen C. Gunsaulus; Pottery of the Ming Dynasty 78, 83 In the Department of Prints and Drawing, Acting Curator Lilian Combs: Prints by Old Masters from Clarence Buckingham Collection; Sports in Prints; Sporting Prints and Drawings from the Collection of Mr. Joel Spitz of Chicago; Half a Century of American Prints; The Lenora Hall Curley Memorial Collection of Drawings; British Landscape Prints by Seymour Haden and David Young Cameron; Portraiture in Prints from Clarence Buckingham Collection; 7th International Exhibition of Lithography and Wood Engraving 78-79, 83 In the Decorative Arts Department: Exhibition of Paperweights from the Collection of Mrs. John N. Bergstrom; French Furniture from Henry C. Dangler Collection; Bonader from Sweden, Florence Dibell Bartlett Collection; English Architecture of the 18th C.; Exhibition of Embroideries from the Greek Islands, English and Ecclesiastical Embroideries from the Collection of Elizabeth Day McCormick 79, 83 Various announcements: invitation for train passengers to visit AIC on the way to the World's Fair in New York and San Francisco Golden Gate Exposition; attendance, lectures, Museum hours and orientation 79-80 June 13, 1939 General Education Board of Rockefeller Foundation, grant for three year project on art education in Chicago High Schools, conducted under supervision of Head of AIC Education Department Helen Parker 81 July 14, 1939 Chinese Art , free lecture series given by AIC Assistant Director and Curator of Oriental Art Charles Fabens Kelley; weekend gallery talks 82 July 18, 1939 Notes on Summer Exhibitions 83 July 22, 1939 Lectures and Gallery tours, given by AIC Assistant Curator for Painting and Sculpture Frederick A. Sweet, Gibson Danes of Northwestern University, Evanston, IL, and Briggs Dyer of SAIC 84 Weekly News Letter (Walter J. Sherwood, ed.); Nine Summer Exhibitions: Costumes and Folk Art from Eastern Europe lent by Florence D. Bartlett; Paintings by Carl Rudolf Krafft, School of the Ozark Painters; Pauline Palmer's paintings, works on view; Exhibition of Lester O. Schwartz, SAIC alumnus; Exhibition of Whistleriana from the collection of Walter S. Brewster, works on view; Water Colors by Thomas Rowlandson; Chinese Porcelains and Jades from Chicago Collections; Lithographs by Odilon Redon, from Martin A. Ryerson Collection; renovation of Permanent collection display; El Greco, lecture by assistant curator of Painting and Sculpture Frederick A. Sweet; note on the death of the mural painter Alphonse Mucha and the 1908 lecture series, titled Harmony in Art , given by the artist in AIC 137-138 July 25, 1939 Invitation to free music concert in Blackstone Hall, organist Max Allen, pianist Eleanor Gullett 85 July 29, 1939 Weekly News Letter (Walter J. Sherwood, ed.); The Masterpiece of the Month, exhibition series, Rembrandt's etching, titled Christ Preaching on display; paintings by winners of AIC Annuals Peter Hurd, Millard Sheets, Esther Williams, Nicolai Ziroli, John Whorf, William Zorach, and Georges Schreiber, acquired by The Metropolitan Museum in New York; free gallery lecture series, given by Briggs Dyer of SAIC and Gibson Danes of Northwestern University, Evanston, IL; gallery tours by Addis Osborne, SAIC alumnus; AIC catalogue of Summer exhibitions 139-141 August 1, 1939 Lectures and gallery talks, given by Briggs Dyer of SAIC, and Addis Osborne, SAIC alumnus 86-88, 90 August 5, 1939 Weekly News Letter (Lester Bridaham, ed.); Kenneth Goodman Memorial Theatre, improvements and additions; Decorative Arts Department Galleries in the Allerton Wing, construction, made possible by Vice-President and Chairman of the Committee of Decorative Arts, Mr. Robert Allerton; Wendell Stevenson, SAIC alumnus, commission of portraiture; SAIC Summer classes extended; Summer School at Saugatuck, MI, classes of Charles Willimovsky, SAIC Director Frederick Fursman, and Don Loving; 50th Annual Exhibition of American Painting and Sculpture: Half a Century of American Art, exhibition announcement; excepts from Time and Newsweek magazines, commenting on AIC Summer exhibitions; Sporting Prints from the Collection of Joel Spitz, exhibition 142-144 August 8, 1939 Briggs Dyer's Sunday Lecture Series gained public acclaim 87 August 12, 1939 Weekly News Letter; lectures and classes given by artists and SAIC alumni Leon R. Pescheret and Addis Osborne, and SAIC professors Edmund Giesbert and Briggs Dyer; Odilon Redon Lithographs, exhibition of works acquired by Martin A. Ryerson from the artist's widow, remarks by AIC Trustee Arthur T. Aldis; painting by Robert B. Harshe, AIC Director from 1921 to 1938, awarded honorable mention at Fine Arts Exhibition of the Golden Gates Exposition, excerpt from The Magazine of Art , May issie 145-147 August 15, 1939 Notes on Briggs Dyer's lectures 88 August 18, 1939 Membership Lecture, One-Plate Color Etching , given by SAIC instructor Leon R. Pescheret 89 August 19, 1939 Weekly News Letter; Student Honorable Mentions for the year 1939; AIC Curator Frederick A. Sweet, inquiring about locations of paintings for inclusion into 50th Annual Exhibition of American Painting and Sculpture: Half a Century of American Art, list of desired works; Assistant in AIC Decorative Arts Department Helen Mitchell, awarded Fellowship at Yale University; The Chicago Museum Tour Committee, providing two-day tour and booklet for Chicago visitors in cooperation with AIC and other cultural institutions, list of the Committee members 148-150 August 22, 1939 Lectures and gallery talks, given by SAIC instructors Briggs Dyer and Addis Osborne, and Head of AIC Education Department Helen Parker 90 Weekly News Letter; Masterpiece of the Month, exhibition series, showing Persian brocade of the Safavid period, the reign of Shah Abbas (1587-1628), gift of Mr. John R. Thompson of Chicago, description and comments; Contemporary Fine Arts Building at the New York World's Fair, AIC ranked as the most popular museum outside New York; Oriental jades from AIC Sonnenschein Collection, shown at The Golden Gate Exposition in San Francisco; free Museum admission on Labor Day; AIC Fall lecture series, titled The Great White Way to San Francisco Bay , given by Dudley Crafts Watson, reflecting on New York World's Fair, The Golden Gate Exposition in San Francisco, and US Museums 151-153 August 29, 1939 Notes on Exhibition of East European Costumes from Florence D. Bartlett Collection and other displays 91 September 2, 1939 SAIC announcing Student registration for the year 1940; colored post cards and reproductions of works from AIC Permanent collection, supplied by New York office of Vienna publisher Max Jaffe, list of titles available at AIC Reproduction Desk; gallery tours, conducted by Head of AIC Education Department Helen Parker and Briggs Dyer of SAIC; general Museum information, record of School, Museum offices and workshops, Shipping Room, and Museum Registrar in the Archives Department; Fall program in Fullerton Hall, opened with lecture series about home decoration, given by Dudley Crafts Watson 154-156 September 11, 1939 Lectures, Paintings of the High Renaissance in Italy , given by Helen Parker, and Dutch and Flemish Old Masters , given by Briggs Dyer 92 September 13, 1939 Meyric R. Rogers, appointed AIC Curator of Decorative Arts Department, replacing late Ms. Bessie Bennett; Mr. Rogers, concurrently appointed Head of Industrial Arts Department, newly formed in AIC; biography note, publications, and remarks by AIC President Potter Palmer and AIC Director of Fine Arts Daniel C. Rich 93-94 September 19, 1939 Week of the American Legion Convention, free Museum admission for the Legion members, announcement by AIC Director of Finance and Operation C. H. Burkholder 95-96 September 22, 1939 American Legion Parade, free Museum admission for the public 95-96 September 25, 1939 AIC Department of Education, programs and lectures, featuring SAIC instructor Mary Hipple, Head of Education Department Helen Parker, Ramsey Wieland, and George Buehr; film demonstrations on art techniques, supplemented by gallery tours 97 September 28, 1939 Sunday Lectures, French and English Paintings of the 17th and 18th Century , given by SAIC instructor George Buehr, and French Decorative Arts , given by assistant in Education Department Ramsey Wieland 100 September 30, 1939 Fiestas in Guatemala , lecture by Erna Fergusson, introducing Scammon Lecture Series for the year 101 October 1, 1939 Masterpiece of the Month, exhibition series, St. John on Patmosby Nicolas Poussin ; comparative displays in Impressionist galleries 98-99 October 2, 1939 Picasso Retrospective, planned by Alfred H. Barr, Director and Vice President of The Museum of Modern Art, N. Y. (MOMA), and Daniel C. Rich, AIC Director of Fine Arts; announcement on exhibition dates; war time exhibition, the first collaborative project by MOMA and AIC 13, 102 October 4, 1939 The Adventures in the Arts , lecture series conducted by Head of Education Department Helen Parker; attendance record for AIC lectures; Costumes from Florence Dibell Bartlett Collection on display 103 October 5, 1939 7th International Exhibition of Lithography and Wood-Engraving, US tour exhibition, jury comprised of artists Peggy Bacon, Asa Cheffetz, and Todros Geller; The Logan Prize for Prints, announced 104 October 7, 1939 Scammon Lecture, The Educational Viewpoint in an Art Museum , given by Dr. Thomas Munro of Cleveland Museum of Art; biography note and publications 105 October 12, 1939 Exhibition of Chinese Pottery and Porcelain, lent by Chicago collectors Mrs. William O. Goodman, Mrs. Richard T. Crane, Mrs. Alice H. Patterson, and Mrs. W. W. Kimball (courtesy of Mrs. Warren Salisbury and Mr. Kimball Salisbury) 106 October 14, 1939 Scammon Lecture, Armor of Renaissance Princes , given by Curator of Arms and Armors in The Metropolitan Museum Stephen V. Grancsay; the 1893 exhibition of Arms and Armor, held at the Chicago Columbian Exposition and featuring Mr. Grancsay's lecture 107 October 20, 1939 Motion Pictures in the Arts , special program in association with 7th International Exhibition of Lithography and Wood-Engraving, conducted by Head of Education Department Helen Parker; film screening, featuring woodcut artists and illustrators, Lynd Ward, Timothy Cole, and Chaim Gross 108 October 21, 1939 Scammon Lecture, The Art of Our Early Cabinet Makers , given by Edwin J. Hipkiss of Boston Museum of Fine Arts; biography note and publications 109 October 26, 1939 SAIC Glee Club concert of Negro Spirituals, conducted by AIC Assistant Director and Curator of Oriental Art Department Charles Fabens Kelley, and featuring musicians Virgil Espenlaub, Juanita Krunk, and Eleanor Gullett; numbers performed 110 October 27, 1939 Scammon Lecture, French Medieval Sculpture in America , given in association with opening of The Cloisters Museum in New York, by James J. Rorimer of The Metropolitan Museum; remarks by Mr. H. E. Winlock, formerly Director of The Metropolitan Museum; publications by Mr. Rorimer 111 October 28, 1939 50th American Exhibition: Half a Century of American Art, opening reception featuring tea table decorations from different periods, sponsored and arranged by The Antiquarian Society, The Municipal Art League, Art Institute Alumni, The Renaissance Society, The Arts Club, etc.; listing of representatives and participants 25, 50, 77, 112, 120-121 November 1, 1939 Masterpieces of Italian Art, exhibition lent by the Royal Italian Government to San Francisco World's Fair, special announcement on exclusive showing at AIC 113-114, 116-119, 122, 123, 125, 129, 131,132, 134 November 6, 1939 Scammon Lecture, Colonial American Portraiture , given by Alan Burroughs of Harvard University; biography note and publications 115 November 9, 1939 Masterpieces of Italian Art, exhibition lent by the Royal Italian Government to San Francisco World's Fair, shipment of art works to Chicago for exclusive showing at AIC and official ceremonies upon arrival, the route of procession to AIC 116 November 11, 1939 Masterpieces of Italian Art, exhibition lent by the Royal Italian Government to San Francisco World's Fair; honorary committees and Chicago sponsors for exclusive AIC showing 117-119 November 14, 1939 50th Annual Exhibition of American Painting and Sculpture: Half a Century of American Art, opening reception arranged by Antiquarian Society and Fortnightly Club, description of table decoration and list of hostesses 120-121 November 17, 1939 Masterpieces of Italian Art, exhibition, opening ceremonies featuring opera singer Hilde Reggiani 122 November 21, 1939 Free Museum admission on Thanksgiving Day; Radio program and special lectures, supplementing Masterpieces of Italian Art Exhibition 123 November 27, 1939 Scammon Lecture, featuring American sculptor William Zorach 124 December 1, 1939 Masterpieces of Italian Art, exhibition, related discussion on using tempera technique 125 December 2, 1939 Scammon Lecture, Precursors of the New Architecture , given by John Barney Rodgers of Armour Institute of Technology; biography note 126 December 5, 1939 Glee Club, Christmas concert, directed by AIC Assistant Director Charles Fabens Kelley 127 December 7, 1939 Masterpieces of Italian Art, exhibition; extended hours for late evening viewing; special musical programs, gallery tours, and Christmas events 129 December 9, 1939 Scammon Lecture, dedicated to sculptor Carl Milles, given by curator of Decorative Arts Department Meyric R. Rogers 128 December 12, 1939 Armour Institute of Technology Musical Club, free concert including AIC Glee Club performance 130 December 14, 1939 Masterpieces of Italian Art, exhibition, evening concerts; Joseph Bentonelli, lyric tenor, performing from the Museum Grand Staircase 131 December 18, 1939 Masterpieces of Italian Art, exhibition, evening concerts; Choir of the Church of Saint Thomas the Apostle 132 December 19, 1939 Free Museum admission on Christmas Day; Listing of current exhibitions 133 December 26, 1939 Masterpieces of Italian Art, exhibition, Italian Day in the Museum, free admission declared by Royal Italian Government 134 December 27, 1939 Free museum admission on New Year's Day; current exhibitions and lectures 135 ",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.6"
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
        "version": "1.6"
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
            "api_link": "https://api.artic.edu/api/v1/educator-resources/123",
            "id": 123,
            "title": "Lesson Plan: Bisa Butler's Safety Patrol",
            "timestamp": "2022-12-13T23:32:28-06:00"
        },
        {
            "_score": 1,
            "api_model": "educator-resources",
            "api_link": "https://api.artic.edu/api/v1/educator-resources/120",
            "id": 120,
            "title": "Virtual Lesson Plan: Cobalt and the Color Blue",
            "timestamp": "2022-12-13T23:32:28-06:00"
        },
        {
            "_score": 1,
            "api_model": "educator-resources",
            "api_link": "https://api.artic.edu/api/v1/educator-resources/119",
            "id": 119,
            "title": "Virtual Lesson Plan: Following the Phoenix",
            "timestamp": "2022-12-13T23:32:28-06:00"
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
        "web_url": "https://nocache.www.artic.edu/collection/resources/educator-resources/7-thematic-curriculum-art-science",
        "copy": " Art + Science was developed by the Art Institute of Chicago to support dialogue and collaboration between art and science teachers at the middle school level, with the ultimate goal of inspiring art and science integration in the curriculum. The program consists of two interconnected parts: this curriculum resource and a field trip to the museum, which features a gallery tour and studio art-making activity. The curriculum resource is intended to help teachers to prepare for and extend the field trip experience. Both the field trip and curriculum resource showcase and encourage interdisciplinary connections between art and science first on a broad level and then through the particular lens of stability and change. ",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.6"
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
        "version": "1.6"
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
            "timestamp": "2022-12-13T23:32:41-06:00"
        },
        {
            "_score": 1,
            "api_model": "digital-catalogs",
            "api_link": "https://api.artic.edu/api/v1/digital-catalogs/34",
            "id": 34,
            "title": "Malangatana: Mozambique Modern",
            "timestamp": "2022-12-13T23:32:41-06:00"
        },
        {
            "_score": 1,
            "api_model": "digital-catalogs",
            "api_link": "https://api.artic.edu/api/v1/digital-catalogs/33",
            "id": 33,
            "title": "The Lithographs of James McNeill Whistler: The Digital Edition",
            "timestamp": "2022-12-13T23:32:41-06:00"
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
        "web_url": "https://nocache.www.artic.edu/digital-publications/2/american-silver",
        "copy": " American Silver in the Art Institute of Chicago showcases the museum's superb collection of American silver. In-depth essays relate a fascinating story about eating, drinking, and entertaining that spans the history of the Republic and traces the development of the museum\u2019s holdings of American silver over nearly a century, and a catalogue incorporates detailed analysis of objects written by leading specialists. This digital augmentation of the 2017 publication provides stunning high-resolution photography and, for a select number of objects, three-dimensional captures that allow for close viewing. In addition, this edition includes an extensive illustrated checklist of additional objects.   Edited by Elizabeth McGoey with contributions by Debra Schmidt Bach, David L. Barquist, Judith A. Barter, Jennifer Goldsborough, Medill Higgins Harvey, Patricia Kane, Elizabeth McGoey, Barbara K. Schnitzer, Janine E. Skerry, Ann Wagner, Gerald W. R. Ward, Deborah Dependahl Waters, Beth Carver Wees, and Elizabeth A. Williams   American Silver in the Art Institute of Chicago is free and has received major support for this catalogue is provided by the Henry Luce Foundation. It is also made by possible by the generosity of the Community Associates of the Art Institute of Chicago, Mr. and Mrs. Henry M. Buchbinder, Carl and Marilynn Thoma, Louise Ingersoll Tausche, Jamee and Marshal Field V, Kay Bucksbaum, Celia and David Hilliard, and Jan and Bill Jentes. ",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.6"
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
        "version": "1.6"
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
            "timestamp": "2022-12-13T23:32:45-06:00"
        },
        {
            "_score": 1,
            "api_model": "digital-publication-sections",
            "api_link": "https://api.artic.edu/api/v1/digital-publication-sections/6",
            "id": 6,
            "title": "\u201cMalangatana as Ethnographer? Modern Paintings of Village Life\u201d by Constantine Petridis",
            "timestamp": "2022-12-13T23:32:45-06:00"
        },
        {
            "_score": 1,
            "api_model": "digital-publication-sections",
            "api_link": "https://api.artic.edu/api/v1/digital-publication-sections/8",
            "id": 8,
            "title": "\u201cDeep Ambivalences: Malangatana\u2019s Anti/Colonial Aesthetic\u201d by M\u00e1rio Pissarra",
            "timestamp": "2022-12-13T23:32:45-06:00"
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
        "copy": " The Art Institute of Chicago has been at the forefront of American museums in collecting and displaying modern art since the early twentieth century, and boasts an ongoing commitment to extending this vital legacy with research, publications, and exhibitions. In that spirit, a number of our curators came together in 2013 for a series of discussions exploring ideas about modern art, in particular the ways in which it manifests across our collections. This gave rise to the Modern Series, a set of three experimental, challenging, and provocative exhibitions and publications that are co-organized by curators across departments, with divergent but complementary specialties. The two previous iterations\u2014 Shatter Rupture Break (February 15\u2013May 3, 2015) and Go (February 23\u2013June 4, 2017)\u2014sought to present the museum\u2019s holdings in departments including Arts of the Americas, Modern and Contemporary Art, Photography and Media, and Textiles in fresh and exciting ways. Malangatana: Mozambique Modern (July 30\u2013November 16, 2020), the third and final project in the series, expands our understanding of modernism and modern art in a global context by bringing the work of celebrated Mozambican artist Malangatana Ngwenya (1936\u20132011) into conversation with our own international collection. It not only showcases the evolution in style and content within his early paintings and drawings, but also contextualizes his practice within the social and political conditions that framed the emergence of modern art in Mozambique and across the African continent. The exhibition also contributed to the cultivation of a more global perspective on artistic creation and its representation in the museum, both by providing the basis for this publication and, not least, by prompting us to acquire a painting and six works on paper by Malangatana for our permanent collection. Africa and its diasporas, with their deep history and wide geographical reach, occupy a prominent place within global art history and modern art that merits many more such efforts and programs in the years to come. Our colleagues\u2014notably Sarah Guernsey, Ann Goldstein, and Greg Nosan\u2014deserve my sincere gratitude for their continuing critical support for the Modern Series. But I am especially thankful to the exhibition\u2019s curators, Hendrik Folkerts, Felicia Mings, and Constantine Petridis, for introducing our staff and visitors to the fascinating milieu and work of Malangatana Ngwenya and for helping the Art Institute expand its representation of modern art from around the world. This exhibition would not have been possible without the generosity of the individuals and institutions in the United States, Portugal, and Mozambique who lent works from their collections. I am particularly grateful to the Malangatana Valente Ngwenya Foundation in Maputo for its invaluable loan of a significant number of paintings and drawings. Major funding for Malangatana: Mozambique Modern was provided by Sylvia Neil and Dan Fischel and the Alfred L. McDougal and Nancy Lauter McDougal Fund for Contemporary Art. Additional support is contributed by the Society for Contemporary Art through the SCA Activation Fund and the Miriam U. Hoover Foundation. Members of the Luminary Trust provide annual leadership support for the museum\u2019s operations, including exhibition development, conservation and collection care, and educational programming. The Luminary Trust includes an anonymous donor; Neil Bluhm and the Bluhm Family Charitable Foundation; Jay Franke and David Herro; Karen Gray-Krehbiel and John Krehbiel, Jr.; Kenneth Griffin; Caryn and King Harris, The Harris Family Foundation; Josef and Margot Lakonishok; Robert M. and Diane v.S. Levy; Ann and Samuel M. Mencoff; Sylvia Neil and Dan Fischel; Anne and Chris Reyes; Cari and Michael J. Sacks; and the Earl and Brenda Shapiro Foundation. Most importantly, I acknowledge with deepest thanks the intellectual and financial support of Sylvia Neil and Dan Fischel, who have provided crucial funding for the realization of this catalogue as well as the previous two in the Modern Series. Their ongoing commitment has enabled and encouraged our continued explorations into the possibilities of digital publication. James Rondeau President and Eloise W. Martin Director ",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.6"
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
        "total": 127,
        "limit": 2,
        "offset": 0,
        "total_pages": 64,
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
        "version": "1.6"
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
        "total": 127,
        "limit": 10,
        "offset": 0,
        "total_pages": 13,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "printed-catalogs",
            "api_link": "https://api.artic.edu/api/v1/printed-catalogs/59",
            "id": 59,
            "title": "Northern European and Spanish Paintings before 1600 in the Art Institute of Chicago: A Catalogue of the Collection",
            "timestamp": "2022-12-13T23:33:00-06:00"
        },
        {
            "_score": 1,
            "api_model": "printed-catalogs",
            "api_link": "https://api.artic.edu/api/v1/printed-catalogs/8",
            "id": 8,
            "title": "Avant-Garde Art in Everyday Life: Early Twentieth-Century European Modernism",
            "timestamp": "2022-12-13T23:33:00-06:00"
        },
        {
            "_score": 1,
            "api_model": "printed-catalogs",
            "api_link": "https://api.artic.edu/api/v1/printed-catalogs/28",
            "id": 28,
            "title": "Bertrand Goldberg: Architecture of Invention",
            "timestamp": "2022-12-13T23:33:00-06:00"
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
        "web_url": "https://nocache.www.artic.edu/print-publications/4/the-art-institute-of-chicago-the-essential-guide",
        "copy": " The Essential Guide presents the diverse holdings of the Art Institute\u2019s collections. Featuring more than three hundred objects, it provides a journey through time\u2014from ancient Egypt until the present day\u2014and across the globe. Beautifully illustrated with short texts about each work, the publication includes beloved icons such as Georges Seurat\u2019s Sunday on La Grande Jatte\u20141884 and Edward Hopper\u2019s Nighthawks , as well as exciting recent acquisitions like a Teotihuacan shell mask, Marcel Duchamp\u2019s readymade Bottle Rack , and Thomas Hart Benton\u2019s Cotton Pickers . Read about objects currently on view in the galleries as well as exquisite textiles and works on paper that, because of the fragility of their materials, are less frequently shown. Use it as a guide to the museum or a souvenir of your visit. Four distinctive covers\u2014one great book! Choose your favorite cover image by Katsushika Hokusai, Archibald Motley Jr., Georgia O\u2019Keeffe, or Georges Seurat.   Foreword by James Rondeau   352 pages, 6 x 9 x 1 in. 335 color ills. Softcover $25 ($22.50 members) ISBN 978-0-86559-301-5 ",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.6"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
    }
}
```
:::

