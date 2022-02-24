<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidosClientesDetalleTable extends Migration
{
    public function up()
    {
        Schema::create('PedidosClientesDetalle', function(Blueprint $table){
            $table->unsignedInteger('Id_PedCli')->index();   
            $table->unsignedInteger('PCD_ArtCant');
            $table->unsignedInteger('Id_Desc')->nullable();
            // $table->integer('Id_PedCli')->length(4);
            // $table->integer('Id_Art')->length(4)->nullable();
            // $table->string('Pcd_Producto',30);
            // $table->integer('Pcd_ProdCan')->length(4);
        });
    }

    public function down()
    {
        Schema::dropIfExists('PedidosClientesDetalle');
    }
}