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

 

## Request Data Model (Laboratory 2)

**Database name:** laravel_request_system_db

### `requests` table fields
| Field | Type | Constraint | Purpose |
|---|---|---|---|
| id | bigint unsigned | PK | Unique request number |
| requester_name | string(100) | required | Person submitting |
| requester_email | string(255) | required | Contact address |
| item_name | string(150) | required | Item or service |
| quantity | unsigned integer | required | Requested quantity |
| purpose | text | required | Reason for request |
| status | string(20) | default `pending` | Request state |
| created_at / updated_at | timestamps | | Creation / update times |

### Migration command
`php artisan migrate`

### Verify the table
1. Run `php artisan migrate:status` and confirm `create_requests_table` is "Ran".
2. Open phpMyAdmin, select the database, and check the `requests` table structure.
3. Run `SELECT id, requester_name, item_name, quantity, status FROM requests;`

### User stories
1. As a requester, I want to submit my name, email, item, quantity, and purpose so that staff know what I need.
2. As a staff reviewer, I want each request to show a status so that I can tell which ones still need review.
3. As a record keeper, I want a unique request number and timestamps on each request so that I can audit records.



## Laboratory 3: Secure Request Access

### Ownership and access rules
- Guests are redirected to the login page.
- Students list and view only their own requests. Ownership is decided by `user_id`, never by name or email.
- Authenticated students may create requests. The initial status is always `pending`.
- Only administrators may list all requests and update status.
- **Denied access returns HTTP 403** for another student's record. This response is applied consistently through `Gate::authorize`.

### Route summary
| Method | Route | Access |
|---|---|---|
| GET | /login, POST /login | Guests |
| POST | /logout | Signed-in users |
| GET | /requests | Signed-in; students see only their own, admin sees all |
| GET | /requests/create | Students |
| POST | /requests | Students |
| GET | /requests/{id} | Owner or administrator |
| PATCH | /requests/{id}/status | Administrator only |

### Setup and migration steps
1. `composer install`
2. Copy `.env.example` to `.env`, then `php artisan key:generate`
3. Create the MySQL database `laravel_request_system_db` and set the DB values in `.env`
4. `php artisan migrate`
5. `php artisan db:seed --class=Lab3Seeder` (creates fictional admin, Student A and Student B)
6. `php artisan serve`

### File responsibilities
- Policy (`app/Policies/ServiceRequestPolicy.php`): FULL NAME 1
- Controller (`app/Http/Controllers/ServiceRequestController.php`): FULL NAME 1
- Routes (`routes/web.php`): FULL NAME 1
- Views (`resources/views/requests/`): FULL NAME 2
- Tests and test matrix: FULL NAME 2

### Testing steps
Use separate browser sessions for Student A, Student B, the administrator and a guest. Run tests T01 to T10 from the Laboratory 3 matrix and compare database values before and after each write attempt.

### Dependency audit and exposed secrets
`composer audit` was run and its result is recorded in the Laboratory 3 report. An exposed secret must be revoked or rotated, removed from the code, and the repository history addressed. Deleting the file alone is not enough.