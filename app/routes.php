<?php

$app->get("/", ['App\Controllers\HomeController', 'index'])->setName('home');

$app->get("/dashboard", ['App\Controllers\DashboardController', 'index'])->setName('dashboard');

$app->group('/sessions', function () {

     $this->get('/login', ['App\Controllers\SessionController', 'index'])->setName('login');

});
