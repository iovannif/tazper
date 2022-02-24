<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkToArticulosDetalleTable extends Migration
{
    public function up()
    {
        Schema::table('ArticulosDetalle', function (Blueprint $table) {
            $table->foreign('Id_Art')->references('Id_Art')->on('Articulos')->onDelete('cascade');
            $table->foreign('Id_Lp')->references('Id_Lp')->on('ListaPrecio');
        });
    }

    public function down()
    {
        Schema::table('ArticulosDetalle', function (Blueprint $table) {
            $table->dropForeign(['Id_Art']);
            $table->dropForeign(['Id_Lp']);
        });
    }
}