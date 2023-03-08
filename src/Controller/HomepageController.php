<?php

declare(strict_types=1);

namespace Onlydev\Controller;

class HomepageController extends AbstractController
{
    public function index(): void
    {
        phpinfo();
    }

    public function hello(string $name): void
    {
        echo sprintf('Hello, %s!', $name);
    }
}