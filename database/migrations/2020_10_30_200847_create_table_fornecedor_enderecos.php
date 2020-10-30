<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableFornecedorEnderecos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fornecedor_enderecos', function (Blueprint $table) {

            $table->increments('id');

            $table->string('cep');
            $table->string('logradouro');
            $table->string('complemento')->nullable();
            $table->string('numero')->nullable();
            $table->string('bairro');
            $table->string('cidade');
            $table->char('uf', 2);

            $table->integer('fornecedor_id')->unsigned();

            $table->timestamps();

            $table->softDeletes();

            $table->foreign('fornecedor_id')->on('fornecedores')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fornecedor_enderecos');
    }
}
