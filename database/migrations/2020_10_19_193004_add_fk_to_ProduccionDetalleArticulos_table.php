<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkToProduccionDetalleArticulosTable extends Migration
{
    public function up()
    {
        Schema::table('ProduccionDetalleArticulos', function (Blueprint $table) {
            $table->foreign('Id_Pdc')->references('Id_Pdc')->on('ProduccionDetalle')->onDelete('cascade');
            $table->foreign('Id_Art')->references('Id_Art')->on('Articulos');
        });
    }

    public function down()
    {
        Schema::table('ProduccionDetalleArticulos', function (Blueprint $table) {
            $table->dropForeign(['Id_Pdc']);
            $table->dropForeign(['Id_Art']);
        });
    }
}