<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('Id_Prf')->references('Id_Prf')->on('Perfil');
            $table->foreign('Id_Per')->references('Id_Per')->on('Personal');
            // $table->foreign('Usu_Id')->references('Id_Usu')->on('Users');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['Id_Prf']);
            $table->dropForeign(['Id_Per']);
            // $table->dropForeign(['Usu_Id']);
        });
    }
}