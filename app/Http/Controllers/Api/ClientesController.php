<?php

namespace App\Http\Controllers\Api;

use App\Api\Cliente;
use App\Api\Cor;
use App\Api\Produto;
use App\Api\Tamanho;
use App\Api\Variation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Cliente::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Cliente::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Cleinte::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cliente = Produto::findOrFail($id);

        $cliente -> update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente -> delete();
    }

    public function cores()
    {
        //$cor = Cor::findOrFail(1);
        $prod = Produto::findOrFail(1);
        $cores = Cor::where('produto_id','=',$prod->id)->get();
        $tamanhos = Tamanho::where('produto_id','=',$prod->id)->get();
        $vari = Variation::all();
        $vari -> destroy();
        //$variations = Variation::all();
        ///// CRIADOR DE VARIAÇÕES
        foreach ($cores as $cor){
            foreach ($tamanhos as $tam) {
                $cor->tamanhos()->attach($tam->id);
            }
        }
        //$cor->tamanhos()->attach(1);
        //return $cor = Produto::with('cores')->find(1);
        //return $pedidos = Cliente::all();
        //$pedidos = Cliente::all();
        //dd($pedidos);
        return $cores;
    }
}
