<?php

namespace App\ViewBuilder;

class UserViewBuilder extends AbstractViewBuilder
{
    public function build() : array
    {
        return [
            'info' => [
                'table_name' => 'USER DATA',
                'url' => '/user',
            ],
            'sortFields' => [
                'id' => 'id',
                'first_name,last_name' => 'Имя Фамилия',
                'city' => 'Город',
                'country' => 'Страна',
            ],
            'filterFields' => [
                'name' => 'Имя Фамилия',
                'city' => 'Город Страна',
            ],
            'createFields' => [
                'first_name','last_name'
            ],
            'listFields' => [
                'city','chose-city_id'
            ]
        ];
    }

    protected function toAssocArray(object $dto): array
    {
        return [
            'id' => $dto->id,
            'name' => $dto->name,
            'city' => $dto->city,
            'country' => $dto->country
        ];
    }

    public function toWithout(object $dto): array
    {
        return [
            'id' => $dto->id,
            'first_name' => $dto->first_name,
            'last_name' => $dto->last_name
        ];
    }
    public function buildUserView(object|array $dto) : array
    {
        return [...$this->build(),'data' => $this->toArray($dto,[$this,'toAssocArray'])];
    }

    public function buildUserEditView(object|array $userDTO,object|array $cityDTO): array
    {
        return [...$this->build(),'data' => $this->toArray($userDTO,[$this,'toWithout']),'list' => $this->toArray($cityDTO,[$this,'toFullAssocArray'])];
    }

    public function buildUserCreateView(array $cityDTO): array
    {
        return [...$this->build(),'list' => $this->toArray($cityDTO,[$this,'toFullAssocArray'])];
    }

    public function toFullAssocArray(object $dto) : array
    {
        return [
            'key' => $dto->id,
            'value' => $dto->city,
        ];
    }

}