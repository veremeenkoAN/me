<?php

namespace App\DTO\City;

class CityUpdateDTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $city,
        public readonly int $country_id,
    ){}

}