<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Fornecedor;
use Illuminate\Http\Request;

class FornecedoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Fornecedor::paginate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dados = $request->validate([
            'nome_fantasia' => 'required|string',
            'razao_social'  => 'required|string',
            'cnpj'          => 'required|string|cnpj|unique:fornecedores,cnpj',
        ]);

        return Fornecedor::create($dados);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fornecedor  $fornecedor
     * @return \Illuminate\Http\Response
     */
    public function show(Fornecedor $fornecedor)
    {
        return $fornecedor;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fornecedor  $fornecedor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fornecedor $fornecedor)
    {
        $dados = $request->validate([
            'nome_fantasia' => 'required|string',
            'razao_social'  => 'required|string',
            'cnpj'          => 'required|string|cnpj|unique:fornecedores,cnpj,' . $fornecedor->id,
        ]);

        $fornecedor->fill($dados)->save();

        return $fornecedor;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fornecedor  $fornecedor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fornecedor $fornecedor)
    {
        $fornecedor->delete();

        return response()->noContent();
    }

    public function produtos(Fornecedor $fornecedor)
    {
        return $fornecedor->produtos()->paginate();
    }

    public function salvarProduto(Fornecedor $fornecedor, Request $request)
    {
        $request->validate([
            'produto_id' => 'required|exists:produtos,id',
            'preco'      => 'required|numeric'
        ]);


        $fornecedor->produtos()->sync([
            $request->get('produto_id') => $request->only('preco')
        ], false);


        return $fornecedor->produtos()->findOrFail($request->produto_id)->pivot;
    }

    public function excluirProduto(Fornecedor $fornecedor, Produto $produto)
    {
        $resultado = $fornecedor->produtos()->detach($produto);

        return response(['status' => (boolean) $resultado], $resultado ? 200 : 404);
    }
}
