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

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

\Illuminate\Support\Facades\DB::listen(function ($query)
{
    logger($query->sql);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Route::group(['prefix'=>'/roles', 'as'=>'roles.', 'middleware' => 'auth'], function (){
//    Route::get('', 'RoleController@index')->name('index');
//    Route::get('create', 'RoleController@create')->name('create');
//    Route::post('', 'RoleController@store')->name('store')->middleware('auth');
//    Route::get('{role}', 'RoleController@show')->name('show');
//    Route::get('{role}/edit', 'RoleController@edit')->name('edit');
//    Route::PUT('{role}', 'RoleController@update')->name('update');
//    Route::delete('{role}', 'RoleController@destroy')->name('destroy');
//});

Route::group(['middleware'=>'auth'], function () {
    Route::resource('roles', 'RoleController');
    Route::resource('works', 'WorkController');
    Route::resource('staff', 'StaffController');
    Route::resource('cities', 'CityController');
    Route::resource('visitors', 'VisitorController');
    Route::resource('articles', 'ArticleController');
    Route::resource('events', 'EventController');
    Route::resource('folders', 'FolderController');

    Route::resource('folder/{folder}/upload', 'FolderUploadController');

});

Route::get('citiesByCountry/{country}', 'CityController@getCitiesByCountryId')->name('cityAjax');
Route::get('staff/index/ajax/{work_id}', "StaffController@getStaffByJob");
Route::PUT('toggle/active/{id}', 'ToggleController@activation');
Route::PUT('toggle/publish/{id}', 'ToggleController@publish');

Route::post('uploads/file', 'UploadController@file')->name("upload.file");
Route::post('uploads/image', 'UploadController@image')->name("upload.image");
