# Database mapping

The schema intentionally uses four maintainable tables:

- `users`: administrator identity, unique email, password hash, and role.
- `contents`: typed records for services, solutions, industries, projects, testimonials, and FAQs; unique `(type, slug)`, publishing state, order, featured flag, and SEO fields.
- `inquiries`: submitted contact details, consent, workflow status, timestamp, and non-reversible IP hash.
- `settings`: unique administrator/configuration values including verified company contacts.

`scripts/install.php` supports SQLite and MySQL/MariaDB through PDO and can be run repeatedly. Content types share a table because their editorial lifecycle and fields are identical; the composite uniqueness constraint keeps URLs stable within each type.
