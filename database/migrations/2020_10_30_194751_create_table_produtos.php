<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableProdutos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {

            $table->increments('id');

            $table->string('nome', 200)->unique();

            $table->text('descricao')->nullable();

            $table->integer('categoria_id')->unsigned();

            $table->timestamps();

            $table->softDeletes();

            $table->foreign('categoria_id')->on('categorias')->references('id');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produtos');
    }
}
