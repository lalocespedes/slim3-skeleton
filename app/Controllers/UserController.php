<?php

namespace App\Controllers;

use Slim\Views\Twig;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use App\Models\User;

class UserController
{
    public function index(Request $request, Response $response, Twig $view, User $user)
    {
        return $response->withJson($user->all()->toArray());
    }
}
