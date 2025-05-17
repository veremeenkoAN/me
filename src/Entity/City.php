<?php

namespace App\Entity;

// TODO Огромное количество мертвого кода в проекте. Так как наделал кучу лишнего в мизерном проекте. И даже в таком объеме бизнес-логики как видишь легко запутаться. Тут вся папка под удаление. Куча еще файлов и методов под удаление. Закомментированный код есть
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