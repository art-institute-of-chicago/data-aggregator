{
  "swagger": "2.0",
  "info": {
    "title": "Art Institution of Chicago API",
    "description": "An API for an aggregator of Art Institute of Chicago data",
    "termsOfService": "",
    "contact": {
      "email": "museumtechnology@artic.edu"
    },
    "license": {
      "name": ""
    },
    "version": "1.0.0"
  },
  "host": "{{ $host }}",
  "basePath": "/api/v1",
  "schemes": [
    "https"
  ],
  "paths": {
    "/api/v1/artworks": {
      "get": {
        "tags": [
          "artworks"
        ],
        "summary": "A list of all artworks sorted by last updated date in descending order",
        "produces": [
          "application/json"
        ],
        "parameters": [
          {
            "$ref": "#/parameters/ids"
          },
          {
            "$ref": "#/parameters/limit"
          },
          {
            "$ref": "#/parameters/page"
          }
        ],
        "responses": {
          "200": {
            "description": "Successful operation",
            "schema": {
              "type": "array",
              "items": {
                "$ref": "#/definitions/Artwork"
              }
            }
          },
          "default": {
            "description": "error",
            "schema": {
              "$ref": "#/definitions/Error"
            }
          }
        }
      }
    },
    "/api/v1/artworks/{id}": {
      "get": {
        "tags": [
          "artworks"
        ],
        "summary": "A single artwork by the given identifier",
        "produces": [
          "application/json"
        ],
        "parameters": [
          {
            "$ref": "#/parameters/id"
          }
        ],
        "responses": {
          "200": {
            "description": "Successful operation",
            "schema": {
              "items": {
                "$ref": "#/definitions/Artwork"
              }
            }
          },
          "default": {
            "description": "error",
            "schema": {
              "$ref": "#/definitions/Error"
            }
          }
        }
      }
    },
    "/api/v1/artworks/{id}/artists": {
      "get": {
        "tags": [
          "artworks"
        ],
        "summary": "The artists for a given artwork",
        "produces": [
          "application/json"
        ],
        "parameters": [
          {
            "$ref": "#/parameters/id"
          }
        ],
        "responses": {
          "200": {
            "description": "Successful operation",
            "schema": {
              "items": {
                "$ref": "#/definitions/Agent"
              }
            }
          },
          "default": {
            "description": "error",
            "schema": {
              "$ref": "#/definitions/Error"
            }
          }
        }
      }
    },
    "/api/v1/artworks/{id}/copyrightRepresentatives": {
      "get": {
        "tags": [
          "artworks"
        ],
        "summary": "The copyright representatives for a given artwork",
        "produces": [
          "application/json"
        ],
        "parameters": [
          {
            "$ref": "#/parameters/id"
          }
        ],
        "responses": {
          "200": {
            "description": "Successful operation",
            "schema": {
              "items": {
                "$ref": "#/definitions/Agent"
              }
            }
          },
          "default": {
            "description": "error",
            "schema": {
              "$ref": "#/definitions/Error"
            }
          }
        }
      }
    },
    "/api/v1/artworks/{id}/categories": {
      "get": {
        "tags": [
          "artworks"
        ],
        "summary": "A list of all publish categories for a given artwork",
        "produces": [
          "application/json"
        ],
        "parameters": [
          {
            "$ref": "#/parameters/id"
          }
        ],
        "responses": {
          "200": {
            "description": "Successful operation",
            "schema": {
              "type": "array",
              "items": {
                "$ref": "#/definitions/Category"
              }
            }
          },
          "default": {
            "description": "error",
            "schema": {
              "$ref": "#/definitions/Error"
            }
          }
        }
      }
    },
    "/api/v1/artworks/{id}/parts": {
      "get": {
        "tags": [
          "artworks"
        ],
        "summary": "A list of all parts for a given artwork",
        "produces": [
          "application/json"
        ],
        "parameters": [
          {
            "$ref": "#/parameters/id"
          }
        ],
        "responses": {
          "200": {
            "description": "Successful operation",
            "schema": {
              "type": "array",
              "items": {
                "$ref": "#/definitions/Artwork"
              }
            }
          },
          "default": {
            "description": "error",
            "schema": {
              "$ref": "#/definitions/Error"
            }
          }
        }
      }
    },
    "/api/v1/artworks/{id}/sets": {
      "get": {
        "tags": [
          "artworks"
        ],
        "summary": "A list of all sets for a given artwork",
        "produces": [
          "application/json"
        ],
        "parameters": [
          {
            "$ref": "#/parameters/id"
          }
        ],
        "responses": {
          "200": {
            "description": "Successful operation",
            "schema": {
              "type": "array",
              "items": {
                "$ref": "#/definitions/Artwork"
              }
            }
          },
          "default": {
            "description": "error",
            "schema": {
              "$ref": "#/definitions/Error"
            }
          }
        }
      }
    },
    "/api/v1/artworks/{id}/images": {
      "get": {
        "tags": [
          "artworks"
        ],
        "summary": "A list of all images for a given artwork",
        "produces": [
          "application/json"
        ],
        "parameters": [
          {
            "$ref": "#/parameters/id"
          }
        ],
        "responses": {
          "200": {
            "description": "Successful operation",
            "schema": {
              "type": "array",
              "items": {
                "$ref": "#/definitions/Image"
              }
            }
          },
          "default": {
            "description": "error",
            "schema": {
              "$ref": "#/definitions/Error"
            }
          }
        }
      }
    },
    "/api/v1/agents": {
      "get": {
        "tags": [
          "agents"
        ],
        "summary": "A list of all agents sorted by last updated date in descending order",
        "produces": [
          "application/json"
        ],
        "parameters": [
          {
            "$ref": "#/parameters/ids"
          },
          {
            "$ref": "#/parameters/limit"
          },
          {
            "$ref": "#/parameters/page"
          }
        ],
        "responses": {
          "200": {
            "description": "Successful operation",
            "schema": {
              "type": "array",
              "items": {
                "$ref": "#/definitions/Agent"
              }
            }
          },
          "default": {
            "description": "error",
            "schema": {
              "$ref": "#/definitions/Error"
            }
          }
        }
      }
    },
    "/api/v1/agents/{id}": {
      "get": {
        "tags": [
          "agents"
        ],
        "summary": "A single agent by the given identifier",
        "produces": [
          "application/json"
        ],
        "parameters": [
          {
            "$ref": "#/parameters/id"
          }
        ],
        "responses": {
          "200": {
            "description": "Successful operation",
            "schema": {
              "items": {
                "$ref": "#/definitions/Agent"
              }
            }
          },
          "default": {
            "description": "error",
            "schema": {
              "$ref": "#/definitions/Error"
            }
          }
        }
      }
    },
    "/api/v1/artists": {
      "get": {
        "tags": [
          "artists"
        ],
        "summary": "A list of all artists sorted by last updated date in descending order",
        "produces": [
          "application/json"
        ],
        "parameters": [
          {
            "$ref": "#/parameters/ids"
          },
          {
            "$ref": "#/parameters/limit"
          },
          {
            "$ref": "#/parameters/page"
          }
        ],
        "responses": {
          "200": {
            "description": "Successful operation",
            "schema": {
              "type": "array",
              "items": {
                "$ref": "#/definitions/Agent"
              }
            }
          },
          "default": {
            "description": "error",
            "schema": {
              "$ref": "#/definitions/Error"
            }
          }
        }
      }
    },
    "/api/v1/artists/{id}": {
      "get": {
        "tags": [
          "artists"
        ],
        "summary": "A single artist by the given identifier",
        "produces": [
          "application/json"
        ],
        "parameters": [
          {
            "$ref": "#/parameters/id"
          }
        ],
        "responses": {
          "200": {
            "description": "Successful operation",
            "schema": {
              "items": {
                "$ref": "#/definitions/Agent"
              }
            }
          },
          "default": {
            "description": "error",
            "schema": {
              "$ref": "#/definitions/Error"
            }
          }
        }
      }
    },
    "/api/v1/venues": {
      "get": {
        "tags": [
          "venues"
        ],
        "summary": "A list of all venues sorted by last updated date in descending order",
        "produces": [
          "application/json"
        ],
        "parameters": [
          {
            "$ref": "#/parameters/ids"
          },
          {
            "$ref": "#/parameters/limit"
          },
          {
            "$ref": "#/parameters/page"
          }
        ],
        "responses": {
          "200": {
            "description": "Successful operation",
            "schema": {
              "type": "array",
              "items": {
                "$ref": "#/definitions/Agent"
              }
            }
          },
          "default": {
            "description": "error",
            "schema": {
              "$ref": "#/definitions/Error"
            }
          }
        }
      }
    },
    "/api/v1/venues/{id}": {
      "get": {
        "tags": [
          "venues"
        ],
        "summary": "A single venue by the given identifier",
        "produces": [
          "application/json"
        ],
        "parameters": [
          {
            "$ref": "#/parameters/id"
          }
        ],
        "responses": {
          "200": {
            "description": "Successful operation",
            "schema": {
              "items": {
                "$ref": "#/definitions/Agent"
              }
            }
          },
          "default": {
            "description": "error",
            "schema": {
              "$ref": "#/definitions/Error"
            }
          }
        }
      }
    },
    "/api/v1/departments": {
      "get": {
        "tags": [
          "departments"
        ],
        "summary": "A list of all departments sorted by last updated date in descending order",
        "produces": [
          "application/json"
        ],
        "parameters": [
          {
            "$ref": "#/parameters/ids"
          },
          {
            "$ref": "#/parameters/limit"
          },
          {
            "$ref": "#/parameters/page"
          }
        ],
        "responses": {
          "200": {
            "description": "Successful operation",
            "schema": {
              "type": "array",
              "items": {
                "$ref": "#/definitions/Department"
              }
            }
          },
          "default": {
            "description": "error",
            "schema": {
              "$ref": "#/definitions/Error"
            }
          }
        }
      }
    },
    "/api/v1/departments/{id}": {
      "get": {
        "tags": [
          "departments"
        ],
        "summary": "A single department by the given identifier",
        "produces": [
          "application/json"
        ],
        "parameters": [
          {
            "$ref": "#/parameters/id"
          }
        ],
        "responses": {
          "200": {
            "description": "Successful operation",
            "schema": {
              "items": {
                "$ref": "#/definitions/Department"
              }
            }
          },
          "default": {
            "description": "error",
            "schema": {
              "$ref": "#/definitions/Error"
            }
          }
        }
      }
    },
    "/api/v1/object-types": {
      "get": {
        "tags": [
          "objectTypes"
        ],
        "summary": "A list of all object types sorted by last updated date in descending order",
        "produces": [
          "application/json"
        ],
        "parameters": [
          {
            "$ref": "#/parameters/ids"
          },
          {
            "$ref": "#/parameters/limit"
          },
          {
            "$ref": "#/parameters/page"
          }
        ],
        "responses": {
          "200": {
            "description": "Successful operation",
            "schema": {
              "type": "array",
              "items": {
                "$ref": "#/definitions/ObjectType"
              }
            }
          },
          "default": {
            "description": "error",
            "schema": {
              "$ref": "#/definitions/Error"
            }
          }
        }
      }
    },
    "/api/v1/object-types/{id}": {
      "get": {
        "tags": [
          "objectTypes"
        ],
        "summary": "A single object type by the given identifier",
        "produces": [
          "application/json"
        ],
        "parameters": [
          {
            "$ref": "#/parameters/id"
          }
        ],
        "responses": {
          "200": {
            "description": "Successful operation",
            "schema": {
              "items": {
                "$ref": "#/definitions/ObjectType"
              }
            }
          },
          "default": {
            "description": "error",
            "schema": {
              "$ref": "#/definitions/Error"
            }
          }
        }
      }
    },
    "/api/v1/categories": {
      "get": {
        "tags": [
          "categories"
        ],
        "summary": "A list of all publish categories sorted by last updated date in descending order",
        "produces": [
          "application/json"
        ],
        "parameters": [
          {
            "$ref": "#/parameters/ids"
          },
          {
            "$ref": "#/parameters/limit"
          },
          {
            "$ref": "#/parameters/page"
          }
        ],
        "responses": {
          "200": {
            "description": "Successful operation",
            "schema": {
              "type": "array",
              "items": {
                "$ref": "#/definitions/Category"
              }
            }
          },
          "default": {
            "description": "error",
            "schema": {
              "$ref": "#/definitions/Error"
            }
          }
        }
      }
    },
    "/api/v1/categories/{id}": {
      "get": {
        "tags": [
          "categories"
        ],
        "summary": "A single category by the given identifier",
        "produces": [
          "application/json"
        ],
        "parameters": [
          {
            "$ref": "#/parameters/id"
          }
        ],
        "responses": {
          "200": {
            "description": "Successful operation",
            "schema": {
              "items": {
                "$ref": "#/definitions/Category"
              }
            }
          },
          "default": {
            "description": "error",
            "schema": {
              "$ref": "#/definitions/Error"
            }
          }
        }
      }
    },
    "/api/v1/agent-types": {
      "get": {
        "tags": [
          "agentTypes"
        ],
        "summary": "A list of all agent types sorted by last updated date in descending order",
        "produces": [
          "application/json"
        ],
        "parameters": [
          {
            "$ref": "#/parameters/ids"
          },
          {
            "$ref": "#/parameters/limit"
          },
          {
            "$ref": "#/parameters/page"
          }
        ],
        "responses": {
          "200": {
            "description": "Successful operation",
            "schema": {
              "type": "array",
              "items": {
                "$ref": "#/definitions/AgentType"
              }
            }
          },
          "default": {
            "description": "error",
            "schema": {
              "$ref": "#/definitions/Error"
            }
          }
        }
      }
    },
    "/api/v1/agent-types/{id}": {
      "get": {
        "tags": [
          "agentTypes"
        ],
        "summary": "A single agent type by the given identifier",
        "produces": [
          "application/json"
        ],
        "parameters": [
          {
            "$ref": "#/parameters/id"
          }
        ],
        "responses": {
          "200": {
            "description": "Successful operation",
            "schema": {
              "items": {
                "$ref": "#/definitions/AgentType"
              }
            }
          },
          "default": {
            "description": "error",
            "schema": {
              "$ref": "#/definitions/Error"
            }
          }
        }
      }
    },
    "/api/v1/galleries": {
      "get": {
        "tags": [
          "galleries"
        ],
        "summary": "A list of all galleries sorted by last updated date in descending order",
        "produces": [
          "application/json"
        ],
        "parameters": [
          {
            "$ref": "#/parameters/ids"
          },
          {
            "$ref": "#/parameters/limit"
          },
          {
            "$ref": "#/parameters/page"
          }
        ],
        "responses": {
          "200": {
            "description": "Successful operation",
            "schema": {
              "type": "array",
              "items": {
                "$ref": "#/definitions/Gallery"
              }
            }
          },
          "default": {
            "description": "error",
            "schema": {
              "$ref": "#/definitions/Error"
            }
          }
        }
      }
    },
    "/api/v1/galleries/{id}": {
      "get": {
        "tags": [
          "galleries"
        ],
        "summary": "A single gallery by the given identifier",
        "produces": [
          "application/json"
        ],
        "parameters": [
          {
            "$ref": "#/parameters/id"
          }
        ],
        "responses": {
          "200": {
            "description": "Successful operation",
            "schema": {
              "items": {
                "$ref": "#/definitions/Gallery"
              }
            }
          },
          "default": {
            "description": "error",
            "schema": {
              "$ref": "#/definitions/Error"
            }
          }
        }
      }
    },
    "/api/v1/exhibitions": {
      "get": {
        "tags": [
          "exhibitions"
        ],
        "summary": "A list of all exhibitions sorted by last updated date in descending order",
        "produces": [
          "application/json"
        ],
        "parameters": [
          {
            "$ref": "#/parameters/ids"
          },
          {
            "$ref": "#/parameters/limit"
          },
          {
            "$ref": "#/parameters/page"
          }
        ],
        "responses": {
          "200": {
            "description": "Successful operation",
            "schema": {
              "type": "array",
              "items": {
                "$ref": "#/definitions/Exhibition"
              }
            }
          },
          "default": {
            "description": "error",
            "schema": {
              "$ref": "#/definitions/Error"
            }
          }
        }
      }
    },
    "/api/v1/exhibitions/{id}": {
      "get": {
        "tags": [
          "exhibitions"
        ],
        "summary": "A single exhibition by the given identifier",
        "produces": [
          "application/json"
        ],
        "parameters": [
          {
            "$ref": "#/parameters/id"
          }
        ],
        "responses": {
          "200": {
            "description": "Successful operation",
            "schema": {
              "items": {
                "$ref": "#/definitions/Exhibition"
              }
            }
          },
          "default": {
            "description": "error",
            "schema": {
              "$ref": "#/definitions/Error"
            }
          }
        }
      }
    },
    "/api/v1/exhibitions/{id}/artworks": {
      "get": {
        "tags": [
          "exhibitions"
        ],
        "summary": "The artworks for a given exhibition",
        "produces": [
          "application/json"
        ],
        "parameters": [
          {
            "$ref": "#/parameters/id"
          }
        ],
        "responses": {
          "200": {
            "description": "Successful operation",
            "schema": {
              "items": {
                "$ref": "#/definitions/Artwork"
              }
            }
          },
          "default": {
            "description": "error",
            "schema": {
              "$ref": "#/definitions/Error"
            }
          }
        }
      }
    },
    "/api/v1/exhibitions/{id}/venues": {
      "get": {
        "tags": [
          "exhibitions"
        ],
        "summary": "The venues for a given exhibition",
        "produces": [
          "application/json"
        ],
        "parameters": [
          {
            "$ref": "#/parameters/id"
          }
        ],
        "responses": {
          "200": {
            "description": "Successful operation",
            "schema": {
              "items": {
                "$ref": "#/definitions/Agent"
              }
            }
          },
          "default": {
            "description": "error",
            "schema": {
              "$ref": "#/definitions/Error"
            }
          }
        }
      }
    },
    "/api/v1/images": {
      "get": {
        "tags": [
          "images"
        ],
        "summary": "A list of all images sorted by last updated date in descending order",
        "produces": [
          "application/json"
        ],
        "parameters": [
          {
            "$ref": "#/parameters/ids"
          },
          {
            "$ref": "#/parameters/limit"
          },
          {
            "$ref": "#/parameters/page"
          }
        ],
        "responses": {
          "200": {
            "description": "Successful operation",
            "schema": {
              "type": "array",
              "items": {
                "$ref": "#/definitions/Image"
              }
            }
          },
          "default": {
            "description": "error",
            "schema": {
              "$ref": "#/definitions/Error"
            }
          }
        }
      }
    },
    "/api/v1/images/{id}": {
      "get": {
        "tags": [
          "images"
        ],
        "summary": "A single image by the given identifier",
        "produces": [
          "application/json"
        ],
        "parameters": [
          {
            "$ref": "#/parameters/id"
          }
        ],
        "responses": {
          "200": {
            "description": "Successful operation",
            "schema": {
              "items": {
                "$ref": "#/definitions/Image"
              }
            }
          },
          "default": {
            "description": "error",
            "schema": {
              "$ref": "#/definitions/Error"
            }
          }
        }
      }
    },
    "/api/v1/videos": {
      "get": {
        "tags": [
          "videos"
        ],
        "summary": "A list of all videos sorted by last updated date in descending order",
        "produces": [
          "application/json"
        ],
        "parameters": [
          {
            "$ref": "#/parameters/ids"
          },
          {
            "$ref": "#/parameters/limit"
          },
          {
            "$ref": "#/parameters/page"
          }
        ],
        "responses": {
          "200": {
            "description": "Successful operation",
            "schema": {
              "type": "array",
              "items": {
                "$ref": "#/definitions/Asset"
              }
            }
          },
          "default": {
            "description": "error",
            "schema": {
              "$ref": "#/definitions/Error"
            }
          }
        }
      }
    },
    "/api/v1/videos/{id}": {
      "get": {
        "tags": [
          "videos"
        ],
        "summary": "A single video by the given identifier",
        "produces": [
          "application/json"
        ],
        "parameters": [
          {
            "$ref": "#/parameters/id"
          }
        ],
        "responses": {
          "200": {
            "description": "Successful operation",
            "schema": {
              "items": {
                "$ref": "#/definitions/Asset"
              }
            }
          },
          "default": {
            "description": "error",
            "schema": {
              "$ref": "#/definitions/Error"
            }
          }
        }
      }
    },
    "/api/v1/links": {
      "get": {
        "tags": [
          "links"
        ],
        "summary": "A list of all links sorted by last updated date in descending order",
        "produces": [
          "application/json"
        ],
        "parameters": [
          {
            "$ref": "#/parameters/ids"
          },
          {
            "$ref": "#/parameters/limit"
          },
          {
            "$ref": "#/parameters/page"
          }
        ],
        "responses": {
          "200": {
            "description": "Successful operation",
            "schema": {
              "type": "array",
              "items": {
                "$ref": "#/definitions/Asset"
              }
            }
          },
          "default": {
            "description": "error",
            "schema": {
              "$ref": "#/definitions/Error"
            }
          }
        }
      }
    },
    "/api/v1/links/{id}": {
      "get": {
        "tags": [
          "links"
        ],
        "summary": "A single link by the given identifier",
        "produces": [
          "application/json"
        ],
        "parameters": [
          {
            "$ref": "#/parameters/id"
          }
        ],
        "responses": {
          "200": {
            "description": "Successful operation",
            "schema": {
              "items": {
                "$ref": "#/definitions/Asset"
              }
            }
          },
          "default": {
            "description": "error",
            "schema": {
              "$ref": "#/definitions/Error"
            }
          }
        }
      }
    },
    "/api/v1/sounds": {
      "get": {
        "tags": [
          "sounds"
        ],
        "summary": "A list of all sounds sorted by last updated date in descending order",
        "produces": [
          "application/json"
        ],
        "parameters": [
          {
            "$ref": "#/parameters/ids"
          },
          {
            "$ref": "#/parameters/limit"
          },
          {
            "$ref": "#/parameters/page"
          }
        ],
        "responses": {
          "200": {
            "description": "Successful operation",
            "schema": {
              "type": "array",
              "items": {
                "$ref": "#/definitions/Asset"
              }
            }
          },
          "default": {
            "description": "error",
            "schema": {
              "$ref": "#/definitions/Error"
            }
          }
        }
      }
    },
    "/api/v1/sounds/{id}": {
      "get": {
        "tags": [
          "sounds"
        ],
        "summary": "A single sound by the given identifier",
        "produces": [
          "application/json"
        ],
        "parameters": [
          {
            "$ref": "#/parameters/id"
          }
        ],
        "responses": {
          "200": {
            "description": "Successful operation",
            "schema": {
              "items": {
                "$ref": "#/definitions/Asset"
              }
            }
          },
          "default": {
            "description": "error",
            "schema": {
              "$ref": "#/definitions/Error"
            }
          }
        }
      }
    },
    "/api/v1/texts": {
      "get": {
        "tags": [
          "texts"
        ],
        "summary": "A list of all texts sorted by last updated date in descending order",
        "produces": [
          "application/json"
        ],
        "parameters": [
          {
            "$ref": "#/parameters/ids"
          },
          {
            "$ref": "#/parameters/limit"
          },
          {
            "$ref": "#/parameters/page"
          }
        ],
        "responses": {
          "200": {
            "description": "Successful operation",
            "schema": {
              "type": "array",
              "items": {
                "$ref": "#/definitions/Asset"
              }
            }
          },
          "default": {
            "description": "error",
            "schema": {
              "$ref": "#/definitions/Error"
            }
          }
        }
      }
    },
    "/api/v1/texts/{id}": {
      "get": {
        "tags": [
          "texts"
        ],
        "summary": "A single text by the given identifier",
        "produces": [
          "application/json"
        ],
        "parameters": [
          {
            "$ref": "#/parameters/id"
          }
        ],
        "responses": {
          "200": {
            "description": "Successful operation",
            "schema": {
              "items": {
                "$ref": "#/definitions/Asset"
              }
            }
          },
          "default": {
            "description": "error",
            "schema": {
              "$ref": "#/definitions/Error"
            }
          }
        }
      }
    },
    "/api/v1/shop-categories": {
      "get": {
        "tags": [
          "shopCategories"
        ],
        "summary": "A list of all shop categories sorted by last updated date in descending order",
        "produces": [
          "application/json"
        ],
        "parameters": [
          {
            "$ref": "#/parameters/ids"
          },
          {
            "$ref": "#/parameters/limit"
          },
          {
            "$ref": "#/parameters/page"
          }
        ],
        "responses": {
          "200": {
            "description": "Successful operation",
            "schema": {
              "type": "array",
              "items": {
                "$ref": "#/definitions/ShopCategory"
              }
            }
          },
          "default": {
            "description": "error",
            "schema": {
              "$ref": "#/definitions/Error"
            }
          }
        }
      }
    },
    "/api/v1/shop-categories/{id}": {
      "get": {
        "tags": [
          "shopCategories"
        ],
        "summary": "A single shop category by the given identifier",
        "produces": [
          "application/json"
        ],
        "parameters": [
          {
            "$ref": "#/parameters/id"
          }
        ],
        "responses": {
          "200": {
            "description": "Successful operation",
            "schema": {
              "items": {
                "$ref": "#/definitions/ShopCategory"
              }
            }
          },
          "default": {
            "description": "error",
            "schema": {
              "$ref": "#/definitions/Error"
            }
          }
        }
      }
    },
    "/api/v1/products": {
      "get": {
        "tags": [
          "products"
        ],
        "summary": "A list of all products sorted by last updated date in descending order",
        "produces": [
          "application/json"
        ],
        "parameters": [
          {
            "$ref": "#/parameters/ids"
          },
          {
            "$ref": "#/parameters/limit"
          },
          {
            "$ref": "#/parameters/page"
          }
        ],
        "responses": {
          "200": {
            "description": "Successful operation",
            "schema": {
              "type": "array",
              "items": {
                "$ref": "#/definitions/Product"
              }
            }
          },
          "default": {
            "description": "error",
            "schema": {
              "$ref": "#/definitions/Error"
            }
          }
        }
      }
    },
    "/api/v1/products/{id}": {
      "get": {
        "tags": [
          "products"
        ],
        "summary": "A single product by the given identifier",
        "produces": [
          "application/json"
        ],
        "parameters": [
          {
            "$ref": "#/parameters/id"
          }
        ],
        "responses": {
          "200": {
            "description": "Successful operation",
            "schema": {
              "items": {
                "$ref": "#/definitions/Product"
              }
            }
          },
          "default": {
            "description": "error",
            "schema": {
              "$ref": "#/definitions/Error"
            }
          }
        }
      }
    },
    "/api/v1/events": {
      "get": {
        "tags": [
          "events"
        ],
        "summary": "A list of all events sorted by last updated date in descending order",
        "produces": [
          "application/json"
        ],
        "parameters": [
          {
            "$ref": "#/parameters/ids"
          },
          {
            "$ref": "#/parameters/limit"
          },
          {
            "$ref": "#/parameters/page"
          }
        ],
        "responses": {
          "200": {
            "description": "Successful operation",
            "schema": {
              "type": "array",
              "items": {
                "$ref": "#/definitions/Event"
              }
            }
          },
          "default": {
            "description": "error",
            "schema": {
              "$ref": "#/definitions/Error"
            }
          }
        }
      }
    },
    "/api/v1/events/{id}": {
      "get": {
        "tags": [
          "events"
        ],
        "summary": "A single event by the given identifier",
        "produces": [
          "application/json"
        ],
        "parameters": [
          {
            "$ref": "#/parameters/id"
          }
        ],
        "responses": {
          "200": {
            "description": "Successful operation",
            "schema": {
              "items": {
                "$ref": "#/definitions/Event"
              }
            }
          },
          "default": {
            "description": "error",
            "schema": {
              "$ref": "#/definitions/Error"
            }
          }
        }
      }
    }
  },
  "definitions": {
    "Error": {
      "required": [
        "status",
        "error",
        "detail"
      ],
      "properties": {
        "status": {
          "type": "integer"
        },
        "error": {
          "type": "string"
        },
        "detail": {
          "type": "string"
        }
      }
    },
    "Artwork": {
      "properties": {
        "id": {
          "description": "Unique identifier"
        },
        "title": {
          "description": "Name of the artwork"
        },
        "main_reference_number": {},
        "date_start": {
          "description": "Earliest creation date"
        },
        "date_end": {
          "description": "Latest creation date"
        },
        "date_display": {
          "description": "Date information to display"
        },
        "agent_id": {
          "description": "Unique identifier of the agent"
        },
        "agent_display": {
          "description": "Agent information to display"
        },
        "deparment_id": {
          "description": "Uniqie identifier of the department"
        },
        "dimension": {},
        "medium": {},
        "inscriptions": {},
        "credit_line": {},
        "publication_history": {},
        "exhibition_history": {},
        "provenance_text": {},
        "last_updated_lpm_fedora": {},
        "last_updated_lpm_solr": {},
        "last_updated": {}
      },
      "type": "object"
    },
    "Agent": {
      "properties": {
        "id": {
          "description": "Unique identifier"
        },
        "title": {
          "description": "Name of the agent"
        },
        "birth_date": {},
        "death_date": {},
        "last_updated_lpm_fedora": {},
        "last_updated_lpm_solr": {},
        "last_updated": {}
      },
      "type": "object"
    },
    "Category": {
      "properties": {
        "id": {
          "description": "Unique identifier"
        },
        "title": {
          "description": "Name of the publish category"
        },
        "last_updated_lpm_fedora": {},
        "last_updated_lpm_solr": {},
        "last_updated": {}
      },
      "type": "object"
    },
    "Image": {
      "properties": {
        "id": {
          "description": "Unique identifier"
        },
        "title": {
          "description": "Name of the image"
        },
        "last_updated_lpm_fedora": {},
        "last_updated_lpm_solr": {},
        "last_updated": {}
      },
      "type": "object"
    },
    "Department": {
      "properties": {
        "id": {
          "description": "Unique identifier"
        },
        "title": {
          "description": "Name of the department"
        },
        "last_updated_lpm_fedora": {},
        "last_updated_lpm_solr": {},
        "last_updated": {}
      },
      "type": "object"
    },
    "Gallery": {
      "properties": {
        "id": {
          "description": "Unique identifier"
        },
        "title": {
          "description": "Name of the department"
        },
        "last_updated_lpm_fedora": {},
        "last_updated_lpm_solr": {},
        "last_updated": {}
      },
      "type": "object"
    },
    "Exhibition": {
      "properties": {
        "id": {
          "description": "Unique identifier"
        },
        "title": {
          "description": "Name of the department"
        },
        "last_updated_lpm_fedora": {},
        "last_updated_lpm_solr": {},
        "last_updated": {}
      },
      "type": "object"
    },
    "ObjectType": {
      "properties": {
        "id": {
          "description": "Unique identifier"
        },
        "title": {
          "description": "Name of the department"
        },
        "last_updated_lpm_fedora": {},
        "last_updated_lpm_solr": {},
        "last_updated": {}
      },
      "type": "object"
    },
    "AgentType": {
      "properties": {
        "id": {
          "description": "Unique identifier"
        },
        "title": {
          "description": "Name of the department"
        },
        "last_updated_lpm_fedora": {},
        "last_updated_lpm_solr": {},
        "last_updated": {}
      },
      "type": "object"
    },
    "Asset": {
      "properties": {
        "id": {
          "description": "Unique identifier"
        },
        "title": {
          "description": "Name of the department"
        },
        "last_updated_lpm_fedora": {},
        "last_updated_lpm_solr": {},
        "last_updated": {}
      },
      "type": "object"
    },
    "ShopCategory": {
      "properties": {
        "id": {
          "description": "Unique identifier"
        },
        "title": {
          "description": "Name of the shop category"
        },
        "last_updated": {}
      },
      "type": "object"
    },
    "Product": {
      "properties": {
        "id": {
          "description": "Unique identifier"
        },
        "title": {
          "description": "Name of the product"
        },
        "last_updated": {}
      },
      "type": "object"
    },
    "Event": {
      "properties": {
        "id": {
          "description": "Unique identifier"
        },
        "title": {
          "description": "Name of the event"
        },
        "start": {
          "description": "Start date and time"
        },
        "end": {
          "description": "End date and time"
        },
        "last_updated": {}
      },
      "type": "object"
    }
  },
  "parameters": {
    "id": {
      "name": "id",
      "in": "path",
      "type": "string",
      "required": true
    },
    "ids": {
      "name": "ids",
      "in": "query",
      "type": "string"
    },
    "limit": {
      "name": "limit",
      "in": "query",
      "type": "integer"
    },
    "page": {
      "name": "page",
      "in": "query",
      "type": "integer"
    }
  },
  "externalDocs": {
    "description": "Find out more about open source at the Art Institute of Chicago",
    "url": "http://www.github.com/art-insititute-of-chicago"
  }
}