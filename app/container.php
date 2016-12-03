<?php
// DIC configuration

$container = $app->getContainer();

// Register Twig on container
$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig(__DIR__ . '/../resources/views', [
        'cache' => false
    ]);
    
    $view->addExtension(new Slim\Views\TwigExtension(
        $container->get('router'),
        $container->get('request')->getUri()
    ));

    return $view;
};
