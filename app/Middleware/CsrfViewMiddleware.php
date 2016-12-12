<?php

namespace App\Middleware;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class CsrfViewMiddleware extends Middleware
{
    private $container;

    public function __construct($container) {
        $this->container = $container;
    }

    public function __invoke(Request $request, Response $response, $next)
    {
        $this->container->get('Slim\Views\Twig')->getEnvironment()->addGlobal('csrf', [
            'field' => '
                <input type="hidden" name="' . $this->container->get('csrf')->getTokenNameKey() . '" value="' . $this->container->get('csrf')->getTokenName() . '">
                <input type="hidden" name="' . $this->container->get('csrf')->getTokenValueKey() . '" value="' . $this->container->get('csrf')->getTokenValue() . '">
            '
        ]);

        $response = $next($request, $response);

        return $response;
    }
}
