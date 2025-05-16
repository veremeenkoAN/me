<?php

namespace App\Services;

use App\DTO\User\UserSaveDTO;
use App\DTO\User\UserUpdateDTO;
use App\Mapper\DTOUserMapper;
use App\Repositories\CountryRepository;
use App\Repositories\UserRepository;

class UserService
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly DTOUserMapper $mapper,
        private readonly UserRepository $countryRepository ,
    )
    {}

    public function getAll(): array
    {
        $allUsers = $this->userRepository->getAll();
        return $this->mapper->toDTO($allUsers);
    }

    public function sort(string $field,string $order): array
    {
        $sortedData = $this->userRepository->sort($field,$order);
        return $this->mapper->toDTO($sortedData);
    }

    public function filter(string $input, string $field): array
    {
        if ($field === 'name') {
            $filteredData = $this->userRepository->filterName($input);
        }
        else {
            $filteredData = $this->userRepository->filterCountry($input);
        }
        return $this->mapper->toDTO($filteredData);
    }

    public function delete(int $id): void
    {
        $this->userRepository->delete($id);
    }

    public function getOne(int $id): array
    {
        $userModel = $this->userRepository->getByID($id);
        return $this->mapper->toUserEditDTO($userModel);
    }

    public function update(UserUpdateDTO $dto): void
    {
        $this->userRepository->update($dto->id,$dto->first_name,$dto->last_name,$dto->city_id);
    }

    public function save(UserSaveDTO $dto): void
    {
        $this->userRepository->save($dto->first_name,$dto->last_name,$dto->city_id);
    }

}