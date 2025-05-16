<?php

namespace App\Repositories;

interface UserRepository
{
    public function getAll(): array;
    public function getById(int $id): array;
    public function sort(string $field,string $order): array;

    public function delete(int $id): void;
    public function update(int $id, string $first_name,string $last_name,int $city_id): void;
    public function save(string $first_name, string $last_name, int $country_id): void;


}