<?php

namespace Src\Auth\Application\Providers;

use Src\Auth\Application\JWTAuth;
use Src\Auth\Domain\AuthInterface;
use Src\Shared\Application\Providers\BaseServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(AuthInterface::class, JWTAuth::class);
        $this->registerRoutes(__DIR__ . "/../../Presentation/HTTP/Routes");
    }

    public function register()
    {
    }
}
