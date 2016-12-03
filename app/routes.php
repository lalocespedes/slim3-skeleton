<?php

use Slim\Views\Twig;
use Slim\Http\Request;
use Slim\Http\Response;

$app->get("/", ['App\Controllers\HomeController', 'index'])->setName('home');