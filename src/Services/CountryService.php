<?php

namespace App\Services;

use App\DTO\Country\CountryDTO;
use App\DTO\Country\CountrySaveDTO;
use App\Mapper\InterfaceDTOMapper;
use App\Repositories\CountryRepository;

class CountryService
{

    public function __construct(private readonly CountryRepository $countryRepository,private readonly InterfaceDTOMapper $mapper)
    {}

    public function getAll(): array
    {
        $allCountries = $this->countryRepository->getAll();
        return $this->mapper->toDTO($allCountries);

    }

    public function sort(string $field,string $order): array
    {
        $allSortedCountries = $this->countryRepository->sort($field,$order);
        return $this->mapper->toDTO($allSortedCountries);
    }

    public function filter(string $input,string $field): array
    {
        if ($field == 'id') {
            $allFilteredCountries = $this->countryRepository->filterId((int)$input);
            return $this->mapper->toDTO($allFilteredCountries);
        }
        $allFilteredCountries = $this->countryRepository->filter($input,$field);
        return $this->mapper->toDTO($allFilteredCountries);
    }

    public function delete(int $id): void
    {
        $this->countryRepository->delete($id);
    }

    public function getOne(int $id): array
    {
        $city = $this->countryRepository->getById($id);
        return $this->mapper->toDTO($city);
    }

    public function update(CountryDTO $dto): void
    {
        $this->countryRepository->update($dto->id,$dto->country);
    }

    public function save(CountrySaveDTO $dto): void
    {
        $this->countryRepository->save($dto->country);
    }


}