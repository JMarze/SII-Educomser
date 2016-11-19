<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistorialesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historiales', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha_finalizacion');
            $table->tinyInteger('nota')->default(0);
            $table->boolean('certificado')->default(false);
            $table->text('observaciones')->nullable();

            // Foreign Keys
            $table->integer('inscripcion_id')->unsigned();
            $table->foreign('inscripcion_id')->references('id')->on('inscripciones')->onUpdate('cascade');

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
        Schema::drop('historiales');
    }
}
