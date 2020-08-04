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
Do you want _all_ of our data? Are you running into problems with throttling or deep pagination? Consider using our [data dumps](#data-dumps) instead of our API.
:::

For example, you can access the `/artworks` endpoint in our API by visiting the following URL to see all the published artworks in our collection:

```
https://api.artic.edu/api/v1/artworks
```

If you want to see data for just one artwork, you can use the `/artworks/{id}` endpoint. For example, here's [_Nighthawks_](https://www.artic.edu/artworks/111628/nighthawks) by Edward Hopper:

```
https://api.artic.edu/api/v1/artworks/111628
```

When you view these URLs in your browser you might get a jumbled bunch of text. That's OK! If you're using Chrome, install the [JSON Formatter extension](https://chrome.google.com/webstore/detail/json-formatter/bcjindcccaagfpapjjmafapmmgkkhgoa) and hit reload, and the results will be formatted in a way humans can read, too.

There is a lot of data you'll get for each artwork. If you want to only retrieve a certain set of fields, change the `fields` parameter in the query to list which ones you want, like this:

```
https://api.artic.edu/api/v1/artworks?fields=id,title,artist_display,date_display,main_reference_number
```

::: tip
The `fields` parameter expects either an array of field names, or a comma-separated list of field names in a single string (e.g. example above). We encourage you to use it because it makes your queries run faster and lets us track which fields need continued support.
:::

You can [paginate](#pagination) through results using `page` and `limit` params:

```
https://api.artic.edu/api/v1/artworks/search?page=2&limit=100
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

