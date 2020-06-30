<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

//Route Login & Register
Route::post('register' ,'Api\UserController@Register');
Route::post('login','Api\UserController@Login');

//Route user
Route::get('user', 'Api\UserController@index');
Route::post('user', 'Api\UserController@store');
Route::get('user/{id}', 'Api\UserController@view');
Route::put('user/{id}', 'Api\UserController@update');
Route::delete('user/{id}', 'Api\UserController@destroy');

//Route File
Route::get('file', 'Api\FileController@index');
Route::post('file', 'Api\FileController@store');
Route::get('file/{id}', 'Api\FileController@view');
Route::put('file/{id}', 'Api\FileController@update');
Route::delete('file/{id}', 'Api\FileController@destroy');

//Route Item
Route::get('item', 'Api\ItemController@index');
Route::post('item', 'Api\ItemController@store');
Route::get('item/{id}', 'Api\ItemController@view');
Route::put('item/{id}', 'Api\ItemController@update');
Route::delete('item/{id}', 'Api\ItemController@destroy');

//Route Task
Route::get('task', 'Api\TaskController@index');
Route::post('task', 'Api\TaskController@store');
Route::get('task/{id}', 'Api\TaskController@view');
Route::put('task/{id}', 'Api\TaskController@update');
Route::delete('task/{id}', 'Api\TaskController@destroy');

//Route Role
Route::get('role', 'Api\RoleController@index');
Route::post('role', 'Api\RoleController@store');
Route::get('role/{id}', 'Api\RoleController@view');
Route::put('role/{id}', 'Api\RoleController@update');
Route::delete('role/{id}', 'Api\RoleController@destroy');

//Route Event
Route::get('event', 'Api\EventController@index');
Route::post('event', 'Api\EventController@store');
Route::get('event/{id}', 'Api\EventController@view');
Route::put('event/{id}', 'Api\EventController@update');
Route::delete('event/{id}', 'Api\EventController@destroy');