<?php

use App\App;

define('INC_ROOT', dirname(__DIR__));
ini_set('display_errors', getenv('APP_DEBUG'));
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

date_default_timezone_set('Mexico/General');

session_cache_limiter(false);

if (!isset($_SESSION)) {
    session_start();
}

// Instantiate the app
$app = new App;
$container = $app->getContainer();

// Middleware

$app->add(new \App\Middleware\CsrfViewMiddleware($container));

$app->add($container->get('csrf'));

$app->add(function ($request, $response, $next)
{
    // DataBase Migrate
    $phinx = new Phinx\Console\PhinxApplication();

    $phinx = new Phinx\Wrapper\TextWrapper($phinx, [
        'configuration' => '../phinx.yml',
        'parser' => 'yaml'
    ]);

    call_user_func([$phinx, 'getMigrate']);

    // //login
    // if (!isset($_SESSION['user_id']) && $request->getUri()->getPath() != '/sessions/login') {

    //     if($request->getUri()->getPath() === '/') return $next($request, $response);

    //     return $response->withRedirect('/sessions/login');

    // }

    $response = $next($request, $response);

    return $response;
    
});

require __DIR__ . '/../app/container.php';

// Database connection
$dbconfig = require __DIR__ . '/../config/database.php';
$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($dbconfig);
$capsule->setAsGlobal();
$capsule->bootEloquent();

require __DIR__ . '/../app/routes.php';
