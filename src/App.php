<?php

namespace App;

use App\DIContainer\DIContainer;
use App\Response\AbstractHttpResponse;

class App
{

    public function __construct(
        private Router $router
    ){}

    public function handle(Request $request): AbstractHttpResponse
    {
        return $this->router->dispatch($request);
    }

}


