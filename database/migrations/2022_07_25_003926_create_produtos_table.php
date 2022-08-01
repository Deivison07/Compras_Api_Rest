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
            $table->unsignedBigInteger('marca_id');
            $table->unsignedBigInteger('categoria_id');
            $table->unsignedBigInteger('tipo_id');

            $table->string('nome_produto')->unique();
            $table->text('descricao_produto')->nullable();
            $table->string('imagem_produto');
            $table->integer('quantidade_produto');
            $table->float('valor_produto');

            $table->timestamps();

            //foreign key (constraints)
            $table->foreign('marca_id')->references('id')->on('marcas');
            $table->foreign('categoria_id')->references('id')->on('categorias');
            $table->foreign('tipo_id')->references('id')->on('tipos');
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

            $table->dropForeign('produtos_categoria_id_foreign'); //[table]_[coluna]_foreign
            $table->dropForeign('produtos_marca_id_foreign');
            $table->dropForeign('produtos_tipo_id_foreign');
        });

        Schema::dropIfExists('produtos');
    }
}
