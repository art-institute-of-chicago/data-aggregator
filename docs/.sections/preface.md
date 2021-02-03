## Introduction

The [Art Institute of Chicago](https://www.artic.edu)'s API provides JSON-formatted data as a REST-style service that allows developers to explore and integrate the museum’s public data into their projects. This API is the same tool that powers our [website](https://www.artic.edu), our [mobile app](https://www.artic.edu/visit/explore-on-your-own/mobile-app-audio-tours), and many other technologies in the museum.

If the application you're building will be public, please send it our way! We'd love to share it alongside some of the [other projects that use our API](https://www.artic.edu/open-access/public-api). And if you have any questions, please feel free to reach out to us: [engineering@artic.edu](mailto:engineering@artic.edu).


### Quick Start

An [API](https://www.youtube.com/watch?v=81ygVYCupdo) is a structured way that one software application can talk to another. APIs power much of the software we use today, from the apps on our phones and watches to technology we see in sports and TV shows. We have built an API to let people like you easily get our data in an ongoing way.

::: tip
Do you want _all_ of our data? Are you running into problems with [throttling](#authentication) or [deep pagination](#pagination)? Consider using our [data dumps](#data-dumps) instead of our API.
:::

For example, you can access the `/artworks` listing endpoint in our API by visiting the following URL to see all the published artworks in our collection:

```
https://api.artic.edu/api/v1/artworks
```

If you want to see data for just one artwork, you can use the `/artworks/{id}` detail endpoint. For example, here's [_Starry Night and the Astronauts_](https://www.artic.edu/artworks/129884/starry-night-and-the-astronauts) by Alma Thomas:

```
https://api.artic.edu/api/v1/artworks/129884
```

When you view these URLs in your browser, you might see a jumbled bunch of text. That's OK! If you're using Chrome, install the [JSON Formatter extension](https://chrome.google.com/webstore/detail/json-formatter/bcjindcccaagfpapjjmafapmmgkkhgoa), hit reload, and the results will be formatted in a way humans can read, too.

There is a lot of data you'll get for each artwork. If you want to only retrieve a certain set of fields, change the `fields` parameter in the query to list which ones you want, like this:

```
https://api.artic.edu/api/v1/artworks?fields=id,title,artist_display,date_display,main_reference_number
```

::: tip
The `fields` parameter expects either an array of field names, or a comma-separated list of field names in a single string (e.g. example above). We encourage you to use it because it makes your queries run faster and lets us track which fields need continued support.
:::

You can [paginate](#pagination) through results using `page` and `limit` params:

```
https://api.artic.edu/api/v1/artworks?page=2&limit=100
```

If you want to search and filter the results, you can do so via our search endpoints. For example, here is a [full-text search](https://en.wikipedia.org/wiki/Full-text_search) for all artworks whose metadata contains some mention of cats:

```
https://api.artic.edu/api/v1/artworks/search?q=cats
```

Here is the same search, but filtered to only show artworks that are in the public domain:

```
https://api.artic.edu/api/v1/artworks/search?q=cats&query[term][is_public_domain]=true
```

Behind the scenes, our search is powered by [Elasticsearch](https://www.elastic.co/what-is/elasticsearch). You can use its [Query DSL](https://www.elastic.co/guide/en/elasticsearch/reference/current/query-dsl.html) to interact with our API. The example above uses a [`term`](https://www.elastic.co/guide/en/elasticsearch/reference/current/query-dsl-term-query.html) query. Other queries we use often include [`exists`](https://www.elastic.co/guide/en/elasticsearch/reference/current/query-dsl-exists-query.html) and [`bool`](https://www.elastic.co/guide/en/elasticsearch/reference/current/query-dsl-bool-query.html). [Aggregations](https://www.elastic.co/guide/en/elasticsearch/reference/current/search-aggregations.html) are also a powerful tool.

Our API accepts queries through both `GET` and `POST`. It might be easier to visualize how the `GET` query above is structured by comparing it to its `POST` equivallent:

``` bash
curl --location --request POST 'https://api.artic.edu/api/v1/artworks/search' \
--header 'Content-Type: application/json' \
--data-raw '{
    "q": "cats",
    "query": {
        "term": {
            "is_public_domain": true
        }
    }
}'
```

For production use, we recommend using `GET` and passing the entire query as minified URL-encoded JSON via the `params` parameter. For example:

```
https://api.artic.edu/api/v1/artworks/search?params=%7B%22q%22%3A%22cats%22%2C%22query%22%3A%7B%22term%22%3A%7B%22is_public_domain%22%3Atrue%7D%7D%7D
```

::: warning
Our API is flexible in how it accepts queries, but each method of querying is meant for a specific purpose. See [GET vs. POST](#get-vs-post) for more details.
:::

There's a lot of information you can get about our collection, and there's a lot more than artworks in our API. Explore our documentation to learn more!


### Conventions

- We refer to models in our API as "resources" (e.g. `artworks`, `artists`, `places`)

- Resources are typically accessed via their endpoints. Each resource has three endpoints:

  - Listing (e.g. `/artworks`)
  - Detail (e.g. `/artworks/{id}`)
  - Search (e.g. `/artworks/search`) (optional)

  Some resources might lack a search endpoint if there appears to be no need for it yet.

- Multi-word endpoints are hyphenated (e.g. `/tour-stop`).

- All field names are lowercase and snake case (underscore case).

- Every resource in the API has `id` and `title` fields.

- Fields that contain a single id reference to another resource are singular and end with `_id`:

  ```json
  "artist_id": 51349,
  ```

- Fields that contain id references to multiple records from another resource are singular and end with `_ids`:

  ```json
  "style_ids": ["TM-4439", "TM-8542", "TM-4441"],
  ```

- Fields that contain title references to records from other resources follow naming conventions similar to id-based fields:

  ```json
  "artist_title": "Ancient Roman",
  "classification_titles": ["modern and contemporary art", "painting"],
  ```

- Every title-based field has a `keyword` subfield in Elasticsearch, which is meant for filters and aggregations. See "New defaults" section in [this article](https://www.elastic.co/blog/strings-are-dead-long-live-strings) for more info.

- Numeric and boolean fields get parsed into actual numbers and booleans:

  ```json
  "artwork_id": "45", // BAD
  "date_start": 1942, // GOOD

  "is_preferred": "True", // BAD
  "is_in_gallery": true, // GOOD
  ```

- We never show any empty strings in the API. We only show `null`:

  ```json
  "date_display": "", // BAD
  "artist_display": null, // GOOD
  ```

- We prefer to always show all fields, even if they are `null` for the current record:

  - If a field that typically returns a string, number, or object is empty for a given record, we return it as `null`, rather than omitting it.

  - If a field typically returns an array, we prefer to return an empty array, rather than returning `null`. This is done in part for backwards-compatibility reasons.


### Best Practices

Here are some tips that will make your application run faster and/or reduce load on our systems:

- Cache API responses in your system when possible.

- Use the `fields` parameter to tell us exactly what fields you need.

- Batch detail queries with the multi-id parameter (`?ids=`).

- Batch search queries with [multi-search](#multi-search) (`/msearch`).

- When [downloading images](#images), use `/full/843,/0/default.jpg` parameters.

- When scraping, please use a single thread and self-throttle.

- Consider using [data dumps](#data-dumps) instead of scraping our API.


## Data Dumps

You can download a dump that contains all of our public data here:

https://github.com/art-institute-of-chicago/api-data

These data dumps are updated nightly. They are generated from our API. As such, they contain the same data as our API, and their schema mirrors that of the API. The data is dumped in JSON format, with one JSON file per record. Records are grouped by API resource type.

Our intention with this approach is to make it easier to adapt code to draw from the data dumps instead of the API, and vice-versa. Since the schema is the same, switching between the two should be relatively straight-forward.

If you notice schema discrepancies between the data dumps and the API, or if you need help with using our data dumps, please [open an issue](https://github.com/art-institute-of-chicago/api-data/issues) in the `api-data` repo.


### Data Dumps vs. API?

We recommend using the data dumps for scenarios such as the following:

- You want to have a full copy of our data for archival purposes.
- You want to scrape a large result set (>10,000 records).
- You want to analyze or enhance our data.

Use our API if the following fits your use case:

- You want to integrate our data into a website or application.
- You need real-time access to our data.


### Scraping Data

Generally, we ask that you avoid extensive scraping of our API. The API is meant for direct integration into websites and applications. The data dumps are meant for backups and analysis. Scraping our API puts undue stress on our systems. Instead of scraping, please download the data dumps and filter them locally to obtain the data you need.

That said, we don't mind small-scale scraping of our API. It can be convenient to use our search endpoint to filter records and retrieve only the fields you need. You can even use the [aggregation](#aggregations) functionality of our search endpoints to run some simple analyses. Just remember that you cannot paginate beyond 10,000 results in our search endpoints (see [Pagination](#pagination)).

If you do decide to scrape our resources, please throttle your requests to no more than one per second and avoid running multiple scrapers in parallel.



## Images

This API does not contain image files. However, it does contain all of the data you need to access our images. Our institution serves images via a separate API that is compliant with the [IIIF Image API 2.0](https://iiif.io/api/image/2.0/) specification. Using metadata from this API, you can craft URLs that will allow you to access images of artworks from our collection.

The [International Image Interoperability Framework (IIIF)](https://iiif.io/) stewards a set of open standards that enables rich access to digital media from libraries, archives, museums, and other cultural institutions around the world. In practical terms, they define several API specifications that enable interoperability. When a tool is built to be IIIF-compliant, it's easier to adapt it to consume images from any number of institutions that offer IIIF-compliant APIs.


### IIIF Image API

We deliver our images via the [IIIF Image API 2.0](https://iiif.io/api/image/2.0/). Our IIIF URLs have the following structure:

```
https://www.artic.edu/iiif/2/{identifier}/{region}/{size}/{rotation}/{quality}.{format}
```

We recommend the following URL structure for most use-cases:

```
https://www.artic.edu/iiif/2/{identifier}/full/843,/0/default.jpg
```

Let's jump right into an example. Here's how you can construct IIIF URLs:

 1. Retrieve one or more artworks with `image_id` fields. Here are a few ways of doing so:

    ```
    # La Grande Jatte
    https://api.artic.edu/api/v1/artworks/27992?fields=id,title,image_id

    # La Grande Jatte and The Bedroom
    https://api.artic.edu/api/v1/artworks?ids=27992,28560&fields=id,title,image_id

    # Top two public domain artworks
    https://api.artic.edu/api/v1/artworks/search?query[term][is_public_domain]=true&limit=2&fields=id,title,image_id
    ```

    Let's go with the first one, [_La Grande Jatte_](https://www.artic.edu/artworks/27992/a-sunday-on-la-grande-jatte-1884). Your response will look something like this:

    ```
    {
        "data": {
            "id": 27992,
            "title": "A Sunday on La Grande Jatte — 1884",
            "image_id": "1adf2696-8489-499b-cad2-821d7fde4b33"
        },
        "config": {
            "iiif_url": "https://www.artic.edu/iiif/2",
        }
    }
    ```

 2. Find the base IIIF Image API endpoint in the `config.iiif_url` field:

    ```
    https://www.artic.edu/iiif/2
    ```

    We recommend that you avoid hardcoding this value into your applications.

 3. Append the `image_id` of the artwork as a segment to this URL:

    ```
    https://www.artic.edu/iiif/2/1adf2696-8489-499b-cad2-821d7fde4b33
    ```

 4. Append `/full/843,/0/default.jpg` to the URL:

    ```
    https://www.artic.edu/iiif/2/1adf2696-8489-499b-cad2-821d7fde4b33/full/843,/0/default.jpg
    ```

That's it! This is a valid IIIF URL. It will return the same image as we use on our website:

![La Grande Jatte](https://www.artic.edu/iiif/2/1adf2696-8489-499b-cad2-821d7fde4b33/full/843,/0/default.jpg)

Some artworks also have `alt_image_ids`, such as the [Coronation Stone of Motecuhzoma II](https://www.artic.edu/artworks/75644/coronation-stone-of-motecuhzoma-ii-stone-of-the-five-suns):

```
https://api.artic.edu/api/v1/artworks/75644?fields=id,title,image_id,alt_image_ids
```

Exhibitions have images, too:

```
https://api.artic.edu/api/v1/exhibitions/4568?fields=id,title,image_id,alt_image_ids
```


### Image Sizes

The [IIIF Image API 2.0](https://iiif.io/api/image/2.0/) has a lot of options. However, we prefer to use it conservatively. As mentioned above, here's the URL pattern we use for most projects:

```
https://www.artic.edu/iiif/2/{identifier}/full/843,/0/default.jpg
```

We recommend using `/full/843,/0/default.jpg` because this is the most common size used by our website, so there's a good chance that the image has previously been requested and cached. If you use this pattern in your projects, it will make images load faster in your application and decrease load on our systems.

::: tip
We don't mind if you hotlink to our images. Our images support CORS with `Access-Control-Allow-Origin: *` headers—same as our API responses! However, please be aware that any image can get unpublished or replaced at any time.
:::

If you'd like to display the full image at smaller sizes, we recommend the following size increments, as these are likely to give you a cache hit as well:

```
https://www.artic.edu/iiif/2/{identifier}/full/200,/0/default.jpg
https://www.artic.edu/iiif/2/{identifier}/full/400,/0/default.jpg
https://www.artic.edu/iiif/2/{identifier}/full/600,/0/default.jpg
https://www.artic.edu/iiif/2/{identifier}/full/843,/0/default.jpg
```

If you are accessing public domain images, you may also use the following pattern for larger images:

```
https://www.artic.edu/iiif/2/{identifier}/full/1686,/0/default.jpg
```

However, we still recommend using `843` instead unless there's a clear need for `1686`.

Why the strange number—843px wide? This number is related to certain [guidelines for the use of copyrighted materials](https://aamd.org/sites/default/files/document/Guidelines%20for%20the%20Use%20of%20Copyrighted%20Materials.pdf) within the museum field. Over time, it became the most common dimension used by our applications, so it is the size we continue to recommend.


### IIIF Manifests

We also offer IIIF Manifest for all of our public domain artworks. A manifest is a resource defined by the [IIIF Presentation API](https://iiif.io/api/presentation/2.0/). Each manifest contains artwork metadata—such as title, artist name, and copyright info—alongside a list of images associated with that artwork.

You can access the manifest by appending `/manifest.json` after the artwork identifier. For example, here is the manifest for [The Great Wave](https://www.artic.edu/artworks/24645/under-the-wave-off-kanagawa-kanagawa-oki-nami-ura-also-known-as-the-great-wave-from-the-series-thirty-six-views-of-mount-fuji-fugaku-sanjurokkei):

```
https://api.artic.edu/api/v1/artworks/24645/manifest.json
```

These IIIF manifests do not contain any data that cannot be found elsewhere in our API. But because they follow a standardized API, they can be used with IIIF-compliant tools, such as [Mirador](https://projectmirador.org/). For a fun example, try pasting the URL above into the [Getty's Animal Crossing Art Generator](https://experiments.getty.edu/ac-art-generator#iiifloader)—and scroll up to see the result!


### Image Dumps

Unfortunately, we cannot offer image dumps at this time. We are exploring that possibility.

For now, you may scrape images from our IIIF Image API. We ask that you please follow our guidelines for [scraping images](#scraping-images) if you decide to do so.


### Scraping Images

Generally, we prefer that you hotlink to our images, rather than scraping them. Scraping images can put unnecessary strain on our systems. That said, we understand that many use-cases require images to be stored locally.

If you'd like to scrape images from our IIIF API, please follow these guidelines:

 * Scrape one image at a time—do not use multiple threads or processes!
 * Consider adding a delay of 1 second between each image download
 * Use the following URL pattern to download our [most common image size](image-sizes):
   ```
   https://www.artic.edu/iiif/2/{identifier}/full/843,/0/default.jpg
   ``` 


### Copyright

For information about copyright, please see the [Image Licensing](https://www.artic.edu/image-licensing) and [Terms](https://www.artic.edu/terms) pages on our website. We defer to those resources in all legal respects.

From a developer's perspective, we recommend only using images from artworks that are tagged as public domain. When querying for artworks, you can filter by public domain status like so:

```
https://api.artic.edu/api/v1/artworks/search?query[term][is_public_domain]=true&limit=0
```

To get the full list of artworks that are in the public domain, you will need to download our [data dumps](#data-dumps) and perform the filtering locally.

Please note that you may encounter images that are not public domain via our [IIIF Image API](#iiif-image-api). It is up to you to determine whether or not you are allowed to use these images for your use-case and to obtain any necessary permissions.



## General Information

### Authentication

You may access our API without authentication. Anonymous users are throttled to 60 requests per minute. (Each IP counts as a separate user.) If you are working on an application that needs to exceed this restriction, please get in touch with us at engineering@artic.edu.

Please use [HTTPS](https://en.wikipedia.org/wiki/HTTPS) to access our API. To support legacy applications, our API is currently accessible via both HTTP and HTTPS, but HTTP access will be removed in the future.

Lastly, consider adding a `User-Agent` header with the name of your project and a contact email to your API requests. For example:

```bash
curl 'https://api.artic.edu/api/v1/artworks/24645' \
--header 'User-Agent: aic-bash (engineering@artic.edu)'
```

We ask that you do so as a [matter of courtesy](https://towardsdatascience.com/ethics-in-web-scraping-b96b18136f01). If we see an application using a disproportionate amount of system resources, this gives us an avenue to reach out and work with you to optimize your queries.


### Pagination

Listing and search endpoints are paginated. We show 12 records per page by default. Pagination can be controlled via the following query parameters:

  - `page` to request a specific page of results (1-based, default: 1)
  - `limit` to set how many records each page should return (0-based, default: 12)

**Example:** https://api.artic.edu/api/v1/artists?page=2&limit=10

For performance reasons, `limit` cannot exceed 100. Additionally, you cannot request more than 10,000 records from a single search query through any combination of `limit` and `page`. For example:

  - **Success:** https://api.artic.edu/api/v1/artists/search?limit=100&page=100
  - **Error:** https://api.artic.edu/api/v1/artists/search?limit=100&page=101

Generally, we ask that you avoid scraping our API. If you want to filter and scrape our search results, but the number of results is greater than 10,000, you won't be able to scrape them fully. Instead, we recommend that you download our [data dumps](#data-dumps) and perform your filtering locally.

Occasionally, it might be useful to check the total number of results without retrieving any data. Our API supports this by allowing you to make a request with `limit=0`. For example, check `pagination.total` of this query to see the number of public domain artworks in our API:

https://api.artic.edu/api/v1/artworks/search?query[term][is_public_domain]=true&limit=0

All paginated endpoints include a `pagination` block in their responses:

```json
{
    "pagination": {
        "total": 112773,
        "limit": 12,
        "offset": 24,  // 0-based
        "current_page": 3, // 1-based
        "total_pages": 9398,
        "prev_url": "https://api.artic.edu/api/v1/artworks?page=2&limit=12",
        "next_url": "https://api.artic.edu/api/v1/artworks?page=4&limit=12"
    },
    "data": [
        // ...
    ]
}
```


