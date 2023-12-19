<?php

namespace Src\Shared\Application\Providers;

abstract class BaseServiceProvider extends \Illuminate\Support\ServiceProvider
{
    protected function registerRoutes(string $routePath)
    {
        $routeFiles = glob(sprintf("%s/*.php", $routePath));
        array_walk($routeFiles, fn($route) => $this->loadRoutesFrom($route));
    }
}
