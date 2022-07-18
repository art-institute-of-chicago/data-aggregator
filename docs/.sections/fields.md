## Fields

### Collections

#### Artworks

Represents a work of art in our collections. For a description of all the endpoints available for this resource, see [here](#artworks).

* `id` *integer* - Unique identifier of this resource. Taken from the source system.
* `api_model` *string* - REST API resource type or endpoint
* `api_link` *string* - REST API link for this resource
* `is_boosted` *boolean* - Whether this document should be boosted in search
* `title` *string* - The name of this resource
* `alt_titles` *array* - Alternate names for this work
* `thumbnail` *array* - Metadata about the image referenced by `image_id`. Currently, all thumbnails are IIIF images. You must build your own image URLs using IIIF Image API conventions. See our API documentation for more details.
* `main_reference_number` *string* - Unique identifier assigned to the artwork upon acquisition
* `has_not_been_viewed_much` *boolean* - Whether the artwork hasn't been visited on our website very much
* `boost_rank` *number* - Manual indication of what rank this artwork should take in search results. Noncontiguous.
* `date_start` *number* - The year of the period of time associated with the creation of this work
* `date_end` *number* - The year of the period of time associated with the creation of this work
* `date_display` *string* - Readable, free-text description of the period of time associated with the creation of this work. This might include date terms like Dynasty, Era etc. Written by curators and editors in house style, and is the preferred field for display on websites and apps. 
* `date_qualifier_title` *string* - Readable, text qualifer to the dates provided for this record.
* `date_qualifier_id` *integer* - Unique identifier of the qualifer to the dates provided for this record.
* `artist_display` *string* - Readable description of the creator of this work. Includes artist names, nationality and lifespan dates
* `place_of_origin` *string* - The location where the creation, design, or production of the work took place, or the original location of the work
* `dimensions` *string* - The size, shape, scale, and dimensions of the work. May include multiple dimensions like overall, frame, or dimension for each section of a work. Free-form text formatted in a house style.
* `medium_display` *string* - The substances or materials used in the creation of a work
* `inscriptions` *string* - A description of distinguishing or identifying physical markings that are on the work
* `credit_line` *string* - Brief statement indicating how the work came into the collection
* `publication_history` *string* - Bibliographic list of all the places this work has been published
* `exhibition_history` *string* - List of all the places this work has been exhibited
* `provenance_text` *string* - Ownership/collecting history of the work. May include names of owners, dates, and possibly methods of transfer of ownership. Free-form text formatted in a house style.
* `publishing_verification_level` *string* - Indicator of how much metadata on the work in published. Web Basic is the least amount, Web Everything is the greatest.
* `internal_department_id` *number* - An internal department id we use for analytics. Does not correspond to departments on the website.
* `fiscal_year` *number* - The fiscal year in which the work was acquired.
* `fiscal_year_deaccession` *number* - The fiscal year in which the work was deaccessioned.
* `is_public_domain` *boolean* - Whether the work is in the public domain, meaning it was created before copyrights existed or has left the copyright term
* `is_zoomable` *boolean* - Whether images of the work are allowed to be displayed in a zoomable interface.
* `max_zoom_window_size` *number* - The maximum size of the window the image is allowed to be viewed in, in pixels.
* `copyright_notice` *string* - Statement notifying how the work is protected by copyright. Applies to the work itself, not image or other related assets.
* `has_multimedia_resources` *boolean* - Whether this artwork has any associated microsites, digital publications, or documents tagged as multimedia
* `has_educational_resources` *boolean* - Whether this artwork has any documents tagged as educational
* `colorfulness` *float* - Unbounded positive float representing an abstract measure of colorfulness.
* `color` *object* - Dominant color of this artwork in HSL
* `latitude` *number* - Latitude coordinate of the location of this work in our galleries
* `longitude` *number* - Longitude coordinate of the location of this work in our galleries
* `latlon` *string* - Latitude and longitude coordinates of the location of this work in our galleries
* `is_on_view` *boolean* - Whether the work is on display
* `on_loan_display` *string* - If an artwork is on loan, this contains details about the loan
* `gallery_title` *string* - The location of this work in our museum
* `gallery_id` *number* - Unique identifier of the location of this work in our museum
* `artwork_type_title` *string* - The kind of object or work (e.g. Painting, Sculpture, Book)
* `artwork_type_id` *number* - Unique identifier of the kind of object or work
* `department_title` *string* - Name of the curatorial department that this work belongs to
* `department_id` *number* - Unique identifier of the curatorial department that this work belongs to
* `artist_id` *integer* - Unique identifier of the preferred artist/culture associated with this work
* `artist_title` *string* - Name of the preferred artist/culture associated with this work
* `alt_artist_ids` *array* - Unique identifiers of the non-preferred artists/cultures associated with this work
* `artist_ids` *integer* - Unique identifier of all artist/cultures associated with this work
* `artist_titles` *array* - Names of all artist/cultures associated with this work
* `category_ids` *array* - Unique identifiers of the categories this work is a part of
* `category_titles` *array* - Names of the categories this artwork is a part of
* `artwork_catalogue_ids` *array* - This list represents all the catalogues this work is included in. This isn't an exhaustive list of publications where the work has been mentioned. For that, see `publication_history`.
* `term_titles` *array* - The names of the taxonomy tags for this work
* `style_id` *string* - Unique identifier of the preferred style term for this work
* `style_title` *string* - The name of the preferred style term for this work
* `alt_style_ids` *array* - Unique identifiers of all other non-preferred style terms for this work
* `style_ids` *array* - Unique identifiers of all style terms for this work
* `style_titles` *array* - The names of all style terms related to this artwork
* `classification_id` *string* - Unique identifier of the preferred classification term for this work
* `classification_title` *string* - The name of the preferred classification term for this work
* `alt_classification_ids` *array* - Unique identifiers of all other non-preferred classification terms for this work
* `classification_ids` *array* - Unique identifiers of all classification terms for this work
* `classification_titles` *array* - The names of all classification terms related to this artwork
* `subject_id` *string* - Unique identifier of the preferred subject term for this work
* `alt_subject_ids` *array* - Unique identifiers of all other non-preferred subject terms for this work
* `subject_ids` *array* - Unique identifiers of all subject terms for this work
* `subject_titles` *array* - The names of all subject terms related to this artwork
* `material_id` *string* - Unique identifier of the preferred material term for this work
* `alt_material_ids` *array* - Unique identifiers of all other non-preferred material terms for this work
* `material_ids` *array* - Unique identifiers of all material terms for this work
* `material_titles` *array* - The names of all material terms related to this artwork
* `technique_id` *string* - Unique identifier of the preferred technique term for this work
* `alt_technique_ids` *array* - Unique identifiers of all other non-preferred technique terms for this work
* `technique_ids` *array* - Unique identifiers of all technique terms for this work
* `technique_titles` *array* - The names of all technique terms related to this artwork
* `theme_titles` *array* - The names of all thematic publish categories related to this artwork
* `image_id` *uuid* - Unique identifier of the preferred image to use to represent this work
* `alt_image_ids` *array* - Unique identifiers of all non-preferred images of this work.
* `document_ids` *array* - Unique identifiers of assets that serve as documentation for this artwork
* `sound_ids` *uuid* - Unique identifiers of the audio about this work
* `video_ids` *uuid* - Unique identifiers of the videos about this work
* `text_ids` *uuid* - Unique identifiers of the texts about this work
* `section_ids` *array* - Unique identifiers of the digital publication chapters this work in included in
* `section_titles` *array* - Names of the digital publication chapters this work is included in
* `site_ids` *array* - Unique identifiers of the microsites this work is a part of
* `suggest_autocomplete_boosted` *object* - Internal field to power the `/autocomplete` endpoint. Do not use directly.
* `suggest_autocomplete_all` *object* - Internal field to power the `/autosuggest` endpoint. Do not use directly.
* `source_updated_at` *ISO 8601 date and time* - Date and time the resource was updated in the source system
* `updated_at` *ISO 8601 date and time* - Date and time the record was updated in the aggregator database
* `timestamp` *ISO 8601 date and time* - Date and time the record was updated in the aggregator search index



#### Agents

Represents a person or organization. In the API, this includes artists. For a description of all the endpoints available for this resource, see [here](#agents).

* `id` *integer* - Unique identifier of this resource. Taken from the source system.
* `api_model` *string* - REST API resource type or endpoint
* `api_link` *string* - REST API link for this resource
* `title` *string* - The name of this resource
* `sort_title` *string* - Sortable name for this agent, typically with last name first.
* `alt_titles` *array* - Alternate names for this agent
* `birth_date` *number* - The year this agent was born
* `death_date` *number* - The year this agent died
* `description` *string* - A biographical description of the agent
* `ulan_id` *number* - Unique identifier of this agent in Getty's ULAN
* `is_artist` *boolean* - Whether the agent is an artist. Solely based on whether the agent is listed as an artist for an artwork record.
* `agent_type_title` *string* - Name of the type of agent, e.g. individual, fund, school, organization, etc.
* `agent_type_id` *number* - Unique identifier of the type of agent, e.g. individual, fund, school, organization, etc.
* `artwork_ids` *array* - Unique identifiers of the works this artist created.
* `site_ids` *array* - Unique identifiers of the microsites this exhibition is a part of
* `suggest_autocomplete_boosted` *object* - Internal field to power the `/autocomplete` endpoint. Do not use directly.
* `suggest_autocomplete_all` *object* - Internal field to power the `/autosuggest` endpoint. Do not use directly.
* `source_updated_at` *ISO 8601 date and time* - Date and time the resource was updated in the source system
* `updated_at` *ISO 8601 date and time* - Date and time the record was updated in the aggregator database
* `timestamp` *ISO 8601 date and time* - Date and time the record was updated in the aggregator search index



#### Places

A room or hall that works of art are displayed in. For a description of all the endpoints available for this resource, see [here](#places).

* `id` *integer* - Unique identifier of this resource. Taken from the source system.
* `api_model` *string* - REST API resource type or endpoint
* `api_link` *string* - REST API link for this resource
* `title` *string* - The name of this resource
* `tgn_id` *number* - Reconciled identifier of this object in the Getty's Thesauraus of Geographic Names (TGN)
* `suggest_autocomplete_boosted` *object* - Internal field to power the `/autocomplete` endpoint. Do not use directly.
* `suggest_autocomplete_all` *object* - Internal field to power the `/autosuggest` endpoint. Do not use directly.
* `source_updated_at` *ISO 8601 date and time* - Date and time the resource was updated in the source system
* `updated_at` *ISO 8601 date and time* - Date and time the record was updated in the aggregator database
* `timestamp` *ISO 8601 date and time* - Date and time the record was updated in the aggregator search index



#### Galleries

A room or hall that works of art are displayed in. For a description of all the endpoints available for this resource, see [here](#galleries).

* `id` *integer* - Unique identifier of this resource. Taken from the source system.
* `api_model` *string* - REST API resource type or endpoint
* `api_link` *string* - REST API link for this resource
* `title` *string* - The name of this resource
* `latitude` *number* - Latitude coordinate of the center of the room
* `longitude` *number* - Longitude coordinate of the center of the room
* `tgn_id` *number* - Reconciled identifier of this object in the Getty's Thesauraus of Geographic Names (TGN)
* `is_closed` *boolean* - Whether the gallery is currently closed
* `number` *string* - The gallery's room number. For "Gallery 100A", this would be "100A".
* `floor` *string* - The level the gallery is on, e.g., 1, 2, 3, or LL
* `latlon` *string* - Latitude and longitude coordinates of the center of the room
* `suggest_autocomplete_boosted` *object* - Internal field to power the `/autocomplete` endpoint. Do not use directly.
* `suggest_autocomplete_all` *object* - Internal field to power the `/autosuggest` endpoint. Do not use directly.
* `source_updated_at` *ISO 8601 date and time* - Date and time the resource was updated in the source system
* `updated_at` *ISO 8601 date and time* - Date and time the record was updated in the aggregator database
* `timestamp` *ISO 8601 date and time* - Date and time the record was updated in the aggregator search index



#### Exhibitions

An organized presentation and display of a selection of artworks. For a description of all the endpoints available for this resource, see [here](#exhibitions).

* `id` *integer* - Unique identifier of this resource. Taken from the source system.
* `api_model` *string* - REST API resource type or endpoint
* `api_link` *string* - REST API link for this resource
* `title` *string* - The name of this resource
* `is_featured` *boolean* - Is this exhibition currently featured on our website?
* `short_description` *string* - Brief explanation of what this exhibition is
* `web_url` *string* - URL to this exhibition on our website
* `image_url` *string* - URL to the hero image from the website
* `status` *string* - Whether the exhibition is open or closed
* `aic_start_at` *ISO 8601 date and time* - Date the exhibition opened at the Art Institute of Chicago
* `aic_end_at` *ISO 8601 date and time* - Date the exhibition closed at the Art Institute of Chicago
* `gallery_id` *number* - Unique identifier of the gallery that mainly housed the exhibition
* `gallery_title` *string* - The name of the gallery that mainly housed the exhibition
* `artwork_ids` *array* - Unique identifiers of the artworks that were part of the exhibition
* `artwork_titles` *array* - Names of the artworks that were part of the exhibition
* `artist_ids` *array* - Unique identifiers of the artist agent records representing who was shown in the exhibition
* `site_ids` *array* - Unique identifiers of the microsites this exhibition is a part of
* `image_id` *uuid* - Unique identifier of the preferred image to use to represent this exhibition
* `alt_image_ids` *array* - Unique identifiers of all non-preferred images of this exhibition.
* `document_ids` *array* - Unique identifiers of assets that serve as documentation for this exhibition
* `suggest_autocomplete_boosted` *object* - Internal field to power the `/autocomplete` endpoint. Do not use directly.
* `suggest_autocomplete_all` *object* - Internal field to power the `/autosuggest` endpoint. Do not use directly.
* `source_updated_at` *ISO 8601 date and time* - Date and time the resource was updated in the source system
* `updated_at` *ISO 8601 date and time* - Date and time the record was updated in the aggregator database
* `timestamp` *ISO 8601 date and time* - Date and time the record was updated in the aggregator search index



#### Agent Types

A kind of agent, e.g. Individual, Couple, School, Estate, Culture. For a description of all the endpoints available for this resource, see [here](#agent-types).

* `id` *integer* - Unique identifier of this resource. Taken from the source system.
* `api_model` *string* - REST API resource type or endpoint
* `api_link` *string* - REST API link for this resource
* `title` *string* - The name of this resource
* `suggest_autocomplete_boosted` *object* - Internal field to power the `/autocomplete` endpoint. Do not use directly.
* `suggest_autocomplete_all` *object* - Internal field to power the `/autosuggest` endpoint. Do not use directly.
* `source_updated_at` *ISO 8601 date and time* - Date and time the resource was updated in the source system
* `updated_at` *ISO 8601 date and time* - Date and time the record was updated in the aggregator database
* `timestamp` *ISO 8601 date and time* - Date and time the record was updated in the aggregator search index



#### Agent Roles

A qualifier for the relationship an agent may have to an artwork. For a description of all the endpoints available for this resource, see [here](#agent-roles).

* `id` *integer* - Unique identifier of this resource. Taken from the source system.
* `api_model` *string* - REST API resource type or endpoint
* `api_link` *string* - REST API link for this resource
* `title` *string* - The name of this resource
* `suggest_autocomplete_boosted` *object* - Internal field to power the `/autocomplete` endpoint. Do not use directly.
* `suggest_autocomplete_all` *object* - Internal field to power the `/autosuggest` endpoint. Do not use directly.
* `source_updated_at` *ISO 8601 date and time* - Date and time the resource was updated in the source system
* `updated_at` *ISO 8601 date and time* - Date and time the record was updated in the aggregator database
* `timestamp` *ISO 8601 date and time* - Date and time the record was updated in the aggregator search index



#### Agent Place Qualifiers

A qualifier for the relationship a place may have to an agent. For a description of all the endpoints available for this resource, see [here](#agent-place-qualifiers).

* `id` *integer* - Unique identifier of this resource. Taken from the source system.
* `api_model` *string* - REST API resource type or endpoint
* `api_link` *string* - REST API link for this resource
* `title` *string* - The name of this resource
* `suggest_autocomplete_boosted` *object* - Internal field to power the `/autocomplete` endpoint. Do not use directly.
* `suggest_autocomplete_all` *object* - Internal field to power the `/autosuggest` endpoint. Do not use directly.
* `source_updated_at` *ISO 8601 date and time* - Date and time the resource was updated in the source system
* `updated_at` *ISO 8601 date and time* - Date and time the record was updated in the aggregator database
* `timestamp` *ISO 8601 date and time* - Date and time the record was updated in the aggregator search index



#### Artwork Place Qualifiers

A qualifier for the relationship a place may have to an artwork. For a description of all the endpoints available for this resource, see [here](#artwork-place-qualifiers).

* `id` *integer* - Unique identifier of this resource. Taken from the source system.
* `api_model` *string* - REST API resource type or endpoint
* `api_link` *string* - REST API link for this resource
* `title` *string* - The name of this resource
* `suggest_autocomplete_boosted` *object* - Internal field to power the `/autocomplete` endpoint. Do not use directly.
* `suggest_autocomplete_all` *object* - Internal field to power the `/autosuggest` endpoint. Do not use directly.
* `source_updated_at` *ISO 8601 date and time* - Date and time the resource was updated in the source system
* `updated_at` *ISO 8601 date and time* - Date and time the record was updated in the aggregator database
* `timestamp` *ISO 8601 date and time* - Date and time the record was updated in the aggregator search index



#### Artwork Date Qualifiers

A kind of date on at artwork, e.g., Made, Reconstructed, Published, etc. For a description of all the endpoints available for this resource, see [here](#artwork-date-qualifiers).

* `id` *integer* - Unique identifier of this resource. Taken from the source system.
* `api_model` *string* - REST API resource type or endpoint
* `api_link` *string* - REST API link for this resource
* `title` *string* - The name of this resource
* `suggest_autocomplete_boosted` *object* - Internal field to power the `/autocomplete` endpoint. Do not use directly.
* `suggest_autocomplete_all` *object* - Internal field to power the `/autosuggest` endpoint. Do not use directly.
* `source_updated_at` *ISO 8601 date and time* - Date and time the resource was updated in the source system
* `updated_at` *ISO 8601 date and time* - Date and time the record was updated in the aggregator database
* `timestamp` *ISO 8601 date and time* - Date and time the record was updated in the aggregator search index



#### Catalogues

Represents a catalogue raisonne. A catalogue raisonné is a comprehensive, annotated listing of all the known artworks by an artist. For a description of all the endpoints available for this resource, see [here](#catalogues).

* `id` *integer* - Unique identifier of this resource. Taken from the source system.
* `api_model` *string* - REST API resource type or endpoint
* `api_link` *string* - REST API link for this resource
* `title` *string* - The name of this resource
* `suggest_autocomplete_boosted` *object* - Internal field to power the `/autocomplete` endpoint. Do not use directly.
* `suggest_autocomplete_all` *object* - Internal field to power the `/autosuggest` endpoint. Do not use directly.
* `source_updated_at` *ISO 8601 date and time* - Date and time the resource was updated in the source system
* `updated_at` *ISO 8601 date and time* - Date and time the record was updated in the aggregator database
* `timestamp` *ISO 8601 date and time* - Date and time the record was updated in the aggregator search index



#### Artwork Types

A kind of object or work, e.g., Painting, Sculpture, Book, etc. For a description of all the endpoints available for this resource, see [here](#artwork-types).

* `id` *integer* - Unique identifier of this resource. Taken from the source system.
* `api_model` *string* - REST API resource type or endpoint
* `api_link` *string* - REST API link for this resource
* `title` *string* - The name of this resource
* `aat_id` *integer* - Identifier of reconciled (most similar) term in the Getty's Art and Architecture Thesaurus (AAT)
* `suggest_autocomplete_boosted` *object* - Internal field to power the `/autocomplete` endpoint. Do not use directly.
* `suggest_autocomplete_all` *object* - Internal field to power the `/autosuggest` endpoint. Do not use directly.
* `source_updated_at` *ISO 8601 date and time* - Date and time the resource was updated in the source system
* `updated_at` *ISO 8601 date and time* - Date and time the record was updated in the aggregator database
* `timestamp` *ISO 8601 date and time* - Date and time the record was updated in the aggregator search index



#### Category Terms

Tag-like classifications of artworks and other resources. For a description of all the endpoints available for this resource, see [here](#category-terms).

* `id` *keyword* - Unique identifier of this resource. Taken from the source system.
* `api_model` *string* - REST API resource type or endpoint
* `api_link` *string* - REST API link for this resource
* `title` *string* - The name of this resource
* `subtype` *string* - Takes one of the following values: classification, material, technique, style, subject, department, theme
* `parent_id` *string* - Unique identifier of this category's parent
* `aat_id` *integer* - Identifier of reconciled (most similar) term in the Getty's Art and Architecture Thesaurus (AAT)
* `suggest_autocomplete_all` *object* - Internal field to power the `/autosuggest` endpoint. Do not use directly.
* `source_updated_at` *ISO 8601 date and time* - Date and time the resource was updated in the source system
* `updated_at` *ISO 8601 date and time* - Date and time the record was updated in the aggregator database
* `timestamp` *ISO 8601 date and time* - Date and time the record was updated in the aggregator search index



#### Images

A pictorial representation of a collections resource, like an artwork, artist, exhibition, etc. For a description of all the endpoints available for this resource, see [here](#images).

* `id` *keyword* - Unique identifier of this resource. Taken from the source system.
* `lake_guid` *uuid* - Unique UUID of this resource in LAKE, our DAMS.
* `api_model` *string* - REST API resource type or endpoint
* `api_link` *string* - REST API link for this resource
* `title` *string* - The name of this resource
* `type` *string* - Type always takes one of the following values: image, sound, text, video
* `alt_text` *string* - Alternative text for the asset to describe it to people with low or no vision
* `content` *string* - Text of or URL to the contents of this asset
* `is_multimedia_resource` *boolean* - Whether this resource is considered to be multimedia
* `is_educational_resource` *boolean* - Whether this resource is considered to be educational
* `is_teacher_resource` *boolean* - Whether this resource is considered to be educational
* `credit_line` *string* - Asset-specific copyright information
* `content_e_tag` *string* - Arbitrary unique identifier that changes when the binary file gets updated
* `iiif_url` *url* - IIIF URL of this image
* `width` *number* - Native width of the image
* `height` *number* - Native height of the image
* `lqip` *text* - Low-quality image placeholder (LQIP). Currently a 5x5-constrained, base64-encoded GIF.
* `colorfulness` *float* - Unbounded positive float representing an abstract measure of colorfulness.
* `color` *object* - Dominant color of this image in HSL
* `fingerprint` *object* - Image hashes: aHash, dHash, pHash, wHash
* `artwork_ids` *array* - Unique identifiers of the artworks associated with this asset
* `artwork_titles` *array* - Names of the artworks associated with this asset
* `suggest_autocomplete_boosted` *object* - Internal field to power the `/autocomplete` endpoint. Do not use directly.
* `suggest_autocomplete_all` *object* - Internal field to power the `/autosuggest` endpoint. Do not use directly.
* `source_updated_at` *ISO 8601 date and time* - Date and time the resource was updated in the source system
* `updated_at` *ISO 8601 date and time* - Date and time the record was updated in the aggregator database
* `timestamp` *ISO 8601 date and time* - Date and time the record was updated in the aggregator search index



#### Videos

A moving image representation of a collections resource, like an artwork, artist, exhibition, etc. For a description of all the endpoints available for this resource, see [here](#videos).

* `id` *keyword* - Unique identifier of this resource. Taken from the source system.
* `lake_guid` *uuid* - Unique UUID of this resource in LAKE, our DAMS.
* `api_model` *string* - REST API resource type or endpoint
* `api_link` *string* - REST API link for this resource
* `title` *string* - The name of this resource
* `type` *string* - Type always takes one of the following values: image, sound, text, video
* `alt_text` *string* - Alternative text for the asset to describe it to people with low or no vision
* `content` *string* - Text of or URL to the contents of this asset
* `is_multimedia_resource` *boolean* - Whether this resource is considered to be multimedia
* `is_educational_resource` *boolean* - Whether this resource is considered to be educational
* `is_teacher_resource` *boolean* - Whether this resource is considered to be educational
* `credit_line` *string* - Asset-specific copyright information
* `content_e_tag` *string* - Arbitrary unique identifier that changes when the binary file gets updated
* `artwork_ids` *array* - Unique identifiers of the artworks associated with this asset
* `artwork_titles` *array* - Names of the artworks associated with this asset
* `suggest_autocomplete_boosted` *object* - Internal field to power the `/autocomplete` endpoint. Do not use directly.
* `suggest_autocomplete_all` *object* - Internal field to power the `/autosuggest` endpoint. Do not use directly.
* `source_updated_at` *ISO 8601 date and time* - Date and time the resource was updated in the source system
* `updated_at` *ISO 8601 date and time* - Date and time the record was updated in the aggregator database
* `timestamp` *ISO 8601 date and time* - Date and time the record was updated in the aggregator search index



#### Sounds

Audio that represents a collections resource, like an artwork, artist, exhibition, etc. For a description of all the endpoints available for this resource, see [here](#sounds).

* `id` *keyword* - Unique identifier of this resource. Taken from the source system.
* `lake_guid` *uuid* - Unique UUID of this resource in LAKE, our DAMS.
* `api_model` *string* - REST API resource type or endpoint
* `api_link` *string* - REST API link for this resource
* `title` *string* - The name of this resource
* `type` *string* - Type always takes one of the following values: image, sound, text, video
* `alt_text` *string* - Alternative text for the asset to describe it to people with low or no vision
* `content` *string* - Text of or URL to the contents of this asset
* `is_multimedia_resource` *boolean* - Whether this resource is considered to be multimedia
* `is_educational_resource` *boolean* - Whether this resource is considered to be educational
* `is_teacher_resource` *boolean* - Whether this resource is considered to be educational
* `credit_line` *string* - Asset-specific copyright information
* `content_e_tag` *string* - Arbitrary unique identifier that changes when the binary file gets updated
* `artwork_ids` *array* - Unique identifiers of the artworks associated with this asset
* `artwork_titles` *array* - Names of the artworks associated with this asset
* `suggest_autocomplete_boosted` *object* - Internal field to power the `/autocomplete` endpoint. Do not use directly.
* `suggest_autocomplete_all` *object* - Internal field to power the `/autosuggest` endpoint. Do not use directly.
* `source_updated_at` *ISO 8601 date and time* - Date and time the resource was updated in the source system
* `updated_at` *ISO 8601 date and time* - Date and time the record was updated in the aggregator database
* `timestamp` *ISO 8601 date and time* - Date and time the record was updated in the aggregator search index



#### Texts

Text that represents a collections resource, like an artwork, artist, exhibition, etc. For a description of all the endpoints available for this resource, see [here](#texts).

* `id` *keyword* - Unique identifier of this resource. Taken from the source system.
* `lake_guid` *uuid* - Unique UUID of this resource in LAKE, our DAMS.
* `api_model` *string* - REST API resource type or endpoint
* `api_link` *string* - REST API link for this resource
* `title` *string* - The name of this resource
* `type` *string* - Type always takes one of the following values: image, sound, text, video
* `alt_text` *string* - Alternative text for the asset to describe it to people with low or no vision
* `content` *string* - Text of or URL to the contents of this asset
* `is_multimedia_resource` *boolean* - Whether this resource is considered to be multimedia
* `is_educational_resource` *boolean* - Whether this resource is considered to be educational
* `is_teacher_resource` *boolean* - Whether this resource is considered to be educational
* `credit_line` *string* - Asset-specific copyright information
* `content_e_tag` *string* - Arbitrary unique identifier that changes when the binary file gets updated
* `artwork_ids` *array* - Unique identifiers of the artworks associated with this asset
* `artwork_titles` *array* - Names of the artworks associated with this asset
* `suggest_autocomplete_boosted` *object* - Internal field to power the `/autocomplete` endpoint. Do not use directly.
* `suggest_autocomplete_all` *object* - Internal field to power the `/autosuggest` endpoint. Do not use directly.
* `source_updated_at` *ISO 8601 date and time* - Date and time the resource was updated in the source system
* `updated_at` *ISO 8601 date and time* - Date and time the record was updated in the aggregator database
* `timestamp` *ISO 8601 date and time* - Date and time the record was updated in the aggregator search index



### Shop

#### Products

An item available for purchase in the museum shop. For a description of all the endpoints available for this resource, see [here](#products).

* `id` *integer* - Unique identifier of this resource. Taken from the source system.
* `api_model` *string* - REST API resource type or endpoint
* `api_link` *string* - REST API link for this resource
* `title` *string* - The name of this resource
* `external_sku` *number* - Numeric product identification code of a machine-readable barcode, when the customer sku differs from our internal one
* `image_url` *url* - URL of an image for this product
* `web_url` *url* - URL of this product in the shop
* `description` *string* - Explanation of what this product is
* `price_display` *string* - Explanation of what this product is
* `min_compare_at_price` *number* - Number indicating how much the least expensive variant of a product cost before a sale
* `max_compare_at_price` *number* - Number indicating how much the most expensive variant of a product cost before a sale
* `min_current_price` *number* - Number indicating how much the least expensive variant of a product costs right now
* `max_current_price` *number* - Number indicating how much the most expensive variant of a product costs right now
* `artist_ids` *array* - Unique identifiers of the artists associated with this product
* `artwork_ids` *array* - Unique identifiers of the artworks associated with this product
* `exhibition_ids` *array* - Unique identifiers of the exhibitions associated with this product
* `suggest_autocomplete_boosted` *object* - Internal field to power the `/autocomplete` endpoint. Do not use directly.
* `suggest_autocomplete_all` *object* - Internal field to power the `/autosuggest` endpoint. Do not use directly.
* `source_updated_at` *ISO 8601 date and time* - Date and time the resource was updated in the source system
* `updated_at` *ISO 8601 date and time* - Date and time the record was updated in the aggregator database
* `timestamp` *ISO 8601 date and time* - Date and time the record was updated in the aggregator search index



### Mobile

#### Tours

A collection of audio tour stops to form a tour. For a description of all the endpoints available for this resource, see [here](#tours).

* `id` *integer* - Unique identifier of this resource. Taken from the source system.
* `api_model` *string* - REST API resource type or endpoint
* `api_link` *string* - REST API link for this resource
* `title` *string* - The name of this resource
* `image` *url* - The main image for the tour
* `description` *string* - Explanation of what the tour is
* `intro` *string* - Text introducing the tour
* `weight` *number* - Number representing this tour's sort order
* `intro_link` *url* - Link to the audio file of the introduction
* `intro_transcript` *string* - Transcript of the introduction audio to the tour
* `artwork_titles` *array* - Names of the artworks featured in this tour's tour stops
* `artist_titles` *array* - Names of the artists of the artworks featured in this tour's tour stops
* `suggest_autocomplete_boosted` *object* - Internal field to power the `/autocomplete` endpoint. Do not use directly.
* `suggest_autocomplete_all` *object* - Internal field to power the `/autosuggest` endpoint. Do not use directly.
* `source_updated_at` *ISO 8601 date and time* - Date and time the resource was updated in the source system
* `updated_at` *ISO 8601 date and time* - Date and time the record was updated in the aggregator database
* `timestamp` *ISO 8601 date and time* - Date and time the record was updated in the aggregator search index



#### Mobile Sounds

The audio file for a stop on a tour. For a description of all the endpoints available for this resource, see [here](#mobile-sounds).

* `id` *integer* - Unique identifier of this resource. Taken from the source system.
* `api_model` *string* - REST API resource type or endpoint
* `api_link` *string* - REST API link for this resource
* `title` *string* - Name of this mobile audio file – derived from the artwork and tour titles
* `web_url` *url* - URL to the audio file
* `transcript` *string* - Text transcription of the audio file
* `suggest_autocomplete_boosted` *object* - Internal field to power the `/autocomplete` endpoint. Do not use directly.
* `suggest_autocomplete_all` *object* - Internal field to power the `/autosuggest` endpoint. Do not use directly.
* `source_updated_at` *ISO 8601 date and time* - Date and time the resource was updated in the source system
* `updated_at` *ISO 8601 date and time* - Date and time the record was updated in the aggregator database
* `timestamp` *ISO 8601 date and time* - Date and time the record was updated in the aggregator search index



### Digital Scholarly Catalogs

#### Publications

Represents an overall digital publication. For a description of all the endpoints available for this resource, see [here](#publications).

* `id` *integer* - Unique identifier of this resource. Taken from the source system.
* `api_model` *string* - REST API resource type or endpoint
* `api_link` *string* - REST API link for this resource
* `title` *string* - The name of this resource
* `web_url` *string* - URL to the publication
* `section_ids` *array* - Unique identifiers of the sections of this publication
* `suggest_autocomplete_boosted` *object* - Internal field to power the `/autocomplete` endpoint. Do not use directly.
* `suggest_autocomplete_all` *object* - Internal field to power the `/autosuggest` endpoint. Do not use directly.
* `source_updated_at` *ISO 8601 date and time* - Date and time the resource was updated in the source system
* `updated_at` *ISO 8601 date and time* - Date and time the record was updated in the aggregator database
* `timestamp` *ISO 8601 date and time* - Date and time the record was updated in the aggregator search index



#### Sections

Represents a chapter of publication. For a description of all the endpoints available for this resource, see [here](#sections).

* `id` *long* - Unique identifier of this resource. Taken from the source system.
* `api_model` *string* - REST API resource type or endpoint
* `api_link` *string* - REST API link for this resource
* `title` *string* - The name of this resource
* `web_url` *string* - URL to the section
* `accession` *string* - An accession number parsed from the title or tombstone
* `generic_page_id` *number* - Unique identifier of the page on the website that represents the publication this section belongs to
* `artwork_id` *number* - Unique identifier of the artwork with which this section is associated
* `publication_title` *string* - Name of the publication this section belongs to
* `publication_id` *number* - Unique identifier of the publication this section belongs to
* `content` *string* - Content of this section in plaintext
* `suggest_autocomplete_boosted` *object* - Internal field to power the `/autocomplete` endpoint. Do not use directly.
* `suggest_autocomplete_all` *object* - Internal field to power the `/autosuggest` endpoint. Do not use directly.
* `source_updated_at` *ISO 8601 date and time* - Date and time the resource was updated in the source system
* `updated_at` *ISO 8601 date and time* - Date and time the record was updated in the aggregator database
* `timestamp` *ISO 8601 date and time* - Date and time the record was updated in the aggregator search index



### Static Archive

#### Sites

An archived static microsite. For a description of all the endpoints available for this resource, see [here](#sites).

* `id` *integer* - Unique identifier of this resource. Taken from the source system.
* `api_model` *string* - REST API resource type or endpoint
* `api_link` *string* - REST API link for this resource
* `title` *string* - The name of this resource
* `description` *string* - Explanation of what this site is
* `web_url` *url* - URL to this site
* `exhibition_ids` *array* - Unique identifier of the exhibitions this site is associated with
* `exhibition_titles` *array* - Names of the exhibitions this site is associated with
* `artist_ids` *array* - Unique identifiers of the artists this site is associated with
* `artist_titles` *array* - Names of the artists this site is associated with
* `artwork_ids` *array* - Unique identifiers of the artworks this site is associated with
* `artwork_titles` *array* - Names of the artworks this site is associated with
* `suggest_autocomplete_boosted` *object* - Internal field to power the `/autocomplete` endpoint. Do not use directly.
* `suggest_autocomplete_all` *object* - Internal field to power the `/autosuggest` endpoint. Do not use directly.
* `source_updated_at` *ISO 8601 date and time* - Date and time the resource was updated in the source system
* `updated_at` *ISO 8601 date and time* - Date and time the record was updated in the aggregator database
* `timestamp` *ISO 8601 date and time* - Date and time the record was updated in the aggregator search index



### Website

#### Closures

Closure on the website For a description of all the endpoints available for this resource, see [here](#closures).

* `id` *integer* - Unique identifier of this resource. Taken from the source system.
* `api_model` *string* - REST API resource type or endpoint
* `api_link` *string* - REST API link for this resource
* `title` *string* - The name of this resource
* `date_start` *ISO 8601 date and time* - The date the closure begins
* `date_end` *ISO 8601 date and time* - The date the closure ends
* `closure_copy` *string* - Description of the closure
* `type` *number* - Number indicating the type of closure
* `suggest_autocomplete_boosted` *object* - Internal field to power the `/autocomplete` endpoint. Do not use directly.
* `suggest_autocomplete_all` *object* - Internal field to power the `/autosuggest` endpoint. Do not use directly.
* `source_updated_at` *ISO 8601 date and time* - Date and time the resource was updated in the source system
* `updated_at` *ISO 8601 date and time* - Date and time the record was updated in the aggregator database
* `timestamp` *ISO 8601 date and time* - Date and time the record was updated in the aggregator search index



#### Web Exhibitions

An enhanced exhibition on the website For a description of all the endpoints available for this resource, see [here](#web-exhibitions).

* `id` *integer* - Unique identifier of this resource. Taken from the source system.
* `api_model` *string* - REST API resource type or endpoint
* `api_link` *string* - REST API link for this resource
* `title` *string* - The name of this resource
* `exhibition_id` *number* - Identifier of the CITI exhibition this website exhibition is tied to
* `is_featured` *boolean* - Is this exhibition currently featured on our website?
* `list_description` *string* - Short description to be used for exhibition listings
* `suggest_autocomplete_boosted` *object* - Internal field to power the `/autocomplete` endpoint. Do not use directly.
* `suggest_autocomplete_all` *object* - Internal field to power the `/autosuggest` endpoint. Do not use directly.
* `source_updated_at` *ISO 8601 date and time* - Date and time the resource was updated in the source system
* `updated_at` *ISO 8601 date and time* - Date and time the record was updated in the aggregator database
* `timestamp` *ISO 8601 date and time* - Date and time the record was updated in the aggregator search index



#### Events

An event on the website For a description of all the endpoints available for this resource, see [here](#events).

* `id` *integer* - Unique identifier of this resource. Taken from the source system.
* `api_model` *string* - REST API resource type or endpoint
* `api_link` *string* - REST API link for this resource
* `title` *string* - The name of this resource
* `title_display` *string* - The name of this event formatted with HTML (optional)
* `image_url` *string* - The URL of an image representing this page
* `hero_caption` *string* - Text displayed with the hero image on the event
* `short_description` *string* - Brief description of the event
* `header_description` *string* - Brief description of the event displayed below the title
* `list_description` *string* - One-sentence description of the event displayed in listings
* `description` *string* - All copytext of the event
* `location` *string* - Where the event takes place
* `event_type_id` *number* - Unique identifier indicating the preferred type of this event
* `alt_event_type_ids` *array* - Unique identifiers indicating the alternate types of this event
* `audience_id` *number* - Unique identifier indicating the preferred audience for this event
* `alt_audience_ids` *array* - Unique identifiers indicating the alternate audiences for this event
* `program_ids` *array* - Unique identifiers indicating the programs this event is a part of
* `program_titles` *array* - Titles of the programs this event is a part of
* `is_ticketed` *boolean* - Whether a ticket is required to attend the event
* `rsvp_link` *url* - The URL to the sales site for this event
* `buy_button_text` *string* - The text used on the ticket/registration button
* `buy_button_caption` *string* - Additional text below the ticket/registration button
* `is_registration_required` *boolean* - Whether registration is required to attend the event
* `is_member_exclusive` *boolean* - Whether the event is exclusive to members of the museum
* `is_sold_out` *boolean* - Whether the event is sold out
* `is_free` *boolean* - Whether the event is free
* `is_admission_required` *boolean* - Whether admission to the museum is required to attend this event
* `is_after_hours` *boolean* - Whether the event is to be held after the museum closes
* `is_virtual_event` *boolean* - Whether the event is being held virtually
* `start_date` *ISO 8601 date and time* - The date the event begins
* `end_date` *ISO 8601 date and time* - The date the event ends
* `start_time` *string* - The time the event starts
* `end_time` *string* - The time the event ends
* `date_display` *string* - A readable display of the event dates
* `door_time` *string* - The time the doors open for this event
* `layout_type` *number* - Number indicating the type of layout this event page uses
* `entrance` *string* - Which entrance to use for this event
* `join_url` *string* - URL to the membership signup page via this event
* `survey_url` *string* - URL to the survey associated with this event
* `event_host_id` *number* - Unique identifier of the host (cf. event programs) that is presenting this event
* `event_host_title` *string* - Unique identifier of the host (cf. event programs) that is presenting this event
* `sponsor_id` *number* - Unique identifier of the sponsor this website event is tied to
* `search_tags` *array* - Editor-specified list of tags to aid in internal search
* `suggest_autocomplete_boosted` *object* - Internal field to power the `/autocomplete` endpoint. Do not use directly.
* `suggest_autocomplete_all` *object* - Internal field to power the `/autosuggest` endpoint. Do not use directly.
* `source_updated_at` *ISO 8601 date and time* - Date and time the resource was updated in the source system
* `updated_at` *ISO 8601 date and time* - Date and time the record was updated in the aggregator database
* `timestamp` *ISO 8601 date and time* - Date and time the record was updated in the aggregator search index



#### Event Occurrences

An occurrence of an event on the website For a description of all the endpoints available for this resource, see [here](#event-occurrences).

* `id` *keyword* - Unique identifier of this resource. Taken from the source system.
* `api_model` *string* - REST API resource type or endpoint
* `api_link` *string* - REST API link for this resource
* `title` *string* - The name of this resource
* `event_id` *integer* - Identifier of the master event of which this is an occurrence
* `short_description` *string* - Brief description of the event
* `description` *string* - Description of the event
* `image_url` *string* - The URL of an image representing this page
* `is_private` *boolean* - Whether the event is private. Private events should be omitted from listings.
* `start_at` *ISO 8601 date and time* - The date the event occurrence begins
* `end_at` *ISO 8601 date and time* - The date the event occurrence ends
* `location` *string* - Where the event takes place
* `button_url` *url* - The URL to the sales site or an RSVP link for this event
* `button_text` *string* - The text used on the ticket/registration button
* `button_caption` *string* - Additional text below the ticket/registration button
* `suggest_autocomplete_boosted` *object* - Internal field to power the `/autocomplete` endpoint. Do not use directly.
* `suggest_autocomplete_all` *object* - Internal field to power the `/autosuggest` endpoint. Do not use directly.
* `source_updated_at` *ISO 8601 date and time* - Date and time the resource was updated in the source system
* `updated_at` *ISO 8601 date and time* - Date and time the record was updated in the aggregator database
* `timestamp` *ISO 8601 date and time* - Date and time the record was updated in the aggregator search index



#### Event Programs

An event on the website For a description of all the endpoints available for this resource, see [here](#event-programs).

* `id` *integer* - Unique identifier of this resource. Taken from the source system.
* `api_model` *string* - REST API resource type or endpoint
* `api_link` *string* - REST API link for this resource
* `title` *string* - The name of this resource
* `is_affiliate_group` *boolean* - Whether this program represents an affiliate group
* `is_event_host` *boolean* - Whether this program represents an event host
* `suggest_autocomplete_boosted` *object* - Internal field to power the `/autocomplete` endpoint. Do not use directly.
* `suggest_autocomplete_all` *object* - Internal field to power the `/autosuggest` endpoint. Do not use directly.
* `source_updated_at` *ISO 8601 date and time* - Date and time the resource was updated in the source system
* `updated_at` *ISO 8601 date and time* - Date and time the record was updated in the aggregator database
* `timestamp` *ISO 8601 date and time* - Date and time the record was updated in the aggregator search index



#### Articles

Article on the website For a description of all the endpoints available for this resource, see [here](#articles).

* `id` *integer* - Unique identifier of this resource. Taken from the source system.
* `api_model` *string* - REST API resource type or endpoint
* `api_link` *string* - REST API link for this resource
* `title` *string* - The name of this resource
* `date` *ISO 8601 date and time* - The date the article was published
* `copy` *string* - The text of the article
* `suggest_autocomplete_boosted` *object* - Internal field to power the `/autocomplete` endpoint. Do not use directly.
* `suggest_autocomplete_all` *object* - Internal field to power the `/autosuggest` endpoint. Do not use directly.
* `source_updated_at` *ISO 8601 date and time* - Date and time the resource was updated in the source system
* `updated_at` *ISO 8601 date and time* - Date and time the record was updated in the aggregator database
* `timestamp` *ISO 8601 date and time* - Date and time the record was updated in the aggregator search index



#### Highlights

Highlights are a grouping of artworks on the website For a description of all the endpoints available for this resource, see [here](#highlights).

* `id` *integer* - Unique identifier of this resource. Taken from the source system.
* `api_model` *string* - REST API resource type or endpoint
* `api_link` *string* - REST API link for this resource
* `title` *string* - The name of this resource
* `copy` *string* - The text of the highlight description
* `suggest_autocomplete_boosted` *object* - Internal field to power the `/autocomplete` endpoint. Do not use directly.
* `suggest_autocomplete_all` *object* - Internal field to power the `/autosuggest` endpoint. Do not use directly.
* `source_updated_at` *ISO 8601 date and time* - Date and time the resource was updated in the source system
* `updated_at` *ISO 8601 date and time* - Date and time the record was updated in the aggregator database
* `timestamp` *ISO 8601 date and time* - Date and time the record was updated in the aggregator search index



#### Web Artists

Article on the website For a description of all the endpoints available for this resource, see [here](#web-artists).

* `id` *integer* - Unique identifier of this resource. Taken from the source system.
* `api_model` *string* - REST API resource type or endpoint
* `api_link` *string* - REST API link for this resource
* `title` *string* - The name of this resource
* `intro_copy` *string* - Description of the artist
* `agent_id` *number* - Unique identifier of the CITI agent records this artist represents
* `suggest_autocomplete_boosted` *object* - Internal field to power the `/autocomplete` endpoint. Do not use directly.
* `suggest_autocomplete_all` *object* - Internal field to power the `/autosuggest` endpoint. Do not use directly.
* `source_updated_at` *ISO 8601 date and time* - Date and time the resource was updated in the source system
* `updated_at` *ISO 8601 date and time* - Date and time the record was updated in the aggregator database
* `timestamp` *ISO 8601 date and time* - Date and time the record was updated in the aggregator search index



#### Static Pages

Pages defined in the website code. For a description of all the endpoints available for this resource, see [here](#static-pages).

* `id` *integer* - Unique identifier of this resource. Taken from the source system.
* `api_model` *string* - REST API resource type or endpoint
* `api_link` *string* - REST API link for this resource
* `title` *string* - The name of this resource
* `web_url` *string* - The URL to this page on our website
* `suggest_autocomplete_boosted` *object* - Internal field to power the `/autocomplete` endpoint. Do not use directly.
* `suggest_autocomplete_all` *object* - Internal field to power the `/autosuggest` endpoint. Do not use directly.
* `source_updated_at` *ISO 8601 date and time* - Date and time the resource was updated in the source system
* `updated_at` *ISO 8601 date and time* - Date and time the record was updated in the aggregator database
* `timestamp` *ISO 8601 date and time* - Date and time the record was updated in the aggregator search index



#### Generic Pages

A generic page on the website For a description of all the endpoints available for this resource, see [here](#generic-pages).

* `id` *integer* - Unique identifier of this resource. Taken from the source system.
* `api_model` *string* - REST API resource type or endpoint
* `api_link` *string* - REST API link for this resource
* `title` *string* - The name of this resource
* `web_url` *string* - The URL to this page on our website
* `listing_description` *string* - A brief description of the page used in listings
* `short_description` *string* - A brief description of the page used in mobile and meta tags
* `copy` *string* - The text of the page
* `search_tags` *array* - Editor-specified list of tags to aid in internal search
* `suggest_autocomplete_boosted` *object* - Internal field to power the `/autocomplete` endpoint. Do not use directly.
* `suggest_autocomplete_all` *object* - Internal field to power the `/autosuggest` endpoint. Do not use directly.
* `source_updated_at` *ISO 8601 date and time* - Date and time the resource was updated in the source system
* `updated_at` *ISO 8601 date and time* - Date and time the record was updated in the aggregator database
* `timestamp` *ISO 8601 date and time* - Date and time the record was updated in the aggregator search index



#### Press Releases

A press release on the website For a description of all the endpoints available for this resource, see [here](#press-releases).

* `id` *integer* - Unique identifier of this resource. Taken from the source system.
* `api_model` *string* - REST API resource type or endpoint
* `api_link` *string* - REST API link for this resource
* `title` *string* - The name of this resource
* `web_url` *string* - The URL to this page on our website
* `listing_description` *string* - A brief description of the page used in listings
* `short_description` *string* - A brief description of the page used in mobile and meta tags
* `copy` *string* - The text of the page
* `suggest_autocomplete_boosted` *object* - Internal field to power the `/autocomplete` endpoint. Do not use directly.
* `suggest_autocomplete_all` *object* - Internal field to power the `/autosuggest` endpoint. Do not use directly.
* `source_updated_at` *ISO 8601 date and time* - Date and time the resource was updated in the source system
* `updated_at` *ISO 8601 date and time* - Date and time the record was updated in the aggregator database
* `timestamp` *ISO 8601 date and time* - Date and time the record was updated in the aggregator search index



#### Educator Resources

An educator resource on the website For a description of all the endpoints available for this resource, see [here](#educator-resources).

* `id` *integer* - Unique identifier of this resource. Taken from the source system.
* `api_model` *string* - REST API resource type or endpoint
* `api_link` *string* - REST API link for this resource
* `title` *string* - The name of this resource
* `web_url` *string* - The URL to this page on our website
* `listing_description` *string* - A brief description of the page used in listings
* `short_description` *string* - A brief description of the page used in mobile and meta tags
* `copy` *string* - The text of the page
* `suggest_autocomplete_boosted` *object* - Internal field to power the `/autocomplete` endpoint. Do not use directly.
* `suggest_autocomplete_all` *object* - Internal field to power the `/autosuggest` endpoint. Do not use directly.
* `source_updated_at` *ISO 8601 date and time* - Date and time the resource was updated in the source system
* `updated_at` *ISO 8601 date and time* - Date and time the record was updated in the aggregator database
* `timestamp` *ISO 8601 date and time* - Date and time the record was updated in the aggregator search index



#### Digital Catalogs

A digital catalog on the website For a description of all the endpoints available for this resource, see [here](#digital-catalogs).

* `id` *integer* - Unique identifier of this resource. Taken from the source system.
* `api_model` *string* - REST API resource type or endpoint
* `api_link` *string* - REST API link for this resource
* `title` *string* - The name of this resource
* `web_url` *string* - The URL to this page on our website
* `listing_description` *string* - A brief description of the page used in listings
* `short_description` *string* - A brief description of the page used in mobile and meta tags
* `copy` *string* - The text of the page
* `suggest_autocomplete_boosted` *object* - Internal field to power the `/autocomplete` endpoint. Do not use directly.
* `suggest_autocomplete_all` *object* - Internal field to power the `/autosuggest` endpoint. Do not use directly.
* `source_updated_at` *ISO 8601 date and time* - Date and time the resource was updated in the source system
* `updated_at` *ISO 8601 date and time* - Date and time the record was updated in the aggregator database
* `timestamp` *ISO 8601 date and time* - Date and time the record was updated in the aggregator search index



#### Digital Publication Sections

A digital catalog on the website For a description of all the endpoints available for this resource, see [here](#digital-publication-sections).

* `id` *integer* - Unique identifier of this resource. Taken from the source system.
* `api_model` *string* - REST API resource type or endpoint
* `api_link` *string* - REST API link for this resource
* `title` *string* - The name of this resource
* `web_url` *string* - The URL to this section on our website
* `listing_description` *string* - A brief description of the section used in listings
* `copy` *string* - The text of the section
* `date` *ISO 8601 date and time* - The date the section was published
* `author_display` *string* - A display-friendly text of the authors of this section
* `digital_publication_id` *number* - Unique identifier of the digital publication this section belongs to
* `suggest_autocomplete_boosted` *object* - Internal field to power the `/autocomplete` endpoint. Do not use directly.
* `suggest_autocomplete_all` *object* - Internal field to power the `/autosuggest` endpoint. Do not use directly.
* `source_updated_at` *ISO 8601 date and time* - Date and time the resource was updated in the source system
* `updated_at` *ISO 8601 date and time* - Date and time the record was updated in the aggregator database
* `timestamp` *ISO 8601 date and time* - Date and time the record was updated in the aggregator search index



#### Printed Catalogs

A printed catalog on the website For a description of all the endpoints available for this resource, see [here](#printed-catalogs).

* `id` *integer* - Unique identifier of this resource. Taken from the source system.
* `api_model` *string* - REST API resource type or endpoint
* `api_link` *string* - REST API link for this resource
* `title` *string* - The name of this resource
* `web_url` *string* - The URL to this page on our website
* `listing_description` *string* - A brief description of the page used in listings
* `short_description` *string* - A brief description of the page used in mobile and meta tags
* `copy` *string* - The text of the page
* `suggest_autocomplete_boosted` *object* - Internal field to power the `/autocomplete` endpoint. Do not use directly.
* `suggest_autocomplete_all` *object* - Internal field to power the `/autosuggest` endpoint. Do not use directly.
* `source_updated_at` *ISO 8601 date and time* - Date and time the resource was updated in the source system
* `updated_at` *ISO 8601 date and time* - Date and time the record was updated in the aggregator database
* `timestamp` *ISO 8601 date and time* - Date and time the record was updated in the aggregator search index



#### Issues

Article on the website For a description of all the endpoints available for this resource, see [here](#issues).

* `id` *integer* - Unique identifier of this resource. Taken from the source system.
* `api_model` *string* - REST API resource type or endpoint
* `api_link` *string* - REST API link for this resource
* `title` *string* - The name of this resource
* `date` *ISO 8601 date and time* - The date the article was published
* `copy` *string* - The text of the article
* `issue_number` *number* - The number of the issue
* `cite_as` *string* - How to cite the issue
* `suggest_autocomplete_boosted` *object* - Internal field to power the `/autocomplete` endpoint. Do not use directly.
* `suggest_autocomplete_all` *object* - Internal field to power the `/autosuggest` endpoint. Do not use directly.
* `source_updated_at` *ISO 8601 date and time* - Date and time the resource was updated in the source system
* `updated_at` *ISO 8601 date and time* - Date and time the record was updated in the aggregator database
* `timestamp` *ISO 8601 date and time* - Date and time the record was updated in the aggregator search index



#### Issue Articles

Article on the website For a description of all the endpoints available for this resource, see [here](#issue-articles).

* `id` *integer* - Unique identifier of this resource. Taken from the source system.
* `api_model` *string* - REST API resource type or endpoint
* `api_link` *string* - REST API link for this resource
* `title` *string* - The name of this resource
* `date` *ISO 8601 date and time* - The date the article was published
* `copy` *string* - The text of the article
* `issue_id` *number* - Unique identifier of the issue this article belongs to
* `cite_as` *string* - How to cite the issue
* `suggest_autocomplete_boosted` *object* - Internal field to power the `/autocomplete` endpoint. Do not use directly.
* `suggest_autocomplete_all` *object* - Internal field to power the `/autosuggest` endpoint. Do not use directly.
* `source_updated_at` *ISO 8601 date and time* - Date and time the resource was updated in the source system
* `updated_at` *ISO 8601 date and time* - Date and time the record was updated in the aggregator database
* `timestamp` *ISO 8601 date and time* - Date and time the record was updated in the aggregator search index



