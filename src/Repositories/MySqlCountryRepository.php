<?php

namespace App\Repositories;

use App\Database;

class MySqlCountryRepository implements CountryRepository
{
    public function __construct(private readonly Database $db) {}

    public function getAll(): array
    {
        $this->db->query("SELECT * FROM countries");
        return $this->db->fetchAll();
    }

    public function sort(string $field,string $order): array
    {
        $this->db->query("SELECT id, country FROM countries ORDER BY $field $order");
        return $this->db->fetchAll();
    }

    public function filter(string $input,string $field): array
    {
        $this->db->query("SELECT id, country FROM countries WHERE $field LIKE :input",['input' =>  "%$input%"]);
        return $this->db->fetchAll();
    }

    public function filterId(int $input): array
    {
        $this->db->query("SELECT id,country FROM countries WHERE id =:input",['input' =>  $input]);
        return $this->db->fetchAll();
    }

    public function delete(int $id): void
    {
        $this->db->query("DELETE FROM countries WHERE id =:id",['id' => $id]);
    }

    public function getById(int $id): array
    {
        $this->db->query("SELECT id,country FROM countries WHERE id =:id",['id' => $id]);
        return $this->db->fetchAll();
    }

    public function update(int $id, string $country): void
    {
        $this->db->query("UPDATE countries SET country = :country WHERE id =:id",['id' => $id,'country' => $country]);
    }

    public function save(string $country): void
    {
        $this->db->query("INSERT INTO countries (country) VALUES (:country)",['country' => $country]);
    }





}