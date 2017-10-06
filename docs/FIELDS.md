## artworks/essentials

### date_start, date_end, and date_display

These fields represent dates when the artwork was created. In many cases, it took multiple years to make an artwork, so these dates are a range. `date_start` and `date_end` are integers, meant for aiding in search. `date_display` is a prettified free-text representation of the above; it was written by curators and editors in house style, and it's currently the preferred field for output on websites, etc.

### date_dates

This field is a work-in-progress. Some artworks will have additional dates associated with them, describing their object history. This might include publication dates for works on paper, exhibition dates for provenance, found dates for archaeological finds, etc.

### catalogue_titles

Describes which [catalog raisonees](https://en.wikipedia.org/wiki/Catalogue_raisonn%C3%A9) this artwork has been published under. This isn't an exhaustive list of publications where the work has been mentioned, only _catalog raisonees_.

### committee_titles

List of committees which were involved in the acquisition of the artwork.

### image_ids, image_iiif_urls

Represents images related to this artwork, accessible via `artworks/:id/images`, or `/images/:id`

Please note that when accessing these fields through search, there is a chance that e.g. `image_id[0]` will not correspond to `image_iiif_url[0]`, which is a downside of Lucene indexing.



## artworks/:id/sets, artworks/:id/parts

An artwork might be part of a set - e.g. a teapot and a teacup are separate artworks that are part of the same set. An artwork's `sets` attribute thus defined what "sets" it belongs to. Somewhat counter-intuitively, perhaps, "sets" are artworks as well, rather than a separate model. This approach might be best explained by the need to track the same fields both for individual artworks, as well as for groups of them that share some object-history context.



## events

### type_id, resource_id

Both of these fields are internal, meaningful only within the context of our eGalaxy system. They are injested to facilitate integration with other systems. `resource_id` is a special cause, because some resources correspond to galleries. We are working on providing a `gallery_id` where these relationships are possible.
