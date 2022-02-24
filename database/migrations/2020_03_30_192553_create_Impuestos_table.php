<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImpuestosTable extends Migration
{
    public function up()
    {
        Schema::create('Impuestos', function (Blueprint $table){
            $table->increments('Id_Imp')->unsigned();
            $table->string('Imp_Des',20)->uniqued();
            $table->unsignedInteger('Imp_Porc');
        });
    }

    public function down()
    {
        Schema::dropIfExists('Impuestos');
    }
}