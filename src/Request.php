<?php

namespace App;

readonly class Request
{
    public function __construct(
        private string $uri,
        private string $method,
        private array  $queryParams,
        private array  $bodyParams,
    )
    {
    }

    /**
     * TODO Ошибка эта не ловится нигде. Может ты так и хотел
     * @throws \JsonException
     */
    public static function fromGlobals(): self
    {
        return new self(
            parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH),
            $_SERVER['REQUEST_METHOD'],
            $_GET,
            $_POST ?: (json_decode(file_get_contents('php://input'), true, 512, JSON_THROW_ON_ERROR) ?? [])
        );
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    //TODO несколько проблем: если ключа нет — будет Undefined array key + возможный TypeError, если тип данных не string
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