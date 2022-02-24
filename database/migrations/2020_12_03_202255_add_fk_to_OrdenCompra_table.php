<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkToOrdenCompraTable extends Migration
{
    public function up()
    {
        Schema::table('OrdenCompra', function (Blueprint $table) {
            $table->foreign('Id_PedProv')->references('Id_PedProv')->on('PedidosProveedores');
            $table->foreign('Id_Prov')->references('Id_Prov')->on('Proveedores');
            $table->foreign('Id_Suc')->references('Id_Suc')->on('Sucursal');
            $table->foreign('Id_PtoExp')->references('Id_PtoExp')->on('PtoExpedicion');
        });
    }

    public function down()
    {
        Schema::table('OrdenCompra', function (Blueprint $table) {
            $table->dropForeign(['Id_PedProv']);            
            $table->dropForeign(['Id_Prov']);            
            $table->dropForeign(['Id_Suc']);            
            $table->dropForeign(['Id_PtoExp']);            
        });
    }
}
