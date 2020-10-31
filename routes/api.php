<?php

use Illuminate\Http\Request;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/', function () {
    return [
        'titulo'       => 'Teste de Backend Donadvice',
        'autor'        => 'Wallace Maxters',
        'documentacao' => 'https: //documenter.getpostman.com/view/245362/TVYKbwpf',
        'laravel'      => app()->version()
    ];
});

Route::apiResource('categorias', 'CategoriasController')->parameters([
    'categorias' => 'categoria'
]);


Route::apiResource('produtos', 'ProdutosController')->parameters([
    'produtos' => 'produto'
]);

Route::get('produtos/{produto}/fornecedores', 'ProdutosController@fornecedores');
Route::put('produtos/{produto}/salvar-fornecedor', 'ProdutosController@salvarFornecedor');
Route::delete('produtos/{produto}/excluir-fornecedor/{fornecedor}', 'ProdutosController@excluirFornecedor');

Route::apiResource('fornecedores', 'FornecedoresController')->parameters([
    'fornecedores' => 'fornecedor'
]);

Route::get('fornecedores/{fornecedor}/produtos', 'FornecedoresController@produtos');
Route::put('fornecedores/{fornecedor}/salvar-produto', 'FornecedoresController@salvarProduto');
Route::delete('fornecedores/{fornecedor}/excluir-produto/{produto}', 'FornecedoresController@excluirProduto');
