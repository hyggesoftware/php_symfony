# Symfony Test Task

### Technological stack

This project uses following technologies:

* [PHP](https://www.php.net/) - v7.2
* [Symfony](https://symfony.com/) - v5.1.3
* [Nginx](https://nginx.org/)
* [PostgreSQL](https://www.postgresql.org/) - v9.6
* [Docker & docker-compose](https://docs.docker.com/compose/gettingstarted/)

### Installation

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