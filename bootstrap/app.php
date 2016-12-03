<?php

use App\App;

define('INC_ROOT', dirname(__DIR__));
ini_set('display_errors', '1');
error_reporting(E_ALL);

require __DIR__ . '/../vendor/autoload.php';

// Load Dotenv //
try {
    $dotenv = new Dotenv\Dotenv(dirname(__DIR__));
    $dotenv->load();
    $dotenv->required(['DB_CONNECTION','DB_HOST','DB_DATABASE','DB_USERNAME','DB_PASSWORD']);
    unset($_dotenv);
} catch (Dotenv\Exception\InvalidPathException $e) {
    dd($e->getMessage());
    exit;
} catch (Dotenv\Exception\ValidationException $e) {
    dd($e->getMessage());
}

session_start();

// Instantiate the app
//$settings = require __DIR__ . '/../app/settings.php';
$app = new App;

require __DIR__ . '/../app/container.php';

$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection([
    'driver' => getenv('DB_CONNECTION'),
    'host' => getenv('DB_HOST'),
    'database' => getenv('DB_DATABASE'),
    'username' => getenv('DB_USERNAME'),
    'password' => getenv('DB_PASSWORD'),
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => ''
]);
$capsule->setAsGlobal();
$capsule->bootEloquent();

require __DIR__ . '/../app/routes.php';
