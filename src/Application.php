<?php

declare(strict_types=1);

namespace Onlydev;

use FastRoute\Dispatcher;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

use function FastRoute\simpleDispatcher;

class Application
{
    private ContainerInterface $container;
    private Dispatcher $dispatcher;

    public function __construct()
    {
        $this->setupContainer();
        $this->setupRoutes();
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
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
                $controller = $this->container->get($handler[0]);
                call_user_func_array(array($controller, $handler[1]), $vars);
                break;
        }
    }

    private function setupContainer(): void
    {
        $this->container = require_once __DIR__ . '/../config/container.php';
    }

    private function setupRoutes(): void
    {
        $this->dispatcher = simpleDispatcher(require_once __DIR__ . '/../config/routes.php');
    }
}