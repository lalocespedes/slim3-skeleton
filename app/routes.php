<?php

use App\Middleware\AuthMiddleware;
use App\Middleware\GuestMiddleware;

$container = $app->getContainer();

$app->get("/", ['App\Controllers\HomeController', 'index'])->setName('home');

$app->get("/dashboard", ['App\Controllers\DashboardController', 'index'])->setName('dashboard')->add(new AuthMiddleware($container));

$app->group('/sessions', function () {

    $this->get('/logout', ['App\Controllers\SessionController', 'getSignOut'])->setName('logout');
    $this->get('/login', ['App\Controllers\SessionController', 'getSignIn'])->setName('login');
    $this->post('/postSignIn', ['App\Controllers\SessionController', 'postSignIn']);

})->add($container->get('csrf'))->add(new GuestMiddleware($container));

$app->group('/api', function () {

    // Users
    $this->get('/users', ['App\Controllers\UserController', 'getUsers'])->setName('users');
    $this->post('/users/create', ['App\Controllers\UserController', 'postSaveUser']);

    // User Profile
    $this->post('/profile/password/change', ['App\Controllers\Auth\PasswordController', 'postChangePassword']);

});
