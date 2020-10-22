<?php

namespace App\Api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produto extends Model
{
    use SoftDeletes;

    protected $table = 'produtos';

    protected $fillable = [
        'cod_produto', 'nome', 'valor','cores','tamanhos'
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    public function getCoresArrayAttribute()
    {
        return explode(",",$this->cores);
    }

    public function getTamanhosArrayAttribute()
    {
        return explode(",",$this->tamanhos);
    }

}
