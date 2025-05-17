<?php

namespace App\Mapper;

use App\DTO\Country\CountryDTO;

class DTOCountryMapper implements InterfaceDTOMapper
{

    public function toDTO(array $models): array
    {
        $result = [];
        foreach ($models as $modelCountry) {
            $result[] = new CountryDTO($modelCountry['id'],$modelCountry['country']);
        }
        return $result;
    }

}