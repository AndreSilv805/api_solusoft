<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarTabelaPedidoProduto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedido_produto', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('pedido');
            $table->unsignedInteger('produto');

            $table->string('cod_produto');
            $table->string('nome');
            $table->string('cor')->nullable();
            $table->string('tamanho')->nullable();
            $table->integer('quantidade');
            $table->float('valor_vendido', 8, 2);

            $table->foreign('pedido')->references('id')->on('pedidos');
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
        Schema::dropIfExists('pedido_produto');
    }
}
