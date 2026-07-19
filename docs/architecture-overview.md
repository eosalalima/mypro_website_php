# Architecture Overview

## Scope

This document records the Phase 1 discovery assessment for migrating the Next.js application in `https://github.com/eosalalima/mypro_website` into this Laravel target repository.

## Repository access status

The target repository checkout at `/workspace/mypro_website_php` is currently an empty Git branch containing only `.gitkeep`. The primary Next.js repository could not be cloned from this execution environment because outbound GitHub access failed with `CONNECT tunnel failed, response 403`.

Because the source repository contents are unavailable in this environment, this assessment is intentionally conservative and does not invent modules, routes, models, roles, integrations, or business rules. The migration plan documents the required discovery steps once repository access is available.

## Current target architecture

No Laravel application has been scaffolded yet. Per the migration request, implementation should not begin until the source application has been inspected and the discovery documents have been produced.

## Intended Laravel architecture

The Laravel implementation should use a modular, conventional structure:

```text
app/
├── Enums/
├── Events/
├── Exceptions/
├── Http/
│   ├── Controllers/
│   ├── Middleware/
│   ├── Requests/
│   └── Resources/
├── Jobs/
├── Listeners/
├── Livewire/
├── Models/
├── Notifications/
├── Policies/
├── Providers/
├── Repositories/
├── Services/
└── Support/
```

## Required architecture discovery checklist

When the primary repository is available, inspect:

1. `app/`, `pages/`, `src/app/`, and `src/pages/` for routing architecture.
2. `components/`, `src/components/`, and UI library configuration for reusable React components.
3. `middleware.ts`, route groups, and server actions for access control and workflow boundaries.
4. `prisma/`, `drizzle/`, Supabase configuration, SQL files, or ORM models for schema design.
5. `.env.example`, deployment files, and package scripts for runtime requirements.
6. API routes under `app/api`, `pages/api`, or equivalent service modules.
7. Authentication provider usage such as NextAuth/Auth.js, Clerk, Supabase Auth, custom sessions, or JWTs.
8. File upload, reporting, background job, email, and notification code paths.

## Preliminary migration position

The target should remain a single Laravel application unless discovery identifies a hard separation requirement such as an independently deployed webhook processor, queue worker, or external service.
