<?php

namespace App\Mapper;

interface InterfaceDTOMapper
{

    public function ToDTO(array $models): array;

}