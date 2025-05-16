<?php

namespace App\Controllers;
use App\DTO\User\UserSaveDTO;
use App\DTO\User\UserUpdateDTO;
use App\Render\ViewRenderInterface;
use App\Request;
use App\Render;
use App\Response\HtmlResponse;
use App\Services\CityService;
use App\Services\UserService;
use App\Validator\ValidatorInterface;
use App\ViewBuilder\CityViewBuilder;
use App\ViewBuilder\UserViewBuilder;

class UserController
{
    public function __construct(
        private readonly UserService $userService,
        private readonly CityService $cityService,
        private readonly UserViewBuilder $builder,
        private readonly ViewRenderInterface $view,
        private readonly ValidatorInterface $validator,
    ){}


    public function index(Request $request): HtmlResponse
    {
        $allUserDTO = $this->userService->getAll();
        return new HtmlResponse($this->view->render('table',$this->builder->buildUserView($allUserDTO),'aton'),200);
    }

    public function sort(Request $request): HtmlResponse
    {
        $allCountriesDTO = $this->userService->sort($request->post('filter-field'),$request->post('order'));
        return new HtmlResponse($this->view->renderComponent('list',$this->builder->buildUserView($allCountriesDTO)));
    }

    public function filter(Request $request): HtmlResponse //validation in the future))
    {
        $filteredData = $this->userService->filter($request->post('input'),$request->post('field'));
        return new HtmlResponse($this->view->renderComponent('list',$this->builder->buildUserView($filteredData)));
    }

    public function delete(Request $request): HtmlResponse
    {
        $this->userService->delete($request->post('id'));
        return new HtmlResponse('',200);
    }

    public function edit(Request $request): HtmlResponse
    {
        $userDTO = $this->userService->getOne($request->get('id'));
        $allCityDTO = $this->cityService->getAll();
        return new HtmlResponse($this->view->render('edit',$this->builder->buildUserEditView($userDTO,$allCityDTO),'aton'),200);
    }

    public function update(Request $request): HtmlResponse
    {
        $this->validator->set($request->getBodyParams());
        if (!$this->validator->required(['id','first_name','last_name','chose-city_id'])) {
            throw new \Exception('Incorrect field');
        }
        $userDTO = new UserUpdateDTO($request->post('id'),$request->post('first_name'),$request->post('last_name'),$request->post('chose-city_id'));
        $this->userService->update($userDTO);
        return new HtmlResponse('',303,['Location' => '/user']);
    }

    public function create(Request $request): HtmlResponse
    {
        $allCitiesDTO = $this->cityService->getAll();
        return new HtmlResponse($this->view->render('add',$this->builder->buildUserCreateView($allCitiesDTO),'aton'),200);
    }

    public function save(Request $request): HtmlResponse
    {
        $this->validator->set($request->getBodyParams());
        if (!$this->validator->required(['first_name','last_name','chose-city_id'])) {
            throw new \Exception('Incorrect field');
        }
        $userDTO = new UserSaveDTO($request->post('first_name'),$request->post('last_name'),$request->post('chose-city_id'));
        $this->userService->save($userDTO);
        return new HtmlResponse('',303,['Location' => '/user']);

    }


}