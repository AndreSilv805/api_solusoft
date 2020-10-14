<?php

namespace App\Api;

use Illuminate\Database\Eloquent\Model;

class Tamanho extends Model
{
    protected $table = 'tamanhos';

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

    public function cores()
    {
        return $this->belongsToMany(Cor::class, 'cor_tamanho', 'tamanho','cor');
    }
}
