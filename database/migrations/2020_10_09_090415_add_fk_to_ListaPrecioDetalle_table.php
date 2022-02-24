<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkToListaPrecioDetalleTable extends Migration
{
    public function up()
    {
        Schema::table('ListaPrecioDetalle', function (Blueprint $table) {
            $table->foreign('Id_Lp')->references('Id_Lp')->on('ListaPrecio');
        });
    }

    public function down()
    {
        Schema::table('ListaPrecioDetalle', function (Blueprint $table) {
            $table->dropForeign(['Id_Lp']);
        });
    }
}