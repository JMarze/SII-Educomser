<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInscripcionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscripciones', function (Blueprint $table) {
            $table->increments('id');
            $table->text('observaciones')->nullable();
            $table->boolean('modulo_carrera')->default(false);

            // Foreign Key
            $table->integer('publicidad_id')->unsigned();
            $table->foreign('publicidad_id')->references('id')->on('publicidades')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('alumno_id')->unsigned();
            $table->foreign('alumno_id')->references('id')->on('alumnos')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('lanzamiento_curso_id')->unsigned();
            $table->foreign('lanzamiento_curso_id')->references('id')->on('lanzamiento_curso')->onUpdate('cascade')->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('inscripcion_lanzamiento_carrera', function (Blueprint $table) {
            $table->integer('lanzamiento_carrera_id')->unsigned();
            $table->foreign('lanzamiento_carrera_id')->references('id')->on('lanzamiento_carrera')->onUpdate('cascade');

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
        Schema::drop('inscripcion_lanzamiento_carrera');
        Schema::drop('inscripciones');
    }
}
