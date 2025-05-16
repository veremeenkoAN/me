<?php

namespace App\ViewBuilder;

class CityViewBuilder extends AbstractViewBuilder
{
    public function build() : array
    {
        return [
            'info' => [
                'table_name' => 'CITY DATA',
                'url' => '/city',
            ],
            'sortFields' => [
                'id' => 'id',
                'city' => 'Город',
                'country' => 'Страна',
            ],
            'filterFields' => [
                'id' => 'id',
                'country' => 'Страна',
                'city' => 'Город',
            ],
            'createFields' => [
                'city',
            ],
            'listFields' => [
                'country' ,'chose-country_id'
            ]
        ];
    }

    protected function toAssocArray(object $dto) : array
    {
        return [
            'id' => $dto->id,
            'city' => $dto->city,
            'country' => $dto->country,
        ];
    }


    protected function toWithout(object $dto) : array
    {
        return [
            'id' => $dto->id,
            'city' => $dto->city,
        ];
    }

    public function buildCityView(object|array $dto) : array
    {
        return [...$this->build(),'data' => $this->toArray($dto,[$this,'toAssocArray'])];
    }

    public function buildCityEditView(object|array $cityDTO,object|array $countryDTO) : array
    {
        return [...$this->build(),'data' => $this->toArray($cityDTO,[$this,'toWithout']),'list' => $this->toArray($countryDTO,[$this,'toFullAssocArray'])];
    }

    public function toFullAssocArray(object $dto) : array
    {
        return [
            'key' => $dto->id,
            'value' => $dto->country,
        ];
    }

    public function ViewCityCreate(object|array $countryDTO) : array
    {
        return [...$this->build(),'list' => $this->toArray($countryDTO,[$this,'toFullAssocArray'])];
    }



}