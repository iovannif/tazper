<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Auth;

class CreateArticulosTable extends Migration
{
    public function up()
    {
        Schema::create('Articulos', function (Blueprint $table){            
            $table->increments('Id_Art')->unsigned();            
            $table->string('Art_Tip',8);
            $table->unsignedInteger('Id_Mat')->unique()->nullable();            
            $table->unsignedInteger('Id_Prod')->unique()->nullable();
            $table->string('Art_DesLar',35)->unique();            
            $table->string('Art_DesCor',25)->unique()->nullable();
            $table->string('Art_ProdTip',8)->nullable();    
            $table->unsignedInteger('Id_Cat')->nullable();
            $table->unsignedInteger('Id_Imp');
            $table->unsignedInteger('Art_GanMin')->nullable();    
            $table->unsignedInteger('Art_PreCom');
            $table->unsignedInteger('Art_PreVen')->nullable();    
            $table->string('Art_UniMed',20);            
            $table->float('Art_St', 5,1);                            
            $table->string('Art_StMn',20)->nullable();
            $table->string('Art_StMx',20)->nullable();
            $table->unsignedInteger('Id_Prov')->nullable();            
            $table->string('Art_Est',8);
            $table->string('Art_Obs',140)->nullable();

                $table->timestamps();
                
                $table->unsignedInteger('Art_RegPor')->nullable();
                $table->string('Art_RegUser',20)->nullable();            
                $table->unsignedInteger('Art_MdfPor')->nullable();                  
                $table->string('Art_MdfUser',20)->nullable();         

                $table->unsignedInteger('Id_Usu')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('Articulos');
    }
}