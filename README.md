# Lumen PHP Framework

[![Build Status](https://travis-ci.org/laravel/lumen-framework.svg)](https://travis-ci.org/laravel/lumen-framework)
[![Total Downloads](https://img.shields.io/packagist/dt/laravel/framework)](https://packagist.org/packages/laravel/lumen-framework)
[![Latest Stable Version](https://img.shields.io/packagist/v/laravel/framework)](https://packagist.org/packages/laravel/lumen-framework)
[![License](https://img.shields.io/packagist/l/laravel/framework)](https://packagist.org/packages/laravel/lumen-framework)

Laravel Lumen is a stunningly fast PHP micro-framework for building web applications with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Lumen attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as routing, database abstraction, queueing, and caching.

## Official Documentation

Documentation for the framework can be found on the [Lumen website](https://lumen.laravel.com/docs).

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

### Fill APP_KEY

Fill **APP_KEY** in **.env** files.

### Start server
```bash
php -S localhost:8000 -t public
```

### Running test suite:

```bash
vendor\bin\phpunit tests
vendor\bin\phpunit tests\ContainerTest.php
```

### Postman Docummentation API

Check [Postman](https://documenter.getpostman.com/view/12023164/TVmQfGUX) 


## Contributing

Thank you for considering contributing to Lumen! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Lumen, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## License

The Lumen framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
