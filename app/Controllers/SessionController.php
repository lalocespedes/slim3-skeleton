<?php

namespace App\Controllers;

use Slim\Views\Twig;
use Slim\Router;
use Slim\Csrf\Guard as Csrf;
use Slim\Flash\Messages as Flash;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Respect\Validation\Validator as v;

use App\Auth\Auth;
use App\Models\User;
use App\Validation\Validator;

/**
 * 
 */
class SessionController
{
    public function getSignOut(Request $request, Response $response, Router $router, Auth $auth)
    {
        $auth->logout();

        return $response->withRedirect($router->pathFor('home'));

    }

    public function getSignIn(Request $request, Response $response, Twig $view, User $user, Csrf $csrf)
    {
        $nameKey = $csrf->getTokenNameKey();
        $valueKey = $csrf->getTokenValueKey();
        $name = $request->getAttribute($nameKey);
        $value = $request->getAttribute($valueKey);

        $tokenArray= [
            $nameKey => $name,
            $valueKey => $value
        ];

        return $view->render($response, 'sessions/login.twig', [
            'data' => $tokenArray
        ]);
    }

    public function postSignIn(Request $request, Response $response, Auth $auth, Router $router, Flash $flash, Validator $validator)
    {

        $validation = $validator->validate($request, [
            'email' => v::email(),
            'password' => v::alnum()->noWhitespace()->length(4, 20)
        ]);

        if($validation->failed()) {

            //$flash->addMessage('error', $validation->errors());

            $flash->addMessage('error', 'Errores');

            return $response->withRedirect($router->pathFor('login'));

        }

        $attempt = $auth->attempt(
            $request->getParam('email'),
            $request->getParam('password')
        );

        if(!$attempt) {

            $flash->addMessage('error', 'Usuario y/o contraseña erroneo.');

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
}
