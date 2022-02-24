<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkToCategoriaDetalleTable extends Migration
{
    public function up()
    {
        Schema::table('CategoriaDetalle', function (Blueprint $table){
            $table->foreign('Id_Cat')->references('Id_Cat')->on('Categoria')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('CategoriaDetalle', function (Blueprint $table){
            $table->dropForeign(['Id_Cat']);
        });
    }
}