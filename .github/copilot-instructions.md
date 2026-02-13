Project: UTP Cable Lab — AI assistant instructions

Overview
- This is a small Laravel 12 monolithic app (PHP ^8.2) that simulates UTP cable preparation.
- HTTP entrypoints are defined in [routes/web.php](routes/web.php#L1). The main UI is the Blade view at [resources/views/cable/index.blade.php](resources/views/cable/index.blade.php#L1).
- Server game logic lives in `App\\Http\\Controllers\\CableController` ([app/Http/Controllers/CableController.php](app/Http/Controllers/CableController.php#L1)). That controller exposes JSON endpoints `/shuffle` and `/check` used by the frontend.

What to know before editing
- The controller defines canonical wire orders: `T568A` and `T568B`. These are the authoritative arrays used for validation and scoring. If you change wire identifiers, update both the controller and any frontend code that expects the same strings.
- The current UI uses inline JavaScript in the Blade view (not a separate SPA). Many UI behaviors (colors, wire labels, click handlers) are implemented directly inside [resources/views/cable/index.blade.php](resources/views/cable/index.blade.php#L1). Edit there for quick UI changes; ensure route/controller JSON shape remains compatible.

Dev & common commands
- Install PHP deps: `composer install`
- Install node deps: `npm install`
- Start full dev environment (mirrors repo dev script):
  - `composer run dev` — this runs `php artisan serve`, queue listener, pail, and `npm run dev` using `concurrently`.
  - If you only need assets: `npm run dev` (Vite dev server).
- Build assets: `npm run build` (runs `vite build`).
- Tests: `composer run test` or `php artisan test`.
- Code style: `vendor/bin/pint` (project includes `laravel/pint`).

Database and local setup
- The composer `post-create-project-cmd` will attempt to create `database/database.sqlite` and run migrations. For local manual setup:
  - `copy .env.example .env`
  - `php artisan key:generate`
  - `touch database/database.sqlite` (or create the file on Windows)
  - `php artisan migrate`

Project-specific patterns & gotchas
- Naming & data shape: the controller returns JSON arrays of lowercase wire identifiers like `white-orange`, `green`, `brown`, etc. Frontend code must send/expect the same strings for `/check` to validate correctly. Example: the controller compares the incoming `wires` array directly to its `T568A`/`T568B` arrays.
- Frontend vs server source of truth: the view has a local `wireColors` JS constant (colors and display names). If you change the canonical wire IDs in the controller, update `wireColors` in `resources/views/cable/index.blade.php` to match.
- Routes are minimal and explicit — prefer modifying `routes/web.php` when adding simple endpoints. For larger features, follow Laravel conventions: controllers, requests, resources, and Blade views.
- Localization: UI text is written in Indonesian in places — be conscious of language when editing strings.

Where to look for examples
- Game logic / scoring: [app/Http/Controllers/CableController.php](app/Http/Controllers/CableController.php#L1)
- Main UI and inline JS: [resources/views/cable/index.blade.php](resources/views/cable/index.blade.php#L1)
- Routes: [routes/web.php](routes/web.php#L1)
- Composer scripts that orchestrate dev workflow: [composer.json](composer.json#L1)

How the AI assistant should behave
- When changing wire identifiers or the validation logic, make coordinated edits to `CableController` and the Blade view `wireColors`/AJAX code.
- Prefer minimal, atomic changes with tests or manual verification steps listed in the PR description (how to run `composer run dev`, where to click in the UI, expected JSON shape).
- Avoid assumptions about external services — this repo runs locally using SQLite/migrations; do not add external integrations without noting them in the PR.

If unsure, ask
- Which side should be authoritative for wire metadata (controller vs view)?
- Should any UI behavior be moved from inline JS into separate assets (Vite + resources/js)?

End of instructions.
