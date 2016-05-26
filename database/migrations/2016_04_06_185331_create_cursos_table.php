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
            $table->string('nombre', 100)->unique();
            $table->string('logo', 25)->nullable();
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

        Schema::create('carrera_curso', function (Blueprint $table) {
            // Foreign Keys
            $table->string('carrera_codigo', 15)->index();
            $table->foreign('carrera_codigo')->references('codigo')->on('carreras');
            $table->string('curso_codigo', 15)->index();
            $table->foreign('curso_codigo')->references('codigo')->on('cursos');

            $table->tinyInteger('orden')->default(1);
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('carrera_curso');
        Schema::drop('cursos');
    }
}
