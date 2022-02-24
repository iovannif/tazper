<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table){
            $table->increments('Id_Usu')->unsigned();
            $table->string('Usu_User',20)->unique();
            $table->unsignedInteger('Id_Prf');
            $table->string('Usu_Pass');
            $table->unsignedInteger('Id_Per')->unique()->nullable();
            $table->string('Usu_Est',8);
            $table->string('Usu_Obs',140)->nullable();
            
                $table->timestamps();
            
                $table->unsignedInteger('Usu_RegPor')->nullable();
                $table->string('Usu_RegUser',20)->nullable();
                $table->unsignedInteger('Usu_MdfPor')->nullable();
                $table->string('Usu_MdfUser',20)->nullable();

                $table->unsignedInteger('Usu_Id')->nullable();

                $table->rememberToken();
        });        
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}