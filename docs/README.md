---
home: true
tagline: null
footer: AGPL-3.0 Licensed | Copyright © 2018–present Art Institute of Chicago
---

The Art Institute of Chicago's API provides JSON formatted data as a REST-style service that allows developers to explore and integrate the museum’s data into their projects. This API is the same tool that powers our [website](https://www.artic.edu/), our [mobile app](https://www.artic.edu/visit/explore-on-your-own/mobile-app-audio-tours), and many other technologies in the museum.

### Getting started

API requests are made by accessing various endpoints at https://api.artic.edu/api/v1. Read more about our [endpoints](/endpoints) and [fields](/fields) to learn about the parameters you can use to manipulate your query.

### What's an API?

An [API](https://www.youtube.com/watch?v=81ygVYCupdo) is a structured way that one software application can talk to another. APIs power much of the software we use today, from the apps on our phones and watches to technology we see in sports and TV shows. The Art Institute of Chicago has built an API to let people like you easily get the data you need in an ongoing way.

To look at all the artworks in our collection, access the API with the following URL:

```
https://api.artic.edu/api/v1/artworks
```

When you view this in your browser you might get a jumbled bunch of text. That's OK! If you're using Chrome, install the [JSON Formatter extension](https://chrome.google.com/webstore/detail/json-formatter/bcjindcccaagfpapjjmafapmmgkkhgoa) and hit reload, and the results will be formatted in a way humans can read, too.

There is a lot of data you'll get for each artwork. If you want to only retrieve a certain set of fields, change the `fields` parameter in the query to list which ones you want, like this:

```
https://api.artic.edu/api/v1/artworks?fields=id,title,artist_display,date_display,main_reference_number
```

There's a lot of information you can get in our collection, and there's a lot more than artworks in our API. Learn more by reading through our [endpoints](/endpoints) and [fields](/fields) documentation.

If the application you're building will be public, please send it our way! We'd love to share it alongside some of the other projects that use our API. And if you have any questions, please feel free to reach out to us: engineering@artic.edu.