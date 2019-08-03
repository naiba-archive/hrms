<?php
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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

/**
 * Dingo 在 Header 中控制 API 版本
 *  Accept: application/vnd.YOUR_SUBTYPE.v1+json
 */
$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) {
    $api->post('register', 'App\Http\Controllers\LoginController@register');
});
