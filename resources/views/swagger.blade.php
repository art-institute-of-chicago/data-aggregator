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
    "http"
  ],
  "paths": {
    "/artworks": {
      "get": {
        "tags": [
            "artworks",
            "collections"
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

    "/artworks/{id}": {
      "get": {
        "tags": [
            "artworks",
            "collections"
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

    "/artworks/{id}/artists": {
      "get": {
        "tags": [
            "artworks",
            "collections"
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

    "/artworks/{id}/copyrightRepresentatives": {
      "get": {
        "tags": [
            "artworks",
            "collections"
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

    "/artworks/{id}/categories": {
      "get": {
        "tags": [
            "artworks",
            "collections"
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

    "/artworks/{id}/parts": {
      "get": {
        "tags": [
            "artworks",
            "collections"
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

    "/artworks/{id}/sets": {
      "get": {
        "tags": [
            "artworks",
            "collections"
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

    "/artworks/{id}/images": {
      "get": {
        "tags": [
            "artworks",
            "collections"
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

    "/agents": {
      "get": {
        "tags": [
            "agents",
            "collections"
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

    "/agents/{id}": {
      "get": {
        "tags": [
            "agents",
            "collections"
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

    "/artists": {
      "get": {
        "tags": [
            "artists",
            "collections"
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

    "/artists/{id}": {
      "get": {
        "tags": [
            "artists",
            "collections"
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

    "/venues": {
      "get": {
        "tags": [
            "venues",
            "collections"
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

    "/venues/{id}": {
      "get": {
        "tags": [
            "venues",
            "collections"
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

    "/departments": {
      "get": {
        "tags": [
            "departments",
            "collections"
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

    "/departments/{id}": {
      "get": {
        "tags": [
            "departments",
            "collections"
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

    "/object-types": {
      "get": {
        "tags": [
            "objectTypes",
            "collections"
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

    "/object-types/{id}": {
      "get": {
        "tags": [
            "objectTypes",
            "collections"
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

    "/categories": {
      "get": {
        "tags": [
            "categories",
            "collections"
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

    "/categories/{id}": {
      "get": {
        "tags": [
            "categories",
            "collections"
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

    "/agent-types": {
      "get": {
        "tags": [
            "agentTypes",
            "collections"
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

    "/agent-types/{id}": {
      "get": {
        "tags": [
            "agentTypes",
            "collections"
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

    "/galleries": {
      "get": {
        "tags": [
            "galleries",
            "collections"
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

    "/galleries/{id}": {
      "get": {
        "tags": [
            "galleries",
            "collections"
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

    "/exhibitions": {
      "get": {
        "tags": [
            "exhibitions",
            "collections"
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

    "/exhibitions/{id}": {
      "get": {
        "tags": [
            "exhibitions",
            "collections"
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

    "/exhibitions/{id}/artworks": {
      "get": {
        "tags": [
            "exhibitions",
            "collections"
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

    "/exhibitions/{id}/venues": {
      "get": {
        "tags": [
            "exhibitions",
            "collections"
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

    "/images": {
      "get": {
        "tags": [
            "images",
            "collections"
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

    "/images/{id}": {
      "get": {
        "tags": [
            "images",
            "collections"
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

    "/videos": {
      "get": {
        "tags": [
            "videos",
            "collections"
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

    "/videos/{id}": {
      "get": {
        "tags": [
            "videos",
            "collections"
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

    "/links": {
      "get": {
        "tags": [
            "links",
            "collections"
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

    "/links/{id}": {
      "get": {
        "tags": [
            "links",
            "collections"
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

    "/sounds": {
      "get": {
        "tags": [
            "sounds",
            "collections"
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

    "/sounds/{id}": {
      "get": {
        "tags": [
            "sounds",
            "collections"
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

    "/texts": {
      "get": {
        "tags": [
            "texts",
            "collections"
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

    "/texts/{id}": {
      "get": {
        "tags": [
            "texts",
            "collections"
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

    "/shop-categories": {
      "get": {
        "tags": [
            "shopCategories",
            "shop"
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

    "/shop-categories/{id}": {
      "get": {
        "tags": [
            "shopCategories",
            "shop"
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

    "/products": {
      "get": {
        "tags": [
            "products",
            "shop"
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

    "/products/{id}": {
      "get": {
        "tags": [
            "products",
            "shop"
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

    "/events": {
      "get": {
        "tags": [
            "events",
            "members-event"
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

    "/events/{id}": {
      "get": {
        "tags": [
            "events",
            "members-event"
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
    },

    "/members/{id}/{zip}": {
      "get": {
        "tags": [
            "members",
            "members-event"
        ],
        "summary": "A single member by the given identifier",
        "produces": [
          "application/json"
        ],
        "parameters": [
          {
            "$ref": "#/parameters/id",
            "id": {
              "name": "zip",
              "in": "path",
              "type": "string",
              "required": true
            }
          }
        ],
        "responses": {
          "200": {
            "description": "Successful operation",
            "schema": {
              "items": {
                "$ref": "#/definitions/Member"
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

    "/tours": {
      "get": {
        "tags": [
            "tours",
            "mobile-app"
        ],
        "summary": "A list of all tours sorted by last updated date in descending order",
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
                "$ref": "#/definitions/Tour"
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

    "/tours/{id}": {
      "get": {
        "tags": [
            "tours",
            "mobile-app"
        ],
        "summary": "A single tour by the given identifier",
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
                "$ref": "#/definitions/Tour"
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

    "/mobile-sounds": {
      "get": {
        "tags": [
            "mobileSounds",
            "mobile-app"
        ],
        "summary": "A list of all mobile sounds sorted by last updated date in descending order",
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
                "$ref": "#/definitions/MobileSound"
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

    "/mobile-sounds/{id}": {
      "get": {
        "tags": [
            "mobileSounds",
            "mobile-app"
        ],
        "summary": "A single mobile sounds by the given identifier",
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
                "$ref": "#/definitions/MobileSound"
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

    "/publications": {
      "get": {
        "tags": [
            "publications",
            "dsc"
        ],
        "summary": "A list of all publications sorted by last updated date in descending order",
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
                "$ref": "#/definitions/Publication"
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

    "/publications/{id}": {
      "get": {
        "tags": [
            "publications",
            "dsc"
        ],
        "summary": "A single publication by the given identifier",
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
                "$ref": "#/definitions/Publication"
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

    "/title-pages": {
      "get": {
        "tags": [
            "title-pages",
            "dsc"
        ],
        "summary": "A list of all title pages sorted by last updated date in descending order",
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
                "$ref": "#/definitions/TitlePage"
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

    "/title-pages/{id}": {
      "get": {
        "tags": [
            "title-pages",
            "dsc"
        ],
        "summary": "A single title page by the given identifier",
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
                "$ref": "#/definitions/TitlePage"
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

    "/sections": {
      "get": {
        "tags": [
            "section",
            "dsc"
        ],
        "summary": "A list of all sections sorted by last updated date in descending order",
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
                "$ref": "#/definitions/Section"
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

    "/sections/{id}": {
      "get": {
        "tags": [
            "sections",
            "dsc"
        ],
        "summary": "A single section by the given identifier",
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
                "$ref": "#/definitions/Section"
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

    "/works-of-art": {
      "get": {
        "tags": [
            "works-of-art",
            "dsc"
        ],
        "summary": "A list of all works of art sorted by last updated date in descending order",
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
                "$ref": "#/definitions/WorkOfArt"
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

    "/works-of-art/{id}": {
      "get": {
        "tags": [
            "works-of-art",
            "dsc"
        ],
        "summary": "A single work of art by the given identifier",
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
                "$ref": "#/definitions/WorkOfArt"
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

    "/footnotes": {
      "get": {
        "tags": [
            "footnotes",
            "dsc"
        ],
        "summary": "A list of all footnotes sorted by last updated date in descending order",
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
                "$ref": "#/definitions/Footnote"
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

    "/footnotes/{id}": {
      "get": {
        "tags": [
            "footnote",
            "dsc"
        ],
        "summary": "A single footnote by the given identifier",
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
                "$ref": "#/definitions/Footnote"
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

    "/figures": {
      "get": {
        "tags": [
            "figures",
            "dsc"
        ],
        "summary": "A list of all figures sorted by last updated date in descending order",
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
                "$ref": "#/definitions/Figure"
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

    "/figures/{id}": {
      "get": {
        "tags": [
            "figure",
            "dsc"
        ],
        "summary": "A single figure by the given identifier",
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
                "$ref": "#/definitions/Figure"
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

    "/collectors": {
      "get": {
        "tags": [
            "collectors",
            "dsc"
        ],
        "summary": "A list of all collectors sorted by last updated date in descending order",
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
                "$ref": "#/definitions/Collector"
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

    "/collectors/{id}": {
      "get": {
        "tags": [
            "collector",
            "dsc"
        ],
        "summary": "A single collector by the given identifier",
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
                "$ref": "#/definitions/Collector"
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
          "description": "Name of the gallery"
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
          "description": "Name of the exhibition"
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
          "description": "Name of the object type"
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
          "description": "Name of the agent type"
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
          "description": "Name of the asset"
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
    },

    "Member": {
      "properties": {
        "id": {
          "description": "Unique identifier"
        },
        "title": {
          "description": "Name of the member"
        },
        "first_name": {
          "description": "Member's first name"
        },
        "last_name": {
          "description": "Member's last name"
        },
        "street_1": {
          "description": "Member's street address"
        },
        "street_2": {
          "description": "Member's secondary street address"
        },
        "city": {
          "description": "Member's city"
        },
        "state": {
          "description": "Member's state"
        },
        "zip": {
          "description": "Member's postal code"
        },
        "email": {
          "description": "Member's email address"
        },
        "phone": {
          "description": "Member's phone number"
        },
        "membership_level": {
          "description": "Member's membership level"
        },
        "opened": {
          "description": "Date the membership was created"
        },
        "used": {
          "description": "Date the membership was last used"
        },
        "expires": {
          "description": "Date the membership expires"
        }
      },
      "type": "object"
    },

    "Tour": {
      "properties": {
        "id": {
          "description": "Unique identifier"
        },
        "title": {
          "description": "Name of the tour"
        },
        "image": {
          "description": "URL to an image representing this tour"
        },
        "description": {
          "description": "Description of the tour"
        },
        "intro": {
          "description": "Text of the introduction to the tour"
        },
        "weight": {
          "description": "Sort order for the tour in a list"
        },
        "intro_link": {
          "description": "URL to the audio for the introduction"
        },
        "intro_transcript": {
          "description": "Transcript of the intro audio"
        }
      },
      "type": "object"
    },

    "MobileSound": {
      "properties": {
        "id": {
          "description": "Unique identifier"
        },
        "title": {
          "description": "Name of the mobile tour audio"
        },
        "transcript": {
          "description": "Transcript of the intro audio"
        },
        "link": {
          "description": "URL to the audio of the this tour stop"
        }
      },
      "type": "object"
    },

    "Publication": {
      "properties": {
        "id": {
          "description": "Unique identifier"
        },
        "title": {
          "description": "Name of the publication"
        },
        "link": {
          "description": "URL to the publication"
        }
      },
      "type": "object"
    },

    "TitlePage": {
      "properties": {
        "id": {
          "description": "Unique identifier"
        },
        "content": {
          "description": "Page content"
        },
        "publication": {
          "description": "Name of the publication this page belongs to"
        },
        "publication_id": {
          "description": "Unique identifier of the publication this page belongs to"
        }
      },
      "type": "object"
    },

    "Section": {
      "properties": {
        "id": {
          "description": "Unique identifier"
        },
        "content": {
          "description": "Section content"
        },
        "weight": {
          "description": "Sort order of this section"
        },
        "depth": {
          "description": "How far below the previous section this on sits. Used for creating hierarchy."
        },
        "publication": {
          "description": "Name of the publication this page belongs to"
        },
        "publication_id": {
          "description": "Unique identifier of the publication this page belongs to"
        }
      },
      "type": "object"
    },

    "WorkOfArt": {
      "properties": {
        "id": {
          "description": "Unique identifier"
        },
        "content": {
          "description": "Text content about this work of art"
        },
        "weight": {
          "description": "Sort order of this section"
        },
        "depth": {
          "description": "How far below the previous section this on sits. Used for creating hierarchy."
        },
        "publication": {
          "description": "Name of the publication this page belongs to"
        },
        "publication_id": {
          "description": "Unique identifier of the publication this page belongs to"
        },
        "artwork": {
          "description": "Name of the artwork this section describes"
        },
        "artwork_id": {
          "description": "Unique identifier of the artwork this section describes"
        }
      },
      "type": "object"
    },

    "Footnote": {
      "properties": {
        "id": {
          "description": "Unique identifier"
        },
        "content": {
          "description": "Text content about this footnote"
        },
        "section": {
          "description": "Name of the section this footnote belongs to"
        },
        "section_id": {
          "description": "Unique identifier of the section this footnote belongs to"
        }
      },
      "type": "object"
    },

    "Figure": {
      "properties": {
        "id": {
          "description": "Unique identifier"
        },
        "content": {
          "description": "Text content of this figure"
        },
        "section": {
          "description": "Name of the section this figure belongs to"
        },
        "section_id": {
          "description": "Unique identifier of the section this figure belongs to"
        }
      },
      "type": "object"
    },

    "Collector": {
      "properties": {
        "id": {
          "description": "Unique identifier"
        },
        "content": {
          "description": "Text content about this collector"
        },
        "weight": {
          "description": "Sort order of this section"
        },
        "depth": {
          "description": "How far below the previous section this one sits. Used for creating hierarchy."
        },
        "publication": {
          "description": "Name of the publication this section belongs to"
        },
        "publication_id": {
          "description": "Unique identifier of the publication this section belongs to"
        }
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