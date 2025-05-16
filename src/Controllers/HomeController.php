<?php

namespace App\Controllers;
use App\Render\ViewRenderInterface;
use App\Request;
use App\Render;
use App\Response\HtmlResponse;

class HomeController
{

    public function __construct(private ViewRenderInterface $view)
    {}

    public function index(Request $request): HtmlResponse
    {
        return new HtmlResponse($this->view->render('home',[],'aton'));

    }

}