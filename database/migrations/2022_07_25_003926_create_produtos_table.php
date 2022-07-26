<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('marca_produto');
            $table->unsignedBigInteger('categoria_produto')->nullable();
            $table->unsignedBigInteger('tipo_produto')->nullable();

            $table->string('nome_produto')->unique();
            $table->text('descricao_produto')->nullable();
            $table->string('imagem_produto')->nullable();
            $table->integer('quantidade');
            $table->float('valor');

            $table->timestamps();

            //foreign key (constraints)
            $table->foreign('marca_produto')->references('id')->on('marcas');
            $table->foreign('categoria_produto')->references('id')->on('categorias');
            $table->foreign('tipo_produto')->references('id')->on('tipos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('produtos', function(Blueprint $table) {

            $table->dropForeign('produtos_categoria_produto_foreign'); //[table]_[coluna]_foreign
            $table->dropForeign('produtos_marca_produto_foreign');
            $table->dropForeign('produtos_tipo_produto_foreign');
        });

        Schema::dropIfExists('produtos');
    }
}
