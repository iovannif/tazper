<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticulosDetalleTable extends Migration
{
    public function up()
    {
        Schema::create('ArticulosDetalle', function (Blueprint $table){
            $table->unsignedInteger('Id_Art');
            $table->unsignedInteger('Id_Lp');
        });
    }

    public function down()
    {
        Schema::dropIfExists('ArticulosDetalle');
    }
}