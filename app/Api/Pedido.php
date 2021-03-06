<?php

namespace App\Api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pedido extends Model
{
    use SoftDeletes;

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

    public function setIdAttribute($value)
    {
        $this->attributes['id']=$value;
        $this->attributes['data_pedido']=$value;
    }

    public function setCreatedAtAttribute($value)
    {
        $this->attributes['created_at']=$value;
        $this->attributes['data_pedido']=$value;
    }


    /*public function getCodPedidoAttribute()
    {
        return $this->id;
    }*/

    public function getDataPedidoAttribute()
    {
        return date('d/m/Y H:i');
    }


}
