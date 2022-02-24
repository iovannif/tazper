<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProduccionDetalleTable extends Migration
{
    public function up()
    {
        Schema::create('ProduccionDetalle', function (Blueprint $table){
            $table->unsignedInteger('Id_Pdc')->index();   
            $table->float('PD_MatCant', 5,1);       
        });
    }

    public function down()
    {
        Schema::dropIfExists('ProduccionDetalle');
    }    
}