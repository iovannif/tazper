<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComprasDetalleTable extends Migration
{
    public function up()
    {
        Schema::create('ComprasDetalle', function (Blueprint $table){
            $table->unsignedInteger('Id_Com')->index();                        
            $table->float('CD_ArtCant', 5,1);       
            
            $table->unsignedInteger('CD_ArtExen')->nullable();
            $table->unsignedInteger('CD_ArtIva5')->nullable();
            $table->unsignedInteger('CD_ArtIva10')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ComprasDetalle');
    }
}