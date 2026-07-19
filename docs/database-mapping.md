# Database Mapping

## Discovery status

No Prisma, Drizzle, SQL, Supabase, or other database schema files are available in the current target checkout. The primary Next.js repository could not be accessed from this environment.

## Required source inspection

When source access is available, inspect these paths and patterns:

- `prisma/schema.prisma`
- `drizzle.config.*`
- `src/db/**`, `lib/db/**`, `database/**`, `supabase/**`
- SQL migration files
- ORM model definitions
- Seed scripts and fixtures
- API handlers and server actions for implicit relationships or constraints

## Mapping template

| Source model/table | Source fields | Relationships | Laravel model | Migration/table | Indexes/constraints | Notes |
| --- | --- | --- | --- | --- | --- | --- |
| TBD | TBD | TBD | TBD | TBD | TBD | Pending source access |

## Database migration principles

- Preserve source primary keys and foreign keys where practical.
- Document every renamed field before implementation.
- Add indexes for filters, joins, sorting, and uniqueness discovered in source behavior.
- Use Eloquent relationships and eager loading for list/detail pages.
- Use transactions for multi-step writes.
- Keep credentials out of source control.
