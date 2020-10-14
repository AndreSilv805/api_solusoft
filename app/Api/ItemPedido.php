<?php

namespace App\Api;

use Illuminate\Database\Eloquent\Model;

class ItemPedido extends Model
{

    protected $table = 'pedido_produto';

    protected $hidden = [
        'created_at', 'updated_at',
    ];
    //protected $with = ['produtos'];

    /*protected $fillable = [
        'cliente_id', 'cod_pedido', 'obeservacao', 'forma_pagamento',
    ];*/

}
