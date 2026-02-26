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
        "total": 131066,
        "limit": 2,
        "offset": 0,
        "total_pages": 65533,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/artworks?page=2&limit=2"
    },
    "data": [
        {
            "id": 99652,
            "api_model": "artworks",
            "api_link": "https://api.artic.edu/api/v1/artworks/99652",
            "is_boosted": false,
            "title": "St. Joseph and Christ Child",
            "alt_titles": null,
            ...
        },
        {
            "id": 46875,
            "api_model": "artworks",
            "api_link": "https://api.artic.edu/api/v1/artworks/46875",
            "is_boosted": false,
            "title": "Profile of Mary Reynolds with Jewel",
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
        "version": "1.14"
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
        "total": 49,
        "limit": 10,
        "offset": 0,
        "total_pages": 5,
        "current_page": 1
    },
    "data": [
        {
            "_score": 122.00677,
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
            "timestamp": "2026-02-26T00:32:58-06:00"
        },
        {
            "_score": 113.039665,
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
            "timestamp": "2026-02-25T23:24:24-06:00"
        },
        {
            "_score": 111.79353,
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
            "timestamp": "2026-02-25T23:25:49-06:00"
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
        "version": "1.14"
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
        "total": 16715,
        "limit": 2,
        "offset": 0,
        "total_pages": 8358,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/agents?page=2&limit=2"
    },
    "data": [
        {
            "id": 47893,
            "api_model": "agents",
            "api_link": "https://api.artic.edu/api/v1/agents/47893",
            "title": "Virgil Thomson",
            "sort_title": "Thomson, Virgil",
            "alt_titles": null,
            ...
        },
        {
            "id": 24885,
            "api_model": "agents",
            "api_link": "https://api.artic.edu/api/v1/agents/24885",
            "title": "Florine Stettheimer",
            "sort_title": "Stettheimer, Florine",
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
        "version": "1.14"
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
        "total": 16719,
        "limit": 10,
        "offset": 0,
        "total_pages": 1672,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "id": 27506,
            "api_model": "agents",
            "api_link": "https://api.artic.edu/api/v1/agents/27506",
            "title": "Pierre Violet",
            "timestamp": "2026-02-26T15:08:35-06:00"
        },
        {
            "_score": 1,
            "id": 27530,
            "api_model": "agents",
            "api_link": "https://api.artic.edu/api/v1/agents/27530",
            "title": "Jan Visscher",
            "timestamp": "2026-02-26T15:08:35-06:00"
        },
        {
            "_score": 1,
            "id": 27531,
            "api_model": "agents",
            "api_link": "https://api.artic.edu/api/v1/agents/27531",
            "title": "Nicolas Jansz. (Claes) Visscher",
            "timestamp": "2026-02-26T15:08:35-06:00"
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
        "version": "1.14"
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
        "total": 4146,
        "limit": 2,
        "offset": 0,
        "total_pages": 2073,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/places?page=2&limit=2"
    },
    "data": [
        {
            "id": 33519,
            "api_model": "places",
            "api_link": "https://api.artic.edu/api/v1/places/33519",
            "title": "Sana'a",
            "latitude": 15.4,
            "longitude": 44.2333,
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
        "version": "1.14"
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
        "total": 4146,
        "limit": 10,
        "offset": 0,
        "total_pages": 415,
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
        "version": "1.14"
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
            "id": 23999,
            "api_model": "galleries",
            "api_link": "https://api.artic.edu/api/v1/galleries/23999",
            "title": "Gallery 184",
            "latitude": 41.880005810703,
            "longitude": -87.622309160161,
            ...
        },
        {
            "id": 23998,
            "api_model": "galleries",
            "api_link": "https://api.artic.edu/api/v1/galleries/23998",
            "title": "Gallery 183",
            "latitude": 41.880125632037,
            "longitude": -87.622315865683,
            ...
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
        "total": 179,
        "limit": 10,
        "offset": 0,
        "total_pages": 18,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "id": 2,
            "api_model": "galleries",
            "api_link": "https://api.artic.edu/api/v1/galleries/2",
            "title": "East Garden at Columbus Drive",
            "timestamp": "2026-02-24T12:08:39-06:00"
        },
        {
            "_score": 1,
            "id": 346,
            "api_model": "galleries",
            "api_link": "https://api.artic.edu/api/v1/galleries/346",
            "title": "Stock Exchange Trading Room",
            "timestamp": "2026-02-24T12:08:39-06:00"
        },
        {
            "_score": 1,
            "id": 2705,
            "api_model": "galleries",
            "api_link": "https://api.artic.edu/api/v1/galleries/2705",
            "title": "Gallery 59",
            "timestamp": "2026-02-24T12:08:39-06:00"
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
        "version": "1.14"
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
        "total": 6510,
        "limit": 2,
        "offset": 0,
        "total_pages": 3255,
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
        "version": "1.14"
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
        "total": 6510,
        "limit": 10,
        "offset": 0,
        "total_pages": 651,
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
        "version": "1.14"
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
        "version": "1.14"
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
        "version": "1.14"
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
        "version": "1.14"
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
        "version": "1.14"
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
        "version": "1.14"
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
        "version": "1.14"
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
        "version": "1.14"
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
        "version": "1.14"
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
        "version": "1.14"
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
        "version": "1.14"
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
        "total": 10900,
        "limit": 2,
        "offset": 0,
        "total_pages": 5450,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/category-terms?page=2&limit=2"
    },
    "data": [
        {
            "id": "TM-16491",
            "api_model": "category-terms",
            "api_link": "https://api.artic.edu/api/v1/category-terms/TM-16491",
            "title": "pose",
            "subtype": "subject",
            "parent_id": null,
            ...
        },
        {
            "id": "TM-16490",
            "api_model": "category-terms",
            "api_link": "https://api.artic.edu/api/v1/category-terms/TM-16490",
            "title": "street corner",
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
        "version": "1.14"
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
        "total": 10900,
        "limit": 10,
        "offset": 0,
        "total_pages": 1090,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "id": "PC-1",
            "api_model": "category-terms",
            "api_link": "https://api.artic.edu/api/v1/category-terms/PC-1",
            "title": "Arts of Africa",
            "timestamp": "2026-02-24T12:10:20-06:00"
        },
        {
            "_score": 1,
            "id": "PC-10",
            "api_model": "category-terms",
            "api_link": "https://api.artic.edu/api/v1/category-terms/PC-10",
            "title": "Painting and Sculpture of Europe",
            "timestamp": "2026-02-24T12:10:20-06:00"
        },
        {
            "_score": 1,
            "id": "PC-100",
            "api_model": "category-terms",
            "api_link": "https://api.artic.edu/api/v1/category-terms/PC-100",
            "title": "Impressionism and Post-Impressionism",
            "timestamp": "2026-02-24T12:10:20-06:00"
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
        "version": "1.14"
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
        "total": 179783,
        "limit": 2,
        "offset": 0,
        "total_pages": 89892,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/images?page=2&limit=2"
    },
    "data": [
        {
            "id": "630c7f1e-1b6e-0485-37ae-91ff0a1e1b0c",
            "lake_guid": "630c7f1e-1b6e-0485-37ae-91ff0a1e1b0c",
            "api_model": "images",
            "api_link": "https://api.artic.edu/api/v1/images/630c7f1e-1b6e-0485-37ae-91ff0a1e1b0c",
            "title": "J34271-int",
            "type": "image",
            ...
        },
        {
            "id": "c5108eba-a7aa-d57a-e5ae-c9b0b1887cc5",
            "lake_guid": "c5108eba-a7aa-d57a-e5ae-c9b0b1887cc5",
            "api_model": "images",
            "api_link": "https://api.artic.edu/api/v1/images/c5108eba-a7aa-d57a-e5ae-c9b0b1887cc5",
            "title": "J30512-int",
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
        "version": "1.14"
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
        "total": 179827,
        "limit": 10,
        "offset": 0,
        "total_pages": 17983,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "id": "1bda4c4f-a4c1-cd47-9280-3f81745b80ab",
            "api_model": "images",
            "api_link": "https://api.artic.edu/api/v1/images/1bda4c4f-a4c1-cd47-9280-3f81745b80ab",
            "title": "AIC1997Degasphoto_006.jpg",
            "timestamp": "2026-02-24T12:10:50-06:00"
        },
        {
            "_score": 1,
            "id": "ade1618f-8a66-db18-9467-3d513c6ea5dc",
            "api_model": "images",
            "api_link": "https://api.artic.edu/api/v1/images/ade1618f-8a66-db18-9467-3d513c6ea5dc",
            "title": "IM010535",
            "timestamp": "2026-02-24T12:10:50-06:00"
        },
        {
            "_score": 1,
            "id": "d9ddbeee-69a4-5c3e-4759-d970de849218",
            "api_model": "images",
            "api_link": "https://api.artic.edu/api/v1/images/d9ddbeee-69a4-5c3e-4759-d970de849218",
            "title": "AIC1988SAICFellowship008.jpg",
            "timestamp": "2026-02-24T12:10:50-06:00"
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
        "version": "1.14"
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
        "version": "1.14"
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
            "timestamp": "2026-02-24T12:20:51-06:00"
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
        "version": "1.14"
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
        "total": 1368,
        "limit": 2,
        "offset": 0,
        "total_pages": 684,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/sounds?page=2&limit=2"
    },
    "data": [
        {
            "id": "e6221e2d-309c-6037-f879-d47736943674",
            "lake_guid": "e6221e2d-309c-6037-f879-d47736943674",
            "api_model": "sounds",
            "api_link": "https://api.artic.edu/api/v1/sounds/e6221e2d-309c-6037-f879-d47736943674",
            "title": "Michelle Madison V2",
            "type": "sound",
            ...
        },
        {
            "id": "4e21bc9d-6de6-e989-1394-21d90073a4a9",
            "lake_guid": "4e21bc9d-6de6-e989-1394-21d90073a4a9",
            "api_model": "sounds",
            "api_link": "https://api.artic.edu/api/v1/sounds/4e21bc9d-6de6-e989-1394-21d90073a4a9",
            "title": "Audio stop 207.mp3",
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
        "version": "1.14"
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
        "total": 1368,
        "limit": 10,
        "offset": 0,
        "total_pages": 137,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "id": "f38522ed-05e8-8761-953e-77d965c87ccf",
            "api_model": "sounds",
            "api_link": "https://api.artic.edu/api/v1/sounds/f38522ed-05e8-8761-953e-77d965c87ccf",
            "title": "Audio Lecture: The History and Transformation of a Benin Exhibition",
            "timestamp": "2026-02-24T12:20:51-06:00"
        },
        {
            "_score": 1,
            "id": "586f399e-1566-b42a-c4a9-5b4aa77a0d2f",
            "api_model": "sounds",
            "api_link": "https://api.artic.edu/api/v1/sounds/586f399e-1566-b42a-c4a9-5b4aa77a0d2f",
            "title": "Audio Lecture: Mel Bochner Symposium, Introduction and Keynote",
            "timestamp": "2026-02-24T12:20:51-06:00"
        },
        {
            "_score": 1,
            "id": "df8dcfba-6535-64e2-a4d1-7701e2d121e8",
            "api_model": "sounds",
            "api_link": "https://api.artic.edu/api/v1/sounds/df8dcfba-6535-64e2-a4d1-7701e2d121e8",
            "title": "Audio Lecture: Mel Bochner Symposium, Panel I: Language (Eric de Bruyn)",
            "timestamp": "2026-02-24T12:20:52-06:00"
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
        "version": "1.14"
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
        "total": 3888,
        "limit": 2,
        "offset": 0,
        "total_pages": 1944,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/texts?page=2&limit=2"
    },
    "data": [
        {
            "id": "2c168d60-b288-b252-9dd0-ca89b8e0266e",
            "lake_guid": "2c168d60-b288-b252-9dd0-ca89b8e0266e",
            "api_model": "texts",
            "api_link": "https://api.artic.edu/api/v1/texts/2c168d60-b288-b252-9dd0-ca89b8e0266e",
            "title": "AIC1928ModernPaintingandSculpture_comb_3357",
            "type": "text",
            ...
        },
        {
            "id": "ae51f385-20aa-49e5-b9f0-505054817bcf",
            "lake_guid": "ae51f385-20aa-49e5-b9f0-505054817bcf",
            "api_model": "texts",
            "api_link": "https://api.artic.edu/api/v1/texts/ae51f385-20aa-49e5-b9f0-505054817bcf",
            "title": "1959USCollectsPanAm_comb",
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
        "version": "1.14"
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
        "total": 3888,
        "limit": 10,
        "offset": 0,
        "total_pages": 389,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "id": "46298023-ac4e-605c-3020-871b59e67de6",
            "api_model": "texts",
            "api_link": "https://api.artic.edu/api/v1/texts/46298023-ac4e-605c-3020-871b59e67de6",
            "title": "1970_Photographs_by_Edmund_Teske_Installation_Photos_10.pdf",
            "timestamp": "2026-02-24T12:20:55-06:00"
        },
        {
            "_score": 1,
            "id": "7daac14a-c6ac-bc68-3198-aee9440f1bb5",
            "api_model": "texts",
            "api_link": "https://api.artic.edu/api/v1/texts/7daac14a-c6ac-bc68-3198-aee9440f1bb5",
            "title": "1970_Photographs_by_Euge_ne_Atget_Installation_Photos_16.pdf",
            "timestamp": "2026-02-24T12:20:55-06:00"
        },
        {
            "_score": 1,
            "id": "aa99f424-7100-e96d-1bf1-c18e310601f3",
            "api_model": "texts",
            "api_link": "https://api.artic.edu/api/v1/texts/aa99f424-7100-e96d-1bf1-c18e310601f3",
            "title": "1969_Prison_and_the_Free_WorldDanny_Lyon_Installation_Photos_10.pdf",
            "timestamp": "2026-02-24T12:20:55-06:00"
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
        "version": "1.14"
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
        "total": 2333,
        "limit": 2,
        "offset": 0,
        "total_pages": 1167,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/products?page=2&limit=2"
    },
    "data": [
        {
            "id": 291985,
            "api_model": "products",
            "api_link": "https://api.artic.edu/api/v1/products/291985",
            "title": "Henri Matisse Playing Cards",
            "external_sku": 291985,
            "image_url": "https://shop-images.imgix.net291985_2.jpg",
            ...
        },
        {
            "id": 291962,
            "api_model": "products",
            "api_link": "https://api.artic.edu/api/v1/products/291962",
            "title": "The Most Fascinating Museums Postcards: 50 Postcards Celebrating North America\u2019s Favorite Museums",
            "external_sku": 291962,
            "image_url": "https://shop-images.imgix.net291962_2.jpg",
            ...
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
        "total": 2333,
        "limit": 10,
        "offset": 0,
        "total_pages": 234,
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
        "version": "1.14"
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
        "total": 18,
        "limit": 2,
        "offset": 0,
        "total_pages": 9,
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
            "id": 4551,
            "api_model": "tours",
            "api_link": "https://api.artic.edu/api/v1/tours/4551",
            "title": "Myth and Scandal",
            "image": "http://aic-mobile-tours.artic.edu/sites/default/files/tour-images/240772_LedaSwanMarble%20%281%29.jpg",
            "description": "<p>The Myth and Scandal tour tells some of the mythological stories behind the Art Institute of Chicago\u2019s Ancient Greek, Roman, Byzantine, and Egyptian collections. On this tour, you will hear about palace intrigue, Gods feuding, magical creatures, and much more as you weave your way through this vast collection.\u00a0</p>\n",
            ...
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
        "total": 18,
        "limit": 10,
        "offset": 0,
        "total_pages": 2,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "id": 1000,
            "api_model": "tours",
            "api_link": "https://api.artic.edu/api/v1/tours/1000",
            "title": "Magic of the Miniature",
            "timestamp": "2026-02-24T12:21:32-06:00"
        },
        {
            "_score": 1,
            "id": 1023,
            "api_model": "tours",
            "api_link": "https://api.artic.edu/api/v1/tours/1023",
            "title": "The Architecture Tour",
            "timestamp": "2026-02-24T12:21:32-06:00"
        },
        {
            "_score": 1,
            "id": 2193,
            "api_model": "tours",
            "api_link": "https://api.artic.edu/api/v1/tours/2193",
            "title": "The Essentials Tour",
            "timestamp": "2026-02-24T12:21:32-06:00"
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
        "version": "1.14"
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
        "total": 1056,
        "limit": 2,
        "offset": 0,
        "total_pages": 528,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/mobile-sounds?page=2&limit=2"
    },
    "data": [
        {
            "id": 6033,
            "api_model": "mobile-sounds",
            "api_link": "https://api.artic.edu/api/v1/mobile-sounds/6033",
            "title": "T66_VD_06_KoreanNationalTreasures_BottlewithFishMotif_Korean ",
            "web_url": "https://www.artic.edu/mobile/audio/KNT%20Verbal%20Descriptions_05_0.mp3",
            "transcript": "<p>\uc774 \ub3c4\uc790\uae30 \ubcd1\uc740 \ub450 \uc190\uc73c\ub85c \ud3b8\uc548\ud558\uac8c \uc7a1\uc744 \uc218 \uc788\ub294 \ud06c\uae30\uc785\ub2c8\ub2e4. \uc791\uace0 \ub465\uadfc \uad7d\uc5d0\uc11c \uc2dc\uc791\ud574 \uc704\ub85c<br>\uac08\uc218\ub85d \uc644\ub9cc\ud558\uac8c \ub113\uc5b4\uc9c0\ub294 \ubab8\uccb4\ub294 \uc804\uccb4\uc801\uc73c\ub85c \ud48d\uc131\ud558\uace0 \ub465\uadfc \uace1\uc120\uc744 \uadf8\ub9bd\ub2c8\ub2e4. \ubc14\ub2e5\uc5d0\uc11c 3 \ubd84\uc758<br>1 \uc9c0\uc810\uc5d0\uc11c \uc9c0\ub984\uc774 \uac70\uc758 7 \uc778\uce58 (18 cm) \ub85c \uac00\uc7a5 \ub113\uc5b4\uc9c0\uba70, \uadf8 \uc704\ub85c\ub294 \uae09\uaca9\ud788 \uc881\uc544\uc838 \ub0a0\ub835\ud55c \ubaa9\uc744<br>\uc774\ub8ec \ub4a4 \ub2e4\uc2dc \ud3c9\ud3c9\ud55c \uc785\uad6c\ub85c \ub113\uac8c \ud37c\uc9d1\ub2c8\ub2e4. \uc804\uccb4\uc801\uc778 \ubaa8\uc591\uc740 \ub9c8\uce58 \uc11c\uc591\ubc30\ub97c \ub2ee\uc558\uc2b5\ub2c8\ub2e4.<br>\ud45c\uba74\uc740 \uc740\uc740\ud55c \uad11\ud0dd\uc774 \ub3c4\ub294 \ub530\ub73b\ud55c \ud06c\ub9bc\uc0c9\uc785\ub2c8\ub2e4. \ubbf8\uc138\ud55c \uc694\ucca0\uc774 \ub290\uaef4\uc9c0\ub294 \uc9c8\uac10\uc740 \ub9c8\uce58 \uc791\uc740<br>\uc870\uc57d\ub3cc \uac19\uc774 \ub9e4\ub044\ub7ec\uc6b0\uba74\uc11c\ub3c4 \uc790\uc5f0\uc2a4\ub7ec\uc6b4 \ubd88\uc644\uc804\ud568\uc744 \uc9c0\ub2c8\uace0 \uc788\uc2b5\ub2c8\ub2e4. \uc774\ub7ec\ud55c \uc2a4\ud0c0\uc77c\uc758<br>\ub3c4\uc790\uae30\uac00 \uac70\uce5c \ud0dc\ud1a0\ub85c \ub9cc\ub4e4\uc5b4\uc838 \uc18c\ubc15\ud558\uace0 \uc815\uaca8\uc6b4 \uba4b\uc73c\ub85c \uc798 \uc54c\ub824\uc9c4 \u2018\ubd84\uccad\uc0ac\uae30\u2019\uc785\ub2c8\ub2e4. \ub3c4\uacf5\uc740 \ubcd1<br>\ub458\ub808\uc5d0 \uc5ec\ub7ec \uac1c\uc758 \ub760\ub97c \uc0c8\uaca8 \ub123\uc5c8\uc2b5\ub2c8\ub2e4. \uc774 \uc120\ub4e4\uc740 \ud558\ub2e8\ubd80\uc5d0 \ucd18\ucd18\ud788 \ubaa8\uc5ec \uc788\ub2e4\uac00 \ubab8\uccb4\uc640 \ubaa9<br>\ubd80\ubd84\uc73c\ub85c \uac08\uc218\ub85d \uac04\uaca9\uc774 \ub113\uc5b4\uc9d1\ub2c8\ub2e4. \uc120 \uc548\ucabd\uc740 \uc0b0\ud654\ucca0 \uc548\ub8cc\ub85c \ub9cc\ub4e0 \uc9d9\uc740 \uac08\uc0c9 \uc720\uc57d\uc73c\ub85c \ucc44\uc6cc\uc838<br>\uc788\uc2b5\ub2c8\ub2e4. \ubab8\uccb4\uc5d0\uc11c \uac00\uc7a5 \ub113\uc740 \ubd80\ubd84\uc758 \ub760 \uc0ac\uc774\uc5d0\ub294 \ubb3c\uace0\uae30\ub97c \ud615\uc0c1\ud654\ud55c \ub300\ub2f4\ud558\uace0 \uadf8\ub798\ud53d\uc801\uc778<br>\ubb38\uc591\uc774 \uc7a5\uc2dd\ub418\uc5b4 \uc788\uc2b5\ub2c8\ub2e4. \uac19\uc740 \ucca0\ud654 \uae30\ubc95\uc758 \uac08\uc0c9\uc73c\ub85c \uadf8\ub824\uc9c4 \ucee4\ub2e4\ub780 \ubb3c\uace0\uae30\ub294 \ub9cc\ud654 \uce90\ub9ad\ud130\ucc98\ub7fc<br>\uc775\uc0b4\uc2a4\ub7fd\uace0 \uc7a5\ub09c\uc2a4\ub7ec\uc6b4 \ubaa8\uc2b5\uc785\ub2c8\ub2e4. \ub3d9\uc2ec\uc6d0\uc73c\ub85c \ud45c\ud604\ub41c \ucee4\ub2e4\ub780 \ub208\uc740 \ud22d \ud280\uc5b4\ub098\uc640 \uc788\uace0, \ubc18\ubcf5\uc801\uc778<br>\ubd80\ucc44\uaf34 \ubaa8\uc591\uc758 \uc120\uc73c\ub85c \ud615\uc131\ub41c \ube44\ub298\uc744 \uac00\uc9c0\uace0 \uc788\uc2b5\ub2c8\ub2e4. \uc9c0\ub290\ub7ec\ubbf8\uc640 \uc544\uac00\ubbf8\ub294 \uac00\ub85c\uc138\ub85c\uc758 \uc9c1\uc120\uacfc<br>\ubd80\ub4dc\ub7ec\uc6b4 \uace1\uc120\uc73c\ub85c \uc774\ub8e8\uc5b4\uc838 \uc788\uc2b5\ub2c8\ub2e4. \uc120\uc758 \uc9c8\uac10\uc740 \ubd93\uc73c\ub85c \uadf8\ub9b0 \ub4ef \ub05d\uc774 \uac00\ub298\uc5b4\uc9c0\ub294 \uad75\uc740<br>\ud544\uce58\ub97c \ubcf4\uc5ec\uc8fc\uc5b4 \uc11c\uc608\uc801\uc778 \ub290\ub08c\uc744 \uc790\uc544\ub0c5\ub2c8\ub2e4. \uc774 \ubb3c\uace0\uae30\ub294 \uae34 \uc8fc\ub465\uc774\uac00 \uaf2c\ub9ac\uc9c0\ub290\ub7ec\ubbf8 \ub05d\uacfc<br>\ub9de\ub2ff\uc544 \ubcd1 \uc804\uccb4\ub97c \ud718\uac10\uace0 \uc788\uc2b5\ub2c8\ub2e4.</p>\n",
            ...
        },
        {
            "id": 6032,
            "api_model": "mobile-sounds",
            "api_link": "https://api.artic.edu/api/v1/mobile-sounds/6032",
            "title": "T66_VD_05_KoreanNationalTreasures_EightGreatEventsintheLifeofShakyamuniBuddha_Korean ",
            "web_url": "https://www.artic.edu/mobile/audio/KNT%20Verbal%20Descriptions_03.mp3",
            "transcript": "<p>\uc774 \ub450 \uc810\uc758 \ube44\ub2e8 \ucc44\uc0c9\ud654\ub294 \ud654\ub824\ud55c \uc0c9\ucc44\uc758 \ud5a5\uc5f0\uc744 \uc120\uc0ac\ud569\ub2c8\ub2e4. \ubd89\uc740\uc0c9, \ucd08\ub85d\uc0c9, \uae08\uc0c9, \ud478\ub978\uc0c9\uc774<br>\uc5b4\uc6b0\ub7ec\uc838 \uc778\ubb3c, \ub3d9\ubb3c, \ub098\ubb34, \uad6c\ub984, \uac74\ucd95\ubb3c, \uc2e0\ud654 \uc18d \uc0dd\ubb3c\ub4e4\ub85c \uac00\ub4dd \ucc2c \uce58\ubc00\ud55c \uad6c\ub3c4\uc5d0 \uc0dd\uba85\ub825\uc744<br>\ubd88\uc5b4\ub123\uc2b5\ub2c8\ub2e4. \uac01\uac01 \uac00\ub85c \uc57d 43 \uc778\uce58 (\uc57d 110cm), \uc138\ub85c \uc57d 60 \uc778\uce58 (\uc57d 152 cm)\uc5d0 \ub2ec\ud558\ub294 \uac70\ub300\ud55c<br>\ud06c\uae30\uc784\uc5d0\ub3c4 \uadf8 \uc548\uc5d0 \ub2f4\uae34 \ubcf5\uc7a1\ub2e4\ub2e8\ud55c \uc11c\uc0ac\ub97c \ub2e4 \ub2f4\uc544\ub0b4\uae30 \ubc85\ucc28 \ubcf4\uc77c \uc815\ub3c4\uc785\ub2c8\ub2e4. \uac01 \uadf8\ub9bc\uc740 \uc5ec\ub7ec<br>\uc774\uc57c\uae30\uac00 \uc18c\uc9d1\ub2e8\uc73c\ub85c \ubb36\uc5ec \ub3d9\uc2dc\uc5d0 \ud3bc\uccd0\uc9c0\ub294 \uc5f0\uc18d\uc801 \uc11c\uc0ac \uad6c\uc870\ub97c \ucde8\ud558\uace0 \uc788\uc2b5\ub2c8\ub2e4. \uc774 \uc791\ud488\ub4e4\uc740<br>\ubd80\ucc98\uc758 \uc0dd\uc560\uc640 \uac00\ub974\uce68\uc744 \ub2f4\uc740 \ub300\ud45c\uc801\uc778 \uc7a5\uba74\ub4e4\uc778 \uc11d\uac00\ud314\uc0c1\ub3c4 \uc911 \uc77c\ubd80\uc785\ub2c8\ub2e4. \ud55c\uad6d \ud68c\ud654\ub294<br>\ud55c\uad6d\uc5b4\uc640 \ub9c8\ucc2c\uac00\uc9c0\ub85c \uc624\ub978\ucabd\uc5d0\uc11c \uc67c\ucabd\uc73c\ub85c \uc77d\uae30 \ub54c\ubb38\uc5d0, \uc624\ub978\ucabd\uc5d0 \uc804\uc2dc\ub41c \uadf8\ub9bc\ubd80\ud130 \uc774\uc57c\uae30\uac00<br>\uc2dc\uc791\ub429\ub2c8\ub2e4.<br>\u2018\ub3c4\uc194\ub798\uc758\uc0c1\u2019\uc774\ub77c \ubd88\ub9ac\ub294 \uc774 \uccab \ubc88\uc9f8 \uadf8\ub9bc\uc740 \ubd80\ucc98\uc758 \uc218\ud0dc \uc7a5\uba74\uc744 \ubb18\uc0ac\ud569\ub2c8\ub2e4. \uc5ed\uc0ac\uc801\uc778 \ubd80\ucc98\uac00<br>\ub418\uae30 \uc804, \uc2e0\uc911 (\ubd88\uad50\uc758 \uc218\ud638\uc2e0)\uc73c\ub85c\uc11c\uc758 \uc218\ub9ce\uc740 \uc804\uc0dd \uc911 \ud558\ub098\uac00 \ub4f1\uc7a5\ud569\ub2c8\ub2e4. \uc624\ub978\ucabd \uc0c1\ub2e8\uc5d0\ub294<br>\ubd80\ucc98\uac00 \ubd89\uc740 \uc6d0 \uc548\uc5d0\uc11c \uc5ec\uc12f \uac1c\uc758 \uc0c1\uc544\ub97c \uac00\uc9c4 \ud770 \ucf54\ub07c\ub9ac\ub97c \ud0c0\uace0 \uac00\ubd80\uc88c\ub97c \ud2c0\uace0 \ub5a0 \uc788\ub294 \ub4ef\ud558\uba70,<br>\ubd89\uc740\uc0c9\uacfc \ud478\ub978\uc0c9 \ubc95\ubcf5\uc744 \uc785\uc740 \ubcf4\uc0b4\uacfc \uc2e0\uc911\ub4e4\uc774 \ubd80\ucc98\ub97c \ud638\uc704\ud558\uace0 \uc788\ub294\ub370, \uc5b4\ub5a4 \uc774\ub294 \ud569\uc7a5\uc744 \ud558\uace0,<br>\uc5b4\ub5a4 \uc774\ub294 \uc545\uae30\ub97c \uc5f0\uc8fc\ud558\uba70, \ub610 \uc5b4\ub5a4 \uc774\ub294 \uaf43\uc78e\uc744 \ubfcc\ub9ac\uba70 \ubd80\ucc98\uc758 \uac15\ub9bc\uc744 \uc54c\ub9bd\ub2c8\ub2e4. \uc774\ub4e4\uc740 \ubaa8\ub450<br>\ucd08\ub85d\uc0c9\uacfc \uae08\uc0c9 \uad6c\ub984\uc744 \ud0c0\uace0 \ud654\uba74 \uc67c\ucabd \uc544\ub798\ub85c \ub0b4\ub824\uc624\ub294\ub370, \uadf8 \uacf3\uc5d0\ub294 \ud654\ub824\ud55c \uc637\uc744 \uc785\uc740 \uc5ec\uc778\uc774<br>\uc2dc\uc885\ub4e4\uc5d0\uac8c \ub458\ub7ec\uc2f8\uc5ec \uc549\uc544 \uc788\uc2b5\ub2c8\ub2e4. \ubc14\ub85c \ubd80\ucc98\uc758 \uc5b4\uba38\ub2c8\uc778 \ub9c8\uc57c \ubd80\uc778\uc73c\ub85c, \uc218\ud0dc\uc758 \uc21c\uac04\uc744<br>\ubb18\uc0ac\ud55c \uac83\uc785\ub2c8\ub2e4. \ub8f8\ube44\ub2c8 \uc655\uad6d\uc758 \uc655\ube44\uc600\ub358 \uadf8\ub140\ub294 \uc5ec\uc12f \uac1c\uc758 \uc0c1\uc544\uac00 \ub2ec\ub9b0 \ucf54\ub07c\ub9ac\uac00 \uc790\uc2e0\uc758<br>\uc606\uad6c\ub9ac\ub85c \ub4e4\uc5b4\uc624\ub294 \uafc8\uc744 \uafb8\uc5c8\uc2b5\ub2c8\ub2e4.<br>\uc624\ub978\ucabd \ud558\ub2e8 \uc0ac\uac01\ud615 \ud2c0 \uc548\uc5d0\ub294 \uc784\uc2e0\ud55c \ub9c8\uc57c \ubd80\uc778\uacfc \uadf8\ub140\uc758 \ub0a8\ud3b8\uc778 \uc655\uc774 \ud568\uaed8 \uc544\ub4e4\uc758 \ud0c4\uc0dd\uc744<br>\uae30\ub2e4\ub9ac\ub294 \ubaa8\uc2b5\uc774 \ub2f4\uaca8 \uc788\uc2b5\ub2c8\ub2e4. \uadf8\ub9bc\uc744 \uac00\ub4dd \ucc44\uc6b4 \uc218\uc2ed \uba85\uc758 \uc778\ubb3c\uc740 \uc7a5\ucc28 \uc704\ub300\ud55c \uae68\ub2ec\uc74c\uc744 \uc5bb\uc740<br>\uc2a4\uc2b9\uc774 \ub420 \uc5b4\ub9b0 \uc655\uc790\uc758 \ud0c4\uc0dd\uc744 \ucd95\ud558\ud558\ub294 \ucd95\uc81c \ubd84\uc704\uae30\ub97c \uc790\uc544\ub0c5\ub2c8\ub2e4.<br>\uc67c\ucabd\uc5d0 \uc704\uce58\ud55c \uadf8\ub9bc\uc740 8 \ud3ed \uc911 \ub610 \ub2e4\ub978 \uc774\uc57c\uae30\uc778 \u2018\uc124\uc0b0\uc218\ub3c4\uc0c1\u2019\uc73c\ub85c, \ub208 \ub36e\uc778 \uc0b0\uc5d0\uc11c \uace0\ud589\ud558\ub294<br>\ubd80\ucc98\uc758 \uc774\uc57c\uae30\ub97c \ub2f4\uace0 \uc788\uc2b5\ub2c8\ub2e4. \uc55e\uc120 \uadf8\ub9bc\uacfc \ub9c8\ucc2c\uac00\uc9c0\ub85c \ubd89\uc740\uc0c9, \ud669\uc0c9, \ud478\ub978\uc0c9, \ucd08\ub85d\uc0c9\uc758 \ud654\ub824\ud55c<br>\uc0c9\uac10\uacfc \uc2dc\uac01\uc801, \uc11c\uc0ac\uc801 \uc694\uc18c\uc758 \ubc00\ub3c4\ub97c \uacf5\uc720\ud569\ub2c8\ub2e4. \uc774 \uadf8\ub9bc\uc740 \uace0\ud0c0\ub9c8 \uc2ef\ub2e4\ub974\ud0c0\ub85c \ud0dc\uc5b4\ub09c \ubd80\ucc98\uac00<br>\uc655\uc790\uc758 \uc0b6\uc744 \ubc84\ub9ac\uace0 \uae68\ub2ec\uc74c\uc744 \uc5bb\uc740 \uc874\uc7ac\ub85c \uc9c4\ud654\ud558\ub294 \uacfc\uc815\uc744 \ubcf4\uc5ec\uc90d\ub2c8\ub2e4. \uc67c\ucabd \ud558\ub2e8, \ud478\ub978\uc0c9 \ubab8\uc744<br>\ud55c \uc778\ubb3c\uc774 \uc790\uc2e0\uc758 \uba38\ub9ac\uce74\ub77d\uc744 \uc790\ub974\ub824 \uba38\ub9ac \uc704\ub85c \uce7c\uc744 \ub4e4\uace0 \uc788\ub294\ub370, \uc774\ub294 \uc138\uc18d\uc758 \ubbf8\ub828\uc744 \ub04a\uc5b4\ub0b4\ub294<br>\uc0c1\uc9d5\uc801\uc778 \ud589\uc704\uc785\ub2c8\ub2e4. \uadf8 \uc624\ub978\ucabd\uc73c\ub85c\ub294 \uc2ef\ub2e4\ub974\ud0c0\uc758 \uc544\ubc84\uc9c0\uac00 \uadf8\ub97c \uad81\uc804\uc73c\ub85c \ub370\ub824\uc624\uae30 \uc704\ud574 \ubcf4\ub0b8<br>\ud654\ub824\ud55c \ub9c8\ucc28\uac00 \ub3c4\ucc29\ud558\uc9c0\ub9cc, \ubd80\ucc98\ub294 \uc774\ub97c \uac70\uc808\ud569\ub2c8\ub2e4. \uadf8\ub9bc\uc758 \ud558\ub2e8\ubd80\ub294 \ubd80\ucc98\ub97c \ub2e4\uc2dc \uc655\uc790\uc758<br>\uc0b6\uc73c\ub85c \ub418\ub3cc\ub9ac\ub824 \ud588\ub358 \uc0ac\ub78c\ub4e4\uc744 \ub098\ud0c0\ub0c5\ub2c8\ub2e4. \ub9c8\ucc28 \ubc14\ub85c \uc67c\ucabd\uc5d0\ub294 \ubd80\ucc98\uac00 \ud639\ub3c5\ud55c \ud658\uacbd\uc5d0\uc11c \uace0\ud589\uc744<br>\uc2dc\uc791\ud588\ub358 \ud558\uc580 \uc124\uc0b0\uc774 \ubcf4\uc785\ub2c8\ub2e4. \uadf8\ub9bc \uc0c1\ub2e8 3 \ubd84\uc758 1 \uc9c0\uc810 \uc67c\ucabd\uc5d0\ub294 \uc2b9\ubcf5\uc73c\ub85c \uaca8\uc6b0 \ubab8\uc744 \uac00\ub9b0<br>\ubd80\ucc98\uac00 \ubcf4\ub9ac\uc218 \uc544\ub798 \ud5d8\uc900\ud55c \ubc14\uc704 \uc704\uc5d0 \uc549\uc544 \uc138 \uba85\uc758 \uc81c\uc790\uc5d0\uac8c \uc9c0\ud61c\ub97c \uc804\ud558\uace0 \uc788\uc2b5\ub2c8\ub2e4. \uadf8<br>\uc624\ub978\ucabd\uc5d0\uc11c \ubd80\ucc98\ub294 \uc74c\uc2dd\uc744 \uacf5\uc591\ud558\ub294 \uc7ac\uac00 \uc2e0\uc790\ub4e4 \uc55e\uc5d0 \ub2e4\uc2dc \ub4f1\uc7a5\ud569\ub2c8\ub2e4. \uc5ec\uae30\uc11c \ubd80\ucc98\ub294 \ucd08\ub85d\uc0c9<br>\uc6d0\ud310 \uc704\uc5d0 \ub5a0 \uc788\ub294 \ubaa8\uc2b5\uc73c\ub85c \ubb18\uc0ac\ub418\uc5b4, \uae68\ub2ec\uc74c\uc5d0 \uac00\uae4c\uc6cc \uc84c\uc74c\uc744 \uc554\uc2dc\ud569\ub2c8\ub2e4. \uadf8\ub9bc\uc758 \ub098\uba38\uc9c0<br>\ubd80\ubd84\uc740 \ud654\ub824\ud55c \uad00\uc744 \uc4f4 \uadc0\uc871\ubd80\ud130 \uc77c\ubc18 \ud3c9\ubbfc\uc5d0 \uc774\ub974\uae30\uae4c\uc9c0, \ubd80\ucc98\uc758 \uc9c0\ud61c\ub97c \uad6c\ud558\ub824\ub294 \uac01\uacc4\uac01\uce35\uc758<br>\uc0ac\ub78c\ub4e4\ub85c \ube7d\ube7d\ud558\uac8c \ucc44\uc6cc\uc838 \uc788\uc2b5\ub2c8\ub2e4.</p>\n",
            ...
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
        "total": 1056,
        "limit": 10,
        "offset": 0,
        "total_pages": 106,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "id": 226,
            "api_model": "mobile-sounds",
            "api_link": "https://api.artic.edu/api/v1/mobile-sounds/226",
            "title": "Justus Sustermans",
            "timestamp": "2026-02-24T12:21:35-06:00"
        },
        {
            "_score": 1,
            "id": 227,
            "api_model": "mobile-sounds",
            "api_link": "https://api.artic.edu/api/v1/mobile-sounds/227",
            "title": "Self-Portrait, Etching at a Window",
            "timestamp": "2026-02-24T12:21:35-06:00"
        },
        {
            "_score": 1,
            "id": 235,
            "api_model": "mobile-sounds",
            "api_link": "https://api.artic.edu/api/v1/mobile-sounds/235",
            "title": "Self-Portrait, Anthony Van Dyck",
            "timestamp": "2026-02-24T12:21:35-06:00"
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
        "version": "1.14"
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
        "version": "1.14"
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
            "timestamp": "2026-02-24T12:21:46-06:00"
        },
        {
            "_score": 1,
            "id": 7,
            "api_model": "publications",
            "api_link": "https://api.artic.edu/api/v1/publications/7",
            "title": "Pissarro Paintings and Works on Paper at the Art Institute of Chicago",
            "timestamp": "2026-02-24T12:21:46-06:00"
        },
        {
            "_score": 1,
            "id": 12,
            "api_model": "publications",
            "api_link": "https://api.artic.edu/api/v1/publications/12",
            "title": "The Modern Series at the Art Institute of Chicago",
            "timestamp": "2026-02-24T12:21:46-06:00"
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
        "version": "1.14"
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
        "version": "1.14"
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
            "id": 18,
            "api_model": "sections",
            "api_link": "https://api.artic.edu/api/v1/sections/18",
            "title": "Foreword",
            "timestamp": "2026-02-24T12:21:46-06:00"
        },
        {
            "_score": 1,
            "id": 25,
            "api_model": "sections",
            "api_link": "https://api.artic.edu/api/v1/sections/25",
            "title": "Preface: American Silver",
            "timestamp": "2026-02-24T12:21:46-06:00"
        },
        {
            "_score": 1,
            "id": 33,
            "api_model": "sections",
            "api_link": "https://api.artic.edu/api/v1/sections/33",
            "title": "Forging a Collection: American Silver at the Art Institute of Chicago",
            "timestamp": "2026-02-24T12:21:46-06:00"
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
        "version": "1.14"
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
        "version": "1.14"
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
            "timestamp": "2026-02-24T12:22:44-06:00"
        },
        {
            "_score": 1,
            "id": 2,
            "api_model": "sites",
            "api_link": "https://api.artic.edu/api/v1/sites/2",
            "title": "American Perspectives: A yearlong celebration of American artistic vision",
            "timestamp": "2026-02-24T12:22:44-06:00"
        },
        {
            "_score": 1,
            "id": 3,
            "api_model": "sites",
            "api_link": "https://api.artic.edu/api/v1/sites/3",
            "title": "Curious Corner",
            "timestamp": "2026-02-24T12:22:44-06:00"
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
        "version": "1.14"
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
        "total": 2870,
        "limit": 2,
        "offset": 0,
        "total_pages": 1435,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/events?page=2&limit=2"
    },
    "data": [
        {
            "id": 6379,
            "api_model": "events",
            "api_link": "https://api.artic.edu/api/v1/events/6379",
            "title": "Lecture: Beyond Tradition\u2014Emerging Japanese Craft Artists",
            "title_display": null,
            "image_url": "https://artic-web.imgix.net/3681a130-043c-4f42-8c8f-0e66e2fda2d1/main.jpeg?rect=0%2C0%2C800%2C450&auto=format%2Ccompress&q=80&fit=crop&crop=faces%2Ccenter&w=1200&h=675",
            ...
        },
        {
            "id": 6307,
            "api_model": "events",
            "api_link": "https://api.artic.edu/api/v1/events/6307",
            "title": "Conversation: Architects New Affiliates and Norman Kelley on Bruce Goff",
            "title_display": null,
            "image_url": "https://artic-web.imgix.net/e9c71f55-a1d1-4288-99f5-46fa4da2926a/J28881-int-Web72ppi%2C2000px%2CsRGB%2CJPEG.jpg?rect=0%2C223%2C2000%2C1128&auto=format%2Ccompress&q=80&fit=crop&crop=faces%2Ccenter&w=1200&h=677",
            ...
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
        "total": 2869,
        "limit": 10,
        "offset": 0,
        "total_pages": 287,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "id": 6352,
            "api_model": "events",
            "api_link": "https://api.artic.edu/api/v1/events/6352",
            "title": "Luminary Tour: Willem de Kooning Drawing (Sept 8)",
            "timestamp": "2026-02-26T15:00:21-06:00"
        },
        {
            "_score": 1,
            "id": 6412,
            "api_model": "events",
            "api_link": "https://api.artic.edu/api/v1/events/6412",
            "title": "Member Lecture: Embroidered Traditions from Morocco to Afghanistan",
            "timestamp": "2026-02-26T15:00:21-06:00"
        },
        {
            "_score": 1,
            "id": 6422,
            "api_model": "events",
            "api_link": "https://api.artic.edu/api/v1/events/6422",
            "title": "Gallery Conversation: Surrealism and World-Building",
            "timestamp": "2026-02-26T15:00:21-06:00"
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
        "image_url": "https://artic-web.imgix.net/22a002db-9695-452b-9c85-7a63644df4e0/G35154-int_press.jpg?rect=0%2C349%2C2334%2C1312&auto=format%2Ccompress&q=80&fit=crop&crop=faces%2Ccenter&w=1200&h=675",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.14"
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
        "total": 449,
        "limit": 2,
        "offset": 0,
        "total_pages": 225,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/event-occurrences?page=2&limit=2"
    },
    "data": [
        {
            "id": "f695963c-c328-57d8-afff-cf1797b594c9",
            "api_model": "event-occurrences",
            "api_link": "https://api.artic.edu/api/v1/event-occurrences/f695963c-c328-57d8-afff-cf1797b594c9",
            "title": "Gallery Tour (Sunday at 1:00, Grand Staircase start)",
            "title_display": "Gallery Tour",
            "event_id": 5532,
            ...
        },
        {
            "id": "c30b68e7-c82d-5db3-9656-da79dba2d64b",
            "api_model": "event-occurrences",
            "api_link": "https://api.artic.edu/api/v1/event-occurrences/c30b68e7-c82d-5db3-9656-da79dba2d64b",
            "title": "Conversation: Architects New Affiliates and Norman Kelley on Bruce Goff",
            "title_display": null,
            "event_id": 6307,
            ...
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
        "total": 449,
        "limit": 10,
        "offset": 0,
        "total_pages": 45,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "id": "a33b0fd0-5b41-55d3-aa7b-43ea2ad0ef90",
            "api_model": "event-occurrences",
            "api_link": "https://api.artic.edu/api/v1/event-occurrences/a33b0fd0-5b41-55d3-aa7b-43ea2ad0ef90",
            "title": "Member Lecture: Embroidered Traditions from Morocco to Afghanistan",
            "timestamp": "2026-02-25T23:27:06-06:00"
        },
        {
            "_score": 1,
            "id": "d936bf2a-b28a-5fa9-bcca-2106ada00e64",
            "api_model": "event-occurrences",
            "api_link": "https://api.artic.edu/api/v1/event-occurrences/d936bf2a-b28a-5fa9-bcca-2106ada00e64",
            "title": "Teen Studio Workshop: Ink in Action",
            "timestamp": "2026-02-25T23:27:06-06:00"
        },
        {
            "_score": 1,
            "id": "a7043f3d-17b0-5647-ae40-8d4effc1f64d",
            "api_model": "event-occurrences",
            "api_link": "https://api.artic.edu/api/v1/event-occurrences/a7043f3d-17b0-5647-ae40-8d4effc1f64d",
            "title": "Teen Studio Workshop: Made for Protection",
            "timestamp": "2026-02-25T23:27:06-06:00"
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

::: details Example request: https://api.artic.edu/api/v1/event-occurrences/009515f5-1b3a-5fad-b859-b65d00f8d673  
```js
{
    "data": {
        "id": "009515f5-1b3a-5fad-b859-b65d00f8d673",
        "api_model": "event-occurrences",
        "api_link": "https://api.artic.edu/api/v1/event-occurrences/009515f5-1b3a-5fad-b859-b65d00f8d673",
        "title": "The Artist's Studio: Brilliant Bricolage",
        "title_display": null,
        "event_id": 6331,
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.14"
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
        "total": 47,
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
        "version": "1.14"
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
        "total": 47,
        "limit": 10,
        "offset": 0,
        "total_pages": 5,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "id": 108,
            "api_model": "event-programs",
            "api_link": "https://api.artic.edu/api/v1/event-programs/108",
            "title": "Matisse",
            "timestamp": "2026-02-25T23:30:06-06:00"
        },
        {
            "_score": 1,
            "id": 107,
            "api_model": "event-programs",
            "api_link": "https://api.artic.edu/api/v1/event-programs/107",
            "title": "Critical Fabulation",
            "timestamp": "2026-02-25T23:30:06-06:00"
        },
        {
            "_score": 1,
            "id": 106,
            "api_model": "event-programs",
            "api_link": "https://api.artic.edu/api/v1/event-programs/106",
            "title": "Spotlight Talk",
            "timestamp": "2026-02-25T23:30:06-06:00"
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
        "version": "1.14"
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
        "total": 551,
        "limit": 2,
        "offset": 0,
        "total_pages": 276,
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
            "id": 102,
            "api_model": "articles",
            "api_link": "https://api.artic.edu/api/v1/articles/102",
            "title": "United Colors of Anxiety",
            "copy": " Jitish Kallat\u2019s installation Public Notice 3 opens at the Art Institute of Chicago tomorrow, September 11, 2010. The artist was generous enough to give us his thoughts on the work. Public Notice 3 draws on the historical convergence of an enormously influential call for religious tolerance by Swami Vivekananda at the Art Institute on September 11, 1893, and the September 11, 2001, terrorist attacks on the United States. The installation will be on view until January 2, 2011.   This Saturday, September 11, as Public Notice 3 takes up tenancy on the risers of the Art Institute\u2019s Grand Staircase, one of the elements it draws upon is the memory inscribed within the architecture of the museum building (site) and commences its engagement with the visiting public by evoking recent memories enshrined within 9/11 (date). Through its connection with the history of this building, it evokes yet another date, that of the first Parliament of Religions that took place at this very site at the Art Institute on September 11, 1893. The Parliament was the first attempt to create a global convergence of faiths\u2014not nations, possibly with the knowledge that in the future it will not \u201conly\u201d be nations that become sole commissioners of carnage\u2014and Public Notice 3 overlays these contrasting moments like a palimpsest. On September 11, 1893, the crowd of 7,000 was addressed by Swami Vivekananda. Now his speech is illuminated, conceptually and actually, in the threat coding system of the United States Department of Homeland Security. I find it interesting how the advisory system co-opts five colours from a visual artist\u2019s toolbox into the rhetoric of terror, by framing them as devices to meter and broadcast threat (much like its predecessors, the British BIKINI alert state and the French vigipirate ). Treating the museum\u2019s Grand Staircase almost like a notepad, the 118 step-risers receive the refracted text of the speech. I see Public Notice 3 as an experiential and contemplative transit space; the text of the speech is doubled at the two entry points on the lower levels of the staircase and quadrupled at the four exit points at the top, multiplying like a visual echo. \u2014Jitish Kallat ",
            "source_updated_at": "2018-08-08T16:07:41-05:00",
            ...
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
        "total": 551,
        "limit": 10,
        "offset": 0,
        "total_pages": 56,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "id": 1008,
            "api_model": "articles",
            "api_link": "https://api.artic.edu/api/v1/articles/1008",
            "title": "The Accidental Anonymity of Ancient Portraits",
            "timestamp": "2026-02-25T23:15:18-06:00"
        },
        {
            "_score": 1,
            "id": 1054,
            "api_model": "articles",
            "api_link": "https://api.artic.edu/api/v1/articles/1054",
            "title": "Leslie Wilson, Associate Director, Academic Engagement and Research",
            "timestamp": "2026-02-25T23:15:18-06:00"
        },
        {
            "_score": 1,
            "id": 1057,
            "api_model": "articles",
            "api_link": "https://api.artic.edu/api/v1/articles/1057",
            "title": "Bureaucratic Collage: Ghosts in the System",
            "timestamp": "2026-02-25T23:15:18-06:00"
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
        "source_updated_at": "2018-08-24T16:52:37-05:00",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.14"
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
        "total": 8,
        "limit": 2,
        "offset": 0,
        "total_pages": 4,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/highlights?page=2&limit=2"
    },
    "data": [
        {
            "id": 37,
            "api_model": "highlights",
            "api_link": "https://api.artic.edu/api/v1/highlights/37",
            "title": "making-a-difference-a-tour-for-families",
            "copy": " In this tour of the collection, you\u2019ll find five works by artists or featuring subjects who are envisioning peace, imagining new futures, and creating safe and just spaces. Explore these artworks and our suggested activities with your family and friends. Think about what you can do to help others and make your mark in the world.   Mended Petal (2016) by Yoko Ono Pritzker Garden   Yoko Ono is an artist, musician, and peace activist, and many of her artworks are meant to bring awareness to the need for peace and healing in the world. This sculpture is the shape of a petal from a lotus flower. Ono said, \u201cI see the lotus as a universal symbol of peace and embodiment of all of our greatest hopes and aspirations.\u201d Look for the raised lines on this sculpture, where it was mended. What do you think needs to be mended in the world today? How would you help to repair it? Use your body to copy the shape of this sculpture. Stand tall, raise your arms, and put your hands together. Feel the healing energy flow upward through your legs and body and then up your arms to the sky.   Starry Night and the Astronauts (1972) by Alma Thomas Gallery 297   This painter Alma Thomas wasn't afraid to try something new in art, even as she grew older. In her 70s, after retiring from teaching, she began to paint in an abstract way, using thick dabs of bright color. She was captivated by space exploration and astronauts going to the moon, and even though she never flew into space, she used her imagination to capture its magic in a new way. Thomas made this work in 1972, when she was 81\u2014the same year she became the first African American woman to have a solo exhibition at the Whitney Museum of American Art in New York. Do you think it\u2019s ever too late to change the way you think? Or too late to explore the things that fascinate you? Alma Thomas didn\u2019t think so. Can you think of people who made a difference when they were older? Do you think that you will continue to work for the things you believe in?   This, My Brother (1942) by Charles White Gallery 262   The Chicago artist Charles White said, \u201cPaint is the only weapon I have with which to fight what I resent.\u201d He believed that art could be a force in promoting racial equality for black people. This painting of a man emerging from a demolished building is based on a novel about a white miner who survives a terrible workplace accident and joins the workers\u2019 struggle against the company. White changed the character into a black man with outstretched hands, a hopeful image of the possibility of social change. How can paintings of injustice inspire people to make changes in the world? What would you call attention to, through your art, in order to make a difference?   SustainingTraditions\u2014Digital Teachings (2018) by Kelly Church Gallery 262   Native artists such as Kelly Church, a fifth-generation basket maker, have used black ash trees to make baskets for thousands of years. Across the United States, however, these trees are being destroyed by the emerald ash borer, an invasive insect. Church envisions a future when traditional knowledge keepers like herself may not be able to teach this art to the next generation. Inside this basket, she has placed a flash drive containing files that record this knowledge for her community, entrusting our museum to preserve it. What special skills would you want to pass on to future generations so they aren't lost? Think about the qualities that each person brings to a community and talk with your family about ways we can use our knowledge and skills to help each other.   Jizo Bosatsu (Kamakura period, late 12th\u2013early 13th century), Japan Gallery 104   The figure of Jizo, a gentle, peaceful Buddhist monk, stands on a lotus flower, the subject of Yoko Ono\u2019s Mended Petal . In Buddhist art, the lotus is a symbol of purity and spiritual awakening. In his left hand Jizo holds a jewel called a cintamani , a symbol of his power to help others. In his right hand he holds a staff that jingles as he walks, alerting small creatures in his path to scuttle away so they are not trampled. With this small, kind gesture, Jizo shows compassion for all living beings. What other kinds of quiet and not-so-quiet gestures can be effective as activism?   For more family fun, visit the Ryan Learning Center , a space for art making and engaging activities. Drop by to take part in a studio project, design your own one-of-a-kind tour using JourneyMaker, and more. Open daily, 11:00\u20133:00. Closed on Tuesdays. And remember, museum admission is always free for kids under 14 and Chicago teens under 18. ",
            "source_updated_at": "2026-02-03T11:19:32-06:00",
            ...
        },
        {
            "id": 33,
            "api_model": "highlights",
            "api_link": "https://api.artic.edu/api/v1/highlights/33",
            "title": "black-artists",
            "copy": " Since then, the museum has supported black artists, purchasing many works for the collection including those by graduates of the School of the Art Institute of Chicago (SAIC), one of the few art academies that allowed black students to enroll at the turn of the 20th century, such as Archibald John Motley Jr., Walter Ellison, Eldzier Cortor, and Richard Hunt. Today we continue to expand the collection with the distinct voices and perspectives of black artists across departments and media\u2014architecture, design, installation art, painting, printmaking, photography, painting, sculpture, and textiles. This tour features a rotating selection of these works. Please note that while many of these works are on view, and are noted as such, some may be off view due to the museum's installation schedule. Click through to the artwork pages for more information.   Walter T. Bailey   The first black architect licensed in Illinois, Walter T. Bailey studied at the University of Illinois at Urbana-Champaign and spent his early career as a professor at Tuskegee University\u2014a historically black university in Alabama. In 1922 he was commissioned by the Knights of Pythias, a black fraternal order (there was also a predominantly white Knights of Pythias order at the time), to design their national headquarters in Chicago\u2019s thriving Bronzeville neighborhood. When it was completed in 1928, the building was the largest and most significant in the country to be designed, built, and financed by African Americans. This terracotta fragment was recovered from the temple's Egyptian Revival facade\u2014a style which likely held great significance for the black Knights of Pythias at a moment when many African American intellectuals looked to the history of Egypt as a source of cultural pride. Although the structure was demolished in 1980, the Pythian Temple remains an important part of the rich history of Bronzeville and Chicago\u2019s South Side. This work is on view in Gallery 200.   Richmond Barth\u00e9   After studying painting at the School of the Art Institute of Chicago, Mississippi native Richmond Barth\u00e9 moved to New York where he achieved success as a sculptor. His works were exhibited widely by the Harmon Foundation, an organization that promoted African American artists and writers, and earned the praise of Harlem Renaissance critic Alain Locke. Barth\u00e9, who frequently explored the expressive potential of the body\u2019s form, pose, and movement, modeled Boxer from memory, inspired by the famed Cuban featherweight Eligio Sardi\u00f1as Montalvo, better known as \u201cKid Chocolate\u201d\u2014who, Barth\u00e9 said, \u201cmoved like a ballet dancer.\u201d In this work, Barth\u00e9 conveys the boxer\u2019s immense strength and agility with lyricism and grace. This work is on view in Gallery 161.   Simone Leigh   Over the past 20 years, Simone Leigh has been celebrated for a sculptural practice that draws from a diverse range of African diasporic traditions. Her work encompasses sculptures in materials ranging from ceramic to bronze as well as videos, installations, and community-centered gatherings. Rooted in her exploration of black female subjectivity, Leigh\u2019s sculptures give form to the history, knowledge, and experience that a body can hold. Leigh calls Sharifa \u201cthe first portrait I\u2019ve ever done.\u201d The subject is the writer Sharifa Rhodes-Pitts, author of Harlem Is Nowhere , a 2011 history of the storied neighborhood. Rhodes-Pitts is also one of Leigh\u2019s closest friends and a frequent participant in her projects. As both a historian and a mother, she embodies the labor of black women that Leigh has long centered in her work. This work is on view in the North Garden.   Alma Thomas   After decades as a representational painter, in her 70s, Alma Thomas turned to abstraction, creating shimmering, mosaic-like fields of color with rhythmic dabs of paint that were often inspired by forms from nature. The artist had been fascinated with space exploration since the late 1960s, and her later paintings often referenced America\u2019s manned Apollo missions to the moon. Although she had never flown, Thomas began to paint as if she were in an airplane, capturing what she described as shifting patterns of light and streaks of color. Starry Night and the Astronauts evokes the open expanse and celestial patterns of a night sky, but the work could also be read as an aerial view of a watery surface. This painting was created in 1972, when the artist was 80. In the same year, she became the first African American woman to receive a solo exhibition at a major art museum, the Whitney Museum of American Art in New York City. This work is on view in Gallery 297.   Betye Saar   Betye Saar began her career as a printmaker in Los Angeles in the 1960s, incorporating metaphysical elements from a wide range of sources including phrenology, palm reading, and astrology. Eshu (The Trickster) was inspired by a trip that Saar took in 1970 to Chicago\u2019s Field Museum of Natural History with friend and fellow artist David Hammons. Impressed with the multitude of African objects she encountered, Saar returned home to start a new series of what she referred to as \u201critual pieces.\u201d To create this assemblage, Saar attached fabric to a found leather support. \u201cWhen I saw the main shape,\u201d Saar reflected, \u201cI knew I wanted to create a body.\u201d She traced the contours of her own hands and feet in paint onto the surface to conjure an abstract version of Eshu, the trickster god of the Yoruba people of West Africa. By integrating her own body, Saar claimed her role as \u201ca medium, the connection between the material and the message.\u201d This work is on view in Gallery 297.   Henry Ossawa Tanner   The son of a prominent minister of the African Methodist Episcopal Church, Henry Osssawa Tanner was perhaps the most renowned American painter of religious works at the turn of the 20th century. After studying at the Pennsylvania Academy of the Fine Arts, Tanner moved to France in 1891 in an effort to escape the trenchant racism that limited his career in the United States. The Two Disciples at the Tomb depicts an event from the Gospel of Saint John in which Peter and John arrive at Christ\u2019s empty tomb. Tanner grounds the scene in the figures\u2019 thoughtful expressions\u2014Peter looks downward with a somber gaze, while John appears transfixed, his face bathed in a golden light that signifies the presence of Christ\u2019s spirit. This work is on view in Gallery 273.   David Drake   This boldly inscribed storage jar was made by David Drake, who was born enslaved around 1800and learned the art of hand-coiling, throwing, and glazing pottery in Edgefield, South Carolina. \u201cLM\u201d stands for Lewis Miles, Drake\u2019s enslaver and owner of the Stoney Bluff Manufactory, part of the plantation where the potter labored from around 1849 to the 1860s. Drake was not the only artisan active in Edgefield, and his audacious works represent artistry, skill, and resilience at a time when enslaved people faced criminalization and violence for reading, writing, or even signing one\u2019s name. This work is on view in Gallery 161.   Hughie Lee-Smith   Starting art classes at age ten and graduating from the Cleveland School of Art (now the Cleveland Institute of Art), Hughie Lee-Smith became a painter of uncategorizable images\u2014scenes of lone enigmatic figures in bleak landscapes that are realist yet surreal, romantic and mystical. The artist linked the starkness of his imagery to his experience as an African American man, later recalling, \u201cUnconsciously it has a lot to do with a sense of alienation \u2026 and in all blacks there is an awareness of their isolation from the mainstream of society.\u201d In Desert Forms , as in many of Lee-Smith\u2019s works, the isolation can also be interpreted as a universal statement about the loneliness that can be experienced by all of humanity. This work is on view in Gallery 262.   Norman Lewis   New York painter Norman Lewis began his career working in the social realist style. Around 1946, however, he started exploring a gestural approach to abstraction and became the only African American among the first generation of Abstract Expressionist artists. Although his work avoided overt representation, he still sought to address social concerns. The title of this painting alludes to the United States\u2019 struggles and potential after World War II. With reference to lines from Walt Whitman\u2019s poem \u201cSong of Myself\u201d (first published in 1855), Lewis commented on his own time and the productive complications his socially engaged abstraction brought to American painting at this moment: \u201cDo I contradict myself? / Very well then I contradict myself, / (I am large, I contain multitudes.).\u201d This work is on view in Gallery 262.   Charles White   Born and educated in Chicago, Charles White was one of the preeminent artists to emerge during the city\u2019s Black Renaissance of the 1930s and \u201940s. As a child, White sketched in the galleries of the Art Institute of Chicago and in high school earned a scholarship to the School of the Art Institute of Chicago. White believed that art could be a force in promoting racial equality: \u201cPaint is the only weapon I have with which to fight what I resent.\u201d In This, My Brother , White depicts a man with outstretched hands emerging from a demolished structure. The artwork title comes from a 1936 novel about a rural white miner who, after a political awakening, joins the proletarian struggle against capitalism; in his depiction, White transforms the protagonist into a Black man who breaks free from a mountain of rubble, a hopeful image of the possibility of social change. This work is on view in Gallery 262.   Norman Teague   Norman Teague is a Chicago-based designer and educator whose practice focuses on the complexity of urbanism and uses design as a mechanism to empower black and brown communities. His projects range from a collaboration with Theaster Gates and John Preus for dOCUMENTA (13) in Kassel, Germany, to a 2017 contribution to the Chicago Cultural Center exhibition Wall of Respect: Vestiges, Shards, and Legacy of Black Power exploring the legacy of a seminal 1967 mural developed by black artists in Chicago\u2019s South Side communities. Teague\u2019s Sinmi stool takes its title from the word \u201crelax\u201d in the African language of Yoruba. This sleek seating in plywood and rubber was inspired by the American rocking chair as well as the relaxed positions\u2014straddling, sitting, or perching\u2014commonly assumed when lounging and socializing on city streets. This work is on view in Gallery 285.   Charles Harrison   One of the most prominent African American designers in modern history\u2014and a SAIC graduate\u2014Charles Harrison designed over 750 objects during his 32-year career at the Chicago-based retailer Sears, Roebuck, and Co.\u2014sewing machines, hair dryers, kitchen appliances, lawn mowers, and many other goods. One transformative early project was his acclaimed 1959 redesign for the popular toy View-Master, a stereoscope device originally introduced at the 1939 New York World\u2019s Fair and used by the military in WWII. Harrison\u2019s updated\u2014and now iconic\u2014model replaced the dark brown, blocky unit with lightweight, brightly colored, injection-molded plastic, making the device less costly and easier to use, especially for children. This work is on view in Gallery 285.   Joshua Johnson   The first known African American painter to gain professional recognition in the United States, Joshua Johnson had trained as a blacksmith before being freed by his enslaver (and father) in 1782. Johnson worked throughout the Baltimore area as both a portraitist and limner (someone who decorates manuscripts), advertising himself as \u201cself-taught\u201d in the city\u2019s newspapers. Among the more than 80 paintings attributed to Johnson is this one of Elizabeth Beatty and her daughter, both fashionably dressed. The child holds a brightly colored strawberry, a delicacy often featured in Johnson\u2019s portraits. This work is on view in Gallery 161. ",
            "source_updated_at": "2026-01-23T10:29:30-06:00",
            ...
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
        "total": 8,
        "limit": 10,
        "offset": 0,
        "total_pages": 1,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "id": 27,
            "api_model": "highlights",
            "api_link": "https://api.artic.edu/api/v1/highlights/27",
            "title": "women-made-chicago-art-spaces",
            "timestamp": "2026-02-24T12:22:56-06:00"
        },
        {
            "_score": 1,
            "id": 33,
            "api_model": "highlights",
            "api_link": "https://api.artic.edu/api/v1/highlights/33",
            "title": "black-artists",
            "timestamp": "2026-02-24T12:22:56-06:00"
        },
        {
            "_score": 1,
            "id": 37,
            "api_model": "highlights",
            "api_link": "https://api.artic.edu/api/v1/highlights/37",
            "title": "making-a-difference-a-tour-for-families",
            "timestamp": "2026-02-24T12:22:56-06:00"
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

::: details Example request: https://api.artic.edu/api/v1/highlights/27  
```js
{
    "data": {
        "id": 27,
        "api_model": "highlights",
        "api_link": "https://api.artic.edu/api/v1/highlights/27",
        "title": "women-made-chicago-art-spaces",
        "copy": " Margaret Burroughs and the South Side Community Art Center   In addition to being a writer, visual artist, and educator, Margaret Burroughs (1917\u20132010) was also an institution-builder who believed in the importance of Black-centered spaces. At 23 years old, Burroughs cofounded the South Side Community Art Center (SSCAC) in the South Side Chicago neighborhood of Bronzeville, which continues to thrive today as the oldest Black arts center in the US. In 1961, Burroughs also helped establish the DuSable Museum of African American History, which began in the living room of her Bronzeville home before moving south to its current location in Washington Park.   Since its founding in 1941, the South Side Community Art Center (SSCAC) has fostered an environment in which Black artists can proudly share their work and community members can easily engage with art. This exhibition pamphlet exemplifies the types of educational arts programs that the center has historically offered for adults and children. Black artists from the School of the Art Institute of Chicago often taught classes at SSCAC, sharing their knowledge and resources with South Side residents.   Isobel Neal Gallery   In 1986, former Chicago public school teacher Isobel Neal opened the Isobel Neal Gallery. Neal's prior involvement with the South Side Community Center led her to identify that Black artists in Chicago struggled to find gallery representation, and so she devoted her gallery to the exhibition of work by Black artists. The space became widely known and was especially cherished by Chicago\u2019s Black community. In 1996 Mae Jemison, the first Black woman astronaut to travel to outer space\u2014photographed here with Neal\u2014selected the gallery to host her homecoming reception over other prominent Chicago venues, including Navy Pier.   Located in Chicago\u2019s River North neighborhood, the Isobel Neal Gallery exhibited both established and emerging Black artists, including artists that have since gained a national reputation such as Charles White , Ed Clark , Norman Lewis , Phoebe Beasley, and Elizabeth Catlett \u2014shown here in the exhibition program for \u201cIn the Hemisphere of Love.\u201d Following the gallery\u2019s closure after ten years of operation, many of these artists went on to show their work in other galleries and museums throughout Chicago and the country. Even after closing the gallery, Neal continued to support the arts through independent curating and civic leadership roles at the Art Institute of Chicago.   Artemisia Gallery   Founded and maintained by women graduate students from the School of the Art Institute of Chicago (SAIC), some pictured here, Artemisia Gallery opened in 1973, mere weeks after the women-run ARC gallery opened across the hall in the same building. The SAIC group named their gallery after the 17th-century painter Artemisia Gentileschi, one of the few women artists in Italy during that period; her work often illustrated strong female figures. The gallery functioned as a feminist cooperative\u2014a space run by and for women with the aim of disrupting the patriarchal art world.   At Artemisia Gallery, women artists developed their skills, experimented with processes, and built community. The gallery promoted radical political perspectives through exhibitions that addressed domestic violence, protested US imperialism in Central America and the Carribean, and expanded the visibility of Indigenous American women painters, among other efforts. It also fostered experimentation with artistic and display practices through programming that included the Mixing Women in Sound Art Festival (album and poster art shown here) which brought women sound artists from across the globe to participate in Chicago\u2019s art scene.   ARC Gallery   ARC Gallery\u2014which stands for Artists, Residents, Chicago\u2014opened in 1973 as one of the city\u2019s first art spaces managed completely by women, and it continues to operate as a female artists\u2019 cooperative today. The founding members, pictured above, came from various artistic backgrounds and were frustrated with the structural barriers that prevented women artists from thriving in Chicago. ARC\u2019s mission was to provide women with mentorship and practical resources for artistic success.   Three years after ARC first opened, it relocated, along with Artemisia Gallery, to Hubbard Street, a thriving hub for alternative art galleries during the 1970s. That same year, ARC created an additional venue named RAW Space, which offered a platform for installation artists. Today, RAW Space serves as an incubator where artists can apply to rent the venue for installation and performance projects.   \"Highlights of Women-Made Chicago Art Spaces\" was curated by Kayleigh Doyen and Isabella Ko, 2018\u20132020 Andrew W. Mellon Undergraduate Curatorial Fellows at the Art Institute of Chicago. ",
        "source_updated_at": "2025-11-12T14:41:39-06:00",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.14"
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
        "version": "1.14"
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
            "timestamp": "2026-02-26T15:25:20-06:00"
        },
        {
            "_score": 1,
            "id": 3,
            "api_model": "static-pages",
            "api_link": "https://api.artic.edu/api/v1/static-pages/3",
            "title": "Exhibitions",
            "timestamp": "2026-02-26T15:25:20-06:00"
        },
        {
            "_score": 1,
            "id": 4,
            "api_model": "static-pages",
            "api_link": "https://api.artic.edu/api/v1/static-pages/4",
            "title": "Upcoming Exhibitions",
            "timestamp": "2026-02-26T15:25:20-06:00"
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
        "version": "1.14"
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
        "total": 226,
        "limit": 2,
        "offset": 0,
        "total_pages": 113,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/generic-pages?page=2&limit=2"
    },
    "data": [
        {
            "id": 465,
            "api_model": "generic-pages",
            "api_link": "https://api.artic.edu/api/v1/generic-pages/465",
            "title": "Playing Favorites",
            "web_url": "https://www.artic.edu/visit-us-virtually/watch-and-listen/videos/playing-favorites",
            "copy": " Finding Meaning in a Medieval Reliquary with Cybele Tom Former objects conservator Cybele Tom reflects on the work she would most like to bring home from the museum\u2014a treasured reliquary.   Designing for Pig Parts with Zo\u00eb Ryan Former chair and curator of Architecture and Design Zo\u00eb Ryan shares one of her most beloved objects in the collection\u2014a book by designer Christien Meindertsma that encourages us to think critically about how and why objects come into being.   Manipulating Reality through Victorian Photocollage with Liz Siegel Curator of Photography Liz Siegel dives into an object full of subtle surprises\u2014a photocollage by Lady Filmer that presents both a self-portrait and an imagined reality for the artist.   Art You Can't Hold in Your Hands with Jordan Carter Jordan Carter, associate curator, Modern and Contemporary Art, talks about the first artwork he installed at the museum\u2014a piece of conceptual art by Daniel Buren that exists outside of traditional exhibition spaces.   Rembrandt and the Desire for Human Connection with Sam Ramos Sam Ramos, associate director of innovation and creativity, tells viewers about an artwork he loves\u2014a painting by Rembrandt\u2014and explains why he might be afraid to have the artist create his portrait.   Art That Expresses the Inner World with Costa Petridis Costa Petridis, chair and curator of Arts of Africa, reflects on an artwork that makes the invisible visible\u2014a drawing by Belgian artist Fernand Khnopff. ",
            ...
        },
        {
            "id": 459,
            "api_model": "generic-pages",
            "api_link": "https://api.artic.edu/api/v1/generic-pages/459",
            "title": "Project Windows 2020",
            "web_url": "https://www.artic.edu/visit/special-offers/project-windows-2020",
            "copy": " Voting for Project Windows 2020 is now closed. Check out the winners below!   Project Windows 2020 Winners   Art Institute Award Robert Guild Jewelry Best Use of Color Strides by Miyanna Best Use of Light/Technology Bloomingdale's Best Use of Materials Offshore Rooftop & Bar at Navy Pier Chicago Charm Teuscher Chocolates of Switzerland Chicago Style Blick Art Supply Most Amusing Ghirardelli Most Artistic Marshall Pierce & Co. Most Inspiring Macy\u2019s People's Choice Tea Gschwendner   Project Windows 2020 Participants ",
            ...
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
        "total": 226,
        "limit": 10,
        "offset": 0,
        "total_pages": 23,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "id": 577,
            "api_model": "generic-pages",
            "api_link": "https://api.artic.edu/api/v1/generic-pages/577",
            "title": "Impact",
            "timestamp": "2026-02-25T23:39:07-06:00"
        },
        {
            "_score": 1,
            "id": 417,
            "api_model": "generic-pages",
            "api_link": "https://api.artic.edu/api/v1/generic-pages/417",
            "title": "Instagram",
            "timestamp": "2026-02-25T23:39:07-06:00"
        },
        {
            "_score": 1,
            "id": 576,
            "api_model": "generic-pages",
            "api_link": "https://api.artic.edu/api/v1/generic-pages/576",
            "title": "Activity",
            "timestamp": "2026-02-25T23:39:07-06:00"
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
        "web_url": "https://www.artic.edu/visit/free-admission-opportunities",
        "copy": " RESERVE ONLINE IN ADVANCE   You can reserve your free tickets online in advance ; your resident status will be verified using the zip code associated with the billing address provided. If you're unable to reserve tickets in advance, please stop by the admissions desks on the day of your visit for assistance. Free admission for Illinois residents is supported by   Illinois Educators Free admission is available to current Illinois educators, including pre-K\u201312 teachers, teaching artists working in schools, and homeschool parents. Educators can register online to receive a voucher for a complimentary ticket to the museum. This voucher must be presented\u2014as a printed document or on a smartphone\u2014with a valid educator ID at one of the museum\u2019s admission counters. Chicago Public Library\u2014Explore More Illinois Digital Pass Chicago Public Library cardholders 18 and older can log in at chipublib.org/digitalpasses to reserve free general admission passes to the museum through Explore More Illinois. Please note that this offer is valid only for Chicago Public Library cardholders.   NO ADVANCE TICKET REQUIRED The following groups are invited to visit our galleries at no cost every day. In order to receive your free admission benefits, simply show the corresponding identification at the admissions desk in either museum lobby. Free admission benefits are not single use\u2014you are welcome to use them any time you would like to visit. Be sure to inquire about the availability of special exhibition tickets when you check in at the admissions counter. Kids under 14 Admission is always free for children under 14. These free tickets are available online as well as on-site at the admissions counters. Chicago Teens Museum admission is free for Chicago teens under the age of 18, thanks to the extraordinary generosity of Glenn and Claire Swogger and the Redbud Foundation. See more opportunities and resources for teens . Active-Duty Military As part of the Blue Star Museums program, active-duty service members receive free admission all year long. Plus, from Armed Forces Day through Labor Day, we also welcome service members and their households. Please bring your active-duty military ID to the admissions counter to receive this benefit. LINK and WIC Cardholders As part of Museums for All, LINK and WIC cardholders and anyone in their households receive free general admission to the museum and all ticketed special exhibitions. Simply present your card along with a valid photo ID. University Partners Students of colleges and universities in the University Partner Program are entitled to free general and special exhibition admission by showing a valid student ID at the ticket counter. Check the full list of partnering colleges and universities . Corporate Partners Employees of certain companies in the Corporate Partner Program are entitled to free general and special exhibition admission by showing proof of employment at the ticket counter. Learn more about the Corporate Partner Program . Check the full list of Corporate Partner companies whose employees are entitled to free admission.   More Corporate Partner Opportunities ",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.14"
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
        "total": 8,
        "limit": 2,
        "offset": 0,
        "total_pages": 4,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/landing-pages?page=2&limit=2"
    },
    "data": [
        {
            "id": 13,
            "api_model": "landing-pages",
            "api_link": "https://api.artic.edu/api/v1/landing-pages/13",
            "title": "Research Center",
            "web_url": null,
            "copy": "Get Started. Learn how to engage with our online resources and expert staff. Discover how to make an appointment, find our reading room, and what to expect during your visit. Discover Our Collections. Both online and in person, you can explore books about art history, as well as original documents, auction catalogs, art periodicals, books made by artists, historical photographs, artworld ephemera, and many digital resources. Resources at your fingertips. Home to the Art Institute's archival collections, research library, and academic engagement programs, the Research Center is an incubator for new art historical ideas and student training. The Research Center holds millions of resources on the global history of art, architecture, and design. Our collections have sparked new discoveries for faculty and students, industry professionals, writers, filmmakers, curators, and art researchers at all levels. We welcome college-level class visits, individual appointments, and students who are curious about art museum careers. Search the Catalog. Search for physical and digital materials in the Library and Archives collections, browse categories and concepts, and request items for your appointment. Internship and Research Opportunities. Learn first hand how the museum works. We support the next generation of museum professionals with internships, fellowships, events, and training programs for college and university students. Find a Guide. Explore our research guides for assistance with common research topics, such as artworks in the museum's collection or Chicago buildings.",
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
        "version": "1.14"
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
        "total": 8,
        "limit": 10,
        "offset": 0,
        "total_pages": 1,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "id": 1,
            "api_model": "landing-pages",
            "api_link": "https://api.artic.edu/api/v1/landing-pages/1",
            "title": "Visit",
            "timestamp": "2026-02-24T12:22:57-06:00"
        },
        {
            "_score": 1,
            "id": 3,
            "api_model": "landing-pages",
            "api_link": "https://api.artic.edu/api/v1/landing-pages/3",
            "title": "Home",
            "timestamp": "2026-02-24T12:22:57-06:00"
        },
        {
            "_score": 1,
            "id": 4,
            "api_model": "landing-pages",
            "api_link": "https://api.artic.edu/api/v1/landing-pages/4",
            "title": "Ryan Learning Center",
            "timestamp": "2026-02-24T12:22:57-06:00"
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
        "copy": "Museum Map. Take a look at our museum floor plan to get a sense of the museum's layout and mark any must-see spaces. Free Winter Weekdays 2026. January 5\u2013February 27 All Illinois residents are invited to visit the museum free of charge every weekday we're open from 11 a.m. through closing (5 p.m. on Mondays, Wednesdays, and Fridays and 8 p.m. on Thursdays). Free admission for Illinois residents is supported by Health Care Service Corporation Free Daily Tours. Follow a knowledgeable guide through the galleries on a free tour, offered in English every day at 1:00 and 3:00 and in Spanish on Fridays and Saturdays at 2:00. Your Personal Must-See Tour. Build your very own self-guided museum tour with the works you love. What to See in an Hour. Experience some of the museum\u2019s most iconic works by accessing self-guided tours, like What to See in an Hour, on your phone. Ryan Learning Center. Enjoy creative activities in this space, Wednesdays\u2013Mondays, 11:00\u20133:00, including making a custom museum tour with JourneyMaker. Exhibitions. Be sure to catch the many special exhibitions on view during your visit. Visitor Policies. These guidelines support a welcoming environment for all our visitors to experience the art in our galleries. Dining and Shopping. Grab a bite at one of our caf\u00e9s and be sure to pick up a souvenir of your visit at one of two store locations. Accessibility. The Art Institute offers a range of resources and programs designed for adults and children with disabilities.",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.14"
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
        "total": 383,
        "limit": 2,
        "offset": 0,
        "total_pages": 192,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/press-releases?page=2&limit=2"
    },
    "data": [
        {
            "id": 45,
            "api_model": "press-releases",
            "api_link": "https://api.artic.edu/api/v1/press-releases/45",
            "title": "Press Releases from 1983",
            "web_url": "https://www.artic.edu/press/press-releases/45/press-releases-from-1983",
            "copy": " To obtain the full text of any news releases in this index, please contact the Institutional Archives at reference@artic.edu or (312) 443-4777.   January 3, 1983 Mauritshuis: 17th Century Dutch Painting from the Royal Picture Gallery, organized by The National Gallery of Art, Washington, D.C.; bicentennial of Dutch-American diplomatic relations; exhibition venues, catalogue by director of The Mauritshuis Dr. Hans Hoetink; complementary exhibitions of works by Dutch Masters from AIC Permanent collection in the galleries of Prints and Drawings, European Paintings, and Textiles 88-90, 94, 115 January 21, 1983 \"Living National Treasures\" of Japan, exhibition and craft making demonstrations, Children's festival of Japanese Arts, programs and schedule 91-93 February 3, 1983 Mauritshuis: 17th Century Dutch Painting, related events, films and lectures; curator of European Painting Department Richard Brettell 88-90, 94-95, 115 February 10, 1983 Betty and Edwin Bergman Collection, gift of Joseph Cornell objects; comments by AIC Director James N. Wood, and Curator of 20th Century Art Department A. James Speyer 96-98, 149 February 22, 1983 Highlights of Arms and Armor from the George F. Harding Collection, exhibition, consulting curator Leonid Tarassuk; the Collection history and acquisition; remarks by AIC Chairman Arthur W. Schultz 99-101, 149 March 3, 1983 Photographs and Portfolios by Paul Strand, exhibition of works loaned from private and public collections; curator of Photography Department David Travis; exhibition venues 102-103 Photographs by Jerry Gordon, exhibition of works loaned by the artist; curator of Photography Department David Travis 104 March 17, 1983 Six Centuries of European Decorative Arts from the Permanent Collection, exhibition, reinstallation in Gunsaulis Hall, curator of European Decorative Arts Lynn Springer Roberts 105-106 ; symposium 111-112 March 21, 1983 Perspectives on Contemporary Realism: The Jalane and Richard Davidson Collection, traveling exhibition, AIC showing coordinated by curator of Prints and Drawings Department Harold Joachim; Collection history; catalogue by Frank H. Goodyear, Jr., of Pennsylvania Academy of Fine Arts 107-108 March 24, 1983 The Vatican Collection: The Papacy and Art, announcement 150 , attendance and ticket information 109-110, 129-130, 148, 175-176 ; lectures 153-154 ; complementary exhibitions from Permanent Collection: A Legacy of Rome: Church Architecture in Chicago 133 Junior Museum: Vatican Discovered 133 The Lure of Rome: Five Centuries in the Eternal City, organized by the Department of Prints and Drawings and the Ryerson and Burnham Libraries 140-141 Vestments and Liturgical Textiles 144-145 April 7, 1983 The Age of Grandeur: European Decorative Arts in the 17th Century , symposium in conjunction with renovation and reinstallation of Gunsaulis Hall; The Antiquarian Society of AIC, Samuel A. Marx Fund, Mrs. James Ward Thorne Fund; related events 105-106, 111-112 April 14, 1983 Ansel Adams: An American Place, 1936, photography exhibition re-creating the 1936 show held in Alfred Stieglitz Gallery in New York, catalogue by guest curator Andrea Gray; AIC showing coordinated by curator of Photography Department David Travis; exhibition venues 113-114 April 18, 1983 17th Century Textile Treasures from the Permanent Collection, show complementing The Mauritshuis Museum exhibition, curator of Textiles Department Christa Thurman 115 Campaign for Chicago's Masterpiece, fund-raising drive for Museum building restoration and construction of the South Wing; announcement by Chairman of AIC Board of Trustees Arthur W. Schultz; comments by Chairman of the Campaign Marshall Field 116-118, 191 April 26, 1983 Acquisition of two works from Claude Monet's Haystack series, partial gift of Mr. and Mrs. Daniel Searle; Museum Major Acquisition Fund, de-accessioning of several Impressionist paintings through Christies's sales 119-120 April 28, 1983 Henry Moore's Large Interior Form (1982), gift from Henry Moore Foundation of Hertfordshire, U. K.; installation of the sculpture in Museum's Northwest Garden, project by Bruce Graham of Skidmore, Owings & Merril; remarks by AIC Director James N. Wood; related exhibition and events 121-122 May 2, 1983 New Chicago Architecture: Beyond the International Style, recent work by Chicago architectural firms, exhibition curated by John Zukowsky and Robert Bruegman; catalogue included in Inland Architect magazine (May/June 1983) 123-124, 149 May 3, 1983 Ivan Mestrovich's Two American Indians , restoration of sculptures (downtown Chicago) made possible by The Benjamin F. Ferguson Fund under direction of AIC Board of Trustees; examination and restoration by Washington University Technical Associates (WUTA) of St. Louis; comments by conservator Timothy Lennon, Department of Conservation at AIC 125-126 May 5, 1983 Photography and Architecture: 1839-1939, exhibition from The Canadian Center for Architecture, Montreal; US and European venues, catalogue 127-128 May 9, 1983 The Vatican Collections: The Papacy and Art, exhibition, Ticketron and Tele-tron services; Membership Department 129-130 Neil J. Hoffman, appointed President of SAIC; announcement by AIC Chairman Arthur W. Schultz 131-132 May 20, 1983 The Vatican Collections: The Papacy and Art, related events and complementary exhibitions 133 Puppet Week programs for preschoolers featuring noted puppeteer companies, schedule 134-135 May 23, 1983 An Open Land: Photographs of the Midwest 1852-1982, traveling exhibition sponsored by Open Land Project and organized by photographer Rhondal McKinney and curator of Photography Department David Travis, catalogue 136-137 June 6, 1983 The Betty and Edwin Bergman Joseph Cornell Collection, gift, gallery installation designed by architectural firm Krueck & Olsen of Chicago 138-139, 149, 168 June 9, 1983 The Lure of Rome: Five Centuries in the Eternal City, exhibition organized by AIC Prints and Drawings Department, AIC Ryerson and Burnham Libraries, and The Newberry Library (Chicago), complementing The Vatican exhibition 140-141 June 23, 1983 Chicago: The Architectural City, photography exhibition in celebration of 150th anniversary of the city of Chicago, guest curator Kathleen Lamb; The Prince Charitable Trusts of Chicago, grant 142-143, 149 August 5, 1983 The Sustaining Fellows $2.1 million contribution, chairman David C. Hilliard and president Norman Ross; remarks by Chairman of The Board of Trustees Arthur W. Schultz; reception in McKinlock Court 146-147 August 19, 1983 The Vatican Collection: The Papacy and Art, attendance record 148 Exhibition Schedule for August 1983 - June 1984, 149-152 August 25, 1983 Lecture series featuring The Vatican Collection: The Papacy and Art exhibition 153-154 August 29, 1983 Art Today series, Hayden Herrera, Dore Ashton 155 September 7, 1983 Recent Acquisitions, 1982-83, exhibition curator Deborah Frumkin of Photography Department; The Photographic Society purchases 156 Lars Sonck, 1870-1956, Finnish architecture exhibition as a part of Scandinavia Today Program of The American Scandinavian Foundation, catalogue 158-159 September 12, 1983 The 1983 Chicago Chapter, American Institute of Architects (AIA) Award, AIA architectural competitions in the USA, exhibition of prize-winning Chicago-area firms 157-158 September 16, 1983 The National Endowment for the Arts (NEA) $1 million challenge grant to AIC; announcement by Chairman of The Board of Trustees Arthur W. Schultz 160-161 September 26, 1983 Alfred Stieglitz, retrospective; Georgia O'Keeffe, donation of Stieglitz Photography collection; exhibition catalogue 150, 162-164, 167 September 29, 1983 Nancy Outside in July: Etchings by Jim Dine, exhibition, curator of Prints and Drawings Ester Sparks; Aldo Crommelynck and Jim Dine, gift of prints to Museum; exhibition venues and catalogue published by the Universal Limited Art Editions (ULAE) 150, 165-167 October 1983 Monthly Calendar Exhibition schedule and public programs, including The Junior Museum, The Film Center, The Art Rental and Sales Gallery, and SAIC 167-171 October 6, 1983 The Campaign for Chicago's Masterpiece, $49.25 million five-year fund-raising drive, Museum expansion and renovation 116-118 ; comments by AIC Chairman Arthur W. Schultz and AIC Director James N. Wood; joint gift from Marshall Field and the McCormick Family for Field/McCormick American Wing; various contributions; press conference and dinner for art patrons of Midwest 172-174 October 26, 1983 The Vatican Collection: The Papacy and Art, attendance and budget record; comments by AIC president E. Laurence Chalmers, Jr., 175-176 October 31, 1983 Faberge: Selections from the FORBES Magazine Collection, exhibition from Malcolm S. Forbes Collection (New York) 177-178 November 3, 1983 TOPS: The Chicago Architectural Club 1983 Juried Exhibition, Chicago's skyline concept drawings, curator of Architecture Pauline Saliga; The Chicago Architectural Journal documenting exhibition 179-180 November 7, 198 Aqua Lapis: Embroidered Wall Sculpture by Nancy Hemenway, 1975-1983; curator of Textile Department Christa Thurman; exhibition venues and catalogue 151, 181-182 November 14, 1983 The Pennsylvania Germans: A Celebration of Their Arts, 1683-1850, exhibition organized by Philadelphia Museum of Art, catalogue 151, 183-184 November 21, 1983 Junior Museum, Painting: From the Ground Up, exhibition curated by director of AIC Junior Museum Lois Raasch 185 November 28, 1983 Mrs. James W. Alsdorf, Warren L. Batts, John H. Bryan, and Daniel C. Searle elected AIC Trustees; Arthur M. Wood, James W. Alsdorf, Mrs. Frederic Clay Bartlett (born Evelyn Fortune), and Ivan Albright named Life Trustees of AIC; other officers elected at the Annual Meeting of The Board of Trustees 186-187 November 29, 1983 Dr. Harold Joachim (1909-1983), Curator of the Department of Prints and Drawings, obituary 188-189 December 15, 1983 Computerized display system installed in accordance with The Campaign for Chicago's Masterpiece, donations from Museum visitors for restoration of Allerton building glass roof 190 (116-118) December 22, 1983 Grant Wood: The Regionalist Vision, exhibition organized by The Minneapolis Museum of Art; the Chicago Tribune grant; exhibition history of Grant Wood's American Gothic and selection of cartoons and parodies based on the painting; exhibition venues and catalogue; related events and lectures 151, 191-196 ",
            ...
        },
        {
            "id": 242,
            "api_model": "press-releases",
            "api_link": "https://api.artic.edu/api/v1/press-releases/242",
            "title": "Charles White: A Retrospective",
            "web_url": "https://www.artic.edu/press/press-releases/242/charles-white-a-retrospective",
            "copy": " Tuesday, January 23, 2018   CHICAGO \u2014Charles White, born and educated in Chicago, was one of the preeminent artists to emerge during the city\u2019s Black Renaissance of the 1930s and 1940s. A passionate mural and easel painter and superbly gifted draftsman, White powerfully interpreted African American history, culture, and lives in striking works that nevertheless have a more universal resonance. Presented by the Art Institute of Chicago and The Museum of Modern Art (MoMA) in New York, Charles White: A Retrospective runs June 8-September 3 at the Art Institute before traveling to MoMA, where it will be on view from October 7, 2018 through January 13, 2019, followed by Los Angeles Museum of Contemporary Art in Spring 2019. Co-curated by Sarah Kelly Oehler, Field McCormick Chair and Curator of American Art, and Esther Adler, Associate Curator, Department of Drawings and Prints, MoMA, the exhibition examines how White explored social and political themes ranging from the ongoing fight for freedom and equality to the dignity and struggles of labor. Throughout his career, he pushed against the boundaries of his media and the figurative tradition in American art.   As an artist, White\u2019s mastery of mediums intersected with social activism, engaging the past and present with an eye toward the future. He defined his essential quest as the discovery of truth, beauty, and dignity of life and people while using an expressive and highly accessible realism. He often drew from history to illuminate inequities contemporary to his time, as Oehler describes in the forthcoming catalogue for the exhibition, \u201cNot content merely to be mindful of the past, White made it his most important artistic theme\u2026 He returned to the past again and again for aesthetic inspiration, explicitly harnessing his creative energies to educate his fellow citizens and promote social equality by producing and displaying inspiring images of historical figures.\u201d   Presented in the 100th anniversary year of the artist\u2019s birth, this exhibition marks the most comprehensive presentation of White\u2019s work since 1982 and unites a selection of his finest paintings, drawings, and prints. This includes fourteen works owned by the Art Institute, drawn in part from the group of forty-three prints by White recently acquired by the Art Institute, of which five were offered as gifts by the artist\u2019s son. This breathtaking collection of White\u2019s prints begins with his work in Mexico during the late\u20131940s, up through his last published lithograph and his most powerful etchings. Organized chronologically, the exhibition examines the development of White\u2019s practice, from his emergence as a force in the Chicago art world through his mature career as an artist, activist, and educator in New York and Los Angeles. The exhibition deepens understanding of White\u2019s artistic oeuvre, looking in particular at his output through the lens of Chicago\u2019s unique cultural and artistic communities and the city\u2019s broader contributions to American art history. Together, the featured works speak to White\u2019s universal appeal and continued relevance to audiences today.   A full catalogue featuring essays by organizing curators Sarah Kelly Oehler and Esther Adler accompanies the exhibition. Additional essayists include Ilene Susan Fort, Curator Emerita of American Art at Los Angeles County Museum of Art; Kellie Jones, Associate Professor in Art History and Archaeology and the Institute for Research in African American Studies (IRAAS) at Columbia University; Mark Pascale, Janet and Craig Duchossois Curator of Prints and Drawings, the Art Institute of Chicago; and Deborah Willis, University Professor and Chair of the Department of Photography and Imaging at the Tisch School of the Arts at New York University.Sponsors   Image: Charles White. Harvest Talk , 1953. \u00a9 The Charles White Archives Inc. ",
            ...
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
        "total": 383,
        "limit": 10,
        "offset": 0,
        "total_pages": 39,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "id": 3,
            "api_model": "press-releases",
            "api_link": "https://api.artic.edu/api/v1/press-releases/3",
            "title": "Press Releases from 1941",
            "timestamp": "2026-02-25T23:42:16-06:00"
        },
        {
            "_score": 1,
            "id": 2,
            "api_model": "press-releases",
            "api_link": "https://api.artic.edu/api/v1/press-releases/2",
            "title": "Press Releases from 1940",
            "timestamp": "2026-02-25T23:42:16-06:00"
        },
        {
            "_score": 1,
            "id": 60,
            "api_model": "press-releases",
            "api_link": "https://api.artic.edu/api/v1/press-releases/60",
            "title": "Press Releases from 1998",
            "timestamp": "2026-02-25T23:42:16-06:00"
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
        "web_url": "https://www.artic.edu/press/press-releases/1/press-releases-from-1939",
        "copy": " To obtain the full text of any news releases in this index, please contact the AIC Archives at archives@artic.edu .   January 6, 1939 Scammon Lecture, The Spirit of Modern Building , given by Dr. Walter Curt Behrendt, Technical Director of Buffalo City Planing Association, N.Y., 1 January 7, 1939 Turkish and Italian Textiles in Paintings , lecture, given by Alan J. B. Wace, Keeper of Textiles in the Victoria and Albert Museum and professor of Classical Archaeology, Cambridge, England; members of Chicago Needlework and Textile Guild, listed 2 January 20, 1939 Lecture series, given by Dr. Maurice Gnesin, Director of Goodman Theatre and Head of AIC Goodman School of Drama 3 January 11, 1939 Comments on exhibitions: The French Romanticists Gros, Gericault, and Delacroix; Exhibition of Bonnard and Villard, Contemporary French Artists; Christmas Story in Art; George Grosz, His Art from 1918 to 1938; Architecture by Ludwig Mies Van Der Rohe; 34 Old Master Drawings, Lent by Sir Robert Witt of London; gallery tour for the Second Conference of Chicago Art Clubs 4-5 January 13, 1939 AIC major exhibitions of 1938, attendance record from Museum Registrar's Department 6 January 14, 1939 Scammon Lecture, Turner's Romantic Vision of Switzerland , given by Dr. Paul Ganz, Professor at University of Basle, Switzerland, biography note and publications 8 January 18, 1939 28th Annual Governing Members' Meeting, hosted by AIC President Mr. Potter Palmer; luncheon, list of participants 7 January 19, 1939 Kate S. Buckingham Memorial Lecture, Chinese Bronzes , given by AIC Assistant Director and Curator of Oriental Art Department Charles Fabens Kelley 9 January 21, 1939 The National Exhibition of Representative Buildings of the Post War Period, exhibition, organized and curated by American Institute of Architecture (AIA) 12 January 23, 1939 Annual Report for 1938, issued by Director of Fine Arts Daniel C. Rich and Director of Finance and Operation Charles H. Burkholder; major gifts and donations; Robert Allerton, gift for construction of the Decorative Arts Galleries; Mrs. Erna Sawyer Goodman, money gift, establishing William Owen Goodman Fund; attendance, membership, SAIC enrollment; major bequest of Ms. Kate Buckingham; Mrs. William O. Goodman Collection of pewter, gift to AIC; Superintendent's report on condition of skylight roof; Bartlett Lecture Series; funding for lectures and publications 10-11 Pablo Picasso: Forty Years of His Art, exhibition announcement, first collaborative project of AIC and The Museum of Modern Art, N.Y., 13, 102 January 25, 1939 43rd Annual Exhibition by Artists of Chicago and Vicinity, jury comprised of Donald Bear of Denver Art Museum, Clarence Carter of Carnegie Institute, Pittsburgh, and artists Mahonri H. Young of New York and Albin Polasek of Chicago; list of prizes 14, 19-20, 23, 25 January 26, 1939 Kate S. Buckingham Memorial Lecture, Chinese Terra Cotta Tiles , given by AIC Assistant Director and Curator of Oriental Art Department Charles Fabens Kelley 15 January 30, 1939 A Leading School of Buddhist Sculpture , lecture given by Dr. Osvald Siren of National Museum in Stockholm; biography note and comments on his collection and publications 16 SAIC 6th Annual Open House for alumni, governing members, trustees, friends of the School and officials; Glee Club concert under direction of AIC Assistant Director and Curator of Oriental Art Charles Kelley 17 January 31, 1939 Chicago High School Scholarship contest at SAIC; list of winners, Judith Pesman, Suzanne Siporin, Emil Grego, Joanne Kuper, and Joseph Strickland 18 Exhibition of Contemporary American Art at New York World's Fair 1939; proceedings and requirements; Chicago juries of New York World's Fair, represented by Aaron Bohrod, Ralph Clarkson, Mitchell Siporin, Daniel C. Rich (chairman of the Painting Jury), Sidney Loeb, Peterpaul Ott, Albin Polasek, George Thorp, Todros Geller, James Swann, Morris Topchevsky, Beatrice Levy, Charles Wilimovsky, and Lillian Combs 19-20 February 2, 1939 Kate S. Buckingham Memorial Lecture, Chinese Sculpture and Painting , given by AIC Assistant Director and Curator of Oriental Art Department Charles Fabens Kelley 21 February 4, 1939 Scammon Lecture, Six Dynasties and Early T'ang Painting , given by Laurence Sickman, curator of Oriental Art at William Rockhill Nelson Gallery of Art, Kansas City, MO; biography note 22 February 6, 1939 43rd Annual Exhibition by Artists of Chicago and Vicinity, opening, Artists' Dinner, hosted by AIC Director of Finance and Operation Charles H. Burkholder; guest speaker George Buehr, other guests included Mr. and Mrs. Potter Palmer, Mr. Paul Schulze, Mr. and Mrs. Charles Fabens Kelley, Mrs. Albion Headburg, and Ms. Eleanor Jewett 14, 19-20, 23, 25 February 13, 1939 The Making of a Cartoon , lecture and film demonstration, conducted by cartoonist of the Chicago Daily News Vaughn R. Shoemaker, complementing exhibition titled Original American Cartoons from Charles L. Howard Collection 24 February 14, 1939 AIC Exhibition Calendar for 1939 In the Department of Painting and Sculpture, curator Daniel Catton Rich, AIC Director: Chicago and Vicinity 43rd Annual Exhibition; Masterpiece of the Month: Portrait of Mrs. Wolff by Sir Thomas Lawrence; 18th International Exhibition of Watercolors; Annual Exhibition by Students of SAIC; 50th Annual Exhibition of American Painting and Sculpture: Half a Century of American Art 25 In the Children's Museum, curator Helen Mackenzie: The Making of a Masterpiece, exhibition, featuring altarpiece by Giovanni di Paolo of Sienna; Means and Methods of Water Color Painting 25 In the Blackstone Hall: Original American Cartoons from the Collection of Charles L. Howard of Chicago 26 In the Oriental Art Department, Curator Charles Fabens Kelley: two exhibitions from AIC Clarence Buckingham Collection of Japanese Prints, titled In Wind and Rain, and Blossom Viewing; Masterpiece of the Month: Imperial Jade Cup on Stand, 18th C., gift of Russell Tyson 26 In Prints Department, Acting Curator Lillian Combs: Selections from Lenora Hall Gurley Memorial Collection of Drawings; Recent Accessions in Prints, 1937-1939; Woodcuts from Books of the 15th Century; Masterpiece of the Month: The Lamentation from the Great Passion by Albrecht Durer; Prints by Old Masters from Clarence Buckingham Collection; The Bulls of Bordeaux by Francesco Goya; Sports in Prints 26 In the Decorative Arts Department, Curator Bessie Bennett: French Furniture and Sculpture, 18th C. from Henry Dangler Collection; Florence Dibell Bartlett Collection of Bonader from Sweden, 18th and 19th C.; English Architecture of 18th C.; Embroideries from The Greek Islands Lent by Elizabeth Day McCormick; Ecclesiastical Embroideries; English Embroideries; Exhibition of Embroideries by the Needlework and Textile Guild 27 General Information about Permanent collection and admission 27 February 15, 1939 Florence Dibell Bartlett Lecture, Adventures in the Arts , given by Helen Parker, Head of AIC Education Department 28 February 20, 1939 Antiquarian Society, Tea Party, honoring Elizabeth Day McCormick and exhibition of Embroideries from the Greek Islands; party specialties and participants 29, 59, 61 February 21, 1939 George Washington's Birthday, free Museum admission; Washington's portraits in AIC Permanent collection 30 February 25, 1939 Scammon Lecture, The Fountains of Florence , given by Bertha Wiles, Curator of Mark Epstein Library at University of Chicago 31 February 28, 1939 Scammon Lecture, The Artistic Relations of England and Italy , given by William George Constable of Boston Museum of Fine Arts; biography note, Mr. Constable, founder of the Courtauld Institute in London 33 March 2, 1939 New Light on Prehistoric Man , lecture and film demonstration, presented by Dr. Henry Field, and sponsored by Chicago Chapter of Archaeological Institute of America 32 Kate S. Buckingham Lecture, The Gothic Room , given by Bessie Bennett, AIC Curator of Decorative Arts 34 March 8, 1939 Goodman Theatre, performance of Alice in Wonderland for children from settlement houses and orphanages; list of participating institutions 36 March 9, 1939 Kate S. Buckingham Lecture, Prints by Old Masters, Including Rembrandt , given by Edith R. Abbot, artist and educator of The Metropolitan Museum, N.Y., biography note about Ms. Abbot 37 March 15, 1939 Frederick Arnold Sweet, appointed Assistant Curator of AIC Painting and Sculpture Department; Mr. Sweet's resume 38 March 17, 1939 Kate S. Buckingham Lectures, Master Etchers of the 19th Century , given by Head of Education Department Helen Parker; The English Lustre Ware Collection, given by AIC Director Daniel C. Rich 39 March 20, 1939 Opening reception for 18th International Water Color Show, works on view, including loans from Edward Hopper, John Whorf, and Henri Matisse 35 March 23, 1939 18th Annual International Water Color Exhibition; prizes and works on view; jury comprised of Grant Wood, Joseph W. Jicha of Cleveland, and Hubert Ropp of Chicago; concurrent exhibition in the AIC Children's Museum, explaining water color technique; biography notes about prize-winners, Everett Shinn and Dale Nichols 35, 40-42, 5I-52, 64 March 24, 1939 Kate S. Buckingham Lecture, The English Lustre Ware Collection , given by AIC Director Daniel C. Rich 43 March 28, 1939 AIC Curator of Decorative Arts Department Bessie Bennett (1870-1939), obituary; Ms. Bennet's AIC tenure, biography note, remarks by AIC President Mr. Potter Palmer 44-45 April 3, 1939 Easter Festivities at AIC, Monsalvat , performance by Dudley Crafts Watson; SAIC Glee Club concert under direction of Charles Fabens Kelley, sponsored in part by Mrs. James Ward Thorne 46 April 6, 1939 Albin Polasek, Head of Sculpture Department at SAIC, honored with award of merit by the National Institute of Immigrant Welfare, N.Y.; biography note and chronology 47-48 April 11, 1939 Glee Club, Eastern concert program 46, 49 50th Annual Exhibition of American Painting and Sculpture: Half a Century of American Art, retrospective, showing works from American Annual exhibitions held at AIC from 1888 to 1938; comments on the exhibition selection by AIC Director Daniel C. Rich 25, 50 3rd Conference of Art Chairmen; AIC Assistant Curator of Painting and Sculpture Frederick A. Sweet, speaking on 18th International Water Color Exhibition, comments and criticism 40-42, 51-52, 64 April 13, 1939 Kate S. Buckingham Lecture, The Early Development of Chinese Pottery , given by AIC Assistant Director and Curator of Oriental Art Department Charles Fabens Kelley 53 April 17, 1939 SAIC group exhibition at Paul Theobald's Gallery in Chicago, showing abstractionist paintings done in the class of Willard G. Smythe 54 April 20, 1939 Kate S. Buckingham Lecture, The Great Period of Pottery and the Beginnings of Porcelain , given by AIC Assistant Director and Curator of Oriental Art Department Charles Fabens Kelley; attendance record of the Lecture Series 55 April 25, 1939 Europe, Asia, Africa: A Common Civilization , lecture, given by Melville J. Herskovits of Northwestern University, Evanston, IL, 56 Art Quiz, booklet by Head of Education Department Helen Parker, published in support for AIC Museum programs 57 April 27, 1939 Kate S. Buckingham Lecture, The Great Porcelains of the Ming and Ch'ing Dynasties, given by AIC Assistant Director and Curator of Oriental Art Department Charles Fabens Kelley 58 May 2, 1939 Antiquarian Society, Tea Party, featuring speech by AIC Director Daniel C. Rich, titled Decorative Arts in the Museum of Tomorrow ; members of the Society, listed 59 May 5, 1939 Goodman Theatre dance series, featuring Spanish dancer Clarita Martin, Ms. Martin's remarks 60 May 6, 1939 Antiquarian Society, Spring Meeting; Tea Party marking the Exhibition of Embroideries from Greek Islands in Elizabeth Day McCormick Collection; special gallery arrangements provided by Mrs. Walter S. Brewster, Mrs. Charles S. Dewey, Mrs. James Ward Thorne, Mrs. C. Morse Ely, and Mrs. Chauncey McCormick 29, 59, 61-62 May 9, 1939 Antiquarian Society Tea Party, decorative floral display available for public viewing 62 May 12, 1939 5th Annual Exhibition by Student Janitors of SAIC, participants and Fellowship awards 63 May 12, 1939 18th International Water Color Exhibition, attendance record; list of works sold from the show 35, 40-42, 51-52, 64 May 13, 1939 Annual Exhibition of the Needlework and Textile Guild of AIC, opening; works on view and participants 65-66 May 22, 1939 Foreign Travelling Fellowships, awarded to SAIC Student Janitors by AIC Officials and members of SAIC Faculty; award recipients Murray Jones, Edward Voska, biography notes 67 May 23, 1939 SAIC Glee Club concert, program and performers 68 May 26, 1939 Free Museum admission on Memorial Day; special exhibitions: Glass Paperweights from Mrs. John H. Bergstrom Collection; Japanese Surimono Prints, lent by Ms. Helen C. Gunsaulus; Chinese Jades from Mrs. Edward Sonnenschein Collection; Ms. Elizabeth Day McCormick Collection of Embroideries 69 June 2, 1939 Room of Recent Accessions, opening; new gallery, designated for exhibitions in The Masterpiece of the Month Series, and displaying new additions to Permanent collection; works shown at the opening; comments by AIC Director Daniel C. Rich 70-71 June 6, 1939 Art Students League of SAIC, prizes given to the League members; awards made possible through the gift of Mrs. William O. Goodman 72 June 8, 1939 Free Summer Lectures, French and German Primitives by Gibson Danes of Northwestern University, Evanston, IL; Paintings of the High Renaissance in Italy by SAIC instructor Briggs Dyer; Dutch and Flemish Old Masters by AIC Assistant Curator of Painting Frederick A. Sweet 73 June 9, 1939 SAIC Annual Commencement Exercises, graduation announcement at Goodman Memorial Theatre, conducted by AIC Vice President Mr. Chauncey McCormick; Invocation and Benediction pronounced by Minister of New England Church, Rev. Theodore Hume; student prizes, AIC Glee Club performance; guest list 74 June 10, 1939 AIC Director Daniel Catton Rich, named Chairman of Jury at San Francisco Golden Gate International Exposition 75 June 13, 1939 AIC Exhibition Calendar for 1939 Summer Exhibitions In the Department of Painting and Sculpture, curator AIC Director Daniel Catton Rich: Annual Exhibition of Works by SAIC Students; Costumes and Folk Art from Central Europe from Florence Dibell Bartlett Collection; Whistleriana, the artist's memorabilia from Walter Brewster Collection; Water Color Drawings by Thomas Rowlandson; Paintings by Lester O. Schwartz; Memorial Exhibition of Paintings by Pauline Palmer; Memorial Exhibition of Paintings by Carl Rudolf Krafft; Chinese Porcelains from the Goodman, Crane, Patterson, and Salisbury Collections; Lithographs by Odilon Redon; 50th Annual Exhibition of American Painting and Sculpture: Half a Century of American Art 76-77, 83 In the Children's Museum, curator Helen Mackenzie: Exhibition of Work by Children in the Saturday Classes of SAIC 77 From exhibition series The Making of the Masterpiece, showing At the Moulin Rouge by Toulouse-Lautrec 77 The Masterpiece of the Month, exhibition series introduced 77-78 In the Oriental Art Department, curator Charles Fabens Kelley: Chinese Jades from the Collection of Mr. and Mrs. Edward Sonnenschein; Japanese Surimono, lent by Ms. Helen C. Gunsaulus; Pottery of the Ming Dynasty 78, 83 In the Department of Prints and Drawing, Acting Curator Lilian Combs: Prints by Old Masters from Clarence Buckingham Collection; Sports in Prints; Sporting Prints and Drawings from the Collection of Mr. Joel Spitz of Chicago; Half a Century of American Prints; The Lenora Hall Curley Memorial Collection of Drawings; British Landscape Prints by Seymour Haden and David Young Cameron; Portraiture in Prints from Clarence Buckingham Collection; 7th International Exhibition of Lithography and Wood Engraving 78-79, 83 In the Decorative Arts Department: Exhibition of Paperweights from the Collection of Mrs. John N. Bergstrom; French Furniture from Henry C. Dangler Collection; Bonader from Sweden, Florence Dibell Bartlett Collection; English Architecture of the 18th C.; Exhibition of Embroideries from the Greek Islands, English and Ecclesiastical Embroideries from the Collection of Elizabeth Day McCormick 79, 83 Various announcements: invitation for train passengers to visit AIC on the way to the World's Fair in New York and San Francisco Golden Gate Exposition; attendance, lectures, Museum hours and orientation 79-80 June 13, 1939 General Education Board of Rockefeller Foundation, grant for three year project on art education in Chicago High Schools, conducted under supervision of Head of AIC Education Department Helen Parker 81 July 14, 1939 Chinese Art , free lecture series given by AIC Assistant Director and Curator of Oriental Art Charles Fabens Kelley; weekend gallery talks 82 July 18, 1939 Notes on Summer Exhibitions 83 July 22, 1939 Lectures and Gallery tours, given by AIC Assistant Curator for Painting and Sculpture Frederick A. Sweet, Gibson Danes of Northwestern University, Evanston, IL, and Briggs Dyer of SAIC 84 Weekly News Letter (Walter J. Sherwood, ed.); Nine Summer Exhibitions: Costumes and Folk Art from Eastern Europe lent by Florence D. Bartlett; Paintings by Carl Rudolf Krafft, School of the Ozark Painters; Pauline Palmer's paintings, works on view; Exhibition of Lester O. Schwartz, SAIC alumnus; Exhibition of Whistleriana from the collection of Walter S. Brewster, works on view; Water Colors by Thomas Rowlandson; Chinese Porcelains and Jades from Chicago Collections; Lithographs by Odilon Redon, from Martin A. Ryerson Collection; renovation of Permanent collection display; El Greco, lecture by assistant curator of Painting and Sculpture Frederick A. Sweet; note on the death of the mural painter Alphonse Mucha and the 1908 lecture series, titled Harmony in Art , given by the artist in AIC 137-138 July 25, 1939 Invitation to free music concert in Blackstone Hall, organist Max Allen, pianist Eleanor Gullett 85 July 29, 1939 Weekly News Letter (Walter J. Sherwood, ed.); The Masterpiece of the Month, exhibition series, Rembrandt's etching, titled Christ Preaching on display; paintings by winners of AIC Annuals Peter Hurd, Millard Sheets, Esther Williams, Nicolai Ziroli, John Whorf, William Zorach, and Georges Schreiber, acquired by The Metropolitan Museum in New York; free gallery lecture series, given by Briggs Dyer of SAIC and Gibson Danes of Northwestern University, Evanston, IL; gallery tours by Addis Osborne, SAIC alumnus; AIC catalogue of Summer exhibitions 139-141 August 1, 1939 Lectures and gallery talks, given by Briggs Dyer of SAIC, and Addis Osborne, SAIC alumnus 86-88, 90 August 5, 1939 Weekly News Letter (Lester Bridaham, ed.); Kenneth Goodman Memorial Theatre, improvements and additions; Decorative Arts Department Galleries in the Allerton Wing, construction, made possible by Vice-President and Chairman of the Committee of Decorative Arts, Mr. Robert Allerton; Wendell Stevenson, SAIC alumnus, commission of portraiture; SAIC Summer classes extended; Summer School at Saugatuck, MI, classes of Charles Willimovsky, SAIC Director Frederick Fursman, and Don Loving; 50th Annual Exhibition of American Painting and Sculpture: Half a Century of American Art, exhibition announcement; excepts from Time and Newsweek magazines, commenting on AIC Summer exhibitions; Sporting Prints from the Collection of Joel Spitz, exhibition 142-144 August 8, 1939 Briggs Dyer's Sunday Lecture Series gained public acclaim 87 August 12, 1939 Weekly News Letter; lectures and classes given by artists and SAIC alumni Leon R. Pescheret and Addis Osborne, and SAIC professors Edmund Giesbert and Briggs Dyer; Odilon Redon Lithographs, exhibition of works acquired by Martin A. Ryerson from the artist's widow, remarks by AIC Trustee Arthur T. Aldis; painting by Robert B. Harshe, AIC Director from 1921 to 1938, awarded honorable mention at Fine Arts Exhibition of the Golden Gates Exposition, excerpt from The Magazine of Art , May issie 145-147 August 15, 1939 Notes on Briggs Dyer's lectures 88 August 18, 1939 Membership Lecture, One-Plate Color Etching , given by SAIC instructor Leon R. Pescheret 89 August 19, 1939 Weekly News Letter; Student Honorable Mentions for the year 1939; AIC Curator Frederick A. Sweet, inquiring about locations of paintings for inclusion into 50th Annual Exhibition of American Painting and Sculpture: Half a Century of American Art, list of desired works; Assistant in AIC Decorative Arts Department Helen Mitchell, awarded Fellowship at Yale University; The Chicago Museum Tour Committee, providing two-day tour and booklet for Chicago visitors in cooperation with AIC and other cultural institutions, list of the Committee members 148-150 August 22, 1939 Lectures and gallery talks, given by SAIC instructors Briggs Dyer and Addis Osborne, and Head of AIC Education Department Helen Parker 90 Weekly News Letter; Masterpiece of the Month, exhibition series, showing Persian brocade of the Safavid period, the reign of Shah Abbas (1587-1628), gift of Mr. John R. Thompson of Chicago, description and comments; Contemporary Fine Arts Building at the New York World's Fair, AIC ranked as the most popular museum outside New York; Oriental jades from AIC Sonnenschein Collection, shown at The Golden Gate Exposition in San Francisco; free Museum admission on Labor Day; AIC Fall lecture series, titled The Great White Way to San Francisco Bay , given by Dudley Crafts Watson, reflecting on New York World's Fair, The Golden Gate Exposition in San Francisco, and US Museums 151-153 August 29, 1939 Notes on Exhibition of East European Costumes from Florence D. Bartlett Collection and other displays 91 September 2, 1939 SAIC announcing Student registration for the year 1940; colored post cards and reproductions of works from AIC Permanent collection, supplied by New York office of Vienna publisher Max Jaffe, list of titles available at AIC Reproduction Desk; gallery tours, conducted by Head of AIC Education Department Helen Parker and Briggs Dyer of SAIC; general Museum information, record of School, Museum offices and workshops, Shipping Room, and Museum Registrar in the Archives Department; Fall program in Fullerton Hall, opened with lecture series about home decoration, given by Dudley Crafts Watson 154-156 September 11, 1939 Lectures, Paintings of the High Renaissance in Italy , given by Helen Parker, and Dutch and Flemish Old Masters , given by Briggs Dyer 92 September 13, 1939 Meyric R. Rogers, appointed AIC Curator of Decorative Arts Department, replacing late Ms. Bessie Bennett; Mr. Rogers, concurrently appointed Head of Industrial Arts Department, newly formed in AIC; biography note, publications, and remarks by AIC President Potter Palmer and AIC Director of Fine Arts Daniel C. Rich 93-94 September 19, 1939 Week of the American Legion Convention, free Museum admission for the Legion members, announcement by AIC Director of Finance and Operation C. H. Burkholder 95-96 September 22, 1939 American Legion Parade, free Museum admission for the public 95-96 September 25, 1939 AIC Department of Education, programs and lectures, featuring SAIC instructor Mary Hipple, Head of Education Department Helen Parker, Ramsey Wieland, and George Buehr; film demonstrations on art techniques, supplemented by gallery tours 97 September 28, 1939 Sunday Lectures, French and English Paintings of the 17th and 18th Century , given by SAIC instructor George Buehr, and French Decorative Arts , given by assistant in Education Department Ramsey Wieland 100 September 30, 1939 Fiestas in Guatemala , lecture by Erna Fergusson, introducing Scammon Lecture Series for the year 101 October 1, 1939 Masterpiece of the Month, exhibition series, St. John on Patmosby Nicolas Poussin ; comparative displays in Impressionist galleries 98-99 October 2, 1939 Picasso Retrospective, planned by Alfred H. Barr, Director and Vice President of The Museum of Modern Art, N. Y. (MOMA), and Daniel C. Rich, AIC Director of Fine Arts; announcement on exhibition dates; war time exhibition, the first collaborative project by MOMA and AIC 13, 102 October 4, 1939 The Adventures in the Arts , lecture series conducted by Head of Education Department Helen Parker; attendance record for AIC lectures; Costumes from Florence Dibell Bartlett Collection on display 103 October 5, 1939 7th International Exhibition of Lithography and Wood-Engraving, US tour exhibition, jury comprised of artists Peggy Bacon, Asa Cheffetz, and Todros Geller; The Logan Prize for Prints, announced 104 October 7, 1939 Scammon Lecture, The Educational Viewpoint in an Art Museum , given by Dr. Thomas Munro of Cleveland Museum of Art; biography note and publications 105 October 12, 1939 Exhibition of Chinese Pottery and Porcelain, lent by Chicago collectors Mrs. William O. Goodman, Mrs. Richard T. Crane, Mrs. Alice H. Patterson, and Mrs. W. W. Kimball (courtesy of Mrs. Warren Salisbury and Mr. Kimball Salisbury) 106 October 14, 1939 Scammon Lecture, Armor of Renaissance Princes , given by Curator of Arms and Armors in The Metropolitan Museum Stephen V. Grancsay; the 1893 exhibition of Arms and Armor, held at the Chicago Columbian Exposition and featuring Mr. Grancsay's lecture 107 October 20, 1939 Motion Pictures in the Arts , special program in association with 7th International Exhibition of Lithography and Wood-Engraving, conducted by Head of Education Department Helen Parker; film screening, featuring woodcut artists and illustrators, Lynd Ward, Timothy Cole, and Chaim Gross 108 October 21, 1939 Scammon Lecture, The Art of Our Early Cabinet Makers , given by Edwin J. Hipkiss of Boston Museum of Fine Arts; biography note and publications 109 October 26, 1939 SAIC Glee Club concert of Negro Spirituals, conducted by AIC Assistant Director and Curator of Oriental Art Department Charles Fabens Kelley, and featuring musicians Virgil Espenlaub, Juanita Krunk, and Eleanor Gullett; numbers performed 110 October 27, 1939 Scammon Lecture, French Medieval Sculpture in America , given in association with opening of The Cloisters Museum in New York, by James J. Rorimer of The Metropolitan Museum; remarks by Mr. H. E. Winlock, formerly Director of The Metropolitan Museum; publications by Mr. Rorimer 111 October 28, 1939 50th American Exhibition: Half a Century of American Art, opening reception featuring tea table decorations from different periods, sponsored and arranged by The Antiquarian Society, The Municipal Art League, Art Institute Alumni, The Renaissance Society, The Arts Club, etc.; listing of representatives and participants 25, 50, 77, 112, 120-121 November 1, 1939 Masterpieces of Italian Art, exhibition lent by the Royal Italian Government to San Francisco World's Fair, special announcement on exclusive showing at AIC 113-114, 116-119, 122, 123, 125, 129, 131,132, 134 November 6, 1939 Scammon Lecture, Colonial American Portraiture , given by Alan Burroughs of Harvard University; biography note and publications 115 November 9, 1939 Masterpieces of Italian Art, exhibition lent by the Royal Italian Government to San Francisco World's Fair, shipment of art works to Chicago for exclusive showing at AIC and official ceremonies upon arrival, the route of procession to AIC 116 November 11, 1939 Masterpieces of Italian Art, exhibition lent by the Royal Italian Government to San Francisco World's Fair; honorary committees and Chicago sponsors for exclusive AIC showing 117-119 November 14, 1939 50th Annual Exhibition of American Painting and Sculpture: Half a Century of American Art, opening reception arranged by Antiquarian Society and Fortnightly Club, description of table decoration and list of hostesses 120-121 November 17, 1939 Masterpieces of Italian Art, exhibition, opening ceremonies featuring opera singer Hilde Reggiani 122 November 21, 1939 Free Museum admission on Thanksgiving Day; Radio program and special lectures, supplementing Masterpieces of Italian Art Exhibition 123 November 27, 1939 Scammon Lecture, featuring American sculptor William Zorach 124 December 1, 1939 Masterpieces of Italian Art, exhibition, related discussion on using tempera technique 125 December 2, 1939 Scammon Lecture, Precursors of the New Architecture , given by John Barney Rodgers of Armour Institute of Technology; biography note 126 December 5, 1939 Glee Club, Christmas concert, directed by AIC Assistant Director Charles Fabens Kelley 127 December 7, 1939 Masterpieces of Italian Art, exhibition; extended hours for late evening viewing; special musical programs, gallery tours, and Christmas events 129 December 9, 1939 Scammon Lecture, dedicated to sculptor Carl Milles, given by curator of Decorative Arts Department Meyric R. Rogers 128 December 12, 1939 Armour Institute of Technology Musical Club, free concert including AIC Glee Club performance 130 December 14, 1939 Masterpieces of Italian Art, exhibition, evening concerts; Joseph Bentonelli, lyric tenor, performing from the Museum Grand Staircase 131 December 18, 1939 Masterpieces of Italian Art, exhibition, evening concerts; Choir of the Church of Saint Thomas the Apostle 132 December 19, 1939 Free Museum admission on Christmas Day; Listing of current exhibitions 133 December 26, 1939 Masterpieces of Italian Art, exhibition, Italian Day in the Museum, free admission declared by Royal Italian Government 134 December 27, 1939 Free museum admission on New Year's Day; current exhibitions and lectures 135 ",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.14"
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
        "total": 64,
        "limit": 2,
        "offset": 0,
        "total_pages": 32,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/educator-resources?page=2&limit=2"
    },
    "data": [
        {
            "id": 99,
            "api_model": "educator-resources",
            "api_link": "https://api.artic.edu/api/v1/educator-resources/99",
            "title": "Tips for Discussing Works of Art",
            "web_url": "https://www.artic.edu/educator-resources/99/tips-for-discussing-works-of-art",
            "copy": " Discussions about works of art can take many forms. Keeping the following suggestions in mind will ensure that the discussion is meaningful and inclusive. ",
            ...
        },
        {
            "id": 34,
            "api_model": "educator-resources",
            "api_link": "https://api.artic.edu/api/v1/educator-resources/34",
            "title": "Educator Resource Packet: Shukongojin",
            "web_url": "https://www.artic.edu/educator-resources/34/educator-resource-packet-shukongojin",
            "copy": " The Art Institute\u2019s figure of Shukongojin, with his demon-like body, flaring eyes, and mouth stretched in a scream, might have originally terrified an oncoming visitor to the temple he guarded, but might have also instilled a sense of protection and reassurance for the visitor who hoped nothing would disturb his meditations once inside. For the viewer today, Shukongojin looks down from his rock-like pedestal, imposing both a sense of awe and curiosity about the target of his aggressive presence. This teaching packet includes an essay, discussion questions, activity ideas, a glossary, and an image of the artwork. ",
            ...
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
        "total": 64,
        "limit": 10,
        "offset": 0,
        "total_pages": 7,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "id": 121,
            "api_model": "educator-resources",
            "api_link": "https://api.artic.edu/api/v1/educator-resources/121",
            "title": "Artful Encounters: Short and Informative Videos for Educators and Students",
            "timestamp": "2026-02-25T23:45:07-06:00"
        },
        {
            "_score": 1,
            "id": 113,
            "api_model": "educator-resources",
            "api_link": "https://api.artic.edu/api/v1/educator-resources/113",
            "title": "SmartHistory Videos: Six Works from the Collection",
            "timestamp": "2026-02-25T23:45:07-06:00"
        },
        {
            "_score": 1,
            "id": 112,
            "api_model": "educator-resources",
            "api_link": "https://api.artic.edu/api/v1/educator-resources/112",
            "title": "Thorne Room Videos: Short But Informative Peeks into Three Tiny Rooms",
            "timestamp": "2026-02-25T23:45:07-06:00"
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

::: details Example request: https://api.artic.edu/api/v1/educator-resources/12  
```js
{
    "data": {
        "id": 12,
        "api_model": "educator-resources",
        "api_link": "https://api.artic.edu/api/v1/educator-resources/12",
        "title": "Educator Resource Packet: A Boy in Front of the Loews 125th Street Movie Theater, from the series Harlem, U.S.A",
        "web_url": "https://www.artic.edu/educator-resources/12/educator-resource-packet-a-boy-in-front-of-the-loews-125th-street-movie-theater-from-the-series-harlem-usa",
        "copy": " A Boy in Front of the Loews 125th Street Movie Theater is one of thirty photographs that constitute Harlem, U.S.A. , Dawoud Bey\u2019s first significant body of work. In this series, he explores a multitude of approaches towards representing the identities of Harlem and its black residents. This teaching packet includes an essay, discussion questions, activity ideas, a glossary, and images of three photographs from the series. ",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.14"
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
        "version": "1.14"
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
            "id": 47,
            "api_model": "digital-publications",
            "api_link": "https://api.artic.edu/api/v1/digital-publications/47",
            "title": "Cezanne Paintings and Watercolors at the Art Institute of Chicago",
            "timestamp": "2026-02-25T23:48:07-06:00"
        },
        {
            "_score": 1,
            "id": 30,
            "api_model": "digital-publications",
            "api_link": "https://api.artic.edu/api/v1/digital-publications/30",
            "title": "Ivan Albright Paintings at the Art Institute of Chicago",
            "timestamp": "2026-02-25T23:48:07-06:00"
        },
        {
            "_score": 1,
            "id": 32,
            "api_model": "digital-publications",
            "api_link": "https://api.artic.edu/api/v1/digital-publications/32",
            "title": "Whistler Paintings and Drawings at the Art Institute of Chicago",
            "timestamp": "2026-02-25T23:48:07-06:00"
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
        "web_url": "https://www.artic.edu/digital-publications/2/american-silver",
        "copy": " American Silver in the Art Institute of Chicago showcases the museum's superb collection of American silver. In-depth essays relate a fascinating story about eating, drinking, and entertaining that spans the history of the Republic and traces the development of the museum\u2019s holdings of American silver over nearly a century, and a catalogue incorporates detailed analysis of objects written by leading specialists. This digital augmentation of the 2017 publication provides stunning high-resolution photography and, for a select number of objects, three-dimensional captures that allow for close viewing. In addition, this edition includes an extensive illustrated checklist of additional objects.   Edited by Elizabeth McGoey with contributions by Debra Schmidt Bach, David L. Barquist, Judith A. Barter, Jennifer Goldsborough, Medill Higgins Harvey, Patricia Kane, Elizabeth McGoey, Barbara K. Schnitzer, Janine E. Skerry, Ann Wagner, Gerald W. R. Ward, Deborah Dependahl Waters, Beth Carver Wees, and Elizabeth A. Williams   American Silver in the Art Institute of Chicago is free and has received major support for this catalogue is provided by the Henry Luce Foundation. It is also made by possible by the generosity of the Community Associates of the Art Institute of Chicago, Mr. and Mrs. Henry M. Buchbinder, Carl and Marilynn Thoma, Louise Ingersoll Tausche, Jamee and Marshal Field V, Kay Bucksbaum, Celia and David Hilliard, and Jan and Bill Jentes. ",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.14"
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
        "version": "1.14"
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
        "total": 28,
        "limit": 10,
        "offset": 0,
        "total_pages": 3,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "id": 11,
            "api_model": "digital-publication-articles",
            "api_link": "https://api.artic.edu/api/v1/digital-publication-articles/11",
            "title": "Installation Views",
            "timestamp": "2026-02-25T23:51:08-06:00"
        },
        {
            "_score": 1,
            "id": 3,
            "api_model": "digital-publication-articles",
            "api_link": "https://api.artic.edu/api/v1/digital-publication-articles/3",
            "title": "Acknowledgments",
            "timestamp": "2026-02-25T23:51:08-06:00"
        },
        {
            "_score": 1,
            "id": 8,
            "api_model": "digital-publication-articles",
            "api_link": "https://api.artic.edu/api/v1/digital-publication-articles/8",
            "title": "\u201cDeep Ambivalences: Malangatana\u2019s Anti/Colonial Aesthetic\u201d by M\u00e1rio Pissarra",
            "timestamp": "2026-02-25T23:51:08-06:00"
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
        "web_url": "https://www.artic.edu/digital-publications/34/malangatana-mozambique-modern/1/directors-foreword",
        "copy": " The Art Institute of Chicago has been at the forefront of American museums in collecting and displaying modern art since the early twentieth century, and boasts an ongoing commitment to extending this vital legacy with research, publications, and exhibitions. In that spirit, a number of our curators came together in 2013 for a series of discussions exploring ideas about modern art, in particular the ways in which it manifests across our collections. This gave rise to the Modern Series, a set of three experimental, challenging, and provocative exhibitions and publications that are co-organized by curators across departments, with divergent but complementary specialties. The two previous iterations\u2014 Shatter Rupture Break (February 15\u2013May 3, 2015) and Go (February 23\u2013June 4, 2017)\u2014sought to present the museum\u2019s holdings in departments including Arts of the Americas, Modern and Contemporary Art, Photography and Media, and Textiles in fresh and exciting ways. Malangatana: Mozambique Modern (July 30\u2013November 16, 2020), the third and final project in the series, expands our understanding of modernism and modern art in a global context by bringing the work of celebrated Mozambican artist Malangatana Ngwenya (1936\u20132011) into conversation with our own international collection. It not only showcases the evolution in style and content within his early paintings and drawings, but also contextualizes his practice within the social and political conditions that framed the emergence of modern art in Mozambique and across the African continent. The exhibition also contributed to the cultivation of a more global perspective on artistic creation and its representation in the museum, both by providing the basis for this publication and, not least, by prompting us to acquire a painting and six works on paper by Malangatana for our permanent collection. Africa and its diasporas, with their deep history and wide geographical reach, occupy a prominent place within global art history and modern art that merits many more such efforts and programs in the years to come. Our colleagues\u2014notably Sarah Guernsey, Ann Goldstein, and Greg Nosan\u2014deserve my sincere gratitude for their continuing critical support for the Modern Series. But I am especially thankful to the exhibition\u2019s curators, Hendrik Folkerts, Felicia Mings, and Constantine Petridis, for introducing our staff and visitors to the fascinating milieu and work of Malangatana Ngwenya and for helping the Art Institute expand its representation of modern art from around the world. This exhibition would not have been possible without the generosity of the individuals and institutions in the United States, Portugal, and Mozambique who lent works from their collections. I am particularly grateful to the Malangatana Valente Ngwenya Foundation in Maputo for its invaluable loan of a significant number of paintings and drawings. Major funding for Malangatana: Mozambique Modern was provided by Sylvia Neil and Dan Fischel and the Alfred L. McDougal and Nancy Lauter McDougal Fund for Contemporary Art. Additional support is contributed by the Society for Contemporary Art through the SCA Activation Fund and the Miriam U. Hoover Foundation. Members of the Luminary Trust provide annual leadership support for the museum\u2019s operations, including exhibition development, conservation and collection care, and educational programming. The Luminary Trust includes an anonymous donor; Neil Bluhm and the Bluhm Family Charitable Foundation; Jay Franke and David Herro; Karen Gray-Krehbiel and John Krehbiel, Jr.; Kenneth Griffin; Caryn and King Harris, The Harris Family Foundation; Josef and Margot Lakonishok; Robert M. and Diane v.S. Levy; Ann and Samuel M. Mencoff; Sylvia Neil and Dan Fischel; Anne and Chris Reyes; Cari and Michael J. Sacks; and the Earl and Brenda Shapiro Foundation. Most importantly, I acknowledge with deepest thanks the intellectual and financial support of Sylvia Neil and Dan Fischel, who have provided crucial funding for the realization of this catalogue as well as the previous two in the Modern Series. Their ongoing commitment has enabled and encouraged our continued explorations into the possibilities of digital publication. James Rondeau President and Eloise W. Martin Director ",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.14"
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
        "total": 212,
        "limit": 2,
        "offset": 0,
        "total_pages": 106,
        "current_page": 1,
        "next_url": "https://api.artic.edu/api/v1/printed-publications?page=2&limit=2"
    },
    "data": [
        {
            "id": 145,
            "api_model": "printed-publications",
            "api_link": "https://api.artic.edu/api/v1/printed-publications/145",
            "title": "Strokes of Genius: Italian Drawings from the Goldman Collection",
            "web_url": "https://www.artic.edu/print-publications/145/strokes-of-genius-italian-drawings-from-the-goldman-collection",
            "copy": " This catalogue presents 59 masterful Italian drawings from the late 15th, 16th, and 17th centuries: working drawings, preparatory sketches, and finished compositions that have been added in recent years to the private collection of Jean and Steven Goldman. In her essays, Jean Goldman assesses the collection within the context of Mannerism and the role of drawing in the business of art. She and Nicolas Schwed coauthored detailed entries on the works\u2019 attributions, subjects, and functions, complete with documentation including provenance, bibliography, exhibition history, and comparative illustrations. The catalogue presents the work of more than forty artists, some of whom, such as Giorgio Vasari and Pietro da Cortona, were major figures, and others who were virtually unknown. Together, these magnificent works trace the rise and evolution of Mannerism in Italy.   Edited by Suzanne Folds McCullagh Essays by Jean Goldman and Nicolas Schwed   200 pages, 9 1/2 x 12 in. 78 color and 91 b/w ills. Hardcover $50.00 ISBN: 978-0-300-20777-4 ",
            ...
        },
        {
            "id": 38,
            "api_model": "printed-publications",
            "api_link": "https://api.artic.edu/api/v1/printed-publications/38",
            "title": "The Lithographs of James McNeill Whistler",
            "web_url": "https://www.artic.edu/print-publications/38/the-lithographs-of-james-mcneill-whistler",
            "copy": " This two-volume study presents the lithographic work of James McNeill Whistler (American, 1834-1903) in thorough technical and contextual detail. Volume I, a catalogue raisonn\u00e9, contains entries for each of Whistler's 179 lithographs, and is illustrated with reproductions of near-facsimile quality. The essays situate Whistler's work in lithography within a broader art-historical context. Volume II features transcriptions of more than 170 letters exchanged between Whistler and his London printers, Thomas Way and T. R. Way. Also included are a discussion of Whistler's lithographic techniques and an illustrated chronological account of the artist's marketing strategies. A compilation of watermarks reproduces at actual size those found in lithographs printed in Whistler's lifetime and posthumously. The Lithographs of James McNeill Whistler constitutes an important contribution to Whistler studies and to the study of nineteenth-century printmaking.   Edited by Martha Tedeschi   2-volume, boxed set, 992 pages, 8 7/8 x 12 3/4 in. 864 ills. Out of print ISBN: 978-0-86559-150-9 (hardcover) ",
            ...
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
        "total": 212,
        "limit": 10,
        "offset": 0,
        "total_pages": 22,
        "current_page": 1
    },
    "data": [
        {
            "_score": 1,
            "id": 83,
            "api_model": "printed-publications",
            "api_link": "https://api.artic.edu/api/v1/printed-publications/83",
            "title": "The Art Institute of Chicago Museum Studies 34, no. 2 : Art through the Pages: Library Collections at the Art Institute of Chicago",
            "timestamp": "2026-02-25T23:54:09-06:00"
        },
        {
            "_score": 1,
            "id": 84,
            "api_model": "printed-publications",
            "api_link": "https://api.artic.edu/api/v1/printed-publications/84",
            "title": "The Art Institute of Chicago Museum Studies 34, no. 1 : Notable Acquisitions at the Art Institute of Chicago",
            "timestamp": "2026-02-25T23:54:09-06:00"
        },
        {
            "_score": 1,
            "id": 21,
            "api_model": "printed-publications",
            "api_link": "https://api.artic.edu/api/v1/printed-publications/21",
            "title": "The Art Institute of Chicago Museum Studies 33, no. 2 : The Art of Indonesian Textiles: The E. M. Bakwin Collection at the Art Institute of Chicago",
            "timestamp": "2026-02-25T23:54:09-06:00"
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
        "web_url": "https://www.artic.edu/print-publications/4/the-art-institute-of-chicago-the-essential-guide",
        "copy": " The Essential Guide presents the diverse holdings of the Art Institute\u2019s collections. Featuring more than three hundred objects, it provides a journey through time\u2014from ancient Egypt until the present day\u2014and across the globe. Beautifully illustrated with short texts about each work, the publication includes beloved icons such as Georges Seurat\u2019s Sunday on La Grande Jatte\u20141884 and Edward Hopper\u2019s Nighthawks , as well as exciting recent acquisitions like a Teotihuacan shell mask, Marcel Duchamp\u2019s readymade Bottle Rack , and Thomas Hart Benton\u2019s Cotton Pickers . Read about objects currently on view in the galleries as well as exquisite textiles and works on paper that, because of the fragility of their materials, are less frequently shown. Use it as a guide to the museum or a souvenir of your visit. Four distinctive covers\u2014one great book! Choose your favorite cover image by Katsushika Hokusai, Archibald Motley Jr., Georgia O\u2019Keeffe, or Georges Seurat.   Foreword by James Rondeau   352 pages, 6 x 9 x 1 in. 335 color ills. Softcover $25 ($22.50 members) ISBN 978-0-86559-301-5 ",
        ...
    },
    "info": {
        "license_text": "The data in this response may be protected by copyright, and other restrictions, of the Art Institute of Chicago and third parties. You may use this data for noncommercial educational and personal use and for \"fair use\" as authorized under law, provided that you also retain all copyright and other proprietary notices contained on the materials and cite the author and source of the materials.",
        "license_links": [
            "https://www.artic.edu/terms"
        ],
        "version": "1.14"
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
        "version": "1.14"
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
            "timestamp": "2026-02-26T15:25:12-06:00"
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
        "version": "1.14"
    },
    "config": {
        "iiif_url": "https://www-test.artic.edu/iiif/2",
        "website_url": "https://www-test.artic.edu"
    }
}
```
:::

