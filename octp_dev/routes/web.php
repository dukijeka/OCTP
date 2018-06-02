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

Route::get('user/showAllUsers', 'UsersController@showAll');
Route::post('user/promoteuser', 'UsersController@promoteUser');
Route::post('user/demoteuser', 'UsersController@demoteUser');
Route::delete('user/deleteuser', 'UsersController@deleteUser');
Route::resource('user', 
                'UsersController', 
                ['only' => ['show', 
                            'edit',
                            'update',
                            'destroy']])->middleware('auth');
Route::post('user/changepass/{id}', 'UsersController@changePass');
Route::post('user/changeemail/{id}', 'UsersController@changeEmail');

Route::post('/test', 'DocumentsController@addTranslation');
//Route::post('/test', ['as'=> 'ajaxSendmsg', 'uses'=>'DocumentsController@addTranslation']);
Route::get('/document', 'DocumentsController@index');
Route::get('/document/showAll', 'DocumentsController@showAll');
Route::get('/document/my', 'DocumentsController@my');
Route::post('/document/add_translation/{?postdata}', 'DocumentsController@addTranslation');
Route::resource('document',
                'DocumentsController',
                ['only' => ['show',
                            'create',
                            'store',
                            'destroy']
                ]);

Route::get('/report', 'ReportsController@index')->middleware('auth');
Route::get('/report/my', 'ReportsController@my')->middleware('auth');
Route::get('/report/store', 'ReportsController@store')->middleware('auth');
Route::get('/report/destroy', 'ReportsController@destroy')->middleware('auth');

