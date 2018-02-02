<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatecontribuyentesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contribuyentes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 50);
            $table->string('dui', 12);
            $table->string('nit', 20);
            $table->date('nacimiento');
            $table->date('fechaDebaja')->nullable();
            $table->string('telefono', 10);
            $table->integer('genero');
            $table->string('direccion');
            $table->tinyInteger('estado')->default(1);
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
        Schema::drop('contribuyentes');
    }
}
