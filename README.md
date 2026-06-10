# Task Manager API 📝

A RESTful API built with Laravel for managing projects and tasks.

---

## Requirements

- PHP >= 8.4
- Composer
- MySQL
- Laravel 13

---

## Installation

```bash
# Clone the repository
git clone https://github.com/your-username/task-manager.git

# Go to project folder
cd task-manager

# Install dependencies
composer install

# Copy env file
cp .env.example .env

# Generate app key
php artisan key:generate

# Configure database in .env
DB_DATABASE=taskmanager
DB_USERNAME=root
DB_PASSWORD=

# Run migrations and seed
php artisan migrate --seed

# Start the server
php artisan serve
```

---

## API Endpoints

### Users
| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/users` | Get all users |
| POST | `/api/users` | Create a user |
| GET | `/api/users/{id}` | Get a user |
| PUT | `/api/users/{id}` | Update a user |
| DELETE | `/api/users/{id}` | Delete a user |

### Projects
| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/projects` | Get all projects |
| POST | `/api/projects` | Create a project |
| GET | `/api/projects/{id}` | Get a project |
| PUT | `/api/projects/{id}` | Update a project |
| DELETE | `/api/projects/{id}` | Delete a project |

### Tasks
| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/tasks` | Get all tasks |
| POST | `/api/tasks` | Create a task |
| GET | `/api/tasks/{id}` | Get a task |
| PUT | `/api/tasks/{id}` | Update a task |
| DELETE | `/api/tasks/{id}` | Delete a task |


### Comments
 
| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/comments` | Get all comments |
| POST | `/api/comments` | Create a comment |
| GET | `/api/comments/{id}` | Get a comment |
| PUT | `/api/comments/{id}` | Update a comment |
| DELETE | `/api/comments/{id}` | Delete a comment |
 
---
 
## Search & Filter
 
The tasks endpoint supports search and filter via query parameters.
 
### Filter by status
 
```
GET /api/tasks?status=pending
GET /api/tasks?status=in_progress
GET /api/tasks?status=completed
```
 
### Filter by priority
 
```
GET /api/tasks?priority=low
GET /api/tasks?priority=medium
GET /api/tasks?priority=high
```
 
### Search by keyword
 
Searches inside `title` and `description`:
 
```
GET /api/tasks?search=bug
```
 
### Combine filters
 
```
GET /api/tasks?status=pending&priority=high
GET /api/tasks?status=pending&search=bug
GET /api/tasks?status=pending&priority=high&search=fix
```
---

## Features

- ✅ CRUD for Users, Projects, Tasks and Comments
- ✅ JWT Authentication
- ✅ Search & Filter for Tasks
- ✅ Slug auto generation
- ✅ Soft Deletes for Projects and Tasks
- ✅ Polymorphic Comments
- ✅ Priority levels for Tasks (low, medium, high)
- ✅ Request Validation
- ✅ API Resources and Collections
- ✅ Pagination
- ✅ Standardized API Responses

---

## Built With

- [Laravel 13](https://laravel.com)
- [MySQL](https://www.mysql.com)
- [PHP 8.4](https://www.php.net)
- [php-open-source-saver/jwt-auth](https://github.com/PHP-Open-Source-Saver/jwt-auth)
 
