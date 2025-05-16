<?php

namespace App\Entity;

class Country
{
    private int $id;
    private string $country;

    public function __construct(array $country)
    {
        $this->country = $country['country'];
        $this->id = $country['id'];

    }
    public function getCountry(): string
    {
        return $this->country;
    }

    public function getId(): int
    {
        return $this->id;
    }

//    public static function getAll() : array
//    {
//        $allCountries = db()->getAll(self::TABLE_NAME);
//        $sortFields = self::getSortFields();
//        $info = self::getInfo();
//        return array_merge(['data' => $allCountries],['sortFields'=> $sortFields],['info' =>  $info]);
//
//    }
//
//    public static function getSortFields()
//    {
//        return ['id' => 'id','country' => 'Страна'];
//    }
//
//    public static function getInfo() : array
//    {
//        return ['table_name' => 'COUNTRY DATA', 'filter_url' => '/country/filter'];
//    }
//    public static function getSortedData(string $field,string $order) : array
//    {
//        $sortedCities = db()->getAll(self::TABLE_NAME,$field,$order);
//        return $sortedCities;
//    }


}