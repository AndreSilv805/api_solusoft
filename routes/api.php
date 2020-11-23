<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/
Route::get('produtos-search', 'Api\ProdutosController@pesquisar');
Route::apiResource('produtos', 'Api\ProdutosController');

Route::get('clientes-search', 'Api\ClientesController@pesquisar');
Route::apiResource('clientes', 'Api\ClientesController');


Route::get('pedidos-search', 'Api\PedidosController@pesquisar');
Route::put('pedidos/{id}/add', 'Api\PedidosController@adicionar');
Route::delete('pedidos/remover/{id}', 'Api\PedidosController@remove');
Route::get('pedidos/pdf/{id}', 'Api\PedidosController@pdf');
Route::get('pedidos/email/{id}', 'Api\PedidosController@email');
Route::apiResource('pedidos', 'Api\PedidosController');



