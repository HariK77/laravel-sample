## About Laravel Codes

This is a [Laravel](https://laravel.com) Application, in which I try to implement different features ex: handling excel files, ajax, access management using plugins in backend. For front end I used bootstrap 5 and different javascript plugins.

## Implemented Features
- Implemented resourceful controllers(file uploads).
- Implemented database seeding (Product Table, Permissions Table).
- Implemented crud operations using Ajax(axios).
- Implemented export and import of excel files using [Laravel Excel](https://laravel-excel.com/).
- Implemented access management system with [Laravel Permission](https://spatie.be/docs/laravel-permission/v4/introduction)

## Setup Instructions
- Clone the repository using $ git clone https://github.com/HariK77/laravel-sample.git
- run $ composer install
- run $ sudo chmod -R 0777 storage/ 
- create a .env file ($ cp .env.example .env)
- configure db connections, create db.
- run $ php artisan key:generate
- run $ php artisan migrate
- access it using localhost/laravel-sample/public

