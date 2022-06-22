## Installation

```sh
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
```

## Starting the project

```sh
php artisan serve
php artisan schedule:work
node socket-server.js
```