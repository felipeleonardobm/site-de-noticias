<?php
use core\Router;

$router = new Router();

$router->get('/', 'HomeController@index');

//USUÁRIO

$router->get('/login', 'HomeController@login');
$router->get('/cadastro', 'HomeController@cadastrar');
$router->get('/logout', 'HomeController@logout');

$router->post('/cadastro', 'UserController@cadastrarAction');
$router->post('/login', 'UserController@loginAction');

//CATEGORIA

$router->get('/newCategory', 'HomeController@newCategory');
$router->get('/listCategories', 'HomeController@listCategories');
$router->get('/editCategory/{id}', 'HomeController@editCategory');
$router->get('/excluirCategoria/{id}', 'CategoryController@deleteAction');

$router->post('/newCategory', 'CategoryController@newAction');
$router->post('/editCategory/{id}', 'CategoryController@editAction');


//NOTÍCIA

$router->get('/newPost', 'HomeController@newPost');
$router->get('/listPosts', 'HomeController@listPosts');
$router->get('/editPost/{id}', 'HomeController@editPost');
$router->get('/posts/{id}', 'HomeController@viewPosts');
$router->get('/post/{id}', 'HomeController@post');
$router->get('/excluirPost/{id}', 'PostController@deletePost');

$router->post('/newPost', 'PostController@newPost');
$router->post('/editPost/{id}', 'PostController@editPost');
