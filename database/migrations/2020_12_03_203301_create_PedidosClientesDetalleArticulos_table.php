Ç<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidosClientesDetalleArticulosTable extends Migration
{
    public function up()
    {
        Schema::create('PedidosClientesDetalle_Articulos', function (Blueprint $table){
            $table->unsignedInteger('Id_PedCli');
            $table->unsignedInteger('Id_Art');      
        });
    }

    public function down()
    {
        Schema::dropIfExists('PedidosClientesDetalle_Articulos');
    }
}
