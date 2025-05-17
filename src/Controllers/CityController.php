<?php

namespace App\Controllers;
use App\DTO\City\CitySaveDTO;
use App\DTO\City\CityUpdateDTO;
use App\Exception\ValidationException;
use App\Render\ViewRenderInterface;
use App\Request;
use App\Response\HtmlResponse;
use App\Services\CityService;
use App\Services\CountryService;
use App\Validator\ValidatorInterface;
use App\ViewBuilder\CityViewBuilder;

class CityController
{
    public function __construct(
        private readonly CityService $cityService,
        //TODO Ничего страшного конечно. Но просто указываю пример, что инстанс будет делаться, а используется в редких методах
        private readonly CountryService $countryService,
        private readonly CityViewBuilder $builder,
        private readonly ViewRenderInterface $view,
        private readonly ValidatorInterface $validator,
    )
    {}

    public function index(Request $request): HtmlResponse
    {
        $allCitiesDTO = $this->cityService->getAll();
        return new HtmlResponse($this->view->render('table',$this->builder->buildCityView($allCitiesDTO),'aton'));
    }

    public function sort(Request $request): HtmlResponse //validation in the future))
    {
        $sortedData = $this->cityService->sort($request->post('filter-field'),$request->post('order'));
        return new HtmlResponse($this->view->renderComponent('list',$this->builder->buildCityView($sortedData)));
    }

    public function filter(Request $request): HtmlResponse //validation in the future))
    {
        $filteredData = $this->cityService->filter($request->post('input'),$request->post('field'));
        return new HtmlResponse($this->view->renderComponent('list',$this->builder->buildCityView($filteredData)));
    }

    public function delete(Request $request): HtmlResponse
    {
        $this->cityService->delete($request->post('id'));
        return new HtmlResponse('',200);
    }

    public function edit(Request $request): HtmlResponse
    {
        $cityDTO = $this->cityService->getOne($request->get('id'));
        $countryDTO = $this->countryService->getAll();
        return new HtmlResponse($this->view->render('edit',$this->builder->buildCityEditView($cityDTO,$countryDTO),'aton'));
    }

    public function update(Request $request): HtmlResponse
    {
        $this->validator->set($request->getBodyParams());
        if (!$this->validator->required(['id','city','chose-country_id'])) {
            throw new \Exception('Incorrect field');
        }
        $cityDTO = new CityUpdateDTO($request->post('id'),$request->post('city'),$request->post('chose-country_id'));
        $this->cityService->update($cityDTO);
        return new HtmlResponse('',303,['Location' => '/city']);
    }

    public function create(Request $request): HtmlResponse
    {
        $countryDTO = $this->countryService->getAll();
        return new HtmlResponse($this->view->render('add',$this->builder->ViewCityCreate($countryDTO),'aton'),200);
    }

    public function save(Request $request): HtmlResponse
    {
        try {
            $citySaveDtoFromUser = CitySaveDTO::fromRequestAfterValidation($request);
        } catch (ValidationException $exception) {
            throw $exception; //TODO Я бы советовал тут ловить и выводить пользовательскую ошибку не дефолтным образом
        }

        $this->cityService->save($citySaveDtoFromUser);

        return new HtmlResponse('',303,['Location' => '/city']);
    }
}