<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiny-Hotel-System</title>
    <link rel="stylesheet" href="https://stackedit.io/style.css"/>
</head>

<body class="stackedit">
<div class="stackedit__html"><h1 id="tiny-twitter-system">Tiny Twitter System</h1>
    <p>Tiny Twitter System API and with user statistics using service repository design pattern.</p>
    <h2 id="packages-required">Packages Required</h2>
    <ul>
        <li><a href="https://laravel.com/">Laravel 8.x</a></li>
        <li><a href="https://laravel.com/docs/8.x/sanctum">Laravel Sanctum</a></li>
        <li><a href="https://github.com/overtrue/laravel-follow">Laravel Follow</a></li>
        <li><a href="https://github.com/cybercog/laravel-ban">Laravel Ban</a></li>
        <li><a href="https://github.com/barryvdh/laravel-dompdf">Laravel DOMPDF</a></li>
    </ul>
    <h2 id="installation">Installation</h2>
    <ul>
        <li>Clone the project, you can do it from running the following code.<br>
            <code>git clone https://github.com/bin0mial/tiny-twitter-system.git</code></li>
        <li>Add <code>.env</code> file take copy from <code>.env.example</code> and modify it.</li>
        <li>Now you need to generate key for the application, for generating key run the following command<br>
            <code>php artisan key:generate</code></li>
        <li>Install composer packages<br>
            <code>composer install</code></li>
        <li>Now link the storage to the public directory<br>
            <code>php artisan storage:link</code></li>
        <li>Finally migrate database<br>
            <code>php artian migrate</code></li>
    </ul>
    <h2 id="application-apis">Application APIs</h2>
    <p>This application has mainly 4 APIs.</p>
    <h3 id="authentication-apis-login-register">Authentication APIs (Login, Register)</h3>
    <ul>
        <li>Authentication is divided into Login and Register, If you have to register providing those information
            <code>name</code>, <code>email</code>, <code>password</code>, <code>date_of_birth</code>, <code>image</code><br>
            on the following API endpoint<br>
            <code>http://localhost:8000/api/v1/register</code></li>
        <li>Login endpoint requires from you to provide <code>email</code>, <code>password</code> and
            <code>device_name</code><br>
            on the following endpoint<br>
            <code>http://localhost:8000/api/v1/login</code></li>
    </ul>
    <h3 id="statistics-api">Statistics API</h3>
    <ul>
        <li>From this endpoint you can access system statistics and you have option to download it or just view it in
            form of PDF (users and number of tweets also total number of tweets ).<br>
            You can access it from the following endpoint:<br>
            <code>http://localhost:8000/api/v1/statistics</code></li>
    </ul>
    <h3 id="tweets-api-requires-authentication">Tweets API (Requires Authentication)</h3>
    <ul>
        <li>From this end point you can write a tweet with max length <code>140 characters</code> by providing <code>tweet</code>
            in the body and this endpoint required to be authenticated using bearer token on the following endpoint:<br>
            <code>http://localhost:8000/api/v1/tweets</code></li>
    </ul>
    <h3 id="follows-api-requires-authentication">Follows API (Requires Authentication)</h3>
    <ul>
        <li>From this endpoint you can follow another person but you can follow yourself all you have to do is just
            providing the <code>id</code> of the user you want to follow on the following endpoint:<br>
            <code>http://localhost:8000/api/v1/follows</code></li>
    </ul>
</div>
</body>

</html>
