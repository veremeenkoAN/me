<?php

namespace App\Mapper;

interface InterfaceDTOMapper
{

    public function toDTO(array $models): array;

}