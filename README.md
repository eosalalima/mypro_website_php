# MyPro Website PHP

## Project overview

This repository is the target Laravel migration for the existing Next.js application in `https://github.com/eosalalima/mypro_website`.

Phase 1 discovery has started, but the primary source repository could not be cloned from this environment because GitHub access returned `CONNECT tunnel failed, response 403`. The repository currently contains migration assessment and planning documents only; the Laravel application has not yet been scaffolded.

## Technology stack target

- PHP
- Laravel
- Blade templates
- Livewire and Alpine.js for interactive behavior
- Tailwind CSS
- Laravel Eloquent ORM
- MySQL or MariaDB
- Laravel migrations, factories, and seeders
- Laravel Form Requests, Policies, Gates, and middleware
- PHPUnit or Pest
- Vite
- Docker support where practical

## Prerequisites

To be finalized after Laravel foundation work. Expected prerequisites include:

- PHP supported by the selected Laravel version
- Composer
- Node.js and npm for Vite asset builds
- MySQL or MariaDB
- Redis if queues/cache require it

## Installation

Pending Laravel scaffolding.

## Environment setup

Pending Laravel scaffolding. See `docs/environment-variables.md` for the preliminary environment plan.

## Database setup

Pending source schema discovery and Laravel migrations.

## Migration and seeding

Pending source schema discovery.

## Development commands

Pending Laravel scaffolding.

## Test commands

Pending Laravel scaffolding. Expected commands may include:

```bash
php artisan test
composer test
```

## Asset build commands

Pending Laravel scaffolding. Expected commands may include:

```bash
npm install
npm run build
npm run dev
```

## Queue worker commands

Pending discovery of background jobs. Expected command:

```bash
php artisan queue:work
```

## Scheduler setup

Pending discovery of scheduled tasks. Expected production cron entry:

```bash
* * * * * cd /path/to/application && php artisan schedule:run >> /dev/null 2>&1
```

## Deployment guidance

See `docs/deployment-guide.md` for preliminary guidance. Final deployment steps depend on the discovered source features and the Laravel implementation phases.

## Documentation

- `docs/architecture-overview.md`
- `docs/nextjs-to-laravel-mapping.md`
- `docs/database-mapping.md`
- `docs/route-mapping.md`
- `docs/feature-inventory.md`
- `docs/migration-plan.md`
- `docs/environment-variables.md`
- `docs/deployment-guide.md`
- `docs/testing-guide.md`
- `docs/assumptions-and-decisions.md`
- `docs/known-differences.md`
