<?php

namespace App\Validator;

class Validator implements ValidatorInterface
{

    private array $data;

    public function set(array $data) : void
    {
        $this->data = $data;
    }

    public function required(array $field) : bool
    {
        foreach ($field as $key) {
            if (!isset($this->data[$key])) {
                return false;
            }
        }
        return true;
    }
}