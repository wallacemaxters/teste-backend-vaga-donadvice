<?php

use App\Models\Produto;
use App\Models\Categoria;
use App\Models\Fornecedor;
use Illuminate\Database\Seeder;

class MockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $categoria = Categoria::create(['nome' => 'Bebidas']);

        $produto = Produto::create([
            'nome' => 'Coca Coca',
            'descricao' => 'Refrigerante de Cola mais vendido do brasil',
            'categoria_id' => $categoria->id,
        ]);

        $fornecedor = Fornecedor::create([
            'nome_fantasia' => 'Wallace Maxters',
            'razao_social'  => 'Wallace de Souza Vizerra',
            'cnpj'          => '33109809000105'
        ]);

        $fornecedor->produtos()->attach($produto, [
            'preco' => 8.99
        ]);

        $fornecedor->telefones()->create([
            'ddd'      => '31',
            'numero' => '999999964',
            'observacao' => 'whatsapp/celular'
        ]);

        $fornecedor->telefones()->create([
            'ddd'      => '31',
            'numero' => '33553333',
            'observacao' => 'comercial'
        ]);

        $fornecedor->endereco()->create([
            'cep' => '324000000',
            'logradouro' => 'Rua Qualquer',
            'bairro'     => 'Novo Horizonte',
            'numero'     => '111',
            'cidade'     => 'Ibirité',
            'uf'         => 'MG',
            'complemento' => 'Bloco 2 Casa 3'
        ]);


    }
}
