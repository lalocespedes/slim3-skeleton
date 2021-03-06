<?php

namespace App\Middleware;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class Middleware
{
    public function __invoke(Request $request, Response $response, $next)
    {
        $response = $next($request, $response);

        return $response;
    }
}
