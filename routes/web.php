<?php

use App\Entities\Customer;

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

use Doctrine\ORM\Query\ResultSetMapping;
use LaravelDoctrine\ORM\Facades\EntityManager;

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/customers', 'CustomerController@index');
$router->get('/customers/{id}', 'CustomerController@show');

