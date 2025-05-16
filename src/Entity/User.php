<?php

namespace App\Entity;
use App\Entity;

class User
{

    private int $id;

    private string $lastname;

    private string $firstname;

    private int $city_id;


    const TABLE_NAME  = 'users';

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->lastname = $data['lastname'];
        $this->firstname = $data['firstname'];
        $this->city_id = $data['city_id'];

    }

    public static function getAll(): array
    {

       $allUsers = db()->twoJoins(self::TABLE_NAME ,City::TABLE_NAME ,Country::TABLE_NAME ,['users.id','users.first_name','users.last_name','cities.city','countries.country'],[['users.city_id','cities.id'],['cities.country_id','countries.id']]);
       $allFilters = self::getSortFields();
       $info = self::getInfo();
       return array_merge(['data' => $allUsers],['sortFields'=> $allFilters],['info' =>  $info]);
    }

    public static function getSortFields(): array
    {
        return ['id' => 'id','name' => 'Фамилия Имя','country' => 'Cтрана', 'city' => 'Город'];
    }

    public static function getInfo(): array
    {
        return ['table_name' => 'USER DATA', 'filter_url' => '/user/filter'];
    }









}