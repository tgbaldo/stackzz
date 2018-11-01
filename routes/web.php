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

$router->get('/infusion', function () {
    
    $infusionsoft = new \Infusionsoft\Infusionsoft(array(
        'clientId'     => 'rdh4btg4heh6y7bfy5y9aarz',
        'clientSecret' => 'GU3a2vcMGV',
        'redirectUri'  => 'https://stackzz.herokuapp.com/infusion/callback',
    ));

    // If the serialized token is available in the session storage, we tell the SDK
    // to use that token for subsequent requests.
    if (isset($_SESSION['token'])) {
        $infusionsoft->setToken(unserialize($_SESSION['token']));
    }

    // If we are returning from Infusionsoft we need to exchange the code for an
    // access token.
    if (isset($_GET['code']) and !$infusionsoft->getToken()) {
        $_SESSION['token'] = serialize($infusionsoft->requestAccessToken($_GET['code']));
    }

    if ($infusionsoft->getToken()) {
        // Save the serialized token to the current session for subsequent requests
        $_SESSION['token'] = serialize($infusionsoft->getToken());

        // MAKE INFUSIONSOFT REQUEST
    } else {
        echo '<a href="' . $infusionsoft->getAuthorizationUrl() . '">Click here to authorize</a>';
    }
});

$router->get('/infusion/callback', function () {
    
    echo "POST<br><br>";
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";

    echo "<br><br>GET<br><br>";
    echo "<pre>";
    print_r($_GET);
    echo "</pre>";
});

$router->get('/', function () {
    return redirect(route('posts'));
});

$router->get('/home', function () {
    return redirect(route('posts'));
});

$router->get('/404', function () {
    exit('Página não encontrada');
});

// posts
$router->group(
    [
        'middleware' => 'auth',
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
            '/edit/{slug}',
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
        $router->delete(
            '/{id}',
            [
                'as' => 'posts.delete',
                'uses' => '\App\Domains\Post\PostController@delete'
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
        'middleware' => 'auth',
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

// users
$router->group(
    [
        'prefix' => 'users'
    ],
    function () use ($router) {
        $router->get('/logout',
            [
                'as' => 'users.logout',
                'uses' => 'Auth\LoginController@logout'
            ]
        );
    }
);


$router->get('login/google', 'Auth\LoginController@redirectToProvider')
    ->name('google.login');

$router->get('login/google/callback', 'Auth\LoginController@handleProviderCallback')
    ->name('google.callback');

Auth::routes();
