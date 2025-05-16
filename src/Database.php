<?php

namespace App;

class Database
{

    private \PDO $connection;
    private \PDOStatement $stmt;

    public function __construct(DatabaseConfig $dbconfig)
    {
        try {
            $this->connection = new \PDO($dbconfig->getDSN(),$dbconfig->getLogin(),$dbconfig->getPassword(),$dbconfig->getOptions());
        }
        catch(\PDOException $error) {
            file_put_contents(__DIR__ . "/.." . LOGPATH, print_r($error->getMessage(),1));
            return ;
        }

    }

    public function query(string $query,array $data = []): void
    {
        try {
            $this->stmt = $this->connection->prepare($query);
            $this->stmt->execute($data);
        }
        catch(\PDOException $error) {
            file_put_contents(__DIR__ . '/log' , print_r($error->getMessage(),1));
            return ;
        }
    }

    public function fetch(): array
    {
        return $this->stmt->fetch();
    }

    public function fetchAll(): array
    {
        return $this->stmt->fetchAll();
    }
//
//    public function getAll(string $table_name,string $sortField ='',string $order='') : array
//    {
//
//        $query = "SELECT * FROM $table_name ";
//        if ($sortField && $order) {
//            $query .= $this->addOrderField($sortField,$order);
//        }
//
//        $this->query($query);
//        return $this->fetchAll();
//
//    }
//
//    public function join(string $table_name1,string $table_name2,array $fields,array $equalFields,string $sortField = '',string $order = '')
//    {
//        $strFields = $this->toFields($fields);
//
//        $query = "SELECT $strFields FROM $table_name1 JOIN $table_name2 on {$equalFields[0]} = {$equalFields[1]} ";
//        if ($sortField && $order) {
//            $query .= $this->addOrderField($sortField,$order);
//        }
//        db()->query($query);
//        return $this->fetchAll();
//
//    }
//
//    public function toFields(array $fields)
//    {
//        return implode(',',$fields);
//    }
//
//    public function twoJoins(string $table_name1,string $table_name2,string $table_name3,array $fields,array $equalFields,string $sortField = '',string $order = '')
//    {
//        $strFields = $this->toFields($fields);
//        db()->query("SELECT $strFields FROM $table_name1 JOIN $table_name2 on {$equalFields[0][0]} = {$equalFields[0][1]} JOIN  $table_name3 ON {$equalFields[1][0]} = {$equalFields[1][1]}");
//        return $this->fetchAll();
//    }
//
//    public function addOrderField(string $field,string $order)
//    {
//        return "ORDER BY $field $order";
//    }




}