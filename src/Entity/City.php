<?php

namespace App\Entity;

class City
{
    private int $id;
    private string $city;
    private int $country_id;

    public function __construct(array $data)
    {
        $this->city = $data['city'];
        $this->id = $data['id'];
        $this->country_id = $data['country_id'];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getCountry_id(): string
    {
        return $this->country_id;
    }

}