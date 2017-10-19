![Art Institute of Chicago](https://raw.githubusercontent.com/Art-Institute-of-Chicago/template/master/aic-logo.gif)

# Art Institute of Chicago API

Thank you for your interest in using our museum's API. Our API offers an aggregation of our institutional data from a number of our internal systems, including artworks, artists, events, mobile tours and more.

The API is currently in develpment and is planned to move to production in early 2018. It is developed and maintained by in-house developers at the Art Institute of Chicago.

## Features

The API provides:

* JSON data in a unified, normalized format for all of our public institutional data
* Navigate relationships across systems
* Ability to "include" related data, so you don't have to make multiple calls
* Ability to specify the fields returned by any query

## Conventions

Following are some general conventions we've used in our API. You can look at information on our [endpoints](ENDPOINTS.md) and [fields](FIELDS.md) to learn more.

### Endpoints

* All endpoint resources are plural, e.g. /artworks, /books or /events
* Multiple-word resource routes are hyphenated, e.g. /tour-stop 
* URL paths only contain nouns. The HTTP method is used as the verb describing an action (GET /artworks, POST /books, DELETE /events/3, etc.)
* Single record results are formatted as:
  ```
  {
    "data": {
      "id": 511501255,
      "title": "Hello",
    }
  }
  ```
* Multiple record results are formatted as:
  ```
  {
    "data": [
      {
        "id": 100002,
        "title": "Hello",
      },
      {
        "id": 100003,
        "title": "It’s me",
      }
    ]
  }
  ```
* All resources offer the following endpoints:
  * GET /resources -- a list of all resources sorted by last updated date in descending order
  * GET /resources/X -- a single resource by the given identifier
  * GET /resources?ids=X,Y,Z -- multiple resource by the given identifiers
* Although not required, if subresource endpoints are provided, they are be built as such:
  * GET /resources/X/subresources -- a list of all subresources for a given resource
  * GET /resources/X/subresources/Y -- a single subresource for a given resource
  * GET /resources/X/subresources?ids=Y,Z -- multiple subresource for a given resource
* All resources provide an id and a title, as well as an image and description if possible.
* The API provides a short version number in the path in the form of /v1/. For the sake of brevity these version numbers aren't semantic, they are incremental. 
* Swagger is used to document the API interface, at the path /v1/swagger.json.

### Status codes

* The following status codes are returned:
  * 200 - generic successful request
  * 400 - invalid syntax
  * 403 - current user is forbidden from accessing this data
  * 404 - URL is not valid or requested resource does not exist
  * 405 - HTTP method not allowed
  * 500 - generic failed request
* More specific errors are provided in a machine-readable format. The structure of the error is as follows:
  * id - unique identifier for this particular occurrence of the problem (where such is logged)
  * status - the HTTP status code
  * code - an application specific error code (e.g. exception name)
  * error - a short, standard, human-readable summary of the problem
  * detail - human-readable explanation specific to this occurrence of the error (e.g. trace)

### Pagination

* By default, all queries return 12 records per page. A maximum of records per page the API can return is 1,000. 
* Pagination options for all methods can be passed as two query parameters: 
  * `page` to request a specific page of results
  * An optional `limit` parameter to set how many records each page should return and override the default. 
* Requests that return more data than what’s provided by the initial call add a pagination block to their results:
  ```
  {
    "pagination":{
      "total":726,
      "limit":12,
      "offset":24,  // zero-indexed
      "current_page":3, // 1-indexed
      "total_pages":61,
      "prev_url":"http://localhost/v1/resources?page=2&limit=12",
      "next_url":"http://localhost/v1/resources?page=4&limit=12"
    },
    "data":[
      ...
    ]
  }
  ```

### Includes

If a client wishes to embed subresources into the returned data, so they don’t have to make additional queries to retrieve them, they can pass the query parameter `?include=subresource1,subresource2,subresource3` to have them embedded. The results are the same as the subresources available in the separate API calls. The results look like this:

```
GET /resource/1?include=lyrics
{
  "data": {
    "id": 511501255,
    "title": "Hello",
    "lyric_ids": [
      1,
      2
    ],
    "lyrics": [
      {
        "id": 1,
        "line": "Hello, it's me"
      },
      {
        "id": 2,
        "line": "I was wondering if after all these year you'd like to meet"
      }
    ]
  }
}
```

Note that the `lyrics_ids` are returned without the include parameter as well, so a client can still retrieve subresource data in separate calls if they wish.

### Fields

To limit the fields that are returned to your query, you can pass the `fields` parameter with a comma-separated list of field names.

### Field names

* All fields are lowercase and snake case (underscore case)
* Fields which contain a single id reference to another resource are singular, and end with _id, ex:
  ```
  "artist_id": 55  
  ```
* Fields which refer to multiple resources via ids have singular resource names, followed by _ids, ex:
  ```
  "copyright_representative_ids": [55, 60, 61]
  ```
* Fields which contain an included resource are named singular, after the resource:
  ```
  "artist": {"id": 55, "title": "Sheikh, Nilima"}
  ```
* Fields which contain multiple included resources are plural, after the resource:
  ```
  "artists": [
    {"id": 55, "title": "Sheikh, Nilima"},
    {"id": 60, "title": "Walker, Kara"},
  ]
  ```

### Authentication

No authentication is implemented on API.

## Licensing

This project is licensed under the [GNU Affero General Public License 
Version 3](LICENSE).
