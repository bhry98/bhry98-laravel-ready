# bhry98-laravel-ready

A Laravel starter package designed to help developers kickstart new Laravel projects with production-ready settings, pre-installed packages, and clean architecture structure. Ideal for rapid development with best practices in mind.

## 🚀 Features

- Laravel 11+ support
- Pre-configured user authentication
- API structure ready
- Role and permission management (spatie/laravel-permission)
- Laravel Sanctum for API authentication
- Centralized response and error handling
- Basic user and role seeders
- Ready-to-use `ApiController` and `BaseService` structure
- Laravel Debugbar (dev only)

## 📦 Included Packages

- `spatie/laravel-permission`
- `laravel/sanctum`
- `barryvdh/laravel-debugbar`
- `spatie/laravel-query-builder` (optional, for clean query handling)
- Custom helper functions

## 📂 Folder Structure Overview
## reset_password_attempt_limit
app/
├── Actions/
├── Http/
│ ├── Controllers/
│ │ ├── Api/
│ │ └── Auth/
│ ├── Middleware/
│ └── Requests/
├── Models/
├── Services/
routes/
├── api.php
├── web.php
config/
database/
├── seeders/

