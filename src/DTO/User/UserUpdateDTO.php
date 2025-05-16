<?php

namespace App\DTO\User;

class UserUpdateDTO
{

    public function __construct(
        public readonly int $id,
        public readonly string $first_name,
        public readonly string  $last_name,
        public readonly string  $city_id,

    ){}

}