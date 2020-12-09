# Tennis Player API

Backend Engineer Assessment. Problem 1.

## Business Requirements

- [x] A Player can have several tennis ball Containers.
- [x] Each Container has a specified capacity.
- [x] A Container is marked as ready when it is fully loaded with tennis balls.
- [x] The Player can put one tennis ball into a random Container. He can do this repeatedly until he is ready to play.
- [x] When one of the Player's Containers is ready, the Player is ready to play tennis.

## Postman Documentation API

Check [Postman Documentation](https://documenter.getpostman.com/view/12023164/TVmQfGUX) 

BaseURL [tennis.dika.web.id](http://tennis.dika.web.id) 

## Setup With Docker

### Setup

- `git clone https://github.com/ferdhika31/tennis-api.git`
- `cd tennis-api`
- `docker-compose build app`
- `docker-compose up -d`
- `docker-compose exec app composer install`
- `cp .env.example .env` or `copy .env.example .env`
- `docker-compose exec app php artisan migrate --seed`
- `docker-compose exec app php artisan passport:install`

Now that all containers are up, access from browser `localhost:8000`

### Running test suite race condition:

```bash
docker-compose exec app vendor/bin/phpunit tests
docker-compose exec app vendor/bin/phpunit tests/ContainerTest.php
```

### Stop 
- `docker-compose stop` to stop app


## Setup Without Docker

### Setup

- `git clone https://github.com/ferdhika31/tennis-api.git`
- `cd tennis-api`
- `composer install`
- `cp .env.example .env` or `copy .env.example .env`
- Edit database configuration
- `php artisan migrate --seed`
- `php artisan passport:install`
- `php -S localhost:8000 -t public`

### Running test suite:

```bash
vendor/bin/phpunit tests
vendor/bin/phpunit tests/ContainerTest.php
```

## Contributing

Thank you for considering contributing to Lumen! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Lumen, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## License

The Lumen framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
