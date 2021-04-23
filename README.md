# Tiny Twitter System
Tiny Twitter System API and with user statistics using service repository design pattern.
## Packages Required

 - [Laravel 8.x](https://laravel.com/) 
 - [Laravel Sanctum](https://laravel.com/docs/8.x/sanctum)
 - [Laravel Follow](https://github.com/overtrue/laravel-follow)
 - [Laravel Ban](https://github.com/cybercog/laravel-ban)
 - [Laravel DOMPDF](https://github.com/barryvdh/laravel-dompdf)

## Installation

 - Clone the project, you can do it from running the following code.
 ```git clone https://github.com/bin0mial/tiny-twitter-system.git```
 - Add `.env` file take copy from `.env.example` and modify it.
 - Now you need to generate key for the application, for generating key run the following command
 ```php artisan key:generate```
 - Install composer packages
 ```composer install```
 - Now link the storage to the public directory
 ```php artisan storage:link```
- Finally migrate database
```php artian migrate```

## Application APIs
This application has mainly 4 APIs.

 ### Authentication APIs (Login, Register)
 - Authentication is divided into Login and Register, If you have to register providing those information `name`, `email`, `password`, `date_of_birth`, `image`
 on the following API endpoint
 ```http://localhost:8000/api/v1/register```
 - Login endpoint requires from you to provide `email`, `password` and `device_name`
on the following endpoint
```http://localhost:8000/api/v1/login```	
	 
 ### Statistics API
 - From this endpoint you can access system statistics and you have option to download it or just view it in form of PDF (users and number of tweets also total number of tweets ).
 You can access it from the following endpoint:
 ```http://localhost:8000/api/v1/statistics```
 
 ### Tweets API (Requires Authentication)
 - From this end point you can write a tweet with max length `140 characters` by providing `tweet` in the body and this endpoint required to be authenticated using bearer token on the following endpoint:
 ```http://localhost:8000/api/v1/tweets```

 ### Follows API (Requires Authentication)
 - From this endpoint you can follow another person but you can follow yourself all you have to do is just providing the `id` of the user you want to follow on the following endpoint:
 ```http://localhost:8000/api/v1/follows```


