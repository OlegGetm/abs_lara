<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('article/{slug}', 'ArticleController@show');
// Route::get('articles/{id}', 'ArticleController@show');
Route::get('list/tag/{tag_slug}', 'ArticleController@index');
Route::get('list/category/{category_slug}', 'ArticleController@index');


Route::group([
        'prefix' => 'adminzone', 
        'namespace' => 'Admin', 
        // 'middleware' => 'auth'
    ], function () {
    Route::resource('article', 'ArticleController');
    Route::resource('tag', 'TagController');
});




// ['uses' => 'FooController@method', 'as' => 'name']