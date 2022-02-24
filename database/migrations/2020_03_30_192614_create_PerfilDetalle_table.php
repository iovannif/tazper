<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerfilDetalleTable extends Migration
{
    public function up()
    {
        Schema::create('PerfilDetalle', function (Blueprint $table){
            $table->unsignedInteger('Id_Prf')->unique();
            $table->text('Prf_Priv');
        });
    }

    public function down()
    {
        Schema::dropIfExists('PerfilDetalle');
    }
}