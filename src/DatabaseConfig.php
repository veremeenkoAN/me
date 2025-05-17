<?php

namespace App;

use PDO;

readonly class DatabaseConfig
{

    private string $login;
    private string $password;
    private string $dbname;
    private string $host;
    private array $options;

    /**
     * @param string $login
     * @param string $password
     * @param string $dbname
     * @param string $host
     * @param array $options
     */
    public function __construct(string $login, string $password, string $dbname, string $host, array $options)
    {
        $this->login = $login;
        $this->password = $password;
        $this->dbname = $dbname;
        $this->host = $host;
        $this->options = $options;
    }

    public static function fromLocalMySQL(): self
    {
        return new self('root', 'root', 'aton', 'mysql', [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
    }


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