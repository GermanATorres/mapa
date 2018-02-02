<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatenegociosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('negocios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('contribuyente_id')->unsiged();
            $table->integer('rubro_id')->unsiged();
            $table->string('nombre', 60);
            $table->text('direccion');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('contribuyente_id')->references('id')->on('contribuyentes');
            $table->foreign('rubro_id')->references('id')->on('rubros');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('negocios');
    }
}
