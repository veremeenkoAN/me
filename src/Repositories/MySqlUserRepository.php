<?php

namespace App\Repositories;

use App\Database;

class MySqlUserRepository implements UserRepository
{
    public function __construct(private readonly Database $db) {}

    public function getAll(): array
    {
        $this->db->query("SELECT users.id,users.first_name,users.last_name,cities.city,countries.country FROM users JOIN cities ON users.city_id = cities.id JOIN countries ON countries.id = cities.country_id");
        return $this->db->fetchAll();
    }

    public function sort(string $field,string $order): array
    {
        $this->db->query("SELECT users.id,users.first_name,users.last_name,cities.city,countries.country FROM users JOIN cities ON users.city_id = cities.id JOIN countries ON countries.id = cities.country_id ORDER BY $field $order");
        return $this->db->fetchAll();
    }

    public function filterName(string $input): array
    {
        $this->db->query("SELECT users.id,users.first_name,users.last_name,cities.city,countries.country FROM users JOIN cities ON users.city_id = cities.id JOIN countries ON countries.id = cities.country_id WHERE first_name LIKE :input or last_name LIKE :input",['input' =>  "%$input%"]);
        return $this->db->fetchAll();
    }

    public function filterCountry(string $input): array
    {
        $this->db->query("SELECT users.id,users.first_name,users.last_name,cities.city,countries.country FROM users JOIN cities ON users.city_id = cities.id JOIN countries ON countries.id = cities.country_id WHERE country LIKE :input or city LIKE :input",['input' =>  "%$input%"]);
        return $this->db->fetchAll();
    }


    public function delete(int $id): void
    {
        $this->db->query("DELETE FROM users WHERE id =:id",['id' => $id]);
    }

    public function getById(int $id): array
    {
        $this->db->query("SELECT users.id,users.first_name,users.last_name,cities.city,countries.country FROM users JOIN cities ON users.city_id = cities.id JOIN countries ON countries.id = cities.country_id WHERE users.id =:id",['id' => $id]);
        return $this->db->fetchAll();
    }

    public function update(int $id, string $first_name,string $last_name,int $city_id): void
    {
        $this->db->query("UPDATE users SET first_name =:first_name,last_name=:last_name,city_id=:city_id WHERE id =:id",['id' => $id,'first_name' => $first_name,'last_name' => $last_name,'city_id' => $city_id]);
    }

    public function save(string $first_name,string $last_name,int $country_id): void
    {
        $this->db->query("INSERT INTO users (first_name,last_name,city_id) VALUES (:first_name,:last_name,:country_id)",['first_name' => $first_name,'last_name' => $last_name,'country_id' => $country_id]);
    }

}