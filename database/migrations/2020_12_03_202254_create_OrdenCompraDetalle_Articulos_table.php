<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdenCompraDetalleArticulosTable extends Migration
{
    public function up()
    {
        Schema::create('OrdenCompraDetalle_Articulos', function (Blueprint $table){
            $table->unsignedInteger('Id_OC');
            $table->unsignedInteger('Id_Art');      
        });
    }

    public function down()
    {
        Schema::dropIfExists('OrdenCompraDetalle_Articulos');
    }
}
