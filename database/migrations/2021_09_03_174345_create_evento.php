<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evento', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->date('fecha');
            $table->unsignedBigInteger('id_parroquia');
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
        Schema::table('evento', function(Blueprint $table){
            $table->dropForeign(['id_parroquia']);
        });
        Schema::dropIfExists('evento');
    }
}
