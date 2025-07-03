# 🧱 bhry98-laravel-ready

A Laravel starter package designed to help developers kickstart new Laravel projects with production-ready settings, pre-installed packages, and a clean architecture structure. Ideal for **rapid development** with **best practices** in mind.

---

## 🚀 Features

- ✅ Laravel 11+ support
- 🔒 Pre-configured user authentication
- 🧰 API structure ready for Laravel Sanctum
- 🔐 Role and permission management using `spatie/laravel-permission`
- 📦 Centralized response and error handling
- 👥 Basic user and role seeders
- 🧱 Modular architecture with `ApiController` and `BaseService`
- 🐞 Laravel Debugbar for development debugging
- 🛠️ Helper functions and traits included

---

## 📦 Included Packages

- [`spatie/laravel-permission`](https://github.com/spatie/laravel-permission)
- [`laravel/sanctum`](https://laravel.com/docs/sanctum)
- [`barryvdh/laravel-debugbar`](https://github.com/barryvdh/laravel-debugbar)
- [`spatie/laravel-query-builder`](https://github.com/spatie/laravel-query-builder) *(optional)*
- Custom helper functions and service classes

---

## 📂 Folder Structure Overview

```plaintext
app/
├── Actions/
├── Http/
│   ├── Controllers/
│   │   ├── Api/
│   │   └── Auth/
│   ├── Middleware/
│   └── Requests/
├── Models/
├── Services/

routes/
├── api.php
├── web.php

config/
database/
├── seeders/
```

## 📚 Documentation

- 🔗 [Users Management Overview »](docs/users-management-overview.md)  
- 🔗 [RBAC (Roles & Permissions) Overview »](docs/rbac-overview.md)  
- 🔗 [Enums System Overview »](docs/enums-overview.md)

---

## 🚫 Security: Reset Password Attempt Limit

A configurable limit on failed password reset attempts is built in to reduce brute-force attacks.  
It can be customized via `config/auth.php` or through your own middleware logic.
