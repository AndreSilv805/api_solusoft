<?php

namespace App\Http\Controllers\Api;

use App\Api\Pedido;
use App\Api\ItemPedido;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use PDF;

class PedidosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {

        return Pedido::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ped = Pedido::create();
        return $ped;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Pedido::findOrFail($id);
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
        $pedido = Pedido::findOrFail($id);

        $pedido -> update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pedido = Pedido::findOrFail($id);
        $pedido -> delete();

        //$pedido = Pedido::findOrFail(1);
        //$pedido->produtos()->attach(1,['nome'=>'nome']);

        //$pedido->produtos()->attach(1,[quantidade => 1]);
        //dd($pedido->produtos);

        //foreach ($pedido->produtos as $produto){
        //  echo "{$produto->pivot->created_at}{$produto->pivot->nome}<br>";
        //}

        //return Pedido::all();
        //$produto -> update($request->all());
    }

    public function pdf($id){
        $pedido = Pedido::findOrFail($id);
        $pdf = PDF::loadView('pdf', compact('pedido'));
        return $pdf->setPaper('a4')->stream('teste pdf');

    }

    public function adicionar(Request $request, $id){

        $pedido = Pedido::findOrFail($id);

        $prod = [
            'cod_produto' => $request->cod_produto,
            'nome' => $request->nome."  ".$request->selecaocores."  ".$request->selecaotamanhos,
            'cor' => $request->selecaocores,
            'tamanho' => $request->selecaotamanhos,
            'quantidade' => $request->quantidade,
            'valor_vendido' => $request->valor
        ];

        $pedido->produtos()->attach($request->id,$prod);
    }
    public function remove($id){

        $item = ItemPedido::findOrFail($id);
        $item -> delete();

    }

    public function email($id){

        $pedido = Pedido::findOrFail($id);

        Mail::send('pdf', ['pedido' => $pedido ], function($m){
            $m->from('als2009f@gmail.com','André');
            $m->to('smartcapinha@gmail.com');
        });

    }



}
