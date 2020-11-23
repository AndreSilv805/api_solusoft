<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Api\Produto;

class ProdutosController extends Controller
{
    public function __construct()
    {

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function index(){


        return Produto::all();

    }

    public function store(Request $request)
    {

        $produto = [
            'cod_produto' => $request->cod_produto,
            'nome' => $request->nome,
            'valor'=> str_replace(',', '.', $request->valor),
            'cores'=> implode(",",$request->cores),
            'tamanhos'=> implode(",",$request->tamanhos)
        ];

        $prod = Produto::create($produto);

         return $prod;

    }

    public function show($id)
    {
        //dd(Produto::all());
        $produto = Produto::findOrFail($id);
        $produto->cores = $produto->coresArray;
        $produto->tamanhos = $produto->tamanhosArray;
        return $produto;
    }

    public function update(Request $request, $id)
    {
        $produto = Produto::findOrFail($id);

        $prod = [
            'cod_produto' => $request->cod_produto,
            'nome' => $request->nome,
            'valor'=> str_replace(',', '.', $request->valor),
            'cores'=> implode(",",$request->cores),
            'tamanhos'=> implode(",",$request->tamanhos)
        ];

        $produto -> update($prod);

    }

    public function destroy($id)
    {
        $produto = Produto::findOrFail($id);
        $produto -> delete();
    }

    public function pesquisar(Request $request)
    {
        $search = function ($query) use($request) {

            $termos = $request->only('nome');

            foreach ($termos as $nome => $valor) {
                if ($valor) {
                    $query->where($nome, 'LIKE', '%' . $valor . '%');
                }
            }

            $iguais = $request->only('cod_produto','valor');

            foreach ($iguais as $nome => $valor) {
                if ($valor) {
                    $query->where($nome, '=', $valor);
                }
            }
        };
        return Produto::where($search)->paginate(9);

    }

}
