<?php

namespace Src\Shared\Infrastructure\Communicator;

use Illuminate\Support\ServiceProvider;

class CommunicatorServiceProvider extends ServiceProvider
{
    public function boot(){
        $this->mergeConfigFrom(__DIR__ . '/configs/communicator.php' , "communicator");
    }

}
