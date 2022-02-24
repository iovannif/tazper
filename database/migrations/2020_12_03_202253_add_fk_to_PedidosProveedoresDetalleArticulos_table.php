<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkToPedidosProveedoresDetalleArticulosTable extends Migration
{
    public function up()
    {
        Schema::table('PedidosProveedoresDetalleArticulos', function (Blueprint $table) {
            $table->foreign('Id_PedProv')->references('Id_PedProv')->on('PedidosProveedoresDetalle')->onDelete('cascade');
            $table->foreign('Id_Art')->references('Id_Art')->on('Articulos');
        });
    }

    public function down()
    {
        Schema::table('PedidosProveedoresDetalleArticulos', function (Blueprint $table) {
            $table->dropForeign(['Id_PedProv']);
            $table->dropForeign(['Id_Art']);
        });
    }
}