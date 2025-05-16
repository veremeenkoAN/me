<?php

namespace App\DTO\User;

class UserDTO
{

    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string  $city,
        public readonly string  $country,

    ){}

}