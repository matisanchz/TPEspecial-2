<?php
require_once './libs/Router.php';
require_once './app/Controllers/class-api.controller.php';
require_once './app/Controllers/subclass-api.controller.php';

// crea el router
$router = new Router();

// defina la tabla de ruteo
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


// ejecuta la ruta (sea cual sea)
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);