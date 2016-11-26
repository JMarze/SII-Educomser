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
/*Route::get('/', function () {
    return view('welcome');
});*/

Route::auth();

Route::get('/', 'HomeController@index');
Route::get('curso/{codigoCurso}', 'HomeController@verCurso')->name('curso.ver');
Route::get('cronograma', 'HomeController@verCronograma')->name('cronograma.ver');

// Backend - Restful
Route::group(['prefix' => 'admin'], function(){
    // Backend Area
    Route::resource('area', 'AreaController');

    // Backend Dificultad
    Route::resource('dificultad', 'DificultadController');

    // Backend Tipo
    Route::resource('tipo', 'TipoController');

    // Backend Cronograma
    Route::resource('cronograma', 'CronogramaController');
    Route::resource('cronograma_carrera', 'CronogramaCarreraController');

    Route::get('cronograma/listar/relaciones', 'CronogramaController@listar')->name('admin.cronograma.listar');
    Route::get('cronograma_carrera/listar/relaciones', 'CronogramaCarreraController@listar')->name('admin.cronograma_carrera.listar');

    Route::get('cronograma/{cronograma}/attach', 'CronogramaController@attach')->name('admin.cronograma.attach');
    Route::put('cronograma/{cronograma}/attach', 'CronogramaController@postattach')->name('admin.cronograma.postattach');

    Route::post('cronograma/curso', 'CronogramaController@storeCurso')->name('admin.cronograma.storeCurso');
    Route::post('cronograma_carrera/carrera', 'CronogramaCarreraController@storeCarrera')->name('admin.cronograma_carrera.storeCarrera');

    Route::get('cronograma/curso/{lanzamientoId}/edit', 'CronogramaController@editCurso')->name('admin.cronograma.editCurso');
    Route::get('cronograma/carrera/{lanzamientoId}/edit', 'CronogramaCarreraController@editCarrera')->name('admin.cronograma_carrera.editCarrera');

    Route::put('cronograma/curso/{lanzamientoId}', 'CronogramaController@updateCurso')->name('admin.cronograma.updateCurso');
    Route::put('cronograma_carrera/carrera/{lanzamientoId}', 'CronogramaCarreraController@updateCarrera')->name('admin.cronograma_carrera.updateCarrera');

    Route::delete('cronograma/curso/{lanzamientoId}', 'CronogramaController@destroyCurso')->name('admin.cronograma.destroyCurso');
    Route::delete('cronograma_carrera/carrera/{lanzamientoId}', 'CronogramaCarreraController@destroyCarrera')->name('admin.cronograma_carrera.destroyCarrera');

    Route::get('cronograma/curso/disponible', 'CronogramaController@cursosdisponibles')->name('admin.cronograma.cursosdisponibles');
    Route::get('cronograma/carrera/disponible', 'CronogramaCarreraController@carrerasdisponibles')->name('admin.cronograma.carrerasdisponibles');
    Route::get('cronograma/curso/todos', 'CronogramaController@cursostodos')->name('admin.cronograma.cursostodos');

    // Backend Grado
    Route::resource('grado', 'GradoController');

    // Backend Profesion
    Route::resource('profesion', 'ProfesionController');
    Route::get('profesion/listar/relaciones', 'ProfesionController@listar')->name('admin.profesion.listar');

    // Backend Docente
    Route::resource('docente', 'DocenteController');
    Route::get('docente/listar/relaciones', 'DocenteController@listar')->name('admin.docente.listar');
    Route::get('docente/{docente}/show', 'DocenteController@show')->name('admin.docente.getshow');
    Route::get('docente/{docente}/attach', 'DocenteController@attach')->name('admin.docente.attach');
    Route::put('docente/{docente}/attach', 'DocenteController@postattach')->name('admin.docente.postattach');

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

    Route::get('curso/logo/{nombreLogo}', 'CursoController@verLogo')->name('admin.curso.verlogo');

    // Backend Alumno
    Route::resource('alumno', 'AlumnoController');
    Route::get('alumno/listar/relaciones', 'AlumnoController@listar')->name('admin.alumno.listar');
    Route::get('alumno/{alumno}/show', 'AlumnoController@show')->name('admin.alumno.getshow');
    Route::get('alumno/{alumno}/attach', 'AlumnoController@attach')->name('admin.alumno.attach');
    Route::put('alumno/{alumno}/attach', 'AlumnoController@postattach')->name('admin.alumno.postattach');

    Route::put('alumno/{alumno}/attach_curso', 'AlumnoController@postattachcurso')->name('admin.alumno.postattachcurso');
    Route::put('alumno/{alumno}/attach_modulo/{lanzamientoCarrera}', 'AlumnoController@postattachmodulo')->name('admin.alumno.postattachmodulo');
    Route::put('alumno/{alumno}/attach_carrera', 'AlumnoController@postattachcarrera')->name('admin.alumno.postattachcarrera');
    Route::put('alumno/{alumno}/attach_curso_personalizado', 'AlumnoController@postattachcursopersonalizado')->name('admin.alumno.postattachcursopersonalizado');
    Route::put('alumno/{alumno}/attach_historial', 'AlumnoController@postattachhistorial')->name('admin.alumno.postattachhistorial');
    Route::put('alumno/{historial}/attach_certificado', 'AlumnoController@postattachcertificado')->name('admin.alumno.postattachcertificado');

    // Backend Insripcion
    Route::delete('inscripcion/{inscripcion}', 'InscripcionController@destroyCurso')->name('admin.inscripcion.destroy_curso');
    Route::delete('inscripcioncarrera/{inscripcion}', 'InscripcionController@destroyCarrera')->name('admin.inscripcion.destroy_carrera');
    Route::delete('inscripcionmodulo/{inscripcion}/carrera/{inscripcion_carrera}', 'InscripcionController@destroyModulo')->name('admin.inscripcion.destroy_modulo');
    Route::get('inscripcion/{inscripcion}/edit', 'InscripcionController@editCurso')->name('admin.inscripcion.edit_curso');
    Route::get('inscripcioncarrera/{inscripcion}/edit', 'InscripcionController@editCarrera')->name('admin.inscripcion.edit_carrera');
});
