<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdenCompraTable extends Migration
{
    public function up()
    {
        Schema::create('OrdenCompra', function (Blueprint $table){
            $table->increments('Id_OC')->unsigned();
            $table->unsignedInteger('Id_PedProv')->unique();            
            $table->unsignedInteger('Id_Prov');            
            $table->date('OC_Fe');    
            $table->string("OC_CliNum",10)->nullable();                    
            $table->unsignedInteger('Id_Suc');      
            $table->unsignedInteger('Id_PtoExp');                        

            $table->string("OC_MedEnv",70)->nullable();
            $table->string("OC_FOB",70)->nullable();
            $table->string("OC_CondEnv",70)->nullable();
            $table->string("OC_FeEnt",70);
            $table->string("OC_Obs",290);

            $table->unsignedInteger("OC_SubTot");
            $table->unsignedInteger("OC_Iva")->nullable();
            $table->unsignedInteger("OC_Env")->nullable();
            $table->unsignedInteger("OC_Otr")->nullable();
            $table->unsignedInteger("OC_Tot")->nullable();
            $table->string("OC_Est",9);

                $table->timestamps();
            
                $table->unsignedInteger('OC_RegPor')->nullable();
                $table->string('OC_RegUser',20)->nullable();
                $table->unsignedInteger('OC_MdfPor')->nullable();
                $table->string('OC_MdfUser',20)->nullable();

                $table->unsignedInteger('Id_Usu')->nullable();
            
            // $table->string("OC_EmpProv",30);
            // $table->string("OC_EmpDir",30);
            // $table->string("OC_EmpTel",12);
            // $table->string("OC_EmpWeb",40)->nullable();            

            // $table->date("OC_Fecha");
            // $table->string("OC_NumOrd",10);
            // $table->string("OC_CliNum",10);
                    
            // $table->string("OC_VenEmp",30);
            // $table->string("OC_VenDep",20);
            // $table->string("OC_VenDir",30);
            // $table->string("OC_VenTel",15);
            // $table->string("OC_VenEmail",30)->nullable();                        

            // $table->string("OC_EnvEnc",30);
            // $table->string("OC_EnvEmp",30);
            // $table->string("Oc_EnvDir",30);
            // $table->string("OC_EnvTel",15);
            // $table->string("OC_EnvEmail",30) ->nullable();
            
            // $table->string("OC_MedEnv",70)->nullable();
            // $table->string("OC_FOB",70);
            // $table->string("OC_CondEnv",70)->nullable();
            // $table->string("OC_FechaEnt",70);
            
            // $table->string("OC_CondEsp",290)->nullable();
            // $table->integer("OC_Subtotal")->length(7);
            // $table->integer("OC_Iva")->length(7);
            // $table->integer("OC_Envio")->length(7);
            // $table->integer("OC_Otro")->length(7);
            // $table->integer("OC_Total")->length(7);

            // $table->integer('OC_RegPor')->length(4)->nullable();
            
            // $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('OrdenCompra');
    }
}