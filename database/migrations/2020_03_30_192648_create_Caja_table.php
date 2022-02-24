<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCajaTable extends Migration
{
    public function up()
    {
        Schema::create('Caja', function (Blueprint $table){
            $table->increments('Id_Caj')->unsigned();
            $table->string('Caj_Des',20)->unique();
            $table->string('Caj_Cod',15)->unique();            
            $table->integer('Id_Suc')->unsigned();
            $table->integer('Id_PtoExp')->unsigned();
            $table->string('Caj_Est',8);
            $table->integer('Caj_Fon');
        });
    }

    public function down()
    {
        Schema::dropIfExists('Caja');
    }
}