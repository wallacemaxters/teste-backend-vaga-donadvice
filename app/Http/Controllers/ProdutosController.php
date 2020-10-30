<?php

namespace App\Http\Controllers;

use App\Models\Produto;
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
        return $produto;
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
            'nome'         => 'required|string|max:200|unique:produtos,nome,id,'. $produto->id,
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


    public function adicionarFornecedor(Produto $produto, Request $request)
    {
        $dados = $request->validate([
            'fornecedor_id' => 'required|exists:fornecedores,id',
            'preco'         => 'required|numeric',
        ]);

        $produto->fornecedores()->sync([$dados['fornecedor_id'] => $dados], false);

        return $dados;
    }
}



