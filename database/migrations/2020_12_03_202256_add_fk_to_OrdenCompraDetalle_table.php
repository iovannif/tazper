<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkToOrdenCompraDetalleTable extends Migration
{
    public function up()
    {
        Schema::table('OrdenCompraDetalle', function (Blueprint $table) {
            $table->foreign('Id_OC')->references('Id_OC')->on('OrdenCompra')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('OrdenCompraDetalle', function (Blueprint $table) {
            $table->dropForeign(['Id_OC']);
        });
    }
}
