<?php

namespace App\Mapper;

use App\DTO\City\CityDTO;

class DTOCityMapper implements InterfaceDTOMapper
{

    public function ToDTO(array $models): array
    {
        $result = [];
        foreach ($models as $modelCity) {
            $result[] = new CityDTO($modelCity['id'],$modelCity['city'],$modelCity['country']);
        }
        return $result;
    }


}