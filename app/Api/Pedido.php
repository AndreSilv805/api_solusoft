<?php

namespace App\Api;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';

    protected $with = ['produtos','items', 'cliente'];

    protected $fillable = [
        'cliente_id', 'cod_pedido', 'obeservacao', 'forma_pagamento',
    ];

    protected $hidden = [
        'updated_at',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id', 'id');
    }

    public function items()
    {
        return $this->hasMany(ItemPedido::class, 'pedido', 'id');
    }

    public function removeProduct($product_id)
    {
        return $this->produtos()->detach($product_id);
    }

    public function produtos()
    {
        return $this->belongsToMany(Produto::class, 'pedido_produto', 'pedido','produto')
                    ->withPivot(['cod_produto','nome','quantidade','valor_vendido'])
                    //->withTimestamps()
                    ->as('ped')
                    ;
    }
}
