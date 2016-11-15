<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLanzamientoCarreraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lanzamiento_carrera', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('mensualidad', 6, 2)->default(0);
            $table->decimal('matricula', 6, 2)->default(0);

            // Foreign Keys
            $table->string('carrera_codigo', 15)->index();
            $table->foreign('carrera_codigo')->references('codigo')->on('carreras')->onUpdate('cascade');
            $table->integer('cronograma_id')->unsigned();
            $table->foreign('cronograma_id')->references('id')->on('cronogramas')->onUpdate('cascade');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('lanzamiento_carrera');
    }
}
