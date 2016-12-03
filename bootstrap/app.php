<?php

require __DIR__ . '/../vendor/autoload.php';

session_start();
define('INC_ROOT', dirname(__DIR__));

// Instantiate the app
$settings = require __DIR__ . '/../app/settings.php';
$app = new \Slim\App($settings);

require __DIR__ . '/../app/container.php';

require __DIR__ . '/../app/routes.php';
