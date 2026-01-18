# Product API

REST API for product search and filtering.

## Tech Stack

- PHP 8.2
- Laravel 10
- MySQL 8.0
- Docker + Docker Compose
- Nginx

## Installation

### Requirements

- Docker Desktop
- Git

### Setup

1. Clone repository:
```bash
git clone https://github.com/MartinAkopyan/product-api.git
cd product-api
```

2. Copy environment file:
```bash
cp .env.example .env
```

3. Start Docker containers:
```bash
docker-compose up -d --build
```

4. Install dependencies:
```bash
docker-compose exec app composer install
```

5. Generate application key:
```bash
docker-compose exec app php artisan key:generate
```

6. Run migrations and seed database:
```bash
docker-compose exec app php artisan migrate --seed
```

7. Access API:
```
http://localhost:8080/api/products
```

## API Documentation

### Endpoint

```
GET /api/products
```

### Query Parameters

| Parameter | Type | Description |
|-----------|------|-------------|
| q | string | Search by product name |
| price_from | numeric | Minimum price |
| price_to | numeric | Maximum price |
| category_id | integer | Filter by category ID |
| in_stock | boolean | Filter by stock availability |
| rating_from | numeric | Minimum rating (0-5) |
| sort | string | Sorting option |
| page | integer | Page number |
| per_page | integer | Items per page (10-100) |

### Sort Options

| Value | Description |
|-------|-------------|
| price_asc | Price ascending |
| price_desc | Price descending |
| rating_desc | Rating descending |
| newest | Newest first |

### Example Requests

```bash
# All products
curl "http://localhost:8080/api/products"

# Search by name
curl "http://localhost:8080/api/products?q=laptop"

# Filter by price range
curl "http://localhost:8080/api/products?price_from=100&price_to=500"

# Filter by category and stock
curl "http://localhost:8080/api/products?category_id=1&in_stock=true"

# Combined filters with sorting
curl "http://localhost:8080/api/products?q=laptop&price_from=500&rating_from=4&sort=price_asc&per_page=10"
```

## Author

Martin Akopyan
