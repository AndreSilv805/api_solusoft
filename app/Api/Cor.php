<?php

namespace App\Api;

use Illuminate\Database\Eloquent\Model;

class Cor extends Model
{
    protected $table = 'cores';

    protected $fillable = [
        'nome', 'value', 'text'
    ];
    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function produtos()
    {
        return $this->belongsTo(Cor::class, 'produto_id', 'id');
    }

    public function tamanhos()
    {
        return $this->belongsToMany(Tamanho::class, 'cor_tamanho', 'cor','tamanho')
        ->withPivot(['produto','nome']);
    }
}
