<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChamados extends Migration
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
      $table->unsignedBigInteger('agency_id')->nullable();
      $table->unsignedBigInteger('user_id');
      $table->unsignedBigInteger('tecnico_id');
      $table->unsignedBigInteger('state_id');
      $table->unsignedBigInteger('cite_id');
      $table->string('prefix', 20)->nullable();
      $table->string('sigla', 20)->nullable();
      $table->date('start');
      $table->date('end')->nullable();
      $table->time('arrival_time')->nullable();
      $table->integer('type')->default(0);
      $table->string('cot', 60)->nullable();
      $table->string('pagamento', 6)->nullable();
      $table->string('solicitante')->nullable();
      $table->string('tel_solicitante')->nullable();
      $table->string('email_solicitante')->nullable();
      $table->string('v_deslocamento')->nullable()->default(0);
      $table->string('v_titanium')->nullable()->default(0);
      $table->string('v_atendimento')->nullable()->default(0);
      $table->string('v_km')->nullable()->default(0);
      $table->string('total')->nullable()->default(0);
      $table->string('zipcode')->nullable();
      $table->string('address');
      $table->text('occurrence')->nullable();
      $table->text('solution')->nullable();
      $table->string('responsavel')->nullable();
      $table->string('tel_responsavel')->nullable();
      $table->string('improdutiva', 5)->nullable();
      $table->string('serial', 50)->nullable();
      $table->string('model', 30)->nullable();
      $table->string('marca', 25)->nullable();
      $table->integer('status')->default(1);
      $table->string('documentacao', 5)->default('off');
      $table->string('departure_time')->nullable();
      $table->string('rat')->nullable();
      $table->text('observacao')->nullable();
      $table->timestamps();

      $table->foreign('user_id')->references('id')->on('users');
      // $table->foreign('tecnico_id')->references('id')->on('tecnicos');
      // $table->foreign('agency_id')->references('id')->on('agencies');
      $table->foreign('state_id')->references('id')->on('states');
      $table->foreign('cite_id')->references('id')->on('cities');
      $table->foreign('client_id')->references('id')->on('clients');
      $table->foreign('sub_client_id')->references('id')->on('sub_clients');
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
