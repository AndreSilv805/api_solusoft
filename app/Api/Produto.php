<?php

namespace App\Api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produto extends Model
{
    //protected $with = ['cores','tamanhos'];

    use SoftDeletes;

    protected $with = ['variations','coress','tamanhoss'];

    protected $table = 'produtos';

    protected $fillable = [
        'cod_produto', 'nome', 'valor','cores','tamanhos'
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    public function coress()
    {
        return $this->hasMany(Cor::class, 'produto_id', 'id');
    }

    public function tamanhoss()
    {
        return $this->hasMany(Tamanho::class, 'produto_id', 'id');
    }

    public function variations()
    {
        return $this->hasMany(Variation::class, 'produto', 'id');
    }
   /* public function setCoresAttribute($value)
    {
        $this->attributes['cores'] = implode(",",$value);
    }*/

    public function getCoresArrayAttribute()
    {
        return explode(",",$this->cores);
    }

    public function getTamanhosArrayAttribute()
    {
        return explode(",",$this->tamanhos);
    }




}
