<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagosDetalleTable extends Migration
{
    public function up()
    {
        Schema::create('PagosDetalle', function (Blueprint $table){
            $table->unsignedInteger('Id_Pag')->index();                                                       
            $table->string('PD_Art', 35);       
            $table->unsignedInteger('PD_ArtPre');   
            $table->float('PD_ArtCant', 5,1);       
            $table->unsignedInteger('PD_ArtTot');            
        });   
    }

    public function down()
    {
        Schema::dropIfExists('PagosDetalle');
    }
}
