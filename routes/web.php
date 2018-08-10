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

/*Route::get('/', function () {
    return view('basic.template');
});*/
Route::get('/','ShowController@showMain');
Route::get('/allClass/{clase}', 'ShowController@showAll');
Route::get('/class/{clase}/{subclase}', 'ShowController@showClass');
Route::get('/item/{item}', 'ShowController@showItem');
//Route::get('/subasta','SubastaController@index');
Route::get('/api','ApiController@index');
Route::get('/checkowner','ApiController@ownercheck');
//Route::get('/extract','ExtractController@treatJson');
Route::get('/api/items','ApiController@items');