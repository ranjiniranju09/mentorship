<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Route::match(['get', 'post'], '/mentees', 'App\Http\Controllers\MenteeController@menteedash')->name('mentees');

Route::match(['get', 'post'], '/login', 'App\Http\Controllers\LoginRegController@login')->name('login');

Route::match(['get', 'post'], '/register1', 'App\Http\Controllers\LoginRegController@register1')->name('register1');
Route::match(['get', 'post'], '/register2', 'App\Http\Controllers\LoginRegController@register2')->name('register2');


Route::match(['get', 'post'], '/mentorregister', 'App\Http\Controllers\LoginRegController@mentorregister')->name('mentorregister');

Route::match(['get', 'post'], '/registermentor', 'App\Http\Controllers\LoginRegController@registermentor')->name('registermentor');

Route::match(['get', 'post'], '/registermentee', 'App\Http\Controllers\LoginRegController@registermentee')->name('registermentee');

Route::match(['get','post'],'/logged','App\Http\Controllers\LoginRegController@show')->name('logged');

// Route::match(['get','post'],'/tickets','App\Http\Controllers\LoginRegController@tickets')->name('tickets');

Route::match(['get','post'],'/session/{mentorId]','App\Http\Controllers\SessionController@session')->name('session');

Route::match(['get','post'],'/mentor','App\Http\Controllers\MentorController@mentor')->name('mentor');


Route::match(['get','post'],'/sessionstore','App\Http\Controllers\SessionController@sessionstore')->name('sessionstore');

Route::match(['get','post'],'/sessiondelete/{id}','App\Http\Controllers\SessionController@sessiondelete')->name('sessiondelete');

Route::match(['get','post'],'/sessionupdate/{id}','App\Http\Controllers\SessionController@sessionupdate')->name('sessionupdate');

Route::match(['get','post'],'/sessionedit/{id}','App\Http\Controllers\SessionController@sessionedit')->name('sessionedit');

Route::match(['get','post'],'/admin','App\Http\Controllers\AdminController@admin')->name('admin');

Route::match(['get','post'],'/adminstore','App\Http\Controllers\AdminController@adminstore')->name('adminstore');

Route::match(['get','post'],'/mapping','App\Http\Controllers\MappingController@map')->name('mapping');

Route::match(['get','post'],'/mappingstore','App\Http\Controllers\MappingController@mappingstore')->name('mappingstore');

Route::match(['get','post'],'/sessionjoin/{id}','App\Http\Controllers\SessionController@sessionjoin')->name('sessionjoin');

Route::match(['get','post'],'/menteesession','App\Http\Controllers\SessionController@menteesession')->name('menteesession');

Route::match(['get','post'],'/storefeedback/{id}','App\Http\Controllers\SessionController@storefeedback')->name('storefeedback');

Route::match(['get','post'],'/MarkAttendance/{id}','App\Http\Controllers\SessionController@MarkAttendance')->name('MarkAttendance');

Route::match(['get','post'],'/ShowTask','App\Http\Controllers\TasksController@ShowTask')->name('ShowTask');

Route::match(['get','post'],'/StoreTask/{mentorId}','App\Http\Controllers\TasksController@StoreTask')->name('StoreTask');
