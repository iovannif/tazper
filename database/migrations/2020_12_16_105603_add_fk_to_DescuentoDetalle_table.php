<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkToDescuentoDetalleTable extends Migration
{
    public function up()
    {
        Schema::table('DescuentoDetalle', function (Blueprint $table) {
            $table->foreign('Id_Desc')->references('Id_Desc')->on('Descuento')->onDelete('cascade');
            $table->foreign('Id_Lp')->references('Id_Lp')->on('ListaPrecio');
            $table->foreign('Id_Cli')->references('Id_Cli')->on('Clientes')->onDelete('cascade');
            $table->foreign('Id_Art')->references('Id_Art')->on('Articulos')->onDelete('cascade');
            $table->foreign('Id_Cat')->references('Id_Cat')->on('Categoria')->onDelete('cascade');                                    
        });
    }

    public function down()
    {
        Schema::table('DescuentoDetalle', function (Blueprint $table) {
            $table->dropForeign(['Id_Desc']);
            $table->dropForeign(['Id_Lp']);
            $table->dropForeign(['Id_Cli']);
            $table->dropForeign(['Id_Art']);
            $table->dropForeign(['Id_Cat']);
        });
    }
}