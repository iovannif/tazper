<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    public function up()
    {
        Schema::create('Clientes', function (Blueprint $table){
            $table->increments('Id_Cli')->unsigned();
            $table->string('Cli_Nom',30);
            $table->string('Cli_Ape',30);
            $table->string('Cli_Ruc',15)->unique();
            $table->unsignedInteger('Id_Lp');
            // $table->date('Cli_FeNac');
            // $table->string('Cli_Gen',9);
            // $table->string('Cli_Cel',15);
            // $table->string('Cli_Dir',40);
            // $table->string('Cli_Ciu',30);
            // $table->string('Cli_Bar',30);
            $table->string('Cli_Est',8);
            $table->string('Cli_Obs',140)->nullable();            

                $table->timestamps();

                $table->unsignedInteger('Cli_RegPor')->nullable();
                $table->string('Cli_RegUser',20)->nullable();
                // $table->unsignedInteger('Cli_MdfPor')->nullable();
                // $table->string('Cli_MdfUser',20)->nullable();

                $table->unsignedInteger('Id_Usu')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('Clientes');
    }
}