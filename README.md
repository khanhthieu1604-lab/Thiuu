# 🚗 Car Rental – Laravel Project

Dự án web thuê & mua xe được xây dựng bằng Laravel.

## Tech Stack
- Laravel
- PHP >= 8.2
- MySQL
- Blade
- Docker (optional)

## Setup (Local)
```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
