<?php

namespace App\DTO\Country;

class CountryDTO
{

    public function __construct(
        public readonly int $id,
        public readonly string $country
    ){}

}