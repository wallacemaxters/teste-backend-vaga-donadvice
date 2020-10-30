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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::apiResource('produtos', 'ProdutosController')->parameters([
    'produtos' => 'produto'
]);

Route::get('produtos/{produto}/fornecedores', 'ProdutosController@fornecedores');
Route::put('produtos/{produto}/adicionar-fornecedor', 'ProdutosController@adicionarFornecedor');

Route::apiResource('fornecedores', 'FornecedoresController')->parameters([
    'fornecedores' => 'fornecedor'
]);

Route::get('fornecedores/{fornecedor}/produtos', 'FornecedoresController@produtos');