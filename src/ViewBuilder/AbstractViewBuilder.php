<?php

namespace App\ViewBuilder;

use Closure;

abstract class AbstractViewBuilder implements ViewBuilderInterface
{

    public function toArray(array|object $dto,callable $fn) : array
    {
        if (!is_array($dto)) {
            $dto = [$dto];
        }
        return array_map($fn,$dto);
    }

    abstract protected function toAssocArray(object $dto) : array;

}