<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/
/*
Route::get('/hello', function () {
    //return view('welcome');
    return "<h1>Hello World</h1>";
});

Route::get("/users/{name}/{id}", function($name,$id){
    return "This is user ".$name." with id ".$id;
});*/

/*Ruter poziva metodu index 
koja prikazuje view definisan u toj metodi 
u PagesController kontroleru(glavna strana). Dakle sada ide preko kontrolera.
Ovo '/' je kada se se ukuca lsapp.test u brouseru.
Ako npr. '/about' onda je kada se u brouseru ukuca
lsap.test/about i prikazuje about stranu.*/

Route::get('/', "PagesController@index");
Route::get("/about", "PagesController@about");
Route::get('/services', "PagesController@services");
/* Ovo sluzi da kada korisnik nije registrovan,
da mu ne bude prikazano ono blog, tj.
klikom na isto ne bude odveden na postove, jel' te nije ulogovan. 
$router->group(['middleware'=>'auth'], function(){
    Route::resource("posts", "PostsController");
});
*/

Route::resource("posts", "PostsController");
/*Gornje je identicno donjem.*/
/*
Route::get('/posts', "PostsController@index");
Route::get('/posts/create', "PostsController@create");
Route::get('/posts/{id}', "PostsController@show");
Route::post('/posts', "PostsController@store");
Route::get('/posts/{id}/edit', "PostsController@edit");
Route::put('/posts/{id}', "PostsController@update");
Route::delete('/posts/{id}', "PostsController@destroy");
*/
/*Automatski postavlja autorizaciju. 
Kada se uradi ono sa tinkerom, ovo se automatski doda.*/
Auth::routes();

Route::get('/dashboard', 'DashboardController@index');

Route::get('service/post/view', 'PostController@view');
Route::get('service/post/create', 'PostController@create');
Route::get('service/post/update', 'PostController@update');
Route::get('service/post/delete', 'PostController@delete');