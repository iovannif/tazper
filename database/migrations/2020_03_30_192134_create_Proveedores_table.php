<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProveedoresTable extends Migration
{
    public function up()
    {
        Schema::create('Proveedores', function (Blueprint $table){
            $table->increments('Id_Prov')->unsigned();
            $table->string('Prov_Des',30)->unique();
            $table->string('Prov_RazSoc',40);
            $table->string('Prov_Ruc',20)->unique();
            
            $table->string('Prov_Tel',15)->unique();
            $table->string('Prov_Cel',15)->nullable();
            $table->string('Prov_Email',30)->nullable();
            $table->string('Prov_Web',45)->nullable();
            
            $table->string('Prov_Dir',50);
            $table->string('Prov_Ciu',30)->nullable();
            $table->string('Prov_Bar',30)->nullable();
            
            $table->string('Prov_Ho',60);
            $table->string('Prov_Est',8);
            $table->string('Prov_Obs',140)->nullable();

                $table->timestamps();            

                $table->unsignedInteger('Prov_RegPor')->nullable();
                $table->string('Prov_RegUser',20)->nullable();
                $table->unsignedInteger('Prov_MdfPor')->nullable();
                $table->string('Prov_MdfUser',20)->nullable();

                $table->unsignedInteger('Id_Usu')->nullable();                        
        });
    }

    public function down()
    {
        Schema::dropIfExists('Proveedores');
    }
}