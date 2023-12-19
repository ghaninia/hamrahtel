<?php

namespace Src\Agenda\Message\Application\Providers;
use Src\Shared\Application\Providers\BaseServiceProvider as ServiceProvider;

class MessageServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            \Src\Agenda\Message\Domain\Repositories\MessageRepositoryInterface::class,
            \Src\Agenda\Message\Application\Repositories\MessageRepository::class
        );

        $this->app->bind(
            \Src\Agenda\Message\Domain\Services\MessageServiceInterface::class,
            \Src\Agenda\Message\Application\Services\MessageService::class
        );

        $this->registerRoutes(__DIR__ . "/../../Presentation/HTTP/Routes");
    }
}
