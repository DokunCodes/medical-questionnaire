<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Project

The project is a questionnaire recommender system for people suffering from erectile dysfunction.

## Project Stack
- Laravel 10
- Vue 3
- Laravel Inertia
- MySQL Database
- Tailwind CSS

## Project Requirements
1. PHP 8.1
2. MYSQL 8.0
3. Composer
4. NodeJS 16.x
5. NPM 8.x
6. Laravel CLI
7. Git


## Steps to run the project
1. Clone the project
2. Run `composer install`
3. Run `php artisan key:gen`
4. Run `npm install`
5. Create a database and update the .env file with the database credentials
6. Run `php artisan migrate:fresh --seed`
7. Run `php artisan serve`
8. Run `npm run dev` to compile the assets
9. Visit `http://localhost:8000` to view the project
10. Login with the following credentials:
    - Email: `admin@manual.co'
    - Password: `password`
    - Role: `admin`
    - Note: The admin user is seeded with the database


## Steps to test Endpoints
1. Open postman and fetch the following endpoints:
2. METHOD:GET - `http://localhost:8000/api/v1/questionnaire`
3. METHOD:POST - `http://localhost:8000/api/v1/recommendations`
    Request Payload 
   { "userOption": 31 }
