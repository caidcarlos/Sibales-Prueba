<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLiderSubcategoria extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lider_subcategoria', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_lider');
            $table->unsignedBigInteger('id_subcategoria');
            $table->foreign('id_lider')->references('id')->on('lider_social');
            $table->foreign('id_subcategoria')->references('id')->on('subcategorias');
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
        Schema::table('lider_subcategoria', function (Blueprint $table){
            $table->dropForeign('id_lider');
            $table->dropForeign('id_subcategoria');
        });
        Schema::dropIfExists('lider_subcategoria');
    }
}
