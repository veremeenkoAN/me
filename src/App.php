<?php

namespace App;

use App\DIContainer\DIContainer;
use App\Response\HttpResponseInterface;

class App
{

    public function __construct(
        private Router $router
    ){}

    public function handle(Request $request): HttpResponseInterface
    {
        return $this->router->dispatch($request);
    }

}


