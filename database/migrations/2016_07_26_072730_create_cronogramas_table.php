<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCronogramasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cronogramas', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('inicio_carrera')->default(false);
            $table->dateTime('inicio')->nullable();
            $table->decimal('duracion_clase')->default(0);
            $table->decimal('costo')->default(0);
            $table->decimal('costo_mensual')->nullable();
            $table->decimal('matricula')->nullable();
            $table->boolean('promocion')->default(false);
            $table->boolean('slider')->default(false);

            // Foreign Keys
            $table->integer('tipo_id')->unsigned();
            $table->foreign('tipo_id')->references('id')->on('tipos');
            $table->string('curso_codigo', 15)->index();
            $table->foreign('curso_codigo')->references('codigo')->on('cursos');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('cronograma_docente', function (Blueprint $table) {
            // Foreign Keys
            $table->integer('cronograma_id')->unsigned();
            $table->foreign('cronograma_id')->references('id')->on('cronogramas');
            $table->integer('docente_id')->unsigned();
            $table->foreign('docente_id')->references('id')->on('docentes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cronograma_docente');
        Schema::drop('cronogramas');
    }
}
