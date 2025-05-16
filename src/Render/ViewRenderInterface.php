<?php

namespace App\Render;

interface ViewRenderInterface
{
    public function render(string $path, array $data,string $layout): string ;
    public function renderComponent(string $path, array $data) : string;

}