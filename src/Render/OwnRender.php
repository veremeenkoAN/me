<?php

namespace App\Render;

class OwnRender implements ViewRenderInterface
{
    private string $innerHtml;

    public function render(string $path, array $data,string $layout): string
    {
        try{
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
        catch (\Exception $e) {

        }
    }

    public function renderComponent(string $path, array $data) : string
    {
        try{
            $innerPath = __DIR__ . "/../../view/components/{$path}.php";
            ob_start();
            require $innerPath;
            return ob_get_clean();
        }
        catch (\Exception $e) {

        }
    }
}