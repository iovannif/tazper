<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimbradoTable extends Migration
{
    public function up()
    {
        Schema::create('Timbrado', function (Blueprint $table){
            $table->increments('Id_Timb');
            $table->unsignedInteger('Id_Suc');
            $table->unsignedInteger('Id_PtoExp');
            $table->unsignedInteger('Timb_Num');
            //$table->unsignedInteger('Timb_Num',15); toma como autonum
            $table->date('Timb_IniVig');
            $table->date('Timb_FinVig');
            $table->unsignedInteger('Timb_Rang');
            $table->unsignedInteger('Timb_IniFact');
            $table->unsignedInteger('Timb_FinFact');
            $table->string('Timb_Est',10);
            $table->string('Timb_Obs',140)->nullable();                        
            
                $table->timestamps();

                $table->unsignedInteger('Timb_RegPor')->nullable();            
                $table->string('Timb_RegUser',20)->nullable();

                $table->unsignedInteger('Id_Usu')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('Timbrado');
    }
}