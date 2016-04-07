<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cursos', function (Blueprint $table) {
            $table->string('codigo', 15)->primary();
            $table->string('nombre', 25)->unique();
            $table->string('logo', 25)->unique();
            $table->string('color_hexa', 7)->nullable();
            $table->decimal('costo_personalizado', 6, 2)->default(0);
            $table->decimal('costo_referencial', 6, 2)->default(0);
            $table->string('eslogan', 50)->nullable();
            $table->text('descripcion');
            $table->decimal('horas_academicas', 5, 2)->default(0);
            $table->decimal('horas_reales', 5, 2)->default(0);

            // Foreign Keys
            $table->integer('area_id')->unsigned();
            $table->foreign('area_id')->references('id')->on('areas');
            $table->integer('dificultad_id')->unsigned();
            $table->foreign('dificultad_id')->references('id')->on('dificultades');

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
        Schema::drop('cursos');
    }
}
