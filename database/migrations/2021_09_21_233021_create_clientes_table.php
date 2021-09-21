<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome');
            $table->string('cpf', 11)->unique();
            $table->string('email', 200)->unique();
            $table->string('nascimento', 15)->nullable();
            $table->string('cep', 9)->nullable();
            $table->string('rua', 40)->nullable();
            $table->string('numero', 10)->nullable();
            $table->string('bairro', 50)->nullable();
            $table->string('uf', 2)->nullable();
            $table->string('cidade', 30)->nullable();
            $table->string('complemento', 50)->nullable();
            $table->string('telefone', 20)->nullable();
                        
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
        Schema::dropIfExists('clientes');
    }
}
