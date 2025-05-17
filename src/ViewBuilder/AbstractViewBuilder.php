<?php

namespace App\ViewBuilder;

use Closure;

// TODO Грусть-печаль плохо-поддерживаемая вышла. Нужно меньше наследования логики, больше копипасты. Зачем было унифицировать все эти вьюшки, чтобы шаблонам 4-ем соответствовало?? Лишь бы что вышло. Не усложняй где не нужно. Это прям под удаление всю папку хоть) Но уже забей
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