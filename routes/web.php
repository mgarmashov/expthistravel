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
    CRUD::resource('pages', 'PagesController');
    CRUD::resource('categories', 'CategoriesController');
    CRUD::resource('products', 'ProductsController');
    CRUD::resource('activities', 'ActivitiesController');
    CRUD::resource('countries', 'CountriesController');
    CRUD::resource('orders', 'OrdersController');

    Route::get('/quiz-statistics', 'QuizHistoryController@showList')->name('admin.quiz-statistic');


});

Route::group(['middleware' => ['web']], function() {

    Route::get('/', 'HomepageController@showPage')->name('index');
    Route::get('/experiences', 'SearchController@showPage')->name('experiences');

    Route::get('/contacts', 'HomepageController@showContacts')->name('contacts');
    Route::post('/contacts/send', 'HomepageController@sendContacts')->name('contacts.send');

    foreach (\App\Models\Page::all() as $page) {
        Route::get('/'.$page->slug, 'HomepageController@showStaticPage')->name($page->slug);
    }
    Route::get('/search', 'SearchController@showPage')->name('search');
    Route::get('/order', 'ProfileController@orderPage')->name('orderPage');
    Route::get('/booking', 'ProfileController@bookingPage')->name('bookingPage');
    Route::post('/booking/send', 'ProfileController@createOrder')->name('sendBooking');
    Route::get('/booking/sent', 'ProfileController@thankYouPage')->name('thank-for-order');


    Route::get('/experience/{id}', 'ProductController@showPage')->name('product');
    Route::get('/toOrder/{id?}', 'ProductController@toOrder')->name('productToOrder');
    Route::get('/fromOrder/{id?}', 'ProductController@deleteFromOrder')->name('productDeleteFromOrder');


    Route::get('/quiz', 'QuizController@showPage')->name('quiz-part1');
    Route::post('/quiz/get-question', 'QuizController@getQuestion')->name('getQuestion');
    Route::get('/quiz/part2', 'QuizController@showPart2')->name('quiz-part2');
    Route::any('/quiz/part3', 'QuizController@showPart3')->name('quiz-part3');
    Route::post('/quiz/register', 'Auth\RegisterController@register')->name('quiz-register');
    Route::get('/quiz-results', 'QuizController@showResults')->name('quiz-results');
});

Auth::routes();
//Route::get('/reset-password/{token}', function($token){
//    dd($token);
//})->name('password.reset');


Route::group(['middleware' => ['auth']], function() {
    Route::get('/profile', 'ProfileController@showProductsPage')->name('profile.products');
    Route::get('/profile/show', 'ProfileController@showProfilePage')->name('profile.show');
    Route::post('/profile/save', 'ProfileController@saveProfile')->name('profile.save');
    Route::get('/profile/edit', 'ProfileController@showEditPage')->name('profile.edit');
});
