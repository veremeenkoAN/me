<?php

namespace App\Response;

class HtmlResponse extends AbstractHttpResponse
{
    public function send() : void
    {
        http_response_code($this->code);
        foreach ($this->headers as $key => $header) {
            header("$key:$header");
        }
        echo $this->content;
    }


}