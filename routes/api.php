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


Route::group([
    'prefix'    => '/auth',
    'namespace' => 'Auth'
], function () {
    Route::post('register', 'RegisterController');
    Route::post('login', 'AuthController@login');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('logout', 'AuthController@logout');

});

Route::group(['middleware' => ['auth:api']], function () {
    Route::group([
        'prefix'     => '/clients',
        'middleware' => []
        // todo проверка доступов к клиенту
    ], function () {
        Route::get('/', 'ClientsController@getList');
        Route::get('/{client_id}', 'ClientsController@getOne');

        Route::post('/', 'ClientsController@create');
        Route::put('/{client_id}', 'ClientsController@update');
        Route::delete('/{client_id}', 'ClientsController@delete');
    });
});