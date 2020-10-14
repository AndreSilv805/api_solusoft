<?php

namespace App\Http\Controllers\Api;

use App\Api\Pedido;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        //
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

    public function pdf(){

        $pdf = PDF::loadView('pdf');
        return $pdf->setPaper('a4')->stream('teste pdf');

    }



}
