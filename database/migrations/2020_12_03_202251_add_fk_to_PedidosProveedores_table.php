<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkToPedidosProveedoresTable extends Migration
{
    public function up()
    {
        Schema::table('PedidosProveedores', function (Blueprint $table) {
            $table->foreign('Id_Suc')->references('Id_Suc')->on('Sucursal');
            $table->foreign('Id_PtoExp')->references('Id_PtoExp')->on('PtoExpedicion');
            $table->foreign('Id_Prov')->references('Id_Prov')->on('Proveedores');
            $table->foreign('Id_MedPag')->references('Id_MedPag')->on('Medio_Pago');
        });
    }

    public function down()
    {
        Schema::table('PedidosProveedores', function (Blueprint $table) {
            $table->dropForeign(['Id_Suc']);
            $table->dropForeign(['Id_PtoExp']);
            $table->dropForeign(['Id_Prov']);
            $table->dropForeign(['Id_MedPag']);
        });
    }
}