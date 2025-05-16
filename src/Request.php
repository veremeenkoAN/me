<?php

namespace App;

class Request
{
    private string $uri;
    private string $method;
    private array $queryParams;
    private array $bodyParams;

    public function __construct()
    {
        $this->uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->queryParams = $_GET;
        if (empty($_POST)) {
            $this->bodyParams = json_decode(file_get_contents('php://input'),1) ?? [];
        }
        else {
            $this->bodyParams = $_POST;
        }
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function get(string $key): string
    {
        return $this->queryParams[$key];

    }

    public function post(string $key): string
    {
        return $this->bodyParams[$key];
    }

    public function getBodyParams(): array
    {
        return $this->bodyParams;
    }


}