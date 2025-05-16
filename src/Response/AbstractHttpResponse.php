<?php

namespace App\Response;

abstract class AbstractHttpResponse
{
    public function __construct(protected string|array $content ,protected int $code = 200, protected array $headers = ['Content-Type' => 'text/html'])
    {}
    abstract public function send() : void;

}