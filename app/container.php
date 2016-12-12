<?php
// DIC configuration

use Slim\Views\Twig;
use Slim\Views\TwigExtension;
use Interop\Container\ContainerInterface;

use App\Auth\Auth;

return [
    'router' => DI\object(Slim\Router::class),
    Auth::class => function (ContainerInterface $c) {
        return new \App\Auth\Auth;
    },
    'flash' => function (ContainerInterface $c) {
        return new \Slim\Flash\Messages;
    },
    Twig::class => function (ContainerInterface $c) {
        $twig = new Twig(__DIR__ . '/../resources/views', [
            'cache' => false
        ]);

        $twig->addExtension(new TwigExtension(
            $c->get('router'),
            $c->get('request')->getUri()
        ));

        $twig->getEnvironment()->addGlobal('auth', [
            'check' => $c->get('App\Auth\Auth')->check(),
            'user' => $c->get('App\Auth\Auth')->user()
        ]);

        $twig->getEnvironment()->addGlobal('flash', $c->get('flash'));

        return $twig;
    },
    'errorHandler' => function (ContainerInterface $c) {
        return function ($request, $response, $exception) use ($c) {
            $response->getBody()->rewind();
            return $response->withStatus(500)
                        ->withHeader('Content-Type', 'text/html')
                        ->write($exception->getMessage());
        };
    },
    'csrf' => function (ContainerInterface $c) {
        return new \Slim\Csrf\Guard;
    }
];
