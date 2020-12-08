# Tennis Player API

Backend Engineer Assesment. Problem 1.

## Business Requirements

- [x] A Player can have several tennis ball Containers.
- [x] Each Container has a specified capacity.
- [x] A Container is marked as ready when it is fully loaded with tennis balls.
- [x] The Player can put one tennis ball into a random Container. He can do this repeatedly until he is ready to play.
- [x] When one of the Player's Containers is ready, the Player is ready to play tennis.

## Postman Documentation API

Check [Postman Documentation](https://documenter.getpostman.com/view/12023164/TVmQfGUX) 
BaseURL [tennis.dika.web.id](http://tennis.dika.web.id) 


## Install

### Clone Project
```bash
# Clone this repo
git clone https://github.com/ferdhika31/tennis-api.git
```

### Change Directory to Project
```bash
cd tennis-api
```

### Copy .env.example file
```bash
cp .env.example .env
```

### Fill .env Files

- Fill **APP_KEY**
- Fill **DB_HOST**
- Fill **DB_DATABASE**
- Fill **DB_USERNAME**
- Fill **DB_PASSWORD**

### Install dependency

```bash
composer install
```

### Migrate and install Laravel Passport

```bash
# Create new tables for Passport
php artisan migrate --seed

# Install encryption keys and other necessary stuff for Passport
php artisan passport:install
```

### Start server
```bash
php -S localhost:8000 -t public
```

### Running test suite:

```bash
vendor\bin\phpunit tests
vendor\bin\phpunit tests\ContainerTest.php
```

## Contributing

Thank you for considering contributing to Lumen! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Lumen, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## License

The Lumen framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
