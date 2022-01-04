<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeneficioEntregado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beneficio_entregado', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->string('observacion', 240)->nullable();
            $table->unsignedBigInteger('id_lider_beneficio');
            $table->unsignedBigInteger('id_secretaria')->nullable();
            $table->unsignedBigInteger('id_evento')->nullable();
            $table->foreign('id_lider_beneficio')->references('id')->on('lider_subcategoria');
            $table->foreign('id_secretaria')->references('id')->on('secretaria');
            $table->foreign('id_evento')->references('id')->on('evento');
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
        Schema::table('beneficio_entregado', function (Blueprint $table){
            $table->dropForeign(['id_lider_beneficio','id_secretaria','id_evento']);
        });
        Schema::dropIfExists('beneficio_entregado');
    }
}
