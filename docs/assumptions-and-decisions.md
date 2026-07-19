# Assumptions and Decisions

## Decisions

1. Do not scaffold or rewrite the Laravel application before source discovery is complete.
2. Do not invent source routes, models, roles, modules, or integrations while source access is blocked.
3. Treat this repository as the target Laravel application repository.
4. Preserve existing URLs and workflows where practical once discovered.

## Assumptions

- The primary source of truth remains `https://github.com/eosalalima/mypro_website` branch `main`.
- The target should be one Laravel application unless discovery proves a separate service is required.
- MySQL or MariaDB will be the target relational database.
- Tailwind CSS remains the preferred styling system.

## Open questions

- Which authentication provider does the source application use?
- What database schema and ORM are present in the source?
- Which external services, webhooks, file storage systems, and scheduled jobs exist?
- Which user roles and permissions are required?
- Which reports and exports must be preserved?
