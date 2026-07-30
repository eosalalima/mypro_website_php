# Framework-free architecture

The application targets PHP 8.2.12 without Laravel, Vue, a Node runtime, or external runtime libraries. `public/index.php` is the front controller and explicit route table. `app/bootstrap.php` loads environment values, starts a hardened session, and sends baseline response headers. Small namespaced classes provide PDO connectivity, authentication, content queries, and view rendering. PHP views generate server-rendered HTML; `public/assets/app.js` adds only responsive navigation and cookie-notice interaction.

PDO prepared statements protect data operations. State-changing forms use session CSRF tokens. Admin routes call `Auth::requireAdmin()`, passwords use PHP's password APIs, contact submissions are validated, honeypot checked, session throttled, and store only a salted hash of the visitor IP.
