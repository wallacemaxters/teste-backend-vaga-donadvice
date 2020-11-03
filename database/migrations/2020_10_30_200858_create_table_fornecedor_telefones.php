<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableFornecedorTelefones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fornecedor_telefones', function (Blueprint $table) {
            
            $table->increments('id');

            $table->string('numero', 10);

            $table->string('ddd', 2);

            $table->string('observacao', 200)->nullable();

            $table->softDeletes();

            $table->integer('fornecedor_id')->unsigned();

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
        Schema::dropIfExists('fornecedor_telefones');
    }
}
