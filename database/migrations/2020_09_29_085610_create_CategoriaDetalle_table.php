<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriaDetalleTable extends Migration
{
    public function up()
    {
        Schema::create('CategoriaDetalle', function (Blueprint $table){
            $table->unsignedInteger('Id_Cat')->unique();                   
        });   
    }

    public function down()
    {
        Schema::dropIfExists('CategoriaDetalle');
    }
}