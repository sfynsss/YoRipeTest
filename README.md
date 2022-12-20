<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Getting started

## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/5.4/installation#installation)

Alternative installation is possible without local dependencies relying on [Docker](#docker). 

Clone the repository

    git clone git@github.com:sfynsss/YoRipeTest.git

Switch to the repo folder

    cd YoRipeTest

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate --seed

Start the local development server

    php artisan serve

You can now access postman, login using users in database seeder

## Route List
+--------+----------+---------------------+------+------------------------------------------------------------+------------------------------------------+
| Domain | Method   | URI                 | Name | Action                                                     | Middleware                               |
+--------+----------+---------------------+------+------------------------------------------------------------+------------------------------------------+
|        | GET|HEAD | /                   |      | Closure                                                    | web                                      |
|        | POST     | api/create-posts    |      | App\Http\Controllers\API\PostsController@store             | api                                      |
|        |          |                     |      |                                                            | App\Http\Middleware\Authenticate:sanctum |
|        | POST     | api/create-users    |      | App\Http\Controllers\API\UsersController@store             | api                                      |
|        |          |                     |      |                                                            | App\Http\Middleware\Authenticate:sanctum |
|        |          |                     |      |                                                            | App\Http\Middleware\Authenticate         |
|        |          |                     |      |                                                            | App\Http\Middleware\IsAdmin              |
|        | POST     | api/delete-posts    |      | App\Http\Controllers\API\PostsController@delete            | api                                      |
|        |          |                     |      |                                                            | App\Http\Middleware\Authenticate:sanctum |
|        | POST     | api/delete-users    |      | App\Http\Controllers\API\UsersController@delete            | api                                      |
|        |          |                     |      |                                                            | App\Http\Middleware\Authenticate:sanctum |
|        |          |                     |      |                                                            | App\Http\Middleware\Authenticate         |
|        |          |                     |      |                                                            | App\Http\Middleware\IsAdmin              |
|        | POST     | api/login           |      | App\Http\Controllers\API\AuthController@login              | api                                      |
|        | POST     | api/logout          |      | App\Http\Controllers\API\AuthController@logout             | api                                      |
|        |          |                     |      |                                                            | App\Http\Middleware\Authenticate:sanctum |
|        | GET|HEAD | api/posts           |      | App\Http\Controllers\API\PostsController@index             | api                                      |
|        |          |                     |      |                                                            | App\Http\Middleware\Authenticate:sanctum |
|        | GET|HEAD | api/posts/{id}      |      | App\Http\Controllers\API\PostsController@show              | api                                      |
|        |          |                     |      |                                                            | App\Http\Middleware\Authenticate:sanctum |
|        | GET|HEAD | api/profile         |      | Closure                                                    | api                                      |
|        |          |                     |      |                                                            | App\Http\Middleware\Authenticate:sanctum |
|        | POST     | api/register        |      | App\Http\Controllers\API\AuthController@register           | api                                      |
|        | POST     | api/update-posts    |      | App\Http\Controllers\API\PostsController@update            | api                                      |
|        |          |                     |      |                                                            | App\Http\Middleware\Authenticate:sanctum |
|        | POST     | api/update-users    |      | App\Http\Controllers\API\UsersController@update            | api                                      |
|        |          |                     |      |                                                            | App\Http\Middleware\Authenticate:sanctum |
|        |          |                     |      |                                                            | App\Http\Middleware\Authenticate         |
|        |          |                     |      |                                                            | App\Http\Middleware\IsAdmin              |
|        | GET|HEAD | api/users           |      | App\Http\Controllers\API\UsersController@index             | api                                      |
|        |          |                     |      |                                                            | App\Http\Middleware\Authenticate:sanctum |
|        |          |                     |      |                                                            | App\Http\Middleware\Authenticate         |
|        |          |                     |      |                                                            | App\Http\Middleware\IsAdmin              |
|        | GET|HEAD | api/users/{id}      |      | App\Http\Controllers\API\UsersController@show              | api                                      |
|        |          |                     |      |                                                            | App\Http\Middleware\Authenticate:sanctum |
|        |          |                     |      |                                                            | App\Http\Middleware\Authenticate         |
|        |          |                     |      |                                                            | App\Http\Middleware\IsAdmin              |
|        | GET|HEAD | sanctum/csrf-cookie |      | Laravel\Sanctum\Http\Controllers\CsrfCookieController@show | web                                      |
+--------+----------+---------------------+------+------------------------------------------------------------+------------------------------------------+
