<?php
// DIC configuration

use Slim\Views\Twig;
use Slim\Views\TwigExtension;
use Interop\Container\ContainerInterface;

return [
    'router' => DI\object(Slim\Router::class),
    Twig::class => function (ContainerInterface $c) {
        $twig = new Twig(__DIR__ . '/../resources/views', [
            'cache' => false
        ]);

        $twig->addExtension(new TwigExtension(
            $c->get('router'),
            $c->get('request')->getUri()
        ));

        return $twig;
    }
];
