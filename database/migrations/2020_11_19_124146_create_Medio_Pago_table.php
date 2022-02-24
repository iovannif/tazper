<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedioPagoTable extends Migration
{
    public function up()
    {
        Schema::create('Medio_Pago', function (Blueprint $table){
            $table->increments('Id_MedPag')->unsigned();
            $table->string('MedPag_Des',20)->unique();
        });
    }

    public function down()
    {
        Schema::dropIfExists('Medio_Pago');
    }
}