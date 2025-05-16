<?php

namespace App\Response;

class EmptyResponse extends AbstractHttpResponse
{
    public function __construct(int $code, array $headers)
    {
        $this->headers = $headers;
        $this->code = $code;
    }

    public function send(): void
    {
        http_response_code($this->code);
        foreach ($this->headers as $key => $value){
            header("$key:$value");
        }
    }
}