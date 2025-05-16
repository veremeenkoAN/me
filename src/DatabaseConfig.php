<?php

namespace App;

use PDO;

class DatabaseConfig
{

    private string $login = 'root';
    private string $password = 'root';
    private string $dbname = 'aton';
    private string $host = 'mysql';
    private array $options = [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];

    public function getDSN(): string
    {
        return "mysql:host={$this->host};" . "dbname={$this->dbname}";
    }

    public function getOptions(): array
    {
        return $this->options;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getLogin(): string
    {
        return $this->login;
    }


}