<?php

namespace App\Repositories;

interface CountryRepository
{
    public function getAll(): array;
    public function getById(int $id): array;
    public function sort(string $field,string $order): array;
    public function filter(string $input,string $field): array;
    public function filterId(int $input): array;
    public function delete(int $id): void;
    public function update(int $id, string $country): void;
    public function save(string $country): void;

}