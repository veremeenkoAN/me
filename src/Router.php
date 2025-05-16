<?php

namespace App;


use App\DIContainer\DIContainer;
use App\Render\ViewRenderInterface;
use App\Response\AbstractHttpResponse;
use App\Response\AbstractResponse;
use App\Response\HtmlResponse;

class Router
{
    private static array $routers;

    public function __construct(
        private DIContainer         $container,
        private ViewRenderInterface $view,
        private Logger              $logger
    )
    {}

    public static function add(array $router): void
    {
        self::$routers[$router[0]][$router[1]] = $router[2];

    }

    public function dispatch(Request $request): AbstractHttpResponse
    {
        try {
            $controller = self::$routers[$request->getMethod()][$request->getUri()];
            return $this->container->get($controller[0])->{$controller[1]}($request);
        } catch(\Exception $error) {
            $this->logger->log($error->getMessage());
            return new HtmlResponse($this->view->render('',[],'errors/404'),404);
        }
    }

}