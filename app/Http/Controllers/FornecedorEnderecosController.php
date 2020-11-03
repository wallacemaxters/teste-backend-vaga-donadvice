<?php

namespace App\Http\Controllers;

use App\Models\FornecedorEndereco;
use Illuminate\Http\Request;

class FornecedorEnderecosController extends Controller
{

    public function store(Request $request)
    {
        $dados = $request->validate([
            'cep'           => 'required|numeric|digits:8',
            'numero'        => 'nullable',
            'logradouro'     => 'required|string',
            'cidade'        => 'required|string',
            'uf'            => 'required|string|size:2',
            'bairro'        => 'required|string',
            'complemento'   => 'nullable|string',
            'fornecedor_id' => 'required|exists:fornecedores,id'
        ]);

        return FornecedorEndereco::create($dados);
    }

    public function show(FornecedorEndereco $fornecedor_endereco)
    {
        return $fornecedor_endereco;
    }

    public function update(Request $request, FornecedorEndereco $fornecedor_endereco)
    {
        $dados = $request->validate([
            'cep'           => 'required|numeric|digits:8',
            'numero'        => 'nullable',
            'logradouro'     => 'required|string',
            'cidade'        => 'required|string',
            'uf'            => 'required|string|size:2',
            'bairro'        => 'required|string',
            'complemento'   => 'nullable|string',
            'fornecedor_id' => 'required|exists:fornecedores,id'
        ]);

        $fornecedor_endereco->update($dados);

        return $fornecedor_endereco;
    }


    public function destroy(FornecedorEndereco $fornecedor_endereco)
    {
        $fornecedor_endereco->delete();
    }
}
