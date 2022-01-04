<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUbch extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ubch', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 20)->unique();
            $table->string('nombre', 50);
            $table->string('telefono', 12)->nullable();
            $table->string('direccion', 100);
            $table->unsignedBigInteger('id_parroquia');
            $table->boolean('status');
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
        Schema::table('ubch', function(Blueprint $table){
            $table->dropForeign(['id_parrouia']);
        });
        Schema::dropIfExists('ubch');
    }
}
