<?php

namespace App\Exception;

class ValidationException extends \RuntimeException
{
    /**
     * @param class-string $dtoClass
     * @param string $field
     * @return self
     */
    public static function fieldInDtoIsMissing(string $dtoClass, string $field): self
    {
        throw new self("Field '$field' is missing in '$dtoClass'");
    }

    /**
     * @param class-string $dtoClass
     * @param string $field
     * @param string $expectedType
     * @param mixed $value
     * @return self
     */
    public static function wrongTypeInDtoField(string $dtoClass, string $field, string $expectedType, mixed $value): self
    {
        $actualType = gettype($value);
        throw new self("Field '$field' in '$dtoClass' should be of type '$expectedType', got '$actualType'");
    }
}