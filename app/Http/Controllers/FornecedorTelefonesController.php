<?php

namespace App\Http\Controllers;

use App\Models\FornecedorTelefone;
use Illuminate\Http\Request;

class FornecedorTelefonesController extends Controller
{

    public function store(Request $request)
    {
        $dados = $request->validate([
            'ddd'           => 'required|numeric|digits:2',
            'numero'      => 'required|numeric|digits_between:8,9',
            'fornecedor_id' => 'required|exists:fornecedores,id',
            'observacao'    => 'nullable|string|max:200'
        ]);

        return FornecedorTelefone::create($dados);
    }

    public function show(FornecedorTelefone $fornecedor_telefone)
    {
        return $fornecedor_telefone;
    }

    public function update(Request $request, FornecedorTelefone $fornecedor_telefone)
    {
        $dados = $request->validate([
            'ddd'           => 'required|numeric|digits:2',
            'numero'      => 'required|numeric|digits_between:8,9',
            'observacao'    => 'nullable|string|max:200',
            'fornecedor_id' => 'required|exists:fornecedores,id'
        ]);

        $fornecedor_telefone->update($dados);

        return $fornecedor_telefone;
    }


    public function destroy(FornecedorTelefone $fornecedor_telefone)
    {
        $fornecedor_telefone->delete();
    }
}
