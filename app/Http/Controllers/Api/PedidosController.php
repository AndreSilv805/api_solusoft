<?php

namespace App\Http\Controllers\Api;

use App\Api\Pedido;
use App\Api\ItemPedido;

use App\Mail\ComprovanteEmail;
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


    public function index(Request $request)
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
        $prod = [
            'cod_produto' => $request->cod_produto
        ];
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

    }

    public function pdf($id){

        $pedido = Pedido::findOrFail($id);
        $produtos = $pedido->items;
        $total = 0;
        foreach($produtos as $prod){
                $total += $prod->quantidade*$prod->valor_vendido;
        }
        $numItem = 1;

        $pdf = PDF::loadView('pdf', compact(['pedido','total','numItem']));
        //return $pdf->setPaper('a4')->download('teste_pdf.pdf');
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

        /*Mail::send('pdf', ['pedido' => $pedido ], function($m){
            $m->from('als2009f@gmail.com','André');
            $m->to('smartcapinha@gmail.com');
        });*/
        Mail::send(new ComprovanteEmail($pedido));


    }

    public function pesquisar(Request $request)
    {
        $search = function ($query) use($request) {

            $termos = $request->only('obeservacao','created_at');

            foreach ($termos as $nome => $valor) {
                if ($valor) {
                    $query->where($nome, 'LIKE', '%' . $valor . '%');
                }
            }

            $iguais = $request->only('id');

            foreach ($iguais as $nome => $valor) {
                if ($valor) {
                    $query->where($nome, '=', $valor);
                }
            }
        };
        return Pedido::where($search)->paginate(9);

    }
}
