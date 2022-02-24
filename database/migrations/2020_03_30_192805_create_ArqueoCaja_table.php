<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArqueoCajaTable extends Migration
{
    public function up()
    {
        Schema::create('ArqueoCaja', function (Blueprint $table){
            $table->increments('Id_Arq')->unsigned();
            $table->unsignedInteger('Id_Caj')->default('1');
            $table->string('Arq_Est',7);

            $table->datetime('Arq_Ape');
            $table->unsignedInteger('Arq_ApePor');     
            $table->string('Arq_ApeUser',20); 

            $table->datetime('Arq_Cie')->nullable();
            $table->unsignedInteger('Arq_CiePor')->nullable();
            $table->string('Arq_CieUser',20)->nullable();    
            
            $table->integer('Arq_FonIni');                                   
            $table->integer('Arq_FonFin')->nullable();                                  
                        
            $table->unsignedInteger('Id_Usu')->nullable();            
        });

    }

    public function down()
    {
        Schema::dropIfExists('ArqueoCaja');
    }
}