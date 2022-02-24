<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkToPedidosProveedoresDetalleTable extends Migration
{
    public function up()
    {
        Schema::table('PedidosProveedoresDetalle', function (Blueprint $table) {
            $table->foreign('Id_PedProv')->references('Id_PedProv')->on('PedidosProveedores')->onDelete('cascade');            
        });
    }

    public function down()
    {
        Schema::table('PedidosProveedoresDetalle', function (Blueprint $table) {
            $table->dropForeign(['Id_PedProv']);
        });
    }
}