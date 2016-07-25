<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->string('codigo', 12)->primary();
            $table->string('primer_apellido', 25);
            $table->string('segundo_apellido', 25);
            $table->string('nombres', 25);
            $table->string('email', 50)->unique()->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('numero_ci', 15)->nullable();
            $table->enum('genero', ['femenino', 'masculino']);
            $table->text('direccion')->nullable();
            $table->string('telefono_1', 15)->nullable();
            $table->string('telefono_2', 15)->nullable();

            // Foreign Keys
            $table->string('expedicion_codigo', 2)->index();
            $table->foreign('expedicion_codigo')->references('codigo')->on('expediciones');

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
        Schema::drop('personas');
    }
}
