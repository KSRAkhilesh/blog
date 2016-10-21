<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


Route::get('about')
->uses('PagesController@getAbout');

Route::get('contact')
->uses('PagesController@getContact');

Route::post('contact')
->uses('PagesController@postContact');

Route::get('')
->uses('PagesController@getIndex');

Route::get('blog/{slug}')
->name('blog.single')
->uses('BlogController@getSingle')
->where('slug','[\w\d\-\_]+');

Route::get('blog')
->uses('BlogController@getIndex')
->name('blog.index');



Auth::routes();

Route::get('/home', 'HomeController@index');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('posts','PostController');
});

Route::resource('categories','CategoryController',['except'=>['create']]);
Route::resource('tags','TagController',['except'=>['create']]);

// Comments
Route::post('comments/{id}')
->uses('CommentsController@store')
->name('comments.store');

Route::get('comments/{id}/edit')
->uses('CommentsController@edit')
->name('comments.edit');

Route::put('comments/{id}')
->uses('CommentsController@update')
->name('comments.update');

Route::delete('comments/{id}')
->uses('CommentsController@destroy')
->name('comments.destroy');
Route::get('comments/{id}/delete')
->uses('CommentsController@delete')
->name('comments.delete');