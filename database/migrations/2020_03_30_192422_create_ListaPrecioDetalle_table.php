<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListaPrecioDetalleTable extends Migration
{
    public function up()
    {
        Schema::create('ListaPrecioDetalle', function (Blueprint $table){
            $table->unsignedInteger('Id_Lp');            
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('ListaPrecioDetalle');
    }
}