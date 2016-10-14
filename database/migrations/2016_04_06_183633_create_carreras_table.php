<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarrerasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carreras', function (Blueprint $table) {
            $table->string('codigo', 15)->primary();
            $table->string('nombre', 100)->unique();
            $table->string('logo', 25)->nullable();
            $table->string('color_hexa', 7)->nullable();
            $table->decimal('costo_mensual', 6, 2)->default(0);
            $table->boolean('vigente')->default(true);
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
        Schema::drop('carreras');
    }
}
