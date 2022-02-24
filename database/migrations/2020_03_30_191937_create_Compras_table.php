<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComprasTable extends Migration
{
    public function up()
    {
        Schema::create('Compras', function (Blueprint $table){
            $table->increments('Id_Com')->unsigned();
            $table->unsignedInteger('Id_Pag')->unique()->nullable();
            $table->date('Com_Fe');
            $table->time('Com_Ho');
            $table->string('Com_Fac',15)->unique();
            $table->unsignedInteger('Id_Arq');            
            $table->unsignedInteger('Id_Suc');
            $table->unsignedInteger('Id_PtoExp');
            $table->unsignedInteger('Id_PedProv')->unique()->nullable();
            $table->unsignedInteger('Id_Prov')->nullable();
            $table->unsignedInteger('Id_OC')->unique()->nullable();
            $table->string('Com_ConPag',7);            
            $table->unsignedInteger('Id_MedPag');

            $table->unsignedInteger('Com_StExe')->nullable();
            $table->unsignedInteger('Com_St5')->nullable();
            $table->unsignedInteger('Com_St10')->nullable();
            $table->unsignedInteger('Com_Total');
            
            $table->unsignedInteger('Com_Liq5')->nullable();
            $table->unsignedInteger('Com_Liq10')->nullable();
            $table->unsignedInteger('Com_TotIva')->nullable();

                $table->timestamps();

                $table->unsignedInteger('Com_RegPor')->nullable();
                $table->string('Com_RegUser',20)->nullable();

                $table->unsignedInteger('Id_Usu')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('Compras');
    }
}