## Installation

### 1. Clone the repository
First, clone the repository to your local machine:

```bash
git clone https://github.com/leandro16197/Challenge.git
cd challenge
```
### 2. Set up Docker containers
    docker compose up -d

### 3. Run database migrations
    docker-compose exec laravel-challenge php artisan migrate
### 4. Run database seeders 
    docker-compose exec laravel-challenge php artisan db:seed
### 5. Access the application
    http://localhost:8000
### 6. Administrator Access

To access the application as an administrator, use the following credentials:

- **Email**: admin@example.com
- **Password**: password123
