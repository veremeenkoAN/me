<?php

namespace App\DTO\City;

readonly class CityDTO
{
    public function __construct(
        public int $id,
        public string $city,
        public string $country,
    ){}

}