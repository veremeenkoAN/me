<?php

namespace App\Response;

readonly class EmptyResponse implements HttpResponseInterface
{
    public function __construct(
        private int $code = 200,
        private array $headers = []
    )
    {}

    public function send(): void
    {
        http_response_code($this->code);
        foreach ($this->headers as $key => $value){
            header("$key:$value");
        }
    }
}