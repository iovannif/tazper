<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkToOrdenCompraDetalleArticulosTable extends Migration
{
    public function up()
    {
        Schema::table('OrdenCompraDetalle_Articulos', function (Blueprint $table) {
            $table->foreign('Id_OC')->references('Id_OC')->on('OrdenCompraDetalle')->onDelete('cascade');
            $table->foreign('Id_Art')->references('Id_Art')->on('Articulos');        
        });
    }

    public function down()
    {
        Schema::table('OrdenCompraDetalle_Articulos', function (Blueprint $table) {
            $table->dropForeign(['Id_OC']);
            $table->dropForeign(['Id_Art']);
        });
    }
}
