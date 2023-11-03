# Morele.net recruitment task

## About The Project

Movie search engine made as a recruitment task

### Built With

- [PHP](https://www.php.net/)
- [Symfony](https://symfony.com/)
- [Docker](https://www.docker.com/)
- [Compose](https://docs.docker.com/compose/)

## Getting Started

### Installation

Follow these simple steps

#### Clone API repository

```bash
git clone git@github.com:RyuuKodex/movie-search-engine.git
```

1. Run `docker compose build --pull --no-cache` to build fresh images
2. Run `docker compose up` (the logs will be displayed in the current shell)

## Endpoint

#### 

```http
  GET /api/movies/search?algorithm=<algorithm>
  
  List of algorithms:
  - random
  - startsWithW
  - moreThanOneWord
```

## Commands

#### Start the project

```bash
docker compose up -d
```

#### Connect to app container

```bash
docker compose exec app bash
```

#### Stop project

```bash
docker compose down --remove-orphans
```

#### Run tests in the container

```bash
php bin/phpunit --do-not-cache-result --testsuite unit
```

#### Run code lint in the container

```bash
vendor/bin/php-cs-fixer fix --allow-risky=yes
```