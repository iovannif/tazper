<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompraDetalleArticulosTable extends Migration
{
    public function up()
    {
        Schema::create('ComprasDetalleArticulos', function (Blueprint $table){
            $table->unsignedInteger('Id_Com');
            $table->unsignedInteger('Id_Art');      
        });
    }

    public function down()
    {
        Schema::dropIfExists('ComprasDetalleArticulos');
    }
}