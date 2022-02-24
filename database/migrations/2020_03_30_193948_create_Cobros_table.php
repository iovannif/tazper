<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCobrosTable extends Migration
{
    public function up()
    {
        Schema::create('Cobros', function (Blueprint $table){
            // $table->increments('Id_Cob')->unsigned();
            // $table->integer('Id_Ven')->length(4)->nullable();
            // $table->string('Cob_Est',10);
            // $table->integer('Id_PedCli')->length(4)->nullable();
            // $table->unsignedInteger('Cob_In');
            
            $table->unsignedInteger('Id_Cob');
            $table->primary('Id_Cob');
            $table->unsignedInteger('Id_Ven');
            $table->string('Cob_Est',7);

                $table->timestamps();

                $table->unsignedInteger('Cob_RegPor')->nullable();
                $table->string('Cob_RegUser',20)->nullable();

                $table->unsignedInteger('Id_Usu')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('Cobros');
    }
}