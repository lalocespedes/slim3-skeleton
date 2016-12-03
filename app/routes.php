<?php

$app->get("/", ['App\Controllers\HomeController', 'index'])->setName('home');

$app->get("/dashboard", ['App\Controllers\DashboardController', 'index'])->setName('dashboard');