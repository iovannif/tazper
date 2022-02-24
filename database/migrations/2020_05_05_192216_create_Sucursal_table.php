<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSucursalTable extends Migration
{
    public function up()
    {
        Schema::create('Sucursal', function (Blueprint $table){
            $table->increments('Id_Suc')->unsigned();
            $table->string('Suc_NomFan',30);
            $table->string('Suc_Des',30)->unique();
            $table->string('Suc_Cod',7)->unique();

            $table->string('Suc_Tel',15)->unique();                   
            $table->string('Suc_Dir',50)->unique();                   
            $table->string('Suc_Ciu',30);
            $table->string('Suc_Bar',30);
            $table->string('Suc_Red1',30)->nullable();
            $table->string('Suc_Red2',30)->nullable();
            $table->string('Suc_Email',30)->nullable();

            $table->string('Suc_Ruc',20);
            $table->string('Suc_RazSoc',40);    
            $table->string('Suc_Enc',30);                                                         

            $table->string('Suc_Est',8);
            $table->string('Suc_Obs',140)->nullable();                               
        });
    }

    public function down()
    {
        Schema::dropIfExists('Sucursal');
    }
}