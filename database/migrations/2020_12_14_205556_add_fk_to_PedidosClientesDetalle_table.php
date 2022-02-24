<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkToPedidosClientesDetalleTable extends Migration
{
    public function up()
    {
        Schema::table('PedidosClientesDetalle', function (Blueprint $table) {
            $table->foreign('Id_PedCli')->references('Id_PedCli')->on('PedidosClientes')->onDelete('cascade');            
            // $table->foreign('Id_Desc')->references('Id_Desc')->on('Descuento');   
        });
    }

    public function down()
    {
        Schema::table('PedidosClientesDetalle', function (Blueprint $table) {
            $table->dropForeign(['Id_PedCli']);
            // $table->dropForeign(['Id_Desc']);
        });
    }
}
