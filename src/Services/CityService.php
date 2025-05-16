<?php

namespace App\Services;
use App\DTO\City\CityUpdateDTO;
use App\Mapper\DTOCityMapper;
use App\Repositories\CityRepository;
use App\Repositories\CountryRepository;

class CityService
{

    public function __construct(
        private readonly CityRepository $cityRepository,
        private readonly DTOCityMapper $mapper,
        private readonly CountryRepository $countryRepository ,
    )
    {}

    public function getAll(): array
    {
        $allCities = $this->cityRepository->getAll();
        return $this->mapper->toDTO($allCities);
    }

    public function sort(string $field,string $order): array
    {
        $sortedData = $this->cityRepository->sort($field,$order);
        return $this->mapper->toDTO($sortedData);
    }

    public function filter(string $input, string $field): array
    {
        if ($field === 'id') {
            $filteredData = $this->cityRepository->filterId((int)$input);
            return $this->mapper->toDTO($filteredData);
        }
        $filteredData = $this->cityRepository->filter($input,$field);
        return $this->mapper->toDTO($filteredData);
    }

    public function delete(int $id): void
    {
        $this->cityRepository->delete($id);
    }

    public function getOne(int $id): array
    {
        $cityModel = $this->cityRepository->getByID($id);
        return $this->mapper->toDTO($cityModel);
    }

    public function update(CityUpdateDTO $dto): void
    {
        $this->cityRepository->update($dto->id,$dto->city,$dto->country_id);
    }

    public function save(string $city,int $id)
    {
        $this->cityRepository->save($city,$id);
    }




}