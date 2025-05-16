<?php

namespace App\Response;

class JsonResponse extends AbstractHttpResponse
{
    public function __construct(array $content,int $code, array $headers)
    {
        $this->headers = $headers;
        $this->code = $code;
        $this->content = $content;
    }

    public function send(): void
    {
        http_response_code($this->code);
        foreach ($this->headers as $key => $value){
            header("$key:$value");
        }
        echo json_encode($this->content);
    }

}