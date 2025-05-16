<?php

namespace App\DTO\User;

class UserEditDTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $first_name,
        public readonly string  $last_name
    ){}

}