<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkToPerfilDetalleTable extends Migration
{
    public function up()
    {
        Schema::table('PerfilDetalle', function (Blueprint $table) {
            $table->foreign('Id_Prf')->references('Id_Prf')->on('Perfil');
        });
    }

    public function down()
    {
        Schema::table('PerfilDetalle', function (Blueprint $table) {
            $table->dropForeign(['Id_Prf']);
        });
    }
}