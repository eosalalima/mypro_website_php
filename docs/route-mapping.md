# Route Mapping

## Discovery status

No source routes could be inspected because the primary Next.js repository is not available in this environment.

## Route mapping template

| Existing Next.js URL | New Laravel URL | Method | Controller/Livewire component | Middleware | Permission | Parameters | Response | Status |
| --- | --- | --- | --- | --- | --- | --- | --- | --- |
| TBD | Preserve where practical | GET/POST/etc. | TBD | TBD | TBD | TBD | Blade/JSON/redirect | Pending source access |

## Source route discovery checklist

- App Router pages: `app/**/page.tsx`, `app/**/layout.tsx`, `app/**/route.ts`.
- Pages Router pages: `pages/**/*.tsx`, `pages/api/**/*.ts`.
- Dynamic routes: bracketed paths such as `[id]`, `[slug]`, and catch-all routes.
- Redirects and rewrites: `next.config.*`.
- Middleware route matchers: `middleware.ts`.
- Links and navigation: components containing `href`, `Link`, menus, sidebars, breadcrumbs.

## Laravel routing principles

- Preserve public URLs when practical.
- Group authenticated routes under `auth` middleware.
- Apply policies for record-level access.
- Use named routes for all Blade navigation.
- Use API controllers and Sanctum only when API token authentication is required.
