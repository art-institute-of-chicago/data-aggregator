---
# Using `home: true` causes Vuepress to use a different layout
# https://vuepress.vuejs.org/theme/default-theme-config.html#homepage
---

## Introduction

The [Art Institute of Chicago](https://www.artic.edu)'s API provides JSON-formatted data as a REST-style service that allows developers to explore and integrate the museum’s public data into their projects. This API is the same tool that powers our [website](https://www.artic.edu), our [mobile app](https://www.artic.edu/visit/explore-on-your-own/mobile-app-audio-tours), and many other technologies in the museum.

If the application you're building will be public, please send it our way! We'd love to share it alongside some of the [other projects that use our API](https://www.artic.edu/open-access/public-api). And if you have any questions, please feel free to reach out to us: [engineering@artic.edu](mailto:engineering@artic.edu).


### Quick Start

An [API](https://www.youtube.com/watch?v=81ygVYCupdo) is a structured way that one software application can talk to another. APIs power much of the software we use today, from the apps on our phones and watches to technology we see in sports and TV shows. We built an API to let people like you easily get our data in an ongoing way.

::: tip
Do you want _all_ of our data? Are you running into problems with [throttling](#authentication) or [deep pagination](#pagination)? Consider using our [data dumps](#data-dumps) instead of our API.
:::

For example, you can access the `/artworks` listing endpoint in our API by visiting the following URL to see all the published artworks in our collection:

```
https://api.artic.edu/api/v1/artworks
```

If you want to see data for just one artwork, you can use the `/artworks/{id}` detail endpoint. For example, here's [_Nighthawks_](https://www.artic.edu/artworks/111628/nighthawks) by Edward Hopper:

```
https://api.artic.edu/api/v1/artworks/111628
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
Our API is flexible in how it accepts queries, but each method of querying is meant for a specific purpose. See [GET vs. POST](get-vs-post) for more details.
:::

There's a lot of information you can get about our collection, and there's a lot more than artworks in our API. Explore our documentation to learn more!


### Conventions

- We refer to models in our API as "resources" (e.g. `artworks`, `artists`, `places`)

- Resources are typically accessed via their endpoints. Each resource has three endpoints:

  - Listing (e.g. `/artworks`)
  - Detail (e.g. `/artworks/{id}`)
  - Search (e.g. `/artworks/search`)

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

- Fields that contains title references to records from other resources follow naming conventions similar to id-based fields:

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

- When downloading images, use `/full/843,/default.jpg` parameters.

- When scraping, please use a single thread and self-throttle.

- Consider using [data dumps](#data-dumps) instead of scraping our API.


### Authentication

You may access our API without authentication. Anonymous users are throttled to 60 requests per minute. If you are working on an application that needs to exceed this restriction, please get in touch with us at engineering@artic.edu.

Please use [HTTPS](https://en.wikipedia.org/wiki/HTTPS) to access our API. To support legacy applications, our API is currently accessible via both HTTP and HTTPS, but HTTP access will be removed in the future.

Lastly, consider adding a `User-Agent` header with the name of your project and a contact email to your API requests. For example:

```bash
curl 'https://api.artic.edu/api/v1/artworks/111628' \
--header 'User-Agent: aic-bash (engineering@artic.edu)'
```

We ask that you do so as a [matter of courtesy](https://towardsdatascience.com/ethics-in-web-scraping-b96b18136f01). If we see an application using a disproportionate amount of system resources, this gives us an avenue to reach out and work with you to optimize your queries.


### Pagination

Listing and search endpoints are paginated. We show 12 records per page by default. Pagination can be controlled via the following query parameters:

  - `page` to request a specific page of results (1-based) (default: 1)
  - `limit` to set how many records each page should return (0-based) (default: 12)

**Example:** https://api.artic.edu/api/v1/artists?page=2&limit=10

For performance reasons, `limit` cannot exceed 100. Additionally, due to an underlying limitation in our search engine, you cannot request more than 10,000 records from a single search query through any combination of `limit` and `page`. For example:

  - **Success:** https://api.artic.edu/api/v1/artists/search?limit=100&page=100
  - **Error:** https://api.artic.edu/api/v1/artists/search?limit=100&page=101

If you want to filter and scrape our search results, but the number of results is greater than 10,000, you won't be able to scrape them fully. Instead, we recommend that you download our [data dumps](#data-dumps) and perform your filtering locally.

Occasionally, it might be useful to make a request with `limit=0` to find the total number of results. Our API supports this. For example, check `pagination.total` of this query to see the number of public domain artworks in our API:

https://api.artic.edu/api/v1/artworks/search?query[term][is_public_domain]=true&limit=0

All paginated endpoints include a `pagination` block in their responses:

```json
{
    "pagination": {
        "total": 112773,
        "limit": 12,
        "offset": 24,  // zero-indexed
        "current_page": 3, // 1-indexed
        "total_pages": 9398,
        "prev_url": "https://api.artic.edu/api/v1/artworks?page=2&limit=12",
        "next_url": "https://api.artic.edu/api/v1/artworks?page=4&limit=12"
    },
    "data": [
        // ...
    ]
}
```


