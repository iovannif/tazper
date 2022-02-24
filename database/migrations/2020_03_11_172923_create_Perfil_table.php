<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerfilTable extends Migration
{
    public function up()
    {
        Schema::create('Perfil', function (Blueprint $table){
            $table->increments('Id_Prf')->unsigned();
            $table->string('Prf_Des',20)->unique();
            $table->string('Prf_NivAcc',40);
            $table->string('Prf_Est',8);
        });
    }

    public function down()
    {
        Schema::dropIfExists('Perfil');
    }
}