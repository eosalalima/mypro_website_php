# Environment Variables

## Discovery status

Source environment variables could not be inspected because the primary Next.js repository was unavailable.

## Laravel baseline variables

The final `.env.example` should include Laravel defaults plus discovered application-specific variables.

| Variable | Purpose | Required | Source equivalent | Notes |
| --- | --- | --- | --- | --- |
| APP_NAME | Application name | Yes | TBD | Set during Laravel foundation |
| APP_ENV | Runtime environment | Yes | TBD | local/staging/production |
| APP_KEY | Laravel encryption key | Yes | N/A | Generated per environment |
| APP_DEBUG | Debug mode | Yes | TBD | Must be false in production |
| APP_URL | Public app URL | Yes | NEXT_PUBLIC_* or deployment URL | Verify source |
| DB_CONNECTION | Database driver | Yes | DATABASE_URL or DB vars | MySQL/MariaDB target |
| DB_HOST | Database host | Yes | TBD | Do not hardcode |
| DB_DATABASE | Database name | Yes | TBD | Do not hardcode |
| DB_USERNAME | Database username | Yes | TBD | Do not hardcode |
| DB_PASSWORD | Database password | Yes | TBD | Secret |
| QUEUE_CONNECTION | Queue backend | Yes | TBD | Required for jobs if discovered |
| MAIL_MAILER | Mail transport | If email used | TBD | Verify source email features |
| FILESYSTEM_DISK | Storage disk | If uploads used | TBD | local/public/s3 |

## Required follow-up

After source access is restored, compare `.env.example`, deployment configs, package scripts, and integration modules to populate all app-specific variables.
