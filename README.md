# Technical-Test-02-Symfony

We present the second technical test with PHP/Symfony; Create an IoT device monitoring application. You can see the [Instructions here]().

## To start

This project was developed with PHP 8.1.

### Prerequisites

- A machine with at least PHP 8.1.
- Composer
- Symfony CLI

### Installation

- Clone or download the repository
- Duplicate and rename the `.env` file to `.env.local` and modify the necessary information and choose your database (`APP_ENV`, `APP_SECRET`, ...)
- Install the dependencies with `symfony composer install --optimize-autoloader`
- Run migrations with `symfony console doctrine:migrations:migrate --no-interaction`
- Add default datasets with `symfony console doctrine:fixtures:load --no-interaction`
- with bash terminal run `while true; do php bin/console app:create-datas; sleep 86400; done`

## Startup

- Locally run your database
- Run the app with `symfony serve -d`

## Features

- Datafixtures
- A script which generates automaticaly modules Iot values and simulates failure during 10 days.

## Made with

* [Composer](https://getcomposer.org/) - Dependancy manager
* [Visual Studio code](https://code.visualstudio.com/) - Code editor

## Author

* **Ishake FOUHAL** _alias_ [@IF-WEB-DEV](https://github.com/if-web-dev)