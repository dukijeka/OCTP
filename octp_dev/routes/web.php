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

Route::get('/', 'HomeController@index')->name('home');

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::resource('user', 
                'UsersController', 
                ['only' => ['show', 
                            'edit',
                            'update',
                            'destroy']])->middleware('auth');

Route::get('/showAllUsers', 'UsersController@showAll');
Route::post('user/changepass/{id}', 'UsersController@changePass');
Route::post('user/changeemail/{id}', 'UsersController@changeEmail');
Route::post('user/promoteuser/{id}', 'UsersController@promoteUser');
Route::post('user/demoteuser/{id}', 'UsersController@demoteUser');
Route::delete('user/deleteuser/{id}', 'UsersController@deleteUser');

Route::get('/document', 'DocumentsController@index');
Route::get('/document/showAll', 'DocumentsController@showAll');
Route::get('/document/my', 'DocumentsController@my');
Route::resource('document',
                'DocumentsController',
                ['only' => ['show',
                            'create',
                            'store',
                            'destroy']
                ]);

Route::get('/report', 'ReportsController@index');
Route::get('/report/my', 'ReportsController@my');
Route::get('/report/store', 'ReportsController@store');
Route::get('/report/destroy', 'ReportsController@destroy');

