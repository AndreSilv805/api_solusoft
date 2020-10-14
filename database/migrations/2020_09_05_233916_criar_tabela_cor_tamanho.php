<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarTabelaCorTamanho extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cor_tamanho', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->unsignedInteger('cor');
            $table->unsignedInteger('tamanho');
            $table->unsignedInteger('produto');

            $table->foreign('cor')->references('id')->on('cores');
            $table->foreign('tamanho')->references('id')->on('tamanhos');
            $table->foreign('produto')->references('id')->on('produtos');



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
        Schema::dropIfExists('cor_tamanho');
    }
}
