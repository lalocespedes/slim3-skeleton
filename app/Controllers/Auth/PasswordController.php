<?php

namespace App\Controllers\Auth;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use App\Auth\Auth;

class PasswordController
{
    public function getChangePassword(Request $request, Response $response)
    {
        
    }

    public function postChangePassword(Request $request, Response $response, Auth $auth)
    {
        
        $auth->user()->setPassword($request->getParam('password'));

        return $response->withStatus(200)
            ->withJson([
                "message" => "Password changed"
            ]);

    }
}
