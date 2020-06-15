<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChamadosTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('chamados', function (Blueprint $table) {
      $table->id();
      $table->string('number')->unique();
      $table->unsignedBigInteger('client_id');
      $table->unsignedBigInteger('sub_client_id');
      $table->unsignedBigInteger('agency_id');
      $table->string('sigla');
      $table->date('dt_scheduling');
      $table->time('arrival_time')->nullable();
      $table->integer('type')->default(0);
      $table->string('v_deslocamento')->nullable();
      $table->string('v_titanium')->nullable();
      $table->unsignedBigInteger('user_id');
      $table->unsignedBigInteger('tecnico_id');
      $table->string('v_atendimento')->nullable();
      $table->string('v_km')->nullable();
      $table->string('zipcode')->nullable();
      $table->string('address');
      $table->unsignedBigInteger('state_id');
      $table->unsignedBigInteger('cite_id');
      $table->text('occurrence')->nullable();
      $table->text('solution')->nullable();
      $table->string('responsavel')->nullable();
      $table->string('tel_responsavel')->nullable();
      $table->string('produtiva')->nullable();
      $table->string('serial')->nullable();
      $table->string('model')->nullable();
      $table->string('marca')->nullable();
      $table->integer('status')->default(0);
      $table->integer('documentacao')->default(0);
      $table->string('departure_time')->nullable();
      $table->string('rat')->nullable();
      $table->string('observacao')->nullable();
      $table->timestamps();

      $table->foreign('user_id')->references('id')->on('users');
      $table->foreign('tecnico_id')->references('id')->on('tecnicos');
      $table->foreign('agency_id')->references('id')->on('agencies');
      $table->foreign('state_id')->references('id')->on('states');
      $table->foreign('cite_id')->references('id')->on('cities');
      // $table->foreign('client_id')->references('id')->on('clients');
      // $table->foreign('sub_client_id')->references('id')->on('sub_clients');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('chamados');
    Schema::table('chamados', function (Blueprint $table) {
      $table->dropForeign('chamados_user_id_foreign');
      $table->dropForeign('chamados_tecnico_id_foreign');
      $table->dropForeign('chamados_state_id_foreign');
      $table->dropForeign('chamados_cite_id_foreign');
      $table->dropForeign('chamados_client_id_foreign');
      $table->dropForeign('chamados_sub_client_id_foreign');
    });
  }
}
