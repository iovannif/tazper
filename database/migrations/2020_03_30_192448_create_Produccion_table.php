<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProduccionTable extends Migration
{
    public function up()
    {
        Schema::create('Produccion', function (Blueprint $table){
            $table->increments('Id_Pdc')->unsigned();
            $table->unsignedInteger('Id_Prod');
            $table->unsignedInteger('Pdc_Cant');
            $table->string('Pdc_Con',6);
            $table->string('Pdc_Est',10);
            $table->string('Pdc_Obs',140)->nullable();
            
                $table->timestamps();

                $table->unsignedInteger('Pdc_RegPor')->nullable();
                $table->string('Pdc_RegUser',20)->nullable();                            

                $table->unsignedInteger('Id_Usu')->nullable();
        });        
    }

    public function down()
    {
        Schema::dropIfExists('Produccion');
    }
}