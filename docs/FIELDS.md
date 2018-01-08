# Collections

## Artworks

Represents a work of art in our collections. For a description of all the endpoints available for this resource, see [here](ENDPOINTS.md#artworks).

* `id` *number* - Unique identifier of this resource. Taken from the source system
* `title` *string* - Name of this resource
* `main_reference_number` *string* - Unique identifier assigned to the artwork upon acquisition
* `date_start` *number* - The year of the period of time associated with the creation of this work
* `date_end` *number* - The year of the period of time associated with the creation of this work
* `date_display` *string* - Readable, free-text description of the period of time associated with the creation of this work. This might include date terms like Dynasty, Era etc. Written by curators and editors in house style, and is the preferred field for display on websites and apps.
* `description` *string* - Longer explanation describing the work
* `artist_display` *string* - Readable description of the creator of this work. Includes artist names, nationality and lifespan dates
* `department` *string* - Name of the curatorial department that this work belongs to
* `department_id` *number* - Unique identifier of the curatorial department that this work belongs to
* `dimensions` *string* - The size, shape, scale, and dimensions of the work. May include multiple dimension like overall, frame, or dimension for each section of a work. Free-form text formatted in a house style.
* `medium` *string* - The substances or materials used in the creation of a work
* `inscriptions` *string* - A description of distinguishing or identifying physical markings that are on the work
* `object_type` *string* - The kind of object or work, e.g., Painting, Sculpture, Book, etc.
* `object_type_id` *number* - Unique identifier of the kind of object or work
* `credit_line` *string* - Brief statement indicating how the work came into the collection
* `publication_history` *string* - Bibliographic list of all the places this work has been published
* `exhibition_history` *string* - List of all the places this work has been exhibited
* `provenance_text` *string* - Ownership/collecting history of the work. May include names of owners, dates, and possibly methods of transfer of ownership. Free-form text formatted in a house style.
* `publishing_verification_level` *string* - Indicator of how much metadata on the work in published. Web Basic is the least amount, Web Everything is the greatest.
* `is_public_domain` *boolean* - Whether the work is in the public domain, meaning it was created before copyrights existed or has left the copyright term
* `copyright_notice` *string* - Statement notifying how the work is protected by copyright. Applies to the work itself, not image or other related assets.
* `place_of_origin` *string* - The location where the creation, design, or production of the work took place, or the original location of the work
* `collection_status` *string* - The works status of belonging to our collection. Values include 'Permanent Collection', 'Ryerson Collection', and 'Long-term Loan'.
* `gallery` *string* - The location of this work in our museum
* `gallery_id` *number* - Unique identifier of the location of this work in our museum
* `is_in_gallery` *boolean* - Whether the work is on display
* `latitude` *number* - Latitude coordinate of the location of this work in our galleries
* `longitude` *number* - Longitude coordinate of the location of this work in our galleries
* `latlon` *string* - Latitude and longitude coordinates of the location of this work in our galleries
* `is_highlighted_in_mobile` *boolean* - Whether the work is highlighted in the mobile app
* `selector_number` *number* - The code that can be entered in our audioguides to learn more about this work
* `artist_ids` *array* - Unique identifiers of the artists associated with this work
* `category_ids` *array* - Unique identifiers of the categories this work is a part of
* `copyright_representative_ids` *array* - Unique identifiers of the copyright representatives associated with this work
* `part_ids` *array* - Unique identifiers of the individual works that make up this work
* `set_ids` *array* - Unique identifiers of the sets this work is a part of. These are not artwork ids.
* `date_dates` *array* - List of all the dates associated with this work. Includes creation dates, and may also include publication dates for works on paper, exhibition dates for provenance, found dates for archaeological finds, etc.
* `catalogue_titles` *array* - A catalogue raisonné is a comprehensive, annotated listing of all the known artworks by an artist. This list represents all the catalogues this work is included in. This isn't an exhaustive list of publications where the work has been mentioned. For that, see `publication_history`.
* `committee_titles` *array* - List of committees which were involved in the acquisition or deaccession of this work
* `term_titles` *array* - The names of the taxonomy tags for this work
* `preferred_image_id` *uuid* - Unique identifier of the preferred image to use to represent this work
* `preferred_image_iiif_url` *string* - IIIF URL of the preferred image to use to represent this work
* `image_ids` *array* - Unique identifiers of all the images of this work. The order of this list will not correspond to the order of `image_iiif_urls`.
* `image_iiif_urls` *array* - IIIF URLs of all the images of this work. The order of this list will not correspond to the order of `image_ids`.
* `tour_ids` *array* - Unique identifiers of the tours this work is included in
* `site_ids` *array* - Unique identifiers of the microsites this work is a part of
* `last_updated_fedora` *ISO 8601 date and time* - Date and time the resource was updated in LAKE, our digital asset management system
* `last_updated_source` *string* - Date and time the resource was updated in the LAKE LPM Solr index, which is our direct source of data
* `last_updated` *ISO 8601 date and time* - Date and time the resource was updated in the Data Aggregator



## Agents

Represents a person or organization. In the API, this includes artists, venues, and copyright representatives. For a description of all the endpoints available for this resource, see [here](ENDPOINTS.md#agents).

* `id` *number* - Unique identifier of this resource. Taken from the source system
* `title` *string* - Name of this resource
* `birth_date` *number* - The year this agent was born
* `birth_place` *string* - Name of the place this agent was born
* `death_date` *number* - The year this agent died
* `death_place` *string* - Name of the place this agent died
* `is_licensing_restricted` *boolean* - Whether the use of the images of works by this artist are restricted by licensing
* `is_artist` *boolean* - Whether the agent is an artist. Soley based on whether the agent is listed as an artist for an artwork record.
* `agent_type` *string* - Name of the type of agent, e.g., individual, fund, school, organization, corporate body, etc.
* `agent_type_id` *number* - Unique identifier of the type of agent
* `site_ids` *array* - Unique identifiers of the microsites this exhibition is a part of
* `last_updated_fedora` *ISO 8601 date and time* - Date and time the resource was updated in LAKE, our digital asset management system
* `last_updated_source` *string* - Date and time the resource was updated in the LAKE LPM Solr index, which is our direct source of data
* `last_updated` *ISO 8601 date and time* - Date and time the resource was updated in the Data Aggregator



## Departments

Represents a curatorial department in the museum. For a description of all the endpoints available for this resource, see [here](ENDPOINTS.md#departments).

* `id` *number* - Unique identifier of this resource. Taken from the source system
* `title` *string* - Name of this resource
* `last_updated_fedora` *ISO 8601 date and time* - Date and time the resource was updated in LAKE, our digital asset management system
* `last_updated_source` *string* - Date and time the resource was updated in the LAKE LPM Solr index, which is our direct source of data
* `last_updated` *ISO 8601 date and time* - Date and time the resource was updated in the Data Aggregator



## Object Types

A kind of object or work, e.g., Painting, Sculpture, Book, etc. For a description of all the endpoints available for this resource, see [here](ENDPOINTS.md#object-types).

* `id` *number* - Unique identifier of this resource. Taken from the source system
* `title` *string* - Name of this resource
* `last_updated_fedora` *ISO 8601 date and time* - Date and time the resource was updated in LAKE, our digital asset management system
* `last_updated_source` *string* - Date and time the resource was updated in the LAKE LPM Solr index, which is our direct source of data
* `last_updated` *ISO 8601 date and time* - Date and time the resource was updated in the Data Aggregator



## Categories

Tag-like classifications of artworks and other resources. For a description of all the endpoints available for this resource, see [here](ENDPOINTS.md#categories).

* `id` *number* - Unique identifier of this resource. Taken from the source system
* `title` *string* - Name of this resource
* `parent_id` *number* - Unique identifier of this category's parent
* `is_in_nav` *boolean* - Whether this category was included in the departmental navigation in the old collections site
* `description` *string* - Explanation of what this category is
* `sort` *number* - Number representing this category's sort order
* `type` *number* - Number representing the type of category. 1 is departmental, 2 is subject, 3 is theme, 5 is multimedia.
* `last_updated_fedora` *ISO 8601 date and time* - Date and time the resource was updated in LAKE, our digital asset management system
* `last_updated_source` *string* - Date and time the resource was updated in the LAKE LPM Solr index, which is our direct source of data
* `last_updated` *ISO 8601 date and time* - Date and time the resource was updated in the Data Aggregator



## Agent Types

A kind of agent, e.g. Individual, Couple, School, Estate, Culture. For a description of all the endpoints available for this resource, see [here](ENDPOINTS.md#agent-types).

* `id` *number* - Unique identifier of this resource. Taken from the source system
* `title` *string* - Name of this resource
* `last_updated_fedora` *ISO 8601 date and time* - Date and time the resource was updated in LAKE, our digital asset management system
* `last_updated_source` *string* - Date and time the resource was updated in the LAKE LPM Solr index, which is our direct source of data
* `last_updated` *ISO 8601 date and time* - Date and time the resource was updated in the Data Aggregator



## Galleries

A room or hall that works of art are displayed in. For a description of all the endpoints available for this resource, see [here](ENDPOINTS.md#galleries).

* `id` *number* - Unique identifier of this resource. Taken from the source system
* `title` *string* - Name of this resource
* `is_closed` *boolean* - Whether the gallery is currently closed
* `number` *string* - The gallery's room number. For 'Gallery 100A', this would be '100A'.
* `floor` *string* - The level the gallery is on, e.g., 1, 2, 3, or LL
* `latitude` *number* - Latitude coordinate of the center of the room
* `longitude` *number* - Longitude coordinate of the center of the room
* `latlon` *string* - Latitude and longitude coordinates of the center of the room
* `category_ids` *number* - Unique identifiers of the categories this gallery is a part of
* `last_updated_fedora` *ISO 8601 date and time* - Date and time the resource was updated in LAKE, our digital asset management system
* `last_updated_source` *string* - Date and time the resource was updated in the LAKE LPM Solr index, which is our direct source of data
* `last_updated` *ISO 8601 date and time* - Date and time the resource was updated in the Data Aggregator



## Exhibitions

An organized presentation and display of a selection of artworks. For a description of all the endpoints available for this resource, see [here](ENDPOINTS.md#exhibitions).

* `id` *number* - Unique identifier of this resource. Taken from the source system
* `title` *string* - Name of this resource
* `description` *string* - Explanation of what this exhibition is
* `type` *string* - The type of exhibition. In particular this notes whether the exhibition was only displayed at the Art Institute or whether it traveled to other venues, or whether it was
* `department` *string* - The name of the department that primarily organized the exhibition
* `department_id` *number* - Unique identifier of the department that primarily organized the exhibition
* `gallery` *string* - The name of the gallery that mainly housed the exhibition
* `gallery_id` *number* - Unique identifier of the gallery that mainly housed the exhibition
* `dates` *string* - A readable string of when the exhibition took place
* `is_active` *boolean* - Whether the exhibition is active
* `artwork_ids` *array* - Unique identifiers of the artworks that were part of the exhibition
* `venue_ids` *array* - Unique identifiers of the venue agent records representing who hosted the exhibition
* `site_ids` *array* - Unique identifiers of the microsites this exhibition is a part of
* `last_updated_fedora` *ISO 8601 date and time* - Date and time the resource was updated in LAKE, our digital asset management system
* `last_updated_source` *string* - Date and time the resource was updated in the LAKE LPM Solr index, which is our direct source of data
* `last_updated` *ISO 8601 date and time* - Date and time the resource was updated in the Data Aggregator



## Images

A pictorial representation of a collections resource, like an artwork, artist, exhibition, etc. For a description of all the endpoints available for this resource, see [here](ENDPOINTS.md#images).

* `id` *number* - Unique identifier of this resource. Taken from the source system
* `title` *string* - Name of this resource
* `type` *string* - Typs always takes one of the following values: image, link, sound, text, video
* `description` *string* - Explanation of what this asset is
* `content` *string* - Text of URL of the contents of this asset
* `category_ids` *array* - Unique identifier of the categories associated with this asset
* `artwork_ids` *array* - Unique identifiers of the artworks associated with this asset
* `artwork_titles` *array* - Names of the artworks associated with this asset
* `iiif_url` *url* - IIIF URL of this image
* `color` *object* - Dominant color of this image in HSL
* `fingerprint` *object* - Image hashes: aHash, dHash, pHash, wHash
* `last_updated_fedora` *ISO 8601 date and time* - Date and time the resource was updated in LAKE, our digital asset management system
* `last_updated_source` *string* - Date and time the resource was updated in the LAKE LPM Solr index, which is our direct source of data
* `last_updated` *ISO 8601 date and time* - Date and time the resource was updated in the Data Aggregator



## Videos

A moving image representation of a collections resource, like an artwork, artist, exhibition, etc. For a description of all the endpoints available for this resource, see [here](ENDPOINTS.md#videos).

* `id` *number* - Unique identifier of this resource. Taken from the source system
* `title` *string* - Name of this resource
* `type` *string* - Typs always takes one of the following values: image, link, sound, text, video
* `description` *string* - Explanation of what this asset is
* `content` *string* - Text of URL of the contents of this asset
* `category_ids` *array* - Unique identifier of the categories associated with this asset
* `artwork_ids` *array* - Unique identifiers of the artworks associated with this asset
* `artwork_titles` *array* - Names of the artworks associated with this asset
* `last_updated_fedora` *ISO 8601 date and time* - Date and time the resource was updated in LAKE, our digital asset management system
* `last_updated_source` *string* - Date and time the resource was updated in the LAKE LPM Solr index, which is our direct source of data
* `last_updated` *ISO 8601 date and time* - Date and time the resource was updated in the Data Aggregator



## Links

A website that represents a collections resource, like an artwork, artist, exhibition, etc. For a description of all the endpoints available for this resource, see [here](ENDPOINTS.md#links).

* `id` *number* - Unique identifier of this resource. Taken from the source system
* `title` *string* - Name of this resource
* `type` *string* - Typs always takes one of the following values: image, link, sound, text, video
* `description` *string* - Explanation of what this asset is
* `content` *string* - Text of URL of the contents of this asset
* `category_ids` *array* - Unique identifier of the categories associated with this asset
* `artwork_ids` *array* - Unique identifiers of the artworks associated with this asset
* `artwork_titles` *array* - Names of the artworks associated with this asset
* `last_updated_fedora` *ISO 8601 date and time* - Date and time the resource was updated in LAKE, our digital asset management system
* `last_updated_source` *string* - Date and time the resource was updated in the LAKE LPM Solr index, which is our direct source of data
* `last_updated` *ISO 8601 date and time* - Date and time the resource was updated in the Data Aggregator



## Sounds

Audio that represents a collections resource, like an artwork, artist, exhibition, etc. For a description of all the endpoints available for this resource, see [here](ENDPOINTS.md#sounds).

* `id` *number* - Unique identifier of this resource. Taken from the source system
* `title` *string* - Name of this resource
* `type` *string* - Typs always takes one of the following values: image, link, sound, text, video
* `description` *string* - Explanation of what this asset is
* `content` *string* - Text of URL of the contents of this asset
* `category_ids` *array* - Unique identifier of the categories associated with this asset
* `artwork_ids` *array* - Unique identifiers of the artworks associated with this asset
* `artwork_titles` *array* - Names of the artworks associated with this asset
* `last_updated_fedora` *ISO 8601 date and time* - Date and time the resource was updated in LAKE, our digital asset management system
* `last_updated_source` *string* - Date and time the resource was updated in the LAKE LPM Solr index, which is our direct source of data
* `last_updated` *ISO 8601 date and time* - Date and time the resource was updated in the Data Aggregator



## Texts

Text that represents a collections resource, like an artwork, artist, exhibition, etc. For a description of all the endpoints available for this resource, see [here](ENDPOINTS.md#texts).

* `id` *number* - Unique identifier of this resource. Taken from the source system
* `title` *string* - Name of this resource
* `type` *string* - Typs always takes one of the following values: image, link, sound, text, video
* `description` *string* - Explanation of what this asset is
* `content` *string* - Text of URL of the contents of this asset
* `category_ids` *array* - Unique identifier of the categories associated with this asset
* `artwork_ids` *array* - Unique identifiers of the artworks associated with this asset
* `artwork_titles` *array* - Names of the artworks associated with this asset
* `last_updated_fedora` *ISO 8601 date and time* - Date and time the resource was updated in LAKE, our digital asset management system
* `last_updated_source` *string* - Date and time the resource was updated in the LAKE LPM Solr index, which is our direct source of data
* `last_updated` *ISO 8601 date and time* - Date and time the resource was updated in the Data Aggregator



# Shop

## Shop Categories

Tag-like classifications of shop products. For a description of all the endpoints available for this resource, see [here](ENDPOINTS.md#shop-categories).

* `id` - Unique identifier of this resource. Taken from the source system.
* `title` *string* - Name of this resource
* `link` *url* - URL to the shop page for this category
* `parent_id` *number* - Unique identifier of this category's parent
* `type` *string* - The type of category, e.g., sale, place-of-origin, style, etc.
* `source_id` *number* - The identifier from the source system. This is only unique relative to the type of category, so we don't use this as the primary identifier.
* `child_ids` *array* - Unique identifiers of this category's children
* `last_updated_source` *string* - Date and time the resource was updated in the source system
* `last_updated` *string* - Date and time the resource was updated in the Data Aggregator



## Products

An item available for purchase in the museum shop. For a description of all the endpoints available for this resource, see [here](ENDPOINTS.md#products).

* `id` - Unique identifier of this resource. Taken from the source system.
* `title` *string* - Name of this resource
* `title_display` *string* - HTML prettified version of the title
* `sku` *string* - Numeric product identification code of a machine-readable bar code
* `link` *url* - URL to the item in the shop
* `image` *url* - URL of an image for this product
* `description` *string* - Explanation of what this product is
* `is_on_sale` *boolean* - Whether this product us on sale
* `priority` *number* - Used for sorting in the shop website, specifically in the "Featured" sort mode, which is the default. This sort mode is two-part: first, items are sorted by their `priority` ascending; then as a secondary step, items are sorted by the number of items sold, descending.
* `price` *number* - Number indicating how much the product costs the customer
* `review_count` *number* - Number indicating how many reviews this product has
* `item_sold` *number* - Number indicating how many items of this product have been sold
* `rating` *number* - Floating number representing the average rating this product has received
* `category_ids` *array* - Unique identifier of the categories associated with this product
* `last_updated_source` *string* - Date and time the resource was updated in the source system
* `last_updated` *string* - Date and time the resource was updated in the Data Aggregator



# Events and Membership

## Events

An occurrence of a program at the museum. For a description of all the endpoints available for this resource, see [here](ENDPOINTS.md#events).

* `id` - Unique identifier of this resource. Taken from the source system.
* `title` *string* - Name of this resource
* `description` *string* - Long description of the event
* `short_description` *string* - Short description of the event
* `image` *url* - URL to an image representing this event
* `type` *string* - The name of the type of event
* `start_at` *ISO 8601 date and time* - Date and time the event begins
* `end_at` *ISO 8601 date and time* - Date and time the event ends
* `resource_id` *number* - Unique identifier of the resource associated with this event, often the venue in which it takes place
* `resource_title` *string* - The name of the resource associated with this event, often the venue in which it takes place
* `is_after_hours` *boolean* - Whether the event takes place after museum hours
* `is_private_event` *boolean* - Whether the event is open to public
* `is_admission_required` *boolean* - Whether admission is required in order to attend the event
* `is_ticketed` *boolean* - Whether a ticket is required to attend the event.
* `available` *number* - Number indicating how many tickets are available for the event
* `total_capacity` *number* - Number indicating the total number of tickets that can be sold for the event
* `exhibition_ids` *array* - Unique identifiers of the exhibitions associated with this work
* `last_updated_source` *string* - Date and time the resource was updated in the source system
* `last_updated` *string* - Date and time the resource was updated in the Data Aggregator



## Members

A member of the museum

* `id` - Unique identifier of this resource. Taken from the source system.
* `item_id` - Unique identifier indicating the type of membership
* `item_name` - The name of the type of membership
* `item_description` - Explanation of what the type of membership is
* `status` - Number indicating the status of the membership
* `status_description` - Explanation of the status of the membership
* `category` - Unique identifier of the category associated with this membership
* `sub_category` - Unique identifier of the subcategory associated with this membership
* `date_opened` - Date and time the membership was first created
* `date_used` - Date and time the membership was last used
* `valid_days` - Number indicating for how many more days the membership will be valid
* `valid_until` - Date and time of when the membership will become invalid
* `members` - An array representing each person associated with this membership. Fields include:
  * `id` - Unique identifier of this person on the membership
  * `member_type` - Number representing the type of member this person is
  * `primary` - Whether this person is the primary member
  * `status` - Number indicating the status of this person on the membership
  * `status_description` - Explanation of the status of this person on the membership
  * `relationship_type_id` - Unique identifier of the type of relationship this person has with the primary member
  * `relationship_description` - Explanation of the type of relationship this person has with the primary member
  * `job_title` - This person's job title
  * `name_title_id` - Unique identifier of this person's title, e.g., Ms., Miss, Mrs., Mr., etc.
  * `first_name` - This person's first name
  * `middle_name` - This person's middle name
  * `last_name` - This person's last name
  * `name_suffix_id` - Unique identifier of this person's suffix, e.g., Jr., III, etc.
  * `street_1` - First line of street address
  * `street_2` - Second line of street address, if needed
  * `street_3` - Third line of street address, if needed
  * `city` - The name of the city this person resides in
  * `state` - The name of the state this person resides in
  * `zip` - The zip code this person resides in
  * `country` - The name of the country this person resides in
  * `phone` - This person's phone number
  * `fax` - This person's fax number, if available
  * `cell` - This person's cell number, if available
  * `email` - This person's email address, if available
  * `allow_email` - Whether this person has stated it's okay to send them email
  * `allow_mailings` - Whether this person has stated it's okay to send them postal mailings
  * `date_of_birth` - Date this person was born
  * `age_group` - Number indicating this person's age group
  * `gender` - Number indicating this person's gender


# Mobile

## Tours

A collection of audio tour stops to form a tour. For a description of all the endpoints available for this resource, see [here](ENDPOINTS.md#tours).

* `id` - Unique identifier of this resource. Taken from the source system.
* `title` *string* - Name of this resource
* `image` *url* - The main image for the tour
* `description` *string* - Explanation of what the tour is
* `intro` *string* - Text introducing the tour
* `weight` *number* - Number representing this tour's sort order
* `intro_link` *url* - Link to the audio file of the introduction
* `intro_transcript` *string* - Transcript of the introduction audio to the tour
* `last_updated_source` *string* - Date and time the resource was updated in the source system
* `last_updated` *string* - Date and time the resource was updated in the Data Aggregator



## Tour Stops

An audio tour stops on a tour. For a description of all the endpoints available for this resource, see [here](ENDPOINTS.md#tour-stops).

* `id` - Unique identifier of this resource. Taken from the source system.
* `title` *string* - Name of this resource
* `title` *string* - Name of this tour stop
* `artwork` *string* - Name of the artwork for this tour stop
* `artwork_id` *number* - Unique identifier of the artwork for this tour stop
* `mobile_sound` *url* - URL to the audio file for this tour stop
* `mobile_sound_id` *number* - Unique identifier of the audio file for this tour stop
* `weight` *number* - Number representing this tour stop's sort order
* `last_updated_source` *string* - Date and time the resource was updated in the source system
* `last_updated` *string* - Date and time the resource was updated in the Data Aggregator



## Mobile Sounds

The audio file for a stops on a tour. For a description of all the endpoints available for this resource, see [here](ENDPOINTS.md#mobile-sounds).

* `id` - Unique identifier of this resource. Taken from the source system.
* `title` *string* - Name of this resource
* `link` *url* - URL to the audio file
* `transcript` *string* - Text transcription of the audio file
* `last_updated_source` *string* - Date and time the resource was updated in the source system
* `last_updated` *string* - Date and time the resource was updated in the Data Aggregator



# Digital Scholarly Catalogs

## Publications

Represents an overall digital publication. For a description of all the endpoints available for this resource, see [here](ENDPOINTS.md#publications).

* `id` - Unique identifier of this resource. Taken from the source system.
* `title` *string* - Name of this resource
* `web_url` *string* - URL to the publication
* `site` *string* - Which site in our multi-site Drupal installation owns this publication
* `alias` *string* - Used by Drupal in lieu of the id to generate pretty paths
* `title` *string* - Official title of the publication
* `section_ids` *array* - Unique identifiers of the sections of this publication
* `last_updated_source` *string* - Date and time the resource was updated in the source system
* `last_updated` *string* - Date and time the resource was updated in the Data Aggregator



## Sections

Represents a chapter of publication. For a description of all the endpoints available for this resource, see [here](ENDPOINTS.md#sections).

* `id` - Unique identifier of this resource. Taken from the source system.
* `title` *string* - Name of this resource
* `web_url` *string* - URL to the section
* `accession` *string* - An accession number parsed from the title or tombstone
* `revision` *number* - Version identifier as provided by Drupal
* `source_id` *number* - Drupal node id, unique only within the site of this publication
* `weight` *number* - Number representing this section's sort order
* `parent_id` *number* - Uniquer identifier of the parent section
* `publication` *string* - Name of the publication this section belongs to
* `publication_id` *number* - Unique identifier of the publication this section belongs to
* `artwork_id` *number* - Unique identifier of the artwork with which this section is associated
* `content` *string* - Content of this section in plaintext
* `last_updated_source` *string* - Date and time the resource was updated in the source system
* `last_updated` *string* - Date and time the resource was updated in the Data Aggregator



# Static Archive

## Sites

An archived static microsite. For a description of all the endpoints available for this resource, see [here](ENDPOINTS.md#sites).

* `id` - Unique identifier of this resource. Taken from the source system.
* `title` *string* - Name of this resource
* `description` *string* - Explanation of what this site is
* `web_url` *url* - URL to this site
* `exhibition_ids` *array* - Unique identifier of the exhibitions this site is associated with
* `artist_ids` *array* - Unique identifiers of the artists this site is associated with
* `artwork_ids` *array* - Unique identifiers of the artworks this site is associated with
* `last_updated_source` *string* - Date and time the resource was updated in the source system
* `last_updated` *string* - Date and time the resource was updated in the Data Aggregator



# Archive

## Archive Images

An image from the archives. For a description of all the endpoints available for this resource, see [here](ENDPOINTS.md#archive-images).

* `id` - Unique identifier of this resource. Taken from the source system.
* `title` *string* - Name of this resource
* `alternate_title` *string* - Alternate name of this image
* `web_url` *url* - URL to this image on the archives website
* `collection` *string* - Name of the collection this image is a part of
* `archive` *string* - Name of the archive within this collection this image is a part of
* `format` *string* - Physical format of the photograph
* `file_format` *string* - Format of the digital file
* `file_size` *number* - Number representing the size of the file in bytes
* `pixel_dimensions` *string* - Dimensions of the digital image
* `color` *string* - Color type. Values include Color, B&W and Toned
* `physical_notes` *string* - Notes about the photograph
* `date` *string* - Date of photograph
* `date_object` *string* - Date the subject of the photograph was designed or built
* `date_view` *string* -
* `creator` *string* - Name of the architect, designer or creator
* `additional_creator` *string* - Name of an additional architect, designer or creator
* `photographer` *string* - Name of person who took the photograph
* `main_id` *string* - Unique identifier used by the Archives for this image
* `legacy_image_id` *string* - Unique identifier used by Imaging for this image. Most of the these numbers of using their legacy ID schema.
* `subject_terms` *array* - Array of subject terms this image is tagged with
* `view` *string* - View of the object in the image
* `image_notes` *string* - Image description
* `file_name` *string* - Name of the digital image file
* `source_created_at` *ISO 8601 date and time* - Date the source record was created
* `source_modified_at` *ISO 8601 date and time* - Date the source record was modified
* `last_updated_source` *string* - Date and time the resource was updated in the source system
* `last_updated` *string* - Date and time the resource was updated in the Data Aggregator



# Library

## Library Materials

A library material, such as a book, journal, or video. For a description of all the endpoints available for this resource, see [here](ENDPOINTS.md#library-materials).

* `id` - Unique identifier of this resource. Taken from the source system.
* `title` *string* - Name of this resource
* `date` *number* - Publication year of this library material
* `last_updated_source` *string* - Date and time the resource was updated in the source system
* `last_updated` *string* - Date and time the resource was updated in the Data Aggregator



## Library Terms

A Library of Congress term. For a description of all the endpoints available for this resource, see [here](ENDPOINTS.md#library-terms).

* `id` - Unique identifier of this resource. Taken from the source system.
* `title` *string* - Name of this resource
* `uri` *string* - Full Library of Congress URI for identification
* `last_updated_source` *string* - Date and time the resource was updated in the source system
* `last_updated` *string* - Date and time the resource was updated in the Data Aggregator



> Generated by `php artisan docs:fields` on 2018-01-08 11:46:16
