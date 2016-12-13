<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('monto', 6, 2)->default(0);
            $table->text('observaciones');
            $table->integer('numero_factura');

            // Foreign Keys
            $table->integer('inscripcion_id')->unsigned();
            $table->foreign('inscripcion_id')->references('id')->on('inscripciones')->onUpdate('cascade');
            $table->integer('concepto_id')->unsigned();
            $table->foreign('concepto_id')->references('id')->on('conceptos')->onUpdate('cascade');

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
        Schema::drop('pagos');
    }
}
