<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topicos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('subtitulo', 25);
            $table->string('archivo_url', 25)->nullable();

            // Foreign Keys
            $table->integer('capitulo_id')->unsigned();
            $table->foreign('capitulo_id')->references('id')->on('capitulos');

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
        Schema::drop('topicos');
    }
}
