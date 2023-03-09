<?php

declare(strict_types=1);

namespace Onlydev\Controller;

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class HomepageController extends AbstractController
{
    /**
     * @throws NotFoundExceptionInterface
     * @throws SyntaxError
     * @throws ContainerExceptionInterface
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function index(): void
    {
        $this->render('homepage/index.html.twig');
    }

    public function hello(string $name): void
    {
        echo sprintf('Hello, %s!', $name);
    }
}