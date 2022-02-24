<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidosProveedoresDetalleArticulosTable extends Migration
{
    public function up()
    {
        Schema::create('PedidosProveedoresDetalleArticulos', function (Blueprint $table){
            $table->unsignedInteger('Id_PedProv');
            $table->unsignedInteger('Id_Art');      
        });  
    }

    public function down()
    {
        Schema::dropIfExists('PedidosProveedoresDetalleArticulos');
    }
}