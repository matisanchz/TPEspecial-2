<?php
require_once './libs/Router.php';
require_once './app/Controllers/class-api.controller.php';
require_once './app/Controllers/subclass-api.controller.php';
require_once './app/Controllers/specie-api.controller.php';
require_once './app/Controllers/user-api.controller.php';

$router = new Router();

$router->addRoute('auth/token', 'GET', 'AuthApiController', 'getToken');

$router->addRoute('classes', 'GET', 'ClassApiController', 'getClasses');
$router->addRoute('classes/:ID', 'GET', 'ClassApiController', 'getClass');
$router->addRoute('classes/:ID', 'DELETE', 'ClassApiController', 'deleteClass');
$router->addRoute('classes/:ID', 'PUT', 'ClassApiController', 'editClass'); 
$router->addRoute('classes', 'POST', 'ClassApiController', 'insertClass'); 

$router->addRoute('subclasses', 'GET', 'SubclassApiController', 'getSubclasses');
$router->addRoute('subclasses/:ID', 'GET', 'SubclassApiController', 'getSubclass');
$router->addRoute('subclasses/:ID', 'DELETE', 'SubclassApiController', 'deleteSubclass');
$router->addRoute('subclasses/:ID', 'PUT', 'SubclassApiController', 'editSubclass'); 
$router->addRoute('subclasses', 'POST', 'SubclassApiController', 'insertSubclass');

$router->addRoute('species', 'GET', 'SpecieApiController', 'getSpecies');
$router->addRoute('species/:ID', 'GET', 'SpecieApiController', 'getSpecie');
$router->addRoute('species/:ID', 'DELETE', 'SpecieApiController', 'deleteSpecie');
$router->addRoute('species/:ID', 'PUT', 'SpecieApiController', 'editSpecie'); 
$router->addRoute('species', 'POST', 'SpecieApiController', 'insertSpecie');


// ejecuta la ruta (sea cual sea)
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);