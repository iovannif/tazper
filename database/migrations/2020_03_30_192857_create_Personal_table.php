<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonalTable extends Migration
{
    public function up()
    {
        Schema::create('Personal', function (Blueprint $table){
            $table->increments('Id_Per')->unsigned();
            $table->string('Per_Nom',20);
            $table->string('Per_Ape',20);
            $table->string('Per_CI',15);
            $table->string('Per_Car',20);
            $table->unsignedInteger('Id_Usu')->unique()->nullable(); //por trigger traer username cuando se cree, ya que tiene este per

            $table->date('Per_FeNac');
            $table->string('Per_LugNac',30);
            $table->string('Per_Nac',20);
            $table->string('Per_Gen',9);
            $table->string('Per_EstCiv',15);
            $table->string('Per_Hij',2);            
            
            $table->string('Per_Tel',15)->nullable();
            $table->string('Per_Cel',15);
            $table->string('Per_Email',30)->nullable();
            $table->string('Per_Dir',50);
            $table->string('Per_Ciu',30);
            $table->string('Per_Bar',30);
            
            $table->date('Per_Ini');            
            $table->string('Per_Tur',60);
            $table->string('Per_Est',8);
            $table->string('Per_Obs',140)->nullable();
            
                $table->timestamps();            

                $table->unsignedInteger('Per_RegPor')->nullable();
                $table->string('Per_RegUser',20)->nullable();
                $table->unsignedInteger('Per_MdfPor')->nullable();
                $table->string('Per_MdfUser',20)->nullable();

                $table->unsignedInteger('Usu_Id')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('Personal');
    }
}