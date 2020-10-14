<?php

namespace App\Api;

use Illuminate\Database\Eloquent\Model;

class Variation extends Model
{
    protected $table = 'cor_tamanho';

    protected $fillable = [
        'produto','nome'
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function cores()
    {
        return $this->hasMany(Cor::class, 'produto_id', 'id');
    }

    public function tamanhos()
    {
        return $this->hasMany(Tamanho::class, 'produto_id', 'id');
    }


}
