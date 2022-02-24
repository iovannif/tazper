<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePtoExpedicionTable extends Migration
{
    public function up()
    {
        Schema::create('PtoExpedicion', function (Blueprint $table){
            $table->increments('Id_PtoExp')->unsigned();
            $table->string('PtoExp_Des',20);
            $table->string('PtoExp_Cod',7);
            $table->integer('Id_Suc')->unsigned();
            $table->string('PtoExp_Est',8);                                                
        });
    }

    public function down()
    {
        Schema::dropIfExists('PtoExpedicion');
    }
}