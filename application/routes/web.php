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

//Auth Controller routes
$router->group(['prefix' => 'auth'], function () use ($router) {
    //Authenticate user
    $router->post(
        '/login',
        [
            'uses' => 'AuthController@authenticate'
        ]
    );
});

//Auth Middleware Group
$router->group(['middleware' => 'auth'], function () use ($router) {

    //Score Controller group
    $router->group(['prefix' => 'score'], function () use ($router) {
        //get user
        $router->get(
            '/',
            [
                'uses' => 'ScoreController@getScore'
            ]
        );
    });

});

