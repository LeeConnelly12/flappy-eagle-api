# Flappy Eagle API

![tests workflow](https://github.com/LeeConnelly12/flappy-eagle-api/actions/workflows/ci.yml/badge.svg) [![Laravel Forge Site Deployment Status](https://img.shields.io/endpoint?url=https%3A%2F%2Fforge.laravel.com%2Fsite-badges%2F38b22622-1761-4088-a6fc-fa6fc8cd59b3&style=flat)](https://forge.laravel.com)

## Setup

Set alias for sail

```
alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'
```

Copy the .env.example file

```
cp .env.example .env
```

Install the composer dependencies

```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
```

Start the containers

```
sail up -d
```

Run migrations

```
sail artisan migrate
```

Run tests

```
sail artisan test
```
