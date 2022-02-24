<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListaPrecioTable extends Migration
{
    public function up()
    {
        Schema::create('ListaPrecio', function (Blueprint $table){
            $table->increments('Id_Lp')->unsigned();
            $table->string('Lp_Cat',20)->unique();
            $table->unsignedInteger('Lp_Desc');
            $table->string('Lp_Est',8);
        });
    }

    public function down()
    {
        Schema::dropIfExists('ListaPrecio');
    }
}