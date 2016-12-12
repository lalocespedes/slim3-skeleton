<?php

namespace App;

use DI\ContainerBuilder;
use DI\Bridge\Slim\App as DIBridge;

class App extends DIBridge
{

    protected function configureContainer(ContainerBuilder $builder)
    {
        $builder->addDefinitions([
            'settings.determineRouteBeforeAppMiddleware' => false,
            'settings.displayErrorDetails' => true
        ]);

        $builder->addDefinitions(__DIR__ . '/container.php');
    }
}
