<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdenCompraDetalleTable extends Migration
{
    public function up()
    {
        Schema::create('OrdenCompraDetalle', function (Blueprint $table) {
            $table->unsignedInteger('Id_OC')->index();
            $table->float('OCD_ArtCant', 5,1);
            $table->unsignedInteger('OCD_ArtTot');

            // $table->integer('Id_OC')->length(4);
            // $table->string('OCD_ArtNum',7);
            // $table->string('OCD_ArtDes',30);
            // $table->string('OCD_ArtCant',20);
            // $table->integer('OCD_ArtPreUn')->length(7);
            // $table->integer('OCD_ArtTotal')->length(7);            
        });
    }

    public function down()
    {
        Schema::dropIfExists('OrdenCompraDetalle');
    }
}