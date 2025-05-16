# Laravel Project with Docker Compose

## Copy from .env.example to .env

```bash
cp .env.example .env
php artisan key:generate

```

Populate with data

```bash
DB_HOST=db
DB_PORT=5432
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=secretpassword

POSTGRES_DB=laravel_db
POSTGRES_USER=laravel_user
POSTGRES_PASSWORD=secretpassword

```

## Starting Containers

Start the app and all related services:

```bash
docker-compose up -d
docker-compose exec app php artisan db:seed --class=EventSeeder
```

Access app via

```bash
http://localhost:8080
```
