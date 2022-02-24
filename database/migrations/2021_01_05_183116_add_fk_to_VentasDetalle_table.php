<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkToVentasDetalleTable extends Migration
{
    public function up()
    {
        Schema::table('VentasDetalle', function (Blueprint $table) {
            $table->foreign('Id_Ven')->references('Id_Ven')->on('Ventas')->onDelete('cascade');
            // $table->foreign('Id_Desc')->references('Id_Desc')->on('Descuento');
        });
    }

    public function down()
    {
        Schema::table('VentasDetalle', function (Blueprint $table) {
            $table->dropForeign(['Id_Ven']);
            // $table->dropForeign(['Id_Desc']);
        });
    }
}
