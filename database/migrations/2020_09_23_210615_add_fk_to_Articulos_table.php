<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkToArticulosTable extends Migration
{
    public function up()
    {
        Schema::table('Articulos', function (Blueprint $table) {
            $table->foreign('Id_Cat')->references('Id_Cat')->on('Categoria');
            $table->foreign('Id_Imp')->references('Id_Imp')->on('Impuestos');
            $table->foreign('Id_Prov')->references('Id_Prov')->on('Proveedores');
        });
    }

    public function down()
    {
        Schema::table('Articulos', function (Blueprint $table) {            
            $table->dropForeign(['Id_Cat']);
            $table->dropForeign(['Id_Imp']);
            $table->dropForeign(['Id_Prov']);
        });
    }
}