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

    "/artworks/boosted": {
      "get": {
        "tags": [
            "artworks",
            "collections"
        ],
        "summary": "A list of boosted artworks sorted by last updated date in descending order",
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

    "/artworks/search": {
      "get": {
        "tags": [
            "artworks",
            "collections",
            "search"
        ],
        "summary": "Search artwork data in the aggregator",
        "produces": [
          "application/json"
        ],
        "parameters": [
          {
            "$ref": "#/parameters/q"
          },
          {
            "$ref": "#/parameters/facets"
          }
        ],
        "responses": {
          "200": {
            "description": "Successful operation",
            "schema": {
              "items": {
                "$ref": "#/definitions/SearchResult"
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

    "/artworks/{id}/copyright-representatives": {
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

    "/agents/search": {
      "get": {
        "tags": [
            "agents",
            "collections",
            "search"
        ],
        "summary": "Search agent data in the aggregator",
        "produces": [
          "application/json"
        ],
        "parameters": [
          {
            "$ref": "#/parameters/q"
          },
          {
            "$ref": "#/parameters/facets"
          }
        ],
        "responses": {
          "200": {
            "description": "Successful operation",
            "schema": {
              "items": {
                "$ref": "#/definitions/SearchResult"
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

    "/departments/search": {
      "get": {
        "tags": [
            "departments",
            "collections",
            "search"
        ],
        "summary": "Search department data in the aggregator",
        "produces": [
          "application/json"
        ],
        "parameters": [
          {
            "$ref": "#/parameters/q"
          },
          {
            "$ref": "#/parameters/facets"
          }
        ],
        "responses": {
          "200": {
            "description": "Successful operation",
            "schema": {
              "items": {
                "$ref": "#/definitions/SearchResult"
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

    "/categories/search": {
      "get": {
        "tags": [
            "categories",
            "collections",
            "search"
        ],
        "summary": "Search category data in the aggregator",
        "produces": [
          "application/json"
        ],
        "parameters": [
          {
            "$ref": "#/parameters/q"
          },
          {
            "$ref": "#/parameters/facets"
          }
        ],
        "responses": {
          "200": {
            "description": "Successful operation",
            "schema": {
              "items": {
                "$ref": "#/definitions/SearchResult"
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

    "/galleries/search": {
      "get": {
        "tags": [
            "galleries",
            "collections",
            "search"
        ],
        "summary": "Search gallery data in the aggregator",
        "produces": [
          "application/json"
        ],
        "parameters": [
          {
            "$ref": "#/parameters/q"
          },
          {
            "$ref": "#/parameters/facets"
          }
        ],
        "responses": {
          "200": {
            "description": "Successful operation",
            "schema": {
              "items": {
                "$ref": "#/definitions/SearchResult"
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

    "/exhibitions/search": {
      "get": {
        "tags": [
            "exhibitions",
            "collections",
            "search"
        ],
        "summary": "Search exhibition data in the aggregator",
        "produces": [
          "application/json"
        ],
        "parameters": [
          {
            "$ref": "#/parameters/q"
          },
          {
            "$ref": "#/parameters/facets"
          }
        ],
        "responses": {
          "200": {
            "description": "Successful operation",
            "schema": {
              "items": {
                "$ref": "#/definitions/SearchResult"
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

    "/videos/search": {
      "get": {
        "tags": [
            "videos",
            "collections",
            "search"
        ],
        "summary": "Search video data in the aggregator",
        "produces": [
          "application/json"
        ],
        "parameters": [
          {
            "$ref": "#/parameters/q"
          },
          {
            "$ref": "#/parameters/facets"
          }
        ],
        "responses": {
          "200": {
            "description": "Successful operation",
            "schema": {
              "items": {
                "$ref": "#/definitions/SearchResult"
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

    "/links/search": {
      "get": {
        "tags": [
            "links",
            "collections",
            "search"
        ],
        "summary": "Search link data in the aggregator",
        "produces": [
          "application/json"
        ],
        "parameters": [
          {
            "$ref": "#/parameters/q"
          },
          {
            "$ref": "#/parameters/facets"
          }
        ],
        "responses": {
          "200": {
            "description": "Successful operation",
            "schema": {
              "items": {
                "$ref": "#/definitions/SearchResult"
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

    "/sounds/search": {
      "get": {
        "tags": [
            "sounds",
            "collections",
            "search"
        ],
        "summary": "Search sound data in the aggregator",
        "produces": [
          "application/json"
        ],
        "parameters": [
          {
            "$ref": "#/parameters/q"
          },
          {
            "$ref": "#/parameters/facets"
          }
        ],
        "responses": {
          "200": {
            "description": "Successful operation",
            "schema": {
              "items": {
                "$ref": "#/definitions/SearchResult"
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

    "/texts/search": {
      "get": {
        "tags": [
            "texts",
            "collections",
            "search"
        ],
        "summary": "Search text data in the aggregator",
        "produces": [
          "application/json"
        ],
        "parameters": [
          {
            "$ref": "#/parameters/q"
          },
          {
            "$ref": "#/parameters/facets"
          }
        ],
        "responses": {
          "200": {
            "description": "Successful operation",
            "schema": {
              "items": {
                "$ref": "#/definitions/SearchResult"
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

    "/shop-categories/search": {
      "get": {
        "tags": [
            "shopCategories",
            "shop",
            "search"
        ],
        "summary": "Search shop category data in the aggregator",
        "produces": [
          "application/json"
        ],
        "parameters": [
          {
            "$ref": "#/parameters/q"
          },
          {
            "$ref": "#/parameters/facets"
          }
        ],
        "responses": {
          "200": {
            "description": "Successful operation",
            "schema": {
              "items": {
                "$ref": "#/definitions/SearchResult"
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

    "/products/search": {
      "get": {
        "tags": [
            "products",
            "shop",
            "search"
        ],
        "summary": "Search product data in the aggregator",
        "produces": [
          "application/json"
        ],
        "parameters": [
          {
            "$ref": "#/parameters/q"
          },
          {
            "$ref": "#/parameters/facets"
          }
        ],
        "responses": {
          "200": {
            "description": "Successful operation",
            "schema": {
              "items": {
                "$ref": "#/definitions/SearchResult"
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

    "/events/search": {
      "get": {
        "tags": [
            "events",
            "members-event",
            "search"
        ],
        "summary": "Search event data in the aggregator",
        "produces": [
          "application/json"
        ],
        "parameters": [
          {
            "$ref": "#/parameters/q"
          },
          {
            "$ref": "#/parameters/facets"
          }
        ],
        "responses": {
          "200": {
            "description": "Successful operation",
            "schema": {
              "items": {
                "$ref": "#/definitions/SearchResult"
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

    "/tours/search": {
      "get": {
        "tags": [
            "tours",
            "mobile-app",
            "search"
        ],
        "summary": "Search tour data in the aggregator",
        "produces": [
          "application/json"
        ],
        "parameters": [
          {
            "$ref": "#/parameters/q"
          },
          {
            "$ref": "#/parameters/facets"
          }
        ],
        "responses": {
          "200": {
            "description": "Successful operation",
            "schema": {
              "items": {
                "$ref": "#/definitions/SearchResult"
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

    "/tour-stops": {
      "get": {
        "tags": [
            "tour-stops",
            "mobile-app"
        ],
        "summary": "A list of all tour stops sorted by last updated date in descending order",
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
                "$ref": "#/definitions/TourStop"
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

    "/tour-stops/search": {
      "get": {
        "tags": [
            "tour-stops",
            "mobile-app",
            "search"
        ],
        "summary": "Search tour stop data in the aggregator",
        "produces": [
          "application/json"
        ],
        "parameters": [
          {
            "$ref": "#/parameters/q"
          },
          {
            "$ref": "#/parameters/facets"
          }
        ],
        "responses": {
          "200": {
            "description": "Successful operation",
            "schema": {
              "items": {
                "$ref": "#/definitions/SearchResult"
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

    "/tour-stops/{id}": {
      "get": {
        "tags": [
            "tour-stops",
            "mobile-app"
        ],
        "summary": "A single tour stop by the given identifier",
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
                "$ref": "#/definitions/TourStop"
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

    "/publications/search": {
      "get": {
        "tags": [
            "publications",
            "dsc",
            "search"
        ],
        "summary": "Search publication data in the aggregator",
        "produces": [
          "application/json"
        ],
        "parameters": [
          {
            "$ref": "#/parameters/q"
          },
          {
            "$ref": "#/parameters/facets"
          }
        ],
        "responses": {
          "200": {
            "description": "Successful operation",
            "schema": {
              "items": {
                "$ref": "#/definitions/SearchResult"
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

    "/sections/search": {
      "get": {
        "tags": [
            "sections",
            "dsc",
            "search"
        ],
        "summary": "Search section data in the aggregator",
        "produces": [
          "application/json"
        ],
        "parameters": [
          {
            "$ref": "#/parameters/q"
          },
          {
            "$ref": "#/parameters/facets"
          }
        ],
        "responses": {
          "200": {
            "description": "Successful operation",
            "schema": {
              "items": {
                "$ref": "#/definitions/SearchResult"
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

    "/sites": {
      "get": {
        "tags": [
            "site"
        ],
        "summary": "A list of all sites sorted by last updated date in descending order",
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
                "$ref": "#/definitions/Site"
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

    "/sites/search": {
      "get": {
        "tags": [
            "site",
            "search"
        ],
        "summary": "Search site data in the aggregator",
        "produces": [
          "application/json"
        ],
        "parameters": [
          {
            "$ref": "#/parameters/q"
          },
          {
            "$ref": "#/parameters/facets"
          }
        ],
        "responses": {
          "200": {
            "description": "Successful operation",
            "schema": {
              "items": {
                "$ref": "#/definitions/SearchResult"
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

    "/sites/{id}": {
      "get": {
        "tags": [
            "site"
        ],
        "summary": "A single site by the given identifier",
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
                "$ref": "#/definitions/Site"
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

    "/search": {
      "get": {
        "tags": [
            "search"
        ],
        "summary": "Search all data in the aggregator",
        "produces": [
          "application/json"
        ],
        "parameters": [
          {
            "$ref": "#/parameters/q"
          },
          {
            "$ref": "#/parameters/facets"
          }
        ],
        "responses": {
          "200": {
            "description": "Successful operation",
            "schema": {
              "items": {
                "$ref": "#/definitions/SearchResult"
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
        "main_reference_number": {
          "description": "Institutional identifier of the artwork"
        },
        "date_start": {
          "description": "Earliest creation date"
        },
        "date_end": {
          "description": "Latest creation date"
        },
        "date_display": {
          "description": "Date information to display"
        },
        "description": {
          "description": "Web description of the artwork"
        },
        "artist_display": {
          "description": "Artist information to display"
        },
        "department": {
          "description": "Name of the department"
        },
        "department_id": {
          "description": "Unique identifier of the department"
        },
        "dimension": {
          "description": "Dimensions of the work. Can be multiples, for example if the work is a set, has a frame, etc."
        },
        "medium": {
          "description": "Mediums which the work was created"
        },
        "inscriptions": {
          "description": "Text of inscriptions found in the work"
        },
        "object_type": {
          "description": "Name of the type of object"
        },
        "object_type_id": {
          "description": "Unique identifier of the type of object"
        },
        "credit_line": {
          "description": "Credit attribution of the work"
        },
        "publication_history": {
          "description": "Full list of where this work has ever been published"
        },
        "exhibition_history": {
          "description": "Full list of where this work has ever been exhibited"
        },
        "provenance_text": {
          "description": "Ownership history of the work"
        },
        "publishing_verification_level": {
          "description": "The level which the works images can be published"
        },
        "is_public_domain": {
          "description": "Boolean flag indicating if the work is in the public domain"
        },
        "copyright_notice": {
          "description": "Legal text of copyright"
        },
        "place_of_origin": {
          "description": "Location where the work was created"
        },
        "collection_status": {
          "description": "Level of the Art Institutes holding of the work"
        },
        "gallery": {
          "description": "Name of the gallery"
        },
        "gallery_id": {
          "description": "Unique identifier of the gallery"
        },
        "is_in_gallery": {
          "description": "Boolean flag indicating if the work is in currently in the galleries"
        },
        "latitude": {
          "description": "For works in the mobile app, this will represent the exact position that the work sits within a gallery. For all other objects these coordinates are the center point of the gallery which they reside."
        },
        "longitude": {
          "description": "For works in the mobile app, this will represent the exact position that the work sits within a gallery. For all other objects these coordinates are the center point of the gallery which they reside."
        },
        "latlon": {
          "description": "For works in the mobile app, this will represent the exact position that the work sits within a gallery. For all other objects these coordinates are the center point of the gallery which they reside."
        },
        "is_highlighted_in_mobile": {
          "description": "Boolean flag indicating if the work is highlighted in the mobile app"
        },
        "selector_number": {
          "description": "The three-digit number to enter into our audioguide to pull up this work"
        },
        "artist_ids": {
          "description": "Unique identifiers of the artists t who created this work"
        },
        "category_ids": {
          "description": "Unique identifiers of the categories associated with this work"
        },
        "copyright_representative_ids": {
          "description": "Unique identifiers of the agents who have the type 'Copyright Representative' associated with this work"
        },
        "part_ids": {
          "description": "Unique identifiers of the artworks that are parts of this work"
        },
        "set_ids": {
          "description": "Unique identifiers of the sets this work is a part of"
        },
        "date_dates": {
          "description": "All dates associated with this work"
        },
        "catalogue_titles": {
          "description": "Names of the catalogue raisonné this work in included in"
        },
        "term_titles": {
          "description": "Names of the terms associated with this work"
        },
        "image_urls": {
          "description": "URLs of images of this work"
        },
        "publication_ids": {
          "description": "Unique identifiers of the publications this work is included in"
        },
        "tour_ids": {
          "description": "Unique identifiers of the mobile tours this work is included in"
        },
        "last_updated_citi": {
          "description": "Date the work was last updated in CITI"
        },
        "last_updated_fedora": {
          "description": "Date the work was last updated in LAKE's Fedora"
        },
        "last_updated_source": {
          "description": "Date the work was last updated in LAKE's LPM Solr index"
        },
        "last_updated": {
          "description": "Date the work was last updated in the Data Aggregator"
        }
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
        "birth_date": {
          "description": "Year the agent was born"
        },
        "birth_place": {
          "description": "Name of the location the agent was born"
        },
        "death_date": {
          "description": "Year the agent was died"
        },
        "death_place": {
          "description": "Name of the location the agent died "
        },
        "is_licensing_restricted": {
          "description": "Boolean flag indicating if the agent has licensing restrictions"
        },
        "agent_type": {
          "description": "Name of the type of this agent"
        },
        "agent_type_id": {
          "description": "Unique identifier of the type of this agent"
        },
        "last_updated_citi": {
          "description": "Date the work was last updated in CITI"
        },
        "last_updated_fedora": {
          "description": "Date the work was last updated in LAKE's Fedora"
        },
        "last_updated_source": {
          "description": "Date the work was last updated in LAKE's LPM Solr index"
        },
        "last_updated": {
          "description": "Date the work was last updated in the Data Aggregator"
        }
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
        "parent_id": {
          "description": "Unique identifier of the parent of this category"
        },
        "is_in_nav": {
          "description": "Whether this category is included in the departmental navigation on the legacy Collections website"
        },
        "description": {
          "description": "Web description"
        },
        "sort": {
          "description": "Number indicating sort order"
        },
        "type": {
          "description": "The type of category. 1 is Departmental, 2 is Subject, 3 is Theme and 5 is Multimedia."
        },
        "last_updated_citi": {
          "description": "Date the work was last updated in CITI"
        },
        "last_updated_fedora": {
          "description": "Date the work was last updated in LAKE's Fedora"
        },
        "last_updated_source": {
          "description": "Date the work was last updated in LAKE's LPM Solr index"
        },
        "last_updated": {
          "description": "Date the work was last updated in the Data Aggregator"
        }
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
        "last_updated_citi": {
          "description": "Date the work was last updated in CITI"
        },
        "last_updated_fedora": {
          "description": "Date the work was last updated in LAKE's Fedora"
        },
        "last_updated_source": {
          "description": "Date the work was last updated in LAKE's LPM Solr index"
        },
        "last_updated": {
          "description": "Date the work was last updated in the Data Aggregator"
        }
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
        "last_updated_citi": {
          "description": "Date the work was last updated in CITI"
        },
        "last_updated_fedora": {
          "description": "Date the work was last updated in LAKE's Fedora"
        },
        "last_updated_source": {
          "description": "Date the work was last updated in LAKE's LPM Solr index"
        },
        "last_updated": {
          "description": "Date the work was last updated in the Data Aggregator"
        }
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
        "is_closed": {
          "description": "Whether the gallery is currently closed."
        },
        "number": {
          "description": "The gallery number. For example, Gallery *100*."
        },
        "floor": {
          "description": "The elevation at which this gallery resides. Isn't always numeric, can be 'LL'."
        },
        "latitude": {
          "description": "For works in the mobile app, this will represent the exact position that the work sits within a gallery. For all other objects these coordinates are the center point of the gallery which they reside."
        },
        "longitude": {
          "description": "For works in the mobile app, this will represent the exact position that the work sits within a gallery. For all other objects these coordinates are the center point of the gallery which they reside."
        },
        "latlon": {
          "description": "For works in the mobile app, this will represent the exact position that the work sits within a gallery. For all other objects these coordinates are the center point of the gallery which they reside."
        },
        "category_ids": {
          "description": "Unique identifiers of categories this gallery is associated with"
        },
        "last_updated_citi": {
          "description": "Date the work was last updated in CITI"
        },
        "last_updated_fedora": {
          "description": "Date the work was last updated in LAKE's Fedora"
        },
        "last_updated_source": {
          "description": "Date the work was last updated in LAKE's LPM Solr index"
        },
        "last_updated": {
          "description": "Date the work was last updated in the Data Aggregator"
        }
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
        "description": {
          "description": "Description of this exhibition"
        },
        "type": {
          "description": "Name of the type of this exhibition"
        },
        "department": {
          "description": "Name of the department associated with this exhibition"
        },
        "department_id": {
          "description": "Unique identifier of the department associated with this exhibition"
        },
        "gallery": {
          "description": "Name of the gallery associated with this exhibition"
        },
        "gallery_id": {
          "description": "Unique identifier of the gallery associated with this exhibition"
        },
        "dates": {
          "description": "The dates which this exhibition ran at the Art Institute of Chicago"
        },
        "is_active": {
          "description": "Boolean flag indicating if this exhibition is active"
        },
        "artwork_ids": {
          "description": "Unique identifiers of the artworks included in this exhibition"
        },
        "venue_ids": {
          "description": "Agent IDs of other venues that hosted this exhibition"
        },
        "last_updated_citi": {
          "description": "Date the work was last updated in CITI"
        },
        "last_updated_fedora": {
          "description": "Date the work was last updated in LAKE's Fedora"
        },
        "last_updated_source": {
          "description": "Date the work was last updated in LAKE's LPM Solr index"
        },
        "last_updated": {
          "description": "Date the work was last updated in the Data Aggregator"
        }
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
        "last_updated_citi": {
          "description": "Date the work was last updated in CITI"
        },
        "last_updated_fedora": {
          "description": "Date the work was last updated in LAKE's Fedora"
        },
        "last_updated_source": {
          "description": "Date the work was last updated in LAKE's LPM Solr index"
        },
        "last_updated": {
          "description": "Date the work was last updated in the Data Aggregator"
        }
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
        "last_updated_citi": {
          "description": "Date the work was last updated in CITI"
        },
        "last_updated_fedora": {
          "description": "Date the work was last updated in LAKE's Fedora"
        },
        "last_updated_source": {
          "description": "Date the work was last updated in LAKE's LPM Solr index"
        },
        "last_updated": {
          "description": "Date the work was last updated in the Data Aggregator"
        }
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
        "description": {
          "description": "Description of the asset"
        },
        "content": {
          "description": "Asset content"
        },
        "artist": {
          "description": "Name of the artist this asset is associated with"
        },
        "artist_id": {
          "description": "Unique identifier of the artist this asset is associated with"
        },
        "category_ids": {
          "description": "Unique identifiers of the categories this asset is associated with"
        },
        "last_updated_fedora": {
          "description": "Date the work was last updated in LAKE's Fedora"
        },
        "last_updated_source": {
          "description": "Date the work was last updated in LAKE's LPM Solr index"
        },
        "last_updated": {
          "description": "Date the work was last updated in the Data Aggregator"
        }
      },
      "type": "object"
    },

    "ShopCategory": {
      "properties": {
        "id": {
          "description": "Unique identifier. Not the same as the identifier in the source system, as source_id is not unique."
        },
        "title": {
          "description": "Name of the shop category"
        },
        "link": {
          "description": "URL to the page for this shop category"
        },
        "parent_id": {
          "description": "Unique identifier of the category that is this record's parent"
        },
        "type": {
          "description": "Name of this category's type"
        },
        "source_id": {
          "description": "The identifier of this category in the source system. These are not unique, as they are relative to the category type in the source system."
        },
        "child_ids": {
          "description": "Unique identifiers of this category's children"
        },
        "last_updated_source": {
          "description": "Date the work was last updated in the source system"
        },
        "last_updated": {
          "description": "Date the work was last updated in the Data Aggregator"
        }
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
        "title_display": {
          "description": "Web-friendly name of the product"
        },
        "sku": {
          "description": "Inventory identification code of the product"
        },
        "link": {
          "description": "URL to the shop page of this product"
        },
        "image": {
          "description": "URL to the image of this product"
        },
        "description": {
          "description": "Description of this product"
        },
        "is_on_sale": {
          "description": "Boolean flag indicating if this product is on sale"
        },
        "priority": {
          "description": "Number indicating the priority of this product"
        },
        "price": {
          "description": "Price of this product"
        },
        "review_count": {
          "description": "Number of reviews this product has received"
        },
        "item_sold": {
          "description": "Number of items this product has sold"
        },
        "rating": {
          "description": "Decimal number of this product's average rating"
        },
        "category_ids": {
          "description": "Unique identifiers of categories this product is associated with"
        },
        "last_updated_source": {
          "description": "Date the work was last updated in the source system"
        },
        "last_updated": {
          "description": "Date the work was last updated in the Data Aggregator"
        }
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
        "type": {
          "description": "Name of the type of event"
        },
        "on_sale": {
          "description": "Date and time that this product goes on sale"
        },
        "off_sale": {
          "description": "Date and time that this product goes off sale"
        },
        "resource": {
          "description": "Number identifying this event's resource"
        },
        "user_event_number": {
          "description": "Number identifying this event's user event"
        },
        "available": {
          "description": "Number identifying the number of tickets available for this event"
        },
        "total_capacity": {
          "description": "Number identifying this event's total capacity"
        },
        "status": {
          "description": "Number identifying this event's status"
        },
        "rs_event_seat_map_id": {},
        "has_roster": {
          "description": "Boolean flag indicating if this event has a roster"
        },
        "is_private_event": {
          "description": "Boolean flag indicating if this event is a private event"
        },
        "has_holds": {
          "description": "Boolean flag indicating if this event has any holds"
        },
        "last_updated_source": {
          "description": "Date the work was last updated in the source system"
        },
        "last_updated": {
          "description": "Date the work was last updated in the Data Aggregator"
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
        },
        "last_updated_source": {
          "description": "Date the work was last updated in the source system"
        },
        "last_updated": {
          "description": "Date the work was last updated in the Data Aggregator"
        }
      },
      "type": "object"
    },

    "TourStop": {
      "properties": {
        "id": {
          "description": "Unique identifier"
        },
        "title": {
          "description": "Name of the tour stop"
        },
        "artwork": {
          "description": "Title of the artwork"
        },
        "artwork_id": {
          "description": "Unique identifier of the artwork"
        },
        "mobile_sound": {
          "description": "URL to the tour audio"
        },
        "mobile_sound_id": {
          "description": "Unique identifier of the tour audio"
        },
        "weight": {
          "description": "Sort order for the tour stop in a list"
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
        },
        "last_updated_source": {
          "description": "Date the work was last updated in the source system"
        },
        "last_updated": {
          "description": "Date the work was last updated in the Data Aggregator"
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
        },
        "last_updated_source": {
          "description": "Date the work was last updated in the source system"
        },
        "last_updated": {
          "description": "Date the work was last updated in the Data Aggregator"
        }
      },
      "type": "object"
    },

    "Section": {
      "properties": {
        "id": {
          "description": "Unique identifier"
        },
        "title": {
          "description": "Name of the section"
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
        },
        "last_updated_source": {
          "description": "Date the work was last updated in the source system"
        },
        "last_updated": {
          "description": "Date the work was last updated in the Data Aggregator"
        }
      },
      "type": "object"
    },

    "Site": {
      "properties": {
        "id": {
          "description": "Unique identifier"
        },
        "title": {
          "description": "Name of the site"
        },
        "description": {
          "description": "Description of the site"
        },
        "link": {
          "description": "Link the site"
        },
        "exhibition": {
          "description": "Name of the exhibition this site is associated with"
        },
        "exhibition_id": {
          "description": "Unique identifier of the exhibition this site is associated with"
        },
        "artwork_ids": {
          "description": "Array of unique identifier of artwork this site is associated with"
        },
        "last_updated_source": {
              "description": "Date the work was last updated in the source system"
        },
        "last_updated": {
              "description": "Date the work was last updated in the Data Aggregator"
        }
      },
      "type": "object"
    },

    "SearchResult": {
      "properties": {
        "_score": {
          "description": "Search index ranking of the result"
        },
        "id": {
          "description": "Unique identifier within the search index"
        },
        "api_id": {
          "description": "API unique identifier"
        },
        "api_model": {
          "description": "Name of the model the resource represents"
        },
        "api_link": {
          "description": "URL to this recource in the API"
        },
        "title": {
          "description": "Name of this resource"
        },
        "timestamp": {
          "description": "Date this record was last updated in the API"
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
    },
    "q": {
      "name": "query",
      "in": "query",
      "type": "string"
    },
    "facets": {
      "name": "facets",
      "in": "query",
      "type": "string"
    }
  },
  "externalDocs": {
    "description": "Find out more about open source at the Art Institute of Chicago",
    "url": "http://www.github.com/art-insititute-of-chicago"
  }
}
