<?php

$app->get("/", ['App\Controllers\HomeController', 'index'])->setName('home');

$app->get("/dashboard", ['App\Controllers\DashboardController', 'index'])->setName('dashboard');

$app->group('/sessions', function () {

     $this->get('/login', ['App\Controllers\SessionController', 'getSignIn'])->setName('login');
     $this->post('/postSignUp', ['App\Controllers\SessionController', 'postSignIn'])->setName('postSignUp');

});
