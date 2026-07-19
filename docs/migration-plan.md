# Migration Plan

## Phase 1: Discovery

Status: Partially complete; blocked by source repository network access.

Completed:

- Verified current target repository contains no Laravel implementation yet.
- Attempted to clone the primary Next.js repository branch `main`.
- Created conservative migration planning documents without inventing unavailable source details.

Blocked:

- Source repository clone failed with `CONNECT tunnel failed, response 403`.

Next actions:

1. Provide repository access through network allowlisting, a local checkout, or an archive.
2. Run route, component, API, schema, dependency, and environment discovery.
3. Update all mapping documents with source-specific findings.
4. Only then begin Laravel foundation work.

## Phase 2: Foundation

- Scaffold Laravel using the stable version supported by the environment.
- Configure Vite, Tailwind CSS, Blade layouts, Livewire, and Alpine.js.
- Add Laravel authentication appropriate to the discovered source auth model.
- Establish coding standards and CI/test commands.

## Phase 3: Database

- Convert source schema to Laravel migrations and Eloquent models.
- Add factories, seeders, and data migration scripts.
- Preserve keys, constraints, and indexes where practical.

## Phase 4: Core Modules

Recommended order after discovery:

1. Authentication and user/profile management.
2. Roles and permissions.
3. Shared layout and navigation.
4. Master/reference data.
5. Transactional modules.
6. Dashboards.
7. Reports and exports.
8. Settings and integrations.

## Phase 5: Verification

- Compare Laravel behavior against the Next.js source.
- Run unit, feature, route, authorization, validation, API, upload, and integration tests.
- Test responsive UI and accessibility states.

## Phase 6: Deployment Preparation

- Document production environment, queues, scheduler, storage permissions, database deployment, backups, and rollback.
- Add Docker support if practical and aligned with deployment requirements.
