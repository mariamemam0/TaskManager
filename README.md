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

---

## Features

- ✅ CRUD for Users, Projects and Tasks
- ✅ JWT Authentication
- ✅ Slug auto generation
- ✅ Soft Deletes for Projects and Tasks
- ✅ Priority for Tasks
- ✅ Request Validation
- ✅ API Resources and Collections
- ✅ Pagination
- ✅ Standardized API Responses

---

## Built With

- [Laravel 13](https://laravel.com)
- [MySQL](https://www.mysql.com)
- [PHP 8.4](https://www.php.net)
