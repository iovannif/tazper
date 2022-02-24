<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentasDetalleTable extends Migration
{
    public function up()
    {
        Schema::create('VentasDetalle', function (Blueprint $table){
            $table->unsignedInteger('Id_Ven')->index();                                    
            //
            $table->unsignedInteger('VD_ArtCant');                   
            $table->unsignedInteger('VD_ArtPre'); 
            $table->unsignedInteger('Id_Desc')->nullable(); 
            $table->unsignedInteger('VD_ArtDesc')->nullable(); 

            $table->unsignedInteger('VD_ArtExen')->nullable();
            $table->unsignedInteger('VD_ArtIva5')->nullable();
            $table->unsignedInteger('VD_ArtIva10')->nullable();

            // $table->integer('Id_Ven')->length(4);

            // $table->integer('Id_Art')->length(4)->nullable;
            // $table->string('VD_ArtDes',30);
            // $table->integer('VD_ArtPreUn')->length(7);
            // $table->integer('VD_ArtCant')->length(4);
            // $table->integer('VD_ArtExen')->length(7)->nullable;
            // $table->integer('VD_ArtIva5')->length(7)->nullable;
            // $table->integer('VD_ArtIva10')->length(7)->nullable;

            // $table->timestamps();
        });

        /*
        Cambio de precio
        Descuento
        */
    }

    public function down()
    {
        Schema::dropIfExists('VentasDetalle');
    }
}
