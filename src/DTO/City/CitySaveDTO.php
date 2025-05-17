<?php

namespace App\DTO\City;

use App\Exception\ValidationException;
use App\Request;

readonly class CitySaveDTO
{
    private const string CITY_NAME_KEYWORD = 'city';
    private const string ID_KEYWORD = 'chose-country_id';

    /**
     * @param string $name City name
     * @param int $id City ID
     */
    public function __construct(
        public string $name,
        public int    $id
    )
    {
    }

    /**
     * @param Request $request
     * @return self
     * @throws ValidationException
     */
    public static function fromRequestAfterValidation(Request $request): self {
        // TODO Можно, конечно, накопить ошибки в массив, если хочешь. Тогда отдать все сразу ближе к концу метода в исключении
        if (!isset($request->getBodyParams()[self::CITY_NAME_KEYWORD])) {
            throw ValidationException::fieldInDtoIsMissing(self::class,self::CITY_NAME_KEYWORD);
        }

        $cityName = $request->getBodyParams()[self::CITY_NAME_KEYWORD];
        if (!is_string($cityName)) {
            throw ValidationException::wrongTypeInDtoField(self::class,self::CITY_NAME_KEYWORD, 'string', $cityName);
        }

        if (!isset($request->getBodyParams()[self::ID_KEYWORD])) {
            ValidationException::fieldInDtoIsMissing(self::class,self::ID_KEYWORD);
        }

        $cityId = $request->getBodyParams()[self::ID_KEYWORD];

        if (!is_numeric($cityId)) {
            throw ValidationException::wrongTypeInDtoField(self::class,self::CITY_NAME_KEYWORD, 'string', $cityName);
        }

        return new self($cityName, (int)$cityId);
    }
}