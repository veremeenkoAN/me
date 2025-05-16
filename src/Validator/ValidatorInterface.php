<?php

namespace App\Validator;

interface ValidatorInterface
{

    public function set(array $data) : void;
    public function required(array $field): bool;

}