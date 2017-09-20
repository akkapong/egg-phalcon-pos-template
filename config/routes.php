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
$api = new RouterGroup(array(
    'namespace' => 'Users\Controllers'
));

//==== Start : user Section ====//
$api->addGet('/users', [
    'controller' => 'user',
    'action'     => 'getUser',
]);

$api->addGet('/users/{id}', [
    'controller' => 'user',
    'action'     => 'getUserdetail',
    'params'     => 1
]);

$api->addPost('/users', [
    'controller' => 'user',
    'action'     => 'postUser',
]);

$api->addDelete('/users/{id}', [
    'controller' => 'user',
    'action'     => 'deleteUser',
    // 'params'     => 1
]);
//==== End : user Section ====//

$api->addGet('/basic', [
    'controller' => 'index',
    'action'     => 'basic',
]);

$api->addGet('/basics', [
    'controller' => 'index',
    'action'     => 'basicList',
]);

$api->addGet('/test', [
    'controller' => 'test',
    'action'     => 'mongoInsert',
]);

// $api->addGet('/deal/detail', [
//     'controller' => 'deal',
//     'action'     => 'getDealDetail',
// ]);

// $api->addPost('/deal', [
//     'controller' => 'deal',
//     'action'     => 'postCreate',
// ]);

// $api->addPut('/deal/:params', [
//     'controller' => 'deal',
//     'action'     => 'putUpdate',
//     'params'     => 1
// ]);

// $api->addDelete('/deal/:params', [
//     'controller' => 'deal',
//     'action'     => 'deleteDeal',
//     'params'     => 1
// ]);
//==== End : Deal Section ====//

$router->mount($api);

return $router;
