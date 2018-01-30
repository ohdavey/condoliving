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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/communities', 'CommunityController@index');
Route::get('/community/{community}', 'CommunityController@show');
Route::get('/community/{community}/property/{property}', 'PropertyController@show');
Route::get('/tenants', 'TenantController@index');
Route::get('/tenant/{tenant}', 'TenantController@show');
Route::get('/leases', 'LeaseController@index');
Route::get('/lease/create', 'LeaseController@create');
Route::post('/lease', 'LeaseController@store');
Route::get('/lease/{lease}', 'LeaseController@show');
