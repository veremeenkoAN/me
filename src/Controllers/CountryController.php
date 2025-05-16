<?php

namespace App\Controllers;
use App\DTO\City\CityUpdateDTO;
use App\DTO\Country\CountryDTO;
use App\DTO\Country\CountrySaveDTO;
use App\Render\ViewRenderInterface;
use App\Request;
use App\Render;
use App\Response\HtmlResponse;
use App\Services\CountryService;
use App\Validator\ValidatorInterface;
use App\ViewBuilder\AbstractViewBuilder;

class CountryController
{
    public function __construct(
        private readonly CountryService $countryService,
        private readonly AbstractViewBuilder $builder,
        private readonly ViewRenderInterface $view,
        private readonly ValidatorInterface $validator
    )
    {}

    public function index(Request $request): HtmlResponse
    {
        $allCountriesDTO = $this->countryService->getAll();
        return new HtmlResponse($this->view->render('table',$this->builder->buildCountryView($allCountriesDTO),'aton'),200);
    }

    public function sort(Request $request): HtmlResponse
    {
        $allCountriesDTO = $this->countryService->sort($request->post('filter-field'),$request->post('order'));
        return new HtmlResponse($this->view->renderComponent('list',$this->builder->buildCountryView($allCountriesDTO)));
    }

    public function filter(Request $request): HtmlResponse
    {
        $allCountriesDTO = $this->countryService->filter($request->post('input'),$request->post('field'));
        return new HtmlResponse($this->view->renderComponent('list',$this->builder->buildCountryView($allCountriesDTO)));
    }

    public function delete(Request $request): HtmlResponse
    {
        $this->countryService->delete($request->post('id'));
        return new HtmlResponse('',200);
    }

    public function edit(Request $request): HtmlResponse
    {
        $countryDTO = $this->countryService->getOne($request->get('id'));
        return new HtmlResponse($this->view->render('edit',$this->builder->buildCountryView($countryDTO),'aton'));
    }

    public function update(Request $request): HtmlResponse
    {
        $this->validator->set($request->getBodyParams());
        if (!$this->validator->required(['id','country','original-id'])) {
            throw new \Exception('Incorrect fields');
        }
        $countryDTO = new CountryDTO($request->post('id'),$request->post('country'));
        $this->countryService->update($countryDTO);
        return new HtmlResponse('',303,['Location' => '/country']);
    }

     public function create(Request $request): HtmlResponse
     {
         return new HtmlResponse($this->view->render('add',$this->builder->build(),'aton'),200);
     }

    public function save(Request $request): HtmlResponse
    {
        $this->validator->set($request->getBodyParams());
        if (!$this->validator->required(['country'])) {
            throw new \Exception('Incorrect field');
        }
        $countryDTO = new CountrySaveDTO($request->post('country'));
        $this->countryService->save($countryDTO);
        return new HtmlResponse('',303,['Location' => '/country']);
    }
}