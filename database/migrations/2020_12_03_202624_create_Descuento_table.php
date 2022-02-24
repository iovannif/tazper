<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDescuentoTable extends Migration
{
    public function up()
    {
        Schema::create('Descuento', function (Blueprint $table){
            $table->increments('Id_Desc')->unsigned();                                                
            $table->string('Desc_Tip',15);              
            $table->string('Desc_Des',20); //->unique();     
            // $table->string('Desc_Porc',3);   
            $table->string('Desc_Est',11); //vigente
            $table->string('Desc_Obs',140)->nullable();                           

                $table->timestamps();

                $table->unsignedInteger('Desc_RegPor')->nullable();
                $table->string('Desc_RegUser',20)->nullable();
                $table->unsignedInteger('Desc_MdfPor')->nullable();
                $table->string('Desc_MdfUser',20)->nullable();

                $table->unsignedInteger('Id_Usu')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('Descuento');
    }
}