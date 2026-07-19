# Next.js to Laravel Mapping

## Global mapping strategy

| Next.js implementation | Laravel replacement |
| --- | --- |
| App Router page | Laravel route, thin controller, and Blade view |
| Pages Router page | Laravel route, thin controller, and Blade view |
| React component | Blade component for static/reusable UI, Livewire component for stateful UI, Alpine.js for small interactions |
| Server component | Controller/service prepared view data rendered by Blade |
| Client component | Livewire or Alpine.js depending on interaction complexity |
| Server action | Controller method, service class method, queued job, or Livewire action |
| API route | Laravel API controller with Form Request validation and API Resources |
| Middleware | Laravel middleware, policies, gates, and route middleware groups |
| Prisma/Drizzle model | Eloquent model, migration, factory, and seeder |
| Zod/Yup validation | Laravel Form Request rules and custom validation rules |
| NextAuth/Auth.js/Clerk/Supabase Auth | Laravel authentication, policies, gates, Sanctum where token auth is needed |
| React state | Livewire public properties/computed data or Alpine.js local state |
| Cron job | Laravel Scheduler command |
| Background operation | Laravel queued job and event/listener pipeline |
| Next.js image handling | Laravel Storage, signed routes for private files, and image optimization service |
| Environment variables | `.env.example` entries and Laravel config files |

## Route-level mapping

Route-level mapping cannot be completed until source routes are available. See `docs/route-mapping.md` for the pending route inventory template.

## Component-level mapping

Component-level mapping cannot be completed until React component files are available. During discovery, classify components as:

- Layout components: convert to Blade layouts/components.
- Form components: convert to Blade components plus Form Requests; use Livewire for dynamic forms.
- Data tables and filters: convert to Livewire components with pagination and eager loading.
- Modals/dropdowns/tabs: convert to Alpine.js unless server state is required.
- Dashboard widgets: convert to Blade components backed by query/service classes.
