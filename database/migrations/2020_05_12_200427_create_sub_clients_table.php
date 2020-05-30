<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_clients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
            $table->string('phone');
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('state_id');
            $table->unsignedBigInteger('cite_id');

            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('state_id')->references('id')->on('states');
            $table->foreign('cite_id')->references('id')->on('cities');

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
        Schema::dropIfExists('sub_clients');
    }
}
