<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkToVentasDetalleArticulosTable extends Migration
{
   public function up()
    {
        Schema::table('VentasDetalle_Articulos', function (Blueprint $table) {
            $table->foreign('Id_Ven')->references('Id_Ven')->on('VentasDetalle')->onDelete('cascade');
            $table->foreign('Id_Art')->references('Id_Art')->on('Articulos');
        });
    }

    public function down()
    {
        Schema::table('VentasDetalle_Articulos', function (Blueprint $table) {
            $table->dropForeign(['Id_Ven']);
            $table->dropForeign(['Id_Art']);
        });
    }
}
