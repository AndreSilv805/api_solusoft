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
Route::get('produtos/cor', 'Api\ProdutosController@cores');
Route::get('produtos/add', 'Api\ProdutosController@add');
Route::apiResource('produtos', 'Api\ProdutosController');

Route::apiResource('clientes', 'Api\ClientesController');

Route::get('pedidos/pdf', 'Api\PedidosController@pdf');
Route::apiResource('pedidos', 'Api\PedidosController');


