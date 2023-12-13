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
        "total": 122928,
        "limit": 2,
        "offset": 0,
        "total_pages": 61464,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/artworks?page=2&limit=2"
    },
    "data": [
        {
            "id": 148414,
            "api_model": "artworks",
            "api_link": "https://api.artic.edu/api/v1/artworks/148414",
            "is_boosted": false,
            "title": "The Glass of Beer",
            "alt_titles": null,
            ...
        },
        {
            "id": 20522,
            "api_model": "artworks",
            "api_link": "https://api.artic.edu/api/v1/artworks/20522",
            "is_boosted": false,
            "title": "Jester",
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
        "version": "1.9"
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
        "total": 299,
        "limit": 10,
        "offset": 0,
        "total_pages": 30,
        "current_page": 1
    },
    "data": [
        {
            "_score": 205.29251,
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
            "timestamp": "2023-12-12T23:34:18-06:00"
        },
        {
            "_score": 190.2042,
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
            "timestamp": "2023-12-12T23:32:26-06:00"
        },
        {
            "_score": 188.1074,
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
            "timestamp": "2023-12-12T23:34:17-06:00"
        }
    ],
    "info": {
        "license_text": "The `description` field in this response is licensed under a Creative Commons Attribution 4.0 Generic License (CC-By) and the Terms and Conditions of artic.edu. All other data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.9"
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
        "version": "1.9"
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
        "total": 15267,
        "limit": 2,
        "offset": 0,
        "total_pages": 7634,
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
        "version": "1.9"
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
        "total": 15303,
        "limit": 10,
        "offset": 0,
        "total_pages": 1531,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "agents",
            "api_link": "https://api.artic.edu/api/v1/agents/48322",
            "id": 48322,
            "title": "Walter W. Ahlschlager",
            "timestamp": "2023-12-13T12:01:25-06:00"
        },
        {
            "_score": 1,
            "api_model": "agents",
            "api_link": "https://api.artic.edu/api/v1/agents/48361",
            "id": 48361,
            "title": "Fritz Albert",
            "timestamp": "2023-12-13T12:01:25-06:00"
        },
        {
            "_score": 1,
            "api_model": "agents",
            "api_link": "https://api.artic.edu/api/v1/agents/48419",
            "id": 48419,
            "title": "William George Allan",
            "timestamp": "2023-12-13T12:01:25-06:00"
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.9"
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
        "version": "1.9"
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
        "total": 4015,
        "limit": 2,
        "offset": 0,
        "total_pages": 2008,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/places?page=2&limit=2"
    },
    "data": [
        {
            "id": 31300,
            "api_model": "places",
            "api_link": "https://api.artic.edu/api/v1/places/31300",
            "title": "Benicia",
            "tgn_id": null,
            "source_updated_at": "2023-09-15T09:03:53-05:00",
            ...
        },
        {
            "id": -2147479935,
            "api_model": "places",
            "api_link": "https://api.artic.edu/api/v1/places/-2147479935",
            "title": "Capistrano Beach",
            "tgn_id": null,
            "source_updated_at": "2023-09-15T05:57:47-05:00",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Attribution 4.0 Generic License (CC-By) and the Terms and Conditions of artic.edu. Contains information from the J. Paul Getty Trust, Getty Research Institute, the Getty Thesaurus of Geographic Names, which is made available under the ODC Attribution License.",
        "license_links": [
            "https://creativecommons.org/licenses/by/4.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.9"
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
        "total": 4021,
        "limit": 10,
        "offset": 0,
        "total_pages": 403,
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
            "https://creativecommons.org/licenses/by/4.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.9"
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
        "source_updated_at": "1976-09-02T06:20:00-05:00",
        ...
    },
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Attribution 4.0 Generic License (CC-By) and the Terms and Conditions of artic.edu. Contains information from the J. Paul Getty Trust, Getty Research Institute, the Getty Thesaurus of Geographic Names, which is made available under the ODC Attribution License.",
        "license_links": [
            "https://creativecommons.org/licenses/by/4.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.9"
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
            "id": 25238,
            "api_model": "galleries",
            "api_link": "https://api.artic.edu/api/v1/galleries/25238",
            "title": "Bluhm Family Terrace",
            "latitude": 41.88047341848,
            "longitude": -87.622294127941,
            ...
        },
        {
            "id": 2147475440,
            "api_model": "galleries",
            "api_link": "https://api.artic.edu/api/v1/galleries/2147475440",
            "title": "Gallery 136",
            "latitude": 41.878945382673,
            "longitude": -87.623231840441,
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.9"
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
        "total": 72,
        "limit": 10,
        "offset": 0,
        "total_pages": 8,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "galleries",
            "api_link": "https://api.artic.edu/api/v1/galleries/2147483616",
            "id": 2147483616,
            "title": "Gallery 217",
            "timestamp": "2023-06-29T11:12:37-05:00"
        },
        {
            "_score": 1,
            "api_model": "galleries",
            "api_link": "https://api.artic.edu/api/v1/galleries/2147479700",
            "id": 2147479700,
            "title": "Gallery 246",
            "timestamp": "2023-05-26T11:47:46-05:00"
        },
        {
            "_score": 1,
            "api_model": "galleries",
            "api_link": "https://api.artic.edu/api/v1/galleries/2147474874",
            "id": 2147474874,
            "title": "Gallery 135",
            "timestamp": "2023-06-03T00:17:48-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.9"
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
        "version": "1.9"
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
        "total": 6194,
        "limit": 2,
        "offset": 0,
        "total_pages": 3097,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/exhibitions?page=2&limit=2"
    },
    "data": [
        {
            "id": 9062,
            "api_model": "exhibitions",
            "api_link": "https://api.artic.edu/api/v1/exhibitions/9062",
            "title": "Vivian Suter: el bosque interior",
            "is_featured": false,
            "position": -1,
            ...
        },
        {
            "id": 9639,
            "api_model": "exhibitions",
            "api_link": "https://api.artic.edu/api/v1/exhibitions/9639",
            "title": "Van Gogh and the Avant-Garde: The Modern Landscape",
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
        "version": "1.9"
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
        "total": 6470,
        "limit": 10,
        "offset": 0,
        "total_pages": 647,
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
        "version": "1.9"
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
        "version": "1.9"
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
            "source_updated_at": "2019-05-08T13:31:54-05:00",
            "updated_at": "2019-05-09T12:01:08-05:00",
            ...
        },
        {
            "id": 28,
            "api_model": "agent-types",
            "api_link": "https://api.artic.edu/api/v1/agent-types/28",
            "title": "Nonprofit",
            "source_updated_at": "2019-05-08T13:31:54-05:00",
            "updated_at": "2019-05-09T12:01:08-05:00",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.9"
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
        "source_updated_at": "2019-05-08T13:31:53-05:00",
        "updated_at": "2019-05-09T12:01:08-05:00",
        ...
    },
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.9"
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
        "total": 165,
        "limit": 2,
        "offset": 0,
        "total_pages": 83,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/agent-roles?page=2&limit=2"
    },
    "data": [
        {
            "id": 575,
            "api_model": "agent-roles",
            "api_link": "https://api.artic.edu/api/v1/agent-roles/575",
            "title": "Ceramist",
            "source_updated_at": "2023-05-04T11:32:56-05:00",
            "updated_at": "2023-05-04T11:37:23-05:00",
            ...
        },
        {
            "id": 434,
            "api_model": "agent-roles",
            "api_link": "https://api.artic.edu/api/v1/agent-roles/434",
            "title": "Craftsperson",
            "source_updated_at": "2020-06-24T11:02:14-05:00",
            "updated_at": "2020-06-24T16:00:33-05:00",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.9"
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
        "source_updated_at": "2019-05-08T14:05:07-05:00",
        "updated_at": "2019-05-09T12:01:07-05:00",
        ...
    },
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.9"
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
            "id": 8,
            "api_model": "artwork-place-qualifiers",
            "api_link": "https://api.artic.edu/api/v1/artwork-place-qualifiers/8",
            "title": "Artist's nationality:",
            "source_updated_at": "2023-06-30T10:23:03-05:00",
            "updated_at": "2023-06-30T10:27:37-05:00",
            ...
        },
        {
            "id": 54,
            "api_model": "artwork-place-qualifiers",
            "api_link": "https://api.artic.edu/api/v1/artwork-place-qualifiers/54",
            "title": "Artist's culture:",
            "source_updated_at": "2020-04-14T04:36:05-05:00",
            "updated_at": "2020-04-14T08:46:00-05:00",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.9"
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
        "source_updated_at": "2019-05-08T13:00:18-05:00",
        "updated_at": "2019-05-09T12:01:07-05:00",
        ...
    },
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.9"
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
            "source_updated_at": "2021-07-12T11:18:20-05:00",
            "updated_at": "2021-07-12T11:20:41-05:00",
            ...
        },
        {
            "id": 62,
            "api_model": "artwork-date-qualifiers",
            "api_link": "https://api.artic.edu/api/v1/artwork-date-qualifiers/62",
            "title": "Manufactured",
            "source_updated_at": "2019-05-08T16:59:24-05:00",
            "updated_at": "2019-05-09T12:01:07-05:00",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.9"
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
        "source_updated_at": "2019-05-08T16:59:23-05:00",
        "updated_at": "2019-05-09T12:01:07-05:00",
        ...
    },
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.9"
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
            "source_updated_at": "2019-05-08T14:03:58-05:00",
            ...
        },
        {
            "id": 23,
            "api_model": "artwork-types",
            "api_link": "https://api.artic.edu/api/v1/artwork-types/23",
            "title": "Vessel",
            "aat_id": 300193015,
            "source_updated_at": "2019-05-08T14:03:58-05:00",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.9"
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
        "source_updated_at": "2019-05-08T14:03:58-05:00",
        ...
    },
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.9"
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
        "total": 9832,
        "limit": 2,
        "offset": 0,
        "total_pages": 4916,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/category-terms?page=2&limit=2"
    },
    "data": [
        {
            "id": "TM-15481",
            "api_model": "category-terms",
            "api_link": "https://api.artic.edu/api/v1/category-terms/TM-15481",
            "title": "Artist's Book",
            "subtype": "classification",
            "parent_id": null,
            ...
        },
        {
            "id": "TM-15480",
            "api_model": "category-terms",
            "api_link": "https://api.artic.edu/api/v1/category-terms/TM-15480",
            "title": "eye-dazzler",
            "subtype": "style",
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
        "version": "1.9"
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
        "total": 9854,
        "limit": 10,
        "offset": 0,
        "total_pages": 986,
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
        "version": "1.9"
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
        "version": "1.9"
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
        "total": 159618,
        "limit": 2,
        "offset": 0,
        "total_pages": 79809,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/images?page=2&limit=2"
    },
    "data": [
        {
            "id": "47dc7c68-1d02-cc0a-70c7-1e34da404b15",
            "lake_guid": "47dc7c68-1d02-cc0a-70c7-1e34da404b15",
            "api_model": "images",
            "api_link": "https://api.artic.edu/api/v1/images/47dc7c68-1d02-cc0a-70c7-1e34da404b15",
            "title": "29444",
            "type": "image",
            ...
        },
        {
            "id": "06d7c448-326e-bbc9-ecb7-cfa4d419a025",
            "lake_guid": "06d7c448-326e-bbc9-ecb7-cfa4d419a025",
            "api_model": "images",
            "api_link": "https://api.artic.edu/api/v1/images/06d7c448-326e-bbc9-ecb7-cfa4d419a025",
            "title": "28072",
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
        "version": "1.9"
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
        "total": 161399,
        "limit": 10,
        "offset": 0,
        "total_pages": 16140,
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
        "version": "1.9"
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
        "version": "1.9"
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
        "version": "1.9"
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
        "version": "1.9"
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
        "version": "1.9"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "total": 807,
        "limit": 2,
        "offset": 0,
        "total_pages": 404,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/sounds?page=2&limit=2"
    },
    "data": [
        {
            "id": "2e40d12a-33dd-c2c5-e839-6c94ca1ace49",
            "lake_guid": "2e40d12a-33dd-c2c5-e839-6c94ca1ace49",
            "api_model": "sounds",
            "api_link": "https://api.artic.edu/api/v1/sounds/2e40d12a-33dd-c2c5-e839-6c94ca1ace49",
            "title": "Audio stop 602.mp3",
            "type": "sound",
            ...
        },
        {
            "id": "3d4e8b5f-b807-5e6a-a64f-821d338dea44",
            "lake_guid": "3d4e8b5f-b807-5e6a-a64f-821d338dea44",
            "api_model": "sounds",
            "api_link": "https://api.artic.edu/api/v1/sounds/3d4e8b5f-b807-5e6a-a64f-821d338dea44",
            "title": "Audio stop 701.mp3",
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
        "version": "1.9"
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
        "version": "1.9"
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
        "version": "1.9"
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
            "id": "7d3c6f32-7159-e58d-adcc-42a3015f5e98",
            "lake_guid": "7d3c6f32-7159-e58d-adcc-42a3015f5e98",
            "api_model": "texts",
            "api_link": "https://api.artic.edu/api/v1/texts/7d3c6f32-7159-e58d-adcc-42a3015f5e98",
            "title": "Book: The Miracles of Mary: A Seventeenth-Century Ethiopian Manuscript",
            "type": "text",
            ...
        },
        {
            "id": "92a80080-7a67-c6aa-5fd8-1a294240f49c",
            "lake_guid": "92a80080-7a67-c6aa-5fd8-1a294240f49c",
            "api_model": "texts",
            "api_link": "https://api.artic.edu/api/v1/texts/92a80080-7a67-c6aa-5fd8-1a294240f49c",
            "title": "Art + Science",
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
        "version": "1.9"
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
        "version": "1.9"
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
        "version": "1.9"
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
        "total": 1412,
        "limit": 2,
        "offset": 0,
        "total_pages": 706,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/products?page=2&limit=2"
    },
    "data": [
        {
            "id": 289074,
            "api_model": "products",
            "api_link": "https://api.artic.edu/api/v1/products/289074",
            "title": "Willard Frederic Elms Art Institute by the Elevated Lines Poster",
            "external_sku": 289074,
            "image_url": "https://shop-images.imgix.net289074_2.jpg",
            ...
        },
        {
            "id": 288988,
            "api_model": "products",
            "api_link": "https://api.artic.edu/api/v1/products/288988",
            "title": "Isabelle Gougenheim Parfum Scarf",
            "external_sku": 288988,
            "image_url": "https://shop-images.imgix.net288988_2.jpg",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.9"
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
        "total": 1505,
        "limit": 10,
        "offset": 0,
        "total_pages": 151,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "products",
            "api_link": "https://api.artic.edu/api/v1/products/245285",
            "id": "245285",
            "title": "Georges Seurat A Sunday on La Grande Jatte\u20141884 Tote",
            "timestamp": "2023-12-12T23:10:02-06:00"
        },
        {
            "_score": 1,
            "api_model": "products",
            "api_link": "https://api.artic.edu/api/v1/products/245287",
            "id": "245287",
            "title": "Georges Seurat A Sunday on La Grande Jatte\u20141884 Umbrella",
            "timestamp": "2023-12-12T23:10:02-06:00"
        },
        {
            "_score": 1,
            "api_model": "products",
            "api_link": "https://api.artic.edu/api/v1/products/245313",
            "id": "245313",
            "title": "The Devil in the White City",
            "timestamp": "2023-12-12T23:10:02-06:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.9"
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
        "version": "1.9"
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
        "version": "1.9"
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
        "total": 24,
        "limit": 10,
        "offset": 0,
        "total_pages": 3,
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
        "version": "1.9"
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
        "version": "1.9"
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
        "total": 879,
        "limit": 2,
        "offset": 0,
        "total_pages": 440,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/mobile-sounds?page=2&limit=2"
    },
    "data": [
        {
            "id": 5468,
            "api_model": "mobile-sounds",
            "api_link": "https://api.artic.edu/api/v1/mobile-sounds/5468",
            "title": "Mutlisensory Gallery: Intro (Multisensory Tour)",
            "web_url": "https://www.artic.edu/mobile/audio/Copy%20of%20Multi-Sensory%20Gallery%20Intro.mp3",
            "transcript": "<p>Speaker 1<br>Hey there. I'm Andrew.</p>\n<p>Speaker 2<br>And I'm Melissa.</p>\n<p>Speaker 1<br>And we're so excited that you decided to check out the multi-sensory gallery at the Art Institute.</p>\n<p>Speaker 2<br>And that you're listening to the audio tour.</p>\n<p>Speaker 1<br>Melissa, that word multisensory is kind of a mouthful. What does it mean?</p>\n<p>Speaker 2<br>Well, we know about the human senses. You know, sight, hearing, touch, taste, smell. Most of the time we're using them in combinations. Hearing and touching at the same time, for instance. That's multi-sensory. And artworks are something where we use all of our senses to take them in.</p>\n<p>Speaker 1<br>Wait hold on. Last time I checked, we weren't supposed to touch things at the museum, let alone taste or smell them.</p>\n<p>Speaker 2<br>You're right about that. We shouldn't touch things, and we definitely shouldn't taste anything in the galleries because it'll damage the works of art. But here in the multi-sensory gallery, we've got really cool things that you can touch and tap to see how they might feel and sound. And you can imagine how they might taste and smell too.</p>\n<p>Speaker 1<br>You know, artists also use their senses when they're creating works of art, choosing a block of wood for carving or feeling the heat of a super hot furnace for melting metal, turning greasy wool into yarn, or digging into a block of marble. That's all really physical work that requires a lot of coordination between the mind and the body.</p>\n<p>Speaker 2<br>That's right. And we're going to meet four artists and hear about how they use their materials and their tools to create the works that are hanging in this gallery.</p>\n<p>Speaker 1<br>You can, of course, listen as you look, but we also encourage you to run your hand over the surface of each of the works of art as you hear how they were made.</p>\n<p>Speaker 2<br>We'll let you know where you can find other works of art made out of these materials in the museums galleries. But remember, this is the only place we're allowed to touch. The two of us will be in so much trouble if everyone starts touching things out there.</p>\n<p>Speaker 1<br>Yeah, no touching and definitely no licking.</p>\n<p>Speaker 2<br>Yeah. Andrew, I really don't think that's on anyone's mind.</p>\n<p>Speaker 1<br>I know. I just, you know, need to remind myself sometimes. All right. I think that about covers it. Get your senses ready and we'll see what the first artwork.</p>\n",
            ...
        },
        {
            "id": 5285,
            "api_model": "mobile-sounds",
            "api_link": "https://api.artic.edu/api/v1/mobile-sounds/5285",
            "title": "T51_07_255294_UrhoboMotherChildFigure_V4.mp3",
            "web_url": "https://www.artic.edu/mobile/audio/T51_07_255294_UrhoboMotherChildFigure_V4.mp3",
            "transcript": "<p>Curatorial fellow Janet Purdy.</p>\n<p>Janet Purdy</p>\n<p>The most important thing about this figure is that it depicts a mother. And in Urhobo culture, it's a representation of maternity and women and the role they play in society.</p>\n<p>Perkins Foss</p>\n<p>She is a figure known as Edjo and she would be one of a group of individuals carved. And of course, that would be in a shrine that is commemorating, some would say, founding heroes, the founding family that settled an Urhobo community. Hi, I'm Perkins Foss and I am a retired associate professor of the history of art at Penn State University. Her stature as a senior titled individual is the ring, I guess we could say of... it's beads. It goes from shoulder, it continues down to her breast and up the other side. She's got a coiffure, only fragments of which are still left. That is a number of vertical tufts that would be tied off in such a way that it's almost, in a European sense, crown-like.</p>\n<p>Janet Purdy</p>\n<p>One of the important things to look at this is that the representation of the jewelry is showing different fashions of different times, and so these kind of figures would differ across different regions in the Niger delta. They would, over time, their adornment would change, and while we can't really see this woman's hairstyle, it would've been a very fashionable, really elaborate hairstyle represented at the time that this was carved.</p>\n<p>One of my favorite quotes is from a prolific Urhobo artist. His name is Bruce Onobrakpeya, and he's one of the biggest print makers in all of Africa, not just West Africa. And one of the things that he says about Urhobo art in general is, his quote is that &quot;art itself is the reflection of the life of people&quot;, and he's trying to carry that forward in whatever art form. He makes prints, but his father was a carver, so he's trying to make sure that whatever art forms that Urhobo people continue to create, that they reflect their life and culture and spirituality.</p>\n",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.9"
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
        "total": 937,
        "limit": 10,
        "offset": 0,
        "total_pages": 94,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "mobile-sounds",
            "api_link": "https://api.artic.edu/api/v1/mobile-sounds/226",
            "id": 226,
            "title": "Justus Sustermans",
            "timestamp": "2023-12-12T23:05:03-06:00"
        },
        {
            "_score": 1,
            "api_model": "mobile-sounds",
            "api_link": "https://api.artic.edu/api/v1/mobile-sounds/227",
            "id": 227,
            "title": "Self-Portrait, Etching at a Window",
            "timestamp": "2023-12-12T23:05:03-06:00"
        },
        {
            "_score": 1,
            "api_model": "mobile-sounds",
            "api_link": "https://api.artic.edu/api/v1/mobile-sounds/235",
            "id": 235,
            "title": "Self-Portrait, Anthony Van Dyck",
            "timestamp": "2023-12-12T23:05:03-06:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.9"
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
        "version": "1.9"
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
        "version": "1.9"
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
            "timestamp": "2023-12-01T03:05:02-06:00"
        },
        {
            "_score": 1,
            "api_model": "publications",
            "api_link": "https://api.artic.edu/api/v1/publications/7",
            "id": 7,
            "title": "Pissarro Paintings and Works on Paper at the Art Institute of Chicago",
            "timestamp": "2023-12-01T03:05:02-06:00"
        },
        {
            "_score": 1,
            "api_model": "publications",
            "api_link": "https://api.artic.edu/api/v1/publications/12",
            "id": 12,
            "title": "The Modern Series at the Art Institute of Chicago",
            "timestamp": "2023-12-01T03:05:02-06:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.9"
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
        "version": "1.9"
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
        "version": "1.9"
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
            "api_link": "https://api.artic.edu/api/v1/sections/543965",
            "id": 543965,
            "title": "Cats. 75\u201377 \u00a0Three Early Drinking Bowls",
            "timestamp": "2023-12-01T03:05:19-06:00"
        },
        {
            "_score": 1,
            "api_model": "sections",
            "api_link": "https://api.artic.edu/api/v1/sections/539799",
            "id": 539799,
            "title": "Glass Artworks",
            "timestamp": "2023-12-01T03:05:19-06:00"
        },
        {
            "_score": 1,
            "api_model": "sections",
            "api_link": "https://api.artic.edu/api/v1/sections/538795",
            "id": 538795,
            "title": "Note to the Reader",
            "timestamp": "2023-12-01T03:05:19-06:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.9"
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
        "version": "1.9"
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
        "version": "1.9"
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
            "api_link": "https://api.artic.edu/api/v1/sites/1",
            "id": 1,
            "title": "Chicago Architecture: Ten Visions",
            "timestamp": "2023-12-01T03:00:04-06:00"
        },
        {
            "_score": 1,
            "api_model": "sites",
            "api_link": "https://api.artic.edu/api/v1/sites/2",
            "id": 2,
            "title": "American Perspectives: A yearlong celebration of American artistic vision",
            "timestamp": "2023-12-01T03:00:04-06:00"
        },
        {
            "_score": 1,
            "api_model": "sites",
            "api_link": "https://api.artic.edu/api/v1/sites/3",
            "id": 3,
            "title": "Curious Corner",
            "timestamp": "2023-12-01T03:00:04-06:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.9"
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
        "version": "1.9"
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
        "total": 2337,
        "limit": 2,
        "offset": 0,
        "total_pages": 1169,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/events?page=2&limit=2"
    },
    "data": [
        {
            "id": 5776,
            "api_model": "events",
            "api_link": "https://api.artic.edu/api/v1/events/5776",
            "title": "Member Lecture: Camille Claudel",
            "title_display": "Member Lecture: <i>Camille Claudel</i>",
            "image_url": "https://artic-web.imgix.net/7dfe2288-7828-4ed3-b362-cb9ddebcdc2c/gm_37199601_Original_Image2ClaudelImageBank-Web72ppi%2C2000px%2CsRGB%2CJPEG.jpg?rect=0%2C279%2C1553%2C874&auto=format%2Ccompress&q=80&fit=crop&crop=faces%2Ccenter&w=1200&h=675",
            ...
        },
        {
            "id": 5756,
            "api_model": "events",
            "api_link": "https://api.artic.edu/api/v1/events/5756",
            "title": "Conversation: Remedios Varo\u2014A Taxonomy of Techniques",
            "title_display": "Conversation: Remedios Varo\u2014A Taxonomy of Techniques",
            "image_url": "https://artic-web.imgix.net/20cb13a8-fa8f-4852-8bb0-79e3c34116d2/Capture.JPG?rect=0%2C0%2C1521%2C856&auto=format%2Ccompress&q=80&fit=crop&crop=faces%2Ccenter&w=1200&h=675",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.9"
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
        "total": 2368,
        "limit": 10,
        "offset": 0,
        "total_pages": 237,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "events",
            "api_link": "https://api.artic.edu/api/v1/events/4845",
            "id": 4845,
            "title": "Express Talk: The Fantasy of Place",
            "timestamp": "2023-12-12T23:39:30-06:00"
        },
        {
            "_score": 1,
            "api_model": "events",
            "api_link": "https://api.artic.edu/api/v1/events/4844",
            "id": 4844,
            "title": "Gallery Talk: Coloring the Past",
            "timestamp": "2023-12-12T23:39:30-06:00"
        },
        {
            "_score": 1,
            "api_model": "events",
            "api_link": "https://api.artic.edu/api/v1/events/4840",
            "id": 4840,
            "title": "Express Talk: The Sound of Impressionism",
            "timestamp": "2023-12-12T23:39:30-06:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.9"
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
        "image_url": "https://artic-web.imgix.net/22a002db-9695-452b-9c85-7a63644df4e0/G35154-int_press.jpg?rect=0%2C349%2C2334%2C1312&auto=format%2Ccompress&q=80&fit=crop&crop=faces%2Ccenter&w=1200&h=675",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.9"
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
        "total": 255,
        "limit": 2,
        "offset": 0,
        "total_pages": 128,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/event-occurrences?page=2&limit=2"
    },
    "data": [
        {
            "id": "86e2bad1-35dd-5145-b12d-9ffad657a0bb",
            "api_model": "event-occurrences",
            "api_link": "https://api.artic.edu/api/v1/event-occurrences/86e2bad1-35dd-5145-b12d-9ffad657a0bb",
            "title": "Member Previews: Picasso\u2014Drawing from Life",
            "event_id": 5781,
            "short_description": "Enjoy two full days of member-only access to Picasso: Drawing from Life and see the exhibition before it opens to the public.",
            ...
        },
        {
            "id": "0cfa13a6-4a0d-5f53-935a-0226917579c1",
            "api_model": "event-occurrences",
            "api_link": "https://api.artic.edu/api/v1/event-occurrences/0cfa13a6-4a0d-5f53-935a-0226917579c1",
            "title": "Member Previews: Picasso\u2014Drawing from Life",
            "event_id": 5781,
            "short_description": "Enjoy two full days of member-only access to Picasso: Drawing from Life and see the exhibition before it opens to the public.",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.9"
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
        "total": 119,
        "limit": 10,
        "offset": 0,
        "total_pages": 12,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "event-occurrences",
            "api_link": "https://api.artic.edu/api/v1/event-occurrences/b7e9412b-8ab1-589a-a3ac-0ca3f5df89d0",
            "id": "b7e9412b-8ab1-589a-a3ac-0ca3f5df89d0",
            "title": "Performance: Joyce DiDonato Sings Camille Claudel\u2014Into the Fire",
            "timestamp": "2023-12-12T23:46:29-06:00"
        },
        {
            "_score": 1,
            "api_model": "event-occurrences",
            "api_link": "https://api.artic.edu/api/v1/event-occurrences/a6f0e89c-84ea-5b13-ac56-f83b0e43d7ff",
            "id": "a6f0e89c-84ea-5b13-ac56-f83b0e43d7ff",
            "title": "Saturday Studio: Claudel and Movement",
            "timestamp": "2023-12-12T23:46:29-06:00"
        },
        {
            "_score": 1,
            "api_model": "event-occurrences",
            "api_link": "https://api.artic.edu/api/v1/event-occurrences/ed56e684-ca22-544b-904c-ebcd68f16622",
            "id": "ed56e684-ca22-544b-904c-ebcd68f16622",
            "title": "Adult Sketch Class: The Explorer\u2019s Sketchbook",
            "timestamp": "2023-12-12T23:46:29-06:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.9"
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

::: details Example request: https://api.artic.edu/api/v1/event-occurrences/0151d68e-b3c7-5f43-a9cf-36b74eb69d7d  
```js
{
    "data": {
        "id": "0151d68e-b3c7-5f43-a9cf-36b74eb69d7d",
        "api_model": "event-occurrences",
        "api_link": "https://api.artic.edu/api/v1/event-occurrences/0151d68e-b3c7-5f43-a9cf-36b74eb69d7d",
        "title": "Gallery Tour (Sunday at 3:00, Modern Wing start)",
        "event_id": 5538,
        "short_description": "Looking for a good place to start your museum visit? Join a knowledgeable guide for a tour of museum icons and lesser-known treasures. This tour starts in the Modern Wing's Griffin Court.",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.9"
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
        "total": 39,
        "limit": 2,
        "offset": 0,
        "total_pages": 20,
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
            "id": 32,
            "api_model": "event-programs",
            "api_link": "https://api.artic.edu/api/v1/event-programs/32",
            "title": "Reflections",
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
        "version": "1.9"
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
        "total": 41,
        "limit": 10,
        "offset": 0,
        "total_pages": 5,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "event-programs",
            "api_link": "https://api.artic.edu/api/v1/event-programs/96",
            "id": 96,
            "title": "Artist Talk",
            "timestamp": "2023-12-12T23:46:56-06:00"
        },
        {
            "_score": 1,
            "api_model": "event-programs",
            "api_link": "https://api.artic.edu/api/v1/event-programs/95",
            "id": 95,
            "title": "Picasso: Drawing from Life",
            "timestamp": "2023-12-12T23:46:56-06:00"
        },
        {
            "_score": 1,
            "api_model": "event-programs",
            "api_link": "https://api.artic.edu/api/v1/event-programs/94",
            "id": 94,
            "title": "Curator-Led Gallery Conversation",
            "timestamp": "2023-12-12T23:46:56-06:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.9"
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
        "version": "1.9"
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
        "total": 429,
        "limit": 2,
        "offset": 0,
        "total_pages": 215,
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
            "source_updated_at": "2018-08-08T11:04:54-05:00",
            ...
        },
        {
            "id": 702,
            "api_model": "articles",
            "api_link": "https://api.artic.edu/api/v1/articles/702",
            "title": "American Egyptomania",
            "copy": " Ancient Egypt has fascinated the American public for centuries. The grandeur and \u201cexoticism\u201d of its pyramids, temples, Great Sphinx, and culture have made this great civilization a recurring subject in architecture, film, art, and popular culture. In fact, Egyptian imagery, often taken out of context and presented as a stereotype, has been so present in American culture that it feels strangely familiar. During the 20th century Egyptomania reached a fever pitch in the United States: Howard Carter\u2019s 1922 discovery of King Tutankhamen\u2019s Tomb caused a nationwide craze, and Elizabeth Taylor\u2019s portrayal of Cleopatra in the 1963 classic film inspired a new interest in ancient Egyptian fashion.   Chicago was not immune to the Egyptian Revival craze, and many fine examples of Egyptian-inspired architecture can be found in the city. Graceland Cemetery in Uptown and Rosehill Cemetery in Ravenswood are two sites that house Victorian-era memorial tombs and mausoleums in the Egyptian style. A more modern and commercial example is a warehouse built by the Chicago-based storage and moving company Reebie, founded in 1880 by William C. Reebie. In 1922, the same year King Tut\u2019s tomb was discovered, the Reebie Storage and Moving Company opened a historical warehouse on the 2300 block of North Clark Street.   The building\u2019s singular fa\u00e7ade, decorated in a colorful Egyptian Revival style, features an entrance guarded by twin statues of Pharaoh Ramses II. Not surprisingly, the Reebie warehouse was designated a Chicago historical landmark in 1999.   Another Egyptian Revival\u2013style building, captured by photographer and scholar Harold Allen, is the Cairo Supper Club, a one-story building whose exterior is adorned with glazed polychromatic terra-cotta, lotus-capped columns, and a winged-scarab medallion in the cornice. Designed in 1920 by architect Paul Gerhardt Sr., the building was first used as an automobile showroom and then housed the Cairo Supper Club from the 1940s to the 1960s. The Egyptian-themed fa\u00e7ade combined with the Art Deco\u2013inflected neon lights and large plate-glass windows seem to provide a vivid marriage of two different but equally influential cultures. The Egyptian-themed fa\u00e7ade combined with the Art Deco-inflected neon lights and large plate-glass windows seems to provide a vivid marriage of two different but equally influential cultures.   Similar to the Reebie warehouse, the Cairo Supper Club building was named a Chicago historical landmark in 2013 under the guidelines of exemplary architecture with a unique exterior. The Cairo Supper Club wasn\u2019t the only Egyptian-inspired building that attracted Allen\u2019s attention and his camera. In fact, he made it his goal to photograph all the Egyptian Revival\u2013style architecture ever built and simultaneously began collecting his other items that grew out the country\u2019s Egyptomania craze\u2014magazines, print and mass-manufactured material, Wedgwood, ceramics, and memorabilia. You can experience his photographs and selections from his collection now in the exhibition Forever \u201cEgypt!\u201d: Works from the Collection of Harold Allen .   The exhibition runs through August 31 in the museum\u2019s Ryerson and Burnham Libraries. Please note: The libraries are closed Saturday and Sunday. \u2014Alejandra Vargas and Margarita Lizcano Hernandez, 2016\u201318 Andrew W. Mellon Undergraduate Curatorial Fellows and exhibition co-curators ",
            "source_updated_at": "2018-08-14T04:38:13-05:00",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.9"
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
        "total": 439,
        "limit": 10,
        "offset": 0,
        "total_pages": 44,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "articles",
            "api_link": "https://api.artic.edu/api/v1/articles/1093",
            "id": 1093,
            "title": "Elizabeth Siddal in Her Eyes",
            "timestamp": "2023-12-12T23:15:05-06:00"
        },
        {
            "_score": 1,
            "api_model": "articles",
            "api_link": "https://api.artic.edu/api/v1/articles/1076",
            "id": 1076,
            "title": "An Early Collection of Bencharong Porcelain",
            "timestamp": "2023-12-12T23:15:05-06:00"
        },
        {
            "_score": 1,
            "api_model": "articles",
            "api_link": "https://api.artic.edu/api/v1/articles/1092",
            "id": 1092,
            "title": "Your Winter Essentials",
            "timestamp": "2023-12-12T23:15:06-06:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.9"
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
        "source_updated_at": "2018-08-24T11:52:37-05:00",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.9"
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
        "total": 38,
        "limit": 2,
        "offset": 0,
        "total_pages": 19,
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
            "source_updated_at": "2020-05-28T06:32:54-05:00",
            ...
        },
        {
            "id": 29,
            "api_model": "highlights",
            "api_link": "https://api.artic.edu/api/v1/highlights/29",
            "title": "contemporary-chicago-artists",
            "copy": " Explore all the works by Chicago artists in the museum's collection.   Dawoud Bey   Photographer Dawoud Bey has called Chicago home since 1998. While known for his color photography and striking portraits, for this project, Bey returned to black-and-white printing of his early years and turned his attention on an unpeopled landscape: homes and patches of land that are understood to have formed part of the Underground Railroad. For the title of the series, Night Coming Tenderly, Black , Bey was inspired by the closing couplet of a short poem \u201cDream Variations\u201d by Langston Hughes: \u201cNight coming tenderly / Black like me.\u201d   Gladys Nilsson   Among the most celebrated watercolorists working today, longtime Chicagoan Gladys Nilsson studied at the School of the Art Institute of Chicago (SAIC) and has taught at the school for over 25 years. As a member of the artist group known as the Hairy Who , Nilsson helped inject new and unique energy into the city's art landscape. Her mischievous scenes of figures interacting and engaging in various pursuits, including disguise and voyeurism, express her sense of humor and boundless curiosity. This watercolor, originally commissioned by SAIC to be used as an advertising poster, depicts playfully arranged crowds of students painting, listening to music, chatting, and hanging out in many different spaces.   Jeanne Gang   Internationally renowned for her Aqua Tower , Jeanne Gang has designed buildings across the world, and many in and around Chicago, including the Writers' Theatre, several residential buildings, two boat houses along the river, the Nature Boardwalk at Lincoln Park Zoo, and a community center in the Auburn-Gresham neighborhood. Gang designed this space to provide a welcoming, familiar space for Chinese immigrants arriving in Chicago. Finding subtle ways to incorporate traditional Chinese colors and signs within a modern, airy space, Gang organized the small structure to maximize the intergenerational connections common within the Chicago Chinese community.   Kerry James Marshall   For the last three decades, artist Kerry James Marshall has applied themes from art history to examine and recontextualize the representation of black culture. In his painting series Vignette Suite, Marshall used characteristics of the fanciful 18th-century French Rococo style and projected positive images of black life, centered around the notion of love. He focused his series on the air-borne embrace of a man and woman and surrounded them with various emblems of black affirmation, including a Black Power clenched fist, hands breaking through chains, the Black Liberation flag, African artifacts, and a panther. The result is both a multifaceted and evolving depiction of love and black identity as well as a powerful reinterpretation of a traditional art form.   Richard Hunt   One of the most important sculptors of our time, Richard Hunt was raised in Chicago and graduated from the School of the Art Institute of Chicago. Still in the city today, Hunt works out of a repurposed Chicago Railway Systems electrical substation built in 1909, creating both towering sculptures and more intimate constructions. His 2020 installation on the Art Institute\u2019s Bluhm Family Terrace features the title work, Scholar\u2019s Rock or Stone of Hope or Love of Bronze , a monumental bronze sculpture that Hunt created over six years through a durational process of adding, removing, and reshaping the work. Read more about this installation in a conversation between Hunt and curator Jordan Carter.   Anne Wilson   Anne Wilson , the Chicago-based artist and professor emeritus of Fiber and Material Studies at the School of the Art Institute of Chicago, defies easy categorization. Working with everyday materials such as table linens, bed sheets, human hair, lace, thread, glass, and wire, Wilson considers the inequities of factory labor, the impact of globalization, domestic and social rituals, and themes of time and loss. For her Dispersions series, Wilson created 26 works from fragments of heirloom damask tablecloths and napkins. Wilson opened up a damaged area in each piece of cloth into a perfect circle and embellished the edges with colored thread and hair. These are ambiguous material images, suggesting the trace from a gunshot or a celestial explosion and evoking the mortal and physical alongside the transcendent and unknowable. Wilson draws our attention to the contrasts between the machine-made cloth and the intricate hand stitching; creating tension between the artist's intervention and its foundation, and between the formal tone-on-tone design of the white cloth and the small bursts of color and texture dispersed around damaged cloth.   Amanda Williams   Currently based in the South Side neighborhood of Bridgeport, Amanda Williams was born and raised in the Chicagoland area. Her work blends her architectural training with traditional art approaches to confront issues of race, value, and urban space. For her most famous project, Color(ed) Theory , which debuted at the Chicago Architecture Biennial in 2015, Williams painted eight soon-to-be-demolished houses in Chicago's Englewood using a palette of colors found in products and services marketed primarily toward Black people, such as Flamin\u2019 Red Hots. Drawing attention to the underinvestment in African American communities around the city, the series asks: What color is poverty? What color is gentrification?   Pope.L   Known for his groundbreaking performances as well as for text-based drawings and paintings that disrupt the conventions of cultural identity and explode traditional artistic categories, artist Pope.L has lived in Chicago for over a decade and has been a professor at University of Chicago since 2010. The title of this work, Finnish Painting evokes a strangely specific yet enigmatic sense of national identity while also offering a play on words, the imperative to \u201cfinish painting.\u201d This work presents the barely legible text of a poem, the last word of which is \u201cdecode\u201d\u2014as if acknowledging that to see, read, and understand others is always a struggle, and that meaning is often fluid. Another text-based feature is the attribution at the lower right, \u201cR. Ryman,\u201d referring to Minimalist artist Robert Ryman , whose monochromatic white paintings were often layered color underpainting and who treated his signature as an important visual element within a painting\u2019s composition, never simply as authorization of a finished canvas. Perhaps this Pope.L work reveals what might lie beneath Ryman\u2019s white surfaces.   Stanley Tigerman   Architect, designer, and provocateur Stanley Tigerman \u2014a lifelong Chicagoan\u2014made it his mission to push the city's architecture beyond the then reigning style of the modernist glass box. His design for the Holocaust Museum and Education Center in Skokie integrates symbolic gestures of Judaism in various ways\u2014the site plan, materials, and formal language. This model for an early scheme shows how the museum is composed of two wings\u2014the darkened wing points six degrees toward the Western Wall in Jerusalem, and the lighter education center toward the rising sun. He suggested that the use of such symbolism serves an act of defiance to those who would eliminate a particular culture and its history.   Bethany Collins   Originally from Alabama, Bethany Collins currently lives in Chicago making work that explores the deep-rooted connections between race and language. In The Birmingham News, 1963 , Collins presents 18 embossed and distressed front pages from issues of the Birmingham News published during 1963, a seismic year for the civil rights movement. While most national media outlets were covering the area\u2019s sit-ins, demonstrations, and police brutality, the Birmingham News did not, supposedly to subdue racial tension. By embossing, darkening, and distressing these pages, Collins transforms them into a kind of memorial to events ignored by the Birmingham press and demonstrates how authored and institutional texts are always politicized.   Terry Evans   A Kansas City native, Terry Evans moved to Chicago in 1994 and has lived here since. After focusing on the Midwestern prairie for many years, Evans took to the skies and photographed the city from above for her Revealing Chicago project. From backyard pools to the city jail, the lakefront to industrial areas, Evans sought to show \"the diversity and complexity of Chicago.\" She lamented that she \"hadn't even come close. This is an incomplete portrait, a fraction of a second in the life of Chicago, and every picture contains more stories than the image reveals.\"   Judy Ledgerwood   A longtime Midwesterner and decades-long Chicagoan, Judy Ledgerwood paints monumental abstractions that explore both the perceptual effects and the politics of color, luminosity, pattern, and scale. After earning her MFA from the School of the Art Institute of Chicago in 1984, she turned to traditionally \u201cfeminine\u201d pastels and decorative forms in order to challenge the stereotypes of gendered approaches to painting. Ledgerwood borrowed this work\u2019s title, So What , from a 1959 \u201ccool period\u201d jazz composition by Miles Davis. Made during winter, the painting features pale colors evocative of the season and at first appears quiet and serene. Yet sustained looking reveals subtle modulations in the blue-green, yellow, and white circles, which seem to alternately recede and advance across the work\u2019s surface. ",
            "source_updated_at": "2021-03-24T11:22:26-05:00",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.9"
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
        "total": 39,
        "limit": 10,
        "offset": 0,
        "total_pages": 4,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "highlights",
            "api_link": "https://api.artic.edu/api/v1/highlights/67",
            "id": 67,
            "title": "picasso-s-circles-of-influence",
            "timestamp": "2023-12-12T23:51:37-06:00"
        },
        {
            "_score": 1,
            "api_model": "highlights",
            "api_link": "https://api.artic.edu/api/v1/highlights/65",
            "id": 65,
            "title": "the-body-speaks",
            "timestamp": "2023-12-12T23:51:37-06:00"
        },
        {
            "_score": 1,
            "api_model": "highlights",
            "api_link": "https://api.artic.edu/api/v1/highlights/37",
            "id": 37,
            "title": "making-a-difference-a-tour-for-families",
            "timestamp": "2023-12-12T23:51:37-06:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.9"
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
        "copy": " If you entered at Michigan Avenue, start at the top. If you entered through the Modern Wing, go in reverse order. Please note that artworks occasionally go off view for imaging, treatment, or loan to other institutions. Click on the images to ensure the work is currently on view.   Hero Construction , created in 1958, just a year after Chicago sculptor Richard Hunt graduated from the School of the Art Institute, is composed of found objects\u2014old pipes, bits of metal, and automobile parts\u2014that the artist discovered in junkyards and on the street. Inspired by mythology and heroic sculptures past and present, the welded figure suggests a hero for our times, humble yet resilient in the face of past, present, and future injustices and uncertainties. On view on the Woman's Board Grand Staircase   More than 100 years ago, Agnes F. Northrop designed the monumental Hartwell Memorial Window for Tiffany Studios as a commission from Mary Hartwell in honor of her husband, Frederick Hartwell, for the Central Baptist Church of Providence, Rhode Island (now Community Church of Providence). Composed of 48 panels and numerous different glass types, the window is inspired by the view from Frederick Hartwell\u2019s family home near Mt. Chocorua in New Hampshire. The majestic scene captures the transitory beauty of nature\u2014the sun setting over a mountain, flowing water, and dappled light dancing through the trees\u2014in an intricate arrangement of vibrantly colored glass. On view at the top of the Woman's Board Grand Staircase   This 12th-century statue of the Buddha comes from the south Indian coastal town of Nagapattinam, where Buddhist monasteries flourished and attracted monks from distant lands. He is seated in a lotus posture of meditation, with hands and feet resting atop one another. The mark on his forehead is called the urna, which distinguishes the Buddha as a great being. On view in Gallery 140   Peruvian artist Kukuli Velarde (born 1962) creates ceramic works that both celebrate indigenous cultures and explore the consequences of colonialization by Spain. In this low-fired clay sculpture, she transforms the famous Christian statue of the Virgin of the Immaculate Conception in Cusco\u2019s cathedral, called La Linda, into an ancient Nasca goddess. Crowned in a silver starred halo and adorned with iconography from ancient Nasca ceramics, La Linda Nasca creates a throughline from pre-Columbian traditions to the post-colonial present of contemporary Latin American art. In this way, Velarde explores the dual identities that many modern Andeans may embrace. On view in Gallery 136   Caught in the heat of battle with sword raised and horse rearing, this mounted figure may match many notions of a knight in shining armor but actually represents a common hired soldier. The armors for both man and horse were produced in Nuremberg, Germany, in the 16th century, but the clothing was meticulously recreated in 2017 from period designs. Look for the special leggings: small plates of steel are sewn between two pieces of linen to protect the soldier's legs. You'll also spot some splashes of mud and grime from the battlefield. On view in Gallery 239   For his largest and best-known painting, Georges Seurat depicted Parisians enjoying all sorts of leisurely activities\u2014strolling, lounging, sailing, and fishing\u2014in the park called La Grande Jatte in the River Seine. He used an innovative technique called Pointillism, inspired by optical and color theory, applying tiny dabs of different colored paint that viewers see as a single, and Seurat believed, more brilliant hue. On view in Gallery 240   This sun-drenched composition with its vivid palette, dramatic perspective, and dynamic brushwork depicts Vincent van Gogh 's bedroom in his house in Arles, France, his first true home of his own. Van Gogh dubbed it the \u201cStudio of the South\u201d in the hope that friends and artists would join him there. He immediately set to work on the house and painted this bedroom scene as a part of his decorating scheme. Van Gogh liked this image so much that he painted three distinct versions\u2014the other two are held in the collections of the Van Gogh Museum in Amsterdam and the Mus\u00e9e d\u2019Orsay in Paris. On view in Gallery 241   Painted in the summer of 1965, when Georgia O'Keeffe was 77 years old, this monumental work culminates the artist\u2019s series based on her experiences as an airplane passenger during the 1950s. Spanning the entire 24-foot width of O\u2019Keeffe\u2019s garage, the work has not left the Art Institute since it came into the building\u2014because of its size and because of its status as an essential icon. On view in Gallery 249   This iconic painting of an all-night diner in which three customers sit together and yet seem totally isolated from one another has become one of the best-known images of 20th-century art. Hopper said of the enigmatic work, \u201cUnconsciously, probably, I was painting the loneliness of a large city.\u201d On view in Gallery 262   One of the most famous American paintings of all time, this double portrait by Grant Wood debuted at the Art Institute in 1930, winning the artist a $300 prize and instant fame. Many people think the couple are a husband and wife, but Wood meant the couple to be a father and his daughter. (His sister and his dentist served as his models.) He intended this Depression-era canvas to be a positive statement about rural American values during a time of disillusionment. On view in Gallery 263   Pablo Picasso\u2019s The Old Guitarist is a work from his Blue Period (1901\u201304). During this time the artist restricted himself to a cold, monochromatic blue palette and flattened forms, taking on the themes of misery and alienation inspired by such artists as Edvard Munch and Paul Gauguin. The elongated, angular figure also relates to Picasso\u2019s interest in Spanish art and, in particular, the great 16th-century artist El Greco . The image re\ufb02ects the 22-year-old Picasso\u2019s personal sympathy for the plight of the downtrodden; he knew what it was like to be poor, having been nearly penniless during all of 1902. On view in Gallery 391   In 1911\u201312, Vasily Kandinsky cofounded the Blue Rider (Der Blaue Reiter), a loose alliance of artists who often worked in a common palette, used expressive brushwork, and shared a belief in the symbolic and spiritual importance of forms and colors, including their effect on emotions and memories. In his influential 1912 publication, Concerning the Spiritual in Art , Vasily Kandinsky advocated an art that could move beyond imitation of the physical world, inspiring, as he put it, \u201cvibrations in the soul.\u201d Improvisation No. 30 (Cannons) \u2014one of the first works in which he attempted to depict those \u201cvibrations\u201d \u2014 is a standout work within the Art Institute\u2019s modern art collection. On view in Gallery 392   In the 1970s, Alma Thomas was enthralled by astronauts and outer space. Starry Night and the Astronauts not only captures her fascination with space flight but also shows the signature style of her abstract works, which use short, rhythmic strokes of paint. \u201cColor is life,\u201d she once proclaimed, \u201cand light is the mother of color.\u201d Thomas made this work in 1972, when she was 81\u2014the same year she became the first African American woman to have a solo exhibition at the Whitney Museum of American Art in New York. On view in Gallery 291 ",
        "source_updated_at": "2023-09-26T10:23:44-05:00",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.9"
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
        "version": "1.9"
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
            "timestamp": "2023-12-13T12:20:18-06:00"
        },
        {
            "_score": 1,
            "api_model": "static-pages",
            "api_link": "https://api.artic.edu/api/v1/static-pages/2",
            "id": 2,
            "title": "Events",
            "timestamp": "2023-12-13T12:20:18-06:00"
        },
        {
            "_score": 1,
            "api_model": "static-pages",
            "api_link": "https://api.artic.edu/api/v1/static-pages/3",
            "id": 3,
            "title": "Exhibitions",
            "timestamp": "2023-12-13T12:20:18-06:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.9"
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
        "version": "1.9"
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
            "id": 15,
            "api_model": "generic-pages",
            "api_link": "https://api.artic.edu/api/v1/generic-pages/15",
            "title": "Research Guides",
            "web_url": "https://nocache.www.artic.edu/library/discover-our-collections/research-guides",
            "copy": " Learn how to research a work of art, uncover the history of a Chicago building, locate art market prices or a professional appraiser, or find information on works exhibited at the Paris salons, among other topics.   An overview of the library collections is available here , and information on visiting the Reading Room can be found here . ",
            ...
        },
        {
            "id": 307,
            "api_model": "generic-pages",
            "api_link": "https://api.artic.edu/api/v1/generic-pages/307",
            "title": "Former Director\u2019s Papers",
            "web_url": "https://nocache.www.artic.edu/institutional-archives/former-directors-papers",
            "copy": null,
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.9"
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
        "total": 215,
        "limit": 10,
        "offset": 0,
        "total_pages": 22,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "generic-pages",
            "api_link": "https://api.artic.edu/api/v1/generic-pages/481",
            "id": 481,
            "title": "Joining a Virtual Event",
            "timestamp": "2023-12-12T23:51:50-06:00"
        },
        {
            "_score": 1,
            "api_model": "generic-pages",
            "api_link": "https://api.artic.edu/api/v1/generic-pages/485",
            "id": 485,
            "title": "Intersections",
            "timestamp": "2023-12-12T23:51:50-06:00"
        },
        {
            "_score": 1,
            "api_model": "generic-pages",
            "api_link": "https://api.artic.edu/api/v1/generic-pages/478",
            "id": 478,
            "title": "Yady Rivero",
            "timestamp": "2023-12-12T23:51:50-06:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.9"
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
        "copy": " RESERVE ONLINE IN ADVANCE Free Admission for Illinois Residents Admission was free for Illinois residents on Thursday evenings, 5\u20138 p.m., May 18\u2013August 31, 2023. Our next free days for Illinois residents will be weekdays (Mondays, Thursdays, and Fridays), November 27\u2013December 22, 2023. If you reserve your free tickets online in advance , your resident status will be verified using the zip code associated with the billing address provided. If you're unable to reserve tickets in advance, please stop by the admissions desks on the day of your visit for assistance. Illinois Educators Free admission is available to current Illinois educators, including pre-K\u201312 teachers, teaching artists working in schools, and homeschool parents. Educators can register online to receive a voucher for a complimentary ticket to the museum. This voucher must be presented\u2014as a printed document or on a smartphone\u2014with a valid educator ID at one of the museum\u2019s admission counters. Chicago Public Library\u2014Explore More Illinois Digital Pass Chicago Public Library cardholders 18 and older can log in at chipublib.org/digitalpasses to reserve free general admission passes to the museum through Explore More Illinois. Please note that this offer is valid only for Chicago Public Library cardholders.   NO ADVANCE TICKET REQUIRED The following groups are invited to visit our galleries at no cost every day. In order to receive your free admission benefits, simply show the corresponding identification at the admissions desk in either museum lobby. Free admission benefits are not single use\u2014you are welcome to use them any time you would like to visit. Be sure to inquire about the availability of special exhibition tickets when you check in at the admissions counter. Kids under 14 Admission is always free for children under 14. These free tickets are available online as well as on-site at the admissions counters. Chicago Teens Museum admission is free for Chicago teens under the age of 18, thanks to the extraordinary generosity of Glenn and Claire Swogger and the Redbud Foundation. See more opportunities and resources for teens . Active-Duty Military As part of the Blue Star Museums program, active-duty service members receive free admission all year long. Plus, from Armed Forces Day through Labor Day, we also welcome service members and their households. Please bring your active-duty military ID to the admissions counter to receive this benefit. LINK and WIC Cardholders As part of Museums for All, LINK and WIC cardholders and anyone in their households receive free general admission to the museum and all ticketed special exhibitions. Simply present your card along with a valid photo ID. University Partners Students of colleges and universities in the University Partner Program are entitled to free general and special exhibition admission by showing a valid student ID at the ticket counter. Check the full list of partnering colleges and universities . Corporate Partners Employees of certain companies in the Corporate Partner Program are entitled to free general and special exhibition admission by showing proof of employment at the ticket counter. Learn more about the Corporate Partner Program . Check the full list of Corporate Partner companies whose employees are entitled to free admission.   More Corporate Partner Opportunities ",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.9"
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
        "total": 302,
        "limit": 2,
        "offset": 0,
        "total_pages": 151,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/press-releases?page=2&limit=2"
    },
    "data": [
        {
            "id": 53,
            "api_model": "press-releases",
            "api_link": "https://api.artic.edu/api/v1/press-releases/53",
            "title": "Press Releases from 1991",
            "web_url": "https://nocache.www.artic.edu/press/press-releases/53/press-releases-from-1991",
            "copy": " To obtain the full text of any news releases in this index, please contact the Institutional Archives at reference@artic.edu or (312) 443-4777.   January 3, 1991 Fragments of Chicago Past , AIC publication, Permanent collection catalogue of building fragments edited by curator of Architecture Pauline Saliga 1-3 January 8, 1991 Museum Studies , AIC semiannual (v. 16, no. 2) with contributions by curator of European Painting Gloria Groom, curator of Chinese Art Elinor L. Pearlstein, SAIC professor Catherine C. Bock, Albert Kostenevich (curator of exhibition titled Poussin to Matisse, The Hermitage, Leningrad), executive director of Publications Susan F. Rossen, first Museum's curator of Modern Art Katharine Kuh, SAIC professor Maria Makela, et. al., 4-6 January 17, 1991 Ronne Hartfield, appointed Executive Director of Museum Education replacing Kent Lydecker; remarks by AIC Director James N. Wood 7-8 Lucille Clifton and Angela Jackson, program with The Reading and Conversation Series sponsored by Lannan Foundation 9-10 ; African American History Month, programs 11-13 January 24, 1991 A Distanced Land: The Photographs by John Pfahl, exhibition from Albright-Knox Art Gallery, Buffalo, NY, catalogue 14-17, 63-64, 95 January 1991 Monthly Calendar Curator's Choice: A Selection of Masterworks from the Asian Collection, exhibition; Asian Art gallery renovation 18, 95 Paper Gardens: Photography by Joan Fontcuberta, exhibition 19, 49 Public Programs. Kraft Educational Center 20-23 February 25, 1991 Acquisitions in 1989-1990, exhibition shown in The New Acquisitions Gallery 24-29 February 1991 Monthly Calendar New and continuing exhibitions, public programs, and lectures. Kraft Education Center 30-34 High and Low: Modern Art and Popular Culture, exhibition from The Museum of Modern Art, N.Y., 30 March 8, 1991 1991-1992 EXHIBITION SCHEDULE ( 35-44 ) Manet and the Etching Revival, exhibition 37 Contemporary Prints and Portfolios from the Permanent Collection, exhibition i A Senufo Caryatid Drum: Woman and Senufo Art, exhibition 38, 96 Calum Colvin's The Ways of Life , exhibition of cibachrome photographs 38, 96 Paul Strand: A Retrospective, exhibition organized by The National Gallery of Art, Washington, DC., catalogue 38, 95 Power in the Blood, the North of Ireland: Photographs by Gilles Peress, exhibition venues 39, 93 \"Degenerate Art\": The Fate of the Avant-Garde in Nazi Germany, exhibition organized by Los Angeles County Museum of Art 40, 93-94 The Gold of Africa: Jewelry and Ornaments from Ghana, Cote d'Ivoire, Mali and Senegal, exhibition organized by Barbier-Mueller Museum in Geneva, Switzerland, curator Marie-Therese Brincard of The American Federation of Arts 40, 85, 94 18th Century English Pottery: Selections from the Collection of Harry Root, promised gift; exhibition 41, 94 A Birthday Celebration: 100 Years of Antiquarian Society: Textile Collecting, 1890 to 1991, exhibition for the 30th anniversary of AIC Department of Textiles 41, 118-119, 155 Tokens of Affection: The Portrait Miniature in America, the Gloria and Richard Manney Collection, exhibition co-organized by The Metropolitan Museum and Smithsonian Institution, catalogue 42, 120-123 Martin Puryear, exhibition, curator of 20th Century Art Neal Benezra, catalogue and venues 42, 146 Grave Goods from Ancient Cultures, exhibition in association with the 1991 annual meeting of the Archeological Institute of America, curators Mary Greuel and Karen Alexander of European Decorative Arts Department 43, 147 The Radiance of Jade and Crystal Clarity of Water: Korean Ceramics from the Ataka Collection, exhibition from Museum of Oriental Ceramics of Osaka, Japan; catalogue 43, 147,150 Soviet Propaganda Plates from the Tuber Collection, exhibition 43 Jacob Lawrence: The Frederick Douglass and Harriet Tubman Series of Narrative Paintings, traveling exhibition of historical illustrations 44, 75 1991-1992 EXHIBITION SCHEDULE ADDENDUM (of March 12) From Pontormo to Seurat: Drawings Recently Acquired by AIC, curator of Prints and Drawings Department Douglas W. Druick and curator of Earlier Prints and Drawings Susanne Folds McCullagh; exhibition venue in The Frick Museum in New York 48, 109-111, 129 March 8, 1991 1991-1992 RENOVATIONS and NEW INSTALLATIONS ( 45-47, 117 ) The Earnest R. Graham Study Center for Architectural Drawings, designed by Stanley Tigerman, opening 45, 99, 114 Stanley McCormick Memorial Court (Museum's North Garden), opening, installation of Alexander Calder's sculpture Flying Dragon (1975) 46, 94 Modern Art 1900-1950: The Collection Reinstalled, East Wing and Morton Building, gallery opening; Albert and Connie Gallery and Linda Robin Gallery, dedication 46, 93 The Kraft General Food Education Center, renaming and renovation of AIC Junior Museum, $1.1 million contribution by Kraft Foundation 46, 117 The Galleries of East Asian Art, opening; the Government of Japan, Mitsubishi Bank, T. T. Tsui, et. al., funding 47, 117 March 1991 Monthly Calendar Continuing exhibitions, public programs, and lectures. Kraft Education Center 50-53 April 10, 1991 English and French Printed Textiles: History on Cloth, exhibition of commemorative textiles 38, 54-58 April 28, 1991 Museum shop, wedding gift ideas, reproductions and adaptations from Museum's holdings 59-62 April 1991 Monthly Calendar Continuing exhibitions, public programs, and lectures. Kraft Education Center 63-67 May 16, 1991 Garden Restaurant, opening for summer season, Ray Bailey jazz quintet 68-69 May 22, 1991 Museum shop, gifts For Father's Day; puzzle Landscape Variations designed by Richard Hunt; jigsaw puzzles featuring Museum's famous paintings 70-74 June 4, 1991 Contemporary Austrian Architecture and Design, catalogue and exhibition, curator of Architecture Department John Zukowsky and curator of European Decorative Arts Ian Wardropper 39, 82-84 June 10, 1991 Museum shop featuring The Gold of Africa exhibition, catalogue and jewelry 85-88 June 20, 1991 Museum shop, satellite shops in Oakbrook Mall and at 900 N. Michigan Ave. (downtown Chicago) 89-91, 142 June 1991 Monthly Calendar New and continuing exhibitions, public programs and lectures. Kraft Education Center 92-98 Austrian Architecture and Design: Beyond Tradition in the 1990s, exhibition and catalogue, curator of Architecture Department John Zukowsky, curator of European Decorative Arts Ian Wardropper 39, 82-84, 92 Modern Art 1900-1950: The Collection Reinstalled, exhibition marking opening of new galleries, installation planned by curator of 20th Century Art Department Charles F. Stuckey and designed by John Vinci 46, 93 A New Leaf: Ray K. Metzker, Recent Photographs, exhibition 93, 99, 131 July 1991 Monthly Calendar New and continuing exhibitions, public programs, and lectures. Kraft Education Center 99-105 August 9, 1991 Museum Studies, AIC semiannual (v. 17, no. 1) featuring AIC Collection of Italian drawings 106-108 August 30, 1991 From Pontormo to Seurat: Drawings Recently Acquired by AIC, exhibition venue in The Frick Collection in New York, curator of Prints and Drawings Department Douglas W. Druick, curator of Earlier Prints and Drawings Susanne Folds McCullagh 48, 109-111, 129 August 1991 Monthly Calendar New and continuing exhibitions, public programs, and lectures. Kraft Education Center 112-116 September 5, 1991 1992 Renovation and Reinstallation; opening of The Kraft General Foods Education Center and Galleries of East Asian Art 117 September 6, 1991 A Birthday Celebration: 100 Years of Antiquarian Society: Textile Collecting, 1890 to 1991, exhibition of gifts and acquisitions, the 30th anniversary of the Department of Textiles 40, 118-119, 129, 155 Tokens of Affection: The Portrait Miniature in America, the Gloria and Richard Manney Collection, exhibition co-organized by The Metropolitan Museum and Smithsonian Institution, catalogue 42, 120-123, 129 September 9, 1991 Museum shop, Holiday Gift Catalogue 124-126 September 25, 1991 The Lannan Foundation Poetry Program, Miroslav Holub readings, hosted by Edward Hirsch 127-128 September 1991 Monthly Calendar New and continuing exhibitions, public programs, and lectures. Kraft Education Center 129-134 From Pontormo to Seurat: Drawings Recently Acquired by AIC, exhibition 129 A Birthday Celebration: 100 Years of Antiquarian Society, exhibition 129 Tokens of Affection: The Portrait Miniature in America, exhibiton 129-130 October 4, 1991 The Intuitive Eye: Photographs from the David C. and Sarajean Ruttenberg Collection, exhibition and catalogue, curator of Photography Colin Westerbeck, curator of the Ruttenberg Collection Kathleen Lamb; chair of Photography Department Acquisition Committee Mr. David C. Ruttenberg 135-137, 149 ; gift 161-162 October 11, 1991 Extended museum hours for \"Evenings around the Sculpture Court\", The Roger McCormick Memorial Sculpture Court, special programs 138 Otober-November 1991 Monthly Calendars New and continuing exhibitions, public programs, and lectures. Kraft Education Center 139-152 December 10, 1991 Women Artists: From the 16th Century to the 20th Century, subscription series, lecture schedule 153-154 December 1991 Monthly Calendar New and continuing exhibitions, public programs, and lectures. Kraft Education Center 155-160 ",
            ...
        },
        {
            "id": 52,
            "api_model": "press-releases",
            "api_link": "https://api.artic.edu/api/v1/press-releases/52",
            "title": "Press Releases from 1990",
            "web_url": "https://nocache.www.artic.edu/press/press-releases/52/press-releases-from-1990",
            "copy": " To obtain the full text of any news releases in this index, please contact the Institutional Archives at reference@artic.edu or (312) 443-4777.   January 3, 1990 On Assignment: Documentary Photographs from the 1930s and 1940s by Marion Post Wolcott and Easter Bubley; Photography by Gary Brotmeyer, exhibitions 1 January 9, 1990 Universal Limited Art Editions (ULAE): The First Twenty Five Years , AIC publication and lecture series by former AIC curator of Prints and Drawings Esther Sparks; exhibition of the same title in conjunction with publication 2-3, 6-7 January 12, 1990 Teacher's manual based on the 1989 AIC Teacher Development Course on the Arts of Africa, distribution in Chicago area schools; Yoruba: Nine Centuries of African Art and Thought, exhibition 4 Constantin Brancusi's sculpture Golden Bird (1919), acquisition; renovation of 20th Century Art galleries; comments by AIC Director James N. Wood 5 January 18, 1990 Universal Limited Art Editions (ULAE): The First Twenty Five Years, exhibition, catalogue by Esther Sparks; lecture series 2-3 ; publications and programs 6-7 January 25, 1990 Museum shop, Valentine's Day gift ideas 8-12 January 26, 1990 The Trading Room: Louis Sullivan and The Chicago Stock Exchange (1977) by John Vinci, revised edition; curator of Architecture Pauline Saliga 13-14 February 27, 1990 Emilio Ambasz: Architecture, Exhibition, Industrial and Graphic Design, retrospective organized by La Jolla Museum of Contemporary Art, catalogue, lecture by the artist, reception, exhibition venues; AIC Architecture Society Fellows, benefactors Stuart Nathan, John Buck, Harold Schiff 15-21 The Artists File , microform publication of The New York Public Library clipping file, acquisition in Ryerson and Burnham Libraries made possible by AIC Woman's Board, restricted gift; Ryerson Pamphlet File; comments by director of AIC Ryerson and Burnham Libraries Jack P. Brown 22-23 February 28, 1990 Martha P. Tedeschi, appointed Associate Curator in the Department of Prints and Drawings 24 John W. Smith, appointed Archivist at AIC 25 Pauline A. Saliga, appointed Associate Curator in the Department of Architecture 26-27 The Andrew W. Mellon Foundation, grant for scholarly research and publications; $1 million anonymous gift by a member of AIC Board of Trustees; comments by AIC Director James N. Wood 28-29 March 1, 1990 The Bruce Goff archive and library, gift of Shin'eKan, Inc., acquisition in the Department of Architecture and in AIC Ryerson and Burnham Libraries; comments by director of AIC Libraries Jack P. Brown and curator of Architecture Department John Zukowsky 30-31 March 5, 1990 Museum Studies (v.15, no. 2), AIC semiannual featuring sculpture works from Youruba exhibition, also included essays on holdings from Permanent collection by Jack P. Brown (Jean Leon Gerome's paintings), Martha A. Wolff (Dieric Bouts' Sorrowing Madonna ), et. al., 32-34 Designed by Yard: 20th Century Pattern Repeats, exhibition of Western textiles from Permanent collection; Robert Allerton acquisitions 35-36 March 21, 1990 Museum shop, Easter gifts inspired by Beatrix Potter's Tale of Peter Rabbit 37-40 April 3, 1990 Classical Drawing: Shades of Black and White, exhibition of works by Chicago high school students organized by AIC Junior Museum and Marwen Foundation 41-42 April 19, 1990 The Department of Textiles at The Art Institute of Chicago , AIC publication concurrent with reopening of Textile Galleries, curator of Textile Department Christa C. M. Thurman 43-44 April 30, 1990 Affinities and Intuitions: The Gerald S. Elliott Collection of Contemporary Art , AIC publication and exhibition prepared by curator of 20th Century Art Neal Benezra with contributions by SAIC professor Judith R. Kirschner, curator of 20th Century Painting and Sculpture Department Charles F. Stuckey, et. al., 45-47, 51-52 Yoruba: Nine Centuries of African Art and Thought, exhibition 4, 32-33 ; AIC video release 48-49 May 4, 1990 Ryerson and Burnham Libraries, closing for inventory, new schedule 50 May 22, 1990 Affinities and Intuitions: The Gerald S. Elliott Collection of Contemporary Art , AIC publication and exhibition, curator of 20th Century Art Neal Benezra; comments by AIC Director James N. Wood 45-47, 51-52 June 13, 1990 Kraft General Foods, corporate gift of $1.1 million for renovation of AIC Junior Museum renamed The Kraft General Foods Education Center; presentation ceremony and commemorative mural; comments by AIC Director James N. Wood and President of Kraft General Foods Geoffrey Bible; AIC Woman's Board contribution 53-56 June 27, 1990 From Poussin to Matisse: The Russian Taste for French Painting , AIC publication and exhibition; The Hermitage, Leningrad, and Pushkin Museum in Moscow, cultural exchange program 57-59, 84-84 Ed Paschke , AIC publication concurrent with the artist's retrospective; SAIC alumnus; Chicago Imagist movement 60-61 ; Ed Paschke: Paintings, exhibition, curator of 20th Century Art Neal Benezra; exhibition venues; Ed Paschke: Drawings from Chicago Collections, complementary show 86-87 July 3, 1990 Art in the Park Trailer, Chicago Park District activities, SAIC and Kraft Education Center family programs 62-63 Museum shop, special sales area at Museum's North Garden featuring exhibition titled Monet in the '90s, 68-69 August 4, 1990 Suggested admission fees increase 82 August 6, 1990 New Acquisitions: Early American Modernist Painting, exhibition, preview for opening of 20th Century Art galleries; Marcel Duchamp, Joseph Stella, Charles Demuth, Walter W. Ellison (SAIC alumnus), et. al., works on view 79-81, 84 August 20, 1990 18th Century Worcester English Porcelain: Recent and Promised Gifts from the Collection of Dr. Kenneth J. Maier, exhibition concurrent with The International Antique Show at Navy Pier, Chicago; curator of European Decorative Arts Rita E. McCarthy 74-78, 85-86 August 24, 1990 1990-1992 EXHIBITION SCHEDULE ( 83-93 ) Private Taste in Ancient Rome: Selections from Chicago Collections, exhibition 83 Chicago Skyscrapers: Selections from the Permanent Collection, exhibition of architectural drawings 84 The New Vision: Photography Between the World Wars, Ford Motor Company Collection from The Metropolitan Museum of Art, exhibition; the Waddell Collection 85 The Art of Music: A Salute to the Centennial Season of the Chicago Symphony Orchestra, exhibition of prints and drawings 86 The Romantic Vision of Caspar David Friedrich: Paintings and Drawings from the USSR, exhibition venues; cultural exchange program 87 The American Bed and Its Coverings, textile exhibition 87 Selections from the Permanent Collection of Asian Art, preview for gallery opening 88 Museum's North Garden, opening after renovation; installation of Alexander Calder's sculpture Flying Dragon (1975), acquisition made possible by Sydney Port 88 High and Low: Modern Art and Popular Culture, exhibition organized by The Museum of Modern Art, N.Y., 88 English and French Printed Textiles, exhibition 89 Paul Strand: A Retrospective, photography exhibition organized by The National Gallery of Art, Washington, D.C., 89 \"Degenerate Art\": The Fate of the Avant-Garde in Nazi Germany, exhibition organized by Los Angeles County Museum 89 The Gold of Africa: Jewelry and Ornaments from Ghana, Cote d'Ivoire, Mali and Senegal, exhibition organized by Barbier-Mueller Museum in Geneva, Switzerland; traveling exhibition circulated by The American Federation of Arts 90 Cream-ware from the Collection of Harry Root, Jr., exhibition; promised gift 90 Tokens of Affection: The Portrait Miniature in America, exhibition organized by The Metropolitan Museum of Art, collection of Gloria and Richard Manney 91 Martin Puryear, exhibition curated by Neal Benezra of 20th Century Art Department, catalogue and venues 91 Soviet Propaganda Plates from the Tuber Collection, exhibition 92 Opening of The Ernest R. Graham Study Center for Architectural Drawings, design by Stanley Tigerman; grant of Graham Foundation for Advanced Studies in Fine Arts 92 Reinstallation of 20th Century Art Galleries, opening 92 The Junior Museum renamed The Kraft General Foods Education Center, renovation 53-56 ; opening 93 Reinstallation of Asian Art Galleries, funding 93 September 6, 1990 Museum shop, 1990-1991 Holiday Gift Catalogue, adaptations and reproductions from Permanent collection 94-97 October 4, 1990 The Museum shop, first satellite shop \"Holiday Collection\" at 900 N. Michigan Ave. (Chicago downtown), opening 98-99 November 13, 1990 Victor D. Simmons, appointed staff lecturer in the Department of Museum Education 101-102 December 10, 1990 New Acquisitions: Modernist Photography, exhibition; Recent Acquisitions from the Photography Collection, exhibition 87, 103-104 JANUARY 1990 Universal Limited Art Editions (ULAE): The First Twenty Five Years , exhibition and publication by Esther Sparks 105 American Art Since World War II: Recent Acquisitions, exhibition 105 1889: The First Year of the Classical Collection, exhibition of antiquities acquired by Charles T. Hutchinson and William M. R. French, related documents 105 European Textile Masterpieces from Coptic Times through the 19th Century, exhibition from Permanent collection 106 New acquisitions: Old Master Drawings of the 15th-18th Centuries, exhibition of works acquired from British Rail Pension Fund Collection, London 106 Tour de France: Paintings, Photographs, Prints, and Drawings from Permanent Collection, exhibition 106 On Assignment: Documentary Photographs from the 1930s and 1940s by Marion Post Wolcott and Esther Bubley, exhibition of photographs commissioned by The Farm Security Administration and The Office of War Information 106 Stanley Tigerman: Recent Projects, exhibition organized by guest curator Sarah M. Underhill; Tigerman's archive, promised gift to Architecture Department 107 The Chicago Panels by Ellsworth Kelly, long-term loan from the artist, installation of six color panels in the Sculpture Court of Rice Building, project sponsored by AIC Auxiliary Board 107 Public programs, schedule; The Junior Museum activities and exhibitions: Photography: Inventions and Innovations; Pinhole Photography; The Factory (Andy Warhol) 107-110 FEBRUARY 1990 Yoruba: Nine Centuries of African Art and Thought, exhibition 111 Designed by Yard: 20th Century Pattern Repeats, exhibition of Western textiles from Permanent collection; Robert Allerton acquisitions 111 Photographs by Gary Brotmeyer, exhibition 112 Altered States: Landscape Prints and the Dynamic of Change in the Impressionist Era, exhibition, Part 1 112 ; Part II 126 Public Programs; Junior Museum activities and exhibitions: Lamidi Fakeye: Living Youruba Sculptor, et. al., 113-116 MARCH 1990 Private Taste in Ancient Rome: Selections from Chicago Collections, exhibition 117 What's New: Mexico City, exhibition 117 Crossings: Photographs by Susan Meiselas, exhibition 117 Landeck, Lewis, and Lozowick: Three American Printmakers, exhibition 119 Public Programs and Junior Museum activities 120-123 APRIL 1990 Changing Impressions: Experimental Printing from the 17th through 19th Centuries, exhibition 124 Public Programs and Junior Museum activities 126-129 MAY 1990 Monet in the '90s: The Series Painting, exhibition venues 130 Emilio Ambasz: Architecture, Exhibition, Industrial and Graphic Design, retrospective 130-131 Affinities and Intuitions: The Gerald S. Elliott Collection of Contemporary Art , AIC publication and exhibition 131 Public Programs and Junior Museum activities 132-135 JUNE 1990 Lee Miller: Photographer, exhibition 136 Public Programs and Junior Museum activities 139-141 JULY 1990 Chicago Skyscrapers: Selections from the Permanent Collection, exhibition of architectural drawings 142 Lenore Tawney: A Retrospective, fiber art, traveling exhibition 142 Public Programs and Junior Museum activities 144-147 AUGUST 1990 Public Programs in The Kraft Education Center [formerly The Junior Museum], schedules 150-152 SEPTEMBER 1990 From Poussin to Matisse: The Russian Taste for French Painting , AIC publication and exhibition; The Hermitage, Leningrad, and Pushkin Museum, Moscow, cultural exchange program 153 The New Vision: Photography Between the World Wars, Ford Motor Company Collection from The Metropolitan Museum of Art, exhibition 153 Public Programs. Kraft Education Center, schedules 154-157 OCTOBER 1990 Ed Paschke: Paintings, exhibition venues; Ed Paschke: Drawings from Chicago Collections, complementary show 158 Public Programs. Kraft Education Center, schedules 160-164 NOVEMBER 1990 The Romantic Vision of Caspar David Friedrich: Paintings and Drawings from the USSR, exhibition venues; cultural exchange program 165 Public Programs. Kraft Education Center 167-171 DECEMBER 1990 New Acquisitions: Modernist Photography, exhibition; Recent Acquisitions from the Photography Collection, exhibition 172 Public Programs. Kraft Education Center 175-178 ",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.9"
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
        "total": 306,
        "limit": 10,
        "offset": 0,
        "total_pages": 31,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "press-releases",
            "api_link": "https://api.artic.edu/api/v1/press-releases/310",
            "id": 310,
            "title": "test",
            "timestamp": "2023-12-12T23:52:40-06:00"
        },
        {
            "_score": 1,
            "api_model": "press-releases",
            "api_link": "https://api.artic.edu/api/v1/press-releases/307",
            "id": 307,
            "title": "Christopher Maxwell to Join Art Institute of Chicago  as Samuel and M. Patricia Grober Curator of Applied Arts of Europe",
            "timestamp": "2023-12-12T23:52:40-06:00"
        },
        {
            "_score": 1,
            "api_model": "press-releases",
            "api_link": "https://api.artic.edu/api/v1/press-releases/306",
            "id": 306,
            "title": "The Art Institute Appoints David Nacol as the Vice President for Philanthropy",
            "timestamp": "2023-12-12T23:52:40-06:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.9"
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
        "version": "1.9"
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
        "total": 68,
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
        "version": "1.9"
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
        "total": 73,
        "limit": 10,
        "offset": 0,
        "total_pages": 8,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "educator-resources",
            "api_link": "https://api.artic.edu/api/v1/educator-resources/132",
            "id": 132,
            "title": "Kukuli Velarde: una mirada m\u00e1s cercana",
            "timestamp": "2023-12-12T23:53:42-06:00"
        },
        {
            "_score": 1,
            "api_model": "educator-resources",
            "api_link": "https://api.artic.edu/api/v1/educator-resources/131",
            "id": 131,
            "title": "Kukuli Velarde: A Closer Look",
            "timestamp": "2023-12-12T23:53:42-06:00"
        },
        {
            "_score": 1,
            "api_model": "educator-resources",
            "api_link": "https://api.artic.edu/api/v1/educator-resources/130",
            "id": 130,
            "title": "Georgia O\u2019Keeffe: una mirada m\u00e1s cercana",
            "timestamp": "2023-12-12T23:53:42-06:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.9"
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
        "web_url": "https://nocache.www.artic.edu/collection/resources/educator-resources/12-educator-resource-packet-a-boy-in-front-of-the-loews-125th-street-movie-theater-from-the-series-harlem-usa",
        "copy": " A Boy in Front of the Loews 125th Street Movie Theater is one of thirty photographs that constitute Harlem, U.S.A. , Dawoud Bey\u2019s first significant body of work. In this series, he explores a multitude of approaches towards representing the identities of Harlem and its black residents. This teaching packet includes an essay, discussion questions, activity ideas, a glossary, and images of three photographs from the series. ",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.9"
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
        "version": "1.9"
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
        "total": 20,
        "limit": 10,
        "offset": 0,
        "total_pages": 2,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "digital-catalogs",
            "api_link": "https://api.artic.edu/api/v1/digital-catalogs/38",
            "id": 38,
            "title": "Perspectives on Place",
            "timestamp": "2023-12-12T23:53:57-06:00"
        },
        {
            "_score": 1,
            "api_model": "digital-catalogs",
            "api_link": "https://api.artic.edu/api/v1/digital-catalogs/37",
            "id": 37,
            "title": "Perspectives on Data",
            "timestamp": "2023-12-12T23:53:57-06:00"
        },
        {
            "_score": 1,
            "api_model": "digital-catalogs",
            "api_link": "https://api.artic.edu/api/v1/digital-catalogs/36",
            "id": 36,
            "title": "Perspectives on In/stability",
            "timestamp": "2023-12-12T23:53:57-06:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.9"
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
        "version": "1.9"
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
        "total": 31,
        "limit": 2,
        "offset": 0,
        "total_pages": 16,
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
        "version": "1.9"
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
        "total": 40,
        "limit": 10,
        "offset": 0,
        "total_pages": 4,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "digital-publication-sections",
            "api_link": "https://api.artic.edu/api/v1/digital-publication-sections/35",
            "id": 35,
            "title": "Lookout Towers",
            "timestamp": "2023-12-12T23:54:03-06:00"
        },
        {
            "_score": 1,
            "api_model": "digital-publication-sections",
            "api_link": "https://api.artic.edu/api/v1/digital-publication-sections/37",
            "id": 37,
            "title": "Staging Site-Specific Installation Art in a Museum Context",
            "timestamp": "2023-12-12T23:54:03-06:00"
        },
        {
            "_score": 1,
            "api_model": "digital-publication-sections",
            "api_link": "https://api.artic.edu/api/v1/digital-publication-sections/36",
            "id": 36,
            "title": "Pots, Petroglyphs, and Pathways: The Mythical Killer Whale in Nasca Art",
            "timestamp": "2023-12-12T23:54:03-06:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.9"
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
        "version": "1.9"
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
        "total": 131,
        "limit": 2,
        "offset": 0,
        "total_pages": 66,
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
        "version": "1.9"
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
        "total": 134,
        "limit": 10,
        "offset": 0,
        "total_pages": 14,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "printed-catalogs",
            "api_link": "https://api.artic.edu/api/v1/printed-catalogs/211",
            "id": 211,
            "title": "David Goldblatt: No Ulterior Motive",
            "timestamp": "2023-12-12T23:54:16-06:00"
        },
        {
            "_score": 1,
            "api_model": "printed-catalogs",
            "api_link": "https://api.artic.edu/api/v1/printed-catalogs/210",
            "id": 210,
            "title": "Radical Clay: Contemporary Women Artists from Japan",
            "timestamp": "2023-12-12T23:54:16-06:00"
        },
        {
            "_score": 1,
            "api_model": "printed-catalogs",
            "api_link": "https://api.artic.edu/api/v1/printed-catalogs/208",
            "id": 208,
            "title": "Remedios Varo: Science Fictions",
            "timestamp": "2023-12-12T23:54:16-06:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.9"
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
        "version": "1.9"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
    }
}
```
:::

