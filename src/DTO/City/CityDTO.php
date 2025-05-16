<?php

namespace App\DTO\City;

class CityDTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $city,
        public readonly string $country,
    ){}

}