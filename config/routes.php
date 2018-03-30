<?php
/*
 * Define custom routes. File gets included in the router service definition.
 */
// $router = new Phalcon\Mvc\Router();

// $router->addGet("/basic", "Index::basic");
// $router->addGet("/basic-list", "Index::basicList");
// $router->addGet("/test-mongo", "test::mongoInsert");

// return $router;

use Phalcon\Mvc\Router\Group as RouterGroup;

$router->removeExtraSlashes(true);

$router->setDefaults(array(
    'namespace'  => 'Core\Controllers',
    'controller' => 'error',
    'action'     => 'page404'
));

//==========Route for api==========
/** [New Route For Module] **/



$router->mount($api);

return $router;
