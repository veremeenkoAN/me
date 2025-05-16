<?php

namespace App\Repositories;
use App\Database;
use App\Mapper\InterfaceEntityMapper;

class MySqlCityRepository implements CityRepository
{
    public function __construct(private readonly Database $db) {}

    public function getAll(): array
    {
        $this->db->query("SELECT cities.id,cities.city,countries.country FROM cities JOIN countries on cities.country_id = countries.id");
        return $this->db->fetchAll();
    }

    public function sort(string $field,string $order): array
    {
        $this->db->query("SELECT cities.id,cities.city,countries.country FROM cities JOIN countries on cities.country_id = countries.id ORDER BY $field $order");
        return($this->db->fetchAll());
    }

    public function filter(string $input,string $field): array
    {
        $this->db->query("SELECT cities.id,cities.city,countries.country FROM cities JOIN countries on cities.country_id = countries.id WHERE $field LIKE :input",['input' =>  "%$input%"]);
        return $this->db->fetchAll();
    }

    public function filterId(int $input): array
    {
        $this->db->query("SELECT cities.id,cities.city,countries.country FROM cities JOIN countries on cities.country_id = countries.id WHERE cities.id =:input",['input' =>  $input]);
        return $this->db->fetchAll();
    }

    public function delete(int $id): array
    {
        $this->db->query("DELETE FROM cities WHERE id = :id",['id' => $id]);
    }

    public function getById(int $id): array
    {
        $this->db->query("SELECT cities.id,cities.city,countries.country,cities.country_id FROM cities JOIN countries on cities.country_id = countries.id WHERE cities.id =:id",['id' => $id]);
        return($this->db->fetchAll());
    }

    public function update(int $id,string $city,int $country_id): void
    {
        $this->db->query("UPDATE cities SET city = :city , country_id = :country_id WHERE id =:id",['id' => $id,'city' => $city,'country_id' => $country_id]);
    }

    public function save(string $city,int $country_id): void
    {
        $this->db->query("INSERT INTO cities (city,country_id) VALUES (:city,:country_id)",['city' => $city,'country_id' =>$country_id ]);
    }



}