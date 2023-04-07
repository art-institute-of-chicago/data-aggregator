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
        "total": 118873,
        "limit": 2,
        "offset": 0,
        "total_pages": 59437,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/artworks?page=2&limit=2"
    },
    "data": [
        {
            "id": 54488,
            "api_model": "artworks",
            "api_link": "https://api.artic.edu/api/v1/artworks/54488",
            "is_boosted": false,
            "title": "Man Ploughing, Dalby",
            "alt_titles": null,
            ...
        },
        {
            "id": 86395,
            "api_model": "artworks",
            "api_link": "https://api.artic.edu/api/v1/artworks/86395",
            "is_boosted": false,
            "title": "Centerpiece and Stand with Pair of Sugar Casters",
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
        "version": "1.8"
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
            "_score": 209.39456,
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
            "timestamp": "2023-03-22T23:15:27-05:00"
        },
        {
            "_score": 194.00476,
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
            "timestamp": "2023-03-22T23:13:52-05:00"
        },
        {
            "_score": 191.86606,
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
            "timestamp": "2023-03-22T23:15:24-05:00"
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
        "version": "1.8"
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
        "total": 15009,
        "limit": 2,
        "offset": 0,
        "total_pages": 7505,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/agents?page=2&limit=2"
    },
    "data": [
        {
            "id": 115387,
            "api_model": "agents",
            "api_link": "https://api.artic.edu/api/v1/agents/115387",
            "title": "Josephine Pryde",
            "sort_title": "Pryde, Josephine",
            "alt_titles": null,
            ...
        },
        {
            "id": 6717,
            "api_model": "agents",
            "api_link": "https://api.artic.edu/api/v1/agents/6717",
            "title": "Dikran G. Kelekian, Inc.",
            "sort_title": "Dikran G. Kelekian, Inc.",
            "alt_titles": [
                "Dikran G. Kelekian Inc.",
                "Kelekian, Inc."
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
        "version": "1.8"
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
        "total": 15090,
        "limit": 10,
        "offset": 0,
        "total_pages": 1509,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "agents",
            "api_link": "https://api.artic.edu/api/v1/agents/2",
            "id": 2,
            "title": "Antiquarian Society",
            "timestamp": "2023-04-07T10:02:30-05:00"
        },
        {
            "_score": 1,
            "api_model": "agents",
            "api_link": "https://api.artic.edu/api/v1/agents/25",
            "id": 25,
            "title": "Anonymous",
            "timestamp": "2023-04-07T10:02:30-05:00"
        },
        {
            "_score": 1,
            "api_model": "agents",
            "api_link": "https://api.artic.edu/api/v1/agents/102",
            "id": 102,
            "title": "Alvar Aalto",
            "timestamp": "2023-04-07T10:02:30-05:00"
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
        "version": "1.8"
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
        "total": 3973,
        "limit": 2,
        "offset": 0,
        "total_pages": 1987,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/places?page=2&limit=2"
    },
    "data": [
        {
            "id": -1891,
            "api_model": "places",
            "api_link": "https://api.artic.edu/api/v1/places/-1891",
            "title": "Jemez Pueblo",
            "tgn_id": null,
            "source_updated_at": "2022-12-27T11:44:25-06:00",
            ...
        },
        {
            "id": -2147476187,
            "api_model": "places",
            "api_link": "https://api.artic.edu/api/v1/places/-2147476187",
            "title": "New York",
            "tgn_id": null,
            "source_updated_at": "2022-12-22T12:10:04-06:00",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Attribution 4.0 Generic License (CC-By) and the Terms and Conditions of artic.edu. Contains information from the J. Paul Getty Trust, Getty Research Institute, the Getty Thesaurus of Geographic Names, which is made available under the ODC Attribution License.",
        "license_links": [
            "https://www.artic.edu/terms",
            "https://creativecommons.org/licenses/by/4.0/"
        ],
        "version": "1.8"
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
        "total": 3977,
        "limit": 10,
        "offset": 0,
        "total_pages": 398,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "places",
            "api_link": "https://api.artic.edu/api/v1/places/-2147471508",
            "id": -2147471508,
            "title": "Haycock Township",
            "timestamp": "2022-05-08T23:17:35-05:00"
        },
        {
            "_score": 1,
            "api_model": "places",
            "api_link": "https://api.artic.edu/api/v1/places/-2147471507",
            "id": -2147471507,
            "title": "Rainrod",
            "timestamp": "2022-05-08T23:17:35-05:00"
        },
        {
            "_score": 1,
            "api_model": "places",
            "api_link": "https://api.artic.edu/api/v1/places/-2147471505",
            "id": -2147471505,
            "title": "Sevenoaks",
            "timestamp": "2022-05-08T23:17:35-05:00"
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
        "tgn_id": null,
        "source_updated_at": "1976-09-02T11:20:00-05:00",
        ...
    },
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Attribution 4.0 Generic License (CC-By) and the Terms and Conditions of artic.edu. Contains information from the J. Paul Getty Trust, Getty Research Institute, the Getty Thesaurus of Geographic Names, which is made available under the ODC Attribution License.",
        "license_links": [
            "https://www.artic.edu/terms",
            "https://creativecommons.org/licenses/by/4.0/"
        ],
        "version": "1.8"
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
            "id": 23968,
            "api_model": "galleries",
            "api_link": "https://api.artic.edu/api/v1/galleries/23968",
            "title": "Gallery 284",
            "latitude": 41.880123635586,
            "longitude": -87.622311842749,
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
        "version": "1.8"
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
        "total": 38,
        "limit": 10,
        "offset": 0,
        "total_pages": 4,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "galleries",
            "api_link": "https://api.artic.edu/api/v1/galleries/2147475440",
            "id": 2147475440,
            "title": "Gallery 136",
            "timestamp": "2023-01-03T13:06:56-06:00"
        },
        {
            "_score": 1,
            "api_model": "galleries",
            "api_link": "https://api.artic.edu/api/v1/galleries/2147483637",
            "id": 2147483637,
            "title": "Gallery 204",
            "timestamp": "2023-01-12T17:16:54-06:00"
        },
        {
            "_score": 1,
            "api_model": "galleries",
            "api_link": "https://api.artic.edu/api/v1/galleries/2147483638",
            "id": 2147483638,
            "title": "Gallery 203",
            "timestamp": "2023-01-09T00:16:46-06:00"
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
        "version": "1.8"
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
        "total": 6170,
        "limit": 2,
        "offset": 0,
        "total_pages": 3085,
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
            "short_description": "Please note: this exhibition is open on weekdays only.",
            ...
        },
        {
            "id": 2999,
            "api_model": "exhibitions",
            "api_link": "https://api.artic.edu/api/v1/exhibitions/2999",
            "title": "Tools of the Trade: 19th- and 20th- Century Architectural Trade Catalogs",
            "is_featured": false,
            "short_description": null,
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.8"
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
        "total": 6446,
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
        "version": "1.6"
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
        "short_description": "This landmark exhibition is devoted to the marine paintings of Edouard Manet (1832\u20131883), a little-studied but highly significant aspect of the career of the artist who is sometimes referred to as the father of Impressionism.",
        ...
    },
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.8"
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
        "version": "1.8"
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
        "version": "1.8"
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
        "version": "1.8"
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
        "version": "1.8"
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
        "version": "1.8"
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
        "version": "1.8"
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
        "version": "1.8"
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
        "version": "1.8"
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
        "version": "1.8"
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
        "version": "1.8"
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
        "total": 9766,
        "limit": 2,
        "offset": 0,
        "total_pages": 4883,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/category-terms?page=2&limit=2"
    },
    "data": [
        {
            "id": "TM-15398",
            "api_model": "category-terms",
            "api_link": "https://api.artic.edu/api/v1/category-terms/TM-15398",
            "title": "copper plate",
            "subtype": "material",
            "parent_id": null,
            ...
        },
        {
            "id": "TM-15397",
            "api_model": "category-terms",
            "api_link": "https://api.artic.edu/api/v1/category-terms/TM-15397",
            "title": "silver plate",
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
        "version": "1.8"
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
        "total": 9780,
        "limit": 10,
        "offset": 0,
        "total_pages": 978,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "category-terms",
            "api_link": "https://api.artic.edu/api/v1/category-terms/TM-13183",
            "id": "TM-13183",
            "title": "washington, D.C.",
            "timestamp": "2022-05-08T23:19:06-05:00"
        },
        {
            "_score": 1,
            "api_model": "category-terms",
            "api_link": "https://api.artic.edu/api/v1/category-terms/TM-13184",
            "id": "TM-13184",
            "title": "united states of america",
            "timestamp": "2022-05-08T23:19:06-05:00"
        },
        {
            "_score": 1,
            "api_model": "category-terms",
            "api_link": "https://api.artic.edu/api/v1/category-terms/TM-13185",
            "id": "TM-13185",
            "title": "kasterlee (municipality)",
            "timestamp": "2022-05-08T23:19:06-05:00"
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
        "version": "1.8"
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
        "total": 154189,
        "limit": 2,
        "offset": 0,
        "total_pages": 77095,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/images?page=2&limit=2"
    },
    "data": [
        {
            "id": "d6e4181d-dc08-ed5f-1f9f-95fb71e1aa6a",
            "lake_guid": "d6e4181d-dc08-ed5f-1f9f-95fb71e1aa6a",
            "api_model": "images",
            "api_link": "https://api.artic.edu/api/v1/images/d6e4181d-dc08-ed5f-1f9f-95fb71e1aa6a",
            "title": "243266",
            "type": "image",
            ...
        },
        {
            "id": "f4c55af0-d797-989c-2581-ba92b2ba5043",
            "lake_guid": "f4c55af0-d797-989c-2581-ba92b2ba5043",
            "api_model": "images",
            "api_link": "https://api.artic.edu/api/v1/images/f4c55af0-d797-989c-2581-ba92b2ba5043",
            "title": "243268",
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
        "version": "1.8"
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
        "total": 155219,
        "limit": 10,
        "offset": 0,
        "total_pages": 15522,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "images",
            "api_link": "https://api.artic.edu/api/v1/images/154b8da1-cfc9-5e58-f996-9c46e6211b73",
            "id": "154b8da1-cfc9-5e58-f996-9c46e6211b73",
            "title": "G28125",
            "timestamp": "2022-05-08T23:31:16-05:00"
        },
        {
            "_score": 1,
            "api_model": "images",
            "api_link": "https://api.artic.edu/api/v1/images/da377b99-3363-fb09-57b1-e2cd1a43719e",
            "id": "da377b99-3363-fb09-57b1-e2cd1a43719e",
            "title": "G21772",
            "timestamp": "2022-05-08T23:31:17-05:00"
        },
        {
            "_score": 1,
            "api_model": "images",
            "api_link": "https://api.artic.edu/api/v1/images/78f6ad73-80d5-6bc5-0553-56529aca8457",
            "id": "78f6ad73-80d5-6bc5-0553-56529aca8457",
            "title": "G21767",
            "timestamp": "2022-05-08T23:31:11-05:00"
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
        "version": "1.8"
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
        "version": "1.8"
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
        "total": 1,
        "limit": 10,
        "offset": 0,
        "total_pages": 1,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "videos",
            "api_link": "https://api.artic.edu/api/v1/videos/fae3fdc2-7a52-5fc4-c634-c2033f9b2a46",
            "id": "fae3fdc2-7a52-5fc4-c634-c2033f9b2a46",
            "title": "Skeele_FruitPiece_Essentials_Main",
            "timestamp": "2023-02-14T16:12:02-06:00"
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
        "total": 807,
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
        "version": "1.8"
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
        "total": 807,
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
            "timestamp": "2023-02-14T15:28:12-06:00"
        },
        {
            "_score": 1,
            "api_model": "sounds",
            "api_link": "https://api.artic.edu/api/v1/sounds/586f399e-1566-b42a-c4a9-5b4aa77a0d2f",
            "id": "586f399e-1566-b42a-c4a9-5b4aa77a0d2f",
            "title": "Audio Lecture: Mel Bochner Symposium, Introduction and Keynote",
            "timestamp": "2023-02-14T15:28:12-06:00"
        },
        {
            "_score": 1,
            "api_model": "sounds",
            "api_link": "https://api.artic.edu/api/v1/sounds/df8dcfba-6535-64e2-a4d1-7701e2d121e8",
            "id": "df8dcfba-6535-64e2-a4d1-7701e2d121e8",
            "title": "Audio Lecture: Mel Bochner Symposium, Panel I: Language (Eric de Bruyn)",
            "timestamp": "2023-02-14T15:28:12-06:00"
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
        "version": "1.8"
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
        "version": "1.8"
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
        "version": "1.6"
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
        "version": "1.8"
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
        "total": 1194,
        "limit": 2,
        "offset": 0,
        "total_pages": 597,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/products?page=2&limit=2"
    },
    "data": [
        {
            "id": 288516,
            "api_model": "products",
            "api_link": "https://api.artic.edu/api/v1/products/288516",
            "title": "Forming Abstraction: Art and Institutions in Postwar Brazil",
            "external_sku": 288516,
            "image_url": "https://shop-images.imgix.net288516_2.jpg",
            ...
        },
        {
            "id": 288473,
            "api_model": "products",
            "api_link": "https://api.artic.edu/api/v1/products/288473",
            "title": "Richard Hunt",
            "external_sku": 288473,
            "image_url": "https://shop-images.imgix.net288473_2.jpg",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.8"
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
        "total": 1284,
        "limit": 10,
        "offset": 0,
        "total_pages": 129,
        "current_page": 1
    },
    "data": [
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
        },
        {
            "_score": 1,
            "api_model": "products",
            "api_link": "https://api.artic.edu/api/v1/products/248669",
            "id": "248669",
            "title": "Awika Windup Toy",
            "timestamp": "2022-12-07T23:00:50-06:00"
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
        "version": "1.8"
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
        "version": "1.8"
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
        "total": 20,
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
            "timestamp": "2023-01-23T23:00:36-06:00"
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
        "version": "1.8"
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
        "version": "1.8"
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
        "total": 879,
        "limit": 10,
        "offset": 0,
        "total_pages": 88,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "mobile-sounds",
            "api_link": "https://api.artic.edu/api/v1/mobile-sounds/226",
            "id": 226,
            "title": "Justus Sustermans",
            "timestamp": "2023-03-22T23:00:10-05:00"
        },
        {
            "_score": 1,
            "api_model": "mobile-sounds",
            "api_link": "https://api.artic.edu/api/v1/mobile-sounds/227",
            "id": 227,
            "title": "Self-Portrait, Etching at a Window",
            "timestamp": "2023-03-22T23:00:11-05:00"
        },
        {
            "_score": 1,
            "api_model": "mobile-sounds",
            "api_link": "https://api.artic.edu/api/v1/mobile-sounds/235",
            "id": 235,
            "title": "Self-Portrait, Anthony Van Dyck",
            "timestamp": "2023-03-22T23:00:11-05:00"
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
        "version": "1.8"
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
        "version": "1.8"
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
        "version": "1.6"
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
        "version": "1.8"
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
        "version": "1.8"
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
        "version": "1.6"
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
        "version": "1.8"
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
        "version": "1.8"
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
        "version": "1.6"
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
        "version": "1.8"
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
        "total": 2326,
        "limit": 2,
        "offset": 0,
        "total_pages": 1163,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/events?page=2&limit=2"
    },
    "data": [
        {
            "id": 5605,
            "api_model": "events",
            "api_link": "https://api.artic.edu/api/v1/events/5605",
            "title": "Member Lecture: The Journey of the Noble Dos Aguas Armory",
            "title_display": "Member Lecture: The Journey of the Noble Dos Aguas Armory",
            "image_url": "https://artic-web.imgix.net/e425db37-aa3d-4452-ad3d-56fc385ca2d6/default1.jpg?rect=0%2C11%2C843%2C473&auto=format%2Ccompress&q=80&fit=crop&crop=faces%2Cedges%2Centropy&w=1200&h=673",
            ...
        },
        {
            "id": 5651,
            "api_model": "events",
            "api_link": "https://api.artic.edu/api/v1/events/5651",
            "title": "Lecture: Diego Vel\u00e1zquez in Seville",
            "title_display": null,
            "image_url": "https://artic-web.imgix.net/100b6ca4-879d-4402-9c23-902090b40725/default1.jpg?rect=27%2C0%2C1550%2C872&auto=format%2Ccompress&q=80&fit=crop&crop=faces%2Cedges%2Centropy&w=1200&h=675",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.8"
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
        "total": 2359,
        "limit": 10,
        "offset": 0,
        "total_pages": 236,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "events",
            "api_link": "https://api.artic.edu/api/v1/events/5603",
            "id": 5603,
            "title": "Virtual Rebroadcast: Lecture\u2014The Language of Beauty in African Art",
            "timestamp": "2023-03-22T23:16:45-05:00"
        },
        {
            "_score": 1,
            "api_model": "events",
            "api_link": "https://api.artic.edu/api/v1/events/5604",
            "id": 5604,
            "title": "Museum Closed Today",
            "timestamp": "2023-03-22T23:16:45-05:00"
        },
        {
            "_score": 1,
            "api_model": "events",
            "api_link": "https://api.artic.edu/api/v1/events/5564",
            "id": 5564,
            "title": "Virtual Lecture: Fabricating Fashion",
            "timestamp": "2023-03-22T23:16:45-05:00"
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
        "version": "1.8"
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
        "total": 411,
        "limit": 2,
        "offset": 0,
        "total_pages": 206,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/event-occurrences?page=2&limit=2"
    },
    "data": [
        {
            "id": "f0ffa14b-2388-5971-be1b-e3357d053d6f",
            "api_model": "event-occurrences",
            "api_link": "https://api.artic.edu/api/v1/event-occurrences/f0ffa14b-2388-5971-be1b-e3357d053d6f",
            "title": "Lecture: Goryeo Celadon and Material Culture",
            "event_id": 5598,
            "short_description": "Join ceramic specialist Namwon Jang for a discussion of the Goryeo celadons from the Art Institute\u2019s collection currently on view in the Korean galleries.",
            ...
        },
        {
            "id": "d53bd05c-88e9-5c0e-9d98-3307167e4fa0",
            "api_model": "event-occurrences",
            "api_link": "https://api.artic.edu/api/v1/event-occurrences/d53bd05c-88e9-5c0e-9d98-3307167e4fa0",
            "title": "The Start Here Tour (Sunday)",
            "event_id": 5554,
            "short_description": "Start your Art Institute visit with a one-stop tour\u2014get a peek at the collection, learn about the day\u2019s events, and receive tips for navigating the museum.",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.8"
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
        "total": 452,
        "limit": 10,
        "offset": 0,
        "total_pages": 46,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "event-occurrences",
            "api_link": "https://api.artic.edu/api/v1/event-occurrences/2e228f55-25c1-59dd-9cdc-943102de3d89",
            "id": "2e228f55-25c1-59dd-9cdc-943102de3d89",
            "title": "Slow Looking: Museum Makeover Edition (May 19)",
            "timestamp": "2023-03-22T23:26:32-05:00"
        },
        {
            "_score": 1,
            "api_model": "event-occurrences",
            "api_link": "https://api.artic.edu/api/v1/event-occurrences/87e2d02d-00de-530c-8b78-de133b9b287d",
            "id": "87e2d02d-00de-530c-8b78-de133b9b287d",
            "title": "Slow Looking: Museum Makeover Edition (May 5)",
            "timestamp": "2023-03-22T23:26:32-05:00"
        },
        {
            "_score": 1,
            "api_model": "event-occurrences",
            "api_link": "https://api.artic.edu/api/v1/event-occurrences/e95cb9c3-1506-5e17-8525-b4ebcc48ea71",
            "id": "e95cb9c3-1506-5e17-8525-b4ebcc48ea71",
            "title": "Gallery Tour: (Thursday at 1:00, Modern Wing start)",
            "timestamp": "2023-03-23T12:56:26-05:00"
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
        "version": "1.8"
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
        "total": 34,
        "limit": 2,
        "offset": 0,
        "total_pages": 17,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/event-programs?page=2&limit=2"
    },
    "data": [
        {
            "id": 16,
            "api_model": "event-programs",
            "api_link": "https://api.artic.edu/api/v1/event-programs/16",
            "title": "Antiquarian Society",
            "is_affiliate_group": false,
            "is_event_host": false,
            ...
        },
        {
            "id": 12,
            "api_model": "event-programs",
            "api_link": "https://api.artic.edu/api/v1/event-programs/12",
            "title": "Verbal Description Tours",
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
        "version": "1.8"
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
            "timestamp": "2023-03-22T23:26:34-05:00"
        },
        {
            "_score": 1,
            "api_model": "event-programs",
            "api_link": "https://api.artic.edu/api/v1/event-programs/85",
            "id": 85,
            "title": "Volunteers",
            "timestamp": "2023-03-22T23:26:34-05:00"
        },
        {
            "_score": 1,
            "api_model": "event-programs",
            "api_link": "https://api.artic.edu/api/v1/event-programs/84",
            "id": 84,
            "title": "Art + Science",
            "timestamp": "2023-03-22T23:26:34-05:00"
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
        "version": "1.8"
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
        "total": 391,
        "limit": 2,
        "offset": 0,
        "total_pages": 196,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/articles?page=2&limit=2"
    },
    "data": [
        {
            "id": 1029,
            "api_model": "articles",
            "api_link": "https://api.artic.edu/api/v1/articles/1029",
            "title": "Bessie Potter Vonnoh, Trailblazing Chicago Sculptor",
            "copy": " Her remarkable career, like those of many women artists, eventually faded from view. Let\u2019s look anew at Vonnoh (1872\u20131955).   In 1895 the museum acquired seven of Vonnoh's sculptures: singular female figures (save for one of a male) in contemporary dress, about 12 to 15 inches in height, including The Chrysanthemum Girl. Cast in plaster, the compositions were conceived to be finished works in a material oftentimes employed by artists as an intermediate step\u2014a sketch for a composition yet to be refined.   Vonnoh, in contrast, embraced plaster as an accessible medium with possibilities. It captured the rough, freely modeled surfaces of her statuettes (dubbed \u201cPotterines\u201d in her day), suggestive and appealingly tactile in form. For French artist Jean-Fran\u00e7ois Rafa\u00eblli, her three-dimensional works resonated with the canvases of modern plein-air painters. Vonnoh was, in his words, \u201can impressionist in plaster.\u201d   Today, her name remains unfamiliar to many art enthusiasts and scholars, but at the turn of the 20th century, Bessie Potter Vonnoh made headlines. A total of nine of her sculptures were in the Art Institute\u2019s holdings by 1901. And in 1914\u201315, the museum mounted a solo exhibition on the artist. A number of sculptures\u2014this time bronze casts\u2014were purchased by the museum out of the exhibition.   Vonnoh was born Bessie Onahotema Potter in St. Louis in 1872, her middle name meaning \u201cshe gives with an open hand\u201d in the language of the Choctaw Nation. (Vonnoh was white; her mother sought out a Native name, according to the artist.) A short time later, after the death of her father, she and her mother moved to Chicago. Vonnoh suffered from an unknown illness as a young child. The prescribed medical treatments left her immobile much of the time, which greatly stunted her growth, although she eventually regained her health. Years later, as she garnered artistic fame, much was made in the press about her diminutive stature in relation to her big talents.   Her achievements as a young female artist were considerable. As a schoolgirl in Chicago, sculpture drew her in. In 1886 at age 14, Vonnoh was already a student at the School of the Art Institute of Chicago, working in the studio of sculptor and instructor Lorado Taft. Five years later, while wrapping up coursework, she stepped into the art world as a professional, exhibiting a portrait bust at the museum\u2019s Fourth Annual Exhibition of American Oil Paintings and Sculpture . Vonnoh had arrived.   Her path to success was certainly noteworthy, but Vonnoh was not alone. In late 19th-century Chicago, networks of and opportunities for (largely white) female professionals were on the rise. Women studied at the School of the Art Institute in strong numbers at the time of Vonnoh\u2019s tenure. In 1892 female students surpassed male students six to one. And the school\u2019s faculty mirrored that drive toward professionalism: painter Alice Kellogg (later Tyler), a graduate of the program, became an instructor there in 1881, and by the following decade women comprised almost one-third of the faculty. Women artists were on the rosters of early exhibitions at the Art Institute, including various annuals for contemporary American art, Chicago artists, and students of the school. (To be sure, the percentage of female exhibitors remained small, but a nexus of artists demonstrated that it could be done, despite persistent obstacles.) Additionally, women in Chicago created their own organizations, such as the Bohemian Art Club (later the Palette Club), whose annual exhibitions were held at the museum beginning in 1883\u2014just four years after the founding of the Art Institute itself.   Her training completed, Vonnoh seized an important opportunity: executing public commissions in sculpture for the city\u2019s 1893 World\u2019s Columbian Exposition. She, along with a cadre of local female sculptors including Julia Bracken (later Wendt) and Janet Scudder, who had likewise studied with Taft, assisted on projects for the fair\u2019s Horticulture Building. Additionally, Vonnoh made her mark with individual contributions to the Illinois State Building and the Fine Arts exhibition.   Establishing a studio in 1894, Vonnoh carved out a niche in Chicago\u2019s artistic life, honing in on what would become her celebrated forms: domestically scaled sculptures of contemporary women. Rapidly sketched, they were genre studies as well as portraits, evoking a fleeting moment or a familiar activity.   In the mid-1890s, Vonnoh\u2019s sculptures were in high demand. She could produce plaster casts from her clay models in large editions and offer them at prices accessible to middle-class patrons. The artist experimented with the finish of her plasters through tinting\u2014applying soft, matte color to portions of an object to heighten the visual interest of its active surfaces, as she did in An American Girl .   In 1895 the seven plasters by Vonnoh that entered the Art Institute were The Chrysanthemum Girl , An American Girl , Miss F. , William , Mildred , Evelyn , and A Summer Girl (the first three were tinted sculptures). The set was purchased and presented to the museum by the Arch\u00e9 Club, a local women\u2019s group dedicated to the study of art and history. Records for the acquisition note, \u201cThe Arch\u00e9 Club gave $100 to be devoted to the work of a woman sculptor in Chicago.\u201d Here again is an example of a (modest) structure of support for female professionals in the city in the late 19th century.   With these acquisitions, Vonnoh became the first named woman sculptor\u2014and only the second woman artist\u2014represented at the Art Institute (Annie C. Shaw was the first, with paintings acquired in 1892 and 1894). Neither Rosa Bonheur nor Mary Cassatt, for instance\u2014artists whose names and reputations have fared much better over the last century\u2014had a work in the permanent collection yet (not until 1901 and 1910, respectively).   After her early achievements in Chicago, Bessie Potter Vonnoh set her sights further afield, traveling abroad and eventually settling in New York, where she married painter Robert Vonnoh in 1899. Her pace did not slow. Attracting patrons with deeper pockets, she was then able to translate her sculptures into bronze, a new challenge.   Her 1914\u201315 exhibition at the Art Institute featured thirty-three sculptures, largely in bronze. Examples of her work in this medium are what can be found in the collection today. Sadly, none of her plasters remain at the Art Institute. When seven bronzes were purchased in 1915, Vonnoh requested that her earlier plasters be returned, and the museum obliged. We can assume that the artist felt the bronzes better represented her mature work. The Art Institute currently holds five of her sculptures.   Vonnoh\u2019s fascinating story comes to light when we take time to experience her sculptures and comb the archives. The dividends are many: we come to understand better our own institutional histories, elevate and celebrate objects too long neglected, and carve a different path forward in the galleries. \u2014Annelise K. Madsen, Gilda and Henry Buchbinder Associate Curator, Arts of the Americas ",
            "source_updated_at": "2023-01-06T09:26:03-06:00",
            ...
        },
        {
            "id": 705,
            "api_model": "articles",
            "api_link": "https://api.artic.edu/api/v1/articles/705",
            "title": "Hidden Materials in John Singer Sargent\u2019s Watercolors",
            "copy": " While John Singer Sargent is most widely known for his oil portraits of august men and women in fashionable interiors, he cultivated a love of painting outdoors from an early age. As a boy he recorded his family\u2019s European travels in sketchbooks, and as his talent and repertoire grew, he acquired numerous accoutrements such as portable easels, sketching umbrellas, rigid pads of paper, and compact palettes of watercolors that allowed him to paint multiple pictures during one outing, even in challenging conditions. In fact, Sargent was an official war artist for Britain during World War I and spent four months on the front painting and sketching.   A fellow war artist, Henry Tonks, painted this watercolor caricature of Sargent in 1918, depicting the artist clothed in army greens and shielded by a sketching umbrella that Sargent camouflaged for the purpose. The painting (held in the collection of the Museum of Fine Arts in Boston, and not a part of this exhibition) gives new meaning to challenging conditions\u2014and shows us a glimpse of Sargent\u2019s life apart from glamorous portraits.   In preparation for the current exhibition John Singer Sargent and Chicago\u2019s Gilded Age , Art Institute curators, conservators, and conservation scientists examined some of Sargent\u2019s paintings and investigated his less obvious materials, finding evidence that provides valuable insight into the artist\u2019s working process. A Newsworthy Surprise Sargent captured hundreds of landscapes in watercolor as he traveled across Europe and North America. In 1908 he painted Tarragona Terrace and Garden when he visited the eastern coast of Spain. Seated in the arcade of Tarragona\u2019s cathedral, Sargent made a quick study of its columns.   While he generally preferred to leave parts of the paper bare to delineate highlights, the foliage in the upper left corner of this picture was painted using a different technique. Here it appears that Sargent simply laid in a mass of greens and browns and then returned with an opaque, zinc white paint to create his highlights. In order to fully conceal the dark colors underneath, Sargent had to use thick dabs of white as if he were making a correction in oils. Sargent often made multiple paintings in one day and would interleave his paintings with sheets of newspaper for protection as he carried them. He did this with Tarragona Terrace and Garden , perhaps not realizing that the thickly applied areas of paint had not dried completely when he laid the newspaper on its surface. As an unintended consequence, fragments from a Spanish newspaper stuck to the painting, remnants of Sargent\u2019s panting process that survive today.   In normal light these tiny pieces of newsprint are barely noticeable, but they stand out in an infrared photograph, which makes some of the Spanish text almost legible.   Wax in a Watercolor Nearly 10 years after he painted Tarragona Terrace and Garden , Sargent made another series of stunning architectural studies while visiting his friends Charles and James Deering in Florida. Sargent was drawn to Vizcaya, the lavish estate that James had recently built, not least of all because it reminded him of the Italian landscapes and gardens that he loved to paint.   Analytical instruments in the conservation science lab at the Art Institute can help answer a lot of questions about artists\u2019 materials. In the case of this work, scientists sought more information about a soft, translucent material found in discrete areas on its surface. The material was analyzed and determined to be a wax, which Sargent used as a \u201cresist\u201d\u2014meaning that he marked the paper with a transparent material that would repel the water-based paint and leave highlights in the composition.   Analysis also revealed that the wax is a type called spermaceti, a product obtained from sperm whales and a major commercial product of the whaling industry. In Sargent\u2019s time this wax was commonly used to make candles. Finding it here helps to explain Sargent\u2019s process\u2014because spermaceti is softer than other common waxes such as beeswax, it would have been the logical choice for use as a drawing material. To learn more about Sargent\u2019s process and materials come visit John Singer Sargent and Chicago\u2019s Gilded Age in the Art Institute\u2019s Regenstein Hall through September 30, and check out the technical essay in the exhibition catalogue . \u2014Mary Broadway, associate conservator of prints and drawings ",
            "source_updated_at": "2018-08-08T16:04:54-05:00",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.8"
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
        "total": 405,
        "limit": 10,
        "offset": 0,
        "total_pages": 41,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "articles",
            "api_link": "https://api.artic.edu/api/v1/articles/1020",
            "id": 1020,
            "title": "Expanding Perspectives: Finding a Language for Beauty",
            "timestamp": "2023-03-22T23:01:37-05:00"
        },
        {
            "_score": 1,
            "api_model": "articles",
            "api_link": "https://api.artic.edu/api/v1/articles/1015",
            "id": 1015,
            "title": "Water, Lasers, and Wax: Conserving the Art Institute Lions",
            "timestamp": "2023-03-22T23:01:37-05:00"
        },
        {
            "_score": 1,
            "api_model": "articles",
            "api_link": "https://api.artic.edu/api/v1/articles/1019",
            "id": 1019,
            "title": "Photographer, Subject, Viewer: A Triangulated Relationship",
            "timestamp": "2023-03-22T23:01:37-05:00"
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
        "version": "1.8"
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
        "total": 30,
        "limit": 2,
        "offset": 0,
        "total_pages": 15,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/highlights?page=2&limit=2"
    },
    "data": [
        {
            "id": 35,
            "api_model": "highlights",
            "api_link": "https://api.artic.edu/api/v1/highlights/35",
            "title": "portraits",
            "copy": " But these works can do that and so much more. They can communicate and challenge ideas, values, and histories, and\u2014as seen on this tour\u2014they can take a variety of forms.   Jordan Casteel's Barack (2020) On view in Gallery 295   New York\u2013based Jordan Casteel is known for her expressive and sensitive depictions of people she encounters in her everyday sphere. Her portrait of the former president, Barack , was painted to accompany a 2020 interview in the Atlantic with Obama. As a painting of an iconic individual, Barack is somewhat of an outlier in her body of work. It is also, unlike her other portraits, based on a photograph that was not taken by the artist herself. And yet the painting process remained intimate and empathic: as Casteel remarked, \u201cThere is another level of \u2018knowing\u2019 that occurs when you take the time to paint the likeness of someone.\u201d (Fun fact: Chicago\u2019s Whitney Young High School on the Near West Side\u2014the school from which Michelle Obama graduated\u2014is named after Casteel\u2019s grandfather.)   Felix Gonzalez-Torres\u2019s Untitled (1989) On view in Gallery 293   This self-portrait by Cuban-American artist Felix Gonzalez-Torres, takes the form of words and dates that run across the top of the gallery walls close to the ceiling. Merging private histories with collective memory, the artist combined historical events and enigmatic personal milestones. Gonzalez-Torres first realized the work in 1989 and continued to change it with each iteration of the installation until his premature death in 1996. By the artist\u2019s instruction, the work can continue to shift in ongoing manifestations, anchored in its own history yet also perpetually changing.   Shepard Fairey's Barack Obama \u201cHope\u201d Poster (2008) On view in Gallery 285   Street artist, graphic designer, and activist Shepard Fairey created this visionary portrait of Barack Obama in 2008 and distributed the poster as a form of grassroots activism. Fairey created other versions of the stylized, stenciled design, with the words \u201cchange\u201d and \u201cprogress\u201d under Obama\u2019s upturned face and the Sol Sender\u2013 designed campaign logo, but the final \u201chope\u201d version became famous around the world when it was adopted as one of the official images of Obama\u2019s 2008 presidential campaign. New Yorker art critic Peter Schjeldahl called the poster \u201cthe most efficacious American political illustration since \u2018Uncle Sam Wants You.\u2019\u201d   Solidus (Coin) of Empress Irene (797\u2013802) On view in Gallery 153   Throughout history, coins have been one of the most prevalent mediums for portraits of powerful people. This rare example depicts Empress Irene, one of only three female rulers to hold sole power during the Byzantine Empire. Here Irene wears a crown with pendilia (long pearl adornments) and a jewel-encrusted loros (an imperial scarf) and holds in her hands the globus cruciger (cross-topped orb) and cross-topped staff\u2014all signs of male imperial power and dominion over the Christian world. Irene left her mark on the male-dominated world of Byzantine politics. She came to power by blinding and exiling her son and also reversed her husband\u2019s previous policies. And because of her gender, her reign was challenged by the Christian West when Charlemagne was crowned Holy Roman Emperor, starting a long-lasting controversy about rightful claims to imperial authority.   Elizabeth Catlett\u2019s Sharecropper (1952, printed 1970) On view in Gallery 263   Considered Elizabeth Catlett\u2019s most famous work, Sharecropper is not a portrait of a specific person but rather a heroic depiction of the everywoman sharecropper, an embodiment of the strength and persistence of Black tenant farmers in the American South. Sharecropping was a legacy of slavery that required farmers to pay for the land they rented with part of their crop; as a result, they often faced lifelong debt. Catlett made this print in Mexico at the Taller de Gr\u00e1fica Popular (People\u2019s Graphic Arts Workshop). Influenced by the spirit of activism at the workshop, she produced images of Sojourner Truth and Harriet Tubman as well as of everyday African American women persevering amid hardship.   Portrait Vessel of a Ruler , Moche (100 BCE/500 CE) On view in Gallery 136   Ceramic portrait vessels produced by artists of the Moche culture are the only discernible examples of portraiture, in a Euro-American sense, from the ancient Andes. This large and particularly fine example probably depicts an elite male, notable for his proud and commanding expression. His status is also likely articulated through his painted face and the headcloth and intricately woven band that he wears. Vessels such as this were often placed in burials as funerary offerings. They may also have been sent as emblems of royal authority, or even emissaries, to other elite individuals in nearby settlements.   Mbeudjang\u2019s Portrait of Metang, the 10th King of Batufam (1912\u201314) On view in Gallery 137   Carved by the eastern Bangwa artist Mbeudjang, this figure represents Metang, an early 20th-century ruler of Batufam, a kingdom in the Cameroon Grassfields. He wears a tall, pointed hat reserved for royals; is seated on a one-legged stool that evokes prestige; and holds a gourd vessel and a buffalo-horn drinking cup\u2014two of the most important regalia among kingdoms in this region. Though called \u201cportraits,\u201d commemorative figures like this are not intended to be lifelike renderings. Rather they are idealized images of kingship and served as valued partners to rulers in protecting their realm and its people.   Vincent van Gogh\u2019s Self-Portrait (1887) On view in Gallery 241   Over his short five-year career, Vincent van Gogh painted 35 self-portraits\u201424 of them, including this early example, during his two-year stay in Paris with his brother Theo. Here, Van Gogh used densely dabbed brushwork, an approach influenced by Georges Seurat\u2019s revolutionary technique in A Sunday on La Grande Jatte\u20141884 (on view Gallery in 240), to create a dynamic portrayal of himself. The dazzling array of dots and dashes in brilliant greens, blues, reds, and oranges is anchored by his intense gaze.   John Philip Simpson\u2019s The Captive Slave (Portrait of Ira Aldridge) (1827) On view in Gallery 220   This painting by John Philip Simpson is both a powerful abolitionist statement and a striking portrait of the celebrated Shakespearean actor Ira Aldridge. A freeborn American, Aldridge became the first Black man to play Othello on the London stage in 1833. Simpson\u2019s painting highlights Aldridge\u2019s gifts of expression as a tragic actor. He draws particular attention to Aldridge\u2019s upward gaze with a glint of white in the eye. His artful application of highlights is also noticeable on the shackles and Aldridge's fingernails.   Bisa Butler\u2019s The Safety Patrol (2018) On view in Gallery 215   Bisa Butler often finds inspiration for her portrait quilts in historical photographs. The spark for this work was found in an image taken in 1949 by Charles Harris that features seven school children, including a central safety patrol officer, waiting to cross the street. Butler\u2019s vibrant textile interpretation considers the potential of these children as future caretakers of the world. As the artist has noted, the letters OK printed diagonally on the safety officer\u2019s shirt and the yellow eye on his left side simultaneously ward off evil forces and forecast that the children are prepared for the future and will be alright. ",
            "source_updated_at": "2021-10-22T13:25:40-05:00",
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
        "version": "1.8"
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
            "api_link": "https://api.artic.edu/api/v1/highlights/37",
            "id": 37,
            "title": "making-a-difference-a-tour-for-families",
            "timestamp": "2023-03-22T23:30:37-05:00"
        },
        {
            "_score": 1,
            "api_model": "highlights",
            "api_link": "https://api.artic.edu/api/v1/highlights/52",
            "id": 52,
            "title": "chicagos-home-for-the-holidays",
            "timestamp": "2023-03-22T23:30:37-05:00"
        },
        {
            "_score": 1,
            "api_model": "highlights",
            "api_link": "https://api.artic.edu/api/v1/highlights/53",
            "id": 53,
            "title": "beauty-around-the-world",
            "timestamp": "2023-03-22T23:30:37-05:00"
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
        "version": "1.8"
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
        "version": "1.8"
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
        "version": "1.6"
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
        "total": 216,
        "limit": 2,
        "offset": 0,
        "total_pages": 108,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/generic-pages?page=2&limit=2"
    },
    "data": [
        {
            "id": 417,
            "api_model": "generic-pages",
            "api_link": "https://api.artic.edu/api/v1/generic-pages/417",
            "title": "Instagram",
            "web_url": "https://nocache.www.artic.edu/instagram",
            "copy": null,
            ...
        },
        {
            "id": 298,
            "api_model": "generic-pages",
            "api_link": "https://api.artic.edu/api/v1/generic-pages/298",
            "title": "George Eggers Papers",
            "web_url": "https://nocache.www.artic.edu/institutional-archives/former-directors-papers/george-eggers-papers",
            "copy": " Director, 1916\u20131921 8 linear inches 1 microfilm roll History George William Eggers (1883\u20131958) was born in Dunkirk, New York, and was trained as an artist at the Pratt Institute Art School. He came to Chicago in 1906 to serve on the faculty of the Chicago Normal College. He was hired as director of the Art Institute of Chicago in 1916 and served in that post until 1921, at which time he left to become director of the Denver Art Museum. Later positions included the directorship of the Worcester Art Museum and cChairman of the Art Department for the City Colleges of New York. While at the Art Institute of Chicago, George Eggers was responsible for creating the extension program, inaugurating the international water color exhibitions, and planning for the first permanent installation of the museum's collection. Scope and Content The records of George Eggers consist primarily of correspondence from his tenure as director, 1916\u20131921. No records from the first two years of his directorship have yet been located. The records begin in 1918 and continue through 1921. They contain such routine museum business as acquisitions, lecture programs, and exhibition arrangements. Correspondents include artists, donors, dealers, scholars, and staff from other art institutions. ",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.8"
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
        "total": 224,
        "limit": 10,
        "offset": 0,
        "total_pages": 23,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "generic-pages",
            "api_link": "https://api.artic.edu/api/v1/generic-pages/397",
            "id": 397,
            "title": "Predoctoral Fellows and Interns",
            "timestamp": "2023-03-22T23:30:58-05:00"
        },
        {
            "_score": 1,
            "api_model": "generic-pages",
            "api_link": "https://api.artic.edu/api/v1/generic-pages/265",
            "id": 265,
            "title": "Photograph Conservation",
            "timestamp": "2023-03-22T23:30:58-05:00"
        },
        {
            "_score": 1,
            "api_model": "generic-pages",
            "api_link": "https://api.artic.edu/api/v1/generic-pages/269",
            "id": 269,
            "title": "Time-Based Media Conservation",
            "timestamp": "2023-03-22T23:30:58-05:00"
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
        "copy": " RESERVE ONLINE IN ADVANCE Free Winter Weekdays 2023 for Illinois Residents Admission is free for Illinois residents on weekdays (Mondays, Thursdays, and Fridays) January 9\u2013March 24, 2023. If you reserve your free tickets online in advance , your resident status will be verified using the zip code associated with the billing address provided. If you're unable to reserve tickets in advance, please stop by the admissions desks on the day of your visit for assistance.   NO ADVANCE TICKET REQUIRED The following groups are invited to visit our galleries at no cost every day\u2014even when museum admission tickets are sold out. In order to receive your free admission benefits, simply show the corresponding identification at the admissions desk in either museum lobby. Free admission benefits are not single use\u2014you are welcome to use them any time you would like to visit. Kids under 14 Admission is always free for children under 14. These free tickets are available online as well as on-site at the admissions counters. Chicago Teens Museum admission is free for Chicago teens under the age of 18, thanks to the extraordinary generosity of Glenn and Claire Swogger and the Redbud Foundation. See more opportunities and resources for teens . Active-Duty Military As part of the Blue Star Museums program, active-duty service members receive free admission all year long. Plus, from Armed Forces Day through Labor Day, we also welcome service members and their households. Please bring your active-duty military ID to the admissions counter to receive this benefit. LINK and WIC Cardholders As part of Museums for All, LINK and WIC cardholders and anyone in their households receive free general admission to the museum and all ticketed special exhibitions. Simply present your card along with a valid photo ID. Illinois Educators Free admission is available to current Illinois educators, including pre-K\u201312 teachers, teaching artists working in schools, and homeschool parents. Educators can register online to receive a voucher for a complimentary ticket to the museum. This voucher must be presented\u2014as a printed document or on a smartphone\u2014with a valid educator ID at one of the museum\u2019s admission counters. Learn more about requesting complimentary educator admission. Kids Museum Passport Sponsored by the 15 Museums Work for Chicago institutions, this program allows individuals with a Chicago Public Library card to check out a pass for free general admission to the Art Institute. Please note the following parameters for use of the Kids Museum Passport: Each pass admits a maximum of four people for general admission\u2014at least one child under the age of 18 and a maximum of two adults. Ticketed exhibitions and activities are not included and must be purchased separately. University Partners Students of colleges and universities in the University Partner Program are entitled to free general and special exhibition admission by showing a valid student ID at the ticket counter. Check the full list of partnering colleges and universities . Corporate Partners Employees of certain companies in the Corporate Partner Program are entitled to free general and special exhibition admission by showing proof of employment at the ticket counter. Learn more about the Corporate Partner Program . Check the full list of Corporate Partner companies whose employees are entitled to free admission.   More Corporate Partner Opportunities ",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.8"
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
        "version": "1.8"
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
        "total": 289,
        "limit": 10,
        "offset": 0,
        "total_pages": 29,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "press-releases",
            "api_link": "https://api.artic.edu/api/v1/press-releases/294",
            "id": 294,
            "title": "Art Institute of Chicago Appoints Norissa Bailey as Senior Vice President People and Culture",
            "timestamp": "2023-03-22T23:31:28-05:00"
        },
        {
            "_score": 1,
            "api_model": "press-releases",
            "api_link": "https://api.artic.edu/api/v1/press-releases/293",
            "id": 293,
            "title": "Irene Sunwoo to Join Art Institute of Chicago as John H. Bryan Chair of Architecture and Design",
            "timestamp": "2023-03-22T23:31:28-05:00"
        },
        {
            "_score": 1,
            "api_model": "press-releases",
            "api_link": "https://api.artic.edu/api/v1/press-releases/287",
            "id": 287,
            "title": "Malangatana: Mozambique Modern",
            "timestamp": "2023-03-22T23:31:28-05:00"
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
        "version": "1.8"
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
        "version": "1.8"
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
            "timestamp": "2023-03-22T23:32:12-05:00"
        },
        {
            "_score": 1,
            "api_model": "educator-resources",
            "api_link": "https://api.artic.edu/api/v1/educator-resources/120",
            "id": 120,
            "title": "Virtual Lesson Plan: Cobalt and the Color Blue",
            "timestamp": "2023-03-22T23:32:12-05:00"
        },
        {
            "_score": 1,
            "api_model": "educator-resources",
            "api_link": "https://api.artic.edu/api/v1/educator-resources/119",
            "id": 119,
            "title": "Virtual Lesson Plan: Following the Phoenix",
            "timestamp": "2023-03-22T23:32:12-05:00"
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
        "version": "1.8"
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
        "total": 19,
        "limit": 2,
        "offset": 0,
        "total_pages": 10,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/digital-catalogs?page=2&limit=2"
    },
    "data": [
        {
            "id": 31,
            "api_model": "digital-catalogs",
            "api_link": "https://api.artic.edu/api/v1/digital-catalogs/31",
            "title": "Matisse Paintings, Works on Paper, Sculpture, and Textiles at the Art Institute of Chicago",
            "web_url": "https://nocache.www.artic.edu/digital-publications/31/matisse-at-the-art-institute-of-chicago",
            "copy": " Matisse: Paintings, Works on Paper, Sculpture, and Textiles at the Art Institute of Chicago highlights the ten paintings, five bronzes, forty-one works on paper, and one textile by Henri Matisse in the museum\u2019s collection. These extraordinary objects narrate the numerous stylistic and thematic paths the artist explored and present a comprehensive story of his entire career. Highlights include an extended entry on Bathers by a River , in which our curatorial and conservation colleagues use state-of-the-art imaging to \u201cexcavate\u201d the canvas, charting how the artist\u2019s radical changes to composition and palette marked a creative evolution at a pivotal moment in his career.   Edited by Stephanie D\u2019Alessandro, with entries by Kristi Dahm, Stephanie D\u2019Alessandro, Kathleen Kiefer, Kristin Hoermann Lister, Katja Rivera, Brandon Ruud, Marin Sarv\u00e9-Tarr, Suzanne Schnepp, Mel Becker Solomon, Martha Tedeschi, Kirk Vuillemot, Daniel S. Walker, and Debora Wood.   The Andrew W. Mellon Foundation provided essential funding and ongoing support for the project. A generous grant from the Grainger Foundation supported the purchase of equipment used for the technical analysis. Jim Ziebart contributed equipment. ",
            ...
        },
        {
            "id": 30,
            "api_model": "digital-catalogs",
            "api_link": "https://api.artic.edu/api/v1/digital-catalogs/30",
            "title": "Ivan Albright Paintings at the Art Institute of Chicago",
            "web_url": "https://nocache.www.artic.edu/digital-publications/30/ivan-albright-paintings-at-the-art-institute-of-chicago",
            "copy": " Renowned as the \u201cmaster of the macabre,\u201d Chicago native Ivan Albright (1897\u20131983) is famous for richly detailed paintings of ghoulish subjects including Into the World There Came a Soul Called Ida and Picture of Dorian Gray . This catalogue brings together fresh perspectives on the artist: professor emerita of art history Sarah Burns reveals Albright\u2019s fascination with popular culture, and curator John P. Murphy explores his philosophy of ugliness. Painting conservator Kelly Keegan examines the artist\u2019s process and details how he achieved his unique painterly effects. A plate section of the 44 oil paintings in the collection of the Art Institute of Chicago, reproduced in high resolution to enable close looking, documents Albright\u2019s portrayal of the body\u2019s vulnerability to age, disease, and death. This includes a haunting series of self-portraits, one of which the artist made in his hospital bed three days before he died.   Edited by Sarah Kelly Oehler, with an introduction by Sarah Kelly Oehler and essays by Sarah Burns, Kelly Keegan, and John P. Murphy   This publication follows the exhibition Flesh: Ivan Albright at the Art Institute of Chicago (May 4\u2013Aug. 4, 2018).   The publication is free and has received generous funding from the Northwestern University Department of Art History Warnock Publication Fund. ",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.8"
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
        "total": 19,
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
            "timestamp": "2023-03-22T23:32:24-05:00"
        },
        {
            "_score": 1,
            "api_model": "digital-catalogs",
            "api_link": "https://api.artic.edu/api/v1/digital-catalogs/34",
            "id": 34,
            "title": "Malangatana: Mozambique Modern",
            "timestamp": "2023-03-22T23:32:24-05:00"
        },
        {
            "_score": 1,
            "api_model": "digital-catalogs",
            "api_link": "https://api.artic.edu/api/v1/digital-catalogs/33",
            "id": 33,
            "title": "The Lithographs of James McNeill Whistler: The Digital Edition",
            "timestamp": "2023-03-22T23:32:24-05:00"
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
        "version": "1.8"
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
        "version": "1.8"
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
        "total": 9,
        "limit": 10,
        "offset": 0,
        "total_pages": 1,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "digital-publication-sections",
            "api_link": "https://api.artic.edu/api/v1/digital-publication-sections/24",
            "id": 24,
            "title": "Digital Methods for Inquiry into the Eurocentric Structure of Architectural History Surveys",
            "timestamp": "2023-04-07T11:01:53-05:00"
        },
        {
            "_score": 1,
            "api_model": "digital-publication-sections",
            "api_link": "https://api.artic.edu/api/v1/digital-publication-sections/22",
            "id": 22,
            "title": "Crowdsourcing Metadata in Museums: Expanding Descriptions, Access, Transparency, and Experience",
            "timestamp": "2023-04-07T11:01:53-05:00"
        },
        {
            "_score": 1,
            "api_model": "digital-publication-sections",
            "api_link": "https://api.artic.edu/api/v1/digital-publication-sections/29",
            "id": 29,
            "title": "Credits",
            "timestamp": "2023-04-07T11:01:53-05:00"
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
        "website_url": "http://www.artic.edu"
    }
}
```
:::

##### `GET /digital-publication-sections/{id}`

A single digital-publication-section by the given identifier.


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
        "version": "1.8"
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
        "version": "1.6"
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


