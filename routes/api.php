<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    $api->get('/', function (Request $req) {
        return $req->headers;
    });
    $api->group([
        'middleware' => 'api',
        'prefix' => 'auth'
    ], function ($api) {
        $api->post('register', ['as' => 'register', 'uses' => 'App\Http\Controllers\AuthController@register']);
        $api->post('login', ['as' => 'login', 'uses' => 'App\Http\Controllers\AuthController@login']);
        $api->post('logout', 'App\Http\Controllers\AuthController@logout');
        $api->post('refresh', 'App\Http\Controllers\AuthController@refresh');
        $api->post('me', ['as' => 'me', 'middleware' => 'auth:api', 'uses' => 'App\Http\Controllers\AuthController@me']);
    });

    $api->group([
        'middleware' => 'auth:api',
        'prefix' => 'company'
    ], function ($api) {
        $api->post('', 'App\Http\Controllers\CompanyController@add');
        $api->get('', 'App\Http\Controllers\CompanyController@query');
        $api->patch('', 'App\Http\Controllers\CompanyController@update');
        $api->delete('', 'App\Http\Controllers\CompanyController@delete');
    });

    $api->group([
        'middleware' => 'auth:api',
        'prefix' => 'house'
    ], function ($api) {
        $api->post('', 'App\Http\Controllers\HouseController@add');
        $api->get('', 'App\Http\Controllers\HouseController@query');
        $api->patch('', 'App\Http\Controllers\HouseController@update');
        $api->delete('', 'App\Http\Controllers\HouseController@delete');
    });

    $api->group([
        'middleware' => 'api',
        'prefix' => 'contract'
    ], function ($api) {
        $api->post('', 'App\Http\Controllers\ContractController@add');
        $api->get('', 'ContractController@query');
        $api->patch('', 'App\Http\Controllers\ContractController@update');
        $api->delete('', 'App\Http\Controllers\ContractController@delete');
    });

    $api->group([
        'middleware' => 'auth:api',
        'prefix' => 'bill'
    ], function ($api) {
        $api->post('', 'App\Http\Controllers\BillController@add');
        $api->get('', 'App\Http\Controllers\BillController@query');
        $api->patch('', 'App\Http\Controllers\BillController@update');
        $api->delete('', 'App\Http\Controllers\BillController@delete');
    });
});
