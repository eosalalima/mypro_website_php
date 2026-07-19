# Deployment Guide

## Status

Deployment instructions are preliminary because the Laravel application has not been scaffolded and source runtime requirements are pending discovery.

## Target deployment outline

1. Provision PHP, Composer, web server, MySQL/MariaDB, Redis if queues/cache require it, and Node.js only for Vite asset builds.
2. Install Composer dependencies.
3. Build frontend assets with Vite.
4. Configure `.env` with production-safe secrets.
5. Run database migrations after backups and rollout approval.
6. Configure queue workers for queued jobs.
7. Configure Laravel Scheduler with a per-minute cron entry if scheduled tasks are required.
8. Configure storage symlinks and private/public disks.
9. Disable debug mode in production.
10. Monitor logs, queues, scheduled commands, and failed jobs.

## Pending source-dependent items

- External service secrets and callback URLs.
- Webhook endpoints and signature verification.
- File storage backend.
- Queue and scheduler requirements.
- Report/export generation dependencies.
