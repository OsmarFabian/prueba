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

// ruta para el post(tutorial de desarrollo web)
Route::get('post', function(){
	return view('pruebap');
});
Route::post('prueba','pruebasController@recibirPost');Auth::routes();

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('crear_evento', 'EventosController@agregar_evento');