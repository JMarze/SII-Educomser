<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('clase_entendible_clara', ['Si', 'No', 'Mas o Menos']);
            $table->enum('curso_docente', ['Excelente', 'Muy Bueno', 'Bueno', 'Regular', 'Malo']);
            $table->enum('falta_docente', ['Claridad', 'Orden', 'Dominio', 'Paciencia', 'Ninguno']);
            $table->enum('practicas', ['Adecuadas', 'Difíciles', 'No Aplicables']);
            $table->enum('pregunta_docente', ['Aclara la duda', 'Lo confunde', 'No le responde']);
            $table->enum('falta_curso', ['Práctica', 'Teoría', 'Más tiempo']);
            $table->enum('informacion_proporcionada', ['Excelente', 'Muy Bueno', 'Bueno', 'Regular', 'Malo']);
            $table->text('observaciones');

            // Foreign Keys
            $table->integer('inscripcion_id')->unsigned();
            $table->foreign('inscripcion_id')->references('id')->on('inscripciones')->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('evaluaciones');
    }
}
