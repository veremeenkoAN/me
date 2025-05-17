<?php

namespace App\Response;

readonly class HtmlResponse implements HttpResponseInterface
{
    public function __construct(
        private string|array $content,
        private int $code = 200,
        private array $additionalHeaders = []
    )
    {
    }

    public function send(): void
    {
        http_response_code($this->code);
        header("Content-Type:text/html");
        foreach ($this->additionalHeaders as $key => $header) {
            header("$key:$header");
        }
        echo $this->content;
    }


}