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

// $router->post('graphql/login', 'AuthenticateController@authenticate');

$router->get('/', function () use ($router) {
    // config(['app.locale' => 'en']);
    return [
      'framework' => $router->app->version(),
      'env' => app()->environment(),
      'debug' => config('app.locale')
    ];
});

$router->post('/test.json', function () use ($router) {
    return [
        'test' => true
    ];
});

$router->get('/schema.json', function () use ($router) {
    $schema = GraphQL::introspection('admin');
    // dd($schema);
    return response()->json($schema);
});
$router->post('/schema.json', function () use ($router) {
    $schema = GraphQL::introspection('admin');

    return response()->json($schema);
});


$router->group(['prefix' => 'api', 'middleware' => 'auth'], function () use ($router) {
    $router->get('/', function ()    {
        // Uses Auth Middleware
    });

    $router->get('user/profile', function () {
        // Uses Auth Middleware
    });

    $router->get('/example', 'ExampleController@getExample');
});
