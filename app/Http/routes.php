<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

// Backend - Restful
Route::group(['prefix' => 'admin'], function(){
    // Backend Area
    Route::resource('area', 'AreaController');

    // Backend Dificultad
    Route::resource('dificultad', 'DificultadController');

    // Backend Carrera
    Route::resource('carrera', 'CarreraController');
    Route::put('carrera/upload/{carrera}', 'CarreraController@upload')->name('admin.carrera.upload');

    // Backend Curso
    Route::resource('curso', 'CursoController');
    Route::put('curso/upload/{curso}', 'CursoController@upload')->name('admin.curso.upload');
    Route::get('curso/listar/relaciones', 'CursoController@listar')->name('admin.curso.listar');
});
