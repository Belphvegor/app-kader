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
    // return str_random(32);
});
$router->post('/login', 'AuthController@login');
// $router->get('/logout', 'AuthController@logout');

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->group(['prefix' => 'admin'], function () use ($router) {
        $router->group(['prefix' => 'kader'], function () use ($router) {
            $router->get('/', 'KaderController@index');
            $router->post('/store', 'KaderController@store');
            $router->get('/detail/{id}', 'KaderController@detail');
            $router->put('/update/{id}', 'KaderController@update');
            $router->delete('/delete/{id}', 'KaderController@delete');
            $router->get('/trash', 'KaderController@trash');
            $router->post('/restore', 'KaderController@restore');
            $router->post('/destroy', 'KaderController@destroy');
            $router->get('/pencarian', 'KaderController@search');
        });

        $router->group(['prefix' => 'halaqah'], function () use ($router) {
            $router->get('/', 'HalaqahController@index');
            $router->post('/store', 'HalaqahController@store');
            $router->get('/detail/{id}', 'HalaqahController@detail');
            $router->put('/update/{id}', 'HalaqahController@update');
            $router->delete('/delete/{id}', 'HalaqahController@delete');
            $router->get('/trash', 'HalaqahController@trash');
            $router->post('/restore', 'HalaqahController@restore');
            $router->post('/destroy', 'HalaqahController@destroy');
            $router->get('/pencarian', 'HalaqahController@search');
        });

        $router->group(['prefix' => 'tarbiyah'], function () use ($router) {
            $router->get('/datatarbiyah', 'TarbiyahDetailController@index');
            $router->post('/storetarbiyah', 'TarbiyahDetailController@store');
            $router->get('/detailtarbiyah/{id}', 'TarbiyahDetailController@detail');
            $router->delete('/deletetarbiyah/{id}', 'TarbiyahDetailController@delete');
        });

        $router->group(['prefix' => 'marhalah'], function () use ($router) {
            $router->get('/', 'MarhalahController@index');
            $router->post('/store', 'MarhalahController@store');
            $router->get('/detail/{id}', 'MarhalahController@detail');
            $router->put('/update/{id}', 'MarhalahController@update');
            $router->delete('/delete/{id}', 'MarhalahController@delete');
        });

        $router->group(['prefix' => 'event'], function () use ($router) {
            $router->get('/', 'EventController@index');
            $router->post('/store', 'EventController@store');
            $router->get('/detail/{id}', 'EventController@detail');
            $router->put('/update/{id}', 'EventController@update');
            $router->delete('/delete/{id}', 'EventController@delete');
        });

        $router->group(['prefix' => 'open-registration'], function () use ($router) {
            $router->get('/', 'OpenRegistrationController@index');
            $router->post('/store', 'OpenRegistrationController@store');
            $router->get('/detail/{id}', 'OpenRegistrationController@detail');
            $router->put('/update/{id}', 'OpenRegistrationController@update');
            $router->delete('/delete/{id}', 'OpenRegistrationController@delete');
        });
    });

    $router->group(['prefix' => 'register'], function () use ($router) {
        $router->post('/koderegister', 'RegisterController@registrasi');
        $router->post('/storeregister/{id}', 'RegisterController@store');
        $router->get('/detailregister/{id}', 'RegisterController@detail');
    });

    $router->group(['prefix' => 'state'], function () use ($router) {
        $router->get('/provinces', 'WilayahController@provinsi');
        $router->get('/cities', 'WilayahController@kabupaten');
        $router->get('/districts', 'WilayahController@kecamatan');
        $router->get('/villages', 'WilayahController@kelurahan');
    });
});
