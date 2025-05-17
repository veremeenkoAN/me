<?php

namespace App\Render;

class OwnRender implements ViewRenderInterface
{
    private string $innerHtml;

    public function render(string $path, array $data,string $layout): string
    {
        $layoutPath = __DIR__ . "/../../view/layout/{$layout}.php";
        $innerPath = __DIR__ . "/../../view/{$path}.php";
        if (!empty($path)) {
            ob_start();
            require $innerPath;
            $this->innerHtml = ob_get_clean();
        }
        ob_start();
        require $layoutPath;
        return ob_get_clean();
    }

    public function renderComponent(string $path, array $data) : string
    {
        $innerPath = __DIR__ . "/../../view/components/{$path}.php";
        ob_start();
        require $innerPath;
        return ob_get_clean();
    }
}