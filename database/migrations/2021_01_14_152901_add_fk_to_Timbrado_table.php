<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkToTimbradoTable extends Migration
{
    public function up()
    {
        Schema::table('Timbrado', function (Blueprint $table) {
            $table->foreign('Id_Suc')->references('Id_Suc')->on('Sucursal');
            $table->foreign('Id_PtoExp')->references('Id_PtoExp')->on('PtoExpedicion');
        });
    }

    public function down()
    {
        Schema::table('Timbrado', function (Blueprint $table) {
            $table->dropForeign(['Id_Suc']);
            $table->dropForeign(['Id_PtoExp']);
        });
    }
}
