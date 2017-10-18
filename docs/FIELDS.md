# Collections

## Artworks

Represents a work of art in our collections. For a description of all the endpoints available for this resource, see [here](ENDPOINTS.md#artworks).

* `id` - Unique identifier of this resource. Taken from the source system
* `title` - Name of this resource
* `main_reference_number` - Unique identifier assigned to the artwork upon acquisition
* `date_start` - The year of the period of time associated with the creation of this work
* `date_end` - The year of the period of time associated with the creation of this work
* `date_display` - Readable, free-text description of the period of time associated with the creation of this work. Written by curators and editors in house style, and is the preferred field for display on websites and apps.
* `description` - Longer explanation describing the work
* `artist_display` - Readable description of the creator of this work. Includes artist names, nationality and lifespan dates
* `department` - Name of the curatorial department that this work belongs to
* `department_id` - Unique identifier of the curatorial department that this work belongs to
* `dimensions` - The size, shape, scale, and dimensions of the work. Free-form text formatted in a house style.
* `medium` - The substances or materials used in the creation of a work
* `inscriptions` - A description of distinguishing or identifying physical markings that are a part of the work
* `object_type` - The kind of object or work, e.g., Painting, Sculpture, Book, etc.
* `object_type_id` - Unique identifier of the kind of object or work
* `credit_line` - Brief statement indicating how the work came into the collection
* `publication_history` - Bibliographic list of all the places this work has been published
* `exhibition_history` - List of all the places this work has been exhibited
* `provenance_text` - Ownership/collecting history of the work. May include names of owners, dates, and possibly methods of transfer of ownership
* `publishing_verification_level` - Indicator of how much metadata on the work in published. Web Basic is the least amount, Web Everything is the greatest.
* `is_public_domain` - Whether the work is in the public domain, meaning it was created before copyrights existed or has left the copyright term
* `copyright_notice` - Statement notifying how the work is protected by copyright. Applies to the work itself, not image or other related assets.
* `place_of_origin` - The location where the creation, design, or production of the work took place, or the original location of the work
* `collection_status` - The works status of belonging to our collection. Either 'Permanent Collection' or 'Long-term Loan'.
* `gallery` - The location of this work in our museum
* `gallery_id` - Unique identifier of the location of this work in our museum
* `is_in_gallery` - Whether the work is on display
* `latitude` - Latitude coordinate of the location of this work in our galleries
* `longitude` - Longitude coordinate of the location of this work in our galleries
* `latlon` - Latitude and longitude coordinates of the location of this work in our galleries
* `is_highlighted_in_mobile` - Whether the work is highlighted in the mobile app
* `selector_number` - The code that can be entered in our audioguides to learn more about this work
* `artist_ids` - Unique identifiers of the artists associated with this work
* `category_ids` - Unique identifiers of the categories this work is a part of
* `copyright_representative_ids` - Unique identifiers of the copyright representatives associated with this work
* `part_ids` - Unique identifiers of the individual works that make up this work
* `set_ids` - Unique identifiers of the sets this work is a part of. These are not artwork ids.
* `date_dates` - List of all the dates associated with this work. Includes creation dates, and may also include publication dates for works on paper, exhibition dates for provenance, found dates for archaeological finds, etc.
* `catalogue_titles` - A catalogue raisonné is a comprehensive, annotated listing of all the known artworks by an artist. This list represents all the catalogues this work is included in. This isn't an exhaustive list of publications where the work has been mentioned. For that, see `publication_history`.
* `committee_titles` - List of committees which were involved in the acquisition or deaccession of this work
* `term_titles` - The names of the subject terms tagged for this work
* `preferred_image_id` - Unique identifier of the preferred image to use to represent this work
* `preferred_image_iiif_url` - IIIF URL of the preferred image to use to represent this work
* `image_ids` - Unique identifiers of all the images of this work. The order of this list will not correspond to the order of `image_iiif_urls`.
* `image_iiif_urls` - IIIF URLs of all the images of this work. The order of this list will not correspond to the order of `image_ids`.
* `publication_ids` - Unique identifiers of the Digital Scholarly Catalogs this work is included in
* `tour_ids` - Unique identifiers of the tours this work is included in
* `last_updated_fedora` - Date and time the resource was updated in LAKE, our digital asset management system
* `last_updated_source` - Date and time the resource was updated in the LAKE LPM Solr index, which is our direct source of data
* `last_updated` - Date and time the resource was updated in the Data Aggregator



## Agents

Represents a person or organization. In the API, this includes artists, copyright representatives and corporate bodies. For a description of all the endpoints available for this resource, see [here](ENDPOINTS.md#agents).

* `id` - Unique identifier of this resource. Taken from the source system
* `title` - Name of this resource
* `birth_date` - The year this agent was born
* `birth_place` - Name of the place this agent was born
* `death_date` - The year this agent died
* `death_place` - Name of the place this agent died
* `is_licensing_restricted` - Whether the use of the images of works by this artist are restricted by licensing
* `agent_type` - Name of the type of agent, e.g., 'Artist', 'Copyright Representative', or 'Corporate Body'
* `agent_type_id` - Unique identifier of the type of agent
* `last_updated_fedora` - Date and time the resource was updated in LAKE, our digital asset management system
* `last_updated_source` - Date and time the resource was updated in the LAKE LPM Solr index, which is our direct source of data
* `last_updated` - Date and time the resource was updated in the Data Aggregator



## Artists

A person who created an artwork. This is a type of Agent. For a description of all the endpoints available for this resource, see [here](ENDPOINTS.md#artists).

## Venues

An organization like a museum. This is a type of Agent. For a description of all the endpoints available for this resource, see [here](ENDPOINTS.md#venues).

## Departments

Represents a curatorial department in the museum. For a description of all the endpoints available for this resource, see [here](ENDPOINTS.md#departments).

* `id` - Unique identifier of this resource. Taken from the source system
* `title` - Name of this resource
* `last_updated_fedora` - Date and time the resource was updated in LAKE, our digital asset management system
* `last_updated_source` - Date and time the resource was updated in the LAKE LPM Solr index, which is our direct source of data
* `last_updated` - Date and time the resource was updated in the Data Aggregator



## Object Types

A kind of object or work, e.g., Painting, Sculpture, Book, etc. For a description of all the endpoints available for this resource, see [here](ENDPOINTS.md#object-types).

* `id` - Unique identifier of this resource. Taken from the source system
* `title` - Name of this resource
* `last_updated_fedora` - Date and time the resource was updated in LAKE, our digital asset management system
* `last_updated_source` - Date and time the resource was updated in the LAKE LPM Solr index, which is our direct source of data
* `last_updated` - Date and time the resource was updated in the Data Aggregator



## Categories

Tag-like classifications of artworks and other resources. For a description of all the endpoints available for this resource, see [here](ENDPOINTS.md#categories).

* `id` - Unique identifier of this resource. Taken from the source system
* `title` - Name of this resource
* `parent_id` - Unique identifier of this category's parent
* `is_in_nav` - Whether this category was included in the departmental navigation in the old collections site
* `description` - Explanation of what this category is
* `sort` - Number representing this category's sort order
* `type` - Number representing the type of category. 1 is departmental, 2 is subject, 3 is theme, 5 is multimedia.
* `last_updated_fedora` - Date and time the resource was updated in LAKE, our digital asset management system
* `last_updated_source` - Date and time the resource was updated in the LAKE LPM Solr index, which is our direct source of data
* `last_updated` - Date and time the resource was updated in the Data Aggregator



## Agent Types

A kind of agent, e.g., Artist, Corporate Body, Copyright Representative, etc. For a description of all the endpoints available for this resource, see [here](ENDPOINTS.md#agent-types).

* `id` - Unique identifier of this resource. Taken from the source system
* `title` - Name of this resource
* `last_updated_fedora` - Date and time the resource was updated in LAKE, our digital asset management system
* `last_updated_source` - Date and time the resource was updated in the LAKE LPM Solr index, which is our direct source of data
* `last_updated` - Date and time the resource was updated in the Data Aggregator



## Galleries

A room or hall that works of art are displayed in. For a description of all the endpoints available for this resource, see [here](ENDPOINTS.md#galleries).

* `id` - Unique identifier of this resource. Taken from the source system
* `title` - Name of this resource
* `is_closed` - Whether the gallery is currently closed
* `number` - The gallery's room number. For 'Gallery 100', this would be '100'.
* `floor` - The level the gallery is on, e.g., 1, 2, 3, or LL
* `latitude` - Latitude coordinate of the center of the room
* `longitude` - Longitude coordinate of the center of the room
* `latlon` - Latitude and longitude coordinates of the center of the room
* `category_ids` - Unique identifiers of the categories this gallery is a part of
* `last_updated_fedora` - Date and time the resource was updated in LAKE, our digital asset management system
* `last_updated_source` - Date and time the resource was updated in the LAKE LPM Solr index, which is our direct source of data
* `last_updated` - Date and time the resource was updated in the Data Aggregator



## Exhibitions

An organized presentation and display of a selection of artworks. For a description of all the endpoints available for this resource, see [here](ENDPOINTS.md#exhibitions).

* `id` - Unique identifier of this resource. Taken from the source system
* `title` - Name of this resource
* `description` - Explanation of what this exhibition is
* `type` - The type of exhibition. In particular this notes whether the exhibition was only displayed at the Art Institute or whether it traveled to other venues, or whether it was
* `department` - The name of the department that primarily organized the exhibition
* `department_id` - Unique identifier of the department that primarily organized the exhibition
* `gallery` - The name of the gallery that mainly housed the exhibition
* `gallery_id` - Unique identifier of the gallery that mainly housed the exhibition
* `dates` - A readable string of when the exhibition took place
* `is_active` - Whether the exhibition is active
* `artwork_ids` - Unique identifiers of the artworks that were part of the exhibition
* `venue_ids` - Unique identifiers of the venue agent records representing who hosted the exhibition
* `last_updated_fedora` - Date and time the resource was updated in LAKE, our digital asset management system
* `last_updated_source` - Date and time the resource was updated in the LAKE LPM Solr index, which is our direct source of data
* `last_updated` - Date and time the resource was updated in the Data Aggregator



## Images

A pictorial representation of a collections resource, like an artwork, artist, exhibition, etc. For a description of all the endpoints available for this resource, see [here](ENDPOINTS.md#images).

* `id` - Unique identifier of this resource. Taken from the source system
* `title` - Name of this resource
* `description` - Explanation of what this asset is
* `content` - Text of URL of the contents of this asset
* `artist` - Name of the artist associated with this asset
* `artist_id` - Unique identifier of the artist associated with this asset
* `category_ids` - Unique identifier of the categories associated with this asset
* `iiif_url` - IIIF URL of this image
* `is_preferred` - Whether this is the preferred representation for a work of art
* `artwork_ids` - Unique identifiers of the artworks included in this image
* `artwork_titles` - The names of the artworks included in this image
* `last_updated_fedora` - Date and time the resource was updated in LAKE, our digital asset management system
* `last_updated_source` - Date and time the resource was updated in the LAKE LPM Solr index, which is our direct source of data
* `last_updated` - Date and time the resource was updated in the Data Aggregator



## Videos

A moving image representation of a collections resource, like an artwork, artist, exhibition, etc. For a description of all the endpoints available for this resource, see [here](ENDPOINTS.md#videos).

* `id` - Unique identifier of this resource. Taken from the source system
* `title` - Name of this resource
* `description` - Explanation of what this asset is
* `content` - Text of URL of the contents of this asset
* `artist` - Name of the artist associated with this asset
* `artist_id` - Unique identifier of the artist associated with this asset
* `category_ids` - Unique identifier of the categories associated with this asset
* `last_updated_fedora` - Date and time the resource was updated in LAKE, our digital asset management system
* `last_updated_source` - Date and time the resource was updated in the LAKE LPM Solr index, which is our direct source of data
* `last_updated` - Date and time the resource was updated in the Data Aggregator



## Links

A website that represents a collections resource, like an artwork, artist, exhibition, etc. For a description of all the endpoints available for this resource, see [here](ENDPOINTS.md#links).

* `id` - Unique identifier of this resource. Taken from the source system
* `title` - Name of this resource
* `description` - Explanation of what this asset is
* `content` - Text of URL of the contents of this asset
* `artist` - Name of the artist associated with this asset
* `artist_id` - Unique identifier of the artist associated with this asset
* `category_ids` - Unique identifier of the categories associated with this asset
* `last_updated_fedora` - Date and time the resource was updated in LAKE, our digital asset management system
* `last_updated_source` - Date and time the resource was updated in the LAKE LPM Solr index, which is our direct source of data
* `last_updated` - Date and time the resource was updated in the Data Aggregator



## Sounds

Audio that represents a collections resource, like an artwork, artist, exhibition, etc. For a description of all the endpoints available for this resource, see [here](ENDPOINTS.md#sounds).

* `id` - Unique identifier of this resource. Taken from the source system
* `title` - Name of this resource
* `description` - Explanation of what this asset is
* `content` - Text of URL of the contents of this asset
* `artist` - Name of the artist associated with this asset
* `artist_id` - Unique identifier of the artist associated with this asset
* `category_ids` - Unique identifier of the categories associated with this asset
* `last_updated_fedora` - Date and time the resource was updated in LAKE, our digital asset management system
* `last_updated_source` - Date and time the resource was updated in the LAKE LPM Solr index, which is our direct source of data
* `last_updated` - Date and time the resource was updated in the Data Aggregator



## Texts

Text that represents a collections resource, like an artwork, artist, exhibition, etc. For a description of all the endpoints available for this resource, see [here](ENDPOINTS.md#texts).

* `id` - Unique identifier of this resource. Taken from the source system
* `title` - Name of this resource
* `description` - Explanation of what this asset is
* `content` - Text of URL of the contents of this asset
* `artist` - Name of the artist associated with this asset
* `artist_id` - Unique identifier of the artist associated with this asset
* `category_ids` - Unique identifier of the categories associated with this asset
* `last_updated_fedora` - Date and time the resource was updated in LAKE, our digital asset management system
* `last_updated_source` - Date and time the resource was updated in the LAKE LPM Solr index, which is our direct source of data
* `last_updated` - Date and time the resource was updated in the Data Aggregator



# Shop

## Shop Categories

Tag-like classifications of shop products For a description of all the endpoints available for this resource, see [here](ENDPOINTS.md#shop-categories).

* `id` - Unique identifier of this resource. Taken from the source system.
* `title` - Name of this resource
* `link` - URL to the shop page for this category
* `parent_id` - Unique identifier of this category's parent
* `type` - The type of category, e.g., sale, place-of-origin, style, etc.
* `source_id` - The identifier from the source system. This is only unique relative to the type of category, so we don't use this as the primary identifier.
* `child_ids` - Unique identifier of this category's children
* `last_updated_source` - Date and time the resource was updated in the source system
* `last_updated` - Date and time the resource was updated in the Data Aggregator



## Products

An item available for purchase in the museum shop For a description of all the endpoints available for this resource, see [here](ENDPOINTS.md#products).

* `id` - Unique identifier of this resource. Taken from the source system.
* `title` - Name of this resource
* `title_display` - HTML prettified version of the title
* `sku` - Numeric product identification code of a machine-readable bar code
* `link` - URL to the item in the shop
* `image` - URL of an image for this product
* `description` - Explanation of what this product is
* `is_on_sale` - Whether this product us on sale
* `priority` - We are unclear as to the purpose of this numeric field
* `price` - Number indicating how much the product costs the customer
* `review_count` - Number indicating how many reviews this product has
* `item_sold` - Number indicating how many items of this product have been sold
* `rating` - Floating number representing the average rating this product has received
* `category_ids` - Unique identifier of the categories associated with this product
* `last_updated_source` - Date and time the resource was updated in the source system
* `last_updated` - Date and time the resource was updated in the Data Aggregator



# Events and Membership

## Events

An occurrence of a program at the museum For a description of all the endpoints available for this resource, see [here](ENDPOINTS.md#events).

* `id` - Unique identifier of this resource. Taken from the source system.
* `title` - Name of this resource
* `type_id` - Number indicating the type of event
* `start_at` - Date and time the event begins
* `end_at` - Date and time the event ends
* `resource_id` - Unique identifier of the resource associated with this event, often the venue in which it takes place
* `resource_title` - The name of the resource associated with this event, often the venue in which it takes place
* `is_after_hours` - Whether the event takes place after museum hours
* `is_private_event` - Whether the event is open to public
* `is_admission_required` - Whether admission is required in order to attend the event
* `available` - Number indicating how many tickets are available for the event
* `total_capacity` - Number indicating the total number of tickets that can be sold for the event
* `last_updated_source` - Date and time the resource was updated in the source system
* `last_updated` - Date and time the resource was updated in the Data Aggregator



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
* `title` - Name of this resource
* `image` - The main image for the tour
* `description` - Explanation of what the tour is
* `intro` - Text introducing the tour
* `weight` - Number representing this tour's sort order
* `intro_link` - Link to the audio file of the introduction
* `intro_transcript` - Transcript of the introduction audio to the tour
* `last_updated_source` - Date and time the resource was updated in the source system
* `last_updated` - Date and time the resource was updated in the Data Aggregator



## Tour Stops

An audio tour stops on a tour. For a description of all the endpoints available for this resource, see [here](ENDPOINTS.md#tour-stops).

* `id` - Unique identifier of this resource. Taken from the source system.
* `title` - Name of this tour stop
* `artwork` - Name of the artwork for this tour stop
* `artwork_id` - Unique identifier of the artwork for this tour stop
* `mobile_sound` - URL to the audio file for this tour stop
* `mobile_sound_id` - Unique identifier of the audio file for this tour stop
* `weight` - Number representing this tour stop's sort order
* `description` - Explanation of what this tour stop is
* `last_updated_source` - Date and time the resource was updated in the source system
* `last_updated` - Date and time the resource was updated in the Data Aggregator



## Mobile Sounds

The audio file for a stops on a tour. For a description of all the endpoints available for this resource, see [here](ENDPOINTS.md#mobile-sounds).

* `id` - Unique identifier of this resource. Taken from the source system.
* `title` - Name of this resource
* `link` - URL to the audio file
* `transcript` - Text transcription of the audio file
* `last_updated_source` - Date and time the resource was updated in the source system
* `last_updated` - Date and time the resource was updated in the Data Aggregator



# Digital Scholarly Catalogs

## Publications

Represents an overall digital publication. For a description of all the endpoints available for this resource, see [here](ENDPOINTS.md#publications).

* `id` - Unique identifier of this resource. Taken from the source system.
* `title` - Name of this resource
* `link` - URL to the publication
* `last_updated_source` - Date and time the resource was updated in the source system
* `last_updated` - Date and time the resource was updated in the Data Aggregator



## Sections

Represents a chapter of publication. For a description of all the endpoints available for this resource, see [here](ENDPOINTS.md#sections).

* `id` - Unique identifier of this resource. Taken from the source system.
* `title` - Name of this resource
* `content` - The text of this section
* `weight` - Number representing this section's sort order
* `depth` - Number representing how deep in the navigation hierarchy this section resides
* `publication` - Name of the publication this section belongs to
* `publication_id` - Unique identifier of the publication this section belongs to
* `last_updated_source` - Date and time the resource was updated in the source system
* `last_updated` - Date and time the resource was updated in the Data Aggregator



# Static Archive

## Sites

An archived static microsite. For a description of all the endpoints available for this resource, see [here](ENDPOINTS.md#sites).

* `id` - Unique identifier of this resource. Taken from the source system.
* `title` - Name of this resource
* `description` - Explanation of what this site is
* `link` - URL to this site
* `exhibition` - The name of the exhibition this site is associated with
* `exhibition_id` - Unique identifier of the exhibition this site is associated with
* `artwork_ids` - Unique identifiers of the artworks this site is associated with
* `last_updated_source` - Date and time the resource was updated in the source system
* `last_updated` - Date and time the resource was updated in the Data Aggregator



