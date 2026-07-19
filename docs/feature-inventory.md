# Feature Inventory

## Discovery status

Source feature discovery is blocked until the Next.js repository can be cloned or provided as an archive. The environment returned `CONNECT tunnel failed, response 403` for GitHub clone and remote inspection attempts.

## Confirmed target repository contents

The current target repository branch contains no application code beyond `.gitkeep`.

## Feature inventory template

Complete this table after inspecting the source repository.

| Module | Feature | Source files | User workflow | Laravel target | Status | Notes |
| --- | --- | --- | --- | --- | --- | --- |
| Authentication | TBD | TBD | Login/logout/register/reset/profile | Laravel auth stack, controllers, requests, policies | Pending source access | Do not assume provider until verified |
| Dashboard | TBD | TBD | TBD | Controller or Livewire dashboard | Pending source access | Identify widgets and data sources |
| User management | TBD | TBD | TBD | Eloquent models, policies, Livewire tables/forms | Pending source access | Identify roles and permissions |
| Reports/exports | TBD | TBD | Filters, totals, export/print | Controllers, services, queued exports | Pending source access | Verify file formats |
| File uploads | TBD | TBD | Upload/download/delete | Laravel Storage and validation requests | Pending source access | Verify storage backend |
| External integrations | TBD | TBD | API/webhook workflows | HTTP Client, API controllers, jobs | Pending source access | Verify secrets and signature checks |

## Inventory questions for source review

- Which pages are public, authenticated, or role-restricted?
- Which forms exist and what validation rules apply?
- Which workflows mutate data and require transactions?
- Which dashboards and reports aggregate data?
- Which components represent reusable design primitives?
- Which integrations require webhooks, scheduled jobs, queues, or retries?
