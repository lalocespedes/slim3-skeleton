<?php

namespace App\Middleware;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class GuestMiddleware extends Middleware
{
    private $container;

    public function __construct($container) {
        $this->container = $container;
    }

    public function __invoke(Request $request, Response $response, $next)
    {
        if($this->container->get('App\Auth\Auth')->check()) {

            return $response->withRedirect($this->container->get('router')->pathFor('dashboard'));

        }

        $response = $next($request, $response);

        return $response;
    }
}
