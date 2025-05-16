<?php

namespace App\ViewBuilder;

class CountryViewBuilder extends AbstractViewBuilder
{
    public function build() : array
    {
        return [
            'info' => [
                'table_name' => 'COUNTRY DATA',
                'url' => '/country',
            ],
            'sortFields' => [
                'id' => 'id',
                'country' => 'Страна'
            ],
            'filterFields' => [
                'id' => 'id',
                'country' => 'Страна',
            ],
            'createFields' => [
                'country',
            ],
        ];
    }

    protected function toAssocArray(object $dto): array
    {
        return [
            'id' => $dto->id,
            'country' => $dto->country,
        ];
    }
    
    public function buildCountryView(object|array $dto): array
    {
        return [...$this->build(),'data' => $this->toArray($dto,[$this,'toAssocArray'])];
    }

    public function toWithout(): array
    {

    }

    public function buildCountryEditView(object|array $cityDTO,object|array $countryDTO) : array
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

    
    

}