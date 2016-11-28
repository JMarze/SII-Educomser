<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLanzamientoCursoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lanzamiento_curso', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('costo', 6, 2)->default(0);
            $table->boolean('confirmado')->default(true);

            // Foreign Keys
            $table->string('curso_codigo', 15)->index();
            $table->foreign('curso_codigo')->references('codigo')->on('cursos')->onUpdate('cascade');
            $table->integer('cronograma_id')->unsigned();
            $table->foreign('cronograma_id')->references('id')->on('cronogramas')->onUpdate('cascade')->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('lanzamiento_curso_docente', function (Blueprint $table) {
            $table->integer('lanzamiento_curso_id')->unsigned();
            $table->foreign('lanzamiento_curso_id')->references('id')->on('lanzamiento_curso')->onUpdate('cascade');

            $table->integer('docente_id')->unsigned();
            $table->foreign('docente_id')->references('id')->on('docentes')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('lanzamiento_curso_docente');
        Schema::drop('lanzamiento_curso');
    }
}
