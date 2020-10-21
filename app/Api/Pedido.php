<?php

namespace App\Api;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';

    protected $with = ['produtos','items'];

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

    public function addProduct($product_id, $quantity = null, $valorvenda)
    {
        if(!$this->products->contains($product_id)){
            $quantity  = $quantity ?? 1;
            $this->produtos()->attach($product_id, ['quantidade' => $quantity,'valor_vendido' => $valorvenda]);
            return "Produto adicionado";
        }
        $product  = $this->produtos()->find($product_id);
        $quantity = $quantity ? $quantity : $product->ped->quantidade + 1;
        $this->produtos()->updateExistingPivot($product_id, ['quantidade' => $quantity,'valor_vendido' => $valorvenda]);
        return "Quantidade atualizada";
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
