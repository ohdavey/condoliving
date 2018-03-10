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

Route::get('/','CommunityController@index')->name('home');
Auth::routes();
Route::get('/home', 'CommunityController@index')->name('home');
Route::get('/communities', 'CommunityController@index')->name('communities');
Route::get('/community/create', 'CommunityController@create');
Route::post('/community/create', 'CommunityController@store');
Route::get('/community/{community}', 'CommunityController@show')->name('community.show');
Route::post('/community/{community}', 'CommunityController@update');
Route::get('/community/{community}/properties', 'PropertyController@index');
Route::get('/community/{community}/property/create', 'PropertyController@create');
Route::get('/community/{community}/property/{property}', 'PropertyController@show')->name('property.show');
Route::get('/community/{community}/property/{property}/lease/create', 'LeaseController@create')->name('lease.create');
Route::post('/community/{community}/property/store', 'PropertyController@store');
Route::get('/properties', 'PropertyController@index');
Route::get('/tenants', 'TenantController@index');
Route::get('/tenant/{tenant}', 'TenantController@show');
Route::post('/tenants/lookup', 'TenantController@lookUpTenant');
Route::get('/leases', 'LeaseController@index');
Route::get('/lease/create', 'LeaseController@create');
Route::post('/lease', 'LeaseController@store');
Route::get('/lease/{lease}', 'LeaseController@show');
