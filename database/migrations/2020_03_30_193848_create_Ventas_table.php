<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentasTable extends Migration
{
    public function up()
    {
        Schema::create('Ventas', function (Blueprint $table){
            $table->increments('Id_Ven')->unsigned();
            $table->unsignedInteger('Id_Cob')->unique()->nullable();
            $table->date('Ven_Fe');
            $table->time('Ven_Ho');
            $table->unsignedInteger('Id_Suc');
            $table->unsignedInteger('Id_PtoExp');
            $table->unsignedInteger('Id_Arq');
            
            $table->unsignedInteger('Id_Timb');
            $table->string('Ven_Fact',7)->unique();
            $table->string('Ven_Tip',9);  
            $table->unsignedInteger('Id_PedCli')->unique()->nullable();
            $table->unsignedInteger('Id_Cli');   
            $table->string('Ven_CliLp',20);   
            $table->unsignedInteger('Ven_CliDesc');   
            $table->string('Ven_DescDia',20)->nullable();   
            $table->string('Ven_CondCob',7);            
            $table->unsignedInteger('Id_MedPag');   
            $table->string('Ven_Est',7);                                                         

            $table->unsignedInteger('Ven_StExe')->nullable();
            $table->unsignedInteger('Ven_St5')->nullable();
            $table->unsignedInteger('Ven_St10')->nullable();
            $table->unsignedInteger('Ven_Tot');            
            $table->unsignedInteger('Ven_Liq5')->nullable();
            $table->unsignedInteger('Ven_Liq10')->nullable();
            $table->unsignedInteger('Ven_TotIva')->nullable();                                         

                $table->timestamps();

                $table->unsignedInteger('Ven_RegPor')->nullable();
                $table->string('Ven_RegUser',20)->nullable();

                $table->unsignedInteger('Id_Usu')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('Ventas');
    }
}