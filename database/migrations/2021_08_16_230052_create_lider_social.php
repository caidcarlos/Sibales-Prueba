<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLiderSocial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lider_social', function (Blueprint $table) {
            $table->id();
            $table->string('cedula', 9)->unique();
            $table->string('p_nombre', 20);
            $table->string('s_nombre', 20)->nullable();
            $table->string('p_apellido', 20);
            $table->string('s_apellido', 20)->nullable();
            $table->string('carnet_psuv', 20)->unique();
            $table->string('telefono_1', 12);
            $table->string('telefono_2', 12)->nullable();
            $table->string('direccion', 100);
            $table->unsignedBigInteger('id_parroquia')->nullable();
            $table->unsignedBigInteger('id_ubch')->nullable();
            $table->unsignedBigInteger('id_comuna')->nullable();
            $table->unsignedBigInteger('id_consejocomunal')->nullable();
            $table->foreign('id_parroquia')->references('id')->on('parroquias');
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
        Schema::table('lider_social', function (Blueprint $table){
            $table->dropForeign(['id_parroquia']);
        });
        Schema::dropIfExists('lider_social');
    }
}
