<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidosClientesTable extends Migration
{
    public function up()
    {
        Schema::create('PedidosClientes', function (Blueprint $table){
            // $table->increments('Id_PedCli')->length(4);
            $table->increments('Id_PedCli')->unsigned();                                    
            $table->unsignedInteger('Id_Suc');
            $table->unsignedInteger('Id_PtoExp');
            $table->dateTime('PedCli_FeHo');
            $table->unsignedInteger('Id_Cli');
            $table->string('PedCli_CliLp',20);   
            $table->unsignedInteger('PedCli_CliDesc');  
            $table->string('PedCli_Tip',9);
            $table->date('PedCli_FeEnt');
            $table->string('PedCli_CondCob',7);
            $table->unsignedInteger('Id_MedPag');
            $table->string('PedCli_Est',9);
            $table->string('PedCli_Obs',140)->nullable();

                $table->timestamps();

                $table->unsignedInteger('PedCli_RegPor')->nullable();
                $table->string('PedCli_RegUser',20)->nullable();
                
                $table->unsignedInteger('Id_Usu')->nullable();
        });
        
        /*
        Código
        Cliente
        Categoría
        Fecha de entrega
        Efectuada por
        Fecha y hora
        Registro
        Por
        */                
    }

    public function down()
    {
        Schema::dropIfExists('PedidosClientes');
    }
}