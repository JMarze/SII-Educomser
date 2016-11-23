<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInscripcionesCarreraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscripciones_carrera', function (Blueprint $table) {
            $table->increments('id');
            $table->text('observaciones')->nullable();

            // Foreign Key
            $table->integer('alumno_id')->unsigned();
            $table->foreign('alumno_id')->references('id')->on('alumnos')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('lanzamiento_carrera_id')->unsigned();
            $table->foreign('lanzamiento_carrera_id')->references('id')->on('lanzamiento_carrera')->onUpdate('cascade')->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('inscripciones_modulos', function (Blueprint $table) {
            $table->integer('inscripcion_carrera_id')->unsigned();
            $table->foreign('inscripcion_carrera_id')->references('id')->on('inscripciones_carrera')->onUpdate('cascade');

            $table->integer('inscripcion_id')->unsigned();
            $table->foreign('inscripcion_id')->references('id')->on('inscripciones')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('inscripciones_modulos');
        Schema::drop('inscripciones_carrera');
    }
}
