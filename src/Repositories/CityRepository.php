<?php

namespace App\Repositories;

interface CityRepository
{
    /** @return string[] */
    public function getAll(): array;
    public function getById(int $id): array;
    public function sort(string $field,string $order): array;
    public function filter(string $input,string $field): array;
    public function filterId(int $input): array;
    public function delete(int $id): array;
    public function update(int $id,string $city, int $country_id): void;
    public function save(string $city, int $country_id): void;

}