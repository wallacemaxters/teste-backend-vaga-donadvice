<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Fornecedor;
use Illuminate\Http\Request;

class ProdutosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Produto::paginate();
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
            'nome'         => 'required|string|max:200|unique:produtos,nome',
            'descricao'    => 'nullable|string',
            'categoria_id' => 'required|exists:categorias,id',
        ]);


        return Produto::create($dados);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function show(Produto $produto)
    {
        return $produto->load('categoria:id,nome');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produto $produto)
    {

        $dados = $request->validate([
            'nome'         => 'required|string|max:200|unique:produtos,nome,'. $produto->id,
            'descricao'    => 'nullable|string',
            'categoria_id' => 'required|exists:categorias,id',
        ]);


        $produto->fill($dados)->save();

        return $produto;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produto $produto)
    {
        $produto->delete();
    }


    public function fornecedores(Produto $produto)
    {
        return $produto->fornecedores()->paginate();
    }


    /**
     * Cria ou atualiza um fornecedor
     *
     * @param Produto $produto
     * @param Request $request
     */
    public function salvarFornecedor(Produto $produto, Request $request)
    {
        $request->validate([
            'fornecedor_id' => 'required|exists:fornecedores,id',
            'preco'         => 'required|numeric',
        ]);

        $produto->fornecedores()->sync([
            $request->fornecedor_id => $request->only('preco')
        ], false);

        return $produto->fornecedores()->findOrFail($request->fornecedor_id)->pivot;
    }

    /**
     *
     * Excluir um fornecedor do produto
     *
     * @param Produto $produto
     * @param Request $request
     */
    public function excluirFornecedor(Produto $produto, Fornecedor $fornecedor)
    {
        $resultado = $produto->fornecedores()->detach($fornecedor);

        return response(['status' => (boolean) $resultado], $resultado ? 200 : 404);
    }
}



