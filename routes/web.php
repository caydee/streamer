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

Route::get('/', "Home@index")->name('home');
Route::get('/watch/{key}', "Home@watch");
Auth::routes();

//Cms
Route::get('/cms', 'Cms@index');
Route::get('/cms/dashboard', 'Cms@dashboard');
Route::get('/cms/company', 'Cms@company');
Route::post('/cms/addcompany', 'Cms@addcompany');
Route::post('/cms/editcompany', 'Cms@editcompany');
Route::get('/cms/livestream', 'Cms@livestream');
Route::get('/cms/livestreamusers/{id}/{slug}', 'Cms@livestream_users');
Route::get('/cms/users', 'Cms@users');
Route::post('/cms/usermgt','Cms@usermgt');
Route::post('/cms/getuserroles','Cms@getuserroles');
Route::post('/cms/edituserroles','Cms@edituserroles');
Route::post('/cms/delete','Cms@delete');
Route::post('/cms/update','Cms@update');
Route::Post('/upload','Cms@imageUploadPost')->name('upload');
Route::Post('/cms/addlivestream','Cms@addlivestream');
Route::Post('/cms/editlivestream','Cms@editlivestream');
Route::Post('/cms/addlivestreamusers','Cms@addlivestreamusers');
Route::Post('/cms/editlivestreamusers','Cms@editlivestreamusers');
Route::post('/cms/bulkupload','Cms@bulkupload');
Route::post('/home/logout','Home@logout');
Route::post('/home/login','Home@login');
//Datatables
Route::post('/get_companies','Datatables@get_companies');
Route::post('/get_users','Datatables@get_users');
Route::post('/get_livestreams','Datatables@get_livestreams');
Route::post('/get_livestream_users','Datatables@get_livestream_users');
Route::get('/watch/{$key}','Home@watch');
