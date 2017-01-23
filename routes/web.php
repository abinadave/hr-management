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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::group(['middleware' => 'auth'], function () {
    Route::post('/role', 'RoleController@insert');
    Route::get('employee/management', 'EmployeeController@emloyeeManagement');
    Route::post('user/employee', 'EmployeeController@insert');
    Route::delete('role/{id}', 'RoleController@delete');
});