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

    // Backend Tipo
    Route::resource('tipo', 'TipoController');

    // Backend Grado
    Route::resource('grado', 'GradoController');

    // Backend Profesion
    Route::resource('profesion', 'ProfesionController');
    Route::get('profesion/listar/relaciones', 'ProfesionController@listar')->name('admin.profesion.listar');

    // Backend Docente
    Route::resource('docente', 'DocenteController');
    Route::get('docente/listar/relaciones', 'DocenteController@listar')->name('admin.docente.listar');
    Route::get('docente/{docente}/show', 'DocenteController@show')->name('admin.docente.getshow');

    // Backend Carrera
    Route::resource('carrera', 'CarreraController');
    Route::put('carrera/upload/{carrera}', 'CarreraController@upload')->name('admin.carrera.upload');
    Route::get('carrera/listar/relaciones', 'CarreraController@listar')->name('admin.carrera.listar');
    Route::get('carrera/{carrera}/attach', 'CarreraController@attach')->name('admin.carrera.attach');
    Route::put('carrera/{carrera}/attach', 'CarreraController@postattach')->name('admin.carrera.postattach');

    // Backend Curso
    Route::resource('curso', 'CursoController');
    Route::put('curso/upload/{curso}', 'CursoController@upload')->name('admin.curso.upload');
    Route::get('curso/listar/relaciones', 'CursoController@listar')->name('admin.curso.listar');
    Route::get('curso/{curso}/show', 'CursoController@show')->name('admin.curso.getshow');
    Route::post('curso/{curso}/create_capitulo', 'CursoController@create_capitulo')->name('admin.curso.create_capitulo');
    Route::post('curso/{capitulo}/create_topico', 'CursoController@create_topico')->name('admin.curso.create_topico');
});
