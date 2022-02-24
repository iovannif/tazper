<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkToPedidosClientesDetalleArticulosTable extends Migration
{
    public function up()
    {
        Schema::table('PedidosClientesDetalle_Articulos', function (Blueprint $table) {
            $table->foreign('Id_PedCli')->references('Id_PedCli')->on('PedidosClientesDetalle')->onDelete('cascade');
            $table->foreign('Id_Art')->references('Id_Art')->on('Articulos');
        });
    }

    public function down()
    {
        Schema::table('PedidosClientesDetalle_Articulos', function (Blueprint $table) {
            $table->dropForeign(['Id_PedCli']);
            $table->dropForeign(['Id_Art']);
        });
    }
}
