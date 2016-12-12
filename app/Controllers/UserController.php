<?php

namespace App\Controllers;

use Slim\Views\Twig;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use App\Models\User;

class UserController
{
    public function getUsers(Request $request, Response $response, Twig $view, User $user)
    {
        return $response->withJson($user->all()->toArray());
    }

    public function postSaveUser(Request $request, Response $response, User $user)
    {

        try {

            $sql = $user->create([
                'username' => $request->getParam('username'),
                'email' => $request->getParam('email'),
                'password' => password_hash($request->getParam('password'), PASSWORD_DEFAULT)
            ]);

            return $response->withJson([
                'message' => 'User created',
                'id' => $sql->id
            ]);

        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return $response->withStatus(400)
            ->withJson([
                "message" => $e->getMessage()
            ]);

        } catch(\Illuminate\Database\QueryException $e) {

            return $response->withStatus(400)
            ->withJson([
                "message" => $e->getMessage()
            ]);
        }
    }
}
