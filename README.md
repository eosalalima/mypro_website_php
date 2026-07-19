# MyPro Website PHP

A lightweight PHP portfolio website for MyProfessional Solutions, Inc. built without a PHP framework and using Vue.js for interactive UI state.

## Features

- PHP-rendered data source in `data.php`.
- Vue.js navigation and portfolio rendering.
- Responsive single-page marketing layout based on `Mypro - Portfolio 2026 v3.pdf`.
- Contact form handler that validates input and records inquiries in `storage/inquiries.log`.

## Run locally

```bash
php -S 127.0.0.1:8000
```

Then open `http://127.0.0.1:8000`.

## Notes

This project intentionally avoids PHP frameworks. Vue.js is loaded from a CDN for the UI layer.
