<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTecnicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tecnicos', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('rg')->unique()->nullable();
            $table->string('cpf')->unique()->nullable();
            $table->string('telefone')->nullable();
            $table->string('telefone1')->nullable();
            $table->string('address')->nullable();
            $table->unsignedBigInteger('state_id')->nullable();
            $table->unsignedBigInteger('cite_id')->nullable();
            $table->string('agencia')->nullable();
            $table->string('numconta')->nullable();
            $table->string('numbanco')->nullable();
            $table->string('operacao')->nullable();
            $table->string('favorecido')->nullable();
            $table->enum('tipo', ['0', '1'])->nullable();
            $table->string('active', 4)->default('off')->nullable();
            $table->string('image', 190)->nullable();
            
            $table->foreign('state_id')->references('id')->on('states');
            $table->foreign('cite_id')->references('id')->on('cities');
            
            $table->softDeletes()->index();
            $table->timestamps();

            // $table->foreign('state_id')->references('id')->on('states')->onDelete('restrict');
            // $table->foreign('cities_id')->references('id')->on('cities')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tecnicos');
    }
}
