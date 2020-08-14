# Symfony Test Task

## Technological stack

This project uses following technologies:

* [PHP](https://www.php.net/) - v7.2
* [Symfony](https://symfony.com/) - v5.1.3
* [Nginx](https://nginx.org/)
* [PostgreSQL](https://www.postgresql.org/) - v9.6
* [Docker & docker-compose](https://docs.docker.com/compose/gettingstarted/)

## Installation

#### Using docker-compose

```sh
$ docker-compose up -d
```

Go to docker-compose PHP service bash:
```sh
$ docker-compose exec php bash
```

Then execute:
```sh
$ composer install
$ php bin/console doctrine:migrations:migrate
$ php bin/console doctrine:fixtures:load

```

The app will start on `http://localhost:8081`

## API

The API has 3 endpoints:

#### GetUsersList
`GET /users` Get list of app users

#### RouletteSpin
`POST /roulette/spin` Spin the roulette

Request body:

- `api_key` User's api_key

#### GetStatistics
`GET /statistics` Get statistics of roulette spins