<?php

declare(strict_types=1);

namespace Onlydev;

use FastRoute\Dispatcher;

use function FastRoute\simpleDispatcher;

class Application
{
    private Dispatcher $dispatcher;

    public function __construct()
    {
        $this->setupRoutes();
    }

    public function run(): void
    {
        $routeInfo = $this->dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);

        switch ($routeInfo[0]) {
            case Dispatcher::NOT_FOUND:
                echo '404 Not Found';
                break;
            case Dispatcher::METHOD_NOT_ALLOWED:
                echo '405 Method Not Allowed';
                break;
            case Dispatcher::FOUND:
                $handler = $routeInfo[1];
                $vars = $routeInfo[2];
                $controller = new $handler[0]();
                call_user_func_array(array($controller, $handler[1]), $vars);
                break;
        }
    }

    private function setupRoutes(): void
    {
        $this->dispatcher = simpleDispatcher(require_once __DIR__ . '/../config/routes.php');
    }
}