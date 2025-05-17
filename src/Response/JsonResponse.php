<?php

namespace App\Response;

readonly class JsonResponse implements HttpResponseInterface
{
    public function __construct(
        private array $content,
        private int $code = 200,
        private array $additionHeaders = []
    )
    {}

    public function send(): void
    {
        http_response_code($this->code);
        header("Content-Type:application/json");
        foreach ($this->additionHeaders as $key => $value){
            header("$key:$value");
        }
        echo json_encode($this->content);
    }

}