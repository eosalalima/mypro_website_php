# Testing Guide

## Current status

No executable Laravel test suite exists yet because the repository has not been scaffolded. Phase 1 documentation checks are limited to file creation and Git status verification.

## Required future test coverage

- Authentication workflows.
- Authorization and policy checks.
- Route access and redirects.
- Form Request validation.
- Model relationships and database constraints.
- CRUD workflows for each migrated module.
- API endpoints and JSON resources.
- File upload validation, storage, and access-controlled downloads.
- Reports, filters, pagination, exports, and large dataset behavior.
- Regression tests for discovered business rules.

## Suggested commands after Laravel foundation

```bash
composer test
php artisan test
npm run build
npm run lint
```

Update this guide with the actual commands once the Laravel stack is installed.
