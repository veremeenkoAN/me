<?php

namespace App\DTO\User;

class UserSaveDTO
{
    public function __construct(
        public readonly string $first_name,
        public readonly string $last_name,
        public readonly int $city_id
    ){}

}
