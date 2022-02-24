<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkToProduccionDetalleTable extends Migration
{
    public function up()
    {
        Schema::table('ProduccionDetalle', function (Blueprint $table) {
            $table->foreign('Id_Pdc')->references('Id_Pdc')->on('Produccion')->onDelete('cascade');            
        });
    }

    public function down()
    {
        Schema::table('ProduccionDetalle', function (Blueprint $table) {
            $table->dropForeign(['Id_Pdc']);
        });
    }
}