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

    Route::get('/quiz-statistics', 'QuizHistoryController@showList')->name('admin.quiz-statistic');


});

Route::group(['middleware' => ['web']], function() {

    Route::get('/', 'HomepageController@showPage')->name('index');
    Route::get('/experiences', 'SearchController@showPage')->name('experiences');

    Route::get('/contacts', 'HomepageController@showContacts')->name('contacts');
    Route::get('/how-we-work', 'HomepageController@showHowWeWork')->name('how-we-work');
    Route::get('/order', 'ProfileController@orderPage')->name('orderPage');
    Route::get('/search', 'SearchController@showPage')->name('search');

    Route::get('/experience/{id}', 'ProductController@showPage')->name('product');
    Route::get('/toOrder/{id?}', 'ProductController@toCart')->name('productToOrder');

    Route::get('/quiz', 'QuizController@showPage')->name('quiz-part1');
    Route::post('/quiz/get-question', 'QuizController@getQuestion')->name('getQuestion');
    Route::get('/quiz/part2', 'QuizController@showPart2')->name('quiz-part2');
    Route::any('/quiz/part3', 'QuizController@showPart3')->name('quiz-part3');
    Route::post('/quiz/register', 'Auth\RegisterController@register')->name('quiz-register');
    Route::get('/quiz-results', 'QuizController@showResults')->name('quiz-results');
});

Auth::routes();


Route::group(['middleware' => ['auth']], function() {
    Route::get('/profile', 'ProfileController@showPage')->name('profile');
});
