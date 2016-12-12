<?php

use App\Middleware\AuthMiddleware;
use App\Middleware\GuestMiddleware;

$container = $app->getContainer();

$app->get("/", ['App\Controllers\HomeController', 'index'])->setName('home');

$app->group('', function () {

    //Auth
    $this->get('/logout', ['App\Controllers\SessionController', 'getSignOut'])->setName('logout');

    // Dashboard
    $this->get("/dashboard", ['App\Controllers\DashboardController', 'index'])->setName('dashboard');

})->add(new AuthMiddleware($container));


$app->group('', function () {

        $this->get('/login', ['App\Controllers\SessionController', 'getSignIn'])->setName('login');
        $this->post('/login', ['App\Controllers\SessionController', 'postSignIn']);

})->add($container->get('csrf'))->add(new GuestMiddleware($container));

// API

$app->group('/api', function () {

    // Users
    $this->get('/users', ['App\Controllers\UserController', 'getUsers'])->setName('users');
    $this->post('/users/create', ['App\Controllers\UserController', 'postSaveUser']);

    // User Profile
    $this->post('/profile/password/change', ['App\Controllers\Auth\PasswordController', 'postChangePassword']);

})->add(new AuthMiddleware($container));
