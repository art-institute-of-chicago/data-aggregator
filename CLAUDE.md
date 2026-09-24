# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is the **Data Aggregator** — the Art Institute of Chicago's central data hub. It's a Laravel application that imports public data from many internal source systems (collections management, web CMS, shop, membership/events, mobile, archives, etc.), stores a unified copy locally, indexes it into Elasticsearch, and serves it all through the public REST API at `api.artic.edu`. Consumers include the AIC website, mobile app, and third-party Open Access users. The `develop` branch is the main branch.

Built on `aic/data-hub-foundation`, a shared internal package (`vendor/aic/data-hub-foundation`) providing base classes (`AbstractModel`, `AbstractController`, `AbstractCommand`, `AbstractTransformer`, `AbstractFactory`) used throughout this app.

## Requirements

- PHP 8.5
- MySQL 8.x (primary datastore)
- PostgreSQL + pgvector (vector embeddings datastore, connection `vectors`)
- Elasticsearch 9.x
- Composer 2
- Node 18 (only needed for building the VuePress docs site)

## Common Commands

```bash
composer install                    # Install PHP dependencies
cp .env.example .env && php artisan key:generate
php artisan migrate --seed          # Create tables, seed with Faker data

php artisan test                    # Run full test suite
php artisan test --filter TestName  # Run a single test
composer lint                       # PHP CodeSniffer
composer format                     # Auto-fix linting errors (phpcbf + PHP CS Fixer)
vendor/bin/phpstan analyse          # Static analysis (phpstan.neon.dist, level 3)

php artisan list import             # See all available data import commands
php artisan import:all              # Import all data from all source systems
```

Tests run against MySQL + the `vectors` Postgres connection (see `.env.testing`); CI (`.github/workflows/testing.yml`) spins up both plus pgvector.

### Docs site

```bash
npm install
npm run docs-dev      # Local VuePress docs w/ live regeneration
npm run docs-build    # Regenerate docs/README.md from field mappings + build VuePress site
```

`docs/generate_readme.js` calls into the `docs:*` artisan commands (`app/Console/Commands/Docs/`) which read field definitions straight out of the outbound transformers — so API docs and the OpenAPI spec all stay in sync with the code automatically.

## Architecture

### Data flow: source systems → local storage → search index → API

Each external source system (collections, web, shop, mobile, archives, etc. — see `config/resources/sources.php` for their base URLs) is pulled in by an **import command** and pushed back out through the **REST API**, with Elasticsearch powering dedicated search endpoints:

1. **Import** (`app/Console/Commands/Import/*`) — extend `AbstractImportCommand`, use the `ImportsData` behavior (`app/Behaviors/ImportsData.php`) to page through a source system's HTTP API. Each command tracks its own last-successful-run time (via the `Command` model) so `--since` incremental imports are possible; `-full` variants share that watermark with their partial counterpart.
2. **Inbound transformation** (`app/Transformers/Inbound/`) — maps raw source-system JSON onto local Eloquent attributes before upserting into MySQL.
3. **Storage** — Eloquent models (`app/Models/`) extend `App\Models\BaseModel` → `Aic\Hub\Foundation\AbstractModel`. IDs are **not auto-incrementing**; the source system's own ID is preserved as the primary key.
4. **Search indexing** — models using the `ElasticSearchable` trait (Laravel Scout + Elasticsearch) index themselves via `toSearchableArray()`, which just calls the model's outbound transform.
5. **Outbound transformation / API response** (`app/Transformers/Outbound/`) — extend `App\Transformers\Outbound\AbstractTransformer` (a Fractal `TransformerAbstract`). Controllers (`app/Http/Controllers/`, mostly generic `ResourceController` / `RestrictedResourceController`) use these to shape JSON responses.

### The resource registry is the single source of truth

`config/resources/outbound.php` and `config/resources/inbound.php` are arrays that map **endpoint ⇄ model ⇄ transformer** (outbound) and **source ⇄ model ⇄ transformer** (inbound). The `Resources` singleton (`app/Providers/ResourceServiceProvider.php`) reads these to answer "what model backs this endpoint," "what transformer serializes this model," "is this searchable/restricted," etc. `routes/api.php` loops over `config('resources.outbound.base')` to auto-register all resource routes — **adding a new public endpoint is primarily a config change**, not a new route/controller.

### Transformer field definitions are the single source of truth, three times over

Each outbound transformer builds a `$mappedFields` array (id/title/dates/custom fields, each with a `doc`, `type`, `elasticsearch` mapping, optional `filter`/`is_restricted`, and a `value` callback). This one definition drives:
- the actual JSON field in API responses (`transform()`),
- the Elasticsearch index mapping (`elasticsearchMapping()` / `ElasticSearchable`), and
- the generated field documentation (`app/Console/Commands/Docs/CreateFieldsDocs.php`, `CreateOpenapiDoc.php`).

When adding or changing a field, edit it once in the transformer — do not hand-edit generated docs or index mappings.

### Restricted / access-controlled data

Some resources are marked `is_restricted` in `config/resources/outbound.php` and served through `RestrictedResourceController` instead of `ResourceController` (`APP_RESTRICTED`, `LOGIN_WHITELIST_IPS`, `ACCESS_WHITELIST_IPS` in `.env`). Individual fields can also be flagged `is_restricted` (or `AbstractTransformer::RESTRICTED_IN_DUMP` to hide only from data dumps) inside a transformer's field definition and are stripped via `Gate::denies('restricted-access')`.

### AI / embeddings

`app/Services/EmbeddingService.php`, `DescriptionService.php`, `VectorSearchService.php`, and the `ai:*` commands under `app/Console/Commands/AI/` generate and search text/image embeddings, stored via pgvector on the `vectors` Postgres connection (separate from the main MySQL datastore). `routes/ai.php` exposes AI-backed search endpoints; `AzureAIController` integrates with Azure AI services.

### Test suites (`tests/`)

- **`Basic/`** — one test class per resource, extending `BasicTestCase`, exercising the generic CRUD/field-filtering behavior every endpoint gets for free (404s on bad IDs, `?fields=`, `?ids=`, etc.).
- **`Contract/`** — extends `ContractTestCase`; asserts that specific field sets known to be relied on by the website and mobile app are actually present in a resource's response, so a field rename/removal fails loudly instead of silently breaking a consumer.
- **`Unit/`** — narrower unit tests not tied to the HTTP layer.

### Key config files

- `config/resources/sources.php` — base URLs for every upstream source system
- `config/resources/inbound.php` / `outbound.php` — the resource registry described above
- `config/aic.php` — app-wide AIC settings (versioning, licensing text, etc.)
- `config/elasticsearch.php` — ES connection/index settings
- `config/database.php` — `mysql` (primary) and `vectors` (pgsql/pgvector) connections
- `.env.example` — all available environment variables, including per-source-system data service URLs

## Off-limits Directories

Never read, edit, or create files inside `vendor/` or `node_modules/`. These are managed by Composer and npm respectively — any changes would be overwritten on the next install and could mask real dependency issues. (`vendor/aic/data-hub-foundation` is worth *reading* to understand base-class behavior, but never edit it here — it's a separate package.)
