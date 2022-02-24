<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDescuentoDetalleTable extends Migration
{
    public function up()
    {
        Schema::create('DescuentoDetalle', function(Blueprint $table){
            $table->unsignedInteger('Id_Desc');  
            $table->unsignedInteger('Id_Lp')->nullable();
            $table->unsignedInteger('Id_Cli')->nullable(); 
            $table->unsignedInteger('Id_Art')->nullable();
            $table->unsignedInteger('Id_Cat')->nullable();
            $table->unsignedInteger('DD_Porc')->nullable();
            // $table->string('Desc_Porc',3);   
        });
    }

    public function down()
    {
        Schema::dropIfExists('DescuentoDetalle');
    }
}