<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidosProveedoresDetalleTable extends Migration
{
    public function up()
    {
        Schema::create('PedidosProveedoresDetalle', function (Blueprint $table){
            $table->unsignedInteger('Id_PedProv')->index();   
            $table->float('PPD_ArtCant', 5,1);
        });
    }

    public function down()
    {
        Schema::dropIfExists('PedidosProveedoresDetalle');
    }
}