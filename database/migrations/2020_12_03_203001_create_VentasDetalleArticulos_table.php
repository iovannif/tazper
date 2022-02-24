<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentasDetalleArticulosTable extends Migration
{
    public function up()
    {
        Schema::create('VentasDetalle_Articulos', function (Blueprint $table){
            $table->unsignedInteger('Id_Ven');
            $table->unsignedInteger('Id_Art');      
        });
    }

    public function down()
    {
        Schema::dropIfExists('VentasDetalle_Articulos');
    }
}