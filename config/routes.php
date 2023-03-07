<?php

declare(strict_types=1);

use FastRoute\RouteCollector;
use Onlydev\Controller\HomepageController;

$routes = function (RouteCollector $r) {
    $r->addRoute('GET', '/', [HomepageController::class, 'index']);
    $r->addRoute('GET', '/hello/{name}', [HomepageController::class, 'hello']);
};

return $routes;