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
use Spatie\Permission\Models\Role;

Route::get('/', function () {
    return view('welcome');
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
    Route::resource('cities', 'CityController');
});

