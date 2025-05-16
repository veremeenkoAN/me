<?php

namespace App\Mapper;

use App\DTO\User\UserDTO;
use App\DTO\User\UserEditDTO;

class DTOUserMapper implements InterfaceDTOMapper
{

    public function ToDTO(array $models): array
    {
        $result = [];
        foreach ($models as $modelUser) {
            $name = $modelUser['first_name'] . " {$modelUser['last_name']}";
            $result[] = new UserDTO($modelUser['id'], $name,$modelUser['city'],$modelUser['country']);
        }
        return $result;
    }

    public function toUserEditDTO(array $models): array
    {
        $result = [];
        foreach ($models as $modelUser) {
            $result[] = new UserEditDTO($modelUser['id'],$modelUser['first_name'],$modelUser['last_name']);
        }
        return $result;
    }
}