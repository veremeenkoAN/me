<?php

namespace App\Mapper;

//TODO Конвенция либо в конце суффикс Interface, либо не использовать
interface InterfaceDTOMapper
{

    public function toDTO(array $models): array;

}