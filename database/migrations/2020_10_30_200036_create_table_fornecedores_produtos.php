<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableFornecedoresProdutos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fornecedores_produtos', function (Blueprint $table) {
            
            $table->integer('produto_id')->unsigned();

            $table->integer('fornecedor_id')->unsigned();

            $table->decimal('preco', 22, 2);

            $table->primary(['produto_id', 'fornecedor_id']);

            $table->foreign('produto_id')->on('produtos')->references('id');
            
            $table->foreign('fornecedor_id')->on('fornecedores')->references('id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fornecedores_produtos');
    }
}
