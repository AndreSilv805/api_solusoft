<?php

namespace App\Http\Controllers\Api;

use App\Api\Cor;
use App\Api\Tamanho;
use App\Api\Variation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Api\Produto;
use PDF;

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

    //response()->jason()  outra forma de retorna um json




    public function index(){

        //dd(Produto::all());
        //return Produto::all()
        //$pdf = PDF::loadView('pdf');
        //return $pdf->setPaper('a4')->stream('teste pdf');
        return Produto::all();

    }

    public function store(Request $request)
    {

        $produto = [
            'cod_produto' => $request->cod_produto,
            'nome' => $request->nome,
            'valor'=> $request->valor,
            'cores'=> implode(",",$request->cores),
            'tamanhos'=> implode(",",$request->tamanhos)
        ];

        $prod = Produto::create($produto);

        ###condicional para criação de cores e tamanhos e variações
        if ($request->cores != null){

            $cores = $request->cores;

            foreach($cores as $cor){
            $prod->cores()->create(['nome'=>$cor, 'value'=>$cor, 'text'=>$cor, ]);
            }

            $tamanhos = $request->tamanhos;

            foreach($tamanhos as $tamanho){
                $prod->tamanhos()->create(['nome'=>$tamanho, 'value'=>$tamanho, 'text'=>$tamanho,]);
            }

            $coresvariacao = Cor::where('produto_id','=',$prod->id)->get();
            $tamanhosvariacao = Tamanho::where('produto_id','=',$prod->id)->get();

            ///// CRIADOR DE VARIAÇÕES
            foreach ($coresvariacao as $cor){
                foreach ($tamanhosvariacao as $tam) {
                    $cor->tamanhos()->attach($tam->id,['produto'=>$prod->id, 'nome'=>$cor->nome."/".$tam->nome]);
                }
            }

            // $prod->cores()->delete();

            ///$prod->cores()->where('nome','=','laranja') -> delete();
        }

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

        $coresvariacao = Cor::where('produto_id','=',$produto->id)->get();
        $tamanhosvariacao = Tamanho::where('produto_id','=',$produto->id)->get();
        $variacoes = Variation::where('produto','=',$produto->id)->get();

        foreach ( $variacoes as $variacao){
            $variacao -> delete();
        }

        foreach ( $coresvariacao as $variacao){
            $variacao -> delete();
        }

        foreach ( $tamanhosvariacao as $variacao){
            $variacao -> delete();
        }

        $prod = [
            'cod_produto' => $request->cod_produto,
            'nome' => $request->nome,
            'valor'=> $request->valor,
            'cores'=> implode(",",$request->cores),
            'tamanhos'=> implode(",",$request->tamanhos)
        ];

        $produto -> update($prod);



        if ($request->cores != null){

            ///// CRIADOR DE CORES
            $cores = $request->cores;
            foreach($cores as $cor){
                $produto->coress()->create(['nome'=>$cor,'value'=>$cor,'text'=>$cor, ]);
            }

            ///// CRIADOR DE TAMANHOS
            $tamanhos = $request->tamanhos;
            foreach($tamanhos as $tamanho){
                $produto->tamanhoss()->create(['nome' =>$tamanho, 'value'=>$tamanho, 'text'=>$tamanho ]);
            }

            $coresvariacao = Cor::where('produto_id','=',$produto->id)->get();
            $tamanhosvariacao = Tamanho::where('produto_id','=',$produto->id)->get();
            $variacoes = Variation::where('produto','=',$produto->id)->get();

            ///// CRIADOR DE VARIAÇÕES

            foreach ($coresvariacao as $cor){
                foreach ($tamanhosvariacao as $tam) {
                    //if (in_array($nomevariacao, $variacoes,true)) {
                        $cor->tamanhos()->attach($tam->id,['produto' => $produto->id, 'nome' => $cor->nome ."/". $tam->nome]);
                    //}
                }
            }

            // $prod->cores()->delete();

            ///$prod->cores()->where('nome','=','laranja') -> delete();
        }



    }

    public function destroy($id)
    {
        $produto = Produto::findOrFail($id);
        $produto -> delete();
    }
    public function add(){

        //dd(Produto::all());
        //return Produto::all();
        return Produto::all();
        //$pdf = PDF::loadView('pdf');
        //return $pdf->setPaper('a4')->stream('teste pdf');

    }
    public function cores()
    {
        //$cor = Cor::findOrFail(1);
        $prod = Produto::findOrFail(2);
        $cores = Cor::where('produto_id','=',$prod->id)->get();
        $tamanhos = Tamanho::where('produto_id','=',$prod->id)->get();
        //$vari = Variation::all();

        $variations = Variation::all();


        foreach ( $variations as $var){
            $var -> delete();
        }

        ///// CRIADOR DE VARIAÇÕES
        foreach ($cores as $cor){
            foreach ($tamanhos as $tam) {
                $cor->tamanhos()->attach($tam->id);
            }
        }
        $variations = Variation::all();
        /////outra forma de criar cores
        //$cor->tamanhos()->attach(1);?
        //return $cor = Produto::with('cores')->find(1);
        //return $pedidos = Cliente::all();
        //$pedidos = Cliente::all();
        //dd($pedidos);
        return $variations;
    }
}
