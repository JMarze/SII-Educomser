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
            $table->foreign('expedicion_codigo')->references('codigo')->on('expediciones')->onUpdate('cascade');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('persona_profesion', function (Blueprint $table) {
            $table->string('persona_codigo', 12)->index();
            $table->foreign('persona_codigo')->references('codigo')->on('personas')->onUpdate('cascade');

            $table->integer('profesion_id')->unsigned();
            $table->foreign('profesion_id')->references('id')->on('profesiones')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('persona_profesion');
        Schema::drop('personas');
    }
}
