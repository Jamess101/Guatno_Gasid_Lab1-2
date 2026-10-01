# Laravel Request System

## Project Description
A Laravel web application for managing requests, using MySQL as its database.
Developed as Laboratory 1 for DevOps.

## Student Information
- Name: Gasid, Ralph James G
        Guatno James Phillip
- Course: BSIT 4 - 3

## Software Requirements
- PHP 8.2 or newer
- Composer
- MySQL / MariaDB (XAMPP or Laragon)
- Git
- phpMyAdmin (optional)

## Laravel Installation Instructions
1. Clone the repository:
   git clone https://github.com/YOUR-USERNAME/laravel-request-system.git
2. Go into the folder: cd laravel-request-system
3. Install dependencies: composer install
4. Copy the environment file: copy .env.example .env
   (Mac/Linux: cp .env.example .env)
5. Generate the app key: php artisan key:generate

## Database Name
laravel_request_system_db

## Database Import Instructions
1. Start MySQL and open phpMyAdmin.
2. Create a database named laravel_request_system_db.
3. Either import the provided laravel_request_system_db.sql file using the
   *Import* tab, or run php artisan migrate.
4. Set your own MySQL username and password in .env
   (never commit this file).

## Commands to Run the Project
php artisan migrate
php artisan serve

Then open http://127.0.0.1:8000

## GitHub Repository
https://github.com/Jamess101/Guatno_Gasid_Lab1-2.git

