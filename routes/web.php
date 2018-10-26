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

Route::group(['prefix' => 'admin', 'middleware' => ['admin'], 'namespace' => 'Admin'], function() {

    CRUD::resource('users', 'UsersController');
    CRUD::resource('categories', 'CategoriesController');
    CRUD::resource('products', 'ProductsController');
    CRUD::resource('activities', 'ActivitiesController');
    CRUD::resource('countries', 'CountriesController');

});

Route::group(['middleware' => ['web']], function() {

    Route::get('/', 'HomepageController@showPage')->name('index');
    Route::get('/quiz', 'TestpageController@showPage')->name('test');
    Route::post('/quiz/get-question', 'TestpageController@getQuestion')->name('getQuestion');
});