<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('docentes', function (Blueprint $table) {
            $table->increments('id');
            $table->text('biografia');
            $table->string('email_institucional', 50)->unique()->nullable();
            $table->boolean('vigente')->default(true);
            $table->string('social_facebook', 100)->unique()->nullable();
            $table->string('social_twitter', 100)->unique()->nullable();
            $table->string('social_googleplus', 100)->unique()->nullable();
            $table->string('social_youtube', 100)->unique()->nullable();
            $table->string('social_linkedin', 100)->unique()->nullable();
            $table->string('social_website', 100)->unique()->nullable();

            // Foreign Keys
            $table->string('persona_codigo', 12)->index();
            $table->foreign('persona_codigo')->references('codigo')->on('personas')->onUpdate('cascade')->onDelete('cascade');

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
        Schema::drop('docentes');
    }
}
