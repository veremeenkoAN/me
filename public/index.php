<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\App;
use App\Controllers\CityController;
use App\Controllers\CountryController;
use App\Controllers\HomeController;
use App\Controllers\UserController;
use App\Database;
use App\DatabaseConfig;
use App\DIContainer\DIContainer;
use App\Logger;
use App\Mapper\DTOCityMapper;
use App\Mapper\DTOCountryMapper;
use App\Mapper\DTOUserMapper;
use App\Repositories\MySqlCityRepository;
use App\Repositories\MySqlCountryRepository;
use App\Repositories\MySqlUserRepository;
use App\Request;
use App\Router;
use App\Services\CityService;
use App\Render;
use App\Render\OwnRender;
use App\Services\CountryService;
use App\Services\UserService;
use App\Validator\Validator;
use App\ViewBuilder\CityViewBuilder;
use App\ViewBuilder\CountryViewBuilder;
use App\ViewBuilder\UserViewBuilder;

$container = new DIContainer;

Router::add(['GET','/',[\App\Controllers\HomeController::class,'index']]);

Router::add(['GET','/country',[\App\Controllers\CountryController::class,'index']]);
Router::add(['GET','/city',[\App\Controllers\CityController::class,'index']]);
Router::add(['GET','/user',[\App\Controllers\UserController::class,'index']]);

Router::add(['POST','/country/sort',[\App\Controllers\CountryController::class,'sort']]);
Router::add(['POST','/city/sort',[\App\Controllers\CityController::class,'sort']]);
Router::add(['POST','/user/sort',[\App\Controllers\UserController::class,'sort']]);

Router::add(['POST','/country/filter',[\App\Controllers\CountryController::class,'filter']]);
Router::add(['POST','/city/filter',[\App\Controllers\CityController::class,'filter']]);
Router::add(['POST','/user/filter',[\App\Controllers\UserController::class,'filter']]);

Router::add(['POST','/country/delete',[\App\Controllers\CountryController::class,'delete']]);
Router::add(['POST','/city/delete',[\App\Controllers\CityController::class,'delete']]);
Router::add(['POST','/user/delete',[\App\Controllers\UserController::class,'delete']]);

Router::add(['GET','/country/edit',[\App\Controllers\CountryController::class,'edit']]);
Router::add(['GET','/city/edit',[\App\Controllers\CityController::class,'edit']]);
Router::add(['GET','/user/edit',[\App\Controllers\UserController::class,'edit']]);

Router::add(['POST','/country/update',[\App\Controllers\CountryController::class,'update']]);
Router::add(['POST','/city/update',[\App\Controllers\CityController::class,'update']]);
Router::add(['POST','/user/update',[\App\Controllers\UserController::class,'update']]);

Router::add(['GET','/country/create',[\App\Controllers\CountryController::class,'create']]);
Router::add(['GET','/city/create',[\App\Controllers\CityController::class,'create']]);
Router::add(['GET','/user/create',[\App\Controllers\UserController::class,'create']]);

Router::add(['POST','/country/save',[\App\Controllers\CountryController::class,'save']]);
Router::add(['POST','/city/save',[\App\Controllers\CityController::class,'save']]);
Router::add(['POST','/user/save',[\App\Controllers\UserController::class,'save']]);


$container->set(\App\Controllers\CityController::class, fn($c) => new CityController(
    $c->get(\App\Services\CityService::class),new CountryService($c->get(\App\Repositories\MySqlCountryRepository::class),new DTOCountryMapper()),new CityViewBuilder,new OwnRender(),new Validator())
);

$container->set(\App\Services\CityService::class, fn($c) => new CityService(
    $c->get(\App\Repositories\MySqlCityRepository::class), new DTOCityMapper(),$c->get(\App\Repositories\MySqlCountryRepository::class)
));

$container->set(\App\Repositories\MySqlCityRepository::class, fn($c) => new MySqlCityRepository(
    $c->get(\App\Database::class)
));

$container->set(\App\Database::class, fn($c) => new Database(
    $c->get(\App\DatabaseConfig::class)
));

$container->set(\App\DatabaseConfig::class, fn($c) => new DatabaseConfig()
);

//---------------------------------------------------

$container->set(\App\Controllers\CountryController::class, fn($c) => new CountryController(
    $c->get(\App\Services\CountryService::class),new CountryViewBuilder(),new OwnRender(),new Validator())
);

$container->set(\App\Services\CountryService::class, fn($c) => new CountryService(
    $c->get(\App\Repositories\MySqlCountryRepository::class), new DTOCountryMapper()
));

$container->set(\App\Repositories\MySqlCountryRepository::class, fn($c) => new MySqlCountryRepository(
    $c->get(\App\Database::class)
));

$container->set(\App\Database::class, fn($c) => new Database(
    $c->get(\App\DatabaseConfig::class)
));

$container->set(\App\DatabaseConfig::class, fn($c) => new DatabaseConfig()
);

//-------------------------------------------------------------------------

$container->set(\App\Controllers\UserController::class, fn($c) => new UserController(
    $c->get(\App\Services\UserService::class), $c->get(\App\Services\CityService::class),new UserViewBuilder(),new OwnRender(),new Validator())
);

$container->set(\App\Services\UserService::class, fn($c) => new UserService(
    $c->get(\App\Repositories\MySqlUserRepository::class), new DTOUserMapper(),$c->get(\App\Repositories\MySqlUserRepository::class)
));

$container->set(\App\Repositories\MySqlUserRepository::class, fn($c) => new MySqlUserRepository(
    $c->get(\App\Database::class)
));

$container->set(\App\Database::class, fn($c) => new Database(
    $c->get(\App\DatabaseConfig::class)
));

$container->set(\App\DatabaseConfig::class, fn($c) => new DatabaseConfig()
);


$container->set(\App\Controllers\HomeController::class, fn($c) => new HomeController(new OwnRender())
);



$app = new App(new Router($container,new OwnRender,new Logger));
$request = Request::fromGlobals();
$response = $app->handle($request);
$response->send();


