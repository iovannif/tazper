<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagosTable extends Migration
{
    public function up()
    {
        Schema::create('Pagos', function (Blueprint $table){
            $table->unsignedInteger('Id_Pag');
            $table->primary('Id_Pag');
            $table->unsignedInteger('Id_Arq');
            $table->unsignedInteger('Id_Com');
            $table->string('Pag_ConPag',7);
            $table->unsignedInteger('Id_MedPag');
            $table->unsignedInteger('Pag_Eg');
            $table->unsignedInteger('Id_Caj');
            $table->string('Pag_Fac');
            $table->string('Pag_Prov',30)->nullable();          
            $table->unsignedInteger('Id_Suc');            
            $table->unsignedInteger('Id_PtoExp');            
            // $table->string('Pag_Est',10);                                                

                $table->timestamps();

                $table->unsignedInteger('Pag_RegPor')->nullable();
                $table->string('Pag_RegUser',20)->nullable();

                $table->unsignedInteger('Id_Usu')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('Pagos');
    }
}