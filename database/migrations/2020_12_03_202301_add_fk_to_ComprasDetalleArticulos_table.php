<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkToComprasDetalleArticulosTable extends Migration
{
    public function up()
    {
        Schema::table('ComprasDetalleArticulos', function (Blueprint $table) {
            $table->foreign('Id_Com')->references('Id_Com')->on('ComprasDetalle')->onDelete('cascade');
            $table->foreign('Id_Art')->references('Id_Art')->on('Articulos');
        });
    }

    public function down()
    {
        Schema::table('ComprasDetalleArticulos', function (Blueprint $table) {
            $table->dropForeign(['Id_Com']);
            $table->dropForeign(['Id_Art']);
        });
    }
}