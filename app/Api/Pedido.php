<?php

namespace App\Api;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';

    protected $with = ['produtos','item'];

    protected $fillable = [
        'cliente_id', 'cod_pedido', 'obeservacao', 'forma_pagamento',
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id', 'id');
    }

    public function item()
    {
        return $this->hasMany(ItemPedido::class, 'pedido', 'id');
    }

    public function produtos()
    {
        return $this->belongsToMany(Produto::class, 'pedido_produto', 'pedido','produto')
                    ->withPivot(['id','quantidade','valor_vendido'])
                    //->withTimestamps()
                    ->as('ped')
                    ;
    }
}
