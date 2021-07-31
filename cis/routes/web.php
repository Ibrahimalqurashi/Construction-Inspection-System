<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/projects/create', 'ProjectsController@create');
Route::post('/projects', 'ProjectsController@store');

Route::get('/projects/add/{id}', 'ProjectsController@add')->name('projects.add');
Route::post('/projects/add', 'ProjectsController@update')->name('projects.update');

Route::get('/projects', 'ProjectsController@index')->name('projects.index');
Route::get('/projects/collections/constructs/{id}', 'ConstructController@show')->name('constructs.show');




Route::get('/projects/collections/constructs/create/{id}', 'ConstructController@create')->name('constructs.create');
Route::post('/projects/collections/constructs', 'ConstructController@store')->name('constructs.store');

Route::get('/projects/collections/constructs/report/{id}', 'ConstructController@start')->name('constructs.start');
Route::post('/projects/collections/constructs/report', 'ConstructController@report')->name('constructs.report');

Route::get('/projects/collections/constructs/upload/{id}', 'ConstructController@upload')->name('constructs.upload');

Route::get('/projects/collections/create/{id}', 'CollectionsController@create');
Route::post('/projects/collections', 'CollectionsController@store')->name('collections.store');

Route::get('/projects/collections/{id}', 'CollectionsController@show')->name('collections.show');

Route::get('/projects/{id}', 'ProjectsController@show')->name('projects.show');



Route::delete('/projects/{id}', 'ProjectsController@destroy')->name('projects.destroy');
Route::delete('/projects/collections/{id}', 'CollectionsController@destroy')->name('collections.destroy');
Route::delete('/projects/collections/constructs/{id}', 'ConstructController@destroy')->name('constructs.destroy');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
