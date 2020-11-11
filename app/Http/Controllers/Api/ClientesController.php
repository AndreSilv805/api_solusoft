<?php

namespace App\Http\Controllers\Api;

use App\Api\Cliente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
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
        return Cliente::findOrFail($id);
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
        $cliente = Cliente::findOrFail($id);

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

    public function pesquisar(Request $request)
    {
        $search = function ($query) use($request) {

            $termos = $request->only('nome','cpf');

            foreach ($termos as $nome => $valor) {
                if ($valor) {
                    $query->where($nome, 'LIKE', '%' . $valor . '%');
                }
            }

            $iguais = $request->only('cod_cliente');

            foreach ($iguais as $nome => $valor) {
                if ($valor) {
                    $query->where($nome, '=', $valor);
                }
            }
        };
        return Cliente::where($search)->paginate(9);

    }



}
