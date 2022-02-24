<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidosProveedoresTable extends Migration
{
    public function up()
    {
        Schema::create('PedidosProveedores', function (Blueprint $table){
            $table->increments('Id_PedProv')->unsigned();                                    
            $table->unsignedInteger('Id_Suc');
            $table->unsignedInteger('Id_PtoExp');
            $table->dateTime('PedProv_FeHo');
            $table->unsignedInteger('Id_Prov');
            $table->date('PedProv_FeEnt');
            $table->string('PedProv_ConPag',7);
            // $table->string('PedProv_MedPag',8);
            $table->unsignedInteger('Id_MedPag');
            $table->string('PedProv_Est',9);
            $table->string('PedProv_Obs',140)->nullable();

                $table->timestamps();

                $table->unsignedInteger('PedProv_RegPor')->nullable();
                $table->string('PedProv_RegUser',20)->nullable();
                
                $table->unsignedInteger('Id_Usu')->nullable();
        });
        /*Expedido en*/        
    }

    public function down()
    {
        Schema::dropIfExists('PedidosProveedores');
    }
}