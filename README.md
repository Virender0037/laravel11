Laravel 11 Product Management System

A structured Laravel 11 project demonstrating real-world CRUD with authentication, authorization, soft deletes, actions, and feature testing.

🚀 Features

Laravel 11

Authentication (Laravel Breeze)

Role-based access control (Admin / User)

Product CRUD

Policy-based authorization

Ownership via created_by

Soft Deletes

Restore & Permanent Delete (Admin only)

Blade @can UI protection

Action-based architecture (Create/Update/Delete/Restore/ForceDelete)

Feature Tests (Policy + Lifecycle)

SQLite testing environment

Seeders for demo data


You can use this credentails:

Admin

username:admin@admin.com
password:password

User

username:user@user.com
password:password

Installation
git clone https://github.com/Virender0037/laravel11.git
cd laravel11

composer install
npm install

Create environment file
cp .env.example .env
php artisan key:generate

Configure your database in .env
php artisan migrate:fresh --seed
npm run dev
php artisan serve





