<?php

declare(strict_types=1);

use League\Container\Container;
use Onlydev\Controller\HomepageController;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$container = new Container();

// SERVICES
$container->addShared(Environment::class)
    ->addArgument(new FilesystemLoader(__DIR__ . '/../views'));

// CONTROLLERS
$container->addShared(HomepageController::class)
    ->addArgument($container);

return $container;