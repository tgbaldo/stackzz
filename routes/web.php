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

$router->get('/', function () {
    return redirect(route('posts'));
});

$router->get('/404', function () {
    echo "Página não encontrada";
});

// posts
$router->group(
    [
        'prefix' => 'posts'
    ],
    function () use ($router) {
        $router->get(
            '/',
            [
                'as' => 'posts',
                'uses' => '\App\Domains\Post\PostController@index'
            ]
        );
        $router->get(
            '/create',
            [
                'as' => 'posts.create',
                'uses' => '\App\Domains\Post\PostController@create'
            ]
        );
        $router->get(
            '/{slug}',
            [
                'as' => 'posts.show',
                'uses' => '\App\Domains\Post\PostController@show'
            ]
        );
        $router->post(
            '/',
            [
                'as' => 'posts.store',
                'uses' => '\App\Domains\Post\PostController@store'
            ]
        );
        $router->get(
            '/edit/{id}',
            [
                'as' => 'posts.edit',
                'uses' => '\App\Domains\Post\PostController@edit'
            ]
        );
        $router->put(
            '/{id}',
            [
                'as' => 'posts.update',
                'uses' => '\App\Domains\Post\PostController@update'
            ]
        );
        $router->get(
            '/tag/{tagName}',
            [
                'as' => 'posts.tag',
                'uses' => '\App\Domains\Post\PostController@getAllPostsByTagName'
            ]
        );
    }
);

// comments
$router->group(
    [
        'prefix' => 'comments'
    ],
    function () use ($router) {
        $router->post(
            '/store',
            [
                'as' => 'comments.store',
                'uses' => '\App\Domains\Comment\CommentController@store'
            ]
        );
    }
);