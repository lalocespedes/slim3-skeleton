<?php

namespace App\Controllers;

use Slim\Views\Twig;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class DashboardController
{

    public function index(Request $request, Response $response, Twig $view)
    {
        return $view->render($response, '/templates/app.twig');
    }
}