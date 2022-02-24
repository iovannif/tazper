<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimbradoDetalleTable extends Migration
{
    public function up()
    {
        Schema::create('TimbradoDetalle', function (Blueprint $table){
            $table->unsignedInteger('Id_Timb');
            $table->unsignedInteger('TD_NroFact');
            $table->unsignedInteger('TD_FactCod');
            $table->unsignedInteger('Id_Ven'); //no puede ser negativo para fk //pk positivo            
            $table->string('TD_FactEst','7');
        });
    }

    public function down()
    {
        Schema::dropIfExists('TimbradoDetalle');
    }
}