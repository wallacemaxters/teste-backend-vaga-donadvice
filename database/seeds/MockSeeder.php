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


    }
}
