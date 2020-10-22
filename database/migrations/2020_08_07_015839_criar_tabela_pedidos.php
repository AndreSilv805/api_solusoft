<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarTabelaPedidos extends Migration
{
    /**
     * Run the migrations.
     * ​código do pedido, data do pedido, observação, forma de pagament
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('cliente_id')->nullable();
            $table->string('cod_pedido')->unique()->nullable();
            $table->dateTime('data_pedido')->nullable();
            $table->string('obeservacao')->nullable();
            $table->string('forma_pagamento')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('cliente_id')->references('id')->on('clientes');

        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedidos');
    }
}
