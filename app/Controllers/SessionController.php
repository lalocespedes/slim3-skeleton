<?php

namespace App\Controllers;

use Slim\Views\Twig;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use App\Auth\Auth;
use Slim\Router;

use App\Models\User;

/**
 * 
 */
class SessionController
{
    public function getSignIn(Request $request, Response $response, Twig $view, User $user)
    {
        return $view->render($response, 'sessions/login.twig');
    }

    public function postSignIn(Request $request, Response $response, Auth $auth, Router $router)
    {
        $attempt = $auth->attempt(
            $request->getParam('email'),
            $request->getParam('password')
        );

        if(!$attempt) {

            return $response->withRedirect($router->pathFor('login'));

        }

        return $response->withRedirect($router->pathFor('dashboard'));
    }

    public function postSignUp(Request $request, Response $response, User $user, Router $router)
    {
        $user = User::create([
            'email' => $request->getParam('email'),
            'name' => $request->getParam('name'),
            'password' => password_hash($request->getParam('password'), PASSWORD_DEFAULT)
        ]);

        return $response->withRedirect($router->pathFor('home'));

    }

    public function postChangePassword(Request $request, Response $response, User $user, Router $router)
    {
        //$sql = $user->find(1);

        // $sql->update([
        //     'password' => password_hash('123456', PASSWORD_DEFAULT)
        // ]);

        // dd($sql);

        return $response->withRedirect($router->pathFor('home'));

    }
}
