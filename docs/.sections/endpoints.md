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
        "total": 116941,
        "limit": 2,
        "offset": 0,
        "total_pages": 58471,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/artworks?page=2&limit=2"
    },
    "data": [
        {
            "id": 14556,
            "api_model": "artworks",
            "api_link": "https://api.artic.edu/api/v1/artworks/14556",
            "is_boosted": false,
            "title": "Auvers, Panoramic View",
            "alt_titles": null,
            ...
        },
        {
            "id": 8961,
            "api_model": "artworks",
            "api_link": "https://api.artic.edu/api/v1/artworks/8961",
            "is_boosted": false,
            "title": "Head of Arthur Jerome Eddy",
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
        "version": "1.13"
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
        "total": 307,
        "limit": 10,
        "offset": 0,
        "total_pages": 31,
        "current_page": 1
    },
    "data": [
        {
            "_score": 226.74677,
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
            "timestamp": "2025-01-28T23:26:08-06:00"
        },
        {
            "_score": 210.08162,
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
            "timestamp": "2025-01-28T23:24:30-06:00"
        },
        {
            "_score": 207.76572,
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
            "timestamp": "2025-01-28T23:26:07-06:00"
        }
    ],
    "info": {
        "license_text": "The `description` field in this response is licensed under a Creative Commons Attribution 4.0 Generic License (CC-By) and the Terms and Conditions of artic.edu. All other data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.13"
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
        "version": "1.13"
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
        "total": 13785,
        "limit": 2,
        "offset": 0,
        "total_pages": 6893,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/agents?page=2&limit=2"
    },
    "data": [
        {
            "id": 36138,
            "api_model": "agents",
            "api_link": "https://api.artic.edu/api/v1/agents/36138",
            "title": "Ed Paschke",
            "sort_title": "Paschke, Ed",
            "alt_titles": [
                "Edward F. Paschke"
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
        "version": "1.13"
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
        "total": 16046,
        "limit": 10,
        "offset": 0,
        "total_pages": 1605,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "agents",
            "api_link": "https://api.artic.edu/api/v1/agents/74273",
            "id": 74273,
            "title": "Painter of Tarquinia RC 3984",
            "timestamp": "2025-01-29T14:00:49-06:00"
        },
        {
            "_score": 1,
            "api_model": "agents",
            "api_link": "https://api.artic.edu/api/v1/agents/74293",
            "id": 74293,
            "title": "Style of Andrea Riccio",
            "timestamp": "2025-01-29T14:00:49-06:00"
        },
        {
            "_score": 1,
            "api_model": "agents",
            "api_link": "https://api.artic.edu/api/v1/agents/74295",
            "id": 74295,
            "title": "Style of Jean Baptiste Huet",
            "timestamp": "2025-01-29T14:00:49-06:00"
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.13"
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
        "version": "1.13"
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
        "total": 1556,
        "limit": 2,
        "offset": 0,
        "total_pages": 778,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/places?page=2&limit=2"
    },
    "data": [
        {
            "id": -2147482747,
            "api_model": "places",
            "api_link": "https://api.artic.edu/api/v1/places/-2147482747",
            "title": "Knossos",
            "tgn_id": null,
            "source_updated_at": "1976-09-02T06:20:00-05:00",
            ...
        },
        {
            "id": -2147482751,
            "api_model": "places",
            "api_link": "https://api.artic.edu/api/v1/places/-2147482751",
            "title": "Bergama",
            "tgn_id": null,
            "source_updated_at": "1976-09-02T06:20:00-05:00",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Attribution 4.0 Generic License (CC-By) and the Terms and Conditions of artic.edu. Contains information from the J. Paul Getty Trust, Getty Research Institute, the Getty Thesaurus of Geographic Names, which is made available under the ODC Attribution License.",
        "license_links": [
            "https://creativecommons.org/licenses/by/4.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.13"
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
        "total": 4093,
        "limit": 10,
        "offset": 0,
        "total_pages": 410,
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
        "version": "1.13"
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
        "version": "1.13"
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
        "version": "1.13"
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
        "total": 102,
        "limit": 10,
        "offset": 0,
        "total_pages": 11,
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
            "api_link": "https://api.artic.edu/api/v1/galleries/2147474874",
            "id": 2147474874,
            "title": "Gallery 135",
            "timestamp": "2023-06-03T00:17:48-05:00"
        },
        {
            "_score": 1,
            "api_model": "galleries",
            "api_link": "https://api.artic.edu/api/v1/galleries/2147479698",
            "id": 2147479698,
            "title": "Gallery 248",
            "timestamp": "2023-03-31T00:17:32-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.13"
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
        "total": 6169,
        "limit": 2,
        "offset": 0,
        "total_pages": 3085,
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
        "version": "1.13"
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
        "total": 6505,
        "limit": 10,
        "offset": 0,
        "total_pages": 651,
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
        "version": "1.13"
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
        "version": "1.13"
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
            "source_updated_at": "1976-09-02T11:20:00-05:00",
            "updated_at": "2019-05-02T03:57:48-05:00",
            ...
        },
        {
            "id": 28,
            "api_model": "agent-types",
            "api_link": "https://api.artic.edu/api/v1/agent-types/28",
            "title": "Nonprofit",
            "source_updated_at": "1976-09-02T11:20:00-05:00",
            "updated_at": "2019-05-02T03:57:48-05:00",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.13"
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
        "source_updated_at": "1976-09-02T11:20:00-05:00",
        "updated_at": "2019-05-02T03:57:48-05:00",
        ...
    },
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.13"
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
            "id": 165,
            "api_model": "agent-roles",
            "api_link": "https://api.artic.edu/api/v1/agent-roles/165",
            "title": "Executor",
            "source_updated_at": "1976-09-02T06:20:00-05:00",
            "updated_at": "2022-11-04T10:30:30-05:00",
            ...
        },
        {
            "id": 544,
            "api_model": "agent-roles",
            "api_link": "https://api.artic.edu/api/v1/agent-roles/544",
            "title": "Joint Owner",
            "source_updated_at": "1976-09-02T06:20:00-05:00",
            "updated_at": "2022-11-04T10:30:28-05:00",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.13"
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
        "source_updated_at": "1976-09-02T11:20:00-05:00",
        "updated_at": "2019-05-02T03:57:47-05:00",
        ...
    },
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.13"
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
            "id": 55,
            "api_model": "artwork-place-qualifiers",
            "api_link": "https://api.artic.edu/api/v1/artwork-place-qualifiers/55",
            "title": "Inhabited place:",
            "source_updated_at": "2020-04-13T08:01:45-05:00",
            "updated_at": "2022-11-04T10:30:34-05:00",
            ...
        },
        {
            "id": 54,
            "api_model": "artwork-place-qualifiers",
            "api_link": "https://api.artic.edu/api/v1/artwork-place-qualifiers/54",
            "title": "Artist's culture:",
            "source_updated_at": "2020-04-14T04:36:05-05:00",
            "updated_at": "2022-11-04T10:30:34-05:00",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.13"
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
        "title": "Building address:",
        "source_updated_at": "1976-09-02T11:20:00-05:00",
        "updated_at": "2019-05-02T03:57:48-05:00",
        ...
    },
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.13"
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
            "updated_at": "2022-11-04T10:30:33-05:00",
            ...
        },
        {
            "id": 62,
            "api_model": "artwork-date-qualifiers",
            "api_link": "https://api.artic.edu/api/v1/artwork-date-qualifiers/62",
            "title": "Manufactured",
            "source_updated_at": "1976-09-02T11:20:00-05:00",
            "updated_at": "2019-05-02T03:57:47-05:00",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.13"
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
        "source_updated_at": "1976-09-02T11:20:00-05:00",
        "updated_at": "2019-05-02T03:57:47-05:00",
        ...
    },
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.13"
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
            "aat_id": 300185191,
            "source_updated_at": "2020-05-04T07:25:27-05:00",
            ...
        },
        {
            "id": 34,
            "api_model": "artwork-types",
            "api_link": "https://api.artic.edu/api/v1/artwork-types/34",
            "title": "Architectural Drawing",
            "aat_id": 300054197,
            "source_updated_at": "1976-09-02T06:20:00-05:00",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.13"
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
        "source_updated_at": "1976-09-02T11:20:00-05:00",
        ...
    },
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.13"
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
        "total": 9879,
        "limit": 2,
        "offset": 0,
        "total_pages": 4940,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/category-terms?page=2&limit=2"
    },
    "data": [
        {
            "id": "TM-260",
            "api_model": "category-terms",
            "api_link": "https://api.artic.edu/api/v1/category-terms/TM-260",
            "title": "coin",
            "subtype": "classification",
            "parent_id": null,
            ...
        },
        {
            "id": "TM-14212",
            "api_model": "category-terms",
            "api_link": "https://api.artic.edu/api/v1/category-terms/TM-14212",
            "title": "silkscreen",
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
        "version": "1.13"
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
        "total": 10338,
        "limit": 10,
        "offset": 0,
        "total_pages": 1034,
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
        "version": "1.13"
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
        "version": "1.13"
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
        "total": 284424,
        "limit": 2,
        "offset": 0,
        "total_pages": 142212,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/images?page=2&limit=2"
    },
    "data": [
        {
            "id": "3e9d8df5-8215-541a-23dc-127ef5b71cb0",
            "lake_guid": "3e9d8df5-8215-541a-23dc-127ef5b71cb0",
            "api_model": "images",
            "api_link": "https://api.artic.edu/api/v1/images/3e9d8df5-8215-541a-23dc-127ef5b71cb0",
            "title": "G51329-int",
            "type": "image",
            ...
        },
        {
            "id": "b272df73-a965-ac37-4172-be4e99483637",
            "lake_guid": "b272df73-a965-ac37-4172-be4e99483637",
            "api_model": "images",
            "api_link": "https://api.artic.edu/api/v1/images/b272df73-a965-ac37-4172-be4e99483637",
            "title": "IM049487",
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
        "version": "1.13"
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
        "total": 166765,
        "limit": 10,
        "offset": 0,
        "total_pages": 16677,
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
        "version": "1.13"
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

::: details Example request: https://api.artic.edu/api/v1/images/00004c7e-0917-73e2-f612-86ac3473f21c  
```js
{
    "data": {
        "id": "00004c7e-0917-73e2-f612-86ac3473f21c",
        "lake_guid": "00004c7e-0917-73e2-f612-86ac3473f21c",
        "api_model": "images",
        "api_link": "https://api.artic.edu/api/v1/images/00004c7e-0917-73e2-f612-86ac3473f21c",
        "title": "PD_26312",
        "type": "image",
        ...
    },
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.13"
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
        "version": "1.13"
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
            "timestamp": "2024-04-11T09:25:14-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.13"
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

::: details Example request: https://api.artic.edu/api/v1/videos/1ee4a231-0dad-2638-24fd-dfa2138eb142  
```js
{
    "data": {
        "id": "1ee4a231-0dad-2638-24fd-dfa2138eb142",
        "lake_guid": "1ee4a231-0dad-2638-24fd-dfa2138eb142",
        "api_model": "videos",
        "api_link": "https://api.artic.edu/api/v1/videos/1ee4a231-0dad-2638-24fd-dfa2138eb142",
        "title": "Digital Simulation: Original appearance of <em>For to Be a Farmer's Boy</em>",
        "type": "video",
        ...
    },
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.13"
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
        "total": 1906,
        "limit": 2,
        "offset": 0,
        "total_pages": 953,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/sounds?page=2&limit=2"
    },
    "data": [
        {
            "id": "bfe0cc09-cdb0-8ff1-5d23-b13ac4c41e29",
            "lake_guid": "bfe0cc09-cdb0-8ff1-5d23-b13ac4c41e29",
            "api_model": "sounds",
            "api_link": "https://api.artic.edu/api/v1/sounds/bfe0cc09-cdb0-8ff1-5d23-b13ac4c41e29",
            "title": "Podcast: Edward Hopper",
            "type": "sound",
            ...
        },
        {
            "id": "94eafb7b-f49e-2354-8f81-d0ddb81af06b",
            "lake_guid": "94eafb7b-f49e-2354-8f81-d0ddb81af06b",
            "api_model": "sounds",
            "api_link": "https://api.artic.edu/api/v1/sounds/94eafb7b-f49e-2354-8f81-d0ddb81af06b",
            "title": "Audio stop 804.mp3",
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
        "version": "1.13"
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
            "api_link": "https://api.artic.edu/api/v1/sounds/2cd4dbb3-c531-30e2-e05b-8f8c1b8bf3d3",
            "id": "2cd4dbb3-c531-30e2-e05b-8f8c1b8bf3d3",
            "title": "Audio Lecture: Tapestry Production at Gobelins in the 18th Century",
            "timestamp": "2023-02-14T15:28:13-06:00"
        },
        {
            "_score": 1,
            "api_model": "sounds",
            "api_link": "https://api.artic.edu/api/v1/sounds/40ea7a4c-5166-3d5d-846a-a0700ff2c848",
            "id": "40ea7a4c-5166-3d5d-846a-a0700ff2c848",
            "title": "Audio Lecture: Plot Lines: Spoken and Woven",
            "timestamp": "2023-02-14T15:28:13-06:00"
        },
        {
            "_score": 1,
            "api_model": "sounds",
            "api_link": "https://api.artic.edu/api/v1/sounds/4b1bfb0e-a8b3-b7c6-067e-8be1d5e70108",
            "id": "4b1bfb0e-a8b3-b7c6-067e-8be1d5e70108",
            "title": "Audio Lecture: Little-Known Construction Facts",
            "timestamp": "2023-02-14T15:28:13-06:00"
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.13"
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

::: details Example request: https://api.artic.edu/api/v1/sounds/0018fcf4-cf5c-03a3-3d9c-69c4b1ac5dcc  
```js
{
    "data": {
        "id": "0018fcf4-cf5c-03a3-3d9c-69c4b1ac5dcc",
        "lake_guid": "0018fcf4-cf5c-03a3-3d9c-69c4b1ac5dcc",
        "api_model": "sounds",
        "api_link": "https://api.artic.edu/api/v1/sounds/0018fcf4-cf5c-03a3-3d9c-69c4b1ac5dcc",
        "title": "Audio stop 510.mp3",
        "type": "sound",
        ...
    },
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.13"
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
        "total": 4480,
        "limit": 2,
        "offset": 0,
        "total_pages": 2240,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/texts?page=2&limit=2"
    },
    "data": [
        {
            "id": "1e2bed15-cd31-ee9b-c031-3faad4fd944b",
            "lake_guid": "1e2bed15-cd31-ee9b-c031-3faad4fd944b",
            "api_model": "texts",
            "api_link": "https://api.artic.edu/api/v1/texts/1e2bed15-cd31-ee9b-c031-3faad4fd944b",
            "title": "AREC_TR12063",
            "type": "text",
            ...
        },
        {
            "id": "999fc646-988c-0481-b0dc-5dce5cfde5f7",
            "lake_guid": "999fc646-988c-0481-b0dc-5dce5cfde5f7",
            "api_model": "texts",
            "api_link": "https://api.artic.edu/api/v1/texts/999fc646-988c-0481-b0dc-5dce5cfde5f7",
            "title": "Teacher Manual: Chicago: The City in Art: A Curriculum Guide for Teachers",
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
        "version": "1.13"
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
        "total": 3872,
        "limit": 10,
        "offset": 0,
        "total_pages": 388,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "texts",
            "api_link": "https://api.artic.edu/api/v1/texts/c36781a1-bb62-fc32-8b5c-e1b8337d0b19",
            "id": "c36781a1-bb62-fc32-8b5c-e1b8337d0b19",
            "title": "Andy_Warhol_by_Hand_Part_II.pdf",
            "timestamp": "2022-05-08T23:34:12-05:00"
        },
        {
            "_score": 1,
            "api_model": "texts",
            "api_link": "https://api.artic.edu/api/v1/texts/0ece123a-66ba-a605-3ba3-c9b7ae8772d5",
            "id": "0ece123a-66ba-a605-3ba3-c9b7ae8772d5",
            "title": "Davidson: Moments Alone.pdf",
            "timestamp": "2022-05-08T23:34:12-05:00"
        },
        {
            "_score": 1,
            "api_model": "texts",
            "api_link": "https://api.artic.edu/api/v1/texts/18bb775a-b092-8b00-6cdf-f78e1e01d897",
            "id": "18bb775a-b092-8b00-6cdf-f78e1e01d897",
            "title": "YEG_2018_Agenda-FINAL.pdf",
            "timestamp": "2022-05-08T23:34:12-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.13"
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

::: details Example request: https://api.artic.edu/api/v1/texts/003a874b-1325-1ae5-5679-568e2fa377fa  
```js
{
    "data": {
        "id": "003a874b-1325-1ae5-5679-568e2fa377fa",
        "lake_guid": "003a874b-1325-1ae5-5679-568e2fa377fa",
        "api_model": "texts",
        "api_link": "https://api.artic.edu/api/v1/texts/003a874b-1325-1ae5-5679-568e2fa377fa",
        "title": "AIC1926ChiArExh39thAn_comb.pdf",
        "type": "text",
        ...
    },
    "info": {
        "license_text": "The data in this response is licensed under a Creative Commons Zero (CC0) 1.0 designation and the Terms and Conditions of artic.edu.",
        "license_links": [
            "https://creativecommons.org/publicdomain/zero/1.0/",
            "https://www.artic.edu/terms"
        ],
        "version": "1.13"
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
        "total": 1947,
        "limit": 2,
        "offset": 0,
        "total_pages": 974,
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
        "version": "1.13"
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
        "total": 1758,
        "limit": 10,
        "offset": 0,
        "total_pages": 176,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "products",
            "api_link": "https://api.artic.edu/api/v1/products/288947",
            "id": "288947",
            "title": "Van Gogh Irises Enamel Pendant Necklace",
            "timestamp": "2024-10-01T23:10:40-05:00"
        },
        {
            "_score": 1,
            "api_model": "products",
            "api_link": "https://api.artic.edu/api/v1/products/251030",
            "id": "251030",
            "title": "Claude Monet Water Lilies Mug",
            "timestamp": "2024-09-26T23:10:04-05:00"
        },
        {
            "_score": 1,
            "api_model": "products",
            "api_link": "https://api.artic.edu/api/v1/products/284956",
            "id": "284956",
            "title": "Patricia Locke Curtain Call Crystal Necklace",
            "timestamp": "2024-09-26T23:10:21-05:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.13"
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

::: details Example request: https://api.artic.edu/api/v1/products/245260  
```js
{
    "data": {
        "id": 245260,
        "api_model": "products",
        "api_link": "https://api.artic.edu/api/v1/products/245260",
        "title": "M.C. Escher Tie\u2014Blue",
        "external_sku": 101022,
        "image_url": "https://shop-images.imgix.net101022_2.jpg",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.13"
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
            "id": 4475,
            "api_model": "tours",
            "api_link": "https://api.artic.edu/api/v1/tours/4475",
            "title": "Perfectly United and Infinitely Graceful",
            "image": "http://aic-mobile-tours.artic.edu/sites/default/files/tour-images/buddha-intro.jpg",
            "description": "<p>Explore the metaphysical and spiritual in this journey through the Alsdorf South and Southeast Asian collection at the Art Institute of Chicago.</p>\n",
            ...
        },
        {
            "id": 4219,
            "api_model": "tours",
            "api_link": "https://api.artic.edu/api/v1/tours/4219",
            "title": "Politics, Status, Fashion: The Arms and Armor Collection",
            "image": "http://aic-mobile-tours.artic.edu/sites/default/files/tour-images/aa-pistol-prepped.jpg",
            "description": "<p>Immerse yourself in the lives of royalty, warfare and sport, and Renaissance fashion in this audio tour for the Arms and Armor collection at the Art Institute of Chicago.</p>\n",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.13"
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
        "total": 27,
        "limit": 10,
        "offset": 0,
        "total_pages": 3,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "tours",
            "api_link": "https://api.artic.edu/api/v1/tours/5713",
            "id": 5713,
            "title": "Paula Modersohn-Becker: I Am Me Verbal Description Tour",
            "timestamp": "2024-11-21T23:05:39-06:00"
        },
        {
            "_score": 1,
            "api_model": "tours",
            "api_link": "https://api.artic.edu/api/v1/tours/3246",
            "id": 3246,
            "title": "Verbal Description tour: The Essentials",
            "timestamp": "2024-11-21T23:05:40-06:00"
        },
        {
            "_score": 1,
            "api_model": "tours",
            "api_link": "https://api.artic.edu/api/v1/tours/4405",
            "id": 4405,
            "title": "Founding Modern: Radical Design from the 19th Century",
            "timestamp": "2024-11-21T23:05:40-06:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.13"
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
        "version": "1.13"
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
        "version": "1.13"
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
        "total": 968,
        "limit": 10,
        "offset": 0,
        "total_pages": 97,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "mobile-sounds",
            "api_link": "https://api.artic.edu/api/v1/mobile-sounds/1419",
            "id": 1419,
            "title": "Punch Bowl",
            "timestamp": "2024-11-21T23:05:07-06:00"
        },
        {
            "_score": 1,
            "api_model": "mobile-sounds",
            "api_link": "https://api.artic.edu/api/v1/mobile-sounds/2355",
            "id": 2355,
            "title": "Punch Bowl (Visions of America)",
            "timestamp": "2024-11-21T23:05:07-06:00"
        },
        {
            "_score": 1,
            "api_model": "mobile-sounds",
            "api_link": "https://api.artic.edu/api/v1/mobile-sounds/226",
            "id": 226,
            "title": "Justus Sustermans",
            "timestamp": "2024-11-21T23:05:08-06:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.13"
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
        "version": "1.13"
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
                39452966156,
                39490616069,
                39571033406,
                39571596053,
                39571877378,
                39573565349,
                39573846681,
                39574128014,
                39574409348,
                39574690683,
                39574972019,
                39575253356,
                39575534694,
                39575816033,
                39576097373,
                39577222743,
                39577504088,
                39577785434,
                39578066781,
                39578348129,
                39578629478,
                39578910828,
                39579192179,
                39579473531,
                39579754884,
                39580036238,
                39580598949,
                39582287106,
                39582568469,
                39582849833,
                39583131198,
                39583412564,
                39583693931,
                39583975299,
                39584256668,
                39584538038,
                39585382154,
                39585663528,
                39585944903,
                39586226279,
                39586507656,
                39586789034,
                39587633174,
                39587914556,
                39588195939,
                39588477323,
                39588758708,
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
                39211480841,
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
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.13"
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
            "timestamp": "2025-01-01T03:05:16-06:00"
        },
        {
            "_score": 1,
            "api_model": "publications",
            "api_link": "https://api.artic.edu/api/v1/publications/7",
            "id": 7,
            "title": "Pissarro Paintings and Works on Paper at the Art Institute of Chicago",
            "timestamp": "2025-01-01T03:05:16-06:00"
        },
        {
            "_score": 1,
            "api_model": "publications",
            "api_link": "https://api.artic.edu/api/v1/publications/12",
            "id": 12,
            "title": "The Modern Series at the Art Institute of Chicago",
            "timestamp": "2025-01-01T03:05:16-06:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.13"
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
        "version": "1.13"
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
        "total": 1516,
        "limit": 2,
        "offset": 0,
        "total_pages": 758,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/sections?page=2&limit=2"
    },
    "data": [
        {
            "id": 1828804,
            "api_model": "sections",
            "api_link": "https://api.artic.edu/api/v1/sections/1828804",
            "title": "Mounting Evidence: Original Mounts on Early Matisse Drawings",
            "web_url": "https://publications.artic.edu/matisse/reader/works/section/1888",
            "accession": "1949.894",
            ...
        },
        {
            "id": 464158,
            "api_model": "sections",
            "api_link": "https://api.artic.edu/api/v1/sections/464158",
            "title": "Bertha Honor\u00e9 Palmer and Potter Palmer",
            "web_url": "https://publications.artic.edu/pissarro/reader/paintingsandpaper/section/955",
            "accession": "1922.423",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.13"
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
            "api_link": "https://api.artic.edu/api/v1/sections/39638298044",
            "id": 39638298044,
            "title": "Cat. 107 \u00a0Le sourire: Journal s\u00e9rieux, Sept. 19, 1899",
            "timestamp": "2025-01-01T03:06:20-06:00"
        },
        {
            "_score": 1,
            "api_model": "sections",
            "api_link": "https://api.artic.edu/api/v1/sections/39638579606",
            "id": 39638579606,
            "title": "Cat. 108 \u00a0Le sourire: Journal s\u00e9rieux, Oct. 13, 1899",
            "timestamp": "2025-01-01T03:06:20-06:00"
        },
        {
            "_score": 1,
            "api_model": "sections",
            "api_link": "https://api.artic.edu/api/v1/sections/39638861169",
            "id": 39638861169,
            "title": "Cat. 111 \u00a0Three People, a Mask, a Fox and a Bird, 1899",
            "timestamp": "2025-01-01T03:06:21-06:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.13"
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
        "version": "1.13"
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
        "version": "1.13"
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
        "version": "1.13"
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
        "version": "1.13"
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
        "total": 2370,
        "limit": 2,
        "offset": 0,
        "total_pages": 1185,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/events?page=2&limit=2"
    },
    "data": [
        {
            "id": 5072,
            "api_model": "events",
            "api_link": "https://api.artic.edu/api/v1/events/5072",
            "title": "Luminary Tour: El Greco\u2014Ambition and Defiance",
            "title_display": "Luminary Tour: <i>El Greco\u2014Ambition and Defiance</i>",
            "image_url": "https://artic-web-test.imgix.net/nullf8e8c674-5939-442b-a7cc-a46e0723964d/El-Greco-Assumption-of-the-Virgin-crop.jpg?rect=23%2C31%2C3952%2C2225&auto=format%2Ccompress&q=80&fit=crop&crop=faces%2Ccenter&w=1200&h=676",
            ...
        },
        {
            "id": 5071,
            "api_model": "events",
            "api_link": "https://api.artic.edu/api/v1/events/5071",
            "title": "Luminary Tour: El Greco: Ambition and Defiance",
            "title_display": "Luminary Tour: <i>El Greco\u2014Ambition and Defiance</i>",
            "image_url": "https://artic-web-test.imgix.net/nullf8e8c674-5939-442b-a7cc-a46e0723964d/El-Greco-Assumption-of-the-Virgin-crop.jpg?rect=0%2C105%2C3975%2C2235&auto=format%2Ccompress&q=80&fit=crop&crop=faces%2Ccenter&w=1200&h=675",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.13"
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
        "total": 2590,
        "limit": 10,
        "offset": 0,
        "total_pages": 259,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "events",
            "api_link": "https://api.artic.edu/api/v1/events/6028",
            "id": 6028,
            "title": "Teen Open Studio: Experimental Weaving",
            "timestamp": "2025-01-26T23:24:23-06:00"
        },
        {
            "_score": 1,
            "api_model": "events",
            "api_link": "https://api.artic.edu/api/v1/events/5988",
            "id": 5988,
            "title": "Drop-In Sketching (Dec 5)",
            "timestamp": "2025-01-26T23:24:23-06:00"
        },
        {
            "_score": 1,
            "api_model": "events",
            "api_link": "https://api.artic.edu/api/v1/events/5987",
            "id": 5987,
            "title": "Drop-In Sketching (Nov 7)",
            "timestamp": "2025-01-26T23:24:23-06:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.13"
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
        "image_url": "https://artic-web-test.imgix.net/22a002db-9695-452b-9c85-7a63644df4e0/G35154-int_press.jpg?rect=0%2C349%2C2334%2C1312&auto=format%2Ccompress&q=80&fit=crop&crop=faces%2Ccenter&w=1200&h=675",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.13"
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
        "total": 30,
        "limit": 2,
        "offset": 0,
        "total_pages": 15,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/event-occurrences?page=2&limit=2"
    },
    "data": [
        {
            "id": "b3e2e478-9f11-5eef-a3d3-24ce2b9eba1e",
            "api_model": "event-occurrences",
            "api_link": "https://api.artic.edu/api/v1/event-occurrences/b3e2e478-9f11-5eef-a3d3-24ce2b9eba1e",
            "title": "Gallery Tour (Monday at 3:00, Modern Wing start)",
            "event_id": 5638,
            "short_description": "Looking for a good place to start your museum visit? Join a knowledgeable guide for a 45-minute tour of museum icons and lesser-known treasures. This tour starts in the Modern Wing's Griffin Court.",
            ...
        },
        {
            "id": "b2b7f61a-6529-508a-a303-187bab192b09",
            "api_model": "event-occurrences",
            "api_link": "https://api.artic.edu/api/v1/event-occurrences/b2b7f61a-6529-508a-a303-187bab192b09",
            "title": "Gallery Tour (Monday at 3:00, Modern Wing start)",
            "event_id": 5638,
            "short_description": "Looking for a good place to start your museum visit? Join a knowledgeable guide for a 45-minute tour of museum icons and lesser-known treasures. This tour starts in the Modern Wing's Griffin Court.",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.13"
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
        "total": 332,
        "limit": 10,
        "offset": 0,
        "total_pages": 34,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "event-occurrences",
            "api_link": "https://api.artic.edu/api/v1/event-occurrences/3d5f9428-a5b8-5260-954c-f2f1950bc567",
            "id": "3d5f9428-a5b8-5260-954c-f2f1950bc567",
            "title": "Member Lecture: Myth & Marble\u2014Ancient Roman Sculpture from the Torlonia Collection",
            "timestamp": "2025-01-28T23:27:13-06:00"
        },
        {
            "_score": 1,
            "api_model": "event-occurrences",
            "api_link": "https://api.artic.edu/api/v1/event-occurrences/5556dd31-f4a1-5cab-93d5-456c4f13c753",
            "id": "5556dd31-f4a1-5cab-93d5-456c4f13c753",
            "title": "Member Lecture: Myth & Marble\u2014Ancient Roman Sculpture from the Torlonia Collection",
            "timestamp": "2025-01-28T23:27:13-06:00"
        },
        {
            "_score": 1,
            "api_model": "event-occurrences",
            "api_link": "https://api.artic.edu/api/v1/event-occurrences/2c58f4e5-9c7a-5a99-b9e3-f3e0f4e43b5e",
            "id": "2c58f4e5-9c7a-5a99-b9e3-f3e0f4e43b5e",
            "title": "Member Previews: Frida Kahlo's Month in Paris\u2014A Friendship with Mary Reynolds",
            "timestamp": "2025-01-28T23:27:13-06:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.13"
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

::: details Example request: https://api.artic.edu/api/v1/event-occurrences/1236fbaa-53c6-5a89-964f-c8bc800d5a15  
```js
{
    "data": {
        "id": "1236fbaa-53c6-5a89-964f-c8bc800d5a15",
        "api_model": "event-occurrences",
        "api_link": "https://api.artic.edu/api/v1/event-occurrences/1236fbaa-53c6-5a89-964f-c8bc800d5a15",
        "title": "Gallery Tour (Monday at 3:00, Modern Wing start)",
        "event_id": 5638,
        "short_description": "Looking for a good place to start your museum visit? Join a knowledgeable guide for a 45-minute tour of museum icons and lesser-known treasures. This tour starts in the Modern Wing's Griffin Court.",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.13"
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
        "version": "1.13"
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
        "total": 44,
        "limit": 10,
        "offset": 0,
        "total_pages": 5,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "event-programs",
            "api_link": "https://api.artic.edu/api/v1/event-programs/32",
            "id": 32,
            "title": "Holiday Art Making",
            "timestamp": "2025-01-28T23:30:03-06:00"
        },
        {
            "_score": 1,
            "api_model": "event-programs",
            "api_link": "https://api.artic.edu/api/v1/event-programs/105",
            "id": 105,
            "title": "Arts of Korea",
            "timestamp": "2025-01-28T23:30:03-06:00"
        },
        {
            "_score": 1,
            "api_model": "event-programs",
            "api_link": "https://api.artic.edu/api/v1/event-programs/103",
            "id": 103,
            "title": "Family Studio",
            "timestamp": "2025-01-28T23:30:03-06:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.13"
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
        "version": "1.13"
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
        "total": 406,
        "limit": 2,
        "offset": 0,
        "total_pages": 203,
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
            "id": 620,
            "api_model": "articles",
            "api_link": "https://api.artic.edu/api/v1/articles/620",
            "title": "Snow White and the Seven Dwarfs",
            "copy": " There\u2019s more than initially meets the eye to this exceptionally intricate lock, which was forged in iron by metalworker Frank Koralewsky and illustrates a scene from Grimms\u2019 \u201cSnow White and the Seven Dwarves.\u201d   Look closely and you\u2019ll probably see Snow White first\u2014she\u2019s stirring a cauldron over a fire in the cottage\u2019s kitchen. Let your eyes travel down down to her left and right and you\u2019ll see two dwarves entering with ingredients for her stew. The one to the left hauls a carrot and the one to the right lugs an oversized hare. A bit further to the right, two dwarves stand on andirons and manage the fire. And as you look toward the exterior of the scene, two more dwarves stand on guard. One just above Snow White turns a tiny knob, while the other is literally asleep on the job under a toadstool.   If you\u2019ve been counting carefully, you know that we\u2019ve only accounted for six dwarves so far. The last would have been perched on top of the key that would have unlocked this lock. The key isn\u2019t here, but see below for a historical picture.   Koralewsky was a German-born metalworker who immigrated to the United States in the early 20th century. He settled in Boston and joined the Boston Society of Arts and Crafts, which specialized in locksmithing and hardware. This delicate piece took Koralewsky seven years to complete, but it won the gold medal at the 1915 Panama-Pacific International Exposition. \u2014Katie Rahn ",
            "source_updated_at": "2018-08-08T11:13:55-05:00",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.13"
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
        "total": 498,
        "limit": 10,
        "offset": 0,
        "total_pages": 50,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "articles",
            "api_link": "https://api.artic.edu/api/v1/articles/1069",
            "id": 1069,
            "title": "Camille Claudel through Five Works",
            "timestamp": "2025-01-28T23:15:21-06:00"
        },
        {
            "_score": 1,
            "api_model": "articles",
            "api_link": "https://api.artic.edu/api/v1/articles/1077",
            "id": 1077,
            "title": "The Ocean's Currency: Cowrie Shells in African Art",
            "timestamp": "2025-01-28T23:15:21-06:00"
        },
        {
            "_score": 1,
            "api_model": "articles",
            "api_link": "https://api.artic.edu/api/v1/articles/998",
            "id": 998,
            "title": "To the Naked Eye: Using RTI to Reveal the Hidden",
            "timestamp": "2025-01-28T23:15:21-06:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.13"
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
        "version": "1.13"
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
        "total": 32,
        "limit": 2,
        "offset": 0,
        "total_pages": 16,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/highlights?page=2&limit=2"
    },
    "data": [
        {
            "id": 9,
            "api_model": "highlights",
            "api_link": "https://api.artic.edu/api/v1/highlights/9",
            "title": "international-modern-art",
            "copy": " Please note: artworks occasionally go off view for imaging, treatment, or loan to other institutions. Click on the images to ensure the work is currently on view.   One of the most iconic examples of Picasso\u2019s early Cubism, this portrait of the artist\u2019s dealer Daniel-Henry Kahnweiler (1884\u20131979) was created over more than 30 working sessions. With each sitting, Picasso further broke down and recombined the forms he saw, eventually arriving at a depiction of Kahnweiler as a network of shimmering, semitransparent surfaces that fracture into different planes and shapes.   One of Germany\u2019s leading modern painters, Gabrielle M\u00fcnter was known for her use of saturated color and loose brushwork verging on abstraction. Often using toys as the subjects of her still lifes, she infused her work with a liveliness and wit. Here, her painting includes a depiction of a wax doll made by her friend, the Russian dancer Alexander Sacharoff.   In his seminal 1912 publication, Concerning the Spiritual in Art , Vasily Kandinsky advocated an art that could move beyond imitation of the physical world, inspiring, as he put it, \"vibrations in the soul.\u201d Improvisation No. 30 (Cannons) \u2014one of the first works in which he attempted to depict those \u201cvibrations\u201d \u2014 is a standout work within the Art Institute\u2019s modern art collection, which includes five key paintings by Kandinsky.   This monumental painting is the result of an intense period of experimentation and revision for artist Henri Matisse. He originally painted the work as a pastoral scene of standing and seated bathers, but over the next decade he transformed it into the cubist-inflected composition seen today. When the painting was acquired by the Art Institute in 1953, Matisse told the museum\u2019s director that he viewed the painting as one of his five most pivotal works.   In 1913, on a transatlantic voyage to New York, Francis Picabia was amused by two fellow passengers: an exotic dancer and a Dominican priest, who could not resist the temptation of watching the dancer rehearse. In response, Picabia created this monumental canvas that evokes the sensations of dance and a ship moving through rolling seas. He titled the work Edtaonisl , an acronym made by alternating the letters of the French words \u00e9toile (star) and dans[e] (dance).   Among the most influential images in the early history of Surrealism, Giorgio de Chirico\u2019s The Philosopher\u2019s Conquest seems rife with meaning yet remains resolutely enigmatic. By juxtaposing incongruous objects, the artist sought to produce what he called art that resembles \u201cthe restlessness of myth.\u201d De Chirico\u2019s works profoundly affected artists associated with the Surrealist movement, who in the 1920s and 1930s used similarly unconventional pairings to explore the realm of the subconscious in their work.   While working in Russia in 1915, Kazimir Malevich invented Suprematism, a revolutionary mode of abstraction, which he considered a new type of realism. Breaking away from observed reality to focus instead on the relationships between colored geometric forms against a textured white background, the artist freed his compositions from traditional givens\u2014like top or bottom, left or right\u2014and presented everyday scenes, such as an athlete playing soccer, as if they existed in four dimensions.   Among the earliest proponents of abstract painting in Europe, Frantisek Kupka immigrated from Bohemia (in present-day Czech Republic) to Paris in 1896. Traveling to Paris and Chartres, France, he studied the stained-glass windows of Gothic and Romanesque cathedrals and created radiant abstractions that convey the feeling of light passing through colored glass.   Functioning simultaneously as an abstract painting and a concrete poem, Suzanne Duchamp\u2019s Broken and Restored Multiplication is filled with visual and verbal metaphors of disorder and breakage. In this collage-like array, she turns the iconic metal lattice of the Eiffel Tower upside-down, alerting us to the fragility, but also the flexibility, of systems such as language and memory that allow us to recognize our place in the world, even as it seems to be falling apart.   Constantin Br\u00e2ncu\u0219i's Golden Bird is an icon of modern sculpture and one of more than two dozen Bird sculptures the artist created in his quest for self-sufficient form. As Br\u00e2ncu\u0219i once said, \u201cAll my life, I have sought to render the essence of flight.\u201d In this work, details such as feet, a tail, and an upturned beak are barely suggested, and the elegant, streamlined silhouette of the polished bronze contrasts the rough-hewn wood base.   Piet Mondrian, a founding member of the revolutionary international movement De Stijl (the Style), argued that \u201cthe straight line tells the truth.\u201d Deceptively simple, his works are the result of constant adjustment to achieve absolute balance and harmony. In Lozenge Composition with Yellow, Black, Blue, Red, and Gray , Mondrian rotated a square canvas 90-degrees to create a dynamic relationship between the rectilinear composition and the diagonal lines of the edges of the support.   One of the most prolific artists of the 20th century, Picasso arguably influenced the direction of modern art more than any other single figure. In this work, a portrait of Marie-Th\u00e9r\u00e8se Walter, he used an approach inflected by both Cubism and Surrealism, depicting Walter\u2019s face from a frontal and profile view simultaneously.   Although Marcel Duchamp began his career as a painter, he is best known for his attempts to prove the end of \u201cretinal art,\u201d or artworks created to please the eye. His answer was the \u201creadymade,\u201d an ordinary object transformed into a work of art simply by means of its selection and designation as such by an artist. His Bottle Rack , first realized in 1914, is the earliest work of this type, and was acquired by the Art Institute in 2018. Learn more about Duchamp\u2019s Bottle Rack on the museum\u2019s blog .   Among the boldest and the most brilliantly colored of all of Max Beckmann\u2019s self-portraits, this was perhaps the last painting the artist completed in Berlin before he and his wife fled to the Netherlands\u2014just two days after Adolf Hitler delivered a speech condemning modern art. In 1937, shortly after this work was made, more than 500 of his works were confiscated from German public collections.   White Crucifixion represents a critical turning point for Marc Chagall and for the history of 20th-century art: it was the first of a series of compositions in which the artist portrayed Christ as a Jewish martyr and identified the Nazis with Christ\u2019s tormentors. Painted in response to the terror and trauma of Kristallnacht, an anti-Jewish pogrom, this work is among the most overtly political paintings of Chagall\u2019s career. ",
            "source_updated_at": "2020-05-28T06:33:12-05:00",
            ...
        },
        {
            "id": 6,
            "api_model": "highlights",
            "api_link": "https://api.artic.edu/api/v1/highlights/6",
            "title": "american-art",
            "copy": " Please note: artworks occasionally go off view for imaging, treatment, or loan to other institutions. Click on the images to ensure the work is currently on view.   Georgia O\u2019Keeffe didn't travel in an airplane until she was in her 70s, but when she did, she was fascinated. She started a series of paintings inspired by her in-flight experiences. The works began small and progressively got bigger until the final canvas in the series, Sky above Clouds IV , which is so large that it has never traveled since coming to the Art Institute.   One of America's most famous paintings, American Gothic , debuted at the Art Institute of Chicago, winning a $300 prize and instant fame for Grant Wood. It has long been parodied and is often seen as a satirical commentary on the Midwestern character, but Wood intended it to a positive statement about rural American values. Read more about this work on our blog, where a curator answers the top five FAQs about the iconic painting.   One of the best-known images of 20th-century art, Nighthawks depicts an all-night diner in which three customers, all lost in their own thoughts, have congregated. It's unclear how or why the anonymous and uncommunicative night owls are there\u2014in fact, Hopper eliminated any reference to an entrance to the diner. The four seem as separate and remote from the viewer as they are from one another. (The red-haired woman was actually modeled by the artist\u2019s wife, Jo.)   Known today for his paintings and murals depicting Mexican political and cultural life, Diego Rivera enjoyed a brief but sparkling period as a Cubist painter early in his career. In this work he portrayed his then-lover, the Russian-born painter and writer Marevna Vorob\u00ebv-Stebelska, clearly conveying her distinctive bobbed hair, blond bangs, and prominent nose\u2014despite or with the aid of the Cubist style. Like many other artists in Paris, Rivera rejected Cubism as frivolous and inappropriate following World War I and the Russian Revolution.   A native Chicagoan and graduate of the School of the Art Institute, Archibald Motley used his art to represent the vibrancy of African American culture, frequently portraying young, sophisticated city dwellers out on the town. One of Motley\u2019s most celebrated paintings, Nightlife depicts a crowded cabaret in the South Side neighborhood of Bronzeville. The dynamic composition, intense lighting, and heightened colors vividly express the liveliness of the scene.   The only American artist invited to exhibit with the French Impressionists, Mary Cassatt concentrated on the human figure, particularly on sensitive yet unsentimental portrayals of women and children. In The Child\u2019s Bath , one of Cassatt\u2019s masterworks, she used cropped forms, bold patterns and outlines, and a flattened perspective, all of which she derived from her study of Japanese woodblock prints.   Eldzier Cortor lived in Chicago and attended the School of the Art Institute, and while drawn to abstraction, he felt that it was not an effective tool for conveying serious social and political concerns. In The Room No. VI, the artist exposes the impoverished living conditions experienced by many African Americans on the South Side through a brilliant use of line and color, reinvigorating the idiom of social realism.   Though Stuart Davis studied with the so-called Ashcan School, who sought to depict a realistic look at modern urban life, he came to embrace a more abstracted and energetic style, as seen in Ready-to-Wear . The bright colors intersect and interrupt one another in a distinctly American way: jazzy, vital, and mass produced\u2014all qualities summed up in the title.   In addition to architecture, Frank Lloyd Wright designed furniture like this chair from his home in Oak Park, Illinois. Though his early experiments were heavy, solid cube chairs, he eventually added the refinements seen in this design, such as spindles, the subtly tapering crest rail, and gently curving leg ends, all of which produce an effect that is equal parts sophistication and simplicity.   In The Herring Net, Winslow Homer depicts two fishermen at their daily yet heroic work. As the small boat rides the swells, one fisherman hauls in the heavy net while the other unloads the glistening herring, illustrating that teamwork is essential for survival on this churning sea that both gives and takes. ",
            "source_updated_at": "2020-05-28T06:32:54-05:00",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.13"
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
        "total": 45,
        "limit": 10,
        "offset": 0,
        "total_pages": 5,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "highlights",
            "api_link": "https://api.artic.edu/api/v1/highlights/92",
            "id": 92,
            "title": "food-in-art",
            "timestamp": "2024-11-10T23:36:02-06:00"
        },
        {
            "_score": 1,
            "api_model": "highlights",
            "api_link": "https://api.artic.edu/api/v1/highlights/64",
            "id": 64,
            "title": "chicago-stories-a-celebration-of-our-city",
            "timestamp": "2024-11-10T23:36:03-06:00"
        },
        {
            "_score": 1,
            "api_model": "highlights",
            "api_link": "https://api.artic.edu/api/v1/highlights/3",
            "id": 3,
            "title": "what-to-see-in-an-hour",
            "timestamp": "2024-11-10T23:36:03-06:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.13"
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
        "source_updated_at": "2023-02-22T05:20:55-06:00",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.13"
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
        "version": "1.13"
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
        "total": 10,
        "limit": 10,
        "offset": 0,
        "total_pages": 1,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "static-pages",
            "api_link": "https://api.artic.edu/api/v1/static-pages/2",
            "id": 2,
            "title": "Events",
            "timestamp": "2025-01-29T14:20:13-06:00"
        },
        {
            "_score": 1,
            "api_model": "static-pages",
            "api_link": "https://api.artic.edu/api/v1/static-pages/3",
            "id": 3,
            "title": "Exhibitions",
            "timestamp": "2025-01-29T14:20:13-06:00"
        },
        {
            "_score": 1,
            "api_model": "static-pages",
            "api_link": "https://api.artic.edu/api/v1/static-pages/4",
            "id": 4,
            "title": "Upcoming Exhibitions",
            "timestamp": "2025-01-29T14:20:13-06:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.13"
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
        "version": "1.13"
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
        "total": 225,
        "limit": 2,
        "offset": 0,
        "total_pages": 113,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/generic-pages?page=2&limit=2"
    },
    "data": [
        {
            "id": 15,
            "api_model": "generic-pages",
            "api_link": "https://api.artic.edu/api/v1/generic-pages/15",
            "title": "Research Guides",
            "web_url": "https://nocache.staging.artic.edu/library/discover-our-collections/research-guides",
            "copy": null,
            ...
        },
        {
            "id": 347,
            "api_model": "generic-pages",
            "api_link": "https://api.artic.edu/api/v1/generic-pages/347",
            "title": "Researching a Chicago Neighborhood",
            "web_url": "https://nocache.staging.artic.edu/library/discover-our-collections/research-guides/researching-a-chicago-neighborhood-2",
            "copy": null,
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.13"
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
        "total": 214,
        "limit": 10,
        "offset": 0,
        "total_pages": 22,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "generic-pages",
            "api_link": "https://api.artic.edu/api/v1/generic-pages/248",
            "id": 248,
            "title": "Visitors Who Are Blind or Have Low Vision",
            "timestamp": "2025-01-28T23:39:23-06:00"
        },
        {
            "_score": 1,
            "api_model": "generic-pages",
            "api_link": "https://api.artic.edu/api/v1/generic-pages/43",
            "id": 43,
            "title": "Chicago Commercial, Residential, and Landscape Architecture, Pre-WWII",
            "timestamp": "2025-01-28T23:39:23-06:00"
        },
        {
            "_score": 1,
            "api_model": "generic-pages",
            "api_link": "https://api.artic.edu/api/v1/generic-pages/40",
            "id": 40,
            "title": "Sullivan, Wright, Prairie School, and Organic Architecture",
            "timestamp": "2025-01-28T23:39:23-06:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.13"
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
        "web_url": "https://nocache.staging.artic.edu/visit/free-admission-opportunities",
        "copy": null,
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.13"
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
        "total": 288,
        "limit": 2,
        "offset": 0,
        "total_pages": 144,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/press-releases?page=2&limit=2"
    },
    "data": [
        {
            "id": 60,
            "api_model": "press-releases",
            "api_link": "https://api.artic.edu/api/v1/press-releases/60",
            "title": "Press Releases from 1998",
            "web_url": "https://nocache.staging.artic.edu/press/press-releases/60/press-releases-from-1998",
            "copy": " To obtain the full text of any news releases in this index, please contact the Institutional Archives at reference@artic.edu or (312) 443-4777.   January 1998 Monthly Calendar New and continuing exhibitions, public programs, and lectures 1-6 On the Road to Italy: Early Paintings by Dutch Renaissance Master Jan Scorel, exhibition 1 Public programs, descriptions and changes 2 Elderhostel, educational travel program for senior citizens 4, 17, 71 Programs for Dr. Martin Luther King, Jr., Day 5 January 4, 1998 Women in Chicago Architecture, exhibition organized by AIC curator of Architecture Martha Thorne in collaboration with Chicago Women in Architecture 7-8 Love's Messenger: Tokens of Affection in the Victorian Age , gift box and book, replicas of Victorian valentines from Museum's holdings, text by Debra N. Mancoff 9-10 February 1998 Monthly Calendar New and continuing exhibition, public programs, and lectures 11-19 Baule: African Art / Western Eyes, exhibition 11, 31-34, 71 Bernini's Rome: Italian Baroque Terracotta from The State Hermitage, Russia; the Abbot Farsetti Collection 11 Images in Motion: Social Issues in Visual Art and Contemporary Dance , lecture series featuring David Rousseve of REALITY company, N.Y.; slide commentary on Museum's holdings by SAIC professor James Elkins 16 February 6, 1998 Japan 2000: Architecture for the Japanese Public, first installment of year-long exhibition series organized by AIC and The Japan Foundation; curator of Architecture Department John Zukowsky and guest curator Naomi R. Pollock; installation by Hiroshi Ariyama; lecture; funding 20-22, 37 February 11, 1998 Bernini's Rome: Italian Baroque Terracottas from The State Hermitage, St. Petersburg, Russia, exhibition; the Farsetti Collection; curator of European Decorative Arts and Sculpture, and Ancient Art Department Ian Wardropper; catalogue; funding 23-28 ; related events 29-30 Museum shop featuring Baule: African Art/ Western Eyes exhibition, catalogue, books and handcrafted items 31-34 February 20, 1998 Behind the Lions: a Family Guide to The Art Institute of Chicago , AIC publication for children and families with text by Steve Danzis and illustrations by David Lee Csicsko; book presentation 35-36, 38 March 1998 Monthly Calendar New and continuing exhibitions, public programs, and lectures 37-43 Japan 2000, architecture exhibition series in three installments: Architecture for Japanese Public; Design for Japanese Public; Kisho Kurokawa 37 Stairs and Elevators: The Ups and Downs of Architecture, exhibition of Chicago architectural firms 37 Kraft Education Center: Behind the Lions: Illustrations by David Csicsko, exhibition 38 March 31, 1998 Lake Front Millennium Project, Planned Development application for museum expansion over the train tracks; request for approval from City Plan Commission; statement by AIC Director and President James N. Wood 44-45 Museum shop, spring book events featuring photographer Danny Lyon and historian and filmmaker Michael Wood (PBS series) 46-47, 74 April 1998 Monthly Calendar New and continuing exhibitions, public programs, and lectures 49-54 Gift, Bequest, and Purchase: A Selection of Textile Acquisitions from 1993-1997, exhibition 49 April 10, 1998 Constant Troyon's The Marsh : Precursor to Impressionism, exhibition 55-55r, 68 Meissen and Beyond: 18th Century European Porcelain from the Grober Collection, exhibition; the Grobers's long-term loan to Museum (1989) and endowment for Decorative Arts galleries (1992); works on view 56-57, 68 Museum shop (including satellite locations), special trunk shows: Vessel Amber Jewelry, Judith Jack Marcasite Jewelry, Limoges, Russian Lacquer 58-60 April 15, 1998 Gift, Bequest, and Purchase: A Selection of Textile Acquisitions from 1993-1997 , exhibition, works on view 49, 61-65 The Pocket-Guide to the AIC , foreign-language editions 66-67 May 1998 Monthly Calendar A New Campus Center: The IIT Competition Results, exhibition of works submitted for The Richard H. Driehaus Foundation International Design Competition 68 All Around the House: Photographs of American Jewish Communal Life by Jay Wolke, exhibition 69, 79-84 A Measure of Nature: Landscape Photographs from the Permanent Collection, exhibition 69 Artist's Lithographs: A Bicentennial Celebration, exhibition marking 200th anniversary since the invention of lithographic printing technique 69, 88-89 May 1, 1998 Garden Restaurant, opening, Jazz in the Garden, 18th season of Ray Bailey Quintet 77-77r 9th Annual Schiff Foundation fellowship for Architecture Award presented by AIC Department of Architecture; prize-winner John Joyce; jury 78-78r May 6, 1998 All Around the House: Photographs of American Jewish Communal Life , exhibition catalogue by Joel Snyder of University of Chicago with preface by curator of AIC Photography Department David Travis 79-81 ; exhibition project by Chicago-based photographer and coordinator of Documentary Photography Graduate Studies at the Institute of Design (IIT) Jay Wolke 69, 82-84 Songs on Stone: James McNeill Whistler and the Art of Lithography, exhibition, installation conceived by curator of Prints and Drawings Martha Tedeschi and designed by John Vinci and Ward Miller of Vinci/Hamp Architects; overview by rooms 85-86 ; venue in The National Gallery of Canada; The Lithographs of James McNeill Whistler , two-volume catalogue, AIC publication edited and written by Martha Tedeschi and Harriet Stratis, with contributions by Nesta Spink, Britt Salvesen, Katharine Lochnan, Nicholas Smale, and Kevin Sharp; The Mansfield-Whittemore-Crown Collection of Whistler's lithographs on long-term loan at AIC placed by The Arie and Ida Crown Memorial(1983), grant for the publication; New Light on James McNeill Whistler , symposium 90-96, 98 Artists' Lithographs: A Bicentennial Celebration, exhibition concurrent with James McNeill Whistler retrospective; the 200th anniversary of the invention of lithography 69, 88-89 June 1998 Monthly Calendar New and continuing exhibitions, public programs, and lectures. Kraft Education Center 98-110 Japan 2000: Design for the Japanese Public, second exhibition of the series; industrial design 98 Kraft Center, Drawing on Stone: The Art of Lithography, exhibition and workshop 99 Kraft Center, Family and Friends: Picture Book from Studio Goodwin Sturges, Boston, MA, exhibition 99 July 1998 Monthly Calendar Suggested museum admission fees increase; announcement of regular hours of operation on holidays (with exception to Christmas and Thanksgiving Day) 105 Continuing exhibitions, public programs, and lectures. Kraft Education Center 105-110 July 1, 1998 3rd Annual Kaleidoscope: a Family Day, free admission and programs made possible by Lila Wallace-Reader Digest Fund and The Allstate Foundation 111-114r July 8, 1998 Pass It On: Celebrating Families, exhibition, highlights of the show and events 113-114r August 3, 1998 1998-1999 TEXTILE EXHIBITION SCHEDULE ( 115-115r ) Revival and Reform: A Growing 19th Century Textile Collection, exhibition, curator of Textile Department Christa C. Thurman 115 20th Century Textile Artist, exhibition, curator of Textile Department Christa C. Thurman 115r Ikat: Splendid Silks from Central Asia, exhibition featuring the 1997 George Wittenborn Memorial award-winning catalogue Ikat: Silks of Central Asia: the Guido Goldman Collection by Kate FitzGibbon and Andrew Hale; AIC installation coordinated by curator of Textiles Department Christa C. Thurman 115r August 3, 1998 1998-1999 PHOTOGRAPHY EXHIBITION SCHEDULE ( 116-118 ) In Place of Prairie: Photographs by Terry Evans, exhibition organized in cooperation with the Open Lands Project, curator of Photography Department David Travis 116 Julia Margaret Cameron's Women, exhibition, curator of Photography Sylvia Wolf; catalogue and venues 117 River of Color: The India of Raghubir Singh, exhibition, curator of Photography Department David Travis; related publication 118 Yasuhiro Ishimoto: A Tale of Two Cities, exhibition of street photography including works from Ishimoto's books Someday, Somewhere (1958) and Chicago, Chicago (1969); AIC exhibition publication by curator of Photography Colin Westerbeck with contributions by Arata Isozaki and Fuminori Yokoe 118 August 3, 1998 1998-1999 ARCHITECTURE EXHIBITION SCHEDULE ( 119-121 ) Architecture for Children, exhibition from two-year series on projects by Chicago architects, curated by Martha Thorne 119 Japan 2000: Kisho Kurokawa, international exhibition from Royal Institute of British Architects (RIBA); Chicago showing coordinated by curator of Architecture Department John R. Zukowsky; final installment of Japan: 2000 exhibition series; Kisho Kurokawa: From the Age of Machine to the Age of Life , catalogue edited by Dennis Sharp 119 The Plan of Chicago, exhibition commemorating the 90th anniversary since publication of Plan of Chicago rendered by Daniel Burnham and Edward H. Bennett; curator of Architecture Department John R. Zukowsky 120 The Pritzker Architecture Prize: 1979-1999, exhibition of works by prize winners: Philip Johnson, James Stirling, Hans Hollein, Richard Meier, Kenzo Tange, Frank Gehry, and Robert Venturi; curator of Architecture Martha Thorne, catalogue 121 August 3, 1998 MAJOR EXHIBITIONS FOR 1998-1999 ( 122-128 ) Ancient West Mexico: Art of the Unknown Past, exhibition, curator of African and Amerindian Art Department Richard Townsend, catalogue 123 ; symposium 148 Julia Margaret Cameron's Women, exhibition, curator of Photography Sylvia Wolf, catalogue and venues 117, 123-124 Mary Cassatt: Modern Woman, exhibition, curator of American Arts Department Judith A. Barter, catalogue and venues 124-125, 132-133, 141-145, 168 Japan 2000: Kisho Kurokawa, international exhibition from Royal Institute of British Architects; Chicago showing curated by John R. Zukowsky; catalogue 125, 147 Revival and Reform: A Growing 19th Century Textile Collection, exhibition, curator of Textile Department Christa C. Thurman 125 Masterpieces from Central Africa: Selections from the Belgian Royal Museum for Central Africa, Tervuren; Chicago showing coordinated by curator of African Art Kathleen Bickford; catalogue 126, 186 Gustave Moreau, exhibition organized by AIC, The Metropolitan Museum of Art, N.Y., and Reunion des Musees Nationaux, Paris; curator of European Painting Larry J. Feinberg and curator of European Painting and Prints and Drawings Departments Douglas Druick 127 Land of the Winged Horseman: Art in Poland, 1571-1764, traveling exhibition from museums of Warsaw and Krakow, Poland, organized by Art Services International and Walter Art Gallery, Baltimore; Chicago showing coordinated by curator of European Decorative Arts Department Ian Wardropper 127 September 12, 1998 In Place of Prairie: Photographs by Terry Evans, exhibition in celebration of 35th anniversary of the Open Lands Project 131 September 22, 1998 Mary Cassatt: Modern Woman , AIC exhibition catalogue with essays by Judith A. Barter, Andrew J. Walker, Kevin Sharp, Harriet K. Stratis, Erica E. Hirshler, George T.M. Shackelford; exhibition and catalogue made possible by Sara Lee Corporation and Henry Luce Foundation 132-133 American Arts in The Art Institute of Chicago: From Colonial Times to World War I , AIC publication with essays by Judith A. Barter, Kimberly Rhodes, Seth A. Thayer and Andrew J. Walker; research on American Arts collections and acquisitions 135-136 Museum shop, featuring Mary Cassatt retrospective 137-140 Mary Cassatt: Modern Woman, exhibition organized by AIC and Museum of Fine Arts, Boston; curator of American Arts Department Judith A. Barter; catalogue and venues; Cassatt's Modern Women mural for the 1893 Columbian Exposition and prints acquired by Bertha Honore Palmer 141-145 ; ticketing 146 ; Chamber Music Series, The Chicago Symphony 167 October 1998 Monthly Calendar New and continuing exhibitions, public programs, and lectures. Kraft Education Center 146-154 Kraft Center, Fairy Tales and Other Stories: Illustrations by Paul O. Zelinsky, exhibition including book awarded the 1998 Caldecott Medal 147 October 15, 1998 Japan 2000: Kisho Kurokawa, final installment of the series; international exhibition organized by the Kisho Kurokawa Retrospective Committee and circulated by Royal Institute of British Architects (RIBA); AIC showing coordinated by curator of Architecture Department John R. Zukowsky; catalogue 20-22, 37, 119, 125, 147, 155-158 October 30, 1998 Museum shop, Trunk Shows, Twilight Shopping, and annual Festival of Children's Books; Charles Martine Limoges, Caithness Paperweight signing event, Dale Tiffany Lamp Promotion, Judith Jack Marcasite Jewelry, Vessel International Amber, Blenko Glass signing event, Ala Jaron Jewelry 156-163 October 1998 Monthly Calendar New and continuing exhibitions, public programs, and lectures. Kraft Education Center 164-170 Woman as Artist and Subject: Mary Cassatt, Julia Margaret Cameron, and 19th Century Art and Culture , symposium 168 November 5, 1998 Holiday family programs and lectures, 7th Annual Wreathing of the Lions, event at Museum main entrance; caroling on the Grand Staircase: Songs for the Season; Dine with Dickens; Holiday Treasures and Tea; Holly Days 168, 171-175 November 6, 1998 8th Annual Fall Festival of Children's Books 176-179 November 13, 1998 Museum shop, merchandise for Holiday season, Twilight Shopping, Trunk Shows 180-182 (Un)Conscious Articulations: Fifty Drawings by Arturo Herrera, works on paper from Susan and Lewis Manilow Collection (Chicago); exhibition curated by Raymond Hernandes-Duran, MacArthur Fellow in the Department of Prints and Drawings 183-185 December 1998 Monthly Calendar New and continuing exhibitions, public programs, and lectures. Kraft Education Center 186-192 December 8, 1998 \"ODADAA!\", concert by Ghanaian musicians and dancers for the opening of exhibition titled Masterpieces from Central Africa: Selections from the Royal Belgian Museum, Tervuren 193-194 December 11, 1998 Masterpieces from Central Africa: Selections from the Royal Belgian Museum for Central Africa, Tervuren, final US venue of the international exhibition coordinated by The Tribal Art Center, Basel, Switzerland; catalogue and events 126, 186, 193-201, 204-207 Gifts of Lifetime: Old Master Drawings from the Collection of Dorothy Braude Edinburg, exhibition of partial and promised gifts to the Harry B. and Bessie K. Braude Memorial Collection in AIC; curator of Earlier Prints and Drawings Suzanne Folds McCullagh 186, 202-203 December 28, 1998 Museum shop featuring exhibition Masterpieces from Central Africa, Belgian Royal Museum, Tervuren; related titles and handcrafted items 204-207 ",
            ...
        },
        {
            "id": 56,
            "api_model": "press-releases",
            "api_link": "https://api.artic.edu/api/v1/press-releases/56",
            "title": "Press Releases from 1994",
            "web_url": "https://nocache.staging.artic.edu/press/press-releases/56/press-releases-from-1994",
            "copy": " To obtain the full text of any news releases in this index, please contact the Institutional Archives at reference@artic.edu or (312) 443-4777.   January 1994 Monthly Calendar Graphic Tours: Travel and 19th Century: French Works on Paper, exhibition 235, 245-247 Edvard Munch and Alban Berg Exhibition 235, 248-250 Recent Acquisitions: 20th Century Works on Paper in the Department of Prints and Drawings, exhibition 235 New and continuing exhibitions, public programs, and lectures 235-240 Martin Luther King, Jr., program 240 January 4, 1994 Correction for African American History Month programs 241 January 6, 1994 Museum Studies (v. 19, no. 2), AIC periodical surveying museum acquisitions since 1980 selected by AIC Director and President James N. Wood with essays by editor of Publication Department Margherita Andreotti and Museum curators Ghenette Zelleke, David Travis, and James Ulak 242-244 January 24, 1994 Graphic Tours: Travel and 19th Century French Works on Paper, exhibition coordinated by curator of Prints and Drawings Martha Tedechi and research assistant Jay Clarke in collaboration with Northwestern University students granted by the Andrew W. Mellon Program in art objects and museum internship 245-247 ; Ed Paschke, department chairman at Northwestern University, Chicago 247 January 25, 1994 Violent Passions: Edvard Munch and Alban Berg, Lyric Opera of Chicago production in association with exhibition at AIC 235, 248-250 Museum shop, Valentine's Day gift ideas 251-254 ; the Hodge Collection of valentines in Prints and Drawings Department, facsimiles 251 ; first American valentine card, adaptation from the 1849 original 251 February 1994 Monthly Calendar With Open Eyes: Images from the Art Institute , AIC laser disc publication and interactive exhibition 255, 268-270 Exhibition of Daniel Libeskind and The Jewish Museum in Berlin 255 The Drawings of Joseph Beuys, exhibition 255, 261-267 Continuing exhibitions, public programs, and lectures 256-260 Chicago Symphony Chamber Music Series at AIC 257 February 4, 1994 Thinking is Form: the Drawings of Joseph Beuys 255, 261-267 ; exhibition venues 264 ; the artist's visit to Chicago and SAIC in 1974, 266-267 With Open Eyes: A Multimedia Exploration of Art , AIC electronic publication, demonstration and contents 255, 268-270 February 15, 1994 The Lila Wallace-Reader's Digest Fund, grant for African Arts collection; remarks by AIC Director and President James N. Wood 271-273 March 1994 Monthly Calendar Textile Acquisitions from 1988-1992, 274, 290-292, 380 Continuing exhibitions, public programs, and lectures 274-279 March 4, 1994 Retrospective exhibitions of Odilon Redon and Goya 280-283 March 14, 1994 Lessons from Life: Photographic Works from the Boardroom Collection of Martin Edelston, exhibition and gift of the collection; remarks by AIC Director and President James N. Wood 274, 284-286 March 16, 1994 Museum shop, Easter and Passover gift ideas 287-289 March 23, 1994 Selected Textile Acquisitions, 1988-1992, exhibition 274, 290-292 March 24, 1994 Dr. Charles Stuckey, Head of the Department of 20th Century Painting and Sculpture; Frances and Thomas Dittmer endowment for a curatorial chair as a part of AIC Board of Trustees capital campaign entitled The Second Century Fund: Securing Chicago's Masterpiece; remarks by AIC Director and President James N. Wood 293-294 April 1994 Monthly Calendar Reinstallation of Ancient Art Galleries in McKinlock Court; Robinson Glass Collection 295, 378 ; events 309 Continuing exhibitions, public programs, and lectures 296-301 April 4, 1994 Dr. Yutaka Mino, Head of Asian Art Department, resignation; comments by AIC Director and President James N. Wood 302-303 April 11, 1994 The Art of Horace Pippin, exhibition; Dr. Albert C. Barnes, collector 295, 304-308 ; exhibition venues 308 ; events 354-355 April 15, 1994 Kraft Education Center: Eric Beddows exhibition 301, 309-310 April 21, 1994 Spring book signing events at Museum shop featuring Judith Stein, Lynn H. Nicholas, Naomi Shihab Nye, Nancy Mathews, Eric Beddows, Annette Blaugrund, Meredith Etheringston-Smith, Eleni Fourtouni, Theodore E. Stebbins, Humphrey Wine 311-315 April 24, 1994 John James Audubon: The Watercolors for The Birds of America , exhibition from The New York Historical Society collection, venues and catalogue 316-320, 329 April 27, 1994 Museum shop, gift ideas for Mother's Day 321-324 April 28, 1994 The Actor's Image: Printmakers of the Katsukawa School , AIC publication by keeper of the Buckingham Print Collection Osamu Ueda 325-328 May 1994 Monthly Calendar Italian Sculpture, 1860-1925, from the Gilgore Collection, exhibition 329, 337-339 The Golden Age of Florentine Drawing: from Leonardo to Volterrano, exhibition 329-330, 341-343, 379 Continuing exhibitions, public programs, and lectures 330-336 May 9, 1994 Italian Sculpture, 1860-1925, from the Gilgore Collection 329, 337-340, 380 ; Sheldon and Irma Gilgore 337, 339 ; Chiseled with a Brush: Italian Sculpture, 1860-1925, from the Gilgore Collections , AIC publication by curator of European Decorative Arts Department Ian Wardropper 344-346 The Golden Age of Florentine Drawing: from Leonardo to Volterrano, exhibition 329-330, 340-343, 379 May 24, 1994 World Cup Soccer Games, Chicago Day, free museum admission 347-348 June 1994 Monthly Calendar Continuing exhibitions, public programs, and lectures 350-353 June 2, 1994 AIC and SAIC Summer Programs with Chicago Park District, Horace Pippin outdoor workshop 354-355 June 6, 1994 Museum shop, Father's Day gift ideas 356-360 Garden Restaurant, 14th season of Ray Bailey jazz quintet 361-362 June 8, 1994 Odilon Redon exhibition, installation and catalogue 372-375, 400 ; programs 368-372, 381 June 10, 1994 1994-1995 EXHIBITION SCHEDULE ( 376-389 ) Galleries of Ancient Art in McKinlok Court, reinstallation by Ian Wardropper and John Vinci 295, 309, 378 Knotted Splendor: European and Near Eastern Carpets from the Permanent Collection, exhibition 383, 413, 422-426, 446 Dieter Appelt, photography exhibition 385, 475-476, 479-480, 486 Gustave Caillebotte: The Urban Impressionist, exhibition 386 Louis Sullivan and the Prairie School, exhibition 386 Bruce Goff, exhibition of the artist's architectural archive and drawings from Architecture Department and AIC Ryerson and Burnham Libraries 387 June 20, 1994 Renzo Piano Building Workshop: Selected Projects, interactive exhibition, computer installation 382, 390-391 June 24, 1994 Goya: Truth and Fantasy, exhibition organized by Del Prado, Madrid and by Royal Academy of Arts, London, catalogue 382, 392-395 ; programs 396-399, 401, 408 July 1994 Monthly Calendar New and continuing exhibitions, public programs, and lectures 402-407 July 22, 1994 Celebrating America: A Collection of Poems and Images of American Spirit , children's book compiled by L. Whipple, AIC publication 409-410 July 26, 1994 Transforming Vision: Writers on Art , AIC publication 411-412, 435, 460 August 1994 Monthly Calendar New and continuing exhibitions, public programs, and lectures 413-417 August 2, 1994 Illustrations by Leovigildo Martinez and Leyla Torres, exhibition 418-420, 492 ; Martinez and Matthew Gollub, book signing event 419 Up and Down, All Around , AIC video release for children 421 August 4, 1994 Knotted Splendor: European and Near Eastern Carpets, exhibition 413, 422-426 ; curator of Textile Department Christa Thurman 426 ; carpet adaptations in Museum shop 427-428, 446 ; Textile Department, funding 428 September 1994 Monthly Calendar British Delft From Colonial Williamsburg, exhibition from collection of The Colonial Williamsburg Foundation, VA, 429 Continuing exhibitions, public, programs, and lectures 439-433 September 12, 1994 Museum shop, 1994-1995 Holiday Gift Catalogue 434-437 Museum Studies , AIC periodical (vol. 20, no. 2), special issue featuring Winterbotham Collection of European Paintings 438-439 September 14, 1994 Karl Friedrich Schinkel, 1781-1841: The Drama of Architecture 384, 440-443, 463,486, 489, 501-502 ; installation 442-443 ; Stanley Tigerman 463 ; curators Kurt Foster, John Zukowsky 442-443 ; Exhibition of Karl Schinkel's textile design, gift of Ruth Blumka in memory of John Maxon, comments by Christa Thurman 444-445 , 486 September 20, 1994 Museum shop, Fall trunk shows: Minasian rugs, Halcyon Days Enamels, Limoges, Antique jewelry, Noguchi lamps, Caithness paperweights, Maximal Jewelry, Recife pens; Twilight Shopping 446-449 September 22, 1994 Julia Perkins, appointed Assistant Director for Community Programs in the Museum Education Department; Lila Wallace-Reader's Digest Fund, Refocus/Resources Initiative for African-American community, funding 450-451 September 23, 1994 Architecture gallery, dedication in the name of Dr. Kisho Kurokawa (Japan); The Japan Foundation gallery endowment; lecture by the architect 452-454 September 28, 1994 Fall book signing events at the Museum shop featuring James Yood, Thomas Locker, Lois Ehlert and Sara Weeks, Victoria Lautman, Carlos Fuentes, Eleanor Dwight, Meryle Secrest 455-459 ; special event marking AIC publication of Transforming Vision: Writers on Art edited by Edward Hirsh; readings and book signing by Mark Strand, Reginald Gibbons, Jorie Graham, Li-Young Lee, Susan Mitchell, Gerald Stern, Gary Wills 460 (411-412, 435), 490 ; Festival of Children's Books 461 ; Bystander: A History of Street Photography , book by Joel Meyerowitz and AIC curator of Photography Colin Westerbeck 461, 503 September 29, 1994 Corporate Gift Program at the Museum shop 462a October 1994 Monthly Calendar Friedrich Schinkel, 1781-1841: The Drama of Architecture, installation by Stanley Tigerman 463 Continuing exhibitions, public programs, and lectures 463-471 October 7, 1994 Ryerson and Burnham Libraries, expansion and Reading Room restoration, comments by Director of AIC Libraries Jack Perry Brown; architectural firm of Shepley, Coolidge and Root; description of the 1901 original decor, Elmer E. Garnsey's design and Louis J. Millet's skylight; conversion of card catalogue into on-line computerized information system made possible by Rosenbaum Foundation, Rice Foundation, and Mellon Foundation; renovation of office and stack spaces, electronically operated storage system 472-474 October 18, 1994 Transforming Visions: Writers on Art , AIC publication edited by Edward Hirsch; evening of readings by Mark Strand, Reginald Gibbons, Jorie Graham, Li-Young Lee, Susan Mitchell, Gerald Stern, Gary Wills 460 (411-412, 435), 484-485, 490 October 19, 1994 Dieter Appelt Exhibition, events, seminar, SAIC Visiting Artists program, lecture by the artist 475-476 ; Dieter Appelt , AIC publication by curator of Photography Sylvia Wolf, first English-language monograph on the artist 479-480, 486 November 1994 Monthly Calendar Continuing exhibitions, public programs, and lectures 486-494 5th Annual Chicago Humanities Festival 488 November 4, 1994 \"Wreathing the Lions\" event at Museum's main entrance 477, 481-483 ; second annual Christmas exhibition Glad Tidings of Great Joy coordinated by AIC deputy director Teri J. Edelstein, programs and lectures; Glad Tidings of Great Joy , AIC publication of Gospels 481, 486, 495-496 November 8, 1994 American Arts Department, Henry Luce Foundation grant for major publication, fellowship, and research of the department holdings coordinated by Department curator Judith A. Barter 497-500 November 21, 1994 Lyric Opera of Chicago concerts in association with Karl Friederich Schinkel exhibition 501-502 December 1994 Monthly Calendar New and continuing exhibitions, public programs, and lectures 503-510 Bystander: A History of Street Photography, exhibition and publication by Joel Meyerowitz and Colin Westerbeck 503 December 8, 1994 Three photography exhibitions: Bystander: A History of Street Photography; Joel Meyerowitz; Andre Kertez 511-512 December 27, 1994 African American History Month, 1995 events and program schedule 513-517 ; Joseph A. Yoakum exhibition 513-514 ",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.13"
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
        "total": 343,
        "limit": 10,
        "offset": 0,
        "total_pages": 35,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "press-releases",
            "api_link": "https://api.artic.edu/api/v1/press-releases/377",
            "id": 377,
            "title": "The Art Institute of Chicago Announces 2025 January-June Exhibition Schedule",
            "timestamp": "2025-01-28T23:42:03-06:00"
        },
        {
            "_score": 1,
            "api_model": "press-releases",
            "api_link": "https://api.artic.edu/api/v1/press-releases/375",
            "id": 375,
            "title": "Art Institute of Chicago Announces Top Acquisitions of 2024",
            "timestamp": "2025-01-28T23:42:04-06:00"
        },
        {
            "_score": 1,
            "api_model": "press-releases",
            "api_link": "https://api.artic.edu/api/v1/press-releases/373",
            "id": 373,
            "title": "Project A Black Planet: The Art and Culture of Panafrica",
            "timestamp": "2025-01-28T23:42:04-06:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.13"
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
        "web_url": "https://nocache.staging.artic.edu/press/press-releases/1/press-releases-from-1939",
        "copy": " To obtain the full text of any news releases in this index, please contact the Archives at reference@artic.edu or (312) 443-4777.   January 6, 1939 Scammon Lecture, The Spirit of Modern Building , given by Dr. Walter Curt Behrendt, Technical Director of Buffalo City Planing Association, N.Y., 1 January 7, 1939 Turkish and Italian Textiles in Paintings , lecture, given by Alan J. B. Wace, Keeper of Textiles in the Victoria and Albert Museum and professor of Classical Archaeology, Cambridge, England; members of Chicago Needlework and Textile Guild, listed 2 January 20, 1939 Lecture series, given by Dr. Maurice Gnesin, Director of Goodman Theatre and Head of AIC Goodman School of Drama 3 January 11, 1939 Comments on exhibitions: The French Romanticists Gros, Gericault, and Delacroix; Exhibition of Bonnard and Villard, Contemporary French Artists; Christmas Story in Art; George Grosz, His Art from 1918 to 1938; Architecture by Ludwig Mies Van Der Rohe; 34 Old Master Drawings, Lent by Sir Robert Witt of London; gallery tour for the Second Conference of Chicago Art Clubs 4-5 January 13, 1939 AIC major exhibitions of 1938, attendance record from Museum Registrar's Department 6 January 14, 1939 Scammon Lecture, Turner's Romantic Vision of Switzerland , given by Dr. Paul Ganz, Professor at University of Basle, Switzerland, biography note and publications 8 January 18, 1939 28th Annual Governing Members' Meeting, hosted by AIC President Mr. Potter Palmer; luncheon, list of participants 7 January 19, 1939 Kate S. Buckingham Memorial Lecture, Chinese Bronzes , given by AIC Assistant Director and Curator of Oriental Art Department Charles Fabens Kelley 9 January 21, 1939 The National Exhibition of Representative Buildings of the Post War Period, exhibition, organized and curated by American Institute of Architecture (AIA) 12 January 23, 1939 Annual Report for 1938, issued by Director of Fine Arts Daniel C. Rich and Director of Finance and Operation Charles H. Burkholder; major gifts and donations; Robert Allerton, gift for construction of the Decorative Arts Galleries; Mrs. Erna Sawyer Goodman, money gift, establishing William Owen Goodman Fund; attendance, membership, SAIC enrollment; major bequest of Ms. Kate Buckingham; Mrs. William O. Goodman Collection of pewter, gift to AIC; Superintendent's report on condition of skylight roof; Bartlett Lecture Series; funding for lectures and publications 10-11 Pablo Picasso: Forty Years of His Art, exhibition announcement, first collaborative project of AIC and The Museum of Modern Art, N.Y., 13, 102 January 25, 1939 43rd Annual Exhibition by Artists of Chicago and Vicinity, jury comprised of Donald Bear of Denver Art Museum, Clarence Carter of Carnegie Institute, Pittsburgh, and artists Mahonri H. Young of New York and Albin Polasek of Chicago; list of prizes 14, 19-20, 23, 25 January 26, 1939 Kate S. Buckingham Memorial Lecture, Chinese Terra Cotta Tiles , given by AIC Assistant Director and Curator of Oriental Art Department Charles Fabens Kelley 15 January 30, 1939 A Leading School of Buddhist Sculpture , lecture given by Dr. Osvald Siren of National Museum in Stockholm; biography note and comments on his collection and publications 16 SAIC 6th Annual Open House for alumni, governing members, trustees, friends of the School and officials; Glee Club concert under direction of AIC Assistant Director and Curator of Oriental Art Charles Kelley 17 January 31, 1939 Chicago High School Scholarship contest at SAIC; list of winners, Judith Pesman, Suzanne Siporin, Emil Grego, Joanne Kuper, and Joseph Strickland 18 Exhibition of Contemporary American Art at New York World's Fair 1939; proceedings and requirements; Chicago juries of New York World's Fair, represented by Aaron Bohrod, Ralph Clarkson, Mitchell Siporin, Daniel C. Rich (chairman of the Painting Jury), Sidney Loeb, Peterpaul Ott, Albin Polasek, George Thorp, Todros Geller, James Swann, Morris Topchevsky, Beatrice Levy, Charles Wilimovsky, and Lillian Combs 19-20 February 2, 1939 Kate S. Buckingham Memorial Lecture, Chinese Sculpture and Painting , given by AIC Assistant Director and Curator of Oriental Art Department Charles Fabens Kelley 21 February 4, 1939 Scammon Lecture, Six Dynasties and Early T'ang Painting , given by Laurence Sickman, curator of Oriental Art at William Rockhill Nelson Gallery of Art, Kansas City, MO; biography note 22 February 6, 1939 43rd Annual Exhibition by Artists of Chicago and Vicinity, opening, Artists' Dinner, hosted by AIC Director of Finance and Operation Charles H. Burkholder; guest speaker George Buehr, other guests included Mr. and Mrs. Potter Palmer, Mr. Paul Schulze, Mr. and Mrs. Charles Fabens Kelley, Mrs. Albion Headburg, and Ms. Eleanor Jewett 14, 19-20, 23, 25 February 13, 1939 The Making of a Cartoon , lecture and film demonstration, conducted by cartoonist of the Chicago Daily News Vaughn R. Shoemaker, complementing exhibition titled Original American Cartoons from Charles L. Howard Collection 24 February 14, 1939 AIC Exhibition Calendar for 1939 In the Department of Painting and Sculpture, curator Daniel Catton Rich, AIC Director: Chicago and Vicinity 43rd Annual Exhibition; Masterpiece of the Month: Portrait of Mrs. Wolff by Sir Thomas Lawrence; 18th International Exhibition of Watercolors; Annual Exhibition by Students of SAIC; 50th Annual Exhibition of American Painting and Sculpture: Half a Century of American Art 25 In the Children's Museum, curator Helen Mackenzie: The Making of a Masterpiece, exhibition, featuring altarpiece by Giovanni di Paolo of Sienna; Means and Methods of Water Color Painting 25 In the Blackstone Hall: Original American Cartoons from the Collection of Charles L. Howard of Chicago 26 In the Oriental Art Department, Curator Charles Fabens Kelley: two exhibitions from AIC Clarence Buckingham Collection of Japanese Prints, titled In Wind and Rain, and Blossom Viewing; Masterpiece of the Month: Imperial Jade Cup on Stand, 18th C., gift of Russell Tyson 26 In Prints Department, Acting Curator Lillian Combs: Selections from Lenora Hall Gurley Memorial Collection of Drawings; Recent Accessions in Prints, 1937-1939; Woodcuts from Books of the 15th Century; Masterpiece of the Month: The Lamentation from the Great Passion by Albrecht Durer; Prints by Old Masters from Clarence Buckingham Collection; The Bulls of Bordeaux by Francesco Goya; Sports in Prints 26 In the Decorative Arts Department, Curator Bessie Bennett: French Furniture and Sculpture, 18th C. from Henry Dangler Collection; Florence Dibell Bartlett Collection of Bonader from Sweden, 18th and 19th C.; English Architecture of 18th C.; Embroideries from The Greek Islands Lent by Elizabeth Day McCormick; Ecclesiastical Embroideries; English Embroideries; Exhibition of Embroideries by the Needlework and Textile Guild 27 General Information about Permanent collection and admission 27 February 15, 1939 Florence Dibell Bartlett Lecture, Adventures in the Arts , given by Helen Parker, Head of AIC Education Department 28 February 20, 1939 Antiquarian Society, Tea Party, honoring Elizabeth Day McCormick and exhibition of Embroideries from the Greek Islands; party specialties and participants 29, 59, 61 February 21, 1939 George Washington's Birthday, free Museum admission; Washington's portraits in AIC Permanent collection 30 February 25, 1939 Scammon Lecture, The Fountains of Florence , given by Bertha Wiles, Curator of Mark Epstein Library at University of Chicago 31 February 28, 1939 Scammon Lecture, The Artistic Relations of England and Italy , given by William George Constable of Boston Museum of Fine Arts; biography note, Mr. Constable, founder of the Courtauld Institute in London 33 March 2, 1939 New Light on Prehistoric Man , lecture and film demonstration, presented by Dr. Henry Field, and sponsored by Chicago Chapter of Archaeological Institute of America 32 Kate S. Buckingham Lecture, The Gothic Room , given by Bessie Bennett, AIC Curator of Decorative Arts 34 March 8, 1939 Goodman Theatre, performance of Alice in Wonderland for children from settlement houses and orphanages; list of participating institutions 36 March 9, 1939 Kate S. Buckingham Lecture, Prints by Old Masters, Including Rembrandt , given by Edith R. Abbot, artist and educator of The Metropolitan Museum, N.Y., biography note about Ms. Abbot 37 March 15, 1939 Frederick Arnold Sweet, appointed Assistant Curator of AIC Painting and Sculpture Department; Mr. Sweet's resume 38 March 17, 1939 Kate S. Buckingham Lectures, Master Etchers of the 19th Century , given by Head of Education Department Helen Parker; The English Lustre Ware Collection, given by AIC Director Daniel C. Rich 39 March 20, 1939 Opening reception for 18th International Water Color Show, works on view, including loans from Edward Hopper, John Whorf, and Henri Matisse 35 March 23, 1939 18th Annual International Water Color Exhibition; prizes and works on view; jury comprised of Grant Wood, Joseph W. Jicha of Cleveland, and Hubert Ropp of Chicago; concurrent exhibition in the AIC Children's Museum, explaining water color technique; biography notes about prize-winners, Everett Shinn and Dale Nichols 35, 40-42, 5I-52, 64 March 24, 1939 Kate S. Buckingham Lecture, The English Lustre Ware Collection , given by AIC Director Daniel C. Rich 43 March 28, 1939 AIC Curator of Decorative Arts Department Bessie Bennett (1870-1939), obituary; Ms. Bennet's AIC tenure, biography note, remarks by AIC President Mr. Potter Palmer 44-45 April 3, 1939 Easter Festivities at AIC, Monsalvat , performance by Dudley Crafts Watson; SAIC Glee Club concert under direction of Charles Fabens Kelley, sponsored in part by Mrs. James Ward Thorne 46 April 6, 1939 Albin Polasek, Head of Sculpture Department at SAIC, honored with award of merit by the National Institute of Immigrant Welfare, N.Y.; biography note and chronology 47-48 April 11, 1939 Glee Club, Eastern concert program 46, 49 50th Annual Exhibition of American Painting and Sculpture: Half a Century of American Art, retrospective, showing works from American Annual exhibitions held at AIC from 1888 to 1938; comments on the exhibition selection by AIC Director Daniel C. Rich 25, 50 3rd Conference of Art Chairmen; AIC Assistant Curator of Painting and Sculpture Frederick A. Sweet, speaking on 18th International Water Color Exhibition, comments and criticism 40-42, 51-52, 64 April 13, 1939 Kate S. Buckingham Lecture, The Early Development of Chinese Pottery , given by AIC Assistant Director and Curator of Oriental Art Department Charles Fabens Kelley 53 April 17, 1939 SAIC group exhibition at Paul Theobald's Gallery in Chicago, showing abstractionist paintings done in the class of Willard G. Smythe 54 April 20, 1939 Kate S. Buckingham Lecture, The Great Period of Pottery and the Beginnings of Porcelain , given by AIC Assistant Director and Curator of Oriental Art Department Charles Fabens Kelley; attendance record of the Lecture Series 55 April 25, 1939 Europe, Asia, Africa: A Common Civilization , lecture, given by Melville J. Herskovits of Northwestern University, Evanston, IL, 56 Art Quiz, booklet by Head of Education Department Helen Parker, published in support for AIC Museum programs 57 April 27, 1939 Kate S. Buckingham Lecture, The Great Porcelains of the Ming and Ch'ing Dynasties, given by AIC Assistant Director and Curator of Oriental Art Department Charles Fabens Kelley 58 May 2, 1939 Antiquarian Society, Tea Party, featuring speech by AIC Director Daniel C. Rich, titled Decorative Arts in the Museum of Tomorrow ; members of the Society, listed 59 May 5, 1939 Goodman Theatre dance series, featuring Spanish dancer Clarita Martin, Ms. Martin's remarks 60 May 6, 1939 Antiquarian Society, Spring Meeting; Tea Party marking the Exhibition of Embroideries from Greek Islands in Elizabeth Day McCormick Collection; special gallery arrangements provided by Mrs. Walter S. Brewster, Mrs. Charles S. Dewey, Mrs. James Ward Thorne, Mrs. C. Morse Ely, and Mrs. Chauncey McCormick 29, 59, 61-62 May 9, 1939 Antiquarian Society Tea Party, decorative floral display available for public viewing 62 May 12, 1939 5th Annual Exhibition by Student Janitors of SAIC, participants and Fellowship awards 63 May 12, 1939 18th International Water Color Exhibition, attendance record; list of works sold from the show 35, 40-42, 51-52, 64 May 13, 1939 Annual Exhibition of the Needlework and Textile Guild of AIC, opening; works on view and participants 65-66 May 22, 1939 Foreign Travelling Fellowships, awarded to SAIC Student Janitors by AIC Officials and members of SAIC Faculty; award recipients Murray Jones, Edward Voska, biography notes 67 May 23, 1939 SAIC Glee Club concert, program and performers 68 May 26, 1939 Free Museum admission on Memorial Day; special exhibitions: Glass Paperweights from Mrs. John H. Bergstrom Collection; Japanese Surimono Prints, lent by Ms. Helen C. Gunsaulus; Chinese Jades from Mrs. Edward Sonnenschein Collection; Ms. Elizabeth Day McCormick Collection of Embroideries 69 June 2, 1939 Room of Recent Accessions, opening; new gallery, designated for exhibitions in The Masterpiece of the Month Series, and displaying new additions to Permanent collection; works shown at the opening; comments by AIC Director Daniel C. Rich 70-71 June 6, 1939 Art Students League of SAIC, prizes given to the League members; awards made possible through the gift of Mrs. William O. Goodman 72 June 8, 1939 Free Summer Lectures, French and German Primitives by Gibson Danes of Northwestern University, Evanston, IL; Paintings of the High Renaissance in Italy by SAIC instructor Briggs Dyer; Dutch and Flemish Old Masters by AIC Assistant Curator of Painting Frederick A. Sweet 73 June 9, 1939 SAIC Annual Commencement Exercises, graduation announcement at Goodman Memorial Theatre, conducted by AIC Vice President Mr. Chauncey McCormick; Invocation and Benediction pronounced by Minister of New England Church, Rev. Theodore Hume; student prizes, AIC Glee Club performance; guest list 74 June 10, 1939 AIC Director Daniel Catton Rich, named Chairman of Jury at San Francisco Golden Gate International Exposition 75 June 13, 1939 AIC Exhibition Calendar for 1939 Summer Exhibitions In the Department of Painting and Sculpture, curator AIC Director Daniel Catton Rich: Annual Exhibition of Works by SAIC Students; Costumes and Folk Art from Central Europe from Florence Dibell Bartlett Collection; Whistleriana, the artist's memorabilia from Walter Brewster Collection; Water Color Drawings by Thomas Rowlandson; Paintings by Lester O. Schwartz; Memorial Exhibition of Paintings by Pauline Palmer; Memorial Exhibition of Paintings by Carl Rudolf Krafft; Chinese Porcelains from the Goodman, Crane, Patterson, and Salisbury Collections; Lithographs by Odilon Redon; 50th Annual Exhibition of American Painting and Sculpture: Half a Century of American Art 76-77, 83 In the Children's Museum, curator Helen Mackenzie: Exhibition of Work by Children in the Saturday Classes of SAIC 77 From exhibition series The Making of the Masterpiece, showing At the Moulin Rouge by Toulouse-Lautrec 77 The Masterpiece of the Month, exhibition series introduced 77-78 In the Oriental Art Department, curator Charles Fabens Kelley: Chinese Jades from the Collection of Mr. and Mrs. Edward Sonnenschein; Japanese Surimono, lent by Ms. Helen C. Gunsaulus; Pottery of the Ming Dynasty 78, 83 In the Department of Prints and Drawing, Acting Curator Lilian Combs: Prints by Old Masters from Clarence Buckingham Collection; Sports in Prints; Sporting Prints and Drawings from the Collection of Mr. Joel Spitz of Chicago; Half a Century of American Prints; The Lenora Hall Curley Memorial Collection of Drawings; British Landscape Prints by Seymour Haden and David Young Cameron; Portraiture in Prints from Clarence Buckingham Collection; 7th International Exhibition of Lithography and Wood Engraving 78-79, 83 In the Decorative Arts Department: Exhibition of Paperweights from the Collection of Mrs. John N. Bergstrom; French Furniture from Henry C. Dangler Collection; Bonader from Sweden, Florence Dibell Bartlett Collection; English Architecture of the 18th C.; Exhibition of Embroideries from the Greek Islands, English and Ecclesiastical Embroideries from the Collection of Elizabeth Day McCormick 79, 83 Various announcements: invitation for train passengers to visit AIC on the way to the World's Fair in New York and San Francisco Golden Gate Exposition; attendance, lectures, Museum hours and orientation 79-80 June 13, 1939 General Education Board of Rockefeller Foundation, grant for three year project on art education in Chicago High Schools, conducted under supervision of Head of AIC Education Department Helen Parker 81 July 14, 1939 Chinese Art , free lecture series given by AIC Assistant Director and Curator of Oriental Art Charles Fabens Kelley; weekend gallery talks 82 July 18, 1939 Notes on Summer Exhibitions 83 July 22, 1939 Lectures and Gallery tours, given by AIC Assistant Curator for Painting and Sculpture Frederick A. Sweet, Gibson Danes of Northwestern University, Evanston, IL, and Briggs Dyer of SAIC 84 Weekly News Letter (Walter J. Sherwood, ed.); Nine Summer Exhibitions: Costumes and Folk Art from Eastern Europe lent by Florence D. Bartlett; Paintings by Carl Rudolf Krafft, School of the Ozark Painters; Pauline Palmer's paintings, works on view; Exhibition of Lester O. Schwartz, SAIC alumnus; Exhibition of Whistleriana from the collection of Walter S. Brewster, works on view; Water Colors by Thomas Rowlandson; Chinese Porcelains and Jades from Chicago Collections; Lithographs by Odilon Redon, from Martin A. Ryerson Collection; renovation of Permanent collection display; El Greco, lecture by assistant curator of Painting and Sculpture Frederick A. Sweet; note on the death of the mural painter Alphonse Mucha and the 1908 lecture series, titled Harmony in Art , given by the artist in AIC 137-138 July 25, 1939 Invitation to free music concert in Blackstone Hall, organist Max Allen, pianist Eleanor Gullett 85 July 29, 1939 Weekly News Letter (Walter J. Sherwood, ed.); The Masterpiece of the Month, exhibition series, Rembrandt's etching, titled Christ Preaching on display; paintings by winners of AIC Annuals Peter Hurd, Millard Sheets, Esther Williams, Nicolai Ziroli, John Whorf, William Zorach, and Georges Schreiber, acquired by The Metropolitan Museum in New York; free gallery lecture series, given by Briggs Dyer of SAIC and Gibson Danes of Northwestern University, Evanston, IL; gallery tours by Addis Osborne, SAIC alumnus; AIC catalogue of Summer exhibitions 139-141 August 1, 1939 Lectures and gallery talks, given by Briggs Dyer of SAIC, and Addis Osborne, SAIC alumnus 86-88, 90 August 5, 1939 Weekly News Letter (Lester Bridaham, ed.); Kenneth Goodman Memorial Theatre, improvements and additions; Decorative Arts Department Galleries in the Allerton Wing, construction, made possible by Vice-President and Chairman of the Committee of Decorative Arts, Mr. Robert Allerton; Wendell Stevenson, SAIC alumnus, commission of portraiture; SAIC Summer classes extended; Summer School at Saugatuck, MI, classes of Charles Willimovsky, SAIC Director Frederick Fursman, and Don Loving; 50th Annual Exhibition of American Painting and Sculpture: Half a Century of American Art, exhibition announcement; excepts from Time and Newsweek magazines, commenting on AIC Summer exhibitions; Sporting Prints from the Collection of Joel Spitz, exhibition 142-144 August 8, 1939 Briggs Dyer's Sunday Lecture Series gained public acclaim 87 August 12, 1939 Weekly News Letter; lectures and classes given by artists and SAIC alumni Leon R. Pescheret and Addis Osborne, and SAIC professors Edmund Giesbert and Briggs Dyer; Odilon Redon Lithographs, exhibition of works acquired by Martin A. Ryerson from the artist's widow, remarks by AIC Trustee Arthur T. Aldis; painting by Robert B. Harshe, AIC Director from 1921 to 1938, awarded honorable mention at Fine Arts Exhibition of the Golden Gates Exposition, excerpt from The Magazine of Art , May issie 145-147 August 15, 1939 Notes on Briggs Dyer's lectures 88 August 18, 1939 Membership Lecture, One-Plate Color Etching , given by SAIC instructor Leon R. Pescheret 89 August 19, 1939 Weekly News Letter; Student Honorable Mentions for the year 1939; AIC Curator Frederick A. Sweet, inquiring about locations of paintings for inclusion into 50th Annual Exhibition of American Painting and Sculpture: Half a Century of American Art, list of desired works; Assistant in AIC Decorative Arts Department Helen Mitchell, awarded Fellowship at Yale University; The Chicago Museum Tour Committee, providing two-day tour and booklet for Chicago visitors in cooperation with AIC and other cultural institutions, list of the Committee members 148-150 August 22, 1939 Lectures and gallery talks, given by SAIC instructors Briggs Dyer and Addis Osborne, and Head of AIC Education Department Helen Parker 90 Weekly News Letter; Masterpiece of the Month, exhibition series, showing Persian brocade of the Safavid period, the reign of Shah Abbas (1587-1628), gift of Mr. John R. Thompson of Chicago, description and comments; Contemporary Fine Arts Building at the New York World's Fair, AIC ranked as the most popular museum outside New York; Oriental jades from AIC Sonnenschein Collection, shown at The Golden Gate Exposition in San Francisco; free Museum admission on Labor Day; AIC Fall lecture series, titled The Great White Way to San Francisco Bay , given by Dudley Crafts Watson, reflecting on New York World's Fair, The Golden Gate Exposition in San Francisco, and US Museums 151-153 August 29, 1939 Notes on Exhibition of East European Costumes from Florence D. Bartlett Collection and other displays 91 September 2, 1939 SAIC announcing Student registration for the year 1940; colored post cards and reproductions of works from AIC Permanent collection, supplied by New York office of Vienna publisher Max Jaffe, list of titles available at AIC Reproduction Desk; gallery tours, conducted by Head of AIC Education Department Helen Parker and Briggs Dyer of SAIC; general Museum information, record of School, Museum offices and workshops, Shipping Room, and Museum Registrar in the Archives Department; Fall program in Fullerton Hall, opened with lecture series about home decoration, given by Dudley Crafts Watson 154-156 September 11, 1939 Lectures, Paintings of the High Renaissance in Italy , given by Helen Parker, and Dutch and Flemish Old Masters , given by Briggs Dyer 92 September 13, 1939 Meyric R. Rogers, appointed AIC Curator of Decorative Arts Department, replacing late Ms. Bessie Bennett; Mr. Rogers, concurrently appointed Head of Industrial Arts Department, newly formed in AIC; biography note, publications, and remarks by AIC President Potter Palmer and AIC Director of Fine Arts Daniel C. Rich 93-94 September 19, 1939 Week of the American Legion Convention, free Museum admission for the Legion members, announcement by AIC Director of Finance and Operation C. H. Burkholder 95-96 September 22, 1939 American Legion Parade, free Museum admission for the public 95-96 September 25, 1939 AIC Department of Education, programs and lectures, featuring SAIC instructor Mary Hipple, Head of Education Department Helen Parker, Ramsey Wieland, and George Buehr; film demonstrations on art techniques, supplemented by gallery tours 97 September 28, 1939 Sunday Lectures, French and English Paintings of the 17th and 18th Century , given by SAIC instructor George Buehr, and French Decorative Arts , given by assistant in Education Department Ramsey Wieland 100 September 30, 1939 Fiestas in Guatemala , lecture by Erna Fergusson, introducing Scammon Lecture Series for the year 101 October 1, 1939 Masterpiece of the Month, exhibition series, St. John on Patmosby Nicolas Poussin ; comparative displays in Impressionist galleries 98-99 October 2, 1939 Picasso Retrospective, planned by Alfred H. Barr, Director and Vice President of The Museum of Modern Art, N. Y. (MOMA), and Daniel C. Rich, AIC Director of Fine Arts; announcement on exhibition dates; war time exhibition, the first collaborative project by MOMA and AIC 13, 102 October 4, 1939 The Adventures in the Arts , lecture series conducted by Head of Education Department Helen Parker; attendance record for AIC lectures; Costumes from Florence Dibell Bartlett Collection on display 103 October 5, 1939 7th International Exhibition of Lithography and Wood-Engraving, US tour exhibition, jury comprised of artists Peggy Bacon, Asa Cheffetz, and Todros Geller; The Logan Prize for Prints, announced 104 October 7, 1939 Scammon Lecture, The Educational Viewpoint in an Art Museum , given by Dr. Thomas Munro of Cleveland Museum of Art; biography note and publications 105 October 12, 1939 Exhibition of Chinese Pottery and Porcelain, lent by Chicago collectors Mrs. William O. Goodman, Mrs. Richard T. Crane, Mrs. Alice H. Patterson, and Mrs. W. W. Kimball (courtesy of Mrs. Warren Salisbury and Mr. Kimball Salisbury) 106 October 14, 1939 Scammon Lecture, Armor of Renaissance Princes , given by Curator of Arms and Armors in The Metropolitan Museum Stephen V. Grancsay; the 1893 exhibition of Arms and Armor, held at the Chicago Columbian Exposition and featuring Mr. Grancsay's lecture 107 October 20, 1939 Motion Pictures in the Arts , special program in association with 7th International Exhibition of Lithography and Wood-Engraving, conducted by Head of Education Department Helen Parker; film screening, featuring woodcut artists and illustrators, Lynd Ward, Timothy Cole, and Chaim Gross 108 October 21, 1939 Scammon Lecture, The Art of Our Early Cabinet Makers , given by Edwin J. Hipkiss of Boston Museum of Fine Arts; biography note and publications 109 October 26, 1939 SAIC Glee Club concert of Negro Spirituals, conducted by AIC Assistant Director and Curator of Oriental Art Department Charles Fabens Kelley, and featuring musicians Virgil Espenlaub, Juanita Krunk, and Eleanor Gullett; numbers performed 110 October 27, 1939 Scammon Lecture, French Medieval Sculpture in America , given in association with opening of The Cloisters Museum in New York, by James J. Rorimer of The Metropolitan Museum; remarks by Mr. H. E. Winlock, formerly Director of The Metropolitan Museum; publications by Mr. Rorimer 111 October 28, 1939 50th American Exhibition: Half a Century of American Art, opening reception featuring tea table decorations from different periods, sponsored and arranged by The Antiquarian Society, The Municipal Art League, Art Institute Alumni, The Renaissance Society, The Arts Club, etc.; listing of representatives and participants 25, 50, 77, 112, 120-121 November 1, 1939 Masterpieces of Italian Art, exhibition lent by the Royal Italian Government to San Francisco World's Fair, special announcement on exclusive showing at AIC 113-114, 116-119, 122, 123, 125, 129, 131,132, 134 November 6, 1939 Scammon Lecture, Colonial American Portraiture , given by Alan Burroughs of Harvard University; biography note and publications 115 November 9, 1939 Masterpieces of Italian Art, exhibition lent by the Royal Italian Government to San Francisco World's Fair, shipment of art works to Chicago for exclusive showing at AIC and official ceremonies upon arrival, the route of procession to AIC 116 November 11, 1939 Masterpieces of Italian Art, exhibition lent by the Royal Italian Government to San Francisco World's Fair; honorary committees and Chicago sponsors for exclusive AIC showing 117-119 November 14, 1939 50th Annual Exhibition of American Painting and Sculpture: Half a Century of American Art, opening reception arranged by Antiquarian Society and Fortnightly Club, description of table decoration and list of hostesses 120-121 November 17, 1939 Masterpieces of Italian Art, exhibition, opening ceremonies featuring opera singer Hilde Reggiani 122 November 21, 1939 Free Museum admission on Thanksgiving Day; Radio program and special lectures, supplementing Masterpieces of Italian Art Exhibition 123 November 27, 1939 Scammon Lecture, featuring American sculptor William Zorach 124 December 1, 1939 Masterpieces of Italian Art, exhibition, related discussion on using tempera technique 125 December 2, 1939 Scammon Lecture, Precursors of the New Architecture , given by John Barney Rodgers of Armour Institute of Technology; biography note 126 December 5, 1939 Glee Club, Christmas concert, directed by AIC Assistant Director Charles Fabens Kelley 127 December 7, 1939 Masterpieces of Italian Art, exhibition; extended hours for late evening viewing; special musical programs, gallery tours, and Christmas events 129 December 9, 1939 Scammon Lecture, dedicated to sculptor Carl Milles, given by curator of Decorative Arts Department Meyric R. Rogers 128 December 12, 1939 Armour Institute of Technology Musical Club, free concert including AIC Glee Club performance 130 December 14, 1939 Masterpieces of Italian Art, exhibition, evening concerts; Joseph Bentonelli, lyric tenor, performing from the Museum Grand Staircase 131 December 18, 1939 Masterpieces of Italian Art, exhibition, evening concerts; Choir of the Church of Saint Thomas the Apostle 132 December 19, 1939 Free Museum admission on Christmas Day; Listing of current exhibitions 133 December 26, 1939 Masterpieces of Italian Art, exhibition, Italian Day in the Museum, free admission declared by Royal Italian Government 134 December 27, 1939 Free museum admission on New Year's Day; current exhibitions and lectures 135 ",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.13"
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
            "web_url": "https://nocache.staging.artic.edu/collection/resources/educator-resources/101-educator-resource-packet-zapata-by-jose-clemente-orozco",
            "copy": " This dramatic canvas was painted by Jos\u00e9 Clemente Orozco during his self-imposed exile in the United States. A leader of the Mexican Mural movement of the 1920s and 1930s, Orozco painted Emiliano Zapata who had become a symbol of the Mexican Revolution (1910-20) after his assassination in 1919. This resource packet focuses on a single work of art from the museum's collection and provides information about the artwork, the artist, and the historical context of the piece. ",
            ...
        },
        {
            "id": 99,
            "api_model": "educator-resources",
            "api_link": "https://api.artic.edu/api/v1/educator-resources/99",
            "title": "Tips for Discussing Works of Art",
            "web_url": "https://nocache.staging.artic.edu/collection/resources/educator-resources/99-tips-for-discussing-works-of-art",
            "copy": " Discussions about works of art can take many forms. Keeping the following suggestions in mind will ensure that the discussion is meaningful and inclusive. ",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.13"
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
        "total": 78,
        "limit": 10,
        "offset": 0,
        "total_pages": 8,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "educator-resources",
            "api_link": "https://api.artic.edu/api/v1/educator-resources/36",
            "id": 36,
            "title": "Educator Resource Packet: Starry Night and the Astronauts by Alma Thomas",
            "timestamp": "2025-01-28T23:45:07-06:00"
        },
        {
            "_score": 1,
            "api_model": "educator-resources",
            "api_link": "https://api.artic.edu/api/v1/educator-resources/137",
            "id": 137,
            "title": "Romare Bearden: Una mirada m\u00e1s cercana",
            "timestamp": "2025-01-28T23:45:07-06:00"
        },
        {
            "_score": 1,
            "api_model": "educator-resources",
            "api_link": "https://api.artic.edu/api/v1/educator-resources/136",
            "id": 136,
            "title": "Romare Bearden: A Closer Look",
            "timestamp": "2025-01-28T23:45:07-06:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.13"
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
        "web_url": "https://nocache.staging.artic.edu/collection/resources/educator-resources/7-thematic-curriculum-art-science",
        "copy": " Art + Science was developed by the Art Institute of Chicago to support dialogue and collaboration between art and science teachers at the middle school level, with the ultimate goal of inspiring art and science integration in the curriculum. The program consists of two interconnected parts: this curriculum resource and a field trip to the museum, which features a gallery tour and studio art-making activity. The curriculum resource is intended to help teachers to prepare for and extend the field trip experience. Both the field trip and curriculum resource showcase and encourage interdisciplinary connections between art and science first on a broad level and then through the particular lens of stability and change. ",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.13"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "total": 19,
        "limit": 2,
        "offset": 0,
        "total_pages": 10,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/digital-publications?page=2&limit=2"
    },
    "data": [
        {
            "id": 31,
            "api_model": "digital-publications",
            "api_link": "https://api.artic.edu/api/v1/digital-publications/31",
            "title": "Matisse Paintings, Works on Paper, Sculpture, and Textiles at the Art Institute of Chicago",
            "web_url": "https://nocache.staging.artic.edu/digital-publications/31/matisse-at-the-art-institute-of-chicago",
            "copy": " Matisse: Paintings, Works on Paper, Sculpture, and Textiles at the Art Institute of Chicago highlights the ten paintings, five bronzes, forty-one works on paper, and one textile by Henri Matisse in the museum\u2019s collection. These extraordinary objects narrate the numerous stylistic and thematic paths the artist explored and present a comprehensive story of his entire career. Highlights include an extended entry on Bathers by a River , in which our curatorial and conservation colleagues use state-of-the-art imaging to \u201cexcavate\u201d the canvas, charting how the artist\u2019s radical changes to composition and palette marked a creative evolution at a pivotal moment in his career.   Edited by Stephanie D\u2019Alessandro, with entries by Kristi Dahm, Stephanie D\u2019Alessandro, Kathleen Kiefer, Kristin Hoermann Lister, Katja Rivera, Brandon Ruud, Marin Sarv\u00e9-Tarr, Suzanne Schnepp, Mel Becker Solomon, Martha Tedeschi, Kirk Vuillemot, Daniel S. Walker, and Debora Wood.   The Andrew W. Mellon Foundation provided essential funding and ongoing support for the project. A generous grant from the Grainger Foundation supported the purchase of equipment used for the technical analysis. Jim Ziebart contributed equipment. ",
            ...
        },
        {
            "id": 30,
            "api_model": "digital-publications",
            "api_link": "https://api.artic.edu/api/v1/digital-publications/30",
            "title": "Ivan Albright Paintings at the Art Institute of Chicago",
            "web_url": "https://nocache.staging.artic.edu/digital-publications/30/ivan-albright-paintings-at-the-art-institute-of-chicago",
            "copy": " Renowned as the \u201cmaster of the macabre,\u201d Chicago native Ivan Albright (1897\u20131983) is famous for richly detailed paintings of ghoulish subjects including Into the World There Came a Soul Called Ida and Picture of Dorian Gray . This catalogue brings together fresh perspectives on the artist: professor emerita of art history Sarah Burns reveals Albright\u2019s fascination with popular culture, and curator John P. Murphy explores his philosophy of ugliness. Painting conservator Kelly Keegan examines the artist\u2019s process and details how he achieved his unique painterly effects. A plate section of the 44 oil paintings in the collection of the Art Institute of Chicago, reproduced in high resolution to enable close looking, documents Albright\u2019s portrayal of the body\u2019s vulnerability to age, disease, and death. This includes a haunting series of self-portraits, one of which the artist made in his hospital bed three days before he died.   Edited by Sarah Kelly Oehler, with an introduction by Sarah Kelly Oehler and essays by Sarah Burns, Kelly Keegan, and John P. Murphy   This publication follows the exhibition Flesh: Ivan Albright at the Art Institute of Chicago (May 4\u2013Aug. 4, 2018).   The publication is free and has received generous funding from the Northwestern University Department of Art History Warnock Publication Fund. ",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.13"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "total": 20,
        "limit": 10,
        "offset": 0,
        "total_pages": 2,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "digital-publications",
            "api_link": "https://api.artic.edu/api/v1/digital-publications/8",
            "id": 8,
            "title": "Caillebotte Paintings and Drawings at the Art Institute of Chicago",
            "timestamp": "2025-01-28T23:48:04-06:00"
        },
        {
            "_score": 1,
            "api_model": "digital-publications",
            "api_link": "https://api.artic.edu/api/v1/digital-publications/34",
            "id": 34,
            "title": "Malangatana: Mozambique Modern",
            "timestamp": "2025-01-28T23:48:04-06:00"
        },
        {
            "_score": 1,
            "api_model": "digital-publications",
            "api_link": "https://api.artic.edu/api/v1/digital-publications/38",
            "id": 38,
            "title": "Perspectives on Place",
            "timestamp": "2025-01-28T23:48:04-06:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.13"
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
        "web_url": "https://nocache.staging.artic.edu/digital-publications/2/american-silver",
        "copy": " American Silver in the Art Institute of Chicago showcases the museum's superb collection of American silver. In-depth essays relate a fascinating story about eating, drinking, and entertaining that spans the history of the Republic and traces the development of the museum\u2019s holdings of American silver over nearly a century, and a catalogue incorporates detailed analysis of objects written by leading specialists. This digital augmentation of the 2017 publication provides stunning high-resolution photography and, for a select number of objects, three-dimensional captures that allow for close viewing. In addition, this edition includes an extensive illustrated checklist of additional objects.   Edited by Elizabeth McGoey with contributions by Debra Schmidt Bach, David L. Barquist, Judith A. Barter, Jennifer Goldsborough, Medill Higgins Harvey, Patricia Kane, Elizabeth McGoey, Barbara K. Schnitzer, Janine E. Skerry, Ann Wagner, Gerald W. R. Ward, Deborah Dependahl Waters, Beth Carver Wees, and Elizabeth A. Williams   American Silver in the Art Institute of Chicago is free and has received major support for this catalogue is provided by the Henry Luce Foundation. It is also made by possible by the generosity of the Community Associates of the Art Institute of Chicago, Mr. and Mrs. Henry M. Buchbinder, Carl and Marilynn Thoma, Louise Ingersoll Tausche, Jamee and Marshal Field V, Kay Bucksbaum, Celia and David Hilliard, and Jan and Bill Jentes. ",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.13"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "total": 31,
        "limit": 2,
        "offset": 0,
        "total_pages": 16,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/digital-publication-articles?page=2&limit=2"
    },
    "data": [
        {
            "id": 11,
            "api_model": "digital-publication-articles",
            "api_link": "https://api.artic.edu/api/v1/digital-publication-articles/11",
            "title": "Installation Views",
            "web_url": "https://nocache.staging.artic.edu/digital-publications/34/malangatana-mozambique-modern/11/installation-views",
            "copy": " Video   Photographs ",
            ...
        },
        {
            "id": 10,
            "api_model": "digital-publication-articles",
            "api_link": "https://api.artic.edu/api/v1/digital-publication-articles/10",
            "title": "Works in the Exhibition",
            "web_url": "https://nocache.staging.artic.edu/digital-publications/34/malangatana-mozambique-modern/10/works-in-the-exhibition",
            "copy": " Artist, poet, and revered national hero Malangatana Ngwenya (1936\u20132011) was a pioneer of modern art in Africa. Born in Mozambique, in southeast Africa, Malangatana depicted vivid allegorical scenes that draw from local religious practices, his cultural background, and life under colonial rule. This exhibition presented a selection of the artist\u2019s early paintings and drawings, made between 1959 and 1975. During this period Malangatana embarked on bold formal experiments that coalesced into a signature style characterized by dense compositions of human, animal, and monstrous figures. Malangatana\u2019s early career coincided with Mozambique\u2019s liberation struggle, in particular the armed resistance against the Portuguese in 1964, which was spearheaded by the Front for the Liberation of Mozambique (FRELIMO). A Portuguese colony until 1975, Mozambique was among the last countries on the African continent to gain independence. Malangatana explored the rapidly changing world around him and addressed the country\u2019s social and political context in his paintings and drawings. These works exemplify the confluence of artistic innovation and political liberation that has shaped the history of modern art in Africa during the second half of the twentieth century.   A Hybrid Education Growing up in the village of Matalana, Malangatana encountered local art and craft traditions such as pottery, basketry, and painting before moving to Mozambique\u2019s capital, Louren\u00e7o Marques (now Maputo), to find work. Racial and social barriers of the colonial system limited black Mozambicans\u2019 access to formal art education. However, colonial policies promoting integration through assimilation\u2014pressuring the local black population to adopt the language, religion, and values of the Portuguese\u2014made art classes available to Malangatana at the Industrial School as well as the Art Center of the Colony of Mozambique in the late 1950s. At the Art Center, Malangatana encountered European styles of painting and met Portuguese architect Am\u00e2ncio d\u2019Alpoim Miranda \u201cPancho\u201d Guedes, who became a significant mentor and patron. Guedes encouraged him to leave the Art Center in order to avoid, in Malangatana\u2019s words, \u201cpollution\u201d by a formal education anchored in European painting traditions. Guedes gave Malangatana studio space and a salary, and commissioned a large number of paintings in the years prior to the artist\u2019s first solo exhibition in 1961.   Mythology and Religion Many of Malangatana\u2019s works from the late 1950s to the early 1970s refer to the artist\u2019s Mozambican roots, specifically his Ronga cultural background. The paintings in this section feature Ronga folklore, mythology, and healing rituals. Frequently the artist included Catholic symbols, signs of the pervasive Portuguese influence in Mozambique. Malangatana\u2019s exaggerated depictions of Ronga culture verge on the satirical, and his references to Christianity are similarly unflattering, suggesting a critique of Portuguese colonial rule. Malangatana\u2019s work demonstrates how he carefully balanced all aspects of life in Mozambique, from colonial influences and indigenous customs and practices to the struggle for independence. These experiences\u2014as well as his art education and the structures of patronage he was embedded in\u2014were layered and complex, subverting the clich\u00e9d notion of the self-taught African artist who, unspoiled by foreign influences, finds inspiration in \u201cprimitive\u201d practices and beliefs, an idea that persists in the art history and reception of modern African art.   Beyond Painting and Drawing Malangatana was also active as an educator, muralist, sculptor, and writer. He frequently published in journals and corresponded extensively with peers and friends all over the world. In addition, he wrote poetry, at times to accompany his paintings. Malangatana drew from personal aspects of his life in his poems, some of which were presented in an issue of the African literary journal Black Orpheus.   In 1995 Malangatana started building a cultural center in his birth village of Matalana to host art education and community events. The center\u2019s architecture combines the geometric logic and industrial materials of Bauhaus design\u2014inspired by the work of Malangatana\u2019s friend and patron Pancho Guedes, a renowned modern architect\u2014with elements such as circular windows, teeth, grids, and figurative wall reliefs (fig. 1). The grid design of this exhibition borrowed from the center\u2019s architecture (fig. 2).   Prison Drawings In 1965\u201366 the International and State Defense Police (PIDE) imprisoned Malangatana for 18 months because of his suspected involvement with the Front for the Liberation of Mozambique (FRELIMO). While incarcerated, the artist began a series of drawings that he continued to work on after his release. The works capture the harsh conditions of life in Machava Central Prison through striking realism interrupted by fantasy scenes and dreams, their tension amplified by distorted bodies and monstrous figures. In 1961 mentor and patron Pancho Guedes introduced Malangatana to Eduardo Chivambo Mondlane, the founding president of the movement FRELIMO. Malangatana hoped to go abroad for international opportunities and exposure, but Mondlane encouraged him to stay in Mozambique and use art to contribute to the anti-colonial struggle. The artist\u2019s growing political awareness during the 1960s is apparent in the increasingly political tone of his work. He also expressed dissent by withdrawing from the 1964 exhibition Artists in Mozambique to protest Nelson Mandela\u2019s imprisonment and by refusing to represent Portugal at the 1965 S\u00e3o Paulo Art Biennial.   Artist of the Revolution After receiving a yearlong scholarship in 1971 from the Gulbenkian Foundation in Lisbon, Malangatana explored new media and pursued exhibition opportunities across Europe\u2014before returning permanently to Mozambique in 1974. There he continued experimenting in his art by elongating limbs, introducing opaque colors, and moving further into abstraction with thick outlines and flattened compositions. The titles of his works during this period, such as The Cry for Freedom and Remember Those Who Entered Bleeding? , reflect the focus on the war for independence and the sense of urgency Mozambicans felt at the time: in 1974 a ceasefire ended the war, followed by ten months of negotiations and the country\u2019s independence on June 25, 1975. After independence Malangatana was embraced as an artist of the revolution, and his work, including state-funded murals, was recognized as an exemplar of Mozambican culture. In addition to holding multiple roles within the newly formed government, he was appointed ambassador of peace during Mozambique\u2019s civil war (1977\u201392) and UNESCO Artist for Peace in 1997. He was also instrumental in establishing Mozambique\u2019s National Museum of Art in Maputo. Malangatana continued working as a civic leader, educator, poet, and, foremost, as an artist until his death in 2011. ",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.13"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "total": 49,
        "limit": 10,
        "offset": 0,
        "total_pages": 5,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "digital-publication-articles",
            "api_link": "https://api.artic.edu/api/v1/digital-publication-articles/19",
            "id": 19,
            "title": "Empty Fields Revisited",
            "timestamp": "2025-01-28T23:51:08-06:00"
        },
        {
            "_score": 1,
            "api_model": "digital-publication-articles",
            "api_link": "https://api.artic.edu/api/v1/digital-publication-articles/16",
            "id": 16,
            "title": "Stability Isn't Everything It's Glitched Up to Be: An Interview with Jamie Fenton",
            "timestamp": "2025-01-28T23:51:08-06:00"
        },
        {
            "_score": 1,
            "api_model": "digital-publication-articles",
            "api_link": "https://api.artic.edu/api/v1/digital-publication-articles/37",
            "id": 37,
            "title": "Staging Site-Specific Installation Art in a Museum Context",
            "timestamp": "2025-01-28T23:51:08-06:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.13"
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
        "web_url": "https://nocache.staging.artic.edu/digital-publications/34/malangatana-mozambique-modern/1/directors-foreword",
        "copy": " The Art Institute of Chicago has been at the forefront of American museums in collecting and displaying modern art since the early twentieth century, and boasts an ongoing commitment to extending this vital legacy with research, publications, and exhibitions. In that spirit, a number of our curators came together in 2013 for a series of discussions exploring ideas about modern art, in particular the ways in which it manifests across our collections. This gave rise to the Modern Series, a set of three experimental, challenging, and provocative exhibitions and publications that are co-organized by curators across departments, with divergent but complementary specialties. The two previous iterations\u2014 Shatter Rupture Break (February 15\u2013May 3, 2015) and Go (February 23\u2013June 4, 2017)\u2014sought to present the museum\u2019s holdings in departments including Arts of the Americas, Modern and Contemporary Art, Photography and Media, and Textiles in fresh and exciting ways. Malangatana: Mozambique Modern (July 30\u2013November 16, 2020), the third and final project in the series, expands our understanding of modernism and modern art in a global context by bringing the work of celebrated Mozambican artist Malangatana Ngwenya (1936\u20132011) into conversation with our own international collection. It not only showcases the evolution in style and content within his early paintings and drawings, but also contextualizes his practice within the social and political conditions that framed the emergence of modern art in Mozambique and across the African continent. The exhibition also contributed to the cultivation of a more global perspective on artistic creation and its representation in the museum, both by providing the basis for this publication and, not least, by prompting us to acquire a painting and six works on paper by Malangatana for our permanent collection. Africa and its diasporas, with their deep history and wide geographical reach, occupy a prominent place within global art history and modern art that merits many more such efforts and programs in the years to come. Our colleagues\u2014notably Sarah Guernsey, Ann Goldstein, and Greg Nosan\u2014deserve my sincere gratitude for their continuing critical support for the Modern Series. But I am especially thankful to the exhibition\u2019s curators, Hendrik Folkerts, Felicia Mings, and Constantine Petridis, for introducing our staff and visitors to the fascinating milieu and work of Malangatana Ngwenya and for helping the Art Institute expand its representation of modern art from around the world. This exhibition would not have been possible without the generosity of the individuals and institutions in the United States, Portugal, and Mozambique who lent works from their collections. I am particularly grateful to the Malangatana Valente Ngwenya Foundation in Maputo for its invaluable loan of a significant number of paintings and drawings. Major funding for Malangatana: Mozambique Modern was provided by Sylvia Neil and Dan Fischel and the Alfred L. McDougal and Nancy Lauter McDougal Fund for Contemporary Art. Additional support is contributed by the Society for Contemporary Art through the SCA Activation Fund and the Miriam U. Hoover Foundation. Members of the Luminary Trust provide annual leadership support for the museum\u2019s operations, including exhibition development, conservation and collection care, and educational programming. The Luminary Trust includes an anonymous donor; Neil Bluhm and the Bluhm Family Charitable Foundation; Jay Franke and David Herro; Karen Gray-Krehbiel and John Krehbiel, Jr.; Kenneth Griffin; Caryn and King Harris, The Harris Family Foundation; Josef and Margot Lakonishok; Robert M. and Diane v.S. Levy; Ann and Samuel M. Mencoff; Sylvia Neil and Dan Fischel; Anne and Chris Reyes; Cari and Michael J. Sacks; and the Earl and Brenda Shapiro Foundation. Most importantly, I acknowledge with deepest thanks the intellectual and financial support of Sylvia Neil and Dan Fischel, who have provided crucial funding for the realization of this catalogue as well as the previous two in the Modern Series. Their ongoing commitment has enabled and encouraged our continued explorations into the possibilities of digital publication. James Rondeau President and Eloise W. Martin Director ",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.13"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "total": 129,
        "limit": 2,
        "offset": 0,
        "total_pages": 65,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/printed-publications?page=2&limit=2"
    },
    "data": [
        {
            "id": 156,
            "api_model": "printed-publications",
            "api_link": "https://api.artic.edu/api/v1/printed-publications/156",
            "title": "Gates of the Lord: The Tradition of Krishna Paintings",
            "web_url": "https://nocache.staging.artic.edu/print-publications/156/gates-of-the-lord-the-tradition-of-krishna-paintings",
            "copy": " The Pushtimarg, a Hindu sect established in India in the 15th century, possesses a unique culture\u2014reaching back centuries and still vital today\u2014in which art and devotion are deeply intertwined. This important volume, illustrated with more than one hundred vivid images, offers a new, in-depth look at the Pushtimarg and its rich aesthetic traditions, which are largely unknown outside of South Asia. Original essays by eminent scholars of Indian art focus on the style of worship, patterns of patronage, and artistic heritage that generated pichvais , large paintings on cloth designed to hang in temples, as well as other paintings for the Pushtimarg. In this expansive study, the authors deftly examine how pichvais were and still are used in the seasonal and daily veneration of Shrinathji, an aspect of Krishna as a child who is the chief deity of the temple town of Nathdwara in Rajasthan. Gates of the Lord introduces readers not only to the visual world of the Pushtimarg but also to the spirit of Nathdwara.   Edited by Madhuvanti Ghose Essays by Amit Ambalal, Madhuvanti Ghose, Kalyan Krishna, Tryna Lyons, and Anita B. Shah; with contributions by Emilia Bachrach   176 pages, 9 x 12 in. 170 color and 19 b/w ills. Out of print ISBN: 978-0-300-21472-7 (hardcover) ",
            ...
        },
        {
            "id": 79,
            "api_model": "printed-publications",
            "api_link": "https://api.artic.edu/api/v1/printed-publications/79",
            "title": "Faces, Places, and Inner Spaces",
            "web_url": "https://nocache.staging.artic.edu/print-publications/79/faces-places-and-inner-spaces",
            "copy": " How do artists use faces, places, and inner spaces to express themselves and their world? We all know what a face looks like, but no two faces are exactly alike. In works of art, we find an endless parade of faces. They can help us discover how people from different cultures and times have seen themselves.   Just like faces, places are full of variety. The word \"place\" can mean anything from the corner of a drawer to a neighborhood, from a kitchen to a forest, from a backyard to the moon! By looking at landscapes and cityscapes, interiors and exteriors, we can become more aware of our everyday life and appreciate what surrounds us.   Faces and places are all around us, but what about inner spaces? Inner spaces can be found in our minds, private places created by our emotions, thoughts, beliefs, and imagination. Artists who depict their dreams or fantasies share something very personal that might resemble some of our own thoughts, or seem so strange that we want to know more.   All of the art featured in Faces, Places, and Inner Spaces is from the collection of the Art Institute of Chicago, which houses more than 300,000 works within its 11 curatorial departments. This book includes such world-famous treasures as A Sunday on La Grande Jatte\u20141884 by Georges Seurat and American Gothic by Grant Wood. Though housed in one place, the artworks' universal themes and content make them accessible to every reader everywhere.   Jean Sousa   Hardcover $18.95   48 pages, 10 1/4 x 10 1/4 in. 38 ills. Out of print ISBN: 978-0-810-95966-8 (hardcover) ",
            ...
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.13"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
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
        "total": 138,
        "limit": 10,
        "offset": 0,
        "total_pages": 14,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "api_model": "printed-publications",
            "api_link": "https://api.artic.edu/api/v1/printed-publications/218",
            "id": 218,
            "title": "Project a Black Planet: The Art and Culture of Panafrica",
            "timestamp": "2025-01-28T23:54:04-06:00"
        },
        {
            "_score": 1,
            "api_model": "printed-publications",
            "api_link": "https://api.artic.edu/api/v1/printed-publications/217",
            "id": 217,
            "title": "Paula Modersohn-Becker",
            "timestamp": "2025-01-28T23:54:04-06:00"
        },
        {
            "_score": 1,
            "api_model": "printed-publications",
            "api_link": "https://api.artic.edu/api/v1/printed-publications/216",
            "id": 216,
            "title": "Georgia O'Keeffe: \"My New Yorks\"",
            "timestamp": "2025-01-28T23:54:04-06:00"
        }
    ],
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.13"
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
        "web_url": "https://nocache.staging.artic.edu/print-publications/4/the-art-institute-of-chicago-the-essential-guide",
        "copy": " The Essential Guide presents the diverse holdings of the Art Institute\u2019s collections. Featuring more than three hundred objects, it provides a journey through time\u2014from ancient Egypt until the present day\u2014and across the globe. Beautifully illustrated with short texts about each work, the publication includes beloved icons such as Georges Seurat\u2019s Sunday on La Grande Jatte\u20141884 and Edward Hopper\u2019s Nighthawks , as well as exciting recent acquisitions like a Teotihuacan shell mask, Marcel Duchamp\u2019s readymade Bottle Rack , and Thomas Hart Benton\u2019s Cotton Pickers . Read about objects currently on view in the galleries as well as exquisite textiles and works on paper that, because of the fragility of their materials, are less frequently shown. Use it as a guide to the museum or a souvenir of your visit. Four distinctive covers\u2014one great book! Choose your favorite cover image by Katsushika Hokusai, Archibald Motley Jr., Georgia O\u2019Keeffe, or Georges Seurat.   Foreword by James Rondeau   352 pages, 6 x 9 x 1 in. 335 color ills. Softcover $25 ($22.50 members) ISBN 978-0-86559-301-5 ",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.13"
    },
    "config": {
        "iiif_url": "https://www.artic.edu/iiif/2",
        "website_url": "https://www.artic.edu"
    }
}
```
:::

