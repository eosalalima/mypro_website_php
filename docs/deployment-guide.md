# Deployment guide

Use a currently supported PHP 8.2 patch compatible with the project's exact 8.2.12 platform target, PDO, HTTPS, and MySQL/MariaDB in production. Point the document root at `public/`; never expose `.env`, `app`, `storage`, `scripts`, or Composer metadata. Apache can use the included `.htaccess`; Nginx should route missing paths to `index.php`.

Install Composer autoloading, populate `.env`, run the idempotent installer, create the initial admin through environment values and the CLI, remove the plaintext provisioning password, and make only `storage` writable. Set secure sessions, disable debug output, configure PHP mail delivery and log rotation, and establish encrypted database/file backups with restoration tests.
