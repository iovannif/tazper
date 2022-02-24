<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProduccionDetalleArticulosTable extends Migration
{
    public function up()
    {
        Schema::create('ProduccionDetalleArticulos', function (Blueprint $table){
            $table->unsignedInteger('Id_Pdc');
            $table->unsignedInteger('Id_Art');                
        });
    }

    public function down()
    {
        Schema::dropIfExists('ProduccionDetalleArticulos');
    }
}